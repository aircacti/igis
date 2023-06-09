<?php


// -----------------------------------------
//    All application logic initialization
// -----------------------------------------

// Find application directory
define('PATH', __DIR__);


// *****************************************
// *****************************************
//             Use external
// *****************************************
// *****************************************


// Get config
// $config is available
require_once(PATH . '/config.php');
$config = config::getInstance();

// Get information about request
// $request is available
require_once(PATH . '/handle/request.php');
$request = request::getInstance();

// Get information about existing redirects
// $redirects is available
require_once(PATH . '/redirects.php');

// Get helper function to throw errors
// throw_error($config, code, description) is available
require_once(PATH . '/handle/throw_error.php');

// Get find page by ur/i function
require_once(PATH . '/handle/pagesManager.php');
$pagesManager = pagesManager::getInstance();

// Get the rendering e/ngine
require_once(PATH . '/handle/renderManager.php');
$renderManager = renderManager::getInstance();

// Get translations engine
require_once(PATH . '/handle/translate.php');



// *****************************************
// *****************************************
//             Validate request
// *****************************************
// *****************************************


// Check that the domain used is the same as in the configuration file
if ($config->domain != $request->domain) {
    throw_error(1, 'Domain error');
    exit;
}

// Check if redirection is required
if (isset($redirects[$request->uri])) {
    header('Location: ' . $config->getProtocol() . '://' . $config->domain . $redirects[$request->uri]);
    exit;
}

// Check if https is preferred
if ($config->httpsRedirect && !$request->isHttps) {
    header('Location: https://' . $config->domain . $redirects[$request->uri]);
    exit;
}

// Find requested page object
$current_page = $pagesManager->findPageByUri($request->uri);

// Check if the requested page exists
if (!$current_page) {
    throw_error(2, 'That page not exist ');
    exit;
}

// Check if the page has an assigned content file
if (!file_exists($current_page->getContentPath())) {
    throw_error(3, 'Content file of that page dont exist ');
    exit;
}


// *****************************************
// *****************************************
//             Generate page
// *****************************************
// *****************************************

echo $pagesManager->getView($request->uri);
