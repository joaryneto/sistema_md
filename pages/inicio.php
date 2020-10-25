<?

$PageRequest = strtolower(basename( $_SERVER['REQUEST_URI'] ));
$PageName = strtolower(basename( __FILE__ ));
if($PageRequest == $PageName) exit("<strong> Erro: Não é permitido acessar o arquivo diretamente. </strong>");


if (basename($_SERVER["REQUEST_URI"]) === basename(__FILE__))
{
	exit();
}

//if($_SESSION['menu0'] == false)
//{
//   print("<script>window.alert('Erro: Você não tem permissão.')</script>");
//   print("<script>window.location.href='iniciado.php';</script>");
   //exit("<strong> Erro: Você não tem permissão. </strong>");
//}

?>  

<script>
function teste() 
{

/*var i = 0;
$.each($("input[name='check[]']:value"),function()
{
	i++;
});


if(i == 0)
{
	swal('Atenção', 'Selecione os alunos para gravar.');
	//alert('TESTE');
    return true;	
}
else
{*/
		swal({   
            title: "Atenção!",   
            text: "Você esta iniciando a gravação de Notas dos alunos.",   
            type: "warning",   
            showCancelButton: true,   
            //confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Sim, Gravar!",
            cancelButtonText: "Não, Cancelar!", 			
            closeOnConfirm: true 
        }, function()
		{   
		
		    ajaxLoader('?br=testev2','testes','GET');
			
	});
 //}
}
</script>
<div class="row">             
<?
$SQL = "SELECT produtos.codigo,produtos.descricao FROM vendas inner join produtos on produtos.codigo=vendas.produto where vendas.cliente=".$_SESSION['sistema']." and vendas.status=1";
$RES = mysqli_query($db2,$SQL);
while($row = mysqli_fetch_array($RES))
{
?>  
<div id="testes"></div>
<div class="col-lg-3 col-md-6">
      <!-- Card -->
       <div class="card">
         <img class="card-img-top img-responsive" src="template/img/sistemas_01.png" alt="Card image cap">
         <div class="card-body">
           <h4 class="card-title"><?=$row['descricao'];?></h4>
           <p class="card-text"></p>
           <a href="sistemas.php?tipo=<?=$row['codigo'];?>" class="btn btn-primary">Entrar</a>
         </div>
      </div>
     <!-- Card -->
</div>
					<?}?>
</div>
