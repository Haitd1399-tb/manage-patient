<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    public function district() {
        return $this->belongsTo(District::class, config('vietnam-maps.columns.district_id'), 'id');
    }

    public function patients() {
        return $this->hasMany('App\Models\Patient');
    }
}
