<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable =
    [
        'name', 'age', 'phone_number',
        'validate', 'district_id', 'province_id',
        'ward_id', 'village', 'anamnesis', 'note',
        'quanlity'
    ];

    public function province()
    {
        return $this->belongsTo('HoangPhi\VietnamMap\Models\Province');
    }
    public function district()
    {
        return $this->belongsTo('HoangPhi\VietnamMap\Models\District');
    }
    public function ward()
    {
        return $this->belongsTo('HoangPhi\VietnamMap\Models\Ward');
    }

    public function drugs()
    {
        return $this->hasMany('App\Models\Drug');
    }

    public function orientals()
    {
        return $this->hasMany('App\Model\Oriental');
    }

    public function days()
    {
        return $this->hasMany('App\Models\Day');
    }

    public function advances()
    {
        return $this->hasMany('App\Models\Advance');
    }
    public function photos()
    {
        return $this->hasMany('App\Models\Photo');
    }
}
