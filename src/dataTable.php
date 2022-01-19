<?php

require_once("Models/Data.php");

$view = new stdClass();
$view->pageTitle = 'Register';

$data = new Data();
$dataset = $data->getAllExtendedRisks();

$view->dataset = $dataset;

require_once('Views/dataTable.phtml');
