<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Student extends Model
{
    use HasFactory;
    protected $fillable = ['name','email'];
    public function grade(){
        return $this->belongsTo(Grade::class);
    }
    public function lectures(){
        return $this->belongsToMany(Lecture::class,'lecture_student');
    }
}
