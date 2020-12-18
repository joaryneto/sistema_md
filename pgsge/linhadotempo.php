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

if(isset($_GET['mes']))
{
	$mes=$_GET['mes'];
	$ano=date("Y");
}
else
{
	$mes=date("m");
	$ano=date("Y");
}

?>
<script>
								
function mess(mes)
{
		//window.location.href='sistema.php?url=linhadotempo&mes=' + mes;		
        requestPage2('?br=atu_linhadotempo&mes=' + mes +'&load=1','load','GET');		
}

requestPage2('?br=atu_linhadotempo&mes=<?=$mes?>&load=1','load','GET');	
</script>
<script>
a_menuslow();
$('.t-agenda').addClass('active');
</script>
<div class="container-fluid bg-template mb-4">
            <div class="row hn-290 position-relative">
			<div class="background opac heightset">
                    <i class="fa fa-calendar" style="font-size: 200px;position: absolute;left: 40%;top: 50px;"></i>
                </div>
                <div class="container align-self-end">
                    <h2 class="font-weight-light text-uppercase"><? echo $_SESSION["DESCRICAOPG"] = "Agenda";?></h2>
                    <p class="text-mute mb-2"><? echo $_SESSION["DESCRICAOPG2"] = "Lista";?></p>
					<select name="empresa" id="empresa" class="form-control form-control-lg search bottom-25 position-relative border-0" onChange="mess(this.value);" style="width: 100%; height:36px;">
				<option value="01" <? if($mes == "01"){ echo "selected";}?>>Janeiro</option>
				<option value="02" <? if($mes == "02"){ echo "selected";}?>>Fevereiro</option>
				<option value="03" <? if($mes == "03"){ echo "selected";}?>>Março</option>
				<option value="04" <? if($mes == "04"){ echo "selected";}?>>Abril</option>
				<option value="05" <? if($mes == "05"){ echo "selected";}?>>Maio</option>
				<option value="06" <? if($mes == "06"){ echo "selected";}?>>Junho</option>
				<option value="07" <? if($mes == "07"){ echo "selected";}?>>Julho</option>
				<option value="08" <? if($mes == "08"){ echo "selected";}?>>Agosto</option>
				<option value="09" <? if($mes == "09"){ echo "selected";}?>>Setembro</option>
				<option value="10" <? if($mes == "10"){ echo "selected";}?>>Outubro</option>
				<option value="11" <? if($mes == "11"){ echo "selected";}?>>Novembro</option>
				<option value="12" <? if($mes == "12"){ echo "selected";}?>>Dezembro</option>
			 </select>
                </div>
        </div>
</div>   
<div class="container pt-5">
  
  <div class="row">
	<div class="col-md-12 col-sm-12"> 
		<div class="component-box">
			<!--Tabs with Icon example -->
             <div class="row" id="load">
		   </div>
	   </div>
    </div>
  </div>
</div>