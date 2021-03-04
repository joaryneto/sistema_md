<?

$inputb = filter_input_array(INPUT_GET, FILTER_DEFAULT);

$inicio = revertedata(@$inputb['inicio']);
$final = revertedata(@$inputb['final']);

setlocale(LC_MONETARY,"pt_BR", "ptb");
//$valor = money_format('%n', $valor);

if(!Empty($inputb['inicio']) and !Empty($inputb['final']))
{
	$_SESSION['inicio'] = $inputb['inicio'];
	$_SESSION['final'] = $inputb['final'];
	$_SESSION['profissional'] = $inputb['profissional'];
}

$sql = "SELECT clientes.nome as cliente , count(agendamento_servicos.codigo) as qtd, agendamento_servicos.data, agendamento_servicos.codigo, usuarios.nome, produtos.preco, sum(((produtos_usuarios.comissao)/100)*vendas_recebidos.total) as TotalTaxa , sum(((produtos_usuarios.comissao)/100)*(vendas_recebidos.total-(((vendas_recebidos.taxa)/100)*vendas_recebidos.total))) as total FROM produtos_usuarios
inner join agendamento_servicos on agendamento_servicos.profissional=produtos_usuarios.usuario 
and agendamento_servicos.servico=produtos_usuarios.produto
inner join produtos on produtos.codigo=produtos_usuarios.produto
inner join usuarios on usuarios.codigo=produtos_usuarios.usuario
inner join vendas_mov on vendas_mov.agendamento=agendamento_servicos.codigo
inner join vendas_recebidos on vendas_recebidos.venda=vendas_mov.venda
left join clientes on clientes.codigo=vendas_mov.cliente
where produtos_usuarios.sistema='".$_SESSION['sistema']."' and produtos_usuarios.usuario='".$_SESSION['profissional']."' and vendas_mov.`status`=1 and agendamento_servicos.status=1 and agendamento_servicos.data >= CAST('".$_SESSION['inicio']."' AS DATE) AND agendamento_servicos.data <= CAST('".$_SESSION['final']."' AS DATE) GROUP BY agendamento_servicos.codigo ORDER BY agendamento_servicos.data asc ";
										  
$res = mysqli_query($db3,$sql); 
$row = mysqli_fetch_array($res);

if(isset($row['codigo']))
{

?>

<!DOCTYPE html>
<head>
    <title><? echo $_SESSION['sistema'];?></title>
    <style type="text/css">
        body {
            font-family: sans-serif;
        }

        body, table, h1, h2, h3 {
            font-size: 10pt;
        }

        h1 {
            margin: 0;
        }

        h2 {
            margin: 0;
            font-weight: normal;
        }

        h3 {
            font-weight: bold;
            margin-top: 1cm;
            margin-bottom: 3mm;
            border-bottom: 0px solid #000;
            padding-bottom: 1mm;
            text-transform: uppercase
        }

        h4 {
            font-style: italic;
            font-size: 1em;
            margin-top: 0.5cm;
            margin-bottom: 0;
            font-weight: normal;
        }

        .observacao {
            text-align: right;
            font-style: italic;
            font-size: /*0.8em*/35px;
        }

        .grid .totais td {
            font-weight: bold;
            border-top: 1.5px solid #000 !important;
        }

        .totais td:first-child {
            text-align: right;
        }

        .grid {
            border-collapse: collapse;
        }

            .grid td, .grid th {
                border: 1px solid #000;
                padding: 0.1cm 0.2cm;
            }

            .grid th {
                border-bottom: 1px solid #000;
                background-color: #DDD
            }

            .grid td.valorGrande {
                text-align: right;
            }

        .valorGrande {
            width: 7em;
        }

        .valorQuantidade {
            width: 5em;
            text-align: center;
        }

        @media print {
            .break {
                page-break-before: always;
            }
        }

        @media screen {
            .break {
                border-top: 1px dashed #AAA;
                margin: 2cm 0;
            }
        }

        #MensagemImpressaoRelatorioComissoes{
            margin-top: 10px;
            white-space:pre-line;
        }
        
    </style>
</head>
<body>
<div style="text-align: center;margin-bottom:75px;">
    <h1 style="margin:20px 0 40px;font-size: 12pt;">Ayme</h1>
    <h1>RESUMO FINANCEIRO</h1>
    <h1 style="margin: 1mm 0"><?=strtoupper($rowc['nome']);?></h1>
    <h2>Per&#237;odo de Pagamento: <?=$_SESSION['inicio'];?> a <?=$_SESSION['final'];?></h2>
</div>


    <h3>Descritivo das Receitas Variáveis no Período</h3>

<h4>Sobre Serviços</h4>
<table class="grid" width="100%">
    <tr>
        <th>Servi&#231;o</th>
        <th class="valorQuantidade">Quantidade</th>
            <th class="valorGrande">Valor em Serviços R$</th>
            <th class="valorGrande">Valor Profissional R$</th>
    </tr>
	
<? 

