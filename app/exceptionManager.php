<?php

namespace App;

use Settings\config;
use App\renderEngine;
use Exception;

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

    // This function echoes an error code and description, and terminates script execution.
    public function throw($code = 0, $description = null)
    {

        // Get config manager
        $config = config::getInstance();

        // Get render engine
        $renderEngine = renderEngine::getInstance();

        if ($config->isDebugMode()) {
            throw new \Exception($description, $code);
        } else {
            $this->code = $code;

            try {
                $controllerClass = 'Controllers\\oopsController';

                $controller = new $controllerClass();

                echo $controller->show('/views/content/oops.php', '/views/layouts/oops.php');
            } catch (Exception $e) {
                echo 'WTF';
            }
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
