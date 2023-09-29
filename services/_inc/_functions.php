<?php

function authenticate(){
    $valid_passwords = array ("Import" => "authenticated");
    $valid_users = array_keys($valid_passwords);
    $user = @$_SERVER['PHP_AUTH_USER'];
    $pass = @$_SERVER['PHP_AUTH_PW'];
    $validated = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);
    if (!$validated) {
      header('WWW-Authenticate: Basic realm=""');
      header('HTTP/1.0 401 Unauthorized');
      die ("Not authorized");
    }
    date_default_timezone_set('Europe/Brussels');
    echo "<p><b>User: $user.</b> "." Page Last Updated: <b>" . date ("F d Y H:i:s.", getlastmod())."</b></p>";
}
/**
 *
 * @param type $date
 * @param type $separator
 * @return type
 */
function contvert_date($date,$separator){
    $date_array = Array('Y','m','d');
    $format = implode($separator, $date_array);
    return date($format,strtotime($date));
}
/**
 *
 * @param type $dirname
 */
function create_directory($dirname) {
    if(!(is_dir($dirname))){
        mkdir($dirname, 0777);
        if(is_dir($dirname)) chmod($dirname, 0777);
    }
}
/**
 *
 * @param type $file_name
 * @param type $stringData
 */
function write_file($file_name,$stringData){
    $fh = fopen($file_name, 'w') or die("can't open file");
    fwrite($fh, $stringData);
    fclose($fh);
}
/**
 * Copies MULTIPLE files from/to ftp server
 * @global type $ftp_conn_id
 * @param type $ext
 * @param type $destination
 * @param type $sourse
 * @param type $processed
 */
function ftp_copy_files($ext,$destination,$sourse,$processed)
{
    global $ftp_conn_id;
    $files = ftp_nlist($ftp_conn_id,$sourse);
    $found='0';
    if($files==''){
        $files=read_dir("$sourse");
        $found='1';
    }
    if(isset($files)){
        foreach($files as $value){
            $aa=substr($value, -3);
            $values=str_replace($sourse,"",$value);
            if($aa==$ext || $aa==strtolower($ext)){
                if($found!='1'){
                    if(ftp_get($ftp_conn_id,"$destination/$values","$sourse/$values",FTP_BINARY)){
                        if($processed!=''){
                            if(ftp_put($ftp_conn_id,"$processed/$values","$destination/$values",FTP_BINARY)) ftp_delete($ftp_conn_id,"$sourse/$values");
                            else echo "ftp copy error $sourse/$values<br>";
                            }
                        if($processed=='') ftp_delete($ftp_conn_id,"$sourse/$values");
                    }
                }
                else
                    {
                    if(file_exists("$sourse/$values")){
                        if(ftp_put($ftp_conn_id,"/$destination/$values","$sourse/$values",FTP_BINARY)){
                            if($processed!='')copy("$sourse/$values","$processed/$values");
                            unlink("$sourse/$values");
                        }
                    }
                }

            }
        }
    }
}
/**
 * get files names on local directory
 * @global type $files
 * @param type $dir_name
 * @return string
 */
function read_dir($dir_name)
{
    if(is_dir($dir_name)){
    $dhandle = opendir($dir_name);
    global $files;
    $files = array();
    if ($dhandle) {
       while (false !== ($fname = readdir($dhandle))) {
          if (($fname != '.') && ($fname != '..') && $fname!='ProcessedFiles' && $fname!= date('Y') &&
              ($fname != basename($_SERVER['PHP_SELF']))) {
              if($fname!=''){
                $files[] = (is_dir( "./$fname" )) ? "(Dir) {$fname}" : $fname;
              }
              else{$files[]="";}
    }} closedir($dhandle);}
    return $files;
    }
}
/**
 * get single file data
 * @return string
 */
