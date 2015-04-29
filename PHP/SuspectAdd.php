<?php
$servername = "localhost";
$username = "root";
$password = "bcitsql";
$dbname = "PoliceDB";

try {
		$suspID = $_POST['name'];
		$incID = $_POST['incID'];
		$offID = $_POST['offID'];
		$suspFirstName = $_POST['suspFirstName'];
		$suspLastName = $_POST['suspLastName'];
		$suspGender = $_POST['suspGender'];
		$suspBirth = $_POST['suspBirthday'];
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO suspect (suspID, offID, incID, suspFirstname, suspLastname, suspGender, suspBirthdate)
    VALUES ('".$suspID."','".$offID."','".$incID."', '".$suspFirstName."', '".$suspLastName."', '".$suspGender."', '".$suspBirth."')";
    // use exec() because no results are returned
    echo $sql;
    $conn->exec($sql);
    echo "New record created successfully";
    }
catch(PDOException $e)
    {
    //echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>