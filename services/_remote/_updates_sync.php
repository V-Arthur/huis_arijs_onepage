<?php
/**
 * Created by Evstratova-Bourgois Ekaterina
 * Last modified 10/12/15
 * This is the original file for sync. of the remote - include files
 */
/*
 * Bellow in the comment is the code that you must add in your connection file, after setting ftp login/pass (with $ftp_user, $ftp_password)
 * this is an example, this file should be copied in the root of the server and included in the connection file.
$back = '';
if ($_SERVER["HTTP_HOST"]=='localhost:1234' || $_SERVER["HTTP_HOST"]=='localhost') $back = '../';//download the latest version at 185.56.144.103 (o-sn.be) upload@o-sn.be in the root of your xampp
else {
    if(file_exists('_updates_sync.php')) include 'services/_remote/_updates_sync.php';//synced file
    elseif(file_exists('_updates_sync.php')) include '_updates_sync.php';//back-up file
     $remote = 'services/_remote/';
}
*/
if(!isset($folder))$folder =  "services/";
//---------------------------------------UPDATE FOLODER SERVICES FROM OSN SERVER:
$conn_id = ftp_connect($ftp_server);
if ((!$conn_id)) echo "FTP connection has failed!Attempted to connect to $ftp_server";
else {
    ftp_pasv($conn_id, true);
    $login_result = @ftp_login($conn_id, $ftp_user, $ftp_password);
    if($login_result && $folder!=''){
        if (!is_dir($folder)) mkdir($folder);
        $curdir =dirname(__FILE__);
        ftp_sync ($folder);
        chdir ($curdir);
        ftp_chdir($conn_id,"..");
        if(isset($folder_banners) && $folder_banners!=''){//for the banners module on the OSN
            chdir ("../../");//change dir to root of curent folder echo getcwd() . "+++";
            ftp_sync ($folder_banners);
        }
    } else echo "FTP login has failed! $ftp_server";
}
/**
 * THIS FUNCTION CREATES A LOOP TO COPY ALL FILES AND FOLDERS (WITH THE FILES IN IT) TO THE REMOTE FTP LOCATION
 * @global type $conn_id
 * @global type $folder
 * @param type $dir
 */
function ftp_sync ($dir) {
    global $conn_id,$folder;
    if(isset($conn_id) && $conn_id!=''){
    if (!is_dir($dir)) mkdir($dir); ///echo "<b>$dir</b><br>";
    if (ftp_chdir($conn_id, $dir) == false) echo ("Change Dir Failed: $dir<BR>\r\n");
    else {
        $contents = ftp_nlist($conn_id, ".");
        if(isset($contents)){
        foreach ($contents as $file) {
            if ($file == '.' || $file == '..') continue;
            $exp = explode('.',$dir.$file);
            if (isset($exp[1])) ftp_get($conn_id, $dir.$file, $file, FTP_BINARY) ;
            else {
                $new_dir = $dir.$file;
                if(!(is_dir($new_dir))) mkdir($new_dir);
                 if (ftp_chdir($conn_id, $file)) {
                     $contents2 = ftp_nlist($conn_id,'.');
                     foreach ($contents2 as $file2) {
                        if ($file2 == '.' || $file2 == '..') continue;
                        $exp2 = explode('.',$file2);
                        if (isset($exp2[1]))  ftp_get($conn_id,$new_dir.'/'.$file2, $file2, FTP_BINARY);
                     }
                 }
                  ftp_chdir($conn_id,"..");
            }
        }
        ftp_chdir ($conn_id, "../$dir");
    }
    }
    }
}
//exit;
//-----------------------------------------END UPDATE
?>