$SQL2 = "SELECT clientes.nome as cliente , count(agendamento_servicos.codigo) as qtd, agendamento_servicos.data, agendamento_servicos.codigo, usuarios.nome, produtos.preco, produtos.descricao, sum(((produtos_usuarios.comissao)/100)*vendas_recebidos.total) as TotalTaxa , sum(((produtos_usuarios.comissao)/100)*(vendas_recebidos.total-(((vendas_recebidos.taxa)/100)*vendas_recebidos.total))) as total FROM produtos_usuarios
inner join agendamento_servicos on agendamento_servicos.profissional=produtos_usuarios.usuario 
and agendamento_servicos.servico=produtos_usuarios.produto
inner join produtos on produtos.codigo=produtos_usuarios.produto
inner join usuarios on usuarios.codigo=produtos_usuarios.usuario
inner join vendas_mov on vendas_mov.agendamento=agendamento_servicos.codigo
inner join vendas_recebidos on vendas_recebidos.venda=vendas_mov.venda
left join clientes on clientes.codigo=vendas_mov.cliente
where produtos_usuarios.sistema='".$_SESSION['sistema']."' and produtos_usuarios.usuario='".$_SESSION['profissional']."' and vendas_mov.`status`=1 and agendamento_servicos.status=1 and agendamento_servicos.data >= CAST('".revertedata($_SESSION['inicio'])."' AS DATE) AND agendamento_servicos.data <= CAST('".revertedata($_SESSION['final'])."' AS DATE) GROUP BY produtos.descricao ORDER BY agendamento_servicos.data asc ";
		
$count = 0;		
$res2 = mysqli_query($db3,$SQL2); 
while($row = mysqli_fetch_array($res2))
{
?>
        <tr>
            <td><? echo $row['descricao'];?></td>
			<td><? echo $row['qtd'];?></td>
		    <td>R$ <? echo number_format($row['preco'],2,",",".");?></td>
	        <td>R$ <? echo number_format($row['total'],2,",",".");?></td>
        </tr>
<?
 }
?>
<? 

$SQL2 = "SELECT count(agendamento_servicos.codigo) as qtd,agendamento_servicos.codigo, usuarios.nome, produtos.preco, sum(((produtos_usuarios.comissao)/100)*vendas_recebidos.total) as TotalTaxa , sum(((produtos_usuarios.comissao)/100)*(vendas_recebidos.total-(((vendas_recebidos.taxa)/100)*vendas_recebidos.total))) as total, vendas_recebidos.total as valorrecebido FROM produtos_usuarios
inner join agendamento_servicos on agendamento_servicos.profissional=produtos_usuarios.usuario 
and agendamento_servicos.servico=produtos_usuarios.produto
inner join produtos on produtos.codigo=produtos_usuarios.produto
inner join usuarios on usuarios.codigo=produtos_usuarios.usuario
inner join vendas_mov on vendas_mov.agendamento=agendamento_servicos.codigo
inner join vendas_recebidos on vendas_recebidos.venda=vendas_mov.venda
where produtos_usuarios.sistema='".$_SESSION['sistema']."' and produtos_usuarios.usuario='".$_SESSION['profissional']."' and vendas_mov.`status`=1 and agendamento_servicos.status=1 and agendamento_servicos.data >= CAST('".revertedata($_SESSION['inicio'])."' AS DATE) AND agendamento_servicos.data <= CAST('".revertedata($_SESSION['final'])."' AS DATE)";
$count = 0;		
$res2 = mysqli_query($db3,$SQL2); 
while($row = mysqli_fetch_array($res2))
{
	
?>
    <tr class="totais">
        <td>Total</td>
        <td class="valorQuantidade"><? echo $row['qtd'];?></td>
            <td class="valorGrande"><? echo number_format($row['valorrecebido'],2,",",".");?></td>
            <td class="valorGrande"><? echo number_format($row['total'],2,",",".");?></td>
    </tr>
<? } ?>
</table>


<h3>Resumo</h3>
<table class="grid" width="100%">
    <tr>
        <th>Recebimentos</th>
        <th>Descontos</th>
    </tr>
    <tr>
        <td class="detalhes">
            <div class="linha">
                Sobre Servi&#231;os
                <span>22,50</span>
            </div>
            <div class="linha">
                Sobre Produtos Vendidos
                <span>0,00</span>
            </div>
            <div class="linha">
                Bonificações
                <span>0,00</span>
            </div>
        </td>
        <td class="detalhes">
            <div class="linha">
                Vales / Adiantamento
                <span>0,00</span>
            </div>
            <div class="linha">
                Compra/Uso de Produtos
                <span>0,00</span>
            </div>
        </td>
    </tr>
    <tr class="detalhes" style="font-weight: bold">
        <td class="detalhes">
            <div class="linha">
                Total de Recebimentos
                <span>22,50</span>
            </div>
        </td>
        <td class="detalhes">
            <div class="linha">
                Total de Descontos
                <span>0,00</span>
            </div>
        </td>
    </tr>
    <tr style="font-weight: bold">
        <td style="border: none"></td>
        <td class="detalhes">
            <div class="linha">
                Total a Receber
                <span>22,50</span>
            </div>
        </td>
    </tr>
</table>

<?
}
else
{
	echo "Nenhuma informação encontrado para esse periodo ou ja foi gerado a comissão.";
}

?>

    <script>
        javascript: window.print();
    </script>
</body>
</html>