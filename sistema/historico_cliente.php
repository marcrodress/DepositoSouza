<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/historico_cliente.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#box_central #historico_pagamentos table {
	font-weight: bold;
}
#box_historicos_carrinhos table {
	font-weight: bold;
}
</style>
</head>

<body> 
<?

if($cliente == ''){
 echo "<script language='javascript'>window.alert('Primeiro informe o cliente para exibir o histórico!');window.location='?pack=10';</script>";
}

?>

<div id="box_busca_prod_cliente">
<h1 style="font:18px Arial, Helvetica, sans-serif; margin:5px; padding:0;"><strong>COD:</strong> <? echo strtoupper($cliente); ?> - <strong>Cliente:</strong> <? echo strtoupper($nome_cliente); ?> - <strong>Saldo devedor:</strong> R$ <? echo number_format($saldo_devedor,2,',','.'); ?></h1>
<h1 style="font:18px Arial, Helvetica, sans-serif; margin:2px 0 0 0; padding:5px;"><strong>Última compra:</strong> 

    <?
	 $sql_ultima_compra = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE cliente = '$cliente' AND status = 'ENCERRADO' ORDER BY id DESC LIMIT 1");
	 if(mysqli_num_rows($sql_ultima_compra) == ''){
		 echo "<em>Ainda não fez compra</em>";
	 }else{
	 	while($res = mysqli_fetch_array($sql_ultima_compra)){
			echo $res['data_completa'];
		}
	 }
	 
	?>

 - <strong>Último pagamento:</strong> 01/07/2020</h1>
</div><!-- box_busca_prod_cliente-->

<div id="box_central">

<div id="box_pagamentos">
 <h1 style="font:15px Arial, Helvetica, sans-serif; margin:5px;"><strong>Informar pagamentos</strong></h1>
 <form name="" method="post" action="" enctype="multipart/form-data">
  <select style="font:20px Arial, Helvetica, sans-serif; margin:5px; padding:10px; width:320px; border:1px solid #000; border-radius:5px;" name="forma_pagamento" size="1">
    <option value="DINHEIRO">DINHEIRO</option>
    <option value="CARTAO DE CREDITO">CARTAO DE CREDITO</option>
    <option value="CARTAO DE DEBITO">CARTAO DE DEBITO</option>
    <option value="CHEQUE">PIX/TRANSFERÊNCIA</option>
  </select>
  <input name="valor" type="text" style="font:20px Arial, Helvetica, sans-serif; text-align:center; color:#00F; margin:5px; padding:10px; width:80px; border:1px solid #000; border-radius:5px;" value="<? 


@$pontos = array(".", ".");
@$saldo_devedor = str_replace($pontos, ",", $saldo_devedor);  
  
  echo $saldo_devedor; ?>
" />
 </form>
<hr />

 <br /><br />
 <br /><br />

<? if(isset($_POST['valor'])){

@$forma_pagamento = $_POST['forma_pagamento'];
$valor = $_POST['valor'];

$verifica_ponto = 0;
for($i=0; $i<strlen($valor); $i++){
	if($valor[$i] == '.'){
		$verifica_ponto = 1;
	}
}

if($verifica_ponto == 1){
	echo "<script language='javascript'>window.alert('Não utilize pontos, apenas utilize virgulas para separar os centavos. EX: 100,35');</script>";
}else{

@$pontos = array(",", ".");
@$valor = str_replace($pontos, ".", $valor);

@$pontos = array(",", ".");
@$saldo_devedor = str_replace($pontos, ".", $saldo_devedor);

$saldo_devedor;
$valor;

$saldo_devedor = $saldo_devedor-$valor;
mysqli_query($conexao_bd, "UPDATE clientes SET saldo = '$saldo_devedor', code_ultimo_pagamento = '$code_dia' WHERE code = '$cliente'");

mysqli_query($conexao_bd, "INSERT INTO historico_creditos (dia, mes, ano, data, data_completa, ip, cliente, operador, valor, forma_pagamento, code_dia) VALUES ('$dia', '$mes', '$ano', '$data', '$data_completa', '$ip', '$cliente', '$operador', '$valor', '$forma_pagamento', '$code_dia')");
?>
    <script language="javascript">
		function finaliza(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=340,height=400');
		}
	</script>

	<a style="font:12px Arial, Helvetica, sans-serif; text-decoration:none; border:4px solid #000; background:#069; padding:10px; margin:0 0 0 140px; color:#FFF;" onclick="finaliza('scripts/recibo_pagamento.php?operador=<? echo $nome; ?>&forma=<? echo $forma_pagamento; ?>&data_pagamento=<? echo date("d/m/Y H:i:s"); ?>&cliente=<? echo $nome_cliente; ?>&valor=<? echo $valor; ?>&nome_cliente=<? echo $nome_cliente; ?>');" href="?pack=20"><strong>Emitir recibo de pagamento</strong></a>

<? }} ?> 

