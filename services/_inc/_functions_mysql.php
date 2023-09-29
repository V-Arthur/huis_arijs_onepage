<?php
/**
 * Author: Evstratova-Bourgois Ekaterina Urievna
 * Contact webvisio@webvisiondesign.net
 */
//------------------------------------------------------------Mysql functions
/**
 * @param type $sourse
 * @param type $co
 */
function return_array($sourse,$co)
{
   $x=0;$arr=array(); $arr2=array();
   foreach ($sourse as $keyx => $valuex) {
   $x=$x+1;
   $arr2[$keyx]=$valuex;
       if($x==$co){
       $arr[$sourse->_id] =$arr2;
       }
   }
}
/**
* @global type $connect
* @param type $db
* @param type $table
* @param type $column
* @param type $type
* @param type $size
* @param type $default
*/
function add_columns($db, $table, $column, $type, $size, $default){
    global $connect;
    $query ="SELECT `COLUMN_NAME`
    FROM `INFORMATION_SCHEMA`.`COLUMNS`
    WHERE `TABLE_SCHEMA`='$db'
        AND `TABLE_NAME`= '$table'
        AND COLUMN_NAME ='$column'";
   if(mysqli_num_rows(mysqli_query($connect,$query))==0)
     mysqli_query($connect,"ALTER TABLE `$table` ADD $column $type($size) NOT NULL DEFAULT $default");
}
/**Ohter functions**/
/**
 * @param type $date
 * @return type
 */
function date_convert($date) {
    $dy = substr($date, 0, 4);
    $dm = substr($date, 5, 2);
    $dd = substr($date, 8, 2);
    if (is_numeric($dy)) {
        $date = date("d-m-Y", mktime(0, 0, 0, $dm, $dd, $dy));
    }
    return $date;
}
?>