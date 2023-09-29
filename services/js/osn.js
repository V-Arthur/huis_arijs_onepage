		$(document).foundation();
		// Create an array of styles.
		var styles = [
		  {
			"stylers": [
			  { "gamma": 0.58 },
			  { "lightness": 30 },
			  { "saturation": 0 },
			  { "hue": "#fdbd35" }
			]
		  },{
			"featureType": "water",
			"elementType": "geometry",
			"stylers": [
			  { "color": "#5d5d5d" }
			]
		  },{
			"featureType": "road",
			"elementType": "labels",
			"stylers": [
			  { "visibility": "on" },
			]
		  },{
			"featureType": "road.highway.controlled_access",
			"elementType": "labels",
			"stylers": [
			  { "visibility": "on" }
			]
		  }
		];
		// Create a new StyledMapType object, passing it the array of styles,
		// as well as the name to be displayed on the map type control.
		var styledMap = new google.maps.StyledMapType(styles,
		{name: "Styled Map"});
		var map;
		var parser;
		var provinceParsed = false;
		window.gemeentenActive = true;
		var geocoder;
		var mapParsed = false;
		var LatLngList = new Array();
		var windowHeight = window.innerHeight/2;

		$(document).ready(function(e)
		{
			$(".map_home").css({ 'height': windowHeight + "px" });

			var options = {
				zoom: 8,
			    center: new google.maps.LatLng(50.50, 4.00),
			    mapTypeId: google.maps.MapTypeId.ROADMAP,
			    scrollwheel: false,
			    mapTypeControl: false
			};
			map = new google.maps.Map(document.getElementById("canvas"), options);
			//Associate the styled map with the MapTypeId and set it to display.
			map.mapTypes.set('map_style', styledMap);
			map.setMapTypeId('map_style');
			//open layer netwerken
		    $('.netwerken_btn').click(function(e) {
		        if($(".map_home").is(":visible"))
				{
					$('.pijl').fadeOut(400);
		        	$('.map_home').slideUp('slow', function() {
					   $('.netwerken_menu').slideToggle('slow');
					});
				}
				else
				{
					$('.netwerken_menu').slideToggle('slow');
				}
		    });
		    //open map layer
		    $('.map_btn').click(function(e) {
			    //event.stopPropagation();
			    initialize();
		        if($(".netwerken_menu").is(":visible"))
				{
					$('.netwerken_menu').slideUp('slow');
		        	if($(".map_home").is(":visible"))
					{
						$('.pijl').fadeOut(400);
						$('.map_home').slideToggle(800);
					}
					else
					{
						$('.pijl').fadeIn(400);
						$('.map_home').slideToggle(800, function(){
				            google.maps.event.trigger(map, "resize"); // resize map
				            map.setCenter(new google.maps.LatLng(51.08787, 4.37997)); // set the center
				            map.setZoom(9);
				        });
					}
				}
				else
				{
					if($(".map_home").is(":visible"))
					{
						$('.pijl').fadeOut(400);
						$('.map_home').slideToggle(800);
					}
					else
					{
						$('.pijl').fadeIn(400);
						$('.map_home').slideToggle(800, function(){
				            google.maps.event.trigger(map, "resize"); // resize map
				            map.setCenter(new google.maps.LatLng(51.08787, 4.37997)); // set the center
				            map.setZoom(9);
				        });
					}
				}
		    });
			//schijven van de bollen en zichtbaar/onzichtbaar maken van de netwerken
			$('.netwerken_menu>div').hover(function(){
				var that = $(this);
				$(this).find('img').animate({marginTop:'47px'},{queue:false,duration:500});
				setTimeout(function(){that.find('p').fadeIn(200);}, 250);
				}, function(){
				$(this).find('p').fadeOut(200);
				$(this).find('img').animate({marginTop:'6px'},{queue:false,duration:500});
			});
		});

		function initialize()
		{
			setTimeout(function(){
			if(mapParsed == false)
			{
				//setVisibility('laden', 'inline');
				mapParsed = true;
				geocoder = new google.maps.Geocoder();
				var markers = [];//searchox
				parser = new geoXML3.parser({map: map, processStyles: true});
				//parser.parse(['Municipality.kml', 'Province.kml']);
				parser.parse('Municipality.kml');
				// Create the search box and link it to the UI element.
				var input = document.getElementById('target');
				var searchBox = new google.maps.places.SearchBox(input);
				// [START region_getplaces]
				// Listen for the event fired when the user selects an item from the
				// pick list. Retrieve the matching places for that item.
				google.maps.event.addListener(searchBox, 'places_changed', function() {
				var places = searchBox.getPlaces();
				for (var i = 0, marker; marker = markers[i]; i++) {
				  marker.setMap(null);
				}
				// For each place, get the icon, place name, and location.
				markers = [];
				var bounds = new google.maps.LatLngBounds();
				for (var i = 0, place; place = places[i]; i++) {
				  var image = {
				    url: place.icon,
				    size: new google.maps.Size(71, 71),
				    origin: new google.maps.Point(0, 0),
				    anchor: new google.maps.Point(17, 34),
				    scaledSize: new google.maps.Size(25, 25)
				  };
				  // Create a marker for each place.
				  var marker = new google.maps.Marker({
				    map: map,
				    icon: image,
				    title: place.name,
				    position: place.geometry.location
				  });
				  markers.push(marker);
				  bounds.extend(place.geometry.location);
				}
				//map.fitBounds(results[0].geometry.viewport);
				map.fitBounds(bounds);
				var listener = google.maps.event.addListener(map, "idle", function() {
				if (map.getZoom() > 16) map.setZoom(12);
				google.maps.event.removeListener(listener);
				});
				});
				// [END region_getplaces]
				// Bias the SearchBox results towards places that are within the bounds of the
				// current map's viewport.
				google.maps.event.addListener(map, 'bounds_changed', function() {
				var bounds = map.getBounds();
				searchBox.setBounds(bounds);
				});
				setMarkers();
			}
			}, 800);
		}
		$(function(){
                    $('#searchcontent').focus();
                    $("#searchcontent").click(function() {this.select()});
                     $("#searchcontent_location").click(function() {this.select()});
                    
			$('.b').orbit({animation: 'fade', 'timer': true, 'advanceSpeed': 7000, 'directionalNav': false, 'pauseOnHover': true, 'startClockOnMouseOut': true, 'bullets': false});
			//eerste zoekbalk
			$(".searchbar").keyup(function(event)
			{
				if(event.keyCode != 40 && event.keyCode != 38)
				{
					var searchid = $(this).val();
					var dataString = 'search='+ encodeURIComponent(searchid)+'&type=s';

					if(searchid != '')
					{
						$.ajax({
							type: "GET",
							url: "searchlocation_suggestions.php",//"search_suggestions.php",
							data: dataString,
							cache: false,
							success: function(html)
							{
							$("#result").show();
							$("#result").html(html).show();
							}
						});
					}
				}
				else
				{
					switch (event.keyCode)
					{
					 case 40:
					 {
						  found = 0;
						  $("li").each(function(){
							 if($(this).attr("class") == "selected")
								found = 1;
						  });
                                                  var trimmed = $.trim($("#result li[class='selected'] span").text());
						  if(found == 1)
						  {
							var sel = $("li[class='selected']");
							sel.next().addClass("selected");
							sel.removeClass("selected");
							$("#searchcontent").val(trimmed);
						  }
						  else
							$("#result li:first").addClass("selected");
							$("#searchcontent").val(trimmed);
						 }
					 break;
					 case 38:
					 {
						  found = 0;
						  $("li").each(function(){
							 if($(this).attr("class") == "selected")
								found = 1;
						  });
                                                  var trimmed = $.trim($("#result li[class='selected'] span").text());
						  if(found == 1)
						  {
							var sel = $("li[class='selected']");
							sel.prev().addClass("selected");
							sel.removeClass("selected");
							$("#searchcontent").val(trimmed);
						  }
						  else
							$("#result li:last").addClass("selected");
							$("#searchcontent").val(trimmed);
					 }
					 break;
					}
				}
				if(searchid == '')
				{
					$("#result").hide();
				}return false;
			});
			$(".searchbar").click(function () {
			   $(this).select();
			});

			$(".searchbar").focusout(function(){
				//timeout gebruiken omdat anders het click event niet werkt
				window.setTimeout(function() {
				  $("#result").hide();
				  var sel = $("li[class='selected']");
				  sel.removeClass("selected");
			  	}, 100);
			});
			$("#result").on("click touchend",function(e){
				var $clicked = $(e.target);
				var $name = $(this).find('.selected').html();
				var decoded = $.trim($(this).html($name).text());
				if(decoded!='') $('#searchcontent').val(decoded);
				var sel = $("li[class='selected']");
				sel.removeClass("selected");
				$("#result").hide();
			});
			$("#result").on("mouseover", "li", function(e){
				var hovered = $(e.target);
				$(this).addClass("selected");
			});
			$("#result").on("mouseout",function(e){
				var sel = $("li[class='selected']");
				sel.removeClass("selected");
			});
			$(".submitbtn2").on("click touchend",function(e){
				var nodesArray = Array.prototype.slice.call(document.getElementById("result2").getElementsByClassName('name'));

				if(nodesArray.length <= 1)
				{
					$("#searchform").submit();
				}
				else
				{
					var gemeenteArray = new Array();
					for (var i = 0; i < nodesArray.length; i++) {
						gemeenteArray.push(document.getElementById("result2").getElementsByClassName('name')[i].textContent);
					}
					var cList = $('.gemeente_lijst');
					$('.gemeente_lijst').empty();
					$.each(gemeenteArray, function(i)
					{
					    var li = $('<input type="radio" class="gemeente_radiobtn" name="gemeente' + '" value="' + gemeenteArray[i] + '">' + gemeenteArray[i] + '<br>')
					        .appendTo(cList);
					});
					$("#guide_overlay").css("display", "block");
					$("#gemeente_selectie").css("display", "block");
					positionPopup();
				}
			});
			$(".gemeente_radiobtn").on("click touchend",function(e){
				var gemeente = $(this).val();
				if($.trim(gemeente)!='') $('#searchcontent_location').val($.trim(gemeente));
				$('#searchform').attr('onsubmit', 'return true;');
				$('#searchform').submit();
			});
			//tweede zoekbalk
			$(".searchbar_location").keyup(function(event)
			{
				if(event.keyCode != 40 && event.keyCode != 38)
				{
					var searchid = $(this).val();
                                        var dataString;
					if(searchid != '') var dataString = 'search='+ encodeURIComponent(searchid);

					if(searchid != '')
					{
						$.ajax({
							type: "GET",
							url:"searchlocation_suggestions.php",
							data: dataString,
							cache: false,
							success: function(html)
							{
							$("#result2").show();
							$("#result2").html(html).show();
							}
						});
					}
				}
				else
				{
					switch (event.keyCode)
					{
					 case 40:
					 {
						  found = 0;
						  $("li").each(function(){
							 if($(this).attr("class") == "selected")
								found = 1;
						  });
                                                  
                                                  var trimmed = $.trim($("#result2 li[class='selected'] span").text());
                                                  
						  if(found == 1)
						  {
							var sel = $("li[class='selected']");
							sel.next().addClass("selected");
							sel.removeClass("selected");
							$("#searchcontent_location").val(trimmed);
						  }
						  else  {
							$("#result2 li:first").addClass("selected");
							$("#searchcontent_location").val(trimmed);
                                                        }
						 }
					 break;
					 case 38:
					 {
						  found = 0;
						  $("li").each(function(){
							 if($(this).attr("class") == "selected")
								found = 1;
						  });
                                                   var trimmed = $.trim($("#result2 li[class='selected'] span").text());
						  if(found == 1)
						  {
							var sel = $("li[class='selected']");
							sel.prev().addClass("selected");
							sel.removeClass("selected");
							$("#searchcontent_location").val(trimmed);
						  }
						  else
							$("#result2 li:last").addClass("selected");
							$("#searchcontent_location").val(trimmed);
					 }
					 break;
					}
				}

				if(searchid == '')
				{
					$("#result2").hide();
				}return false;
			});

			$(".searchbar_location").click(function () {
			   $(this).select();
			});

			$(".searchbar_location").on("focusout",function(e){
			  //timeout gebruiken omdat anders het click event niet werkt
			  window.setTimeout(function() {
				  $("#result2").hide();
				  var sel = $("li[class='selected']");
				  sel.removeClass("selected");
			  }, 100);
			});
			$("#result2").on("click touchend",function(e){
				var $clicked = $(e.target);
				var $name = $(this).find('.selected').html();
				var decoded = $(this).html($name).text();
				if($.trim(decoded)!='') $('#searchcontent_location').val($.trim(decoded));
				var sel = $("li[class='selected']");
				sel.removeClass("selected");
				$("#result2").hide();
				//$('#searchform').submit();
			});
			$("#result2").on("mouseover", "li", function(e){
				var hovered = $(e.target);
				$(this).addClass("selected");
			});
			$("#result2").on("mouseout",function(e){
				var sel = $("li[class='selected']");
				sel.removeClass("selected");
			});

			var firstClick = true;
			$(".klm_btn_gemeente").click(function()
			{
				$(".klm_btn_provincie").removeClass("selected_klmbtn");
				$(".klm_btn_gemeente").addClass("selected_klmbtn");
				parser.showDocument(parser.docs[0]);
				if(!firstClick)
				{
					parser.hideDocument(parser.docs[1]);
				}
				gemeentenActive = true;
			});
			$(".klm_btn_provincie").click(function()
			{
				$(".klm_btn_gemeente").removeClass("selected_klmbtn");
				$(".klm_btn_provincie").addClass("selected_klmbtn");
				if(!provinceParsed)
				{
					parser.hideDocument(parser.docs[0]);
					parser.parse('Province.kml');
					provinceParsed = true;
					gemeentenActive = false;
					setVisibility('laden', 'inline');
					firstClick = false;
				}
				else
				{
					parser.hideDocument(parser.docs[0]);
					parser.showDocument(parser.docs[1]);
					gemeentenActive = false;
					firstClick = false;
				}
			});
		});

		function validateMyForm()
		{
			$('#searchcontent').blur();
			$('#searchcontent_location').blur();
			var nodesArray = Array.prototype.slice.call(document.getElementById("result2").getElementsByClassName('name'));
			if(nodesArray.length <= 1 || $('#result2 li').hasClass("selected"))return true;
			else
			{
				var gemeenteArray = new Array();
				for (var i = 0; i < nodesArray.length; i++) {
					gemeenteArray.push(document.getElementById("result2").getElementsByClassName('name')[i].textContent);
				}
				var cList = $('.gemeente_lijst');
				$('.gemeente_lijst').empty();
				$.each(gemeenteArray, function(i)
				{
				    var li = $('<input type="radio" class="gemeente_radiobtn" name="gemeente' + '" value="' + gemeenteArray[i] + '">' + gemeenteArray[i] + '<br>')
				        .appendTo(cList);
				});
				$("#guide_overlay").css("display", "block");
				$("#gemeente_selectie").css("display", "block");
				positionPopup();
				//return false;
			}
		}

                /*
               function setLanguage(taal)
		{
			$.ajax({
				type: "GET",
				url: "setlanguage.php",
				data: 'taal='+taal,
				cache: false,
				success: function()
				{
					location.reload();
				}
			});
		}*/