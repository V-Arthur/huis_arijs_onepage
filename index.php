<?php
//setcookie("winkelmandCookie", FALSE);
?>
<!DOCTYPE html>
<html lang="nl">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Huis Arijs Uitvaartverzorging</title>

    <link href="css/index.css" rel="stylesheet" type="text/css">

    <script
        src="https://code.jquery.com/jquery-3.1.1.min.js"
        integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
        crossorigin="anonymous"></script>

    <script src="js/index.js"></script>
    <noscript></noscript>

    <!--Bootstrap-->
    <!-- Latest compiled and minified CSS -->
    <!--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    -->
    <!-- jQuery library -->
    <!--
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    -->
    <!-- Latest compiled JavaScript -->
    <!--
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    -->
    <!--
    <link href="css/bootstrap.min.css" rel="stylesheet">
    -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!--
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    -->

</head>

  <body>
  <div id="wrapper">

    <!--                        BANNER                       -->    

    <section id="banner">

      <div id="logoBanner"><img src="source/logo/huis-arijs-logo.png" alt="logo huis arijs"></div>

      <div id="sloganBanner">
        <p id="slogan">
          Afscheid nemen is met zachte handen verpakken <br><br>en meedragen, al wat herinnering waard is
        </p>
      </div>
    </section>

  <!--                        HEADER                       -->
    <header id="headerNav">
    
      <div id="headerLogoWrapper">
        <a href="#" id="navLogo"></a>
      </div>
<!--
      <div id="mainNavWrapper">-->
      <nav id="mainNav" class="navLinksWrapper">
        <ul id="navElements">
          <li><a href="#" id="contactLink" class="navLinks" data-id="6">Contact</a></li>
          <li><a href="#" id="overonsLink" class="navLinks" data-id="5">Over ons</a></li>
          <li><a href="#" id="condolerenLink" class="navLinks" data-id="4">Condoleren</a></li>
          <li><a href="#" id="funerariumLink" class="navLinks" data-id="3">Funerarium en Aula</a></li>
          <li><a href="#" id="uitvaartwinkelLink" class="navLinks" data-id="2">Uitvaartwinkel</a></li>
          <li><a href="#" id="voorzorgLink" class="navLinks" data-id="1">Voorzorg</a></li>
        </ul>
      </nav>



      <div id="navButtonWrapper">
        <label for="show-menu" class="menuLabel"><img src="source/icons/menu-icon.png" alt="menu icon"></label>
        <input type="checkbox" id="show-menu" role="button">
      </div>
      
<!--
      </div>
-->
    </header>









    <!-- *******<header id="navigatie">
      <div id="headerContent">

        <span id="navLogo">
          <a href="index.php"><img src="source/logo/huis-arijs-uitvaartverzorging-logo.png" alt="logo huis arijs"></a>
        </span>

        <div id="menuSmallScreen">
          <!--<label for="show-menu" class="show-menu"><img src="source/icons/menu-icon.png" alt="menu icon"></label>
          <input type="checkbox" id="show-menu" role="button">-->
       <!-- ******** </div>
        
        <ul id="nav">
          <li><a href="#">Voorzorg</a></li>
          <li><a href="#">Uitvaartwinkel</a></li>
          <li><a href="#">Funerarium en Aula</a></li>
          <li><a href="#">Over ons</a></li>
          <li><a href="#">Contact</a></li>
        </ul>

      </div>
    </header>
    -->



<!--                        VOORZORG                       -->

    <section id="voorzorg">
      <div id="voorzorgContent" class="content">

        <div id="wilsbeschikkingWrapper" class="contentWrapper">
          <div id="wilsbeschikkingMainContent" class="voorzorgMainContent" data-id="0">
            <div id="wilsbeschikkingAfbeelding" class="voorzorgAfbeelding"></div>

            <div id="wilsbeschikkingTitel" class="voorzorgTitel"><p>Wilsbeschikking</p></div>

            <div id="wilsbeschikkingTekst" class="voorzorgTekst">
              <p>Een laatste wilsbeschikking is een verzoek aan uw nabestaanden om uw wensen te respecteren en uit te voeren.</p>
              <p class="wilsbeschikkingExtraTekst voorzorgExtraTekst">Dit alles gebeurt aan de hand van een gedateerd en ondertekend document welke je op de dienst Bevolking of Burgerlijke Stand van je woonplaats bezorgd.</p>
              <p class="wilsbeschikkingExtraTekst voorzorgExtraTekst">Hier wordt het bewaard in het rijksregister en ontvang je ook een ontvangstbewijs.</p>
              <p class="wilsbeschikkingExtraTekst voorzorgExtraTekst">Bij elke aangifte van overlijden wordt nagegaan of de overledene tijdens zijn leven een laatste wil heeft neergelegd. Indien dit zo is, moeten de nabestaanden die instaan voor de uitvaartregeling, de wil van de overledene respecteren.</p>
            </div>
          </div>

          <div id="wilsbeschikkingLinks" class="voorzorgLinks">
            <div id="wilsbeschikkingLink1" class="voorzorgIndividueleLink voorzorgIndividueleLinkIsLink">
              <a href="source/pdf_files/Wilsbeschikking_pdf.pdf" target="_blank">Je kan hier een model wilsbeschikking downloaden</a>
            </div>
          </div>
        </div>

        <div id="keuzebegrafenisWrapper" class="contentWrapper">
          <div id="keuzebegrafenisMainContent" class="voorzorgMainContent" data-id="0">
            <div id="keuzebegrafenisAfbeelding" class="voorzorgAfbeelding"></div>

            <div id="keuzebegrafenisTitel" class="voorzorgTitel"><p>Keuze begrafenis of crematie</p></div>

            <div id="keuzebegrafenisTekst" class="voorzorgTekst">
              <p>Gedurende eeuwen was begraven bijna de enige vorm om onze overledenen ten ruste te dragen. Geleidelijk aan nam het aantal crematies toe 
