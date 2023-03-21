<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignCourses extends Model
{
    use HasFactory;
    protected $table='assigned_courses';
    public $primaryKey='id';
    public $timestamps=false;
    protected $fillable = ['trainee_id', 'course_id'];
}
