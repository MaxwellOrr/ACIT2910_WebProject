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
        //SELECT suspID, suspFirstname, suspLastname, suspGender FROM suspect
                //Get record count
    $SQL = "SELECT COUNT(*) AS RecordCount FROM suspect$where";
            $sth0 = $conn->prepare("$SQL");
            $sth0->execute();
            $row0 = $sth0->fetch(PDO::FETCH_ASSOC);
            //var_dump($row0);die();
    $recordCount = $row0['RecordCount'];

    //Get records from database
    //$result = mysql_query("SELECT * FROM Member ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] . ";");
    //$SQL = "SELECT * FROM Center ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"] ;
            $SQL = "SELECT suspID, suspFirstname, suspLastname, suspGender FROM suspect$where ORDER BY $sort LIMIT $offset,$rows" ;
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
    	$suspID = $_POST['suspID'];
        $offID = $_POST['offID'];
        $incID = $_POST['incID'];
		$suspFirstname = $_POST['suspFirstname'];
		$suspLastname = $_POST['suspLastname'];
        $suspGender = $_POST['suspGender'];
        $suspBirthday = $_POST['suspBirthday'];
        //Insert record into database
        $sql_insert ="INSERT INTO suspect (suspID, incID, offID, suspFirstname, suspLastname, suspGender, suspBirthdate)
    VALUES ('".$suspID."','".$incID."','".$offID."','".$suspFirstname."', '".$suspLastname."', '".$suspGender."', ".$suspBirthday.")";
        $stmt = $conn->prepare($sql_insert);
        //$stmt->bindValue(1, $_POST['employeetitle']);
        $stmt->execute();

        //Get last inserted record (to return to jTable)
        $sql_select = "SELECT suspID, suspFirstname, suspLastname, suspGender FROM suspect WHERE suspID = ".$suspID."";
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
    	$suspID = $_POST['suspID'];
        $offID = $_POST['offID'];
        $incID = $_POST['incID'];
		$suspFirstname = $_POST['suspFirstname'];
		$suspLastname = $_POST['suspLastname'];
        $suspGender = $_POST['suspGender'];
        $suspBirthday = $_POST['suspBirthday'];
        //Update record in database
        $sql_update = "UPDATE suspect SET suspID = '".$suspID."', incID = '".$incID."',
        offID = '".$offID."', suspFirstname = '".$suspFirstname."'
        , suspLastname = '".$suspLastname."', suspGender = '".$suspGender."', suspBirthdate = ".$suspBirthday."
        WHERE suspID = '".$suspID."';";
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
    	$suspID = $_POST['suspID'];
        //Delete from database
        $sql_delete = "DELETE FROM suspect WHERE suspID = '".$suspID."';";
        $stmt = $conn->prepare($sql_delete);
        //$stmt->bindValue(1, $_POST['employeetitleid']);
        $stmt->execute();

        //Return result to jTable
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        print json_encode($jTableResult);
    }
    else if($_GET["action"] == "getOff")
    {
       $sql_select = "SELECT offID FROM officer;";
        $stmt = $conn->prepare($sql_select);
        $stmt->execute();
        //$row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        
        $rows = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $element = array();
            $element["DisplayText"]= $row['offID'];
            $element["Value"]= $row['offID'];
            $rows[] = $element;
        }

        //Return result to jTable
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        $jTableResult['Options'] = $rows;
        print json_encode($jTableResult);
    }
    else if($_GET["action"] == "getInc")
    {
       $sql_select = "SELECT incID FROM incident;";
        $stmt = $conn->prepare($sql_select);
        $stmt->execute();
        //$row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        
        $rows = array();
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $element = array();
            $element["DisplayText"]= $row['incID'];
            $element["Value"]= $row['incID'];
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