en momenteel meer en meer.</p>
              <p class="keuzebegrafenisExtraTekst voorzorgExtraTekst">Indien de overledene geen laatste wilsbeschikking heeft neergelegd waarin zijn/haar keuze is gemaakt, zijn de nabestaanden vrij om te kiezen voor crematie of begrafenis.</p>
              <p class="keuzebegrafenisExtraTekst voorzorgExtraTitel voorzorgExtraTekst">Traditionele begrafenis</p>
              <p class="keuzebegrafenisExtraTekst voorzorgExtraTekst">Begraving in niet-geconcedeerde grond (kosteloos) <br>Begraving in geconcedeerde grond (betalen van een concessie) <br>Begraving in een grafkelder (betalen van een concessie + grafkelder)</p>
              <p class="keuzebegrafenisExtraTekst voorzorgExtraTitel voorzorgExtraTekst">Crematie</p>
              <p class="keuzebegrafenisExtraTekst voorzorgExtraTekst">Uitstrooiing op een begraafplaats (strooiweide) <br>Uitstrooiing op zee <br>Bewaring van een symbolisch gedeelte van de as <br>Begraving van de urne op de begraafplaats in een traditioneel graf <br>Begraving van de urne op de begraafplaats in een urnenveld of urnentuin <br>Columbarium <br>Asbestemming op andere plaatsen</p>
            </div>
          </div>

          <div id="keuzebegrafenisLinks" class="voorzorgLinks">
            <div id="keuzebegrafenisLink1" class="voorzorgIndividueleLink voorzorgIndividueleLinkIsLink">
              <a href="source/pdf_files/Aanvraag_tot_cremeren.pdf" target="_blank">Je kan "Aanvraag tot cremeren" hier downloaden</a>
            </div>
            <div id="keuzebegrafenisLink2" class="voorzorgIndividueleLink voorzorgIndividueleLinkIsLink">
              <a href="source/pdf_files/Aanvraag_aspotje_in_crematorium__symbolisch_deel.pdf" target="_blank">Je kan "Aanvraag aspotje" hier downloaden</a>
            </div>
            <div id="keuzebegrafenisLink3" class="voorzorgIndividueleLink voorzorgIndividueleLinkIsLink">
              <a href="source/pdf_files/Schriftelijk_verzoek_asbestemming_individueel.pdf" target="_blank">Je kan het document voor thuisbewaring hier <br> downloaden</a>
            </div>
            <div id="keuzebegrafenisLink4" class="voorzorgIndividueleLink voorzorgIndividueleLinkIsLink">
              <a href="source/pdf_files/Gezamelijk_verzoek_asbestemming_thuisbewaring.pdf" target="_blank">Je kan het document tot gezamelijke aanvraag van <br> de nabestaanden hier downloaden</a>
            </div>
          </div>
        </div>

        <div id="voorafregelingWrapper" class="contentWrapper">
          <div id="voorafregelingMainContent" class="voorzorgMainContent" data-id="0">
            <div id="voorafregelingAfbeelding" class="voorzorgAfbeelding"></div>

            <div id="voorafregelingTitel" class="voorzorgTitel"><p>Voorafregeling<p></div>

            <div id="voorafregelingTekst" class="voorzorgTekst">
              <p>Sommige mensen willen tijdens hun leven bepaalde wensen vastleggen betreffende hun  uitvaart. Hiervoor kan je ook bij ons terecht.</p>
              <p class="voorafregelingExtraTekst voorzorgExtraTekst">Wij kunnen bepaalde keuzes noteren volgens uw wensen zodat de nabestaanden weten wat er moet gebeuren. <br>Tevens wordt er een raming gemaakt van de begrafeniskosten.</p>
              <p class="voorafregelingExtraTekst voorzorgExtraTekst">Men kan zijn eigen uitvaart tot in detail vastleggen.</p>
              <p class="voorafregelingExtraTekst voorzorgExtraTekst">De mogelijkheid bestaat ook om financieel maatregelen te treffen zodat de nabestaanden verlost zijn van de financiële verplichtingen. Men kan hiervoor beroep doen op een uitvaartverzekering.</p>
              <p class="voorafregelingExtraTekst voorzorgExtraTekst">Een andere mogelijkheid is om een éénmalig budget opzij te zetten op een spaarrekening. Jaarlijks wordt de intrest bijgeplaatst waardoor een eventuele prijsverhoging wordt opgevangen. Bij overlijden wordt het verworven bedrag vrijgemaakt voor de betaling van de begrafeniskosten.</p>
            </div>
          </div>

          <div id="voorafregelingLinks" class="voorzorgLinks">
            <div id="voorafregelingLink1" class="voorzorgIndividueleLink">
              <p>Wij blijven ook ter beschikking voor verdere informatie</p>
            </div>
          </div>
        </div>
      </div>
    </section>
    
    <!--                        UITVAARTWINKEL                       -->
    <div id="uitvaartwinkelGroteAfbeeldingWrapper" class="overzichtScherm">
      <div id="uitvaartwinkelGroteAfbeeldingSluitenKnopWrapper" class="sluitenKnop"> </div>
      <div id="groteAfbeeldingContainer">
        
      </div>

      <div id="groteAfbeeldingBottomWrapper">
        <div id="groteAfbeeldingTekst">
          <p id="groteAfbeeldingBeschrijving"></p>
          <p id="groteAfbeeldingNummer"></p>
        </div>
        <form>
          <!--<input type="text" name="orderAantal" placeholder="0" id="txtOrderAantal" class="uitvaartwinkelOrderAantalFormContent">-->
          <input type="submit" value="Toevoegen aan winkelwagen" id="uitvaartwinkelBtnSubmitOrder" class="btnSubmit">
        </form>
      </div>
    </div>

    <!-- WINKELMAND OVERZICHT -->
    <div id="uitvaartwinkelWinkelmandOverzichtWrapper" class="overzichtScherm">
      <div id="uitvaartwinkelWinkelmandOverzichtSluitenKnopWrapper" class="sluitenKnop"> </div>
      <div id="uitvaartwinkelWinkelmandOverzichtTitels">
        <div id="titelsContainer">
          <div id="beschrijvingContainer">
            <p id="beschrijving">Beschrijving</p>
          </div>
          <div id="prijsContainer">
            <p id="prijs">Prijs (in euro)</p>
          </div>
        </div>
      </div>
      <div id="uitvaartwinkelWinkelmandOverzichtToegevoegdeProducten">

      <!--
        <div class="productenGroep">
          <div class="productenGroepAfbeeldingContainer">   </div>
          <div class="productenGroepTekstContainer">
            <div class="productenGroepBeschrijvingContainer">
              <p class="productenGroepBeschrijving">Naturel nr. 1    </p>  
            </div>
            <div class="productenGroepPrijsContainer">
              <p class="productenGroepPrijs"> 65  </p>
            </div>
            <div class="selectieVerwijderenWrapper">
              
            </div>
          </div>
        </div>
      -->
      </div>
      <form>
          <input type="submit" value="Verder gaan naar kassa" id="uitvaartwinkelBtnNaarKassa"  class="btnSubmit">
        </form>
    </div>
    <!-- /WINKELMAND OVERZICHT -->






    <section id="uitvaartwinkel">
      <div id="uitvaartwinkelMainContentWrapper">
        <div id="uitvaarwinkelTitelWrapper">
          <p id="uitvaartwinkelTitel">In onze winkel bieden we een ruime keuze aan, kom gerust een kijkje nemen.</p>
        </div>

        <div id="contentLinksWrapper">
          <div id="bloemenWrapper">
          
            <p id="bloemenTitel">Bloemen</p>
            
            <div id="bloemenTekst">
              <p>Wie graag een bloem schenkt, kan deze bij ons bestellen.</p>

              <p>Er is een ruime keuze aan zijden bloemen, dit kan in alle prijsklassen.</p>

              <p>Natuurbloemen kunnen op foto gekozen worden of volgens eigen ontwerp, met een minimumbedrag van 65 euro.</p>

              <div id="extraAfstandParagrafen">
                <p>DE BESTELLING KAN PAS DOORGAAN</p>

                <p>NA ONTVANGST VAN BESTALING</p>

              </div>
            </div>
            
            <div id="uitklappijlNaarBoven"><img src="source/icons/uitklappijl_naar_boven.png"></div>
          </div>

          <div id="toonzaalWrapper">
          
          <div id="uitklappijlNaarBeneden"><img src="source/icons/uitklappijl_naar_beneden.png"></div>
            <div id="toonzaalTekst">
              <p>Als uitvaartonderneming staan wij in voor eigen drukwerk maar u kan ook vrij een eigen drukker kiezen.<br>
              U kan ook tekeningen of foto’s in een rouwkaart of gedenkprentje laten verwerken, een eigen gedicht, eigen tekst ...laten verwerken.</p>

              <h1>Wij zorgen ook voor: </h1>

              <ul>
                <li>Het opstellen van de rouwbrief in samenspraak met de nabestaanden</li>
                <li>Ter beschikking stellen van voorbeeldteksten voor rouwbrief en rouwprentje</li>
                <li>Een proefdruk, zowel van de rouwbrief als het rouwprentje</li>
                <li>Het aanleveren van de nodige rouwpriorzegels</li>
                <li>Kaartjes voor de koffietafel</li>
                <li>Een ingekaderde foto om bij de kist te plaatsen tijdens de uitvaartplechtigheid</li>
                <li>Bedankingskaartjes</li>
              </ul>
            </div>

            <p id="toonzaalTitel">Toonzaal</p>
          </div>
        </div>
        
        <div id="contentRechtsWrapper">
        <!--
          <div id="uitvaartwinkelAfbeelding1" class="uitvaartwinkelAfbeeldingen uitvaartwinkelAfbeeldingenTop"></div>
          <div id="uitvaartwinkelAfbeelding2" class="uitvaartwinkelAfbeeldingen uitvaartwinkelAfbeeldingenTop"></div>
          <div id="uitvaartwinkelAfbeelding3" class="uitvaartwinkelAfbeeldingen uitvaartwinkelAfbeeldingenTop"></div>

          <div id="uitvaartwinkelAfbeelding4" class="uitvaartwinkelAfbeeldingen uitvaartwinkelAfbeeldingenBottom"></div>
          <div id="uitvaartwinkelAfbeelding5" class="uitvaartwinkelAfbeeldingen uitvaartwinkelAfbeeldingenBottom"></div>
          <div id="uitvaartwinkelAfbeelding6" class="uitvaartwinkelAfbeeldingen uitvaartwinkelAfbeeldingenBottom"></div>
          -->
        </div>

        <div id="uitvaartwinkelContentBottomWrapper">
          <div id="uitvaartwinkelPijlLinks" class="uitvaartwinkelPijlen"></div>
          <div id="uitvaartwinkelPijlRechts" class="uitvaartwinkelPijlen"></div>

          <div id="uitvaartwinkelWinkelmandWrapper">
            <p id="uitvaartwinkelWinkelmandAantal"></p>
          </div>
        </div>
      </div>

      <!--          KASSA           -->

      <div id="kassaWrapper">
        <nav id="kassaNav" class="navLinksWrapper">
          <ul>
            <li><a href="#" id="kassaNavBestellingOverzicht">Bestelling overzicht</a></li>
            <li><a href="#" id="kassaNavBetaalmethode">Betaalmethode</a></li>
            <li><a href="#" id="kassaNavGegevens">Gegevens</a></li>
            <!-- <li><a href="#">Bijkomende informatie</a></li> -->
          </ul>
        </nav>

        <div id="bestellingOverzichtWrapper">
          <div id="bestellingenContentWrapper">
             <div id="bestellingOverzichtTitelsWrapper">
              <span id="afbeeldingTitel"></span>
              <span class="bestellingOverzichtTitels">Beschrijving</span>
              <span class="bestellingOverzichtTitels">Prijs/stuk (in euro)</span>
              <span class="bestellingOverzichtTitels">Aantal</span>
              <span class="bestellingOverzichtTitels">Totaal prijs (in euro)</span>
            </div>

            <div id="bestellingenProductWrappersContainer">
              <!-- VERVANG DID MET JAVASCRIPT -->
              <!--
              <div id="eerste" class="bestellingenProductWrapper">
                <div class="bestellingenProductAfbeeldingContainer"><span class="helper"></span><img src="source/afbeeldingen/uitvaartwinkel/bloemen/naturel1.jpg"></div>
                <div class="bestellingenProductBeschrijvingContainer bestellingenProductElements"><span class="helper"></span><span>Naturel nr. 1</span></div>
                <div class="bestellingenProductPrijsContainer bestellingenProductElements"><span class="helper"></span><span>65</span></div>
                <div class="bestellingenProductAantalContainer bestellingenProductElements"><span class="helper"></span><input type="text" name="aantal" class="bestellingenProductAantal"></div>
                <div class="bestellingenProductTotaalPrijsContainer bestellingenProductElements"><span class="helper"></span><span>65</span></div>
              </div>

              <div id="tweede" class="bestellingenProductWrapper">
                <div class="bestellingenProductAfbeeldingContainer"><span class="helper"></span><img src="source/afbeeldingen/uitvaartwinkel/toonzaal/urnes.jpg"></div>
                <div class="bestellingenProductBeschrijvingContainer bestellingenProductElements"><span class="helper"></span><span>Urne</span></div>
                <div class="bestellingenProductPrijsContainer bestellingenProductElements"><span class="helper"></span><span>25</span></div>
                <div class="bestellingenProductAantalContainer bestellingenProductElements"><span class="helper"></span><input type="text" name="aantal" class="bestellingenProductAantal"></div>
                <div class="bestellingenProductTotaalPrijsContainer bestellingenProductElements"><span class="helper"></span><span>25</span></div>
              </div>
              -->
              <!-- EINDE VERVANG -->
            </div>
          </div>

          <div id="bestellingenTotaalPrijsWrapper">
            <p id="bestellingenSubtotaalContainer">Subtotaal <span></span></p>
            <p id="bestellingenVerzendingContainer">Verzending <span></span></p>
            <p id="bestellingenTotaalContainer">Totaal (in euro) <span></span></p>
          </div>

          <div id="kassaformButtonWrapper">
            <input type="button" value="Terug naar winkel" id="bestellingOverzichtBtnTerug" class="btnTerug">
            <input type="submit" value="Volgende" id="bestellingOverzichtBtnSubmit" class="btnSubmit kassaBtnSubmit">
          </div>
        </div>

        <div id="betaalmethodeWrapper">
          <form action="" id="betaalmethodeForm">
            <div id="betaalmethodeFormElements">
              <fieldset>
                <legend id="betaalmethodeLegend">Kies uw betaalmethode</legend>
                <div class="betaalmethodeOptionsContainer"><input id="radioOverschrijving" class="betaalmethodeOptions" type="radio" name="betaalmethode" value="overschrijving" checked><label for="radioOverschrijving">Overshrijving<br><span>U zal een e-mail ontvangen met de nodige gegevens.</span></label></div>
                <div class="betaalmethodeOptionsContainer"><input id="radioAfhalen" class="betaalmethodeOptions" type="radio" name="betaalmethode" value="afhalen"><label for="radioAfhalen">Betaling bij afhalen<br><span>U kan betalen bij afhalen.</span></label></div>
                <div class="betaalmethodeOptionsContainer"><input id="chkFactuur" class="betaalmethodeOptions" type="checkbox" name="factuur" value="factuur"><label for="chkFactuur">Factuur aanvragen<br><span>Als bedrijf kan u een factuur aanvragen.</span></label></div>
              </fieldset>
            </div>

            <div id="kassaformButtonWrapper">
              <input type="button" value="Vorige" id="betaalMethodeBtnTerug" class="btnTerug">
              <input type="submit" value="Volgende" id="betaalMethodeBtnSubmit" class="btnSubmit kassaBtnSubmit">
            </div>
          </form>
        </div>

        <div id="gegevensWrapper">
          <form id="gegevensForm" method="post" action="php/indexData.php">
            <div class="gegevensWrapperTopFieldsets">
              <div class="gegevensWrapperElementsContainer"><label>Titel *</label>
              <div class="gegevensInputElementsContainer"><select id="gegevensTitelSelect" class="gegevensInputElement" name="titel">
                <option value="m">Dhr</option>
                <option value="v">Mevr</option>
              </select></div></div>

              <div class="gegevensWrapperElementsContainer"><label>Voornaam *</label> <div class="gegevensInputElementsContainer"><input type="text" name="voornaam" data-id="1"></div></div>
              <div class="gegevensWrapperElementsContainer"><label>Familienaam *</label> <div class="gegevensInputElementsContainer"><input type="text" name="familienaam" data-id="1"></div></div>
              <div class="gegevensWrapperElementsContainer"><label>Telefoon</label> <div class="gegevensInputElementsContainer"><input type="text" name="telefoon" data-id="0"></div></div>
            </div>

            <div class="gegevensWrapperTopFieldsets">
              <div class="gegevensWrapperElementsContainer"><label>E-mail *</label> <div class="gegevensInputElementsContainer"><input type="text" name="email" data-id="1"></div></div>
              <div class="gegevensWrapperElementsContainer"><label>Straat *</label> <div class="gegevensInputElementsContainer"><input type="text" name="straat" data-id="1"></div></div>
              <div class="gegevensWrapperElementsContainer"><label>Postcode *</label> <div class="gegevensInputElementsContainer"><input type="text" name="postcode" data-id="1"></div></div>
              <div class="gegevensWrapperElementsContainer"><label>Gemeente *</label> <div class="gegevensInputElementsContainer"><input type="text" name="gemeente" data-id="1"></div></div>
            </div>

            <div  class="gegevensWrapperTopFieldsets">
              <div class="gegevensWrapperElementsContainer"><label>Nummer *</label> <div class="gegevensInputElementsContainer"><input type="text" name="nummer" data-id="1"></div></div>
            </div>

            <div  class="gegevensWrapperTopFieldsets gegevensWrapperBottomFieldsets">
              <div class="gegevensWrapperElementsContainer"><label id="lblBedrijf">Bedrijf</label> <div class="gegevensInputElementsContainer"><input type="text" name="bedrijf" disabled data-id="0"></div></div>
            </div>

            <div  class="gegevensWrapperTopFieldsets gegevensWrapperBottomFieldsets">
              <div class="gegevensWrapperElementsContainer"><label id="lblBtwnummer">BTW nummer</label> <div class="gegevensInputElementsContainer"><input type="text" name="btwnummer" disabled data-id="0"></div></div>
            </div>

            <fieldset id="gegevensFieldset">
              <legend>Bijkomende informatie</legend>
              <div class="gegevensWrapperElementsContainer"><label>Tekst op lint of kaartje *</label><div class="gegevensInputElementsContainer"><input type="text" name="tekstLintKaart" data-id="1"></div></div>
              <div class="gegevensWrapperElementsContainer"><label>Datum begrafenis (dd/mm/yyyy) *</label><div class="gegevensInputElementsContainer"><input type="text" name="datumBegrafenis" data-id="1"></div></div>
              <div class="gegevensWrapperElementsContainer"><label>Naam van de overledene *</label><div class="gegevensInputElementsContainer"><input type="text" name="naamOverledene" data-id="1"></div></div>
            </fieldset>

            <div id="kassaformButtonWrapper">
              <input type="button" value="Vorige" id="gegevensBtnTerug" class="btnTerug">
              <input type="submit" value="Bestellen" id="gegevensBtnSubmit" class="btnSubmit kassaBtnSubmit">
            </div>
            <!-- <input type="hidden" name="gegevensPostcheck" value="true"/> -->
          </form>

        </div>

        
      </div>

      <!--          EINDE KASSA           -->
    </section>

