<?php
require('Models/Database.php');
require('Models/Data.php');
require('Models/Calculator.php');

$view = new stdClass();
$view->pageTitle = 'Calculator';

if(isset($_POST['submit'])) {
    $calculator = new Calculator($_POST['resources'],$_POST['district']);
    $result = $calculator->calculate();
    if (!$result) {
        $view->result = 'not a valid number.';
    }
    else {
        $view->result = 'the answer is ' . $result . ' days.';
    }
}
require_once('Views/calculator.phtml');
