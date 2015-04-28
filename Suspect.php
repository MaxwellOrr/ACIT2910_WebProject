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
						<label>Suspect ID:</label>
					</td>
					<td>
						<input type="text" name="suspID" id="id"  placeholder="suspect ID"/><br /><br />
					</td>
				</tr>
				<tr>
					<td>
						<label>Officers :</label>
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
				</tr>
				<tr>
					<td>
						<label>Gender :</label>
					</td>
					<td>
						<select name="suspGender">
						    <option value=></option>
							<option value="Male">Male</option>
							<option value="Female">Female</option>
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
	 $suspID = $_POST["suspID"];
	 $offID = $_POST["offID"];
	 $suspGender = $_POST["suspGender"];
     $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
     $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     $smt = "SELECT suspID, suspFirstname, suspGender FROM suspect "; 
     
     $set = FALSE;
   

   if (!empty($suspID))
   {
      $smt .= " WHERE supID = '$supID'";
      $set = TRUE;
   }
   if (!empty($offID))
   {
      $smt .= ($set===TRUE ? " AND" : " WHERE") . " offID = '$offID'";
      $set = TRUE;
   }
   if (!empty($suspGender))
   {
      $smt .= ($set===TRUE ? " AND" : " WHERE") . " suspGender = '$suspGender'";
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
     echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?> 


		</div>
		</body>
	</html>