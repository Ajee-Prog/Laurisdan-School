<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $fillable = ['subject','question', 'option_a', 'option_b', 'option_c', 'option_d', 'correct_answer'];

    public function options(){
        return $this->hasMany(Option::class);
    }

    public function subject(){
        return $this->belongsTo(Subject::class);
    }
    public function session(){
        return $this->belongsTo(Session::class);
    }
    public function term(){
        return $this->belongsTo(Term::class);
    }
}
