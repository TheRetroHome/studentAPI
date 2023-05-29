<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Grade extends Model
{
    use HasFactory;
    protected $fillable = ['name'];
    public function students(){
        return $this->hasMany(Student::class);
    }
    public function lectures(){
        return $this->belongsToMany(Lecture::class, 'class_lecture')->withPivot('order')->orderBy('pivot_order');
    }
}
