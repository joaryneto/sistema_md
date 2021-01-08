<?
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: Não é permitido acessar o arquivo diretamente. </strong>");


if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__))
{
	exit();
}

$inputb = filter_input_array(INPUT_GET, FILTER_DEFAULT);

if(@$_SESSION['menu99'] == false)
{
   //print("<script>window.alert('Erro: Você não tem permissão.')</script>");
   //print("<script>window.location.href='iniciado.php';</script>");
   //exit("<strong> Erro: Você não tem permissão. </strong>");
}

       $matricula = "";
       $nome = "";
	   $cpf = "";
       $sexo = "";
       $txtNascimento = "";
       $endereco = "";
       $numero = "";
       $bairro = "";
       $cep = "";
       $complemento = "";
       $estado = "";
       $cidade = "";
       $ensino = "";
       $turma = "";
       $email = "";
       $nomemae = "";
       $cpfmae = "";
       $rgmae = "";
       $emissormae = "";
       $telefonemae = "";
       $celularmae = "";
       $localtrabmae = "";
       $nomepai = "";
       $cpfpai = "";
       $rgpai = "";
       $emissorpai = "";
       $telefonepai = "";
       $celularpai = "";
       $localtrabpai = "";
       $situacao = "";

if(isset($_GET['codigo']))
{
	$SQL = "SELECT * FROM matriculas where sistema='".$_SESSION['sistema']."' and codigo='".$_GET['codigo']."'";
	$sucesso = mysqli_query($db,$SQL);
	
	if($sucesso)
	{
      while($row = mysqli_fetch_array($sucesso))
	  {
 
       $matricula = $row['matricula'];
       $nome = $row['nome'];
	   $cpf = $row['cpf'];
       $sexo = $row['sexo'];
       $txtNascimento = $row['txtNascimento'];
       $endereco = $row['endereco'];
       $numero = $row['numero'];
       $bairro = $row['bairro'];
       $cep = $row['cep'];
       $complemento = $row['complemento'];
       $estado = $row['estado'];
       $cidade = $row['cidade'];
       $ensino = $row['ensino'];
       $turma = $row['turma'];
       $email = $row['email'];
       $nomemae = $row['nomemae'];
       $cpfmae = $row['cpfmae'];
       $rgmae = $row['rgmae'];
       $emissormae = $row['emissormae'];
       $telefonemae = $row['telefonemae'];
       $celularmae = $row['celularmae'];
       $localtrabmae = $row['localtrabmae'];
       $nomepai = $row['nomepai'];
       $cpfpai = $row['cpfpai'];
       $rgpai = $row['rgpai'];
       $emissorpai = $row['emissorpai'];
       $telefonepai = $row['telefonepai'];
       $celularpai = $row['telefonepai'];
       $localtrabpai = $row['localtrabpai'];
       $situacao = $row['status'];
	   
	   if(Empty($cpf))
	   {
		   if(Empty($cpfmae))
		   {
		      $cpf = $cpfmae;
		   }
		   else
		   {
			   $cpf = $cpfpai;
		   }
	   }
	   
	  }
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-1')</script>");
	}
}

