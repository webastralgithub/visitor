<?php

namespace App\Http\Controllers;

use App\Models\Plan as UserPlan;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\AssignPlan;
use App\Models\Tenant;
use Illuminate\Http\Request;
use \Stripe\Plan;
use Exception;
use DataTables;
class PlanController extends Controller
{

    public function chargeCreate(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'billing_period' => 'required',
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'description.required' => 'Description is required',
            'description.required' => 'Billing Period is required',
        ]);
        
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        $plans = \Stripe\Plan::create(array(
            "amount" => $req->price,
            "interval" => $req->billing_period,
            "product" => array(
              "name" => $req->name
            ),
            "currency" => 'usd',
          ));
        $attributes = [
            'user_id' => Auth::id(),
            'name' => $req->name,
            'price' => $req->price,
            'description' => $req->description,
            'billing_period' => $req->billing_period,
            'stripe_plan' => $plans->id,
        ];

        UserPlan::create($attributes);

        return back()->with([
            'success' => env('APP_HOST_NAME', 'localhost')." Plan has been created!!"
        ]);
    }
    public function assign_plans(Request $request)
    {
        $tenantIds = $request->input('tenant_id');
        $planId = $request->input('planId');

        foreach ($tenantIds as $tenantId) {
            AssignPlan::create([
                'tenant_id' => $tenantId,
                'user_id' => Auth::user()->id,
                'plan_id' => $planId,
            ]);
        }

        return back()->with([
            'success' => env('APP_HOST_NAME', 'localhost')." Assign plan to Tenants!!"
        ]);

    }

    public function deletePlan($id)
    {
        $plan = UserPlan::find($id);

        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        try {
            $stripePlan = \Stripe\Plan::retrieve($plan->stripe_plan);
            $stripePlan->delete();
            $plan->delete();
    
            return back()->with('success', 'Plan deleted successfully!');
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            return back()->with('error', 'Invalid Stripe Plan ID!');
        }
    }
    
}
