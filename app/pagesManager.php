<?php

namespace App;

class pagesManager
{

    // *****************************************
    // *****************************************
    //              Available data
    // *****************************************
    // *****************************************

    private $pages = [];

    // *****************************************
    // *****************************************
    //            Available functions
    // *****************************************
    // *****************************************

    // Get all available pages
    public function getPages()
    {
        return $this->pages;
    }

    // Get a specific page via uri
    public function getPage($uri)
    {
        foreach ($this->getPages() as $page) {
            if ($page->getUri() == $uri) {
                return $page;
            }
        }
        return null;
    }

    // Add new page as available
    public function addPage($uri, $content_path, $layout_path, $controller_path, $middleware)
    {
        $this->pages[] = new page($uri, $content_path, $layout_path, $controller_path, $middleware);
    }

    // Check if page exist
    public function exists($uri)
    {
        return $this->getPage($uri) == null ? false : true;
    }

    public function contentExists($uri)
    {
        $page = $this->getPage($uri);
        return file_exists(PATH . $page->getContentPath());
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
            self::$instance = new pagesManager();
        }
        return self::$instance;
    }
}
