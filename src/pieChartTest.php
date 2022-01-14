<?php

//require_once("Models/DataControl.php");
//require_once("Models/Risk.php");
//require_once("Models/CsvParsing.php");

$view = new stdClass();
$view->pageTitle = 'Pie Chart';

$view->highRiskPercentage = 67.5;
$view->medRiskPercentage = 12.5;
$view->lowRiskPercentage = 20;


require_once("Views/pieChartTest.phtml");
