<?php

// session_start();
include 'DBConfig.php';
 
// Create connection
$conn = new mysqli($HostName, $HostUser, $HostPass, $DatabaseName);
 //$Email = $obj['email'];
if ($conn->connect_error) {
 
 die("Connection failed: " . $conn->connect_error);
} 
 // Getting the received JSON into $json variable.
  $json = file_get_contents('php://input');
  
  // decoding the received JSON and store into $obj variable.
  $obj = json_decode($json,true);
  


/////////
$arraylat=[];
$arraylon=[];
$arrayEmail=[];

$sql = "SELECT lat , lng, CompanyName FROM companies ";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        $arraylat[] = $row["lat"];
        $arraylon[] = $row["lng"];
        $CompanyName[]=$row["CompanyName"];
		//$item = $row;
     
 
 $json1 = json_encode($item);
 // $json2 = json_encode($arraylon);
  //$json3 = json_encode($CompanyName);
 
 
 
 }
  echo $json1;
   //echo $json2;
  //  echo $json3;
  
	
}
 else {
   $EmailExistMSG = 'no result!!!';
 
 // Converting the message into JSON format.
$InvalidMSGJSon = json_encode($EmailExistMSG);
 
// Echo the message.
  echo $InvalidMSGJSon ;
}
 
 mysqli_close($conn);
?>