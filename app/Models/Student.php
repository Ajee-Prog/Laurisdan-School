<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'class_id', 'parent_id', 'admission_no', 'date_of_birth', 'address', 'parent_contact'];


    public function user(){
        return $this->belongsTo(User::class);
    }

    public function class(){
        return $this->belongsTo(ClassModel::class, 'class_id');
    }

    public function classroom(){
        return $this->belongsTo(Models\ClassModel::class, 'class_id');
    }

    public function results(){
        return $this->hasMany(Result::class, 'class_id');
    }
}
