$(document).ready(function(){
	// body

	$("#wrapper").click(function() {
		voorzorgBackToDefault();
		boolWilsbeschikkingGeklikt = false;
		boolKeuzebegrafenisGeklikt = false;
		boolVoorafregelingGeklikt = false;
	});

	// ---------------------------------------------------------------------- navigatie

	if($(window).scrollTop() >= $("#banner").height()){
		navScroll();
	}
	else{
		noNavScroll();
	}
    

	$(window).scroll(function(){
		if($(window).scrollTop() >= $("#banner").height()){
			navScroll();
		}
		else{
			noNavScroll();
		}
	})

	function navScroll(){
		$('#headerNav').addClass('fixed').css({
			'top': '0',
			'height': '50px',
			'background-color': '#D3C8B1'
		}).next().css('padding-top', '0');

		$("#navLogo").css({
			'height': "20px",
			'width': "43px",
			"margin-top": "-22.5px",
			'background-image': 'url("source/logo/huis-arijs-logo.png")',
			'background-position': 'center',
			'background-size': 'contain',
			'background-repeat': 'no-repeat'
		});

		$("nav ul li a").css({
			"padding-top": "20px",
			"padding-bottom": "5px",
			"padding-left": "10px",
			"padding-right": "10px",
			"font-size": "15px"
		})

		$("#voorzorg").css("margin-top", "50px");
	}

	function noNavScroll(){
		$('#headerNav').removeClass('fixed').next().css('padding-top','0');
		$("#headerNav").removeAttr("style");
		$("#navLogo").removeAttr("style");
		$("nav ul li a").removeAttr("style");
		$("#voorzorg").css("margin-top", "0px");
		$("#voorzorg").removeAttr("style");
	}

	function getP(){
		var $p = 0;
		if($(document).scrollTop() < $("#banner").height()){
			$p = 100;
		}
		else{
			$p = 0;
		}
		return $p;
	}

	$("#voorzorgLink").click(function() {
		
	    $('html,body').animate({
	        scrollTop: $("#voorzorg").offset().top - getP()},
	        'slow');
	});

	$("#uitvaartwinkelLink").click(function() {
	    $('html,body').animate({
	        scrollTop: $("#uitvaartwinkel").offset().top - getP()},
	        'slow');
	});

	$("#funerariumLink").click(function() {
	    $('html,body').animate({
	        scrollTop: $("#funerarium").offset().top - getP()},
	        'slow');
	});

	$("#condolerenLink").click(function() {
	    $('html,body').animate({
	        scrollTop: $("#condoleren").offset().top - getP()},
	        'slow');
	});

	$("#overonsLink").click(function() {
	    $('html,body').animate({
	        scrollTop: $("#overons").offset().top - getP()},
	        'slow');
	});

	$("#contactLink").click(function() {
	    $('html,body').animate({
	        scrollTop: $("#contact").offset().top - getP()},
	        'slow');
	});

	// ---------------------------------------------------------------------- voorzorg

	function voorzorgBackToDefault() {
		$("#wilsbeschikkingMainContent").removeAttr("style");
		$("#keuzebegrafenisMainContent").removeAttr("style");
		$("#voorafregelingMainContent").removeAttr("style");

		$(".voorzorgAfbeelding").removeAttr("style");
		
		$(".voorzorgTitel").removeAttr("style");		
		
		$(".voorzorgTekst").removeAttr("style");
		$(".voorzorgExtraTekst").removeAttr("style");

		$("#wilsbeschikkingMainContent").attr("data-id", "0");
		$("#keuzebegrafenisMainContent").attr("data-id", "0");
		$("#voorafregelingMainContent").attr("data-id", "0");
	}

	$(".voorzorgMainContent").on("click", function(e){
		var $id = $(this).attr("data-id");

		if($id == 1){
			voorzorgBackToDefault();
		}
		else{
			e.stopPropagation();
			voorzorgBackToDefault();
			$(this).attr("data-id", 1);

			$(this).css({
				"background": "#e5dbc9",
				"background": "-moz-linear-gradient(-30deg,  #e5dbc9 0%, #ccc0a9 100%)",
				"background": "-webkit-linear-gradient(-30deg,  #e5dbc9 0%,#ccc0a9 100%)",
				"background": "linear-gradient(150deg,  #e5dbc9 0%,#ccc0a9 100%)",
				"filter": "progid:DXImageTransform.Microsoft.gradient( startColorstr='#e5dbc9', endColorstr='#ccc0a9',GradientType=1 )"
			});

			$(this).find(".voorzorgAfbeelding").css("display", "none");
			$(this).find(".voorzorgTitel").css('margin-top', '35px');

			$(this).find(".voorzorgExtraTekst").css('display', 'block');
			$(this).find(".voorzorgTekst").css("margin-top", "30px");
		}
	});

	// ---------------------------------------------------------------------- Uitvaartwinkel

	var $arrProductId = [];
	var $totaalProducten;
	var $productAfbeelding = [];
	var $productNaam = [];
	var $productPrijs = [];

	var $uitvaartwinkelCategorie = 1;
	var $beginpuntUitvaartwinkel = 6;
	// $("#uitvaartwinkelMainContentWrapper").css("display", "none");
	$("#kassaWrapper").css("display", "none");

	getProductData($beginpuntUitvaartwinkel, 0, $uitvaartwinkelCategorie);

	$("#uitvaartwinkelGroteAfbeeldingWrapper").css("display", "none");
	$("#uitvaartwinkelWinkelmandOverzichtWrapper").css("display", "none");

	var $rangnummer;

	getCookieAantal();

	$("#toonzaalTekst").css("display", "none");
	$("#uitklappijlNaarBeneden").css("display", "none");
	$("#toonzaalWrapper").css("cursor", "pointer");

	$("#bloemenWrapper").on("click", selectBloemen);
	$("#toonzaalWrapper").on("click", selectToonzaal);

	$(document).on("mouseenter", "#toonzaalWrapper", function(e) {
		if($uitvaartwinkelCategorie == 1){
			$(this).css("background-color", "#CCC0A9");
		}
	});

	$(document).on("mouseleave", "#toonzaalWrapper", function(e) {
		if($uitvaartwinkelCategorie == 1){
			$(this).css("background-color", "#AFA083");
		}
	});

	$(document).on("mouseenter", "#bloemenWrapper", function(e) {
		if($uitvaartwinkelCategorie == 2){
			$(this).css("background-color", "#CCC0A9");
		}
	});

	$(document).on("mouseleave", "#bloemenWrapper", function(e) {
		if($uitvaartwinkelCategorie == 2){
			$(this).css("background-color", "#AFA083");
		}
	});

	function selectBloemen(){
		if(!($uitvaartwinkelCategorie == 1)){
			$uitvaartwinkelCategorie = 1;
			$beginpuntUitvaartwinkel = 6;
			getProductData($beginpuntUitvaartwinkel, 0, $uitvaartwinkelCategorie);

			$("#bloemenTekst").css("display", "block");
			$("#toonzaalTekst").css("display", "none");
			$("#uitklappijlNaarBeneden").css("display", "none");
			
			$("#uitklappijlNaarBoven").css("display", "block");

			$("#bloemenWrapper").animate({height: 437.1}, 250);
			$("#bloemenWrapper").css({
				"cursor": "initial",
				"background-color": "#E0D5C1"
			});

			$("#toonzaalWrapper").animate({height: 88.5}, 250);
			$("#toonzaalWrapper").css({
				"cursor": "pointer",
				"background-color": "#AFA083"
			});
		}
	}

	function selectToonzaal(){
		if(!($uitvaartwinkelCategorie == 2)){
			$uitvaartwinkelCategorie = 2;
			$beginpuntUitvaartwinkel = 6;
			getProductData($beginpuntUitvaartwinkel, 0, $uitvaartwinkelCategorie);

			$("#bloemenTekst").css("display", "none");

			setTimeout(
				function() {
					$("#toonzaalTekst").css("display", "block");
				}, 180);

			$("#uitklappijlNaarBeneden").css("display", "block");
			$("#uitklappijlNaarBoven").css("display", "none");

			$("#bloemenWrapper").animate({height: 88.5}, 250);
			$("#bloemenWrapper").css({
				"cursor": "pointer",
				"background-color": "#AFA083"
			});

			$("#toonzaalWrapper").animate({height: 437.1}, 250);
			$("#toonzaalWrapper").css({
				"cursor": "initial",
				"background-color": "#E0D5C1"
			});

		}
	}

	$("#uitvaartwinkelPijlLinks").on("click", function(){
		getProductData($beginpuntUitvaartwinkel, 0, $uitvaartwinkelCategorie);
	});

	$("#uitvaartwinkelPijlRechts").on("click", function(){
		getProductData($beginpuntUitvaartwinkel, 1, $uitvaartwinkelCategorie);
	});

	//----------- producten constructor

	function getProductData(beginpunt, richting, categorie){
		$.ajax({
			url: "php/indexData.php",
			data: {productData: 'getProductData', beginpunt: beginpunt, richting: richting, categorie: categorie},
			type: 'post',
			dataType: "json",
			success: function(data) {
				$("#contentRechtsWrapper").empty();

				$arrProductId = [];
				$productNaam = [];
				$productPrijs = [];
				
				var $data = data;

				$arrProductId = data.id;
				$productNaam = data.naam;
				$productPrijs = data.prijs;
				$totaalProducten = data.totaalProducten;

				for(i = 0; i < $arrProductId.length; i++){
					$uitvaartwinkelAfbeeldingenContainer = $("<div>", {id: "uitvaartwinkelAfbeeldingenContainer" + (i+1), class: "uitvaartwinkelAfbeeldingenContainer"});
					$uitvaartwinkelAfbeelding = $("<div>", {id: "uitvaartwinkelAfbeelding" + (i+1), "class": "uitvaartwinkelAfbeeldingen", "data-id": i});
					$uitvaartwinkelAfbeeldingTekst = $("<span>", {id: "uitvaartwinkelAfbeeldingTekst" + (i+1), "class": "uitvaartwinkelAfbeeldingenTekst"})

					$uitvaartwinkelAfbeeldingenContainer.appendTo($("#contentRechtsWrapper"));
					$uitvaartwinkelAfbeeldingenContainer.append($uitvaartwinkelAfbeelding);
					$uitvaartwinkelAfbeelding.append($uitvaartwinkelAfbeeldingTekst);

					$uitvaartwinkelAfbeeldingTekst.text($productNaam[i]);
				}

				$beginpuntUitvaartwinkel = data.nieuweBeginPunt;

				getProductAfbeelding($arrProductId);
			}
		});
	}

	function getProductAfbeelding(productId){
		$.ajax({
			url: "php/indexData.php",
			data: {productAfbeelding: 'getProductAfbeelding', Id: productId},
			type: 'post',
			dataType: "json",
			success: function(data) {
				$productAfbeelding = [];
				$productAfbeelding = data;

				for(i = 0; i < $productAfbeelding.length; i++){
					var $containerPointer = i + 1;
					var $container = $("#uitvaartwinkelAfbeelding" + $containerPointer);

					$container.css({
						'background-image': 'url(' + $productAfbeelding[i] + ')',
						'background-position': 'center',
						'background-size': 'cover',
						'background-repeat': 'no-repeat'
					});
				}
			}
		});
	}

	$("#contentRechtsWrapper").on("click", ".uitvaartwinkelAfbeeldingen", function(){
		var $id = $(this).attr("data-id");
		groteAfbeeldingWeergeven($id);
	})

	var $geselecteerdProductId;

	function groteAfbeeldingWeergeven(geselecteerdVak){
  		$rangnummer = parseInt($beginpuntUitvaartwinkel) + (parseInt(geselecteerdVak)+1);

        $geselecteerdProductId = $arrProductId[geselecteerdVak];

		$("#groteAfbeeldingContainer").css({
			'background-image': 'url(' + $productAfbeelding[geselecteerdVak] + ')',
			'background-position': 'center',
			'background-size': 'contain',
			'background-repeat': 'no-repeat'
		});
		$("#txtOrderAantal").val("");
        $("#groteAfbeeldingBeschrijving").text($productNaam[geselecteerdVak] + " - " + $productPrijs[geselecteerdVak] + " euro");

        $("#groteAfbeeldingNummer").text("Afbeelding " + $rangnummer + " van " + $totaalProducten);

        $("#uitvaartwinkelGroteAfbeeldingWrapper").css("display", "block");
        $("#uitvaartwinkelWinkelmandOverzichtWrapper").css("display", "none");
	}

	$("#uitvaartwinkelGroteAfbeeldingSluitenKnopWrapper").on("click", function(){
		$("#txtOrderAantal").val("");
		$("#groteAfbeeldingBeschrijving").val("");
		$("#uitvaartwinkelGroteAfbeeldingWrapper").css("display", "none");
	});

	$("#uitvaartwinkelBtnSubmitOrder").on("click", function(e){
		e.preventDefault();
		$.ajax({
			url: "php/indexData.php",
			data: {cookieSetProduct: 'cookieSetProduct', Id: $geselecteerdProductId, aantal: 1},
			type: 'post',
			dataType: "json",
			success: function(data) {
				$productPrijs = [];
				$productPrijs = data;
				getCookieAantal();
			}
		});
	});

	$("#uitvaartwinkelWinkelmandWrapper").on("mouseenter", function(){
		$(this).css({
			'background-image': 'url(source/icons/winkelmand-hover-icon.png)',
			'background-position': 'center',
			'background-repeat': 'no-repeat'
		})

		$("#uitvaartwinkelWinkelmandAantal").css({
			'background-image': 'url(source/icons/winkelmand-mini-hover-icon.png)',
			'background-position': 'center',
			'background-size': 'contain',
			'background-repeat': 'no-repeat'
		})
	})

	$("#uitvaartwinkelWinkelmandWrapper").on("mouseleave", function(){
		$(this).removeAttr("style");
		$("#uitvaartwinkelWinkelmandAantal").removeAttr("style");
	})

	$("#uitvaartwinkelWinkelmandWrapper").on("click", function(){
		$("#uitvaartwinkelGroteAfbeeldingWrapper").css("display", "none");
		$("#uitvaartwinkelWinkelmandOverzichtWrapper").css("display", "block");
		getWinkelmandData();
	});

	$("#uitvaartwinkelWinkelmandOverzichtSluitenKnopWrapper").on("click", function(){
		$("#uitvaartwinkelWinkelmandOverzichtWrapper").css("display", "none");
	});

	function getCookieAantal(){
		$.ajax({
			url: "php/indexData.php",
			data: {getCookieAantal: 'getCookieAantal'},
			type: 'post',
			dataType: "json",
			success: function(data) {
				var $winkelmandAantal = data;
				var $uitvaartwinkelWinkelmandAantal = $("#uitvaartwinkelWinkelmandAantal");
				$uitvaartwinkelWinkelmandAantal.text($winkelmandAantal);
			}
		});
	}

	function getWinkelmandData(){
		$.ajax({
			url: "php/indexData.php",
			data: {winkelmandData: 'getWinkelmandData'},
			type: 'post',
			dataType: "json",
			success: function(data) {
				$('#uitvaartwinkelWinkelmandOverzichtToegevoegdeProducten').empty();
				if(data.id && data.id.length > 0){
					for(i = 0; i < data.id.length; i++){
						$productenGroep = $("<div>", {id: "productenGroep"+ i, "class": "productenGroep", "data-id": data.id[i]});
						$productenGroepAfbeeldingContainer = $("<div>", {id: "productenGroepAfbeeldingContainer"+ i, "class": "productenGroepAfbeeldingContainer"});
						$productenGroepTekstContainer = $("<div>", {id: "productenGroepTekstContainer"+ i, "class": "productenGroepTekstContainer"});
						$productenGroepBeschrijvingContainer = $("<div>", {id: "productenGroepBeschrijvingContainer"+ i, "class": "productenGroepBeschrijvingContainer"});
						$productenGroepBeschrijving = $("<p>", {id: "productenGroepBeschrijving"+ i, "class": "productenGroepBeschrijving"});
						$productenGroepPrijsContainer = $("<div>", {id: "productenGroepPrijsContainer"+ i, "class": "productenGroepPrijsContainer"});
						$productenGroepPrijs = $("<p>", {id: "productenGroepPrijs"+i, "class": "productenGroepPrijs"});
						$selectieVerwijderenWrapper = $("<div>", {id: "selectieVerwijderenWrapper"+ i, "class": "selectieVerwijderenWrapper", "data-id": data.id[i]});
						$selectieVerwijderenContainer = $("<div>", {id: "selectieVerwijderenContainer"+ i, "class": "selectieVerwijderenContainer", "data-id": data.id[i]});
						$prullenbakIcon = $("<img>", {class: "prullenbakIcon", src: "source/icons/prullenbak-button.png", alt: "prullenbak icon", title: "Selectie verwijderen"})

						$productenGroep.appendTo($("#uitvaartwinkelWinkelmandOverzichtToegevoegdeProducten"));
						$productenGroep.append($productenGroepAfbeeldingContainer);
						$productenGroep.append($productenGroepTekstContainer);
						$productenGroepTekstContainer.append($productenGroepBeschrijvingContainer);
						$productenGroepBeschrijvingContainer.append($productenGroepBeschrijving);
						$productenGroepTekstContainer.append($productenGroepPrijsContainer);
						$productenGroepPrijsContainer.append($productenGroepPrijs);
						$productenGroepTekstContainer.append($selectieVerwijderenWrapper);
						$selectieVerwijderenWrapper.append($selectieVerwijderenContainer);
						$selectieVerwijderenContainer.append($prullenbakIcon);

						$("#productenGroepBeschrijving" + i).text(data.naam[i]);

						$("#productenGroepPrijs" + i).text(data.prijs[i]);
					}

					getWinkelmandAfbeelding(data.id);
				}
				else{
					$winkelmandLeeg = $("<p>");
					$winkelmandLeeg.text("Uw winkelmand is leeg.");
					$winkelmandLeeg.appendTo($("#uitvaartwinkelWinkelmandOverzichtToegevoegdeProducten"));
				}
			}
		});
	}

	$(document).on("mouseenter", ".selectieVerwijderenContainer", function(e) {
	    $(this).find('img').attr('src', 'source/icons/prullenbak-hover-button.png');
	});

	$(document).on("mouseleave", ".selectieVerwijderenContainer", function(e) {
	    $(this).find('img').attr('src', 'source/icons/prullenbak-button.png');
	});

	function getWinkelmandAfbeelding(productId){
		$.ajax({
			url: "php/indexData.php",
			data: {productAfbeelding: 'getProductAfbeelding', Id: productId},
			type: 'post',
			dataType: "json",
			success: function(data) {
				for(i = 0; i < data.length; i++){
					var $container = $("#productenGroepAfbeeldingContainer" + i);
					$container.css({
						'background-image': 'url(' + data[i] + ')',
						'background-position': 'center',
						'background-size': 'cover',
						'background-repeat': 'no-repeat'
					});
				}
			}
		});
	}
	
	$("#uitvaartwinkelWinkelmandOverzichtWrapper").on("click", ".selectieVerwijderenContainer", function(e){
		var $id = $(this).attr("data-id");
		var $productenGroep = $(".productenGroep[data-id='" + $id + "']");

		verwijderItemUitWinkelmand($id);
    });

    function verwijderItemUitWinkelmand(productId){
    	$.ajax({
			url: "php/indexData.php",
			data: {cookieRemoveProduct: 'cookieRemoveProduct', Id: productId},
			type: 'post',
			dataType: "json",
			success: function(data) {
				// console.log(data);
				getWinkelmandData();
				getCookieAantal();
			}
		});
    }

    $("#uitvaartwinkelBtnNaarKassa").on("click", function(e){
    	e.preventDefault();

    	$.post("php/indexData.php",{getCookieAantal:"getCookieAantal"}, gaNaarKassa);
		
    })

    function gaNaarKassa(data){
    	if(data > 0){
    		$("#uitvaartwinkelMainContentWrapper").css("display", "none");
    		$("#uitvaartwinkelWinkelmandOverzichtWrapper").css("display", "none");
    		
			$("#kassaWrapper").css("display", "block");
			toonBestellingOverzicht();

			bestellingenProductInvullen();
    	}
	}

	var totaalPrijzen = [];
	var verzendKosten = 0;
	var totaal = 0;

	function bestellingenProductInvullen(){
		//console.log($data);
		totaalPrijzen = [];
		$("#bestellingenProductWrappersContainer").empty();
		$("#bestellingenSubtotaalContainer span").empty();
		$("#bestellingenVerzendingContainer span").empty();
		$("#bestellingenTotaalContainer span").empty();

		$.post("php/indexData.php",{winkelmandData:"winkelmandData"}, function(data){
			var $data = JSON.parse(data);
			$.post("php/indexData.php",{productAfbeelding:"productAfbeelding", Id: $data.id}, function(d){
				$afbeeldingenData = JSON.parse(d);

				for(i = 0; i < $data.id.length; i++){
				$bestellingenProductWrapper = $("<div>", {class: "bestellingenProductWrapper"});

				$helper = $("<span>", {class: "helper"});

				$bestellingenProductAfbeeldingContainer = $("<div>", {class: "bestellingenProductAfbeeldingContainer"});
				//helper
				// $afbeeldingSource = $("<img>", {src: $afbeeldingenData[i]});
				
				$bestellingenProductBeschrijvingContainer = $("<div>", {class: "bestellingenProductBeschrijvingContainer bestellingenProductElements"});
				//helper
				// $naam = $("<span>");

				$bestellingenProductPrijsContainer = $("<div>", {class: "bestellingenProductPrijsContainer bestellingenProductElements"});
				//helper
				// $prijs = $("<span>");

				$bestellingenProductAantalContainer = $("<div>", {class: "bestellingenProductAantalContainer bestellingenProductElements"});
				//helper
				// $bestellingenProductAantal = $("<input>", {type: "text", name: "aantal", class: "bestellingenProductAantal"});

				$bestellingenProductTotaalPrijsContainer = $("<div>", {class: "bestellingenProductTotaalPrijsContainer bestellingenProductElements"});
				//helper
				// $totaalPrijs = $("<span>");

				$("#bestellingenProductWrappersContainer").append($bestellingenProductWrapper);

				$bestellingenProductWrapper.append($bestellingenProductAfbeeldingContainer);
				$bestellingenProductWrapper.append($bestellingenProductBeschrijvingContainer);
				$bestellingenProductWrapper.append($bestellingenProductPrijsContainer);
				$bestellingenProductWrapper.append($bestellingenProductAantalContainer);
				$bestellingenProductWrapper.append($bestellingenProductTotaalPrijsContainer);

				$bestellingenProductAfbeeldingContainer.append($("<span>", {class: "helper"}));
				$bestellingenProductAfbeeldingContainer.append($("<img>", {src: $afbeeldingenData[i]}));

				$bestellingenProductBeschrijvingContainer.append($("<span>", {class: "helper"}));
				$bestellingenProductBeschrijvingContainer.append($("<span>").text($data.naam[i]));

				$bestellingenProductPrijsContainer.append($("<span>", {class: "helper"}));
				$bestellingenProductPrijsContainer.append($("<span>").text($data.prijs[i]));

				$bestellingenProductAantalContainer.append($("<span>", {class: "helper"}));
				$bestellingenProductAantalContainer.append($("<input>", {type: "text", name: "aantal", class: "bestellingenProductAantal", value: $data.aantal[i], "data-id": $data.id[i]}));
				$bestellingenProductAantalContainer.append($("<div>", {class: "bestellingenAantalBevestigen", "data-id": $data.id[i]}));

				$bestellingenProductTotaalPrijsContainer.append($("<span>", {class: "helper"}));
				$bestellingenProductTotaalPrijsContainer.append($("<span>").text($data.prijs[i] * $data.aantal[i]));

				totaalPrijzen.push($data.prijs[i] * $data.aantal[i]);
			}
			var subTotaal = 0;
			for (var i = 0; i < totaalPrijzen.length; i++) {
			    subTotaal += totaalPrijzen[i] << 0;
			}
			totaal = subTotaal + verzendKosten;


			$("#bestellingenSubtotaalContainer span").text(subTotaal);
			$("#bestellingenVerzendingContainer span").text(verzendKosten);
			$("#bestellingenTotaalContainer span").text(totaal);
			});
		});
	}

	$("#bestellingenProductWrappersContainer").on("click", ".bestellingenAantalBevestigen", function(){
		var $id = $(this).attr("data-id");
		var $aantal = $(".bestellingenProductAantal[data-id=" + $id + "]");
		// console.log($aantal.val());

		$.post("php/indexData.php", {setCookieAantal: "setCookieAantal", id: $id, aantal: $aantal.val()}, bestellingenProductInvullen);
	})




	$("#bestellingOverzichtBtnTerug").on("click", function(){
		$("#uitvaartwinkelMainContentWrapper").css("display", "block");
		clearKassa();
		$("#kassaWrapper").css("display", "none");
	})

	$("#bestellingOverzichtBtnSubmit").on("click", function(){
		toonBetaalmethode();
	})




	$("#betaalMethodeBtnTerug").on("click", function(){
		toonBestellingOverzicht();
	})

	$("#betaalMethodeBtnSubmit").on("click", function(e){
		e.preventDefault();
		var valideer = valideerBetaalmethode();
		var checkFactuur = false;
		var errBetaalmethode = "Selecteer een betaalmethode a.u.b.";
		if($("#chkFactuur").is(":checked")){
			checkFactuur = true;
		}
		else{
			checkFactuur = false;
		}

		if(valideer){
			$.post("php/indexData.php", {valideerBetaalmethode: "valideerBetaalmethode", valideer: valideer, checkFactuur: checkFactuur}, function(data){
				if(JSON.parse(data)){
					toonGegevens(checkFactuur);
				}
				else{
					alert(errBetaalmethode);
				}
			});
		}
		else{
			alert(errBetaalmethode);
		}
		
	})

	$("#gegevensBtnTerug").on("click", function(){
		toonBetaalmethode();
	})

	// $("#gegevensBtnSubmit").on("click", function(e){
	// 	e.preventDefault();
	// 	// $("#uitvaartwinkelMainContentWrapper").css("display", "block");
	// 	// clearKassa();
	// 	// $("#kassaWrapper").css("display", "none");
	// })

	var $gegevensForm = $("#gegevensForm");

	$gegevensForm.on("submit", function(e){
		e.preventDefault();
		
		// var $arrGegevens = [];

		var $isValid = true;

		var $gegevensTitelSelect = $("#gegevensTitelSelect").val();

		var $isBedrijf = false;

		if($("input[name='bedrijf'").attr("data-id") == 1 && $("input[name='btwnummer'").attr("data-id") == 1){
			$isBedrijf = true;
		}

		if($gegevensTitelSelect != ""){
			if(!($gegevensTitelSelect == "m" || $gegevensTitelSelect == "v")){
				$isValid = false;
			}
			else{
				// $arrGegevens.push({"titel": $gegevensTitelSelect});
			}
		}
		else{
			$isValid = false;
		}

		$("#gegevensForm input").each(function() {
			// && !(this.name === "bedrijf") && !(this.name === "btwnummer")
			if($(this).val() === "" /*&& !(this.name === "telefoon")*/ && $(this).attr("data-id") == 1){
				// alert("Vul a.u.b. alle vereiste velden in.");
				$(this).css({"border-color": "red"});
				$isValid = false;
			}
			else{
				$(this).css({"border-color": ""});
				
			}
		});

		var currentTime = new Date();

		if($isValid == true){
			$("#gegevensForm input").each(function() {
				switch(this.name){
					case "voornaam":
						// if(!$(this).val().match(/^[a-zA-Z]$/)){
						// 	alert("Geen geldige voornaam!");
						// 	$isValid = false;
						// }
						// $arrGegevens.push({"voornaam": $(this).val()});
						break;
					case "familienaam":
						// if(!$(this).val().match(/^[a-zA-Z]$/)){
						// 	console.log("Geen geldige familienaam!");
						// 	$isValid = false;
						// }
						// $arrGegevens.push({"familienaam": $(this).val()});
						break;
					case "telefoon":
						if($(this).val().length > 0){
							if(!$(this).val().replace(/ /g,'').match(/^[0-9]{9,10}$/)){
								console.log("Geen geldige telefoonnummer!");
								$(this).css({"border-color": "red"});
								$isValid = false;
							}
							else{
								// $arrGegevens.push({"telefoon": $(this).val()});
								$(this).css({"border-color": ""});
							}
						}
						break;
					case "email":
						// if($(this).val().length > 0){
							if(!$(this).val().replace(/ /g,'').match(/^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i) || $(this).val().indexOf(" ") >= 0){
								console.log("Geen geldige e-mail adres!");
								$(this).css({"border-color": "red"});
								$isValid = false;
							}
							else{
								// $arrGegevens.push({"email": $(this).val()});
								$(this).css({"border-color": ""});
							}
						// }
						
						break;
					case "straat":
						// $arrGegevens.push({"straat": $(this).val()});
						break;
					case "postcode":
						// if($(this).val().length > 0){
							if(!$(this).val().match(/^[1-9]{1}[0-9]{3}$/)){
								console.log("Geen geldige postcode!");
								$(this).css({"border-color": "red"});
								$isValid = false;
							}
							else{
								// $arrGegevens.push({"postcode": $(this).val()});
								$(this).css({"border-color": ""});
							}
						// }
						break;
					case "gemeente":
						// $arrGegevens.push({"gemeente": $(this).val()});
						break;
					case "nummer":
						// $arrGegevens.push({"nummer": $(this).val()});
						break;
					case "bedrijf":
						if($(this).attr("data-id") == 1){
							if($(this).val().length > 0){
								// $arrGegevens.push({"bedrijf": $(this).val()});
							}
						}
						break;
					case "btwnummer":
						if($(this).attr("data-id") == 1){
							if($(this).val().length > 0){
								// $arrGegevens.push({"btwnummer": $(this).val()});
							}
						}
						break;
					case "tekstLintKaart":
						// $arrGegevens.push({"tekstLintKaart": $(this).val()});
						break;
					case "datumBegrafenis":
						if($(this).val().length > 0){
							if($(this).val().replace(/ /g,'').match(/^(\d{1,2})[-\/.](\d{1,2})[-\/.](\d{4})$/)){
								// var $waarde = $(this).val().replace(/[-\/.]/g, "/");
								var $deDatum = $(this).val().replace(/ /g,'').split(/[-\/.]/g);
								// console.log($deDatum);
								// $dag = $(this).toString().substring(0, 2);
								// $maand = $(this).toString().substring(3, 2);
								// $jaar = $(this).toString().substring(6, 4);

								if($deDatum[0] < 0 || $deDatum[1] < 0 || $deDatum[1] > 12 || $deDatum[2] > currentTime.getFullYear()){
									$isValid = false;
								}
								
								if($isValid){
									var $extraNul = "";

									if($deDatum[1].length < 2){
										$extraNul = "";
									}
									else{
										$extraNul = "0";
									}

									// console.log($deDatum[1] + " en " + $extraNul + "1");

									switch($deDatum[1]){
										case $extraNul + "1":
											if($deDatum[0] > 31){
												$(this).css({"border-color": "red"});
												$isValid = false;
											}
											else{
												// $arrGegevens.push({"datumBegrafenis": $("input[name='datumBegrafenis']").val()});
												$(this).css({"border-color": ""});
											}
											break;
										case $extraNul + "2":
											if((($deDatum[2] % 4 == 0) && ($deDatum[2] % 100 != 0)) || ($deDatum[2] % 400 == 0)){
												if($deDatum[0] > 29){
													$(this).css({"border-color": "red"});
													$isValid = false;
												}
												else{
													// $arrGegevens.push({"datumBegrafenis": $("input[name='datumBegrafenis']").val()});
													$(this).css({"border-color": ""});
												}
											}
											else if($deDatum[0] > 28){
												$(this).css({"border-color": "red"});
												$isValid = false;
											}
											else{
												// $arrGegevens.push({"datumBegrafenis": $("input[name='datumBegrafenis']").val()});
												$(this).css({"border-color": ""});
											}
											break;
										case $extraNul + "3":
											if($deDatum[0] > 31){
												$(this).css({"border-color": "red"});
												$isValid = false;
											}
											else{
												// $arrGegevens.push({"datumBegrafenis": $("input[name='datumBegrafenis']").val()});
												$(this).css({"border-color": ""});
											}
											break;
										case $extraNul + "4":
											if($deDatum[0] > 30){
												$(this).css({"border-color": "red"});
												$isValid = false;
											}
											else{
												// $arrGegevens.push({"datumBegrafenis": $("input[name='datumBegrafenis']").val()});
												$(this).css({"border-color": ""});
											}
											break;
										case $extraNul + "5":
											if($deDatum[0] > 31){
												$(this).css({"border-color": "red"});
												$isValid = false;
											}
											else{
												// $arrGegevens.push({"datumBegrafenis": $("input[name='datumBegrafenis']").val()});
												$(this).css({"border-color": ""});
											}
											break;
										case $extraNul + "6":
											if($deDatum[0] > 30){
												$(this).css({"border-color": "red"});
												$isValid = false;
											}
											else{
												// $arrGegevens.push({"datumBegrafenis": $("input[name='datumBegrafenis']").val()});
												$(this).css({"border-color": ""});
											}
											break;
										case $extraNul + "7":
											if($deDatum[0] > 31){
												$(this).css({"border-color": "red"});
												$isValid = false;
											}
											else{
												// $arrGegevens.push({"datumBegrafenis": $("input[name='datumBegrafenis']").val()});
												$(this).css({"border-color": ""});
											}
											break;
										case $extraNul + "8":
											if($deDatum[0] > 31){
												$(this).css({"border-color": "red"});
												$isValid = false;
											}
											else{
												// $arrGegevens.push({"datumBegrafenis": $("input[name='datumBegrafenis']").val()});
												$(this).css({"border-color": ""});
											}
											break;
										case $extraNul + "9":
											if($deDatum[0] > 30){
												$(this).css({"border-color": "red"});
												$isValid = false;
											}
											else{
												// $arrGegevens.push({"datumBegrafenis": $("input[name='datumBegrafenis']").val()});
												$(this).css({"border-color": ""});
											}
											break;
										case "10":
											if($deDatum[0] > 31){
												$(this).css({"border-color": "red"});
												$isValid = false;
											}
											else{
												// $arrGegevens.push({"datumBegrafenis": $("input[name='datumBegrafenis']").val()});
												$(this).css({"border-color": ""});
											}
											break;
										case "11":
											if($deDatum[0] > 30){
												$(this).css({"border-color": "red"});
												$isValid = false;
											}
											else{
												// $arrGegevens.push({"datumBegrafenis": $("input[name='datumBegrafenis']").val()});
												$(this).css({"border-color": ""});
											}
											break;
										case "12":
											if($deDatum[0] > 31){
												$(this).css({"border-color": "red"});
												$isValid = false;
											}
											else{
												// $arrGegevens.push({"datumBegrafenis": $("input[name='datumBegrafenis']").val()});
												$(this).css({"border-color": ""});
											}
											break;
									}
								}
							}
							else{
								console.log("Geen geldige begrafenis datum!");
								$isValid = false;
							}
						}
						break;
					case "naamOverledene":
						// $arrGegevens.push({"naamOverledene": $(this).val()});
						break;
				}
			});
		}

		var $deArray = $gegevensForm.serializeArray();

		if($isValid){

			$.post("php/indexData.php", {valideerGegevens: "valideerGegevens", arrGegevens: $deArray, isBedrijf: $isBedrijf}, function(data){
				console.log(data);
				var $data = JSON.parse(data);
				if($data == true || $data == false){
					console.log($data);
				}
				else{
					// alert("Er is een fout opgetreden, kijk uw gegevens na en probeer het opnieuw.");
				}
			});

			// console.log($deArray);
		}

		// console.log($arrGegevens);

		// console.log("Is valid: " + $isValid);
		// console.log(currentTime.getFullYear());
	})


	// $form1.on('submit', function(e){
	// 	e.preventDefault();

	// 	var $geldigFormulier = true;

	// 	$(":input").each(function() {
	// 		if($(this).val() === "" && !this.name === "telefoon"){
	// 			console.log("Vul a.u.b. alle vereiste velden in.");
	// 			$geldigFormulier = false;
	// 		}
	// 		else{
	// 			switch(this.name){
	// 				case "vnaam":
	// 					if(!$(this).val().match(/^[a-zA-Z]$/)){
	// 						console.log("Geen geldige voornaam!");
	// 					}
	// 					break;
	// 				case "naam":
	// 					if(!$(this).val().match(/^[a-zA-Z]$/)){
	// 						console.log("Geen geldige naam!");
	// 					}
	// 					break;
	// 				case "telefoon":
	// 					var $telefoonWaarde = $(this).val();

	// 					//$telefoonWaarde = $(this)
	// 					if($telefoonWaarde != ""){
	// 						if(!($telefoonWaarde.match(/^[0-9]{9,10}$/))){
	// 							console.log("Geen geldige telefoonnummer!");
	// 						}
	// 					}


	// 					// $telefoonWaarde.replace(/\s/g, "").onblur = function(){
	// 			  //           //[+32]?
	// 			  //           if(/^[0-9]{9,10}$/.test(t.value)){
	// 			  //               console.log("correct");
	// 			  //           }
	// 			  //       }
	// 					break;
	// 				case "email":
	// 					// if(!$(this).val().match('^ $')){
	// 					// 	console.log("Geen geldige email!");
	// 					// }
	// 					break;
	// 				case "straat":
	// 					break;
	// 				case "postcode":
	// 					break;
	// 				case "gemeente":
	// 					break;
	// 			}
	// 		}
	// 	});
		
	// })














































	$("#kassaNav ul li a").on("click", function(e){
		e.preventDefault();
	})

	function clearKassa(){
		$("#bestellingOverzichtWrapper").css("display", "none");
		$("#betaalmethodeWrapper").css("display", "none");
		$("#gegevensWrapper").css("display", "none");
		$("#kassaNav ul li a").css("text-decoration", "none");
	}

	function toonBestellingOverzicht(){
		clearKassa();
		$("#bestellingOverzichtWrapper").css("display", "block");		
		$("#kassaNavBestellingOverzicht").css("text-decoration", "underline");
	}

	function toonBetaalmethode(){
		clearKassa();
		$("#betaalmethodeWrapper").css("display", "block");		
		$("#kassaNavBetaalmethode").css("text-decoration", "underline");
	}

	function toonGegevens($f){
		clearKassa();
		$("#gegevensWrapper").css("display", "block");		
		$("#kassaNavGegevens").css("text-decoration", "underline");
		var $lblBedrijf = $("#lblBedrijf");
		var $lblBtwnummer = $("#lblBtwnummer");
		var $txtBedrijf = $("input[name='bedrijf']");
		var $txtBtwnummer = $("input[name='btwnummer']");
		if($f){
			$lblBedrijf.text("Bedrijf *");
			$txtBedrijf.attr("data-id", 1);
			$txtBedrijf.prop("disabled", false);
			$lblBtwnummer.text("BTW nummer *");
			$txtBtwnummer.attr("data-id", 1);
			$txtBtwnummer.prop("disabled", false);
		}
		else{
			$lblBedrijf.text("Bedrijf");
			$txtBedrijf.attr("data-id", 0).removeAttr('style');
			$txtBedrijf.prop("disabled", true);
			$txtBedrijf.val('');
			$lblBtwnummer.text("BTW nummer");
			$txtBtwnummer.attr("data-id", 0).removeAttr('style');
			$txtBtwnummer.prop("disabled", true);
			$txtBtwnummer.val('');
		}
	}

	function valideerBetaalmethode(){
		var radio = $(".betaalmethodeOptions[name=betaalmethode]");
	    var formValid = false;
	    var waarde;

	    var i = 0;
	    while (!formValid && i < radio.length) {
	        if (radio[i].checked) formValid = true;
	        i++;        
	    }

	    if(formValid == false){
	    	waarde = false;
	    }
	    else{
	    	waarde = $(".betaalmethodeOptions[name=betaalmethode]:checked").val();
	    }

	    return waarde;
	}


	// ---------------------------------------------------------------------- funerarium en aula
	var $beginpuntFunerariumenaula = -4;
	var $arrFunerariumAfbeeldingen = [];

	var $funerariumKolomTitel1 = $("#funerariumKolomTitel1");
	var $funerariumKolomTitel2 = $("#funerariumKolomTitel2");
	var $funerariumKolomTitel3 = $("#funerariumKolomTitel3");
	var $funerariumKolomTitel4 = $("#funerariumKolomTitel4");

	var $funerariumAfbeelding1 = $("#funerariumAfbeeldingContainer1");
	var $funerariumAfbeelding2 = $("#funerariumAfbeeldingContainer2");
	var $funerariumAfbeelding3 = $("#funerariumAfbeeldingContainer3");
	var $funerariumAfbeelding4 = $("#funerariumAfbeeldingContainer4");

	$("#funerariumPijlLinks").on("click", function(){
		setFunerariumData($beginpuntFunerariumenaula, 0);
	});

	$("#funerariumPijlRechts").on("click", function(){
		setFunerariumData($beginpuntFunerariumenaula, 1);
		// $("#funerariumWrapper").hide();
		// $("#funerariumWrapper").slideDown('slow');
	});

	setFunerariumData($beginpuntFunerariumenaula, 1);

	function setFunerariumData(b, r){
		$.ajax({
			url: 'php/indexData.php',
			data: {funerariumTitel: 'getFunerariumtitels', richting: r, beginpunt: b},
			type: 'post',
			dataType: "json",
			success: function(output) {
				$beginpuntFunerariumenaula = output.nieuweBeginPunt;

				$funerariumKolomTitel1.html('');
				$funerariumKolomTitel2.html('');
				$funerariumKolomTitel3.html('');
				$funerariumKolomTitel4.html('');
				$funerariumKolomTitel1.append(output.titel[0]);
				$funerariumKolomTitel2.append(output.titel[1]);
				$funerariumKolomTitel3.append(output.titel[2]);
				$funerariumKolomTitel4.append(output.titel[3]);

				setFunerariumAfbeeldingen(output.id);
			}
		});
	}

	function setFunerariumAfbeeldingen(arrFunerariumId){
		$.ajax({
			url: 'php/indexData.php',
			data: {funerariumAfbeelding: 'getFunerariumAfbeeldingen', arrFunerariumId: arrFunerariumId},
			type: 'post',
			dataType: "json",
			success: function(output) {
				$arrFunerariumAfbeeldingen = [];

				for(i = 0; i < output.length; i++){
					$arrFunerariumAfbeeldingen[i] = output[i];
				}

				$funerariumAfbeelding1.css({
					'background-image': 'url(' + output[0] + ')',
					'background-position': 'center',
					'background-size': 'cover'
				});

				$funerariumAfbeelding2.css({
					'background-image': 'url(' + output[1] + ')',
					'background-position': 'center',
					'background-size': 'cover'
				});

				$funerariumAfbeelding3.css({
					'background-image': 'url(' + output[2] + ')',
					'background-position': 'center',
					'background-size': 'cover'
				});

				$funerariumAfbeelding4.css({
					'background-image': 'url(' + output[3] + ')',
					'background-position': 'center',
					'background-size': 'cover'
				});				
			}
		});
	}

	// ---------------------------------------------------------------------- Condoleren

	condolerenHideElements();
	$("#condolerenNormaalWrapper").css("display", "block");
	$("#condolerenVorigeUitvaartenButton").css("display", "inline-block");

	getLaatsteOverledeneData();
	var arrRouwbrieven = [];
	var arrOverledeneId = [];
	var arrCondolerenFoto = [];
	var arrCondolerenNaam = [];
	var arrCondolerenTitel = [];
	var arrCondolerenGeboortedatum = [];
	var arrCondolerenDatumOverlijden = [];
	var arrCondolerenWoonplaats = [];
	var arrCondolerenRouwbrief = [];

	var $offsetStandaardWaarde = -10;
	var $offsetOverledeneData = $offsetStandaardWaarde;

	$("#condolerenVorigeUitvaartenPijlLinks").on("click", function(){
		getOverledeneData($offsetOverledeneData, 0);
	})

	$("#condolerenVorigeUitvaartenPijlRechts").on("click", function(){
		getOverledeneData($offsetOverledeneData, 1);
	})

	function getOverledeneData($offset, $richting){
		$.ajax({
			url: 'php/indexData.php',
			data: {overledeneData: 'getOverledeneData', offset: $offset, richting: $richting},
			type: 'post',
			dataType: "json",
			success: function(data) {
				$("#condolerenVorigeUitvaartenMainContent").empty();

				arrOverledeneId = [];
				arrCondolerenNaam = [];
				arrCondolerenTitel = [];
				arrCondolerenGeboortedatum = [];
				arrCondolerenDatumOverlijden = [];
				arrCondolerenWoonplaats = [];
				arrCondolerenRouwbrief = [];

				for(i = 0; i < data.id.length; i++){
					$condolerenVorigeUitvaartenVak = $("<div>", {"class": "condolerenVorigeUitvaartenVak condolerenVorigeUitvaartenVakTop"});

					$condolerenVorigeUitvaartenFotoContainer = $("<div>", {id: "condolerenVorigeUitvaartenFotoContainer"+ i, "class": "condolerenVorigeUitvaartenFotoContainer"});
					$pNaam = $("<p>", {"class": "condolerenVorigeUitvaartenNaamContainer", "data-id": i});

					$condolerenVorigeUitvaartenVak.appendTo($("#condolerenVorigeUitvaartenMainContent"));
					$condolerenVorigeUitvaartenVak.append($condolerenVorigeUitvaartenFotoContainer);
					$condolerenVorigeUitvaartenVak.append($pNaam);

					$pNaam.empty();
					$pNaam.html(data.naam[i]);

					arrOverledeneId[i] = data.id[i];
					arrCondolerenNaam[i] = data.naam[i];
					arrCondolerenTitel[i] = data.titel[i];
					arrCondolerenGeboortedatum[i] = data.geboortedatum[i] + ", " + data.geboorteplaats[i];
					arrCondolerenDatumOverlijden[i] = data.datumOverlijden[i] + ", " + data.plaatsOverlijden[i];
					arrCondolerenWoonplaats[i] = "Woonplaats: " + data.woonplaats[i];
					arrCondolerenRouwbrief[i] = "source/afbeeldingen/condoleren/rouwbrief/" + data.rouwbrief[i];
				}

				$offsetOverledeneData = data.nieuweOffset;

				getOverledeneFoto(arrOverledeneId);
			}
		});
	}

	function getOverledeneFoto(arrOverledeneId){
		$.ajax({
			url: 'php/indexData.php',
			data: {overledeneFoto: 'getOverledeneFoto', arrOverledeneId: arrOverledeneId},
			type: 'post',
			dataType: "json",
			success: function(data) {
				arrCondolerenFoto = [];
				for(i = 0; i < data.length; i++){
					if(data[i] == "data:image/jpeg;base64,"){
						arrCondolerenFoto[i] = "source/afbeeldingen/condoleren/condoleren_huis_arijs_logo.png";
						$("#condolerenVorigeUitvaartenFotoContainer"+ i).css({
							'background-image': 'url(' + arrCondolerenFoto[i] + ')',
							'background-position': 'center',

							'background-size': 'contain',
							'background-repeat': 'no-repeat'
						});
					}
					else{
						$("#condolerenVorigeUitvaartenFotoContainer"+ i).css({
							'background-image': 'url(' + data[i] + ')',
							'background-position': 'center',

							'background-size': 'cover',
							'background-repeat': 'no-repeat'
						});
						arrCondolerenFoto[i] = data[i];
					}
				}
			}
		})
	}

	function getLaatsteOverledeneData(){
		$.ajax({
			url: 'php/indexData.php',
			data: {laatsteOverledeneData: 'getLaatsteOverledeneData'},
			type: 'post',
			dataType: "json",
			success: function(data) {
				$("#condolerenNormaalWrapper").empty();

				arrCondolerenNaam = [];
				arrCondolerenTitel = [];
				arrCondolerenGeboortedatum = [];
				arrCondolerenDatumOverlijden = [];
				arrCondolerenWoonplaats = [];
				arrCondolerenRouwbrief = [];

				for(i = 0; i < 4; i++){
					$condolerenKolom = $("<div>", {"class": "condolerenKolom", "data-id": i});

					$condolerenImageWrapper = $("<div>", {id: "condolerenImage"+ i, "class": "condolerenImageWrapper"});
					$h1Naam = $("<h1>");
					$h2Titel = $("<h2>");
					$pGeboorte = $("<p>");
					$pOverlijden = $("<p>");
					$pWoonplaats = $("<p>", {"class": "condolerenWoonplaats"});

					$condolerenKolomBottomWrapper = $("<div>", {"class": "condolerenKolomBottomWrapper"});
					$condolerenCondolerenIcon = $("<div>", {"class": "condolerenIcons condolerenCondolerenIcon", "data-id": i});
					$condolerenRouwbriefHref = $("<a/>", {href: "source/afbeeldingen/condoleren/rouwbrief/" + data.rouwbrief[i], target: "_blank"});
					$condolerenRouwbriefIcon = $("<div>", {"class": "condolerenIcons condolerenRouwbriefIcon"});
					$condolerenBloemenIcon = $("<div>", {"class": "condolerenIcons condolerenBloemenIcon"});

					$condolerenKolom.appendTo($("#condolerenNormaalWrapper"));
					$condolerenKolom.append($condolerenImageWrapper);
					$condolerenKolom.append($h1Naam);
					$condolerenKolom.append($h2Titel);
					$condolerenKolom.append($pGeboorte);
					$condolerenKolom.append($pOverlijden);
					$condolerenKolom.append($pWoonplaats);

					$condolerenKolom.append($condolerenKolomBottomWrapper);
					$condolerenKolomBottomWrapper.append($condolerenCondolerenIcon);
					$condolerenKolomBottomWrapper.append($condolerenRouwbriefHref);
					$condolerenRouwbriefHref.append($condolerenRouwbriefIcon);
					$condolerenKolomBottomWrapper.append($condolerenBloemenIcon);

					$h1Naam.html(data.naam[i]);
					$h2Titel.html(data.titel[i]);
					$pGeboorte.html(data.geboortedatum[i] + ", " + data.geboorteplaats[i]);
					$pOverlijden.html(data.datumOverlijden[i] + ", " + data.plaatsOverlijden[i]);
					$pWoonplaats.html("Woonplaats: " + data.woonplaats[i]);

					arrCondolerenNaam[i] = data.naam[i];
					arrCondolerenTitel[i] = data.titel[i];
					arrCondolerenGeboortedatum[i] = data.geboortedatum[i] + ", " + data.geboorteplaats[i];
					arrCondolerenDatumOverlijden[i] = data.datumOverlijden[i] + ", " + data.plaatsOverlijden[i];
					arrCondolerenWoonplaats[i] = "Woonplaats: " + data.woonplaats[i];
					arrCondolerenRouwbrief[i] = "source/afbeeldingen/condoleren/rouwbrief/" + data.rouwbrief[i];
				}

				getLaatsteOverledeneFoto();
			}
		});
	}

	function getLaatsteOverledeneFoto(){
		$.ajax({
			url: 'php/indexData.php',
			data: {laatsteOverledeneFoto: 'getLaatsteOverledeneFoto'},
			type: 'post',
			dataType: "json",
			success: function(data) {
				arrCondolerenFoto = [];
				for(i = 0; i < 4; i++){
					if(data[i] == "data:image/jpeg;base64,"){
						$("#condolerenImage"+ i).css({
							'background-image': 'url("source/afbeeldingen/condoleren/condoleren_huis_arijs_logo.png")',
							'background-position': 'center',
							'background-size': 'contain',
							'background-repeat': 'no-repeat'
						});
						arrCondolerenFoto[i] = "source/afbeeldingen/condoleren/condoleren_huis_arijs_logo.png";
					}
					else{
						$("#condolerenImage"+ i).css({
							'background-image': 'url(' + data[i] + ')',
							'background-position': 'center',
							'background-size': 'cover',
							'background-repeat': 'no-repeat'
						});
						arrCondolerenFoto[i] = data[i];
					}
				}
			}
		})
	}

	$("#condolerenNormaalWrapper").on("click", ".condolerenIcons.condolerenBloemenIcon", function(){
		selectBloemen();
		$('html,body').animate({
	        scrollTop: $("#uitvaartwinkel").offset().top},
	        'slow');
	});

	$("#condolerenSelectedWrapper").on("click", ".condolerenIcons.condolerenBloemenIcon", function(){
		selectBloemen();
		$('html,body').animate({
	        scrollTop: $("#uitvaartwinkel").offset().top},
	        'slow');
	});

	$("#condolerenVorigeUitvaartenWrapper").on("click", ".condolerenVorigeUitvaartenNaamContainer", function(){
		var $id = $(this).attr("data-id");
		condolerenSelected($id);
	})

	$("#condolerenNormaalWrapper").on("click", ".condolerenIcons.condolerenCondolerenIcon", function(){
		var $id = $(this).attr("data-id");
		condolerenSelected($id);
	});

	$("#condolerenVorigeUitvaartenButton").on("click", function(){
		condolerenHideElements();
		$("#condolerenLaatsteUitvaartenButton").css("display", "inline-block");
		$("#condolerenVorigeUitvaartenWrapper").css("display", "block");

		getOverledeneData($offsetStandaardWaarde, 1);
	})

	$("#condolerenLaatsteUitvaartenButton").on("click", function(){
		condolerenHideElements();
		$("#condolerenVorigeUitvaartenButton").css("display", "inline-block");
		$("#condolerenNormaalWrapper").css("display", "block");
		getLaatsteOverledeneData();
	})


	function condolerenSelected($dataId){
		$("#condolerenSelectedImage").css("background", "");
		$("#condolerenSelectedNaam").html("");
		$("#condolerenSelectedTitel").html("");
		$("#condolerenSelectedGeboortedatum").html("");
		$("#condolerenSelectedDatumOverlijden").html("");
		$("#condolerenSelectedWoonplaats").html("");

		condolerenHideElements();

		$("#condolerenSelectedImage").css({
			'background-image': 'url(' + arrCondolerenFoto[$dataId] + ')',
			'background-position': 'center',
			'background-size': 'contain',
			'background-repeat': 'no-repeat'
		});

		$("#condolerenSelectedNaam").html(arrCondolerenNaam[$dataId]);
		$("#condolerenSelectedTitel").html(arrCondolerenTitel[$dataId]);
		$("#condolerenSelectedGeboortedatum").html(arrCondolerenGeboortedatum[$dataId]);
		$("#condolerenSelectedDatumOverlijden").html(arrCondolerenDatumOverlijden[$dataId]);
		$("#condolerenSelectedWoonplaats").html(arrCondolerenWoonplaats[$dataId]);

		$("#condolerenSelectedRouwbriefIconLink").attr({
			"href": arrCondolerenRouwbrief[$dataId],
			"target": "_blank"
		});

		$("#condolerenSelectedWrapper").css("display", "block");
	}

	$("#condolerenBtnTerug").on("click", function(){
		condolerenHideElements();

		$("#condolerenNormaalWrapper").css("display", "block");
		$("#condolerenVorigeUitvaartenButton").css("display", "inline-block");
		getLaatsteOverledeneData();
	});

	function condolerenHideElements(){
		$("#condolerenNormaalWrapper").css("display", "none");
		$("#condolerenVorigeUitvaartenWrapper").css("display", "none");
		$("#condolerenSelectedWrapper").css("display", "none");

		$("#condolerenVorigeUitvaartenButton").css("display", "none");
		$("#condolerenLaatsteUitvaartenButton").css("display", "none");
	}

	var $form1 = $("#condolerenForm");

	$form1.on('submit', function(e){
		e.preventDefault();

		var $geldigFormulier = true;

		$(":input").each(function() {
			if($(this).val() === "" && !this.name === "telefoon"){
				console.log("Vul a.u.b. alle vereiste velden in.");
				$geldigFormulier = false;
			}
			else{
				switch(this.name){
					case "vnaam":
						if(!$(this).val().match(/^[a-zA-Z]$/)){
							console.log("Geen geldige voornaam!");
						}
						break;
					case "naam":
						if(!$(this).val().match(/^[a-zA-Z]$/)){
							console.log("Geen geldige naam!");
						}
						break;
					case "telefoon":
						var $telefoonWaarde = $(this).val();

						//$telefoonWaarde = $(this)
						if($telefoonWaarde != ""){
							if(!($telefoonWaarde.match(/^[0-9]{9,10}$/))){
								console.log("Geen geldige telefoonnummer!");
							}
						}


						// $telefoonWaarde.replace(/\s/g, "").onblur = function(){
				  //           //[+32]?
				  //           if(/^[0-9]{9,10}$/.test(t.value)){
				  //               console.log("correct");
				  //           }
				  //       }
						break;
					case "email":
						// if(!$(this).val().match('^ $')){
						// 	console.log("Geen geldige email!");
						// }
						break;
					case "straat":
						break;
					case "postcode":
						break;
					case "gemeente":
						break;
				}
			}
		});
		
	})

// ---------------------------------------------------------------------- EINDE Condoleren

// ---------------------------------------------------------------------- Over ons

	var $arrCreads = [];
	var $creadIndex = 0;

	getCread();

	function getCread(){
		$.ajax({
			url: 'php/indexData.php',
			data: {getCread: 'getCread'},
			type: 'post',
			dataType: "json",
			success: function(data) {
				$arrCreads = [];
				$creadIndex = 0;

				$arrCreads = data;

				$creadImage = $("<img>", {"id": "creadImage", "src": $arrCreads[0]});

				$creadImage.appendTo($("#creadImageContainer"));
				
			}
		})
	}

	$("#overonsPijlLinks").on("click", function(){
		$creadIndex -= 1;
		if($creadIndex <= 0){
			$creadIndex = 0;
		}

		$("#creadImage").attr("src", $arrCreads[$creadIndex]);
	})

	$("#overonsPijlRechts").on("click", function(){
		$creadIndex += 1;
		if($creadIndex >= $arrCreads.length){
			$creadIndex = $arrCreads.length-1;
		}

		$("#creadImage").attr("src", $arrCreads[$creadIndex]);
	})


// ---------------------------------------------------------------------- EINDE Over ons

// ---------------------------------------------------------------------- Contact



	// function initMap() {
	// 	var uluru = {lat: -25.363, lng: 131.044};
	// 	var map = new google.maps.Map(document.getElementById('map'), {
	// 		zoom: 4,
	// 		center: uluru
	// 	});
	// 	var marker = new google.maps.Marker({
	// 		position: uluru,
	// 		map: map
	// 	});
	// }



	
}); // end document ready

