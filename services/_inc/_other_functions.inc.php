<?php 
/**
 * Author: Evstratova-Bourgois Ekaterina Urievna
 * Contact webvisio@webvisiondesign.net
 */
/**
 * (BTW, GSM, FAX or TEL) Number format convertion
 * @global type $valid_address
 * @global type $only_belgian_locations
 * @param type $nummer_check
 * @param string $defenition
 * @return string
 */
 function splitNummer($nummer_check, $defenition){
    global $valid_address, $only_belgian_locations; //TEMPORARY valid_address = BELGIAN ADDRESS
    $nummer = $nummer_check;//TBT
    if($defenition == 'fax') $defenition = 'tel';
    $defenitions = Array('tel'=>'** ** ** ** **', 'gsm'=>'** *** ** ** **', 'vestNR'=>'* *** *** ***','KlantNr'=>"****.***.***");
    $defenitions_spec = '** * *** ** **';
    $defenitions_spec_null = '** ** *** ** **';
        /*some errors that are  in the CSV file*/
        $nummer = replace(Array('  ','+000','+0000','+000000','+0000000000','+','.','/','-','(',')','*'), '', $nummer_check, 'strtoupper');
        if($only_belgian_locations == true){
            /*Only for Belgian phone numbers*/
            if (strpos($nummer, '+') == false) {
               $sub = substr($nummer,0,1);
               if(strlen(str_replace(' ','',$nummer))<=9 && $sub == 0 && $sub!='') {
                   $sub_num = substr($nummer,1);
                   $nummer = '32'.$sub_num;
               }
           }
        }
        foreach($defenitions as $code => $format){
            if($defenition == $code && $nummer!=''){
                $nrarray = '';
                $count = 0;
                $zones = array('2', '3', '4', '9'); //$land3 = array('377', '352');//$tempnr = substr($nummer,0,3);
                if($code =='vestNR' || $code =='KlantNr') $point = true; else $point = false;
                $len = (replace(Array('.','/','-','(',')',' '), '', $format, 'trim'));
                $nummer = replace(Array('.','/','-','(',')',' '), '', $nummer, 'trim');
                $len = (str_replace(' ','',$len));
                $nummer = str_replace(' ','',$nummer);
                $len = strlen($len);
                $nummer = preg_replace('/\s+/','', $nummer);//TBT NEW
                 if($code =='KlantNr'){
                    $nummer = str_replace(array('BE','be','BE ','be '),'', $nummer);
                    for($j=0;$j<(10-(strlen($nummer)));$j++) $nummer = '0'.$nummer;//??BUG?
                 }
                    if(strlen($nummer)==$len){
                        $splitsen = str_split($nummer);
                        if($code =='tel'){
                            if($splitsen[2] == 0){
                               if(in_array($splitsen[3], $zones)) $format = $defenitions_spec_null;
                            } elseif
                                (in_array($splitsen[2], $zones)) $format = $defenitions_spec;
                        }
                        $count = 0;
                        foreach(explode(' ',replace(Array('.','/','-','(',')'), ' ', $format, 'trim') ) as $spaces){
                            foreach(str_split($spaces) as  $num){
                               if(isset($splitsen[$count])) $nrarray.=$splitsen[$count];
                               $count++;
                            }
                            $count2 = $count;
                        //echo "<br>".(str_split($format)[$count2])." ".($count2)."-$count2::$format<br>";
                        if($point) $nrarray.=".";
                        else $nrarray.=" ";
                    }
                    if($point) $nrarray = substr($nrarray,0,-1);
                    $nummer = ($nrarray);
                }
                else
                    $nummer = replace(Array('.','/','-','(',')','*'), '', $nummer_check, 'strtoupper');
            }
        }
        if(find_in_string($nummer, Array('+'))=='' && substr($nummer,0,1)!=0 && $nummer!='' && $defenition !='vestNR' && $defenition !='KlantNr') $nummer='+'.$nummer;
        if(/*$valid_address==true && */$defenition =='KlantNr' && $only_belgian_locations == true && substr($nummer,0,2)!="BE") $nummer = 'BE '.$nummer;
        return $nummer;
}
//--------------------------------------
/**
 * @param string $somthing
 * @param type $find
 * @return string
 */
