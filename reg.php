<?php
session_start();
$errmsg_arr = array();
$errflag = false;
// configuration
$dbhost 	= "localhost";
$dbname		= "PoliceDB";
$dbuser		= "root";
$dbpass		= "bcitsql";
 
// database connection
$conn = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
 
// new data
 
$user = $_POST['uname'];
$password = $_POST['pword'];
 
if($user == '') {
	$errmsg_arr[] = 'You must enter your Username';
	$errflag = true;
}
if($password == '') {
	$errmsg_arr[] = 'You must enter your Password';
	$errflag = true;
}
 
// query
$result = $conn->prepare("SELECT secLevel FROM login WHERE username= :hjhjhjh AND password= :asas");
$result->bindParam(':hjhjhjh', $user);
$result->bindParam(':asas', $password);
$result->execute();
$rows = $result->fetch(PDO::FETCH_ASSOC);


if($rows['secLevel'] > 0) {
$_SESSION['permission'] = $rows['secLevel'];
$_SESSION['user'] = $user;
	

header("location: http://localhost/WebProjectV2/Home.php");
exit();
}
else{
	$errmsg_arr[] = 'Username and Password are not found';
	$errflag = true;
}
if($errflag) {
	$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
	session_write_close();
	header("location: index.php");
	exit();
}
 
?>