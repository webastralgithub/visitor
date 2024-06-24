@extends('layouts.agency')

@section('title', 'Home Page')

@section('content')
<section class="custom--contaner">
    <div class="dash--text">
        <h2>Dashboard</h2>
    </div>
    <div class="add--agency--sec dashbord-agency">
        <div class="agency--box">
            <a>
                <div class="age--sec">
                    <div class="dast-agency"> Total Customers</div>
                </div>
                <div class="dast-agency-number">{{isset($totalCustomers) ? $totalCustomers : ''}}</div>
            </a>
        </div>
        <div class="agency--box">
            <a>
                <div class="age--sec">
                    <div class="dast-agency"> Total Leads</div>
                </div>
                <div class="dast-agency-number">{{isset($totalLeads) ? $totalLeads : ''}}</div>
            </a>
        </div>
    </div>
  
</section>

@endsection