@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-5">
      <h3>Sales Page</h3>
    </div>
    <div class="col-md-4">
      <h3></h3>
    </div>
    <div class="col-md-3">
      <div class="btn-group btn-group-justified">
        <a href="{{url('sales')}}" class="btn btn-info">Details</a>
        @if (Auth::user()->type == "admin")
            <a href="{{url('dashboard')}}" class="btn btn-primary">Back</a>
        @endif
      </div>
    </div>
  </div>


  <div class="row">
    <div class="col-md-4">
      @include('sale.parts.sales-item-add-part')
    </div>

    <form action="{{url('sales')}}" method="post">
      {{csrf_field()}}
    <div class="col-md-8">
      {{-- <dl class="dl-horizontal">
        <dt>Search Sale By ID: </dt>
        <dd><input type="text" class="form-control input-sm" name="sale-id" value="500" /></dd>
      </dl> --}}

      <div class="table_header">
      <table class="table table-bordered" style="margin:0px; padding:0px">
        <thead>
          <tr>
            <th class="col-xs-8">Sales Details</th>
            <th class="col-xs-1">Qnt.</th>
            <th class="col-xs-2">Price</th>
            <th class="col-xs-1">Actions</th>
          </tr>
        </thead>
        <tr>
          <th>
            <div class="col-xs-4">
              Order Name:
            </div>
            <div class="col-xs-8">
              <input type="text" id="odname" name="odname" class="form-control input-sm" readonly />
              <input type="hidden" id="oddetails" name="oddetails" class="form-control input-sm" value="{{$orders}}" />
            </div>
          </th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
        </tr>
      </table>
      </div>


      <div class="items-details" style="margin-top:0px; overflow:auto; height:150px">
      <table class="table table-bordered">
        <tbody>
          @foreach ($orders as $order)
            <tr>
              <td class="col-xs-8">{{ $order->name }}</td>
              <td class="col-xs-1 text-center">
                <input type="hidden" class="form-control text-right input-sm" name="unit{{$order->id}}" value="{{ $order->quantity }}" />
                {{ $order->quantity }}
              </td>
              <td class="col-xs-2 text-right">{{ $order->getPriceSum() }}</td>
              <td class="col-xs-1 text-center">
                <a href="{{url('order/remove/'.$order->id)}}" class="btn btn-danger"><i class="fa fa-trash-o"></i></a>
              </td>
            </tr>
          @endforeach

          {{-- <tr>
            <td>Product Title | Product Details</td>
            <td><input type="number" class="form-control text-right input-sm" name="unit" value="1" /></td>
            <td class="text-right">200</td>
            <td class="text-center">
              <button class="btn btn-primary"><i class="fa fa-edit"></i></button>
              <button class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
            </td>
          </tr>
          <tr>
            <td>Product Title | Product Details</td>
            <td><input type="number" class="form-control text-right input-sm" name="unit" value="1" /></td>
            <td class="text-right">200</td>
            <td class="text-center">
              <button class="btn btn-primary"><i class="fa fa-edit"></i></button>
              <button class="btn btn-danger"><i class="fa fa-trash-o"></i></button>
            </td>
          </tr> --}}

        </tbody>
        </table>
        </div>


        <div class="total">
        <table class="table table-bordered">
          <tr>
            <td class="text-right">Discount</td>
            <td class="text-right">
              <div class="input-group">
                <input type="text" class="form-control text-right input-sm" id="discount_percent" name="discount_percent" value="0" /><div class="input-group-addon">%</div>
              </div>
            </td>
            <td class="text-right"><input type="text" id="discount_amt" class="form-control text-right input-sm" name="discount_amt" value="0" /></td>
            <td>&nbsp;</td>
          </tr>
        <tr>
          <td class="col-xs-7 text-right">CGST</td>
          <td class="col-sx-2 text-right">
            <div class="input-group">
              <input type="text" class="form-control text-right input-sm" id="cgst_percent" name="cgst_percent" value="0" /><div class="input-group-addon">%</div>
            </div>
          </td>
          <td class="col-xs-2 text-right"><input type="text" class="form-control text-right input-sm" id="cgst_amt" name="cgst_amt" value="0" /></td>
          <td class="col-xs-1">&nbsp;</td>
        </tr>
        <tr>
          <td class="text-right">SGST</td>
          <td class="text-right">
            <div class="input-group">
              <input type="text" class="form-control text-right input-sm" id="sgst_percent" name="sgst_percent" value="0" /><div class="input-group-addon">%</div>
            </div>
          </td>
          <td class="text-right"><input type="text" class="form-control text-right input-sm" id="sgst_amt" name="sgst_amt" value="0" /></td>
          <td class="col-xs-1">&nbsp;</td>
        </tr>
        <tr>
          <td class="text-right">Total Amount</td>
          <td class="text-right">&nbsp;</td>
          <td class="text-right" id="total">{{ $total }}</td>
          <td>
            <input type="hidden" id="units" name="units" value="{{ $totalQualtity }}" />
            <input type="hidden" id="net_total" name="net_total" value="{{ $total }}" />
            <input type="hidden" id="put_total" name="put_total" value="{{ $total }}" />
            &nbsp;</td>
        </tr>
      </table>
      </div>

      <div class="row">
      <div class="col-md-6 col-md-offset-2">
        <div class="input-group">
          <span class="input-group-addon">Trasaction Mode</span>
          <select name="tmode" class="form-control">
            <option value="cash">Cash</option>
            <option value="card">Card</option>
            <option value="cheque">Cheque</option>
          </select>
        </div>
      </div>
      <div class="col-md-4">
        <div class="input-group text-right">
          <button class="btn btn-success" type="submit">Save Sales</button>
          <a href="{{url('order/clear')}}" class="btn btn-danger">Clear</a>
        </div>
      </div>
    </div>
    </div>
    </form>

    </div>
  </div>
