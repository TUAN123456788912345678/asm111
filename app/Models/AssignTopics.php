<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignTopics extends Model
{
    use HasFactory;
    protected $table='assigned_topics';
    public $primaryKey='id';
    public $timestamps=false;
    protected $fillable = ['trainer_id', 'topic_id'];
}
