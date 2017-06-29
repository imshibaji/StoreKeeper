@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-4">
      <a href="./stock" class="btn btn-primary btn-lg" style="width:100%; height:250px; line-height:240px;font-size:35px">Stocks</a>
    </div>
    <div class="col-md-4">
      <a href="./sales" class="btn btn-success btn-lg" style="width:100%; height:250px; line-height:240px;font-size:35px">Sales</a>
    </div>
    <div class="col-md-4">
      <a href="./reports" class="btn btn-info btn-lg" style="width:100%; height:250px; line-height:240px;font-size:35px">Reports</a>
    </div>
</div>
@endsection

@section('footer-scripts')

@endsection
