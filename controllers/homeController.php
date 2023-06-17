<?php

namespace Controllers;

use App\renderEngine;
use Settings\config;
use App\mailManager;
use App\modelsManager;

class homeController
{

    public function show($content_path, $layout_path)
    {

        // Get render engine
        $renderEngine = renderEngine::getInstance();

        // Get config settings
        $config = config::getInstance();

        // Get mail manager
        $mailManager = mailManager::getInstance();

        // Get models manager
        $modelsManager = modelsManager::getInstance();

        // Calculate time
        $discoveryOfAmerica = new \DateTime('1492-10-12');
        $discoveryOfThisSite = new \DateTime();
        $intervalOfGreatEvents = $discoveryOfAmerica->diff($discoveryOfThisSite);
        $intervalOfGreatEvents = $intervalOfGreatEvents->format('%y years, %m months, %d days, %h hours, %i minutes, %s seconds');

        // Get weather
        $temperature = $this->getTemperature();
        if (!$temperature) {
            $temperature = "(API Error)";
        }


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

        // Get country model
        $countriesModel = $modelsManager->getModel('countriesModel');

        $customVariables = [
            'url' => $config->getPrefixedUrl(),
            'pageTitle' => "Welcome page!",
            'intervalOfGreatEvents' => $intervalOfGreatEvents,
            'temperature' => $temperature,
            'bahamasPopulation' => $countriesModel->getCountryPopulation('USA')
        ];

        // Return compiled view
        return $renderEngine->render($content_path, $layout_path, $customVariables);
    }

    private function getTemperature()
    {
        // API URL for retrieving temperature data
        $url = "https://api.open-meteo.com/v1/forecast?latitude=24.05&longitude=-74.49&hourly=temperature_2m&forecast_days=1";

        // Retrieve JSON data from the API URL
        $json = file_get_contents($url);

        // Decode the JSON data into an associative array
        $data = json_decode($json, true);

        // Check if the data is successfully decoded
        if ($data == null) {
            return false;
        }

        // Get the current date and time in the required format
        $currentDateTime = date('Y-m-d\TH:00');

        // Find the index of the current date and time in the time array
        $index = array_search($currentDateTime, $data['hourly']['time']);

        // Return the temperature value for the corresponding index
        return $data['hourly']['temperature_2m'][$index];
    }


    // *****************************************
    //           Singleton declaration
    // *****************************************
    // *****************************************


    private static $instance;

    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new homeController();
        }
        return self::$instance;
    }
}
