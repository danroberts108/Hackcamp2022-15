<?php
require_once("Models/Data.php");

class DataControl extends Data
{

    private $latitude, $longitude, $distance, $district;

    public function __construct($latitude,$longitude,$distance,$district)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->distance = $distance;
        $this->district = $district;
        var_dump($this->latitude, $this->longitude,$this->distance, $this->district);
    }

    public function registerData()
    {
        if ($this->emptyInput() == false) {
            header('Location: index.php?error=emptyinput');
            exit();
        }

        $this->setData($this->latitude, $this->longitude, $this->distance, $this->district);

    }

    private function emptyInput()
    {
        $result = true;
        if (empty($this->latitude) || empty($this->longitude) || empty($this->distance) || empty($this->district)) {
            $result = false;
        }
        return $result;
    }
}