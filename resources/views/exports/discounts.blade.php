<table>
    <thead>
    <tr>
        <th align=center style="font-size: 16px">ID</th>
        <th align=center style="font-size: 16px">Full Name</th>
        <th align=center style="font-size: 16px">W/R</th>
        <th align=center style="font-size: 16px">Discounts</th>
        <th align=center style="font-size: 16px">Cash Discounts</th>
        <th align=center style="font-size: 16px">-</th>
        <th align=center style="font-size: 16px">Date</th>
        <th align=center style="font-size: 16px">Rate</th>
        <th align=center style="font-size: 16px">Reason</th>
    </tr>
    </thead>
    <tbody>
    @foreach($exportedDiscounts as $employee)
        <tr>
            <td bgcolor=green align=center style="border: 3px solid #CCC;">{{ $employee->id }}</td>
            <td bgcolor=green align=center style="border: 3px solid #CCC;">{{ $employee->full_name }}</td>
            <td bgcolor=green align=center style="border: 3px solid #CCC;">{{ $employee->contract->work_rate }}</td>
            <td bgcolor=gray align=center style="border: 3px solid #CCC;">{{ count($employee->discounts) }}</td>
            <td @if ( $employee->cash_discounts_count != 0 ) bgcolor=red @else bgcolor=gray @endif align=center style="border: 3px solid #CCC;">{{ $employee->cash_discounts_count }}</td>
        </tr>
        @foreach($employee->discounts as $discount)
          <tr>
            <td colspan=5></td>
            <td align=center style="border: 3px dashed #CCC;">{{ $loop->iteration }}</td>
            <td align=center>{{ $discount->date }}</td>
            <td bgcolor=orange align=center class="text-center">
              <div class="badge bg-label-danger me-1">
                {{ $discount->rate }}
              </div>
            </td>
            <td>
              {{ $discount->reason }}
              @if ($discount->is_auto)
                <span class="badge badge-center rounded-pill bg-label-secondary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-custom-class="tooltip-primary" data-bs-original-title="Automatic"><i class="ti ti-settings"></i></span>
              @endif
            </td>
          </tr>
        @endforeach
    @endforeach
    </tbody>
</table>