function trimmed($somthing,$find){
    if(strpos($somthing,$find)){
        $temparray = explode($find, $somthing);
        array_map('trim', $temparray);
        $somthing = $temparray[0]." - ".$temparray[1];
    }
    return $somthing;
}
//--------------------------------------
/**
 * @param type $Number
 * @return boolean
 */
function checkValidStreetNr($Number){
   $ValidNumber = false;
   $Number_controle = str_replace('/','',$Number);
   $Number_controle = preg_replace( '/[a-zA-Z]/',  '', $Number_controle);
   if (preg_match( '/^[\-+]?[-0-9]*\.*\,?[-0-9]+$/', $Number_controle))  {
          $ValidNumber = true;
    } else {
       $ValidNumber = false;
    }
    return $ValidNumber;
}
//--------------------------------------
/**
 * @param type $site
 * @return type
 */
function url_correction($site){
    $site = str_replace("http://", "", $site);
    $site = str_replace("https://", "", $site);
    return $site;
}
/**
* removing 'Rechtsvorm' (NV etc) from name
* @param type $name
* @return type
*/
function name_correction($name, $rechtsvorm){
    $remove_txt = $rechtsvorm;
    foreach($remove_txt as $txt) {
        $name = str_replace(' '.$txt,'', $name);
        $name = str_replace(' '.strtolower($txt),'', $name);
    }
    return $name;
}
//--------------------------------------
/**
* Handeling the 'crap' formating of the street/number/postcode in the CSV files:
* @global type $straat
* @global type $straatNR
* @global type $bus
* @global type $straatNR_vest
* @global type $straat_vest
* @global type $bus_vest
* @param type $string
* @param type $dif
*/
function separate_street_nr_bus($string, $dif){
    global $straat, $straatNR, $bus, $straatNR_vest, $straat_vest, $bus_vest, $naam;
    //-----------------------street
    $explode =Array($string);
    $pattern = utf8_encode("\D");// returns only the int   ///*"-a-zA-Z\):éèëêÉÈËÊáàäâåÁÀÄÂÅóòöôÓÒÖÔíìïîÍÌÏÎúùüûÚÙÜÛýÿÝøØœŒÆçÇ﻿' .("*/
    $check_num_start =  trim(preg_replace( "/[$pattern]/",  '', $explode[0]));
    $check_num_start = str_replace(array('/'),'',$check_num_start);
    $check_start_sub = trim(substr($check_num_start,0,1));
    $check_straat = @explode(($check_start_sub),$explode[0]);
   if(isset($check_straat[1])) {
        $Part = explode(' *',$check_straat[1]);
        $straat0 = $Part[0];
   }
   else
       $Part = '';
   $straat0 =  $check_straat[0];
   if($straat0 == '') $straat0 = trim($string);
   else $straat0 = preg_replace( '/[0-9]/', '', trim($straat0));
     //-----------------------Bus
    $string = @explode($straat0,$string);
    $string = $string[1];

    $explode_bus = explode('B', strtoupper($string));
    $check_val = @substr($explode_bus[1],-1);
    $check_val1 = substr($explode_bus[0],-1);
    $check_val2 = @substr($explode_bus[1],0,1);
    $upper_string= @explode('BUS',strtoupper($string)) ;

     //--------------------------------------
    if($check_val2!='-') $check_val2 ='';
    if(($check_val==' ' || $check_val1==' ' || $check_val2 == '-') && isset($explode_bus[1]) && $explode_bus[1] !=strtoupper('BB')  && $explode_bus[1]!=''
      && @$upper_string[1]==''){
        $search_case = strtoupper(' b').$check_val2;
    } else
        $search_case = '#';
    //--------------------------------------
     $bus_marks =  Array(strtoupper('bus'),'/',strtoupper('bte'),$search_case);//$search_case enabled for the moment
     $found = find_in_string(strtoupper($string),$bus_marks);
     //if($found !='') {$string = replace(Array($found), ' BUS ', $string, 'strtoupper');}
     $cX = '';
     if(isset($found) && $found !=''){
       $found = strtoupper($found);
       $explode = explode($found, strtoupper($string));
       $cX = count($explode)-1; //echo "<br>".$found."::: ". $string."+++<br>";
     }
       if(isset($explode[$cX]))
           $bus0 = trim(str_replace('BUS','' , trim($explode[$cX])));
       else
           $bus0 = '';
  //-----------------------in case if bus marking is only 'B', like 'b1' or 'B1'
    if($bus0 =='BB') $bus0 = 'B'; //only in case if '$search_case' is in  the $bus_marks Array
    $bus0 = preg_replace('/[-\+()]/','', str_replace('/','',$bus0));
     if($found =='B') $bus0 = 'B'.$bus0;
   //-----------------------Street Number
   if(isset($explode[0]) && $explode[0]!='') $straatNRX = explode($straat0,$explode[0]); else $straatNRX = $straatNR;//NEW TBT INSTEAD OF $straatNRX = explode($straat0,$explode[0]);
   $straatNR0 = $straatNRX[count($straatNRX)-1];

   if(trim(preg_replace( '/[0-9]/',  '*', $straatNR0)) == trim(preg_replace( "/[$pattern]/",  '', '*'.@$Part[1])) ){
          $explodeNew = @explode(' ','*'.$Part[1]);
          $explodeNew2 = explode(' ',$straatNR0);
          if(isset($explodeNew[1])) $NrPart2 = str_replace('*', '',$explodeNew[1]); else $NrPart2 = '';
          $straatNR0 = trim($explodeNew2[0].' '.$NrPart2.@$explodeNew2[1]);
   }
   if(!empty($dif) && $dif=='_vest'){
       $straatNR_vest = str_replace(array("'","."),'', trim($straatNR0));
       $straat_vest = trim($straat0);
       $bus_vest = str_replace(array("'","."),'',trim($bus0));
   } else {
       $straatNR = str_replace(array("'","."),'',$straatNR0);
       $straat = trim($straat0);
       $bus = str_replace(array("'","."),'',$bus0);
   }
   if(isset($SPLIT_ADDRESS) && $SPLIT_ADDRESS == TRUE){
       $nX = explode($straat0,$rechtsvorm);
       if(isset($nX[0])) $naam = trim($nX[0])." ".$rechtsvorm;
       $pX = explode(' ', $straatNR0.$bus0);
       $cX = count($pX)-1;
       $plaats_maatsch_address = $pX[$cX].
       $postcode[$cX-1];
   }
}
/**
 *
 * @global type $connect
 * @global string $new_var
 * @param type $variables
 * @param type $variable_values
 * @param string $lang
 * @return type
 */
