<?php

//MySql in future

class pages
{

    public $admin = [
        'title' => 'Administration',
        'uri' => '/admin',
        'content' => 'pages/admin.php'
    ];

    public $panel = [
        'title' => 'Page panel',
        'uri' => '/panel',
        'content' => 'pages/panel.php'
    ];

    public $home = [
        'title' => 'Home page',
        'uri' => '/',
        'content' => 'pages/home.php'
    ];
}
