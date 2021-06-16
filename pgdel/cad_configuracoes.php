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

$inputb = filter_input_array(INPUT_GET, FILTER_DEFAULT);

$cpf = "";
$login = "";
$senha = "";
$nome = "";
$email = "";
$tipo = "";
$situacao = "";

if(@$inputb['ap'] == "1")
{
	
	$credito = str_replace(',', ".", security::input(@$inputb['credito']));
	$debito = str_replace(',', ".", security::input(@$inputb['debito']));
	
	$x = 0;
	$SQL = "SELECT * FROM configuracoes where sistema='".$_SESSION['sistema']."';";
	$RES = mysqli_query($db3,$SQL);
	while($row = mysqli_fetch_array($RES))
	{
		$x = 1;
	}
	
	if($x == 1)
	{
		$SQL1 = "UPDATE configuracoes SET razao='".$inputb['razao']."', maquina='".$inputb['maquina']."',credito='".$credito."',debito='".$debito."' where sistema='".$_SESSION['sistema']."'";
	    $sucesso = mysqli_query($db3,$SQL1);
	
	    print('
		<script>
		swal({   
 			   title: "Info!",   
 			   text: "Gravado com sucesso.",   
 			   timer: 1500,   
 			   showConfirmButton: false 
 		});
		</script>');
	}
	else
	{
	   $SQL1 = "INSERT into configuracoes(sistema, razao, maquina,credito, debito) values('".$_SESSION['sistema']."','".$inputb['razao']."','".$inputb['maquina']."','".$credito."','".$debito."')";
	   $sucesso = mysqli_query($db3,$SQL1);
	   
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
	
$sucesso = mysqli_query($db3,"SELECT * FROM configuracoes where sistema='".$_SESSION['sistema']."'");

if($sucesso)
{
  while($row = mysqli_fetch_array($sucesso))
  {
	 $cnpj = $row['cnpj'];
	 $razao = $row['razao'];
	 $maquina = $row['maquina'];
	 $credito = $row['credito'];
	 $debito = $row['debito'];
	 
	 //print("<script>window.alert('TESTE ".$descricao.",".$valor."')</script>");
  }
}

?>		
<div class="container-fluid bg-template mb-4">
            <div class="row hn-154 position-relative">
			<div class="background opac heightset">
					<i class="material-icons" style="font-size: 100px;position: absolute;left: 45%;top: 50px;">supervisor_account</i> 
                </div>
                <div class="container align-self-end">
                    <h2 class="font-weight-light text-uppercase"><? echo $_SESSION["DESCRICAOPG"] = "Configurações";?></h2>
                    <p class="text-mute mb-2"><? echo $_SESSION["DESCRICAOPG2"] = "Lista";?></p>
                </div>
            </div>
        </div>
<div class="container pt-5">
  
  <div class="row">
	<div class="col-md-12 col-sm-12"> 
		<div class="component-box">
		    <script>
			$('.t-gravar').on('click',function()
		    {
	   
				var razao = document.getElementById('razao').value;
				var maquina = document.getElementById('maquina').value;
				var credito = document.getElementById('credito').value;
				var debito = document.getElementById('debito').value;
				
				if(razao == "")
				{
				       swal({   
 			               title: "Atenção",   
 			               text: "Campo Razão/Nome em branco.",   
 			               timer: 1000,   
 			               showConfirmButton: false 
 			           });
				}
				else
				{
				      requestPage2('?br=cad_configuracoes&razao='+ razao +'&maquina='+ maquina +'&credito='+ credito +'&debito='+ debito +'&ap=1','conteudo','GET');
				}

			});
						
			$('#credito').mask('##0,00', {reverse: true});
			$('#debito').mask('##0,00', {reverse: true});
			
			</script>
								<form name="laudo" class="form-material m-t-40 row" autocomplete="off" method="post" action="<? if(Empty($_GET['codigo'])){ echo "sistema.php?url=cad_usuarios&ap=1";}else { echo "sistema.php?url=cad_usuarios&codigo=".$_GET['codigo']."&ap=2";} ?>" enctype="multipart/form-data">
								<div class="form-group col-md-3 m-t-20"><label>CPF/CNPJ :</label>
								<input type="text" name="cnpj" id="cnpj" value="<? echo $_SESSION['sistema']; ?>" readonly class="form-control">
								</div>
								<div class="form-group col-md-6 m-t-20"><label>Nome da Empresa :</label>
								<input type="text" name="razao" id="razao" value="<? echo $razao; ?>" class="form-control">
								</div>
								<div class="form-group col-md-12 m-t-20"><h2>Taxas Maquininha :</h2>
								</div>
								<div class="form-group col-md-3 m-t-20"><label>Maquina :</label>
								<input type="text" name="maquina" id="maquina" value="<? echo $maquina; ?>" class="form-control">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>Crédito :</label>
								<input type="text" name="credito" id="credito" value="<? echo $credito; ?>" class="form-control">
								</div>
								<div class="form-group col-md-2 m-t-20"><label>Débito :</label>
								<input type="text" name="debito" id="debito" value="<? echo $debito; ?>" class="form-control">
								</div>
								<!--< } ?> -->
								<div class="form-group col-md-12 m-t-20">
								<div class="form-actions">
								<button type="button" class="btn btn-info t-gravar"><i class="fa fa-plus-circle"></i> Gravar</button>
								</div></div>
								
								</form>
								
							
                            </div>
                        </div>
					</div>
				</div>