function lang_switch($variables, $variable_values, $lang){//TBT NEW!!!
    global $connect;
    if($lang == '') $lang ='nl';
    foreach($variables as $count => $variable){
       global $$variable;
       if(substr($variable,-2)!=$lang) $new_var = $variable.$lang; else $new_var = $variable;
       global $$new_var;
       if($$new_var == '') $$new_var = $variable_values[$count];
       else if($$variable!='') $$new_var = $$variable;
   }
   return $$new_var;
}
/**
 *
 * @param type $location
 * @return type
 */
function remove_brackets($location){
    $location =explode('(',$location);
    $location = trim($location[0]);
    $location =  trim(preg_replace( '/[0-9]/',  '',$location));
    return $location;
}
/**
 * Import module:
 * @param type $idName
 * @param type $TableName
 * @param type $values
 * @param type $connect
 * @param type $check_doubles
 * @param type $record_exists - if it exists in the import list
 * @return type
 */
function check_doubles_and_input($idName, $TableName, $values, $connect, $check_doubles, $record_exists){
    global $atmusername, $double, $update, $UPDATE_DB, $double_klantid,$vest_import, $con2, $search_ID_ARR;
   
    $return_id = 0;
    $query_doubles = '';
    $query_input = '';
    $query_delete ='';
    $part1 = Array();
    $part2= Array();
    $not_search = Array('klantmarker','naamzichtbaar','creatiedatum','laatstepersoon','laatstbijgewerkt','contractSTART','contractEND',
    /*NEW 13/04/15 TBT*/'idVERKOPER');
    $not_search_values = Array('typeklant');
    $not_input = Array('tblKLANT'/*,'tblKLANT_VEST'*/);
    $not_id_klant = Array('tblKLANT_VEST');
    $empty_input = Array('tblX');//--input empty fields for contact
    $search_ID = '';
    /**not to import empty rows, when data is not in the file**/
    if($record_exists == true && (count($values)>0 || in_array($TableName,$empty_input))) {
        if($connect =='') $connect = $con2;
         $query_doubles = "SELECT $idName FROM $TableName WHERE ";
         $query_input = "INSERT INTO  $TableName SET ";
         if($TableName == 'tblVERTALING') $query_doubles.= "  (";
         if(array_key_exists('idVERTALING', $values)) $found = true;
         $co = 0;
         $coE = 0;
         foreach ($values as $key=> $value){ 
            //$value = escaped($connect,trim($value));//TBT
            $value = trim($value);//TBT
            $value = str_replace('"','',$value);
            if($value!='' || in_array($TableName,$empty_input)) $query_input.= " `$key` = \"$value\",";
            if(in_array($value, $not_search_values)) $value = '%';
            if(find_in_string(strtolower($key), Array('id','salt','wachtwoord')) && $value!='') {
                $search_ID.= " AND (`$key` LIKE \"$value\") ";
                $coE++;
           }
            if($key == 'nl' || $key == 'fr' || $key == 'en' ) {
               if(isset($found)) $val = '%'; else  $val = $value;
               if($val!='') $co++;
               $part1[] = " (`$key` LIKE \"$val\") ";
            }  else  {
               if($value!='' && (!in_array($key, $not_search))) $part2[] = "  `$key` LIKE \"$value\" ";
               if($value!='' && $TableName != 'tblVERTALING') $co++;//TBT 31/03/15
           }
         }
         $part1 = implode(' OR ',$part1);
         $query_doubles.= $part1;
         if($part1!='') $query_doubles.=') AND ';
         $query_doubles.= implode(' AND ',$part2);
         $query_doubles = $query_doubles." ORDER BY $TableName.$idName ASC LIMIT 1";
         $query_input = substr($query_input,0,-1);
         
          //----------------------------------------- check for doubles
         $rows = $rows_imp = 0;
         if((isset($check_doubles) && $check_doubles == 1)|| ($UPDATE_DB == true)) {
             //echo "Double check |:".$query_doubles."<br><br>";
             $query = run_query($query_doubles);
             $rows = $rows_imp = mysqli_num_rows($query);
             $row = mysqli_fetch_array($query);
             $return_id = $row[$idName];
         }   
            
         if((isset($check_doubles) && $rows==0 && $check_doubles == 1 && $UPDATE_DB == false) || ($check_doubles == FALSE && $UPDATE_DB == false) || ($UPDATE_DB == true && $rows==0 && $TableName!='tblOPENINGSUREN')) { 
             if(($double != true || $TableName == 'tblKLANT_VEST')  && ((!in_array($TableName, $not_input) && $UPDATE_DB == TRUE) || $UPDATE_DB == false)
              /*|| ($update == true && (($rows==0 && $check_doubles == 1)|| ($check_doubles == FALSE)) && (!in_array($TableName, $not_input)))*/){
                if($co>0) {
                    mysqli_query($connect,$query_input) or die(mysqli_error($connect)."<br/>Error:$query_input<br/>");  
                    $return_id = mysqli_insert_id($connect);
                    $rows = $rows_imp = 1;
                }
             }
         }
         //-------------------------------UPDATE RECORD IN THE DATABASE (OPTION CAN BE SET ONLY MANUALLY IN THE CODE- NOT ON BY DEFAULT!)
         $where = '';
         //echo $double_klantid."++++$where+++$search_ID++++-->$double_klantid<br>";
         if ($UPDATE_DB == true && $double_klantid!=0) {

            if(!in_array($TableName, $not_id_klant)) {//TBT: NEW
                if(array_key_exists('idKLANT', $values) || in_array($TableName, $not_input)) $where.= " AND idKLANT = '$double_klantid' ";
                elseif(array_key_exists('klantID', $values)) $where.= " AND klantID = '$double_klantid' ";
            }
            if($where!=''){
                $query_up_chk = "SELECT $idName FROM $TableName  WHERE 1 $where $search_ID LIMIT 1";
                //echo "Double check ||: $rows_imp::$coE::".$query_up_chk."<br><br>";
                $query = run_query($query_up_chk);
                $arr = mysqli_fetch_array($query);
                $return_id = $arr[$idName];
                $rows = mysqli_num_rows($query);
             }
             if((!in_array($TableName, $not_input)) && $rows==0) {
                   //echo "INPUT ||:".$query_input."+++<br>";
                    mysqli_query($connect,$query_input) or die(mysqli_error($connect));
                    $return_id = mysqli_insert_id($connect);
                    $rows = $rows_imp = 1;
             }
             if(isset($return_id)) $where.= " AND $idName = '$return_id'";
             $query_up = str_replace('INSERT INTO','UPDATE',$query_input)." WHERE 1 $where LIMIT 1";
             if($update == true && $where!='' && $rows_imp==0) {//TBT NEW
                 // echo "UPDATE ||:".$query_up."<br>";
                $rows = 1;
                 mysqli_query($connect,$query_up) or die(mysqli_error($connect)."<br/>$query_up<br/>");
             }
             //--------------------------DELETE RECORD:  TBT
             if($update == true && $where!='' && $TableName!='tblKLANT' && $TableName!='tblOPENINGSUREN'){//TBT NEW
                 if($coE>1 && $rows_imp>0) $search_ID_ARR[] = $return_id;
                 $del_part = explode("WHERE",$query_up);
                 if(isset($del_part[1]) && $del_part[1]!='' && $rows_imp==0) {
                    $query_delete = "DELETE FROM `$TableName` WHERE  ".$del_part[1];
                   //if($coE==1)  echo "DELETE ||:".$query_delete."<br>";
                   if($coE==1)  mysqli_query($connect,$query_delete) or die(mysqli_error($connect)."<br/>$query_delete<br/>");
                 }
             }
             //-------------------------END DELETE
         }
         //-------------------------------END UPDATE
     }
     return $return_id;
}

