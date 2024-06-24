<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Payment;
use App\Models\StripeCustomer;
use App\Models\Tenant;
use App\Models\TenantDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Stripe\Stripe;
use Carbon\Carbon;
use Auth;
class PaymentController extends Controller
{
    public function paymentCard()
    {
       $cardDetails= $this->getCardDetails();
        return view('agency.stripe.payment',compact('cardDetails'));
    }

    public function create_payment(Request $request)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $tenant = Tenant::where('id', 'abc')->first();
            if (!$tenant) {
                return response()->json(['status' => false, 'message' => 'Tenant not found'], 404);
            }

            tenancy()->central(function ($tenant) {
            $payment = Payment::where(['tenant_id' => $tenant->id, 'payment_status' => 'paid'])->first();
            if ($payment) {
                return response()->json(['status' => false, 'message' => 'Already paid'], 400);
            }
        });
            

            $customer = \Stripe\Customer::create([
                'name'=>Auth::user()->name,
                'email' => "testdev@yopmail.com",
                'description' => "Premium Plan",
                'source' => $request->stripeToken,
            ]);

            $charge = \Stripe\Charge::create([
                'amount' => 200,
                'currency' => 'usd',
                'customer' => $customer->id,
                'description' => 'Subscription Plan',
            ]);
            tenancy()->central(function ($tenant) use($charge) {
               
            $newPayment = Payment::create([
                'tenant_id' => $tenant->id,
                'amount_paid' => $charge->amount,
                'paid_at' => Carbon::now(),
                'payment_status' => 'Paid',
            ]);
        });
        tenancy()->central(function ($tenant) use ($customer,$charge) {
            $newStripeCustomer = StripeCustomer::create([
                'tenant_id' => $tenant->id,
                'stripe_customer_id' => $customer->id,
                'payment_status' => 'Paid',
                'price' => $charge->amount,
            ]);
        });
            return redirect()->back()->with([
                'success' => "Payment paid successfully."
            ]);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            return redirect()->back()->with([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function stripeWebhook(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));

        $payload = $request->getContent();
        $event = null;

        try {
            $event = \Stripe\Event::constructFrom(json_decode($payload, true));
        } catch (\UnexpectedValueException $e) {
            return response()->json(['status' => 'Invalid payload'], 400);
        }

        $paymentId = $event->data->object->subscription ?? "";
        $status = $event->data->object->status ?? "";

        if (!empty($paymentId) && in_array($status, ['failed', 'canceled'])) {
            $payment = StripeCustomer::where('stripe_customer_id', $paymentId)->first();
            if ($payment) {
                $payment->payment_status = $status;
                $payment->logs = json_encode($payload);
                $payment->save();
            }
        }

        return response()->json(['status' => 'success'], 200);
    }

    public function invoices()
    {
        return view("invoices.index");
    }


   public function getCardDetails(){
   
     $TenantDetail =TenantDetail::first();
       $tenant = $TenantDetail->tenant_id;  
       $tenant= tenancy()->central(function ($tenant) {
            return StripeCustomer::where('tenant_id',$tenant->id)->first();
        });
      Stripe::setApiKey(env('STRIPE_SECRET'));
                $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET'));
                $cardDetails['customer']= $stripe->customers->retrieve($tenant->stripe_customer_id, []);

                $cardDetails['card'] = $stripe->paymentMethods->all([
                'type' => 'card',
                'limit' => 3,
                'customer' => $tenant->stripe_customer_id,
            ]);
            return $cardDetails;


   }

}
