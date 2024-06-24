<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDomain extends Model
{
    use HasFactory;
    protected $table = 'customerDomains';
    
    protected $fillable = [
        'customer_id',
        'domain',
    ];
}
