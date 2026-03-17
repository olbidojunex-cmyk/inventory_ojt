 @foreach ($outbounds as $outbound)
     <tr>
         <td>
             <input type="checkbox" class="select_item" value="{{ $outbound->personnel_item_id }}">
         </td>
         <td>{{ $outbound->personnel?->personnel_name ?? '-' }}</td>
         <td>{{ $outbound->item?->item_name ?? '-' }}</td>
         <td>{{ $outbound->personnel_date_issued }}</td>
         <td>{{ $outbound->personnel_item_quantity }}</td>
         <td>{{ $outbound->item?->uom?->item_uom_name ?? '-' }}</td>
         <td>{{ $outbound->personnel_date_receive }}</td>
         <td>{{ $outbound->personnel?->branch?->branch_name ?? '-' }}</td>
         <td>{{ $outbound->personnel?->branch?->branch_department ?? '-' }}</td>
         <td>{{ $outbound->personnel_item_remarks }}</td>
         <td>action</td>
     </tr>
 @endforeach
