<?php
require_once("Models/Database.php");
require_once("Models/Risk.php");
require_once("Models/ExtendedRisk.php");

class Data
{
    private $_db;

    public function __construct() {
        $this->_db = Database::connect();
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
            $result[] = $risk;
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

    public function getRiskFromDatabase($id): Risk
    {
        $statement = $this->_db->prepare("SELECT * FROM Risks WHERE id=?");
        $statement->execute($id);

        $result = $statement->fetch();

        $risk = new Risk($result['lattitude'], $result['longitude'], $result['distance'], $result['district']);
        $risk->setId($result['id']);

        return $risk;
    }

    public function getRiskFromDatabaseWithLonLat($lon, $lat): Risk
    {
        $statement = $this->_db->prepare("SELECT * FROM Risks WHERE longitude=? AND lattitude=?");
        $statement->execute(array($lon, $lat));

        $result = $statement->fetch();

        $risk = new Risk($result['lattitude'], $result['longitude'], $result['distance'], $result['district']);
        $risk->setId($result['id']);

        return $risk;
    }

    public function getNumberRisks()
    {
        //Shouldn't be testing for post values in the class itself - should be before the function is run
        if (isset($_POST[''])) {
            $statement = $this->_db->prepare('SELECT COUNT FROM Risks');
            $statement->execute();
        }
    }

    public function getRisks($district): int
    {
        $statement = $this->_db->prepare('SELECT COUNT(*) FROM Risks WHERE district=?');
        $statement->execute([$district]);
        var_dump($statement->fetch());
        return intval($statement->fetch());
    }
}