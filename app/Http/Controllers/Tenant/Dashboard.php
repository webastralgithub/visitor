<?php

namespace App\Http\Controllers\Tenant;
use App\Models\Tenant;
use App\Models\Lead;
use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    //

    public function show() {
        $totalLeads =Lead::count();
        $totalCustomers = Customer::count();
        return view('agency.dashboard',compact('totalLeads' ,'totalCustomers'));
    }

    public function dashboard() {
      
        $totalAgency = Tenant::count();
        
        return view('welcome',compact('totalAgency'));
    }
}
