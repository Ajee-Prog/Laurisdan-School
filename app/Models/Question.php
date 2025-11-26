<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    // protected $fillable = ['subject','question', 'option_a', 'option_b', 'option_c', 'option_d', 'correct_answer'];
    // protected $fillable = ['subject','question','subject_id','session_id','term_id', 'option_a', 'option_b', 'option_c', 'option_d', 'correct_answer'];
    // protected $fillable = ['exam_id','question_text'];
    protected $fillable = [
        'exam_id', 'question_text', 'option_a', 'option_b', 'option_c', 'option_d', 'correct_option'
    ];
    // protected $fillable = [
    //     'class_id', 'subject_id', 'question', 'correct_option'
    // ];

        
    // public function options(){
    //     return $this->hasMany(Option::class);
    // }
    public function exam(){
        return $this->belongsTo(Exam::class);
    }

    public function options(){
        return $this->hasMany(Option::class);
    }

    // public function subject(){
    //     return $this->belongsTo(Subject::class);
    // }
    // public function session(){
    //     return $this->belongsTo(SessionModel::class);
    // }
    // public function term(){
    //     return $this->belongsTo(Term::class);
    // }
}
