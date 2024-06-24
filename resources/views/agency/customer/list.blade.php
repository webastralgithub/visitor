@extends('layouts.agency')
@section('title', 'Home Page')
@section('content')
<section class="custom--contaner">
    <div class="dash--text">
        <h2>View Customers</h2>
    </div>
    <div class="view--cust--table-section">
        <div class="view--cust--table">
            <table id="customer-table" class="display">
                <thead>
                    <tr>
                        <th>SN.</th>
                        <th>Company Name</th>
                        <th>Location ID</th>
                        <th>Domain URL</th>
                        <th>Webhook URL</th>
                        <th>Actions</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</section>
@endsection