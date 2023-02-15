<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Oriental extends Model
{
    use HasFactory;

    protected $fillable = ['storeoriental_id', 'patient_id', 'weight_Oriental', 'created_at'];

    public function patient() {
        return $this->belongsTo('App\Model\Patient');
    }

    public function storeoriental() {
        return $this->belongsTo('App\Models\StoreOriental');
    }
}
