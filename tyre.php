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
$Type = 'Repairing And Changing Tyre';
 
// Populate User email from JSON $obj array and store into $email.
$plate = $obj['plate_num'];
$type = $obj['type'];
$num = $obj['num'];
$rad = $obj['rad'];


$Email = $obj['Email'];


//Checking Email is already exist or not using SQL query.
$CheckSQL = "SELECT * FROM customervehicles WHERE Email='$Email' AND PlateNumber='$plate' ";
 
// Executing SQL Query.
$check = mysqli_fetch_array(mysqli_query($con,$CheckSQL));
 
 
if(isset($check)){

 
 // Creating SQL query and insert the record into MySQL database table.
$Sql_Query = "insert into order_form (OrderType,Vehicle, Information , Status, CustomerEmail) values ( '$Type','$plate', 'type :$type , quantity : $num , rad of tyre :$rad','Need Help','$Email')";
 
 
 if(mysqli_query($con,$Sql_Query)){
 
 // If the record inserted successfully then show the message.
$MSG = 'request send  Successfully';
 
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

 $EmailExistMSG = 'error in plate number , Please Try Again !!!';
 
 // Converting the message into JSON format.
$EmailExistJson = json_encode($EmailExistMSG);
 
// Echo the message.
 echo $EmailExistJson ; 
  }
 
 mysqli_close($con);
?>