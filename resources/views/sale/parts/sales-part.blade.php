<table class="table table-responsive table-striped table-bordered">
  <thead>
    <tr>
      <th class="col-xs-2">Entry Date</th>
      <th class="col-xs-6">Sales Details</th>
      <th class="col-xs-1">Units</th>
      <th class="col-xs-3">Total Amount</th>
    </tr>
  </thead>
  <tbody>
  @foreach ($sales as $sale)
  <tr>
      <td class="text-center">
        <h4>{{ explode(' ',$sale->created_at)[0] }}</h4>
        <div class="row">
          <div class="col-xs-12">
            <div class="btn-group btn-group-justified">
              <a href="{{url('sales/'.$sale->id)}}" class="btn btn-success btn-sm btn-block">Print</a>
              <a href="{{url('sales/'.$sale->id.'/edit')}}" class="btn btn-danger btn-sm btn-block">Rerurn</a>
            </div>
          </div>
          {{-- <div class="col-xs-5">
          <form class="form-group" action="{{url('sales/'.$sale->id)}}" method="post">
             {{ csrf_field() }}
             {{ method_field('DELETE') }}
             <input type="hidden" name="id" value="{{$sale->id}}" />
            <button type="submit" class="btn btn-danger btn-sm btn-block">Delete</button>
          </form>
          </div> --}}
      </div>
      </td>
      <td>
        <p>Sale ID: {{$sale->id}}, Ref No: {{$sale->name}}, Status: {{$sale->status}}</p>
        @php
          $details = json_decode($sale->details, true);
        @endphp
        @foreach ($details as $dt)
          <h6>PID:{{$dt['id']}}, Name:{{$dt['name']}}, Qty:{{$dt['quantity']}}, Price:{{$dt['price']}}, ST:{{$dt['attributes']['tax']}}, Disc:{{$dt['attributes']['discount']}}, Status:{{$dt['attributes']['status']}}</h6>
        @endforeach
        <p>
          {{$sale->cgstPercent}}% CGST Rs. {{$sale->cgstAmt}}/-, {{$sale->sgstPercent}}% SGST Rs. {{$sale->sgstAmt}}/-, {{$sale->discountPercent}}% Discount Rs. {{$sale->discountAmt}}/-
        </p>
      </td>
      <td class="text-center">
        <h3>{{$sale->unit}}</h3>
      </td>
      <td>
        {{-- <h4>Net Amount Rs. {{$sale->netAmt}}/-</h4> --}}
        <h4>Total Amount Rs. {{$sale->totalAmt}}/-</h4>
      </td>
    </tr>
  @endforeach

  {{-- <tr>
    <td class="text-center">
      <h3>12-12-2016</h3>
      <div class="btn-group btn-group-justified">
        <a href="./edit-stocks" class="btn btn-primary btn-sm">Edit</a>
        <a href="./delete-stocks" class="btn btn-danger btn-sm">Delete</a>
      </div>
    </td>
    <td>
      <h4>Product Title</h4>
      <p>Here will be goes product details.</p>
      <p><strong>Rs 200/-</strong> per unit cost</p>
    </td>
    <td class="text-center">
      <h3>12</h3>
    </td>
    <td>
      <h2>Rs. 2000/-</h2>
    </td>
  </tr> --}}

  </tbody>
</table>
{{ $sales->links() }}
