<?php

$pages = [
    [
        'uri' => '/',
        'title' => 'Welcome!',
        'content_path' => '/views/content/home.php',
        'layout_path' => '/views/layouts/default.php',
        'controller_path' => '/controllers/homeController.php'
    ],
    [
        'uri' => '/test',
        'title' => 'Testing page',
        'content_path' => '/views/content/test.php',
        'layout_path' => null,
        'controller_path' => '/controllers/testController.php'
    ]
];
