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


	// ---------------------------------------------------------------------- funerarium en aula

	//var images = ['../source/afbeeldingen/funerarium_en_aula/inkom_2.jpg'];

	//var $div = $("#funerariumAfbeeldingContainer1");

	//$("<img />").attr("src", val).appendTo($div);

	//$div.prepend('<img id="theImg" src="source/afbeeldingen/funerarium_en_aula/inkom_2.jpg" />')

	//$div.css('background-image', 'url(source/afbeeldingen/funerarium_en_aula/inkom_2.jpg)');
	//$div.css('background-position', 'center');
	//$div.css('background-size', 'cover');

	var sourceFolder = "source/afbeeldingen/funerarium_en_aula/";
	var fileExtension = ".jpg";
/*
	$.ajax({
		url: sourceFolder,
		success: function(data){
			//$(data).find("a:contains(" + fileextension + ")").each(function () {

			alert(data.length);

			//});
		}
	});

*/
	var $lAfbeelding;
	var $nieuwMeestRechtseAfbeelding;
	//var $eersteFunerariumAfbeelding;
	//var $laatsteFunerariumAfbeelding;

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
		//console.log("eersteFunerariumAfbeelding: " + $lAfbeelding);
		changeFunerariumAfbeeldingenLinks($nieuwMeestRechtseAfbeelding);
	});

	$("#funerariumPijlRechts").on("click", function(){
		//console.log("laatsteFunerariumAfbeelding: " + $lAfbeelding);
		changeFunerariumAfbeeldingenRechts($nieuwMeestRechtseAfbeelding);


	});

	function changeFunerariumAfbeeldingenLinks($meestRechtseAfbeeldingVorigeReeks){
		$.ajax({
			url: "xml/funerariumenaula.xml",
			dataType: "xml",
			success: function(data){
				// $(xml).find("CDs CD").eq(index);

				//console.log("meestRechtseAfbeeldingVorigeReeks: " + $meestRechtseAfbeeldingVorigeReeks);

				var $xml = $(data);
				var $titel = [];
				var $url = [];
				var $pointer;
				var $totaalAfbeeldingen = $xml.find('afbeelding').length - 1;

				$nieuwMeestRechtseAfbeelding = $meestRechtseAfbeeldingVorigeReeks - 4;

				//var $eersteAfbeelding = $meestRechtseAfbeeldingVorigeReeks - 3;
				//var $beginAfbeeldingen = $meestRechtseAfbeeldingVorigeReeks - 7;
				//console.log("$meestRechtseAfbeeldingVorigeReeks: " + $meestRechtseAfbeeldingVorigeReeks);
				//console.log("$beginAfbeeldingen: " + $beginAfbeeldingen);

				//var $vierdeAfbeelding = $xml.find('afbeelding').index(4);
				//console.log("vierde afbeelding: " + $xml.find('url').eq(0).text());


				for(i = $nieuwMeestRechtseAfbeelding; i > $nieuwMeestRechtseAfbeelding - 4; i--){
					//console.log("beginAfbeeldingen: " + $beginAfbeeldingen);
					$pointer = i % ($totaalAfbeeldingen + 1);
					console.log($pointer);


					// nieuwe manier, door eq() te gebruiken
					$titel.push($xml.find('titel').eq($pointer).text());
					$url.push($xml.find('url').eq($pointer).text());

					/*

					var $afbeeldingen = $xml.find('afbeelding[id="' + $pointer + '"]');

					//console.log($afbeeldingen.attr('id'));

					$titel.push($afbeeldingen.find('titel').text());
					$url.push($afbeeldingen.find('url').text());
					*/
					
				}

				//$laatsteFunerariumAfbeelding = $beginAfbeeldingen + 1;
				//$eersteFunerariumAfbeelding = $beginAfbeeldingen - 4;
				//$lAfbeelding = $meestRechtseAfbeeldingVorigeReeks - 4;

				// console.log("$titel links: " + $titel);

				changeFunerariumAfbeeldingenHTMLCSS($titel, $url, 0);
				/*
				$funerariumKolomTitel1.html('');
				$funerariumKolomTitel2.html('');
				$funerariumKolomTitel3.html('');
				$funerariumKolomTitel4.html('');
				$funerariumKolomTitel1.append($titel[3]);
				$funerariumKolomTitel2.append($titel[2]);
				$funerariumKolomTitel3.append($titel[1]);
				$funerariumKolomTitel4.append($titel[0]);

				$funerariumAfbeelding1.css({
					'background-image': 'url(' + $url[3] + ')',
					'background-position': 'center',
					'background-size': 'cover'
				});

				$funerariumAfbeelding2.css({
					'background-image': 'url(' + $url[2] + ')',
					'background-position': 'center',
					'background-size': 'cover'
				});

				$funerariumAfbeelding3.css({
					'background-image': 'url(' + $url[1] + ')',
					'background-position': 'center',
					'background-size': 'cover'
				});

				$funerariumAfbeelding4.css({
					'background-image': 'url(' + $url[0] + ')',
					'background-position': 'center',
					'background-size': 'cover'
				});
				*/
				
			}
		});
		
	}

	function changeFunerariumAfbeeldingenRechts($meestRechtseAfbeeldingVorigeReeks){
		$.ajax({
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
					//console.log("beginAfbeeldingen: " + $beginAfbeeldingen);
					$pointer = i % ($totaalAfbeeldingen + 1);
					console.log($pointer);

					// nieuwe manier, door eq() te gebruiken
					$titel.push($xml.find('titel').eq($pointer).text());
					$url.push($xml.find('url').eq($pointer).text());

					//console.log("vierde afbeelding: " + $xml.find('url').eq(0).text());

					// -------- oude manier, door id te gebruiken
					//var $afbeeldingen = $xml.find('afbeelding[id="' + $pointer + '"]');

					//console.log($afbeeldingen.attr('id'));

					//$titel.push($afbeeldingen.find('titel').text());
					//$url.push($afbeeldingen.find('url').text());
					
				}

				//$laatsteFunerariumAfbeelding = $beginAfbeeldingen + 3;
				//eersteFunerariumAfbeelding = $beginAfbeeldingen - 1;

				$nieuwMeestRechtseAfbeelding = $meestRechtseAfbeeldingVorigeReeks + 4;

				changeFunerariumAfbeeldingenHTMLCSS($titel, $url, 1);

				/*
				$funerariumKolomTitel1.html('');
				$funerariumKolomTitel2.html('');
				$funerariumKolomTitel3.html('');
				$funerariumKolomTitel4.html('');
				$funerariumKolomTitel1.append($titel[0]);
				$funerariumKolomTitel2.append($titel[1]);
				$funerariumKolomTitel3.append($titel[2]);
				$funerariumKolomTitel4.append($titel[3]);

				$funerariumAfbeelding1.css({
					'background-image': 'url(' + $url[0] + ')',
					'background-position': 'center',
					'background-size': 'cover'
				});

				$funerariumAfbeelding2.css({
					'background-image': 'url(' + $url[1] + ')',
					'background-position': 'center',
					'background-size': 'cover'
				});

				$funerariumAfbeelding3.css({
					'background-image': 'url(' + $url[2] + ')',
					'background-position': 'center',
					'background-size': 'cover'
				});

				$funerariumAfbeelding4.css({
					'background-image': 'url(' + $url[3] + ')',
					'background-position': 'center',
					'background-size': 'cover'
				});
				*/
				
			}
		});
	}

	function changeFunerariumAfbeeldingenHTMLCSS(titel, url, richting){
		if(ricthing = 0){
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



	//$("#condolerenNormaalWrapper").children().hide();
	$("#condolerenSelectedWrapper").children().hide();
	
});