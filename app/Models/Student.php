<?php

namespace App\Models;
use Carbon\Carbon;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

// class Student extends Model
class Student extends Authenticatable
{
    use Notifiable;

    use HasFactory;
    // protected $guard = 'student';
    

    protected $table = 'students';
    

    protected $fillable = [
        'user_id',
        'parent_id',
        // 'name',
        'last_name',
        'first_name',
        'middle_name',
        
        'password',
        'class_id',
        'image',
        'gender',
        'date_of_birth',
        'place_birth',
        'address',
        'parent_contact',
        'state',
        'lga',
        'nationality',
        'religion',
        'admission_no',
        'student_code',
        'medical_Att',
        // 'phone',
        
    ];



     

     

    protected $hidden = ['password'];

    // Age Autocalculate
    public function getAgeAttribute()
    {
        return $this->date_of_birth
            ? Carbon::parse($this->date_of_birth)->age
            : null;
    }
   



    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    

    public function class(){
        return $this->belongsTo(\App\Models\SchoolClass::class,'class_id');
    }
    
    
    public function parent(){
        return $this->belongsTo(ParentModel::class,'parent_id');
    }
    

    
   
    public function examResults()
{
    return $this->hasMany(ExamResult::class, 'student_id');
}
    
   
    


    

    
}