<!--                        FUNERARIUM EN AULA                       -->
    <section id="funerarium">
      <div id="funerariumWrapper">
        <div id="funerariumBackWrapper">

          <div id="funerariumBackContentLeftWrapper" class="funerariumBackContentWrapper">
            <p>Door de aanwezigheid van drie rouwkamers is er geen tijdsdruk voor de aanwezigen tijdens de bezoekuren maar kan men ongestoord in een rustige, familiale sfeer afscheid nemen van de overledene.</p>

            <p>Een rouwregister ligt ter beschikking om naam en rouwbetuiging te noteren. Dit wordt nadien aan de familie bezorgd.</p>
          </div>

          <div id="funerariumBackContentCenterWrapper" class="funerariumBackContentWrapper">Als eerste in het <br> Pajottenland <br> zorgden we voor een <br> eigen funerarium.</div>

          <div id="funerariumBackContentRightWrapper" class="funerariumBackContentWrapper">
            <p>Onze aula biedt ook de mogelijkheid tot het organiseren van afscheidsplechtigheden, in een intiem kader met angepaste muziek, eigen accenten en de nodige begeleiding.</p>

          </div>

        </div>

        <div id="funerariumFrontWrapper">


          <div id="funerariumKolomEenWrapper" class="funerariumKolomWrappers">
            <div class="funerariumKolomTitel">
              <p id="funerariumKolomTitel1"></p>
            </div>
            <div id="funerariumKolomEenAfbeelding" class="funerariumKolomAfbeelding">
              <div id="funerariumAfbeeldingContainer1" class="funerariumKolomAfbeeldingContainer">
              <!--id="funerariumKolomEenAfbeeldingContainer"-->
                <!--<img src="source/afbeeldingen/funerarium_en_aula/inkom_2.jpg" alt="afbeelding inkom 1">-->
              </div>
            </div>
          </div>



          <div id="funerariumKolomTweeWrapper" class="funerariumKolomWrappers">
            <div class="funerariumKolomTitel">
              <p id="funerariumKolomTitel2"></p>
            </div>
            <div id="funerariumKolomTweeAfbeelding" class="funerariumKolomAfbeelding">
              <div id="funerariumAfbeeldingContainer2" class="funerariumKolomAfbeeldingContainer">
                <!--<img src="source/afbeeldingen/funerarium_en_aula/inkom_2.jpg" alt="afbeelding inkom 1">-->
              </div>
            </div>
          </div>



          <div id="funerariumKolomDrieWrapper" class="funerariumKolomWrappers">
            <div class="funerariumKolomTitel">
              <p id="funerariumKolomTitel3"></p>
            </div>
            <div id="funerariumKolomDrieAfbeelding" class="funerariumKolomAfbeelding">
              <div id="funerariumAfbeeldingContainer3" class="funerariumKolomAfbeeldingContainer">
                <!--<img src="source/afbeeldingen/funerarium_en_aula/inkom_2.jpg" alt="afbeelding inkom 1">-->
              </div>
            </div>
          </div>



          <div id="funerariumKolomVierWrapper" class="funerariumKolomWrappers">
            <div class="funerariumKolomTitel">
              <p id="funerariumKolomTitel4"></p>
            </div>
            <div id="funerariumKolomVierAfbeelding" class="funerariumKolomAfbeelding">
              <div id="funerariumAfbeeldingContainer4" class="funerariumKolomAfbeeldingContainer">
                <!--<img src="source/afbeeldingen/funerarium_en_aula/inkom_2.jpg" alt="afbeelding inkom 1">-->
              </div>
            </div>
          </div>          
        </div>

        <div id="funerariumBottomWrapper">
          <div id="funerariumPijlLinks" class="funerariumPijlen"></div>
          <div id="funerariumPijlRechts" class="funerariumPijlen"></div>
        </div>
      </div>
    </section>

