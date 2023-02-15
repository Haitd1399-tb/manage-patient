<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class storeOriental extends Model
{
    use HasFactory;

    protected $fillable = ['name_Oriental', 'note_Oriental'];

    public function orientals() {
        return $this->hasMany('App\Models\Drug');
    }
}
