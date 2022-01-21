<?php
require_once("Models/Database.php");
require_once("Models/Risk.php");
require_once("Models/ExtendedRisk.php");
require_once("Models/CsvParsing.php");
require_once("Models/District.php");

final class Data
{
    protected $_db, $_dbInstance, $csvParse;

    public function __construct() {
        $this->_dbInstance = Database::getInstance();
        $this->_db = $this->_dbInstance->getdbConnection();
        $this->csvParse = new CsvParsing();
    }

    protected function setData($latitude, $longitude, $distance, $district)
    {
        $statement = $this->_db->prepare('INSERT INTO Risks (latitude, longitude, distance, district) VALUES (?, ?, ?, ?);');

        if (!$statement->execute(array($latitude, $longitude, $distance, $district))) {
            $statement = null;
            header('Location: index.php?error=statementfailed');
            exit();
        }

        $statement = null;

    }

    public function addBulkData($riskArray)
    {
        $statement = $this->_db->prepare("DELETE * FROM Risks");
        $statement->execute();
        for ($i = 1; $i < count($riskArray); $i++) {
            $risk = $riskArray[$i];
            $this->setData($risk->getLat(), $risk->getLon(), $risk->getDistance(), $risk->getDistrict());
        }
    }

    public function getAllRisks()
    {
        $statement = $this->_db->prepare("SELECT * FROM Risks");
        $statement->execute();

        $result = [];
        while ($row = $statement->fetch()) {
            $risk = new Risk($row['latitude'], $row['longitude'], $row['distance'], $row['district']);
            $risk->setId($row['id']);
            array_push($result, $risk);
        }

        return $result;
    }

    public function getAllExtendedRisks()
    {
        $riskArray = $this->getAllRisks();
        $result = [];

        for ($i = 0; $i < count($riskArray); $i++) {
            $risk = $riskArray[$i];
            $riskLevel = "Unknown";
            if ($risk->getDistance() >= 3) {
                $riskLevel = "Low";
            } else if ($risk->getDistance() < 3 && $risk->getDistance() > 1) {
                $riskLevel = "Medium";
            } else if ($risk->getDistance() <= 1) {
                $riskLevel = "High";
            }
            $result[] = new ExtendedRisk($risk->getId(), $risk->getLat(), $risk->getLon(), $risk->getDistance(), $risk->getDistrict(), $riskLevel);
        }

        return $result;
    }

    //Returns the number of records (risks) for the specified district
    public function getRisks($district): int
    {
        $statement = $this->_db->prepare('SELECT COUNT(*) FROM Risks WHERE district=?');
        $statement->bindParam(1, $district);
        $statement->execute();
        $result = $statement->fetch();
        return $result['COUNT(*)'];
    }

    public function getRisksType($district, $type) {
        switch ($type) {
            case "high":
                $statement = $this->_db->prepare("SELECT COUNT(*) FROM Risks WHERE district=? AND distance<=1");
                $statement->execute(array($district));
                break;
            case "medium":
                $statement = $this->_db->prepare("SELECT COUNT(*) FROM Risks WHERE district=? AND distance>1 AND distance<3");
                $statement->execute(array($district));
                break;
            case "low":
                $statement = $this->_db->prepare("SELECT COUNT(*) FROM Risks WHERE district=? AND distance>=3");
                $statement->execute(array($district));
                break;
            case "*":
                $statement = $this->_db->prepare("SELECT COUNT(*) FROM Risks WHERE district=?");
                $statement->execute(array($district));
                break;
        }
        $result = $statement->fetch();
        return $result['COUNT(*)'];
    }

    //Used to construct the pie charts by getting the percentages of risks for the specified district
    public function getSeparateRisks($district)
    {
        if($district=='global'){
            //High Risk
            $statement = $this->_db->prepare("SELECT COUNT(*) FROM Risks where distance<=1");
            $statement->execute();
            $highResult = $statement->fetch();

            //Medium Risk
            $statement = $this->_db->prepare("SELECT COUNT(*) FROM Risks where distance<3 AND distance>1");
            $statement->execute();
            $medResult = $statement->fetch();

            //Low Risk
            $statement = $this->_db->prepare("SELECT COUNT(*) FROM Risks where distance>=3");
            $statement->execute();
            $lowResult = $statement->fetch();
        }

        else {

            //High Risk
            $statement = $this->_db->prepare("SELECT COUNT(*) FROM Risks where distance<=1 AND district =?");
            $statement->execute([$district]);
            $highResult = $statement->fetch();

            //Medium Risk
            $statement = $this->_db->prepare("SELECT COUNT(*) FROM Risks where distance<3 AND distance>1 AND district =?");
            $statement->execute([$district]);
            $medResult = $statement->fetch();

            //Low Risk
            $statement = $this->_db->prepare("SELECT COUNT(*) FROM Risks where distance>=3 AND district =?");
            $statement->execute([$district]);
            $lowResult = $statement->fetch();
        }
        $values = array($highResult,
            $medResult,
            $lowResult);

        //var_dump($values);

        return $values;
    }

    public function getAllHighRisksNum() {
        //High Risk
        $statement = $this->_db->prepare("SELECT COUNT(*) FROM Risks where distance<=1");
        $statement->execute();
        $highResult = $statement->fetch();
        return $highResult['COUNT(*)'];
    }

    public function getAllMedRisksNum() {
        //Medium Risk
        $statement = $this->_db->prepare("SELECT COUNT(*) FROM Risks where distance<=3 AND distance>1");
        $statement->execute();
        $medResult = $statement->fetch();
        return $medResult['COUNT(*)'];
    }

    public function getAllLowRisksNum() {
        //Low Risk
        $statement = $this->_db->prepare("SELECT COUNT(*) FROM Risks where distance>=3");
        $statement->execute();
        $lowResult = $statement->fetch();
        return $lowResult['COUNT(*)'];
    }

    public function getAllRisksNum()
    {
        //Low Risk
        $statement = $this->_db->prepare("SELECT COUNT(*) FROM Risks");
        $statement->execute();
        $allResult = $statement->fetch();
        return $allResult['COUNT(*)'];
    }

    public function getRisksDatabaseCsv() {
        $statement = $this->_db->prepare('SELECT latitude, longitude, distance, district FROM Risks');
        $statement->execute();
        $risks = [];
        while($row = $statement->fetch()) {
            $risk = new Risk($row['latitude'], $row['longitude'], $row['distance'], $row['district']);
            $risks[] = $risk;
        }

        $this->csvParse->getCsvFromRisks($risks);
    }
}