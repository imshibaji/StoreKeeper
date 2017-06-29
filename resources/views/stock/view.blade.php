@extends('layouts.app')

@section('content')
<div class="container">

  <div class="title">
    <div class="row">
      <div class="col-md-8">
        <h1>View Stock</h1>
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
      <div class="row">
      <div class="col-md-6 col-md-offset-3">
        {{-- <h3 class="text-center">Product Details</h3> --}}
        <div id="product-details">
        <dl class="dl-horizontal">
          <dt>Barcode ID</dt>
          <dd>
            <div id="bar-code">
            <p style="text-align: center;float:left">
              <img src="data:image/png;base64,{{DNS1D::getBarcodePNG("$stock->id", "C128")}}" alt="barcode"/>
              <br />
              {{ $stock->id }}</p>
            </div>
          </dd>
        </dl>

        <dl class="dl-horizontal">
          <dt>Product Id</dt>
          <dd>{{ $stock->id }}</dd>
        </dl>

        <dl class="dl-horizontal">
          <dt>Entry Date</dt>
          <dd>{{ $stock->created_at }}</dd>
        </dl>

        <dl class="dl-horizontal">
          <dt>Product Name</dt>
          <dd>{{ $stock->name }}</dd>
        </dl>

        <dl class="dl-horizontal">
          <dt>Product Details</dt>
          <dd>{{ $stock->details }}</dd>
        </dl>

        <dl class="dl-horizontal">
          <dt>No of Units</dt>
          <dd>{{ $stock->unit }}</dd>
        </dl>

        <dl class="dl-horizontal">
          <dt>Price per unit</dt>
          <dd>Rs.{{ $stock->unitPurchPrice }}/-</dd>
        </dl>

        <dl class="dl-horizontal">
          <dt>Total Amount</dt>
          <dd>Rs. {{ $stock->totalPurchAmount }}/-</dd>
        </dl>

      </div>
      <div class="text-center">
        <button class="btn btn-primary" onclick="printDiv('product-details')">Print Details</button>

        <button class="btn btn-primary" onclick="printDiv('bar-code')">Print Code</button>

        <a class="btn btn-primary" href="data:image/png;base64,{{DNS1D::getBarcodePNG("1", "C128")}}" download>Download Barcode</a>
      </div>
      </div>
    </div>

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
</script>
@endsection
