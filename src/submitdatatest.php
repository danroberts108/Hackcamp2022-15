<?php require('src/Models/Database.php');
require('src/Models/Data.php');
require('src/Models/DataControl.php');

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

require_once('src/Views/submitdatatest.phtml');