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
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip_code')->nullable();
            $table->string('home_phone')->nullable();
            $table->string('work_phone')->nullable();
            $table->string('ssn')->nullable();
            $table->date('dob')->nullable();
            $table->string('gender')->nullable();
            $table->string('employer')->nullable();
            $table->string('occupation')->nullable();
            $table->string('language')->nullable();
            $table->string('other_language')->nullable();
            $table->string('claim_number')->nullable();
            $table->date('accident_date')->nullable();
            $table->text('injury_description')->nullable();
            $table->text('injury_background')->nullable();
            $table->boolean('currently_working')->default(false);
            $table->boolean('claim_accepted')->default(false);
            $table->string('jurisdiction')->nullable();
            $table->string('claim_type')->nullable();
            $table->string('service_type')->nullable();
            $table->string('other_claim_type')->nullable();
            $table->string('insured_carrier')->nullable();
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
