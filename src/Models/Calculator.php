<?php

require_once("Models/Data.php");

class Calculator {

    protected $resources = 0, $district = '';
    protected Data $_data;

    public function __construct($resources, $district, $type) {
        $this->resources = $resources;
        $this->district = $district;
        $this->type = $type;
        $this->_data = new Data();
    }

    public function calculate() {
        $risks = $this->_data->getRisksType($this->district, $this->type);


        if (!is_numeric($this->resources)) {
            return false;
        }

        return ceil($risks / $this->resources);
    }

}