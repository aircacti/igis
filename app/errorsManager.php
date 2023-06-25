<?php

namespace App;

class errorsManager
{

    // *****************************************
    // *****************************************
    //            Available functions
    // *****************************************
    // *****************************************

    // This function echoes an error code and description, and terminates script execution.
    public function throw($code = 0, $description = null)
    {
        echo $this->htmlGenerator($code, $description);
        exit;
    }

    public function htmlGenerator($code, $description)
    {
        echo <<<HTML
        
        <!DOCTYPE html>
        <html>
        <head>
            <title>Error Handling Example</title>
            <link rel="stylesheet" type="text/css" href="styles.css">
            <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f5f5f5;
                margin: 0;
                padding: 20px;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                min-height: 100vh;
            }

            h1 {
                font-size: 32px;
                color: #333;
                text-align: center;
                margin-top: 0;
                padding-top: 20px;
                letter-spacing: 2px;
            }

            .error-box {
                background-color: #fff;
                border: 1px solid #ddd;
                border-radius: 4px;
                padding: 20px;
                margin-bottom: 20px;
                max-width: 1000px;
                /* Adjust the width as needed */
                width: 100%;
            }

            .error-box h2 {
                color: #ff4444;
                font-size: 24px;
                margin-top: 0;
                margin-bottom: 10px;
            }

            .error-code {
                font-size: 18px;
                font-weight: bold;
                margin-bottom: 10px;
            }

            .error-type {
                font-size: 14px;
                color: #777;
                margin-bottom: 10px;
            }

            .custom-stack-trace {
                background-color: #f5f5f5;
                border: 1px solid #ddd;
                border-radius: 4px;
                padding: 10px;
                margin-top: 10px;
                overflow-x: auto;
                font-family: monospace;
                font-size: 14px;
            }

            .documentation-links {
                text-align: right;
                margin-top: 20px;
            }

            .documentation-links a {
                margin: 0 10px;
                color: #007bff;
                text-decoration: none;
            }

            .version-info {
                text-align: center;
                margin-top: 20px;
                font-size: 14px;
                color: #777;
            }

            .version-info span {
                margin: 0 10px;
            }
            </style>
        </head>
        <body>
            <h1>IGIS Exception Manager</h1>
        HTML;

        $errors = [
            [
                "title" => $description,
                "code" => "Code " . $code,
                "type" => "Type: PHP Error",
                "message" => "Sorry, the page you are looking for generated error.",
                "stackTrace" => "Trace here"
            ],
        ];

        foreach ($errors as $error) {
            echo <<<HTML
                <div class="error-box">
                    <h2>{$error['title']}</h2>
                    <div class="error-code">{$error['code']}</div>
                    <div class="error-type">{$error['type']}</div>
                    <p>{$error['message']}</p>
                    <div class="custom-stack-trace">
                        <pre>{$error['stackTrace']}</pre>
                    </div>
                </div>
            HTML;
        }

        echo <<<HTML
            <div class="documentation-links">
                <a href="https://github.com/aircacti/igis" target="_blank">GitHub Repository</a>
                <a href="https://www.php.net/docs.php" target="_blank">PHP Documentation</a>
            </div>

            <div class="version-info">
                <span>PHP Version:</span> 8.0.0
                <span>Application Version:</span> 1.0.0
            </div>
        </body>
        </html>
        HTML;
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
            self::$instance = new errorsManager();
        }
        return self::$instance;
    }
}
