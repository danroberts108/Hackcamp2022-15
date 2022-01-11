<?php

class Database
{
    protected static $_dbInstance = null;  //static instance
    protected $_dbHandle;

    public static function getInstance() {
        $username ='hc22-15';
        $password = 'sf7cP0HNHKqMcBf';
        $host = 'helios.csesalford.com'; $dbName = 'sgs564';
        if(self::$_dbInstance === null) { //checks if the PDO exists
            //creates new single instance if not, sending in connection info
            self::$_dbInstance = new self($username, $password, $host, $dbName);
        }
        return self::$_dbInstance;
    }

    private function __construct($username, $password, $host, $database) {
        try {
            $this->_dbHandle = new PDO("mysql:host=$host;dbname=$database",$username,$password);
        // creates the database handle with connection info
        }
        catch (PDOException $e) { // catch any failure to connect to the database
            echo $e->getMessage();
        }
    }

    public function getdbConnection() {
        return $this->_dbHandle; // returns the PDO handle to be used elsewhere
    }

    public function __destruct() {
        $this->_dbHandle = null; // destroys the PDO handle when no longer needed
    }
}