function read_file($file_name){
    global $file_Data;
            $fh = fopen($file_name, 'r');
            $file_Data = @fread($fh, filesize($file_name));
            if(filesize($file_name)<330393463 && !mb_check_encoding($file_Data, 'UTF-8')) {
                $file_Data = utf8_encode($file_Data);
            }
            fclose($fh);
        return $file_Data;
 }
 /**
  * get multiple files data from local dir.
  * @return array $FileData
  */
function read_multiple_local_files($localDirectoryName){
    global $FileData;
    $Files=read_dir($localDirectoryName);
    if(isset($Files)) {
        foreach ($Files as $FileName) {
            if(!is_dir($localDirectoryName.'/'.$FileName)) $FileData[$FileName] = read_file($localDirectoryName.'/'.$FileName);
        }
    }
    return $FileData;
}
/**
 * Reads files listed in the folders by making URL out of their names.
 * @global type $FileData
 * @param type $localDirectoryName
 */
function read_multiple_local_URLS($localDirectoryName){
    global $ext;//----to show only files with extension that is  needed
    $Files=read_dir($localDirectoryName);
    if(isset($Files)) {
        $co = 1;
        foreach ($Files as $FileName) {
            if(isset($ext) && file_exists($localDirectoryName.$FileName.'/'.$FileName.'.'.$ext) /*&& $FileName!= 'activity'*/){
            echo "$co)<a href='import_from_ftp_server.php?file_directory=$FileName'>$FileName</a>&nbsp;&nbsp;&nbsp;";
            $co++;
            }
        }
    }
}
/**
 * Makes as many directories as needed, at ones
 * @global type $LocalFilesDirectory
 * @global type $LocalDirectoryProcessed
 * @global type $localDirectoryName
 * @global type $localDirectoryLogName
 * @global type $foloderName
 * @param type $LocalDirectory
 * @param type $module
 */
function create_folders($LocalDirectory,$module){
    global $LocalFilesDirectory,$LocalDirectoryProcessed,$localDirectoryName,$localDirectoryLogName,$foloderName;
    $year=date('Y');
    $log_folder_name ="log";
    $localDirectorys = Array($LocalFilesDirectory,$year,$module/*,$LocalDirectory*/);
    $localDirectorysLog  = array_merge($localDirectorys, Array($log_folder_name,$LocalDirectoryProcessed));
    $localDirectoryName = implode('/', $localDirectorys);
    $localDirectoryLogName = implode('/', $localDirectorysLog);
    $foloderName = '';
    foreach($localDirectorys as $localDirectory){
        create_directory($foloderName.= $localDirectory."/");
    }
    $foloderName = '';
    foreach($localDirectorysLog as $localDirectoryLog){
        create_directory($foloderName.= $localDirectoryLog."/");
    }
}
/**
 * upload AND convert xls to csv file and upload
 * @global boolean $interractive
 * @param type $Directory
 */
function upload_file($Directory){
    global $interractive, $extension, $extensions, $UploadDirectory, $upFile, $FileName;
    $target_file = $Directory .'/'. basename($_FILES["fileToUpload"]["name"]);
    if(isset($_POST["submit"])) {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file) && in_array('.'.$extension,$extensions)) {
            if('.'.$extension == '.xls' || '.'.$extension == '.xlsx'){
                convert_xls_to_csv($Directory.'/'.$upFile, $Directory.'/'.$FileName.'.csv');
            }
            echo "<br/>The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.<br/><br/><br/>";
            refresh_page($_SERVER['PHP_SELF']);
        } else {
            $interractive = FALSE;
            echo "<br/>Sorry, there was an error uploading your file.<br/><br/><br/>";
        }
    }
}
//--------------------------------------
/**
 * checks where the visitor came from
 * @global type $refresh
 * @global type $url
 * @param type $time_start
 */
