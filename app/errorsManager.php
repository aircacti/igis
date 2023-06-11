<?php

class errorsManager
{

    // *****************************************
    // *****************************************
    //            Available functions
    // *****************************************
    // *****************************************

    public function throw($code = 0, $description = null)
    {
        echo 'Error ' . $code . ' ' . $description;
        exit;
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
            self::$instance = new errorsManager();
        }
        return self::$instance;
    }
}
