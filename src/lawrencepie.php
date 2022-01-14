<?php require('Models/Database.php');
require('Models/Data.php');

$view = new stdClass();
$view->pageTitle = 'Pie';

//Percentages of the pie chart segments
$view->highRisk = 67.5;
$view->medRisk = 12.5;
$view->lowRisk = 20;

require_once('Views/lawrencepie.phtml');
