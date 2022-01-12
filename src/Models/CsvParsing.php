<?php

require_once("Data.php");

class CsvParsing {

    public function getRiskFromCsv($file) {
        $data = array();
        if (($handle = fopen($file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $risk = new Risk($data[0], $data[1], $data[2], $data[3]);
                $data[] = $risk;
                //var_dump($data);

                //SQL statement to add line of data to table, and replace if it already exists


            }
        }
        return $data;
    }

    public function getCsvFromRisk($data) {

    }
}