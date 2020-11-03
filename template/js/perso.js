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
	requestPage2('?br=atu_pesquisa&pesquisa='+ pesquisa +'&ap=4','load','GET');
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

$('#aagenda').on('click',function(){	

      $('#dataagenda').val('');
      $('#codigo').val('');
      $('Input[nome]').val('');
      $('#hora').val('');
      $('#agenda').modal('show');

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