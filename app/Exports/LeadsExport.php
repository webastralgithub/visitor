<?php

namespace App\Exports;
use App\Models\Lead;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Http\Request;
class LeadsExport implements FromCollection
{
    
    /**
    * @return \Illuminate\Support\Collection
    */
    private $selectedLeadIds;

    public function __construct($selectedLeadIds)
    {
        $this->selectedLeadIds = $selectedLeadIds;
    }
    public function collection()
    {
        $query = Lead::select(
            'customer_id',
            'first_name',
            'last_name',
            'personal_email',
            'contact_address',
            'contact_address_2',
            'contact_metro_city',
            'contact_state',
            'contact_zip',
            'contact_zip4',
            'gender',
            'age_range',
            'married',
            'children',
            'income_range',
            'net_worth',
            'homeowner',
            'contact_job_title',
            'contact_professional_email',
            'contact_linkedin_url',
            'contact_facebook_url',
            'contact_twitter_url',
            'company_name',
            'company_linkedin_url',
            'company_domain',
            'company_employee_size_range',
            'company_employees',
            'company_revenue_range',
            'company_primary_industry',
            'company_address',
            'company_address_2',
            'company_city',
            'company_region_code',
            'company_postal_code',
            'session_date',
            'remotesessionid',
            'referrer',
            'visitor_first_visit',
            'visitor_search_term',
            'visitor_search_engine',
            'campaign_name',
            'campaign_source',
            'campaign_medium',
            'campaign_term',
            'campaign_content'
        )->whereIn('id',explode(',', $this->selectedLeadIds))->get();

        // if ($request->id) {
        //     $query->whereIn('id', explode(',', $request->id));
        // }
    
        // $leadsData = $query->get();

        // echo "<pre>";print_r($query);die();
        return $query;
    }

    
}
