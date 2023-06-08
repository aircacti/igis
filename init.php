<?php


// -----------------------------------------
//    All application logic initialization
// -----------------------------------------


// *****************************************
// *****************************************
//             Use external
// *****************************************
// *****************************************


// Get config
// $config is available
require_once('config.php');

// Get information about request
// $request is available
require_once('handle/request.php');

// Get information about existing pages
// $pages is available
require_once('pages.php');

// Get information about existing redirects
// $redirects is available
require_once('redirects.php');

// Get helper function to throw errors
// throw_error($config, code, description) is available
require_once('handle/throw_error.php');


// *****************************************
// *****************************************
//             Validate request
// *****************************************
// *****************************************


// Check that the domain used is the same as in the configuration file
if ($config->domain != $request->domain) {
    throw_error($config, 1, 'Domain error');
    exit;
}

// Check if redirection is required
if (isset($redirects[$request->uri])) {
    header("Location: http://" . $config->domain . $redirects[$request->uri]);
    exit;
}

// Check if the requested page exists
$current_page = findPageByUri($pages, $request->uri);
if (!$current_page) {
    echo 'That page not exist' . $current_page;
    exit;
}

// Check if the page has an assigned content file
if (!file_exists($current_page->getContentPath())) {
    throw_error($config, 1, 'Content file of that page dont exist ');
    exit;
}


// *****************************************
// *****************************************
//             Generate page
// *****************************************
// *****************************************


echo file_get_contents($current_page->getContentPath());
