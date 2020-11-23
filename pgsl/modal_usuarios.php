<?
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: Não é permitido acessar o arquivo diretamente. </strong>");


if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__))
{
	exit();
}

if(@$_SESSION['menu99'] == false)
{
   //print("<script>window.alert('Erro: Você não tem permissão.')</script>");
   //print("<script>window.location.href='iniciado.php';</script>");
   //exit("<strong> Erro: Você não tem permissão. </strong>");
}

function filtro($nome) 
{ 
	$array1 = array(" ","/","ç","ã","é","í","@","#",); 
	$array2 = array("_","_","c","a","e","i","_","_",);
	return str_replace($array1, $array2, $nome); 
}

if(!Empty($_GET['codigo']))
{
	$res = mysqli_query($db3,"SELECT * FROM usuarios where codigo='".$_GET['codigo']."'");
	
	if($res)
	{

	  $x = 0;
      while($row = mysqli_fetch_array($res))
	  {
		 $cpf = $row['cpf'];
		 $login = $row['login'];
		 $nome = $row['nome'];
		 $senha = $row['senha'];
		 $email = $row['email'];
		 $tipo = $row['tipo'];
		 $situacao = $row['status'];
		 
		 $x = 1;
	  }
	  
	  $res2 = mysqli_query($db3,"SELECT menu FROM permissoes where usuario='".$_GET['codigo']."' and status=1");
	  
	  while($row = mysqli_fetch_array($res2))
      {
		 ///print("<script>window.alert('".$row['menu']."')</script>");
		 
		 Switch($row['menu'])
		 {
			 case 0:
			 $smenu0 = true;
			 break;
			 case 1:
			 $smenu1 = true;
			 break;
			 case 2:
			 $smenu2 = true;
			 break;
			 case 3:
			 $smenu3 = true;
			 break;
			 case 4:
			 $smenu4 = true;
			 break;
			 case 5:
			 $smenu5 = true;
			 break;
			 case 6:
			 $smenu6 = true;
			 break;
			 case 7:
			 $smenu7 = true;
			 break;
			 case 8:
			 $smenu8 = true;
			 break;
			 case 9:
			 $smenu9 = true;
			 break;
			 case 10:
			 $smenu10 = true;
			 break;
			 case 11:
			 $smenu11 = true;
			 break;
			 case 12:
			 $smenu12 = true;
			 break;
			 case 13:
			 $smenu13 = true;
			 break;
			 case 14:
			 $smenu14 = true;
			 break;
			 case 15:
			 $smenu15 = true;
			 break;
			 case 16:
			 $smenu16 = true;
			 break;
			 case 99:
			 $smenu99 = true;
			 break;
		 }
	  }
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-1')</script>");
	}
}
else
{
	$cpf = "";
	$nome = "";
	$senha = "";
	$email = "";
	$tipo = "";
	$situacao = 1;
}
?>		

