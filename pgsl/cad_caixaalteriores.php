<?
$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: Não é permitido acessar o arquivo diretamente. </strong>");


if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__))
{
	exit();
}

//if($_SESSION['menu3'] == false)
//{
//   print("<script>window.alert('Erro: Você não tem permissão.')</script>");
//   print("<script>window.location.href='iniciado.php';</script>");
//   //exit("<strong> Erro: Você não tem permissão. </strong>");
//}

if(isset($_GET['codigo']))
{
	$SQL = "SELECT diario.turma,diario.materia,diario.periodo,diario.data,diario.conteudo,diario.texto,materias.descricao as mdescricao,turmas.descricao as tdescricao,periodo.descricao as pdescricao FROM diario 
	inner join materias on materias.codigo=diario.materia 
	inner join turmas on turmas.codigo=diario.turma
	inner join periodo on periodo.codigo=diario.periodo
	where diario.codigo='".$_GET['codigo']."'";
	
	$sucesso = mysqli_query($db,$SQL);
	
	if($sucesso)
	{
      while($row = mysqli_fetch_array($sucesso))
	  {
		 $turma = $row['turma'];
		 $disciplina = $row['materia'];
		 $periodo = $row['periodo'];
		 $data = $row['data'];
		 $conteudo = $row['conteudo'];
		 $texto = $row['texto'];
		 $pdescricao = $row['pdescricao'];
		 $tdescricao = $row['tdescricao'];
		 $mdescricao = $row['mdescricao'];
		 
		 //print("<script>window.alert('TESTE ".$descricao.",".$valor."')</script>");
	  }
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-1')</script>");
	}
}

if(@$_GET['ap'] == "1")
{
	$sucesso = mysqli_query($db,"SELECT * FROM diario where turma='".$_POST['turma']."' and materia='".$_POST['disciplina']."' and periodo='".$_POST['periodo']."' and data='".revertedata($_POST['txtdata'])."' and conteudo like '%'".$_POST['conteudo']."'%'");
	
	if($sucesso)
	{
	    print("<script>window.alert('Conteudo ja cadastrada!')</script>");
		print("<script>window.location.href='iniciado.php?url=cad_diario';</script>");
	}
	else
	{
	   $SQL1 = "INSERT into diario(turma,materia,periodo,data,conteudo,texto) values('".$_POST['turma']."','".$_POST['disciplina']."','".$_POST['periodo']."','".revertedata($_POST['txtdata'])."','".$_POST['conteudo']."','".$_POST['txtobs']."')";
	   $sucesso = mysqli_query($db,$SQL1);
	   
	   if($sucesso)
	   {
		   print("<script>window.alert('Conteudo Cadastrada com sucesso...')</script>");
		   print("<script>window.location.href='iniciado.php?url=cad_diario';</script>");
	   }
	   else
	   {
		   print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-2')</script>");
	   }
	}
}
elseif(@$_GET['ap'] == "2")
{
	$SQL1 = "UPDATE diario SET conteudo='".$_POST['conteudo']."', texto='".$_POST['txtobs']."' where codigo='".$_GET['codigo']."'";
	$sucesso = mysqli_query($db,$SQL1);
	
	if($sucesso)
	{
        print("<script>window.alert('Atualizado com sucesso.');</script>");
		print("<script>window.location.href='iniciado.php?url=cad_diario&codigo=".$_GET['codigo']."';</script>");
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-3')</script>");
	}
	
}

if(@$_GET['fechar'] == "3")
{
	$SQL1 = "UPDATE diario SET status=0 where codigo='".$_GET['codigo']."'";
	$sucesso = mysqli_query($db,$SQL1);
	
	if($sucesso)
	{
        print("<script>window.alert('Bimestre fechado com sucesso.');</script>");
		print("<script>window.location.href='iniciado.php?url=cad_diario&codigo=".$_GET['codigo']."';</script>");
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-3')</script>");
	}
	
}
if(@$_GET['excluir'] == 1)
{
	$SQL1 = "DELETE FROM diario where codigo='".$_GET['codigo']."'";
	$sucesso = mysqli_query($db,$SQL1);
	
	if($sucesso)
	{
        print("<script>window.alert('Excluido com sucesso.');</script>");
		print("<script>window.location.href='iniciado.php?url=cad_diario';</script>");
	}
	else
	{
		print("<script>window.alert('Ocorreu um erro, Entre em contato com Suporte! MSG-3')</script>");
	}
	
}

