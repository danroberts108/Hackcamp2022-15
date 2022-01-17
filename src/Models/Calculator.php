<?php

require_once("Models/Data.php");

class Calculator {

    protected $resources = 0, $district = '';
    protected Data $_data;

    public function __construct($resources, $district) {
        $this->resources = $resources;
        $this->district = $district;
        $this->_data = new Data();
    }

    public function calculate() {
        $risks = $this->_data->getRisks($this->district);

        if (!is_numeric($this->resources)) {
            return false;
        }

        return ceil($risks / $this->resources);
    }

}