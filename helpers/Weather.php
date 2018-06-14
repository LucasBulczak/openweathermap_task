<?php
/**
 * Description of weather
 *
 * @author Lama
 */
class Weather {
    //put your code here
    
    private $date;    
    private $weatherIcon;
    private $temp;
    private $windSpeed;
    private $pressure;
     
    public function __construct($date, $weatherIcon, $temp, $windSpeed, $pressure) {
        $this->date         = $date;
        $this->weatherIcon  = $weatherIcon;
        $this->temp         = $temp;
        $this->windSpeed    = $windSpeed;
        $this->pressure     = $pressure;
    }

    public function __toString() {
        return '<div class="weather_item">'
                    .'<div class="small_val" title="Date">'     .$this->date.'</div>'
                    .'<img src="//openweathermap.org/img/w/'    .$this->weatherIcon.'.png">'
                    .'<div class="small_val" title="Temp">'     .$this->temp.' °C</div>'
                    .'<div class="small_val" title="Wind">'     .$this->windSpeed.' m/s</div>'
                    .'<div class="small_val" title="Pressure">' .$this->pressure.' hpa</div>'
                .'</div>';
    }
    
    public function getDate() {
        return $this->date;
    }
}
