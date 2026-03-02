<?php

namespace App\Helpers;

use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;


class AdmissionHelper
{
    public static function generateAdmissionNo()
    {
        // $year = date('Y');
        $year = Carbon::now()->year;

        // count existing students for this year
        // $count = AuthUser::where('role', 'student')->whereYear('created_at', $year)->count() + 1;

        // return "LNPS/$year/" . str_pad($count, 3, '0', STR_PAD_LEFT);
        $count = Student::whereYear('created_at', $year)->count() + 1;

        return 'LNPS/' . $year . '/' . str_pad($count, 3, '0', STR_PAD_LEFT);
    }
}






// if (!function_exists('generateAdmissionNumber')) {
//     function generateAdmissionNumber()
//     {
//         return 'ADM-' . date('Y') . '-' . rand(1000, 9999);
//     }
// }