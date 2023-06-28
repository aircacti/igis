<?php

namespace Settings;

class config
{

    // *****************************************
    // *****************************************
    //              Available data
    // *****************************************
    // *****************************************

    // Assign a domain to the site
    private $domain = 'igis.igis';

    // Display if there is a page with a different case url
    private $uri_case_sensitive = false;

    // Display detailed error messages instead of a generalized error page
    private $debug = false;

    // Default controller to display non-debug exception page
    private $exceptionControllerName = 'oopsController';

    // Default layout to display non-debug exception page
    private $exceptionLayoutPath = '/views/layouts/oops.php';

    // Default content to display non-debug exception page
    private $exceptionContentPath = '/views/content/oops.php';

    // Default language for translations
    private $mainLanguage = 'en';

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

    // Mailing settings
    private $mailDebug = 0; // Debug level for email sending
    private $mailHost = 'x.com'; // SMTP host
    private $mailUsername = 'x@x.com'; // SMTP username
    private $mailPassword = 'xx'; // SMTP password
    private $mailSMTPSecure = 'tls'; // SMTP encryption method
    private $mailSMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    ); // SMTP options
    private $mailPort = 587; // SMTP port


    // Database settings
    private $dbName = 'igisDatabase';
    private $user = 'root';
    private $password = '';
    private $host = 'localhost';
    private $port = 3306;


    // *****************************************
    // *****************************************
    //            Available functions
    // *****************************************
    // *****************************************

    public function getProtocol()
    {
        return $this->httpsRedirect ? 'https' : 'http';
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

    public function getMailDebug()
    {
        return $this->mailDebug;
    }

    public function getMailHost()
    {
        return $this->mailHost;
    }

    public function getMailUsername()
    {
        return $this->mailUsername;
    }

    public function getMailPassword()
    {
        return $this->mailPassword;
    }

    public function getMailSMTPSecure()
    {
        return $this->mailSMTPSecure;
    }

    public function getMailSMTPOptions()
    {
        return $this->mailSMTPOptions;
    }

    public function getMailPort()
    {
        return $this->mailPort;
    }

    public function getDbName()
    {
        return $this->dbName;
    }

    public function getDbUser()
    {
        return $this->user;
    }

    public function getDbPassword()
    {
        return $this->password;
    }

    public function getDbHost()
    {
        return $this->host;
    }

    public function getDbPort()
    {
        return $this->port;
    }

    public function getExceptionControllerName()
    {
        return $this->exceptionControllerName;
    }

    public function getExceptionLayoutPath()
    {
        return $this->exceptionLayoutPath;
    }

    public function getExceptionContentPath()
    {
        return $this->exceptionContentPath;
    }

    // Testing
    public function getAllProperties()
    {
        $reflection = new \ReflectionClass($this);
        $properties = $reflection->getProperties(\ReflectionProperty::IS_PRIVATE);
        $propertyValues = array();

        foreach ($properties as $property) {
            $property->setAccessible(true);
            $propertyName = $property->getName();
            $propertyValue = $property->getValue($this);

            if (preg_match("/user|password|host|instance/i", $propertyName)) {
                $propertyValue = "IGIS_HIDDEN";
            }

            $propertyValues[$propertyName] = $propertyValue;
        }

        return $propertyValues;
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
