<?php

namespace App;

use Settings\config;
use App\exceptionManager;
use \DB;

class modelManager
{


    // *****************************************
    // *****************************************
    //            Available functions
    // *****************************************
    // *****************************************

    public function __construct()
    {
        $this->configureConnection();
    }

    public function configureConnection()
    {
        // Get config settings
        $config = config::getInstance();

        DB::$user = $config->getDbUser();
        DB::$password = $config->getDbPassword();
        DB::$dbName = $config->getDbName();
    }


    public function getModel($modelName)
    {

        // Get errors manager
        $exceptionManager = exceptionManager::getInstance();

        $modelClass = 'Model\\' . $modelName;

        if (!class_exists($modelClass)) {
            $exceptionManager->throw(6005, 'Model not found');
        }

        $model = new $modelClass();

        return $model;
    }

    public function modelExists($modelName)
    {
        $modelClass = 'Models\\' . $modelName;

        return class_exists($modelClass);
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
            self::$instance = new modelManager();
        }
        return self::$instance;
    }
}
