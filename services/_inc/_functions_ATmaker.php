<?php
/**
 * Author: Evstratova-Bourgois Ekaterina Urievna
 * Contact webvisio@webvisiondesign.net
 */
    /**
     *
     * @global type $arr
     * @param type $q_total_res
     * @param type $q_selected_res
     * @param type $id_name
     * @param type $s_name
     * @param type $description
     * @param type $disp_id
     * @param type $m
     */
    function create_select_box_jquery($q_total_res,$q_selected_res,$id_name, $s_name , $description, $disp_id, $m){
     global $arr, $deselect;
     $array = array();
     $result = mysql_query("$q_total_res");
     $algeselecteerd = mysql_query("$q_selected_res");
     if($m ==true)  $multiple = "multiple='multiple'"; else $multiple = '';
     while ($row = mysql_fetch_assoc($algeselecteerd)) $array[] = $row[$id_name];
     $name = 'geselecteerde'.$s_name;
     if($multiple!='') $tag = '[]'; else $tag='';
     echo "<select name='$name"."$tag' class='select2 anderedd geselecteerde $name' id='$name' $multiple>";
     if($multiple=='') echo "<option value=''></option>";
     while ($row = mysql_fetch_array($result)) {
             $$id_name = $row[$id_name];
             if (in_array($$id_name, $array)) {
                 $selected = 'selected';
                 if($s_name=='KL') $arr[] =$$id_name;
             }
             else $selected = '';
             if($$id_name!= $row[$description] && $disp_id == true) $val =  $$id_name .'  '. $row[$description]; else $val  = $row[$description];

            if((isset($deselect) && $deselect == false) || (!isset($deselect)) ) echo "<option value='".$$id_name."' class='opt_".$$id_name."' $selected>$val</option>";
            if(isset($deselect) && $deselect == true) {
               if($selected=='') echo "<option value='".$$id_name."' class='opt_".$$id_name."' $selected>$val</option>";
            }
     }
     echo "</select>";
  }
    /*
    *
    * @param type $geselecteerde_id
    * @param type $filed_name
    * @param type $placeholder
    * @return type
    **/
    function create_input($geselecteerde_id, $filed_name, $class, $placeholder, $lang){
        global $type_input;
        if(!isset($type_input) || $type_input=='') $type_input = 'text';
        $q = "SELECT ".strtolower($lang)." AS $filed_name"."_"."$lang FROM tblVERTALING WHERE idVERTALING='$geselecteerde_id'  "; //echo $q."<br>";
        $r = mysql_query($q);
        $res = mysql_fetch_assoc($r);
        $var = $filed_name."_".$lang;
        if(mysql_num_rows($r)>0) $val =$res[$var]; else $val = $geselecteerde_id;
        $val = str_replace('"', "'", $val);
        if($lang == 'nl') $lang = '';
        return "<input class='form-control anderedd $class' type='$type_input' name='$filed_name"."$lang' value=\"".$val."\" id='$filed_name' placeholder='$placeholder'>";
    }
?>
<script type="text/javascript">
</script>