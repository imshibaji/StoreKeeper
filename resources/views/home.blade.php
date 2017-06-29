@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-12">
    <ul class="nav navbar-nav">
    <li class="active"><a href="#">Dashboard <span class="sr-only">(current)</span></a></li>
    <li><a href="#">Customer</a></li>
    <li class="dropdown">
      <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Store <span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li><a href="#">Sales</a></li>
        <li><a href="#">Stocks</a></li>
        <li><a href="#">Reports</a></li>
      </ul>
    </li>
    <li><a href="#">Settings</a></li>
  </ul>
  </div>
  </div>

    <div class="row">
        <div class="col-md-3">
          <div class="list-group">
            <a href="#" class="list-group-item">Dashboard</a>
            <a href="#" class="list-group-item">Sells</a>
            <a href="#" class="list-group-item">Stocks</a>
            <a href="#" class="list-group-item">Reports</a>
          </div>
        </div>

        <div class="col-md-9">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>
                <div class="panel-body">
                    You are logged in!
                    <p>
                      <code>
                        {{Auth::user()}}
                      </code>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
