<?php
    $vcard_directory = 'vccard/';
    if(isset($life_import) && $life_import ==TRUE){
    /*
     * FTP connection settings
     * Remote FTP
     */
        $ftp_server_cn= "cn_two@catalogusnetwerk.be";
        $ftp_user_cn =  "cn_two";
        $ftp_password_cn = "3EB4TPFw&?]AEV.";

        $ftp_server =  '185.56.144.103 ';//ATMAKER - BACK END
        $ftp_user =  'upload@o-sn.be';
        $ftp_password = 'kK-p}$C7zl,)SDB.';
    /**
     * FTP upload directory
    */
    $vcard_directory_life = '/public_html/vc_test/';//---TEST
    //$vcard_directory_life = '/public_html/vc/';//---on the LIFE server
    }
    $_SERVER_NAME= strtolower($_SERVER["SERVER_NAME"]);
    $server_tests= Array('osntest.be','localhost');
    $server_tests_url= Array('atmaker_test','osn_test');

    $exp = explode('/',$_SERVER["REQUEST_URI"]);

    $test_connection = false;
    foreach($exp as $y){
        if(in_array($y,$server_tests_url)) $test_connection = true;
    }
    if(!in_array($_SERVER_NAME,$server_tests)  && $test_connection == false ){
        $ftp_server = "ondernemers-en-shoppingnetwerk.be";//OSN server FRONT END
        $ftp_user_name = "FTP@ondernemers-en-shoppingnetwerk.be";
        $ftp_user_pass = "uFpE^qAS#dM&SDB.";
        
    } else {
        $ftp_server =  'osntest.be';//TEST SERVER
        $ftp_user_name =  'osndb@osntest.be';
        $ftp_user_pass = '9+{;Ms*sHK7vEV.';
    }
      $ftp_server2 =  $ftp_server;
      $ftp_user2 = $ftp_user_name;
      $ftp_password2 = $ftp_user_pass;
      ini_set('track_errors', 1);//echo $php_errormsg;

$exp = explode('/',$_SERVER["REQUEST_URI"]);
$server_name = str_replace(array('http://','www.'),'', $_SERVER["SERVER_NAME"]);
if( ($test_connection == true)) $web = 'http://osntest.be';
else if(($test_connection == false ) &&  ($server_name=='o-sn.be' || $server_name=='ondernemers-en-shoppingnetwerk.be')) $web = 'http://www.ondernemers-en-shoppingnetwerk.be';
?>
