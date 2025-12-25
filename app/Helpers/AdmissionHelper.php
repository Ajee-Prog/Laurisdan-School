<?php

namespace App\Helpers;

use App\Models\User;

class AdmissionHelper
{
    public static function generateAdmissionNo()
    {
        $year = date('Y');

        // count existing students for this year
        $count = User::where('role', 'student')->whereYear('created_at', $year)->count() + 1;

        return "LNPS/$year/" . str_pad($count, 3, '0', STR_PAD_LEFT);
    }
}