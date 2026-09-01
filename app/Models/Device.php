<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    protected $fillable = [
        'company_id', 'branch_id', 'device_type_id', 'employee_id',
        'manufacturer_id', 'software_id', 'ip_address', 'mac_address',
        'model', 'device_name', 'cpu', 'ram', 'ram_speed', 'hard_disk',
        'monitor', 'os_installation_date', 'location_within_branch',
        'username', 'password'
    ];

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
    public function software() {
        return $this->belongsTo(Software::class);
    }
}