</div><!-- box_pagamentos -->

<div id="historico_pagamentos">
 <h1 style="font:15px Arial, Helvetica, sans-serif;"><strong>Últimos produtos comprados</strong></h1>
 <hr />
<?

$sql_produtos = mysqli_query($conexao_bd, "SELECT * FROM carrinho_produtos WHERE cliente = '$cliente' ORDER BY id DESC LIMIT 10");
if(mysqli_num_rows($sql_produtos) == ''){
	echo "Cliente ainda não comprou nenhum produto...";
}else{
?>
<table width="540" border="0">
  <tr>
    <td width="100" align="center">Data</td>
    <td width="256" align="left">Título</td>
    <td width="56" align="center">Quant.</td>
    <td width="110" align="center">Valor total</td>
  </tr>
  <? $i=0; while($res_produto = mysqli_fetch_array($sql_produtos)){ $i++; ?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td align="center"><h1 style="font:12px Arial, Helvetica, sans-serif; color:#666;">
    
    <? if(($code_dia-$res_produto['code_dia']) <=7){ ?>
    <a title="Excluir produto" href="?pack=20&p=excluir_produto&id=<? echo $res_produto['id']; ?>&cliente=<? echo $cliente; ?>&valor=<? echo $res_produto['vl_total']; ?>"><img src="img/deleta.png" width="5" height="5" border="0" /></a>
	<? } ?>
	
	<? echo $res_produto['dia']; ?>/<? echo $res_produto['mes']; ?>/<? echo $res_produto['ano']; ?></h1></td>
    <td align="left"><h1 style="font:12px Arial, Helvetica, sans-serif; color:#666; margin:0; padding:0;"><?
     
	 $sql_titulo = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE code = '".$res_produto['produto']."'");
	 	while($res_titulo = mysqli_fetch_array($sql_titulo)){
			echo $res_titulo['titulo'];
		}
	 
	?></h1></td>
    <td align="center"><h1 style="font:12px Arial, Helvetica, sans-serif; color:#666;"><? echo $res_produto['quantidade']; ?></h1></td>
    <td align="center"><h1 style="font:12px Arial, Helvetica, sans-serif; color:#666;">R$ <? echo number_format($res_produto['vl_total'],2,',','.'); ?></h1></td>
  </tr>
  <? } ?>
</table>
<? } ?>
</div><!-- historico_pagamentos -->
</div><!-- box_central -->

<? if(@$_GET['p'] == 'excluir_produto'){
	
$saldo_atualizar = $saldo_devedor-$_GET['valor'];
$id = $_GET['id'];
$cliente = $_GET['cliente'];

$saldo = mysqli_query($conexao_bd, "UPDATE clientes SET saldo = '$saldo_atualizar' WHERE code = '$cliente'");
if($saldo == ''){
echo "<script language='javascript'>window.alert('Erro ao excluir registro!');</script>";
}else{
mysqli_query($conexao_bd, "DELETE FROM carrinho_produtos WHERE id = '$id'");
echo "<script language='javascript'>window.location='?pack=20&enviar=Buscar';</script>";
}
}?>

