<?php

function renderPhpCode($filename, $variables = [])
{
    // Convert individual variable names to an associative array
    if (!is_array($variables)) {
        $variables = compact($variables);
    }

    // Read the content of the file
    $fileContent = file_get_contents($filename);

    // Replace double-bracketed PHP code with the evaluated result
    $renderedContent = preg_replace_callback(
        '/\{\{(.+?)\}\}/',
        function ($matches) use ($variables) {
            // Start output buffering
            ob_start();

            // Extract variables from $variables array into the local symbol table
            extract($variables, EXTR_SKIP);

            // Evaluate the PHP code
            eval($matches[1]);

            // Get the evaluated output and clean the output buffer
            return ob_get_clean();
        },
        $fileContent
    );

    return $renderedContent;
}
