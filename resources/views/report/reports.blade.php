@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10">
      <h1>Transactional Based Reports</h1>
    </div>
    <div class="col-md-2">
      <a href="./dashboard" class="btn btn-primary btn-block">Back</a>
    </div>
  </div>
  <div class="row">
    <form action="{{url('reports')}}" method="post" name="search">
      {{csrf_field()}}
      <div class="col-md-12">
        <table class="table">
          <tr>
            <td>
              Start Date
            </td>
            <td>
              <input class="form-control" id="start_date" name="start_date" type="date" value="{{ $start_date }}" />
            </td>
            <td>
              End Date
            </td>
            <td>
              <input class="form-control" id="end_date" name="end_date" type="date" value="{{ $end_date }}" />
            </td>
            <td>
              <input class="btn btn-default btn-block" name="submit" type="submit" value="Submit" />
            </td>
            <td>
              <a href="{{url('reports')}}" class="btn btn-primary btn-block">Reset</a>
            </td>
            <td>
              <a href="{{url('excel/'.$start_date.'/'.$end_date)}}" class="btn btn-success btn-block">Export Excel</a>
            </td>
          </tr>
        </table>
      </div>
    </form>
  </div>

  <div class="row">
    <div class="data-list col-md-12">
      <table class="table">
        <thead>
          <tr>
            <th>Date</th>
            <th>Description</th>
            <th>Type</th>
            <th>Credit</th>
            <th>Debit</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($reports as $report)
            <tr>
              <td>{{ $report->date }}</td>
              <td>{{ $report->details }}</td>
              <td>{{ $report->type }}</td>

              @if( $report->drcr == "dr" )
                <td>&nbsp;</td>
                <td>{{ $report->amount }}</td>
              @else
                <td>{{ $report->amount }}</td>
                <td>&nbsp;</td>
              @endif
            </tr>
          @endforeach

          {{-- <tr>
            <td>11/07/17</td>
            <td>Sid:1234567890, Shari Sale, 1 peace at Rs. 500/-, Tax Apply 12%</td>
            <td>sale</td>
            <td>500</td>
            <td>&nbsp;</td>
          </tr> --}}
        </tbody>
        <tr>
          <th>&nbsp;</th>
          <th>&nbsp;</th>
          <th>Total</th>
          <th>{{ $totalCredit }}</th>
          <th>{{ $totalDebit }}</th>
        </tr>
      </table>
      {{ $reports->links() }}
    </div>
  </div>
</div>
@endsection
