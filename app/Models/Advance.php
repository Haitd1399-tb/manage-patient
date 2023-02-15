<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advance extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'money_Advance', 'validate_Advance', 'quanlity_Advance'];

    public function patient() {
        return $this->belongsTo('App\Models\Patient');
    }
}
