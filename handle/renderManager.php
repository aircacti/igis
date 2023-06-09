<?php


class renderManager
{

    public function putContentInLayout($contentPath, $layoutPath)
    {
        $content = file_get_contents($contentPath);

        $layout = null;
        if ($layoutPath == false) {
            $layout = "@CONTENT";
        } else {
            $layout = file_get_contents($layoutPath);
        }

        $combined = str_replace("@CONTENT", $content, $layout);

        return $combined;
    }

    public function replaceCodeInBrackets($codeToReplace)
    {

        // Replace double-bracketed PHP code with the evaluated result
        $renderedContent = preg_replace_callback(
            '/\{\{(.+?)\}\}/',
            function ($matches) {
                // Start output buffering
                ob_start();

                // Evaluate the PHP code
                eval($matches[1]);

                // Get the evaluated output and clean the output buffer
                return ob_get_clean();
            },
            $codeToReplace
        );

        return $renderedContent;
    }

    private static $instance;

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new renderManager();
        }
        return self::$instance;
    }
}
