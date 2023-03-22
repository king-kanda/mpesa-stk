<?php

// header("Content-Type: application/json");
include 'db.php';

$response = '{
         "ResultCode": 0, 
         "ResultDesc": "Confirmation Received Successfully"
     } , ';

// DATA FROM MPESA
$mpesaResponse = file_get_contents('php://input');

// write to file
$log = fopen("filedb.json", "a") or die("Unable to open file!");
fwrite($log, $mpesaResponse);
fclose($log);

// log the response
// file_put_contents('log.txt', $mpesaResponse, FILE_APPEND);

// take data from filedb.json and place them into variable which will be used to insert into the database
$mpesaData = json_decode(file_get_contents('filedb.json'), true);

// // get individual values from the json response eg amount, phone number, etc
$amount = $mpesaData['Body']['stkCallback']['CallbackMetadata']['Item'][0]['Value'];
$mpesaReceiptNumber = $mpesaData['Body']['stkCallback']['CallbackMetadata']['Item'][1]['Value'];
$balance = 250;
$transactionDate = $mpesaData['Body']['stkCallback']['CallbackMetadata']['Item'][3]['Value'];
$phoneNumber = $mpesaData['Body']['stkCallback']['CallbackMetadata']['Item'][4]['Value'];

// insert into database
// create database tables
$sql = " CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL Primary Key AUTO_INCREMENT,
  `amount` varchar(50) NOT NULL,
  `mpesaReceiptNumber` varchar(50) NOT NULL unique,
  `balance` varchar(50) NOT NULL,
  `transactionDate` varchar(50) NOT NULL,
  `phoneNumber` varchar(50) NOT NULL
) ";

if (mysqli_query($conn, $sql)) {

    echo "Table transactions created successfully";
    $sql = "INSERT INTO `transactions`(`amount`, `mpesaReceiptNumber`, `balance`, `transactionDate`, `phoneNumber`) VALUES ('$amount', '$mpesaReceiptNumber', '$balance', '$transactionDate', '$phoneNumber')";
    $result = mysqli_query($conn, $sql);

    // validate if the data was inserted into the database
    if ($result) {
        echo $response;
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
} else {

    echo "Error creating table: " . mysqli_error($conn);
}

// close connection
mysqli_close($conn);
