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
$name = $obj['name'];
 
// Populate User email from JSON $obj array and store into $email.
$email = $obj['email'];

// Populate Password from JSON $obj array and store into $password.
$comment = $obj['comment'];
$EmailC = $obj['EmailC'];
 
 // Creating SQL query and insert the record into MySQL database table.
$Sql_Query = "insert into Join_our_team (name,email,comment,type) values ( '$name','$email','From Company : $EmailC , $comment' ,'provider')";
 
 
 if(mysqli_query($con,$Sql_Query)){
 
 // If the record inserted successfully then show the message.
$MSG = 'comment send  Successfully';
 
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