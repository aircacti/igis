<?php

// -----------------------------------------
//    All application logic initialization
// -----------------------------------------


// *****************************************
// *****************************************
//         Load important things
// *****************************************
// *****************************************

require_once(PATH . '/settings/config.php');
$config = config::getInstance();

require_once(PATH . '/app/requestManager.php');
$requestManager = requestManager::getInstance();

require_once(PATH . '/app/pagesManager.php');
$pagesManager = pagesManager::getInstance();

require_once(PATH . '/app/pageClass.php');

require_once(PATH . '/app/redirectionsManager.php');
$redirectionsManager = redirectionsManager::getInstance();

require_once(PATH . '/app/errorsManager.php');
$errorsManager = errorsManager::getInstance();

require_once(PATH . '/app/translationsManager.php');
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
        $page['controller_path']
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
//             Generate page
// *****************************************
// *****************************************

// Get the current page from the pages manager
$current_page = $pagesManager->getPage($requestManager->getUri());

// Get controller for requested URI
require_once(PATH . $current_page->getControllerPath());

// Display page via controller
echo show($current_page->getContentPath(), $current_page->getLayoutPath());
