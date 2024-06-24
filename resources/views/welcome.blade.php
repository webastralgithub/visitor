@extends('layouts.dashbord')

@section('title', 'Home Page')

@section('content')
<section class="custom--contaner">
    <div class="dash--text">
        <h2>Dashboard</h2>
    </div>
    <div class="add--agency--sec dashbord-agency">
        @if(Auth::user()->hasRole('super-admin'))
        <div class="agency--box">
            <a>
                <div class="age--sec">
                    <div class="dast-agency"> Total Agency</div>
                </div>
                <div class="dast-agency-number">{{isset($totalAgency) ? $totalAgency : '' }}</div>
            </a>
         
        </div>
        
        @endif
    </div>
   
</section>

@endsection