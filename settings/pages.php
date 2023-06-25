<?php

$pages = [
    [
        'uri' => '/',
        'content_path' => '/views/content/home.php',
        'layout_path' => '/views/layouts/home.php',
        'controller_path' => '/controllers/homeController.php',
        'middleware' => [
            'ipAddressMiddleware'
        ]
    ]

];
