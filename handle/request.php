<?php


// *****************************************
// *****************************************
//           Http request information
// *****************************************
// *****************************************


class request
{
    public $domain;
    public $uri;
    public $uri_noslash;

    public function __construct()
    {
        $this->domain = $_SERVER['HTTP_HOST'];
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->uri_noslash = substr($this->uri, 1);
    }
}


// *****************************************
// *****************************************
//             Put in a variable
// *****************************************
// *****************************************


$request = new request();
