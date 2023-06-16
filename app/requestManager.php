<?php

namespace App;

class requestManager
{

    // *****************************************
    // *****************************************
    //              Available data
    // *****************************************
    // *****************************************

    private $domain;
    private $uri;
    private $uri_noslash;
    private $user_ip;
    private $language;
    private $isHttps;


    // *****************************************
    // *****************************************
    //               Construct
    // *****************************************
    // *****************************************

    public function __construct()
    {
        // Get the domain from the HTTP_HOST server variable
        $this->domain = $_SERVER['HTTP_HOST'];

        // Get the URI from the REQUEST_URI server variable
        $this->uri = $_SERVER['REQUEST_URI'];

        // Get the URI without the leading slash
        $this->uri_noslash = function () {
            return substr($_SERVER['REQUEST_URI'], 1);
        };

        // Get the user's IP address
        $this->user_ip = function () {
            if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
                return $_SERVER['HTTP_CLIENT_IP'];
            } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
            } else {
                return $_SERVER['REMOTE_ADDR'];
            }
        };

        // Get the language from the ACCEPT_LANGUAGE server variable
        $this->language = function () {
            substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
        };

        // Check if the request is using HTTPS
        $this->isHttps = function () {
            return isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' && isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] === '443';
        };
    }


    // *****************************************
    // *****************************************
    //            Available functions
    // *****************************************
    // *****************************************

    public function getDomain()
    {
        return $this->domain;
    }

    public function getUri()
    {
        return $this->uri;
    }

    public function getUriNoslash()
    {
        return $this->uri_noslash;
    }

    public function getUserIp()
    {
        return $this->user_ip;
    }

    public function getLanguage()
    {
        return $this->language;
    }

    public function isHttps()
    {
        return $this->isHttps;
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
            self::$instance = new requestManager();
        }
        return self::$instance;
    }
}
