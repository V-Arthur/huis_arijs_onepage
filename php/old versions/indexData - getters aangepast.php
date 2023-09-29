<?php
if(isset($_POST['uitvaartwinkelAfbeelding']) && !empty($_POST['uitvaartwinkelAfbeelding'])) {
    $uitvaartwinkelAfbeelding = $_POST['uitvaartwinkelAfbeelding'];
    $categorie = $_POST['categorie'];
    $beginpunt = $_POST['beginpunt'];
    $richting = $_POST['richting'];
    //$eindpunt = $_POST['eindpunt'];
    
    if($uitvaartwinkelAfbeelding == "getUitvaartwinkelAfbeeldingen"){
    	getUitvaartwinkelAfbeeldingen($categorie, $beginpunt, $richting);
    }
}


if(isset($_POST['uitvaartwinkelId']) && !empty($_POST['uitvaartwinkelId'])) {
    $uitvaartwinkelId = $_POST['uitvaartwinkelId'];
    $richting = $_POST['richting'];
    $beginpunt = $_POST['beginpunt'];
    $categorie = $_POST['categorie'];
    if($uitvaartwinkelId == "getUitvaartwinkelId"){
    	getUitvaartwinkelId($categorie, $beginpunt, $richting);
    }
}


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
    $richting = $_POST['richting'];
    $beginpunt = $_POST['beginpunt'];
    if($funerariumAfbeelding == "getFunerariumAfbeeldingen"){
    	getFunerariumAfbeeldingen($beginpunt, $richting);
    }
}


if(isset($_POST['productId']) && !empty($_POST['productId'])) {
    $productId = $_POST['productId'];

    $categorie = $_POST['categorie'];

    if($productId == "getProductId"){
    	getProductId($categorie);
    }
}


if(isset($_POST['productAfbeelding']) && !empty($_POST['productAfbeelding'])) {
    $productAfbeelding = $_POST['productAfbeelding'];

    $productId = $_POST['Id'];

    if($productAfbeelding == "getProductAfbeelding"){
    	getProductAfbeelding($productId);
    }
}

if(isset($_POST['productNaam']) && !empty($_POST['productNaam'])) {
    $productNaam = $_POST['productNaam'];

    $productId = $_POST['Id'];

    if($productNaam == "getProductNaam"){
    	getProductNaam($productId);
    }
}

if(isset($_POST['productPrijs']) && !empty($_POST['productPrijs'])) {
    $productPrijs = $_POST['productPrijs'];

    $productId = $_POST['Id'];

    if($productPrijs == "getProductPrijs"){
    	getProductPrijs($productId);
    }
}

function getProductId($categorie){
	$servername = "localhost";
	//$username = "osn_developer01";
	//$password = "2?[?k0gZWOu0";
	$username = "root";
	$password = "";

	// Create connection
	//$mysqli = new mysqli($servername, $username, $password, "osn_arijs");
	$mysqli = new mysqli($servername, $username, $password, "osn_arijs");

	// Check connection
	if ($mysqli->connect_error) {
	    die("Connection failed: " . $mysqli->connect_error);
	}

	$arrId = array();

	$resultaat = $mysqli->query("SELECT productId FROM tblproduct WHERE categorieId = '$categorie'");
	
	while ($row = $resultaat->fetch_assoc()) {
        //echo '<option value="'.$row["clientId"].'>'.$row["studentFirstName"].' '.$row["studentLastName"].'</option>';
        array_push($arrId, $row["productId"]);
    }

    echo json_encode($arrId);
	
	$mysqli->close();
}

