<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('residents', function (Blueprint $table) {
            $table->string('household_code')->nullable()->after('address');
            $table->boolean('is_pwd')->default(false)->after('household_code');
            $table->boolean('is_solo_parent')->default(false)->after('is_pwd');
            $table->boolean('is_4ps')->default(false)->after('is_solo_parent');
            $table->boolean('is_voter')->default(false)->after('is_4ps');
        });
    }

    public function down(): void
    {
        Schema::table('residents', function (Blueprint $table) {
            $table->dropColumn(['household_code', 'is_pwd', 'is_solo_parent', 'is_4ps', 'is_voter']);
        });
    }
};
