var map;
var idInfoBoxAberto;
var infoBox = [];
var markers = [];

function initialize() {	
	var latlng = new google.maps.LatLng(-18.8800397, -47.05878999999999);
	
    var options = {
        zoom: 5,
		center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    map = new google.maps.Map(document.getElementById("mapa"), options);
}

initialize();

/*function abrirInfoBox(id, marker) 
{
	if (typeof(idInfoBoxAberto) == 'number' && typeof(infoBox[idInfoBoxAberto]) == 'object') {
		infoBox[idInfoBoxAberto].close();
	}

	infoBox[id].open(map, marker);
	idInfoBoxAberto = id;
}*/
  
function carregarPontos() {


  $(function () 
  {
    //-----------------------------------------------------------------------
    // 2) Send a http request with AJAX http://api.jquery.com/jQuery.ajax/
    //-----------------------------------------------------------------------
    /*$.ajax({                                      
      url: 'db.php',                  //the script to call to get data         	  
      data: "",                        //you can insert url argumnets here to pass to api.php                                //for example "id=5&parent=6"
      dataType: 'json',                //data format      
      success: function(data)          //on recieve of reply
      {*/
        //var id = data[0].regiao;              //get id
        //var vname = data[0].comentario;           //get name
		
	$.getJSON('pgsl/pontos.php', function(pontos) {
		
		var latlngbounds = new google.maps.LatLngBounds();
		
		$.each(pontos, function(index, ponto) {
			
			var marker = new google.maps.Marker({
				position: new google.maps.LatLng(data[0].Latitude, data[0].Longitude),
				title: "TESTE",
				icon: ""+ [ponto.icon] +""
			});
			
		   /*var conteudo = '<div id="iw-container">' +
                    '<div class="iw-title">' + data[0].regiao + '</div>' +
                    '<div class="iw-content">' +
                      '<div class="iw-subTitle"></div>' +
                      '<img src="img/vistalegre.jpg" alt="Foto do Local" height="115" width="83">' +
                      '<p> </p>' +
                      '<div class="iw-subTitle">Cood: <br>Marcos Vinicius</div>' +
                      '<p>' + data[0].rua + '<br> ' + data[0].casa + ' - ' + data[0].pais + '<br>'+
                      '<br>' + data[0].telefone + '<br>email: ' + data[0].email + '<br></p>'+
                    '</div>' +
                    '<div class="iw-bottom-gradient"></div>' +
                  '</div>';*/
			
			var myOptions = {
				content: "" + conteudo + "",
				pixelOffset: new google.maps.Size(-150, 0)
        	};
			
			//infoBox[data[0].id] = new InfoBox(myOptions);
			//infoBox[data[0].id].marker = marker;
			
			//infoBox[data[0].id].listener = google.maps.event.addListener(marker, 'click', function (e) {
			//	abrirInfoBox(data[0].id, marker);
			//});
			
			markers.push(marker);
			
			latlngbounds.extend(marker.position);
			
		});
		
		var markerCluster = new MarkerClusterer(map, markers);
		
		map.fitBounds(latlngbounds);
		
	});
	
	    //  } 
    });
  }); 
}

carregarPontos();