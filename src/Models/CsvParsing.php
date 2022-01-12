<?php
require_once("Models/Risk.php");
//require_once("Models/DataControl.php");
require_once("Models/Data.php");
require_once("Models/Database.php");

class CsvParsing {
    protected $dataObject;

    public function getRiskFromCsv($file) {
        $dataObject = new Data();
        $database = new Database();

        $data = array();
        if (($handle = fopen($file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $risk = new Risk($data[0], $data[1], $data[2], $data[3]);
                $data[] = $risk;
                //var_dump($data);
            }
        }
        return $data;
    }

    public function getCsvFromRisk($data) {

    }
}