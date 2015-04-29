<?php
$servername = "localhost";
$username = "root";
$password = "bcitsql";
$dbname = "PoliceDB";

try {
$incID = $_POST['name'];
		$incAddress = $_POST['incAddress'];
		$incDate = $_POST['incDate'];
		$incType = $_POST['incType'];
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO incident (incID, incAddress, incDate, incType)
    VALUES ('".$incID."','".$incAddress."','".$incDate."', '".$incType."')";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "New record created successfully";
    }
catch(PDOException $e)
    {
    //echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>