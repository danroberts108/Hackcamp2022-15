<?php
require('Models/Database.php');
require('Models/Data.php');
require('Models/Calculator.php');

$view = new stdClass();
$view->pageTitle = 'Risk Calculator';

if(isset($_POST['submit'])) {
    $calculator = new Calculator($_POST['resources'],$_POST['district'], $_POST['type']);
    $result = $calculator->calculate();
    if (!$result) {
        $view->result = 'not a valid number or district.';
    }
    else {
        $view->result = $result . ' days.';
    }
}
require_once('Views/calculator.phtml');
