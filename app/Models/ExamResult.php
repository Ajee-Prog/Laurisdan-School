<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamResult extends Model
{
    use HasFactory;
    // protected $fillable = ['student_id','subject', 'score'];
    protected $fillable = ['student_id','subject_id','session_id','term_id','subject', 'score', 'total', 'taken_at'];

    public function student(){
        return $this->belongsTo(\App\Models\Student::class);
    }

}
