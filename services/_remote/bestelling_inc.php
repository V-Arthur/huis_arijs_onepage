<?php
/**
 * the original file is authomatically copied and updated from o-sn.be (185.56.144.103),upload@o-sn.be
 * included in all one-page sites at OSN and subdomains, OSN "search","more info" pages, etc..
 * Contact & order klant detail/one-page
 *
 * @param type $type
 * @param type $title
 * @param type $name
 * @param type $width
 * @return type
 */
if(isset($_SERVER['REQUEST_SCHEME'])) $scheme = $_SERVER['REQUEST_SCHEME']; else $scheme='';//------ !important for server that uses real HTTPS for included files (like one page websites)
if($scheme=='') $scheme ='http';
function create_simple_input($type,$title,$name,$width){
   return "<label style='display:inline !important;'>$title</label><br/><input type='$type' name='$name' id='name' style='width:$width".";display:inline !important;'>";
}
$bestelling_algemeen = array('Gourmet','Fondue','Steengrill','Kaasschotel','Raclette','Buffet');//default bestelling

$q =  "SELECT contactformulier,type_contactformulier, bestelling_data,activate, tblKLANT.idKLANT FROM tblKLANT LEFT JOIN `tblBESTELLING_TYPES` ON `tblBESTELLING_TYPES`.`idKLANT` =tblKLANT.`idKLANT`
 WHERE tblKLANT.idKLANT = '$klantid' AND tblKLANT.`contactformulier` !='standaard' ";
$form_query_best = mysqli_query($con, $q) or die("error query:".$q);

$exp =array();//---personal besteling for the klant (not all tranlated yet, can be added as list with enter tabs or after the comma):
while($form_b = mysqli_fetch_object($form_query_best)){
    if(trim($form_b->contactformulier)==trim($form_b->type_contactformulier) && $form_b->activate=='1'){
        $data = $form_b->bestelling_data;

        $exp_part = explode("\r\n",$data);
        if(count($exp_part)==0) $exp_part = explode("\n",$data);
        if(count($exp_part)==0) $exp_part = explode(",",$data);
        $exp = array_merge($exp,$exp_part);
    }
}
if(count($exp)==0 && mysqli_num_rows($form_query_best)>0) $exp= $bestelling_algemeen;//default bestelling (array on top)
if($taal =='') $taal ='nl';
if(isset($email[0])) $mail=$email[0]; else $mail=$email;
//-------------------------Contact
if($mail != ""){
?>
    <a href="#" data-reveal-id="myModal">
    <div class="large-11 medium-11 small-11 large-offset-1 medium-offset-1 small-offset-1 columns nopadding contact_btn">
        <div class="large-3 medium-3 small-3 columns nopadding contact_btn_icon">
            <img src="<?php echo  "$scheme://".$_SERVER["HTTP_HOST"]?>/images/mail-icon.png" />
        </div>
        <div class="large-9 medium-9 small-9 columns nopadding contact_btn_text">e-mail</div>
    </div>
    </a>
<?php }?>
<div id="myModal" class="reveal-modal tiny" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog"  style='min-width: 630px;'>
<form id="myForm" action="" method="post" data-abide>
<h5 class="text-center"><strong><?php echo $Contacteer_Ons." "?></strong></h5>
<label><?php echo $Uw_e_mailadres?>*</label>
<small class="error"><?php echo $Dit_is_een_verplicht_veld?></small>
<input type="email" name="email" id="email" >
<?php
    echo create_simple_input('text',$Telefoon,'telefoon','');
    echo "<table><tr><td style='padding-right: 25px;'>";
    echo create_simple_input('text',$Naam,'name','252px');
    echo "</td><td colspan='2' style='padding-right: 25px;'>";
    echo create_simple_input('text',$Voornaam,'fistname','100%');
    echo "</td></tr><tr><td style='padding-right: 25px;'>";
    echo create_simple_input('text',$Straat,'street','252px');
    echo "</td><td style='padding-right: 25px;'>";
    echo create_simple_input('text',$Postcode,'postcode','67px');
    echo "</td><td style='padding-right: 25px;'>";
    echo create_simple_input('text',$Plaats,'city','100%');
    echo "</td></tr></table>";
