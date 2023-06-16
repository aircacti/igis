<?php

namespace App;

class translationsManager
{



    // *****************************************
    // *****************************************
    //            Available functions
    // *****************************************
    // *****************************************

    public function getTranslations()
    {
        // Include the file containing the translations
        require_once(PATH . '/settings/translations.php');

        return $translations;
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
            self::$instance = new translationsManager();
        }
        return self::$instance;
    }
}
