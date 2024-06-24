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
    <h2>View Plans</h2>
  </div>
  <div class="view--cust--table-section">
    <div class="view--cust--table">
    <input type="hidden" name="plan_id" id="plan_id">
      <table id="plan-table" class="display">
        <thead>
          <tr>
            <th>SN.</th>
            <th>Plan Name</th>
            <th>Price</th>
            <th>Billing Period</th>
            <th>Description</th>
            <th>Actions</th>
          </tr>
        </thead>
      </table>
    </div>
  </div>

  <div id="myModal" class="overlay popup-modal">
    <div class="modal">
      <span class="close-btn" onclick="closeModal()">&times;</span>
      <div class="modal-inner-btns">
        <form action="/plans/assign-plans" method="post">
          @csrf
          <div class="form-dropdown">
            <label for="choose_agency">Select Agency :</label>
            <select multiple="true" name="tenant_id[]" id="choose_agency" class="form-control select2" required>
              @foreach($tenants as $tenant)
              <option value="{{ $tenant->id }}">{{ $tenant->id }}</option>
              @endforeach
            </select>
          </div>
          <input type="hidden" name="planId" id="planId">
          <!-- Your existing buttons -->
          <div class="popup-btns-inner">
            <button class="btn btn-success">Save</button>
            <button class="btn-close-btn" onclick="closeModal()">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>


</section>


@endsection