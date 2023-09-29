<?php
require 'connection.php';

require_once 'PHPMailerAutoload.php';
require_once 'class.phpmailer.php';
require_once 'class.smtp.php';

if(isset($_POST['valideerGegevens'])){
	$arrGegevens = $_POST["arrGegevens"];
	$isBedrijf = $_POST["isBedrijf"];

	$isValid = true;

	$onderwerp = "Huis Arijs orderbevestiging";
	$titel = "";
	$voornaam = "";
	$familienaam = "";
	$telefoon = "";
	$aan = "";
	$straat = "";
	$nummer = "";
	$postcode = "";
	$gemeente = "";
	$bedrijf = "NULL";
	$btwnummer = "NULL";
	$tekstLintKaart = "";
	$datumBegrafenis = "";
	$naamOverledene = "";

	// foreach($arrGegevens as $row => $innerArray){
	//   foreach($innerArray as $innerRow => $value){
	//   	// switch ($innerRow) {
	//   		// case 'titel':
	//   		// 	if(!($value == "m"  || $value == "v" || $value != "")){
	//   		// 		$isValid = false;
	//   		// 	}
	//   		// 	break;
	//   		// case "voornaam":
	//   		// 	if($value != ""){
	//   		// 		$isValid = false;
	//   		// 	}
	//   		// 	break;
	//   		// case "familienaam":
	//   		// 	if($value == ""){
	//   		// 		$isValid = false;
	//   		// 	}
	//   		// 	break;
	//   		// // default:
	//   		// // 	# code...
	//   		// // 	break;
	//   	// }
	//   	array_push($arrTest, $value);
	//   }
	// }

	// $arrTest = array();
	// if(!($arrGegevens[0]["name"] == "titel")){
	// 	$isValid = false;
	// 	if(!($arrGegevens[0]["value"] == "m") || !($arrGegevens[0]["value"] == "v")){
	// 		$isValid = false;
	// 	}
	// }

	for($i = 0; $i < count($arrGegevens); $i++){
		switch($arrGegevens[$i]["name"]){
			case 'titel':
	  			if(!($arrGegevens[$i]["value"] == "m"  || $arrGegevens[$i]["value"] == "v" || $arrGegevens[$i]["value"] != "")){
	  				$isValid = false;
	  			}
	  			else{
	  				$titel = $arrGegevens[$i]["value"];
	  			}
	  			break;
	  		case "voornaam":
	  			if($arrGegevens[$i]["value"] == ""){
	  				$isValid = false;
	  			}
	  			else{
	  				$voornaam = $arrGegevens[$i]["value"];
	  			}
	  			break;
	  		case "familienaam":
	  			if($arrGegevens[$i]["value"] == ""){
	  				$isValid = false;
	  			}
	  			else{
	  				$familienaam = $arrGegevens[$i]["value"];
	  			}
	  			break;
	  		case "telefoon":
	  			if($arrGegevens[$i]["value"] != ""){
	  				if(!preg_match("/^[0-9]{9,10}$/", preg_replace('/\s+/', '', $arrGegevens[$i]["value"]))){
	  					$isValid = false;
	  				}
	  				else{
	  					$telefoon = $arrGegevens[$i]["value"];
	  				}
	  			}
	  			else{
	  				$telefoon = "NULL";
	  			}
	  			break;
	  		case "email":
	  			$regex = '/^([a-z\d!#$%&"*+\-\/=?^_`{|}~\x{00A0}-\x{D7FF}\x{F900}-\x{FDCF}\x{FDF0}-\x{FFEF}]+(\.[a-z\d!#$%&"*+\-\/=?^_`{|}~\x{00A0}-\x{D7FF}\x{F900}-\x{FDCF}\x{FDF0}-\x{FFEF}]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\x{00A0}-\x{D7FF}\x{F900}-\x{FDCF}\x{FDF0}-\x{FFEF}]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\x{00A0}-\x{D7FF}\x{F900}-\x{FDCF}\x{FDF0}-\x{FFEF}]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\x{00A0}-\x{D7FF}\x{F900}-\x{FDCF}\x{FDF0}-\x{FFEF}]|[a-z\d\x{00A0}-\x{D7FF}\x{F900}-\x{FDCF}\x{FDF0}-\x{FFEF}][a-z\d\-._~\x{00A0}-\x{D7FF}\x{F900}-\x{FDCF}\x{FDF0}-\x{FFEF}]*[a-z\d\x{00A0}-\x{D7FF}\x{F900}-\x{FDCF}\x{FDF0}-\x{FFEF}])\.)+([a-z\x{00A0}-\x{D7FF}\x{F900}-\x{FDCF}\x{FDF0}-\x{FFEF}]|[a-z\x{00A0}-\x{D7FF}\x{F900}-\x{FDCF}\x{FDF0}-\x{FFEF}][a-z\d\-._~\x{00A0}-\x{D7FF}\x{F900}-\x{FDCF}\x{FDF0}-\x{FFEF}]*[a-z\x{00A0}-\x{D7FF}\x{F900}-\x{FDCF}\x{FDF0}-\x{FFEF}])\.?$/ui';

	  			if($arrGegevens[$i]["value"] == ""){
	  				$isValid = false;
	  			}
	  			else if(!preg_match($regex, $arrGegevens[$i]["value"])){
	  				$isValid = false;
	  			}
	  			else{
	  				$aan = $arrGegevens[$i]["value"];
	  			}
	  			break;
	  		case "straat":
	  			if($arrGegevens[$i]["value"] == ""){
	  				$isValid = false;
	  			}
	  			else{
	  				$straat = $arrGegevens[$i]["value"];
	  			}
	  			break;
	  		case "postcode":
	  			if($arrGegevens[$i]["value"] != "" && !preg_match("/^[1-9]{1}[0-9]{3}$/", $arrGegevens[$i]["value"])){
	  				$isValid = false;
	  			}
	  			else{
	  				$postcode = $arrGegevens[$i]["value"];
	  			}
	  			break;
	  		case "gemeente":
	  			if($arrGegevens[$i]["value"] == ""){
	  				$isValid = false;
	  			}
	  			else{
	  				$gemeente = $arrGegevens[$i]["value"];
	  			}
	  			break;
	  		case "nummer":
	  			if($arrGegevens[$i]["value"] == ""){
	  				$isValid = false;
	  			}
	  			else{
	  				$nummer = $arrGegevens[$i]["value"];
	  			}
	  			break;
	  		case "bedrijf":
	  			if($isBedrijf && $arrGegevens[$i]["value"] == ""){
	  				$isValid = false;
	  			}
	  			else if($isBedrijf && $arrGegevens[$i]["value"] != ""){
	  				$bedrijf = $arrGegevens[$i]["value"];
	  			}
	  			else{
	  				$bedrijf = "NULL";
	  			}	  			
	  			break;
	  		case "btwnummer":
	  			if($isBedrijf && $arrGegevens[$i]["value"] == ""){
	  				$isValid = false;
	  			}
	  			else if($isBedrijf && $arrGegevens[$i]["value"] != ""){
	  				$btwnummer = $arrGegevens[$i]["value"];
	  			}
	  			else{
	  				$btwnummer = "NULL";
	  			}
	  			break;
	  		case "tekstLintKaart":
	  			if($arrGegevens[$i]["value"] == ""){
	  				$isValid = false;
	  			}
	  			else{
	  				$tekstLintKaart = $arrGegevens[$i]["value"];
	  			}
	  			break;
	  		case "datumBegrafenis":
	  			if($arrGegevens[$i]["value"] == ""){
	  				$isValid = false;
	  			}
	  			else if(!preg_match("/^(\d{1,2})[-\/.](\d{1,2})[-\/.](\d{4})$/", preg_replace('/\s+/', '', $arrGegevens[$i]["value"]))){
  					$isValid = false;
  				}
  				else{
  					list($dag, $maand, $jaar) = split('[-\/.]', preg_replace('/\s+/', '', $arrGegevens[$i]["value"]));

  					if($dag < 0 || $maand < 0 || $maand > 12 || $jaar > strftime("%Y")){
						$isValid = false;
					}

					if($isValid){
						$extraNul = "";

						if(strlen($maand) < 2){
							$extraNul = "";
							}
						else{
							$extraNul = "0";
						}
						
						switch ($maand) {
							case $extraNul . '1':
								if($dag > 31){
									$isValid = false;
								}
								else{
									$datumBegrafenis = date("Y-m-d", strtotime($dag . "-" . $maand . "-" . $jaar));
								}
								break;
							case $extraNul . '2':
								if(((($jaar % 4 == 0) && ($jaar % 100 != 0)) || ($jaar % 400 == 0)) && $dag > 29) {
									$isValid = false;
								}
								else if($dag > 28){
									$isValid = false;
								}
								else{
									$datumBegrafenis = date("Y/m/d", strtotime($dag . "-" . $maand . "-" . $jaar));
								}
								break;
							case $extraNul . '3':
								if($dag > 31){
									$isValid = false;
								}
								else{
									$datumBegrafenis = date("Y/m/d", strtotime($dag . "-" . $maand . "-" . $jaar));
								}
								break;
							case $extraNul . '4':
								if($dag > 30){
									$isValid = false;
								}
								else{
									$datumBegrafenis = date("Y/m/d", strtotime($dag . "-" . $maand . "-" . $jaar));
								}
								break;
							case $extraNul . '5':
								if($dag > 31){
									$isValid = false;
								}
								else{
									$datumBegrafenis = date("Y/m/d", strtotime($dag . "-" . $maand . "-" . $jaar));
								}
								break;
							case $extraNul . '6':
								if($dag > 30){
									$isValid = false;
								}
								else{
									$datumBegrafenis = date("Y/m/d", strtotime($dag . "-" . $maand . "-" . $jaar));
								}
								break;
							case $extraNul . '7':
								if($dag > 31){
									$isValid = false;
								}
								else{
									$datumBegrafenis = date("Y/m/d", strtotime($dag . "-" . $maand . "-" . $jaar));
								}
								break;
							case $extraNul . '8':
								if($dag > 31){
									$isValid = false;
								}
								else{
									$datumBegrafenis = date("Y/m/d", strtotime($dag . "-" . $maand . "-" . $jaar));
								}
								break;
							case $extraNul . '9':
								if($dag > 30){
									$isValid = false;
								}
								else{
									$datumBegrafenis = date("Y/m/d", strtotime($dag . "-" . $maand . "-" . $jaar));
								}
								break;
							case $extraNul . '10':
								if($dag > 31){
									$isValid = false;
								}
								else{
									$datumBegrafenis = date("Y/m/d", strtotime($dag . "-" . $maand . "-" . $jaar));
								}
								break;
							case $extraNul . '11':
								if($dag > 30){
									$isValid = false;
								}
								else{
									$datumBegrafenis = date("Y/m/d", strtotime($dag . "-" . $maand . "-" . $jaar));
								}
								break;
							case $extraNul . '12':
								if($dag > 31){
									$isValid = false;
								}
								else{
									$datumBegrafenis = date("Y/m/d", strtotime($dag . "-" . $maand . "-" . $jaar));
								}
								break;
						}
					}
  				}
	  			break;
	  		case "naamOverledene":
	  			if($arrGegevens[$i]["value"] == ""){
	  				$isValid = false;
	  			}
	  			else{
	  				$naamOverledene = $arrGegevens[$i]["value"];
	  			}
	  			break;
		}
	}

	if($isValid){
		$arrGegevensData = array("titel" => $titel, "voornaam" => $voornaam, "familienaam" => $familienaam, "telefoon" => $telefoon, "email" => $aan, "straat" => $straat, "nummer" => $nummer, "postcode" => $postcode, "gemeente" => $gemeente, "isBedrijf" => $isBedrijf, "bedrijf" => $bedrijf, "btwnummer" => $btwnummer, "tekstLintKaart" => $tekstLintKaart, "datumBegrafenis" => $datumBegrafenis, "naamOverledene" => $naamOverledene);

		$resultaat = setOrderTabel($arrGegevensData);

		if(!$resultaat["succes"]){
			echo json_encode($resultaat["bericht"]);
		}
		else{
			echo json_encode($resultaat["bericht"]);
		}
		

		
		// echo json_encode($resultaat["bericht"]);

		// $mysqli->close();
	}

	if(!$isValid){
		


		$aanspreek = "";

		if($titel == "m"){
			$aanspreek = "Heer ";
		}
		else{
			$aanspreek = "Mevrouw ";
		}

		$bericht = "
		<html>
		<head>
		<title>Huis Arijs</title>
		</head>
		<body style='width: 100%;'>
			<section style='margin: 0 auto;'>
				<h1>Order bevestiging</h1>
				<table>
					<tr>
						<th> Geachte " . $aanspreek . $voornaam . " " . $familienaam . "</th>
					</tr>
					<tr>
						<td>Dank u voor het plaatsen van u bestelling.</td>
						
					</tr>
					<tr>
						<td>Uw order ID is: <b>[ORDER ID].</b></td>
					</tr>
					<tr>
						<td>Het totaal orderbedrag is: <b>[TOTAAL BEDRAG].</b></td>
					</tr>
					<tr>
						<td>U hebt ervoor gekozen om te betalen via overschrijving. U kunt dit doen op rekeningnummer <b>[REKENINGNUMMER]</b> voor het bedrag van <b>[TOTAAL BEDRAG]</b> onder vermelding <b>[ORDER ID]</b> ter name van <b>HUIS ARIJS</b>.</td>
					<tr>
					<tr>
						<td>Uw bestelling zal worden verwerkt na de ontvangst van betaling. De factuur zal u van ons ontvangen via mail.</td>
					</tr>
					<tr>
						<td>Met vriendelijke groet</td>
					</tr>
					<tr>
						<td>Bob Bobberman</td>
					</tr>
					<tr>
						<td>Huis Arijs Uitvaartverzorging</td>
					</tr>
				</table>
			</section>
		</body>
		</html>
		";

		// $headers = "MIME-Version: 1.0" . "\r\n";
		// $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		// $headers .= 'From: <webmaster@example.com>' . "\r\n";

		// mail($aan, $onderwerp, $bericht, $headers);

		//--------------------
		$headers = '';
	    $headers .= "Content-Transfer-encoding: 8bit";
	    $headers .= "Message-ID: <".md5(uniqid(time()))."@{$_SERVER['SERVER_NAME']}>";
	    $headers .= "X-MSmail-Priority: Normal";
	    $headers .= "X-Mailer: Microsoft Office Outlook, Build 11.0.5510";
	    $headers .= "X-MimeOLE: Produced By Microsoft MimeOLE V6.00.2800.1441";
	    $headers .= "X-AntiAbuse: Servername - {$_SERVER['SERVER_NAME']}";

		$crendentials = array(
		    'email'     => 'publi@osntest.be',    //Your GMail adress
		    'password'  => 'azerty123'               //Your GMail password
	    );

	    $smtp = array(
			'host' => 'premium01.totaalholding.nl',
			'port' => 465,
			'username' => $crendentials['email'],
			'password' => $crendentials['password'],
			'secure' => 'ssl' //SSL or TLS
		);

	    $to         = $aan; //The 'To' field
		$subject    = $onderwerp;
		$content    = $bericht;

		$mailer = new PHPMailer();

		//SMTP Configuration
		$mailer->isSMTP();
		$mailer->SMTPAuth   = true; //We need to authenticate
		$mailer->Host       = $smtp['host'];
		$mailer->Port       = $smtp['port'];
		$mailer->Username   = $smtp['username'];
		$mailer->Password   = $smtp['password'];
		$mailer->SMTPSecure = $smtp['secure']; 

		//Now, send mail :
		//From - To :
		$mailer->From       = 'info@ondernemersnetwerk.be';
		$mailer->FromName   = 'Ondernemersnetwerk'; //Optional
		$mailer->addAddress($to);  // Add a recipient
		$mailer->addCustomHeader($headers);
		// $mail->addReplyTo($crendentials['email'], 'Information');

		//Subject - Body :
		$mailer->Subject        = $subject;
		$mailer->Body           = $content;
		$mailer->isHTML(true); //Mail body contains HTML tags

		//Check if mail is sent :
		if(!$mailer->send()) {
		    echo json_encode('Error sending mail : ' . $mailer->ErrorInfo);
		} else {
		    echo json_encode('Message sent !');
		}
		//--------------------
	}
	

	// echo json_encode($arrGegevens[13]["name"]);
	// echo json_encode($arrGegevens[13]["value"]);
	// echo json_encode(count($arrGegevens));
	// echo json_encode($aan);



	// $deheaders = "MIME-Version: 1.0" . "\r\n";
	// $deheaders .= "Content-type:text/html;charset=UTF-8" . "\r\n"; 
	// if (@mail($aan, "Dit is een test", "Hallo, dit is een message.", $deheaders)) {
	// 	echo json_encode('Uw mail werd succesvol verstuurd.');
	// }
	// else {
	// 	echo json_encode('Uw mail kon niet worden verzonden.');
	// }


}

