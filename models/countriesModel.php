<?php

namespace Models;

use \DB;

class countriesModel {

    public function getAllCountries() {
        return DB::query("SELECT * FROM countriesmodel");
    }

    public function getCountry($country_name) {
        return DB::queryFirstRow("SELECT * FROM countriesmodel WHERE country_name = '{$country_name}'");
    }

    public function getCountryPopulation($country_name) {
        $country = $this->getCountry($country_name);
        return $country['country_population'];
    }

}