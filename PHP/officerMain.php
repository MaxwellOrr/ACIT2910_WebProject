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
    $SQL = "SELECT COUNT(*) AS RecordCount FROM officer$where";
            $sth0 = $conn->prepare("$SQL");
            $sth0->execute();
            $row0 = $sth0->fetch(PDO::FETCH_ASSOC);
            //var_dump($row0);die();
    $recordCount = $row0['RecordCount'];

    //Get records from database
    //$result = mysql_query("SELECT * FROM Member ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
    //$SQL = "SELECT * FROM Center ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] ;
            $SQL = "SELECT offID, depID, offFirstname, offLastname, offRank FROM officer$where ORDER BY $sort LIMIT $offset,$rows" ;
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
    	$offID = $_POST['offID'];
        $depID = $_POST['depID'];
		$offFirstname = $_POST['offFirstname'];
		$offLastname = $_POST['offLastname'];
        $offRank = $_POST['offRank'];
        $offBirthday = $_POST['offBirthday'];
        //Insert record into database
        $sql_insert ="INSERT INTO officer (offID, depID, offFirstname, offLastname, offRank, offBirthdate)
    VALUES ('".$offID."','".$depID."','".$offFirstname."', '".$offLastname."', '".$offRank."', ".$offBirthday.")";
        $stmt = $conn->prepare($sql_insert);
        //$stmt->bindValue(1, $_POST['employeetitle']);
        $stmt->execute();

        //Get last inserted record (to return to jTable)
        $sql_select = "SELECT offID, depID, offFirstname, offLastname, offRank FROM officer WHERE offID = ".$offID."";
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
    	$offID = $_POST['offID'];
        $depID = $_POST['depID'];
		$offFirstname = $_POST['offFirstname'];
		$offLastname = $_POST['offLastname'];
        $offRank = $_POST['offRank'];
        //Update record in database
        $sql_update = "UPDATE officer SET offID = '".$offID."', depID = '".$depID."', offFirstname = '".$offFirstname."'
        , offLastname = '".$offLastname."', offRank = '".$offRank."'WHERE offID = '".$offID."';";
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
    	$offID = $_POST['offID'];
        //Delete from database
        $sql_delete = "DELETE FROM officer WHERE offID = '".$offID."';";
        $stmt = $conn->prepare($sql_delete);
        //$stmt->bindValue(1, $_POST['employeetitleid']);
        $stmt->execute();

        //Return result to jTable
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        print json_encode($jTableResult);
    }
     else if($_GET["action"] == "getdep")
    {
       $sql_select = "SELECT depID FROM department;";
        $stmt = $conn->prepare($sql_select);
        $stmt->execute();
        //$row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        
        $rows = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $element = array();
            $element["DisplayText"]= $row['depID'];
            $element["Value"]= $row['depID'];
            $rows[] = $element;
        }

        //Return result to jTable
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        $jTableResult['Options'] = $rows;
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