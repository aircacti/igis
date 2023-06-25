<?php

namespace Model;

use \DB;
use App\exceptionManager;
use Exception;

class countriesModel
{

    public function getAllCountries()
    {

        // Get errors manager
        $exceptionManager = exceptionManager::getInstance();

        try {
            return DB::query("SELECT * FROM countriesmodel");
        } catch (Exception $e) {
            $exceptionManager->throw(5001, 'Error in query :' . $e);
            die;
        }
    }

    public function getCountry($country_name)
    {
        // Get errors manager
        $exceptionManager = exceptionManager::getInstance();

        try {
            return DB::queryFirstRow("SELECT * FROM countriesmodel WHERE country_name = '{$country_name}'");
        } catch (Exception $e) {
            $exceptionManager->throw(5002, 'Error in query get country :' . $e);
            die;
        }
    }

    public function getCountryPopulation($country_name)
    {
        // Get errors manager
        $exceptionManager = exceptionManager::getInstance();

        try {
            $country = $this->getCountry($country_name);
            return $country['country_population'];
        } catch (Exception $e) {
            $exceptionManager->throw(5003, 'Error in query get country population :' . $e);
        }
    }
}
