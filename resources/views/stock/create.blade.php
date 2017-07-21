@extends('layouts.app')

@section('content')
<div class="container">

  <div class="title">
    <div class="row">
      <div class="col-md-8">
        <h1>Stocks</h1>
      </div>
      <div class="col-md-4">
        <div class="btn-group btn-group-justified">
          <a href="{{url('stock')}}" class="btn btn-info">Details</a>
          <a href="{{url('dashboard')}}" class="btn btn-primary">Back</a>
        </div>
      </div>
    </div>
  </div>


  <div class="details">
    <form action="{{url('stock')}}" method="POST" name="stocks-add">
      {{ csrf_field() }}
      <div class="row">
        <div class="col-md-6">
          <table class="table table-hover">
            <tr>
              <td>
                <h4>Product Name:</h4>
              </td>
              <td>
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Product Name" id="name" name="name" value="{{ old('name') }}" required>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <h4>Product Description:</h4>
              </td>
              <td>
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="Product Description" id="desc" name="desc" value="{{ old('desc') }}" required>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <h4>No of Units:</h4>
              </td>
              <td>
                <div class="input-group">
                  <input type="text" class="form-control" placeholder="No of Units" id="units" name="units" value="{{ old('units') }}" required>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <h4>Unit Purchase Price:</h4>
              </td>
              <td>
                <div class="input">
                  <input type="text" class="form-control" placeholder="Unit Purchase Price" id="upurprice" name="upurprice" value="{{ old('upurprice') }}" required>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <h4>Total Purchase Amount:</h4>
              </td>
              <td>
                <div class="input">
                  <input type="text" class="form-control" placeholder="Total Purchase Amount" id="tamount" name="tamount" value="{{ old('tamount') }}" required>
                </div>
              </td>
            </tr>
          </table>

        </div>

      <div class="col-md-6">
          <table class="table table-hover">
            <tr>
              <td>
                <h4>Unit Sales Price:</h4>
              </td>
              <td>
                <div class="input">
                  <input type="text" class="form-control" placeholder="Unit Sales Price" id="usalprice" name="usalprice" value="{{ old('usalprice') }}" readonly>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <h4>Extra Added / Tax:</h4>
              </td>
              <td>
                <div class="form-inline">
                  <input type="text" class="form-control" id="tax-percent" placeholder="By %" value="0" size="3" required><span class="input-lg">%</span>
                  <input type="text" class="form-control" placeholder="Sales Tax" id="tax" name="tax" value="0" readonly>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <h4>Sales Discount:</h4>
              </td>
              <td>
                <div class="form-inline">
                  <input type="text" class="form-control" id="percent" placeholder="By %" value="0" size="3" required><span class="input-lg">%</span>
                  <input type="text" class="form-control" placeholder="Sales Discount" id="discount" name="discount" value="0" readonly>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <h4>Unit Sales Amount:</h4>
              </td>
              <td>
                <div class="input">
                  <input type="text" class="form-control" placeholder="Unit Sales Amount" id="unitsalamt" name="unitsalamt" value="{{ old('unitsalamt') }}" required>
                </div>
              </td>
            </tr>
            <tr>
              <td>
                <h4>Total Sales Amount:</h4>
              </td>
              <td>
                <div class="input">
                  <input type="text" class="form-control" placeholder="Total Sales Amount" id="totsalamt" name="totsalamt" value="{{ old('totsalamt') }}" required>
                </div>
              </td>
            </tr>
          </table>
      </div>
    </div>

      <div class="row">
        <div class="col-md-12 input-lg">
          <button class="btn btn-success btn-block" type="submit">Save Stock</button>
        </div>
      </div>

    </form>
  </div>

</div>
@endsection


@section('head-scripts')
<style>
.vertical-center-row {
    display: table-cell;
    vertical-align: middle;
    text-align: center;
}

.table .input-group{
  width: 100% !important;
  display: block;
}
</style>
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

$(document).ready(function(){
  $('#units').val(0);
  $('#upurprice').val(0);
  $('#tax-percent').val({{$tax}});
  calculation();
});

$('#units').on('keyup keypress blur change',function(){
  calculation();
});

$('#upurprice').on('keyup keypress blur change',function(){
  calculation();
});

$('#tax-percent').on('keyup keypress blur change', function(){
  calculation();
});

// $('#tax').on('keyup keypress blur change',function(){
//   calculation();
// });

$('#percent').on('keyup keypress blur change',function(){
  calculation();
});

$('#discount').on('keyup keypress blur change',function(){
  calculation();
});


function calculation(){
  var units = parseInt($('#units').val());
  var upurprice = parseFloat($('#upurprice').val());
  var tamount = $('#tamount');
  var usalprice = $('#usalprice');
  var taxper = parseFloat($('#tax-percent').val());
  var taxamt = $('#tax');
  var percent = parseFloat($('#percent').val());
  var discamt = $('#discount');
  var unitsalamt = $('#unitsalamt');
  var totsalamt = $('#totsalamt');

  var profit_percent = {{ $profit }};
  var totalPurchAmount = upurprice * units;

  var sale_price = upurprice + (upurprice * profit_percent/100);

  var tax_per = sale_price * taxper/100;

  var discount = (sale_price + tax_per) * percent/100;
  var unit_sale_price = (sale_price + tax_per) - discount;
  var total_sale_amount = unit_sale_price * units;

  tamount.val(totalPurchAmount);
  usalprice.val(sale_price);

  unitsalamt.val(unit_sale_price);
  taxamt.val(tax_per);
  discamt.val(discount);
  totsalamt.val(total_sale_amount);

  // console.log( units, upurprice, totalPurchAmount, sale_price, unit_sale_price, total_sale_amount);
  //
  // console.log( tax, discount);
}

</script>
@endsection