function setOrderTabel($arrGegevensData){
	global $mysqli;

	$cookie = isset($_COOKIE['winkelmandCookie']) ? $_COOKIE['winkelmandCookie'] : "";
	$cookie = stripslashes($cookie);
	$producten = json_decode($cookie, true);

	// $producten[0]["id"]
	$arrId = array();
	$arrPrijs = array();
	$arrAantal = array();
	
	if(!$producten){
	    $producten = array();
	}

	$cookieCheck = true;

	if (!empty($producten)) {
		foreach($producten as $row => $innerArray){
		  foreach($innerArray as $innerRow => $value){
		    if($innerRow == "id"){
		  		$resultaat = $mysqli->query("SELECT productPrijs FROM tblproduct WHERE productId = '$value'");
		  		if($resultaat->num_rows > 0){
		  			$row = $resultaat->fetch_assoc();
					array_push($arrId, $value);
					array_push($arrPrijs, $row["productPrijs"]);
		  		}
		  		else{
		  			$cookieCheck = false;
		  		}				
		  	}
		  	if($innerRow == "aantal"){
		  		if(!is_numeric($value)){
		  			$value = 1;
		  		}
		  		array_push($arrAantal, $value);
		  	}
		  }
		}

		if($cookieCheck){
			$vandaag = date("Y/m/d");
			$isB = false;

			if($arrGegevensData['isBedrijf'] == "true"){
				$isB = true;
			}

			$query = "INSERT INTO tblorder(orderDatum, titel, voornaam, familienaam, telefoon, email, straat, nummer, postcode, gemeente, isBedrijf, bedrijf, btwnummer, tekstLintKaart, datumBegrafenis, naamOverledene) VALUES ('" . $vandaag . "', '".$arrGegevensData['titel']."', '".$arrGegevensData['voornaam']."', '".$arrGegevensData['familienaam']."', '".$arrGegevensData['telefoon']."', '".$arrGegevensData['email']."', '".$arrGegevensData['straat']."', '".$arrGegevensData['nummer']."', '".$arrGegevensData['postcode']."', '".$arrGegevensData['gemeente']."', '".$isB."', '".$arrGegevensData['bedrijf']."', '".$arrGegevensData['btwnummer']."', '".$arrGegevensData['tekstLintKaart']."', '".$arrGegevensData['datumBegrafenis']."', '".$arrGegevensData['naamOverledene']."')";

			if(!$mysqli->query($query)){
				return $arrResultaat = array("succes" => false, "bericht" => $mysqli->error);
			}
			else{
				$orderId = mysqli_insert_id($mysqli);

				$ErrorOrderDetails = "";

				for($i = 0; $i < count($arrId); $i++){
					$deQuery = "INSERT INTO tblorderdetails(orderId, productId, prijs, aantal, verzendkosten) VALUES ('".$orderId."', '".$arrId[$i]."', '".$arrPrijs[$i]."', '".$arrAantal[$i]."', '0')";
					if(!$mysqli->query($deQuery)){
						$ErrorOrderDetails = $mysqli->error;
					}
				}
				
				if($ErrorOrderDetails == ""){
					return $arrResultaat = array("succes" => true, "bericht" => "Bestelling geplaats.");
				}
				else{
					return $arrResultaat = array("succes" => false, "bericht" => $mysqli->error);
				}				
			}
		}
		else{
			return $arrResultaat = array("succes" => false, "bericht" => "Er is een fout gebeurt, probeer uw winkelmand leeg te maken en maak uw bestelling opnieuw.");
		}
	}
	else{
		return $arrResultaat = array("succes" => false, "bericht" => "Er is een fout gebeurt, probeer uw bestelling opnieuw te maken.");
	}

	// $mysqli->query("SET FOREIGN_KEY_CHECKS = 0");
	// $mysqli->query("TRUNCATE tblorder");
	// $mysqli->query("TRUNCATE tblorderdetails");
	// $mysqli->query("SET FOREIGN_KEY_CHECKS = 1");
	
	$mysqli->close();
}

