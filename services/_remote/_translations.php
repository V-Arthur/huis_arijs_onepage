<?php
/**
 * Created by Evstratova-Bourgois Ekaterina
 * the original file is authomatically copied and updated from o-sn.be (185.56.144.103),upload@o-sn.be
 * text transations for the webite , example=> zoeken:  $zoeken , nl/fr/en/de (lang) = $$zoeken
 * included in all one-page sites at OSN and subdomains, OSN "search","more info" pages, etc..
 */
$tranlations="zoeken|recherche|search|suchen
Zoek een bedrijf|Cherchons une entreprise|Look for a Company
netwerken|réseaux|network
ondernemersnetwerk|réseau entrepreneurs|entrepreneursnetwork
e-shopnetwerk|réseau e-shop|e-shopnetwork
catalogusnetwerk|réseau catalogue|cataloguenetwork
promonetwerk|réseau promo|promonetwork
kortingnetwerk|réseau rabais|rebatenetwork
shoppingexclusief|shoppingexclusif|shoppingexclusive
shoppingadvies|shoppingadvantage|shoppingadvantage
toon gemeenten|afficher des communes|show municipalities
Artikels|Articles|Articles
Meer info|Plus d'info|More info
Streekproducten|Produits du terroir|Local products
Bedrijf toevoegen|Ajouter une société|Add a company
Bedrijfsgegevens aanpassen|Personnalisation des informations de l'entreprise|Customise business data
Vragen en opmerkingen|Questions et commentaires|Questions and comments
Algemene voorwaarden|Conditions g&eacute;n&eacute;rales|Terms and conditions
toon provincies|afficher les provinces|show provinces
Zoek een ondernemer|Cherchons un entrepreneur|Look for an entrepreneur
Zoek een product|Cherchons un produit|Look for a product
Zoek een activiteit|Cherchons une activit\u00E9|Look for an activity
Zoek een bedrijf|Cherchons une entreprise|Look for a company
Zoek een handelaar|Cherchons  un distributeur|Look for a Dealer
Zoek een merk|Chercher une marque|Look for a Mark
Delhaize|Delhaize|Delhaize
Stad|Ville|County
Provincie|Province|Province
Gemeente|Commune|Town
Aalst|Alost|Aalst
Gent|Gand|Ghent
Brussel|Bruxelles|Brussels
netwerken|réseaux|network|netzwerk
Artikels|Articles|Articles
Streekproducten|Produits du terroir|Local products
Bedrijf toevoegen|Ajouter une société|Add a company
Bedrijfsgegevens aanpassen|Personnalisation des informations de l'entreprise|Customise business data
Vragen en opmerkingen|Questions et commentaires|Questions and comments
Algemene voorwaarden|Conditions générales|Terms and conditions
Contact|Contact|Contact
Realisatie|Concept|Concept
In welke gemeente wilt u zoeken|Dans quelle ville vous voulez rechercher|In which town do you want to search
Natuurlijk persoon|Personne physique|Individual
Over ons|Qui sommes-nous|About us
Bedankt voor uw bestelling, u ontvangt spoedig een bevestiging|Je vous remercie pour votre commande, vous recevrez bient&ocirc;t un courriel de confirmation|Thank you for your order, you will receive a confirmation soon
vakantieperiode|vacances|holiday
Voormiddag|matinée|Morning
Namiddag|Après-midi|Afternoon
bereikbaar|disponible|available
vakantieperiode|vacances|holiday
BEKIJK|VOIR|VIEW|ANZEIGEN
SLUITEN|FERMER|CLOSE|SCHLIEßEN
INFO|INFO|INFO
Maandag|Lundi|Monday
gesloten|fermé|closed
op afspraak|sur rendez-vous|by appointment
Dinsdag|Mardi|Tuesday
Woensdag|Mercredi|Wednesday
Donderdag|Jeudi|Thursday
Vrijdag|Vendredi|Friday
Zaterdag|Samedi|Saturday
Zondag|Dimanche|Sunday
van|depuis|from
tot|jusqu'à|to
locatie op kaart|emplacement sur la carte|location on map
website|site web|website
vestigingen|branches|branches
OND. NR./BTW NR.|Numéro d'entreprise|Enterprise number
Vestigingseenheidsnr.|Numéro de l'unité d'établissement|Establishment unit number
Onderwerp|Sujet|Subject
Uw vraag of opmerkingen|Votre message|Your question
Dit is een verplicht veld|Ce champ est obligatoire|This field is required
Stuur mij een kopie van dit bericht|Envoyez-moi une copie de ce message|Send me a copy of this message
Contacteer Ons|Contactez-nous|Contact Us
Uw e-mailadres|Votre adresse e-mail|Your email address
Telefoon|Votre numéro de téléphone|Phone number
Naam|Nom|Name
Voornaam|Prénom|First name
Straat|Rue|Street
Postcode|Code Postal|Postcode
Plaats|Ville|Town
bestelling|ordre|ordrer
Verstuur|Envoyer|Send
Datum afhaling|Date d'ramassage|Pick-up date
Aantal volwassenen|Nombre d'adultes|Number of adults
Aantal kinderen|Nombre d'enfants|Number of children
Andere wensen/opmerkingen|Autres souhaits/commentaires|Other wishes/comments
Bestellen|Réserver|Order
Ontbijtmand|Panier petit déjeuner|Breakfast Basket
Kaasschotel|Plateaux de fromages|Cheese platter
Aperitief|Amuses|Appetizers
Raclette|Raclette|Raclette
Buffetten|Buffets|Buffets
Kinderformule|Formule enfant|Children's formula
Gourmet|Gourmet|Gourmet
Fondue|Fondue|Fondue
Fruitmanden|Corbeilles de Fruits|Fruit baskets
Broodjes|Sandwiches|Sandwiches
Beenham|Jambon à l'Os|Bone-in ham
folder|dépliant|folder|prospekt
Video|Vidéo|Video|Video
nieuwsbrief|lettre d'information|newsletter
Bedankt voor uw bestelling, u ontvangt spoedig een bevestiging|Je vous remercie pour votre commande, vous recevrez bient&ocirc;t un courriel de confirmation|Thank you for your order, you will receive a confirmation soon
E-mail verzonden|L'email a été envoyé|Email has been sent
Dit bericht is verzonden via het Ondernemers-en-Shoppingnetwerk|Ce message a été envoyé par Reseaushopping-et-Entrepreneurs|This message was sent via the Entrepreneurs-and-Shoppingnetwork
Bedankt u voor uw bericht we zullen dit zo spoedig mogelijk beantwoorden|Merci pour votre message nous vous répondrons dés que possible|Thank you for your message we will reply as soon as possible
";
//-----------------------------------------------------------------------------------------------------//
$self= basename($_SERVER['PHP_SELF']);
if(isset($_GET['lang']))$_SESSION['taal'] = $_GET['lang'];
if(!isset($_SESSION['taal'])) $taal = "nl"; elseif(isset($_SESSION['taal']) && $_SESSION['taal']!='') $taal = $_SESSION['taal'];
if($taal == "fr") $in = "&agrave;"; else $in = "in";
if($taal!='nl' && $taal!='de')$lg = '-'.$taal; else $lg = '';
$searched = array();
if(isset($_GET)){
    foreach($_GET as $get_name=>$get_val){
        if($get_val!='' && $get_name!='lang') $searched[]= "$get_name=$get_val";
    }
}
$searched = implode('&',$searched);
if($searched!='')$page= $self.'?'.$searched;
if(!isset($talen_arr)) $talen_arr = array("nl","fr","en","de");
$tr = explode("\n",$tranlations);
foreach($tr as $transl){
    $trans = explode('|',$transl);
    foreach($trans as $n=>$word){
        if($n==0) {
            $tranlation = str_replace(array(' ','-'),'_',$word);
            $tranlation = str_replace(array(',','.','/'),'',$tranlation);
            $type_tranlation= 'type_'.$tranlation;
        }
        if($taal == $talen_arr[$n]) {
            $$tranlation = $word;
            $$type_tranlation = $word;
        }
        if(!isset($$tranlation) || $$tranlation=='') $t = 'nl'; else $t = $taal;//if no tranlation - set default 'nl' tr.
        if($t == $talen_arr[$n]) {
            $$tranlation = $word;
            $$type_tranlation = $word;
        }
    }
}
?>