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
<div class="container-fluid bg-template mb-4">
            <div class="row hn-290 position-relative">
			<div class="background opac heightset">
                    <i class="fa fa-calendar" style="font-size: 200px;position: absolute;left: 40%;top: 50px;"></i>
                </div>
                <div class="container align-self-end">
                    <h2 class="font-weight-light text-uppercase"><? echo $_SESSION["DESCRICAOPG"] = "Agenda";?></h2>
                    <p class="text-mute mb-2"><? echo $_SESSION["DESCRICAOPG2"] = "Lista";?></p>
                    <input type="text" Onclick="" class="form-control form-control-lg search bottom-25 position-relative border-0" placeholder="Pesquisa">
                </div>
            </div>
        </div>   
				  
<div class="container pt-5">
            <div class="row">
             <div class="card">
              <div class="card-body">	
		       </div></div>
                <?
				
				$SQL = "SELECT clientes.nome,agendamento.inicio FROM agendamento inner join clientes on clientes.codigo=agendamento.cliente";
				$RES = mysqli_query($db3,$SQL);
				while($row = mysqli_fetch_array($RES))
				{
				?><div class="col-6 col-md-4 col-lg-3 mb-4">
                    <div class="mb-3 h-100px rounded overflow-hidden position-relative">
                        <div class="background">
                            <img src="template/images/escova-inteligente.jpg" alt="">
                        </div>
                        <div>
                        </div>
                    </div>
                    <h6 class="font-weight-normal mb-1" style="font-size: 95%;"><? echo $row['nome'];?></h6>
					<p><span>Hora: <? echo formatohora(row['inicio']);?>hs</span></p>
                    <p><span class="dot-notification mr-1"></span> <span class="text-mute">Marcado no dia: <? echo formatodatahora($row['inicio']);?></span></p>
                </div>
			  <?}?>
				
            </div>

</div>
<div id="agenda" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="myLargeModalLabel"><b>Lista de Produtos : </h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                            </div>
                                            <div class="modal-body">
											<div class="row">
											<div class="col-12">
											<div class="form-group col-md-12 m-t-20">
											<select name="situacao" class="form-control" style="width: 100%; height:36px;" required="required">
											<option>Selecionar Horario</option>
											<?
											$hora = '06:30:00';
											for($i = 0; $i < 30; $i++){
											$hora = date('H:i:s', strtotime('+30 minute', strtotime($hora)));
											echo "<option value=''>$hora</option>";
											}
											?>
											</select>
											</div>
											<div class="form-group col-md-12 m-t-20"><label>Busca:</label>
                                             <input name="user" type="text" class="form-control" onkeyup="javascript: ajaxLoader('?br=listusuarios&pesquisa='+ this.value +'&ap=2','listusuarios','GET');" />
											</div>
											
											<div class="form-group col-md-12 m-t-20" id="">
											<table class="display nowrap table table-hover table-striped table-bordered">
											<thead>
											  <tr>
											<th>Codigo</th>
											<th>Descrição</th>
											<th>Preço R$</th>
											<th>Estoque</th>
											</tr>
											 </thead>
											   <tbody>
											   <?
											   $data = date('Y');
										       $sql = "select * from produtos";
											   $res = mysqli_query($db3,$sql); 
											   $x = 0;
											   while($row = mysqli_fetch_array($res))
											   {
											   ?>
											   <tr style="cursor: pointer;" onMouseOver="this.style.color='#C0C0C0'" onMouseOut="this.style.color='#67757c'" onclick="itens('<? echo $row['descricao'];?>',<? echo $row['codigo'];?>,'<? echo number_format($row['preco'],2,",",".");?>');">
											   <td><? echo $row['codigo'];?></td>
											   <td><? echo $row['descricao'];?></td>
											   <td><? echo $row['preco'];?></td>
											   <td><? echo $row['b'];?></td>
											   </tr>
											   <? $x = 1;
											   }

 											    if($x == 0)
 											    {
											   	 echo "<tr><td colspan='4'>Nenhum resultado encontrado.</td></tr>";
 											   
 											   }
											   ?>
											 </tbody>
											
                                            </table>											 
											</div>
											</div>
											</div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="mb-2 btn btn-sm btn-danger" data-dismiss="modal">Fechar</button>
                                            </div>
                                        </div>
										
                                        <!-- /.modal-content -->
                                    </div>
									
                                    <!-- /.modal-dialog -->
                                </div>