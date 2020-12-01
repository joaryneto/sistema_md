<?

if($_GET['ap'] == 1)
{
  $SQL = "DELETE FROM imagens where codigo=".$_GET['codigo']."";	
  mysqli_query($db,$SQL);
  
  print("<script>window.alert('Deletado com sucesso.')</script>");
  
}

if($_GET['list'] == 1)
{

$x = 0;
$sql = "SELECT codigo,imagem FROM imagens where protocolo='".$_GET['protocolo']."'";
$res = mysqli_query($db,$sql); 
while($row = mysqli_fetch_array($res))
{
    $x = 1;
}

if($x == 1)
{
?>

<script>

//function visualizar(protocolo,dcm,codigo)
//{
//	window.open('http://sistemav2.imaggi.com.br/dwv/viewers/mobile/index.html?input=http://sistemav2.imaggi.com.br/laudos_enviados/'+ protocolo +'/'+ dcm +'&codigo='+ codigo +'');
//}

function ajustar()
{
try{    
var oBody       =       ifrm.document.body;
var oFrame      =       document.all("viwer");          
oFrame.style.height = oBody.scrollHeight + (oBody.offsetHeight - oBody.clientHeight);
oFrame.style.width = oBody.scrollWidth + (oBody.offsetWidth - oBody.clientWidth);
}
catch(e)
{
window.status = 'Error: ' + e.number + '; ' + e.description;
}
}

function getExt(filename)
{
	var ext = filename.split(".").pop();
    if(ext == filename) return "";
    return ext;

}

function visualizar(local,arquivo)
{	
	if(getExt(arquivo)=="pdf")
	{
		document.getElementById("verPdf").innerHTML = "<object data=.."+ local +""+arquivo+" type=application/pdf width=100% height=1024></object>";

	}
	else if(getExt(arquivo) == "PDF")
	{
		document.getElementById("verPdf").innerHTML = "<object data=.."+ local +""+arquivo+" type=application/pdf width=100% height=1024></object>";
	}
	else if(getExt(arquivo) == "dcm")
	{
		document.getElementById("verPdf").innerHTML = "<div id=rx><iframe src='/dwv/viewers/mobile/index.html?input=http://<? echo $_SERVER[HTTP_HOST];?>"+ local +""+arquivo+"&codigo=<?php echo $codigo;?>' height=1024 width=100%></iframe></div>";
	}
	else
	{
		document.getElementById("verPdf").innerHTML = "<img height=50% width=100% src=.."+ local +""+arquivo+">";
	}
}

function visualizar2(local,arquivo)
{	
	if(getExt(arquivo)=="pdf")
	{
		//document.getElementById("verPdf").innerHTML = "<object data=.."+ local +""+arquivo+" type=application/pdf width=100% height=1024></object>";
		
		window.open("http://<? echo $_SERVER[HTTP_HOST];?>" + local +""+arquivo ); 

	}
	else if(getExt(arquivo) == "PDF")
	{
		//document.getElementById("verPdf").innerHTML = "<object data=.."+ local +""+arquivo+" type=application/pdf width=100% height=1024></object>";
		window.open("http://<? echo $_SERVER[HTTP_HOST];?>" + local +""+arquivo ); 
	}
	else if(getExt(arquivo) == "dcm")
	{
		window.open("http://<? echo $_SERVER[HTTP_HOST];?>/dwv/viewers/mobile/index.html?input=http://<? echo $_SERVER[HTTP_HOST];?>"+ local +""+arquivo+"&codigo=<?php echo $codigo;?>" + local +""+arquivo ); 
	}
	else
	{
		//document.getElementById("verPdf").innerHTML = "<img src="+arquivo+">";
		window.open("http://<? echo $_SERVER[HTTP_HOST];?>" + local +""+arquivo ); 
	}
}
</script>
    
<div class="table-responsive m-t-40" id="listaexames">
<table id="example23" class="display nowrap table table-hover table-striped table-bordered">
<thead>
  <tr>
   <th class="hid">Codigo</th>
   <th>Arquivo</th>
   <th>X</th>
   <th>X</th>
   <th>X</th>
</tr>
</thead>
  <tbody>
<? 

$sql = "SELECT codigo,imagem,protocolo FROM imagens where protocolo='".$_GET['protocolo']."'";
$res = mysqli_query($db,$sql); 
while($row = mysqli_fetch_array($res))
{  

 $SQL2 = "SELECT * FROM laudos_enviados where protocolo=".$row['protocolo']."";
 $RES2 = mysqli_query($db,$SQL2);
 
 $x = 0;
 while($rows = mysqli_fetch_array($RES2))
 {
	 if($rows['pasta'] == 0)
	 {
		 $local = "/laudos_enviados/";
		 $local2 = "C:\www\imaggi\laudos_enviados/";
	 }
	 else
	 {
		 $local = "/laudos_enviados/".$_GET['protocolo']."/";
		 $local2 = "C:\www\imaggi\laudos_enviados/".$_GET['protocolo']."/";
	 }
	 
	 $status=$rows['status']; 
 }
 
 $file = ".".$local.$row['imagem'];
 
 if(file_exists($file))
 {
 
?>
<tr>
  <td class="hid"><? echo $row['codigo'];?></td>
  <td><? echo $row['imagem'];?></td>
  <td><a  data-toggle="tooltip" data-placement="top" title="" data-original-title="Visualizar e atualizar lista" href="javascript: Web(0);" data-toggle="modal" data-target="#respon" OnClick="visualizar('<? echo $local; ?>','<? echo $row['imagem'];?>')"><i class="fa fa-eye" style="font-size: 150%; color: #00abff;"></i></a></td>
  <td><a href="javascript: Web(0);" alt="Imprimir" OnClick="visualizar2('<? echo $local; ?>','<? echo $row['imagem'];?>')"><i class="fa fa-print" data-toggle="tooltip" data-placement="top" title="" data-original-title="Imprimir" style="font-size: 150%; color: #00abff;"></i></a></td>
  <td>
  <? if($_SESSION['menu4'] == true and $status == 1 or $_SESSION['menu4'] == true and $status == 3 or $_SESSION['menu4'] == true and $_GET['inconsistencia'] == 1){?>
  <a href="javascript: Web(0);" onclick="javascript: ajaxLoader('?br=mimagens&protocolo=<? echo $_GET['protocolo'];?>&codigo=<? echo $row['codigo']; ?>&ap=1&list=1<? if($_GET['inconsistencia'] == 1){ echo "&inconsistencia=1";}?>','examesid','GET');">
  <i class="fa fa-trash-o" data-toggle="tooltip" data-placement="top" title="" data-original-title="Excluir arquivo" style="font-size: 150%; color: red;"></i></a>
  <? } ?>
  </td>
</tr>
<? 
 }
 else
 {
	 "<tr><td>*</td><td></td><td></td><td></td><td></td></tr>";
 }
} ?>
</tbody>
<tfoot>
  <tr>
   <th class="hid">Codigo</th>
   <th>Arquivo</th>
   <th>X</th>
   <th>X</th>
   <th>X</th>
  </tr>
</tfoot>
</table>

<?
if($_GET['modal'] == 1)
{
?>
<div id="verPdf"> 
</div>
<?	
} 
}
else
{ 
   echo "Nenhum resultado encontrado"; 
} 
} ?>

