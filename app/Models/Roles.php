<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;
    protected $table='roles';
    public $primaryKey='id';
    public $timestamps=false;
    protected $filltable=[
        'name',
        'description',
    ];

    public function users() {
        return $this->hasMany(User::class);
    }

}
