<?php

namespace App;

use App\exceptionManager;

class middlewareManager
{

    // *****************************************
    // *****************************************
    //            Available functions
    // *****************************************
    // *****************************************

    public function loadMiddleware($middlewareArray)
    {
        foreach ($middlewareArray as $middlewareName) {
            $foundMiddleware = $this->getMiddleware($middlewareName);
            $foundMiddleware->run();
        }
    }

    public function getMiddleware($middlewareName)
    {
        // Get errors manager
        $exceptionManager = exceptionManager::getInstance();

        $middlewareClass = 'Middleware\\' . $middlewareName;

        if (!class_exists($middlewareClass)) {
            $exceptionManager->throw(555, 'Middleware class not found.');
        }

        $middleware = new $middlewareClass();

        return $middleware;
    }


    // *****************************************
    // *****************************************
    //           Singleton declaration
    // *****************************************
    // *****************************************


    private static $instance;

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new middlewareManager();
        }
        return self::$instance;
    }
}
