<?php

class config
{

    // *****************************************
    // *****************************************
    //              Available data
    // *****************************************
    // *****************************************

    // Assign a domain to the site
    private $domain = "igis.igis";

    // Display if there is a page with a different case url
    private $uri_case_sensitive = false;

    // Display detailed error messages instead of a generalized error page
    private $debug = true;

    // Default language for translations
    private $mainLanguage = "en";

    // Display the "Missing translation" message when a translation is missing instead of displaying the translation for the main language
    private $missingTranslation = true;

    // Prefer connection via https. Redirect when traffic is not encrypted
    private $httpsRedirect = false;

    // Enable operations inside double curly brackets
    private $curlyInView = true;

    // list of allowed operations in curly brackets
    private $curlyInViewOperations = [
        'echo', 'translate'
    ];

    // Allow php code execution inside views. Use with caution
    private $phpInView = true;



    // *****************************************
    // *****************************************
    //            Available functions
    // *****************************************
    // *****************************************

    public function getProtocol()
    {
        return $this->httpsRedirect ? "https" : "http";
    }

    public function getDomain()
    {
        return $this->domain;
    }

    public function getPrefixedUrl()
    {
        return $this->getProtocol() . '://' . $this->getDomain();
    }

    public function isUriCaseSensitive()
    {
        return $this->uri_case_sensitive;
    }

    public function isDebugMode()
    {
        return $this->debug;
    }

    public function getMainLanguage()
    {
        return $this->mainLanguage;
    }

    public function isMissingTranslationEnabled()
    {
        return $this->missingTranslation;
    }

    public function isHttpsRedirectEnabled()
    {
        return $this->httpsRedirect;
    }

    public function isCurlyInViewEnabled()
    {
        return $this->curlyInView;
    }

    public function getCurlyInViewOperations()
    {
        return $this->curlyInViewOperations;
    }

    public function isPhpInViewEnabled()
    {
        return $this->phpInView;
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
            self::$instance = new config();
        }
        return self::$instance;
    }
}
