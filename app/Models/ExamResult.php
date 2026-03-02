<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    use HasFactory;
    // protected $fillable = ['student_id','subject', 'score'];
     protected $fillable = [	'exam_id',	'student_id',	'score',	'total_questions',
     	'started_at',	'submitted_at',	'is_submitted',	'created_at',	'updated_at'];
    // protected $fillable = ['student_id', 'exam_id','subject_id','session_id','term_id','subject', 'score', 'total', 'taken_at'];

protected $casts = [
    'started_at'   => 'datetime',
    'submitted_at'=> 'datetime',
    'is_submitted'=> 'boolean'
];

    public function student(){
        return $this->belongsTo(\App\Models\Student::class);
    }

}
