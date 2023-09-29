<?php
require 'connection.php';
// if(isset($_POST['productId']) && !empty($_POST['productId'])) {
//     $productId = $_POST['productId'];

//     $categorie = $_POST['categorie'];

//     if($productId == "getProductId"){
//     	getProductId($categorie);
//     }
// }

if(isset($_POST['productAfbeelding']) && !empty($_POST['productAfbeelding'])) {
    $productAfbeelding = $_POST['productAfbeelding'];

    $productId = $_POST['Id'];

    if($productAfbeelding == "getProductAfbeelding"){
    	getProductAfbeelding($productId);
    }
}

// if(isset($_POST['productNaam']) && !empty($_POST['productNaam'])) {
//     $productNaam = $_POST['productNaam'];

//     $productId = $_POST['Id'];

//     if($productNaam == "getProductNaam"){
//     	getProductNaam($productId);
//     }
// }

// if(isset($_POST['productPrijs']) && !empty($_POST['productPrijs'])) {
//     $productPrijs = $_POST['productPrijs'];

//     $productId = $_POST['Id'];

//     if($productPrijs == "getProductPrijs"){
//     	getProductPrijs($productId);
//     }
// }

if(isset($_POST['cookieSetProduct']) && !empty($_POST['cookieSetProduct'])) {
    $cookieSetProduct = $_POST['cookieSetProduct'];

    $productId = $_POST['Id'];
    $aantal = $_POST['aantal'];

    if($cookieSetProduct == "cookieSetProduct"){
    	cookieSetProduct($productId, $aantal);
    }
}

if(isset($_POST['cookieRemoveProduct']) && !empty($_POST['cookieRemoveProduct'])) {
    $cookieRemoveProduct = $_POST['cookieRemoveProduct'];

    $productId = $_POST['Id'];

    if($cookieRemoveProduct == "cookieRemoveProduct"){
    	cookieRemoveProduct($productId);
    }
}

if(isset($_POST['getCookieAantal']) && !empty($_POST['getCookieAantal'])) {
    $getCookieAantal = $_POST['getCookieAantal'];

    if($getCookieAantal == "getCookieAantal"){
    	getCookieAantal();
    }
}

function getCookieAantal(){
	$cookie = isset($_COOKIE['winkelmandCookie']) ? $_COOKIE['winkelmandCookie'] : "";
	$cookie = stripslashes($cookie);
	$producten = json_decode($cookie, true);

	if(!$producten){
	    $producten = array();
	}

	if (empty($producten)) {
	     echo json_encode(0);
	}
	else{
		echo json_encode(count($producten));
	}
}


if(isset($_POST['winkelmandData']) && !empty($_POST['winkelmandData'])) {
    $winkelmandData = $_POST['winkelmandData'];

    if($winkelmandData == "getWinkelmandData"){
    	getWinkelmandData();
    }
}

function getWinkelmandData(){
	// $servername = "localhost";
	// //$username = "osn_developer01";
	// //$password = "2?[?k0gZWOu0";
	// $username = "root";
	// $password = "";

	// // Create connection
	// //$mysqli = new mysqli($servername, $username, $password, "osn_arijs");
	// $mysqli = new mysqli($servername, $username, $password, "osn_arijs");

	// // Check connection
	// if ($mysqli->connect_error) {
	//     die("Connection failed: " . $mysqli->connect_error);
	// }

	global $mysqli;

	$cookie = isset($_COOKIE['winkelmandCookie']) ? $_COOKIE['winkelmandCookie'] : "";
	$cookie = stripslashes($cookie);
	$producten = json_decode($cookie, true);

	// [0]["id"]
	$arrId = array();
	$arrNaam = array();
	$arrPrijs = array();

	if(!$producten){
	    $producten = array();
	}

	if (empty($producten)) {
	     echo json_encode(0);
	}
	else{
		$test = array();

		foreach($producten as $row => $innerArray){
		  foreach($innerArray as $innerRow => $value){
		    if($innerRow == "id"){
		  		array_push($test, $value);

		  		$resultaat = $mysqli->query("SELECT productNaam, productPrijs FROM tblproduct WHERE productId = '$value'");
				$row = $resultaat->fetch_assoc();
				array_push($arrId, $value);
				array_push($arrNaam, $row["productNaam"]);
				array_push($arrPrijs, $row["productPrijs"]);
		  	}
		  }
		}

		$arrWinkelmandData = array("id" => $arrId, "naam" => $arrNaam, "prijs" => $arrPrijs);

		echo json_encode($arrWinkelmandData);
	}

	$mysqli->close();
}

