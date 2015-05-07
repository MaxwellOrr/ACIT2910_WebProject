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

        
        
        
        
                 $offset = isset($_GET['jtStartIndex']) ? $_GET['jtStartIndex']:1 ;  
    $rows = isset($_GET['jtPageSize']) ? $_GET['jtPageSize']:10 ;
    $q = $_REQUEST['q'];
    $sort = isset($_GET['jtSorting']) ? $_GET['jtSorting']:'name desc';
    $opt = $_REQUEST['opt'];
    $where ='';
    if($q):
        if(!is_array($q)):
            $where = " where incident.$opt like '%$q%'";
        else:
            for($i = 0; $i < count($opt); $i++):  
                $where[] = "incident.".$opt[$i]." like '%".$q[$i]."%'";
            endfor;
            $where = " where ".implode(" And ",$where);  
        endif;
    endif;
                //Get record count
    $SQL = "SELECT COUNT(*) AS RecordCount FROM incident$where";
            $sth0 = $conn->prepare("$SQL");
            $sth0->execute();
            $row0 = $sth0->fetch(PDO::FETCH_ASSOC);
            //var_dump($row0);die();
    $recordCount = $row0['RecordCount'];

    //Get records from database
    //$result = mysql_query("SELECT * FROM Member ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
    //$SQL = "SELECT * FROM Center ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] ;
            $SQL = "SELECT incident.incID, incident.incAddress, incident.incDate, incident.incType, incident.incRegion, incident.incReport,
                    incident.incEvidence, vehicles.vehType, vehicles.vehRegNum, weapons.weapType, weapons.weapID 
                    FROM incident
                    LEFT OUTER JOIN vehicles
                    ON incident.incID = vehicles.incID
                    LEFT OUTER JOIN weapons
                    ON incident.incID = weapons.incID
                    $where ORDER BY incident.$sort LIMIT $offset,$rows" ;
            $sth1 = $conn->prepare("$SQL");
            $sth1->execute();

    //Add all records to an array
    $rows = array();
    //while($row = mysql_fetch_array($result))
            while($row1 = $sth1->fetch(PDO::FETCH_ASSOC))
    {
        $rows[] = $row1;
    }
            //var_dump($rows);die();
    //Return result to jTable
    $jTableResult = array();
    $jTableResult['Result'] = "OK";
    $jTableResult['TotalRecordCount'] = $recordCount;
    $jTableResult['Records'] = $rows;
    print json_encode($jTableResult);
        
        
        
        
        
        
        
    }
    //Creating a new record (createAction)
    else if($_GET["action"] == "create")
    {
    	$incID = $_POST['incID'];
		$incType = $_POST['incType'];
		$incAddress = $_POST['incAddress'];
        $incDate = $_POST['incDate'];
        $incRegion = $_POST['incRegion'];
        $incReport = $_POST['incReport'];
        $incEvidence = $_POST['incEvidence'];
        $vehRegNum = $_POST['vehRegNum'];
        $vehType = $_POST['vehType'];
        $weapID = $_POST['weapID'];
        $weapType = $_POST['weapType'];
        $vehicle_insert = " ";
        $weapon_insert = " ";
        
        //Check if data is inserted into vehicle Registration Number and Vehicle Type.
        if ((!empty($vehRegNum)) AND (!empty($vehType))){
            
            $vehicle_insert = "INSERT INTO vehicles (incID, vehRegNum, vehType)
    VALUES ('".$incID."','".$vehRegNum."','".$vehType."');";
        }
            $weapon_insert = "INSERT INTO weapons (incID, weapID, weapType)
    VALUES ('".$incID."','".$weapID."','".$weapType."');";
        
        //Insert record into database
        $sql_insert ="INSERT INTO incident (incID, incAddress,incDate, incType, incRegion, incReport, incEvidence)
                        VALUES ('".$incID."','".$incAddress."',".$incDate.", '".$incType."',
                        ".$incRegion.", '".$incReport."', '".$incEvidence."');".$vehicle_insert."".$weapon_insert."";
        $stmt = $conn->prepare($sql_insert);
        //$stmt->bindValue(1, $_POST['employeetitle']);
        $stmt->execute();

        //Get last inserted record (to return to jTable)
        $sql_select = "SELECT incident.incID, incident.incAddress, incident.incType, incident.incReport, incident.incEvidence,
                        incident.incRegion, vehicles.vehType, vehicles.vehRegNum, weapons.weapID, weapons.weapType 
                        FROM incident
                        LEFT OUTER JOIN vehicles
                        ON incident.incID = vehicles.incID 
                        LEFT OUTER JOIN weapons
                        ON incident.incID = weapons.incID
                        WHERE incident.incID = ".$incID."";
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
        $incDate = $_POST['incDate'];
        $incRegion = $_POST['incRegion'];
        $inceReport = $_POST['incReport'];
        $incEvidence = $_POST['incEvidence'];
        $vehRegNum = $_POST['vehRegNum'];
        $vehType = $_POST['vehType'];
        $weapID = $_POST['weapID'];
        $weapType = $_POST['weapType'];
        
        //Update record in database
        $sql_update = "UPDATE incident
                        SET incType = '".$incType."', incAddress = '".$incAddress."',
                        incDate = ".$incDate.", incRegion = ".$incRegion.", incReport ='".$incReport."', incEvidence = '".$incEvidence."'
                        WHERE incID = ".$incID.";
                        UPDATE vehicles
                        SET vehRegNum = ".$vehRegNum.", vehType = '".$vehType."'
                        WHERE incID = ".$incID.";
                        UPDATE weapons
                        SET weapID = ".$weapID.", weapType = '".$weapType."'
                        WHERE incID = ".$incID.";";
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
        $sql_delete = "DELETE FROM incident
                        WHERE incId = ".$incID.";
                        DELETE FROM weapons
                        WHERE incID = ".$incID.";
                        DELETE FROM vehicles
                        WHERE incID = ".$incID.";";
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