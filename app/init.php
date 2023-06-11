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

// *****************************************
// *****************************************
//           Create available pages
// *****************************************
// *****************************************

require_once(PATH . '/settings/pages.php');

foreach ($pages as $page) {
    $pagesManager->addPage(
        $page['uri'],
        $page['title'],
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

if ($config->getDomain() != $requestManager->getDomain()) {
    $errorsManager->throw(0, 'Domain error');
    exit;
}

if ($redirectionsManager->exists($requestManager->getUri())) {
    header('Location: ' . $config->getProtocol() . '://' . $config->getDomain() . $redirectionsManager->getRedirection($requestManager->getUri()));
    exit;
}


if (!$requestManager->isHttps() && $config->isHttpsRedirectEnabled()) {
    header('Location: ' . $config->getProtocol() . '://' . $config->getDomain() . $requestManager->getUri());
    exit;
}

if (!$pagesManager->exists($requestManager->getUri())) {
    $errorsManager->throw(1, "That page not exists");
}

if (!$pagesManager->contentExists($requestManager->getUri())) {
    $errorsManager->throw(2, "Content of that page doesnt exist");
}


// *****************************************
// *****************************************
//             Generate page
// *****************************************
// *****************************************

$current_page = $pagesManager->getPage($requestManager->getUri());

require_once(PATH . $current_page->getControllerPath());
echo show($current_page->getContentPath(), $current_page->getLayoutPath());
