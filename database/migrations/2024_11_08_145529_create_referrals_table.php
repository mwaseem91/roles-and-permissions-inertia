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
        Schema::create('referrals', function (Blueprint $table) 
        {
            $table->id();
            $table->text('referring_company');
            $table->text('referring_source');
            $table->text('address1')->nullable();
            $table->text('address2')->nullable();
            $table->text('city')->nullable();
            $table->text('state')->nullable();
            $table->text('zip_code')->nullable();
            $table->text('phone')->nullable();
            $table->text('fax')->nullable();
            $table->text('email');
            $table->enum('status', ['Pending', 'In Progress', 'Completed', 'Rejected'])->default('Pending'); 
            $table->softDeletes(); 
            $table->timestamps();
        });

       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('referrals');
    }
};