<!--                        CONDOLEREN                       -->
    <section id="condoleren">
      <div id="condolerenContentWrapper">


<!--  CONDOLEREN NORMAAL -->
        
        <div id="condolerenNormaalWrapper">
        <!--
          <div class="condolerenKolom">
              <div id="condolerenImageEen" class="condolerenImageWrapper">
                
              </div>
              <h1>Isabella De Vriendt</h1>
              <h2>Echtgenote van Frans Amerijckx</h2>
              <p>20 oktober 1936, Asse</p>
              <p>04 maart 2017, Sint-Katherina-Lombeek</p>
              <p class="condolerenWoonplaats">Woonplaats: Asse</p>

              <div class="condolerenKolomBottomWrapper">
                <div class="condolerenIcons condolerenCondolerenIcon"></div>
                <a href="source/pdf_files/Wilsbeschikking_pdf.pdf" target="_blank">
                  <div class="condolerenIcons condolerenRouwbriefIcon"></div>
                </a>
                <div class="condolerenIcons condolerenBloemenIcon"></div>
              </div>
          </div>
          <div class="condolerenKolom">
              <div id="condolerenImageTwee" class="condolerenImageWrapper">
                
              </div>
              <h1>Lutgarde Otsa</h1>
              <h2>Echtgenote van Marc Borremans</h2>
              <p>24 februari 1959, Ninove</p>
              <p>06 maart 2017, Aalsta</p>
              <p class="condolerenWoonplaats">Woonplaats: Roosdaal </p>

              <div class="condolerenKolomBottomWrapper">
                <div class="condolerenIcons condolerenCondolerenIcon"></div>
                <div class="condolerenIcons condolerenRouwbriefIcon"></div>
                <div class="condolerenIcons condolerenBloemenIcon"></div>
              </div>
          </div>
          <div class="condolerenKolom">
              <div id="condolerenImageDrie" class="condolerenImageWrapper">
                
              </div>
              <h1>Elise DE Braeckenier</h1>
              <h2>Weduwe van Gustaaf Van den Brande</h2>
              <p>30 april 1928, Meerbeke</p>
              <p>05 maart 2017, Asse</p>
              <p class="condolerenWoonplaats">Woonplaats: Eizeringen</p>

              <div class="condolerenKolomBottomWrapper">
                <div class="condolerenIcons condolerenCondolerenIcon"></div>
                <div class="condolerenIcons condolerenRouwbriefIcon"></div>
                <div class="condolerenIcons condolerenBloemenIcon"></div>
              </div>
          </div>
          <div class="condolerenKolom">
              <div id="condolerenImageVier" class="condolerenImageWrapper">
                
              </div>
              <h1>Jeanneke De Koster</h1>
              <h2>Weduwe van Frans Servranckx</h2>
              <p>09 december 1925, Sint-Martens-Bodegem</p>
              <p>02 maart 2017, Sint-Kwintens-Lennik</p>
              <p class="condolerenWoonplaats">Woonplaats: Eizeringen</p>

              <div class="condolerenKolomBottomWrapper">
                <div class="condolerenIcons condolerenCondolerenIcon"></div>
                <div class="condolerenIcons condolerenRouwbriefIcon"></div>
                <div class="condolerenIcons condolerenBloemenIcon"></div>
              </div>
          </div>
          -->
        </div>

