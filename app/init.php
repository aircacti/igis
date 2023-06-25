<?php

require_once PATH . '/vendor/autoload.php';

use Settings\config;
use App\requestManager;
use App\pagesManager;
use App\redirectionManager;
use App\exceptionManager;
use App\translationManager;
use App\middlewareManager;

// -----------------------------------------
//    All application logic initialization
// -----------------------------------------


// *****************************************
// *****************************************
//         Load important things
// *****************************************
// *****************************************

require_once(PATH . '/vendor/autoload.php');

$config = config::getInstance();

$requestManager = requestManager::getInstance();

$pagesManager = pagesManager::getInstance();

require_once(PATH . '/app/pageClass.php');

$redirectionManager = redirectionManager::getInstance();

$exceptionManager = exceptionManager::getInstance();

$translationManager = translationManager::getInstance();

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();


// *****************************************
// *****************************************
//           Create available pages
// *****************************************
// *****************************************

require_once(PATH . '/settings/pages.php');

foreach ($pages as $page) {
    $pagesManager->addPage(
        $page['uri'],
        $page['content_path'],
        $page['layout_path'],
        $page['controller_path'],
        $page['middleware']
    );
}

// *****************************************
// *****************************************
//           Check request
// *****************************************
// *****************************************

// Check if the requested domain matches the configured domain
if ($config->getDomain() != $requestManager->getDomain()) {
    $exceptionManager->throw(6000, 'Invalid domain');
    exit;
}

// Check if a redirection exists for the requested URI
if ($redirectionManager->exists($requestManager->getUri())) {
    header('Location: ' . $config->getProtocol() . '://' . $config->getDomain() . $redirectionManager->getRedirection($requestManager->getUri()));
    exit;
}

// Redirect to the same URI using HTTPS if HTTPS is enabled 
if (!$requestManager->isHttps() && $config->isHttpsRedirectEnabled()) {
    header('Location: ' . $config->getProtocol() . '://' . $config->getDomain() . $requestManager->getUri());
    exit;
}

// Check if the requested URI exists
if (!$pagesManager->exists($requestManager->getUri())) {
    $exceptionManager->throw(6001, "Page does not exist");
}

// Check if the content for the requested URI exists
if (!$pagesManager->contentExists($requestManager->getUri())) {
    $exceptionManager->throw(6002, "There is no content for the page");
}


// *****************************************
// *****************************************
//             Page object
// *****************************************
// *****************************************


// Get the current page from the pages manager
$current_page = $pagesManager->getPage($requestManager->getUri());


// *****************************************
// *****************************************
//             Middleware
// *****************************************
// *****************************************


$middlewareManager = middlewareManager::getInstance();
$middlewareManager->loadMiddleware($current_page->getMiddleware());



// *****************************************
// *****************************************
//             Generate page
// *****************************************
// *****************************************


$controllerClass = 'Controllers\\' . $current_page->getControllerName();

if (!class_exists($controllerClass)) {
    $exceptionManager->throw(6003, 'No controller for this request');
}

$controller = new $controllerClass();

if (!method_exists($controller, 'show')) {
    $exceptionManager->throw(6004, 'There is no show method');
}

echo $controller->show($current_page->getContentPath(), $current_page->getLayoutPath());