function getProductAfbeelding($productId){
	$servername = "localhost";
	//$username = "osn_developer01";
	//$password = "2?[?k0gZWOu0";
	$username = "root";
	$password = "";

	// Create connection
	//$mysqli = new mysqli($servername, $username, $password, "osn_arijs");
	$mysqli = new mysqli($servername, $username, $password, "osn_arijs");

	// Check connection
	if ($mysqli->connect_error) {
	    die("Connection failed: " . $mysqli->connect_error);
	}
	
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

function getProductNaam($productId){
	$servername = "localhost";
	//$username = "osn_developer01";
	//$password = "2?[?k0gZWOu0";
	$username = "root";
	$password = "";

	// Create connection
	//$mysqli = new mysqli($servername, $username, $password, "osn_arijs");
	$mysqli = new mysqli($servername, $username, $password, "osn_arijs");

	// Check connection
	if ($mysqli->connect_error) {
	    die("Connection failed: " . $mysqli->connect_error);
	}

	$arrNaam = array();

	for($i = 0; $i < count($productId); $i++){
		$resultaat = $mysqli->query("SELECT productNaam FROM tblproduct WHERE productId = '$productId[$i]'");
		$row = $resultaat->fetch_assoc();
		//array_push($arrAfbeelding, $row["productAfbeelding"]);
		array_push($arrNaam, $row["productNaam"]);
	}

    echo json_encode($arrNaam);

	$mysqli->close();

}

function getProductPrijs($productId){
	$servername = "localhost";
	//$username = "osn_developer01";
	//$password = "2?[?k0gZWOu0";
	$username = "root";
	$password = "";

	// Create connection
	//$mysqli = new mysqli($servername, $username, $password, "osn_arijs");
	$mysqli = new mysqli($servername, $username, $password, "osn_arijs");

	// Check connection
	if ($mysqli->connect_error) {
	    die("Connection failed: " . $mysqli->connect_error);
	}

	$arrPrijs = array();

	for($i = 0; $i < count($productId); $i++){
		$resultaat = $mysqli->query("SELECT productPrijs FROM tblproduct WHERE productId = '$productId[$i]'");
		$row = $resultaat->fetch_assoc();
		//array_push($arrAfbeelding, $row["productAfbeelding"]);
		array_push($arrPrijs, $row["productPrijs"]);
	}

    echo json_encode($arrPrijs);



	$mysqli->close();
}

function getUitvaartwinkelAfbeeldingen($categorie, $beginpunt, $richting){
	$servername = "localhost";
	//$username = "osn_developer01";
	//$password = "2?[?k0gZWOu0";
	$username = "root";
	$password = "";

	// Create connection
	//$mysqli = new mysqli($servername, $username, $password, "osn_arijs");
	$mysqli = new mysqli($servername, $username, $password, "osn_arijs");

	// Check connection
	if ($mysqli->connect_error) {
	    die("Connection failed: " . $mysqli->connect_error);
	}

	$arrAfbeelding = array();

	$aantal = $mysqli->query("SELECT COUNT(*) FROM tblproduct WHERE categorieId = '$categorie'");
	
	$data = $aantal->fetch_row();
	//echo json_encode($data[0]);
	
	if($richting == 0){
		$nieuweBeginPunt = $beginpunt - 6;
		$nieuweEindPunt = $nieuweBeginPunt + 6;
	}
	else{
		$nieuweBeginPunt = $beginpunt + 6;
		$nieuweEindPunt = $nieuweBeginPunt + 6;
	}

	for($i = $nieuweBeginPunt; $i < $nieuweEindPunt; $i++){
		$pointer = (($i % $data[0]) + $data[0]) % $data[0];		
		$resultaat = $mysqli->query("SELECT productAfbeelding FROM tblproduct WHERE categorieId = '$categorie' LIMIT $pointer,1");
		$row = $resultaat->fetch_assoc();
		array_push($arrAfbeelding, 'data:image/jpeg;base64,' . base64_encode($row["productAfbeelding"]));
	}

	header("content-type: image/jpeg");
	echo json_encode($arrAfbeelding);
	$mysqli->close();
}

function getUitvaartwinkelId($categorie, $beginpunt, $richting){
	$servername = "localhost";
	//$username = "osn_developer01";
	//$password = "2?[?k0gZWOu0";
	$username = "root";
	$password = "";

	$arrId = array();

	// Create connection
	//$mysqli = new mysqli($servername, $username, $password, "osn_arijs");
	$mysqli = new mysqli($servername, $username, $password, "osn_arijs");

	// Check connection
	if ($mysqli->connect_error) {
	    die("Connection failed: " . $mysqli->connect_error);
	}

	$aantal = $mysqli->query("SELECT COUNT(*) FROM tblproduct WHERE categorieId = '$categorie'");
	
	$data = $aantal->fetch_row();
	//echo json_encode($data[0]);
	
	if($richting == 0){
		$nieuweBeginPunt = $beginpunt - 6;
		$nieuweEindPunt = $nieuweBeginPunt + 6;
	}
	else{
		$nieuweBeginPunt = $beginpunt + 6;
		$nieuweEindPunt = $nieuweBeginPunt + 6;
	}

	for($i = $nieuweBeginPunt; $i < $nieuweEindPunt; $i++){
		$pointer = (($i % $data[0]) + $data[0]) % $data[0];		
		$resultaat = $mysqli->query("SELECT productId FROM tblproduct WHERE categorieId = '$categorie' LIMIT $pointer,1");
		$row = $resultaat->fetch_assoc();
		array_push($arrId, $row["productId"]);
	}


	echo json_encode($arrId);
	$mysqli->close();
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
	$mysqli = new mysqli($servername, $username, $password, "osn_arijs");

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
        //echo($query["funerariumEnAulaId"]);
        
        for($i = $nieuweBeginPunt; $i < ($nieuweBeginPunt + 4); $i++){
			//console.log(i);
			$pointer = (($i % $totaalAfbeeldingen) + $totaalAfbeeldingen) % $totaalAfbeeldingen;
			$pointer += 1;

			if($resultaatTitel = $mysqli->query("SELECT funerariumEnAulaNaam FROM tblfunerariumenaula WHERE funerariumEnAulaId = '$pointer'")){
				if($resultaatTitel ->num_rows > 0){
					$deTitel = $resultaatTitel->fetch_object();
				}
			}
			array_push($arrTitel, $deTitel->funerariumEnAulaNaam);
		}
		echo json_encode($arrTitel);
    }
	$mysqli->close();
}

