<?php
require('Models/Database.php');
require('Models/Data.php');
require('Models/Calculator.php');
require('Models/Chart.php');

$view = new stdClass();
$view->pageTitle = 'Pie';

//chart object is called from piecharts.phtml which runs the calculateChart($district) method
$view->chart = new Chart();
//Default values for sizes (in %) of the pie chart segments for global chart
//These will be changed with each iteration of the for loop within the view
$values = $view->chart->calculateChart("global");
$view->highRisk = $values[0]["COUNT(*)"];
$view->medRisk = $values[1]["COUNT(*)"];
$view->lowRisk = $values[2]["COUNT(*)"];

//array items referenced as $district in .phtml
$view->districts = array("Dumfries",
                        "Central & Fife",
                        "Glasgow",
                        "Lanarkshire",
                        "Edinburgh & Borders",
                        "Ayrshire & Clyde South" );

//chart object is called from piecharts.phtml which runs the calculateChart($district) method
$view->chart2 = new Chart();
//Default values for sizes (in %) of the pie chart segments for global chart
//These will be changed with each iteration of the for loop within the view
$values2 = $view->chart2->calculateChart2("all");
$view->dumfries = $values2[0]["COUNT(*)"];
$view->central = $values2[1]["COUNT(*)"];
$view->glasgow = $values2[2]["COUNT(*)"];
$view->lanarkshire = $values2[3]["COUNT(*)"];
$view->edinburgh = $values2[4]["COUNT(*)"];
$view->ayrshire = $values2[5]["COUNT(*)"];
//array items referenced as $risk in .phtml
$view->risks = array("dumfries", "central", "glasgow", "lanarkshire", "edinburgh", "ayrshire");

require_once('Views/piecharts.phtml');
