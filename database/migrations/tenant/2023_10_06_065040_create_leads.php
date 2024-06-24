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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
			$table->string('first_name')->nullable();
			$table->string('last_name')->nullable();
			$table->string('personal_email')->nullable();
			$table->string('contact_address')->nullable();
			$table->string('contact_address_2')->nullable();
			$table->string('contact_metro_city')->nullable();
			$table->string('contact_state')->nullable();
			$table->integer('contact_zip')->nullable();
			$table->integer ('contact_zip4')->nullable();
			$table->string('gender')->nullable();
            $table->string('age_range')->nullable();
			$table->string('married')->nullable();
			$table->string('children')->nullable();
            $table->string('income_range')->nullable();
            $table->string('net_worth')->nullable();
            $table->string('homeowner')->nullable();
            $table->string('contact_job_title')->nullable();
            $table->string('contact_professional_email')->nullable();
            $table->string('contact_linkedin_url')->nullable();
            $table->string('contact_facebook_url')->nullable();
            $table->string('contact_twitter_url')->nullable();
            $table->string('company_name')->nullable();
            $table->string('company_linkedin_url')->nullable();
            $table->string('company_domain')->nullable();
            $table->string('company_employee_size_range')->nullable();
            $table->integer('company_employees')->nullable();
			$table->string('company_revenue_range')->nullable();
			$table->string('company_primary_industry')->nullable();
			$table->string('company_address')->nullable();
			$table->string('company_address_2')->nullable();
			$table->string('company_city')->nullable();
			$table->string('company_region_code')->nullable();
			$table->integer('company_postal_code')->nullable();
			$table->string('session_date')->nullable();
            $table->string('remotesessionid')->nullable();
            $table->string('referrer')->nullable();
            $table->string('visitor_first_visit')->nullable();
            $table->string('visitor_search_term')->nullable();
            $table->string('visitor_search_engine')->nullable();
            $table->string('campaign_name')->nullable();
            $table->string('campaign_source')->nullable();
            $table->string('campaign_medium')->nullable();
            $table->string('campaign_term')->nullable();
            $table->string('campaign_content')->nullable();
            $table->timestamps();
        });	
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
