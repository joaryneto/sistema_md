<?

ob_start();

session_start();

require_once("./load/load.php");

function formatodatahora($data){
    return date("d/m/Y", strtotime($data));
}

function formatohora($hora){
    return date("H:i:s", strtotime($hora));
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

    <link href="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.css" rel="stylesheet"/>
    <!-- Bootstrap core CSS -->
    <link href="template/vendor/bootstrap-4.4.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Swiper CSS -->
    <link href="template/vendor/swiper/css/swiper.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="template/css/style.css" rel="stylesheet">
	
	<!--alerts CSS -->
    <link href="template/vendor/sweetalert/sweetalert.css" rel="stylesheet" type="text/css">	
	
	<!-- Calendar CSS -->
    <link href="template/vendor/calendar/dist/fullcalendar.css" rel="stylesheet" />
	
	<script type="text/javascript" src="template/js/AjaxScript.js.php"></script>
	<script type="text/javascript" src="template/js/perso.js.php"></script>
<style>
.fab{
  position: fixed;
  bottom:90px;
  right:10px;
}

.fab button{
  cursor: pointer;
  width: 48px;
  height: 48px;
  border-radius: 30px;
  background-color: #3355b4;
  border: none;
  box-shadow: 0 1px 5px rgba(0,0,0,.4);
  font-size: 24px;
  color: white;
    
  -webkit-transition: .2s ease-out;
  -moz-transition: .2s ease-out;
  transition: .2s ease-out;
}

.fab button:focus{
  outline: none;
}

.fab button.main{
  position: absolute;
  width: 60px;
  height: 60px;
  border-radius: 30px;
  background-color: #3355b4;
  right: 0;
  bottom: 0;
  z-index: 20;
}

.fab button.main:before{
  content: '⏚';
}

.fab ul{
  position:absolute;
  bottom: 0;
  right: 0;
  padding:0;
  padding-right:5px;
  margin:0;
  list-style:none;
  z-index:10;
  
  -webkit-transition: .2s ease-out;
  -moz-transition: .2s ease-out;
  transition: .2s ease-out;
}

.fab ul li{
  display: flex;
  justify-content: flex-start;
  position: relative;
  margin-bottom: -10%;
  opacity: 0;
  
  -webkit-transition: .3s ease-out;
  -moz-transition: .3s ease-out;
  transition: .3s ease-out;
}

.fab ul li label{
  margin-right:10px;
  white-space: nowrap;
  display: block;
  margin-top: 10px;
  padding: 5px 8px;
  background-color: white;
  box-shadow: 0 1px 3px rgba(0,0,0,.2);
  border-radius:3px;
  height: 18px;
  font-size: 16px;
  pointer-events: none;
  opacity:0;
  
  -webkit-transition: .2s ease-out;
  -moz-transition: .2s ease-out;
  transition: .2s ease-out;
}

.fab.show button.main,
.fab.show button.main{
  outline: none;
  background-color: #3355b4;
  box-shadow: 0 3px 8px rgba(0,0,0,.5);
 }
 
.fab.show button.main:before,
.fab.show button.main:before{
  content: '↑';
}

.fab.show button.main + ul,
.fab.show button.main + ul{
  bottom: 70px;
}

.fab.show button.main + ul li,
.fab.show button.main + ul li{
  margin-bottom: 10px;
  opacity: 1;
}

.fab.show button.main + ul li:hover label,
.fab.show button.main + ul li:hover label{
  opacity: 1;
}
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
                <p class="my-0">Maxartkiller</p>
                <p class="text-mute my-0 small">United States</p>
            </div>
            <div class="col-auto align-self-center">
                <a href="login.html" class="btn btn-link text-white p-2"><i class="material-icons">power_settings_new</i></a>
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
$(function() {
  var availableTags = [
    "ActionScript", "AppleScript", "Asp", "BASIC", "C", "C++",
    "Clojure", "COBOL", "ColdFusion", "Erlang", "Fortran",
    "Groovy", "Haskell", "Java", "JavaScript", "Lisp", "Perl",
    "PHP", "Python", "Ruby", "Scala", "Scheme"
  ];
  
  $(".autocomplete").autocomplete({
    source: availableTags
  });
});
</script>
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
									  <div class="form-group">
    <label>Languages</label>
    <input class="form-control autocomplete" placeholder="Enter A" />
  </div>
  
  <div class="form-group">
    <label >Another Field</label>
    <input class="form-control">
  </div>
</div>
									<div class="form-group col-md-4 m-t-20">
									<div class="container">
									<select name="situacao" class="form-control" autocomplete="off"  style="width: 100%; height:36px;" required="required">
										<option>Selecionar Horario</option>
										<?
											$hora = '06:30:00';
											for($i = 0; $i < 30; $i++){
											$hora = date('H:i:s', strtotime('+30 minute', strtotime($hora)));
											echo "<option value='$hora'>$hora</option>";
											}
										?>
										</select>
									</div>
									<div class="form-group col-md-12 m-t-20"><label>Pesquisar Cliente:</label>
									    <input name="user" type="text" autocomplete="off" class="form-control" onkeyup="javascript: ajaxLoader('?br=atu_pesquisa&pesquisa='+ this.value +'&ap=1','situacao','GET');" required="required" />
									</div>
									<div class="form-group col-md-12 m-t-20"><label>Cliente: </label>
									<select name="situacao" id="situacao" autocomplete="off" class="form-control" style="width: 100%; height:36px;" required="required" />
										  <option>Selecione o Cliente</option>
										</select>
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
    <script src="template/js/jquery-3.3.1.min.js"></script>
    <script src="template/js/popper.min.js"></script>
    <script src="template/vendor/bootstrap-4.4.1/js/bootstrap.min.js"></script>

    <!-- cookie js -->
    <script src="template/vendor/cookie/jquery.cookie.js"></script>

    <!-- swiper js -->
    <script src="template/vendor/swiper/js/swiper.min.js"></script>

    <!-- swiper js -->
    <script src="template/vendor/sparklines/jquery.sparkline.min.js"></script>
	

    <!-- template custom js -->
    <script src="template/js/main.js"></script>

    <!-- page level script -->
    <script>
        $(window).on('load', function() {
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
        })

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
      <script src="template/vendor/calendar/jquery-ui.min.js"></script>
    <script src="template/vendor/moment/moment.js"></script>
    <script src='template/vendor/calendar/dist/fullcalendar.js'></script>
	<script src="template/vendor/calendar/dist/lang/pt-br.js"></script>
	<script>
   

function onCalendarDayClick(date, allDay, jsEvent, view) {
    // Check to see whether the mouse was hovering over our day corner overlay 
    // that is itself applied to the fullCalendar's selection overlay div.
    // If it is, then we know we clicked on the day number and not some other 
    // part of the cell.
    if ($('.my-cell-overlay-day-corner').is(':hover')) {
        alert('Click!');
    }
}

  $(document).ready(function() 
  {
	  
	  
   var calendar = $('#calendar').fullCalendar({
	defaultView: 'agendaDay',
	ignoreTimezone: false,
    monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
    monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
    dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sabado'],
    dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sab'],
    editable:true,
	locale: 'pt-br',
      timeFormat: 'HH:mm',
      editable: true,
      eventLimit: false,
      displayEventTime: this.displayEventTime,
      slotLabelFormat: 'HH:mm',
      allDayText: '24 horas',
      columnFormat: 'dddd',
      header: {
        left: 'prev,next today',
        center: 'title',
        right: 'agendaDay,agendaWeek,month'
      },
      buttonText: {
        today: 'Hoje',
		day: 'Hoje',
        month: 'Mês',
        week: 'Semana'
      },
	eventRender: function(event, element) {

        // To append if is description in next line
        if(event.description != '' && typeof event.description  !== "undefined")
        {  
            element.find(".fc-title").append("<br/><b>"+event.description+"</b>");
        }
    }, 
    events: 'pgsl/atu_agendamento_load.php?load=1',
    selectable:true,
    selectHelper:true,

    select: function(start, end, allDay, view)
    {
       var start = $.fullCalendar.formatDate(start, "Y-MM-DD HH:mm:ss");
       var end = $.fullCalendar.formatDate(end, "Y-MM-DD HH:mm:ss");
			
	   sessionStorage.setItem("inicio", start);
	   sessionStorage.setItem("termino", end);
			
       if (view.name === "agendaDay" || view.name === "agendaWeek" ) 
	   {
		  $('#ModalAdd').modal('show'); 
	   }
		
    },
	
    editable:false,
    /*eventResize:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"pgsl/atu_agendamento_load.php?&ap=2",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function(){
       calendar.fullCalendar('refetchEvents');
	   swal('Atenção', 'Agendamento atualizado');
      }
     })
    },*/

    eventDrop:function(event)
    {
     var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD HH:mm:ss");
     var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD HH:mm:ss");
     var title = event.title;
     var id = event.id;
     $.ajax({
      url:"pgsl/atu_agendamento_load.php?&ap=2",
      type:"POST",
      data:{title:title, start:start, end:end, id:id},
      success:function()
      {
       calendar.fullCalendar('refetchEvents');
	   swal('Atenção', 'Agendamento atualizado');
      }
     });
    },

    eventClick:function(event)
    {
     
	 swal({   
            title: "Atenção!",   
            text: "Tem certeza que deseja removê-lo? ?",   
            type: "warning",   
            showCancelButton: true,   
            //confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Sim, Excluir!",
            cancelButtonText: "Não, Cancelar!", 			
            closeOnConfirm: true 
        }, function()
		{   
		
		var id = event.id;
		$.ajax({
  		     url:"pgsl/atu_agendamento_load.php?&ap=3",
  		     type:"POST",
  		     data:{id:id},
 		      success:function()
 		      {
 		       calendar.fullCalendar('refetchEvents');
				swal('Atenção', 'Agendamento Removido');
 		      }
 		     })
			
        });
    },

   });
  });
   
  </script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.2/js/bootstrap.js"></script>


</body>

</html>
