<?php

 /**
 * @global type $relevancy
 * @param type $word
 * @param type $question
 * @return type
 */
function _define($word, $question) {
   global $relevancy;
   if(is_string($word))  $words = find($word, $question);
   return $words;
  }
/**
 *
 * @global type $relevancy
 * @param type $word
 * @param type $find
 * @return type
 */
 function find($word, $find){
    global $relevancy;
    $words = Array();
    $relevancy = Array();
    $rel = 0;
    foreach($find as $result){
        if (@strpos(strtolower($word), strtolower(return_word($result)))!== false) {
            $rel++;
            $words[]= ($word);
            $relevancy[$word] = $rel;
        }
    }
    return array_unique($words);
  }
/**
 *
 * @global type $slash
 * @global type $merge
 * @global type $rel_count
 * @global type $arr
 * @global type $type
 * @global int $co
 * @global type $co2
 * @global type $j
 * @global type $rel
 * @global type $types
 * @global type $found_exact
 * @global type $type_exact
 * @global type $what
 * @param type $word
 * @param type $searchword
 * @param type $what
 * @return type
 */
function find_results($word, $searchword, $what){
   global $slash, $merge,$merge2,$locations, $rel_count, $arr, $type, $co, $co2,$j, $rel, $types, $found_exact, $type_exact, $relative_search, $$what,$exact, $connect, $search_exact_query_check,$names_exact;
   $j+=($co+$co2); //limit:not used for the moment
   if(isset($locations)) $merge2 = array_unique(array_merge($merge2,array_unique($locations)));
   if(isset($types[$type])) $type = $types[$type];
   if($word!='' && count($word>0)){
    if($j>0 && $searchword!='' && $what!='searchword') {
            $def_extra = 0;
            $def = _define(strtolower($searchword),$merge);
            $def_extra = str_replace($def,'888', strtolower($word));
            $def_extra = preg_replace('/\D/', '',$def_extra);
            $def_ext = explode('888',$def_extra);
            
            //print_r($def);
            ///echo "<br>".$def." ".$def_extra.' '.count($def_ext)."+++++<br><br>";
            //print_r($def_ext);
         if((in_array($type,$names_exact) || (isset($relative_search) && $relative_search== true)) && (isset($def) && (count($def_ext)>1) )/*&& strtolower($searchword) == strtolower($word)*/){
             $found_exact = add_slash($$what);
             $type_exact= $type;
             $exact[] = "$type_exact=$found_exact";
             //echo $word." ".$type." ".$def_extra.'-'.count($def_ext)."<br>";
             $true = true;
         } else $true = false;
     }
     else $found =  implode(',',_define($slash, $merge));
         if(isset($found) && isset($relevancy[$found])) $rel = $relevancy[$found]; else $rel = 1;
         if($what =='idVERTALING' ) $arr[$rel][$type][] = "'".$$what."'";
         else $arr[$rel][$type][] = $found;
         $rel_count[] = $rel;
    }
    $arr= array_unique($arr);
    if(isset($exact)) $exact= array_unique($exact);
    //print_r($exact);
    return $arr;
}
 //---------------------------------------SQL Search
/**
 *
 * @global string $m
 * @global string $i
 * @param type $what
 * @param type $name
 * @param type $del
 */
function make_searchQuery($what, $name, $del){
    global $langueges;
    $m = 'merge'.$name;
    $i = 'implode'.$name;
    $iB = 'implodeB'.$name;
    global $$m,$$i,$$iB;
    $merge = (array_unique(array_merge(explode(' ',trim($what)))));
    $merge = str_replace(($del),'',$merge);
    if(isset($langueges) && count($langueges)>0){
        foreach($langueges as $languege){
            $j =0;
            $c_mrg =  count($merge);
            $prc_search='';
            foreach($merge  as $what){
                if(trim($what)!='' && !is_numeric($what)){
                if($j>0) $prc = '%'; else $prc='';
                if($c_mrg==1) $prc_search="$prc";
                else {
                    if($what>2 && $j>=1) $prc_search="$prc";
                }
                $prc_search.="$what%";
                $if_seacrh[] = " LOWER($languege) LIKE \"$prc_search\" ";
                $j++;
                }
            }
        }
       if(isset($if_seacrh) && sizeof($if_seacrh)>0) $implode = implode(' OR ',$if_seacrh);
    }
    if(sizeof($merge)>0) $implode_arr = implode("%','%",$merge);
    $$m =  array_filter(array_unique($merge));
    if(isset($implode)) $$i = " OR ".$implode;
    if(isset($$iB)) $$i = " OR ".$implode_arr;
}
/**
 *
 * @global type $arr
 * @global type $search_array
 * @global type $search
 * @global type $order
 * @global type $rel_count
 * @global string $i
 * @param type $arr
 */
