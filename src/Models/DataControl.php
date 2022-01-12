<?php

class DataControl extends Data
{

    private $latitude, $longitude, $distance, $district;

    public function __construct($latitude, $longitude, $distance, $district)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->distance = $distance;
        $this->district = $district;
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

    /**
     * @return mixed
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * @param mixed $latitude
     */
    public function setLatitude($latitude): void
    {
        $this->latitude = $latitude;
    }

    /**
     * @return mixed
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * @param mixed $longitude
     */
    public function setLongitude($longitude): void
    {
        $this->longitude = $longitude;
    }

    /**
     * @return mixed
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * @param mixed $distance
     */
    public function setDistance($distance): void
    {
        $this->distance = $distance;
    }

    /**
     * @return mixed
     */
    public function getDistrict()
    {
        return $this->district;
    }

    /**
     * @param mixed $district
     */
    public function setDistrict($district): void
    {
        $this->district = $district;
    }
}