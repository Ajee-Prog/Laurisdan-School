<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    //protected $table = 'sessions';

    
    protected $fillable = ['user_id','class_id','name','email','phone','subject','image','address','employee_no','password'];

    
    protected $hidden = ['password'];

    
    // public function exams(){
    //     return $this->hasMany(Exam::class);
    // }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function class()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class, 'teacher_id');
    }
}
