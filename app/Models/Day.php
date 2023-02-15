<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    protected $fillable = ['quanlity_Day','money_Day', 'validate_Day', 'patient_id'];

    public function patient() {
        return $this->belongsTo('App\Mopdels\Patient');
    }
}
