<?php

return [
    'database' => [
        'host' => env('MYSQLHOST', 'mysql.railway.internal'),
        'port' => env('MYSQLPORT', '3306'),
        'database' => env('MYSQLDATABASE', 'db_ezcoliving'),
        'username' => env('MYSQLUSER', 'root'),
        'password' => env('MYSQLPASSWORD', ''),
    ],
]; 