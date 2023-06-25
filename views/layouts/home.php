<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ echo $pageTitle; }} | IGIS</title>
</head>

<body>

    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col-12 text-center">
                <h1>IGIS</h1>

            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <hr>
            </div>
        </div>
    </div>

    {{ IGIS_CONTENT }}

    <link href="{{ echo $url; }}/resources/libraries/css/bootstrap.min.css" rel="stylesheet">
    <script src="{{ echo $url; }}/resources/libraries/js/bootstrap.bundle.min.js"></script>
</body>

</html>