<div id="box_historicos_carrinhos">
<h2 style="font:20px Arial, Helvetica, sans-serif; margin:5px;"><strong>Histórico de compras</strong></h2>
<hr />
<?

$sql_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE cliente = '$cliente' AND status = 'ENCERRADO'");
if(mysqli_num_rows($sql_carrinho) == ''){
	echo "Ainda não foi realizado nenhuma compra para este cliente...";
}else{	
?>
<h1 style="font:12px Arial, Helvetica, sans-serif;"><table width="990" border="0">
  <tr>
    <td width="54" bgcolor="#669999" align="center">&nbsp;</td>
    <td width="146" bgcolor="#669999" align="center">DATA</td>
    <td width="184" bgcolor="#669999" align="center">OPERADOR</td>
    <td width="122" bgcolor="#669999" align="center">CARRINHO</td>
    <td width="110" bgcolor="#669999" align="center">QUANT. PROD.</td>
    <td width="122" bgcolor="#669999" align="center">VALOR TOTAL</td>
    <td width="172" bgcolor="#669999" align="center">FORMA DE PAGAMENTO</td>
    <td width="46" bgcolor="#669999" align="center">
    <script language="javascript">
		function historico(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=340,height=400');
		}
	</script>      
    <a onclick="historico('scripts/historico_cliente.php?nome=<? echo $nome; ?>&cliente=<? echo $cliente; ?>');" href=""><img src="img/historico_cliente.png" width="35" height="35" border="0" title="Imprimir histórico de vendas do cliente" /></a></td>
  </tr>
  <? 
  $i=0;
  $soma_quant = 0;
  $soma_pagamentos = 0;
  while($res_carrinho = mysqli_fetch_array($sql_carrinho)){ $i++; 
    $quant = 0;
	$valor_total = 0;
	$forma_pagamento = 0;

  	$sql_produtos = mysqli_query($conexao_bd, "SELECT * FROM carrinho_produtos WHERE carrinho = '".$res_carrinho['code_carrinho']."'");
	  while($res_pro = mysqli_fetch_array($sql_produtos)){
		  $quant = $quant+$res_pro['quantidade'];
		  $valor_total = $valor_total+$res_pro['vl_total'];
	 }
	 
	 
	 
	 
	 $sql_carrinho_pagamentos = mysqli_query($conexao_bd, "SELECT * FROM carrinho_pagamentos WHERE code_carrinho = '".$res_carrinho['code_carrinho']."'");
  	   while($res_pag = mysqli_fetch_array($sql_carrinho_pagamentos)){
		   $forma_pagamento = $res_pag['forma_pagamento'];
	   }
  ?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td align="center"><? echo $i; ?></td>
    <td align="center"><? echo $res_carrinho['dia']; ?>/<? echo $res_carrinho['mes']; ?>/<? echo $res_carrinho['ano']; ?></td>
    <td align="center"><? echo $res_carrinho['operador']; ?></td>
    <td align="center"><? echo $res_carrinho['code_carrinho']; ?></td>
    <td align="center"><? $soma_quant = $soma_quant+$quant; echo $quant; ?></td>
    <td align="center">R$ <? $soma_pagamentos = $soma_pagamentos+$valor_total; echo number_format($valor_total,2,',','.'); ?></td>
    <td align="center"><? echo $forma_pagamento; ?></td>
    <td align="center">
    <script language="javascript">
		function finaliza(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=340,height=400');
		}
	</script>    
    
    <a onclick="finaliza('scripts/encerra_compra.php?operador=<? echo $nome; ?>&cliente=<? echo $cliente; ?>&carrinho=<? echo $res_carrinho['code_carrinho']; ?>&data_completa=<? echo $res_carrinho['dia']; ?>/<? echo $res_carrinho['mes']; ?>/<? echo $res_carrinho['ano']; ?>');" href=""><img src="img/recibo_compra.png" width="25" height="25" border="0" title="Emitir recibo compra"></a></td>
  </tr>
  <? } ?>
  <tr>
    <td colspan="4" align="right">QUANTIDA DE PRODUTOS COMPRADOS</td>
    <td align="center"><? echo $soma_quant; ?></td>
    <td align="center">R$ <? echo number_format($soma_pagamentos,2,',','.'); ?></td>
    <td colspan="2" align="center">&nbsp;</td>
    </tr>
</table>
<? } ?>
</h1>
</div><!-- box_historicos_carrinhos-->


