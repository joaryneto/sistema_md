
const c_r = (str) => {
	return str.normalize('NFD').replace(/[\u0300-\u036f]/g, '') // Remove acentos
		//.replace(''', '') // Substitui espaço e outros caracteres por hífen
		.replace(/\-\-+/g, '')	// Substitui multiplos hífens por um único hífen
		.replace(/(^-+|-+$)/, ''); // Remove hífens extras do final ou do inicio da string
}

$('.registrar').on('click',function()
{
    var login = document.getElementById('login').value;
	var login = document.getElementById('email').value;
	var senha = document.getElementById('senha').value;
	
	if(login == "")
	{
		swal('Atenção', 'Preencha os campos login e senha.');
		//window.alert('teste');
	}
    else
	{
		requestPage('?br=atu_login&login='+ login +'&senha='+ senha +'&ap=2','load','GET');
	}		
});


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
		requestPage('?br=atu_login&login='+ login +'&senha='+ senha +'&ap=2','load','GET');
	}		
}

function pesquisar(pesquisa)
{
	requestPage2('?br=atu_pesquisa&pesquisa='+ pesquisa +'&load=1','load','GET');
}

function p_agenda(pesquisa)
{
	requestPage2('?br=atu_pesquisa&pesquisa='+ pesquisa +'&load=1','load','GET');
}

function agenda(profissional,codigo,cliente,data,hora,nome)
{
   $('#modalap').modal('show');
   requestPage2('?br=atu_pesquisa&codigo='+ codigo +'&profissional='+ c_r(profissional) +'&cliente='+ c_r(cliente) +'&data='+ c_r(data) +'&hora='+ c_r(hora) +'&nome='+ c_r(nome) +'&ap=5','modals','GET');
}

function whats(numero,texto)
{
   window.open("https://api.whatsapp.com/send?phone=55"+ numero +"&text="+ texto.replace(/ /g, "%20") +""); 
}

