<?php

namespace App\Imports;

use App\Models\Lead;
use Illuminate\Support\Collection; 
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class LeadsImport implements ToCollection, WithHeadingRow
{
    /**
     * @param Collection $row
     */
    public function collection(Collection $row)
    {
        $leads = new Lead([
            'customer_id'  => $row[0],
            'first_name' => $row[1],
            'last_name' => $row[2],
            'personal_email' => $row[3],
            'contact_address' => $row[4],
            'contact_address_2' => $row[5],
            'contact_metro_city' => $row[6],
            'contact_state' => $row[7],
            'contact_zip' => $row[8],
            'contact_zip4' => $row[9],
            'gender' => $row[10],
            'age_range' => $row[11],
            'married' => $row[12],
            'children' => $row[13],
            'income_range'=> $row[14],
            'net_worth' => $row[15],
            'homeowner' => $row[16],
            'contact_job_title' => $row[17],
            'contact_professional_email' => $row[18],
            'contact_linkedin_url' => $row[19],
            'contact_facebook_url' => $row[20],
            'contact_twitter_url' => $row[21],
            'company_name' => $row[22],
            'company_linkedin_url' => $row[23],
            'company_domain' => $row[24],
            'company_employee_size_range' => $row[25],
            'company_employees' => $row[26],
            'company_revenue_range' => $row[27],
            'company_primary_industry' => $row[28],
            'company_address' => $row[29],
            'company_address_2' => $row[30],
            'company_city' => $row[31],
            'company_region_code' => $row[32],
            'company_postal_code' => $row[33],
            'session_date' => $row[34],
            'remotesessionid' => $row[35],
            'referrer' => $row[36],
            'visitor_first_visit' => $row[37],
            'visitor_search_term' => $row[38],
            'visitor_search_engine' => $row[39],
            'campaign_name' => $row[40],
            'campaign_source'=> $row[41],
            'campaign_medium' => $row[42],
            'campaign_term' => $row[43],
            'campaign_content' => $row[44],
        ]);

        return $leads;
    }
}
