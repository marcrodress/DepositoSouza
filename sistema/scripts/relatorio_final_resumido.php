<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>ENCERRA CARRINHO</title>
<style type="text/css">
body {
	background-color: #FFF;
	font:12px Arial, Helvetica, sans-serif;
	text-align:center;
	font-weight: bold;
}
body table{
	text-align:center;
	}
</style>
<? require "../../conexao.php"; $operador = $_GET['operador']; ?>
<script language="javascript">window.print();</script>

</head>

<body>
<table width="304" style="border:2px solid #000;" border="0">
<tr>
  <td colspan="3" align="center"><h1 style="font:20px Arial, Helvetica, sans-serif; margin:0; padding:0;"><strong>RELAT&Oacute;RIO FINAL RESUMIDO</strong></h1>
    <p><img src="../../img/logo.png" width="244" height="133" /></p>
    <h1 style="font:30px Arial, Helvetica, sans-serif; margin:0;"><strong>Deposito Souza</strong></h1>
    <p style="font:15px Arial, Helvetica, sans-serif; margin:0;"><strong>CNPJ: 07.107.782/0001-01</strong></p>
    <p style="font:15px Arial, Helvetica, sans-serif; margin:0;"><strong>Rua Capit&atilde;o In&aacute;cio Prata, S/N - Ta&iacute;ba<br />
      S&atilde;o Gon&ccedil;alo do Amarante - Cear&aacute;<br />
      CEP: 62670-000</strong></p>
    <p style="font:15px Arial, Helvetica, sans-serif; margin:0;"><strong>(85) 99137.7483/99420.1044/98851.8484</strong></p>
    <p style="font:18px Arial, Helvetica, sans-serif; margin:0;"><strong>Data da compra:<br />
      <? echo date("d/m/Y H:i:s"); ?></strong></p>
      <strong>Vendedor: <br />
      <? echo $_GET['operadornome']; ?><br /></td>
  </tr>
<tr>
  <td colspan="2" align="center"><hr />
<?
$diar = $_GET['dia'];
$mesr = $_GET['mes'];
$anor = $_GET['ano'];

$operador = $_GET['operador'];
$valor_abertura_caixa = 0;

$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM abertura_caixa WHERE operador = '$operador' AND dia = '$diar' AND mes = '$mesr' AND ano = '$anor'");
 while($res_caixa = mysqli_fetch_array($sql_verifica)){
	
$valor_abertura_caixa = ($res_caixa['nota100']*100)+($res_caixa['nota50']*50)+($res_caixa['nota20']*20)+($res_caixa['nota10']*10)+($res_caixa['nota5']*5)+($res_caixa['nota2']*2)+($res_caixa['moeda1']*1)+($res_caixa['moeda50']*0.5)+($res_caixa['moeda25']*0.25)+($res_caixa['moeda10']*0.1)+($res_caixa['moeda05']*0.05);
 }
?>
    Saldo inicial do caixa: R$ <? echo number_format($valor_abertura_caixa,2,',','.'); ?></td>
</tr>
<tr>
  <td colspan="2" align="center"><img src="../img/relatorio_venda_produtos.fw.png" width="300" height="32" /></td>
</tr>
<tr>
  <td width="142">N&ordm; de vendas</td>
  <td width="154">Quantidade de produtos</td>
</tr>
<tr>
  <td align="center" bgcolor="#FFFFFF">
  <?
  
  $diar = $_GET['dia'];
  $mesr = $_GET['mes'];
  $anor = $_GET['ano'];
  
  echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE operador = '$operador' AND dia = '$diar' AND mes = '$mesr' AND ano = '$anor' AND status = 'ENCERRADO'"));
  ?>
  </td>
  <td align="center" bgcolor="#FFFFFF"><?
   $produtos = 0;
   $sql_produtos = mysqli_query($conexao_bd, "SELECT * FROM carrinho_produtos WHERE operador = '$operador' AND dia = '$diar' AND mes = '$mesr' AND ano = '$anor'");
    while($res = mysqli_fetch_array($sql_produtos)){
		$produtos = $produtos+$res['quantidade'];
	}
  echo $produtos;
  ?></td>
</tr>
<tr>
  <td colspan="2"><img src="../img/relatorio_finaneiro.fw.png" width="300" height="32" /></td>
