<?php
if(isset($_POST['action']) && !empty($_POST['action'])) {
    $action = $_POST['action'];
    if($action == "getAantalAfbeeldingen"){
    	getAantalAfbeeldingen();
    }
}

function getAantalAfbeeldingen(){
	$servername = "localhost";
	$username = "root";
	$password = "";

	// Create connection
	$mysqli = new mysqli($servername, $username, $password, "huis_arijs_db");

	// Check connection
	if ($mysqli->connect_error) {
	    die("Connection failed: " . $mysqli->connect_error);
	}
	//echo json_encode(5);

	if($query = $mysqli->query("SELECT * FROM tblfunerariumenaula")){
		
		
        if($query ->num_rows > 0){
            $aantal = $query->num_rows;
            echo json_encode($aantal);
        }

    }
    else{
    	echo json_encode("hallo");
    }
}







?>