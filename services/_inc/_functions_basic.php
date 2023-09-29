<?php
/**
 * Author: Evstratova-Bourgois Ekaterina Urievna
 * Contact webvisio@webvisiondesign.net
 */
/**
 * @global type $ftp_conn_id
 * @param type $ftp_server
 * @param type $ftp_user
 * @param type $ftp_password
 * @return type
 */
function ftpConnect($ftp_server,$ftp_user,$ftp_password){
    global $ftp_conn_id;
    $ftp_conn_id = ftp_connect($ftp_server);
    $login_result = ftp_login($ftp_conn_id, $ftp_user, $ftp_password);
    if((!$ftp_conn_id) || (!$login_result)) echo "FTP connection has failed!";
    else  return $ftp_conn_id;
}
//------------------------------------------------------------Mysql functions
/**
     * @param type $connect
     * @param type $string
     * @return type
     */
function escaped($connect,$string){
    $string = trim(mysqli_real_escape_string($connect,$string));
    return $string;
}
/**
 * looking for the DB conn. file and connecting to it
 * @param type $file
 * @param type $host
 * @param type $user
 * @param type $password
 * @param type $database
 */
function connect($file){
    global $connect, $database, $host, $online_testing, $key, $key_extra, $life_import,$port, $DB, $test_connection;
    include(locate_file($file));
    if(isset($host)){
        $connect = mysqli_connect($host,$user,$password,$database,$port)or die ("Unable to select '$database' at host '$host'").mysqli_error($connect);
         mysqli_query($connect,"SET NAMES UTF8");
    }
    return $connect;
}
/**
 * Get results of a query
 * @global type $connect
 * @param type $q
 */
function query($q){
     global $connect;
     $r = mysqli_query($connect,$q) or die(mysqli_error($connect));
     while ($row = mysqli_fetch_object($r))  return_name($row);
}

function run_query($query){
    global $connect;
    $q = mysqli_query($connect,$query) or die(mysqli_error($connect)."<br/>$query<br/>");
    return $q;
}
/**
 * defining the names and values of array(for example: mysql_fetch_object)
 * @global type $keyx
 * @param type $sourse
 */
function return_name($sourse) {

    foreach ($sourse as $keyx => $valuex) {
        //$keyx =  trim(preg_replace('/-. /',  '_', trim($keyx)));
        //$keyx =  trim(preg_replace('/﻿+/',  '', trim($keyx)));
        $keyx = str_replace(' ', '_', $keyx);//thats the crap sometimes found in the DB
        $keyx = str_replace('-', '_', $keyx);
        $keyx = str_replace('+', '', $keyx);
        $keyx = str_replace('.', '_', $keyx);
        $keyx = str_replace('﻿', '', $keyx);//bug char in csv files
        $valuex = str_replace('﻿', '', $valuex);//bug char in csv files
        $valuex = trim($valuex);
        global $$keyx;
        $$keyx = $valuex;
    }
}
/**
 * Adding some speed to everything.
 * @global type $connect
 */
function boost() {
    global $connect;
    ini_set("memory_limit", "10000M");
    ini_set("max_execution_time", "100000");
    ini_set("set_time_limit", "100001");
    ini_set("max_allowed_packet", "10000M");
     //--------------------------------------
    $query = "set-variable = key_buffer=96M";
    $query.=" safe-show-database";
    $query.=" set-variable = max_connections=500";
    $query.=" set-variable = key_buffer=96M";
    $query.=" set-variable = myisam_sort_buffer_size=96M";
    $query.=" set-variable = join_buffer=4M";
    $query.=" set-variable = record_buffer=4M";
    $query.=" set-variable = sort_buffer=4M";
    $query.=" set-variable = table_cache=0";
    $query.=" set-variable = thread_cache_size=0";
    $query.=" set-variable = wait_timeout=5";
    $query.=" set-variable = thread_concurrency=2";
    $query.=" set-variable = connect_timeout=5";
    $query.=" set-variable = tmp_table_size=64M";
    $query.=" set-variable = max_allowed_packet=32M";
    $query.=" set-variable = max_connect_errors=1";
    mysqli_query($connect, $query);
}
//-------------------------------------------------------------Ohter functions-------------------------------------------*
/**
 * looking for the file in the ../../* folders
 * @param string $file_name
 * @return string
 */
