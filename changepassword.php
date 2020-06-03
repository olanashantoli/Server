<?php
 
// Importing DBConfig.php file.
include 'dbconfig.php';
 
// Creating connection.
$con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
 
// Getting the received JSON into $json variable.
$json = file_get_contents('php://input');
 
// decoding the received JSON and store into $obj variable.
$obj = json_decode($json,true);
 

// Populate User email from JSON $obj array and store into $email.
$AdminID = $obj['adminID'];
 
// Populate Password from JSON $obj array and store into $password.
$Password = $obj['password'];
 
//$HPassword = password_hash ("Password",PASSWORD_DEFAULT);
$Email = $obj['email'];

//Checking Email is already exist or not using SQL query.
$CheckSQL = "SELECT * FROM companies WHERE  AdminID = '$AdminID' and Email='$Email' ";
 
// Executing SQL Query.
$check = mysqli_fetch_array(mysqli_query($con,$CheckSQL));
 
 
if(isset($check)){
 // Creating SQL query and insert the record into MySQL database table.
$Sql_Query = "update  companies SET Password = '$Password'   WHERE AdminID = '$AdminID' and Email='$Email' ";
 
 
 if(mysqli_query($con,$Sql_Query)){
 
 // If the record inserted successfully then show the message.
$MSG = 'profile edit Successfully' ;
 
// Converting the message into JSON format.
$json = json_encode($MSG);
 
// Echo the message.
 echo $json ;
 
 }
 else{
 
$MSG = 'errrror ';
 

$json = json_encode($MSG);
 
 
 echo $json;
 
 }
 
 
  }
  else{

 $EmailExistMSG = 'Error In Admin ID!!!';
 
 // Converting the message into JSON format.
$EmailExistJson = json_encode($EmailExistMSG);
 
// Echo the message.
 echo $EmailExistJson ; 
  }
 mysqli_close($con);
?>