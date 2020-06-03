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
	 
	 $OrderType=$obj['OrderType'];
	 
	 
	 
$sql = "SELECT  ProviderEmail, Status FROM order_form  WHERE CustomerEmail='$Email'AND Vehicle='$plate' And OrderType='$OrderType' ";
$result = $con->query($sql);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $Status=$row["Status"];
        $ProEm=$row["ProviderEmail"];
    }
	
	if($Status=="In Progress")
{ $MSG = " request has been accepted by '$ProEm' ";

 $json = json_encode($MSG);
		echo  $json;
}
else if($Status=="Need Help")
{
    if($ProEm=='null')
    {$MSG ="repeat";
     $json = json_encode($MSG);
		echo  $json;
		}
    else  
	{$MSG = "Company still not accept or deny the requet";
 $json = json_encode($MSG);
		echo  $json;

    }
}
 
} 


else {
    echo "0 results Status";
}


 
 //$json = json_encode($MSG);
 
 //echo $json ;
 
//$MSG = 'Status edit Successfully' ;
 

  
  mysqli_close($con);
 ?>