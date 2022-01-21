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
        if ($this->district == "*") {
            switch ($this->type) {
                case "high":
                    $risks = $this->_data->getAllHighRisksNum();
                    break;
                case "medium":
                    $risks = $this->_data->getAllMedRisksNum();
                    break;
                case "low":
                    $risks = $this->_data->getAllLowRisksNum();
                    break;
                case "*":
                    $risks = $this->_data->getAllRisksNum();
                    break;
            }
        } else {
            $risks = $this->_data->getRisksType($this->district, $this->type);
        }

        if (!is_numeric($this->resources)) {
            return false;
        }

        return ceil($risks / $this->resources);
    }

}