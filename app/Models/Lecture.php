<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;
    protected $fillable = ['name','description'];
    public function grades(){
        return $this->belongsToMany(Grade::class, 'class_lecture')->withPivot('order');
    }
}
