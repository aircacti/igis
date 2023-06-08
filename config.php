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
}


// *****************************************
// *****************************************
//             Put in a variable
// *****************************************
// *****************************************


$config = new config();
