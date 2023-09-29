<?php
if(isset($_POST['titel']) && !empty($_POST['titel'])) {
    $titel = $_POST['titel'];
    $richting = $_POST['richting'];
    $beginpunt = $_POST['beginpunt'];
    if($titel == "getFunerariumtitels"){
    	getFunerariumtitels($beginpunt, $richting);
    }
}

if(isset($_POST['image']) && !empty($_POST['image'])) {
    $image = $_POST['image'];
    $richting = $_POST['richting'];
    $beginpunt = $_POST['beginpunt'];
    if($image == "getFunerariumAfbeeldingen"){
    	getFunerariumAfbeeldingen($beginpunt, $richting);
    }   
}

function getFunerariumtitels($beginpunt, $richting){
	$servername = "localhost";
	//$username = "osn_developer01";
	//$password = "2?[?k0gZWOu0";
	$username = "root";
	$password = "";

	$nieuweBeginPunt;
	$totaalAfbeeldingen;
	$pointer;
	
	$data = array();

	$arrTitel = array();
	$afbeelding = array();

	// Create connection
	//$mysqli = new mysqli($servername, $username, $password, "osn_arijs");
	$mysqli = new mysqli($servername, $username, $password, "huis_arijs_db");

	// Check connection
	if ($mysqli->connect_error) {
	    die("Connection failed: " . $mysqli->connect_error);
	}
	//echo json_encode(5);

	

	if($richting == 0){
		$nieuweBeginPunt = $beginpunt - 4;
		//console.log($nieuweBeginPunt);
	}
	else{
		$nieuweBeginPunt = $beginpunt + 4;
	}
	

	if($query = $mysqli->query("SELECT * FROM tblfunerariumenaula")){
        if($query ->num_rows > 0){
            $totaalAfbeeldingen = $query->num_rows;
            //echo json_encode($aantal);
        }
        //echo($query["funerariumEnAulaId"]);
        
        for($i = $nieuweBeginPunt; $i < ($nieuweBeginPunt + 4); $i++){
			//console.log(i);
			$pointer = (($i % $totaalAfbeeldingen) + $totaalAfbeeldingen) % $totaalAfbeeldingen;
			$pointer += 1;
			if($i == $nieuweBeginPunt){
				$beginpunt = $nieuweBeginPunt;
			}

			//console.log($pointer);
			$resultaatTitel = $mysqli->query("SELECT funerariumEnAulaNaam FROM tblfunerariumenaula WHERE funerariumEnAulaId = '$pointer'");
			//echo($resultaatTitel->num_rows . "\n");
			$deTitel = $resultaatTitel->fetch_object();
			array_push($arrTitel, $deTitel->funerariumEnAulaNaam);

			//array_push($data['titel'], $deTitel->funerariumEnAulaNaam);

			
//			echo(count($arrTitel) . "\n");
			/*
			while($row = mysql_fetch_array($resultaatTitel)) {
				echo $row['funerariumEnAulaNaam'];
			}
			*/

			$resultaatAfbeelding = $mysqli->query("SELECT funerariumEnAulaAfbeelding FROM tblfunerariumenaula WHERE funerariumEnAulaId = '$pointer'");
			$deAfbeelding = $resultaatAfbeelding->fetch_object();
			array_push($afbeelding, $deAfbeelding->funerariumEnAulaAfbeelding);



			//$titel.push($xml.find('titel').eq($pointer).text());

			
			//$url.push($xml.find('url').eq($pointer).text());

		}
		//$data['titel'] = $arrTitel;
		//$data['afbeelding'] = array('hey', 'lol');
		echo json_encode($arrTitel);


    }
    else{
    	//echo json_encode("Kan afbeeldingen voor Funerarium en Aula niet vinden.");
    }

    

	$mysqli->close();
}








function getFunerariumAfbeeldingen($beginpunt, $richting){
	$servername = "localhost";
	//$username = "osn_developer01";
	//$password = "2?[?k0gZWOu0";
	$username = "root";
	$password = "";

	$mysqli = new mysqli($servername, $username, $password, "huis_arijs_db");

	$arrAfbeelding = array();

	// Check connection
	if ($mysqli->connect_error) {
	    die("Connection failed: " . $mysqli->connect_error);
	}

	if($richting == 0){
		$nieuweBeginPunt = $beginpunt - 4;
		//console.log($nieuweBeginPunt);
	}
	else{
		$nieuweBeginPunt = $beginpunt + 4;
	}


	if($query = $mysqli->query("SELECT * FROM tblfunerariumenaula")){
	    if($query ->num_rows > 0){
	        $totaalAfbeeldingen = $query->num_rows;
	        //echo json_encode($aantal);
	    }
	    for($i = $nieuweBeginPunt; $i < ($nieuweBeginPunt + 4); $i++){
	    	$pointer = (($i % $totaalAfbeeldingen) + $totaalAfbeeldingen) % $totaalAfbeeldingen;
			$pointer += 1;

			if($resultaatAfbeelding = $mysqli->query("SELECT funerariumEnAulaAfbeelding FROM tblfunerariumenaula WHERE funerariumEnAulaId = '$pointer'")){
				if($resultaatAfbeelding ->num_rows > 0){
					$deAfbeelding = $resultaatAfbeelding->fetch_object();
				}
			}
			array_push($arrAfbeelding, 'data:image/jpeg;base64,' . base64_encode($deAfbeelding->funerariumEnAulaAfbeelding));
	    }

	}




	
	header("content-type: image/jpeg");
	echo json_encode($arrAfbeelding);
	//echo 'data:image/jpeg;base64,' . base64_encode($deAfbeelding->funerariumEnAulaAfbeelding);
	$mysqli->close();
}
?>