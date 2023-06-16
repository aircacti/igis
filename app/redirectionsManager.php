<?php



class redirectionsManager
{


    // *****************************************
    // *****************************************
    //            Available functions
    // *****************************************
    // *****************************************

    // get all redirects
    public function getRedirections()
    {
        // Include the file containing the redirection settings
        require_once(PATH . '/settings/redirections.php');

        // Return the array of redirections
        return $redirections;
    }

    // Get specific redirect
    public function getRedirection($uri)
    {
        // Get the array of redirections
        $redirections = $this->getRedirections();

        // Check if a redirection exists for the given URI
        if (isset($redirections[$uri])) {
            return $redirections[$uri];
        }

        // Return null if no redirection exists for the URI
        return null;
    }

    // Check if the redirect exists
    public function exists($uri)
    {
        // Get the array of redirections
        $redirections = $this->getRedirections();

        // Check if a redirection exists for the given URI
        return isset($redirections[$uri]);
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
            self::$instance = new redirectionsManager();
        }
        return self::$instance;
    }
}
