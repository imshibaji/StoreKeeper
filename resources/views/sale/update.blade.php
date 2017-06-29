@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-9">
      <h3>Sales Page</h3>
    </div>
    <div class="col-md-3">
      <div class="btn-group btn-group-justified">
        <a href="./view-sales" class="btn btn-info">Details</a>
        <a href="./dashboard" class="btn btn-primary">Back</a>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-4">
      @include('sale.parts.sales-item-add-part')
    </div>


    <div class="col-md-8">
      {{-- <dl class="dl-horizontal">
        <dt>Search Sale By ID: </dt>
        <dd><input type="text" class="form-control input-sm" name="sale-id" value="500" /></dd>
      </dl> --}}

      <div class="table_header">
      <table class="table table-bordered" style="margin:0px; padding:0px">
        <thead>
          <tr>
            <th class="col-xs-9">Product Details</th>
            <th class="col-xs-1">Qnt.</th>
            <th class="col-xs-2">Price</th>
          </tr>
        </thead>
        <tr>
          <th>Order Name: ODR#270617</th>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
        </tr>
      </table>
      </div>


      <div class="items-details" style="margin-top:0px; overflow:auto; height:150px">
      <table class="table table-bordered">
        <tbody>
          <tr>
            <td class="col-xs-9">Product Title | Product Details</td>
            <td class="col-xs-1"><input type="number" class="form-control text-right input-sm" name="unit" value="1" /></td>
            <td class="col-xs-2 text-right">200</td>
          </tr>
          <tr>
            <td>Product Title | Product Details</td>
            <td><input type="number" class="form-control text-right input-sm" name="unit" value="1" /></td>
            <td class="text-right">200</td>
          </tr>
          <tr>
            <td>Product Title | Product Details</td>
            <td><input type="number" class="form-control text-right input-sm" name="unit" value="1" /></td>
            <td class="text-right">200</td>
          </tr>
          <tr>
            <td>Product Title | Product Details</td>
            <td><input type="number" class="form-control text-right input-sm" name="unit" value="1" /></td>
            <td class="text-right">200</td>
          </tr>
          <tr>
            <td>Product Title | Product Details</td>
            <td><input type="number" class="form-control text-right input-sm" name="unit" value="1" /></td>
            <td class="text-right">200</td>
          </tr>
        </tbody>
        </table>
        </div>


        <div class="total">
        <table class="table table-bordered">
        <tr>
          <td class="col-xs-9 text-right">Tax</td>
          <td class="col-xs-2 text-right"><input type="text" class="form-control text-right input-sm" name="tax" value="500" /></td>
        </tr>
        <tr>
          <td class="text-right">Discount</td>
          <td class="text-right"><input type="text" class="form-control text-right input-sm" name="discount" value="0" /></td>
        </tr>
        <tr>
          <td class="text-right">Total Amount</td>
          <td class="text-right">20500</td>
        </tr>
      </table>
      </div>
    </div>
  </div>

  <div class="col-md-4 col-md-offset-6">
    <div class="input-group">
      <span class="input-group-addon">Trasection Mode</span>
      <select name="tmode" class="form-control">
        <option value="cash">Cash</option>
        <option value="card">Card</option>
        <option value="cheque">Cheque</option>
      </select>
    </div>
  </div>
  <div class="col-md-2">
    <div class="input-group text-right">
      <button class="btn btn-success" type="submit">Save Sales</button>
      <button class="btn btn-danger" type="submit">Clear</button>
    </div>
  </div>


</div>
@endsection


@section('footer-scripts')
<script>
//alert('This is sales Main');
</script>
@endsection
