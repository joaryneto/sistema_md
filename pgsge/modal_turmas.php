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
$inputb = filter_input_array(INPUT_GET, FILTER_DEFAULT);

if(isset($inputb['codigo']))
{
	$codigo = $inputb['codigo'];
}

if($_GET['modal'] == 1) 
{ 

if(@$inputb['ap'] == "1")
{
	$x = 0;
	$SQL = "SELECT * FROM turmas where sistema='".$_SESSION['sistema']."' and descricao like '%".$inputb['descricao']."%';'";
	$RES = mysqli_query($db,$SQL);
	while($row = mysqli_fetch_array($RES))
	{
		$x = 1;
	}
	
	if($x == 1)
	{
	    print('
		<script>
		swal({   
 			   title: "Atenção!",   
 			   text: "Aluno já foi cadastrada, escolha outro.",   
 			   timer: 1500,   
 			   showConfirmButton: false 
 		});
		</script>');
	}
	else
	{
	   $SQL1 = "INSERT into turmas(sistema,curso,descricao,status) values('".$_SESSION['sistema']."','".$_GET['curso']."','".$_GET['descricao']."','".$_GET['situacao']."');";
	   $sucesso = mysqli_query($db,$SQL1);
	   
	   if($sucesso)
	   {
		   print('
		   <script>
		   swal({   
 			   title: "Info",   
 			   text: "Cadastrado com sucesso.",   
 			   timer: 1000,   
 			   showConfirmButton: false 
		   });
		   $(\'#modalap\').modal(\'hide\');
		   requestPage2(\'?br=atu_turmas&load=1\',\'listaturmas\',\'GET\');
		   </script>');
	   }
	   else
	   {
		   print('
		<script>
		swal({   
 			   title: "Atenção!",   
 			   text: "Ocorreu um erro, Entre em contato com Suporte! MSG-3",   
 			   timer: 1500,   
 			   showConfirmButton: false 
 		});
		</script>');
	   }
	}
}
else if(@$inputb['ap'] == "2")
{
	$SQL1 = "UPDATE turmas SET descricao='".$_GET['descricao']."',status='".$_GET['situacao']."' where sistema='".$_SESSION['sistema']."' and codigo='".$codigo."';";
	$sucesso = mysqli_query($db,$SQL1);
	
	if($sucesso)
	{
        print('
		<script>
		swal({   
 			   title: "Info",   
 			   text: "Gravado com sucesso.",   
 			   timer: 1000,   
 			   showConfirmButton: false 
 		});
		</script>');
		//print("<script>window.location.href='sistema.php?url=cad_clientes';</script>");
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-3')</script>");
	}
}

$situacao = 1;
$estado = "";
$cidade = "";
$ensino = "";

if(isset($codigo))
{
	$x = 0;
	$SQL = "SELECT * FROM turmas where sistema='".$_SESSION['sistema']."' and codigo='".$codigo."';";
	$RES = mysqli_query($db,$SQL);
	while($row = mysqli_fetch_array($RES))
	{
		 
		 $x = 1;
		 $codigo = $row['codigo'];
		 $descricao = $row['descricao'];
		 $situacao = $row['status'];
	}
	
	if($x == 0)
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-1')</script>");
		print("<script>window.location.href='sistema.php?url=cad_alunos';</script>");
	}
}

?>
<div class="modal-header">
<h2 class="pmd-card-title-text">Cadastro de Turmas</h2>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
<div class="row">
<div class="col-md-12 col-sm-12"> 
<div class="component-box">
<!--Tabs with Icon example -->
            <script>
			
			$('.c_gravar').on('click',function()
		    {
				<? if(!isset($codigo))
				{?>
				var curso = document.getElementById('curso').value;
				<?}?>
				var descricao = document.getElementById('descricao').value;
				var status = document.getElementById('situacao').value;
				
				
				if(descricao == "")
				{
					swal({   
 			               title: "Atenção",   
 			               text: "Campo Matricula em branco.",   
 			               timer: 1000,   
 			               showConfirmButton: false 
 			           });
				}
				else if(status == "")
				{
					swal({   
 			               title: "Atenção",   
 			               text: "'Campo Situação em branco.",   
 			               timer: 1000,   
 			               showConfirmButton: false 
 			           });
				}
				else
				{
				   <? if(isset($codigo))
				   {?>
			          requestPage2('?br=modal_turmas&codigo=<?=$codigo;?>&descricao='+ descricao +'&situacao='+ status +'&modal=1&ap=2','modals','GET');
				   <? } else {?>
				      requestPage2('?br=modal_turmas&curso='+ curso +'&descricao='+ descricao +'&situacao='+ status +'&modal=1&ap=1','modals','GET');
				   <? } ?>
				}
			});
			
			$('.c_novo').on('click',function()
		    {
				requestPage2('?br=modal_turmas&modal=1','modals','GET');
			});
			
			</script>
			<form class="m-t-40 row" name="laudo" method="post" action="<? if(@$codigo ==""){ echo "sistema.php?url=cad_clientes&ap=1";}else { echo "sistema.php?url=cad_clientes&ap=2&codigo=".@$codigo."";} ?>">
            <?
			  
			   $d = date('YdHis');
			   $matri = $d;
			   $_SESSION['matricula'] = $matri;
			?>
			<? if(Empty($_GET['codigo'])){?>
			<div class="form-group col-md-4 m-t-20"><label>Curso :</label>
			<select name="curso" id="curso" class="form-control" style="width: 100%; height:36px;">
			  <option></option>
			  <option value="0">Educação Infantil</option>
			  <option value="1">Ensino Fundamental</option>
			  <option value="2">Ensino Médio</option>
			</select></div>
			<? } ?>
			<div class="form-group col-md-5 m-t-20"><label>Descrição :</label>
			<!--onKeyPress="return(MascaraMoeda(this,'.','.',event)); "-->
			<input type="text" name="descricao" id="descricao" value="<? if(isset($_GET['codigo'])){ echo $descricao;} ?>" class="form-control" required="required">
			</div>
			<div class="form-group col-md-2 m-t-20"><label>Situação :</label>
			<select name="situacao" id="situacao" class="form-control" style="width: 100%; height:36px;">
				<option>Selecionar Situação</option>
					   <option value="0" <? if(0 == $situacao){ echo "selected"; } ?>>Inativa</option>
					   <option value="1" <? if(1 == $situacao){ echo "selected"; } ?>>Ativa</option>
			</select>
			</div>
			<div class="form-group col-md-12 m-t-20" id="load">
			</div>
			<div class="form-group col-md-12 m-t-20">
			<button type="button" class="btn btn-info c_gravar"><i class="fa fa-plus-circle"></i> Gravar</button>
			<button type="button" class="btn btn-info c_novo"><i class="fa fa-plus-circle"></i> Novo</button>
			</div>
		   </form>
</div>
</div>
</div>
<div class="modal-footer">
</div>
<? 
// --------- FINAL CADASTRO DE CLIENTES -------------//

}
?>