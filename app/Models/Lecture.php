<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;
    protected $fillable = ['name','description'];
    public function classes(){
        return $this->belongsToMany(Grade::class,'class_lecture');
    }
    public function students(){
        return $this->belongsToMany(Student::class,'lecture_student');
    }
}
