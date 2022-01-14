<?php
require_once("Data.php");


class Chart
{
    private $data;
    public function __construct() {
        $this->data = new Data();
    }


    public function calculateChart($district) {
        //this function will be called from lawrencepie.phtml
        //it gets the percentage of each type of risk to be returned as an array to lawrencepie.phtml

        $values = $this->data->getSeparateRisks($district);
        //echo "[NEXT CHART]";
        //var_dump($values);
        return($values);
    }


    public function getAllRisks()
    {
        $statement = $this->connect()->prepare("SELECT * FROM Risks");
        $statement->execute();

        $result = [];
        while ($row = $statement->fetch()) {
            $risk = new Risk($row['latitude'], $row['longitude'], $row['distance'], $row['district']);
            $risk->setId($row['id']);
            $result[] = $risk;
        }

        return $result;
    }
}