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
  
$plate = $obj['plate_num'];//منها بدي احدد نوع السيارة 
 $Email = $obj['Email']; // user email
  // Populate User name from JSON $obj array and store into $name.
//$latitude = $obj['latitude'];///موقع اليوزر
 
// Populate User email from JSON $obj array and store into $email.
//$longitude = $obj['longitude'];// موقع اليوزر
$sqltype = "SELECT  VehicleType FROM customervehicles  WHERE  PlateNumber ='$plate'   ";
// ي بدي انفذ اللي فوق واخزن الجواب بمتغير و المتغير احطو تحت مكان ؟؟؟؟؟؟؟؟؟

$sql = "SELECT lat , lng, Email FROM companies where (ServiceType = 'Battery Charge' or 'all') and (VehiclesType = ???????? or 'all' ) ";// مواقع الشركات اللي بتقدم الخدمة "شحن البطارية " 

$result = $conn->query($sql);
 /* هاض عشان يرجع الداتا (المواقع ) ل  الرياكت نيتف 
if ($result->num_rows >0) {
 
 
 while($row[] = $result->fetch_assoc()) {
 
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
*/

 
$conn->close();
?>