function check_refferer($time_start){
 global $refresh, $url, $print;
 if(isset($_SERVER['HTTP_REFERER']) && $_SERVER['HTTP_REFERER']!= "") $_GET['salt'] = 'KK?KSDGNWJCWXDC5C898SFSCPQODQSDF';
      if(!isset($_GET['now'])){
        if($time_start != 'ref'){
            $time_end = microtime(true);
            $execution_time = ($time_end - $time_start)/60;
            if(!isset($_GET['salt'])) $margin = '40'; else $margin = 0;
            $time = "<div style='float:bottom;margin-top:$margin%'><b>Total Execution Time:</b> </div>".$execution_time.' Mins';
        } else $time = "...";

        if(!isset($_GET['salt']) || $_GET['salt'] !== 'KK?KSDGNWJCWXDC5C898SFSCPQODQSDF')  if(!isset($print)) exit($time);
        else {
            if(!isset($print)) if($refresh == true) refresh_page($url); else echo $time."<br>";
        }
   }
   return $time;
}
/**
 * Converts XLS to CSV : just define the paths
 * @param type $loadPath
 * @param type $savePath
 */
function convert_xls_to_csv($loadPath, $savePath){
    global $Directory;
    require_once '../services/Classes/reader.php';
    $data = new Spreadsheet_Excel_Reader();
    $data->setUTFEncoder('mb');//if you want you can change 'iconv' to mb_convert_encoding:*
    $data->read($loadPath);
    $csv_data = array_2_csv($data->sheets[0]['cells']);
    write_file($savePath,$csv_data);
}

/**
 * Makes CSV file from array
 * @param type $array
 * @return type
 */
function array_2_csv($array) {
    $csv = array();
    foreach ($array as $item) {
        if (is_array($item)) {
            $csv[] = array_2_csv($item)."\r\n";
        } else {
            $csv[] = $item.';';
        }
    }
    return implode('', $csv);
}

/**
 * Convert roman numbers to normal
 * @param type $rom
 * @param int $letters
 * @return type
 */
 function rom2arab($rom,$letters=array()){
    if(empty($letters)) $letters=array('M'=>1000, 'D'=>500,  'C'=>100, 'L'=>50, 'X'=>10, 'V'=>5,'I'=>1);
    else  arsort($letters);
    $arab=0; $chk = true;
    foreach($letters as $L=>$V){
        while(strpos($rom,$L)!==false){
            $l=$rom[0];
            $rom=substr($rom,1);
            $m=$l==$L?1:-1;
            if(isset($letters[$l])) $arab += $letters[$l]*$m;
        }
    }
    return $arab;
}
/**
 * to add a number to the array field if it is doubled
 * @param type $count
 * @param type $strting
 */
function addNumberToDouble($count,$strting){
    global $co, $checkDoubles;
    //$strting=  preg_replace( '/[0-9.]/', '', trim($strting));//in case if there would be '1,2,3' in the file
    $strting  = replace(Array(',','...','&'), '', $strting, 'trim');
    $strting = replace(Array('`',' '),'', trim($strting),'trim');
    $checkCode = replace(Array('`'), '*', $strting, 'trim');
    if(find_in_string($checkDoubles, Array('*'.$checkCode.'*'))=='*'.$checkCode.'*') {
        $co++;
        $strting =  '`'.$strting.' '.$co.'`';
    } else  $strting =  '`'.$strting.'`';

    $checkDoubles.='*'.$checkCode.'*';
    return $strting;
}
/**
 * Converting UPPECASE words to First Letter Upper
 * @param type $word
 * @return type
 */
   function detect_word_case($word){
     $french_charsLower = Array('é'=>'É','è'=>'È','ë'=>'Ë','ê'=>'Ê','á'=>'Á','à'=>'À','ä'=>'Ä','â'=>'Â','å'=>'Å','ó'=>'Ó','ò'=>'Ò','ö'=>'Ö','ô'=>'Ô','í'=>'Í',
    'ì'=>'Ì','ï'=>'Ï','î'=>'Î','ú'=>'Ú','ù'=>'Ù','ü'=>'Ü','û'=>'Û','ý'=>'Ý','ø'=>'Ø','œ'=>'Œ','ç'=>'Ç');
     if($word == strtoupper($word)){
        $found = find_in_string(strtoupper($word),array_values($french_charsLower));
        if($found!='') $word = str_replace(array_values($french_charsLower), array_keys($french_charsLower), $word);
         $word = strtolower($word);
         $word = convert_word_case('-', $word);
         $word = convert_word_case('.', $word);
     }
     return  ucwords(trim($word));
     }
 /**
  * part of detect_word_case()
  * @param type $exp
  * @param type $word
  * @return type
  */
     function convert_word_case($exp, $word){
        $explode = explode($exp,$word);
        if(count($explode)>0){
         foreach($explode as $words) $case[] = ucwords($words);
         $word = implode($exp,$case);
        }
      return  ucwords($word);
     }
 /**
  * Used to fix bugs that were copied to the xls file
  * @param type $word
  * @return type
  */
 function debug_xls($word){
     if(!is_array($word)){
       $word = str_replace(chr('00'), '', ($word));
       $word = str_replace('%C2%A0','',urlencode(trim($word)));
       $word = str_replace('%19', '’', ($word));
       $word = str_replace(/*'œ'*/array('%C2%9Cu','%C5%93','%C2%9C'), 'oe', ($word));
       $word =  urldecode(trim($word));
       $word = str_replace(Array('’ '),Array("’"),$word);
     }
    return $word;
   }
