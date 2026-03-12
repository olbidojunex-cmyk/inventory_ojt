<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemUom;
use App\Models\ItemBrand;
use App\Models\ItemCategory;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $item_categories = ItemCategory::All();
        $item_brands = ItemBrand::All();
        $item_uoms = ItemUom::All();
        $items = Item::All();
        
        $items = Item::orderBy('created_at', 'desc')->paginate(10);
        return view('inventory.index', compact('item_categories','item_brands','item_uoms','items'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
        {
           $request->validate([
            'item_name' => '|string|max:255',
            'item_serialno' => 'string|max:255',
            'item_quantity' => '|integer|max:255',
            'item_remarks' => '|string|max:255',
            'item_uom_name' => '|string|max:255',
            'item_brand_name' => '|string|max:255',
        
            'item_category_id' => '|exists:item_categories,item_category_id'
           
        ]);


        $item_brands = ItemBrand::create([
            'item_brand_name' => $request->item_brand_name
        ]);

        $item_uoms = ItemUom::create([
            'item_uom_name' => $request->item_uom_name
        ]);


        // Create personnel linked to branch
        Item::create([
            'item_name' => $request->item_name,
            'item_serialno' => $request->item_serialno,
            'item_quantity' => $request->item_quantity,
            'item_remark' => $request->item_remark,
            

            'item_category_id' => $request->item_category_id,
            'item_uom_id' => $item_uoms->id,
            'item_brand_id' => $item_brands->id
           
        ]);

        return redirect()->back()->with('success','Item added successfully');

        }
    public function storeCategory(Request $request)
    {
        $request->validate([
            'item_category_name' => 'required|string|max:255|unique:item_categories,item_category_name',
        ]);

        ItemCategory::create([
            'item_category_name' => $request->item_category_name
        ]);

        return redirect()->back()->with('success', 'Category added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Item $item)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
       
    }
}
