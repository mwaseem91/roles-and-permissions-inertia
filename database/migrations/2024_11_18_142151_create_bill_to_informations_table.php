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
        Schema::create('bill_to_informations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->nullable();
            $table->boolean('same_as_referral')->default(false);
            $table->string('referring_company');
            $table->string('referring_source');
            $table->string('address1');
            $table->string('address2')->nullable();
            $table->string('city');
            $table->string('zip_code');
            $table->string('phone');
            $table->string('fax')->nullable();
            $table->string('email');
            $table->string('state')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_to_informations');
    }
};
