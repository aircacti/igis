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

    public function throw($code = 0, $additionalDesc = null)
    {
        // Get config manager
        $config = config::getInstance();

        if ($config->isDebugMode()) {
            $shortDescription = $this->getExceptionShortDescription($code);
            $longDescription = $this->getExceptionLongDescription($code);

            $combinedDescription = $shortDescription . ' (' . $longDescription . ') + ' . $additionalDesc;

            throw new \Exception($combinedDescription, $code);
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

    function getExceptionShortDescription($exceptionCode)
    {
        $jsonFile = PATH . '/settings/exceptionCodes.json';
        $jsonData = file_get_contents($jsonFile);
        $data = json_decode($jsonData, true);

        if (isset($data[$exceptionCode]['shortDescription'])) {
            return $data[$exceptionCode]['shortDescription'];
        }

        return 'Exception code short description not found.';
    }

    function getExceptionLongDescription($exceptionCode)
    {
        $jsonFile = PATH . '/settings/exceptionCodes.json';
        $jsonData = file_get_contents($jsonFile);
        $data = json_decode($jsonData, true);

        if (isset($data[$exceptionCode]['longDescription'])) {
            return $data[$exceptionCode]['longDescription'];
        }

        return 'Exception code long description not found.';
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
