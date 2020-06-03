<?php
 session_start();
include 'DBConfig.php';
$conn = new mysqli($HostName, $HostUser, $HostPass, $DatabaseName);
if ($conn->connect_error) {
 die("Connection failed: " . $conn->connect_error);
} 
  $json = file_get_contents('php://input'); 
  $obj = json_decode($json,true); 
$plate = $obj['plate_num'];//منها بدي احدد نوع السيارة 
 $Email = $obj['Email']; // user email
	$latitude = $obj['latitude'];///موقع اليوزر
	$longitude = $obj['longitude'];// موقع اليوزر
	//$OrdID=$obj['ID']; ////////////////////////////////////////////////////////////////////////

$sqltype = "SELECT  VehicleType FROM customervehicles  WHERE  PlateNumber ='$plate'   ";
$result = $conn->query($sqltype);
if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        $VehicleType=$row["VehicleType"];
    }
} else {
    echo "0 results plate";
}

$arraylat=[];
$arraylon=[];
$arrayEmail=[];
$sql = "SELECT lat , lng, Email FROM companies where ServiceType='Battery Charge'   and VehiclesType = 'All Types' or '$VehicleType'";// service also or all
$result = $conn->query($sql);
if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        $arraylat[] = $row["lat"];
        $arraylon[] = $row["lng"];
        $arrayEmail[]=$row["Email"];
    }
} else {
    echo "0 results lat lng email";
}

/////////////////////////////////////////////////////////////////////////////////////////////اضافة
$OrdID=0;
$ind=0;
$sql3 = "SELECT ID FROM order_form where CustomerEmail='$Email' and Vehicle='$plate' ";//and lat and  lng
$result = $con->query($sql3);
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
       $OrdID=$row["ID"];
    }
} else {
    echo "0 results ID";
}
/////////////////////////////////////////////////////////////////////////////////////////////////


 ?>
<script>
    var lan=<?php echo json_encode($arraylat); ?>;
    var lon=<?php echo json_encode($arraylon); ?>;
    var EMArr=<?php echo json_encode($arrayEmail); ?>;
    var lat1="<?php echo $latitude ?>"*(Math.PI/180);;
    var lng1="<?php echo $longitude ?>"*(Math.PI/180);;
    var lat2;
    var lng2;
    var output=[];
    var lowestDis;
    for (i = 0; i < lon.length; i++) {

        lat2=lan[i]*(Math.PI/180);
        lng2=lon[i]*(Math.PI/180);

        var dlong = lng2 - lng1;
        var dlat = lat2 - lat1;
        var ans = Math.pow(Math.sin(dlat / 2), 2) +Math.cos(lat1) * Math.cos(lat2) * Math.pow(Math.sin(dlong / 2), 2);
        var ans2 = 2 * Math.asin(Math.sqrt(ans));
        var ans3 = ans2 * 6371;
        output[i]=ans3;

    }
    var index = 0;
    var value = output[0];
    for (var i = 1; i < output.length; i++) {
        if (output[i] < value) {
            value = output[i];
            index = i;
        }
    }
    output.sort(function(a, b){return a-b});
    lowestDis = output[0];

</script>

<?php
/////////////////////////////////////////////////////////////////////////////////////اضافة
$ProEma= $arrayEmail[$ind];

$sql = "update order_form set ProviderEmail='$ProEma' where ID='$OrdID' ";
$result = $con->query($sql);
/////////////////////////////////////////////////////////////////////////////////

$conn->close();

?>