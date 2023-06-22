<?php

namespace App;

use App\errorsManager;

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
        $errorsManager = errorsManager::getInstance();

        $middlewareClass = 'Middleware\\' . $middlewareName;

        if (!class_exists($middlewareClass)) {
            $errorsManager->throw(555, 'Middleware class not found.');
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