function make_rankingQuery($arr){
    global $arr,$search_array,$search,$order,$rel_count,$i, $locations, $search_query, $rank_loc_total, $where_defined;
    $tbl='tblVERTALING';
    $id = 'idVERTALING';
    $what  = $id;
    $rank_loc_total =Array();
    $location_array = array('field#provincienaamSLEUTEL','field#location','field#location0','LOWER(TRIM(nl))','locatieNAAM','provincienaamSLEUTEL','packlandID'/*,'locatiePOSTCODE'*/);
    krsort(($arr));
    foreach($search_array as $field=>$value){
        $field_x=$field;
        if(isset($value) && trim($value)!='' && trim($field)!='') {
            $i++;
            $x = explode('#',$field);
            $value = trim($value);
            if(isset($x[1]) && $x[1]!='') $fname = $x[1]; else $fname = $field;
            if(isset($locations) && (in_array($field_x,$location_array)) && sizeof($locations)>0) {
                $value.= '","'.implode('","',array_unique(array_filter($locations)));
                $rank_loc_total[]="rank$i";//NEW TBT 21/10/15
            }
            if( in_array(substr($fname,0,5),array('landn')) ||  in_array(substr($field,0,8),array('locatieN','landnaam'))) $rank_loc_total[]="rank$i";//NEW TBT 21/10/15
            if(isset($fname) && $fname!='') {
            if(isset($x[1])) {
                if( !in_array($field_x,$location_array)) $field = "(SELECT LOWER($what) FROM `$tbl` WHERE $id =LOWER(TRIM(".$fname."))) ";
                else   $field =$x[1];
            }
                if(count($rel_count)>0){
                    for($nrs=max(array_unique($rel_count));$nrs>=0;$nrs--){
                        if(isset($arr[$nrs][$fname])) {
                           $arr[$nrs][$fname][] = '"'.$value.'"';
                           $arr[$nrs][$fname] = array_unique($arr[$nrs][$fname]);
                           $arr[$nrs][$fname] = array_filter($arr[$nrs][$fname]);
                           $values  = implode(",",$arr[$nrs][$fname]);
                           $search[]= " IF(($field) IN ($values)  ,1,0) AS rank$i ";
                           $order[] = "rank$i";
                           if(!in_array($field_x,$location_array)) $where_defined[] = " ($fname IN ($values)) ";
                          $i++;
                        }
                    }
                }
                if(!isset($x[1]) && $field_x!= 'LOWER(TRIM(nl))' && !in_array(substr($field_x,0,8),array('locatieP','landnaam','packland'))) {
                    $where_defined[] = " ( LOWER ($field_x) IN (\"".$value."\") ) ";
                    $order[] = "rank$i";
                }
                $search[]= " IF (LOWER($field) IN (\"".$value."\"),1,0) AS rank$i";
            }
        }
    } //print_r($where_defined);
}
/**
 *
 * @global type $postcode_search
 * @global type $search
 * @global type $search_exact
 * @global type $type_exact
 * @global type $merge
 * @global type $merge2
 * @global type $find_in
 * @global type $order
 * @global type $update
 * @global type $frase
 * @param type $search
 * @param type $order
 * @param type $found_exact
 * @param type $default
 * @param type $postcode
 */
