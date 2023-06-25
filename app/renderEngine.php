<?php

namespace App;

use App\exceptionManager;
use Settings\config;

class renderEngine
{

    // Create a property with the name of the view being processed
    private $bufferFileName;

    public function render($content_path, $layout_path, $customVariables)
    {

        // Get config settings
        $config = config::getInstance();

        // Get errors manager
        $exceptionManager = exceptionManager::getInstance();

        // Get the contents of the views
        $rawContent = file_get_contents(PATH . $content_path);
        if (!$rawContent) {
            $exceptionManager->throw(6006, "Could not get page content file");
        }

        $rawLayout = file_get_contents(PATH . $layout_path);
        if (!$rawLayout) {
            $exceptionManager->throw(6007, "Could not get page layout file");
        }

        // Create a buffer file
        $this->bufferFileName = hash("crc32", $rawContent . $rawLayout) . (int)microtime(true);
        $this->createBufferFile();

        // Combine the view with the layout
        $raw = $this->prepareInLayout($rawContent, $rawLayout);
        $this->modifyBufferFile($raw);

        // Check if the view contains php code
        if (!$config->isPhpInViewEnabled()) {
            if (preg_match('/<\?php|<\?/i', $raw)) {
                $this->removeBufferFile();
                $exceptionManager->throw(6008, "Php is not allowed");
            }
        }

        // Check if curly brackets functionality is enabled
        if ($config->isCurlyInViewEnabled()) {
            $raw = $this->prepareCurly($raw);
            $this->modifyBufferFile($raw);
        }


        // Process the view
        $compiled = null;
        try {
            // Start processing
            ob_start();

            // Share custom variables
            extract($customVariables);

            // Include the view buffer
            include PATH . '/buffer/' . $this->bufferFileName;

            // Finish processing
            $compiled = ob_get_clean();
        } catch (\Throwable $e) {
            $this->removeBufferFile();
            $exceptionManager->throw(6009, "Page view failed to render:" . $e);
        }

        // Delete the created buffer file
        $this->removeBufferFile();

        // Return the processed view
        return $compiled;
    }

    private function createBufferFile()
    {
        // Get errors manager
        require_once(PATH . '/app/exceptionManager.php');
        $exceptionManager = exceptionManager::getInstance();

        // Create buffer file
        if (!touch(PATH . '/buffer/' . $this->bufferFileName)) {
            $exceptionManager->throw(6010, "Failed to create buffer file");
        }
    }

    private function modifyBufferFile($raw)
    {
        // Get errors manager
        require_once(PATH . '/app/exceptionManager.php');
        $exceptionManager = exceptionManager::getInstance();

        // Modify buffer file
        if (!file_put_contents(PATH . '/buffer/' . $this->bufferFileName, $raw)) {
            $exceptionManager->throw(6011, "Failed to modify buffer file");
        }
    }

    private function removeBufferFile()
    {
        // Get errors manager
        require_once(PATH . '/app/exceptionManager.php');
        $exceptionManager = exceptionManager::getInstance();

        // Delete buffer file
        if (!unlink(PATH . '/buffer/' . $this->bufferFileName)) {
            $exceptionManager->throw(6012, "Buffer file could not be deleted");
        }
    }

    private function prepareInLayout($rawContent, $rawLayout)
    {
        // Put the content in the layout
        $result = str_replace('{{ IGIS_CONTENT }}', $rawContent, $rawLayout);
        return $result;
    }

    private function prepareCurly($raw)
    {
        // Get errors manager
        require_once(PATH . '/app/exceptionManager.php');
        $exceptionManager = exceptionManager::getInstance();

        $result = preg_replace_callback(
            '/\{\{([^}]+)\}\}/',
            function ($matches) use ($exceptionManager) {
                $code = trim($matches[1]);

                // Check if the code starts with 'echo '
                if (strpos($code, 'echo ') === 0) {
                    // Return PHP code that echoes the content
                    return '<?php ' . $code . ' ?>';
                }
                // Check if the code starts with 'translate('
                elseif (strpos($code, 'translate(') === 0) {
                    // Return PHP code for translation function
                    return '<?php ' . $code . ' ?>';
                } else {
                    // Remove the buffer file and throw an error for illegal operation in curly brackets
                    $this->removeBufferFile();
                    $exceptionManager->throw(6013, "Illegal operation in curly brackets:" . htmlspecialchars($code));
                }
            },
            $raw
        );

        // Return compiled result
        return $result;
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
            self::$instance = new renderEngine();
        }
        return self::$instance;
    }
}
