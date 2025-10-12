<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;
    protected $table = 'classes';
    

    protected $fillable = ['name','slug', 'description'];
    // protected $fillable = ['title', 'author', 'isbn', 'quantity', 'notes'];

    public function students(){
        return $this->hasMany(Student::class);
    }
}
