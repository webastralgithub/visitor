<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LeadAssociate extends Model
{
    use HasFactory;

    protected $table = 'lead_associate';
    protected $fillable = [
        'lead_id',
        'customer_id',
        'full_url',
        'host_name',
        'page',
        'querystring',
        'anchor',
        'page_time',
        'visit_date'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer');
    }

}
