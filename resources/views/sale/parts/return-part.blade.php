<table class="table table-responsive table-striped table-bordered">
  <thead>
    <tr>
      <th class="col-xs-2">Entry Date</th>
      <th class="col-xs-6">Returns Details</th>
      <th class="col-xs-1">Units</th>
      <th class="col-xs-3">Total Amount</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($returns as $return)
    <tr>
        <td class="text-center">
          <h4>{{ explode(' ',$return->created_at)[0] }}</h4>
          <div class="row">
            <div class="col-xs-12">
              <div class="btn-group btn-group-justified">
                <a href="{{url('return/'.$return->id)}}" class="btn btn-success btn-sm btn-block">Print View</a>
                {{-- <a href="{{url('sales/'.$return->id.'/edit')}}" class="btn btn-danger btn-sm btn-block">Rerurn</a> --}}
              </div>
            </div>
            {{--<div class="col-xs-5">
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
          <p>Return ID: {{$return->id}}, Ref No: {{$return->name}}</p>
          @php
            $details = json_decode($return->details, true);
          @endphp
          @foreach ($details as $dt)
            <h6>PID:{{$dt['id']}}, Name:{{$dt['name']}}, Qty:{{$dt['quantity']}}, Price:{{$dt['price']}}, ST:{{$dt['attributes']['tax']}}, Disc:{{$dt['attributes']['discount']}}, </h6>
          @endforeach
          <p>
            {{$return->cgstPercent}}% CGST Rs. {{$return->cgstAmt}}/-, {{$return->sgstPercent}}% SGST Rs. {{$return->sgstAmt}}/-, {{$return->discountPercent}}% Discount Rs. {{$return->discountAmt}}/-
          </p>
        </td>
        <td class="text-center">
          <h3>{{$return->unit}}</h3>
        </td>
        <td>
          {{-- <h4>Net Amount Rs. {{$return->netAmt}}/-</h4> --}}
          <h4>Total Amount Rs. {{$return->totalAmt}}/-</h4>
        </td>
      </tr>
    @endforeach

  {{-- <tr>
    <td class="text-center">
      <h3>12-12-2016</h3>
      <div class="btn-group btn-group-justified">
        <a href="./edit-stocks" class="btn btn-primary btn-sm">view</a>
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
{{ $returns->links() }}
