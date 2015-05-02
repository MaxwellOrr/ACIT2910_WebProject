<?php

try
{
    //Open database connection
    $con = mysql_connect("localhost","root","bcitsql");
    mysql_select_db("PoliceDB", $con);
    mysql_query('SET NAMES utf8 COLLATE utf8_general_ci');

    //Getting records (listAction)
    if($_GET["action"] == "list")
    {
        //Get record count
        $result = mysql_query("SELECT COUNT(*) AS RecordCount FROM incident;");
        $row = mysql_fetch_array($result);
        $recordCount = $row['RecordCount'];

        //Get records from database
        $sql = "SELECT incID, incAddress, incType FROM incident ORDER BY " . $_GET["jtSorting"] . " LIMIT " . $_GET["jtStartIndex"] . "," . $_GET["jtPageSize"];
      
        
        
        $result = mysql_query($sql . ";");

        //Add all records to an array
        $rows = array();
        while($row = mysql_fetch_array($result))
        {
            $rows[] = $row;
        }

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
        //Insert record into database
        $result = mysql_query("INSERT INTO lab (mikroorganizam) VALUES('" . $_POST["mikroorganizam"] . "');");

        //Get last inserted record (to return to jTable)
        $result = mysql_query("SELECT * FROM lab WHERE id = LAST_INSERT_ID();");
        $row = mysql_fetch_array($result);

        //Return result to jTable
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        $jTableResult['Record'] = $row;
        print json_encode($jTableResult);
    }
    //Updating a record (updateAction)
    else if($_GET["action"] == "update")
    {
        //Update record in database
        $result = mysql_query("UPDATE lab SET mikroorganizam = " . $_POST["mikroorganizam"] . " WHERE id = " . $_POST["id"] . ";");

        //Return result to jTable
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        print json_encode($jTableResult);
    }
    //Deleting a record (deleteAction)
    else if($_GET["action"] == "delete")
    {
        //Delete from database
        $result = mysql_query("DELETE FROM lab WHERE id = " . $_POST["id"] . ";");

        //Return result to jTable
        $jTableResult = array();
        $jTableResult['Result'] = "OK";
        print json_encode($jTableResult);
    }

    //Close database connection
    mysql_close($con);

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