@if ($items->count())

    <div class="list-group">
        @php
            $remarkColor = [
                'To be delivered' => 'bg-info text-dark',
                'Not Receive' => 'bg-danger',
                'Issued' => 'bg-warning text-dark',
                'Received' => 'bg-success',
                'Returned' => 'bg-primary',
            ];
        @endphp
        @foreach ($items as $outbound)
            <div class="list-group-item">

                <div class="d-flex justify-content-between">
                    <h6 class="mb-1">{{ $outbound->item->item_name }}</h6>
                    <span class="badge bg-secondary">
                        {{ $outbound->personnel_item_quantity }}
                    </span>
                </div>

                <small class="text-muted">
                    Issued:
                    {{ \Carbon\Carbon::parse($outbound->personnel_date_issued)->setTimezone('Asia/Manila')->format('M d, Y ') }}
                    |
                    Status: <span class="badge {{ $remarkColor[$outbound->personnel_item_remarks] ?? 'bg-secondary' }}">
                        {{ $outbound->personnel_item_remarks ?? '-' }}
                    </span>
                </small>
            </div>
        @endforeach
    </div>
@else
    <div class="text-muted">No assigned items.</div>
@endif
