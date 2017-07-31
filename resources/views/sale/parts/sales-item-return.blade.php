<table class="table">
  <tr>
    <td>Sale Id:</td>
    <td><input type="text" class="form-control" id="sid" value="{{ $sale->id }}"  readonly/></td>
  </tr>
  <tr>
    <td class="text-center" colspan="2">Sales Items</td>
  </tr>
  <tr>
    <td colspan="2">
      @php
        $details = json_decode($sale->details, true);
      @endphp
      @foreach ($details as $dt)
      <div class="row">
        <div class="col-xs-2">
          PID:-{{ $dt['id'] }}
        </div>
        <div class="col-xs-6">
          {{ $dt['name'] }}
        </div>
        <div class="col-xs-2">
          {{ $dt['quantity'] }}
        </div>
        <div class="col-xs-2">
          <a href="{{ url('order/return/'.$sale->id.'/'.$dt['id']) }}" class="btn btn-danger btn-xs"><i class="fa fa-mail-forward"></i></a>
        </div>
      </div>
      @endforeach
    </td>
  </tr>
  <tr>
    <td>Total Amount: INR:</td>
    <td><input type="text" id="sid" class="form-control" value="{{ $sale->totalAmt }}" readonly /></td>
  </tr>
</table>
