<?php

// *****************************************
// *****************************************
//             Configuration file
// *****************************************
// *****************************************


class config
{

    // Assign a domain to the site
    public $domain = "igis.igis";

    // Display if there is a page with a different case url
    public $uri_case_sensitive = false;

    // Display detailed error messages instead of a generalized error page
    public $debug = true;

    // Default language for translations
    public $mainLanguage = "en";

    // Display the "Missing translation" message when a translation is missing instead of displaying the translation for the main language
    public $missingTranslation = true;
}


// *****************************************
// *****************************************
//             Put in a variable
// *****************************************
// *****************************************


$config = new config();
