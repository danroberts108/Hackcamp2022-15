<?php
require_once("Models/Data.php");

$view = new stdClass();
$view->pageTitle = 'Map';

$data = new Data();

$risks = $data->getAllRisks();

$view->coordinates = [];
foreach($risks as $risk) {
    $view->coordinates[] = array($risk->getLat(), $risk->getLon());
}
//var_dump($coordinates);


require_once('Views/heatmap.phtml');