// if(isset($_POST['winkelmandOverzicht']) && !empty($_POST['winkelmandOverzicht'])) {
//     $winkelmandOverzicht = $_POST['winkelmandOverzicht'];

//     if($winkelmandOverzicht == "getWinkelmandOverzicht"){
//     	getWinkelmandOverzicht();
//     }
// }

// function getWinkelmandOverzicht(){
// 	$cookie = isset($_COOKIE['winkelmandCookie']) ? $_COOKIE['winkelmandCookie'] : "";
// 	$cookie = stripslashes($cookie);
// 	$producten = json_decode($cookie, true);

// 	//$arrId = array();

// 	if(!$producten){
// 	    $producten = array();
// 	}

// 	if (empty($producten)) {
// 	     echo json_encode(0);
// 	}
// 	else{
// 		echo json_encode($producten);
// 	}
// }

function cookieRemoveProduct($id){
	$cookie = isset($_COOKIE['winkelmandCookie']) ? $_COOKIE['winkelmandCookie'] : "";
	$cookie = stripslashes($cookie);
	$producten = json_decode($cookie, true);

	if(!$producten){
	    $producten = array();
	}

	foreach($producten as $row => $innerArray){
	  foreach($innerArray as $innerRow => $value){
	    if($innerRow == "id" && $value == $id){
	  		unset($producten[$row]);
	  	}
	  }
	}
//	array_push($producten, array('id' => $id, 'aantal' => $aantal));

	$herstel = array_values($producten);

	// foreach($producten as $row => $innerArray){
	//   if(!$producten[$row] == "" || !$producten[$row] == NULL || $!producten[$row] == FALSE){

	//   }
	// }

	// if(count($herstel) < 1 || empty($producten)){
	// 	setcookie('winkelmandCookie', '', time()-60*60*24*90, '/', '', 0, 0);
	// 	unset($_COOKIE['winkelmandCookie']);
	// }
	// else{
		setcookie("winkelmandCookie", json_encode($herstel), time()+60*60*24*1, '/');
	//}

	

	//$producten = array_diff( $producten, array( '' ) );

	echo json_encode($herstel);
}

function cookieSetProduct($id, $aantal){
	// setcookie('winkelmandCookie', '', time()-60*60*24*90, '/', '', 0, 0);
	// unset($_COOKIE['winkelmandCookie']);

	$cookie = isset($_COOKIE['winkelmandCookie']) ? $_COOKIE['winkelmandCookie'] : "";
	$cookie = stripslashes($cookie);
	$producten = json_decode($cookie, true);

	if(!$producten){
	    $producten = array();
	}

	$zitErIn = 0;

	foreach($producten as $row => $innerArray){
	  foreach($innerArray as $innerRow => $value){
	    if($innerRow == "id" && $value == $id){
	  		$zitErIn = 1;
	  	}
	  }
	}

	if($zitErIn == 1){
		echo json_encode("bestaat al");
	}
	else{
		array_push($producten, array('id' => $id, 'aantal' => $aantal));
		setcookie("winkelmandCookie", json_encode($producten), time()+60*60*24*1, '/');
		echo json_encode($producten);
	}
}

if(isset($_POST['productData']) && !empty($_POST['productData'])) {
    $productData = $_POST['productData'];

	$beginpunt = $_POST['beginpunt'];
    $richting = $_POST['richting'];
    $categorie = $_POST['categorie'];

    if($productData == "getProductData"){
    	getProductData($beginpunt, $richting, $categorie);
    }
}

