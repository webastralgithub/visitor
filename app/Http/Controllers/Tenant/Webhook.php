<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Customer;
use App\Models\CustomerDomain;
use App\Models\Lead;
use App\Models\LeadAssociate;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

use Exception;

class Webhook extends Controller
{
    public function webhook(Request $req) {
        // LOG::info('Webhooh call with data', $req->post());
        // return response()->json('ok'); 

        try{
            $response = [];
            $http_status_code = 400;
            $insert = [];

        
            $host_name = (count($req->pages_visited) > 0) ? $req->pages_visited[0]['host_name']: '';
            $host_name = str_replace(['https://', 'https://www.', 'http://', 'http://www.', 'www.'], ['','','','', ''], $host_name);

            $customer = CustomerDomain::select([
                'customer_id'
            ])
            ->where('domain', $host_name)
            ->first();

            $customer_webhook = '';
            if(!empty($customer->customer_id)){
                $customer_webhook = Customer::select([
                    'webhook_url'
                ])
                ->where('id', $customer->customer_id)
                ->first();
            }

            $customer_webhook_url = (!empty($customer_webhook->webhook_url)) ? $customer_webhook->webhook_url : '';

            $insert['customer_id'] = (!empty($customer->customer_id)) ? $customer->customer_id : 0;
            $insert['first_name'] = $req->input('first_name');
			$insert['last_name'] = $req->input('last_name');
			$insert['personal_email'] = $req->input('personal_email');
			$insert['contact_address'] = $req->input('contact_address');
			$insert['contact_address_2'] = $req->input('contact_address_2');
			$insert['contact_metro_city'] = $req->input('contact_metro_city');
			$insert['contact_state'] = $req->input('contact_state');
			$insert['contact_zip'] = $req->input('contact_zip');
			$insert['contact_zip4'] = $req->input ('contact_zip4');
			$insert['gender'] = $req->input('gender');
            $insert['age_range'] = $req->input('age_range');
			$insert['married'] = $req->input('married');
			$insert['children'] = $req->input('children');
            $insert['income_range'] = $req->input('income_range');
            $insert['net_worth'] = $req->input('net_worth');
            $insert['homeowner'] = $req->input('homeowner');
            $insert['contact_job_title'] = $req->input('contact_job_title');
            $insert['contact_professional_email'] = $req->input('contact_professional_email');
            $insert['contact_linkedin_url'] = $req->input('contact_linkedin_url');
            $insert['contact_facebook_url'] = $req->input('contact_facebook_url');
            $insert['contact_twitter_url'] = $req->input('contact_twitter_url');
            $insert['company_name'] = $req->input('company_name');
            $insert['company_linkedin_url'] = $req->input('company_linkedin_url');
            $insert['company_domain'] = $req->input('company_domain');
            $insert['company_employee_size_range'] = $req->input('company_employee_size_range');
            $insert['company_employees'] = $req->input('company_employees');
			$insert['company_revenue_range'] = $req->input('company_revenue_range');
			$insert['company_primary_industry'] = $req->input('company_primary_industry');
			$insert['company_address'] = $req->input('company_address');
			$insert['company_address_2'] = $req->input('company_address_2');
			$insert['company_city'] = $req->input('company_city');
			$insert['company_region_code'] = $req->input('company_region_code');
			$insert['company_postal_code'] = $req->input('company_postal_code');
			$insert['session_date'] = $req->input('session_date');
            $insert['remotesessionid'] = $req->input('remotesessionid');
            $insert['referrer'] = $req->input('referrer');
            $insert['visitor_first_visit'] = $req->input('visitor_first_visit');
            $insert['visitor_search_term'] = $req->input('visitor_search_term');
            $insert['visitor_search_engine'] = $req->input('visitor_search_engine');
            $insert['campaign_name'] = $req->input('campaign_name');
            $insert['campaign_source'] = $req->input('campaign_source');
            $insert['campaign_medium'] = $req->input('campaign_medium');
            $insert['campaign_term'] = $req->input('campaign_term');
            $insert['campaign_content'] = $req->input('campaign_content');

            $lead_insert = Lead::create($insert);

            if($lead_insert){
                $lead_ass = [];
                $lead_assoc_inserted_id = [];
                foreach($req->pages_visited as $key => $page){
                    $lead_ass['lead_id'] = $lead_insert->id;
                    $lead_ass['full_url'] = $page['full_url'];
                    $lead_ass['host_name'] = $page['host_name'];
                    $lead_ass['page'] = $page['page'];
                    $lead_ass['querystring'] = $page['querystring'];
                    $lead_ass['anchor'] = $page['anchor'];
                    $lead_ass['page_time'] = $page['page_time'];
                    $lead_ass['visit_date'] = $page['visit_date'];
                    $lead_assoc_inserted = LeadAssociate::create($lead_ass);
                    $lead_assoc_inserted_id[] = $lead_assoc_inserted->id;
                }

                if($lead_assoc_inserted){
                    if(!empty($customer_webhook_url)){
                        $web_response = [];
                        $web_response = $req->post();
                        $web_response['host_name'] = $req->pages_visited[0]['host_name'];

                        $customer_webhook_response = Http::post($customer_webhook_url, $web_response);
                        if($customer_webhook_response){
                            $response['customer_webhook_response'] = $customer_webhook_response->successful();
                        } 
                    }
                    $response['status'] = 'success';
                    $response['message'] = 'Lead and lead associate Successfully created';
                    $response['data'] = []; 
                    $response['data']['lead_inserted_id'] = $lead_insert->id; 
                    $response['data']['lead_associate_id'] = $lead_assoc_inserted_id; 
                    $http_status_code = 200;
                } else {
                    $response['status'] = 'error';
                    $response['message'] = 'Lead Inserted but not lead associate';
                }
                
            } else {
                $response['status'] = 'error';
                $response['message'] = 'Lead not inserted';
            }

            return response()->json($response, $http_status_code);

        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ], 400);
        }
    }
}
