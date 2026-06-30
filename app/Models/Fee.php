<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;
    //  protected $fillable = [
    //      'student', 'term', 'session', 'amount'
    //  ];


     protected $fillable = ['student_id', 'parent_id', 'term_id', 'session_id','session','term','class','amount','amount_paid','balance','payment_method','payment_date'];

    public function student(){
        return $this->belongsTo(\App\Models\Student::class, 'student_id');
    }
    public function parent(){
        return $this->belongsTo(\App\Models\ParentModel::class, 'parent_id');
    }
    public function term(){
        return $this->belongsTo(\App\Models\Term::class, 'term_id');
    }
    public function session(){
        return $this->belongsTo(\App\Models\SessionModel::class);
    }
}
