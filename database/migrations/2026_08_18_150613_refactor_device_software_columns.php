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
        Schema::table('devices', function (Blueprint $table) {
            $table->dropColumn(['os_name', 'ms_office_name']);
            $table->foreignId('os_name_id')->nullable()->constrained('system_options')->nullOnDelete();
            $table->foreignId('ms_office_name_id')->nullable()->constrained('system_options')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('devices', function (Blueprint $table) {
            $table->dropForeign(['os_name_id']);
            $table->dropColumn('os_name_id');
            $table->dropForeign(['ms_office_name_id']);
            $table->dropColumn('ms_office_name_id');
            
            $table->string('os_name')->nullable();
            $table->string('ms_office_name')->nullable();
        });
    }
};
