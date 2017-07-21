@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <h3 class="text-center">Quick Report Periods: {{ $start }} to {{ $end }}</h3>
  </div>
  <div class="row top-btns">
    <div class="col-md-4">
      <a href="#" class="btn btn-success btn-lg" style="width:100%; height:100px; line-height:80px;font-size:25px">
        Sales: Rs.{{$sales}}/-
      </a>
    </div>
    <div class="col-md-4">
      <a href="#" class="btn btn-warning btn-lg" style="width:100%; height:100px; line-height:80px;font-size:25px">
        Purchase: Rs.{{$purchase}}/-
      </a>
    </div>
    <div class="col-md-4">
      <a href="#" class="btn btn-primary btn-lg" style="width:100%; height:100px; line-height:80px;font-size:25px">
        Balance: Rs.{{ $sales - $purchase }}/-
      </a>
    </div>
  </div>

  <div class="row middle-btns">
    <div class="col-md-3">
      <a href="./stock" class="btn btn-primary btn-lg" style="width:100%; height:250px; line-height:240px;font-size:35px">Purchase</a>
    </div>
    <div class="col-md-3">
      <a href="./sales" class="btn btn-success btn-lg" style="width:100%; height:250px; line-height:240px;font-size:35px">Sales</a>
    </div>
    <div class="col-md-3">
      <a href="./reports" class="btn btn-info btn-lg" style="width:100%; height:250px; line-height:240px;font-size:35px">Reports</a>
    </div>
    <div class="col-md-3">
      <a href="./settings" class="btn btn-warning btn-lg" style="width:100%; height:250px; line-height:240px;font-size:35px">Settings</a>
    </div>
  </div>

  <div class="row buttom-btns">
    <div class="col-md-6">
      <a href="./users" class="btn btn-warning btn-lg" style="width:100%; height:80px; line-height:60px;font-size:35px">Users</a>
    </div>
    <div class="col-md-6">
      <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-danger btn-lg" style="width:100%; height:80px; line-height:60px;font-size:35px">Logout</a>
    </div>
  </div>
</div>
@endsection

@section('footer-scripts')

@endsection
