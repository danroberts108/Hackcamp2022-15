<?php

class District
{
    private $name, $highCount, $medCount, $lowCount;

    public function __construct($name, $values) {
        $this->name = $name;
        $this->highCount = $values[0]['COUNT(*)'];
        $this->medCount = $values[1]['COUNT(*)'];
        $this->lowCount= $values[2]['COUNT(*)'];
    }

    public function getName() {
        return $this->name;
    }

    public function getHigh() {
        return $this->highCount;
    }

    public function getMed() {
        return $this->medCount;
    }

    public function getLow() {
        return $this->lowCount;
    }

}