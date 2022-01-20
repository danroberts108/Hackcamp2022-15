<?php
require('Models/Database.php');
require('Models/Data.php');
require('Models/Calculator.php');
require('Models/Chart.php');

$view = new stdClass();
$view->pageTitle = 'Risk Charts';
$view->data = new Data();
$view->pageTitle = "Risk Charts";


//chart object is called from piecharts.phtml which runs the calculateChart($district) method
$view->chart = new Chart();
//Default values for sizes (in %) of the pie chart segments for global chart
//These will be changed with each iteration of the for loop within the view
$values = $view->chart->calculateChart("global");
$view->highRisk = $values[0]["COUNT(*)"];
$view->medRisk = $values[1]["COUNT(*)"];
$view->lowRisk = $values[2]["COUNT(*)"];


$view->districtNames = array("Dumfries",
                            "Central & Fife",
                            "Glasgow",
                            "Lanarkshire",
                            "Edinburgh & Borders",
                            "Ayrshire & Clyde South" );

$view->districts = $view->chart->getDistricts($view->districtNames);

//array items referenced as $risk in .phtml
$view->risks = array("high","med","low");

require_once('Views/piecharts.phtml');