function finalize($search,$order,$found_exact,$default,$postcode){
    global $postcode_search,$search,$search_exact,$type_exact,$merge, $merge2,$find_in,$order, $having,$update, $frase, $loc, $locations,$exact, $rank_loc_total,$res_total;
    $merge=array_unique(array_filter($merge));
    if(!is_null($merge2))$merge2= array_unique(array_filter($merge2));
    $rank_loc_total[]= 'rank_loc';
    $res_total=  array_diff($order, $rank_loc_total);//NEW TBT 21/10/15
    if(count(array_filter($merge))>0) $rel = 1; else $rel = 0;
    $order = implode('+',$order);
    $res_total = implode('+',$res_total);
    if($res_total == '') $res_total = 'rank_loc';
    if(isset($search_exact) && $search_exact!='') $ss = 1; else $ss = 0;
    if(/*$searchDB==false  &&*/ $update==false  && $search_exact=='')$rel = '0'; else $rel = '1';
    if(isset($order) && $order!='') {
        $having = " HAVING ( (".implode('+',$rank_loc_total).")>=1 AND (".$res_total.")>='".($rel+$ss)."' )";
        $order ="  CAST((".$order.") AS SIGNED INTEGER) DESC, CAST(rank_loc AS  SIGNED INTEGER) DESC ";//, CAST(rank0 AS  SIGNED INTEGER) DESC
    }
    else {
        $order = ' CAST(rank_loc AS  SIGNED INTEGER) DESC ';//,CAST(rank0 AS  SIGNED INTEGER) DESC
        $having=' HAVING rank_loc>=1 ';
    }
    if(isset($search) && $search!='') $search = implode(',',$search); else $search = $default;//means-whatever
    $postcode_search = '';
    if(isset($exact) && sizeof($exact)>0)$search_exact =  "AND (".implode(" OR ",$exact).") "; else $search_exact = '';
    $find_in = '';

    if(strpos($loc, 'belgi')!== false)  {}
    else {
        if(isset($merge2) &&  sizeof($locations)>0 ) $find_in.= " IN (\"".implode("\",\"",$locations)."\")";
    }
    if(isset($_GET['id']) && $_GET['id']!='') $search_exact.=" AND `tblKLANT`.`idKLANT`='".$_GET['id']."' ";
}
//---------------------------------------------------------------SQL UPDATE/ADD
/**
 *
 * @param type $table_name
 * @param type $keys_array
 * @param type $key_name
 */
function simple_add_mysql($table_name, $keys_array, $key_name){
    $u = '';
    foreach($keys_array as $name_up=>$value_up)  $u.=" `$name_up`=\"$value_up\",";
    if(count($keys_array)>0) $q =  "INSERT INTO $table_name SET ".substr($u,0,-1)." ON DUPLICATE KEY UPDATE $key_name=$key_name";
    if(isset($q)) run_query($q);

}
/**
 *
 * @global type $_POST
 * @param type $table_name
 * @param type $field_names_array
 * @param type $fields_values_array
 * @param type $field_name_val
 * @param type $where
 */
function simple_update_mysql($table_name,$field_names_array, $fields_values_array, $field_name_val, $where){
   global $_POST;
   if(isset($_POST['update'])) {
        $u = '';
        if($field_name_val =='') $fields_values_array = array_combine($field_names_array,$fields_values_array);
        else $fields_values_array = $field_name_val;
        foreach($fields_values_array as $name_up=>$value_up)  $u.=" `$name_up`=\"$value_up\",";
        if(count($fields_values_array)>0) $q =  "UPDATE $table_name SET ".substr($u,0,-1)." $where";
        if(isset($q)) run_query($q); //echo $q."<br>";
   }
}
//---------------------------------------------------------------Price /hour(hours in period)+keyword(s)
/**
 *
 * @global type $hours
 * @global type $days
 * @global type $price
 * @param type $keywords
 * @param type $price_per_keyword
 * @param type $price_per_hour
 * @param type $price_per_click
 * @param type $date_s
 * @param type $date_e
 * @param string $hours_day
 * @param type $clicks_count
 * @return type
 */
   function get_price($keywords, $price_per_keyword, $price_per_hour, $price_per_click, $date_s,$date_e, $hours_day, $clicks_count){
        global $hours, $days, $price;
        $hours = $days = $price = 0;
        if($hours_day=='00:00:00') $hours_day = '24:00:00';
        $date1 = new DateTime($date_s);
        $date2 = new DateTime($date_e);
        $interval_d = $date1->diff($date2);
        if($date_e!='0000-00-00') $days = $interval_d->days+1;
        $t = explode(':',$hours_day);
        $hours = ($t[0]*60+$t[1])/60;
        $price = ($days*$hours*$price_per_hour)+($price_per_keyword*$keywords)+($price_per_click*$clicks_count);
        return $price;
    }
