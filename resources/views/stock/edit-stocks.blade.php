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
          <a href="./view-stocks" class="btn btn-info">Details</a>
          <a href="./dashboard" class="btn btn-primary">Back</a>
        </div>
      </div>
    </div>
  </div>


  <div class="details">
    <form action="#" method="post" name="stocks-add">
      {{ csrf_field() }}
      <div class="row">
        <div class="col-md-6">
          <h4>Product Id:</h4>
          <div class="input">
            <input type="text" class="form-control" placeholder="Not Initiate Yet" readonly="readonly" id="pid" name="pid" value="Not Initiate Yet">
          </div>

          <h4>Product Name:</h4>
          <div class="input">
            <input type="text" class="form-control" placeholder="Product Name" id="name" name="name">
          </div>

          <h4>Product Description:</h4>
          <div class="input">
            <input type="text" class="form-control" placeholder="Product Description" id="desc" name="desc">
          </div>

          <h4>No of Units:</h4>
          <div class="input">
            <input type="text" class="form-control" placeholder="No of Units" id="units" name="units">
          </div>

          <h4>Unit Price:</h4>
          <div class="input">
            <input type="text" class="form-control" placeholder="Unit Price" id="uprice" name="uprice">
          </div>

          <h4>Total Amount:</h4>
          <div class="input">
            <input type="text" class="form-control" placeholder="Total Amount" id="tamount" name="tamount">
          </div>

        </div>

      <div class="col-md-6">
        {{-- <h3 class="text-center">Product Details</h3> --}}
        <div id="product-details">
        <dl class="dl-horizontal">
          <dt>Barcode ID</dt>
          <dd>
            <div id="bar-code">
            <p style="text-align: center;float:left">
              <img src="data:image/png;base64,{{DNS1D::getBarcodePNG("1", "C128")}}" alt="barcode"/>
              <br />
              1</p>
            </div>
          </dd>
        </dl>

        <dl class="dl-horizontal">
          <dt>Product Id</dt>
          <dd>87876566554</dd>
        </dl>

        <dl class="dl-horizontal">
          <dt>Entry Date</dt>
          <dd>13-12-2017 8:7:6</dd>
        </dl>

        <dl class="dl-horizontal">
          <dt>Product Name</dt>
          <dd>Shari of the product</dd>
        </dl>

        <dl class="dl-horizontal">
          <dt>Product Details</dt>
          <dd>Shari of the product. Shari of the product. Shari of the product.</dd>
        </dl>

        <dl class="dl-horizontal">
          <dt>No of Units</dt>
          <dd>10</dd>
        </dl>

        <dl class="dl-horizontal">
          <dt>Price per unit</dt>
          <dd>Rs. 200</dd>
        </dl>

        <dl class="dl-horizontal">
          <dt>Total Amount</dt>
          <dd>Rs. 2000/-</dd>
        </dl>

      </div>
      <div class="text-center">
        <button class="btn btn-primary" onclick="printDiv('product-details')">Print Details</button>

        <button class="btn btn-primary" onclick="printDiv('bar-code')">Print Code</button>
        
        <a class="btn btn-primary" href="data:image/png;base64,{{DNS1D::getBarcodePNG("1", "C128")}}" download>Download Barcode</a>
      </div>
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

<style>
.vertical-center-row {
    display: table-cell;
    vertical-align: middle;
    text-align: center;
}
</style>
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