function locate_file($file_name){
    $retry=1;
    $i=-1;
    foreach(explode('/', $_SERVER['PHP_SELF']) as $exp)$i++;
    while(!file_exists($file_name) && !is_dir($file_name) && $retry<$i){$file_name="../".$file_name;$retry++;}
    if(file_exists($file_name) && !is_dir($file_name)) include($file_name);
    if(!is_dir($file_name) && !file_exists($file_name)) $file_name = '';
    return $file_name;
}
/**
 * @param type $where
 * @param type $what
 * @return type
 */
function find_in_string($where, $what){
    global $found;
    $found = '';
    $co = 0;
    $str = '';
    if(!is_array($what)) $what = array($what);
    foreach($what as $string){
        $string =  trim($string);
        if($string!='') $pos = strpos($where, $string);
        if ($pos !== false) {
          $found = $string;
          if(strlen($found)>1) $str = $found;
          $co++;
        }
    }
    if($co>=1 && $str!='') $found = $str;
    return $found;
}
/**
 *
 * @param type $what
 * @param type $by_what
 * @param type $string
 * @param type $case
 * @return type (strtolower/upper or trim)
 */
function replace($what, $by_what, $string, $case){
   foreach($what as $tag){
        $string = str_replace($case($tag),$by_what,$case($string));
   }
   return $string;
}
/**
 *
 * @global type $name
 * @param type $values
 */
function overwrite($values){
    foreach($values as $name=>$value){
         global $$name;
        $$name = $value;
        //echo $name ."= $value<br>";
    }
}
/**
 * @param type $url
 */
function refresh_page($url) {
    echo "<meta http-equiv='REFRESH' content='0;url=$url'>";
}
/**
 *
 * @param type $w
 * @return type
 */
function add_slash($w){
    return "\"".addslashes($w)."\"";
}
/**
 *
 * @param type $word
 * @return type
 */
function return_word($word){
     $word =  preg_replace('!\s+!', '', $word);
     return trim(preg_replace( "/[-\+?.:,;'()0-9 ]/",'',trim($word)));
  }

/**
 *
 * @param type $where
 * @return type
 */
 function remove_tags($where){
     $where = str_replace(array('/','.',' ','_','+','=','location'), "", $where);
     return $where;
 }

 /**
  * Validate date
  * @param type $value
  * @return boolean
  */
 function is_date($value){
      if (date('Y-m-d', strtotime($value)) == $value || $value=='0000-00-00') return true;
      else  return false;
 }
  /**
  * Validate time
  * @param type $value
  * @return boolean
  */
 function is_time($value){
      if (date('H:i:s', strtotime($value)) == $value || date('H:i', strtotime($value))==$value || $value=='00:00:00') return true;
      else  return false;
 }
/**
 *
 * @param string $subject
 * @param type $content
 * @param type $emails
 * @param type $attachment
 */
 function send_mail_with_attachment($subject, $content, $emails, $attachment){
    $from = "no-reply@ondernemers-en-shoppingnetwerk.be";
    # -=-=-=- MIME BOUNDARY
    $mime_boundary = "----Your_Company_Name----".md5(time());
    $headers = "From: $from <$from>\n";
    $headers .= "Reply-To: $from <$from>\n";
    $headers .= "MIME-Version: 1.0\n";
    $headers .= "Content-Type: multipart/alternative; boundary=\"$mime_boundary\"\n";
    $message = "--$mime_boundary\n";
    $message .= "Content-Type: text/plain; charset=UTF-8\n";
    $message .= "Content-Transfer-Encoding: 8bit\n\n";
    $message .= "--$mime_boundary\n";
    $message .= "Content-Type: text/html; charset=UTF-8\n";
    $message .= "Content-Transfer-Encoding: 8bit\n\n";
    $message .= "<html>\n";
    $message .= "<html><head><style type='text/css'>td { height:30px;border:1px solid #cccccc;padding:0.5em;font-size:1.5em;background:#eee;color:#333;} img {height:50px;width:50px}</style></head><body>\n";
    $message .= "<br>\n";
    $message .= "$content";
    $message .= "</body>\n";
    $message .= "</html>\n";
    $message .= "--$mime_boundary--\n\n";
    $mail_sent = mail( $emails, $subject, $message, $headers );
    echo $mail_sent ? "" : "<br/>Mail failed!";
}
 //-------------------------------------------BANNERS
