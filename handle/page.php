<?php


// *****************************************
// *****************************************
//           Page information
// *****************************************
// *****************************************


class page
{
    public $uri;
    public $uri_no_slash;
    public $title;
    public $content_path;

    public function __construct($uri, $title, $content_path)
    {
        $this->uri = $uri;
        $this->uri_no_slash = substr($uri, 1);
        $this->title = $title;
        $this->content_path = $content_path;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getUriNoSlash()
    {
        return $this->uri_no_slash;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getContentPath()
    {
        return $this->content_path;
    }
}