<!-- EINDE CONDOLEREN NORMAAL -->

<!--  CONDOLEREN VORIGE UITVAARTEN -->

        <div id="condolerenVorigeUitvaartenWrapper">
          <div id="condolerenVorigeUitvaartenPijlLinks"></div>

          <div id="condolerenVorigeUitvaartenMainContent">
<!--
            <div class="condolerenVorigeUitvaartenVak condolerenVorigeUitvaartenVakTop">
              <div class="condolerenVorigeUitvaartenFotoContainer"></div>
              <p class="condolerenVorigeUitvaartenNaamContainer">Jeanneke De Koster</p>
            </div>

            <div class="condolerenVorigeUitvaartenVak condolerenVorigeUitvaartenVakTop">
              <div class="condolerenVorigeUitvaartenFotoContainer"></div>
              <p class="condolerenVorigeUitvaartenNaamContainer">Elise DE Braeckeniera</p>
            </div>

            <div class="condolerenVorigeUitvaartenVak condolerenVorigeUitvaartenVakTop">
              <div class="condolerenVorigeUitvaartenFotoContainer"></div>
              <p class="condolerenVorigeUitvaartenNaamContainer">Lutgarde Ots</p>
            </div>

            <div class="condolerenVorigeUitvaartenVak condolerenVorigeUitvaartenVakTop">
              <div class="condolerenVorigeUitvaartenFotoContainer"></div>
              <p class="condolerenVorigeUitvaartenNaamContainer">Isabella De Vriendt</p>
            </div>

            <div class="condolerenVorigeUitvaartenVak condolerenVorigeUitvaartenVakTop">
              <div class="condolerenVorigeUitvaartenFotoContainer"></div>
              <p class="condolerenVorigeUitvaartenNaamContainer"></p>
            </div>

            <div class="condolerenVorigeUitvaartenVak condolerenVorigeUitvaartenVakBottom">
              <div class="condolerenVorigeUitvaartenFotoContainer"></div>
              <p class="condolerenVorigeUitvaartenNaamContainer"></p>
            </div>

            <div class="condolerenVorigeUitvaartenVak condolerenVorigeUitvaartenVakBottom">
              <div class="condolerenVorigeUitvaartenFotoContainer"></div>
              <p class="condolerenVorigeUitvaartenNaamContainer"></p>
            </div>

            <div class="condolerenVorigeUitvaartenVak condolerenVorigeUitvaartenVakBottom">
              <div class="condolerenVorigeUitvaartenFotoContainer"></div>
              <p class="condolerenVorigeUitvaartenNaamContainer"></p>
            </div>

            <div class="condolerenVorigeUitvaartenVak condolerenVorigeUitvaartenVakBottom">
              <div class="condolerenVorigeUitvaartenFotoContainer"></div>
              <p class="condolerenVorigeUitvaartenNaamContainer"></p>
            </div>

            <div class="condolerenVorigeUitvaartenVak condolerenVorigeUitvaartenVakBottom">
              <div class="condolerenVorigeUitvaartenFotoContainer"></div>
              <p class="condolerenVorigeUitvaartenNaamContainer"></p>
            </div>
