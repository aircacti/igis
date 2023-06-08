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
    public $user_ip;
    public $language;

    public function __construct()
    {
        $this->domain = $_SERVER['HTTP_HOST'];
        $this->uri = $_SERVER['REQUEST_URI'];
        $this->uri_noslash = substr($this->uri, 1);
        $this->user_ip = $this->getUserIpAddr();
        $this->language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    }

    private function getUserIpAddr()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            // IP is provided via share internet
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            // IP is passed from a proxy
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            // Use the remote address as the client IP
            return $_SERVER['REMOTE_ADDR'];
        }
    }
}


// *****************************************
// *****************************************
//             Put in a variable
// *****************************************
// *****************************************


$request = new request();
