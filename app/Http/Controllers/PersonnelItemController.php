<?php

namespace App\Http\Controllers;

use App\Models\PersonnelItem;
use App\Models\Personnel;
use App\Models\Item;
use App\Models\Branch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonnelItemController extends Controller
{
    /**
     * Display a listing of borrowed items.
     */
    public function index()
    {
        // Load all outbound records
        $outbounds = PersonnelItem::with(['personnel','personnel.branch', 'item'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Load personnels and items for the form
        $personnels = Personnel::all();
        $items = Item::paginate(10);

        return view('personnel.index', compact('outbounds', 'personnels', 'items'));
    }

    /**
     * Show the form for creating a new borrow record.
     */
    public function create()
    {
       
    }

    /**
     * Store a newly created borrow record.
     */
      public function store(Request $request)
{
    $request->validate([
        'personnel_id' => 'required|exists:personnels,personnel_id',
        'item_id' => 'required|exists:items,item_id',
        'personnel_item_quantity' => 'required|integer|min:1',
        'personnel_date_receive' => 'nullable|date',
        'personnel_date_issued' => 'nullable|date',
        'personnel_item_remarks' => 'required|string|max:500',
    ]);

    // Use a transaction to ensure stock consistency
    \DB::transaction(function () use ($request) {
        $item = \App\Models\Item::findOrFail($request->item_id);

        // Check if enough remaining stock exists
        if ($item->item_quantity_remaining < $request->personnel_item_quantity) {
            throw new \Exception('Not enough remaining stock available.');
        }

        // Decrement remaining quantity
        $item->item_quantity_remaining -= $request->personnel_item_quantity;

        // Update quantity status
        if ($item->item_quantity_remaining == 0) {
            $item->item_quantity_status = 'Out of Stock';
        } elseif ($item->item_quantity_remaining < ($item->item_quantity_total * 0.2)) {
            $item->item_quantity_status = 'Low Stock';
        } else {
            $item->item_quantity_status = 'Available';
        }

        $item->save();

        // Record outbound
        \App\Models\PersonnelItem::create([
            'personnel_id' => $request->personnel_id,
            'item_id' => $request->item_id,
            'personnel_item_quantity' => $request->personnel_item_quantity,
            'personnel_date_receive' => $request->personnel_date_receive,
            'personnel_date_issued' => $request->personnel_date_issued,
            'personnel_item_remarks' => $request->personnel_item_remarks,
        ]);
    });

    return redirect()->route('outbound.index')
        ->with('success', 'Item outbound recorded successfully!');
}

    public function storePersonnel(Request $request)
    {
        $request->validate([
            'branch_name' => 'required|string|max:255',
            'branch_department' => 'required|string|max:255',
            'personnel_name' => 'required|string|max:255',
        ]);

        $branch = Branch::create([
            'branch_name' => $request->branch_name,
            'branch_department' => $request->branch_department
        ]);

        Personnel::create([
            'branch_id' => $branch->id,
            'personnel_name' => $request->personnel_name,
        ]);

        return redirect()->back()->with('success', 'Personnel added successfully');
    }
    /**
     * Display the specified borrow record.
     */
    public function show(PersonnelItem $personnelItem)
    {
        $personnelItem->load(['personnel', 'item']);
        return view('personnel_items.show', compact('personnelItem'));
    }

    /**
     * Show the form for editing the specified borrow record.
     */
    public function edit(PersonnelItem $personnelItem)
    {
        $personnelItem->load(['personnel', 'item']);
        $personnels = Personnel::all();
        $items = Item::all();

        return view('personnel_items.edit', compact('personnelItem', 'personnels', 'items'));
    }

    /**
     * Update the specified borrow record.
     */
    public function update(Request $request, PersonnelItem $personnelItem)
    {
        $request->validate([
            'personnel_id' => 'required|exists:personnels,personnel_id',
            'item_id' => 'required|exists:items,item_id',
            'personnel_item_quantity' => 'required|integer|min:1',
            'personnel_item_receive' => 'required|date',
            'personnel_item_remarks' => 'nullable|string|max:500',
        ]);

        // Optional: handle stock adjustments if quantity changes
        DB::transaction(function () use ($request, $personnelItem) {
            $item = Item::findOrFail($request->item_id);

            // If quantity changed, adjust stock
            $quantityDiff = $request->personnel_item_quantity - $personnelItem->personnel_item_quantity;
            if ($quantityDiff > 0 && $item->item_quantity < $quantityDiff) {
                throw new \Exception('Not enough stock to increase quantity.');
            }

            $item->item_quantity -= $quantityDiff;
            $item->save();

            $personnelItem->update([
                'personnel_id' => $request->personnel_id,
                'item_id' => $request->item_id,
                'personnel_item_quantity' => $request->personnel_item_quantity,
                'personnel_item_receive' => $request->personnel_item_receive,
                'personnel_item_remarks' => $request->personnel_item_remarks,
            ]);
        });

        return redirect()->route('personnel-items.index')
            ->with('success', 'Borrow record updated successfully!');
    }

    /**
     * Remove the specified borrow record.
     */
    public function destroy(PersonnelItem $personnelItem)
    {
        DB::transaction(function () use ($personnelItem) {
            // Increment item stock back before deleting
            $item = $personnelItem->item;
            $item->item_quantity += $personnelItem->personnel_item_quantity;
            $item->save();

            $personnelItem->delete();
        });

        return redirect()->route('personnel-items.index')
            ->with('success', 'Borrow record deleted successfully!');
    }
}