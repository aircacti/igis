<?php

// This file initializing igis


// Get config
require_once('config.php');
$config = new config();

// Get information about request
require_once('handle/request.php');
$request = new request();

// Get information about existing pages
require_once('handle/pages.php');
$pages = new pages();

// Check error page exist
if (!file_exists('pages/basic_error.html')) {
    echo '<p>Something gone wrong! Please return to previous page!</p> <p hidden>Error: 1</p>';
    exit;
}

// Validate request

function throw_error($config, $code = 0, $description = null)
{
    if ($config->debug) {
        echo 'Error ' . $code . ' ' . $description;
    } else {
        echo file_get_contents('pages/basic_error.html');
    }
}

if ($config->domain != $request->domain) {
    throw_error($config, 1, 'Domain error');
    exit;
}

// Check if page exists
if (!isset($pages->{$request->uri_noslash})) {
    echo 'That page not exist';
    exit;
}

$current_page = $pages->{$request->uri_noslash};

if (!file_exists($current_page['content'])) {
    throw_error($config, 1, 'Content file of that page dont exist');
    exit;
}

//Everything ok
echo file_get_contents($currentPage['content']);
