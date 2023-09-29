<?php
/**
 * If you will have to login on the webpage to Use the Import
 * import user User name: Import
 * import user Password: authenticated
 */
 ini_set('display_errors', '1');//<---------- DONT DELETE THIS LINE!
//-------------------NEVER DELETE THESE SETTINGS - THEY ARE USED IN THE FILES WHERE DB CONNECT FILE IS INCLUDED:
//------- my personal API Key's (for google maps) - nobody should use this anywhere else, then here (change it when you get one registered on OSN email).
$key ='AIzaSyATF8eeGtdfdT6aGC2sZ-yhmUfo8Y4H3B4';
$key_extra ='AIzaSyAjBzPUozCv196ERqEHVG5RMrFLlefzGjU';
//--------facbook token (change it when you get one registered on OSN email).
$fb_token_appID = '433173403533099';
$fb_token_Sec = 'f09ced581569d8f2739d05d116debac3';
$server_tests_url= Array('atmaker_test','osn_test','osntest.be');//---------disrectories to test on the life and test servers
$sever_life_url_osn = array("ondernemers-en-shoppingnetwerk.be","entrepreneurs-and-shoppingnetwork.com","reseaushopping-et-entrepreneurs.be","catalogusnetwerk.be","catalogusnetwerk.com");//--LIFE ONN
$port = '3306';
//$online_testing - to test in online test DB while connected to APACHE on the localhost:
if(!isset($online_testing)) $online_testing = FALSE;
$life_import = FALSE;//!!!----This veriable used to move the 'vc_test' cards on the 'life' directory(if 'true')
if($online_testing == FALSE) $life_import = FALSE;//----DEFAULT VC card setting
//---------------------------host IP's:
$localhost='localhost';
$test_host_1='osntest.be';
$test_host_2='';//not used yet
$life_host='o-sn.be';
//-------------------Dtabases:
$db_life_test = "osn_osndb_test";//o-sn.be/atmaker_test
$test_host_0_db =  "osntest_new";//osntest.be - IMPORT/EXPORT KBO
$db_life = 'osn_osndb';//o-sn.be/atmaker
//-----------------$test_host_1 login
$test_host_1_user="osntest_NEW";
$test_host_1_pass="agwTbS9WAT.";
$test_host_1_db="osntest_test";
//-----------------localhost login
$localhost_user='root';
$localhost_pass='123';
$localhost_db='osntest_osndb';
//-----------------test DB at life server login
$life_test_user='osn_test007';
$life_test_pass='&V!e9V4WEV.';
//-----------------$life_host login
$db_life_user='osn_user007';
$db_life_pass='Q#j$3NNbSDB.';

if($online_testing==true){//---------default if $online_testing: IMPORT/EXPORT KBO MODULE at osntest.be
    $host = $test_host_1;
    $user = $test_host_1_user;
    $password =  $test_host_1_pass;
    $database = $test_host_1_db;
} else
    $host = $localhost;
//-------------------------------------------------
$server =  $_SERVER["HTTP_HOST"].":".$_SERVER["SERVER_PORT"];
$exp = explode('/', str_replace(array('http://','www.'),'', $_SERVER["HTTP_HOST"]).'/'.$_SERVER["REQUEST_URI"]);
$page_self='http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
$server_name = str_replace(array('http://','www.'),'', $_SERVER["SERVER_NAME"]);
//-------------------------------------------------
$LIFE_CONNECTION = FALSE;//--------------------!IMPORTANT
if(!isset($test_connection)) $test_connection = false;
foreach($exp as $y){
    if(in_array($y,$server_tests_url)) $test_connection = true;
}
//-------------------------------------------------- localhost:1234 - for specificly set port at XAMPP
if(isset($server) && (substr($server,0,23) ==$localhost.':1234' || $server_name == $localhost) && $online_testing==false ) {//-------------LOCALHOST
    if(!isset($DB)){
        $host = $localhost;
        $user = $localhost_user;
        $password =  $localhost_pass;
        $database = $localhost_db;
    }
} else {//------when SERVER - > anything then 'localhost'
 //-----------------------------------------------
  if($test_connection == true || $online_testing==true){//------if "test"  found in the url = 'TEST' DATABASE ON THE 'LIFE' SERVER o-sn.be/atmaker_test etc..
        $host=$life_host;
        $user =$life_test_user;
        $password = $life_test_pass;
        $database = $db_life_test;
    } else { //ONLY ON THE 'LIFE' SERVER  ---'LIFE' DATABASE ON THE 'LIFE' SERVER!
        $LIFE_CONNECTION = TRUE;//
        $host = $life_host;
        $user =$db_life_user;
        $password = $db_life_pass;
        $database = $db_life;
        //$life_import = TRUE;
    }
}
if(isset($DB) && $DB == true) {
    $database = $test_host_0_db;//---- for KBO EXPORTS $db_life_test TRUE/FALSE= EXPORT KBO or not (export uses different DB)
    $host = $test_host_1;
    $user =$test_host_1_user;
    $password = $test_host_1_pass;
   
} 
if(!isset($database) || $database =='') die("ERROR: MySQL connection settings are not defined for <b>'".$server_name."'</b> in file <b>'_DB_CONNECTION.php'</b> <br>");
ini_set("max_execution_time", "100000");
ini_set("set_time_limit", "100001");

if(!isset($LIFE_CONNECTION) || $LIFE_CONNECTION == FALSE) $db_warn= true;
if(/*isset($db_warn) || */($test_connection == true && !isset($db_warn)))
    echo "<span style='z-index: 100; position: absolute; background-color: red;color: #ffffff;font-weight: bold;top:120px; left:120px;padding: 2px;'>Database: $host : $user: $database</span>";
 ?>