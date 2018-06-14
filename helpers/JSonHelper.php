<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once './helpers/Weather.php';
/**
 * Description of jsonHelper
 *
 * @author Lama
 */
class JSonHelper {
    //put your code here
    private $response;
    private $numberOfDataToShow;
    
    public function __construct($response, $x) {
        $this->response             = $response;
        $this->numberOfDataToShow   = $x;
    }
    
    public function process() {
        return $this->getWeatherDataFromJSon();
    }
    
    private function getWeatherDataFromJSon() {
        $jsonobj = json_decode($this->response);
        $weatherData = array();
        
        for( $x = 0; $x < $this->numberOfDataToShow; $x++ ) {
            $temporaryDate =        $jsonobj->list[$x]->dt_txt;
            $temporaryWeatherIcon = $jsonobj->list[$x]->weather[0]->icon;
            $temporaryTemp =        $jsonobj->list[$x]->main->temp;
            $temporaryWindSpeed =   $jsonobj->list[$x]->wind->speed;
            $temporaryPressure =    $jsonobj->list[$x]->main->pressure;

            $weather = new Weather(
                    $temporaryDate,
                    $temporaryWeatherIcon,
                    $temporaryTemp,
                    $temporaryWindSpeed,
                    $temporaryPressure
                    );

            array_push($weatherData, $weather);
        }
        return $weatherData;
    }
}
