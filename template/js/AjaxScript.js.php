<? if(empty($_SERVER['HTTP_REFERER']) == true) exit();
header('Content-type: text/javascript');
?>
//<script>

function msgbox(cnpjs,mess)
{
   swal('Atenção', 'Fatura localizada -> '+ cnpjs +' competencia -> '+ mess +'');
}

function semerro(){
	return true;
}
window.onerror=semerro;
	function esconde(){
		window.status=''
	return true
}
function clear_string (field) 
{	   
	document.getElementById(field).value = document.getElementById(field).value.split("'").join("");
	//document.getElementById(field).value = document.getElementById(field).value.split("-").join("");  
	document.getElementById(field).value = document.getElementById(field).value.split("+").join("");
    document.getElementById(field).value = document.getElementById(field).value.split("--").join("");	
	document.getElementById(field).value = document.getElementById(field).value.split("\"").join("");   
	document.getElementById(field).value = document.getElementById(field).value.split("*").join("");	  
	document.getElementById(field).value = document.getElementById(field).value.split("\\").join("");	 
	document.getElementById(field).value = document.getElementById(field).value.split(";").join(""); 		
	//document.getElementById(field).value = document.getElementById(field).value.split("=").join("");		
	document.getElementById(field).value = document.getElementById(field).value.split("$").join("");	 
	document.getElementById(field).value = document.getElementById(field).value.split("#").join("");	
	document.getElementById(field).value = document.getElementById(field).value.split("%").join("");	
	document.getElementById(field).value = document.getElementById(field).value.split("&").join(""); 
}
function abrir(URL,width,height) {
	var left = 50;
	var top = 50;
	
	window.open(URL,'janela', 'width='+width+', height='+height+', top='+top+', left='+left+', scrollbars=yes, status=no, toolbar=no, location=no, directories=no, menubar=no, resizable=no, fullscreen=no');

}

function extraiScript(texto){
     var ini, pos_src, fim, codigo, texto_pesquisa;
     var objScript = null;
     texto_pesquisa = texto.toLowerCase()
     ini = texto_pesquisa.indexOf('<script', 0)
     while (ini!=-1){
         var objScript = document.createElement("script");
         pos_src = texto_pesquisa.indexOf(' src', ini)
         ini = texto_pesquisa.indexOf('>', ini) + 1;
         if (pos_src < ini && pos_src >=0){
             ini = pos_src + 4;
             fim = texto_pesquisa.indexOf('.', ini)+4;
             codigo = texto.substring(ini,fim);
             //codigo = codigo.replace("=","").replace(" ","").replace("\"","").replace("\"","").replace("\'","").replace("\'","").replace(">","");
             objScript.src = codigo;
         }else{
             fim = texto_pesquisa.indexOf('</script>', ini);
             codigo = texto.substring(ini,fim);
             objScript.text = codigo;
         }
         document.body.appendChild(objScript);
         ini = texto.indexOf('<script', fim);
         objScript = null;
     }
 }

function returnQuery(form){
    var elements = form.elements;
    var fields = null;
    for (var i = 0; i < elements.length; i++) {
        if ((name = elements[i].name) && (value = elements[i].value)){
                    if(i == 0){
                        fields = name + "=" + encodeURIComponent(value);
                    } else {
                                    fields += "&"+(name + "=" + encodeURIComponent(value));
                    }
                }
    }
    //alert (fields);
    return fields;
}

function BuscaElementosForm(idForm) 
{
    var elementosFormulario = document.getElementById(idForm).elements;
    var qtdElementos = elementosFormulario.length;
     var queryString = "";
     var elemento;
    this.ConcatenaElemento = function(nome,valor) {
                                 if (queryString.length>0) {
                                     queryString += "&";
                                 }
                                 queryString += encodeURIComponent(nome) + "=" + encodeURIComponent(valor);
                              };
     for (var i=0; i<qtdElementos; i++) 
     {
         elemento = elementosFormulario[i];
         if (!elemento.disabled) 
         {
             switch(elemento.type) 
             {
                 case 'text': case 'password': case 'hidden': case 'textarea':
                     this.ConcatenaElemento(elemento.name,elemento.value);
                     break;
                 case 'select-one':
                     if (elemento.selectedIndex>=0) {
                         this.ConcatenaElemento(elemento.name,elemento.options[elemento.selectedIndex].value);
                     }
                     break;
                 case 'select-multiple':
                     for (var j=0; j<elemento.options.length; j++) {
                         if (elemento.options[j].selected) {
                             this.ConcatenaElemento(elemento.name,elemento.options[j].value);
                         }
                     }
                     break;
                 case 'checkbox': case 'radio':
                     if (elemento.checked) {
                         this.ConcatenaElemento(elemento.name,elemento.value);
                     }
                     break;
             }
         }
     }
     return queryString;
 }

