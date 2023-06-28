<!DOCTYPE html>
<html>

<head>
    <title>Oops! Something went wrong...</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
            flex-direction: column;
        }

        .container {
            max-width: 400px;
            padding: 40px;
            text-align: center;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333333;
            font-size: 28px;
            margin-bottom: 30px;
        }

        p {
            color: #666666;
            font-size: 18px;
            margin-bottom: 20px;
        }

        a {
            color: #337ab7;
            text-decoration: none;
        }

        .myapp {
            text-align: center;
            margin-top: 40px;
        }
    </style>
</head>

<body>
    {{ IGIS_CONTENT }}
</body>

</html>