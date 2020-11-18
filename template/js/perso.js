'user strict'
function logar()
{
    var login = document.getElementById('inputEmail').value;
	var senha = document.getElementById('inputPassword').value;
	
	if(login == "")
	{
		swal('Atenção', 'Preencha os campos login e senha.');
		//window.alert('teste');
	}
    else
	{
		requestPage('?br=atu_login&login='+ login +'&senha='+ senha +'','load','GET');
	}		
}

function pesquisar(pesquisa)
{
	requestPage2('?br=atu_pesquisa&pesquisa='+ pesquisa +'&load=1','load','GET');
}

function agenda(tipo,codigo,cliente,data,hora,nome)
{
   $('#editaagenda').modal('show');
   requestPage2('?br=edit_agendamento&codigo='+ codigo +'&cliente='+ cliente +'&data='+ data +'&hora='+ hora +'&nome='+ nome +'&ap=3','loadagenda','GET');
}

function whats(numero,texto)
{
   window.open("https://api.whatsapp.com/send?phone=55"+ numero +"&text="+ texto.replace(/ /g, "%20") +""); 
}

function agendar()
{	
	var datav = document.getElementById('dataagenda').value;
	var horav = document.getElementById('hora').value;
	var codigo = document.getElementById('codigo').value;
	
	if(datav == "")
	{
		swal('Atenção', 'Selecione uma data.');
	}
	if(horav == "")
	{
		swal('Atenção', 'Selecione a hora.');
	}
	if(codigo == "")
	{
		swal('Atenção', 'Selecione um Cliente.');
	}
	else
	{
	   requestPage2('?br=atu_agendamento&codigo='+ codigo +'&data='+ datav +'&hora='+ horav +'&ap=1&load=1','load','GET');
	}
}

$('#aagenda').on('click',function()
{	
      $('#modalusuario').modal('show');
	  requestPage2('?br=atu_pesquisa&tipo=1&ap=1','modals','GET');
});

$('#reagendarr').on('click',function(){	

    var datav = document.getElementById('dataagenda2').value;
	var horav = document.getElementById('hora2').value;
	var codigo = document.getElementById('codagenda').value;
	
	if(datav == "")
	{
		swal('Atenção', 'Selecione uma data.');
	}
	if(horav == "")
	{
		swal('Atenção', 'Selecione a hora.');
	}
	if(codigo == "")
	{
		swal('Atenção', 'Selecione um Cliente.');
	}
	else
	{
	   requestPage2('?br=atu_agendamento&codigo='+ codigo +'&data='+ datav +'&hora='+ horav +'&ap=2&=load=1','loadagenda','GET');
	}
});


function agendaex(codigo)
{
	requestPage('?br=atu_agendamento&codigo='+ codigo +'&ap=3&load=1','load','GET');
}

$('#agendaex').on('click',function(){	

    var datav = document.getElementById('dataagenda2').value;
	var horav = document.getElementById('hora2').value;
	var codigo = document.getElementById('codagenda').value;
	
	if(datav == "")
	{
		swal('Atenção', 'Selecione uma data.');
	}
	if(horav == "")
	{
		swal('Atenção', 'Selecione a hora.');
	}
	if(codigo == "")
	{
		swal('Atenção', 'Selecione um Cliente.');
	}
	else
	{
	   requestPage2('?br=atu_agendamento&codigo='+ codigo +'&data='+ datav +'&hora='+ horav +'&ap=2','horario2','GET');
	}
});

/* PAGAMENTOS */

$('#btnpagar').on('click',function()
{
	var dinheiro = document.getElementById('dinheiro').value;
	var ctdebito = document.getElementById('ctdebito').value;
	var ctcredito = document.getElementById('ctcredito').value;
	var ted = document.getElementById('ted').value;
	
	requestPage('?br=atu_caixa&dinheiro='+ dinheiro +'&ctdebito='+ ctdebito +'&ctcredito='+ ctcredito +'&ted='+ ted +'&ap=2','loading','GET');
});

/* MENU VERTICAL  */

$('#ldata').on('click',function()
{	
   document.getElementById("btnshow").click();
   requestPage('?br=inicio','conteudo','GET');
});

/* MENU HORIZONTAL  */

$('#catual').on('click',function()
{	
   document.getElementById("btnshow").click();
   requestPage('?br=cad_caixaatual','conteudo','GET');
});

$('#canteriores').on('click',function()
{	
   document.getElementById("btnshow").click();
   requestPage('?br=cad_caixaalteriores','conteudo','GET');
});

$('#cmpagamento').on('click',function()
{	
   document.getElementById("btnshow").click();
   requestPage('?br=cad_cmeiodepagamento','conteudo','GET');
});

/* MENU SGE  */

$('#ldotempo').on('click',function()
{	
   //document.getElementById("btnshow").click();
   //requestPage('?br=linhadotempo','conteudo','GET');
   window.location='sistema.php?url=linhadotempo';
});


$('#relatorio_diario').on('click',function()
{	
    document.getElementById("btnshow").click();
	requestmodal('?br=modal_relatorio&modal=1','modals','GET');
	//$('#modalusuario').modal('show');
});