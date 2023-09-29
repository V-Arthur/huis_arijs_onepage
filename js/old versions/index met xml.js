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

	$("#voorzorgLink").click(function() {
	    $('html,body').animate({
	        scrollTop: $("#voorzorg").offset().top},
	        'slow');
	});

	$("#uitvaartwinkelLink").click(function() {
	    $('html,body').animate({
	        scrollTop: $("#uitvaartwinkel").offset().top},
	        'slow');
	});

	$("#funerariumLink").click(function() {
	    $('html,body').animate({
	        scrollTop: $("#funerarium").offset().top},
	        'slow');
	});

	$("#condolerenLink").click(function() {
	    $('html,body').animate({
	        scrollTop: $("#condoleren").offset().top},
	        'slow');
	});

	$("#overonsLink").click(function() {
	    $('html,body').animate({
	        scrollTop: $("#overons").offset().top},
	        'slow');
	});

	$("#contactLink").click(function() {
	    $('html,body').animate({
	        scrollTop: $("#contact").offset().top},
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
	}

	// wilsbeschikking
	var boolWilsbeschikkingGeklikt = false;
	$("#wilsbeschikkingMainContent").on("click", function(e){
		
		if(boolWilsbeschikkingGeklikt){
			voorzorgBackToDefault();
			boolWilsbeschikkingGeklikt = false;
		}
		else{
			e.stopPropagation();
			voorzorgBackToDefault();

			$("#wilsbeschikkingMainContent").css("background-color", "#91846C");
			$("#wilsbeschikkingAfbeelding").css("display", "none");
			$("#wilsbeschikkingTitel").css('margin-top', '35px');

			$(".wilsbeschikkingExtraTekst").css('display', 'block');
			$("#wilsbeschikkingTekst").css("margin-top", "30px");

			boolWilsbeschikkingGeklikt = true;
			boolKeuzebegrafenisGeklikt = false;
			boolVoorafregelingGeklikt = false;
		}
		

	});

	// keuze begrafenis
	var boolKeuzebegrafenisGeklikt = false;
	$("#keuzebegrafenisMainContent").on("click", function(e){
		if (boolKeuzebegrafenisGeklikt) {
			voorzorgBackToDefault();
			boolKeuzebegrafenisGeklikt = false;
		}
		else {
			e.stopPropagation();
			voorzorgBackToDefault();

			$("#keuzebegrafenisMainContent").css("background-color", "#91846C");		
			$("#keuzebegrafenisAfbeelding").css("display", "none");
			$("#keuzebegrafenisTitel").css("margin-top", "35px");

			$(".keuzebegrafenisExtraTekst").css('display', 'block');
			$("#keuzebegrafenisTekst").css("margin-top", "30px");

			boolWilsbeschikkingGeklikt = false;
			boolKeuzebegrafenisGeklikt = true;
			boolVoorafregelingGeklikt = false;
		}
		
	});

	// voorafregeling
	var boolVoorafregelingGeklikt = false;
	$("#voorafregelingMainContent").on("click", function(e){
		if(boolVoorafregelingGeklikt){
			voorzorgBackToDefault();
			boolVoorafregelingGeklikt = false;
		}
		else {
			e.stopPropagation();
			voorzorgBackToDefault();

			$("#voorafregelingMainContent").css("background-color", "#91846C");
			$("#voorafregelingAfbeelding").css("display", "none");
			$("#voorafregelingTitel").css("margin-top", "35px");

			$(".voorafregelingExtraTekst").css('display', 'block');
			$("#voorafregelingTekst").css("margin-top", "30px");

			boolWilsbeschikkingGeklikt = false;
			boolKeuzebegrafenisGeklikt = false;
			boolVoorafregelingGeklikt = true;
		}
	});

	// ---------------------------------------------------------------------- Uitvaartwinkel

	var $bloemenOfToonzaalGeselecteerd = 0;
	uitvaartwinkelAfbeeldingenWeergeven(6, 0, $bloemenOfToonzaalGeselecteerd);

	var $itemsInWinkelwagen = [];
	//console.log($itemsInWinkelwagen.length);

	var $uitvaartwinkelWinkelmandAantal = $("#uitvaartwinkelWinkelmandAantal");
	$uitvaartwinkelWinkelmandAantal.text($itemsInWinkelwagen.length);

	$("#toonzaalTekst").hide();
	$("#uitklappijlNaarBeneden").hide();
	$("#toonzaalWrapper").css("cursor", "pointer");

	$("#bloemenWrapper").on("click", function(){
		if($bloemenOfToonzaalGeselecteerd == 1){
			$bloemenOfToonzaalGeselecteerd = 0;
			uitvaartwinkelAfbeeldingenWeergeven(6, 0, $bloemenOfToonzaalGeselecteerd);

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
	});

	$("#toonzaalWrapper").on("click", function(){
		if($bloemenOfToonzaalGeselecteerd == 0){
			$bloemenOfToonzaalGeselecteerd = 1;
			uitvaartwinkelAfbeeldingenWeergeven(6, 0, $bloemenOfToonzaalGeselecteerd);

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
	});

	var $beginPunt;
	
	$("#uitvaartwinkelPijlLinks").on("click", function(){
		uitvaartwinkelAfbeeldingenWeergeven($beginPunt, 0, $bloemenOfToonzaalGeselecteerd);
		//console.log($beginPunt);
	});

	$("#uitvaartwinkelPijlRechts").on("click", function(){
		uitvaartwinkelAfbeeldingenWeergeven($beginPunt, 1, $bloemenOfToonzaalGeselecteerd);
	});

	var $uitvaartwinkelurl = [];
	var $uitvaartwinkelprijs = [];
	var $uitvaartwinkelbeschrijving = [];
	var $uitvaartwinkelrangnummer = [];
	var $uitvaartwinkelProductID = [];
	var $totaalAfbeeldingenUitvaartwinkel;

	function uitvaartwinkelAfbeeldingenWeergeven(beginPunt, richting, bloemenOfToonzaal){
		$.ajax({
			url: "xml/uitvaartwinkel.xml",
			dataType: "xml",
			success: function(data){
				var $xml = $(data);
				var $producten;
				var $nieuweBeginPunt;
				var $pointer;

				$uitvaartwinkelurl = [];
				$uitvaartwinkelprijs = [];
				$uitvaartwinkelbeschrijving = [];
				$uitvaartwinkelrangnummer = [];
				$uitvaartwinkelProductID = [];

				if(bloemenOfToonzaal == 0){
					//$bloemenOfToonzaalXML = $xml.find("bloem");
					var $producten = $xml.find('product').has("categorie:contains('bloem')");
				}
				else{
					var $producten = $xml.find('product').has("categorie:contains('toonzaal')");
				}

				$totaalAfbeeldingenUitvaartwinkel = $producten.length;

				if(richting == 0){
					$nieuweBeginPunt = beginPunt - 6;
					//console.log($nieuweBeginPunt);
				}
				else{
					$nieuweBeginPunt = beginPunt + 6;
				}

				for(i = $nieuweBeginPunt; i < ($nieuweBeginPunt + 6); i++){
					//console.log(i);
					$pointer = ((i % $totaalAfbeeldingenUitvaartwinkel) + $totaalAfbeeldingenUitvaartwinkel) % $totaalAfbeeldingenUitvaartwinkel;
					if(i == $nieuweBeginPunt){
						$beginPunt = $nieuweBeginPunt;
					}
					//console.log($pointer);

					$uitvaartwinkelurl.push($producten.find('url').eq($pointer).text());
					$uitvaartwinkelprijs.push($producten.find('prijs').eq($pointer).text());
					$uitvaartwinkelbeschrijving.push($producten.find('beschrijving').eq($pointer).text());
					$uitvaartwinkelrangnummer.push($pointer + 1);
					$uitvaartwinkelProductID.push($producten.find('id').eq($pointer).text());
				}

				//console.log($uitvaartwinkelbeschrijving);

				for(i = 0; i < $uitvaartwinkelurl.length; i++){
					var $continerPointer = i+1;
					var $container = $("#uitvaartwinkelAfbeelding" + $continerPointer);
					
					//console.log($uitvaartwinkelurl[i]);

					$container.css({
						'background-image': 'url(' + $uitvaartwinkelurl[i] + ')',
						'background-position': 'center',
						'background-size': 'cover',
						'background-repeat': 'no-repeat'
					});
				}
			}
		});
	}

	$("#uitvaartwinkelGroteAfbeeldingWrapper").hide();

	var $geselecteerdProduct;
	//var $geselecteerdAfbeelding;
	//var geselecteerdBeschrijving;
	//var geselecteerdPrijs;

	$("#uitvaartwinkelAfbeelding1").on("click", function(){
		groteAfbeeldingWeergeven($uitvaartwinkelurl[0], $uitvaartwinkelbeschrijving[0], $uitvaartwinkelprijs[0], $uitvaartwinkelrangnummer[0]);
		$geselecteerdProduct = $uitvaartwinkelProductID[0];
		/*$geselecteerdBeschrijving = $uitvaartwinkelbeschrijving[0];
		$geselecteerdAfbeelding = $uitvaartwinkelurl[0];
		$geselecteerdPrijs = $uitvaartwinkelprijs[0];*/

	});
	$("#uitvaartwinkelAfbeelding2").on("click", function(){
		groteAfbeeldingWeergeven($uitvaartwinkelurl[1], $uitvaartwinkelbeschrijving[1], $uitvaartwinkelprijs[1], $uitvaartwinkelrangnummer[1]);
		$geselecteerdProduct = $uitvaartwinkelProductID[1];
		/*$geselecteerdBeschrijving = $uitvaartwinkelbeschrijving[1];
		$geselecteerdAfbeelding = $uitvaartwinkelurl[1];
		$geselecteerdPrijs = $uitvaartwinkelprijs[1];*/
	});
	$("#uitvaartwinkelAfbeelding3").on("click", function(){
		groteAfbeeldingWeergeven($uitvaartwinkelurl[2], $uitvaartwinkelbeschrijving[2], $uitvaartwinkelprijs[2], $uitvaartwinkelrangnummer[2]);
		$geselecteerdProduct = $uitvaartwinkelProductID[2];
		/*$geselecteerdBeschrijving = $uitvaartwinkelbeschrijving[2];
		$geselecteerdAfbeelding = $uitvaartwinkelurl[2];
		$geselecteerdPrijs = $uitvaartwinkelprijs[2];*/
	});
	$("#uitvaartwinkelAfbeelding4").on("click", function(){
		groteAfbeeldingWeergeven($uitvaartwinkelurl[3], $uitvaartwinkelbeschrijving[3], $uitvaartwinkelprijs[3], $uitvaartwinkelrangnummer[3]);
		$geselecteerdProduct = $uitvaartwinkelProductID[3];
		/*$geselecteerdBeschrijving = $uitvaartwinkelbeschrijving[3];
		$geselecteerdAfbeelding = $uitvaartwinkelurl[3];
		$geselecteerdPrijs = $uitvaartwinkelprijs[3];*/
	});
	$("#uitvaartwinkelAfbeelding5").on("click", function(){
		groteAfbeeldingWeergeven($uitvaartwinkelurl[4], $uitvaartwinkelbeschrijving[4], $uitvaartwinkelprijs[4], $uitvaartwinkelrangnummer[4]);
		$geselecteerdProduct = $uitvaartwinkelProductID[4];
		/*$geselecteerdBeschrijving = $uitvaartwinkelbeschrijving[4];
		$geselecteerdAfbeelding = $uitvaartwinkelurl[4];
		$geselecteerdPrijs = $uitvaartwinkelprijs[4];*/
	});
	$("#uitvaartwinkelAfbeelding6").on("click", function(){
		groteAfbeeldingWeergeven($uitvaartwinkelurl[5], $uitvaartwinkelbeschrijving[5], $uitvaartwinkelprijs[5], $uitvaartwinkelrangnummer[5]);
		$geselecteerdProduct = $uitvaartwinkelProductID[5];
		/*$geselecteerdBeschrijving = $uitvaartwinkelbeschrijving[5];
		$geselecteerdAfbeelding = $uitvaartwinkelurl[5];
		$geselecteerdPrijs = $uitvaartwinkelprijs[5];*/
	});

	function groteAfbeeldingWeergeven(link, beschrijving, prijs, nummer){
		$("#groteAfbeeldingContainer").css({
			'background-image': 'url(' + link + ')',
			'background-position': 'center',
			'background-size': 'contain',
			'background-repeat': 'no-repeat'
		});
		$("#txtOrderAantal").val("");
        $("#groteAfbeeldingBeschrijving").text(beschrijving + " - " + prijs + " euro");

        $("#groteAfbeeldingNummer").text("Afbeelding " + nummer + " van " + $totaalAfbeeldingenUitvaartwinkel);

        $("#uitvaartwinkelGroteAfbeeldingWrapper").show();
	}

	$("#uitvaartwinkelGroteAfbeeldingSluitenKnopWrapper").on("click", function(){
		$("#txtOrderAantal").val("");
		$("#groteAfbeeldingBeschrijving").val("");
		$("#uitvaartwinkelGroteAfbeeldingWrapper").hide();
	});

	$("#uitvaartwinkelBtnSubmitOrder").on("click", function(e){
		e.preventDefault();
		var $alToegevoegd = false;
		//console.log($geselecteerdProduct);








		if($itemsInWinkelwagen.length > 0){
			for(i = 0; i < $itemsInWinkelwagen.length; i++){
				if($itemsInWinkelwagen[i] == $geselecteerdProduct){
					$alToegevoegd = true;
				}
			}
		}

		if($alToegevoegd){
			alert("Dit item zit al in u winkelwagen.");
		}
		else{
			$itemsInWinkelwagen.push($geselecteerdProduct);
			$uitvaartwinkelWinkelmandAantal.text($itemsInWinkelwagen.length);
		}









	});

	$("#uitvaartwinkelWinkelmandOverzichtWrapper").hide();
	$("#uitvaartwinkelWinkelmandWrapper").on("click", function(){
		$("#uitvaartwinkelWinkelmandOverzichtWrapper").show();
		if($itemsInWinkelwagen.length > 0){
			winkelwagenOverzichtTonen();
		}
	});
	$("#uitvaartwinkelWinkelmandOverzichtSluitenKnopWrapper").on("click", function(){
		$("#uitvaartwinkelWinkelmandOverzichtWrapper").hide();
	});


	function getAfbeelding(id){
		var $deAfbeelding;
		console.log(id);
		$.ajax({
			url: "xml/uitvaartwinkel.xml",
			dataType: "xml",
			success: function(data){
				var $xml = $(data);

				//for(i = 0; i < $itemsInWinkelwagen.length; i++){
					var $product = $xml.find('product').has("id:contains('" + id + "')");
					console.log($product);
					$deAfbeelding = $product.find('url').text();
				//}
				
				//for(i = 0; i < $geselecteerdAfbeelding.length; i++){
					//console.log($geselecteerdAfbeelding[i]);
				//}
				// var $producten = $xml.find('product').has("categorie:contains('toonzaal')");
				//$uitvaartwinkelurl.push($producten.find('url').eq($pointer).text());



			}
		});
		//console.log($deAfbeelding);
	}


	function winkelwagenOverzichtTonen(){
		$(".productenGroep").remove();

		//var $geselecteerdAfbeelding = [];
/*
		$.ajax({
			url: "xml/uitvaartwinkel.xml",
			dataType: "xml",
			success: function(data){
				var $xml = $(data);

				for(i = 0; i < $itemsInWinkelwagen.length; i++){
					var $product = $xml.find('product').has("id:contains('" + $itemsInWinkelwagen[i] + "')");
					$geselecteerdAfbeelding.push($product.find('url').text());
				}

				for(i = 0; i < $geselecteerdAfbeelding.length; i++){
					//console.log($geselecteerdAfbeelding[i]);
				}
				// var $producten = $xml.find('product').has("categorie:contains('toonzaal')");
				//$uitvaartwinkelurl.push($producten.find('url').eq($pointer).text());



			}
		})
		console.log($geselecteerdAfbeelding[i]);
		*/
		for(i = 0; i < $itemsInWinkelwagen.length; i++){
			//var $geselecteerdAfbeelding;
			
			getAfbeelding($itemsInWinkelwagen[i]);

			var $productenGroep = $('<div/>').addClass('productenGroep');
			$productenGroep.appendTo($("#uitvaartwinkelWinkelmandOverzichtToegevoegdeProducten"));

			var $productenGroepAfbeeldingContainer = $('<div/>').addClass('productenGroepAfbeeldingContainer');
			$productenGroepAfbeeldingContainer.css({
				'background-image': 'url(' + $uitvaartwinkelurl[i] + ')',
				'background-position': 'center',
				'background-size': 'cover',
				'background-repeat': 'no-repeat'
			});

			$productenGroepAfbeeldingContainer.appendTo($productenGroep);
		}
				
	}


	// ---------------------------------------------------------------------- funerarium en aula

	var sourceFolder = "source/afbeeldingen/funerarium_en_aula/";
	var fileExtension = ".jpg";

	var $lAfbeelding;
	var $nieuwMeestRechtseAfbeeldingFunerarium;

	var $funerariumKolomTitel1 = $("#funerariumKolomTitel1");
	var $funerariumKolomTitel2 = $("#funerariumKolomTitel2");
	var $funerariumKolomTitel3 = $("#funerariumKolomTitel3");
	var $funerariumKolomTitel4 = $("#funerariumKolomTitel4");

	var $funerariumAfbeelding1 = $("#funerariumAfbeeldingContainer1");
	var $funerariumAfbeelding2 = $("#funerariumAfbeeldingContainer2");
	var $funerariumAfbeelding3 = $("#funerariumAfbeeldingContainer3");
	var $funerariumAfbeelding4 = $("#funerariumAfbeeldingContainer4");

	changeFunerariumAfbeeldingenRechts(13);

	$("#funerariumPijlLinks").on("click", function(){
		changeFunerariumAfbeeldingenLinks($nieuwMeestRechtseAfbeeldingFunerarium);
	});

	$("#funerariumPijlRechts").on("click", function(){
		changeFunerariumAfbeeldingenRechts($nieuwMeestRechtseAfbeeldingFunerarium);
	});

	function changeFunerariumAfbeeldingenLinks($meestRechtseAfbeeldingVorigeReeks){
		$.ajax({
			//type: "GET",
			url: "xml/funerariumenaula.xml",
			dataType: "xml",
			success: function(data){

				var $xml = $(data);
				var $titel = [];
				var $url = [];
				var $pointer;
				var $totaalAfbeeldingen = $xml.find('afbeelding').length - 1;

				$nieuwMeestRechtseAfbeeldingFunerarium = $meestRechtseAfbeeldingVorigeReeks - 4;

				for(i = $nieuwMeestRechtseAfbeeldingFunerarium; i > $nieuwMeestRechtseAfbeeldingFunerarium - 4; i--){
					$pointer = i % ($totaalAfbeeldingen + 1);
					//console.log($pointer);

					$titel.push($xml.find('titel').eq($pointer).text());
					$url.push($xml.find('url').eq($pointer).text());					
				}

				changeFunerariumAfbeeldingenHTMLCSS($titel, $url, 0);
			}
		});
		
	}

	function changeFunerariumAfbeeldingenRechts($meestRechtseAfbeeldingVorigeReeks){
		$.ajax({
			//type: "GET",
			url: "xml/funerariumenaula.xml",
			dataType: "xml",
			success: function(data){
				var $xml = $(data);
				var $titel = [];
				var $url = [];
				var $pointer;
				var $totaalAfbeeldingen = $xml.find('afbeelding').length - 1;

				
				var $beginAfbeeldingen = $meestRechtseAfbeeldingVorigeReeks + 1;

				for(i = $beginAfbeeldingen; i < $beginAfbeeldingen + 4; i++){
					$pointer = i % ($totaalAfbeeldingen + 1);
					//console.log($pointer);

					$titel.push($xml.find('titel').eq($pointer).text());
					$url.push($xml.find('url').eq($pointer).text());
				}

				$nieuwMeestRechtseAfbeeldingFunerarium = $meestRechtseAfbeeldingVorigeReeks + 4;

				changeFunerariumAfbeeldingenHTMLCSS($titel, $url, 1);
			}
		});
	}

	function changeFunerariumAfbeeldingenHTMLCSS(titel, url, richting){
		// als naar links
		if(richting == 0){
			titel.reverse();
			url.reverse();
		}

		$funerariumKolomTitel1.html('');
		$funerariumKolomTitel2.html('');
		$funerariumKolomTitel3.html('');
		$funerariumKolomTitel4.html('');
		$funerariumKolomTitel1.append(titel[0]);
		$funerariumKolomTitel2.append(titel[1]);
		$funerariumKolomTitel3.append(titel[2]);
		$funerariumKolomTitel4.append(titel[3]);

		$funerariumAfbeelding1.css({
			'background-image': 'url(' + url[0] + ')',
			'background-position': 'center',
			'background-size': 'cover'
		});

		$funerariumAfbeelding2.css({
			'background-image': 'url(' + url[1] + ')',
			'background-position': 'center',
			'background-size': 'cover'
		});

		$funerariumAfbeelding3.css({
			'background-image': 'url(' + url[2] + ')',
			'background-position': 'center',
			'background-size': 'cover'
		});

		$funerariumAfbeelding4.css({
			'background-image': 'url(' + url[3] + ')',
			'background-position': 'center',
			'background-size': 'cover'
		});

	}


	// ---------------------------------------------------------------------- Condoleren

	$("#condolerenNormaalWrapper").children().hide();
	//$("#condolerenSelectedWrapper").children().hide();
	
});