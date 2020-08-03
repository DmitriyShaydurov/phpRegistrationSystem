<?php
session_start();
$GLOBALS['config'] = [
    'mysql' => [
        'host' =>'127.0.0.1',
        'username'  => 'mysql',
        'password' => 'mysql',
        'db' => 'form'
    ],
    'remember' => [
        'cookie_name' => 'hash',
        'cookie_expiry'=> 604800
    ],
    'session' => [
        'session_name' => 'user',
        'token_name' => 'token'
    ],
    'register_rules' => [
        'name' => [
            'required' => true,
            'min' => 2,
            'max' => 50,
        ],
        'login' => [
         'required' => true,
         'min' => 2,
         'max' => 20,
         'unique' => 'users'
         ],
         'email' => [
             'required' => true,
             'is_email' => true
         ],
        'password' => [
             'required' => true,
             'min' => 6,
        ]
        ],
        'login_rules' => [
            'login' => [
             'required' => true
             ],
            'password' => [
                 'required' => true
            ],
        ],
        'change_login_rules' => [
            'name' => [
                'required' => true,
                'min' => 2,
                'max' => 50,
                ],
            'password' => [
                'required' => true,
                'min' => 6,
            ],
        ]
];

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../functions/helperFunctions.php';