/**
 *
 * @global type $_POST
 * @global type $_GET
 * @global type $fields_up
 * @global type $_REQUEST
 * @param type $onclick
 * @param type $names
 * @param type $type
 * @param type $id
 * @param type $count
 * @return type
 */
 function makeInputField($onclick,$names, $type, $ids, $count, $placeholder){
     global $_POST,$_GET,$fields_up,$_REQUEST, $nr, $dont_edit, $titles, $connect;
     $fields_up  = Array();
     $onmouse = '';
     if(!isset($titles)) $titles = Array(/*'search'=>'SEARCH',*/'location'=>'LOCATION', 'PRICE_PER_KEYWORD'=>'PRICE/KEYWORD &euro;','PRICE_PER_HOUR'=>'PRICE/HOUR &euro;','PRICE_PER_CLICK'=>'PRICE/CLICK &euro;');
     foreach($names as $name=>$value){
         $tags = 'tags_'.$name;
        global $$tags;
        if(!isset($$tags)) $$tags = '';
         if(isset($_REQUEST[$name.$count])) $fields_up[] = $value = $_REQUEST[$name.$count];
         else if((isset($_GET[$name]) && $_GET[$name]=='' ) || (!isset($_GET[$name])))  $fields_up[] = $value;
         //datepicker
         $class='';
         if (is_date($value)) {
             $id = "date_".$name.$count;
             $class='datepicker';
             $nr++;
         } else
             $id = $name.$count;
         if (is_time($value)) $class = 'timepicker';
         else $t= $type;

         if(isset($dont_edit) && in_array($name,$dont_edit)) $dis = true; else $dis = false;
         //--------
         if(!isset($titles[$name])) $titles[$name] = '';
         $find_me = array('BANNER_KEYWORDS','RUBRIC','LOCATION');
         $onchange = '';
         /* DISABLED -> SELECT ONLY 1 OPTION: 'MAX CLICKS' OR 'CONTRACT PERIOD'
         if(find_in_string($name, array('CONTRACT_END')))$onchange="changeValue('MAX_CLICKS$count', '0')";
         elseif(find_in_string($name, array('MAX_CLICKS'))) $onchange="changeValue('".get_datepicker_id($nr-1)."', '0000-00-00');changeValue('".get_datepicker_id($nr-2)."', '0000-00-00')";
         else $onchange = '';
         */
         if(find_in_string($name, $find_me)){
            $t = 'hidden';
            if($name!='BANNER_KEYWORDS') $selectOnly = 'true'; else $selectOnly = 'false';
            if($name!='LOCATION') $l = '0'; else $l = '1';
            $c = number_format($nr/2,0);
            $fieldName = $name."_X".($c);
            $onmouse = '';//onmousemove
            $onmouse= run_jquery($name,$fieldName, $titles[$name], $l,$selectOnly,$tags, $id);
            echo "<ul id='$name".($c)."' onmousemove = \"$onmouse\"><li>".implode("</li><li>",explode(';',$value))."</li></ul>";
         }
        else
            if($titles[$name]!='') echo "<span class='title'>$titles[$name]:</span>";
        if($dis ==false) echo "<input type='$t' placeholder='$titles[$name]...' name='$name$count' id='$id' value=\"".$value."\" onclick=\"$onclick\" onchange=\"$onchange\" class='form-control $class' style='display:inline'/>";

     }
     return $fields_up;
 }

/**
 *
 * @global type $fieldName
 * @global type $l
 * @global type $selectOnly
 * @global type $id
 * @param type $name
 * @param type $function
 * @param type $details
 * @return type
 */
 function script($name, $function, $details){
     global $fieldName,$l, $selectOnly, $id;
     return "<script>$(function(){ $('#$name').$function($details); });</script>";
 }
/**
 *
 * @global type $nr
 * @global type $tags
 * @param type $name
 * @param type $fieldName
 * @param type $l
 * @param type $selectOnly
 * @param type $tags
 * @param type $id
 * @return type
 */
 function run_jquery($name, $fieldName, $placeholder, $l, $selectOnly,$tags, $id){
     global $nr, $$tags;
     $details = "{ availableTags: [".$$tags."], autocomplete: {delay: 0, minLength: $l}, selectOnly: $selectOnly, fieldName:'$fieldName', placeholder:'$placeholder'}";
     $c = number_format($nr/2,0);
     echo script($name.($c), 'tagit',$details);
     echo script($name.($c), 'sortable','');
     return $onmouse = "document.getElementById('$id').value=document.getElementById('$fieldName').value";
 }
