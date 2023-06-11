<?php

require(PATH . '/app/renderEngine.php');
$renderEngine = renderEngine::getInstance();

function show($content_path, $layout_path)
{
    global $renderEngine;

    return $renderEngine->render($content_path, $layout_path);
}
