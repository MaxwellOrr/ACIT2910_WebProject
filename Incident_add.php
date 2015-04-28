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

		<div class="content">
		
			<form action="" method="post" style="height: 100%">
				<table>
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
     							 

							$nRows = $conn->query("SELECT COUNT(incID) FROM incident")->fetchColumn(); 
							$nRows ++;
							echo $nRows;

     
     						}

						catch(PDOException $e) {
     							echo "Error: " . $e->getMessage();
							}
						$conn = null;
						?>
						
					</tr>
					<tr>
						<td>
							<label>Address :</label>
						</td>
						<td>
							<input type="text" name="incAddress" id="address" required="required" placeholder="Address"/><br/><br />
						</td>
					</tr>
					<tr>
						<td>
							<label>Incident Date:</label>
						</td>
						<td>
							<input type="date" name="incDate">
						</td>
					</tr>
					<tr>
						<td>
							<label>Type :</label>
						</td>
						<td>
							<select name="incType">
							<option value=""></option>
							<option value="Assault">Assault</option>
							<option value="Battery">Battery</option>
							<option value="False Imprisonment">False Imprisonment</option>
							<option value="Kidnapping">Kidnapping</option>
							<option value="Homicide">Homicide</option>
							<option value="Sexual assault">Sexual assault</option>
							<option value="Larceny">Larceny</option>
							<option value="Robbery">Robbery</option>
							<option value="Burglary">Burglary</option>
							<option value="Arson">Arson</option>
							<option value="Embezzlement">Embezzlement</option>
							<option value="Forgery">Forgery</option>
							<option value="False pretenses">False pretenses</option>
							<option value="Attempt">Attempt</option>
							<option value="Solicitation">Solicitation</option>
							<option value="Conspiracy">Conspiracy</option>
							<option value="DUI">DUI</option>
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
		</div>
		<?php
$servername = "localhost";
$username = "root";
$password = "bcitsql";
$dbname = "PoliceDB";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO incident (incID, incAddress, incDate, incType)
    VALUES ('".$nRows."','".$_POST["incAddress"]."','".$_POST["incDate"]."', '".$_POST["incType"]."')";
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

		
		
		
		</body>
	</html>