<div id="box_historico_pagamentos">
<h2 style="font:20px Arial, Helvetica, sans-serif; margin:5px;"><strong>Histórico de pagamentos</strong></h2>
<hr />
<?

$sql_pagamentos = mysqli_query($conexao_bd, "SELECT * FROM historico_creditos WHERE cliente = '$cliente' ORDER BY id DESC");
if(mysqli_num_rows($sql_pagamentos) == ''){
	echo "<h1 style='font:12px Arial; margin:10px;'><em>Ainda não foi realizado nenhum pagamento por este cliente...</em></h1><br>";
}else{	
?>
<h1 style="font:12px Arial, Helvetica, sans-serif;"><table width="990" border="0">
  <tr>
    <td width="64" bgcolor="#009900" align="center">&nbsp;</td>
    <td width="278" bgcolor="#009900" align="center">DATA</td>
    <td width="224" bgcolor="#009900" align="center">OPERADOR</td>
    <td width="90" align="center" bgcolor="#009900">VALOR</td>
    <td width="252" bgcolor="#009900" align="center">FORMA DE PAGAMENTO</td>
    <td width="56" bgcolor="#009900" align="center">
    <script language="javascript">
		function historico(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=340,height=400');
		}
	</script>      
    <a onclick="historico('scripts/recibo_pagamento_todos.php?cliente=<? echo $cliente; ?>&nome=<? echo $nome_cliente; ?>');" href=""><img src="img/historico_cliente.png" width="35" height="35" border="0" title="Imprimir histórico de pagamentos do cliente" /></a></td>
  </tr>
  <? 
  $soma_pagamentos = 0;
  $i=0; while($res_pagamento = mysqli_fetch_array($sql_pagamentos)){ $i++; 
   $soma_pagamentos = $res_pagamento['valor']+$soma_pagamentos;
  ?>

  <tr <? if($i%2 == 0){ echo "bgcolor='#FFEAEA'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td align="center"><? echo $i; ?></td>
    <td align="center"><? echo $res_pagamento['data_completa']; ?></td>
    <td align="center"><? echo $res_pagamento['operador']; ?></td>
    <td align="center">R$ <? echo number_format($res_pagamento['valor'],2,',','.'); ?></td>
    <td align="center"><? $cheque = 0;
	if($res_pagamento['forma_pagamento'] == 'CHEQUE'){
		echo $cheque = "PIX";
	}else{
		echo $cheque = $res_pagamento['forma_pagamento']; 
	}
	?></td>
    <td align="center">
    <script language="javascript">
		function finaliza(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=340,height=400');
		}
	</script>    
    
    <a onclick="finaliza('scripts/recibo_pagamento.php?forma=<? echo $cheque; ?>&cliente=<? echo $nome_cliente; ?>&valor=<? echo $res_pagamento['valor']; ?>&operador=<? echo $nome; ?>&data_pagamento=<? echo $res_pagamento['data_completa']; ?>&nome_cliente=<? echo $nome_cliente; ?>');" href=""><img src="img/recibo_compra.png" width="25" height="25" border="0" title="Emitir comprovante pagamento"></a></td>
  </tr>
  <? } ?>
  <tr>
    <td colspan="3" align="RIGHT">VALOR TOTAL PAGO</td>
    <td  align="center">R$ <? echo number_format($soma_pagamentos,2,',','.'); ?></td>
    <td colspan="2" align="center">&nbsp;</td>
    </tr>
</table>
<? } ?>
</h1>
</div><!-- box_historico_pagamentos-->
</body>
</html>