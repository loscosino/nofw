<?php

$routing = [
    '/test' => [
        'class' => \App\ResponseResolver\TestResponseResolver::class,
        'GET' => 'getAction'
    ],
    '/vehicle' => [
        'class' => \App\ResponseResolver\VehicleResponseResolver::class,
        'GET' => 'getAction'
    ]
];