function getProductData($beginpunt, $richting, $categorie){
	// $servername = "localhost";
	// //$username = "osn_developer01";
	// //$password = "2?[?k0gZWOu0";
	// $username = "root";
	// $password = "";

	// // Create connection
	// //$mysqli = new mysqli($servername, $username, $password, "osn_arijs");
	// $mysqli = new mysqli($servername, $username, $password, "osn_arijs");

	// // Check connection
	// if ($mysqli->connect_error) {
	//     die("Connection failed: " . $mysqli->connect_error);
	// }

	global $mysqli;

	$arrId = array();
	$arrNaam = array();
	$arrPrijs = array();

	$aantalRecords = $mysqli->query("SELECT COUNT(*) FROM tblproduct WHERE categorieId = '$categorie'");
    $records = $aantalRecords->fetch_row();

    if($richting == 0){
		$nieuweBeginPunt = $beginpunt - 6;
		if($nieuweBeginPunt <= 0){
			$nieuweBeginPunt = 0;
		}
	}
	else if($richting == 1 && !(($beginpunt + 6) >= $records[0])){
		$nieuweBeginPunt = $beginpunt + 6;
	}

	if($resultaat = $mysqli->query("SELECT productId, productNaam, productPrijs FROM tblproduct WHERE categorieId = '$categorie' LIMIT $nieuweBeginPunt, 6")){
		while ($row = $resultaat->fetch_assoc()) {
    		array_push($arrId, $row["productId"]);
	        array_push($arrNaam, $row["productNaam"]);
	        array_push($arrPrijs, $row["productPrijs"]);
	    }
	    $productData = array("id" => $arrId, "naam" => $arrNaam, "prijs" => $arrPrijs, "nieuweBeginPunt" => $nieuweBeginPunt, "totaalProducten" => $records[0]);
	}

    echo json_encode($productData);
	
	$mysqli->close();
}

// function getProductId($categorie){
// 	$servername = "localhost";
// 	//$username = "osn_developer01";
// 	//$password = "2?[?k0gZWOu0";
// 	$username = "root";
// 	$password = "";

// 	// Create connection
// 	//$mysqli = new mysqli($servername, $username, $password, "osn_arijs");
// 	$mysqli = new mysqli($servername, $username, $password, "osn_arijs");

// 	// Check connection
// 	if ($mysqli->connect_error) {
// 	    die("Connection failed: " . $mysqli->connect_error);
// 	}
	
// 	$arrId = array();

// 	$resultaat = $mysqli->query("SELECT productId FROM tblproduct WHERE categorieId = '$categorie'");
	
// 	while ($row = $resultaat->fetch_assoc()) {
//         //echo '<option value="'.$row["clientId"].'>'.$row["studentFirstName"].' '.$row["studentLastName"].'</option>';
//         array_push($arrId, $row["productId"]);
//     }

//     echo json_encode($arrId);
	
// 	$mysqli->close();
// }

function getProductAfbeelding($productId){
	// $servername = "localhost";
	// //$username = "osn_developer01";
	// //$password = "2?[?k0gZWOu0";
	// $username = "root";
	// $password = "";

	// // Create connection
	// //$mysqli = new mysqli($servername, $username, $password, "osn_arijs");
	// $mysqli = new mysqli($servername, $username, $password, "osn_arijs");

	// // Check connection
	// if ($mysqli->connect_error) {
	//     die("Connection failed: " . $mysqli->connect_error);
	// }

	global $mysqli;
	
	$arrAfbeelding = array();

	for($i = 0; $i < count($productId); $i++){
		$resultaat = $mysqli->query("SELECT productAfbeelding FROM tblproduct WHERE productId = '$productId[$i]'");
		$row = $resultaat->fetch_assoc();
		//array_push($arrAfbeelding, $row["productAfbeelding"]);
		array_push($arrAfbeelding, 'data:image/jpeg;base64,' . base64_encode($row["productAfbeelding"]));
	}
    
    header("content-type: image/jpeg");

    echo json_encode($arrAfbeelding);
	$mysqli->close();
}

// function getProductNaam($productId){
// 	$servername = "localhost";
// 	//$username = "osn_developer01";
// 	//$password = "2?[?k0gZWOu0";
// 	$username = "root";
// 	$password = "";

// 	// Create connection
// 	//$mysqli = new mysqli($servername, $username, $password, "osn_arijs");
// 	$mysqli = new mysqli($servername, $username, $password, "osn_arijs");

// 	// Check connection
// 	if ($mysqli->connect_error) {
// 	    die("Connection failed: " . $mysqli->connect_error);
// 	}

// 	$arrNaam = array();

// 	for($i = 0; $i < count($productId); $i++){
// 		$resultaat = $mysqli->query("SELECT productNaam FROM tblproduct WHERE productId = '$productId[$i]'");
// 		$row = $resultaat->fetch_assoc();
// 		//array_push($arrAfbeelding, $row["productAfbeelding"]);
// 		array_push($arrNaam, $row["productNaam"]);
// 	}

//     echo json_encode($arrNaam);

// 	$mysqli->close();

// }

// function getProductPrijs($productId){
// 	$servername = "localhost";
// 	//$username = "osn_developer01";
// 	//$password = "2?[?k0gZWOu0";
// 	$username = "root";
// 	$password = "";

