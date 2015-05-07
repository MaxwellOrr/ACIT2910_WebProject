<?php
    session_start();
	$arr = array(
        array(
                "permission" => $_SESSION['permission'],
                "user" => $_SESSION['user']
        )
        );
        
        echo json_encode($arr);
?>