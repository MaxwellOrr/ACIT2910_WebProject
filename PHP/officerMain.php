<?php
	require_once 'Connection.simple.php';
	$conn = dbConnect();
	$OK = true; // We use this to verify the status of the update.
	$counter = 1;
	// If 'buscar' is in the array $_POST proceed to make the query.
	
		
		// Create the query
		$offID = $_POST['name'];
		$incType = $_POST['incType'];
		//$sql = "SELECT * FROM incident WHERE incID = '$incID' AND incType = '$incType'  ";
 $sql = "SELECT offID, depID, offFirstname, offRank FROM officer"; 
     
     $set = FALSE;
   

   if (!empty($offID))
   {
      $sql .= " WHERE offID = '$offID'";
      $set = TRUE;
   }
   if (!empty($depID))
   {
      $sql .= ($set===TRUE ? " AND" : " WHERE") . " depID = '$depID'";
      $set = TRUE;
   }
   if (!empty($offRank))
   {
      $sql .= ($set===TRUE ? " AND" : " WHERE") . " offRank = '$offRank'";
   }

		
		
		
		
		// we have to tell the PDO that we are going to send values to the query
		$stmt = $conn->prepare($sql);
		// Now we execute the query passing an array toe execute();
		$results = $stmt->execute(array($data));
		// Extract the values from $result
		$rows = $stmt->fetchAll();
		$error = $stmt->errorInfo();
		//echo $error[2];	
		
	


	// If there are no records.
	if(empty($rows)) {
		echo "<tr>";
			echo "<td colspan='4'>";
			echo $sql;
			echo "</td>";
		echo "</tr>";
	}
	else {
		foreach ($rows as $row) {
			echo "<tr>";
				echo "<td>".$row['offID']."</td>";
				echo "<td>".$row['depID']."</td>";
				echo "<td>".$row['offFirstname']."</td>";
				echo "<td>".$row['offRank']."</td>";
				echo "<td><button type=\"button\" class=\"btnedit\"  onClick=\"sessionStorage.editID =".$row['offID']."; openDialog();\">Edit</button></td>";
				$counter++;
			echo "</tr>";
		}
	}
?>