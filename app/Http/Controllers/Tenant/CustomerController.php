<?php

namespace App\Http\Controllers\Tenant;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Rules\ArrayAtLeastOneRequired;
use App\Models\Customer;
use App\Models\CustomerDomain;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use DataTables;
class CustomerController extends Controller
{
    public function show(Request $request) {
        if ($request->ajax()) {
        $customers = Customer::select([
            'id',
            'company_name',
            'location_id',
            'webhook_url',
        ])->with([
            'domains' => function($query){
                $query->select('id', 'customer_id', 'domain');
            }
        ])
        ->orderBy('id', 'DESC')->get();

        // pritn_r($customers);

        return DataTables::of($customers)
        ->addColumn('Actions', function ($customer) {
            return '<a href="' . route('showEdit', ['id' => $customer->id]) . '" class="btn btn-success btn-sm mr-2">Edit</a>';
        })
        ->addColumn('domains', function ($customer) {
           
            $html ='';
            foreach($customer->domains as $domains){ 
              $html .= $domains->domain;
            }
            return $html;
        })
        ->rawColumns(['Actions'])
        ->make(true);
    }
        return view('agency.customer.list');
    }

    public function createForm() {
        return view('agency.customer.create');
    }

    public function save(Request $req) {

        $postData = $req->post();

        $postData = $req->validate([
            'company_name' => 'required|min:3',
            'location_id' => 'required|min:3|unique:'.Customer::class,
            'domain' => [
                'at_least_one_filled',
                // Rule::unique(CustomerDomain::class)
            ],
            'webhook_url' => 'nullable|url'
        ], [
            'company_name.required' => 'Company name is required',
            'location_id.required' => 'Location id is required',
            'domain.at_least_one_filled' => 'Please enter at least one domain url.',
        ]);

        //Custom Validating Domain
        if(!empty($postData['domain'])){
            $domains = []; 
            foreach($postData['domain'] as $domain){
                $domains[] = str_replace(['https://', 'https://www.', 'http://', 'http://www.', 'www.'], ['','','','', ''], $domain);
            }
            $domain_match = CustomerDomain::select('domain')
            ->whereIn('domain', $domains)
            ->first();
            if(!empty($domain_match)){
                throw ValidationException::withMessages([
                    'domain' => 'This Domain has already been taken'
                ]);
            }
        }
        
        $customer = Customer::create([
            'company_name'=> $postData['company_name'],
            'location_id' => $postData['location_id'],
            'webhook_url' => $postData['webhook_url'] ? $postData['webhook_url'] : '',
        ]);
        $domains = [];
        foreach ($postData['domain'] as $domain) {
            array_push($domains, new CustomerDomain(['domain' => str_replace(['https://', 'https://www.', 'http://', 'http://www.', 'www.'], ['','','','', ''], $domain)]));
        }

        $customer->domains()->saveMany($domains);

        return redirect()->route('customerList')->with([
            'success' => "Customer created successfully."
        ]);
    }


    public function showEdit(String $id) {
        $customer = Customer::find($id);
        return view('agency.customer.edit', [
            'customer' => $customer
        ]);
    }

    public function update(Request $req, String $id) {
        $customer = Customer::find($id);

        $postData = $req->post();

        $postData = $req->validate([
            'company_name' => 'required|min:3',
            'location_id' => 'required|min:3|unique:'.Customer::class.',location_id,'.$customer->id,
            'domain' => [
                'at_least_one_filled',
                Rule::unique(CustomerDomain::class)->ignore($customer->id, 'customer_id')
            ],
            'webhook_url' => 'nullable|url'
        ], [
            'company_name.required' => 'Company name is required',
            'location_id.required' => 'Location id is required',
            'domain.at_least_one_filled' => 'Please enter at least one domain url.',
        ]);

        $customer->company_name = $postData['company_name'];
        $customer->location_id = $postData['location_id'];
        $customer->webhook_url = $postData['webhook_url'] ? $postData['webhook_url'] : '';
        $customer->save();
        $domains = [];
        foreach ($postData['domain'] as $domain) {
            array_push($domains, new CustomerDomain(['domain' => str_replace(['https://', 'https://www.', 'http://', 'http://www.', 'www.'], ['','','','',''], $domain)]));
        }
        $customer->domains()->delete();
        $customer->domains()->saveMany($domains);
        return redirect()->route('customerList')->with([
            'success' => "Customer updated successfully."
        ]);
    }
}