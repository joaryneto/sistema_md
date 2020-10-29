<?

ob_start();

session_start();

require_once("./load/load.php");

function formatodatahora($data){
    return date("d/m/Y", strtotime($data));
}

function formatohora($horas){
    return date("H:i", $horas);
}

date_default_timezone_set('America/Cuiaba');
$data = date('Y-m-d');
$hora = date('H:i:s');

function revertedata($data){

		if($data != ""){
		$sep_data = explode("/",$data);
		$data = $sep_data[2]."-".$sep_data[1]."-".$sep_data[0];
		}
		
		return $data;
}

//echo $_SESSION['sistema'];

?>
<!doctype html>
<html lang="pt-br" class="color-theme-blue">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover, user-scalable=no">
    <meta name="description" content="">
    <meta name="author" content="Maxartkiller">

    <title>EC Tecnologia</title>

    <!-- Material design icons CSS -->
    <link rel="stylesheet" href="template/vendor/materializeicon/material-icons.css">

    <!-- Roboto fonts CSS -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&amp;display=swap" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="template/vendor/bootstrap-4.4.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- page CSS -->
    <link href="template/vendor/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <link href="template/vendor/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="template/vendor/switchery/dist/switchery.min.css" rel="stylesheet" />
    <link href="template/vendor/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
    <link href="template/vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet" />
    <link href="template/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.css" rel="stylesheet" />
    <link href="template/vendor/multiselect/css/multi-select.css" rel="stylesheet" type="text/css" />
	
    <!-- Swiper CSS -->
    <link href="template/vendor/swiper/css/swiper.min.css" rel="stylesheet">

    <!-- Input Select Seach css -->
    <link href="template/vendor/select2/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="template/vendor/bootstrap-select/bootstrap-select.min.css" rel="stylesheet" />
	
    <link href="template/vendor/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <!-- Page plugins css -->
    <link href="template/vendor/clockpicker/dist/jquery-clockpicker.min.css" rel="stylesheet">
    <!-- Color picker plugins css -->
    <link href="template/vendor/jquery-asColorPicker-master/css/asColorPicker.css" rel="stylesheet">
    <!-- Date picker plugins css -->
    <link href="template/vendor/bootstrap-datepicker/bootstrap-datepicker.min.css" rel="stylesheet" type="text/css" />
    <!-- Daterange picker plugins css -->
    <link href="template/vendor/timepicker/bootstrap-timepicker.min.css" rel="stylesheet">
    <link href="template/vendor/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
	
    <!-- Custom styles for this template -->
    <link href="template/css/style.css" rel="stylesheet">
	
	<!--alerts CSS -->
    <link href="template/vendor/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">
	
	<!-- Calendar CSS -->
    <link href="template/vendor/calendar/dist/fullcalendar.css" rel="stylesheet" />
	
	<script type="text/javascript" src="template/js/AjaxScript.js.php"></script>
	
<style>
.tableFixHead          { 
  overflow-y: auto; 
  height: auto;
  border: 1px solid;
  border-color: lightgray;
  border-radius: 14px 14px 14px 14px;
  }
