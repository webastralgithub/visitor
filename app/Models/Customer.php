<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CustomerDomain;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_name',
        'location_id',
        'webhook_url'
    ];

    public function domains() {
        return $this->hasMany(CustomerDomain::class);
    }

    public function leads() {
        return $this->hasMany(Lead::class);
    }
}
