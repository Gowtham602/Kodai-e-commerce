<?php

return [

    /*
    |--------------------------------------------------------------------------
    | SMS Mode
    |--------------------------------------------------------------------------
    | log  = log OTP in storage/logs/laravel.log (LOCAL)
    | live = send real SMS (PRODUCTION)
    */

    'mode' => env('SMS_MODE', 'log'),

    'username' => env('SMS_USERNAME'),
    'password' => env('SMS_API_PASSWORD'),
    'sender'   => env('SMS_SENDER'),
    'priority' => env('SMS_PRIORITY'),
    'e_id'     => env('SMS_E_ID'),
    't_id'     => env('SMS_T_ID'),
];



