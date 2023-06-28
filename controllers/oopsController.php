<?php

namespace Controllers;

use App\renderEngine;
use Settings\config;
use App\exceptionManager;

class oopsController
{
    public function show($content_path, $layout_path)
    {
        // Get render engine
        $renderEngine = renderEngine::getInstance();

        // Get config settings
        $config = config::getInstance();

        // Get exception manager
        $exceptionManager = exceptionManager::getInstance();

        // Get current exception code
        $exceptionCode = $exceptionManager->getCode();

        // Set default exception message on site
        $message = 'An error occured';

        // if the exception is that the page does not exist 
        //ref. exception codes in docs
        if ($exceptionCode == 6001) {
            $message = 'This page does not exist';
        }

        // Pass message into page
        $customVariables = [
            'message' => $message,
            'domain' => $config->getDomain(),
            'homeUrl' => $config->getPrefixedUrl()
        ];

        return $renderEngine->render($content_path, $layout_path, $customVariables);
    }
}
