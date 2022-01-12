<?php
//require_once('Models/Risks.php');
require_once('Models/CsvParsing.php');
require_once("Models/DataControl.php");
$view = new stdClass();
$view->pageTitle = 'Upload';
//$riskSet = new Risks();
$parse = new CsvParsing();
//$riskSet->testConnection();

//The form that lets the user upload a csv
if(isset($_POST['submit'])) {
    if(isset($_FILES['chosenFile'])) {
        try {
            $uploadDir = "../Uploads/";
            $uploadFile = $uploadDir.basename($_FILES['chosenFile']['name']);

            if(is_uploaded_file($_FILES['chosenFile']['tmp_name'])) { //if file was uploaded
                //echo "[OPENING CSV]";

                $data = array();
                if (($handle = fopen($_FILES['chosenFile']['tmp_name'], "r")) !== FALSE) {
                    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                        $risk = new Risk($data[0], $data[1], $data[2], $data[3]);
                        $data[] = $risk;
                        $dataControl = new DataControl($data[0],$data[1],$data[2],$data[3]);
                        //var_dump($data);

                        //$dataControl->setData($risk);


                    }
                }
            }
        }
        catch(Exception $e) {

        }
    }

}



require_once('Views/upload.phtml');
