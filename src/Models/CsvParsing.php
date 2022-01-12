<?php

require_once("Data.php");

class CsvParsing {

    public function getRiskFromCsv($file) {
        $result = [];
        if (($handle = fopen($file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $result[] = new Risk($data[0], $data[1], $data[2], $data[3]);
                //var_dump($data);

                //SQL statement to add line of data to table, and replace if it already exists


            }
        }
        $dataClass = new Data();
        $dataClass->addBulkData($result);
        return $result;
    }

    public function getCsvFromRisk($data) {

    }
}