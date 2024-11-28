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
        Schema::create('appointment_informations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('referral_id')->constrained()->onDelete('cascade')->nullable();
            $table->text('specialty')->nullable(); 
            $table->text('other_specialty')->nullable();
            $table->text('provider')->nullable();
            $table->text('location')->nullable();
            $table->date('appointment_date')->nullable(); 
            $table->text('appointment_time')->nullable(); 
            $table->date('report_completed_by')->nullable(); 
            $table->text('reason_report_rush_date')->nullable(); 
            $table->boolean('x_rays_approved')->default(false); 
            $table->text('special_instructions')->nullable(); 
            $table->boolean('copy_to_claimant_attorney')->default(false); 
            $table->boolean('copy_to_defense_attorney')->default(false);
            $table->boolean('copy_to_referring_party')->default(false);
            $table->boolean('copy_to_billing_party')->default(false); 
            $table->boolean('do_not_send_notifications')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointment_informations');
    }
};