/**
 * On update DELETE RECORD(S)
 * @global type $nieuweklantid
 * @global type $connect
 * @param type $IDName
 * @param type $TableName
 * @param type $search_ID_ARR
 */
function delete_extras($IDName, $TableName, $search_ID_ARR){
  global $nieuweklantid, $connect, $UPDATE_DB, $update;
  if(isset($nieuweklantid) && count($search_ID_ARR)>0 && $UPDATE_DB == TRUE && $update == TRUE){
    $search_ID_ARR = implode(',',$search_ID_ARR);
    $query_delete = "DELETE FROM $TableName WHERE `idKLANT` LIKE '$nieuweklantid' AND $IDName NOT IN ($search_ID_ARR)";
    //echo $query_delete."+++";
    mysqli_query($connect,$query_delete) or die(mysqli_error($connect)."<br/>$query_delete<br/>");
  }
}
/**
 * @global type $region
 * @global type $locatienaam_NL_searchNew
 * @global type $idLOCATIE
 * @param type $straat
 * @param type $straatNR
 * @param type $postcode
 * @param type $locatienaam
 * @param type $postcode_check
 * @return type
 */
function find_gps_coords($straat,$straatNR,$postcode,$locatienaam, $postcode_check ){
    global $region, $locatienaam_NL_searchNew, $idLOCATIE, $_id, $locatie_check, $connect, $key, $error, $locality,$municipality,$sublocality, $pcode_new, $landzone,$check_location, $link, $online_testing;
    $adresEXTRA = '';
    $locatienaam_search = stripslashes($locatienaam);
    $locatienaam_NL_searchNew  = $locatienaam;
    $json = false;
    if($postcode_check == false) $post = " ".$straatNR." ".$postcode." ".$locatienaam_search;
    else if($locatie_check == false && $postcode_check == true) $post = " ".$locatienaam_search;
    else if($locatie_check == true && $postcode_check == true) {
        $quer = "SELECT nl FROM `tbllocatie` JOIN `tblvertaling` ON `tblvertaling`.`idVERTALING` = `tbllocatie`.`locatieNAAM`
         WHERE locatiePOSTCODE='$postcode' and  nl!='' LIMIT 1";
        $result_locate = mysqli_query($connect,$quer);
            while ($row_locate= mysqli_fetch_object($result_locate)) {
                $locatienaam_NL_searchNew = $locatienaam = $row_locate->nl;
                $post = " ".$postcode." ".$locatienaam_NL_searchNew;
            }
    }
   
    $address = urlencode(mb_convert_encoding(str_replace(" ", "+",strtoupper(stripslashes(str_replace("'","´",$straat))).$post), 'UTF-8'));
    $link =  "https://maps.google.com/maps/api/geocode/json?address=$address&sensor=false&region=$region&language=nl&amp;&key=$key";
    //--------------------------------------
    /**
    * Google limits you usage of their geocoding api to 2500 request per day per IP address //echo "<b style='color:red'>".$error."</b><br>";
    * **/
    if($online_testing == TRUE || $postcode_check == true){
        $json = @file_get_contents($link);
        $json = json_decode($json);
        $error = @$json->{'error_message'};
    }
    $adresEXTRA = '';
    if(isset($check_location) && isset($json->{'results'}[0]) && $check_location==true){
            echo "<br><a href='$link' target='_blank'>".$link."</a><br>";
          
            foreach($json->{'results'}[0]->{'address_components'} as $co=>$data){
                foreach($data as  $class){
                    //if($class[0] == 'postal_code')  $pcode_new = $json->{'results'}[0]->{'address_components'}[$co]->{'long_name'}; 
                    if($class[0] == 'locality') $municipality = $json->{'results'}[0]->{'address_components'}[$co]->{'long_name'};//gemeente
                    if($class[0] == 'sublocality_level_1') {
                        $sublocality = $json->{'results'}[0]->{'address_components'}[$co]->{'long_name'};
                    }
                    if(isset($class[0]) && $class[0] == 'administrative_area_level_2') $locality =  $json->{'results'}[0]->{'address_components'}[$co]->{'long_name'};
                    if($locality=='') $locality  =  $municipality;
                    //----------------------------------
                    if(isset($class[0]) && $class[0] == 'administrative_area_level_1') 
                    $landzone = $json->{'results'}[0]->{'address_components'}[$co]->{'long_name'};
                    else { if($locality == 'Brussel' )$landzone =  'Brussels Gewest'; }   
                } 
            }  
    }
    
    $locatienaam_NL_searchNew = '';//NEW TBT
    
    if($postcode_check == false){ 
        if($error == '' && $json!=''){
            $lat = @$json->{'results'}[0]->{'geometry'}->{'location'}->{'lat'};
            $long = @$json->{'results'}[0]->{'geometry'}->{'location'}->{'lng'};
            if($lat!='' && $long!='') $adresEXTRA = $lat.",".$long;
        } //else echo "<b style='color:red'>".$error."</b><br>";
    } else { 
        if(isset($json->{'results'}[0])){
            $formatted_address = $json->{'results'}[0]->{'formatted_address'};
            $exp= explode(',',$formatted_address);
            $exp1= explode(' ',@trim($exp[1]));
            $adresEXTRA = @trim($exp1[0]);
            if($locatie_check == false && isset($exp[1])) $locatienaam_NL_searchNew = trim(preg_replace( '/[0-9]/',  '',  trim($exp[1])));
            //--------------------------------------
            if(!is_numeric($adresEXTRA)){
                $formatted_address = @$json->{'results'}->{'formatted_address'}[1];
                if($formatted_address!=''){
                    $exp= explode(',',$formatted_address);
                    $exp1= explode(' ',@trim($exp[1]));
                    $adresEXTRA = @trim($exp1[0]);
                    if($locatie_check == false && isset($exp[1])) $locatienaam_NL_searchNew = trim(preg_replace( '/[0-9]/',  '',  trim($exp[1])));
                }
            }
        }
        if($adresEXTRA =='' || !is_numeric($adresEXTRA) && $postcode_check == TRUE){
           $adresEXTRA = $postcode;
           $locatienaam_NL_searchNew = $locatienaam;
        }
    } //echo ' +++'.$adresEXTRA." +++ ".$locatienaam_NL_searchNew." = $locatienaam<br>";
    return $adresEXTRA;
}
/**
 * test if daily API limit is not exided:
 * @global string $TableName
 * @global string $error
 * @global type $key
 * @global type $key_extra
 * @global type $APIerror
 * @param string $TableName
 */
