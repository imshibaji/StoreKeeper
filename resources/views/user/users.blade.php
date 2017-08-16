@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10">
      <h1>User Modification List</h1>
    </div>
    <div class="col-md-2">
      <div class="btn-group">
        <a href="{{url('users/add')}}" class="btn btn-success">Add User</a>
        <a href="{{url('dashboard')}}" class="btn btn-primary">Back</a>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <table class="table table-bordered">
        <tr>
          <th>Username</th>
          <th>Email</th>
          <th>Name</th>
          <th>Type</th>
          <th>Action</th>
        </tr>
        @foreach ($users as $user)
          <tr>
            <td>{{$user->username}}</td>
            <td>{{$user->email}}</td>
            <td>{{$user->name}}</td>
            <td>{{$user->type}}</td>
            <td>
              <div class="btn-group">
                <a href="users/edit/{{$user->id}}" class="btn btn-warning">Edit</a><a href="users/delete/{{$user->id}}" class="btn btn-danger">Delete</a>
              </div>
            </td>
          </tr>
        @endforeach

      </table>
    </div>
  </div>
</div>
@endsection
