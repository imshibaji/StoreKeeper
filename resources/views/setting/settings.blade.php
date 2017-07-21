@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10">
      <h1>Admin Settings</h1>
    </div>
    <div class="col-md-2">
      <a href="./dashboard" class="btn btn-primary btn-block">Back</a>
    </div>
  </div>

  <div class="row">
    <div class="col-md-6 col-md-offset-2">
      <form action="{{url('settings/'.$set->id)}}" name="settings" method="post">
        {{csrf_field()}}
        {{ method_field('PATCH') }}
      <table class="table">
        <tr>
          <td>Business Name</td>
          <td><input type="text" class="form-control" name="bname" value="{{ $set->business_name }}"  readonly/></td>
        </tr>
        <tr>
          <td>Business Address</td>
          <td><input type="text" class="form-control" name="baddr" value="{{ $set->business_address }}" readonly/></td>
        </tr>
        <tr>
          <td>Business Phone No</td>
          <td><input type="text" class="form-control" name="phone" value="{{ $set->business_phone_no }}" readonly/></td>
        </tr>
        <tr>
          <td>Business Account No</td>
          <td><input type="text" class="form-control" name="account" value="{{ $set->bank_account_info }}" readonly/></td>
        </tr>
        <tr>
          <td>Business Profit By Percent</td>
          <td><input type="text" class="form-control" name="profit" value="{{  $set->sales_profit }}" readonly/></td>
        </tr>
        <tr>
          <td>Business Global Tax</td>
          <td><input type="text" class="form-control" name="tax" value="{{ $set->global_tax }}" readonly/></td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td><a href="{{url('settings/1/edit')}}" type="submit" class="btn btn-success">Edit Settings</a></td>
        </tr>

      </table>
      </form>
    </div>
  </div>
</div>
@endsection
