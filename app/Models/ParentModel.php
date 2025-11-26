<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentModel extends Model
{
    use HasFactory;
    protected $table = 'parents';
    protected $fillable = ['name','email','password','phone'];
    protected $hidden = ['password'];

    // protected $table = 'parents';
    // protected $fillable = ['name', 'email', 'phone', 'address', 'image', 'password'];
    // // protected $fillable = ['user_id', 'relation', 'address', 'email', 'image', 'phone'];

    // protected $hidden = ['password', 'remember_token'];



    public function user(){
        return $this->belongsTo(User::class);
    }
    public function students(){
        return $this->hasMany(Student::class, 'parent_id');
    }

    // public function students(){
    //     return $this->belongsToMany(Student::class, 'parent_student', 'parent_id', 'student_id');
    // }
}
