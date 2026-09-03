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
        // Drop old tables that might exist from previous abandoned migrations
        Schema::dropIfExists('os');
        Schema::dropIfExists('ms_offices');
        Schema::dropIfExists('operating_systems');

        // 1. Create new tables
        Schema::create('operating_systems', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('ms_offices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        // 2. Update devices table
        Schema::table('devices', function (Blueprint $table) {
            $table->dropForeign(['software_id']);
            $table->dropColumn('software_id');

            $table->foreignId('operating_system_id')->nullable()->constrained('operating_systems')->nullOnDelete();
            $table->foreignId('ms_office_id')->nullable()->constrained('ms_offices')->nullOnDelete();
        });

        // 3. Drop old software table
        Schema::dropIfExists('software');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::create('software', function (Blueprint $table) {
            $table->id();
            $table->string('os_name')->nullable();
            $table->string('ms_office_name')->nullable();
            $table->timestamps();
        });

        Schema::table('devices', function (Blueprint $table) {
            $table->dropForeign(['operating_system_id']);
            $table->dropForeign(['ms_office_id']);
            $table->dropColumn(['operating_system_id', 'ms_office_id']);

            $table->foreignId('software_id')->nullable()->constrained('software')->nullOnDelete();
        });

        Schema::dropIfExists('operating_systems');
        Schema::dropIfExists('ms_offices');
    }
};
