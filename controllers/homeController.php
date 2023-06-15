<?php
function show($content_path, $layout_path)
{
    require(PATH . '/app/renderEngine.php');
    $renderEngine = renderEngine::getInstance();

    require_once(PATH . '/settings/config.php');
    $config = config::getInstance();

    require_once(PATH . '/app/mailManager.php');
    $mailManager = mailManager::getInstance();

    // Calculate time
    $discoveryOfAmerica = new DateTime('1492-10-12');
    $discoveryOfThisSite = new DateTime();
    $intervalOfGreatEvents = $discoveryOfAmerica->diff($discoveryOfThisSite);
    $intervalOfGreatEvents = $intervalOfGreatEvents->format('%y years, %m months, %d days, %h hours, %i minutes, %s seconds');

    // Get weather
    $temperature = getTemperature();
    if (!$temperature) {
        $temperature = "(API Error)";
    }

    $customVariables = [
        'url' => $config->getPrefixedUrl(),
        'pageTitle' => "Welcome page!",
        'intervalOfGreatEvents' => $intervalOfGreatEvents,
        'temperature' => $temperature
    ];

    // $mailManager->sendEmail(
    //     [
    //         'sender' => 'a@a.pl',
    //         'sender_display' => 'a a',

    //         'recipient' => 'b@b.pl',
    //         'recipient_display' => 'b b',

    //         'subject' => 'c',

    //         'body' => '<h1>D</h1>',
    //         'alt_body' => 'E'
    //     ]
    // );


    return $renderEngine->render($content_path, $layout_path, $customVariables);
}

function getTemperature()
{
    $url = "https://api.open-meteo.com/v1/forecast?latitude=24.05&longitude=-74.49&hourly=temperature_2m&forecast_days=1";
    $json = file_get_contents($url);
    $data = json_decode($json, true);
    if ($data == null) {
        return false;
    }

    $currentDateTime = date('Y-m-d\TH:00');
    $index = array_search($currentDateTime, $data['hourly']['time']);

    return $data['hourly']['temperature_2m'][$index];
}
