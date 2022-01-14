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

    public function getCsvFromRisks($riskArray) {
        $risks = array();
        $risks[] = array("Latitude", "Longitude", "Distance (m)", "District");
        for ($i = 0; $i < count($riskArray); $i++) {
            $risk = $riskArray[$i];
            $risks[] = array($risk->getLat(), $risk->getLon(), $risk->getDistance(), $risk->getDistrict());
        }

        $filename = "risks" . date(DATE_ATOM);
        $filepath = tempnam(sys_get_temp_dir(), $filename);
        $fp = fopen($filepath, "w");
        foreach ($risks as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);

        header('Content-Description: File Transfer');
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename=' . $filename . '.csv');
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');
        header('Content-Length: ' . filesize($filepath));

        ob_clean();
        flush();
        readfile($filepath);

        unlink($fp);
    }
}