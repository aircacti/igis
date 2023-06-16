<?php

namespace App;

class translationsManager
{


    // *****************************************
    // *****************************************
    //           Singleton declaration
    // *****************************************
    // *****************************************


    private static $instance;

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new translationsManager();
        }
        return self::$instance;
    }
}
