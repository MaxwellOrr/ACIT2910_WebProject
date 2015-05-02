<?php
	require_once 'Connection.simple.php';
	$conn = dbConnect();
	$OK = true; // We use this to verify the status of the update.
	$counter = 1;
	// If 'buscar' is in the array $_POST proceed to make the query.
	
		
		// Create the query
		$incID = $_POST['name'];
		$incType = $_POST['incType'];
		//$sql = "SELECT * FROM incident WHERE incID = '$incID' AND incType = '$incType'  ";
     $sql = "SELECT suspID, suspFirstname, suspLastname, suspGender FROM suspect "; 
     
     $set = FALSE;
   

   if (!empty($suspID))
   {
      $sql .= " WHERE supID = '$supID'";
      $set = TRUE;
   }
   if (!empty($offID))
   {
      $sql .= ($set===TRUE ? " AND" : " WHERE") . " offID = '$offID'";
      $set = TRUE;
   }
   if (!empty($suspGender))
   {
      $sql .= ($set===TRUE ? " AND" : " WHERE") . " suspGender = '$suspGender'";
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
			echo "<td colspan='4'>There were not records</td>";
		echo "</tr>";
	}
	else {
		echo json_encode($rows);
	}
?>