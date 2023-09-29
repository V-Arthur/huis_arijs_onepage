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
	productenWijzigen($beginpuntUitvaartwinkel, 0, $uitvaartwinkelCategorie);

	$("#uitvaartwinkelGroteAfbeeldingWrapper").hide();
	var $rangnummer;	
	var $itemsInWinkelwagen = [];
	
	var $uitvaartwinkelWinkelmandAantal = $("#uitvaartwinkelWinkelmandAantal");
	$uitvaartwinkelWinkelmandAantal.text($itemsInWinkelwagen.length);

	$("#toonzaalTekst").hide();
	$("#uitklappijlNaarBeneden").hide();
	$("#toonzaalWrapper").css("cursor", "pointer");

	$("#bloemenWrapper").on("click", selectBloemen);
	$("#toonzaalWrapper").on("click", selectToonzaal);

	function selectBloemen(){
		if(!($uitvaartwinkelCategorie == 1)){
			$uitvaartwinkelCategorie = 1;
			$beginpuntUitvaartwinkel = 6;
			productenWijzigen($beginpuntUitvaartwinkel, 0, $uitvaartwinkelCategorie);

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
			productenWijzigen($beginpuntUitvaartwinkel, 0, $uitvaartwinkelCategorie);

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
		productenWijzigen($beginpuntUitvaartwinkel, 0, $uitvaartwinkelCategorie);
	});

	$("#uitvaartwinkelPijlRechts").on("click", function(){
		productenWijzigen($beginpuntUitvaartwinkel, 1, $uitvaartwinkelCategorie);
		
	});


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

	$("#uitvaartwinkelAfbeelding1").on("click", function(){
		/*
		var bg = $(this).css('background-image');
        bg = bg.replace('url(','').replace(')','').replace(/\"/gi, "");
		*/
		groteAfbeeldingWeergeven(0);
	});

	$("#uitvaartwinkelAfbeelding2").on("click", function(){
		groteAfbeeldingWeergeven(1);
	});

	$("#uitvaartwinkelAfbeelding3").on("click", function(){
		groteAfbeeldingWeergeven(2);
	});

	$("#uitvaartwinkelAfbeelding4").on("click", function(){
		groteAfbeeldingWeergeven(3);
	});

	$("#uitvaartwinkelAfbeelding5").on("click", function(){
		groteAfbeeldingWeergeven(4);
	});

	$("#uitvaartwinkelAfbeelding6").on("click", function(){
		groteAfbeeldingWeergeven(5);
	});

	var $geselecteerdProductId;

	function groteAfbeeldingWeergeven(geselecteerdVak){
		for(i = 0; i < $arrAlleProductId.length; i++){
        	if($arrProductId[geselecteerdVak] == $arrAlleProductId[i]){
        		$rangnummer = i + 1;
        	}
        }

        $geselecteerdProductId = $arrProductId[geselecteerdVak];

		$("#groteAfbeeldingContainer").css({
			'background-image': 'url(' + $productAfbeelding[geselecteerdVak] + ')',
			'background-position': 'center',
			'background-size': 'contain',
			'background-repeat': 'no-repeat'
		});
		$("#txtOrderAantal").val("");
        $("#groteAfbeeldingBeschrijving").text($productNaam[geselecteerdVak] + " - " + $productPrijs[geselecteerdVak] + " euro");

        $("#groteAfbeeldingNummer").text("Afbeelding " + $rangnummer + " van " + $arrAlleProductId.length);

        $("#uitvaartwinkelGroteAfbeeldingWrapper").show();
	}

	$("#uitvaartwinkelGroteAfbeeldingSluitenKnopWrapper").on("click", function(){
		$("#txtOrderAantal").val("");
		$("#groteAfbeeldingBeschrijving").val("");
		$("#uitvaartwinkelGroteAfbeeldingWrapper").hide();
	});

	$("#uitvaartwinkelBtnSubmitOrder").on("click", function(e){
		e.preventDefault();
		//var $alToegevoegd = false;
		//alert($geselecteerdProductId);
		$.ajax({
			url: "php/indexData.php",
			data: {cookieSetProduct: 'cookieSetProduct', Id: $arrAlleProductId[$rangnummer-1], aantal: 1},
			type: 'post',
			dataType: "json",
			success: function(data) {
				$productPrijs = [];
				$productPrijs = data;

				//console.log(data);

				//console.log($productPrijs);
			}
		});
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

		// if($itemsInWinkelwagen.length > 0){
		// 	winkelwagenOverzichtTonen();
		// }
		getWinkelmandOverzicht();
	});

	$("#uitvaartwinkelWinkelmandOverzichtSluitenKnopWrapper").on("click", function(){
		$("#uitvaartwinkelWinkelmandOverzichtWrapper").hide();
	});

	function getWinkelmandOverzicht(){
		$.ajax({
			url: "php/indexData.php",
			data: {winkelmandOverzicht: 'getWinkelmandOverzicht'},
			type: 'post',
			dataType: "json",
			success: function(data) {
				$('#uitvaartwinkelWinkelmandOverzichtToegevoegdeProducten').empty();
				if(data.length > 0){
					var id = [];
					for(var i in data){
						id[i] = data[i].id;
					}

					//var $div = $("<div>", {id: "foo", "class": "a"});

					for(i = 0; i < id.length; i++){
						$productenGroep = $("<div>", {id: "productenGroep"+ i, "class": "productenGroep", "data-id": id[i]});
						$productenGroepAfbeeldingContainer = $("<div>", {id: "productenGroepAfbeeldingContainer"+ i, "class": "productenGroepAfbeeldingContainer"});
						$productenGroepTekstContainer = $("<div>", {id: "productenGroepTekstContainer"+ i, "class": "productenGroepTekstContainer"});
						$productenGroepBeschrijvingContainer = $("<div>", {id: "productenGroepBeschrijvingContainer"+ i, "class": "productenGroepBeschrijvingContainer"});
						$productenGroepBeschrijving = $("<p>", {id: "productenGroepBeschrijving"+ i, "class": "productenGroepBeschrijving"});
						$productenGroepPrijsContainer = $("<div>", {id: "productenGroepPrijsContainer"+ i, "class": "productenGroepPrijsContainer"});
						$productenGroepPrijs = $("<p>", {id: "productenGroepPrijs"+i, "class": "productenGroepPrijs"});
						$selectieVerwijderenContainer = $("<div>", {id: "selectieVerwijderenContainer"+ i, "class": "selectieVerwijderenContainer", "data-id": id[i]});

						$productenGroep.appendTo($("#uitvaartwinkelWinkelmandOverzichtToegevoegdeProducten"));
						$productenGroep.append($productenGroepAfbeeldingContainer);
						$productenGroep.append($productenGroepTekstContainer);
						$productenGroepTekstContainer.append($productenGroepBeschrijvingContainer);
						$productenGroepBeschrijvingContainer.append($productenGroepBeschrijving);
						$productenGroepTekstContainer.append($productenGroepPrijsContainer);
						$productenGroepPrijsContainer.append($productenGroepPrijs);
						$productenGroepTekstContainer.append($selectieVerwijderenContainer);
					}
					


					getWinkelmandAfbeelding(id);
					getWinkelmandNaam(id);
					getWinkelmandPrijs(id);
				}
				//console.log("producten array lengte: " + data.length);

			}
		});
	}

	/*
	<div class="productenGroep">
	    <div class="productenGroepAfbeeldingContainer">   </div>
	    <div class="productenGroepTekstContainer">
	      	<div class="productenGroepBeschrijvingContainer">
	        	<p class="productenGroepBeschrijving">Naturel nr. 1    </p>  
	      	</div>
	      	<div class="productenGroepPrijsContainer">
	        	<p class="productenGroepPrijs"> 65  </p>
	      	</div>
	      	<div class="selectieVerwijderenContainer">
	        
	      	</div>
	    </div>
	</div>
	*/

	/*
	for(i = 0; i < id.length; i++){
		$productenGroep = $('<div/>').addClass('productenGroep');
		$productenGroepAfbeeldingContainer = $('<div/>').addClass('productenGroepAfbeeldingContainer');
		$productenGroepTekstContainer = $('<div/>').addClass('productenGroepTekstContainer');
		$productenGroepBeschrijvingContainer = $('<div/>').addClass('productenGroepBeschrijvingContainer');
		$productenGroepBeschrijving = $('<p/>').addClass('productenGroepBeschrijving');
		$productenGroepPrijsContainer = $('<div/>').addClass('productenGroepPrijsContainer');
		$productenGroepPrijs = $('<p/>').addClass('productenGroepPrijs');
		$selectieVerwijderenContainer = $('<div/>').addClass('selectieVerwijderenContainer');

		$productenGroep.appendTo($("#uitvaartwinkelWinkelmandOverzichtToegevoegdeProducten"));
		$productenGroep.append($productenGroepAfbeeldingContainer);
		$productenGroep.append($productenGroepTekstContainer);
		$productenGroepTekstContainer.append($productenGroepBeschrijvingContainer);
		$productenGroepBeschrijvingContainer.append($productenGroepBeschrijving);
		$productenGroepTekstContainer.append($productenGroepPrijsContainer);
		$productenGroepPrijsContainer.append($productenGroepPrijs);
		$productenGroepTekstContainer.append($selectieVerwijderenContainer);
	}
	*/

	function getWinkelmandAfbeelding(productId){
		$.ajax({
			url: "php/indexData.php",
			data: {productAfbeelding: 'getProductAfbeelding', Id: productId},
			type: 'post',
			dataType: "json",
			success: function(data) {
				//console.log(data);

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

	function getWinkelmandNaam(productId){
		return $.ajax({
			url: "php/indexData.php",
			data: {productNaam: 'getProductNaam', Id: productId},
			type: 'post',
			dataType: "json",
			success: function(data) {
				//console.log(data);

				for(i = 0; i < data.length; i++){
					var $container = $("#productenGroepBeschrijving" + i);
					$container.text(data[i]);
				}
			}
		});
	}

	function getWinkelmandPrijs(productId){
		$.ajax({
			url: "php/indexData.php",
			data: {productPrijs: 'getProductPrijs', Id: productId},
			type: 'post',
			dataType: "json",
			success: function(data) {
				

				//console.log($productPrijs);

				for(i = 0; i < data.length; i++){
					var $container = $("#productenGroepPrijs" + i);
					$container.text(data[i]);
				}
			}
		});
	}
	
	$("#uitvaartwinkelWinkelmandOverzichtWrapper").on("click", ".selectieVerwijderenContainer", function(e){
		var $id = $(this).attr("data-id");
		var $productenGroep = $(".productenGroep[data-id='" + $id + "']");

		verwijderItemUitWinkelmand($id);

		//$productenGroep.empty();

		//var $productenGroep = $(".productenGroep").find("[data-id='" + $id + "']");
        // console.log($productenGroep.attr("id"));

        // $productenGroep.css({
        // 	"background-color": "blue"
        // })
    });

    function verwijderItemUitWinkelmand(productId){
    	$.ajax({
			url: "php/indexData.php",
			data: {cookieRemoveProduct: 'cookieRemoveProduct', Id: productId},
			type: 'post',
			dataType: "json",
			success: function(data) {
				getWinkelmandOverzicht();
				

				//console.log(data);

				
			}
		});
    }

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

	$("#condolerenNormaalWrapper").children().hide();
	//$("#condolerenVorigeUitvaartenButton").hide();
	$("#condolerenSelectedWrapper").children().hide();

	//getLaatsteOverledeneData();
	var arrRouwbrieven = [];
	var arrCondolerenFoto = [];
	var arrCondolerenNaam = [];
	var arrCondolerenTitel = [];
	var arrCondolerenGeboortedatum = [];
	var arrCondolerenDatumOverlijden = [];
	var arrCondolerenWoonplaats = [];
	var arrCondolerenRouwbrief = [];

	function getLaatsteOverledeneData(){
		$.ajax({
			url: 'php/indexData.php',
			data: {laatsteOverledeneData: 'getLaatsteOverledeneData'},
			type: 'post',
			dataType: "json",
			success: function(data) {
				//console.log(data);

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
					$condolerenRouwbriefHref = $("<a/>", {href: "/huisarijs/source/afbeeldingen/condoleren/rouwbrief/" + data.rouwbrief[i], target: "_blank"});
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
					arrCondolerenRouwbrief[i] = "/huisarijs/source/afbeeldingen/condoleren/rouwbrief/" + data.rouwbrief[i];

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
					$("#condolerenImage"+ i).css({
						'background-image': 'url(' + data[i] + ')',
						'background-position': 'center',
						'background-size': 'contain',
						'background-repeat': 'no-repeat'
					});
					
					arrCondolerenFoto[i] = data[i];
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

	$("#condolerenNormaalWrapper").on("click", ".condolerenIcons.condolerenCondolerenIcon", function(){
		$("#condolerenSelectedImage").css("background", "");
		$("#condolerenSelectedNaam").html("");
		$("#condolerenSelectedTitel").html("");
		$("#condolerenSelectedGeboortedatum").html("");
		$("#condolerenSelectedDatumOverlijden").html("");
		$("#condolerenSelectedWoonplaats").html("");

		// $("#condolerenSelectedBloemenIcon").html("");
		//$("#condolerenNormaalWrapper").children().hide();
		
		//var parent = $(this.get(0).parentNode.parentNode.parentNode);
		var $id = $(this).attr("data-id");
		$("#condolerenNormaalWrapper").children().hide();
		$("#condolerenVorigeUitvaartenButton").hide();

		// for(i = 0; i < 4; i++){
		// 	var $parent = $(".condolerenKolom[data-id='" + i + "']");
		// 	if($parent.attr('data-id') !== $id){
		// 		$parent.children().hide();
		// 	}
		// }

		$("#condolerenSelectedImage").css({
			'background-image': 'url(' + arrCondolerenFoto[$id] + ')',
			'background-position': 'center',
			'background-size': 'contain',
			'background-repeat': 'no-repeat'
		});
		$("#condolerenSelectedNaam").html(arrCondolerenNaam[$id]);
		$("#condolerenSelectedTitel").html(arrCondolerenTitel[$id]);
		$("#condolerenSelectedGeboortedatum").html(arrCondolerenGeboortedatum[$id]);
		$("#condolerenSelectedDatumOverlijden").html(arrCondolerenDatumOverlijden[$id]);
		$("#condolerenSelectedWoonplaats").html(arrCondolerenWoonplaats[$id]);


		// $condolerenSelectedRouwbriefIcon = $("#condolerenSelectedRouwbriefIcon");
		// $condolerenSelectedRouwbriefHref = $("<a/>", {href: "/huisarijs/source/afbeeldingen/condoleren/rouwbrief/" + arrCondolerenRouwbrief[$id], target: "_blank"});
		// $condolerenRouwbriefHref.append($("#condolerenSelectedRouwbriefIcon"));

		$("#condolerenSelectedRouwbriefIconLink").attr({
			"href": arrCondolerenRouwbrief[$id],
			"target": "_blank"
		});

		

		//console.log($parent.html());



		$("#condolerenSelectedWrapper").children().show();
	});

	$("#condolerenBtnTerug").on("click", function(){
		$("#condolerenNormaalWrapper").children().show();
		$("#condolerenSelectedWrapper").children().hide();
		$("#condolerenVorigeUitvaartenButton").show();
	});


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




































	// ---------------------------------------------------------------------- Over ons













	
}); // end document ready