<?php
function show($content_path, $layout_path)
{
    require(PATH . '/app/renderEngine.php');
    $renderEngine = renderEngine::getInstance();

    require_once(PATH . '/settings/config.php');
    $config = config::getInstance();


    // Calculate time
    $discoveryOfAmerica = new DateTime('1492-10-12');
    $discoveryOfThisSite = new DateTime();
    $intervalOfGreatEvents = $discoveryOfAmerica->diff($discoveryOfThisSite);
    $intervalOfGreatEvents = $intervalOfGreatEvents->format('%y years, %m months, %d days, %h hours, %i minutes, %s seconds');


    $customVariables = [
        'url' => $config->getPrefixedUrl(),
        'pageTitle' => "Welcome page!",
        'intervalOfGreatEvents' => $intervalOfGreatEvents
    ];

    return $renderEngine->render($content_path, $layout_path, $customVariables);
}
