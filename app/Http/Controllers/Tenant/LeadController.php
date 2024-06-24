<?php

namespace App\Http\Controllers\Tenant;

use App\Models\Customer;
use App\Models\CustomerDomain;
use App\Models\Lead;
use App\Models\LeadAssociate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Exports\LeadsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\LeadsImport;
use Exception;

class LeadController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $leads = Lead::select([
                'leads.id',
                'leads.customer_id',
                'customers.location_id',
                'leads.first_name',
                'leads.last_name',
                'leads.personal_email',
                'leads.contact_address',
                'leads.contact_address_2',
                'leads.contact_metro_city',
                'leads.contact_state',
                'leads.contact_zip',
                'leads.created_at',
                'leads.visitor_search_engine',
            ])
            ->with([
                'lead_associate' => function($query){
                    $query->select('id', 'lead_id', 'full_url', 'host_name')
                    ->with([
                        'customer' => function($query){
                            $query->select('id', 'company_name', 'location_id');
                        }
                    ]);
                }
            ])
            ->leftJoin('customers', 'customers.id' , '=' , 'leads.customer_id')
            ->orderBy('leads.id', 'DESC')
            ->get();
            

            // print_r($leads);die();

            return DataTables::of($leads)
            ->addColumn('Actions', function ($lead) {
                return '<a href="' . route('showLeadAssociate', ['id' => $lead->id]) . '" class="btn btn-success btn-sm mr-2">View</a>';
            })
            ->addColumn('checkbox', function ($lead) {
                return '<input type="checkbox" value="'.$lead->id.'" class="btn btn-success btn-sm mr-2">';
            })
            ->addColumn('host_name', function ($lead) {
               
                $html ='';
                foreach($lead->lead_associate as $associate){ 
                  $html .="<p>$associate->host_name</p>";
                }
                return $html;
            })
            ->editColumn('created_at', function ($lead) {
                return $lead->created_at->format('d-m-y');
            })
            ->rawColumns(['Actions','host_name','checkbox'])
            ->make(true);
        }
        
        return view('agency.leads.list');
    }

    public function showLeadAssociate($id)
    {
        try {
            $lead_associates = LeadAssociate::select([
                'id',
                'lead_id',
                'full_url',
                'host_name',
                'page',
                'querystring',
                'anchor',
                'page_time',
                'visit_date'
            ])
                ->where('lead_id', $id)
                ->orderBy('id', 'DESC')
                ->paginate(10);

            $leads = Lead::select('*')->where('id', $id)->first();

            return view('agency.lead-associates.list', ['lead_associates' => $lead_associates, 'leads' => $leads]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function exportLeads(Request $request)
    {
        return Excel::download( new LeadsExport($request->selectedLeadIds), 'leads.csv');
    }

    public function importLeads(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:csv,xls,xlsx,ods',
        ]);
        Excel::import(new LeadsImport, $request->file('file')->store('files'));

        return back()->with('message','Leads import successfully!!');
    }

    public function getExportData(Request $request)
    {
        $leadIDs = $request->selectedLeadIds;
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
        )->whereIn('id', explode(',', $leadIDs));

        return $query;
    }
}
