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
        Schema::create('claimant_informations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('referral_id')->constrained()->onDelete('cascade')->nullable();
            $table->text('last_name')->nullable();
            $table->text('first_name')->nullable();
            $table->text('address1')->nullable();
            $table->text('address2')->nullable();
            $table->text('city')->nullable();
            $table->text('state')->nullable();
            $table->text('zip_code')->nullable();
            $table->text('home_phone')->nullable();
            $table->text('work_phone')->nullable();
            $table->text('ssn')->nullable();
            $table->date('dob')->nullable();
            $table->text('gender')->nullable();
            $table->text('employer')->nullable();
            $table->text('occupation')->nullable();
            $table->text('language')->nullable();
            $table->text('other_language')->nullable();
            $table->text('claim_number')->nullable();
            $table->date('accident_date')->nullable();
            $table->text('injury_description')->nullable();
            $table->text('injury_background')->nullable();
            $table->boolean('currently_working')->default(false);
            $table->boolean('claim_accepted')->default(false);
            $table->text('jurisdiction')->nullable();
            $table->text('claim_type')->nullable();
            $table->text('service_type')->nullable();
            $table->text('other_claim_type')->nullable();
            $table->text('insured_carrier')->nullable();
            $table->boolean('ama_4th')->default(false);
            $table->boolean('ama_5th')->default(false);
            $table->boolean('ama_6th')->default(false);
            $table->boolean('transportation')->default(false);
            $table->boolean('translation')->default(false);
            $table->boolean('conference_call')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('claimant_informations');
    }
};
