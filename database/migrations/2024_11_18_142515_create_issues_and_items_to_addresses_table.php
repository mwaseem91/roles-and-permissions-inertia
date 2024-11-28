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
        Schema::create('issues_and_items_to_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('referral_id')->constrained()->onDelete('cascade')->nullable();
            $table->boolean('injury_causal_relationship')->default(0); 
            $table->boolean('explain_cause_of_complaints')->default(0); 
            $table->boolean('activity_restrictions')->default(0); 
            $table->boolean('is_current_treatment_necessary')->default(0); 
            $table->boolean('further_treatment_needed')->default(0); 
            $table->boolean('is_causal_relationship_explained')->default(0); 
            $table->boolean('sustained_permanent_injury')->default(0); 
            $table->boolean('return_to_work_no_restrictions')->default(0); 
            $table->boolean('physical_capabilities')->default(0); 
            $table->text('cover_letter')->nullable()->comment('Cover Letter Provided By')->nullable();
            $table->text('additional_information')->nullable();
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issues_and_items_to_addresses');
    }
};
