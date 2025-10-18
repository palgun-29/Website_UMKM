<?php

protected $routeMiddleware = [
    // middleware bawaan
    'role' => \App\Http\Middleware\CheckRole::class,
];
