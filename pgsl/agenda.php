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
                    <i class="fa fa-calendar" style="font-size: 140px;position: absolute;left: 40%;top: 50px;"></i>
                </div>
                <div class="container align-self-end">
                    <h2 class="font-weight-light text-uppercase"><? echo $_SESSION["DESCRICAOPG"] = "Agenda";?></h2>
                    <p class="text-mute mb-2"><? echo $_SESSION["DESCRICAOPG2"] = "Lista";?></p>
                    <input type="text" Onkeyup="pesquisar(this.value);" class="form-control form-control-lg search bottom-25 position-relative border-0" placeholder="Pesquisa">
					<button class='btn btn-info btnadd-sh a-agenda2'><i class='fa fa-plus-circle'></i></button>
					
                </div>
            </div>
        </div>   	  
<div class="container pt-5">
  
  <div class="row">
	<div class="col-md-12 col-sm-12"> 
		<div class="component-box">
			<!--Tabs with Icon example -->
             <div class="row" id="load">
			    <script>
				   $('.a-agenda2').on('click',function()
				   {	
				       $('#modalap').modal('show');
				       requestPage2('?br=atu_pesquisa&tipo=1&ap=1','modals','GET');
				   });

				   a_menuslow();
				   $('.t-agenda').addClass('active');
				   requestPage2('?br=atu_pesquisa&load=1','load','GET');
				</script>
		   </div>
	   </div>
    </div>
  </div>
</div>

        <div class="container my-5">
            <div class="row">
                <div class="col-12">
                    <!-- Swiper -->
                    <div class="swiper-container swiper-categories">
                        <div class="swiper-wrapper">
						    
								<?
		
								$SQL1 = "SELECT * FROM usuarios where sistema='".$_SESSION['sistema']."' and tipo in (2,3,4) and status=1;";
								$RES1 = mysqli_query($db3,$SQL1);
								while($row = mysqli_fetch_array($RES1))
								{
										echo '<a class="swiper-slide">
										<div class="mb-3 h-100px w-100px rounded overflow-hidden position-relative">
										     <div class="background">
										      <img src="template/images/beautiful-2150881_640%402x.png" alt="">
										   </div>
										</div>';
										
										$data = revertedata(date('d-m-Y'));
		
										$SQL2 = "SELECT horarios.hora FROM horarios ORDER BY horarios.hora asc";
										$RES2 = mysqli_query($db3,$SQL2);
										while($row1 = mysqli_fetch_array($RES2))
										{
			
										$x = 0;
										$nome = "";
		  
										$SQL3 = "SELECT agendamento_servicos.hora,agendamento.nome FROM agendamento 
										inner join agendamento_servicos on agendamento_servicos.agendamento=agendamento.codigo 
										where agendamento_servicos.sistema='".$_SESSION['sistema']."' and agendamento_servicos.data='".$data."' and agendamento_servicos.profissional='".$row['codigo']."' and agendamento_servicos.hora='".$row1['hora']."'";
										$RES3 = mysqli_query($db3,$SQL3);
										while($row3 = mysqli_fetch_array($RES3))
										{
													 $nome = $row2['nome'];
													 $x = 1;
										}
												  if($x == 0)
												  {
													   echo '<h6 class="font-weight-normal mb-1">'.$row1['hora'].'</h6>';
												  }
												  else
												  {
													   echo '<h6 class="font-weight-normal mb-1">'.$row1['hora'].' - '.$nome.'</h6>';
												  }
										}
								}
	                              ?>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
		
		<!-- page level script -->
        <script>
        
            $(".sparklinechart").sparkline([5, 6, -7, 2, 0, -4, -2, 4], {
                type: 'bar',
                zeroAxis: false,
                barColor: '#00bf00',
                height: '30',
            });
            $(".sparklinechart2").sparkline([-5, -6, 4, -2, 0, 4, 2, -4], {
                type: 'bar',
                zeroAxis: false,
                barColor: '#00bf00',
                height: '30',
            });

            /* Swiper slider */
            var swiper = new Swiper('.swiper-prices', {
                slidesPerView: 'auto',
                spaceBetween: 0,
                pagination: false,
            });
            var swiper = new Swiper('.swiper-categories', {
                slidesPerView: 'auto',
                spaceBetween: 20,
                pagination: false,
            });
            var swiper = new Swiper('.swiper-shares', {
                slidesPerView: 5,
                spaceBetween: 0,
                pagination: false,
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                    },
                    768: {
                        slidesPerView: 2,
                    },
                    1024: {
                        slidesPerView: 3,
                    },
                }
            });
        

    </script>
