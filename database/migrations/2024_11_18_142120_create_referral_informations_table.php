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
        Schema::create('referral_informations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->nullable();;
            $table->string('referring_company');
            $table->string('referring_source');
            $table->string('address1')->nullable();;
            $table->string('address2')->nullable();
            $table->string('city')->nullable();;
            $table->string('zip_code')->nullable();;
            $table->string('phone')->nullable();;
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
        Schema::dropIfExists('referral_informations');
    }
};
