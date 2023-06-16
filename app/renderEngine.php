<?php

class renderEngine
{

    // Create a property with the name of the view being processed
    private $bufferFileName;

    public function render($content_path, $layout_path, $customVariables)
    {

        // Get config settings
        require_once(PATH . '/settings/config.php');
        $config = config::getInstance();

        // Get errors manager
        require_once(PATH . '/app/errorsManager.php');
        $errorsManager = errorsManager::getInstance();

        // Get the contents of the views
        $rawContent = file_get_contents(PATH . $content_path);
        if (!$rawContent) {
            $errorsManager->throw(5, "Error on file_get_contents");
        }

        $rawLayout = file_get_contents(PATH . $layout_path);
        if (!$rawLayout) {
            $errorsManager->throw(6, "Error on file_get_contents");
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
                $errorsManager->throw(3, "Php is disabled in the view");
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
            $errorsManager->throw(4, "Error while rendering the page. Here is additional information: " . $e);
        }

        // Delete the created buffer file
        $this->removeBufferFile();

        // Return the processed view
        return $compiled;
    }

    private function createBufferFile()
    {
        // Get errors manager
        require_once(PATH . '/app/errorsManager.php');
        $errorsManager = errorsManager::getInstance();

        // Create buffer file
        if (!touch(PATH . '/buffer/' . $this->bufferFileName)) {
            $errorsManager->throw(7, "Error on touch");
        }
    }

    private function modifyBufferFile($raw)
    {
        // Get errors manager
        require_once(PATH . '/app/errorsManager.php');
        $errorsManager = errorsManager::getInstance();

        // Modify buffer file
        if (!file_put_contents(PATH . '/buffer/' . $this->bufferFileName, $raw)) {
            $errorsManager->throw(8, "Error on file_put_contents");
        }
    }

    private function removeBufferFile()
    {
        // Get errors manager
        require_once(PATH . '/app/errorsManager.php');
        $errorsManager = errorsManager::getInstance();

        // Delete buffer file
        if (!unlink(PATH . '/buffer/' . $this->bufferFileName)) {
            $errorsManager->throw(9, "Error on unlink");
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
        require_once(PATH . '/app/errorsManager.php');
        $errorsManager = errorsManager::getInstance();

        $result = preg_replace_callback(
            '/\{\{([^}]+)\}\}/',
            function ($matches) use ($errorsManager) {
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
                    $errorsManager->throw(10, "Illegal operation in curly brackets: " . htmlspecialchars($code));
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
