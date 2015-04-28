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
		
		
		<form class ="Search" action="" method="post">
			<table>
				<tr>
					<td>
						<label>Officer ID :</label>
					</td>
					<td>
						<input type="text" name="offID" id="id"  placeholder="enter ID"/><br /><br />
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
						<label>Rank :</label>
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
	 $offID = $_POST["offID"];
	 $depID = $_POST["depID"];
	 $offRank = $_POST["offRank"];
     $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
      $smt = "SELECT offID, depID, offFirstname, offRank FROM officer"; 
     
     $set = FALSE;
   

   if (!empty($offID))
   {
      $smt .= " WHERE offID = '$offID'";
      $set = TRUE;
   }
   if (!empty($depID))
   {
      $smt .= ($set===TRUE ? " AND" : " WHERE") . " depID = '$depID'";
      $set = TRUE;
   }
   if (!empty($offRank))
   {
      $smt .= ($set===TRUE ? " AND" : " WHERE") . " offRank = '$offRank'";
   }
     $stmt = $conn->prepare($smt);
	 //('".$_POST["incID"]."','".$_POST["incAddress"]."','3/3/15', '".$_POST["incType"]."') WHERE offID = ".$_POST["offID"]."
	 
     $stmt->execute();

     // set the resulting array to associative
     $result = $stmt->setFetchMode(PDO::FETCH_ASSOC); 

     foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) { 
         echo $v;
     }
}
catch(PDOException $e) {
     echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?> 


		</div>
		</body>
	</html>