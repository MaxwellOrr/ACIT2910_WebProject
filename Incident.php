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
		<li>
		<?php
			echo "User: ". $_SESSION['user'];
			?>
		</li>
		
		
	</ul>

	<h1>CrimeTek</h1>
		<div class ="Content">
		
		
		<form class ="Search" action="" method="post">
			<table>
				<tr>
					<td>
						<label>Incident ID : </label>
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
				</tr>
				<tr>
					<td>
						<label>Address: </label>
					</td>
					<td>
						<input type="text" name="incAddress" id="address"  placeholder="Address"/><br/><br />
					</td>
				</tr>
				<tr>
					<td>
						<label>Type: </label>
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
			
		
		
		
		<table class ="results" style='border: solid 1px black;'>
			<tr>
				<th>
					Incident Id
				</th>
				<th>
					Address
				</th>
				<th>
					Type
				</th>
			</tr>
		
	
		<?php



class TableRows extends RecursiveIteratorIterator { 
     function __construct($it) { 
         parent::__construct($it, self::LEAVES_ONLY); 
     }

     function current() {
         return "<td style='width: 150px; border: 1px solid black;'>" . parent::current(). "</td>";
     }

     function beginChildren() { 
         echo "<tr>"; 
     } 

     function endChildren() { 
         echo "</tr>" . "\n";
     } 
} 
$servername = "localhost";
$username = "root";
$password = "bcitsql";
$dbname = "PoliceDB";

try {
	 $incID = $_POST["incID"];
	 $incAddress = $_POST["incAddress"];
	 $incType = $_POST["incType"];
     $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $smt = "SELECT incID, incAddress, incType FROM incident "; 
     
     $set = FALSE;
   

   if (!empty($incID))
   {
      $smt .= " WHERE incID = '$incID'";
      $set = TRUE;
   }
   if (!empty($incAddress))
   {
      $smt .= ($set===TRUE ? " AND" : " WHERE") . " incAddress = '$incAddress'";
      $set = TRUE;
   }
   if (!empty($incType))
   {
      $smt .= ($set===TRUE ? " AND" : " WHERE") . " incType = '$incType'";
   }

     $stmt = $conn->prepare($smt);
	 //('".$_POST["incID"]."','".$_POST["incAddress"]."','3/3/15', '".$_POST["incType"]."')
	 
     $stmt->execute();

     // set the resulting array to associative
     $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

     foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
         echo $v;
		
     }
}
catch(PDOException $e) {
    // echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";


?> 


		</div>
		</body>
	</html>
		