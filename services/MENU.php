<div class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <a href="javascript:window.location.href=window.location.href" class="navbar-brand" style="color:<?php echo $kleur ?>;">ATmaker <span class="glyphicon glyphicon-cloud"</span></a>
        <button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <div class="collapse navbar-collapse navHeaderCollapse">
            <ul class="nav navbar-nav navbar-right">
            	<li class="dropdowns">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Overzicht<b class="caret"></b></a>
                    <ul class = "dropdown-menu">
                        <li><a href="klantview.php">Klanten</a></li>
                        <li><a href="catalogusview.php">Catalogi</a></li>
                        <li><a href="accountview.php">Klant account</a></li>
                        <li><a href="accountviewgroep.php">Groep account</a></li>
                        <li><a href="accountviewonline.php">Online account</a></li>
                        <li class="divider"></li>
                        <li><a href="groepview.php">Groepen</a></li>
                        <li><a href="fabrikantenview.php">Fabrikanten</a></li>
                        <li><a href="aangrenzendeview.php">Randgemeentes</a></li>
                        <li><a href="keywords.php?s=A">Keyword Vertalingen</a></li>
                        <li><a href="BANNERS.php">Banners</a></li> 
                        <?php if ($atm== "admin") { ?>
                        <li><a href="gebruikerview.php">Gebruikers</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <li class="dropdowns">
                    <a id="osnnavbar" href="#" class="dropdown-toggle" data-toggle="dropdown">Klant<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="klant.php">Toevoegen</a></li>
                        <li><a href="accounttoevoegen.php">Account</a></li>
                       
                        <?php if ($atm == "admin") { ?>
                        <li class="divider"></li>
                        <li><a href="verkoper.php">Verkoper toevoegen</a></li>
                        <li><a href="#" data-toggle="modal" data-target="#verkoperaanpassenpopup">Verkoper aanpassen</a></li>
                        <!--li><a href="#" data-toggle="modal" data-target="#verkoperverwijderenpopup">Verwijderen</a></li-->
                        <?php } ?>
                    </ul>
                </li>
                <?php if ($atm == "admin") { ?>
                <li class="dropdowns">
                    <a id="eshopnavbar" href="#" class="dropdown-toggle" data-toggle="dropdown">E-shop<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="eshoptoevoegen.php">Toevoegen</a></li>
                    </ul>
                </li>
                <?php } ?>
                <?php if ($atm == "admin" || $atm == "entries") { ?>
                <li class="dropdowns">
                    <a id="catalognavbar" href="#" class="dropdown-toggle" data-toggle="dropdown">Catalogus<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="catalogus.php">Toevoegen</a></li>
                        <?php if ($_SESSION['atmtypelid'] == "admin") { ?>
                        <li><a href="#" data-toggle="modal" data-target="#klikspopup">Kliks optellen</a></li>
                        <?php } ?>
                    </ul>
                </li>
                <?php } ?>
                <?php if ($atm == "admin") { ?>
                <li class="dropdowns">
                    <a id="promonavbar" href="#" class="dropdown-toggle" data-toggle="dropdown">Promo<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="promotoevoegen.php">Toevoegen</a></li>
                    </ul>
                </li>
                <?php } ?>
                <?php if ($atm == "admin") { ?>
                <li class="dropdowns">
                    <a id="kortingnavbar" href="#" class="dropdown-toggle" data-toggle="dropdown">Korting<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="kortingtoevoegen.php">Toevoegen</a></li>
                    </ul>
                </li>
                <?php } ?>
                <?php if ($atm == "admin") { ?>
                <li class="dropdowns">
                    <a id="xclusivnavbar" href="#" class="dropdown-toggle" data-toggle="dropdown">Xclusiv<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="xclusivtoevoegen.php">Toevoegen</a></li>
                    </ul>
                </li>
                <?php } ?><?php if ($atm == "admin") { ?>
                <li class="dropdowns">
                    <a id="adviesnavbar" href="#" class="dropdown-toggle" data-toggle="dropdown">Advies<b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li><a href="adviestoevoegen.php">Toevoegen</a></li>
                    </ul>
                </li>
                <?php } ?>
                <li class="dropdowns">
                        <?php if (isset($_SESSION['atmusername'])) { ?>
                                <a href="afmelden.php" class="dropdown-toggle" style="color:<?php echo $kleur ?>;" data-toggle="dropdown"><?php echo $_SESSION['atmusername']; ?><b class="caret"></b></a>
                        <?php } ?>
                        <ul class="dropdown-menu">
                                <?php if ($atm == "admin") { ?>
                        <li><a href="gebruiker.php">Gebruiker toevoegen</a></li>
                        <?php } ?>
                        <li><a href="afmelden.php">Afmelden</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</div>