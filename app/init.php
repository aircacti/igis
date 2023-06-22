<?php

require_once PATH . '/vendor/autoload.php';

use Settings\config;
use App\requestManager;
use App\pagesManager;
use App\redirectionsManager;
use App\errorsManager;
use App\translationsManager;
use App\middlewareManager;

// -----------------------------------------
//    All application logic initialization
// -----------------------------------------


// *****************************************
// *****************************************
//         Load important things
// *****************************************
// *****************************************


$config = config::getInstance();

$requestManager = requestManager::getInstance();

$pagesManager = pagesManager::getInstance();

require_once(PATH . '/app/pageClass.php');

$redirectionsManager = redirectionsManager::getInstance();

$errorsManager = errorsManager::getInstance();

$translationsManager = translationsManager::getInstance();

require_once(PATH . '/vendor/autoload.php');

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
    $errorsManager->throw(0, 'Domain error');
    exit;
}

// Check if a redirection exists for the requested URI
if ($redirectionsManager->exists($requestManager->getUri())) {
    header('Location: ' . $config->getProtocol() . '://' . $config->getDomain() . $redirectionsManager->getRedirection($requestManager->getUri()));
    exit;
}

// Redirect to the same URI using HTTPS if HTTPS is enabled 
if (!$requestManager->isHttps() && $config->isHttpsRedirectEnabled()) {
    header('Location: ' . $config->getProtocol() . '://' . $config->getDomain() . $requestManager->getUri());
    exit;
}

// Check if the requested URI exists
if (!$pagesManager->exists($requestManager->getUri())) {
    $errorsManager->throw(1, "That page not exists");
}

// Check if the content for the requested URI exists
if (!$pagesManager->contentExists($requestManager->getUri())) {
    $errorsManager->throw(2, "Content of that page doesnt exist");
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
    $errorsManager->throw(12, 'Controller class not found.');
}

$controller = new $controllerClass();

if (!method_exists($controller, 'show')) {
    $errorsManager->throw(11, 'No show method in controller');
}

echo $controller->show($current_page->getContentPath(), $current_page->getLayoutPath());
