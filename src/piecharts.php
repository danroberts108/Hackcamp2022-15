<?php
require('Models/Database.php');
require('Models/Data.php');
require('Models/Calculator.php');
require('Models/Chart.php');

$view = new stdClass();
$view->pageTitle = 'Pie';

//Default values for sizes (in %) of the pie chart segments for global chart
//These will be changed with each iteration of the for loop within the view
$view->highRisk = 67.5;
$view->medRisk = 12.5;
$view->lowRisk = 20;

$view->districts = array("Dumfries",
                        "Central & Fife",
                        "Glasgow",
                        "Lanarkshire",
                        "Edinburgh & Borders",
                        "Ayrshire & Clyde South" );

//chart object is called from piecharts.phtml which runs the getSeperateRisks method
$view->chart = new Chart();

require_once('Views/piecharts.phtml');
