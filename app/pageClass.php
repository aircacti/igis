<?php


// *****************************************
// *****************************************
//           Page information
// *****************************************
// *****************************************


class page
{

    // *****************************************
    // *****************************************
    //              Available data
    // *****************************************
    // *****************************************

    private $uri;
    private $uri_no_slash;
    private $content_path;
    private $layout_path;
    private $controller_path;

    // *****************************************
    // *****************************************
    //               Construct
    // *****************************************
    // *****************************************

    public function __construct($uri, $content_path, $layout_path, $controller_path)
    {
        $this->uri = $uri;
        $this->uri_no_slash = function () use ($uri) {
            substr($uri, 1);
        };
        $this->content_path = $content_path;
        $this->layout_path = $layout_path;
        $this->controller_path = $controller_path;
    }

    // *****************************************
    // *****************************************
    //            Available functions
    // *****************************************
    // *****************************************

    public function getUri()
    {
        return $this->uri;
    }

    public function getUriNoSlash()
    {
        return $this->uri_no_slash;
    }

    public function getContentPath()
    {
        return $this->content_path;
    }

    public function getLayoutPath()
    {
        return $this->layout_path;
    }

    public function getControllerPath()
    {
        return $this->controller_path;
    }
}
