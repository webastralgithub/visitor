<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TenantDetail extends Model
{
    use HasFactory;
    protected $table = 'tenantsDetail';
    
    protected $fillable = [
        'tenant_id',
        'company_name',
        'address',
        'phone_number',
        'alternate_number',
        'first_name',
        'last_name',
        'tracker_url',
        'state',
        'country',
        'zip',
        'amount',
        'lead_cost',
        'credit',
    ];

}
