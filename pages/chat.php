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

function formatodatahora($data){
    return date("d/m/Y", strtotime($data));
}

if(isset($_POST['button']))
{
	$mes=$_POST['mes'];
	$ano=$_POST['ano'];
	//$tipo=$_POST['tipo'];
}
else
{
	$mes=date("m");
	$ano=date("Y");
}

?>                
<script>
       function mensagens(texto)
	   {
		  if(texto == "")
		  {
			  return;
		  }
		  else
		  {
             $("#chats").append('<li><div class="chat-img"><img src="../assets/images/users/3.jpg" alt="user" /></div><div class="chat-content"><h5>Angelina Rhodes</h5><div class="box bg-light-info">'+texto+'</div></div> <div class="chat-time">11:00 am</div></li>');
		     $('#chats').animate({scrollTop: 9999});
		     document.getElementById("texto").value = "";
		  }
       }
	   
	   setInterval(function()
	   { 					   
		  ajaxLoader('?br=chat_load&protocolo=<? echo $_GET['protocolo'];?>&list=1<? if($_GET['inconsistencia'] == 1){ echo "&inconsistencia=1";}?>','examesid','GET'); 
	   }, 2000);
    </script>
<div class="row">
                    <div class="col-12">
                        <div class="card m-b-0">
                            <!-- .chat-row -->
                            <div class="chat-main-box">
                                <!-- .chat-left-panel -->
                                <div class="chat-left-aside">
                                    <div class="open-panel"><i class="ti-angle-right"></i></div>
                                    <div class="chat-left-inner">
                                        <div class="form-material">
                                            <input class="form-control p-20" type="text" placeholder="Search Contact">
                                        </div>
										<script>
											$('.item-menu').click(function(e) {
  										    $('.item-menu').removeClass('active');
 										     $(this).addClass('active');
										    });

										    // verificar via JS:
 										   const href = [location.pathname, location.search].join('?');
 										   $('.item-menu[href="' + href + '"]').addClass('active');
										   
										</script>
                                        <ul class="chatonline style-none ">
										    <? $SQL = "SELECT usuarios.codigo,matriculas.nome,usuarios.online FROM turmas_professor 
											   inner join matriculas on matriculas.turma=turmas_professor.turma 
											   inner join usuarios on usuarios.matricula=matriculas.matricula where turmas_professor.usuario=".$usuario."";
											   $RES = mysqli_query($db,$SQL);
											   $count = 0;
											   while($row = mysqli_fetch_array($RES))
											   {
												   
												 Switch($row['online'])
												 {
													 case 0:
													  $online = '<small class="text-danger">Offline</small>';
													 break;
													 case 1:
													  $online = '<small class="text-success">online</small>';
													 break;
												 }
											?>
                                            <li>
                                                <a <? if($count == 0){ echo 'class="item-menu active"'; }else{ echo 'class="item-menu"';}?> href="iniciado.php?url=chat"><img src="template/assets/images/users/1.jpg" alt="user-img" class="img-circle"> <span><? echo $row['nome'];?><? echo $online;?></span></a>
                                            </li>
											<? $count++; } ?>
                                            <li class="p-20" id="teste"></li>
                                        </ul>
                                    </div>
                                </div>
                                <!-- .chat-left-panel -->
                                <!-- .chat-right-panel -->
                                <div class="chat-right-aside">
                                    <div class="chat-main-header">
                                        <div class="p-20 b-b">
                                            <h3 class="box-title">Chat Message</h3>
                                        </div>
                                    </div>
                                    <div class="chat-rbox">
                                        <ul class="chat-list p-20" id="chats" style="height: 400px;overflow: auto;">
                                            <!--chat Row -->
                                            <!--chat Row -->
                                            <li class="reverse">
                                                <div class="chat-content">
                                                    <h5>Gabriele Cristina</h5>
                                                    <div class="box bg-light-inverse">It’s Great opportunity to work.</div>
                                                </div>
                                                <div class="chat-img"><img src="template/assets/images/users/5.jpg" alt="user" /></div>
                                                <div class="chat-time">10:57 am</div>
                                            </li>
                                            <!--chat Row -->
                                            <!--chat Row -->
                                            <li>
                                                <div class="chat-img"><img src="template/assets/images/users/3.jpg" alt="user" /></div>
                                                <div class="chat-content">
                                                    <h5>Angelina Rhodes</h5>
                                                    <div class="box bg-light-info">Well we have good budget for the project</div>
                                                </div>
                                                <div class="chat-time">11:00 am</div>
                                            </li>
                                            <!--chat Row -->
                                        </ul>
                                    </div>
                                    <div class="card-body b-t">
                                        <div class="row">
									        
                                            <div class="col-8">
                                                <textarea name="texto" id="texto" placeholder="Type your message here" class="form-control b-0"></textarea>
                                            </div>
                                            <div class="col-4 text-right">
                                                <button type="button" class="btn btn-info btn-circle btn-lg" onclick="mensagens(document.getElementById('texto').value)"><i class="fa fa-paper-plane-o"></i> </button>
                                            </div>
											
                                        </div>
                                    </div>
                                </div>
                                <!-- .chat-right-panel -->
                            </div>
                            <!-- /.chat-row -->
                        </div>
                    </div>
                </div>
				