// 	// Create connection
// 	//$mysqli = new mysqli($servername, $username, $password, "osn_arijs");
// 	$mysqli = new mysqli($servername, $username, $password, "osn_arijs");

// 	// Check connection
// 	if ($mysqli->connect_error) {
// 	    die("Connection failed: " . $mysqli->connect_error);
// 	}

// 	$arrPrijs = array();

// 	for($i = 0; $i < count($productId); $i++){
// 		$resultaat = $mysqli->query("SELECT productPrijs FROM tblproduct WHERE productId = '$productId[$i]'");
// 		$row = $resultaat->fetch_assoc();
// 		//array_push($arrAfbeelding, $row["productAfbeelding"]);
// 		array_push($arrPrijs, $row["productPrijs"]);
// 	}

//     echo json_encode($arrPrijs);



// 	$mysqli->close();
// }

if(isset($_POST['funerariumTitel']) && !empty($_POST['funerariumTitel'])) {
    $funerariumTitel = $_POST['funerariumTitel'];
    $richting = $_POST['richting'];
    $beginpunt = $_POST['beginpunt'];
    if($funerariumTitel == "getFunerariumtitels"){
    	getFunerariumtitels($beginpunt, $richting);
    }
}

if(isset($_POST['funerariumAfbeelding']) && !empty($_POST['funerariumAfbeelding'])) {
    $funerariumAfbeelding = $_POST['funerariumAfbeelding'];
    $arrFunerariumId = $_POST['arrFunerariumId'];
    if($funerariumAfbeelding == "getFunerariumAfbeeldingen"){
    	getFunerariumAfbeeldingen($arrFunerariumId);
    }
}

function getFunerariumtitels($beginpunt, $richting){
	// $servername = "localhost";
	// //$username = "osn_developer01";
	// //$password = "2?[?k0gZWOu0";
	// $username = "root";
	// $password = "";

	// // Create connection
	// //$mysqli = new mysqli($servername, $username, $password, "osn_arijs");
	// $mysqli = new mysqli($servername, $username, $password, "osn_arijs");

	// // Check connection
	// if ($mysqli->connect_error) {
	//     die("Connection failed: " . $mysqli->connect_error);
	// }

	global $mysqli;

	$nieuweBeginPunt;
	$totaalAfbeeldingen;
	$pointer;
	
	$data = array();

	$arrTitel = array();
	$arrId = array();
	$afbeelding = array();

	$aantalRecords = $mysqli->query("SELECT COUNT(*) FROM tblfunerariumenaula");
    $records = $aantalRecords->fetch_row();
	
	if($richting == 0){
		$nieuweBeginPunt = $beginpunt - 4;
		if($nieuweBeginPunt < 0){
			$nieuweBeginPunt = 0;
		}
	}
	elseif($richting == 1 && !(($beginpunt + 4) >= $records[0])){
		$nieuweBeginPunt = $beginpunt + 4;		
	}

	if($records[0] - $nieuweBeginPunt <= 4){
		$nieuweBeginPunt = $records[0] - 4;
	}

	if($query = $mysqli->query("SELECT * FROM tblfunerariumenaula LIMIT $nieuweBeginPunt, 4")){
        if($query ->num_rows > 0){
            // $totaalAfbeeldingen = $query->num_rows;

            while($row = $query->fetch_assoc()){
            	array_push($arrTitel, $row['funerariumEnAulaNaam']);
            	array_push($arrId, $row['funerariumEnAulaId']);
            }
            
        }
        
        
  //       for($i = $nieuweBeginPunt; $i < ($nieuweBeginPunt + 4); $i++){
		// 	//console.log(i);
		// 	$pointer = (($i % $totaalAfbeeldingen) + $totaalAfbeeldingen) % $totaalAfbeeldingen;
		// 	$pointer += 1;

		// 	if($resultaatTitel = $mysqli->query("SELECT funerariumEnAulaNaam FROM tblfunerariumenaula WHERE funerariumEnAulaId = '$pointer'")){
		// 		if($resultaatTitel ->num_rows > 0){
		// 			$deTitel = $resultaatTitel->fetch_object();
		// 		}
		// 	}
		// 	array_push($arrTitel, $deTitel->funerariumEnAulaNaam);
		// }

		$funerariumData = array("id" => $arrId, "titel" => $arrTitel, "nieuweBeginPunt" => $nieuweBeginPunt);
		echo json_encode($funerariumData);
    }
	$mysqli->close();
}

