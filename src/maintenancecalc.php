<?php

$view = new stdClass();
$view->pageTitle = 'Maintenance Calculator';

if(isset($_POST['calculate'])) {
    $num = $_POST['risks'] / $_POST['resources'];
    $days = ceil($num);
    $view->maintenanceResult = $days;
}

require_once('Views/maintenancecalc.phtml');
