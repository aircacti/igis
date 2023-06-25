<?php

class publicException {


    // *****************************************
    // *****************************************
    //              Available data
    // *****************************************
    // *****************************************


    // Define and exception page uri
    private $uri = '/oops';

    // Define view content file
    private $content_path = '/views/content/oops.php';

    // Define view layout file
    private $layout_path = '/views/layouts/oops.php';

    // Define controller for the view
    private $controller_path = '/controllers/oopsController.php';

    
    // *****************************************
    // *****************************************
    //            Available functions
    // *****************************************
    // *****************************************
    
    
    // Getter function for $uri
    public function getUri()
    {
        return $this->uri;
    }

    // Getter function for $content_path
    public function getContentPath()
    {
        return $this->content_path;
    }

    // Getter function for $layout_path
    public function getLayoutPath()
    {
        return $this->layout_path;
    }

    // Getter function for $controller_path
    public function getControllerPath()
    {
        return $this->controller_path;
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
            self::$instance = new publicException();
        }
        return self::$instance;
    }
}