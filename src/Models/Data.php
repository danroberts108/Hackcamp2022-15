<?php
require_once("Models/Database.php");
require_once("Models/Risk.php");
require_once("Models/ExtendedRisk.php");

class Data extends Database
{
    protected function setData($latitude, $longitude,$distance, $district) {
        $statement = $this->connect()->prepare('INSERT INTO Risks (latitude, longitude, distance, district) VALUES (?, ?, ?, ?);');

        if (!$statement->execute(array($latitude, $longitude, $distance, $district))) {
            $statement = null;
            header('Location: index.php?error=statementfailed');
            exit();
        }

        $statement = null;

    }

    public function addBulkData($riskArray) {
        for ($i = 1; $i < count($riskArray); $i++) {
            $risk = $riskArray[$i];
            $this->setData($risk->getLat(), $risk->getLon(), $risk->getDistance(), $risk->getDistrict());
        }
    }

    public function getAllRisks() {
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

    public function getAllExtendedRisks() {
        $riskArray = $this->getAllRisks();
        $result = [];

        for ($i = 0; $i < count($riskArray); $i++) {
            $risk = $riskArray[$i];
            $riskLevel = "Unknown";
            if ($risk->getDistance() >= 3) {
                $riskLevel = "Low";
            } else if($risk->getDistance() < 3 && $risk->getDistance() > 1) {
                $riskLevel = "Medium";
            } else if ($risk->getDistance() <= 1) {
                $riskLevel = "High";
            }
            $result[] = new ExtendedRisk($risk->getId(), $risk->getLat(), $risk->getLon(), $risk->getDistance(), $risk->getDistrict(), $riskLevel);
        }

        return $result;
    }

    public function getRiskFromDatabase($id):Risk {
        $statement = $this->connect()->prepare("SELECT * FROM Risks WHERE id=?");
        $statement->execute($id);

        $result = $statement->fetch();

        $risk = new Risk($result['lattitude'], $result['longitude'], $result['distance'], $result['district']);
        $risk->setId($result['id']);

        return $risk;
    }

    public function getRiskFromDatabaseWithLonLat($lon, $lat):Risk {
        $statement = $this->connect()->prepare("SELECT * FROM Risks WHERE longitude=? AND lattitude=?");
        $statement->execute(array($lon, $lat));

        $result = $statement->fetch();

        $risk = new Risk($result['lattitude'], $result['longitude'], $result['distance'], $result['district']);
        $risk->setId($result['id']);

        return $risk;
    }
    public function getNumberRisks() {
        if (isset($_POST[''])) {
            $statement = $this->connect()->prepare('SELECT COUNT FROM Risks');
            $statement->execute();
        }
    }

    //Could all these functions be combined into 1 with an argument?

    public function getRisks($district) {
        $statement = $this->connect()->prepare('SELECT COUNT(*) FROM Risks WHERE district=?');
        $statement->execute([$district]);
        return intval($statement->fetch());
    }

    public function getRisksDumfries() {
        $statement = $this->connect()->prepare('SELECT COUNT(*) FROM Risks WHERE district=?;');
        $statement->execute(["Dumfries"]);
        var_dump($statement->fetch());
        return intval($statement->fetch());
    }
    public function getRisksCentral() {
        $statement = $this->connect()->prepare('SELECT COUNT(*) FROM Risks WHERE district="Central & Fife"');
        $statement->execute();
        return intval($statement->fetch());
    }
    public function getRisksGlasgow() {
        $statement = $this->connect()->prepare('SELECT COUNT(*) FROM Risks WHERE district="Glasgow"');
        $statement->execute();
        return intval($statement->fetch());
    }
    public function getRisksLanark() {
        $statement = $this->connect()->prepare('SELECT COUNT(*) FROM Risks WHERE district="Lanarkshire"');
        $statement->execute();
        return intval($statement->fetch());
    }
    public function getRisksEdinburgh() {
        $statement = $this->connect()->prepare('SELECT COUNT(*) FROM Risks WHERE district="Edinburgh & Borders"');
        $statement->execute();
        return intval($statement->fetch());
    }
    public function getRisksAyshire() {
        $statement = $this->connect()->prepare('SELECT COUNT(*) FROM Risks WHERE district="Ayshire & Clyde South"');
        $statement->execute();
        return intval($statement->fetch());
    }
}