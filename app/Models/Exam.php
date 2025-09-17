<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'class_id', 'term_id', 'exam_date'];

    public function class(){
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function term(){
        return $this->belongsTo(Term::class, 'term_id');
    }
}
