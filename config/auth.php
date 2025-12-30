<?php

return [

  
    /*
    |--------------------------------------------------------------------------
    | Authentication Defaults
    |--------------------------------------------------------------------------
    
    */

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    /*
    |--------------------------------------------------------------------------
    | Authentication Guards
    |--------------------------------------------------------------------------
   
    | Supported: "session"
    |
    */

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],
    //      'teacher' => [
    //     'driver' => 'session',
    //     'provider' => 'teachers',
    // ],
    'student' => [
        'driver' => 'session',
        'provider' => 'students',
    ],
    // 'parent' => [
    //     'driver' => 'session',
    //     'provider' => 'parents',
    // ],



    ],

    /*
    |--------------------------------------------------------------------------
    | User Providers
    |--------------------------------------------------------------------------
    
    | Supported: "database", "eloquent"
    |
    */

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        // 'users' => [
        //     'driver' => 'database',
        //     'table' => 'users',
        // ],

        // 'teachers' => [
        // 'driver' => 'eloquent',
        // 'model' => App\Models\Teacher::class,
        // ],

        'students' => [
            'driver' => 'eloquent',
            'model' => App\Models\Student::class,
        ],

        // 'parents' => [
        //     'driver' => 'eloquent',
        //     'model' => App\Models\ParentModel::class,
        // ],

    ],

    /*
    |--------------------------------------------------------------------------
    | Resetting Passwords
    |--------------------------------------------------------------------------
    
    */

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],


        
        'students' => [
        'provider' => 'students',
        'table' => 'password_resets',
        'expire' => 60,
        'throttle' => 60,
    ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Password Confirmation Timeout
    |--------------------------------------------------------------------------
    
    */

    'password_timeout' => 10800,

];
