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
        Schema::create('modules_audits', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->integer('model_id')->nullable();
            $table->string('action')->nullable();
            $table->string('audit_by')->nullable();
            $table->string('audit_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modules_audits');
    }
};
