<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionModel extends Model
{
    use HasFactory;
    protected $table = 'sessions';

    protected $fillable = ['name', 'start_date', 'end_date', 'active'];
}