function checkAPI($TableName){
    global  $error, $key, $key_extra, $APIerror;
    $APIerror = false;
    $API_LIMIT_TEST = find_gps_coords('','','','Brussels', false);
    if($API_LIMIT_TEST == '' &&  $TableName!='') {
         $key = $key_extra;
         $error= '';
         $API_LIMIT_TEST =  find_gps_coords('','','','Brussels', false);
         if($API_LIMIT_TEST == '' && $error!='') {
         $APIerror = "<b style='color:red;'>ERROR: $error. Please tyry again tomorrow.</b><br/><br/>";
         $TableName = '';
        }
    } 
    return $key;
}
/**
 * if pack name contains roman numbers+ few more situations
 * @param type $packNAAM
 * @return string
 */
function get_pack_name($packNAAM){
    $pack = explode(' ',(trim($packNAAM)));
    if(count($pack)>1){
        if(!is_numeric($pack[1])) $pack[1] = rom2arab($pack[1],$letters=array());//--if latin number(like IV)
        $packNAAM = strtolower($pack[0])." ".$pack[1];
        if(isset($pack[2]) && $pack[2]!='')  $packNAAM.= " - ".ucfirst(strtolower($pack[2]));
    } else {
        if(is_numeric($packNAAM)) $packNAAM = 'Pack '.$packNAAM;//---if only number
        else $packNAAM = "'%".(ucfirst(strtolower($packNAAM)))."'";//---if only letters
    }
   return $packNAAM;
}
/**
 * part of get_opening_hours()
 * @global type $day_of_week
 * @global type $count_uren
 * @global type $total_hours
 * @param type $days
 * @return type
 */