?>
<label><?php echo $Onderwerp?></label>
<input type="text" name="onderwerp" id="onderwerp">
<label><?php echo $Uw_vraag_of_opmerkingen?>*</label>
<small class="error"><?php echo $Dit_is_een_verplicht_veld?></small>
<textarea rows="4" name="vraag" id="vraag" ></textarea>
<input type="text" value='' name="contactid" id="contactid" style='display:none'/>
<input type="checkbox" id="checkbox-1-1" name="checkbox-1-1" value="kopie" class="regular-checkbox" checked />
<label id="checkboxtxt" for="checkbox-1-1"><?php echo $Stuur_mij_een_kopie_van_dit_bericht?></label>
<input type="submit" class="button emailbtn" value="<?php echo $Verstuur?>">
<img class="loader" src="<?php echo  "$scheme://".$_SERVER["HTTP_HOST"]?>/images/ajax-loader.gif" />
<a class="close-reveal-modal" aria-label="Close">&#215;</a>
</form>
</div>

<?php
//---------------------------end Contact -> Bestelling:
if($mail != "" && count($exp)>0){
?>
<a href="#" data-reveal-id="myModalBestelling">
<div class="large-11 medium-11 small-11 large-offset-1 medium-offset-1 small-offset-1 columns nopadding contact_btn">
<div class="large-3 medium-3 small-3 columns nopadding contact_btn_icon">
<img src="<?php echo  "$scheme://".$_SERVER["HTTP_HOST"]?>/images/bestelling-icon.png" />
</div>
<div class="large-9 medium-9 small-9 columns nopadding contact_btn_text">
<?php echo $bestelling;?>
</div>
</div>
</a>
<!------------------- bestelformulier --------------------!-->
<div id="myModalBestelling" class="reveal-modal tiny" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog"  style='min-width: 630px;'>
<form id="myFormBestelling" action="" method="post" data-abide>
    <h5 class="text-center"><strong><?php echo ucfirst($bestelling); ?></strong></h5>
    <label><?php echo $Uw_e_mailadres?>*</label><small class="error"><?php echo $Dit_is_een_verplicht_veld?></small>
    <input type="email" name="email" id="emailB" >
    <label><?php echo $Telefoon?>*</label><small class="error"><?php echo $Dit_is_een_verplicht_veld?></small>
    <input type="text" name="telefoon" id="telefoonB" >
    <?php
    echo "<table><tr><td style='padding-right: 25px;'>";
    echo create_simple_input('text',$Naam,'name','252px');
    echo "</td><td colspan='2' style='padding-right: 25px;'>";
    echo create_simple_input('text',$Voornaam,'fistname','100%');
    echo "</td></tr><tr><td style='padding-right: 25px;'>";
    echo create_simple_input('text',$Straat,'street','252px');
    echo "</td><td style='padding-right: 25px;'>";
    echo create_simple_input('text',$Postcode,'postcode','67px');
    echo "</td><td style='padding-right: 25px;'>";
    echo create_simple_input('text',$Plaats,'city','100%');
    echo "</td></tr></table>";
    echo create_simple_input('text',$Onderwerp,'onderwerp','');
    ?>
    <div class="large-6 columns nopaddingleft" style='width:100%'>
    <label><?php echo ucfirst($bestelling); ?>*</label>
    <small class="error"><?php echo $Dit_is_een_verplicht_veld?></small>
    <select name="bestelling[]" id="bestellingB" class='select2 anderedd geselecteerde  bestellingB' multiple='multiple' style='width:100%'>
    <option value=""></option>
    <?php
        if(count($exp)>0){
            $exp = array_unique($exp);
            foreach($exp as $val){
                if(isset($$val) && $$val!='') $transl = trim($$val); else $transl = trim($val);
                echo "<option value=\"".trim($val)."\">$transl</option>";
            }
        }
    ?>
    </select>
    </div>
    <div class="large-6 columns" style='width: 150px;'><label><?php echo $Datum_afhaling?></label>
    <input type="text" name="afhaling" class="span2" value="" id="afhaling">
    </div>
    <div class="large-6 columns nopaddingleft" style='width: 170px;'><label><?php echo $Aantal_volwassenen?>
    <select name="volwassenen" id="volwassenen"><?php for($x = 0; $x <= 50; $x++) echo "<option value='$x'>$x</option>"; ?></select>
    </label>
    </div>
    <div class="large-6 columns nopaddingright" style='width: 170px;'><label><?php echo $Aantal_kinderen?>
    <select name="kinderen" id="kinderen"><?php for($x = 0; $x <= 50; $x++) echo "<option value='$x'>$x</option>"; ?></select>
    </label>
    </div>
    <div class="large-6 columns nopaddingright" style='width:100%'><label><?php echo $Andere_wensenopmerkingen?></label>
    <textarea rows="4" name="vraag" id="vraagB"></textarea>

    <input type="checkbox" id="checkbox-1-1" name="checkbox-1-1" value="kopie" class="regular-checkbox" checked />
    <label id="checkboxtxt" for="checkbox-1-1"><?php echo $Stuur_mij_een_kopie_van_dit_bericht?></label>
     </div>
    <input type="submit" class="button emailbtn" value="<?php echo $Bestellen?>">
    <img class="loader" src="<?php echo  "$scheme://".$_SERVER["HTTP_HOST"]?>/images/ajax-loader.gif" />
    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</form>
</div>
<div id="myModalBevestiging" class="reveal-modal tiny" data-reveal aria-labelledby="modalTitle" aria-hidden="true" role="dialog">
    <p><?php echo $Bedankt_voor_uw_bestelling_u_ontvangt_spoedig_een_bevestiging?></p>
    <a class="close-reveal-modal" aria-label="Close">&#215;</a>
</div>
<?php
}
?>
<script src = "<?php echo  "$scheme://".$_SERVER["HTTP_HOST"]?>/services/js/select2.js"></script>
<link rel="stylesheet" type="text/css" href = "<?php echo  "$scheme://".$_SERVER["HTTP_HOST"]?>/services/css/select2.css">
<script type='text/javascript'>
    $('.geselecteerde').select2();