?>	

<div class="container-fluid bg-template mb-4">
            <div class="row hn-290 position-relative">
			<div class="background opac heightset">
                    <i class="fa fa-calendar" style="font-size: 200px;position: absolute;left: 40%;top: 50px;"></i>
                </div>
                <div class="container align-self-end">
                    <h2 class="font-weight-light text-uppercase"><? echo $_SESSION["DESCRICAOPG"] = "Caixa Alteriores";?></h2>
                    <p class="text-mute mb-2"><? echo $_SESSION["DESCRICAOPG2"] = "Lista";?></p>
                    <input type="text" Onkeyup="pesquisar(this.value);" class="form-control form-control-lg search bottom-25 position-relative border-0" placeholder="Pesquisa">
                </div>
            </div>
        </div>   
				  
<div class="container pt-5">
<div class="row">
<div class="col-md-12 col-sm-12"> 
<div class="component-box">
	<?
	
	$SQL3 = "SELECT sum(total) as total FROM vendas_mov where caixa='".$_SESSION['caixa']."'";
	$RES3 = mysqli_query($db3,$SQL3);
	$ROW3 = mysqli_fetch_array($RES3);
	
	$vtotal = number_format($ROW3['total'],2,",",".");
	
	?>
	<div class="pmd-table-card pmd-card pmd-z-depth pmd-card-custom-view">
		 <table class="table pmd-table">
				<thead>
					<tr>
						<th class="text-center">Cod.</th>
						<th class="text-center">Usuario</th>
						<th class="text-right">Abertura/Fechamento</th>
						<th class="text-right">Fechamento</th>
						<th class="text-right">Total R$</th>
					</tr>
				</thead>
				<tbody>
					<? 
			  $sql = "select vendas_op.codigo,vendas_op.data_ab,vendas_op.hora_ab,vendas_op.data_fe,vendas_op.hora_fe,usuarios.nome,vendas_mov.produto,produtos.descricao,vendas_mov.preco,vendas_mov.total as total, sum(vendas_mov.total) as totals, count(vendas_mov.produto) as quantidade from vendas_op 
			  left join vendas_mov on vendas_mov.caixa=vendas_op.codigo
			  left join produtos on produtos.codigo=vendas_mov.produto
			  inner join usuarios on usuarios.codigo=vendas_op.usuario
			  where vendas_op.sistema='".$_SESSION['sistema']."' and vendas_op.status=0 GROUP BY vendas_op.codigo";
			  
			  $res = mysqli_query($db3,$sql); 
			  $b = 0;
			  while($row = mysqli_fetch_array($res))
			  {
					 
			  ?>
				<tr><!-- color: #20aee3; -->
					<td data-title="Cod."><? echo $row['codigo'];?></td>
					<td data-title="Usuario"><? echo $row['nome'];?></td>
					<td data-title="Abertura"><? echo formatodata($row['data_ab']);?> <? echo $row['hora_ab'];?></td>
					<td data-title="Fechamento"><? if(!Empty($row['data_fe'])){ echo formatodatahora($row['data_fe']);}?> <? echo $row['hora_fe'];?></td>
					<td data-title="Total R$">R$ <? echo number_format($row['totals'],2,",",".");?></td>
					<td><a href="javascript: void(0);" onclick="requestPage2('?br=rel_caixaanteriores&codigo=<? echo $row['codigo'];?>','modals','GET');" data-toggle="modal" data-target="#modalusuario" aria-invalid="false"><i class="fa fa-trash-o" style="font-size: 150%; color: red;"></i></a></td>
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
	</div>
</div>
</div>