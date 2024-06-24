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
        Schema::create('lead_associate', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('lead_id')->unsigned()->nullable();
			$table->string('full_url')->nullable();
			$table->string('host_name')->nullable();
			$table->string('page')->nullable();
			$table->string('querystring')->nullable();
			$table->string('anchor')->nullable();
			$table->integer('page_time')->nullable();
			$table->string('visit_date')->nullable();
            $table->timestamps();
        });	
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lead_associate');
    }
};