function getFunerariumAfbeeldingen($arrFunerariumId){
	// $servername = "localhost";
	// //$username = "osn_developer01";
	// //$password = "2?[?k0gZWOu0";
	// $username = "root";
	// $password = "";

	// $mysqli = new mysqli($servername, $username, $password, "osn_arijs");

	// // Check connection
	// if ($mysqli->connect_error) {
	//     die("Connection failed: " . $mysqli->connect_error);
	// }

	global $mysqli;

	$arrAfbeelding = array();

	foreach ($arrFunerariumId as $value) {
	    if($resultaat = $mysqli->query("SELECT funerariumEnAulaAfbeelding FROM tblfunerariumenaula WHERE funerariumEnAulaId = $value")){
			$row = $resultaat->fetch_assoc();
			array_push($arrAfbeelding, 'data:image/jpeg;base64,' . base64_encode($row["funerariumEnAulaAfbeelding"]));
			
		}
	}

	// if($richting == 0){
	// 	$nieuweBeginPunt = $beginpunt - 4;
	// }
	// else{
	// 	$nieuweBeginPunt = $beginpunt + 4;
	// }

	// if($query = $mysqli->query("SELECT * FROM tblfunerariumenaula")){
	//     if($query ->num_rows > 0){
	//         $totaalAfbeeldingen = $query->num_rows;
	//     }
	//     for($i = $nieuweBeginPunt; $i < ($nieuweBeginPunt + 4); $i++){
	//     	$pointer = (($i % $totaalAfbeeldingen) + $totaalAfbeeldingen) % $totaalAfbeeldingen;
	// 		$pointer += 1;

	// 		if($resultaatAfbeelding = $mysqli->query("SELECT funerariumEnAulaAfbeelding FROM tblfunerariumenaula WHERE funerariumEnAulaId = '$pointer'")){
	// 			if($resultaatAfbeelding ->num_rows > 0){
	// 				$deAfbeelding = $resultaatAfbeelding->fetch_object();
	// 			}
	// 		}
	// 		array_push($arrAfbeelding, 'data:image/jpeg;base64,' . base64_encode($deAfbeelding->funerariumEnAulaAfbeelding));
	//     }
	// }

	header("content-type: image/jpeg");
	echo json_encode($arrAfbeelding);
	$mysqli->close();
}

// -------------------------------------------------- CONDOLEREN

if(isset($_POST['overledeneData']) && !empty($_POST['overledeneData'])) {
    $overledeneData = $_POST['overledeneData'];

    $offset = $_POST['offset'];
    $richting = $_POST['richting'];

    if($overledeneData == "getOverledeneData"){
    	getOverledeneData($offset, $richting);
    }
}

if(isset($_POST['overledeneFoto']) && !empty($_POST['overledeneFoto'])) {
    $overledeneFoto = $_POST['overledeneFoto'];

    $arrOverledeneId = $_POST['arrOverledeneId'];

    if($overledeneFoto == "getOverledeneFoto"){
    	getOverledeneFoto($arrOverledeneId);
    }
}

