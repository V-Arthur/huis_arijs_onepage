<?php
/**
 * email/contact - bestelling at OSN & one pages
 * the original file is authomatically copied and updated from o-sn.be (185.56.144.103),upload@o-sn.be
 *  */
    session_start();
    header('Content-Type: text/html; charset=utf-8');
    include '../../connection.php';
    mysqli_query($con,"SET NAMES 'utf8'");
    require_once('../mailservice/PHPMailerAutoload.php');
    if(dirname($_SERVER['PHP_SELF'])=='/osn_test/services/_remote') $testing = true; else $testing = false;
    if($testing==true) $email_receiver = 'alis-c.82@mail.ru';
    $hosting = 'premium01.totaalholding.nl';
    $Username = 'publi@osntest.be';
    $Password = 'azerty123';
    $info = 'Information';

    function send_email($mail,$to){
            global $hosting,$Username,$Password,$headers,$email_subject,$email_sender,$info,$content;
            $mail = new PHPMailer;
            $mail->isSMTP();
            $mail->Host = $hosting;
            $mail->SMTPAuth = true;
            $mail->Username = $Username;
            $mail->Password = $Password;
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->IsHTML(true);
            $mail->addCustomHeader($headers);
            $mail->Subject = $email_subject;
            $mail->From = $email_sender;
            $mail->FromName = $email_sender;
            $mail->addAddress($to);
            $mail->addReplyTo($to,$info);
            $mail->isHTML(true);
            $mail->Subject = $email_subject;
            $mail->Body = utf8_decode($content);
            $mail->send();
        }
    $txt_header = $Dit_bericht_is_verzonden_via_het_Ondernemers_en_Shoppingnetwerk;
    $txt_footer = $Bedankt_u_voor_uw_bericht_we_zullen_dit_zo_spoedig_mogelijk_beantwoorden;
    if(isset($_POST["klantid"]) && $_POST["klantid"]!='') $klantid = mysqli_real_escape_string($con, $_POST["klantid"]); else $klantid='';
    if(isset( $_POST["contactid"]) && $_POST["contactid"]!='') $contactid = mysqli_real_escape_string($con, $_POST["contactid"]);  else $contactid='';
    if(isset($_POST["email"]) && $_POST["email"]!='') $email_sender = $_POST["email"]; else $email_sender='';


    if(isset($_POST["onderwerp"]) && $_POST["onderwerp"]!='') $email_subject =  iconv('utf-8', 'iso-8859-1',$_POST["onderwerp"]); else $email_subject='Info ondernemers-en-shoppingnetwerk.be';
    $phone = $_POST["telefoon"];
    $email_content = $_POST["vraag"];
    $bestelling_data = $_POST["bestelling"];
    $volwassenen = $_POST["volwassenen"];
    $kinderen = $_POST["kinderen"];
    $name = $_POST["name"];
    $fistname = $_POST["fistname"];
    $street = $_POST["street"];
    $postcode = $_POST["postcode"];
    $city = $_POST["city"];
    $datum_afhaling = $_POST['afhaling'];
    $volwassenen = $_POST['volwassenen'];
    $kinderen = $_POST['kinderen'];
    $email_content = str_replace("%26", "&", $email_content);
    $email_content = iconv('utf-8', 'iso-8859-1', $email_content);
    //---get email of the sender:
    $m ="email";
    $em = $m.$taal;

    if($testing==false){
        if($contactid !='') $q =  "SELECT contactemail as email, '$em' as typecontact FROM tblCONTACT_PERS WHERE idCONTACTPERS = '$contactid' and contactemail!='' LIMIT 1";
        elseif($klantid!='') $q = "SELECT inhoud as email, typecontact FROM tblCONTACT WHERE idKLANT = '$klantid' AND typecontact  LIKE 'email%'";

        $cq = mysqli_query($con, $q);
        while($row=mysqli_fetch_object($cq)){
            if($row->typecontact == $em && $row->email!='') $$em = $row->email;
            else {
               if($row->typecontact=='email' && $row->email!='') $$m = $row->email; $$em='';
            }
            if($$em!='') $email_receiver = $$em; else $email_receiver = $$m;
        }

        if($email_receiver =='' && $klantid!=''){
            $q = "SELECT inhoud AS email,TYPE AS typecontact FROM tblKLANT_GROEP  JOIN tblGROEP_CONTACT ON tblKLANT_GROEP.idGROEP =tblGROEP_CONTACT.idGROEP  WHERE TYPE LIKE 'email%' AND idKLANT = '$klantid' AND EMAILovernemen = 1;";
            $cq = mysqli_query($con, $q);
            while($row=mysqli_fetch_object($cq)){
                if($row->typecontact == $em && $row->email!='') $$em = $row->email;
                else {
                   if($row->typecontact=='email' && $row->email!='') $$m = $row->email; $$em='';
                }
                if($$em!='') $email_receiver = $$em; else $email_receiver = $$m;
            }
        }
    }
if($email_sender!='' && $email_receiver!=''){

        $kopie = $_POST['checkbox-1-1'];
        $content =  "
        <div>$txt_header</div>
        <div>$email_content</div>
        <div><img src='http://www.ondernemers-en-shoppingnetwerk.be/images/osn-logo-home.png'></div>
        <div>
        <p><b>Email:</b> $email_sender</p>
        <p><b>$Naam:</b> $name</p>
        <p><b>$Voornaam:</b>$fistname</p>
        <p><b>$Telefoon:</b> $phone</p>
        <p><b>$Straat:</b> $street</p>
        <p><b>$Postcode:</b> $postcode</p>
        <p><b>$Plaats:</b> $city</p>";

        if($volwassenen!='') $content.= "<p><b>$Aantal_volwassenen:</b> $volwassenen</p>";
        if($kinderen!='')$content.= "<p><b>$Aantal_kinderen:</b> $kinderen</p>";
        if(isset($_POST["bestelling"])){
            $content.= "<p><b>".ucfirst($bestelling).":</b></p>";
             foreach ($bestelling_data as $i) $content.= "<p>".$i."</p>";
        }
        if($Datum_afhaling!='')$content.= "<b>$Datum_afhaling:</b> $datum_afhaling</div>";
        $content.= "<div style='display:inline-block; border-radius: 5px; overflow:hidden; background-color:#f3b91c; color:#fff; padding:10px; margin-top:15px;'>$txt_footer</div></body></html>";
        $headers .= "Content-Transfer-encoding: utf-8";
        $headers .= "Message-ID: <".md5(uniqid(time()))."@{$_SERVER['SERVER_NAME']}>";
        $headers .= "X-MSmail-Priority: Normal";
        $headers .= "X-Mailer: Microsoft Office Outlook, Build 11.0.5510";
        $headers .= "X-MimeOLE: Produced By Microsoft MimeOLE V6.00.2800.1441";
        $headers .= "X-AntiAbuse: Servername - {$_SERVER['SERVER_NAME']}";
        send_email($mail, $email_receiver);
        if($kopie == "kopie")send_email($mail, $email_sender);
}
?>