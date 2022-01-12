<?php

class Database
{

    public function connect() {
        try {
            $username = "hc22-15";
            $password = "ssf7cP0HNHKqMcBf";
            $databaseHandler = new PDO('mysql:host=poseidon.salford.ac.uk;dbname=hc22_15', $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            return $databaseHandler;
        }
        catch(PDOException $e) {
            print "Error!: " . $e->getMessage() . "</br>";
            die();
        }
    }



}