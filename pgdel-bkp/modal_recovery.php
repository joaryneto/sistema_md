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

?>		

<?if($_GET['modal'] == 1){
?>
<script>
$('#r_recov').on('click',function()
{	
    var email = document.getElementById('email').value;
	
	if(email == "")
	{
	   swal('Atenção', 'Campo email em branco.');
	}
	else
	{
	   $('#modalform').modal('hide');
	   requestPage('?br=atu_login_recovery&email='+ email  +'&recovery=true','r_load','GET');
	}
});
</script>
<div class="modal-header">
<h2 class="pmd-card-title-text">Recuperação de Usuario</h2>
<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
</div>
<div class="modal-body">
<form class="form-horizontal">
<div class="form-group ">
<input name="email" id="email" type="text" class="form-control" autocomplete="off" />
</div>
<div class="form-group ">
<button type="button" id="r_recov" class="btn btn-info"><i class="fa fa-plus-circle"></i> Recuperar</button>
</div>
<div class="form-group " id="r_load">
</div>
</form>	
							 
<div class="modal-footer">
</div>
</div>	
<? }?>