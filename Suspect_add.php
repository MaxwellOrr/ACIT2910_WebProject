<?php
		session_start();
?>
<html>

	<head>
		<title> 
			Incidents
		</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		
	</head>
	<body>
	
	<ul id="menu">
		<li><a href="Home.php">Home</a></li>
		<li><a href="Incident.php">Incidents</a>	
		<?php

		if($_SESSION['permission'] == 3){
		echo "<ul>";
		echo "<li><a href=\"Incident_add.php\">Add Incident</a></li>";
		echo "<li><a href=\"Incident_edit.php\">Edit Incident</a></li>";
		echo "</ul>";
		};
		?>
		<li><a href="Suspect.php">Suspects</a>
		<?php

		if($_SESSION['permission'] == 3){
		echo "<ul>";
		echo "<li><a href=\"Suspect_add.php\">Add Incident</a></li>";
		echo "<li><a href=\"Suspect_edit.php\">Edit Incident</a></li>";
		echo "</ul>";
		};
		?>
			</li>
		<li><a href="officer.php">Officers</a>
		<?php

		if($_SESSION['permission'] == 3){
		echo "<ul>";
		echo "<li><a href=\"officer_add.php\">Add Incident</a></li>";
		echo "<li><a href=\"officer_edit.php\">Edit Incident</a></li>";
		echo "</ul>";
		};
		?>
			</li>
		
	</ul>
		<div>
		
		
			<form action="" method="post">
				<table>
					<tr>
						<td>
							<label>Suspect ID :</label>
						</td>
						<td>
							<input type="text" name="suspID" id="suspid" required="required" placeholder="enter suspesct ID"/><br /><br />
						</td>
						<td>
						</td>
					</tr>
					<tr>
						<td>
							<label>Officer ID :</label>
						</td>
						<td>
						<?php
						$servername = "localhost";
						$username = "root";
						$password = "bcitsql";
						$dbname = "PoliceDB";

						try {
     							$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
     							$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     							$stmt = $conn->prepare("SELECT offID FROM officer");
     							$stmt->execute();
     							$data = $stmt->fetchAll();

     
     						}

						catch(PDOException $e) {
     							echo "Error: " . $e->getMessage();
							}
						$conn = null;
						?>
						
						<select name="offID" id="offID">
						<option value=></option>
						<?php foreach ($data as $row): ?>
						
    					<option><?=$row["offID"]?></option>
						<?php endforeach ?>
						</select>
						
							
						</td>
						<td>
						</td>
					</tr>
					<tr>
						<td>
							<label>Incident ID :</label>
						</td>
						<td>
						
						<?php
						$servername = "localhost";
						$username = "root";
						$password = "bcitsql";
						$dbname = "PoliceDB";

						try {
     							$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
     							$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     							$stmt = $conn->prepare("SELECT incID FROM incident");
     							$stmt->execute();
     							$data = $stmt->fetchAll();

     
     						}

						catch(PDOException $e) {
     							echo "Error: " . $e->getMessage();
							}
						$conn = null;
						?>
						
						<select name="incID" id="incID">
						<option value=></option>
						<?php foreach ($data as $row): ?>
						
    					<option><?=$row["incID"]?></option>
						<?php endforeach ?>
						</select>
						
							
						</td>
						<td>
							<button type="button" class='iframe' href="Incident_add.php">New Incident</button>
						</td>
					</tr>
					<tr>
						<td>
							<label>First Name :</label>
						</td>
						<td>
							<input type="text" name="suspFirstname" id="firstname" required="required" placeholder="Suspects first name"/><br/><br />
						</td>
						<td>
						</td>
					</tr>
					<tr>
						<td>
							<label>Last Name:</label>
						</td>
						<td>
							<input type="text" name="suspLastname" id="lastname" required="required" placeholder="Suspects last name"/><br/><br />
						</td>
						<td>
						</td>
					</tr>
					<tr>
						<td>
							<label>Gender:</label>
						</td>
						<td>
							<select name="suspGender">
							<option value="Male">Male</option>
							<option value="Female">Female</option>
							</select>
						</td>
						<td>
						</td>
						
					</tr>
					<tr>
						<td>
							<label>Suspect Birthday:</label>
						</td>
						<td>
							<input type="date" name="suspBirthdate">
						</td>
						<td>
						</td>
					</tr>
					<tr>
						<td>
						</td>
						<td>
							<input type="submit" value=" Submit " name="submit"/><br />
						</td>
						<td>
						</td>
					</tr>
				</table>
		</form>
		
		<a class='iframe' href="Incident_add.php">New Incident</a>
		
		
		<?php
$servername = "localhost";
$username = "root";
$password = "bcitsql";
$dbname = "PoliceDB";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO suspect (suspID, offID, incID, suspFirstname, suspLastname, suspGender, suspBirthdate)
    VALUES ('".$_POST["suspID"]."','".$_POST["offID"]."','".$_POST["incID"]."','".$_POST["suspFirstname"]."',
    '".$_POST["suspLastname"]."', '".$_POST["suspGender"]."','".$_POST["suspBirthdate"]."')";
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



		</div>
		
		</body>
	</html>