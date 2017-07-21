<html>
<table>
  <thead>
    <tr>
      <th>Date</th>
      <th>Description</th>
      <th>Type</th>
      <th>Credit</th>
      <th>Debit</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($reports as $report)
    <tr>
      <td>{{$report->date}}</td>
      <td>{{$report->details}}</td>
      <td>{{ $report->type }}</td>

      @if( $report->drcr == "dr" )
        <td>&nbsp;</td>
        <td>{{ $report->amount }}</td>
      @else
        <td>{{ $report->amount }}</td>
        <td>&nbsp;</td>
      @endif
    </tr>
    @endforeach
    {{-- <tr>
      <td>11/07/17</td>
      <td>Pid:1234567890, Shari Sale, 10 peace at Rs. 2000/-, Tax Apply 12%</td>
      <td>purchase</td>
      <td>&nbsp;</td>
      <td>2000</td>
    </tr> --}}
  </tbody>
  <tr>
    <th>&nbsp;</th>
    <th>&nbsp;</th>
    <th>Total</th>
    <th>{{ $totalCredit }}</th>
    <th>{{ $totalDebit }}</th>
  </tr>
</table>
</html>
