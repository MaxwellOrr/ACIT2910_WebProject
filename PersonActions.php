<?php
try
{
  $servername = "localhost";
						$username = "root";
						$password = "bcitsql";
						$dbname = "PoliceDB";

     							$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
     							$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

}



catch ( PDOException $e )
{
    print( "Error connecting to SQL Server." );
    die(print_r($e));
}

catch(Exception $e)
{
    die(var_dump($e));
}

try {
    //Getting records (listAction)
    if($_GET["action"] == "list")
    {
        //Get records from database
        //ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] .
        $sql_select = "SELECT incID, incAddress, incType FROM incident ORDER BY ". $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] .";";
        $stmt = $conn->query($sql_select);

        //Add all records to an array
        $rows = $stmt->fetchall(PDO::FETCH_ASSOC);

        //Return result to jTable
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        $jTableResult['Records'] = $rows;
        print json_encode($jTableResult);
    }
    //Creating a new record (createAction)
    else if($_GET["action"] == "create")
    {
    	$incID = $_POST['incID'];
		$incType = $_POST['incType'];
		$incAddress = $_POST['incAddress'];
        //Insert record into database
        $sql_insert ="INSERT INTO incident (incID, incAddress,incDate, incType)
    VALUES ('".$incID."','".$incAddress."','3/3/15', '".$incType."')";
        $stmt = $conn->prepare($sql_insert);
        //$stmt->bindValue(1, $_POST['employeetitle']);
        $stmt->execute();

        //Get last inserted record (to return to jTable)
        $sql_select = "SELECT incID,incAddress, incType FROM incident WHERE incID = ".$incID."";
        $stmt = $conn->prepare($sql_select);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        //Return result to jTable
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        $jTableResult['Record'] = $row;
        print json_encode($jTableResult);
    }
    //Updating a record (updateAction)
    else if($_GET["action"] == "update")
    {
    	$incID = $_POST['incID'];
		$incType = $_POST['incType'];
		$incAddress = $_POST['incAddress'];
        //Update record in database
        $sql_update = "UPDATE incident SET incType = '".$incType."', incAddress = '".$incAddress."' WHERE incID = '".$incID."';";
        $stmt = $conn->prepare($sql_update);
        //$stmt->bindValue(1, $_POST['employeetitle']);
        //$stmt->bindValue(2, $_POST['employeetitleid']);
        $stmt->execute();

        //Return result to jTable
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        print json_encode($jTableResult);
    }
    //Deleting a record (deleteAction)
    else if($_GET["action"] == "delete")
    {
    	$incID = $_POST['incID'];
        //Delete from database
        $sql_delete = "DELETE FROM incident WHERE incId = '".$incID."';";
        $stmt = $conn->prepare($sql_delete);
        //$stmt->bindValue(1, $_POST['employeetitleid']);
        $stmt->execute();

        //Return result to jTable
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        print json_encode($jTableResult);
    }

    //Close database connection
    $conn = null;

}
catch(Exception $ex)
{
    //Return error message
    $jTableResult = array();
    $jTableResult['Result'] = "ERROR";
    $jTableResult['Message'] = $ex->getMessage();
    print json_encode($jTableResult);
}
	
?>