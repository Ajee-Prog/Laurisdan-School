<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    // protected $fillable = ['user_id', 'class_id', 'parent_id','email' ,'image', 'phone', "date_of_birth", "gender", "admission_no", "state", 'address', "nationality", 'parent_contact'];
    protected $fillable = ['full_name', 'email', 'phone', 'class_id', 'parent_id', 'address', 'passport'];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function class(){
        return $this->belongsTo(ClassModel::class, 'class_id');
    }
    public function parent(){
        return $this->belongsTo(ParentModel::class, 'parent_id');
    }
    public function examResults(){
        return $this->hasMany(ExamResult::class);
    }

    
}
