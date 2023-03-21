<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topics extends Model
{
    use HasFactory;
    protected $table='topics';
    public $primaryKey='id';
    public $timestamps=false;
    protected $filltable=[
        'name',
        'description',
    ];

    public function trainers()
    {
        return $this->belongsToMany(User::class, 'assigned_topics', 'topic_id', 'trainer_id');
    }

}