/**
 * get time difference
 * @param type $t1
 * @param type $t2
 * @return string
 */
function getMyTimeDiff($t1,$t2)
{
    $a1 = explode(":",$t1);
    $a2 = explode(":",$t2);
    $time1 = (($a1[0]*60*60)+($a1[1]*60)+($a1[2]));
    $time2 = (($a2[0]*60*60)+($a2[1]*60)+($a2[2]));
    $diff = abs($time1-$time2);
    $hours = floor($diff/(60*60));
    $mins = floor(($diff-($hours*60*60))/(60));
    $secs = floor(($diff-(($hours*60*60)+($mins*60))));
    $result = $hours.":".$mins.":".$secs;
    return $result;
}
/**
 * 
 * @global type $result_str
 * @global type $result_clean
 * @param type $in
 * @param type $lang
 * @return types
 */
function capture_brackets($in,$lang){
        global $result_str, $result_clean;
           $result_str  = ''; 
           $result_clean = '';
           preg_match_all('/\(([A-Za-z0-9 ]?)\)+/', $in, $out);
           $str_arr = Array();
           foreach($out[1] as $str){
               $str_arr[] =  '('.$str.')';
           }
           $result_clean = trim(str_replace($str_arr,'',$in));
           $x = find_in_string($result_clean,'(');
           if($x!='') $exp = explode($x, $result_clean);
           if(isset($exp[0])){
               $result_clean = trim($exp[0]);
               unset($exp[0]);
           }
           if(isset($exp)) $str_arr =  array_merge($str_arr,$exp);
           $result_str = str_replace(array('(',')'),'',$str_arr);
           return $result_clean;
   }
   
 /** THATS A NEW ONE
  * 
    $curdir =dirname(__FILE__);
    ftp_sync ($folder);   
    chdir ($curdir);
    ftp_chdir($conn_id,"..");
    ftp_sync ($folder_banners);  
  * 
  */
/**
 * ftp_sync - Copy directory and file structure
 * @global type $conn_id
 * @global string $folder
 * @param type $dir
 
   
function ftp_sync ($dir) {
    global $conn_id,$folder;
    if(isset($conn_id) && $conn_id!=''){
    if (!(is_dir($dir))) mkdir($dir); ///echo "<b>$dir</b><br>";
    if (ftp_chdir($conn_id, $dir) == false) echo ("Change Dir Failed: $dir<BR>\r\n");
    else {
        $contents = ftp_nlist($conn_id, ".");
        foreach ($contents as $file) {
            if ($file == '.' || $file == '..') continue;
            $exp = explode('.',$dir.$file);
            //if (isset($exp[1])) echo $file."<br>";else  echo "dir:$dir -- ". $file."<br>";
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
        //chdir ("..");
    }
    }
}
   
   */
?>