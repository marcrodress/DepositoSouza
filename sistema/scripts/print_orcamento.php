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
}
</style>
<? require "../../conexao.php"; $cliente = $_GET['cliente']; ?>
<script language="javascript">window.print();</script>

</head>

<body>
<table width="304" style="border:2px solid #000;" border="0">
  <tr>
    <td colspan="6" align="center"><h1 style="font:20px Arial, Helvetica, sans-serif; margin:0; padding:0;"><strong>OR&Ccedil;AMENTO SIMPLES</strong></h1>
      <p><img src="../../img/logo.png" width="227" height="116" /></p>
      <h1 style="font:30px Arial, Helvetica, sans-serif; margin:0;"><strong>Deposito Souza</strong></h1>
      <p style="font:15px Arial, Helvetica, sans-serif; margin:0;"><strong>CNPJ: 07.107.782/0001-01</strong></p>
      <p style="font:15px Arial, Helvetica, sans-serif; margin:0;"><strong>Rua Capit&atilde;o In&aacute;cio Prata, S/N - Ta&iacute;ba<br>
        S&atilde;o Gon&ccedil;alo do Amarante - Cear&aacute;<br>
      CEP: 62670-000</strong></p>
      <p style="font:15px Arial, Helvetica, sans-serif; margin:0;"><strong>(85) 99137.7483/99420.1044/98851.8484</strong></p>
      <p style="font:18px Arial, Helvetica, sans-serif; margin:0;"><strong>Data da compra:<br /><? echo $_GET['data_completa']; ?></strong></p>
    <p style="font:15px Arial, Helvetica, sans-serif; margin:0;"><strong>Vendedor: <br /><? echo $_GET['operador']; ?><br><hr />    </td></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><strong>Orçamento: <? echo $carrinho = $_GET['carrinho']; ?></strong><hr />
    <strong>CLIENTE</strong> <? if($_GET['cliente'] == NULL){ echo "NÃO INFORMADO"; } ?><br />
     <?
      $sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE code = '".$_GET['cliente']."'");
	  	while($res_cliente = mysqli_fetch_array($sql_cliente)){
			echo strtoupper($res_cliente['nome']);
		}
	 ?>
    </td>
  </tr>
  <tr>
    <td colspan="3" align="center"><img src="../img/descricao_produtos.fw.png" width="300" height="32" /></td>
  </tr>
  <? 
  $soma_produtos = 0;
  $soma_valor = 0;
  $desconto = 0;
  
  $quantidade_antiga = 0;
  $nova_quantidade = 0;
  
   $sql_produtos = mysqli_query($conexao_bd, "SELECT * FROM carrinho_produtos WHERE carrinho = '$carrinho'");
    while($res_produtos = mysqli_fetch_array($sql_produtos)){

		$quantidade_antiga = $res_produtos['quantidade'];

   $sql_prod = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE code = '".$res_produtos['produto']."'");
    while($res_prod = mysqli_fetch_array($sql_prod)){
		$soma_produtos = $soma_produtos+$res_produtos['quantidade'];
		$soma_valor = $soma_valor+$res_produtos['vl_total'];
		$desconto = $desconto+$res_produtos['desconto'];
  	
	$nova_quantidade = $res_prod['estoque']-$quantidade_antiga;
  	
	$sql_update = mysqli_query($conexao_bd, "UPDATE produtos SET estoque = '$nova_quantidade' WHERE code = '".$res_produtos['produto']."'");
	
  
  ?>
  <tr>
    <td colspan="3"><h1 style="font:15px Arial, Helvetica, sans-serif; margin:0; padding:0;"><strong><? echo $res_prod['titulo']; ?></strong><br /><strong style="font:10px Arial, Helvetica, sans-serif;">Valor unitário: R$ <? echo @number_format($res_produtos['vl_unitario'],2,',','.'); ?></strong></h1></td>
  </tr>
  <tr>
    <td width="97" align="center" bgcolor="#999999"><strong>Quantidade</strong></td>
    <td width="97" align="center" bgcolor="#999999"><strong>Desconto</strong></td>
    <td width="97" align="center" bgcolor="#999999"><strong>Valor total</strong></td>
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
  <?
  $soma_pag_carrinho = 0;
   $sql_pag = mysqli_query($conexao_bd, "SELECT * FROM carrinho_pagamentos WHERE code_carrinho = '$carrinho'");
   	while($res_pag = mysqli_fetch_array($sql_pag)){ $soma_pag_carrinho = $soma_pag_carrinho+$res_pag['valor'];
		
		if($res_pag['forma_pagamento'] == 'DESCONTO'){
			$desconto = $desconto+$res_pag['valor'];
		}
		
  ?>
  <? } ?>
  <tr>
    <td colspan="3"><img src="../img/resumo_final.fw.png" /></td>
  </tr>
  <tr>
    <td><img src="../img/quant_produto.fw.png" width="97" height="32" /></td>
    <td><img src="../img/descontos.fw.png" alt="" width="97" height="32" /></td>
    <td><img src="../img/valor_a_pagar.fw.png" width="97" height="32" /></td>
  </tr>
  <tr>
    <td><? echo $soma_produtos; ?></td>
    <td>R$ <? echo number_format($desconto,2,',','.'); ?></td>
    <td>R$ <? echo number_format($soma_valor,2,',','.'); ?></td>
  </tr>
  <tr>
    <td colspan="3"><hr />      
      <span style="font-family: Arial, Helvetica, sans-serif; text-decoration:none; text-shadow:none; font-size: 12px"><em>Este or&ccedil;amento &eacute; apenas simples confer&ecirc;ncia, o valor real pode sofrer altera&ccedil;&atilde;o no ato final da compra.</em></span></td>
  </tr>
</table>
</body>
</html>