//---------------------------------------------------------------Banners dispaly
  /**
   *
   * @global type $URL
   * @global type $URL_LIFE
   * @global type $id_BUYER
   * @global string $banners
   * @global type $id_OTHER
   * @global type $idBUYER_REL
   * @global type $web
   * @param type $banner_images
   * @return string
   */
  function get_banner_url($banner_images){
    global $URL, $URL_LIFE, $id_BUYER, $banners, $id_OTHER, $idBUYER_REL, $web;
    if(count($idBUYER_REL) <= 0) shuffle($banner_images);
        foreach($banner_images as $filename){
          $idBUYER_banner = explode("_", str_replace($URL_LIFE,'',$filename));
          $id_BANNER = remove_tags($idBUYER_banner[0]);
          $id_BANNER = trim(preg_replace(array('!\s+!', "/[\D]/"), '', $id_BANNER));
          if(is_numeric($id_BANNER) && in_array($id_BANNER,(array_merge($id_BUYER,$id_OTHER,$idBUYER_REL))))
             $banners[$id_BANNER][] = $web.str_replace('/public_html/','',$filename);
        }
    return $banners;
  }
  /**
   *
   * @global type $nr_banners
   * @global int $co
   * @global type $idBUYER
   * @global type $idBUYER_REL
   * @global type $referral
   * @global type $update
   * @param type $order
   * @param type $banners
   * @param type $id_X
   * @param type $web
   * @param type $dir
   */
  function display_banner($order, $banners, $id_X, $BANNER_URLS, $web, $dir){
    global $nr_banners, $co, $idBUYER, $idBUYER_REL, $referral, $update, $klantNR, $test_serv, $server_name;
    if($order == 'A') $col = 'red'; else $col = '';
    foreach($id_X as $idBUYER){
        $display = false;
        if(is_array($idBUYER)) $idBUYER_REL = array_merge($idBUYER,$idBUYER_REL);
        if($order != 'C' && in_array($idBUYER, $id_X)) $display = true;
        if($order == 'C' &&( !in_array($idBUYER,$idBUYER_REL)) &&  in_array($idBUYER, $id_X) && is_array($idBUYER_REL) && is_array($id_X)) $display = true;
        if(isset($banners[$idBUYER])){
            foreach($banners[$idBUYER] as $filename){
               //-------------------------problem fix for files located on different server
                if(in_array($server_name,array($test_serv,'localhost','localhost:1234'))){
                    $filename = str_replace(($web.'..'),'..',$filename);
                    $filename = str_replace(($web.'//'),'',$filename);
                }
                else $filename = str_replace(array('/../'),'',$filename);
                $checkurl = (str_replace(array('http://','..'), "", array_unique($BANNER_URLS[$idBUYER])));
                $checkurl = (str_replace($test_serv, "",$checkurl));

                $checkfile = (str_replace(array('http://','..'), "",$filename));
                $checkfile = (str_replace($test_serv, "",$checkfile));
                if(array_search($checkfile, $checkurl)>'-1' ) $found  =true; else $found=false;
                if($display == true && (($co<$nr_banners && $update == false && $found == true ) || ($update == true /*&& $co<=20*/))) {
                    $encoded = base64_encode("$idBUYER/$dir#$filename#$idBUYER");//"$web/$idBUYER/$dir#$filename#$idBUYER"
                    if($update == true) $dis = "class='not-active'"; else $dis = '';
                    $d = 2;//twice smaller// 60x55 60x110 60x165
                    $w=340/$d;$h=312/$d;
                    $mx = $h*3;
                    $banner_url = "<a href='?ref=$encoded' rel='$referral' $dis target='_blank' class='' style='z-index: 3;'>
                    <img src='$filename' class='form-control image' style='width:$w"."px;min-height:$h"."px;max-height:$mx"."px'/></a>";
                    $banner = $banner_url;//"<div class='banner-b'><div class='orbit-wrapper'><div class='b orbit'>$banner_url</div></div></div>";
                        if($update == true) {
                            echo script('cont'.$co, 'resizable', '');
                            echo "<div id='cont$co' class='ui-widget-content banners'>$banner_url";
                            add_banner_to_db($idBUYER,$filename,$co);
                            echo "</div>";
                        } else  echo $banner;
                   $co++;
                }
            }
        }
        //else  echo "<b style='color:$col'>$order: $idBUYER</b><br/>";//the results without banners
    }
  }
  //------------------------------------------DB MYSQL, ADD/UPDATE
  /**
   *
   * @global type $connect
   * @global type $update
   * @global type $_POST
   * @global type $hours
   * @global type $price
   * @global type $days
   * @global string $dont_edit
   * @global type $PRICE_PER_CLICK
   * @global type $PRICE_PER_HOUR
   * @global type $PRICE_PER_KEYWORD
   * @param type $idBUYER
   * @param type $banner_url
   * @param type $co
   */
  function add_banner_to_db($idBUYER,$banner_url,$co){
      global $connect, $update, $_POST, $hours, $price, $days, $dont_edit, $PRICE_PER_CLICK, $PRICE_PER_HOUR, $PRICE_PER_KEYWORD;
      if($update == true){
        $fields = Array();
        $fields_up = Array();
        $nr = $co;
        $tbl = 'tblBANNER';
        $id = 'idKLANT';
        $dont_edit = array('CLICKS_COUNT','idBANNER','idKLANT');
        $fieldnames = array('idKLANT','idBANNER','CONTRACT_START','CONTRACT_END','STARTING_HOUR','HOURS_PER_DAY','MAX_CLICKS','BANNER_KEYWORDS','CLICKS_COUNT');
        $where = " WHERE $id = '$idBUYER' AND BANNER_URL='$banner_url'";
        simple_add_mysql($tbl, array($id => $idBUYER , 'BANNER_URL'=>$banner_url), $id);
        $res = run_query("SELECT * FROM $tbl $where LIMIT 1");
        while ($row = mysqli_fetch_object($res)) foreach($fieldnames as $fieldname)  $$fieldname = $fields[] = $row->$fieldname;
        $e = explode('_',$banner_url);
        $lang = $e[1];
        //---------price
        $KEYWORDS_COUNT = count(array_filter(explode(';',$BANNER_KEYWORDS)));
        get_price($KEYWORDS_COUNT,$PRICE_PER_KEYWORD, $PRICE_PER_HOUR, $PRICE_PER_CLICK, $CONTRACT_START, $CONTRACT_END,$HOURS_PER_DAY,$CLICKS_COUNT);
        echo show_detail_title($KEYWORDS_COUNT,$CLICKS_COUNT,$HOURS_PER_DAY, $lang);
        if(isset($fields)) $fields = array_combine($fieldnames, $fields);
        //---------fields banner
        TAGS_AUTOSUGGEST($idBUYER,'KEYWORD','BANNER_KEYWORDS');
        get_contract_info($idBUYER, $nr);
        $fields_up = makeInputField('this.select()',$fields, 'text','',$nr.'_'.$idBUYER,'');
        //---------fields rubric+location
        add_rubric_to_db($idBUYER, $idBANNER, $co);
        add_location_to_db($idBUYER, $idBANNER, $co);
        simple_update_mysql($tbl,$fieldnames,$fields_up,'', $where);
      }
  }

 /**
  *
  * @global type $connect
  * @global type $update
  * @global type $_POST
  * @global type $PRICE_PER_CLICK
  * @global type $PRICE_PER_HOUR
  * @global type $PRICE_PER_KEYWORD
  * @param type $idBP
  * @param type $co
  */
  function add_price_to_db($idBP, $co){
      global $connect, $update, $_POST, $PRICE_PER_CLICK, $PRICE_PER_HOUR, $PRICE_PER_KEYWORD, $idBUYER;
      if($update == true){
        $fields = Array();
        $fields_up = Array();
        $nr = $co;
        $id = 'idBP';
        $tbl = 'tblBANNER_PRICES';
        $fieldnames = array('PRICE_PER_CLICK','PRICE_PER_HOUR','PRICE_PER_KEYWORD');
        $where = " WHERE $id = '".$$id."' ";
        simple_add_mysql($tbl, array('idBP' => $idBP), 'idBP');
        $res = run_query("SELECT * FROM $tbl $where LIMIT 1");
        while ($row = mysqli_fetch_object($res)) foreach($fieldnames as $fieldname)  $$fieldname = $fields[] = $row->$fieldname;
        if(isset($fields)) $fields = array_combine($fieldnames, $fields);
        $fields_up = makeInputField('this.select()',$fields, 'text','',$nr.'_'.$idBP,'','');
        simple_update_mysql($tbl,$fieldnames,$fields_up,'', $where);
      }
  }
  //------------------------------------------DB MYSQL, ADD/UPDATE RUBRIC & LOCATION
  /**
   *
   * @global type $connect
   * @global string $update
   * @global type $_POST
   * @global type $tags_RUBRIC
   * @param type $idBUYER
   * @param type $idbanner
   * @param type $co
   */
  function add_rubric_to_db($idBUYER, $idbanner, $co){
      global $connect, $update, $_POST;
        $nr = $co;
        $fields_up = Array();
        $count = $nr.'_'.$idbanner;
        $fieldnames = array('RUBRIC');
        $res = RUBRIC_QUERY($idbanner);
        while ($row = mysqli_fetch_object($res)) foreach($fieldnames as $fieldname)  $$fieldname = $fields[] = $row->$fieldname;
        if(!isset($fields))$fields = Array('');
        $fields = Array(implode(";",$fields));
        if(isset($fields)) $fields = array_combine($fieldnames, $fields);
        TAGS_AUTOSUGGEST($idBUYER, 'GROUP', 'RUBRIC');
        $fields_up = makeInputField('this.select()',$fields, 'text','', $count,'');
        if(isset($_POST['update'])) {
            $update = '"'.implode('","',explode(';',@$_POST['RUBRIC'.$count])).'"';
            $fields = Array();
            $fieldnames = array('idBANNER','idRUBRIEK');
            $res = TRANSLATION_QUERY($idbanner, $update);
                while ($row = mysqli_fetch_object($res)) {
                    foreach($fieldnames as $fieldname) $fields[$fieldname] = $row->$fieldname;
                    simple_add_mysql('tblBANNER_RUB', $fields, 'idBANNER_RUB');
                }
            }
  }