@endsection


@section('footer-scripts')
<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script>

$(function(){
  var date = new Date();
  var day = date.getDate();
  var mon = date.getMonth();
  var yr = date.getFullYear();
  var hr = date.getHours();
  var min = date.getMinutes();
  var sec = date.getSeconds();
  $('#odname').val('ODR#'+day+''+mon+''+yr+''+hr+''+min+''+sec);

  $('#cgst_percent').val({{ $set->cgst }});
  $('#sgst_percent').val({{ $set->sgst }});
  $('#discount_percent').val({{ $set->discount }});
  discountCalculation();
  sgstCalculation();
  cgstCalculation();
  addtion();
});

$('#cgst_amt').on('keyup keypress blur change', function(){
  $('#cgst_percent').val(0);
  addtion();
});

$('#sgst_amt').on('keyup keypress blur change', function(){
  $('#sgst_percent').val(0);
  addtion();
});

$('#discount_amt').on('keyup keypress blur change', function(){
  $('#discount_percent').val(0);
  addtion();
});

$('#discount_percent').on('keyup keypress blur change', function(){
  discountCalculation();
  sgstCalculation();
  cgstCalculation();
  addtion();
});

$('#cgst_percent').on('keyup keypress blur change', function(){
  discountCalculation();
  cgstCalculation();
  sgstCalculation();
  addtion();
});

$('#sgst_percent').on('keyup keypress blur change', function(){
  discountCalculation();
  sgstCalculation();
  cgstCalculation();
  addtion();
});

function discountCalculation(){
  var discountPercent = parseFloat($('#discount_percent').val());
  var net_total = parseFloat($('#net_total').val());

  var discount = (net_total * discountPercent/100).toFixed(2);
  $('#discount_amt').val(discount);
}

function cgstCalculation(){
  var cgstPercent = parseFloat($('#cgst_percent').val());
  var net_total = parseFloat($('#net_total').val());
  var discount = parseFloat($('#discount_amt').val());

  var cgst = ((net_total - discount) * cgstPercent/100).toFixed(2);
  $('#cgst_amt').val(cgst);
}

function sgstCalculation(){
  var sgstPercent = parseFloat($('#sgst_percent').val());
  var net_total = parseFloat($('#net_total').val());
  var discount = parseFloat($('#discount_amt').val());

  var sgst = ((net_total - discount) * sgstPercent/100).toFixed(2);
  $('#sgst_amt').val(sgst);
}

function addtion(){
  var net_total = parseFloat($('#net_total').val());
  var cgst = parseFloat($('#cgst_amt').val());
  var sgst = parseFloat($('#sgst_amt').val());
  var discount = parseFloat($('#discount_amt').val());
  var total = ((net_total - discount) + cgst + sgst).toFixed(2);

  console.log(net_total, tax, discount, total);

  $('#put_total').val(total);
  $('#total').html(total);
}
</script>
@endsection
