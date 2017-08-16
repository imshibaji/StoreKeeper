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
      <div class="col-md-6">
        {{-- <h3 class="text-center">Product Details</h3> --}}
        <div id="product-details">
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
          <dd>{{ $stock->description }}</dd>
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
          <dt>Sale Price/Unit</dt>
          <dd>Rs.{{ $stock->unitSalePrice }}/-</dd>
        </dl>

        <dl class="dl-horizontal">
          <dt>Tax</dt>
          <dd>Rs.{{ $stock->saleTax }}/-</dd>
        </dl>

        <dl class="dl-horizontal">
          <dt>Discount</dt>
          <dd>Rs.{{ $stock->saleDisount }}/-</dd>
        </dl>

        <dl class="dl-horizontal">
          <dt>Sale Net Price/Unit</dt>
          <dd>Rs.{{ $stock->unitSaleAmt }}/-</dd>
        </dl>

        <dl class="dl-horizontal">
          <dt>Total Amount</dt>
          <dd>Rs. {{ $stock->totalPurchAmount }}/-</dd>
        </dl>

      </div>
      {{-- <div class="text-center">
        <button class="btn btn-primary" onclick="printDiv('product-details')">Print Details</button>

        <button class="btn btn-primary" onclick="printDiv('bar-code')">Print Code</button>

        <a id="btn-download" class="btn btn-primary" href="#" download>Download Barcode</a>
      </div> --}}
      </div>

      <div class="col-md-6">
        <div class="barcode-area">
          <h3 class="text-center" style="margin:0px;padding:0px;text-align:center">Barcode Genarator</h3>
          <div class="row" style="margin-bottom:10px;">
            <div class="col-xs-12">
              {{-- Bar Code Gen --}}
              <div id="bar-code" style="text-align:center">
              <div style="font-size:30px;text-align:center"><b>{{ $set->business_name }}</b></div>
                <div style="text-align:center">
                  <img src="data:image/png;base64,{{DNS1D::getBarcodePNG("$stock->id", "C128")}}" alt="barcode"/>
                </div>
                <div style="margin-top:-5px;text-align:center"> -- {{ $stock->id }} -- </div>
                <div style="text-align:center">
                  <h1><strong>{{ $stock->name }}</h1>
                  <h3>{{ $stock->description }}</h3>
                  {{-- <del>Rs.{{ $stock->unitSaleAmt }}/-</del> --}}
                  <h2><strong>Amount Rs. {{ $stock->unitSaleAmt - $stock->saleDisount }}/-</strong></h2>
                </div>
              </div>
              {{-- Bar Code Gen --}}
            </div>
          </div>

          {{-- BarCode Preview --}}
          <div id="preview" class="row" style="border:1px solid black; height:350px;text-align:center; margin-bottom:20px;">
            <h4>Downloadable Barcode Preview</h4>
          </div>
          {{-- BarCode Preview --}}

          <div class="text-center">
            <button class="btn btn-primary" onclick="printDiv('product-details')">Print Details</button>

            <button class="btn btn-primary" onclick="printDiv('bar-code')">Print Code</button>

            {{-- <button id="btn-preview-image" class="btn btn-primary">Preview Image</button> --}}

            <a id="btn-download" class="btn btn-primary" href="#" download>Download Barcode</a>
          </div>
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
<script src="{{ asset('js/html2canvas.js') }}"></script>

{{-- <script>
$(function(){
  // Global variables
  var captureArea = $("#capture-area"),
      capturedData;

    $("#btn-preview-image").on('click', function () {
      // To capture entire page
      $('body').scrollTop(0);
      // Get canvas
      html2canvas(captureArea, {
         allowTaint: true,
         useCORS: true,
         taintTest: false,
         onrendered: function (canvas) {
           $("#previewImage").html("").append(canvas);
              capturedData = canvas;
           }
       });
    });

	$("#btn-download").on('click', function () {
    if (capturedData === void 0) {
      alert("Please preview before downloading.");
    } else {
      var imgageData = capturedData.toDataURL("image/png");
      // Now browser starts downloading it instead of just showing it
      var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
      $("#btn-download").attr("download", "screenshot.png").attr("href", newData);
    }
  });
});
</script> --}}

<script>
$(function(){

var capturedData;
html2canvas(document.getElementById('bar-code'),{
  onrendered: function (canvas) {
    document.getElementById('preview').appendChild(canvas);
    capturedData = canvas;
  }
});

var captureArea = $("#bar-code");
$("#btn-preview-image").on('click', function () {

  html2canvas(captureArea, {
     onrendered: function (canvas) {
       $("#preview").html("<h4>Downloadable Barcode Preview</h4>").append(canvas);
          capturedData = canvas;
       }
   });
});

$("#btn-download").on('click', function () {
  if (capturedData === void 0) {
    alert("Please preview before downloading.");
  } else {
    var imgageData = capturedData.toDataURL("image/png");
    // Now browser starts downloading it instead of just showing it
    var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
    $("#btn-download").attr("download", "barcode-{{$stock->id}}.png").attr("href", newData);
  }
});

});

function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
@endsection