-->
          </div>

          <div id="condolerenVorigeUitvaartenPijlRechts"></div>


        </div>

<!--  EINDE CONDOLEREN VORIGE UITVAARTEN -->

<!--  CONDOLEREN SELECTED -->
        <div id="condolerenSelectedWrapper">
        
          <div class="condolerenKolom">
              
              <div id="condolerenSelectedImage" class="condolerenImageWrapper"></div>
              <h1 id="condolerenSelectedNaam"></h1>
              <h2 id="condolerenSelectedTitel"></h2>
              <p id="condolerenSelectedGeboortedatum"></p>
              <p id="condolerenSelectedDatumOverlijden"></p>
              <p id="condolerenSelectedWoonplaats" class="condolerenWoonplaats"></p>

              <div class="condolerenKolomBottomWrapper">
                <div id="condolerenSelectedCondolerenIcon" class="condolerenIcons condolerenCondolerenIcon condolerenCondolerenSelectedIcon"></div>
                <a id="condolerenSelectedRouwbriefIconLink"><div id="condolerenSelectedRouwbriefIcon" class="condolerenIcons condolerenRouwbriefIcon"></div></a>
                <div id="condolerenSelectedBloemenIcon" class="condolerenIcons condolerenBloemenIcon"></div>
              </div>
              
          </div>
        
          <div id="condolerenFormWrapper">
             <form id="condolerenForm" action="#" method="get" >
              <h1>Condoleren</h1>
              <fieldset id="condolerenFormLeftWrapper">
                <p>
                  <label for="txtVnaam" class="" id="lblVnaam">Voornaam</label>
                    <input type="text" name="vnaam" id="txtVnaam" class="condolerenFormTextboxes" required>

                </p>
                <p>
                <label for="txtNaam" class="" id="lblNaam">Naam</label>
                  <input type="text" name="naam" id="txtNaam" class="condolerenFormTextboxes" required>
                </p>
                <p>
                <label for="txtTelefoon" class="" id="lblTelefoon">Telefoon</label>
                  <input type="text" name="telefoon" id="txtTelefoon" class="condolerenFormTextboxes">
                </p>
                <p>
                <label for="txtEmail" class="" id="lblEmail">E-mail</label>
                  <input type="text" name="email" id="txtEmail" class="condolerenFormTextboxes" required>
                </p>
              </fieldset>
              
              <fieldset id="condolerenFormRightWrapper">
                <p>
                <label for="txtStraat" class="" id="lblStraat">Straat</label>
                  <input type="text" name="straat" id="txtStraat" class="condolerenFormTextboxes" required>
                </p>
                <p>
                <label for="txtNummer" class="" id="lblNummer">Nummer</label> 
                  <input type="text" name="nummer" id="txtNummer" class="condolerenFormTextboxes" required>
                </p>
                <p>
                <label for="txtPostcode" class="" id="lblPostcode">Postcode</label>
                  <input type="text" name="postcode" id="txtPostcode" class="condolerenFormTextboxes" required>
                </p>
                <p>
                <label for="txtGemeente" class="" id="lblGemeente">Gemeente</label>
                  <input type="text" name="gemeente" id="txtGemeente" class="condolerenFormTextboxes" required>
                </p>
              </fieldset>

              <fieldset id="condolerenFormBottomWrapper">
                <p>
                  <label for="txtaBericht" class="" id="lblBericht">Bericht</label>
                    <textarea name="bericht" id="txtaBericht" required></textarea>
                </p>
              </fieldset>

              <div id="condolerenformButtonWrapper">
                <input type="button" value="Terug" id="condolerenBtnTerug" class="btnTerug">
                <input type="submit" value="Versturen" id="condolerenBtnSubmit" class="btnSubmit">
              </div>
              
            </form>
          </div>

        </div>


      </div>

      <div id="condolerenVorigeUitvaartenButton"></div>
      <div id="condolerenLaatsteUitvaartenButton"></div>
    </section>
