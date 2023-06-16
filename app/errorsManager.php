<?php

class errorsManager
{

    // *****************************************
    // *****************************************
    //            Available functions
    // *****************************************
    // *****************************************

    // This function echoes an error code and description, and terminates script execution.
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
