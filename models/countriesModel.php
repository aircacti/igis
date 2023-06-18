<?php

namespace Models;

use \DB;
use App\errorsManager;
use Exception;
use MeekroDBException;

class countriesModel {

    public function getAllCountries() {

        // Get errors manager
        $errorsManager = errorsManager::getInstance();

        try {
            return DB::query("SELECT * FROM countriesmodel");
        } catch(Exception $e) {
            $errorsManager->throw(60, 'Error in query :' . $e);
            die;
        }
    }

    public function getCountry($country_name) {
        // Get errors manager
        $errorsManager = errorsManager::getInstance();

        try {
            return DB::queryFirstRow("SELECT * FROM countriesmodel WHERE country_name = '{$country_name}'");
        } catch (Exception $e) {
            $errorsManager->throw(61, 'Error in query get country :' . $e);
            die;
        }
        
    }

    public function getCountryPopulation($country_name) {
        // Get errors manager
        $errorsManager = errorsManager::getInstance();

        try {
            $country = $this->getCountry($country_name);
            return $country['country_population'];
        } catch (Exception $e) {
            $errorsManager->throw(62, 'Error in query get country population :' . $e);
        }

    }

}