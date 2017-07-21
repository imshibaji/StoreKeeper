  <h3 class="text-center">Find / Add Item</h3>
  <div class="input-group">
    <span class="input-group-addon">Product ID</span>
    <input type="text" class="form-control" id="pid" autofocus />
  </div>
  <div class="input-group">
    <span class="input-group-addon">Product Name</span>
    <input type="text" class="form-control" id="pname" readonly />
  </div>

  <div class="input-group">
    <span class="input-group-addon">Product Details</span>
    <input type="text" class="form-control" id="pdetails" readonly />
  </div>

  <div class="input-group">
    <span class="input-group-addon">In Stocks</span>
    <input type="text" class="form-control" id="astock" readonly />
    {{-- <span class="input-group-addon">Booked Stocks</span>
    <input type="text" class="form-control" id="bstock" name="bstock" readonly /> --}}
  </div>

  <div class="input-group">
    <span class="input-group-addon">Discount</span>
    <input type="text" class="form-control" id="discount" name="discount" readonly />
    <span class="input-group-addon">Tax</span>
    <input type="text" class="form-control" id="tax" readonly />
  </div>

  <div class="input-group">
    <span class="input-group-addon">Unit Price</span>
    <input type="text" class="form-control" id="price" readonly />
    {{-- <span class="input-group-addon">Net Total</span>
    <input type="text" class="form-control" id="ntotal" name="ntotal" readonly /> --}}
  </div>

  {{-- <div class="input-group">
    <span class="input-group-addon">Total Amount</span>
    <input type="text" class="form-control" id="tamount" name="tamount" readonly />
  </div> --}}

  <div class="btn-group">
    <a id="add_item" class="btn btn-success">Add Product</a>
    <a id="reset_item" class="btn btn-danger">Reset Product</a>
  </div>

@section('footer-scripts')
@parent
<script>
$(function(){
  // keyup keypress blur change
  $('#pid').on('keyup change', function(){
    $.get("{{url('order/get')}}/"+$('#pid').val(), function(data){
      if( data !== '' ){
        console.log(data);
        $('#pname').val(data.name);
        $('#pdetails').val(data.description);
        $('#astock').val(data.unit);
        $('#discount').val(data.saleDisount);
        $('#tax').val(data.saleTax);
        $('#price').val(data.unitSaleAmt);
        $("#add_item").attr('href', "{{url('order')}}/"+data.id);
      }

    });
  });

  $('#reset_item').click(function(){
    $('#pid').val("");
    $('#pname').val("");
    $('#pdetails').val("");
    $('#astock').val("");
    $('#discount').val("");
    $('#tax').val("");
    $('#price').val("");
    $("#add_item").attr('href', "#");
  });
});
</script>
@endsection
