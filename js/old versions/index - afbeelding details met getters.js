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

	var $arrProductId = [];
	var $arrAlleProductId = [];
	var $productAfbeelding = [];
	var $productNaam = [];
	var $productPrijs = [];

	var $uitvaartwinkelCategorie = 1;
	var $beginpuntUitvaartwinkel = 6;
	//getUitvaartwinkelId($beginpuntUitvaartwinkel, 0, $uitvaartwinkelCategorie);
	//getUitvaartwinkelAfbeeldingen($beginpuntUitvaartwinkel, 0, $uitvaartwinkelCategorie);
	productenWijzigen($beginpuntUitvaartwinkel, 0, $uitvaartwinkelCategorie);
	
	
	var $itemsInWinkelwagen = [];
	
	var $uitvaartwinkelWinkelmandAantal = $("#uitvaartwinkelWinkelmandAantal");
	$uitvaartwinkelWinkelmandAantal.text($itemsInWinkelwagen.length);

	$("#toonzaalTekst").hide();
	$("#uitklappijlNaarBeneden").hide();
	$("#toonzaalWrapper").css("cursor", "pointer");

	$("#bloemenWrapper").on("click", function(){
		if(!($uitvaartwinkelCategorie == 1)){
			$uitvaartwinkelCategorie = 1;
			$beginpuntUitvaartwinkel = 6;
			getUitvaartwinkelAfbeeldingen($beginpuntUitvaartwinkel, 0, $uitvaartwinkelCategorie);

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
		if(!($uitvaartwinkelCategorie == 2)){
			$uitvaartwinkelCategorie = 2;
			$beginpuntUitvaartwinkel = 6;
			getUitvaartwinkelAfbeeldingen($beginpuntUitvaartwinkel, 0, $uitvaartwinkelCategorie);

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

	$("#uitvaartwinkelPijlLinks").on("click", function(){
		//getUitvaartwinkelAfbeeldingen($beginpuntUitvaartwinkel, 0, $uitvaartwinkelCategorie);
		//getUitvaartwinkelId($beginpuntUitvaartwinkel, 0, $uitvaartwinkelCategorie);
		productenWijzigen($beginpuntUitvaartwinkel, 0, $uitvaartwinkelCategorie);
	});

	$("#uitvaartwinkelPijlRechts").on("click", function(){
		//getUitvaartwinkelAfbeeldingen($beginpuntUitvaartwinkel, 1, $uitvaartwinkelCategorie);
		//getUitvaartwinkelId($beginpuntUitvaartwinkel, 1, $uitvaartwinkelCategorie);
		productenWijzigen($beginpuntUitvaartwinkel, 1, $uitvaartwinkelCategorie);
		
	});

	var $uitvaartwinkelurl = [];
	var $uitvaartwinkelprijs = [];
	var $uitvaartwinkelbeschrijving = [];
	var $uitvaartwinkelrangnummer = [];
	var $uitvaartwinkelProductID = [];
	var $totaalAfbeeldingenUitvaartwinkel;

	//----------- producten constructor

	function productenWijzigen(beginpunt, richting, categorie){
		$.ajax({
			url: "php/indexData.php",
			data: {productId: 'getProductId', categorie: categorie},
			type: 'post',
			dataType: "json",
			success: function(data) {
				$arrProductId = [];
				$arrAlleProductId = [];
				var $data = data;
				$arrAlleProductId = $data;


				var $nieuweBeginPunt;
				var $nieuweEindPunt;
				var $pointer;

				var $test = [];

				if(richting == 0){
					$nieuweBeginPunt = beginpunt - 6;
					$nieuweEindPunt = $nieuweBeginPunt + 6;
					$beginpuntUitvaartwinkel -= 6;
				}
				else{
					$nieuweBeginPunt = beginpunt + 6;
					$nieuweEindPunt = $nieuweBeginPunt + 6;
					$beginpuntUitvaartwinkel += 6;
				}

				for(i = $nieuweBeginPunt; i < ($nieuweBeginPunt + 6); i++){
					//console.log(i);
					$pointer = ((i % $data.length) + $data.length) % $data.length;
					//$pointer += 1;

					$arrProductId.push($data[$pointer]);

				}

				//console.log($arrProductId);

				getProductAfbeelding($arrProductId);
				getProductNaam($arrProductId);
				getProductPrijs($arrProductId);
				
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

				//$productAfbeelding = $data;

				for(i = 0; i < $productAfbeelding.length; i++){
					var $containerPointer = i+1;
					var $container = $("#uitvaartwinkelAfbeelding" + $containerPointer);

					$container.css({
						'background-image': 'url(' + $productAfbeelding[i] + ')',
						'background-position': 'center',
						'background-size': 'cover',
						'background-repeat': 'no-repeat'
					});
				}

				//console.log($productAfbeelding[0]);
			}
		});
	}	

	function getProductNaam(productId){
		$.ajax({
			url: "php/indexData.php",
			data: {productNaam: 'getProductNaam', Id: productId},
			type: 'post',
			dataType: "json",
			success: function(data) {
				$productNaam = [];
				$productNaam = data;

				//console.log($productNaam);
			}
		});
	}

	function getProductPrijs(productId){
		$.ajax({
			url: "php/indexData.php",
			data: {productPrijs: 'getProductPrijs', Id: productId},
			type: 'post',
			dataType: "json",
			success: function(data) {
				$productPrijs = [];
				$productPrijs = data;

				//console.log($productPrijs);
			}
		});
	}

	//----------- setters

	function setProductId(data){
		$arrProductId = [];
		$arrProductId = data;

		console.log($arrProductId);
	}

	function setProductAfbeelding(data){
		
	}

	function setProductNaam(data){
		
	}

	function setProductPrijs(data){
		
	}

	


	function getUitvaartwinkelAfbeeldingen(beginpunt, richting, categorie){
		$.ajax({
			url: "php/indexData.php",
			data: {uitvaartwinkelAfbeelding: 'getUitvaartwinkelAfbeeldingen', categorie: categorie, beginpunt: beginpunt, richting: richting},
			type: 'post',
			dataType: "json",
			success: function(output) {
				for(i = 0; i < output.length; i++){
					var $containerPointer = i+1;
					var $container = $("#uitvaartwinkelAfbeelding" + $containerPointer);

					$container.css({
						'background-image': 'url(' + output[i] + ')',
						'background-position': 'center',
						'background-size': 'cover',
						'background-repeat': 'no-repeat'
					});
				}
			}
		});

		if(richting == 0){
			$beginpuntUitvaartwinkel -= 6;
		}
		else{
			$beginpuntUitvaartwinkel += 6;
		}
	}

	

	function getUitvaartwinkelId(beginpunt, richting, categorie){
		$.ajax({
			url: "php/indexData.php",
			data: {uitvaartwinkelId: 'getUitvaartwinkelId', categorie: categorie, beginpunt: beginpunt, richting: richting},
			type: 'post',
			dataType: "json",
			success: function(output){

				//console.log(output);


			}
		});
		if(richting == 0){
			$beginpuntUitvaartwinkel -= 6;
		}
		else{
			$beginpuntUitvaartwinkel += 6;
		}
	}

	$("#uitvaartwinkelGroteAfbeeldingWrapper").hide();

	var $rangnummer;
	var $geselecteerdProduct;
	//var $geselecteerdAfbeelding;
	//var geselecteerdBeschrijving;
	//var geselecteerdPrijs;

	$("#uitvaartwinkelAfbeelding1").on("click", function(){
		//groteAfbeeldingWeergeven($uitvaartwinkelurl[0], $uitvaartwinkelbeschrijving[0], $uitvaartwinkelprijs[0], $uitvaartwinkelrangnummer[0]);
		//$geselecteerdProduct = $uitvaartwinkelProductID[0];
		/*$geselecteerdBeschrijving = $uitvaartwinkelbeschrijving[0];
		$geselecteerdAfbeelding = $uitvaartwinkelurl[0];
		$geselecteerdPrijs = $uitvaartwinkelprijs[0];*/

		// http://stackoverflow.com/questions/8809876/can-i-get-divs-background-image-url

		var bg = $(this).css('background-image');
        bg = bg.replace('url(','').replace(')','').replace(/\"/gi, "");

        for(i = 0; i < $arrAlleProductId.length; i++){
        	if($arrProductId[0] == $arrAlleProductId[i]){
        		$rangnummer = i + 1;
        	}
        }

        //console.log(bg);
        groteAfbeeldingWeergeven($productAfbeelding[0], $productNaam[0], $productPrijs[0], $rangnummer);
        //console.log($arrProductId.length);
        
        //console.log("de id is " + $arrProductId[0]);

        //getUitvaartwinkelId($beginpuntUitvaartwinkel, 0, $uitvaartwinkelCategorie);

	});
	$("#uitvaartwinkelAfbeelding2").on("click", function(){
		//groteAfbeeldingWeergeven($uitvaartwinkelurl[1], $uitvaartwinkelbeschrijving[1], $uitvaartwinkelprijs[1], $uitvaartwinkelrangnummer[1]);
		//$geselecteerdProduct = $uitvaartwinkelProductID[1];
		
		/*$geselecteerdBeschrijving = $uitvaartwinkelbeschrijving[1];
		$geselecteerdAfbeelding = $uitvaartwinkelurl[1];
		$geselecteerdPrijs = $uitvaartwinkelprijs[1];*/

		for(i = 0; i < $arrAlleProductId.length; i++){
        	if($arrProductId[1] == $arrAlleProductId[i]){
        		$rangnummer = i + 1;
        	}
        }

        groteAfbeeldingWeergeven($productAfbeelding[1], $productNaam[1], $productPrijs[1], $rangnummer);
	});
	$("#uitvaartwinkelAfbeelding3").on("click", function(){
		//groteAfbeeldingWeergeven($uitvaartwinkelurl[2], $uitvaartwinkelbeschrijving[2], $uitvaartwinkelprijs[2], $uitvaartwinkelrangnummer[2]);
		//$geselecteerdProduct = $uitvaartwinkelProductID[2];
		
		/*$geselecteerdBeschrijving = $uitvaartwinkelbeschrijving[2];
		$geselecteerdAfbeelding = $uitvaartwinkelurl[2];
		$geselecteerdPrijs = $uitvaartwinkelprijs[2];*/

		for(i = 0; i < $arrAlleProductId.length; i++){
        	if($arrProductId[2] == $arrAlleProductId[i]){
        		$rangnummer = i + 1;
        	}
        }

        groteAfbeeldingWeergeven($productAfbeelding[2], $productNaam[2], $productPrijs[2], $rangnummer);
	});
	$("#uitvaartwinkelAfbeelding4").on("click", function(){
		//groteAfbeeldingWeergeven($uitvaartwinkelurl[3], $uitvaartwinkelbeschrijving[3], $uitvaartwinkelprijs[3], $uitvaartwinkelrangnummer[3]);
		//$geselecteerdProduct = $uitvaartwinkelProductID[3];
		
		/*$geselecteerdBeschrijving = $uitvaartwinkelbeschrijving[3];
		$geselecteerdAfbeelding = $uitvaartwinkelurl[3];
		$geselecteerdPrijs = $uitvaartwinkelprijs[3];*/

		for(i = 0; i < $arrAlleProductId.length; i++){
        	if($arrProductId[3] == $arrAlleProductId[i]){
        		$rangnummer = i + 1;
        	}
        }

        groteAfbeeldingWeergeven($productAfbeelding[3], $productNaam[3], $productPrijs[3], $rangnummer);
	});
	$("#uitvaartwinkelAfbeelding5").on("click", function(){
		//groteAfbeeldingWeergeven($uitvaartwinkelurl[4], $uitvaartwinkelbeschrijving[4], $uitvaartwinkelprijs[4], $uitvaartwinkelrangnummer[4]);
		//$geselecteerdProduct = $uitvaartwinkelProductID[4];
		
		/*$geselecteerdBeschrijving = $uitvaartwinkelbeschrijving[4];
		$geselecteerdAfbeelding = $uitvaartwinkelurl[4];
		$geselecteerdPrijs = $uitvaartwinkelprijs[4];*/

		for(i = 0; i < $arrAlleProductId.length; i++){
        	if($arrProductId[4] == $arrAlleProductId[i]){
        		$rangnummer = i + 1;
        	}
        }

        groteAfbeeldingWeergeven($productAfbeelding[4], $productNaam[4], $productPrijs[4], $rangnummer);
	});
	$("#uitvaartwinkelAfbeelding6").on("click", function(){
		//groteAfbeeldingWeergeven($uitvaartwinkelurl[5], $uitvaartwinkelbeschrijving[5], $uitvaartwinkelprijs[5], $uitvaartwinkelrangnummer[5]);
		//$geselecteerdProduct = $uitvaartwinkelProductID[5];
		
		/*$geselecteerdBeschrijving = $uitvaartwinkelbeschrijving[5];
		$geselecteerdAfbeelding = $uitvaartwinkelurl[5];
		$geselecteerdPrijs = $uitvaartwinkelprijs[5];*/

		for(i = 0; i < $arrAlleProductId.length; i++){
        	if($arrProductId[5] == $arrAlleProductId[i]){
        		$rangnummer = i + 1;
        	}
        }

        groteAfbeeldingWeergeven($productAfbeelding[5], $productNaam[5], $productPrijs[5], $rangnummer);
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

        $("#groteAfbeeldingNummer").text("Afbeelding " + nummer + " van " + $arrAlleProductId.length);

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







/*
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
*/








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
	var $beginpuntFunerariumenaula = -4;

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
	});

	setFunerariumData($beginpuntFunerariumenaula, 1);

	function setFunerariumData(b, r){
		setFunerariumtitels(b, r);
		setFunerariumAfbeeldingen(b, r);

		if(r == 0){
			$beginpuntFunerariumenaula -= 4;
		}
		else{
			$beginpuntFunerariumenaula += 4;
		}
	}

	function setFunerariumtitels(b, r){
		$.ajax({
			url: 'php/indexData.php',
			data: {funerariumTitel: 'getFunerariumtitels', richting: r, beginpunt: b},
			type: 'post',
			dataType: "json",
			success: function(output) {
				$funerariumKolomTitel1.html('');
				$funerariumKolomTitel2.html('');
				$funerariumKolomTitel3.html('');
				$funerariumKolomTitel4.html('');
				$funerariumKolomTitel1.append(output[0]);
				$funerariumKolomTitel2.append(output[1]);
				$funerariumKolomTitel3.append(output[2]);
				$funerariumKolomTitel4.append(output[3]);
			}
		});
	}

	function setFunerariumAfbeeldingen(b, r){
		$.ajax({
			url: 'php/indexData.php',
			data: {funerariumAfbeelding: 'getFunerariumAfbeeldingen', richting: r, beginpunt: b},
			type: 'post',
			dataType: "json",
			success: function(output) {
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
	$("#condolerenSelectedWrapper").children().hide();

	// ---------------------------------------------------------------------- Over ons













	
});