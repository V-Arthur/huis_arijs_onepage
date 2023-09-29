<?php
/**
 * text transations for the webite , example=> zoeken:  $zoeken , nl/fr/en/de (lang) = $$zoeken
 */
$tranlations="zoeken	recherche	search	suchen
Zoek een bedrijf	Cherchons une entreprise	Look for a Company
netwerken	réseaux	network
ondernemersnetwerk	réseau entrepreneurs	entrepreneursnetwork
e-shopnetwerk	réseau e-shop	e-shopnetwork
catalogusnetwerk	réseau catalogue	cataloguenetwork
promonetwerk	réseau promo	promonetwork
kortingnetwerk	réseau rabais	rebatenetwork
shoppingexclusief	shoppingexclusif	shoppingexclusive
shoppingadvies	shoppingadvantage	shoppingadvantage
toon gemeenten	afficher des communes	show municipalities
Artikels	Articles	Articles
Meer info	Plus d'info	More info
Streekproducten	Produits du terroir	Local products
Bedrijf toevoegen	Ajouter une société	Add a company
Bedrijfsgegevens aanpassen	Personnalisation des informations de l'entreprise	Customise business data
Vragen en opmerkingen	Questions et commentaires	Questions and comments
Algemene voorwaarden	Conditions g&eacute;n&eacute;rales	Terms and conditions
toon provincies	afficher les provinces	show provinces
Zoek een ondernemer	Cherchons un entrepreneur	Look for an entrepreneur
Zoek een product	Cherchons un produit	Look for a product
Zoek een activiteit	Cherchons une activit\u00E9	Look for an activity
Zoek een bedrijf	Cherchons une entreprise	Look for a company
Zoek een handelaar	Cherchons  un distributeur	Look for a Dealer
Zoek een merk	Chercher une marque	Look for a Mark
Delhaize	Delhaize	Delhaize
Stad	Ville	County
Provincie	Province	Province
Gemeente	Commune	Town
Aalst	Alost	Aalst
Gent	Gand	Ghent
Brussel	Bruxelles	Brussels
netwerken	réseaux	network	netzwerk
Artikels	Articles	Articles
Streekproducten	Produits du terroir	Local products
Bedrijf toevoegen	Ajouter une société	Add a company
Bedrijfsgegevens aanpassen	Personnalisation des informations de l'entreprise	Customise business data
Vragen en opmerkingen	Questions et commentaires	Questions and comments
Algemene voorwaarden	Conditions générales	Terms and conditions
Contact	Contact	Contact
Realisatie	Concept	Concept
In welke gemeente wilt u zoeken	Dans quelle ville vous voulez rechercher	In which town do you want to search
Natuurlijk persoon	Personne physique	Individual
Over ons	Qui sommes-nous	About us
Bedankt voor uw bestelling, u ontvangt spoedig een bevestiging	Je vous remercie pour votre commande, vous recevrez bient&ocirc;t un courriel de confirmation	Thank you for your order, you will receive a confirmation soon
vakantieperiode	vacances	holiday
Voormiddag	matinée	Morning
Namiddag	Après-midi	Afternoon
bereikbaar	disponible	available
vakantieperiode	vacances	holiday
BEKIJK	VOIR	VIEW	ANZEIGEN
SLUITEN	FERMER	CLOSE	SCHLIEßEN
INFO	INFO	INFO";
//-----------------------------------------------------------------------------------------------------//
if(!isset($taal)) $taal = 'nl';
if(!isset($talen_arr)) $talen_arr = array("nl","fr","en","de");
$tr = explode("\n",$tranlations);
foreach($tr as $transl){
    $trans = explode('	',$transl);
    foreach($trans as $n=>$word){
        if($n==0) {
            $tranlation = str_replace(array(' ','-'),'_',$word);
            $tranlation = str_replace(array(',','.'),'',$tranlation);
        }
        if($taal == $talen_arr[$n]) $$tranlation = $word;
        //echo $tranlation." ".$$tranlation."<br>";
    }
}