/**
 *
 * @global type $connect
 * @global string $update
 * @global type $_POST
 * @global type $tags_LOCATION
 * @param type $idBUYER
 * @param type $idbanner
 * @param type $co
 */
  function add_location_to_db($idBUYER, $idbanner, $co){
      global $connect, $update, $_POST;
        $nr = $co;
        $fields_up = Array();
        $count = $nr.'_'.$idbanner;
        $fieldnames = array('LOCATION');
        $res = LOCATION_QUERY_1($idbanner);
        while ($row = mysqli_fetch_object($res)) foreach($fieldnames as $fieldname)  $$fieldname = $fields[] = $row->$fieldname;
        if(!isset($fields))$fields = Array('');
        $fields = Array(implode(";",$fields));
        if(isset($fields)) $fields = array_combine($fieldnames, $fields);
        TAGS_AUTOSUGGEST($idBUYER, 'LOCATION', 'LOCATION');
        $fields_up = makeInputField('this.select()',$fields, 'text','',$count,'');
        if(isset($_POST['update'])) {
            $update = '"'.implode('","',explode(';',@$_POST['LOCATION'.$count])).'"';
            $fields = Array();
            $fieldnames = array('idBANNER','idLOCATION');
            $res = LOCATION_QUERY_3($idbanner,$update);
                while ($row = mysqli_fetch_object($res)) {
                    foreach($fieldnames as $fieldname) $fields[$fieldname] = $row->$fieldname;
                    simple_add_mysql('tblBANNER_LOC', $fields, 'idBANNER_LOC');
                }
        }
  }
