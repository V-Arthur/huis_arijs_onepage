<?php
if(isset($_POST['uitvaartwinkelAfbeelding']) && !empty($_POST['uitvaartwinkelAfbeelding'])) {
    $uitvaartwinkelAfbeelding = $_POST['uitvaartwinkelAfbeelding'];
    $richting = $_POST['richting'];
    $beginpunt = $_POST['beginpunt'];
    $categorie = $_POST['categorie'];
    if($uitvaartwinkelAfbeelding == "getUitvaartwinkelAfbeeldingen"){
    	getUitvaartwinkelAfbeeldingen($beginpunt, $richting, $categorie);
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

function getUitvaartwinkelAfbeeldingen($beginpunt, $richting, $categorie){
	$servername = "localhost";
	//$username = "osn_developer01";
	//$password = "2?[?k0gZWOu0";
	$username = "root";
	$password = "";

	$arrAfbeelding = array();
	//$arrTempAfbeelding = array();

	// Create connection
	//$mysqli = new mysqli($servername, $username, $password, "osn_arijs");
	$mysqli = new mysqli($servername, $username, $password, "osn_arijs");

	// Check connection
	if ($mysqli->connect_error) {
	    die("Connection failed: " . $mysqli->connect_error);
	}

	if($richting == 0){
		$nieuweBeginPunt = $beginpunt - 6;
		//console.log($nieuweBeginPunt);
		//echo($nieuweBeginPunt);
	}
	else{
		$nieuweBeginPunt = $beginpunt + 6;
		//echo($nieuweBeginPunt);
	}

	//$query = "SELECT productAfbeelding FROM tblproduct WHERE categorieId = '$categorie'";
	$resultaat = $mysqli->query("SELECT productAfbeelding FROM tblproduct WHERE categorieId = '$categorie'");

	if($resultaat ->num_rows > 0){
		//$deAfbeelding = $resultaat->fetch_object();
		
	}

	while ($row = $resultaat->fetch_assoc()) {
        //echo '<option value="'.$row["clientId"].'>'.$row["studentFirstName"].' '.$row["studentLastName"].'</option>';
        array_push($arrAfbeelding, 'data:image/jpeg;base64,' . base64_encode($row["productAfbeelding"]));
    }


	
	/*
	while($resultaat->fetch_object()) {
		array_push($arrAfbeelding, 'data:image/jpeg;base64,' . base64_encode($resultaat->productAfbeelding));
		//$arrAfbeelding[] = json_encode();
	}


/*
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
	
*/
	header("content-type: image/jpeg");
	echo json_encode($arrAfbeelding);
	$mysqli->close();

	/*
	for(i = $nieuweBeginPunt; i < ($nieuweBeginPunt + 6); i++){
		

		$uitvaartwinkelurl.push($producten.find('url').eq($pointer).text());


		$uitvaartwinkelprijs.push($producten.find('prijs').eq($pointer).text());
		$uitvaartwinkelbeschrijving.push($producten.find('beschrijving').eq($pointer).text());
		$uitvaartwinkelrangnummer.push($pointer + 1);
		$uitvaartwinkelProductID.push($producten.find('id').eq($pointer).text());
	}
	*/



	/*
	if($query = $mysqli->query("SELECT * FROM tblproduct")){
    if($query ->num_rows > 0){
        $totaalAfbeeldingenUitvaartwinkel = $query->num_rows;
        //echo json_encode($totaalAfbeeldingen);
    }
}


//echo json_encode("hallo");

if($query = $mysqli->query("SELECT productAfbeelding FROM tblproduct WHERE categorieId = '$categorie'")){
	
    while ($arrAfbeelding = mysql_fetch_array($query, MYSQL_NUM)) {
	    $arrAfbeelding[] = $arrAfbeelding; 
	}

    
    echo json_encode($arrAfbeelding);
	//echo json_encode($totaalAfbeeldingen);

    /*
	for($i = 0; $i < $resultaatAfbeelding ->num_rows; $i++){
		$deAfbeelding = $resultaatAfbeelding->fetch_object();


		array_push($arrTempAfbeelding, 'data:image/jpeg;base64,' . base64_encode($deAfbeelding->productAfbeelding));
	}
	*/
	//echo json_encode($deAfbeelding);

	
//	for($i = $nieuweBeginPunt; $i < ($nieuweBeginPunt + 6); $i++){
		//console.log(i);
//		$pointer = (($i % $totaalAfbeeldingenUitvaartwinkel) + $totaalAfbeeldingenUitvaartwinkel) % $totaalAfbeeldingenUitvaartwinkel;
		//echo json_encode("test");
		//$pointer += 1;

		/*
		if($resultaatAfbeelding ->num_rows > 0){
			$deAfbeelding = $resultaatAfbeelding->fetch_object();
			
		}
		*/

		/*
		if($resultaatAfbeelding = $mysqli->query("SELECT productNaam FROM tblproduct WHERE categorieId = '$categorie'")){
			if($resultaatAfbeelding ->num_rows > 0){
				//$deAfbeelding = $resultaatAfbeelding->fetch_object();
				
			}
		}
		*/
		
		//array_push($arrAfbeelding, $arrTempAfbeelding[$pointer]);


	
//	}
	//echo($resultaatAfbeelding ->num_rows);

//}
//	*/
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