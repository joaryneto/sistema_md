<div class="list-group main-menu my-4">
   <a href="delivery.php" class="list-group-item list-group-item-action active"><i class="material-icons">home</i>Sacola</a>
   <a href="productdetails.html" class="list-group-item list-group-item-action"><i class="material-icons">view_day</i>Promoção</a>
   
   <!-- Restaurante -->
   <? if(isset($_SESSION['usuario'])) { ?>
   <a href="?dl=painel" class="list-group-item list-group-item-action"><i class="material-icons">build_circle</i>Administrador</a>
   <? } ?>
   <!-- Restaurante -->
   <a href="javascript: void(0);" id="btninstall" class="list-group-item list-group-item-action"><i class="material-icons">business</i>Instalar App</a>
</div>