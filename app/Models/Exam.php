<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    // protected $fillable = ['title', 'class_id', 'term_id', 'exam_date'];
    // protected $fillable = ['title', 'subject', 'teacher_id', 'class_id', 'date', 'duration', 'total_marks'];
    // protected $fillable = [
    //     'teacher_id', 'class_id', 'title', 'subject', 'term', 'session'
    // ];

    protected $fillable = ['title','teacher_id','class_id','duration','subject','term','session'];

    public function class(){
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function term(){
        return $this->belongsTo(Term::class, 'term_id');
    }
    public function teacher(){
        return $this->belongsTo(Teacher::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    // public function class(){
    //     return $this->belongsTo(Classroom::class);
    // }
    public function students(){
        return $this->belongsToMany(Student::class, 'exam_student')->withPivot('score', 'status')->withTimestamps();
    }
}