/**
 * 
 * @return string
 */
 function loading_graph(){
   $prc = "<div id='radial-progress' data-progress='1'>
    <div class='circle'><div class='mask full'><div class='fill'></div></div>
    <div class='mask half'><div class='fill'></div><div class='fill fix'></div></div>
    <div class='shadow'></div></div>
    <div class='inset'>
    <div class='percentage'>
    <div class='numbers'><span>99%</span>";
   for ($ii=1;$ii<101;$ii++) $prc.= "<span>$ii%</span>";
   $prc.="</span></div></div></div></div>";
 return $prc;
 }
/**
 *
 * @param type $tags
 * @return type
 */
 function mysql_tags($tags){
    return '"'.implode('","',$tags).'"';
 }
/**
 * Banners
 * @global type $co
 * @global type $idBUYER
 * @global type $hours
 * @global type $days
 * @global type $price
 * @param type $KEYWORDS_COUNT
 * @param type $CLICKS_COUNT
 * @return type
 */
 function show_detail_title($KEYWORDS_COUNT,$CLICKS_COUNT,$HOURS_PER_DAY, $lang){
     global $co,$idBUYER,$hours,$days,$price;
     if($lang == '') $lang = 'NL';
     $href= "klant.php?aantepassenklantselect=$idBUYER";
     return "&nbsp;$lang <b>(<a href='$href' target='_blank'>$idBUYER</a>)</b> <span class='ui-icon ui-icon-info' style='display:inline-block' title='Total hours:".($hours*$days).", Keywords: $KEYWORDS_COUNT, Clicks: $CLICKS_COUNT, Price: &euro; $price'></span>";
 }
 
 /**
  * 
  * @global type $replace_word
  * @param type $search
  * @param type $replace
  * @return type
  */
 function replace_exact_word($search, $replace){
    global $replace_word;
    $return  = '';
    foreach(explode(' ',$search) as $exp){
        if(isset($replace_word) && $replace_word!='' && in_array($exp,$replace)) $return.=str_replace($replace,$replace_word, trim($exp)); 
        else { if(isset($replace_word)) $return.=' '.$exp;}

        if($exp != find_in_string($search, $replace)) {
           if(!isset($replace_word))  $return.=' '.$exp;
        } 
    }
    return trim($return);
 }
 
 
/**
 * 
 * @param type $langueges
 * @param type $what
 * @return type
 */
function if_seach($langueges, $what, $how){
    $if_seacrh = array('');
    foreach($langueges as $languege){
        if($what!='') $if_seacrh[] = " LOWER($languege) $how \"$what\" "; 
    }
    $if_seacrh = implode(' OR ',$if_seacrh);
    return $if_seacrh;
}

/**
 *
 * @param type $fuid
 * @param type $ffname
 * @param type $femail
 */
function checkuser($fuid,$ffname){
        global $connect,$typeGEBRUIKER, $_SESSION;
        $pass = trim(base64_encode(hash('sha256', $fuid.$ffname)));
    	$result = mysqli_query($connect,"SELECT * FROM tblATMlogin WHERE salt='$fuid' ");
	$rows = mysqli_num_rows($result);
	if (empty($result)) {
            $q ="INSERT INTO tblATMlogin (salt,gebruikersNAAM,wachtwoord,typeGEBRUIKER,active) VALUES ('$fuid','$ffname','$pass','$typeGEBRUIKER','1')";
             mysqli_query($connect,$q);
        } else {
            // If Returned user . update the user record (in case he changed login through FB account)
            $q = "UPDATE tblATMlogin SET gebruikersNAAM='$ffname', wachtwoord='$pass', typeGEBRUIKER='$typeGEBRUIKER', active='1' WHERE salt='$fuid' ";//echo $q;exit;
            mysqli_query($connect,$q);
	}
         if($rows==1){
            $row = mysqli_fetch_assoc($result);
            $_SESSION['wachtwoord'] = $pass;
            $_SESSION['atmusername'] = $_SESSION['FULLNAME'];
            $_SESSION['atmmyid'] = $row['idATM'];
            $_SESSION['atmtypelid'] = $typeGEBRUIKER;
         }
         return $_SESSION;
} 

 $basic = true;
?>