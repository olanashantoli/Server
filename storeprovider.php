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
$plate = $obj['plate_num'];//منها بدي احدد نوع السيارة 
 $Email = $obj['Email']; // user email
	$latitude = $obj['latitude'];///موقع اليوزر
	$longitude = $obj['longitude'];// موقع اليوزر
	 $ProviderEmail = $obj['ProviderEmail'];
	 $OrderType=$obj['OrderType'];
	 
	 
	$Sql_Query = "update order_form set ProviderEmail='$ProviderEmail' where CustomerEmail='$Email' AND Vehicle='$plate' AND Status='Need Help' AND  OrderType =  '$OrderType'";//"LAT='latitude' AND LNG='longitude'
 
 
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