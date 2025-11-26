<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModels extends Model
{
    use HasFactory;


    protected $table = 'classes';
    

    protected $fillable = ['name','slug', 'description', 'teacher_id'];
    

    public function students(){
        return $this->hasMany(Student::class, 'class_id');
    }

    

    // public function teacher()
    // {
    //     return $this->belongsTo(Teacher::class, 'teacher_id');
    // }

    public function teacher(){ 
        return $this->belongsTo(User::class,'teacher_id'); 
    }
}