function getOverledeneData($offset, $richting){
	// $servername = "localhost";
	// //$username = "osn_developer01";
	// //$password = "2?[?k0gZWOu0";
	// $username = "root";
	// $password = "";

	// $mysqli = new mysqli($servername, $username, $password, "osn_arijs");
	// $mysqli->set_charset("utf8");

	// // Check connection
	// if ($mysqli->connect_error) {
	//     die("Connection failed: " . $mysqli->connect_error);
	// }

	global $mysqli;

	$arrId = array();
	$arrNaam = array();
    $arrTitel = array();
    $arrGeboorteplaats = array();
    $arrGeboortedatum = array();
    $arrPlaatsOverlijden = array();
    $arrDatumOverlijden = array();
    $arrWoonplaats = array();
    $arrRouwbrief = array();

    $aantalRecords = $mysqli->query("SELECT COUNT(*) FROM tblcondoleren");
    $records = $aantalRecords->fetch_row();

    if($richting == 0){
		$nieuweOffset = $offset - 10;
		if($nieuweOffset <= -10){
			$nieuweOffset = -10;
		}
	}
	else if($richting == 1 && !(($offset+10) >= $records[0])){
		$nieuweOffset = $offset + 10;
		
	}

    // if($offset >= $records[0]){
    // 	$offset = 0;
    // }

    // if($aantal > 10){
    // 	$aantal = 10;
    // }

    if($resultaat = $mysqli->query("SELECT overledeneId, voornaam, familienaam, titel, geboorteplaats, geboortedatum, plaatsOverlijden, datumOverlijden, woonplaats, rouwbrief FROM tblcondoleren ORDER BY datumOverlijden DESC LIMIT $nieuweOffset, 10")){
    	
    	while ($row = $resultaat->fetch_assoc()) {
    		// $jaarOverlijden = substr($row["datumOverlijden"], 0, 4);
    		// $maandOverlijden = getMaand(substr($row["datumOverlijden"], 5, 7));
    		// $dagOverlijden = substr($row["datumOverlijden"], 8);
    		// $datumOverlijden = $dagOverlijden . " " . $maandOverlijden . " " . $jaarOverlijden;

    		$geboorteDatum = getDatum($row["geboortedatum"]);
    		$datumOverlijden = getDatum($row["datumOverlijden"]);


    		array_push($arrId, $row["overledeneId"]);
	        array_push($arrNaam, $row["voornaam"] . " " . $row["familienaam"]);
	        array_push($arrTitel, $row["titel"]);
			array_push($arrGeboorteplaats, $row["geboorteplaats"]);
			array_push($arrGeboortedatum, $geboorteDatum);
			array_push($arrPlaatsOverlijden, $row["plaatsOverlijden"]);
			array_push($arrDatumOverlijden, $datumOverlijden);
			array_push($arrWoonplaats, $row["woonplaats"]);
			array_push($arrRouwbrief, $row["rouwbrief"]);
	    }

	    $overledeneData = array("id" => $arrId, "naam" => $arrNaam, "titel" => $arrTitel, "geboorteplaats" => $arrGeboorteplaats, "geboortedatum" => $arrGeboortedatum, "plaatsOverlijden" => $arrPlaatsOverlijden,
	 		"datumOverlijden" => $arrDatumOverlijden, "woonplaats" => $arrWoonplaats, "rouwbrief" => $arrRouwbrief, "nieuweOffset" => $nieuweOffset);
    }

	echo json_encode($overledeneData);

	$mysqli->close();
}

function getOverledeneFoto($arrOverledeneId){
	// $servername = "localhost";
	// //$username = "osn_developer01";
	// //$password = "2?[?k0gZWOu0";
	// $username = "root";
	// $password = "";

	// $mysqli = new mysqli($servername, $username, $password, "osn_arijs");
	// $mysqli->set_charset("utf8");

	// // Check connection
	// if ($mysqli->connect_error) {
	//     die("Connection failed: " . $mysqli->connect_error);
	// }

	global $mysqli;

	$arrFoto = array();

	foreach ($arrOverledeneId as $value) {
	    if($resultaat = $mysqli->query("SELECT foto FROM tblcondoleren WHERE overledeneId = $value")){
			$row = $resultaat->fetch_assoc();
			array_push($arrFoto, 'data:image/jpeg;base64,' . base64_encode($row["foto"]));
			
		}
	}

	header("content-type: image/jpeg");
	echo json_encode($arrFoto);
	$mysqli->close();
}

if(isset($_POST['laatsteOverledeneData']) && !empty($_POST['laatsteOverledeneData'])) {
    $laatsteOverledeneData = $_POST['laatsteOverledeneData'];

    if($laatsteOverledeneData == "getLaatsteOverledeneData"){
    	getLaatsteOverledeneData();
    }
}

if(isset($_POST['laatsteOverledeneFoto']) && !empty($_POST['laatsteOverledeneFoto'])) {
    $laatsteOverledeneFoto = $_POST['laatsteOverledeneFoto'];



    if($laatsteOverledeneFoto == "getLaatsteOverledeneFoto"){
    	getLaatsteOverledeneFoto();
    }
}

