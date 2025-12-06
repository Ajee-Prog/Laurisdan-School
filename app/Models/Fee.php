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


     protected $fillable = ['student_id','session','term','class','amount','amount_paid','balance','payment_method','payment_date'];

    public function student(){
        return $this->belongsTo(\App\Models\Student::class, 'student_id');
    }
}
