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
      <li role="presentation" class="active"><a href="#sales" aria-controls="sales" role="tab" data-toggle="tab">Sales</a></li>
      <li role="presentation"><a href="#returns" aria-controls="returns" role="tab" data-toggle="tab">Returns</a></li>
    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
      <div role="tabpanel" class="tab-pane active" id="sales">
        @include('sale.parts.sales-part', ['sales'=>$sales])
      </div>
    {{-- Sales End --}}
    {{-- Returns Start --}}
    <div role="tabpanel" class="tab-pane" id="returns">
        @include('sale.parts.return-part', [])
    </div>
  </div>

</div>
  </div>

</div>
@endsection
