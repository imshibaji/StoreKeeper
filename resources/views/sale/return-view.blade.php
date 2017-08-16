@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8">
      <h3>Return Page</h3>
    </div>
    <div class="col-md-4">
      <div class="btn-group btn-group-justified">
        <a class="btn btn-warning" onclick="printDiv('printDiv')">Print Bill</a>
        <a href="{{url('sales/create')}}" class="btn btn-success">Add</a>
        <a href="{{url('sales')}}" class="btn btn-info">Details</a>
        @if (Auth::user()->type == "admin")
            <a href="{{url('dashboard')}}" class="btn btn-primary">Back</a>
        @endif
      </div>
    </div>
  </div>

  <div id="printDiv" class="row">

    <div class="col-md-6" style="float:left">
      <h1>Return Invoice</h1>
    </div>
    <div class="col-md-6 text-right" style="float:right">
      <h3>{{$set->business_name}}</h3>
      <h4>{{$set->business_address}}</h4>
      @if ($set->gst_no != 'None' && $set->gst_no != 'none')
        <h4>GST Tin: {{$set->gst_no}}</h4>
      @endif
      <h4>Phone: {{$set->business_phone_no}}</h4>
      <h4>Ref No: {{$sale->name}}</h4>
      <h4>Sale ID: {{$sale->id}}</h4>
    </div>

    <table class="table table-bordered">
      <tr>
        <th>Date</th>
        <th>Detailes</th>
        <th>Units</th>
        <th>Amount</th>
      </tr>
      @php
        $details = json_decode($sale->details, true);
      @endphp
      @foreach ($details as $dt)
        <tr>
          <td>
            {{ explode(' ',$sale->created_at)[0] }}
          </td>
          <td>
            {{-- PID: {{$dt['id']}}, --}}
            <strong>{{$dt['name']}}</strong>,
            {{-- Quantity: {{$dt['quantity']}},
            Tax: {{$dt['attributes']['tax']}},
            Discount: {{$dt['attributes']['discount']}},--}}
            Price: {{$dt['price']}}/Item,
        </td>
        <td class="text-center">
          {{$dt['quantity']}}
        </td>
        <td class="text-right">
          {{ $dt['price'] * $dt['quantity']}}
        </td>
        </tr>
      @endforeach
      <tr>
        <td> &nbsp; </td>
        <td> &nbsp; </td>
        <td class="text-center">
            <h4>{{$sale->unit}}</h4>
        </td>
        <td class="text-right">
            <h4>{{$sale->netAmt}}</h4>
        </td>
      </tr>
      <tr>
        <td colspan="3" class="text-right">CGST: {{$sale->cgstPercent}}%</td>
        <td class="text-right">{{$sale->cgstAmt}}</td>
      </tr>
      <tr>
        <td colspan="3" class="text-right">SGST: {{$sale->sgstPercent}}%</td>
        <td class="text-right">{{$sale->sgstAmt}}</td>
      </tr>
      <tr>
        <td colspan="3" class="text-right">Discount: {{$sale->discountPercent}}%</td>
        <td class="text-right">{{$sale->discountAmt}}</td>
      </tr>
      <tr>
        <td colspan="3" class="text-right">Total</td>
        <td class="text-right">{{$sale->totalAmt}}</td>
      </tr>
      <tr>
        <td colspan="3" class="text-right">Transaction Mode</td>
        <td class="text-right">{{$sale->tmode}}</td>
      </tr>
    </table>
  </div>

</div>
@endsection


@section('footer-scripts')
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
@endsection
