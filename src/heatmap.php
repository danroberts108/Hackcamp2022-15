<?php
require_once("Models/Data.php");

$view = new stdClass();
$view->pageTitle = 'Register';

$data = new Data();

$risks = $data->getAllRisks();

$coordinates = [];
foreach($risks as $risk) {
    array_push($coordinates, $risk->getLat().", ".$risk->getLon());
}
//var_dump($coordinates);


require_once('Views/heatmap.phtml');
