<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreDrug extends Model
{
    use HasFactory;

    protected $fillable = ['name_Drug', 'money_Drug', 'quanlity_Drug'];

    public function drugs() {
        return $this->hasMany('App\Models\Drug');
    }
}
