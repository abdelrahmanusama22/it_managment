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
            $table->dropForeign(['os_name_id']);
            $table->dropColumn('os_name_id');
            
            $table->dropForeign(['ms_office_name_id']);
            $table->dropColumn('ms_office_name_id');
            
            $table->dropColumn('manufacturer');

            $table->foreignId('manufacturer_id')->nullable()->constrained('manufacturers')->nullOnDelete();
            $table->foreignId('os_id')->nullable()->constrained('software')->nullOnDelete();
            $table->foreignId('ms_office_id')->nullable()->constrained('software')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('devices', function (Blueprint $table) {
            //
        });
    }
};
