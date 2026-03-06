<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aid_distribution_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('resident_id')->constrained('residents')->cascadeOnDelete();
            $table->string('program_name');
            $table->string('assistance_type');
            $table->decimal('quantity', 10, 2)->default(1);
            $table->date('distribution_date');
            $table->text('remarks')->nullable();
            $table->foreignId('recorded_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();

            $table->unique(['resident_id', 'program_name', 'distribution_date'], 'aid_unique_distribution');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aid_distribution_logs');
    }
};
