<?php

namespace App;

use Settings\config;

class exceptionManager
{

    // *****************************************
    // *****************************************
    //              Available data
    // *****************************************
    // *****************************************

    // Assign a domain to the site
    private $code = 6014;

    // *****************************************
    // *****************************************
    //            Available functions
    // *****************************************
    // *****************************************

    public function __construct()
    {
        // Get config manager
        $config = config::getInstance();

        if ($config->isDebugMode()) {
            $this->registerWhoops();
        } else {
            $this->disableErrorsDisplay();
        }
    }

    public function registerWhoops()
    {
        // Get config manager
        $config = config::getInstance();

        $whoops = new \Whoops\Run;
        $handler = new \Whoops\Handler\PrettyPageHandler;
        $handler->addDataTable('Framework settings', $config->getAllProperties());
        $whoops->pushHandler($handler);
        $whoops->register();
    }

    public function disableErrorsDisplay()
    {
        error_reporting(0);
        ini_set('display_errors', 0);
        ini_set('display_startup_errors', 0);
    }

    public function throw($code = 0, $description = null)
    {
        // Get config manager
        $config = config::getInstance();

        if ($config->isDebugMode()) {
            throw new \Exception($description, $code);
        } else {
            $this->code = $code;
            $controllerClass = 'Controllers\\' . $config->getExceptionControllerName();

            $controller = new $controllerClass();

            echo $controller->show($config->getExceptionContentPath(), $config->getExceptionLayoutPath());
        }

        exit;
    }

    public function getCode()
    {
        return $this->code;
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
            self::$instance = new exceptionManager();
        }
        return self::$instance;
    }
}
