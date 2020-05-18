<?php
//  session_start();
 // Importing DBConfig.php file.
 include 'DBConfig.php';
  
 // Creating connection.
  $con = mysqli_connect($HostName,$HostUser,$HostPass,$DatabaseName);
  
  // Getting the received JSON into $json variable.
  $json = file_get_contents('php://input');
  
  // decoding the received JSON and store into $obj variable.
  $obj = json_decode($json,true);
$Email = $obj['email'];
$ID = $obj['ID'];
	$Sql_Query = "update  order_form SET Status = 'Done'   WHERE ProviderEmail='$Email' and ID ='$ID' ";
 
 
 if(mysqli_query($con,$Sql_Query)){
 
 // If the record inserted successfully then show the message.
$MSG = 'Status edit Successfully' ;
 
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
 
  
  mysqli_close($con);
 ?>