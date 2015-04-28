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

<div class ="Content">	
		
			<form action="" method="post">
				<table>
					<tr>
						<td>
							<label>Officer ID :</label>
						</td>
						<td>
							<input type="text" name="offID" id="offid" required="required" placeholder="enter officer ID"/><br /><br />
						</td>
					</tr>
					<tr>
						<td>
							<label>Department ID :</label>
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
     							$stmt = $conn->prepare("SELECT depID FROM department");
     							$stmt->execute();
     							$data = $stmt->fetchAll();

     
     						}

						catch(PDOException $e) {
     							echo "Error: " . $e->getMessage();
							}
						$conn = null;
						?>
						
						<select name="depID" id="depID">
						<option value=></option>
						<?php foreach ($data as $row): ?>
						
    					<option><?=$row["depID"]?></option>
						<?php endforeach ?>
						</select>
						
						
							
						</td>
					</tr>
					<tr>
						<td>
							<label>First Name :</label>
						</td>
						<td>
							<input type="text" name="offFirstname" id="firstname" required="required" placeholder="Officers first name"/><br/><br />
						</td>
					</tr>
					<tr>
						<td>
							<label>Last Name:</label>
						</td>
						<td>
							<input type="text" name="offLastname" id="lastname" required="required" placeholder="Officers last name"/><br/><br />
						</td>
					</tr>
					<tr>
						<td>
							<label>Officer Birthday:</label>
						</td>
						<td>
							<input type="date" name="offBirthdate">
						</td>
					</tr>
					<tr>
						<td>
							<label>Officer Rank:</label>
						</td>
						<td>
							
							<select name="offRank">
							<option value="Chief Constable">Chief Constable</option>
							<option value="Deputy Chief Constable">Deputy Chief Constable</option>
							<option value="Staff Superintendent">Staff Superintendent</option>
							<option value="Superintendent">Superintendent</option>
							<option value="Staff Inspector">Staff Inspector</option>
							<option value="Inspector">Inspector</option>
							<option value="Sergeant Major">Sergeant Major</option>
							<option value="Staff Sergeant">Staff Sergeant</option>
							<option value="Detective">Detective</option>
							<option value="Detective Constable">Detective Constable</option>
							<option value="Police Constable 2nd Class">Police Constable 2nd Class</option>
							<option value="Police Constable 3rd Class">Police Constable 3rd Class</option>
							<option value="Police Constable 4th Class">Police Constable 4th Class</option>
							<option value="Cadet">Cadet</option>
							</select>
							
							
						</td>
					</tr>
					<tr>
						<td>
						</td>
						<td>
							<input type="submit" value=" Submit " name="submit"/><br />
						</td>
					</tr>
				</table>
		</form>
		<?php
$servername = "localhost";
$username = "root";
$password = "bcitsql";
$dbname = "PoliceDB";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO officer (offID, depID, offFirstname, offLastname, offBirthdate, offRank)
    VALUES ('".$_POST["offID"]."','".$_POST["depID"]."','".$_POST["offFirstname"]."',
    '".$_POST["offLastname"]."', '".$_POST["offBirthdate"]."', '".$_POST["offRank"]."')";
    // use exec() because no results are returned
    $conn->exec($sql);
    echo "New record created successfully";
    }
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }

$conn = null;
?>
		</div>
		</body>
	</html>