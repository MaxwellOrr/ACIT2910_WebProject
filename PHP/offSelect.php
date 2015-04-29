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

					
					
					echo "<select name=\"offID\" id=\"offIDval\">";
					echo	"<option value=></option>";
					foreach ($data as $row){
						
    				echo "<option>";
    				echo $row["offID"];
    				echo"</option>";
					};
					echo "</select>";
												?>