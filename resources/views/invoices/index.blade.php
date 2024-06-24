@extends('layouts.dashbord')
@section('title', 'Home Page')
@section('content')

<section class="custom--contaner">
  @if (\Session::has('success'))
  <div class="alert alert-success">
    <ul>
      <li>{!! \Session::get('success') !!}</li>
    </ul>
  </div>
  @endif
  <div class="dash--text">
    <h2>View Invoices</h2>
  </div>
  <div class="view--cust--table-section">
    <div class="view--cust--table">
    <input type="hidden" name="" id="">
      <table id="invoice-table" class="display">
        <thead>
          <tr>
            <th>SN.</th>
            <th>Agency</th>
            <th>Amount </th>
            <th>Payment Status</th>
            <th>Actions</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>
</section>


@endsection