<?php

require_once("Models/Data.php");

$view = new stdClass();

if (isset($_POST['submit'])) {
    $data = new Data();
    $data->getRisksDatabaseCsv();
}

require_once('Views/exportcsv.phtml');