function getFunerariumAfbeeldingen($beginpunt, $richting){
	$servername = "localhost";
	//$username = "osn_developer01";
	//$password = "2?[?k0gZWOu0";
	$username = "root";
	$password = "";

	$mysqli = new mysqli($servername, $username, $password, "osn_arijs");

	$arrAfbeelding = array();

	// Check connection
	if ($mysqli->connect_error) {
	    die("Connection failed: " . $mysqli->connect_error);
	}

	if($richting == 0){
		$nieuweBeginPunt = $beginpunt - 4;
	}
	else{
		$nieuweBeginPunt = $beginpunt + 4;
	}

	if($query = $mysqli->query("SELECT * FROM tblfunerariumenaula")){
	    if($query ->num_rows > 0){
	        $totaalAfbeeldingen = $query->num_rows;
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
	$mysqli->close();
}


// -------------------------------------------------- CREADS

/*

$db_life_host = "www.ondernemers-en-shoppingnetwerk.be:3306";
$db_life_user='osn_user007';
$db_life_pass='Q#j$3NNbSDB.';
$db_life = "osn_osndb";

$con=mysqli_connect($db_life_host,$db_life_user,$db_life_pass,$db_life);

$klantid = 3917;

$locatie_query = mysqli_query($con, "SELECT * FROM tblLOCATIE WHERE idLOCATIE =  '".$adres['locatieID']."'");
$locatie = mysqli_fetch_array($locatie_query);

//$adres_query = mysqli_query($con, "SELECT * FROM tblADRES WHERE klantID = $klantid");
//$adres = mysqli_fetch_array($adres_query);


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
    foreach ($overons_files as $filename) echo " <img class='contact_bg' src='$filename'/>";
} else
    echo " <img class='contact_bg' src='images/overons_default.png'/>";



*/


?>