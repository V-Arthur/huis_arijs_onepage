<?php
/**
 * Author: Evstratova-Bourgois Ekaterina Urievna
 * Contact webvisio@webvisiondesign.net
 */
/**
        * @global type $connect
        * @global boolean $valid_address
        * @global string $idLOCATIE
        * @param type $postcode
        * @param type $locatienaam_NL_search
        */
       function query_location($postcode, $locatienaam_NL_search){
          global $connect, $valid_address, $idLOCATIE, $locatiePARENT;
          $locatienaam_NL_search = str_replace(Array('’'),Array("'"),$locatienaam_NL_search);
          $locatienaam_NL_search2 = str_replace(Array('-'),Array(' '),$locatienaam_NL_search);
          $query_locatie = "SELECT idLOCATIE,landID, locatiePARENT, provincieID  FROM `tblLOCATIE`
        JOIN  `tblVERTALING`  ON tblLOCATIE.locatieNAAM = `tblVERTALING`.`idVERTALING`
        JOIN `tblPROVINCIE` ON `tblPROVINCIE`.`idPROVINCIE`=tblLOCATIE.`provincieID`
        JOIN `tblLANDSDEEL` ON `tblLANDSDEEL`.`idLANDSDEEL`=tblPROVINCIE.`landsdeelID`
        WHERE locatiePOSTCODE ='$postcode' AND (
        LOWER(`tblVERTALING`.nl) = LOWER(\"$locatienaam_NL_search\")  OR LOWER(`tblVERTALING`.fr) = LOWER(\"$locatienaam_NL_search\") OR  LOWER(`tblVERTALING`.en) = LOWER(\"$locatienaam_NL_search\")
         OR
        LOWER(`tblVERTALING`.nl) = LOWER(\"$locatienaam_NL_search2\")  OR LOWER(`tblVERTALING`.fr) = LOWER(\"$locatienaam_NL_search2\") OR  LOWER(`tblVERTALING`.en) = LOWER(\"$locatienaam_NL_search2\") )";
        $idLOCATIE = '';
        $locatiePARENT =0;
        //echo $query_locatie."<br>";
        $query = run_query($query_locatie);
        while ($row = mysqli_fetch_object($query)) $idLOCATIE = $row->idLOCATIE;
        if(isset($idLOCATIE) && $idLOCATIE!='') $valid_address = true;
      }
      /**
       *
       * @global type $btwnr
       * @global type $connect
       * @return type
       */
    function find_idHOLDING(){
        global $btwnr, $connect;
        $query_holding = "SELECT idHOLDING,tblHOLDING.* FROM `tblHOLDING` JOIN `tblKLANT` ON `tblKLANT`.`klantNR` = tblHOLDING.`holbtwnr` WHERE holbtwnr = '$btwnr' and holbtwnr!='' LIMIT 1";
        $idHOLDING = ''; //echo $query_holding."<br>";
        $query = run_query($query_holding);
        while ($row = mysqli_fetch_object($query)) $idHOLDING = $row->idHOLDING;
        return $idHOLDING;
    }
    /**
     *
     * @global type $query_part
     * @param type $straatnl
     * @param type $straatfr
     * @param type $straaten
     * @return type
     */
    function find_street($straatnl, $straatfr, $straaten){
        global $query_part;
         $query_part= "TRIM(LOWER(nl)) = LOWER(\"$straatnl\")";
         if($straatfr !="") $query_part.= "OR TRIM(LOWER(fr)) = LOWER(\"$straatfr\")";
         if($straaten !="") $query_part.= "OR TRIM(LOWER(en)) = LOWER(\"$straaten\")";
         return $query_part;
    }
    /**
     * RETRUNS id of registration address from DB
     * @global type $vestiging
     * @global type $btwnr
     * @global type $connect
     * @global type $straatnl
     * @global type $straatfr
     * @global type $straaten
     * @global type $straatNR_controle
     * @global type $bus
     * @global string $idLOCATIE
     * @global boolean $double
     * @global type $TableName
     * @global type $_id
     * @return type
     */
    function find_registration_address_klaant_id(){
        global $vestigingdatum,$hoofdzetel_new, $nieuweklantid_subvest,$vestigingnr, $invoerder, $vestiging, $btwnr, $connect, $straatnl, $straatfr, $straaten, $straatNR_controle, $bus,$idLOCATIE, $double,/*$double_vest,*/ $TableName, $_id, $rows, $double_klantid, $nieuweklantid_hoofdvest, $UPDATE_DB;
        if($vestiging == 'FALSE' || $vestiging ==''){//TEST
            $query_check ="SELECT idKLANThoofdvest AS klant_hoofdvest FROM  `tblKLANT`
             JOIN `tblKLANT_VEST` ON `tblKLANT_VEST`.`idKLANThoofdvest` = `tblKLANT`.`idKLANT` WHERE klantNR = '$btwnr' LIMIT 1";
             //echo $query_check."<br>";
            $query = run_query($query_check);
            $rows = mysqli_num_rows($query);
        }
        //-------------------------------------------
        if($rows == 0){
           $query_part= find_street($straatnl, $straatfr, $straaten);
        //--------------------------------------
            $query_check ="SELECT `tblKLANT`.`idKLANT` AS klant_hoofdvest FROM `tblADRES`
            JOIN `tblVERTALING` ON  tblADRES.`straatnaamSLEUTEL`=tblVERTALING.idVERTALING
            JOIN `tblKLANT` ON `tblKLANT`.`idKLANT` = tblADRES.`klantID`
            WHERE klantNR = '$btwnr' AND CONCAT( REPLACE (straatNR, ' - ', '-'), '*', bus, '*', locatieID) =
            CONCAT('$straatNR_controle','*','$bus','*','$idLOCATIE') AND ( $query_part ) AND TRIM(LOWER(nl))!='' ";
            //echo $query_check."<br>"; //exit;
            $result = run_query($query_check);
            if(mysqli_num_rows($result)>0) {
                $double= true;
                while ($r = mysqli_fetch_object($result))
                    $double_klantid = $r->klant_hoofdvest;
                    if($vestiging =='TRUE')$nieuweklantid_hoofdvest = $double_klantid;
            } else
                $double_klantid = 0;
           
           //-----Maatsch.address thats being imported-  already exists, but not indicated in the database (only in case if the EXCEL list contains indicated Maatsch.zettel)
            $query_check.=" AND `tblKLANT`.`idKLANT` NOT IN (SELECT idKLANTsubvest FROM `tblKLANT_VEST` WHERE idKLANTsubvest=`tblKLANT`.`idKLANT`)";
            //echo $query_check."<br>";
            $query = run_query($query_check);
            $rows = mysqli_num_rows($query);
        }
         
        //if($rows > 0) {
        if($rows>0 && (!isset($vestiging) || $vestiging =='FALSE')){
             while ($row = mysqli_fetch_object($query)) $nieuweklantid_hoofdvest = $row->klant_hoofdvest;
             mysqli_query($connect,"UPDATE `$TableName` SET Imported =3 WHERE _id ='$_id' ;");
        }
        
        if($rows == 0){
        //-----In case if the hoofdvestiging for this BTW NUMBER already exists:
            $query_check = "SELECT `tblKLANT`.`idKLANT` AS klant_hoofdvest FROM  `tblKLANT` WHERE klantNR = '$btwnr'
            AND `tblKLANT`.`idKLANT`  IN (SELECT idKLANThoofdvest FROM `tblKLANT_VEST` WHERE idKLANThoofdvest=`tblKLANT`.`idKLANT` )
            ORDER BY `tblKLANT`.`idKLANT` ASC LIMIT 1";
            //echo $query_check."<br>";
            $query = run_query($query_check);
            while ($row = mysqli_fetch_object($query)) $nieuweklantid_hoofdvest = $row->klant_hoofdvest;
        }
        if(mysqli_num_rows($query) == 0){
        //-----In case if the hoofdvestiging for this BTW NUMBER does not yet exists, but the BTW NR. exists in the DB:
            $query_check = "SELECT `tblKLANT`.`idKLANT` AS klant_hoofdvest FROM  `tblKLANT` WHERE klantNR = '$btwnr'
            AND `tblKLANT`.`idKLANT` NOT IN (SELECT idKLANTsubvest FROM `tblKLANT_VEST` WHERE idKLANTsubvest=`tblKLANT`.`idKLANT` )
            ORDER BY `tblKLANT`.`idKLANT` ASC LIMIT 1";
            //echo $query_check."<br>";
            $query = run_query($query_check);
            while ($row = mysqli_fetch_object($query)) $nieuweklantid_hoofdvest = $row->klant_hoofdvest;
        }
       //NEW!!!!!! 5/10/15
        if($vestiging =='TRUE' && $nieuweklantid_hoofdvest!= 0){
               $nieuweklantid_subvest = $nieuweklantid_hoofdvest; 
               mysqli_query($connect,"UPDATE tblKLANT SET vestigingnr='$vestigingnr',hoofdzetel='2',online='true',vestigingdatum='$vestigingdatum' WHERE idKLANT='$nieuweklantid_subvest' ");//NEW KBO VESTIGING ON THE SAME ADDRESS BUT NOT THE SAME ROW
            if(isset($hoofdzetel_new) && ($hoofdzetel_new ==2 || $hoofdzetel_new ==1) && $nieuweklantid_subvest!=0 ){
                $values = Array('idKLANThoofdvest'=> $nieuweklantid_subvest, 'idKLANTsubvest'=> $nieuweklantid_subvest);
                $idKLANT_VEST_X= check_doubles_and_input('idKLANT_VEST', 'tblKLANT_VEST', $values, $connect, true, true);
                if($idKLANT_VEST_X>0)  mysqli_query($connect,"UPDATE `$TableName` SET Imported =1 WHERE  _id ='$_id'");//Imported correctly
            }
               
               
        }
        return $nieuweklantid_hoofdvest;
    }
    /**
     *
     * @global type $rows
     * @global type $nieuweklantid_hoofdvest
     * @global type $btwnr
     * @global type $connect
     * @global type $straatnl
     * @global type $straatfr
     * @global type $straaten
     * @global type $straatNR_controle
     * @global type $bus
     * @global string $idLOCATIE
     * @return type
     */
    function find_company_address_klant_id(){
        global $rows, $nieuweklantid_hoofdvest, $btwnr, $connect, $straatnl, $straatfr, $straaten, $straatNR_controle, $bus,$idLOCATIE;
         $query_part= find_street($straatnl, $straatfr, $straaten);
         $query_check ="SELECT `tblKLANT`.`idKLANT` AS klant_subvest FROM `tblADRES`
           JOIN `tblVERTALING` ON  tblADRES.`straatnaamSLEUTEL`=tblVERTALING.idVERTALING
           JOIN `tblKLANT` ON `tblKLANT`.`idKLANT` = tblADRES.`klantID`
           WHERE klantNR = '$btwnr' AND `tblKLANT`.`idKLANT` !='$nieuweklantid_hoofdvest'
           AND CONCAT( REPLACE (straatNR, ' - ', '-'), '*', bus, '*', locatieID) =
           CONCAT('$straatNR_controle','*','$bus','*','$idLOCATIE') AND ($query_part)  AND TRIM(LOWER(nl))!=''
           ORDER BY `tblKLANT`.`idKLANT` ASC";
         $query = run_query($query_check);
         $rows = mysqli_num_rows($query);
         //echo $query_check."<br>";
         return $query;
    }
?>