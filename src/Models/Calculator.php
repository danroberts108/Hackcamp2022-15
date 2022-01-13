<?php

class Calculator extends Data {

    var $resources = 0, $district = '';

    public function __construct($resources, $district) {
        $this->resources = $resources;
        $this->district = $district;

    }

    public function calculate() {
        if (is_numeric($this->resources) && $this->district = 'Dumfries') {
            $result = $this->getRisks("Dumfries") / $this->resources;
        }
        elseif (is_numeric($this->resources) && $this->district = 'Central & Fife') {
            $result = $this->getRisks("Central") / $this->resources;
        }
        elseif (is_numeric($this->resources) && $this->district = 'Glasgow') {
            $result = $this->getRisks("Glasgow") / $this->resources;
        }
        elseif (is_numeric($this->resources) && $this->district = 'Lanarkshire') {
            $result = $this->getRisks("Lanark") / $this->resources;
        }
        elseif (is_numeric($this->resources) && $this->district = 'Edinburgh & Borders') {
            $result = $this->getRisks("Edinburgh") / $this->resources;
        }
        elseif (is_numeric($this->resources) && $this->district = 'Ayrshire & Clyde South') {
            $result = $this->getRisks("Ayshire") / $this->resources;
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