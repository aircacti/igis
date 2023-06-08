<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/images/favicon.ico">
    <title>{{ echo 'asdasd'; }}</title>
</head>

<body>

    <p> {{ print_r($request->language); }} </p>
    <p>Ble ble ble {{ echo 'test'; }}</p>
    <p>{{ translate($request->language, 'Welcome'); }} </p>

</body>

</html>