function get_time($days){
    global $day_of_week,$count_uren, $total_hours;
    $exp = explode('dag',$days);
     if(find_in_string($days, Array('dag'))) $days = substr($days,0,2).':'.$exp[1];
    $days = replace(Array('closed','gesloten','van','u','uur','uren'), '', strtolower($days), 'trim');
    $days = replace(Array('.'), ':',$days, 'trim');
    if(substr($days,2,1)!=':') $days = str_replace(substr($days,0,2),substr($days,0,2).':',$days);
    if(trim(substr($days,3,1)) == '') $days = str_replace(substr($days,0,4),substr($days,0,3),$days);
    $days = replace(Array('tot',',',':-','-'), ' ', $days,'trim');
    $days = preg_replace('!\s+!', '-', $days);
    $day = explode(':',$days);
    $day_of_week = substr(str_replace('dag',':',$day[0]),0,2);
    for($j= 1; $j<7;$j++){
        if(isset($day[$j])){
            $t = explode('-',$day[$j]);
            if($t[0]!='') $count_uren++;
            $total_hours[$day_of_week][] = trim($t[0]);
            if(isset($t[1])){
                $count_uren++;
                $total_hours[$day_of_week][] = trim($t[1]);
            }
        }
    }
    return $total_hours;
}
/**
 * convert text openings uren to the DB values:
 * @global type $day_of_week
 * @global int $count_uren
 * @global array $total_hours
 * @param type $openingsuren
 * @return type
 */