.tableFixHead thead th { position: sticky; top: 0; }
.tableFixHead thead th { background:#fff; }
</style>
</head>

<body>
    <!-- Loader -->
    <div class="row no-gutters vh-100 loader-screen">
        <div class="bg-template background-overlay"></div>
        <div class="col align-self-center text-white text-center">
            <img style="height:50px" src="template/images/logo.png" alt="logo">
            <h1 class="mb-0 mt-3">EC</h1><p class="text-mute subtitle"> Tecnologia</p>
            <div class="loader-ractangls">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
    <!-- Loader ends -->

    <!-- sidebar -->
    <div class="sidebar">
        <div class="row no-gutters">
            <div class="col-auto align-self-center">
                <figure class="avatar avatar-40">
                    <img src="images/man-930397_640%402x.png" alt="">
                </figure>
            </div>
            <div class="col pl-3 align-self-center">
                <p class="my-0"><?=$_SESSION['nome']?></p>
                <p class="text-mute my-0 small">
				<?
				
				switch($_SESSION['nome'])
			    {
					case 1:
					{
						echo "Atendente";
					}
					break;
					case 2:
					{
						echo "Profissional";
					}
					break;
					case 3:
					{
						echo "Administrador";
					}
					break;
					default:
				    {
						echo "Não definido";
					}
					break;
				}
				
				?></p>
            </div>
            <div class="col-auto align-self-center">
                <a href="login.php" class="btn btn-link text-white p-2"><i class="material-icons">power_settings_new</i></a>
            </div>
        </div>
        <div class="list-group main-menu my-5">
            <a href="sistema.php?url=cad_agendamento" class="list-group-item list-group-item-action active"><i class="material-icons">home</i>Agendamento</a>
            <a href="latestnews.html" class="list-group-item list-group-item-action"><i class="material-icons">view_day</i>Latest news</a>
            <a href="subscribed.html" class="list-group-item list-group-item-action"><i class="material-icons">library_books</i>Subscribed</a>
            <a href="notification.html" class="list-group-item list-group-item-action"><i class="material-icons">notifications</i>Notification <span class="badge badge-dark text-white">2</span></a>
            <a href="myprofile.html" class="list-group-item list-group-item-action"><i class="material-icons">account_circle</i>My Profile</a>
            <a href="pagescontrols.html" class="list-group-item list-group-item-action"><i class="material-icons">class</i>Pages Controls <span class="badge badge-light ml-2">Check</span></a>
            <a href="javascript:void(0)" class="list-group-item list-group-item-action mt-4" data-toggle="modal" data-target="#colorscheme"><i class="material-icons">color_lens_outline</i>Change Color</a>
        </div>
    </div>
    <!-- sidebar ends -->

    <!-- wrapper starts -->
    <div class="wrapper">

        <!-- header -->
        <div class="header">
            <div class="row no-gutters">
                <div class="col-auto">
                    <button class="btn btn-link menu-btn"><i class="material-icons menu">menu</i><i class="material-icons closeicon">close</i><span class="new-notification"></span></button>
                </div>
                <div class="col text-left">
                    <div class="header-logo">
                        <img style="height:50px" src="template/images/logo.png" alt="" class="header-logo">
                        <h4>EC<br><small class="text-mute">Tecnologia</small></h4>
                    </div>
                </div>
                <div class="col-auto">
                    <a href="notification.html" class="btn btn-link"><i class="material-icons">notifications_none</i><span class="counts">9+</span></a>
                </div>
            </div>
        </div>
        <!-- header ends -->


        <!-- page content here -->
        
        
		<?php
		if(Empty($_SESSION['manutencao']))
		{
			$_SESSION['manutencao'] = 0;
		}
				   
		if($_SESSION['manutencao']!=1)
		{
			include("url.php");
		}
		else
		{
			include("url2.php");
		} 
		?>
        <!-- page content ends -->


        <!-- footer -->
        <div class="footer">
            <div class="no-gutters">
                <div class="col-auto mx-auto">
                    <div class="row no-gutters justify-content-center">
                        <div class="col-auto">
                            <a href="caixa.php" class="btn btn-link-default active">
                                <span class="icon-text"><i class="material-icons">store_mall_directory</i></span>
                                <span class="text-name">Vendas</span>
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="categories.html" class="btn btn-link-default">
                                <span class="icon-text"><i class="material-icons">inbox</i></span>
                                <span class="text-name">Categories</span>
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="profile-author.html" class="btn btn-link-default">
                                <span class="icon-text"><i class="material-icons">account_circle</i></span>
                                <span class="text-name">Profile</span>
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="bookmarks.html" class="btn btn-link-default">
                                <span class="icon-text"><i class="material-icons">bookmarks</i></span>
                                <span class="text-name">Bookmarks</span>
                            </a>
                        </div>
                        <div class="col-auto">
                            <a href="messages.html" class="btn btn-link-default">
                                <span class="icon-text"><i class="material-icons">send</i></span>
                                <span class="text-name">Messages</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- footer ends -->
<script>

</script>
<div class="fab">
   <button type="button" data-toggle="modal" data-target="#agenda" class="main">
      <i class="fa fa-calendar"></i>
   </button>
  </div>
</div>
<script>

function alteradata()
{
	$('#nome').val('');
}

function buscarcliente(nome)
{
	if(event.key === 'Enter') 
	{
	   $('#codigo').val('');
	   requestPage2('?br=atu_pesquisa&pesquisa='+ nome +'&ap=1','pesquisacliente','GET');
	}
}

function selectcliente(codigo,nome)
{	
	var datav = document.getElementById('dataagenda').value;
	
	if(datav == "")
	{
		swal('Atenção', 'Selecione uma data.');
	}
	else
	{
	   document.getElementById('pcliente').style.display = 'none';
	   $('#codigo').val(codigo);
	   $('#nome').val(nome);
	   requestPage2('?br=atu_pesquisa&codigo='+ codigo +'&nome='+ nome +'&data='+ datav +'&ap=2','horario','GET');
	}
}

function auto()
{
	document.getElementById('pcliente').style.display = 'none';
}

</script>
<div id="agenda" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
            <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel"><b>Agendar Horario : </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                    <div class="modal-body">
									
									<div class="row">
									<div class="col-12">
									<div class="form-group col-md-12 m-t-20" id="inputcliente"><label>Data:</label>
									    <input name="dataagenda" id="dataagenda" OnChange="alteradata();" type="text" autocomplete="off" class="form-control" required="required" />
									</div>
									<div class="form-group col-md-12 m-t-20" id="inputcliente"><label>Pesquisar Cliente:</label>
										<input name="codigo" id="codigo" type="hidden" autocomplete="off" class="form-control" required="required" />
									    <input name="nome" id="nome" type="text" onkeyup="buscarcliente(this.value);" autocomplete="off" class="form-control" required="required" />
									<div id="pesquisacliente"></div>
									</div>
									<div class="form-group col-md-4 m-t-20" id="horario">
									    <input name="hora" id="hora" type="hidden" autocomplete="off" class="form-control" required="required" />
									</div>
									
							</div>
						</div>
                    
                    <div class="modal-footer">
						<div class="row">
                         <div class="col">
						 <button type="button" onclick="agendar();"  class="mb-2 btn btn-sm btn-primary">Gravar</button>
                         <button type="button" class="mb-2 btn btn-sm btn-danger" data-dismiss="modal">Sair</button>
					   </div></div>
                    </div>
					</div>
                 </div>
										
                <!-- /.modal-content -->
            </div>						
        <!-- /.modal-dialog -->
    </div>	
   <div id="editaagenda" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-lg">
            <div class="modal-content">
			
			
                            <div class="modal-header">
                                <h4 class="modal-title" id="myLargeModalLabel"><b>Reagendar : </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                </div>
                                    <div class="modal-body">
									<div id="loadagenda">
									<div class="row">
									<div class="col-12">
									</div>
							</div>
						</div>
                    
                    <div class="modal-footer">
						<div class="row">
                         <div class="col">
						 <button type="button" onclick="reagendar();"  class="mb-2 btn btn-sm btn-primary">Gravar</button>
                         <button type="button" class="mb-2 btn btn-sm btn-danger" data-dismiss="modal">Sair</button>
					   </div></div>
                    </div>
					</div>
                 </div>
										
                <!-- /.modal-content -->
            </div>						
        <!-- /.modal-dialog -->
    </div>	
    <!-- wrapper ends -->

    <!-- color chooser menu start -->
    <div class="modal fade " id="colorscheme" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content ">
                <div class="modal-header theme-header border-0">
                    <h6 class="">Color Picker</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pt-0">
                    <div class="text-center theme-color">
                        <button class="m-1 btn red-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="red"><i class="material-icons w-50">color_lens_outline</i></button>
                        <button class="m-1 btn blue-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="blue"><i class="material-icons w-50">color_lens_outline</i></button>
                        <button class="m-1 btn yellow-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="yellow"><i class="material-icons w-50">color_lens_outline</i></button>
                        <button class="m-1 btn green-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="green"><i class="material-icons w-50">color_lens_outline</i></button>
                        <button class="m-1 btn pink-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="pink"><i class="material-icons w-50">color_lens_outline</i></button>
                        <button class="m-1 btn orange-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="orange"><i class="material-icons w-50">color_lens_outline</i></button>
                        <button class="m-1 btn purple-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="purple"><i class="material-icons w-50">color_lens_outline</i></button>
                        <button class="m-1 btn deeppurple-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="deeppurple"><i class="material-icons w-50">color_lens_outline</i></button>
                        <button class="m-1 btn lightblue-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="lightblue"><i class="material-icons w-50">color_lens_outline</i></button>
                        <button class="m-1 btn teal-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="teal"><i class="material-icons w-50">color_lens_outline</i></button>
                        <button class="m-1 btn lime-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="lime"><i class="material-icons w-50">color_lens_outline</i></button>
                        <button class="m-1 btn deeporange-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="deeporange"><i class="material-icons w-50">color_lens_outline</i></button>
                        <button class="m-1 btn gray-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="gray"><i class="material-icons w-50">color_lens_outline</i></button>
                        <button class="m-1 btn black-theme-bg text-white btn-rounded-54 shadow-sm" data-theme="black"><i class="material-icons w-50">color_lens_outline</i></button>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="col-6 text-left">
                        <div class="row">
                            <div class="col-auto text-right align-self-center"><i class="material-icons text-warning md-36 vm">wb_sunny</i></div>
                            <div class="col-auto text-center align-self-center px-0">
                                <div class="custom-control custom-switch float-right">
                                    <input type="checkbox" name="themelayout" class="custom-control-input" id="theme-dark">
                                    <label class="custom-control-label" for="theme-dark"></label>
                                </div>
                            </div>
                            <div class="col-auto text-left align-self-center"><i class="material-icons text-dark md-36 vm">brightness_2</i></div>
                        </div>
                    </div>
                    <div class="col-6 text-right">
                        <div class="row">
                            <div class="col-auto text-right align-self-center">LTR</div>
                            <div class="col-auto text-center align-self-center px-0">
                                <div class="custom-control custom-switch float-right">
                                    <input type="checkbox" name="rtllayout" class="custom-control-input" id="theme-rtl">
                                    <label class="custom-control-label" for="theme-rtl"></label>
                                </div>
                            </div>
                            <div class="col-auto text-left align-self-center">RTL</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- color chooser menu ends -->



    <!-- jquery, popper and bootstrap js -->
    <script src="template/vendor/jquery/jquery.min.js"></script>
    <script src="template/js/popper.min.js"></script>
    <script src="template/vendor/bootstrap-4.4.1/js/bootstrap.min.js"></script>

    <script src="template/vendor/switchery/dist/switchery.min.js"></script>
    <script src="template/vendor/select2/dist/js/select2.full.min.js" type="text/javascript"></script>
    <script src="template/vendor/bootstrap-select/bootstrap-select.min.js" type="text/javascript"></script>
    <script src="template/vendor/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="template/vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.js" type="text/javascript"></script>
    <script type="text/javascript" src="template/vendor/multiselect/js/jquery.multi-select.js"></script>
    <script>
    $(function() {
        // Switchery
        var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
        $('.js-switch').each(function() {
            new Switchery($(this)[0], $(this).data());
        });
        // For select 2
        $(".select2").select2();
        $('.selectpicker').selectpicker();
        //Bootstrap-TouchSpin
        $(".vertical-spin").TouchSpin({
            verticalbuttons: true,
            verticalupclass: 'ti-plus',
            verticaldownclass: 'ti-minus'
        });
        var vspinTrue = $(".vertical-spin").TouchSpin({
            verticalbuttons: true
        });
        if (vspinTrue) {
            $('.vertical-spin').prev('.bootstrap-touchspin-prefix').remove();
        }
        $("input[name='tch1']").TouchSpin({
            min: 0,
            max: 100,
            step: 0.1,
            decimals: 2,
            boostat: 5,
            maxboostedstep: 10,
            postfix: '%'
        });
        $("input[name='tch2']").TouchSpin({
            min: -1000000000,
            max: 1000000000,
            stepinterval: 50,
            maxboostedstep: 10000000,
            prefix: '$'
        });
        $("input[name='tch3']").TouchSpin();
        $("input[name='tch3_22']").TouchSpin({
            initval: 40
        });
        $("input[name='tch5']").TouchSpin({
            prefix: "pre",
            postfix: "post"
        });
        // For multiselect
        $('#pre-selected-options').multiSelect();
        $('#optgroup').multiSelect({
            selectableOptgroup: true
        });
        $('#public-methods').multiSelect();
        $('#select-all').on('click', function() {
            $('#public-methods').multiSelect('select_all');
            return false;
        });
        $('#deselect-all').on('click', function() {
            $('#public-methods').multiSelect('deselect_all');
            return false;
        });
        $('#refresh').on('click', function() {
            $('#public-methods').multiSelect('refresh');
            return false;
        });
        $('#add-option').on('click', function() {
            $('#public-methods').multiSelect('addOption', {
                value: 42,
                text: 'test 42',
                index: 0
            });
            return false;
        });
        $(".ajax").select2({
            ajax: {
                url: "https://api.github.com/search/repositories",
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                processResults: function(data, params) {
                    // parse the results into the format expected by Select2
                    // since we are using custom formatting functions we do not need to
                    // alter the remote JSON data, except to indicate that infinite
                    // scrolling can be used
                    params.page = params.page || 1;
                    return {
                        results: data.items,
                        pagination: {
                            more: (params.page * 30) < data.total_count
                        }
                    };
                },
                cache: true
            },
            escapeMarkup: function(markup) {
                return markup;
            }, // let our custom formatter work
            minimumInputLength: 1,
            templateResult: formatRepo, // omitted for brevity, see the source of this page
            templateSelection: formatRepoSelection // omitted for brevity, see the source of this page
        });
    });
    </script>

    <!-- swiper js -->
    <script src="template/vendor/swiper/js/swiper.min.js"></script>

    <!-- cookie js -->
    <script src="template/vendor/cookie/jquery.cookie.js"></script>


    <!-- template custom js -->
    <script src="template/js/main.js"></script>

	<script src="template/js/perso.js"></script>

	<!-- Plugin JavaScript -->
    <script src="template/vendor/moment/moment.js"></script>
    <script src="template/vendor/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js"></script>
    <!-- Clock Plugin JavaScript -->
    <script src="template/vendor/clockpicker/dist/jquery-clockpicker.min.js"></script>
    <!-- Color Picker Plugin JavaScript -->
    <script src="template/vendor/jquery-asColorPicker-master/libs/jquery-asColor.js"></script>
    <script src="template/vendor/jquery-asColorPicker-master/libs/jquery-asGradient.js"></script>
    <script src="template/vendor/jquery-asColorPicker-master/dist/jquery-asColorPicker.min.js"></script>
    <!-- Date Picker Plugin JavaScript -->
    <script src="template/vendor/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <!-- Date range Plugin JavaScript -->
    <script src="template/vendor/timepicker/bootstrap-timepicker.min.js"></script>
    <script src="template/vendor/bootstrap-daterangepicker/daterangepicker.js"></script>
	<script src="template/vendor/bootstrap-datepicker/locales/bootstrap-datepicker.pt-BR.min.js"></script>
    <script>
	jQuery('#dataagenda').datepicker({
		format: 'dd/mm/yyyy',
        autoclose: true,
        todayHighlight: true,
		language: "pt-BR",
		orientation: "bottom left"
    });
    </script>
    <!-- Sweet-Alert  -->
    <script src="template/vendor/sweetalert/sweetalert.min.js"></script>
    <script src="template/vendor/sweetalert/jquery.sweet-alert.custom.js"></script>
	
	<!-- MASK INPUT -->
    <script src="template/vendor/mask.money/jquery.maskMoney.js"></script>
    <script>
        $("#dinheiro").maskMoney({prefix:'', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
        $("#ctdebito").maskMoney({prefix:'', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
        $("#ctcredito").maskMoney({prefix:'', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
        $("#ted").maskMoney({prefix:'', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
        $("#desc").maskMoney({prefix:'', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
    </script>
	
</body>

</html>
