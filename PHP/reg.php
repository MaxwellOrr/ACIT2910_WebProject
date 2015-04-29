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
 
$user = $_POST['user'];
$password = $_POST['pass'];
 
if($user == '') {
	$errmsg_arr[] = 'You must enter your Username';
	$errflag = true;
}
if($password == '') {
	$errmsg_arr[] = 'You must enter your Password';
	$errflag = true;
}
 
// query
$result = $conn->prepare("SELECT secLevel FROM login WHERE username= :user AND password= :password");
$result->bindParam(':user', $user);
$result->bindParam(':password', $password);
$result->execute();
$rows = $result->fetch(PDO::FETCH_ASSOC);


if($rows['secLevel'] > 0) {
$_SESSION['permission'] = $rows['secLevel'];
$_SESSION['user'] = $user;
	
//link to the websites directory error with session handling may occur if not absolute address.
header("location: ../home.html");
exit();
}
else{
	$errmsg_arr[] = 'Username and Password are not found';
	$errflag = true;
}
if($errflag) {
	$_SESSION['ERRMSG_ARR'] = $errmsg_arr;
	session_write_close();
	header("location: index.html");
	exit();
}
 
?>
