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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('branch_id')->constrained()->cascadeOnDelete();
            $table->foreignId('device_type_id')->constrained()->cascadeOnDelete();
            $table->foreignId('employee_id')->nullable()->constrained()->nullOnDelete();
            
            // Network Info
            $table->string('ip_address')->nullable();
            $table->string('mac_address')->nullable();
            
            // Hardware Info
            $table->string('manufacturer')->nullable();
            $table->string('model')->nullable();
            $table->string('device_name')->nullable();
            $table->string('cpu')->nullable();
            $table->string('ram')->nullable();
            $table->string('ram_speed')->nullable();
            $table->string('hard_disk')->nullable();
            $table->string('monitor')->nullable();
            
            // Software Info
            $table->string('os_name')->nullable();
            $table->date('os_installation_date')->nullable();
            $table->string('ms_office_name')->nullable();
            
            // Other Info
            $table->string('location_within_branch')->nullable();
            $table->string('username')->nullable();
            $table->text('password')->nullable(); // Will be encrypted in model
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
