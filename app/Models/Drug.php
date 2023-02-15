<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drug extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id', 'storedrug_id', 'quanlity_Drug', 'validate_Drug'];

    public function patient() {
        return $this->belongsToMany('App\Models\Patient');
    }

    public function storedrug() {
        return $this->belongsTo('App\Models\StoreDrug');
    }
}
