<?php
require_once('Models/Database.php');
require('Models/Data.php');
require('Models/DataControl.php');

$view = new stdClass();
$view->pageTitle = 'Submit Data';

if (isset($_POST['submit'])) {
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];
    $distance = $_POST['distance'];
    $district = $_POST['district'];

    $data = new DataControl($latitude, $longitude, $distance, $district);

    $data->registerData();

    header('Location: index.php?error=none');

}

require_once('Views/submitdatatest.phtml');