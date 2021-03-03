<?

$inputb = filter_input_array(INPUT_GET, FILTER_DEFAULT);

$inicio = revertedata(@$inputb['inicio']);
$final = revertedata(@$inputb['final']);

setlocale(LC_MONETARY,"pt_BR", "ptb");
//$valor = money_format('%n', $valor);

if(!Empty($inputb['codigo']))
{
	$_SESSION['cod_comissao'] = $inputb['codigo'];
}

$SQLM = "SELECT * FROM comissao where sistema='".$_SESSION['sistema']."' and codigo='".$_SESSION['cod_comissao']."'";
$RESM = mysqli_query($db3,$SQLM);
$ROWM = mysqli_fetch_array($RESM);

$comissao = $ROWM['codigo'];
$inicio = $ROWM['data_inicio'];
$final = $ROWM['data_final'];
$profissional = $ROWM['profissional'];

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


<!DOCTYPE html>
<head>
    <title>Trinks.com</title>
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


<?

$SQLF = "SELECT * FROM usuarios where codigo='".$profissional."';";
$RES = mysqli_query($db3,$SQLF);
$ROWF = mysqli_fetch_array($RES);

?>
<table align="center" style="border: 2px solid #f1eeee; padding: 20px">
	<tr>
		<td>
            <div style="text-align: center;">
                <h1 style="margin: 1mm 0">Ayme</h1>
                <br />
                    <h1><u>Comprovante de Pagamento Profissional</u></h1>

                <br />
                
            </div>
		</td>
	</tr>
	<tr>
		<td>
			<div style="border: 1px solid; padding: 15px">

				<div style="margin-bottom: 20px">
					Data: 03/03/2021
				</div>
				<div style="margin-bottom: 20px">
					Profissional: <?=$ROWF['nome'];?>
				</div>
				<? 

$SQL2 = "SELECT count(agendamento_servicos.codigo) as qtd,agendamento_servicos.codigo, usuarios.nome, produtos.preco, sum(((produtos_usuarios.comissao)/100)*vendas_recebidos.total) as TotalTaxa , sum(((produtos_usuarios.comissao)/100)*(vendas_recebidos.total-(((vendas_recebidos.taxa)/100)*vendas_recebidos.total))) as total FROM produtos_usuarios
inner join agendamento_servicos on agendamento_servicos.profissional=produtos_usuarios.usuario 
and agendamento_servicos.servico=produtos_usuarios.produto
inner join produtos on produtos.codigo=produtos_usuarios.produto
inner join usuarios on usuarios.codigo=produtos_usuarios.usuario
inner join vendas_mov on vendas_mov.agendamento=agendamento_servicos.codigo
inner join vendas_recebidos on vendas_recebidos.venda=vendas_mov.venda
inner join comissao on comissao.profissional=produtos_usuarios.usuario
where produtos_usuarios.sistema='".$_SESSION['sistema']."' and produtos_usuarios.usuario='".$profissional."' and vendas_mov.`status`=1 and agendamento_servicos.status=1 and agendamento_servicos.data >= CAST('".$inicio."' AS DATE) AND agendamento_servicos.data <= CAST('".$final."' AS DATE)";
$count = 0;		
$res2 = mysqli_query($db3,$SQL2); 
while($row = mysqli_fetch_array($res2))
{
	
?>
				<div style="margin-bottom: 20px">
					<? echo number_format($row['total'],2,",",".");?>
				</div>
<? } ?>
				<div style="margin-bottom: 10px">
					Assinatura do Profissional: ____________________________________________________________
				</div>
			</div>
		</td>
	</tr>
	<tr>
		<td>
			<div style="text-align: right; margin-top: 20px">Impresso em 03/03/2021</div>
		</td>
	</tr>
</table>



    <script>
        window.print();
        window.onafterprint = function () { window.close() };
    </script>

