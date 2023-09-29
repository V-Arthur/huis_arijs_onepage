$(document).ready(function(){
	// console.log("jQuery werkt, yay");

	// body

	$("#wrapper").click(function() {
		voorzorgBackToDefault();
		boolWilsbeschikkingGeklikt = false;
		boolKeuzebegrafenisGeklikt = false;
		boolVoorafregelingGeklikt = false;
	});

	// ---------------------------------------------------------------------- navigatie

	// window.onscroll = function() {
	// 	var scrollTop = (window.pageYOffset !== undefined) ? window.pageYOffset : (document.documentElement || document.body.parentNode || document.body).scrollTop;
	// 	if (scrollTop >= document.getElementById("voorzorg").offsetTop) {
	// 		document.getElementById("headerNav").style.position = "fixed";
	// 		document.getElementById("voorzorg").style.marginTop = "150px";
	// 		document.getElementById("headerNav").style.marginTop = "-150px";
	// 	}
	// 	else{
	// 		document.getElementById("headerNav").style.position = "static";
	// 		document.getElementById("voorzorg").style.marginTop = "0px";
	// 		document.getElementById("headerNav").style.marginTop = "0px";
	// 	}
	// }

	// var aboveHeight = $('#headerNav').height();

	// var $div = $("#headerNav").height();
//    console.log("positie: " + $(window).scrollTop());

	if($(window).scrollTop() >= $("#banner").height()){
		navScroll();
	}
	else{
		noNavScroll();
	}
    

	$(window).scroll(function(){
		// var $test = $("#headerNav").offset().top;
		//console.log($test);
		if($(window).scrollTop() >= $("#banner").height()){
			navScroll();
		}
		else{
			noNavScroll();
		}

		// console.log($(window).scrollTop());
		// if ($(window).scrollTop() >= 500) {
		// 	$('#nav_bar').addClass('navbar-fixed');
	 //    }
	 //    if ($(window).scrollTop() < 500) {
	 //    	$('#nav_bar').removeClass('navbar-fixed');
	 //    }

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

		// console.log($id);

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


	// // wilsbeschikking
	// var boolWilsbeschikkingGeklikt = false;
	// $("#wilsbeschikkingMainContent").on("click", function(e){
		
	// 	if(boolWilsbeschikkingGeklikt){
	// 		voorzorgBackToDefault();
	// 		boolWilsbeschikkingGeklikt = false;
	// 	}
	// 	else{
	// 		e.stopPropagation();
	// 		voorzorgBackToDefault();

	// 		$("#wilsbeschikkingMainContent").css("background-color", "#CCC0A9");
	// 		$("#wilsbeschikkingAfbeelding").css("display", "none");
	// 		$("#wilsbeschikkingTitel").css('margin-top', '35px');

	// 		$(".wilsbeschikkingExtraTekst").css('display', 'block');
	// 		$("#wilsbeschikkingTekst").css("margin-top", "30px");

	// 		boolWilsbeschikkingGeklikt = true;
	// 		boolKeuzebegrafenisGeklikt = false;
	// 		boolVoorafregelingGeklikt = false;
	// 	}
	// });

	// // keuze begrafenis
	// var boolKeuzebegrafenisGeklikt = false;
	// $("#keuzebegrafenisMainContent").on("click", function(e){
	// 	if (boolKeuzebegrafenisGeklikt) {
	// 		voorzorgBackToDefault();
	// 		boolKeuzebegrafenisGeklikt = false;
	// 	}
	// 	else {
	// 		e.stopPropagation();
	// 		voorzorgBackToDefault();

	// 		$("#keuzebegrafenisMainContent").css("background-color", "#CCC0A9");		
	// 		$("#keuzebegrafenisAfbeelding").css("display", "none");
	// 		$("#keuzebegrafenisTitel").css("margin-top", "35px");

	// 		$(".keuzebegrafenisExtraTekst").css('display', 'block');
	// 		$("#keuzebegrafenisTekst").css("margin-top", "30px");

	// 		boolWilsbeschikkingGeklikt = false;
	// 		boolKeuzebegrafenisGeklikt = true;
	// 		boolVoorafregelingGeklikt = false;
	// 	}
	// });

	// // voorafregeling
	// var boolVoorafregelingGeklikt = false;
	// $("#voorafregelingMainContent").on("click", function(e){
	// 	if(boolVoorafregelingGeklikt){
	// 		voorzorgBackToDefault();
	// 		boolVoorafregelingGeklikt = false;
	// 	}
	// 	else {
	// 		e.stopPropagation();
	// 		voorzorgBackToDefault();

	// 		$("#voorafregelingMainContent").css("background-color", "#CCC0A9");
	// 		$("#voorafregelingAfbeelding").css("display", "none");
	// 		$("#voorafregelingTitel").css("margin-top", "35px");

	// 		$(".voorafregelingExtraTekst").css('display', 'block');
	// 		$("#voorafregelingTekst").css("margin-top", "30px");

	// 		boolWilsbeschikkingGeklikt = false;
	// 		boolKeuzebegrafenisGeklikt = false;
	// 		boolVoorafregelingGeklikt = true;
	// 	}
	// });

	// ---------------------------------------------------------------------- Uitvaartwinkel

	var $arrProductId = [];
	var $totaalProducten;
	var $productAfbeelding = [];
	var $productNaam = [];
	var $productPrijs = [];

	var $uitvaartwinkelCategorie = 1;
	var $beginpuntUitvaartwinkel = 6;
	getProductData($beginpuntUitvaartwinkel, 0, $uitvaartwinkelCategorie);

	$("#uitvaartwinkelGroteAfbeeldingWrapper").hide();
	$("#uitvaartwinkelWinkelmandOverzichtWrapper").hide();

	var $rangnummer;

	getCookieAantal();
	// var $itemsInWinkelwagen = [];
	
	$("#toonzaalTekst").hide();
	$("#uitklappijlNaarBeneden").hide();
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

			$("#bloemenTekst").children().show();
			$("#toonzaalTekst").hide();
			$("#uitklappijlNaarBeneden").hide();
			
			$("#uitklappijlNaarBoven").show();

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

			$("#bloemenTekst").children().hide();

			setTimeout(
				function() {
					$("#toonzaalTekst").show();
				}, 180);

			$("#uitklappijlNaarBeneden").show();
			$("#uitklappijlNaarBoven").hide();

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
		//console.log("beginpuntUitvaartwinkel " + $beginpuntUitvaartwinkel);
		
	});

	//----------- producten constructor

	//getProductData(-6, 1, 1);

	function getProductData(beginpunt, richting, categorie){
		$.ajax({
			url: "php/indexData.php",
			data: {productData: 'getProductData', beginpunt: beginpunt, richting: richting, categorie: categorie},
			type: 'post',
			dataType: "json",
			success: function(data) {
				//console.log(data.nieuweBeginPunt);
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


	// function productenWijzigen(beginpunt, richting, categorie){
	// 	$.ajax({
	// 		url: "php/indexData.php",
	// 		data: {productId: 'getProductId', categorie: categorie},
	// 		type: 'post',
	// 		dataType: "json",
	// 		success: function(data) {
	// 			$arrProductId = [];
	// 			$arrAlleProductId = [];
	// 			var $data = data;
	// 			$arrAlleProductId = $data;

	// 			var $nieuweBeginPunt;
	// 			var $nieuweEindPunt;
	// 			var $pointer;

	// 			if(richting == 0){
	// 				$nieuweBeginPunt = beginpunt - 6;
	// 				$nieuweEindPunt = $nieuweBeginPunt + 6;
	// 				$beginpuntUitvaartwinkel -= 6;
	// 			}
	// 			else{
	// 				$nieuweBeginPunt = beginpunt + 6;
	// 				$nieuweEindPunt = $nieuweBeginPunt + 6;
	// 				$beginpuntUitvaartwinkel += 6;
	// 			}

	// 			for(i = $nieuweBeginPunt; i < ($nieuweBeginPunt + 6); i++){
	// 				$pointer = ((i % $data.length) + $data.length) % $data.length;
	// 				$arrProductId.push($data[$pointer]);
	// 			}

	// 			//getProductAfbeelding($arrProductId);
	// 			getProductNaam($arrProductId);
	// 			getProductPrijs($arrProductId);
	// 		}
	// 	});
	// }

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

	// function getProductNaam(productId){
	// 	$.ajax({
	// 		url: "php/indexData.php",
	// 		data: {productNaam: 'getProductNaam', Id: productId},
	// 		type: 'post',
	// 		dataType: "json",
	// 		success: function(data) {
	// 			$productNaam = [];
	// 			$productNaam = data;
	// 		}
	// 	});
	// }

	// function getProductPrijs(productId){
	// 	$.ajax({
	// 		url: "php/indexData.php",
	// 		data: {productPrijs: 'getProductPrijs', Id: productId},
	// 		type: 'post',
	// 		dataType: "json",
	// 		success: function(data) {
	// 			$productPrijs = [];
	// 			$productPrijs = data;
	// 		}
	// 	});
	// }


	$("#contentRechtsWrapper").on("click", ".uitvaartwinkelAfbeeldingen", function(){
		var $id = $(this).attr("data-id");
		groteAfbeeldingWeergeven($id);
	})

	// $("#uitvaartwinkelAfbeelding1").on("click", function(){
	// 	groteAfbeeldingWeergeven(0);
	// });

	// $("#uitvaartwinkelAfbeelding2").on("click", function(){
	// 	groteAfbeeldingWeergeven(1);
	// });

	// $("#uitvaartwinkelAfbeelding3").on("click", function(){
	// 	groteAfbeeldingWeergeven(2);
	// });

	// $("#uitvaartwinkelAfbeelding4").on("click", function(){
	// 	groteAfbeeldingWeergeven(3);
	// });

	// $("#uitvaartwinkelAfbeelding5").on("click", function(){
	// 	groteAfbeeldingWeergeven(4);
	// });

	// $("#uitvaartwinkelAfbeelding6").on("click", function(){
	// 	groteAfbeeldingWeergeven(5);
	// });

	var $geselecteerdProductId;

	function groteAfbeeldingWeergeven(geselecteerdVak){
		// for(i = 0; i < $arrAlleProductId.length; i++){
  //       	if($arrProductId[geselecteerdVak] == $arrAlleProductId[i]){
  //       		$rangnummer = i + 1;
  //       	}
  //       }
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

        $("#uitvaartwinkelGroteAfbeeldingWrapper").show();
        $("#uitvaartwinkelWinkelmandOverzichtWrapper").hide();
	}

	$("#uitvaartwinkelGroteAfbeeldingSluitenKnopWrapper").on("click", function(){
		$("#txtOrderAantal").val("");
		$("#groteAfbeeldingBeschrijving").val("");
		$("#uitvaartwinkelGroteAfbeeldingWrapper").hide();
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
		$("#uitvaartwinkelGroteAfbeeldingWrapper").hide();
		$("#uitvaartwinkelWinkelmandOverzichtWrapper").show();
		getWinkelmandData();
	});

	$("#uitvaartwinkelWinkelmandOverzichtSluitenKnopWrapper").on("click", function(){
		$("#uitvaartwinkelWinkelmandOverzichtWrapper").hide();
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


	// getWinkelmandData();
	function getWinkelmandData(){
		$.ajax({
			url: "php/indexData.php",
			data: {winkelmandData: 'getWinkelmandData'},
			type: 'post',
			dataType: "json",
			success: function(data) {
//				console.log(data);
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

	// function getWinkelmandOverzicht(){
	// 	$.ajax({
	// 		url: "php/indexData.php",
	// 		data: {winkelmandOverzicht: 'getWinkelmandOverzicht'},
	// 		type: 'post',
	// 		dataType: "json",
	// 		success: function(data) {
	// 			//console.log(data);
	// 			$('#uitvaartwinkelWinkelmandOverzichtToegevoegdeProducten').empty();
	// 			if(data.length > 0){
	// 				var id = [];
	// 				for(var i in data){
	// 					id[i] = data[i].id;
	// 				}

	// 				for(i = 0; i < id.length; i++){
	// 					$productenGroep = $("<div>", {id: "productenGroep"+ i, "class": "productenGroep", "data-id": id[i]});
	// 					$productenGroepAfbeeldingContainer = $("<div>", {id: "productenGroepAfbeeldingContainer"+ i, "class": "productenGroepAfbeeldingContainer"});
	// 					$productenGroepTekstContainer = $("<div>", {id: "productenGroepTekstContainer"+ i, "class": "productenGroepTekstContainer"});
	// 					$productenGroepBeschrijvingContainer = $("<div>", {id: "productenGroepBeschrijvingContainer"+ i, "class": "productenGroepBeschrijvingContainer"});
	// 					$productenGroepBeschrijving = $("<p>", {id: "productenGroepBeschrijving"+ i, "class": "productenGroepBeschrijving"});
	// 					$productenGroepPrijsContainer = $("<div>", {id: "productenGroepPrijsContainer"+ i, "class": "productenGroepPrijsContainer"});
	// 					$productenGroepPrijs = $("<p>", {id: "productenGroepPrijs"+i, "class": "productenGroepPrijs"});
	// 					$selectieVerwijderenWrapper = $("<div>", {id: "selectieVerwijderenWrapper"+ i, "class": "selectieVerwijderenWrapper", "data-id": id[i]});

	// 					$productenGroep.appendTo($("#uitvaartwinkelWinkelmandOverzichtToegevoegdeProducten"));
	// 					$productenGroep.append($productenGroepAfbeeldingContainer);
	// 					$productenGroep.append($productenGroepTekstContainer);
	// 					$productenGroepTekstContainer.append($productenGroepBeschrijvingContainer);
	// 					$productenGroepBeschrijvingContainer.append($productenGroepBeschrijving);
	// 					$productenGroepTekstContainer.append($productenGroepPrijsContainer);
	// 					$productenGroepPrijsContainer.append($productenGroepPrijs);
	// 					$productenGroepTekstContainer.append($selectieVerwijderenWrapper);
	// 				}
					
	// 				getWinkelmandAfbeelding(id);
	// 				getWinkelmandNaam(id);
	// 				getWinkelmandPrijs(id);
	// 			}
	// 		}
	// 	});
	// }

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

	// function getWinkelmandNaam(productId){
	// 	return $.ajax({
	// 		url: "php/indexData.php",
	// 		data: {productNaam: 'getProductNaam', Id: productId},
	// 		type: 'post',
	// 		dataType: "json",
	// 		success: function(data) {
	// 			for(i = 0; i < data.length; i++){
	// 				var $container = $("#productenGroepBeschrijving" + i);
	// 				$container.text(data[i]);
	// 			}
	// 		}
	// 	});
	// }

	// function getWinkelmandPrijs(productId){
	// 	$.ajax({
	// 		url: "php/indexData.php",
	// 		data: {productPrijs: 'getProductPrijs', Id: productId},
	// 		type: 'post',
	// 		dataType: "json",
	// 		success: function(data) {
	// 			for(i = 0; i < data.length; i++){
	// 				var $container = $("#productenGroepPrijs" + i);
	// 				$container.text(data[i]);
	// 			}
	// 		}
	// 	});
	// }
	
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
				getWinkelmandData();
				getCookieAantal();
			}
		});
    }

	// function getAfbeelding(id){
	// 	var $deAfbeelding;
	// 	console.log(id);
	// 	$.ajax({
	// 		url: "xml/uitvaartwinkel.xml",
	// 		dataType: "xml",
	// 		success: function(data){
	// 			var $xml = $(data);
	// 			var $product = $xml.find('product').has("id:contains('" + id + "')");
	// 			console.log($product);
	// 			$deAfbeelding = $product.find('url').text();
	// 		}
	// 	});
	// }


	// function winkelwagenOverzichtTonen(){
	// 	$(".productenGroep").remove();
	// 	for(i = 0; i < $itemsInWinkelwagen.length; i++){
	// 		//var $geselecteerdAfbeelding;
			
	// 		getAfbeelding($itemsInWinkelwagen[i]);

	// 		var $productenGroep = $('<div/>').addClass('productenGroep');
	// 		$productenGroep.appendTo($("#uitvaartwinkelWinkelmandOverzichtToegevoegdeProducten"));

	// 		var $productenGroepAfbeeldingContainer = $('<div/>').addClass('productenGroepAfbeeldingContainer');
	// 		$productenGroepAfbeeldingContainer.css({
	// 			'background-image': 'url(' + $uitvaartwinkelurl[i] + ')',
	// 			'background-position': 'center',
	// 			'background-size': 'cover',
	// 			'background-repeat': 'no-repeat'
	// 		});

	// 		$productenGroepAfbeeldingContainer.appendTo($productenGroep);
	// 	}
	// }

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
		// console.log($beginpuntFunerariumenaula);
	});

	$("#funerariumPijlRechts").on("click", function(){
		setFunerariumData($beginpuntFunerariumenaula, 1);
	});

	setFunerariumData($beginpuntFunerariumenaula, 1);

	// function setFunerariumData(b, r){
	// 	setFunerariumtitels(b, r);
	// 	setFunerariumAfbeeldingen(b, r);

	// 	if(r == 0){
	// 		$beginpuntFunerariumenaula -= 4;
	// 	}
	// 	else{
	// 		$beginpuntFunerariumenaula += 4;
	// 	}
	// }

	function setFunerariumData(b, r){
		$.ajax({
			url: 'php/indexData.php',
			data: {funerariumTitel: 'getFunerariumtitels', richting: r, beginpunt: b},
			type: 'post',
			dataType: "json",
			success: function(output) {
				// console.log("oude punt " +  $beginpuntFunerariumenaula + " punt " +  (14 - $beginpuntFunerariumenaula) + " nieuwe punt " +  output.nieuweBeginPunt);
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

	//$("#condolerenNormaalWrapper").children().hide();
	//$("#condolerenVorigeUitvaartenButton").hide();
	// $("#condolerenLaatsteUitvaartenButton").hide();
	// $("#condolerenVorigeUitvaartenWrapper").children().hide();
	// $("#condolerenSelectedWrapper").children().hide();

	condolerenHideElements();
	$("#condolerenNormaalWrapper").children().show();
	$("#condolerenVorigeUitvaartenButton").show();

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

	//getOverledeneData($offsetOverledeneData, 1);

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
				// console.log(data);
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
				// var $test = data[0];
				// if(data[0] == "data:image/jpeg;base64,"){
				// 	console.log(data[0]);
				// }
				

				// console.log(data);

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
				//console.log(data);
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

					//arrRouwbrieven[i] = data.rouwbrief[i];					
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
				//console.log(data);
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
		// $("#condolerenNormaalWrapper").children().hide();
		$("#condolerenLaatsteUitvaartenButton").show();
		// $("#condolerenVorigeUitvaartenButton").hide();
		$("#condolerenVorigeUitvaartenWrapper").children().show();

		getOverledeneData($offsetStandaardWaarde, 1);


	})

	$("#condolerenLaatsteUitvaartenButton").on("click", function(){
		condolerenHideElements();

		// $("#condolerenLaatsteUitvaartenButton").hide();
		$("#condolerenVorigeUitvaartenButton").show();
		$("#condolerenNormaalWrapper").children().show();

		getLaatsteOverledeneData();



	})


	function condolerenSelected($dataId){
		$("#condolerenSelectedImage").css("background", "");
		$("#condolerenSelectedNaam").html("");
		$("#condolerenSelectedTitel").html("");
		$("#condolerenSelectedGeboortedatum").html("");
		$("#condolerenSelectedDatumOverlijden").html("");
		$("#condolerenSelectedWoonplaats").html("");
		
		// $("#condolerenNormaalWrapper").children().hide();
		// $("#condolerenVorigeUitvaartenButton").hide();
		// $("#condolerenVorigeUitvaartenWrapper").children().hide();
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

		$("#condolerenSelectedWrapper").children().show();
	}

	$("#condolerenBtnTerug").on("click", function(){
		condolerenHideElements();

		$("#condolerenNormaalWrapper").children().show();
		// $("#condolerenSelectedWrapper").children().hide();
		$("#condolerenVorigeUitvaartenButton").show();
		// $("#condolerenVorigeUitvaartenWrapper").children().hide();
		getLaatsteOverledeneData();
	});

	function condolerenHideElements(){
		$("#condolerenNormaalWrapper").children().hide();
		$("#condolerenVorigeUitvaartenWrapper").children().hide();
		$("#condolerenSelectedWrapper").children().hide();

		$("#condolerenVorigeUitvaartenButton").hide();
		$("#condolerenLaatsteUitvaartenButton").hide();


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
				//console.log(data);
				$arrCreads = [];
				$creadIndex = 0;

				$arrCreads = data;

				// console.log($arrCreads);

				

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

