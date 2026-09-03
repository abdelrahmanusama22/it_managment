<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Device extends Model
{
    protected static function booted(): void
    {
        static::creating(function ($device) {
            if (empty($device->sku)) {
                $device->sku = 'DEV-' . strtoupper(Str::random(8));
            }
        });
    }
    protected $guarded = [];

    protected $casts = [
        'password' => 'encrypted',
        'os_installation_date' => 'date',
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }

    public function branch() {
        return $this->belongsTo(Branch::class);
    }
    public function deviceType() {
        return $this->belongsTo(DeviceType::class);
    }
    public function employee() {
        return $this->belongsTo(Employee::class);
    }
    public function manufacturer() {
        return $this->belongsTo(Manufacturer::class);
    }
    public function operatingSystem() {
        return $this->belongsTo(OperatingSystem::class);
    }
    public function msOffice() {
        return $this->belongsTo(MsOffice::class);
    }
}