function getLaatsteOverledeneData(){
	// $servername = "localhost";
	// //$username = "osn_developer01";
	// //$password = "2?[?k0gZWOu0";
	// $username = "root";
	// $password = "";

	// $mysqli = new mysqli($servername, $username, $password, "osn_arijs");
	// $mysqli->set_charset("utf8");

	// // Check connection
	// if ($mysqli->connect_error) {
	//     die("Connection failed: " . $mysqli->connect_error);
	// }

	global $mysqli;

    $arrNaam = array();
    $arrTitel = array();
    $arrGeboorteplaats = array();
    $arrGeboortedatum = array();
    $arrPlaatsOverlijden = array();
    $arrDatumOverlijden = array();
    $arrWoonplaats = array();
    $arrRouwbrief = array();

	for($i = 0; $i < 4; $i++){
		$resultaat = $mysqli->query("SELECT voornaam, familienaam, titel, geboorteplaats, geboortedatum, plaatsOverlijden, datumOverlijden, woonplaats, rouwbrief FROM tblcondoleren ORDER BY datumOverlijden DESC LIMIT $i, 1");
		$row = $resultaat->fetch_assoc();

		// $jaarOverlijden = substr($row["datumOverlijden"], 0, 4);
		// $maandOverlijden = getMaand(substr($row["datumOverlijden"], 5, 7));
		// $dagOverlijden = substr($row["datumOverlijden"], 8);
		// $datumOverlijden = $dagOverlijden . " " . $maandOverlijden . " " . $jaarOverlijden;

		$geboorteDatum = getDatum($row["geboortedatum"]);
		$datumOverlijden = getDatum($row["datumOverlijden"]);
		
		array_push($arrNaam, $row["voornaam"] . " " . $row["familienaam"]);
		array_push($arrTitel, $row["titel"]);
		array_push($arrGeboorteplaats, $row["geboorteplaats"]);
		array_push($arrGeboortedatum, $geboorteDatum);
		array_push($arrPlaatsOverlijden, $row["plaatsOverlijden"]);
		array_push($arrDatumOverlijden, $datumOverlijden);
		array_push($arrWoonplaats, $row["woonplaats"]);
		array_push($arrRouwbrief, $row["rouwbrief"]);
	}

	$overledeneData = array("naam" => $arrNaam, "titel" => $arrTitel, "geboorteplaats" => $arrGeboorteplaats, "geboortedatum" => $arrGeboortedatum, "plaatsOverlijden" => $arrPlaatsOverlijden,
	 "datumOverlijden" => $arrDatumOverlijden, "woonplaats" => $arrWoonplaats, "rouwbrief" => $arrRouwbrief);

    echo json_encode($overledeneData);

	$mysqli->close();
}

function getDatum($d){
	$jaar = substr($d, 0, 4);
	$maand = getMaand(substr($d, 5, 7));
	$dag = substr($d, 8);

	return $dag . " " . $maand . " " . $jaar;
}

function getMaand($m){
	switch ($m) {
		case 01:
			$maand = "januari";
			break;
		case 02:
			$maand = "februari";
			break;
		case 03:
			$maand = "maart";
			break;
		case 04:
			$maand = "april";
			break;
		case 05:
			$maand = "mei";
			break;
		case 06:
			$maand = "juni";
			break;
		case 07:
			$maand = "juli";
			break;
		case 08:
			$maand = "augustus";
			break;
		case 09:
			$maand = "september";
			break;
		case 10:
			$maand = "oktober";
			break;
		case 11:
			$maand = "november";
			break;
		case 12:
			$maand = "december";
			break;
		default:
			$maand = "n/a";
	}

	return $maand;
}

function getLaatsteOverledeneFoto(){
	// $servername = "localhost";
	// //$username = "osn_developer01";
	// //$password = "2?[?k0gZWOu0";
	// $username = "root";
	// $password = "";

	// $mysqli = new mysqli($servername, $username, $password, "osn_arijs");
	// $mysqli->set_charset("utf8");

	// // Check connection
	// if ($mysqli->connect_error) {
	//     die("Connection failed: " . $mysqli->connect_error);
	// }

	global $mysqli;

	$arrFoto = array();

	for($i = 0; $i < 4; $i++){
		$resultaat = $mysqli->query("SELECT foto FROM tblcondoleren ORDER BY datumOverlijden DESC LIMIT $i, 1");
		$row = $resultaat->fetch_assoc();
		
		array_push($arrFoto, 'data:image/jpeg;base64,' . base64_encode($row["foto"]));
	}


	//array_push($arrAfbeelding, 'data:image/jpeg;base64,' . base64_encode($deAfbeelding->funerariumEnAulaAfbeelding));

	header("content-type: image/jpeg");
	echo json_encode($arrFoto);
	$mysqli->close();
}

if(isset($_POST['formSubmit']) && !empty($_POST['formSubmit'])) {
    $formSubmit = $_POST['formSubmit'];

    $deForm = $_POST['deForm'];

    if($formSubmit == "formSubmit"){
    	formSubmit($deForm);
    }
}

function formSubmit($deForm){
	// $servername = "localhost";
	// //$username = "osn_developer01";
	// //$password = "2?[?k0gZWOu0";
	// $username = "root";
	// $password = "";

	// $mysqli = new mysqli($servername, $username, $password, "osn_arijs");
	// $mysqli->set_charset("utf8");

	// // Check connection
	// if ($mysqli->connect_error) {
	//     die("Connection failed: " . $mysqli->connect_error);
	// }

	global $mysqli;

	$params = array();
	parse_str($deForm, $params);


	
	echo json_encode($params);
	$mysqli->close();
}

