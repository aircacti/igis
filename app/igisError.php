<?php


<!DOCTYPE html>
<html>

<head>
    <title>Error Handling Example</title>
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
    <h1>My Application Name</h1>

    <div class="error-box">
        <h2>Error: Page Not Found</h2>
        <div class="error-code">Code 12345</div>
        <div class="error-type">Type: PHP Error</div>
        <p>Sorry, the page you are looking for does not exist.</p>
        <div class="custom-stack-trace">
            <pre>
    File "index.html", line 42, in <module>
        main()
    File "index.html", line 30, in main
        result = divide(10, 0)
    File "index.html", line 20, in divide
        return x / y
    ZeroDivisionError: division by zero
            </pre>
        </div>
    </div>

    <div class="error-box">
        <h2>Error: Internal Server Error</h2>
        <div class="error-code">Code 54321</div>
        <div class="error-type">Type: IGIS Error</div>
        <p>Sorry, an unexpected error occurred on the server.</p>
        <div class="custom-stack-trace">
            <pre>
    File "index.html", line 42, in <module>
        main()
    File "index.html", line 30, in main
        result = divide(10, 0)
    File "index.html", line 20, in divide
        return x / y
    ZeroDivisionError: division by zero
            </pre>
        </div>
    </div>

    <div class="documentation-links">
        <a href="https://github.com/your-application-repo" target="_blank">GitHub Repository</a>
        <a href="https://www.php.net/docs.php" target="_blank">PHP Documentation</a>
    </div>

    <div class="version-info">
        <span>PHP Version:</span> 8.0.0
        <span>Application Version:</span> 1.0.0
    </div>
</body>

</html>