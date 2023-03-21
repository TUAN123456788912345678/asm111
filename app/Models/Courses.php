<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    use HasFactory;
    protected $table='courses';
    public $primaryKey='id';
    public $timestamps=false;
    protected $filltable=[
        'name',
        'description',
    ];
}
