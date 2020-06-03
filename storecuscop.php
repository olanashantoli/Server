<?php
 
// Importing DBConfig.php file.
include 'dbconfig.php';
 
// Creating connection.
$con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 
// Getting the received JSON into $json variable.
$json = file_get_contents('php://input');
 
// decoding the received JSON and store into $obj variable.
$obj = json_decode($json,true);
 
 // Populate User name from JSON $obj array and store into $name.
$latitude = $obj['latitude'];
 
// Populate User email from JSON $obj array and store into $email.
$longitude = $obj['longitude'];
 

$Email = $obj['Email'];

 // Creating SQL query and insert the record into MySQL database table.
$Sql_Query = "insert into order_form (LAT,LNG) values ('$latitude','$longitude') WHERE Email='$Email'";
 
 
 if(mysqli_query($con,$Sql_Query)){
 
 // If the record inserted successfully then show the message.
$MSG = 'vehicle Added Successfully' ;
 
// Converting the message into JSON format.
$json = json_encode($MSG);
 
// Echo the message.
 echo $json ;
 
 }
 else{
 
 echo 'Try Again';
 
 }
 
 mysqli_close($con);
?>