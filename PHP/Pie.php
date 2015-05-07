<?php
	$servername = "localhost";
	$username = "root";
	$password = "bcitsql";
	$dbname = "PoliceDB";
	$assault = 0;
	$battery = 0;
	$false_imprisonment = 0;
	$kidnapping = 0;
	$homicide = 0;
	$sexual_assault = 0;
	$larceny = 0;
	$robbery = 0;
	$burglary = 0;
	$arson = 0;
	$embezzlement = 0;
	$forgery = 0;
	$false_pretenses = 0;
	$attempt = 0;
	$solicitation = 0;
	$conspiracy = 0;
	$dui = 0;

	
    	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $region1 = $_POST['Region1'];
		$region2 = $_POST['Region2'];
		$region3 = $_POST['Region3'];
        $region4 = $_POST['Region4'];
		$region5 = $_POST['Region5'];
		$region6 = $_POST['Region6'];
        $region7 = $_POST['Region7'];
		$region8 = $_POST['Region8'];
		$region9 = $_POST['Region9'];
    	// set the PDO error mode to exception
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	$sql = "SELECT incID, incType FROM incident WHERE incRegion IN( '$region1','$region2','$region3','$region4','$region5','$region6','$region7','$region8','$region9')";
        echo 
        	$set = FALSE;
   
    	// use exec() because no results are returned
   		$stmt = $conn->prepare($sql);
    	$stmt->execute();
    	$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    	
    	foreach(new RecursiveArrayIterator($stmt->fetchAll()) as $k=>$v) {
    	switch ($v['incType']) {
    			case "Assault":
        			$assault++;
        			break;
    			case "Battery":
        			$battery++;
        			break;
    			case "False Imprisonment":
        			$false_imprisonment++;
        			break;
        		case "Kidnapping":
        			$kidnapping++;
        			break;
        		case "Homicide":
        			$homicide++;
        			break;
        		case "Sexual assault":
        			$sexual_assault++;
        			break;
        		case "Larceny":
        			$larceny++;
        			break;
        		case "Robbery":
        			$robbery++;
        			break;
        		case "Burglary":
        			$burglary++;
        			break;
        		case "Arson":
        			$arson++;
        			break;
        		case "Embezzlement":
        			$embezzlement++;
        			break;
        		case "Forgery":
        			$forgery++;
        			break;
        		case "False pretenses":
        			$false_pretenses++;
        			break;
        		case "Attempt":
        			$attempt++;
        			break;
        		case "Solicitation":
        			$solicitation++;
        			break;
        		case "Conspiracy":
        			$conspiracy++;
        			break;
        		case "DUI":
        			$dui++;
        			break;
}

    	};
    	
    




$arr = array(
        array(
                "assault" => $assault,
                "battery" => $battery,
                "false_imprisonment" => $false_imprisonment,
                "kidnapping" => $kidnapping,
                "homicide" => $homicide,
                "sexual_assault" => $sexual_assault,
                "larceny" => $larceny,
                "robbery" => $robbery,
                "burglary" => $burglary,
                "arson" => $arson,
                "embezzlement" => $embezzlement,
                "forgery" => $forgery,
                "false_pretenses" => $false_pretenses,
                "attempt" => $attempt,
                "solicitation" => $solicitation,
                "conspiracy" => $conspiracy,
                "dui" => $dui
        )
        );
        
        echo json_encode($arr);
        ?>