function get_opening_hours($openingsuren){
     global $day_of_week,$count_uren, $total_hours;
    if(isset($openingsuren) && trim($openingsuren)!=""){
        $openinghours = array();
        $explode = explode("\n",$openingsuren);
        foreach ($explode as $days){
            $count_uren = 0;
            $total_hours = Array();
             foreach(get_time($days) as $day => $hours){
                $j = 1;
                $time='';
                $co = 0;
                 foreach($hours as $hour){
                     $namedb = $day;
                    if(($co<2 && $time<'12' && $time>'05')) $namedb.='VM'; else $namedb.='NM';
                    if ((boolean)($j % 2)) $time= '';
                     else {
                        $co++;
                        $time.= ':'.$hour;
                    }
                   if((boolean)($co % 2)) $namedb_part = 'van'; else  $namedb_part = 'tot';
                   if((boolean)(($count_uren/2) % 2) && $namedb_part == 'van' && (boolean)($co % 2) && $co>1) $namedb_part = 'tot';
                   if($time!='')  $openinghours[$namedb.$namedb_part]=date('H:i:s',strtotime($time));
                   $time = $hour;
                   $j++;
                 }
             }
        }
    } else $openinghours  = '';
    return $openinghours;
}
/**
 *
 * @global type $groep_soort
 * @global type $groep
 * @param type $groep_
 * @param type $lang
 */
