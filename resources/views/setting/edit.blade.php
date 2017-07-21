@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10">
      <h1>Admin Settings</h1>
    </div>
    <div class="col-md-2">
      <a href="{{url('dashboard')}}" class="btn btn-primary btn-block">Back</a>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 col-md-offset-2">
      <form action="{{url('settings/'.$set->id)}}" name="settings" method="post">
        {{csrf_field()}}
        {{ method_field('PATCH') }}
      <table class="table">
        <tbody>
        <tr>
          <td>Business Name</td>
          <td><input type="text" class="form-control" name="bname" value="{{ $set->business_name }}" /></td>
        </tr>
        <tr>
          <td>Business Address</td>
          <td><input type="text" class="form-control" name="baddr" value="{{ $set->business_address }}" /></td>
        </tr>
        <tr>
          <td>Business Phone No</td>
          <td><input type="text" class="form-control" name="phone" value="{{ $set->business_phone_no }}" /></td>
        </tr>
        <tr>
          <td>Business Account No</td>
          <td><input type="text" class="form-control" name="account" value="{{ $set->bank_account_info }}" /></td>
        </tr>
        <tr>
          <td>Business Profit By Percent</td>
          <td><input type="text" class="form-control" name="profit" value="{{  $set->sales_profit }}" /></td>
        </tr>
        <tr>
          <td>Business Global Tax</td>
          <td><input type="text" class="form-control" name="tax" value="{{ $set->global_tax }}" /></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><button type="submit" class="btn btn-success" name="submit">Save </button> <input type="reset" name="reset" class="btn btn-warning" value="Reset" /></td>
        </tr>
        </tbody>
      </table>
      </form>
    </div>
  </div>
</div>
@endsection
