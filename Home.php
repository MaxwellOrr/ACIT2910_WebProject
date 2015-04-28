<html>
	<head>
		<title> 
			Incidents add
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
		
	
		</div>
		</body>
	</html>