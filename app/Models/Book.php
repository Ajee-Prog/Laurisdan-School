<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'class_id', 'student_id', 'term_id', 'session_id', 'author', 'isbn', 'quantity', 'notes'];

    public function class(){
        return $this->belongsTo(ClassModels::class);
    }
    // public function class(){
    //     return $this->hasMany(SchoolClass::class);
    // }
    public function term(){
        return $this->belongsTo(Term::class);
    }
    public function session(){
        return $this->belongsTo(SessionModel::class);
    }
}
