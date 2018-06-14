<?php
//session_start();

require_once './helpers/JSonHelper.php';
/**
 * Description of WeatherInfo
 *
 * @author Lama
 */
class WeatherInfo {

    private $APPID = '9c398cd4cf22ab63cebf65a655f9d64d';
    private $dataToShow;
    private $city;
    
    public function __construct($city) {
        $this->city = $city;
        $this->dataToShow = $this->countDataToShow();
    }
    
    public function getWeatherInfo(){
        $url            = $this->buildURL();
        $response       = $this->tryToGetResponse($url);
        if ($response)
            $rawWeatherData = $this->getWeatherInfoFromJSonFile($response);
        else
            return null;
        return $rawWeatherData;
    }
        
    private function countDataToShow() {
        $hour = (new DateTime())->format('H');
        $recentResultsFromToday = 8 - (($hour-($hour%3))/3);
        $resultsPer5days = 5*8;
        return $recentResultsFromToday + $resultsPer5days - 1;
    }
    
    private function buildURL() {
        return 'http://api.openweathermap.org/data/2.5/forecast?APPID='.$this->APPID
                .'&q='.$this->city
                .'&units=metric'
                .'&cnt='.$this->dataToShow;
    }
    
    private function tryToGetResponse($url) {
        try {
            return $this->getFileContents($url);           
        } catch (Exception $e) {
            $_SESSION['e_json_response'] = 'Error: '.$e->getMessage();
            return null;
            exit();
        }
    }
    
    private function getFileContents($url) {
        $data = @file_get_contents($url);
        if ($data === FALSE) {
            //throw new Exception("Cannot access '$url' to read contents.");
            throw new Exception("City '$this->city' wasn't found. Try again.");
        } else {
            return $data;
        }
    }
    
    private function getWeatherInfoFromJSonFile($response) {
        $jsonHelper = new JSonHelper($response, $this->dataToShow);
        return $jsonHelper->process();
    }
}
