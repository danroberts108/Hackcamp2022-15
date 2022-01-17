<?php
require_once("Data.php");


class Chart
{
    private $data;
    public function __construct() {
        $this->data = new Data();
    }


    public function calculateChart() {
        $values = $this->data->getSeparateRisks('global');
        //echo "[NEXT CHART]";
        //var_dump($values);
        return ($values);
    }

    public function getDistricts($names) {
        $districts = [];
        foreach($names as $name) {
            $values = $this->data->getSeparateRisks($name);
            array_push($districts, new District($name,$values));
        }

        return $districts;
    }
}