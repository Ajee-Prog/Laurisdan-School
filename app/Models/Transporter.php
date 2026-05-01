<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transporter extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_name',
        'driver_phone',
        'vehicle_no',
        'route',
        'capacity',
        'image'
    ];

    public function students()
    {
        return $this->belongsToMany(Student::class,'transport_students');
    }
}