/**
 *
 * @global type $connect
 */
function clicks_count(){
    global $connect,$domain;
    if(isset($_GET['ref'])){
        $decode =  base64_decode($_GET['ref']);
        $explode = explode('#',$decode);
        if(isset($explode[1])) run_query("UPDATE tblBANNER SET CLICKS_COUNT=CLICKS_COUNT+1 WHERE BANNER_URL='$explode[1]' AND idKLANT='$explode[2]' LIMIT 1");
         header("Location:http://".$domain.'/'.$explode[0]);
        
    }
}
/**
 *
 * @global type $SESSION_location
 * @global type $SESSION_search
 * @param type $country
 */
function getSearchParams($country){
    global $SESSION_location, $SESSION_search;
    if(isset($_GET['location'])) $SESSION_location = $_GET['location']; else $SESSION_location = '';
    if(isset($_GET['search']))  $SESSION_search = $_GET['search']; else $SESSION_search = '';
    if(trim($SESSION_location)==''/* || is_numeric(trim($SESSION_location))*/) $_GET['location']=$SESSION_location = trim($SESSION_location.' '.$country);
}
/**
 *
 * @param type $idBUYER
 * @param type $query_name
 * @param type $tagname
 * @return type
 */
function TAGS_AUTOSUGGEST($idBUYER, $query_name, $tagname){
    $q = $query_name.'_QUERY';
    $t  = 'tags_'.$tagname;
    global $$t;
    $tags = Array();
    $res = $q($idBUYER);
    while ($row = mysqli_fetch_object($res)) $tags[] = $row->$tagname;
    $$t = mysql_tags($tags);
    return $$t;
}
?>