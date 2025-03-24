<?php

return [
    'database' => [
        'host' => env('MYSQLHOST', 'containers-us-west-207.railway.app'),
        'port' => env('MYSQLPORT', '3306'),
        'database' => env('MYSQLDATABASE', 'railway'),
        'username' => env('MYSQLUSER', 'root'),
        'password' => env('MYSQLPASSWORD', ''),
    ],
]; 