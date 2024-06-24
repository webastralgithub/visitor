@extends('layouts.agency')
@section('title', 'Lead Associate List')
@section('content')
<style>
    .back-button a{
        background: #475E88;
        color: #fff;
        padding: 10px 20px;
    }
    .header-table{
        width: 50% !important;
        display: inline-block;
        float: left;
    }
</style>
<section class="custom--contaner">
    <div class="dash--text">
        <h2>View Pages Visited</h2>
    </div>
    <div class="back-button">
	    <a href="{{ route('showLeads') }}" class="label"><img src="/images/leftarrow.png"> Back</a>
    </div>
    <div class="view--cust--table-section class" style="margin-bottom: 40px;">
        <div class="view--cust--table" style="overflow-x:auto;">
            <table class="header-table" border="0" cell-margin="0" cell-padding="10px" style="border-collapse: collapse;">
                <tbody>
                    <tr>
                        <th>First Name</th>
                        <td>{{ $leads->first_name }}</td>
                    </tr>
                    <tr>
                        <th>Personal Email</th>
                        <td>{{ $leads->personal_email }}</td>
                    <tr>
                        <th>Contact Metro City</th>
                        <td>{{ $leads->contact_metro_city }}</td>
                    </tr>
                    <tr>
                        <th>Contact Zip</th>
                        <td>{{ $leads->contact_zip }}</td>
                    </tr>
                    <tr>
                        <th>Gender</th>
                        <td>{{ $leads->gender }}</td>
                    </tr>
                    <tr>
                        <th>Married</th>
                        <td>{{ ($leads->married == 1) ? 'yes' : 'no' }}</td>
                    </tr>
                    <tr>
                        <th>Income Range</th>
                        <td>{{ $leads->income_range }}</td>
                    </tr>
                    <tr>
                        <th>Homeowner</th>
                        <td>{{ ($leads->homeowner == 1) ? 'yes' : 'no' }}</td>
                    </tr>
                    <tr>
                        <th>Contact Professional Email</th>
                        <td>{{ $leads->contact_professional_email }}</td>
                    </tr>
                    <tr>
                        <th>Contact Facebook URL</th>
                        <td>{{ $leads->contact_facebook_url }}</td>
                    </tr>
                    <tr>
                        <th>Company Name</th>
                        <td>{{ $leads->company_name }}</td>
                    </tr>
                    <tr>
                        <th>Company Employee Zip Range</th>
                        <td>{{ $leads->company_employee_size_range }}</td>
                    </tr>
                    <tr>
                        <th>Company Revenue Range</th>
                        <td>{{ $leads->company_revenue_range }}</td>
                    </tr>
                    <tr>
                        <th>Company Address</th>
                        <td>{{ $leads->company_address }}</td>
                    </tr>
                    <tr>
                        <th>Company City</th>
                        <td>{{ $leads->company_city }}</td>
                    </tr>
                    <tr>
                        <th>Company Postal Code</th>
                        <td>{{ $leads->company_postal_code }}</td>
                    </tr>
                    <tr>
                        <th>Remote Session Id</th>
                        <td>{{ $leads->remotesessionid }}</td>
                    </tr>
                    <tr>
                        <th>Visitor First Visit</th>
                        <td>{{ $leads->visitor_first_visit }}</td>
                    </tr>
                    <tr>
                        <th>Visitor Search Engine</th>
                        <td>{{ $leads->visitor_search_engine }}</td>
                    </tr>
                    <tr>
                        <th>Campaign Medium</th>
                        <td>{{ $leads->campaign_medium }}</td>
                    </tr>
                    <tr>
                        <th>Campaign Term</th>
                        <td>{{ $leads->campaign_term }}</td>
                    </tr>
                    <tr>
                        <th>Campaign Content</th>
                        <td>{{ $leads->campaign_content }}</td>
                    </tr>
                </tbody>
            </table>
            <table class="header-table" border="0" cell-margin="0" cell-padding="10px" style="border-collapse: collapse;">
                <tbody>
                    <tr>
                        <th>Last Name</th>
                        <td>{{ $leads->last_name }}</td>
                    </tr>
                    <tr>
                        <th>Contact Address</th>
                        <td>{{ $leads->contact_address }} {{ $leads->contact_address_2 }}</td>
                    </tr>
                    <tr>
                        <th>Contact State</th>
                        <td>{{ $leads->contact_state }}</td>
                    </tr>
                    <tr>
                        <th>Contact Zip 4</th>
                        <td>{{ $leads->contact_zip4 }}</td>
                    </tr>
                    <tr>
                        <th>Age Range</th>
                        <td>{{ $leads->age_range }}</td>
                    </tr>
                    <tr>
                        <th>Children</th>
                        <td>{{ ($leads->children == 1) ? 'yes' : 'no' }}</td>
                    </tr>
                    <tr>
                        <th>Net Worth</th>
                        <td>{{ $leads->net_worth }}</td>
                    </tr>
                    <tr>
                        <th>Contact Job Title</th>
                        <td>{{ $leads->contact_job_title }}</td>
                    </tr>
                    <tr>
                        <th>Contact Linkedin URL</th>
                        <td>{{ $leads->contact_linkedin_url }}</td>
                    </tr>
                    <tr>
                        <th>Contact Twitter URL</th>
                        <td>{{ $leads->contact_twitter_url }}</td>
                    </tr>
                    <tr>
                        <th>Company Linkedin URL</th>
                        <td>{{ $leads->company_linkedin_url }}</td>
                    </tr>
                    <tr>
                        <th>Company Domain</th>
                        <td>{{ $leads->company_domain }}</td>
                    </tr>
                    <tr>
                        <th>Company Employees</th>
                        <td>{{ $leads->company_employees }}</td>
                    </tr>
                    <tr>
                        <th>Company Address 2</th>
                        <td>{{ $leads->company_address_2 }}</td>
                    </tr>
                    <tr>
                        <th>Company Region Code</th>
                        <td>{{ $leads->company_region_code }}</td>
                    </tr>
                    <tr>
                        <th>Session Date</th>
                        <td>{{ $leads->session_date }}</td>
                    </tr>
                    <tr>
                        <th>Referrer</th>
                        <td>{{ $leads->referrer }}</td>
                    </tr>
                    <tr>
                        <th>Company Primary Industry</th>
                        <td>{{ $leads->company_primary_industry }}</td>
                    </tr>
                    <tr>
                        <th>Visitor Search Term</th>
                        <td>{{ $leads->visitor_search_term }}</td>
                    </tr>
                    <tr>
                        <th>Company Name</th>
                        <td>{{ $leads->campaign_name }}</td>
                    </tr>
                    <tr>
                        <th>Campaign Source</th>
                        <td>{{ $leads->campaign_source }}</td>
                    </tr>
                    <tr>
                        <th>Visited at</th>
                        <td>{{ $leads->created_at }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="view--cust--table-section">
        <div class="view--cust--table" style="overflow-x:auto;">
            <table border="0" cell-margin="0" cell-padding="10px" style="border-collapse: collapse;">
                <thead>
                    <tr>
                        <th>SN.</th>
                        <th>Full URL</th>
                        <th>Host Name</th>
                        <th>Page</th>
                        <th>Query String</th>
                        <th>Anchor</th>
                        <th>Page Time</th>
                        <th>Visit Date</th>
                    </tr>
                </thead>
                <tbody>
                    @if($lead_associates->count() > 0)
                        @foreach ($lead_associates as $ls)
                            <tr>
                                <td class="bg--box">{{ $ls->id}}</td>
                                <td>{{ $ls->full_url }}</td>
                                <td>{{ $ls->host_name }}</td>
                                <td>{{ $ls->page }}</td>
                                <td>{{ $ls->querystring }}</td>
                                <td>{{ $ls->anchor }}</td>
                                <td>{{ $ls->page_time }}</td>
                                <td>{{ $ls->visit_date }}</td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            No Pages Visited Found for this lead
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    {{--@include('layouts.paginate', ['paginator' => $lead_associates])--}}
</section>
@endsection