</tr>
<?
$soma_valores = 0;
$soma_quantidade = 0;

$dinheiro = 0;
$cartao_credito = 0;
$cartao_debito = 0;
$cheque = 0;
$crediario = 0;
$descontos = 0;

$sql_pagamento = mysqli_query($conexao_bd, "SELECT * FROM carrinho_pagamentos WHERE operador = '$operador' AND dia = '$diar' AND mes = '$mesr' AND ano = '$anor'");
 while($res_carrnho = mysqli_fetch_array($sql_pagamento)){
	 if($res_carrnho['forma_pagamento'] == 'DINHEIRO'){
		 $dinheiro = $dinheiro+$res_carrnho['valor'];
	 }elseif($res_carrnho['forma_pagamento'] == 'CARTAO DE CREDITO'){
		 $cartao_credito = $cartao_credito+$res_carrnho['valor'];
	 }elseif($res_carrnho['forma_pagamento'] == 'CARTAO DE DEBITO'){
		 $cartao_debito = $cartao_debito+$res_carrnho['valor'];
	 }elseif($res_carrnho['forma_pagamento'] == 'CHEQUE'){
		 $cheque = $cheque+$res_carrnho['valor'];
	 }elseif($res_carrnho['forma_pagamento'] == 'CREDIARIO'){
		 $crediario = $crediario+$res_carrnho['valor'];
	 }elseif($res_carrnho['forma_pagamento'] == 'DESCONTO'){
		 $descontos = $descontos+$res_carrnho['valor'];
	 }
 }
 
$sql_quant = mysqli_query($conexao_bd, "SELECT * FROM carrinho_produtos WHERE operador = '$operador' AND dia = '$diar' AND mes = '$mesr' AND ano = '$anor'");
 while($res_qua = mysqli_fetch_array($sql_quant)){
	 $soma_valores = $soma_valores+$res_qua['vl_total'];
	 $soma_quantidade = $soma_quantidade+$res_qua['quantidade'];
 }
 
?>

<tr>
  <td colspan="2">Total de vendido</td>
</tr>
<tr>
  <td colspan="2" align="center">R$ <? echo number_format($soma_valores,2,',','.'); ?></td>
</tr>
<tr>
  <td colspan="2" align="center"><hr /></td>
</tr>
<tr>
  <td align="left">Dinheiro</td>
  <td align="left">R$ <? echo number_format($dinheiro,2,',','.'); ?></td>
</tr>
<tr>
  <td align="left">Cart&atilde;o de cr&eacute;dito</td>
  <td align="left">R$ <? echo number_format($cartao_credito,2,',','.'); ?></td>
</tr>
<tr>
  <td align="left">Cart&atilde;o de d&eacute;bito</td>
  <td align="left">R$ <? echo number_format($cartao_debito,2,',','.'); ?></td>
</tr>
<tr>
  <td align="left">Pix/Transfer&ecirc;ncia</td>
  <td align="left">R$ <? echo number_format($cheque,2,',','.'); ?></td>
</tr>
<tr>
  <td align="left">Credi&aacute;rio</td>
  <td align="left">R$ <? echo number_format($crediario,2,',','.'); ?></td>
</tr>
<tr>
  <td align="left">Descontos</td>
  <td align="left">R$ <? echo number_format($descontos,2,',','.'); ?></td>
</tr>
<tr>
  <td colspan="2" align="center"><img src="../img/sangria.fw.png" width="300" height="32" /></td>
  </tr>
<tr>
  <td colspan="2" align="center">R$ <? 
  
   $valor_sangria = 0;
   $sql_sangria = mysqli_query($conexao_bd, "SELECT * FROM sangria WHERE dia = '$diar' AND ano = '$anor' AND ano = '$anor' AND operador = '$operador'");
   	while($res_sangria = mysqli_fetch_array($sql_sangria)){
		$valor_sangria = $valor_sangria+$res_sangria['valor'];
	}
   
  
  echo number_format($valor_sangria,2,',','.'); ?></td>
</tr>
<tr>
  <td colspan="2" align="center"><img src="../img/vendas_crediario.fw.png" width="300" height="32" /></td>
</tr>
<tr>
  <td align="center">Cliente</td>
  <td align="center">Valor</td>