<!--  EINDE CONDOLEREN SELECTED -->

<!--                        OVER ONS                       -->
    <section id="overons">
      <div id="overonsContentWrapper">
        <div id="overonsCreadWrapper">
          <div id="creadImageContainer"></div>
          <!--<img src="source/creads/huis-arijs-0448907585_CREAD-01.jpg" alt="cread afbeelding">-->
          <!--<img src="" alt="cread afbeelding" id="creadID">-->

          <div id="overonsCreadPijlenWrapper">
            <div id="overonsPijlLinks" class="overonsPijlen"></div>
            <div id="overonsPijlRechts" class="overonsPijlen"></div>

          </div>
        </div>

        <div id="overonsTekstWrapper">
          <h1>Rouwcentrum en Uitvaartverzorging HUIS ARIJS staat al meer dan 80 jaar borg voor verzorgde en stijlvolle uitvaarten.</h1>

          <p>Wij zijn een familiebedrijf opgericht door de grootouders Jan Arijs en Bertha Elpers, later opgevolgd door de 2 kleinzonen Michel Servranckx en Louis Van Der Plas en bijgestaan door hun echtgenotes Marina Vierendeels en Chris De Backer.</p>

          <p>Als lid van Varu (Vlaamse autonome raad voor uitvaartwezen) en Funebra (Federatie begrafenisondernemers) handelen we volgens een beroepsethiek en waarborgen we vakbekwaamheid en kwaliteit van onze uitvaarten.</p>

          <p>Wij verzorgen uitvaarten in alle cultuur- en geloofsovertuigingen en volgens ieders budget.</p>

          <p>In ons eigen funerarium met aula is er mogelijkheid tot burgerlijke plechtigheden, aangepast aan de persoonlijke wensen.</p>

          <p>Wij verzorgen de uitvaartplechtigheid met eigen personeel en met eigen wagens.</p>

          <h1>Wij zorgen voor een totaal dienstbetoon betreffende:</h1>

          <ul>
            <li>Bespreking van de uitvaart bij u thuis of in ons rouwcentrum</li>
            <li>Overbrenging en opbaring van de overledene in ons funerarium</li>
            <li>Vervullen van alle formaliteiten: aangifte overlijden bij de gemeentelijke diensten, concessie, gemeentelijke taksen, wetsdokter...</li>
            <li>Contact met priester of moreel consulent</li>
            <li>Contact met crematorium en bespreking asbestemming</li>
            <li>Rouwdrukwerk: ruim assortiment rouwbrieven, rouwkaarten, gedachtenisprentjes met of zonder foto</li>
            <li>Vastleggen en bespreking van koffietafel of rouwmaaltijd</li>
            <li>Rouwkapel plaatsen, thuis of in de kerk</li>
            <li>Bloemen: kunstzijde of natuurbloemen</li>
            <li>Krantenberichten</li>
            <li>Balseming/thanathopraxie</li>
            <li>Nationale/Internationale uitvaartregeling</li>
            <li>Voorafregeling van de uitvaart</li>
            <li>In onze uitvaartwinkel is er een ruime keuze aan kisten, urnen, gedenkartikelen, asjuwelen ...</li>
            <li>Informatie betreffende formaliteiten na de uitvaartplechtigheid oa. Successieaangifte</li>
          </ul>


        </div>
      </div>
    </section>

