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
            $where = " where $opt like '%$q%'";
        else:
            for($i = 0; $i < count($opt); $i++):  
                $where[] = $opt[$i]." like '%".$q[$i]."%'";
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
            $SQL = "SELECT incID, incAddress, incType FROM incident$where ORDER BY $sort LIMIT $offset,$rows" ;
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