// -------------------------------------------------- CREADS

if(isset($_POST['getCread']) && !empty($_POST['getCread'])) {
    $getCread = $_POST['getCread'];

    if($getCread == "getCread"){
    	getCread();
    }
}

function getCread(){
	$klantid = 7425;

	$db_life_host = "www.ondernemers-en-shoppingnetwerk.be:3306";
	//$db_life_host = "localhost";
	$db_life_user='osn_user007';
	$db_life_pass='Q#j$3NNbSDB.';
	$db_life = "osn_osndb";

	$con=mysqli_connect($db_life_host,$db_life_user,$db_life_pass,$db_life);

	$adres_query = mysqli_query($con, "SELECT * FROM tblADRES WHERE klantID = $klantid");
	$adres = mysqli_fetch_array($adres_query);

	$locatie_query = mysqli_query($con, "SELECT * FROM tblLOCATIE WHERE idLOCATIE =  '".$adres['locatieID']."'");
	$locatie = mysqli_fetch_array($locatie_query);

	$vertalingid = mysqli_query($con, "SELECT * FROM tblVERTALING WHERE idVERTALING =  '".$locatie['locatieNAAM']."'");
	$gemeentevertaling = mysqli_fetch_array($vertalingid);

	$klant_query = mysqli_query($con, "SELECT * FROM tblKLANT WHERE idKLANT = '$klantid'");
	$klant = mysqli_fetch_array($klant_query);

	$vertalingid = mysqli_query($con, "SELECT * FROM tblVERTALING WHERE idVERTALING = {$klant['naam']}");
	$klantnaam = mysqli_fetch_array($vertalingid);

	$gemeente = urlencode($gemeentevertaling['nl']);
	$gemeente = str_replace("+-+", "-", $gemeente);
	$gemeente = str_replace("+", "-", $gemeente);
	$gemeente = str_replace("%27", "-", $gemeente);
	$gemeente = str_replace(array("%C2","%E4","%E0","%E2"), "a", $gemeente);
	$gemeente = str_replace(array("%EA","%E8","%EB","%E9"), "e", $gemeente);
	$gemeente = str_replace(array("%EE","%EF"), "i", $gemeente);
	$gemeente = str_replace(array("%F6","%F4"), "o", $gemeente);
	$gemeente = str_replace(array("%FB","%FC"), "u", $gemeente);
	$gemeente = str_replace("%E7", "c", $gemeente);
	$gemeente= str_replace(array("%29","%28","(",")"), "", $gemeente);

	$klantnaamwithdashes = str_replace(' ', '-', $klantnaam[1]);

	$klantnaamwithdashes= str_replace(array("(",")"), "", $klantnaamwithdashes);

	if($locatie['locatieTYPE'] == "Deelgemeente")
	  $url = "http://www.ondernemers-en-shoppingnetwerk.be/{$gemeente}-{$locatie['locatiePOSTCODE']}/{$klantnaamwithdashes}/{$klantid}/overons/{$locatie['locatiePARENT']}/gemeente";
	else
	  $url = "http://www.ondernemers-en-shoppingnetwerk.be/{$gemeente}-{$locatie['locatiePOSTCODE']}/{$klantnaamwithdashes}/{$klantid}/overons/{$locatie['idLOCATIE']}/gemeente";


	$html = file_get_contents($url);

	$doc = new DOMDocument();
	@$doc->loadHTML($html);

	$tags = $doc->getElementsByTagName('img');
	$overons_files = array();

	foreach ($tags as $tag) {
	  $src = $tag->getAttribute('src');
	  if (strpos($src, 'CREAD') ||  strpos($src, 'creads')) $overons_files[] = "http://ondernemers-en-shoppingnetwerk.be{$tag->getAttribute('src')}";
	}

	if (is_array($overons_files) && count($overons_files) >= 1) {
		//foreach ($overons_files as $filename) echo " <img class='contact_bg' src='$filename'/>";
	  	// echo " <img class='contact_bg' src='$overons_files[0]'/>";

	  	echo json_encode($overons_files);
	}
	else{
		// echo " <img class='contact_bg' src='images/overons_default.png'/>";
	}

	//echo json_encode("test");
	$con->close();
}

?>