if(isset($_POST['valideerBetaalmethode'])){
	// de beschikbare betaalmethode zijn: overschrijving of betalen bij afhalen

	$isValid = false;

	$radio = $_POST["valideer"];
	$check = $_POST["checkFactuur"];

	if($radio == "overschrijving" || $radio == "afhalen"){
		if($check == true || $check == false){
			$isValid = true;
		}
		else{
			$isValid = false;
		}
	}
	else{
		$isValid = false;
	}

	if($isValid){
		$deWaarden = array('radio' => $radio, 'check' => $check);
		echo json_encode(true);
	}
	else{
		echo json_encode(false);
	}
}

if(isset($_POST['getCookieAantal'])) {
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


if(isset($_POST['winkelmandData'])) {
    global $mysqli;

	$cookie = isset($_COOKIE['winkelmandCookie']) ? $_COOKIE['winkelmandCookie'] : "";
	$cookie = stripslashes($cookie);
	$producten = json_decode($cookie, true);

	// $producten[0]["id"]
	$arrId = array();
	$arrNaam = array();
	$arrPrijs = array();
	$arrAantal = array();

	if(!$producten){
	    $producten = array();
	}

	if (empty($producten)) {
	     echo json_encode(0);
	}
	else{
		foreach($producten as $row => $innerArray){
		  foreach($innerArray as $innerRow => $value){
		    if($innerRow == "id"){
		  		$resultaat = $mysqli->query("SELECT productNaam, productPrijs FROM tblproduct WHERE productId = '$value'");
				$row = $resultaat->fetch_assoc();
				array_push($arrId, $value);
				array_push($arrNaam, $row["productNaam"]);
				array_push($arrPrijs, $row["productPrijs"]);
		  	}
		  	if($innerRow == "aantal"){
		  		array_push($arrAantal, $value);
		  	}
		  }
		}

		$arrWinkelmandData = array("id" => $arrId, "naam" => $arrNaam, "prijs" => $arrPrijs, "aantal" => $arrAantal);

		echo json_encode($arrWinkelmandData);
	}

	$mysqli->close();
}

if(isset($_POST['cookieRemoveProduct'])) {
    $productId = $_POST['Id'];

    $cookie = isset($_COOKIE['winkelmandCookie']) ? $_COOKIE['winkelmandCookie'] : "";
	$cookie = stripslashes($cookie);
	$producten = json_decode($cookie, true);

	if(!$producten){
	    $producten = array();
	}

	foreach($producten as $row => $innerArray){
	  foreach($innerArray as $innerRow => $value){
	    if($innerRow == "id" && $value == $productId){
	  		unset($producten[$row]);
	  	}
	  }
	}

	$herstel = array_values($producten);

	setcookie("winkelmandCookie", json_encode($herstel), time()+60*60*24*1, '/');

	echo json_encode($herstel);
}

if(isset($_POST['cookieSetProduct'])) {
    // setcookie('winkelmandCookie', '', time()-60*60*24*90, '/', '', 0, 0);
	// unset($_COOKIE['winkelmandCookie']);

	$productId = $_POST['Id'];
    $aantal = $_POST['aantal'];

	$cookie = isset($_COOKIE['winkelmandCookie']) ? $_COOKIE['winkelmandCookie'] : "";
	$cookie = stripslashes($cookie);
	$producten = json_decode($cookie, true);

	if(!$producten){
	    $producten = array();
	}

	$zitErIn = 0;

	foreach($producten as $row => $innerArray){
	  foreach($innerArray as $innerRow => $value){
	    if($innerRow == "id" && $value == $productId){
	  		$zitErIn = 1;
	  	}
	  }
	}

	if($zitErIn == 1){
		echo json_encode("bestaat al");
	}
	else{
		array_push($producten, array('id' => $productId, 'aantal' => $aantal));
		setcookie("winkelmandCookie", json_encode($producten), time()+60*60*24*1, '/');
		echo json_encode($producten);
	}
}

if(isset($_POST['setCookieAantal'])){
	$productId = $_POST['id'];
    $aantal = $_POST['aantal'];

	$cookie = isset($_COOKIE['winkelmandCookie']) ? $_COOKIE['winkelmandCookie'] : "";
	$cookie = stripslashes($cookie);
	$producten = json_decode($cookie, true);

	if(!$producten){
	    $producten = array();
	}

	foreach($producten as $row => $innerArray){
	  foreach($innerArray as $innerRow => $value){
	    if($innerRow == "id" && $value == $productId){
	  		$producten[$row]["aantal"] = $aantal;
	  	}
	  }
	}

	setcookie("winkelmandCookie", json_encode($producten), time()+60*60*24*1, '/');
	echo json_encode($producten);
}

if(isset($_POST['productData'])) {
    global $mysqli;

	$beginpunt = $_POST['beginpunt'];
    $richting = $_POST['richting'];
    $categorie = $_POST['categorie'];

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

if(isset($_POST['productAfbeelding'])) {
    global $mysqli;

    $productId = $_POST['Id'];    
	
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

if(isset($_POST['funerariumTitel'])) {
    global $mysqli;

    $richting = $_POST['richting'];
    $beginpunt = $_POST['beginpunt'];

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

		$funerariumData = array("id" => $arrId, "titel" => $arrTitel, "nieuweBeginPunt" => $nieuweBeginPunt);
		echo json_encode($funerariumData);
    }

	$mysqli->close();
}

if(isset($_POST['funerariumAfbeelding'])) {
	global $mysqli;

    $arrFunerariumId = $_POST['arrFunerariumId'];

	$arrAfbeelding = array();

	foreach ($arrFunerariumId as $value) {
	    if($resultaat = $mysqli->query("SELECT funerariumEnAulaAfbeelding FROM tblfunerariumenaula WHERE funerariumEnAulaId = $value")){
			$row = $resultaat->fetch_assoc();
			array_push($arrAfbeelding, 'data:image/jpeg;base64,' . base64_encode($row["funerariumEnAulaAfbeelding"]));
		}
	}

	header("content-type: image/jpeg");
	echo json_encode($arrAfbeelding);
	$mysqli->close();
}

// -------------------------------------------------- CONDOLEREN

if(isset($_POST['overledeneData'])) {
    global $mysqli;

    $offset = $_POST['offset'];
    $richting = $_POST['richting'];

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

    if($resultaat = $mysqli->query("SELECT overledeneId, voornaam, familienaam, titel, geboorteplaats, geboortedatum, plaatsOverlijden, datumOverlijden, woonplaats, rouwbrief FROM tblcondoleren ORDER BY datumOverlijden DESC LIMIT $nieuweOffset, 10")){
    	
    	while ($row = $resultaat->fetch_assoc()) {
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

if(isset($_POST['overledeneFoto'])) {
    global $mysqli;

    $arrOverledeneId = $_POST['arrOverledeneId'];

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

if(isset($_POST['laatsteOverledeneData'])) {
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

if(isset($_POST['laatsteOverledeneFoto'])) {
    global $mysqli;

	$arrFoto = array();

	for($i = 0; $i < 4; $i++){
		$resultaat = $mysqli->query("SELECT foto FROM tblcondoleren ORDER BY datumOverlijden DESC LIMIT $i, 1");
		$row = $resultaat->fetch_assoc();
		
		array_push($arrFoto, 'data:image/jpeg;base64,' . base64_encode($row["foto"]));
	}

	header("content-type: image/jpeg");
	echo json_encode($arrFoto);
	$mysqli->close();
}

if(isset($_POST['formSubmit'])) {
    global $mysqli;

    $deForm = $_POST['deForm'];    

	$params = array();
	parse_str($deForm, $params);
	
	echo json_encode($params);
	$mysqli->close();
}

// -------------------------------------------------- CREADS

if(isset($_POST['getCread'])) {
    $klantid = 7425;

	// $db_life_host = "www.ondernemers-en-shoppingnetwerk.be:3306";
	$db_life_host = "localhost";
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