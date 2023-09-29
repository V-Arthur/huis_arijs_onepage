<?php
/**
 * the original file is authomatically copied and updated from o-sn.be (185.56.144.103),upload@o-sn.be
 * included in all one-page sites at OSN and subdomains, OSN "more info" page, etc..
 *
 */
    chdir ("../../");
    if(isset($_GET['path']) && $_GET['path']!='') $path = '../services/';
    else $path ='';
    if($path=='') $path ='services/';
    if(file_exists($path."_inc/_functions_basic.php")) include($path."_inc/_functions_basic.php"); else exit('not found');
    if(file_exists("connection.php")) include 'connection.php';else exit('not found');
    mysqli_query($con, "SET NAMES 'utf8'");
    function filter_time($from,$till){
        global $gesloten,$op_afspraak;
        $from = date("H:i", strtotime($from));
        $till = date("H:i", strtotime($till));
        if($from == "00:00" && $till == "00:00")  $time = $gesloten;
        elseif($from == "00:02") $time = $op_afspraak;
        else $time = $from."-".$till;
        return str_replace(array('-00:00','00:00-'),'',$time);
    }
    function show_time($Maandag,$maVMvan,$maVMtot,$maNMvan,$maNMtot){
        global $gesloten,$op_afspraak;
        echo "<tr><td class='td_dag'>$Maandag</td><td>".filter_time($maVMvan,$maVMtot)."</td><td>".filter_time($maNMvan,$maNMtot)."</td></tr>";
    }
    function cov_date($date){
        return date("d/m/y", strtotime($date));
    }
    //--------------------------------------------------
    $where =" LIMIT 1";
    $soort = $_GET['s'];
    $klantid =  $_GET['id'];
    if($soort!='undefined' && $soort!='') $where = " AND tblOPENINGSUREN.type='$soort' ";
    //--------------------------------------------------
    $q_part = "FROM tblOPENINGSUREN JOIN `tblVERTALING` ON `tblVERTALING`.`idVERTALING` = tblOPENINGSUREN.type WHERE klantID = '$klantid'";

    $q_t = "SELECT tblOPENINGSUREN.type, nl AS type_uren_chk, $taal AS type_uren $q_part  GROUP BY type_uren
    ORDER BY FIELD(type_uren, 'winkel', 'open/gesloten', 'werkplaats','bureel','kantoor','toonzaal','speciaal','na afspraak','vakantie vast','vakantie speciaal','feestdagen'), FIELD(parentopening,1,0)" ;
    $r = mysqli_query($con, "$q_t");
    $q = "SELECT tblOPENINGSUREN.*,(SELECT $taal FROM `tblVERTALING` WHERE idVERTALING =specialeopening) AS specialeopening_tr, nl AS type_uren_chk, $taal AS type_uren $q_part $where";
    $res = mysqli_query($con, "$q");//echo $q;
    $opts = array();$c=0;
    while($row1 = mysqli_fetch_object($r)) {
        $found_sp = find_in_string($row1->type_uren_chk, "speciaal");
        $found_v = find_in_string($row1->type_uren_chk, "vakantie");
        if($found_v!='')  $type_uren = $vakantieperiode; else $type_uren = $row1->type_uren;
        if(($c==0 && $soort=='') || ($soort==$row1->type)) $sel='selected';else $sel='';
        $opts[]= "<option value=\"$row1->type\" $sel>$type_uren</option>";
        $c++;
    }
?>
<?php if(mysqli_num_rows($res)>0){ ?>
<table class="openingsuren">
    <tr>
        <th><select id="openingsurendd" onchange="getOpeningsuren()"> <?php  foreach($opts as $opt) echo $opt;?></select></th>
        <th><?php echo $Voormiddag?></th><th><?php echo $Namiddag?></th>
    </tr>
    <?php
    $found_sp ='';$found_v='';
        while($row2 = mysqli_fetch_object($res)) {
            return_name($row2);
            $text='';
            $found_sp = find_in_string($row2->type_uren_chk, "speciaal");
            $found_v = find_in_string($row2->type_uren_chk, "vakantie");

            if($specialeopening_tr!='') $specialeopening = $specialeopening_tr; else $row2->specialeopening;
            if($type_uren=='24/7') $text.= "<p><b>".ucfirst($bereikbaar)." 24/7"."</b></p>";
            if($found_sp !='' || $specialeopening!='') $text.= "<p><b>".nl2br($specialeopening)."</b></p>";
            if($found_v !='') $text.=  "<p><b>$van ".cov_date($vakantievan)." $tot ".cov_date($vakantietot)."</b></p>";
            if($text!='') echo "<tr><td colspan='3'><br/> $text</td></tr>";
            if($type_uren!='24/7' && $found_sp=='' && $found_v=='' && $specialeopening==''){
                show_time($Maandag,$maVMvan,$maVMtot,$maNMvan,$maNMtot);
                show_time($Dinsdag,$diVMvan,$diVMtot,$diNMvan,$diNMtot);
                show_time($Woensdag,$woVMvan,$woVMtot,$woNMvan,$woNMtot);
                show_time($Donderdag,$doVMvan,$doVMtot,$doNMvan,$doNMtot);
                show_time($Vrijdag,$vrVMvan,$vrVMtot,$vrNMvan,$vrNMtot);
                show_time($Zaterdag,$zaVMvan,$zaVMtot,$zaNMvan,$zaNMtot);
                show_time($Zondag,$zoVMvan,$zoVMtot,$zoNMvan,$zoNMtot);
            }
       } 
   ?>
</table>
<?php } ?>