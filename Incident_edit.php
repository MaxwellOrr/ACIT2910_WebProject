<?php
		session_start();
?>
<html>

	<head>
		<title> 
			Incidents
		</title>
		<link rel="stylesheet" type="text/css" href="style.css">
		<script>
		
		myfunc(){
		var myvar = 500;
		document.getElementById('test').innerHTML += 500;
		}
		</script>
	</head>
	<body>


		<div class="content">
		
			<form action="" method="post" style="height: 100%">
				<table>
					<tr>
						<td>
							<label>Incident ID :</label>
						</td>
						<td>
						
					
					<div id="incIdDiv"></div>
					<select name="incID" style="display: none;">
  						<option id="incIDop" value="">IncID</option>
					</select>
					
						
						
						
						
						
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
		<div id="test"></div>
		<button type="button" onClick="document.getElementById('incID').value += sessionStorage.editID;">Click Me!</button>
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
    $sql = "UPDATE incident SET incAddress = '".$_POST["incAddress"]."', incDate = '".$_POST["incDate"]."',
	incType = '".$_POST["incType"]."' WHERE incID = '".$_POST["incID"]."'";
	
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

	<script>	
	window.onload = function(){
    // x functionality when window loads
    document.getElementById('incIDop').value += sessionStorage.editID;
    document.getElementById('incIdDiv').innerHTML += sessionStorage.editID;
}	
</script>
		
		</body>
	</html>