function agendar()
{	
	var datav = c_r(document.getElementById('dataagenda').value);
	var horav = c_r(document.getElementById('hora').value);
	var codigo = c_r(document.getElementById('codigo').value);
	
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

$('#CusuarioNovo').on('click',function()
{	
	 location='sistema.php?url=cad_usuarios';
});

$('.registrar').on('click',function()
{
    $('#modalform').modal('show');		
	requestPage2('?br=modal_clientes&modal=3','modals','GET');
});

$('.a-cliente').on('click',function()
{
    $('#modalap').modal('show');		
	requestPage2('?br=modal_clientes&modal=3','modals','GET');
});

$('.a-agenda').on('click',function()
{	
    $('#modalap').modal('show');
    requestPage2('?br=atu_pesquisa&tipo=1&ap=1','modals','GET');
});

function recovery()
{	
    $('#modalform').modal('show');
	requestPage2('?br=modal_recovery&modal=1','modals','GET');
}

function extratocaixaanterior(codigo)
{		
    $('#modalap').modal('show');		
	requestPage2('?br=rel_caixaanteriores&codigo='+ codigo ,'modals','GET');
}

$('#cad_cliente').on('click',function()
{	
		
    //$('#modalusuario').modal('show');		
	requestPage2('?br=modal_clientes&modal=3','modals','GET');
});

function agendaex(agendamento)
{
	if(agendamento == "")
	{
	   swal({   
            title: "Atenção",   
            text: "Escolhar um agendamento.",   
            timer: 1000,   
            showConfirmButton: false 
        });
	}
	else
	{
	   requestPage('?br=atu_pesquisa&codigo='+ agendamento +'&ap=8&load=1','load','GET');
	}
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

function v_menuslow()
{
    $(".menu2" ).show( "slow" );
	$(".menu1" ).hide( "slow" );
}

function a_menuslow()
{
    $(".menu1" ).show( "slow" );
	$(".menu2" ).hide( "slow" );
}

function b_menuslow()
{
    $(".menu1" ).hide( "slow" );
	$(".menu2" ).hide( "slow" );
}

$('#ldata').on('click',function()
{
   document.getElementById("btnshow").click();
   requestPage('?br=inicio','conteudo','GET');
});

/* MENU HORIZONTAL  */

$('.catual').on('click',function()
{	
   b_menuslow();
   requestPage('?br=cad_caixaatual','conteudo','GET');
});

$('.canteriores').on('click',function()
{	
   b_menuslow();
   requestPage('?br=cad_caixaalteriores','conteudo','GET');
});

$('.cmpagamento').on('click',function()
{	
   b_menuslow();
   requestPage('?br=cad_cmeiodepagamento','conteudo','GET');
});

$('.cmpagamento').on('click',function()
{	
   b_menuslow();
   requestPage('?br=cad_cmeiodepagamento','conteudo','GET');
});


$(".t-menu").click(function() { 
              
    // Select all list items 
    var listItems = $(".t-menu"); 
              
    // Remove 'active' tag for all list items 
    for (let i = 0; i < listItems.length; i++) 
	{ 
        listItems[i].classList.remove("active"); 
    } 
              
    // Add 'active' tag for currently selected item 
	document.getElementById("btnshow").click();
    this.classList.add("active"); 
}); 

$('.t-gcomissao').on('click',function()
{	
   b_menuslow();
   requestPage('?br=cad_comissao','conteudo','GET');
});

$('.t-pcomissao').on('click',function()
{	
   b_menuslow();
   requestPage('?br=cad_comissaopro','conteudo','GET');
});

$('.t-agenda').on('click',function()
{	
   a_menuslow();
   $('.t-agenda').addClass('active');
   requestPage('?br=agenda','conteudo','GET');
});

$('.t-vendas').on('click',function()
{	
   v_menuslow();
   $('.t-vendas').addClass('active');
   requestPage('?br=cad_vendas','conteudo','GET');
});

$('.t-produtos').on('click',function()
{	
   b_menuslow();
   $('.t-produtos').addClass('active');
   requestPage('?br=cad_produtos','conteudo','GET');
});

$('.t-cadastro').on('click',function()
{	
   b_menuslow();
   requestPage('?br=cad_usuarios','conteudo','GET');
});


function edit_alunos(codigo)
{				
    $('#modalap').modal('show');
	requestPage2('?br=modal_alunos&codigo=' + codigo +'&modal=1','modals','GET');
}

function edit_turmas(codigo)
{				
    $('#modalap').modal('show');
	requestPage2('?br=modal_turmas&codigo=' + codigo +'&modal=1','modals','GET');
}

function edit_disciplinas(codigo)
{				
    $('#modalap').modal('show');
	requestPage2('?br=modal_materias&codigo=' + codigo +'&modal=1','modals','GET');
}
			
$('.sge-t-alunos').on('click',function()
{	
   //b_menuslow();
   requestPage('?br=cad_alunos','conteudo','GET');
});

$('.m-diario').on('click',function()
{	
   $('.t-diario').addClass('active');
   $('.m-diario').addClass('active');
   requestPage('?br=cad_diario','conteudo','GET');
});

$('.t-diario').on('click',function()
{	
   $('.m-diario').addClass('active');
   $('.t-diario').addClass('active');
   requestPage('?br=cad_diario','conteudo','GET');
});

$('.s-turmas').on('click',function()
{	
   requestPage('?br=cad_turmas','conteudo','GET');
});

$('.s-disciplinas').on('click',function()
{	
   requestPage('?br=cad_materias','conteudo','GET');
});

$('.s-matriculas').on('click',function()
{	
   requestPage('?br=cad_matriculas','conteudo','GET');
});


$('.f-receber').on('click',function()
{	
   requestPage('?br=pagarteste','conteudo','GET');
});

$('.f-pagar').on('click',function()
{	
   requestPage('?br=pagartransacao','conteudo','GET');
});

$('.f-notificacao').on('click',function()
{	
   requestPage('?br=pagarnotificacao','conteudo','GET');
});

$('.f-fatura').on('click',function()
{	
   requestPage('?br=cad_fatura','conteudo','GET');
});

$('.f-relatorio').on('click',function()
{	
   requestPage('?br=cad_matriculas','conteudo','GET');
});

$('.t-linhadotempo').on('click',function()
{	
   //b_menuslow();
   $('.t-linhadotempo').addClass('active');
   requestPage('?br=linhadotempo','conteudo','GET');
});

$('.u-cadastro').on('click',function()
{	
   requestPage('?br=cad_usuarios','conteudo','GET');
});

$('.r-config').on('click',function()
{	
   requestPage('?br=cad_configuracoes','conteudo','GET');
});

/* MENU SGE  */

$('#ldotempo').on('click',function()
{	
   //document.getElementById("btnshow").click();
   //requestPage('?br=linhadotempo','conteudo','GET');
   window.location='sistema.php?url=linhadotempo';
});


$('.r-diario').on('click',function()
{	
    $('#modalap').modal('show');
	requestmodal('?br=modal_relatorio&modal=1','modals','GET');
	//$('#modalusuario').modal('show');
});