@extends('layouts.app')

@section('content')
<div class="container">
  <div class="title">
    <div class="row">
      <div class="col-md-8">
        <h1>Stocks Destails</h1>
      </div>
      <div class="col-md-4">
        <div class="btn-group btn-group-justified">
          <a href="{{url('stock/create')}}" class="btn btn-success">Add Stocks</a>
          <a href="{{url('dashboard')}}" class="btn btn-primary">Back</a>
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <table class="table table-responsive table-striped table-bordered">
      <thead>
        <tr>
          <th class="col-xs-2">Entry Date</th>
          <th class="col-xs-6">Stock Details</th>
          <th class="col-xs-1">Units</th>
          <th class="col-xs-3">Total Amount</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($stocks as $stock)
          <tr>
            <td class="text-center">
              <h3>{{$stock->created_at}}</h3>
              <div class="row">
                <div class="col-xs-12">
                  <div class="btn-group btn-group-justified">
                    <a href="{{url('stock/'.$stock->id)}}" class="btn btn-success btn-sm btn-block">View</a>
                  <a href="{{url('stock/'.$stock->id.'/edit')}}" class="btn btn-primary btn-sm btn-block">Edit</a>
                  </div>
                </div>
                {{-- <div class="col-xs-5">
                <form class="form-group" action="{{url('stock/'.$stock->id)}}" method="post">
                   {{ csrf_field() }}
                   {{ method_field('DELETE') }}
                   <input type="hidden" name="id" value="{{$stock->id}}" />
                  <button type="submit" class="btn btn-danger btn-sm btn-block">Delete</button>
                </form> --}}
              </div>
            </div>
            </td>
            <td>
              <p>Product ID: {{$stock->id}}</p>
              <h4>{{$stock->name}}</h4>
              <p>{{$stock->description}}</p>
              <p>Purchase at <strong>Rs {{$stock->unitPurchPrice}}/-</strong>,  inlude tax Rs. {{$stock->saleTax}}/-, discount Rs. {{$stock->saleDisount}}/-, Sale at <strong>Rs {{$stock->unitSaleAmt}}/-</strong></p>
            </td>
            <td class="text-center">
              <h3>{{$stock->unit}}</h3>
            </td>
            <td>
              <h4>Sale Rs. {{$stock->totalSaleAmount}}/-</h4>
              <h4>Purchase Rs. {{$stock->totalPurchAmount}}/-</h4>
              <h4>Profit Rs. {{$stock->totalSaleAmount - $stock->totalPurchAmount}}/-</h4>
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
          <p>Product ID: 88765449</p>
          <h4>Product Title</h4>
          <p>Here will be goes product details.</p>
          <p>Purchase at <strong>Rs 200/-</strong>, Sale at <strong>Rs 200/-</strong>, inlude tax Rs. 0/-, discount Rs. 0/-</p>
        </td>
        <td class="text-center">
          <h3>12</h3>
        </td>
        <td>
          <h4>Sale Rs. 4000/-</h4>
          <h4>Purchase Rs. 2000/-</h4>
          <h4>Profit Rs. 2000/-</h4>
        </td>
      </tr> --}}
      </tbody>
    </table>
    {{ $stocks->links() }}
  </div>

</div>
@endsection
