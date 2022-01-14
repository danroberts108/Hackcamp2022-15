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
        if (is_numeric($this->resources) && $this->district = 'Dumfries') {
            $result = ceil($this->_data->getRisks("Dumfries") / $this->resources);
        }
        elseif (is_numeric($this->resources) && $this->district = 'Central & Fife') {
            $result = ceil($this->_data->getRisks("Central & Fife") / $this->resources);
        }
        elseif (is_numeric($this->resources) && $this->district = 'Glasgow') {
            $result = ceil($this->_data->getRisks("Glasgow") / $this->resources);
        }
        elseif (is_numeric($this->resources) && $this->district = 'Lanarkshire') {
            $result = ceil($this->_data->getRisks("Lanarkshire") / $this->resources);
        }
        elseif (is_numeric($this->resources) && $this->district = 'Edinburgh & Borders') {
            $result = ceil($this->_data->getRisks("Edinburgh & Borders") / $this->resources);
        }
        elseif (is_numeric($this->resources) && $this->district = 'Ayrshire & Clyde South') {
            $result = ceil($this->_data->getRisks("Ayshire & Clyde South") / $this->resources);
        }
        else {
            $result = false;
        }

        return $result;
    }

    /*public function calculate() {
        if (is_numeric($this->resources) && $this->district = 'Dumfries') {
            $result = ceil($this->getRisksDumfries() / $this->resources);
        }
        elseif (is_numeric($this->resources) && $this->district = 'Central & Fife') {
            $result = ceil($this->getRisksCentral() / $this->resources);
        }
        elseif (is_numeric($this->resources) && $this->district = 'Glasgow') {
            $result = ceil($this->getRisksGlasgow() / $this->resources);
        }
        elseif (is_numeric($this->resources) && $this->district = 'Lanarkshire') {
            $result = ceil($this->getRisksLanark() / $this->resources);
        }
        elseif (is_numeric($this->resources) && $this->district = 'Edinburgh & Borders') {
            $result = ceil($this->getRisksEdinburgh() / $this->resources);
        }
        elseif (is_numeric($this->resources) && $this->district = 'Ayrshire & Clyde South') {
            $result = ceil($this->getRisksAyshire() / $this->resources);
        }
        else {
            $result = false;
        }
        return $result;
    }*/
}