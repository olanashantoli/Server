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

 
// Populate User email from JSON $obj array and store into $email.
$Email = $obj['email'];
 

 
 $Token = $obj['TOK'];

 
 // Creating SQL query and insert the record into MySQL database table.
$Sql_Query = "update  companies SET Token = '$Token'   WHERE Email='$Email'" ;
 
 
 if(mysqli_query($con,$Sql_Query)){
 
 // If the record inserted successfully then show the message.
$MSG = 'User Registered Successfully' ;
 
// Converting the message into JSON format.
$json = json_encode($MSG);
 
// Echo the message.
 echo $json ;
 
 }
 else{
 
$InvalidMSG = 'Invalid token' ;
  
 // Converting the message into JSON format.
 $InvalidMSGJSon = json_encode($InvalidMSG);
  
 // Echo the message.
  echo $InvalidMSGJSon ;
 
 }
 
 mysqli_close($con);
?>