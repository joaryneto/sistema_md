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
	requestPage2('?br=atu_login&pesquisa='+ pesquisa +'','load','GET');
}
