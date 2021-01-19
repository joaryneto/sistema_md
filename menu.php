		<? if($_SESSION['tipo'] == 2){?>
		<!--  SISTEMA ESCOLAR -->
        <div class="list-group main-menu my-5">
			<nav class="navbar" style="padding: .1rem 0rem;">
                <ul class="navbar-nav">
				    <li class="nav-item dropdown" style="width: 230px;">
                        <a href="javascript:void(0);" class="item-link item-content dropdown-toggle" id="navbarDropdown" role="button">
                            <div class="list-group-item list-group-item-action t-menu t-linhadotempo">
                                <i class="material-icons">perm_contact_calendar</i> Linha do tempo
                            </div>
                        </a>
					</li>
					<?if($_SESSION['permissao'] == 2 or $_SESSION['permissao'] == 3){?>
					<li class="nav-item dropdown" style="width: 230px;">
                        <a href="javascript:void(0);" class="item-link item-content dropdown-toggle" id="navbarDropdown" role="button">
                            <div class="list-group-item list-group-item-action t-menu sge-t-alunos">
                                <i class="material-icons">perm_contact_calendar</i> Alunos
                            </div>
                        </a>
					</li>
					<? } ?>
					<?if($_SESSION['permissao'] == 2 or $_SESSION['permissao'] == 3){?>
                    <li class="nav-item dropdown" style="width: 230px;">
                        <a href="" class="item-link item-content dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="list-group-item list-group-item-action">
                                <i class="material-icons">home</i> Diário de Classe
                            </div>
                        </a>
						
                        <div class="dropdown-menu t-menu">
						    <?if($_SESSION['permissao'] == 2 or $_SESSION['permissao'] == 3){?>
                            <a href="javascript: void(0);" class="dropdown-item m-diario">
							 Conteúdo Lecionado
                            </a>
                            <? } ?>
							<?if($_SESSION['permissao'] == 2 or $_SESSION['permissao'] == 3){?>
                            <a href="javascript:void(0);" class="sidebar-close dropdown-item menu-right r-diario" class="btn btn-info">
							 Relatorio
                            </a>
							<?}?>
                        </div>
						<? } ?>
                    </li>
					<?if($_SESSION['permissao'] == 2 or $_SESSION['permissao'] == 3){?>
					<li class="nav-item dropdown" style="width: 230px;">
                        <a href="" class="item-link item-content dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="list-group-item list-group-item-action">
                                <i class="material-icons">perm_contact_calendar</i> Secretaria
                            </div>
                        </a>
						<div class="dropdown-menu t-menu">
						    <?if($_SESSION['permissao'] == 2 or $_SESSION['permissao'] == 3){?>
                            <a href="javascript:void(0);" class="sidebar-close dropdown-item menu-right s-turmas" class="btn btn-info">
							 Turmas
                            </a>
							<?}?>
							<?if($_SESSION['permissao'] == 2 or $_SESSION['permissao'] == 3){?>
                            <a href="javascript:void(0);" class="sidebar-close dropdown-item menu-right s-disciplinas" class="btn btn-info">
							 Disciplinas
                            </a>
							<?}?>
							<? if($_SESSION['permissao'] == 2 or $_SESSION['permissao'] == 3){?>
                            <a href="javascript:void(0);" class="sidebar-close dropdown-item menu-right s-alunos" class="btn btn-info">
							 Alunos
                            </a>
							<?}?>
							<? if($_SESSION['permissao'] == 2 or $_SESSION['permissao'] == 3){?>
                            <a href="javascript:void(0);" class="sidebar-close dropdown-item menu-right s-matriculas" class="btn btn-info">
							 Matriculas
                            </a>
							<?}?>
                        </div>
					</li>
					<? } ?>
					<?if($_SESSION['permissao'] == 2 or $_SESSION['permissao'] == 3){?>
					<li class="nav-item dropdown" style="width: 230px;">
                        <a href="" class="item-link item-content dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="list-group-item list-group-item-action">
                                <i class="material-icons">perm_contact_calendar</i> Financeiro
                            </div>
                        </a>
						<div class="dropdown-menu t-menu">
							<? if($_SESSION['permissao'] == 2 or $_SESSION['permissao'] == 3){?>
                            <a href="javascript:void(0);" class="sidebar-close dropdown-item menu-right f-fatura" class="btn btn-info">
							 Contas a Receber
                            </a>
							<?}?>
							<? if($_SESSION['permissao'] == 2 or $_SESSION['permissao'] == 3){?>
                            <a href="javascript:void(0);" class="sidebar-close dropdown-item menu-right f-relatorio" class="btn btn-info">
							 Relatorio
                            </a>
							<?}?>
                        </div>
					</li>
					<? } ?>
					<?if($_SESSION['permissao'] == 3){?>
					<li class="nav-item dropdown" style="width: 230px;">
                        <a href="javascript: void(0);" class="item-link item-content dropdown-toggle" id="navbarDropdown" role="button">
                            <div class="list-group-item list-group-item-action t-menu u-cadastro">
                                <i class="material-icons">supervisor_account</i> Usuarios
                            </div>
                        </a>
					</li>
					<? } ?>
					<?if($_SESSION['permissao'] == 3){?>
					<li class="nav-item dropdown" style="width: 230px;">
                        <a href="#" class="item-link item-content dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="list-group-item list-group-item-action">
                                <i class="material-icons">supervisor_account</i> Administração
                            </div>
                        </a>
						<div class="dropdown-menu t-menu">
						    <?if($_SESSION['permissao'] == 2 or $_SESSION['permissao'] == 3){?>
                            <a href="javascript:void(0);" class="sidebar-close dropdown-item menu-right r-config" class="btn btn-info">
							 Configurações
                            </a>
							<?}?>
                        </div>
					</li>
					<? } ?>
					<? if(isMobile()){?>
					<li class="nav-item dropdown" style="width: 230px;" id="btninstall">
                        <a href="javascript:void(0);" class="item-link item-content dropdown-toggle" id="navbarDropdown" role="button">
                            <div class="list-group-item list-group-item-action">
                                <i class="material-icons">get_app</i> Instalar App
                            </div>
                        </a>
					</li>
		           <? } ?>
                </ul>
            </nav>
        </div>
	
		<?}?>
		<!--  SISTEMA DE SALÃO -->
		<? if($_SESSION['tipo'] == 3){?>
        <div class="list-group main-menu my-5">
			<nav class="navbar" style="padding: .1rem 0rem;">
                <ul class="navbar-nav">
				    <?if(@$_SESSION['permissao'] == 2 or @$_SESSION['permissao'] == 2 or @$_SESSION['permissao'] == 3  or @$_SESSION['permissao'] == 4){?>
				    <li class="nav-item dropdown" style="width: 230px;">
                        <a href="javascript: void(0);" class="item-link item-content dropdown-toggle" id="navbarDropdown" role="button">
                            <div class="list-group-item list-group-item-action t-menu t-agenda">
                                <i class="material-icons">perm_contact_calendar</i> Agenda
                            </div>
                        </a>
					</li>
					<? } ?>
					<?if(@$_SESSION['permissao'] == 3 or @$_SESSION['permissao'] == 4){?>
					<li class="nav-item dropdown" style="width: 230px;">
                        <a href="javascript: void(0);" class="item-link item-content dropdown-toggle" id="navbarDropdown" role="button">
                            <div class="list-group-item list-group-item-action t-menu t-vendas">
                                <i class="material-icons">store_mall_directory</i> Vendas
                            </div>
                        </a>
					</li>
					<? } ?>
					<?if(@$_SESSION['permissao'] == 2 or @$_SESSION['permissao'] == 4){?>
					<li class="nav-item dropdown" style="width: 230px;">
                        <a href="" class="item-link item-content dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="list-group-item list-group-item-action">
                                <i class="material-icons">store_mall_directory</i> Comissão
                            </div>
                        </a>
						<div class="dropdown-menu t-menu">
						    <?if(@$_SESSION['permissao'] == 4){?>
                            <a href="javascript: void(0);" class="dropdown-item t-gcomissao">
							 Gerar Comissão
                            </a>
							<? } ?>
							<?if(@$_SESSION['permissao'] == 2 or @$_SESSION['permissao'] == 4){?>
                            <a href="javascript: void(0);" class="dropdown-item t-pcomissao">
                             Comissão Geradas
                            </a>
							<? } ?>
                        </div>
					</li>
					<? } ?>
					<?if(@$_SESSION['permissao'] == 3 or @$_SESSION['permissao'] == 4){?>

					
                    <li class="nav-item dropdown" style="width: 230px;">
                        <a href="" class="item-link item-content dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="list-group-item list-group-item-action">
                                <i class="material-icons">home</i> Caixa
                            </div>
                        </a>
                        <div class="dropdown-menu t-menu">
                            <a href="javascript: void(0);" class="dropdown-item catual">
							 Caixa Atual
                            </a>
                            <a href="javascript: void(0);" class="dropdown-item canteriores">
                             Caixa Anteriores
                            </a>
                            <a href="javascript: void(0);" class="dropdown-item cmpagamento" >
                             Meios de Pagamento
                            </a>
                        </div>
                    </li>
					<? } ?>
					<?if(@$_SESSION['permissao'] == 4){?>
					<li class="nav-item dropdown" style="width: 230px;">
                        <a href="javascript:void(0);" class="item-link item-content dropdown-toggle" id="navbarDropdown" role="button">
                            <div class="list-group-item list-group-item-action t-menu t-produtos">
                                <i class="material-icons">card_giftcard</i> Produtos
                            </div>
                        </a>
					</li>
					<li class="nav-item dropdown" style="width: 230px;">
                        <a href="javascript:void(0);" class="item-link item-content dropdown-toggle" id="navbarDropdown" role="button">
                            <div class="list-group-item list-group-item-action t-menu t-cadastro">
                                <i class="material-icons">supervisor_account</i> Usuarios
                            </div>
                        </a>
					</li>
					<li class="nav-item dropdown" style="width: 230px;">
                        <a href="javascript:void(0);" class="item-link item-content dropdown-toggle" id="navbarDropdown" role="button">
                            <div class="list-group-item list-group-item-action t-menu r-config">
                                <i class="material-icons">supervisor_account</i> Configurações
                            </div>
                        </a>
					</li>
					<?} ?>
					<? if(isMobile()){?>
					<li class="nav-item dropdown" style="width: 230px;" id="btninstall">
                        <a href="javascript:void(0);" class="item-link item-content dropdown-toggle" id="navbarDropdown" role="button">
                            <div class="list-group-item list-group-item-action">
                                <i class="material-icons">get_app</i> Instalar App
                            </div>
                        </a>
					</li>
		           <? } ?>
                </ul>
            </nav>
        </div>
		<?}?>
    </div>