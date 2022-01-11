<?php

class Database
{

    public function connect() {
        try {
            $username = "";
            $password = "";
            $databaseHandler = new PDO('mysql:host=poseidon.salford.ac.uk;dbname=*dbname*', $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            return $databaseHandler;
        }
        catch(PDOException $e) {
            print "Error!: " . $e->getMessage() . "</br>";
            die();
        }
    }



}