<?php
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

if(isset($_POST['cookieSetProduct']) && !empty($_POST['cookieSetProduct'])) {
    $cookieSetProduct = $_POST['cookieSetProduct'];

    $productId = $_POST['Id'];
    $aantal = $_POST['aantal'];

    if($cookieSetProduct == "cookieSetProduct"){
    	cookieSetProduct($productId, $aantal);
    }
}

if(isset($_POST['winkelmandOverzicht']) && !empty($_POST['winkelmandOverzicht'])) {
    $winkelmandOverzicht = $_POST['winkelmandOverzicht'];

    if($winkelmandOverzicht == "getWinkelmandOverzicht"){
    	getWinkelmandOverzicht();
    }
}

function getWinkelmandOverzicht(){
	$cookie = isset($_COOKIE['winkelmandCookie']) ? $_COOKIE['winkelmandCookie'] : "";
	$cookie = stripslashes($cookie);
	$producten = json_decode($cookie, true);

	$arrId = array();

	if(!$producten){
	    $producten = array();
	}

	if (empty($producten)) {
	     echo json_encode("array is leeg");
	}
	else{
		echo json_encode($producten);
	}

}

function cookieSetProduct($id, $aantal){
	// cookie wijzigen met / achteraan?
	// setcookie('footer', rand(0, 3434543), $exp_date, '/');

	//$gebruikerid = filter_input(INPUT_COOKIE, "GebruikerId");

	// setcookie("winkelmandCookie", "");
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



	// foreach($producten as $row => $innerArray){
	//   foreach($innerArray as $innerRow => $value){
	//   	if($innerRow == "id" && $value == $id){
	//   		//echo json_encode($value . "<br/>");
	//   		echo json_encode("bestaat al");
	//   	}
	//   	else{
	//   		array_push($producten, array('id' => $id, 'aantal' => $aantal));
	// 		//array_push($producten, "id"=>$id, "aantal"=>$aantal);
	// 		setcookie("winkelmandCookie", json_encode($producten), time()+60*60*24*1, '/');

	// 		echo json_encode($producten);
	// 	}
	    
	//   }
	// }


	// if(array_key_exists($id, $producten)){
	//     // redirect to product list and tell the user it was added to cart
	//     //echo json_encode("bestaat al");
	// }
	// else{
		// array_push($producten, array('id' => $id, 'aantal' => $aantal));
		//array_push($producten, "id"=>$id, "aantal"=>$aantal);
		// setcookie("winkelmandCookie", json_encode($producten), time()+60*60*24*1, '/');

		//echo json_encode($producten);
	// }

		

	// echo json_encode($zitErIn);


/*
	if(isset($_COOKIE["winkelmandCookie"])){
		$cookie = $_COOKIE['winkelmandCookie'];
		$cookie = stripslashes($cookie);
		$producten = json_decode($cookie, true);
		//$producten = json_decode($_COOKIE["winkelmandCookie"]);

		//if(count($saved_cart_items)>0){
	        // foreach($producten as $key=>$value){
	        //     // add old item to array, it will prevent duplicate keys
	        //     $cart_items[$key]=array(
	        //         'quantity'=>$value['quantity']
	        //     );
	        // }
	    //}

		// put item to cookie
	    //$json = json_encode($cart_items, true);
	    //setcookie("winkelmandCookie", $json, time() + (86400 * 30), '/'); // 86400 = 1 day
	    //$_COOKIE['winkelmandCookie']=$json;

		//setcookie("winkelmandCookie", FALSE);
		

		for($i = 0; $i < count($producten); $i++){

		}
		array_push($producten, array('id' => $id, 'aantal' => $aantal));
		setcookie("winkelmandCookie", json_encode($producten), time()+60*60*24*1, '/');

		echo json_encode($producten);





		//if(count($saved_cart_items)>0){
	        // foreach($producten as $key=>$value){
	        //     // add old item to array, it will prevent duplicate keys
	        //     $cart_items[$key]=array(
	        //         'quantity'=>$value['quantity']
	        //     );
	        // }
	    //}

		// put item to cookie
	    //$json = json_encode($cart_items, true);
	    //setcookie("winkelmandCookie", $json, time() + (86400 * 30), '/'); // 86400 = 1 day
	    //$_COOKIE['winkelmandCookie']=$json;

		// setcookie('winkelmandCookie', '', time()-60*60*24*90, '/', '', 0, 0);
  //   	unset($_COOKIE['winkelmandCookie']);
		
		// for($i = 0; $i < count($producten); $i++){
		// 	if($producten[i] == $id){
		// 		$alInWinkelmand = true;
		// 	}
		// }

		//if(!$alInWinkelmand){
			// array_push($producten, array('id' => $id, 'aantal' => $aantal));
			// setcookie("winkelmandCookie", json_encode($producten), time()+60*60*24*1, '/');
		//}









	}
	else{
		$producten = array(array('id' => $id, 'aantal' => $aantal));
		setcookie("winkelmandCookie", json_encode($producten), time()+60*60*24*1);

		echo json_encode("test");
	}


	//$var = json_decode($_COOKIE["winkelmandCookie"], true);
	//array_push($var, array($id+5, $aantal+5));

	//echo json_encode($var);

	*/
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
    //return $arrAfbeelding;
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