if(@$_GET['modal'] == 1) 
{ 

?>
<div class="modal-header">
<h4 class="modal-title" id="myLargeModalLabel"><b>Lista de Alunos : </h4>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
<div class="row">
<div class="col-12">
<script>
function mpesquisa()
{
	var texto = document.getElementById('pesquisa').value;
	
	requestPage2('?br=modal_matriculas&load=1&pesquisa='+ texto +'','list','GET');
}

function m_matriculas(codigo)
{
	$('#modalap').modal('hide');
	requestPage('?br=cad_matriculas&codigo='+ codigo +'','conteudo','GET');
}
</script>
<div class="form-group"><label>Pesquisar :</label>
<input name="pesquisa" id="pesquisa" type="text" class="form-control" onkeypress="mpesquisa();" />
</div>
<div class="pmd-table-card pmd-card pmd-z-depth pmd-card-custom-view">
<table class="table pmd-table">
<thead>
<tr>
<th>Matricula</th>
<th>Aluno</th>
<th>Status</th>
</tr>
</thead>
<tbody id="list">
</tbody>
</table>
</div>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Fechar</button>
</div>
<? 
// --------- FINAL CADASTRO DE CLIENTES -------------//

}
else if(@$inputb['modal'] == 2)
{	
?>
<div class="modal-header">
	<h4 class="modal-title" id="myLargeModalLabel"><b>Responsaveis : </h4>
	<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
<div class="row">

<div class="form-group col-md-5 m-t-20"><label>Nome :</label>
<input type="text" name="rnome" id="rnome" class="form-control" required="required">
</div>
<div class="form-group col-md-3 m-t-20"><label>CPF :</label>
<input type="text" name="rcpf" id="rcpf" class="form-control" required="required">
</div>
<div class="form-group col-md-2 m-t-20"><label>RG :</label>
<input type="text" name="rrg" id="rrg" class="form-control" required="required">
</div>
<div class="form-group col-md-2 m-t-20"><label>Telefone :</label>
<input type="text" name="rtelefone" id="rtelefone" class="form-control" required="required">
</div>
<div class="form-group col-md-5 m-t-20"><label>Parentesco :</label>
<input type="text" name="parentesco" id="parentesco" class="form-control" required="required">
</div>
<div class="form-group col-md-5 m-t-20"><label>Autorização para buscar :</label>
<select class="form-control" name="autorizacao" id="autorizacao" required="required">
	 <option value="">Selecionar</option>
	 <option value="0">NÃO</option>
	 <option value="1">SIM</option>
</select>
</div>
<script>
$('.gravar').on('click',function()
{	
    var rnome = document.getElementById('rnome').value;
	var rcpf = document.getElementById('rcpf').value;
	var rrg = document.getElementById('rrg').value;
	var rtelefone = document.getElementById('rtelefone').value;
	var parentesco = document.getElementById('parentesco').value;
	var autorizacao = document.getElementById('autorizacao').value;
				
	if(rnome == "")
		{
			swal({   
 			 title: "Atenção",   
 			 text: "Campo Nome em branco.",   
 			 timer: 1000,   
 			 showConfirmButton: false 
 	    });
	}
	else if(rcpf == "")
		{
			swal({   
 			 title: "Atenção",   
 			 text: "Campo CPF em branco.",   
 			 timer: 1000,   
 			 showConfirmButton: false 
 	    });
	}
	else if(rrg == "")
		{
			swal({   
 			 title: "Atenção",   
 			 text: "Campo RG em branco.",   
 			 timer: 1000,   
 			 showConfirmButton: false 
 	    });
	}
	else if(rtelefone == "")
		{
			swal({   
 			 title: "Atenção",   
 			 text: "Campo Telefone em branco.",   
 			 timer: 1000,   
 			 showConfirmButton: false 
 	    });
	}
	else if(parentesco == "")
		{
			swal({   
 			 title: "Atenção",   
 			 text: "Campo Parentesco em branco.",   
 			 timer: 1000,   
 			 showConfirmButton: false 
 	    });
	}
	else if(autorizacao == "")
		{
			swal({   
 			 title: "Atenção",   
 			 text: "Campo Autorização em branco.",   
 			 timer: 1000,   
 			 showConfirmButton: false 
 	    });
	}
    else
    {
	   requestPage('?br=cad_listaresponsavel&codigo=<? echo $_GET['codigo'];?>&nome='+ rnome +'&cpf='+ rcpf +'&rg='+ rrg +'&telefone='+ rtelefone +'&parentesco='+ parentesco +'&autorizacao='+ autorizacao +'&ap=1&list=1','listb','GET');
	}
});
</script>
<div class="form-group col-md-2 m-t-20"><label>&nbsp;</label>
<button class="btn btn-info gravar" type="button"> Adicionar </button>
</div>
<div class="col-12">
<div class="pmd-table-card pmd-card pmd-z-depth pmd-card-custom-view">
<table class="table pmd-table">
<thead>
   <tr>
	<th>Responsavel</th>
	<th>Aluno</th>
	<th>X</th>
   </tr>
 </thead>
<tbody id="listb">
<? 
  $SQL = "SELECT responsavel.codigo,responsavel.nome as resp,matriculas.nome as aluno FROM responsavel inner join matriculas on matriculas.codigo=responsavel.matricula 
  where responsavel.sistema='".$_SESSION['sistema']."' and responsavel.matricula='".$_GET['codigo']."'"; 
  $RESB = mysqli_query($db,$SQL);
  $b = 0;
  while($rowb = mysqli_fetch_array($RESB))
  {
	  
?>
   <tr>
	<td><? echo $rowb['resp'];?></td>
	<td><? echo $rowb['aluno'];?></td>
	<td><a class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="" data-original-title="Excluir" style="font-size: 150%; color: red;" href="javascript: WEB(0);" Onclick="javascript: ajaxLoader('?br=cad_listaresponsavel&codigo=<? echo $_GET['codigo'];?>&codres=<? echo $rowb['codigo'];?>&excluir=1&list=1','ltresponsavel','GET');"><a></td>
</tr>
	   
<? $b = 1; }
?>
<?
if($b == 0)
{
	echo "<tr>
	   <td>Nenhum encontrado</td>
	   <td></td>
		  <td></td>
		 </tr>";
}
?>
</tbody>
</table>
</div>
</div>
</div>
</div>
<div class="modal-footer">
</div>
<?}
else if(@$inputb['modal'] == 3)
{
   $SQL = "SELECT * FROM responsavel where sistema='".$_SESSION['sistema']."' and nome like '%".$_GET['nome']."%'";
   $RES = mysqli_query($db,$SQL);
   $x = 0;
   while($row = mysqli_fetch_array($RES))
   {
      $x = 1;
   }

   if($x == 1)
   {
	   print("<script>window.alert('Responsavel ja cadastrado!')</script>");
   }
   else
   {

       $SQLD = "INSERT INTO responsavel(sistema,matricula,nome,cpf,rg,telefone,autorizacao,parentesco) VALUES('".$_SESSION['sistema']."','".$_GET['codigo']."','".$_GET['nome']."','".$_GET['cpf']."','".$_GET['rg']."','".$_GET['telefone']."','".$_GET['autorizacao']."','".$_GET['parentesco']."');";
       $RES = mysqli_query($db,$SQLD);
   }
}
if(@$_GET['load'] == 1)
{
?>
<? 

$sql = "SELECT * FROM matriculas where sistema='".$_SESSION['sistema']."' and  nome like '%".$_GET['pesquisa']."%' or sistema='".$_SESSION['sistema']."' and  nomepai like '%".$_GET['pesquisa']."%' or sistema='".$_SESSION['sistema']."' and nomemae like '%".$_GET['pesquisa']."%'";
$res = mysqli_query($db,$sql); 
while($row = mysqli_fetch_array($res))
{
?>
<tr onclick="m_matriculas(<? echo $row['codigo'];?>);">
<td><? echo $row['matricula'];?></td>
<td><? echo $row['nome'];?></td>
<td><? Switch($row['status'])
            {
				case 0:
				echo "Inativo";
				break;
				case 1:
				echo "Ativo";
				break;
				case 2:
				echo "Pre-matricula";
				break;
			}?></td>
</tr>
<? 
}

if($res == false)
{
	echo "Nenhum resultado encontrado.";
}
	
?>
<?
}
?>