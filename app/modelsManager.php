<?php

namespace App;

use Settings\config;
use App\errorsManager;
use \DB;

class modelsManager
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
        $errorsManager = errorsManager::getInstance();

        $modelClass = 'Models\\' . $modelName;

        if (!class_exists($modelClass)) {
            $errorsManager->throw(55, 'Model class not found.');
        }

        $model = new $modelClass();

        return $model;
    }

    public function modelExists($modelName)
    {

        // Get errors manager
        $errorsManager = errorsManager::getInstance();

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
            self::$instance = new modelsManager();
        }
        return self::$instance;
    }
}
