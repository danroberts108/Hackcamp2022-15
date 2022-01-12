<?php


class CsvParsing extends Risk {
    public function getRiskFromCsv($file) {
        $data = array();
        if (($handle = fopen($file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $risk = new Risk($data[0], $data[1], $data[2], $data[3]);
                $data[] = $risk;
            }
        }
        return $data;
    }

    public function getCsvFromRisk($data) {

    }
}