</tr>
<?
$sql_resumo_crediario = mysqli_query($conexao_bd, "SELECT * FROM historico_debitos WHERE dia = '$diar' AND mes = '$mesr' AND ano = '$anor'");
while($res_crediario = mysqli_fetch_array($sql_resumo_crediario)){
?>
<tr>
  <td align="center"><?
   $sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE code = '".$res_crediario['cliente']."'");
  	while($res_cliente = mysqli_fetch_array($sql_cliente)){
		echo $res_cliente['nome'];
	}
  ?></td>
  <td align="center">R$ <? echo number_format($res_crediario['valor'],2,',','.'); ?></td>
</tr>
<? } ?>
<tr>
  <td colspan="2" align="center"><img src="../img/resumo_de_creditos.fw.png" alt="" width="300" height="32" /></td>
</tr>
<?
$soma_valor_crediario = 0;
$crediario_dinheiro = 0;
$sql_credito = mysqli_query($conexao_bd, "SELECT * FROM historico_creditos WHERE operador = '$operador' AND dia = '$diar' AND mes = '$mesr' AND ano = '$anor'");
 while($res_credito = mysqli_fetch_array($sql_credito)){
	 $soma_valor_crediario = $soma_valor_crediario+$res_credito['valor'];
	 if($res_credito['forma_pagamento'] == 'DINHEIRO'){
		 $crediario_dinheiro = $crediario_dinheiro+$res_credito['valor'];
	 }
 }
?>
<tr>
  <td align="center">N&deg; Cr&eacute;ditos</td>
  <td align="center">Valor recebido</td>
</tr>
<tr>
  <td align="center"><? echo mysqli_num_rows($sql_credito); ?></td>
  <td align="center">R$ <? echo number_format($soma_valor_crediario,2,',','.'); ?></td>
</tr>
<tr>
  <td colspan="2" align="center"><img src="http://ikuly.com/DEPOSITOSOUSA/sistema/img/relatorio_final.fw.png" width="300" height="32" /></td>
  </tr>
<tr>
  <td colspan="2" align="center">Valor final informado</td>
  </tr>

<?
$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM fechamento_caixa WHERE operador = '$operador' AND dia = '$diar' AND mes = '$mesr' AND ano = '$anor' AND status = 'Ativo'");
 while($res_caixa = mysqli_fetch_array($sql_verifica)){
?>
<tr>
  <td colspan="2" align="center">R$ <? 
	$valor_final_caixa = ($res_caixa['nota100']*100)+($res_caixa['nota50']*50)+($res_caixa['nota20']*20)+($res_caixa['nota10']*10)+($res_caixa['nota5']*5)+($res_caixa['nota2']*2)+($res_caixa['moeda1'])+($res_caixa['moeda50']*0.5)+($res_caixa['moeda25']*0.25)+($res_caixa['moeda10']*0.1)+($res_caixa['moeda05']*0.05);
	echo number_format($valor_final_caixa,2,',','.'); ?></td>
</tr>
<? } ?>
<tr>
  <td colspan="2" align="center">SALDO FINAL</td>
  </tr> <? $saldo_final = ($valor_final_caixa-($valor_abertura_caixa+$crediario_dinheiro+$dinheiro-$valor_sangria)); ?>
<tr>
  <td colspan="2" align="center"><h1 style="font:12px Arial, Helvetica, sans-serif; margin:0; padding:0; color:#333;"><strong> R$ <? echo number_format($saldo_final,2,',','.'); ?> <? if($saldo_final < 0){ ?><h2 style="font:12px Arial, Helvetica, sans-serif; color:#F00;">(<em>Falta dinheiro no caixa</em>)</h2><? } ?>
  
<? if($saldo_final > 0){ ?><h2 style="font:12px Arial, Helvetica, sans-serif; color:#090;">(<em>Sobra dinheiro no caixa</em>)</h2><? } ?>  
  
  
  
  </h1>
  
  
  
  </strong></td>
  </tr>
<tr>
  <td colspan="2"><span style="font:12px Arial, Helvetica, sans-serif; margin:15px 0 0 0">
    <hr />
    <em>Recibo para simples confer&ecirc;ncial.</em></span></td>
</tr>
</table>
</body>
</html>
