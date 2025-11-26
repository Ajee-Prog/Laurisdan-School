<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    //protected $table = 'sessions';

    // protected $fillable = ['name','email','password','subject'];
    protected $fillable = ['name','email','password','class_id'];
    protected $hidden = ['password'];

    // protected $fillable = ['name','email','phone','subject','user_id','address', 'class_id', 'employee_no', 'image'];
    // protected $fillable = ['name','email','phone','subject', 'image','password'];
    // protected $hidden = ['password'];

    // public function exams(){
    //     return $this->hasMany(Exam::class);
    // }

    public function class()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function exams()
    {
        return $this->hasMany(Exam::class, 'teacher_id');
    }
}
