<?php

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
    public function showAllData() {
        $statement = $this->connect()->prepare('SELECT * FROM Risks');
        $statement->execute();

        echo "<table border='1'>";
        while ($row = $statement->fetch()) {
            echo "<tr><td>" . $row[1] . "</td><td>" . $row[2] . "</td><td>" . $row[3] . "</td><td>" . $row[4] . "</td></tr>";
        }
        echo "</table";
    }
}