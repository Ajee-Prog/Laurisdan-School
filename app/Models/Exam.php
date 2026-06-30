<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;


    protected $fillable = ['title','teacher_id','class_id','term_id','duration','subject', 'subject_id','term','session_id', 'exam_date'];

    public function class(){
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    // New added SUBJECT
    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function term(){
        return $this->belongsTo(Term::class, 'term_id');
    }
    public function session(){
        return $this->belongsTo(SessionModel::class, 'session_id');
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
    //
}
