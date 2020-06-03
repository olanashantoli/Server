<?php

// session_start();
include 'DBConfig.php';
 
// Create connection
$conn = new mysqli($HostName, $HostUser, $HostPass, $DatabaseName);
 
 
if ($conn->connect_error) {
 
 die("Connection failed: " . $conn->connect_error);
} 
 // Getting the received JSON into $json variable.
  $json = file_get_contents('php://input');
  
  // decoding the received JSON and store into $obj variable.
  $obj = json_decode($json,true);
  




$sql = "SELECT lat ,Phone, lng,VehiclesType, CompanyName FROM companies ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row[]= $result->fetch_assoc()) {
      
		$item = $row;
     
 
 $json = json_encode($item);

 
 }
  echo $json;

	
}
 else {
   $EmailExistMSG = 'no result!!!';
 
 // Converting the message into JSON format.
$InvalidMSGJSon = json_encode($EmailExistMSG);
 
// Echo the message.
  echo $InvalidMSGJSon ;
}
 
$conn->close();
?>