function getGroupName($groep_, $lang){
    global $groep_soort,$groep;

    $groep_exp =explode('(',$groep_);
    if(!isset($groep_exp[1])) $soort = 'Groepsnaam';
    else {
        if(in_array(preg_replace('/\s+/','', strtoupper($groep_exp[1])),array('NL)','FR)','EN)')) && isset($groep_exp[2])) $soort = $groep_exp[2];
        else $soort = $groep_exp[1];
    }
    $groep_soort = str_replace(')','',$soort);
    $groep = trim(str_replace(array('(',$groep_soort,')'),'',$groep_));
    lang_switch(Array('groep'.$lang, 'groep_soort'.$lang), Array($groep, $groep_soort), $lang);
}

/**
 *
 * @global type $ftp_conn_id
 * @global string $word
 * @param type $id
 * @param type $lang
 * @param type $folder
 * @param type $what
 * @return int
 */
 function getFileSettings($id,$lang, $folder, $what){
    global $ftp_conn_id;
    $word = $what.'overnemen';
    global $$word;
    $dirnm = "/public_html/$lang/klanten/$id";
    if(ftp_nlist($ftp_conn_id, "$dirnm/$folder/")!='') $$folder = ftp_nlist($ftp_conn_id, "$dirnm/$folder/"); else $$folder = Array();
    if(str_replace(array("$dirnm/$folder",'.','..','/','#'),'',implode('#',$$folder))!='') $$word = 0;
    return $$word;
 }


 /**
  *  Marker overnemen(groep)
  * @global type $UPDATE_DB
  * @global type $ftp_server2
  * @global type $ftp_user2
  * @global type $ftp_password2
  * @global type $creadovernemen
  * @global type $logoovernemen
  * @global type $markerovernemen
  * @param type $update
  * @param type $lng
  */
 function getGroupSetting($update,$lng){
     global $UPDATE_DB, $ftp_server2, $ftp_user2, $ftp_password2, $creadovernemen, $logoovernemen, $markerovernemen, $nieuweklantid;
     if($update == TRUE && $UPDATE_DB == TRUE){
     $ftp_conn_id = ftpConnect($ftp_server2,$ftp_user2,$ftp_password2);
        if(isset($ftp_conn_id)){
               $lng = strtolower($lng);
               $creadovernemen = getFileSettings($nieuweklantid,$lng, 'creads','cread');
               $logoovernemen = getFileSettings($nieuweklantid,$lng, 'logo','logo');
               $markerovernemen = getFileSettings($nieuweklantid,$lng, 'marker','marker');
           ftp_close($ftp_conn_id);
        }
     }
 }
 
 
 
?>