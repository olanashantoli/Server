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
  
$Email = $obj['email'];
$ID = $obj['ID'];
//$Donee = $obj['Done'];
 //if($Done=='0'){
  // $EmailL = $_SESSION['Email']; 
// Creating SQL command to fetch all records from Table.
//$sql = "SELECT * FROM order_form WHERE Status = 'In Progress' and ProviderEmail='$Email'";//and ProviderEmail='$Email'
$sql = 
 "SELECT cusomer.Token
FROM (order_form

INNER JOIN cusomer ON order_form.CustomerEmail = cusomer.Email)
WHERE order_form.Status = 'Need Help' and order_form.ProviderEmail='$Email'    and order_form.CustomerEmail = cusomer.Email and order_form.ID ='$ID'";

//$result = mysqli_query($conn, $sql);//
$result = $conn->query($sql);//
 //$result = $conn->query($sql);
if (mysqli_query($conn,$sql)){
// $result =mysqli_query($conn,$sql);
//$r2=  $result->fetch_assoc();
	 if ($result->num_rows > 0) {
  // output data of each row
  while($row = $result->fetch_assoc()) {
    echo "id: " . $row["id"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
  }
} else {
  echo "0 results";
}
$MSG = $result;
 

$json = json_encode($MSG);
 
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