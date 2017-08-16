@extends('layouts.app')

@section('content')
<div class="container">
  <div class="title">
    <div class="row">
      <div class="col-md-8">
        <h1>Sales Destails</h1>
      </div>
      <div class="col-md-4">
        <div class="btn-group btn-group-justified">
          <a href="{{url('sales/create')}}" class="btn btn-success">Add Sales</a>
          @if (Auth::user()->type == "admin")
              <a href="{{url('dashboard')}}" class="btn btn-primary">Back</a>
          @endif
        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs" role="tablist">
      <li class="tab"><a href="{{ url('sales') }}">Sales</a></li>
      <li class="tab active"><a href="{{ url('sales/returns') }}">Returns</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div class="tab-pane active" id="returns">
        @include('sale.parts.return-part', [])
    </div>
  </div>

</div>
  </div>

</div>
@endsection
