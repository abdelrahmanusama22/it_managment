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
        // First drop old foreign keys on devices table
        Schema::table('devices', function (Blueprint $table) {
            $table->dropForeign(['os_id']);
            $table->dropForeign(['ms_office_id']);
            $table->dropColumn(['os_id', 'ms_office_id']);
            
            // Add single new column
            $table->foreignId('software_id')->nullable()->constrained('software')->nullOnDelete();
        });

        // Now update software table
        Schema::table('software', function (Blueprint $table) {
            $table->dropColumn(['type', 'name']);
            $table->string('os_name')->nullable();
            $table->string('ms_office_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reverse operations
        Schema::table('software', function (Blueprint $table) {
            $table->dropColumn(['os_name', 'ms_office_name']);
            $table->string('type')->default('os');
            $table->string('name')->default('');
        });

        Schema::table('devices', function (Blueprint $table) {
            $table->dropForeign(['software_id']);
            $table->dropColumn('software_id');
            $table->foreignId('os_id')->nullable()->constrained('software')->nullOnDelete();
            $table->foreignId('ms_office_id')->nullable()->constrained('software')->nullOnDelete();
        });
    }
};
