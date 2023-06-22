<?php

$pages = [
    [
        'uri' => '/',
        'content_path' => '/views/content/igis_home.php',
        'layout_path' => '/views/layouts/igis.php',
        'controller_path' => '/controllers/homeController.php',
        'middleware' => [
            'ipAddressMiddleware'
        ]
    ],
    [
        'uri' => '/elo',
        'content_path' => '/views/content/igis_home.php',
        'layout_path' => '/views/layouts/igis.php',
        'controller_path' => '/controllers/homeController.php',
        'middleware' => []
    ],
    [
        'uri' => '/test',
        'content_path' => '/views/content/test.php',
        'layout_path' => null,
        'controller_path' => '/controllers/testController.php',
        'middleware' => []
    ]
];
