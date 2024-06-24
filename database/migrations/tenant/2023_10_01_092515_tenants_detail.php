<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tenantsDetail', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('tenant_id');
            $table->string('company_name')->nullable();
            $table->string('address')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('alternate_number')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('tracker_url')->nullable();
            $table->decimal('amount', 9, 3)->nullable();
            $table->decimal('lead_cost', 9, 3)->nullable();
            $table->string('credit')->nullable();
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tenantsDetail');
    }
};
