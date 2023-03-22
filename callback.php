<?php
// header("Content-Type: application/json");

$response = '{
         "ResultCode": 0, 
         "ResultDesc": "Confirmation Received Successfully"
     } , ';

// DATA

$mpesaResponse = file_get_contents('php://input');


// write to file
$log = fopen("filedb.json", "a") or die("Unable to open file!");
fwrite($log, $mpesaResponse);
// fwrite($log, $response);
fclose($log);

// echo $response;
