<?php


$servername = "localhost";
$username = "root";
$password = "bcitsql";
$dbname = "PoliceDB";
	$suspID = $_POST['name'];
		$incID = $_POST['incID'];
		$offID = $_POST['offID'];
		$suspFirstName = $_POST['suspFirstName'];
		$suspLastName = $_POST['suspLastName'];
		$suspGender = $_POST['suspGender'];
		$suspBirth = $_POST['suspBirthday'];

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "UPDATE suspect SET incID = \"$incID\", offID = \"$offID\",
		suspFirstname = \"$suspFirstName\", suspLastname = \"$suspLastName\",
		suspGender = \"$suspGender\", suspBirthdate = \"$suspBirth\" WHERE suspID = $suspID";
	
    // use exec() because no results are returned
    $conn->exec($sql);
    //echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
		
	


?>