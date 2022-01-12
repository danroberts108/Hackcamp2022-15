<?php
require_once("Models/Database.php");


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
        for ($i = 0; $i < count($riskArray); $i++) {
            setData($riskArray[$i]->getLat(), $riskArray[$i]->getLon(), $riskArray->getDistance(), $riskArray->getDistrict());
        }
    }

    public function showAllData() {
        $statement = $this->connect()->prepare('SELECT * FROM Risks');
        $statement->execute();

        echo "<table border='1'>";
        while ($row = $statement->fetch()) {
            echo "<tr><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td></tr>";
        }
        echo "</table";
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
}