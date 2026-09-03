<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $guarded = [];

    public function devices() {
        return $this->hasMany(Device::class);
    }
    public function branch() {
        return $this->belongsTo(Branch::class);
    }
}
