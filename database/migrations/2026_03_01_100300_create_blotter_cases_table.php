<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('blotter_cases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complainant_resident_id')->nullable()->constrained('residents')->nullOnDelete();
            $table->foreignId('respondent_resident_id')->nullable()->constrained('residents')->nullOnDelete();
            $table->string('complainant_name')->nullable();
            $table->string('respondent_name')->nullable();
            $table->string('witness_name')->nullable();
            $table->string('incident_type');
            $table->text('narrative');
            $table->string('status')->default('pending');
            $table->date('incident_date')->nullable();
            $table->date('mediation_date')->nullable();
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blotter_cases');
    }
};