function requestPage(url, div, tipo, campos, hideLoading)
{
	
	//window.alert(tipo);
	
    var ajax = null;
	if(window.ActiveXObject)
	{
		ajax = new ActiveXObject('Microsoft.XMLHTTP');
	    //window.alert(ajax);
    }
	else if(window.XMLHttpRequest)
    {	
        ajax = new XMLHttpRequest();
	}   //window.alert(ajax);
     

	if(ajax != null)
	{
	    if (typeof hideLoading === 'undefined' || hideLoading !== true) 
		{
			$(".loader-screen").fadeIn();
            //document.getElementById(div).innerHTML = '<div style="text-align: center;"><img src="https://images.muaway.net/site/images/loader.gif" /></div>';
        }
		
        lastRequestCache = new Date().getTime();
		ajax.open(tipo, url /*+ "&cache=" + cache*/ , true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send();
		
		ajax.onreadystatechange = function status()
		{
				if(ajax.readyState == 4)
				{
					if(ajax.status == 200 || window.location.href.indexOf("http")==-1)
					{
						document.getElementById(div).innerHTML = ajax.responseText;
						var texto=unescape(ajax.responseText);
						extraiScript(texto);
						$('.loader-screen').fadeOut('slow');
					}
     		  	}
				else if(ajax.readyState == 0)
					$(".loader-screen").fadeIn();
					//document.getElementById(div).innerHTML = '<div style="text-align: center;"><img src="https://images.muaway.net/site/images/loader.gif" /></div>';
                else if(ajax.readyState == 3)
					$(".loader-screen").fadeIn();
                    //document.getElementById(div).innerHTML = '<div style="text-align: center;"><img src="https://images.muaway.net/site/images/loader.gif" /></div>';
				else
					$(".loader-screen").fadeIn();
					//document.getElementById(div).innerHTML = '<div style="text-align: center;"><img src="https://images.muaway.net/site/images/loader.gif" /></div>';
		}

		if(tipo == "POST")
		{
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
			ajax.setRequestHeader("Cache-Control", "no-store, no-cache, must-revalidate");
			ajax.setRequestHeader("Cache-Control", "post-check=0, pre-check=0");
			ajax.setRequestHeader("Pragma", "no-cache");
			ajax.send(campos);
			
			window.alert(campos);
			
			$('.loader-screen').fadeOut('slow');
		}
    	else 
		{
   		  ajax.send(null);
    	}
	}

}

function Page(url, div, tipo, campos, hideLoading)
{
	
	//window.alert(tipo);
	
    var ajax = null;
	if(window.ActiveXObject)
	{
		ajax = new ActiveXObject('Microsoft.XMLHTTP');
	    //window.alert(ajax);
    }
	else if(window.XMLHttpRequest)
    {	
        ajax = new XMLHttpRequest();
	}   //window.alert(ajax);
     

	if(ajax != null)
	{
	    if (typeof hideLoading === 'undefined' || hideLoading !== true) 
		{
			$(".loader-screen").fadeIn();
            //document.getElementById(div).innerHTML = '<div style="text-align: center;"><img src="https://images.muaway.net/site/images/loader.gif" /></div>';
        }
		
        lastRequestCache = new Date().getTime();
		ajax.open(tipo,"?br=" + url /*+ "&cache=" + cache*/ , true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send();
		
		ajax.onreadystatechange = function status()
		{
				if(ajax.readyState == 4)
				{
					if(ajax.status == 200 || window.location.href.indexOf("http")==-1)
					{
						document.getElementById(div).innerHTML = ajax.responseText;
						var texto=unescape(ajax.responseText);
						extraiScript(texto);
						$('.loader-screen').fadeOut('slow');
					}
     		  	}
				else if(ajax.readyState == 0)
					$(".loader-screen").fadeIn();
					//document.getElementById(div).innerHTML = '<div style="text-align: center;"><img src="https://images.muaway.net/site/images/loader.gif" /></div>';
                else if(ajax.readyState == 3)
					$(".loader-screen").fadeIn();
                    //document.getElementById(div).innerHTML = '<div style="text-align: center;"><img src="https://images.muaway.net/site/images/loader.gif" /></div>';
				else
					$(".loader-screen").fadeIn();
					//document.getElementById(div).innerHTML = '<div style="text-align: center;"><img src="https://images.muaway.net/site/images/loader.gif" /></div>';
		}

		if(tipo == "POST")
		{
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
			ajax.setRequestHeader("Cache-Control", "no-store, no-cache, must-revalidate");
			ajax.setRequestHeader("Cache-Control", "post-check=0, pre-check=0");
			ajax.setRequestHeader("Pragma", "no-cache");
			ajax.send(campos);
			
			window.alert(campos);
			
			$('.loader-screen').fadeOut('slow');
		}
    	else 
		{
   		  ajax.send(null);
    	}
	}

}


function requestPage2(url, div, tipo, campos, hideLoading)
{
	
	//window.alert(tipo);
	
    var ajax = null;
	if(window.ActiveXObject)
	{
		ajax = new ActiveXObject('Microsoft.XMLHTTP');
	    //window.alert(ajax);
    }
	else if(window.XMLHttpRequest)
    {	
        ajax = new XMLHttpRequest();
	}   //window.alert(ajax);
     

	if(ajax != null)
	{
	    if (typeof hideLoading === 'undefined' || hideLoading !== true) 
		{
			//$(".loader-screen").fadeIn();
            document.getElementById(div).innerHTML = '<div style="text-align: center;"><img src="template/images/loading_1.gif" /></div>';
        }
		
        lastRequestCache = new Date().getTime();
		ajax.open(tipo, url /*+ "&cache=" + cache*/ , true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send();
		
		ajax.onreadystatechange = function status()
		{
				if(ajax.readyState == 4)
				{
					if(ajax.status == 200 || window.location.href.indexOf("http")==-1)
					{
						document.getElementById(div).innerHTML = ajax.responseText;
						var texto=unescape(ajax.responseText);
						extraiScript(texto);
						$('.loader-screen').fadeOut('slow');
					}
     		  	}
				else if(ajax.readyState == 0)
					//$(".loader-screen").fadeIn();
					document.getElementById(div).innerHTML = '<div style="text-align: center;"><img src="template/images/loading_1.gif" /></div>';
                else if(ajax.readyState == 3)
					//$(".loader-screen").fadeIn();
                    document.getElementById(div).innerHTML = '<div style="text-align: center;"><img src="template/images/loading_1.gif" /></div>';
				else
					//$(".loader-screen").fadeIn();
					document.getElementById(div).innerHTML = '<div style="text-align: center;"><img src="template/images/loading_1.gif" /></div>';
		}

		if(tipo == "POST")
		{
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
			ajax.setRequestHeader("Cache-Control", "no-store, no-cache, must-revalidate");
			ajax.setRequestHeader("Cache-Control", "post-check=0, pre-check=0");
			ajax.setRequestHeader("Pragma", "no-cache");
			ajax.send(campos);
			
			window.alert(campos);
			
			$('.loader-screen').fadeOut('slow');
		}
    	else 
		{
   		  ajax.send(null);
    	}
	}

}


function requestoption(url, div, tipo, campos, hideLoading)
{
	
	//window.alert(tipo);
	$('#'+div+'').attr("disabled", true);
	
    var ajax = null;
	if(window.ActiveXObject)
	{
		ajax = new ActiveXObject('Microsoft.XMLHTTP');
	    //window.alert(ajax);
    }
	else if(window.XMLHttpRequest)
    {	
        ajax = new XMLHttpRequest();
	}   //window.alert(ajax);
     

	if(ajax != null)
	{
	    if (typeof hideLoading === 'undefined' || hideLoading !== true) 
		{
			//$(".loader-screen").fadeIn();
            document.getElementById(div).innerHTML = '<option value="">Carregando...</option>';
        }
		
        lastRequestCache = new Date().getTime();
		ajax.open(tipo, url /*+ "&cache=" + cache*/ , true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send();
		
		ajax.onreadystatechange = function status()
		{
				if(ajax.readyState == 4)
				{
					if(ajax.status == 200 || window.location.href.indexOf("http")==-1)
					{
						
						document.getElementById(div).innerHTML = ajax.responseText;
						var texto=unescape(ajax.responseText);
						extraiScript(texto);
						$('#'+div+'').attr("disabled", false);
						//$('.loader-screen').fadeOut('slow');
					}
     		  	}
				else if(ajax.readyState == 0)
					//$(".loader-screen").fadeIn();
					document.getElementById(div).innerHTML = '<option value="">Carregando...</option>';
                else if(ajax.readyState == 3)
					//$(".loader-screen").fadeIn();
                    document.getElementById(div).innerHTML = '<option value="">Carregando...</option>';
				else
					//$(".loader-screen").fadeIn();
					document.getElementById(div).innerHTML = '<option value="">Carregando...</option>';
		}

		if(tipo == "POST")
		{
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
			ajax.setRequestHeader("Cache-Control", "no-store, no-cache, must-revalidate");
			ajax.setRequestHeader("Cache-Control", "post-check=0, pre-check=0");
			ajax.setRequestHeader("Pragma", "no-cache");
			ajax.send(campos);
			
			window.alert(campos);
			
			//$('.loader-screen').fadeOut('slow');
		}
    	else 
		{
   		  ajax.send(null);
    	}
	}

}


function requestmodal(url, div, tipo, campos, hideLoading)
{
	
	//window.alert(tipo);
	
    var ajax = null;
	if(window.ActiveXObject)
	{
		ajax = new ActiveXObject('Microsoft.XMLHTTP');
	    //window.alert(ajax);
    }
	else if(window.XMLHttpRequest)
    {	
        ajax = new XMLHttpRequest();
	}   //window.alert(ajax);
     

	if(ajax != null)
	{
	    if (typeof hideLoading === 'undefined' || hideLoading !== true) 
		{
            document.getElementById(div).innerHTML = '<div style="text-align: center;"><img src="template/images/loading_1.gif" /></div>';
        }
		
        lastRequestCache = new Date().getTime();
		ajax.open(tipo, url /*+ "&cache=" + cache*/ , true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send();
		
		ajax.onreadystatechange = function status()
		{
				if(ajax.readyState == 4)
				{
					if(ajax.status == 200 || window.location.href.indexOf("http")==-1)
					{
						
						document.getElementById(div).innerHTML = ajax.responseText;
						var texto=unescape(ajax.responseText);
						extraiScript(texto);
						
					}
     		  	}
				else if(ajax.readyState == 0)
					document.getElementById(div).innerHTML = '<div style="text-align: center;"><img src="template/images/loading_1.gif" /></div>';
                else if(ajax.readyState == 3)
                    document.getElementById(div).innerHTML = '<div style="text-align: center;"><img src="template/images/loading_1.gif" /></div>';
				else
					document.getElementById(div).innerHTML = '<div style="text-align: center;"><img src="template/images/loading_1.gif" /></div>';
		}

		if(tipo == "POST")
		{
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
			ajax.setRequestHeader("Cache-Control", "no-store, no-cache, must-revalidate");
			ajax.setRequestHeader("Cache-Control", "post-check=0, pre-check=0");
			ajax.setRequestHeader("Pragma", "no-cache");
			ajax.send(campos);
			
			window.alert(campos);
		}
    	else 
		{
   		  ajax.send(null);
    	}
	}

}

function relatorio(url, div, tipo, campos, hideLoading)
{
	
	//window.alert(tipo);
	
    var ajax = null;
	if(window.ActiveXObject)
	{
		ajax = new ActiveXObject('Microsoft.XMLHTTP');
	    //window.alert(ajax);
    }
	else if(window.XMLHttpRequest)
    {	
        ajax = new XMLHttpRequest();
	}   //window.alert(ajax);
     

	if(ajax != null)
	{
	    if (typeof hideLoading === 'undefined' || hideLoading !== true) 
		{
			//$(".loader-screen").fadeIn();
            document.getElementById(div).innerHTML = '<div style="text-align: center;"><img src="template/images/loading_1.gif" /></div>';
        }
		
        lastRequestCache = new Date().getTime();
		ajax.open(tipo, url /*+ "&cache=" + cache*/ , true);
		ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		ajax.send();
		
		ajax.onreadystatechange = function status()
		{
				if(ajax.readyState == 4)
				{
					if(ajax.status == 200 || window.location.href.indexOf("http")==-1)
					{
						document.getElementById(div).innerHTML = "";
						var texto=unescape(ajax.responseText);
						extraiScript(texto);
						//$('.loader-screen').fadeOut('slow');
					}
     		  	}
				else if(ajax.readyState == 0)
					//$(".loader-screen").fadeIn();
					document.getElementById(div).innerHTML = '<div style="text-align: center;"><img src="template/images/loading_1.gif" /></div>';
                else if(ajax.readyState == 3)
					//$(".loader-screen").fadeIn();
                    document.getElementById(div).innerHTML = '<div style="text-align: center;"><img src="template/images/loading_1.gif" /></div>';
				else
					//$(".loader-screen").fadeIn();
					document.getElementById(div).innerHTML = '<div style="text-align: center;"><img src="template/images/loading_1.gif" /></div>';
		}

		if(tipo == "POST")
		{
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
			ajax.setRequestHeader("Cache-Control", "no-store, no-cache, must-revalidate");
			ajax.setRequestHeader("Cache-Control", "post-check=0, pre-check=0");
			ajax.setRequestHeader("Pragma", "no-cache");
			ajax.send(campos);
			
			window.alert(campos);
			
			$('.loader-screen').fadeOut('slow');
		}
    	else 
		{
   		  ajax.send(null);
    	}
	}

}

function loadPage(pagina,url, div, tipo, campos, hideLoading) 
{
	
    var replacement = {
        "home": "",
        "painelUsuario": "painel-usuario",
        "recuperardados": "recuperar-dados",
        "vip": "goldsways"
    };

    var handle = "?pagAjax=";

    if (url.indexOf(handle) < 0) {
        requestPage(pagina,url, div, tipo, campos, hideLoading);
        return;
    }

    var page = url.substr(url.indexOf(handle) + handle.length);

    if (page.indexOf('&') > -1) {
        page = page.substr(0, page.indexOf('&'));
    }

    if (Object.keys(replacement).length > 0) {
        for (var i in replacement) {
            if (replacement.hasOwnProperty(i) && page === i) 
			{
                page = replacement[i];
            }
        }
    }

    if (window.history.pushState) 
	{
        window.history.pushState('', '', '/' + page);
		//window.alert(teste + div + tipo + campos + hideLoading);
    }

    requestPage(pagina,url, div, tipo, campos, hideLoading);
}

function ajaxLoader(url, div, tipo, campos)
{
    var ajax = null;
	if(window.ActiveXObject)
		ajax = new ActiveXObject('Microsoft.XMLHTTP');
	else if(window.XMLHttpRequest)
		ajax = new XMLHttpRequest();


	if(ajax != null)
	{
		var cache = new Date().getTime();
		ajax.open(tipo, url /*+ "&cache=" + cache*/ , true);
		ajax.onreadystatechange = function status()
		{
				if(ajax.readyState == 4)
				{
					if(ajax.status == 200)
					{
						document.getElementById(div).innerHTML = ajax.responseText;
						var texto=unescape(ajax.responseText);
						extraiScript(texto);
					}
     		  	}
				else if(ajax.readyState == 0)
					document.getElementById(div).innerHTML = '<div style="text-align: center;"><img src="https://images.muaway.net/site/images/loader.gif" /></div>';
                else if(ajax.readyState == 3)
                    document.getElementById(div).innerHTML = '<div style="text-align: center;"><img src="https://images.muaway.net/site/images/loader.gif" /></div>';
				else
					document.getElementById(div).innerHTML = '<div style="text-align: center;"><img src="https://images.muaway.net/site/images/loader.gif" /></div>';
		}

		if(tipo == "POST"){
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
			ajax.setRequestHeader("Cache-Control", "no-store, no-cache, must-revalidate");
			ajax.setRequestHeader("Cache-Control", "post-check=0, pre-check=0");
			ajax.setRequestHeader("Pragma", "no-cache");
			ajax.send(campos);
		}
    	else {
   		ajax.send(null);
    	}
	}

}

function gerar(url, div, tipo, campos)
{
    var ajax = null;
	if(window.ActiveXObject)
		ajax = new ActiveXObject('Microsoft.XMLHTTP');
	else if(window.XMLHttpRequest)
		ajax = new XMLHttpRequest();


	if(ajax != null)
	{
		var cache = new Date().getTime();
		ajax.open(tipo, url /*+ "&cache=" + cache*/ , true);
		ajax.onreadystatechange = function status()
		{
				if(ajax.readyState == 4)
				{
					if(ajax.status == 200)
					{
						document.getElementById(div).innerHTML = ajax.responseText;
						var texto=unescape(ajax.responseText);
						//extraiScript(texto);
						$("#gerarstatus").append(texto);
					}
     		  	}
				else if(ajax.readyState == 0)
					document.getElementById(div).innerHTML = '<center><img src="images/carregando.gif" alt="Carregando..." /><center>';
                else if(ajax.readyState == 3)
                    document.getElementById(div).innerHTML = '<center><img src="images/carregando.gif" alt="Carregando..." /><center>';
				else
					document.getElementById(div).innerHTML = '<center><img src="images/carregando.gif" alt="Carregando..." /><center>';
		}

		if(tipo == "POST"){
			ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
			ajax.setRequestHeader("Cache-Control", "no-store, no-cache, must-revalidate");
			ajax.setRequestHeader("Cache-Control", "post-check=0, pre-check=0");
			ajax.setRequestHeader("Pragma", "no-cache");
			ajax.send(campos);
		}
    	else {
   		ajax.send(null);
    	}
	}

}

function makevisible(cur,which){
	strength=(which==0)? 1 : 0.7
	if (cur.style.MozOpacity)
		cur.style.MozOpacity=strength
	else if (cur.filters)
		cur.filters.alpha.opacity=strength*100
}
function limparPadrao(campo) 
{
	if (campo.value == campo.defaultValue) 
	{
		campo.value = "";
	}
}
function escreverPadrao(campo) 
{
	if (campo.value == "") {
		campo.value = campo.defaultValue;
	}
}
function getRadioValue(strName) {
	var value = 0;
	for (var i = 0; i < document.getElementsByName(strName).length; i++) {
		if (document.getElementsByName(strName)[i].checked == true) {
			value = document.getElementsByName(strName)[i].value;
			break;
		}
	}
	return value;
}

function emptyInput(input) {
    if (input.value == input.defaultValue) {
        input.value = "";
    }
}

function writeDefault(input) {
    if (input.value == "") {
        input.value = input.defaultValue;
    }
}

function str_split(string, split_length) 
{
    if (string === undefined || !string.toString || split_length < 1) {
        return false;
    }
    return string.toString().match(new RegExp('.{1,' + (split_length || '1') + '}', 'g'));
}
function carregarBanco(numero) 
{
    switch(numero)
    {
        case '1':
            document.getElementById('trBB').style.display = '';
            document.getElementById('trCEF').style.display = 'none';    
            document.getElementById('trITAU').style.display = 'none';
            document.getElementById('trBRAD').style.display = 'none'; 
            document.getElementById('trLOTCXQ').style.display = 'none'; 
            document.getElementById('trCCB').style.display = 'none';       
            document.getElementById('trHSBC').style.display = 'none'; 
            document.getElementById('trSANTANDER').style.display = 'none'; 
            break;
        case '2':  
            document.getElementById('trBB').style.display = 'none';
            document.getElementById('trCEF').style.display = '';       
            document.getElementById('trITAU').style.display = 'none';
            document.getElementById('trBRAD').style.display = 'none';
            document.getElementById('trLOTCXQ').style.display = 'none';
            document.getElementById('trCCB').style.display = 'none';       
            document.getElementById('trHSBC').style.display = 'none'; 
            document.getElementById('trSANTANDER').style.display = 'none'; 
            break;   
        case '3':  
            document.getElementById('trBB').style.display = 'none';
            document.getElementById('trCEF').style.display = 'none'; 
            document.getElementById('trITAU').style.display = '';
            document.getElementById('trBRAD').style.display = 'none';
            document.getElementById('trLOTCXQ').style.display = 'none';  
            document.getElementById('trCCB').style.display = 'none';       
            document.getElementById('trHSBC').style.display = 'none'; 
            document.getElementById('trSANTANDER').style.display = 'none'; 
            break;
        case '4':   
            document.getElementById('trBB').style.display = 'none';
            document.getElementById('trCEF').style.display = 'none';    
            document.getElementById('trITAU').style.display = 'none';
            document.getElementById('trBRAD').style.display = '';
            document.getElementById('trLOTCXQ').style.display = 'none'; 
            document.getElementById('trCCB').style.display = 'none';        
            document.getElementById('trHSBC').style.display = 'none'; 
            document.getElementById('trSANTANDER').style.display = 'none';      
            break;
        case '5':   
            document.getElementById('trBB').style.display = 'none';
            document.getElementById('trCEF').style.display = 'none';    
            document.getElementById('trITAU').style.display = 'none';
            document.getElementById('trBRAD').style.display = 'none';
            document.getElementById('trLOTCXQ').style.display = ''; 
            document.getElementById('trCCB').style.display = 'none';      
            document.getElementById('trHSBC').style.display = 'none';   
            document.getElementById('trSANTANDER').style.display = 'none';      
            break;
        case '6':   
            document.getElementById('trBB').style.display = 'none';
            document.getElementById('trCEF').style.display = 'none';    
            document.getElementById('trITAU').style.display = 'none';
            document.getElementById('trBRAD').style.display = 'none';
            document.getElementById('trLOTCXQ').style.display = 'none';  
            document.getElementById('trCCB').style.display = '';         
            document.getElementById('trHSBC').style.display = 'none';
            document.getElementById('trSANTANDER').style.display = 'none';     
            break;
        case '10':   
            document.getElementById('trBB').style.display = 'none';
            document.getElementById('trCEF').style.display = 'none';    
            document.getElementById('trITAU').style.display = 'none';
            document.getElementById('trBRAD').style.display = 'none';
            document.getElementById('trLOTCXQ').style.display = 'none';  
            document.getElementById('trCCB').style.display = 'none';      
            document.getElementById('trHSBC').style.display = '';        
            document.getElementById('trSANTANDER').style.display = 'none';     
            break;
        case '11':   
            document.getElementById('trBB').style.display = 'none';
            document.getElementById('trCEF').style.display = 'none';    
            document.getElementById('trITAU').style.display = 'none';
            document.getElementById('trBRAD').style.display = 'none';
            document.getElementById('trLOTCXQ').style.display = 'none';  
            document.getElementById('trCCB').style.display = 'none';      
            document.getElementById('trHSBC').style.display = 'none';      
            document.getElementById('trSANTANDER').style.display = '';      
            break;
    } 
    carregarOpcoes('trBB', '102030');
    carregarOpcoes('trCEF', '102030'); 
    carregarOpcoes('trITAU', '102030');
    carregarOpcoes('trBRAD', '10203040506070');
    carregarOpcoes('trLOTCXQ', '1020');
    carregarOpcoes('trCCB', '1020');
    carregarOpcoes('trHSBC', '102030');
    carregarOpcoes('trSANTANDER', '1020304050');
    document.getElementById("tipoDepositoBB").options[0].selected = "true";
    document.getElementById("tipoDepositoCEF").options[0].selected = "true";
    document.getElementById("tipoDepositoITAU").options[0].selected = "true";
    document.getElementById("tipoDepositoBRAD").options[0].selected = "true";
    document.getElementById("tipoDepositoLOTCXQ").options[0].selected = "true";
    document.getElementById("tipoDepositoCCB").options[0].selected = "true";
    document.getElementById("tipoDepositoHSBC").options[0].selected = "true";
    document.getElementById("tipoDepositoSANTANDER").options[0].selected = "true";
}
function carregarOpcoes(trBanco, campos) 
{            
    var dumpCampos = new Array();
    dumpCampos = str_split(campos);
    for(i = 0; i < campos.length; i+=2) { 
        document.getElementById(trBanco+''+dumpCampos[i]).style.display = (dumpCampos[i+1] == 0 ? 'none' : '')                                            
    }
    document.getElementById('tipoDepositoF').value = campos;             
} 