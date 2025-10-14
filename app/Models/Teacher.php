<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;
    //protected $table = 'sessions';

    protected $fillable = ['name','email','subject','user_id','address','phone', 'class_id', 'employee_no', 'image'];
}