$(function(){

    var d = new Date();
    d.setDate(d.getDate()-1)
    $('#afhaling').fdatepicker({
        format: 'dd-mm-yyyy',
        language: '<?php echo $taal?>',
        startDate: d,
        disableDblClickSelection: true
    });

    $("#myForm").submit(function() {
        if($("#email").val()=='' ||  $("#vraag").val()=='') $('.error').css({backgroundColor:"rgb(240, 65, 36)", display: 'block' })
        else {
        $.ajax({
            type:"POST",
            url:"<?php echo  "$scheme://".$_SERVER["HTTP_HOST"].dirname($_SERVER['PHP_SELF']).'/'.$back.$remote?>mail-klant.php",
            data:$("#myForm").serialize() + "&klantid=" + <?php echo $klantid; ?>,
            cache: false,
            success: function () {
                $('.error').css({backgroundColor:"#ffffff", display: 'none' })
                $(".emailbtn").css({backgroundColor:"#09bc03"});
                $(".emailbtn").val("<?php echo $E_mail_verzonden.'!';?>");
                $("#email").val("");
                $("#telefoon").val("");
                $("#onderwerp").val("");
                $("#vraag").val("");
                $(".loader").hide();
            },
        });
    }
        return false;

    });
    $("#myFormBestelling").submit(function() {
        if($("#emailB").val()=='' ||  $("#telefoonB").val()=='' ||  $(".bestellingB").val()==''){
            $('.error').css({backgroundColor:"rgb(240, 65, 36)", display: 'block' });
        }
        else {

            $.ajax({
                type:"POST",
                url:"<?php echo  "$scheme://".$_SERVER["HTTP_HOST"].dirname($_SERVER['PHP_SELF']).'/'.$back.$remote?>mail-klant.php",
                data:$("#myFormBestelling").serialize() + "&klantid=" + <?php echo $klantid; ?>,
                cache: false,
                success: function ()
                {
                    $('.error').css({backgroundColor:"#ffffff", display: 'none' })
                    $("#emailB").val("");
                    $("#telefoonB").val("");
                    $("#onderwerp").val("");
                    $("#vraagB").val("");
                    $("#bestellingB").val("");
                    $(".loader").hide();
                    $('#myModalBevestiging').foundation('reveal', 'open');
                },
            });
        }
        return false;
    });
});

function openEmail()
{
    $.ajax({
    type: "POST",
    url: "<?php echo  "$scheme://".$_SERVER["HTTP_HOST"]?>/getform.php",
    data: "klantid=" + <?php echo $klantid; ?>,
    cache: false,
    success: function(data)
    {
        if(data == "standaard")
        {
            $('#myModal').foundation('reveal', 'open');
            $("#contactid").val("");
        }
        if(data == "bestelformulier"){
            $('#myModalBestelling').foundation('reveal', 'open');
        }
    }
    });
}
function contactForm(contactid)
{
    $('#myModal').foundation('reveal', 'open');
    $("#contactid").val(contactid);
}
</script>