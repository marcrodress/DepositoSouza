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
</style>
<script language="javascript">window.print();</script>
<? require "../../conexao.php"; $cliente = $_GET['cliente']; ?>

</head>

<body>
<?

$sql_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE cliente = '".$_GET['cliente']."' AND status = 'ENCERRADO'");
 while($res_carrinho = mysqli_fetch_array($sql_carrinho)){
?>
<table width="304" border="0" style="border:2px solid #000; page-break-before: always;">
  <tr>
    <td colspan="3" align="center"><h1 style="font:20px Arial, Helvetica, sans-serif; margin:0; padding:0;"><strong>COMPROVANTE DE COMPRA</strong></h1><p><img src="../../img/logo.png" width="230" height="116" /></p>
    <h1 style="font:30px Arial, Helvetica, sans-serif; margin:0;"><strong>Deposito Souza</strong></h1>
    <p style="font:15px Arial, Helvetica, sans-serif; margin:0;"><strong>CNPJ: 07.107.782/0001-01</strong></p>
    <p style="font:15px Arial, Helvetica, sans-serif; margin:0;"><strong>Rua Capit&atilde;o In&aacute;cio Prata, S/N - Ta&iacute;ba<br>
    S&atilde;o Gon&ccedil;alo do Amarante - Cear&aacute;<br>
    CEP: 62670-000</strong></p>
    <p style="font:15px Arial, Helvetica, sans-serif; margin:0;"><strong>(85) 99137.7483/99420.1044/98851.8484</strong></p>
    <p style="font:18px Arial, Helvetica, sans-serif; margin:0;"><strong>Data da compra:<br /><? echo $res_carrinho['data_completa']; ?></strong></p>
    <p style="font:15px Arial, Helvetica, sans-serif; margin:0;"><strong>Vendedor: <br /><? 
	 
	 $sql_verica_operador = mysqli_query($conexao_bd, "SELECT * FROM adm WHERE cpf = '".$res_carrinho['operador']."'");
	 	while($res_operador = mysqli_fetch_array($sql_verica_operador)){
			echo $res_operador['nome'];
		}
	
	 ?><br><hr />
  
    </td>
  </tr>
  <tr>
    <td colspan="3" align="center"><strong>Orçamento: <? echo $carrinho = $res_carrinho['code_carrinho']; ?></strong>
      <hr />
CLIENTE
<? if($_GET['cliente'] == NULL){ echo "N&Atilde;O INFORMADO"; } ?>
<br />
<?
      $sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE code = '".$_GET['cliente']."'");
	  	while($res_cliente = mysqli_fetch_array($sql_cliente)){
			echo strtoupper($res_cliente['nome']);
		}
	 ?><hr /></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><img src="../img/descricao_produtos.fw.png" width="300" height="32" /></td>
  </tr>
  <? 
  $soma_produtos = 0;
  $soma_valor = 0;
  $desconto = 0;
   $sql_produtos = mysqli_query($conexao_bd, "SELECT * FROM carrinho_produtos WHERE carrinho = '$carrinho'");
    while($res_produtos = mysqli_fetch_array($sql_produtos)){
   $sql_prod = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE code = '".$res_produtos['produto']."'");
    while($res_prod = mysqli_fetch_array($sql_prod)){
		$soma_produtos = $soma_produtos+$res_produtos['quantidade'];
		$soma_valor = $soma_valor+$res_produtos['vl_total'];
		$desconto = $desconto+$res_produtos['desconto'];
  ?>
  <tr>
    <td colspan="3"><h1 style="font:12px Arial, Helvetica, sans-serif; margin:0; padding:0;"><? echo $res_prod['titulo']; ?></h1></td>
  </tr>
  <tr>
    <td width="97" align="center" bgcolor="#999999"><strong>Quantidade</strong></td>
    <td width="97" align="center" bgcolor="#999999">Desconto</td>
    <td width="97" align="center" bgcolor="#999999"><strong>Valor: </strong></td>
  </tr>
  <tr>
    <td  align="center"><h1 style="font:10px Arial, Helvetica, sans-serif; margin:0; padding:0;"><? echo $res_produtos['quantidade']; ?></h1></td>
    <td align="center"><h1 style="font:10px Arial, Helvetica, sans-serif; margin:0; padding:0;">R$ <? echo @number_format($res_produtos['desconto'],2,',','.'); ?></h1></td>
    <td align="center"><h1 style="font:10px Arial, Helvetica, sans-serif; margin:0; padding:0;">R$ <? echo @number_format($res_produtos['vl_total'],2,',','.'); ?></h1></td>
  </tr>
  <tr>
    <td colspan="3"><hr /></td>
  </tr>
  <? }} ?>
  <tr>
    <td colspan="3"><img src="../img/resumo_pagamento.fw.png" width="300" height="32" /><br /></td>
  </tr>
  <tr>
    <td colspan="2" align="center">RESUMO DE PAGAMENTO</td>
    <td align="center">VALOR</td>
  </tr>
  <?
  $soma_pag_carrinho = 0;
   $sql_pag = mysqli_query($conexao_bd, "SELECT * FROM carrinho_pagamentos WHERE code_carrinho = '$carrinho'");
   	while($res_pag = mysqli_fetch_array($sql_pag)){ $soma_pag_carrinho = $soma_pag_carrinho+$res_pag['valor'];
  ?>
  <tr>
    <td colspan="2" align="center"><h1 style="font:10px Arial, Helvetica, sans-serif; margin:0; padding:0;"><? echo $res_pag['forma_pagamento']; ?></h1></td>
    <td align="center"><h1 style="font:10px Arial, Helvetica, sans-serif; margin:0; padding:0;">R$ <? echo @number_format($res_pag['valor'],2,',','.'); ?></h1></td>
  </tr>
  <? } ?>
  <tr>
    <td colspan="3" align="center"><hr />
    TROCO: R$ <? echo number_format($soma_pag_carrinho-$soma_valor,2,',','.'); ?></td>
  </tr>
  <tr>
    <td colspan="3"><img src="../img/resumo_final.fw.png" /></td>
  </tr>
  <tr>
    <td><img src="../img/quant_produto.fw.png" width="97" height="32" /></td>
    <td><img src="../img/descontos.fw.png" alt="" width="97" height="32" /></td>
    <td><img src="../img/valor_pago.fw.png" width="97" height="32" /></td>
  </tr>
  <tr>
    <td><? echo $soma_produtos; ?></td>
    <td>R$ <? echo number_format($desconto,2,',','.'); ?></td>
    <td>R$ <? echo number_format($soma_valor,2,',','.'); ?></td>
  </tr>
  <tr>
    <td colspan="3"><span style="font:12px Arial, Helvetica, sans-serif; margin:15px 0 0 0"><hr /><em>Recibo de compra sem valor fiscal.</em></span></td>
  </tr>
</table>
<br /><br />
<? } ?>
</body>
</html>
