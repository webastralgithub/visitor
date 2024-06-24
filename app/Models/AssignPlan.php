<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignPlan extends Model
{
    use HasFactory;
    protected $table = "assign_plans";

    protected $fillable = [
        'user_id',
        'tenant_id',
        'plan_id'
    ];
}
