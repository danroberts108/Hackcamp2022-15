<?php
require_once("Models/DataControl.php");
require_once("Models/Risk.php");
require_once("Models/CsvParsing.php");
$view = new stdClass();
$view->pageTitle = 'Upload';
$parse = new CsvParsing();

//The form that lets the user upload a csv
if(isset($_POST['submit'])) {
    if(isset($_FILES['chosenFile'])) {
        try {
            $uploadDir = "../Uploads/";
            $uploadFile = $uploadDir.basename($_FILES['chosenFile']['name']);

            if(is_uploaded_file($_FILES['chosenFile']['tmp_name'])) { //if file was uploaded
                //echo "[OPENING CSV]";

                $dataArray = $parse->getRiskFromCsv($_FILES['chosenFile']['tmp_name']);
            }
        }
        catch(Exception $e) {

        }
    }

}



require_once('Views/upload.phtml');