<!--                        CONTACT                       -->
<!--
    <section id="contact">
      <div id="contactContentWrapper">
        <div id="map"></div>

        <div id="contactCenterWrapper">
          <div id="contactCenterTopLeft">
            <div id="adresWrapper"></div>
            <div id="telefoonWrapper"></div>
            <div id="faxWrapper"></div>
          </div>

          <div id="contactCenterTopRight">
            <div id="infoWrapper"></div>
            <div id="qrcodeWrapper"></div>
          </div>

          <div id="openingsurenWrapper"></div>
        </div>

        <div id="contactRightWrapper"></div>
      </div>
    </section>
-->








































<!--                        FOOTER                       -->

    <footer>
      <div id="footerImageWrapper">
        <img src="source/logo/huis-arijs-uitvaartverzorging-logo.png" alt="logo huis arijs">
      </div>
      
      <div id="footerTekstWrapper">
        <span class="footerTekstLinks"><a href="#">Disclaimer</a></span> <span class="footerTekstLinks"><a href="#">Privacy Policy</a></span>
        <span class="footerTekstRechts">| Ontwerp & creatie identitybuilding</span> <span class="footerTekstRechts">+32 2 582 12 91</span> <span class="footerTekstRechts">Terlindestraat 76, 1740 Ternat</span>
        
      </div>
    </footer>
  </div>
  </body>
</html>