<?if($_GET['modal'] == 1){

if(!Empty($_GET['codigo']))
{
	$res = mysqli_query($db3,"SELECT * FROM usuarios where codigo='".$_GET['codigo']."'");
	
	if($res)
	{

	  $x = 0;
      while($row = mysqli_fetch_array($res))
	  {
		 $cpf = $row['cpf'];
		 $login = $row['login'];
		 $nome = $row['nome'];
		 $senha = $row['senha'];
		 $email = $row['email'];
		 $tipo = $row['tipo'];
		 $situacao = $row['status'];
		 
		 $x = 1;
	  }
	  
	  $res2 = mysqli_query($db3,"SELECT menu FROM permissoes where usuario='".$_GET['codigo']."' and status=1");
	  
	  while($row = mysqli_fetch_array($res2))
      {
		 ///print("<script>window.alert('".$row['menu']."')</script>");
		 
		 Switch($row['menu'])
		 {
			 case 0:
			 $smenu0 = true;
			 break;
			 case 1:
			 $smenu1 = true;
			 break;
			 case 2:
			 $smenu2 = true;
			 break;
			 case 3:
			 $smenu3 = true;
			 break;
			 case 4:
			 $smenu4 = true;
			 break;
			 case 5:
			 $smenu5 = true;
			 break;
			 case 6:
			 $smenu6 = true;
			 break;
			 case 7:
			 $smenu7 = true;
			 break;
			 case 8:
			 $smenu8 = true;
			 break;
			 case 9:
			 $smenu9 = true;
			 break;
			 case 10:
			 $smenu10 = true;
			 break;
			 case 11:
			 $smenu11 = true;
			 break;
			 case 12:
			 $smenu12 = true;
			 break;
			 case 13:
			 $smenu13 = true;
			 break;
			 case 14:
			 $smenu14 = true;
			 break;
			 case 15:
			 $smenu15 = true;
			 break;
			 case 16:
			 $smenu16 = true;
			 break;
			 case 99:
			 $smenu99 = true;
			 break;
		 }
	  }
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-1')</script>");
	}
}
else
{
	$cpf = "";
	$nome = "";
	$senha = "";
	$email = "";
	$tipo = "";
	$situacao = 1;
}
?>
<div class="modal-header">
<h2 class="pmd-card-title-text">Lista de Usuarios :</h2>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
<form class="form-horizontal">
<div class="form-group "><label>Busca:</label>
<input name="user" type="text" class="form-control" autocomplete="off" onkeyup="javascript: requestPage2('?br=cad_listadeusuarios&pesquisa='+ this.value +'&ap=1','listusuarios','GET');" />
</div>
<div id="listusuarios">
<div class="pmd-table-card pmd-card pmd-z-depth pmd-card-custom-view">
<table class="table pmd-table">
<thead>
<tr>
<th>Nome</th>
<th>Status</th>
</tr>
</thead>
<tbody>
<?
$sql = "SELECT * FROM usuarios limit 10";
$res = mysqli_query($db3,$sql); 
$x = 0;
while($row = mysqli_fetch_array($res))
{
?>
<tr style="cursor: pointer;" onMouseOver="this.style.color='#C0C0C0'" onMouseOut="this.style.color='#67757c'" onclick="javascript: window.location='sistema.php?url=cad_usuarios&codigo=<? echo $row['codigo'];?>';">
<td data-title="Nome"><? echo $row['nome'];?></td>
<td data-title="Status"><? Switch($row['status'])
	 {
	   case 0:
		 echo '<span class="label label-danger">Inativo</span>';
	   break;
	   case 1:
		 echo '<span class="label label-success">Ativo</span>';
	   break;
	   case 2:
		 echo '<span class="label label-warning">Pre-ativo</span>';
	   break;
   }
   ?>
</td>
</tr>
<? $x = 1;
}

if($x == 0)
{
 echo "<tr><td>Nenhum resultado encontrado.</td><td></td><td></td><td></td></tr>";

}
?>
</tbody>	
</table>
</div>
</div>
</form>										 
<div class="modal-footer">
<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Fechar</button>
</div>
<? }else if($_GET['modal'] == 2){?>
<!-- Modal -->
			<div class="modal-header pmd-modal-bordered">
				<h4 class="modal-title" id="myLargeModalLabel"><b>Serviços de Profissional</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="row">
			<div class="col-12">
			<script>
			$('#m_servicos').on('click',function()
			{
				var servico = document.getElementById('servico').value;
				//var datav = document.getElementById('dataagenda2').value;
				
			    requestPage2('?br=atu_servicos&codigo=<? echo $_GET['codigo'];?>&servico='+ servico +'&ap=1&load=1','u_load','GET');
			});
			
			function m_desabilitar(servico)
			{				
			    requestPage2('?br=atu_servicos&servico='+ servico +'&ap=2&load=1','u_load','GET');
			}
			</script>
			<div class="form-group col-md-9 m-t-20"><label>Tipo :</label>
				<select name="servico" id="servico" class="form-control" style="width: 100%; height:36px;" required="required">
                <option value="">Selecionar Tipo</option>
				 <?
				 $SQL2 = "SELECT produtos.codigo, produtos.descricao, produtos.descricao from produtos where produtos.tipo=2 order by produtos.descricao ASC";
				 $RES2 = mysqli_query($db3,$SQL2);
				 while($row = mysqli_fetch_array($RES2))
				 {?>
			         <option value="<? echo $row['codigo'];?>"><? echo $row['descricao'];?></option>
			   <?}?>
            </select>
			</div>
			<div class="form-group col-md-3 m-t-20">
			<button type="submit" class="btn btn-info" id="m_servicos"><i class="fa fa-plus-circle"></i> Gravar</button>
            </div>
			<div class="form-group col-md-2 m-t-20">
			</div>
			<div class="col-md-12 col-sm-12"> 
            <div class="component-box">
			<div class="pmd-table-card pmd-card pmd-z-depth pmd-card-custom-view">
		    <table class="table pmd-table">
				<thead>
					<tr>
						<th class="text-center">Cod.</th>
						<th class="text-center">Serviço</th>
						<th class="text-right">Comissão</th>
					</tr>
				</thead>
				<tbody id="u_load">
				<? 
			     $SQL2 = "SELECT produtos_usuarios.codigo, produtos.descricao from produtos inner join produtos_usuarios on produtos_usuarios.produto=produtos.codigo where produtos_usuarios.usuario='".$_GET['codigo']."' and produtos.tipo=2 and produtos_usuarios.status=1 order by produtos.descricao ASC";
				 $RES2 = mysqli_query($db3,$SQL2);
				 while($row = mysqli_fetch_array($RES2))
				 {
					 
			  ?>
				<tr><!-- color: #20aee3; -->
					<td data-title="Cod."><? echo $row['codigo'];?></td>
					<td data-title="Serviço"><? echo $row['descricao'];?></td>
					<td data-title="Comissão">R$ <? echo number_format($row['totals'],2,",",".");?></td>
					<td><a href="javascript: void(0);" onclick="m_desabilitar(<?=$row['codigo'];?>);"><i class="fa fa-trash-o" style="font-size: 150%; color: red;"></i></a></td>
				</tr>
			  <? $b = 1;
			  
			   } 
			  
			  if($b == 0)
			  {
				 echo '<tr ><!-- color: #20aee3; -->
					<td colspan="5" class="text-center"> Nenhum registro encontrado.</td>
				</tr>';
			  }
			  ?>
				</tbody>
			</table>
		</div></div>
		<div id="listaservicos"></div>
  </div>
</div>
  </div>
</div>
<? }else if($_GET['modal'] == 3){?>
			<div class="modal-header">
				<h4 class="modal-title" id="myLargeModalLabel"><b>Lista de permissões</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">
			<div class="row">
			<div class="col-12">
			<div class="form-group col-md-12 m-t-20">
			<h4>Menu Permissões</h4>
			<div class="switchery-demo m-b-30">
			<input type="checkbox" name="menu[]" value="13" <? if($smenu13 == true and isset($_GET['codigo'])){?> checked <? } ?> data-color="#009efb" /> Cadastro de Empresas<br />
			<input type="checkbox" name="menu[]" value="0" <? if($smenu0 == true and isset($_GET['codigo'])){?> checked <? } ?> data-color="#009efb" /> Exames Enviados<br />
			<input type="checkbox" name="menu[]" value="1" <? if($smenu1 == true and isset($_GET['codigo'])){?> checked <? } ?> data-color="#009efb" /> Cadastro de Exames<br />
			<input type="checkbox" name="menu[]" value="2" <? if($smenu2 == true and isset($_GET['codigo'])){?> checked <? } ?> data-color="#009efb" /> Tabela de Desconto<br />
			<input type="checkbox" name="menu[]" value="3" <? if($smenu3 == true and isset($_GET['codigo'])){?> checked <? } ?> data-color="#009efb" /> Tabela de pagamento a Laudadores<br />
			<input type="checkbox" name="menu[]" value="4" <? if($smenu4 == true and isset($_GET['codigo'])){?> checked <? } ?> data-color="#009efb" /> Enviar Exames<br />
			<input type="checkbox" name="menu[]" value="5" <? if($smenu5 == true and isset($_GET['codigo'])){?> checked <? } ?> data-color="#009efb" /> Laudar Exames<br />
			<input type="checkbox" name="menu[]" value="14" <? if($smenu14 == true and isset($_GET['codigo'])){?> checked <? } ?> data-color="#009efb" /> Laudos Externo<br />
			
			<input type="checkbox" name="menu[]" value="10" <? if($smenu10 == true and isset($_GET['codigo'])){?> checked <? } ?> data-color="#009efb" /> Equiparar exames
			<br />
			<input type="checkbox" name="menu[]" value="6" <? if($smenu6 == true and isset($_GET['codigo'])){?> checked <? } ?> data-color="#009efb" /> Editar Laudo<br />
			<input type="checkbox" name="menu[]" value="7" <? if($smenu7 == true and isset($_GET['codigo'])){?> checked <? } ?> data-color="#009efb" /> Bloquear Laudo<br />
			<!--<input type="checkbox" name="menu[]" value="8" <? if($smenu8 == true and isset($_GET['codigo'])){?> checked <? } ?> class="js-switch" data-color="#009efb" /> Excluir Laudo-->
			<input type="checkbox" name="menu[]" value="9" <? if($smenu9 == true and isset($_GET['codigo'])){?> checked <? } ?> data-color="#009efb" /> Alterar dados<br />
			<input type="checkbox" name="menu[]" value="11" <? if($smenu11 == true and isset($_GET['codigo'])){?> checked <? } ?> data-color="#009efb" /> Gerar fatura<br />
			<input type="checkbox" name="menu[]" value="12" <? if($smenu12 == true and isset($_GET['codigo'])){?> checked <? } ?> data-color="#009efb" /> Faturas geradas<br />
			<input type="checkbox" name="menu[]" value="15" <? if($smenu15 == true and isset($_GET['codigo'])){?> checked <? } ?> data-color="#009efb" /> Resultado do Exame<br />
			<input type="checkbox" name="menu[]" value="16" <? if($smenu16 == true and isset($_GET['codigo'])){?> checked <? } ?> data-color="#009efb" /> Perguntas Pre-definidas<br />
			<input type="checkbox" name="menu[]" value="17" <? if($smenu16 == true and isset($_GET['codigo'])){?> checked <? } ?> data-color="#009efb" /> Relatorio de Produção<br />
			
			
			</div>
			
			<h4>Permissões Geral</h4>
			<div class="switchery-demo m-b-30">
			<input type="checkbox" name="menu[]" value="99" <? if($smenu99 == true and isset($_GET['codigo'])){?> checked <? } ?> data-color="#009efb" /> Permissões de Usuarios
			</div>
			
		</div>
	  </div>
   </div>
</div>
<? }else if($_GET['modal'] == 4){?>
<div id="assinatura" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myLargeModalLabel"><b>Assinatura do Usuario : </b> <? if(isset($_GET['codigo'])){ echo $nome;} ?></h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
			</div>
			<div class="modal-body">
			<div class="row">
			<div class="col-12">
			<div class="card">
			<div class="card-body">
			<div id="assinatura2">
			<script>
			function altfoto(input) 
			{
			  if (input.files && input.files[0]) 
			  {
				  var reader = new FileReader();
			
				  reader.onload = function (e) 
				   {
					 $('#foto').attr('src', e.target.result)
					  $('#imgs').attr('value', e.target.result)
					  //$('#mensagem').attr('value', e.target.result)
					  //$("textarea#mensagem").text(e.target.result)
				  };
			
				reader.readAsDataURL(input.files[0]);
			  }
			}
			</script>
			<label for="img" title="Click aqui">
			<?
			  
			  $file = "./sign/".$empresa.".gif";
			  if(file_exists($file))
			  {
			 ?>
			<img src="./sign/<? echo $empresa;?>.gif" style="height: 200px;width: 450px;" id="foto" />
			<?}else{?>
			<img src="./template/img/sign.gif" style="height: 200px;width: 450px;" id="foto" />
			<? }?>
			</label>
			<input type="file" id="img" name="img" accept="image/gif" onchange="altfoto(this)" style="display: none;">
			<input type="text" id="imgs" name="imgs" accept="image/gif" value="" onchange="altfoto(this)" style="display: none;">
			</div>
			</div>
			</div>
			</div>
			</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-danger waves-effect text-left" data-dismiss="modal">Fechar</button>
			</div>
		</div>
		
		<!-- /.modal-content -->
	</div>
	
	<!-- /.modal-dialog -->
</div>									
<? } ?>					