<?php



class redirectionsManager
{


    // *****************************************
    // *****************************************
    //            Available functions
    // *****************************************
    // *****************************************

    public function getRedirections()
    {
        require_once(PATH . '/settings/redirections.php');
        return $redirections;
    }

    public function getRedirection($uri)
    {
        $redirections = $this->getRedirections();

        if (isset($redirections[$uri])) {
            return $redirections[$uri];
        }

        return null;
    }

    public function exists($uri)
    {
        $redirections = $this->getRedirections();

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
