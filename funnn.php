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
$ServiceType=$obj['ServiceType'];
//$sqltype = "SELECT  VehicleType FROM customervehicles  WHERE  PlateNumber ='$plate'   ";
$sqltype = "SELECT  VehicleType FROM customervehicles  WHERE  PlateNumber ='$plate'   ";
$result = $con->query($sqltype);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $VehicleType=$row["VehicleType"];
    }
} else {
    echo "0 results plate";
}


   
 
//$sql = "SELECT lat , lng, Email FROM companies where ServiceType='Battery Charge'   and VehiclesType = 'All Types' or '$VehicleType'";// service also or all or subset 
//////////////////2

$sql = "SELECT lat , lng, Email FROM companies where ServiceType='$ServiceType' and VehiclesType IN ('All Types' , '$VehicleType')";
$result = $con->query($sql);

if ($result->num_rows > 0) {

    while($row[] = $result->fetch_assoc()) {
        $item = $row;
     $json = json_encode($item);
    }
	echo $json;	
}
 else {
    $EmailExistMSG = 'no result 222222222222!!!';
 $InvalidMSGJSon = json_encode($EmailExistMSG);
  echo $InvalidMSGJSon ;
}

////////////////////////////////////////////////////////

$con->close();

?>