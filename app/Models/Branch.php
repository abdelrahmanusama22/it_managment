<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $guarded = [];

    public function company() {
        return $this->belongsTo(Company::class);
    }
    public function devices() {
        return $this->hasMany(Device::class);
    }
    public function employees() {
        return $this->hasMany(Employee::class);
    }
}
