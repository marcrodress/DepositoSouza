<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body {
	background-color: #FFF;
	padding:5px;
	margin:auto;
	font:12px Arial, Helvetica, sans-serif;
}
body table{
	border-radius:5px;
	border:2px solid #999;
	text-align:center;
	}
body table td{
	border-radius:5px;
	font-weight: bold;
	padding:5px;
	}

.sdf {
	font-weight: bold;
}
.s {
	font-weight: bold;
}
.dsf {
	font-weight: bold;
}
.as {
	font-weight: normal;
}
</style>




</head>

<body>
<? require "../../conexao.php"; ?>

<table width="1005" style="border:1px solid #000; border-radius:5px;" border="0">
  <tr>
    <td width="194" rowspan="3" align="center"><img src="../../img/logo.fw.png" width="194" height="120" /></td>
    <td align="center" bgcolor="#CCCCCC"><h1 style="font:25px Arial, Helvetica, sans-serif; padding:0; margin:0;"><strong>DEPOSITO SOUZA</strong></h1></td>
  </tr>
  <tr>
    <td height="21" align="center"><p style="font:15px Arial, Helvetica, sans-serif; padding:0; margin:0;"><strong>Rua Capit&atilde;o In&aacute;cio Prata, S/N - Ta&iacute;ba<br />
      S&atilde;o Gon&ccedil;alo do Amarante - Cear&aacute; - 
      CEP: 62670-000<br />
    (85) 99137.7483/99420.1044/98851.8484</strong></p></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#CCCCCC"><h3 style="font:15px Arial, Helvetica, sans-serif; padding:0; margin:0;">
	<strong><? echo date("d/m/Y H:i:s"); ?></strong>
    <br /><strong>Operador: </strong>Marcos Rodrigues de Oliveira</h3></td>
  </tr>
</table>
<br />

<?


$diar = $_GET['dia'];
$mesr = $_GET['mes'];
$anor = $_GET['ano'];

$operador = $_GET['operador'];
$valor_abertura_caixa = 0;

$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM abertura_caixa WHERE operador = '$operador' AND dia = '$diar' AND mes = '$mesr' AND ano = '$anor'");
 while($res_caixa = mysqli_fetch_array($sql_verifica)){
	
$valor_abertura_caixa = ($res_caixa['nota100']*100)+($res_caixa['nota50']*50)+($res_caixa['nota20']*20)+($res_caixa['nota10']*10)+($res_caixa['nota5']*5)+($res_caixa['nota2']*2)+($res_caixa['moeda1']*1)+($res_caixa['moeda50']*0.5)+($res_caixa['moeda25']*0.25)+($res_caixa['moeda10']*0.1)+($res_caixa['moeda05']*0.05);
	 
?>
<table width="1005" border="0">
  <tr>
    <td colspan="6" bgcolor="#999999"><h1 style="font:20px Arial, Helvetica, sans-serif; padding:0; margin:0;"><strong>Abertura de caixa</strong></h1></td>
  </tr>
  <tr>
    <td colspan="6">Valor inicial dispon&iacute;vel no caixa: R$ <? echo @number_format($valor_abertura_caixa,2,',','.'); ?> </td>
  </tr>
  <tr>
    <td bgcolor="#F3FBFE">Notas de R$ 100,00</td>
    <td bgcolor="#F3FBFE">Nota de R$ 50,00</td>
    <td bgcolor="#F3FBFE">Nota de R$ 20,00</td>
    <td bgcolor="#F3FBFE">Nota de R$ 10,00</td>
    <td bgcolor="#F3FBFE">Nota de R$ 5,00</td>
    <td bgcolor="#F3FBFE">Nota de R$ 2,00</td>
  </tr>
  <tr>
    <td>R$ <? echo number_format(($res_caixa['nota100']*100),2,',','.'); ?></td>
    <td>R$ <? echo number_format($res_caixa['nota50']*50,2,',','.'); ?></td>
    <td>R$ <? echo number_format($res_caixa['nota20']*20,2,',','.'); ?></td>
    <td>R$ <? echo number_format($res_caixa['nota10']*10,2,',','.'); ?></td>
    <td>R$ <? echo number_format($res_caixa['nota5']*5,2,',','.'); ?></td>
    <td>R$ <? echo number_format($res_caixa['nota2']*2,2,',','.'); ?></td>
  </tr>
  <tr>
    <td bgcolor="#F3FBFE">Moedas de R$ 1,00</td>
    <td bgcolor="#F3FBFE">Moedas de R$ 0,50</td>
    <td bgcolor="#F3FBFE">Moeda de R$ 0,25</td>
    <td bgcolor="#F3FBFE">Moedas de R$ 0,10</td>
    <td bgcolor="#F3FBFE">Moedas de R$ 0,05</td>
    <td bgcolor="#F3FBFE">Saldo da Maquina</td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($res_caixa['moeda1']*1,2,',','.'); ?></td>
    <td>R$ <? echo number_format($res_caixa['moeda50']*0.5,2,',','.'); ?></td>
    <td>R$ <? echo number_format($res_caixa['moeda25']*0.25,2,',','.'); ?></td>
    <td>R$ <? echo number_format($res_caixa['moeda10']*0.1,2,',','.'); ?></td>
    <td>R$ <? echo number_format($res_caixa['moeda05']*0.05,2,',','.'); ?></td>
    <td>R$ <? echo number_format($res_caixa['saldo_maquina']*1,2,',','.'); ?></td>
  </tr>
</table> 
<? } ?>
<br />

<?


$dinhero_prod = 0;
$cartao_credito_prod = 0;
$cartao_debito_prod = 0;
$cheque_prod = 0;
$crediario_prod = 0;
$descontos_prod = 0;

$sql_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE operador = '$operador' AND dia = '$dia' AND mes = '$mes' AND ano = '$ano'");
if(mysqli_num_rows($sql_carrinho) == ''){
	echo "<em>Não foi vendido nenhum produto.</em>";
}else{
?>
<table width="1000" border="0">
  <tr>
    <td colspan="6" align="center" bgcolor="#999999"><h1 style="font:20px Arial, Helvetica, sans-serif; padding:0; margin:0;"><strong>Venda de produtos</strong></h1></td>
  </tr>
  <tr>
    <td colspan="6">Total do faturamento: R$ 
    
         <?
		 $faturamento = 0;
		 while($res_carrinho = mysqli_fetch_array($sql_carrinho)){
			 $sql_descricao_prod = mysqli_query($conexao_bd, "SELECT * FROM carrinho_produtos WHERE carrinho = '".$res_carrinho['code_carrinho']."'");
			   while($res_descricao_prod = mysqli_fetch_array($sql_descricao_prod)){
				  $faturamento = $faturamento+$res_descricao_prod['vl_total'];
			  }
		 } echo number_format($faturamento,2,',','.');
		?>    
    
    </td>
  </tr>
  <tr>
    <td colspan="6" bgcolor="#FFFFFF">
     	<? 
		
$sql_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE dia = '$diar' AND mes = '$mesr' AND ano = '$anor' AND operador = '$operador' AND status = 'ENCERRADO'");		
		
		$i = 0; while($res_carrinhos = mysqli_fetch_array($sql_carrinho)){ $i++; ?>    

    <table width="985" border="0">
      <tr>
        <td width="143" bgcolor="#CCCCCC">COD. CLIENTE</td>
        <td width="278" bgcolor="#CCCCCC">NOME DO CLIENTE</td>
        <td width="325" bgcolor="#CCCCCC">QUANT. PRODUTOS</td>
        <td width="220" bgcolor="#CCCCCC">VALOR TOTAL</td>
        </tr>
      <tr>
        <td><h3 style="font:12px Arial, Helvetica, sans-serif; text-transform:uppercase; padding:0; margin:0;"><? echo $res_carrinhos['cliente']; ?></h3></td>
        <td><h3 style="font:12px Arial, Helvetica, sans-serif; text-transform:uppercase; padding:0; margin:0;"><?
          
		  $sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE code = '".$res_carrinhos['cliente']."'");
		  	while($res_cliente = mysqli_fetch_array($sql_cliente)){
				echo $res_cliente['nome'];
			}
		  
		?></h3></td>
        <td><h3 style="font:12px Arial, Helvetica, sans-serif; text-transform:uppercase; padding:0; margin:0;"><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM carrinho_produtos WHERE carrinho = '".$res_carrinhos['code_carrinho']."'")); ?></h3></td>
        <td><h3 style="font:12px Arial, Helvetica, sans-serif; text-transform:uppercase; padding:0; margin:0;">R$ <?
        	$soma_prod = 0;
			$sql_soma_prod = mysqli_query($conexao_bd, "SELECT * FROM carrinho_produtos WHERE carrinho = '".$res_carrinhos['code_carrinho']."'");
			
			  while($res_soma_prod = mysqli_fetch_array($sql_soma_prod)){
				  $soma_prod = $soma_prod+$res_soma_prod['vl_total'];
			 }
			 
			 echo number_format($soma_prod,2,',','.');
			
		?></h3></td>
        </tr>
      <tr>
        <td colspan="4">
        <table width="970" border="0">
      	  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
            <td>ID</td>
            <td>QUANT.</td>
            <td>C&Oacute;DIGO BARRAS</td>
            <td>PRODUTO</td>
            <td>VL. UNIT&Aacute;RIO</td>
            <td>VL. TOTAL</td>
          </tr>
        <?
		 $sql_descricao_prod = mysqli_query($conexao_bd, "SELECT * FROM carrinho_produtos WHERE carrinho = '".$res_carrinhos['code_carrinho']."'");
		   while($res_descricao_prod = mysqli_fetch_array($sql_descricao_prod)){
			$sql_prod = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE code = '".$res_descricao_prod['produto']."'");
			 while($res_prod = mysqli_fetch_array($sql_prod)){
		?>
          <tr>
            <td><h3 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;"><? echo $i; ?></h3></td>
            <td><h3 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;"><? echo $res_descricao_prod['quantidade']; ?></h3></td>
            <td><h3 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;"><? echo $res_descricao_prod['produto']; ?></h3></td>
            <td><h3 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;"><? echo $res_prod['titulo']; ?></h3></td>
            <td><h3 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;">R$ <? echo number_format($res_descricao_prod['vl_unitario'],2,',','.'); ?></h3></td>
            <td><h3 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;">R$ <? echo number_format($res_descricao_prod['vl_total'],2,',','.'); ?></h3></td>
          </tr>
          <? }} ?>
          <tr>
            <td colspan="4">&nbsp;</td>
            <td bgcolor="#CCCCCC" class="sdf">FORMA DE PAGAMENTO</td>
            <td bgcolor="#CCCCCC" class="dsf">VALOR</td>
          </tr>
         <?
		$sql_pag_prod = mysqli_query($conexao_bd, "SELECT * FROM carrinho_pagamentos WHERE code_carrinho = '".$res_carrinhos['code_carrinho']."'");
		  while($res_pag_prod = mysqli_fetch_array($sql_pag_prod)){
			  	  
		 ?>
          <tr>
            <td colspan="4">&nbsp;</td>
            <td><h3 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;"><? if($res_pag_prod['forma_pagamento'] == 'CHEQUE'){ echo "PIX/TRANSFERÊNCIA";}else{echo $res_pag_prod['forma_pagamento']; }?></h3></td>
            <td><h3 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;">R$ <? echo number_format($res_pag_prod['valor'],2,',','.'); ?></h3></td>
          </tr>
          <? } ?>
        </table>  

        </td>
        </tr>
    </table>  <br />
        <? } ?>
   </td>
  </tr>
  <tr>
    <td bgcolor="#3399CC">DINHEIRO</td>
    <td bgcolor="#3399CC">CART&Atilde;O DE CR&Eacute;DITO</td>
    <td bgcolor="#3399CC">CART&Atilde;O DE D&Eacute;BITO</td>
    <td bgcolor="#3399CC">PIX/TRANSFERÊNCIA</td>
    <td bgcolor="#3399CC">CREDI&Aacute;RIO</td>
    <td bgcolor="#3399CC">DESCONTOS</td>
  </tr>
         <?
		$sql_pag_prod = mysqli_query($conexao_bd, "SELECT * FROM carrinho_pagamentos WHERE operador = '$operador' AND dia = '$diar' AND mes = '$mesr' AND $anor");
		  while($res_pag_prod = mysqli_fetch_array($sql_pag_prod)){
			  
			  if($res_pag_prod['forma_pagamento'] == 'DINHEIRO'){
				  $dinhero_prod = $dinhero_prod+$res_pag_prod['valor'];
			  }elseif($res_pag_prod['forma_pagamento'] == 'CARTAO DE CREDITO'){
				  $cartao_credito_prod = $cartao_credito_prod+$res_pag_prod['valor'];
			  }elseif($res_pag_prod['forma_pagamento'] == 'CARTAO DE DEBITO'){
				  $cartao_debito_prod = $cartao_debito_prod+$res_pag_prod['valor'];
			  }elseif($res_pag_prod['forma_pagamento'] == 'CHEQUE'){
				  $cheque_prod = $cheque_prod+$res_pag_prod['valor'];
			  }elseif($res_pag_prod['forma_pagamento'] == 'DESCONTO'){
				  $descontos_prod = $descontos_prod+$res_pag_prod['valor'];
			  }elseif($res_pag_prod['forma_pagamento'] == 'CREDIARIO'){
				  $crediario_prod = $crediario_prod+$res_pag_prod['valor'];			  
			  }
		  }
		 ?>
  <tr>
    <td><h3 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;">R$ <? echo number_format($dinhero_prod,2,',','.'); ?></h3></td>
    <td><h3 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;">R$ <? echo number_format($cartao_credito_prod,2,',','.'); ?></h3></td>
    <td><h3 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;">R$ <? echo number_format($cartao_debito_prod,2,',','.'); ?></h3></td>
    <td><h3 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;">R$ <? echo number_format($cheque_prod,2,',','.'); ?></h3></td>
    <td><h3 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;">R$ <? echo number_format($crediario_prod,2,',','.'); ?></h3></td>
    <td><h3 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;">R$ <? echo number_format($descontos_prod,2,',','.'); ?></h3></td>
  </tr>
</table>
<p>
  <? } ?>
  
</p>
<p>
  <?

$sql_creditos = mysqli_query($conexao_bd, "SELECT * FROM historico_creditos WHERE dia = '$diar' AND mes = '$mesr' AND ano = '$anor' AND operador = '$operador'");
if(mysqli_num_rows($sql_creditos) == ''){
	echo "<em>Não foram realizados pagamentos na data de hoje</em>";
}else{
?>
</p>
<table width="1005" border="0">
  <tr>
    <td colspan="6" align="center" bgcolor="#999999"><h1 style="font:20px Arial, Helvetica, sans-serif; padding:0; margin:0;"><strong>Recebimento do d&iacute;vidas - credi&aacute;rio</strong></h1></td>
  </tr>
  <tr>
    <td colspan="6">Total recebido: R$ <?
     	$soma_creditos = 0;
		while($res_creditos = mysqli_fetch_array($sql_creditos)){
			$soma_creditos = $soma_creditos+$res_creditos['valor'];
		}
		
		echo number_format($soma_creditos,2,',','.');
	
	?></td>
  </tr>
  <tr>
    <td colspan="6" bgcolor="#FFFFFF"><table width="980" border="0">
      <tr>
        <td width="43" bgcolor="#996600">&nbsp;</td>
        <td width="126" bgcolor="#996600">COD.</td>
        <td width="129" bgcolor="#996600">CPF</td>
        <td width="324" bgcolor="#996600">NOME</td>
        <td width="115" bgcolor="#996600">VALOR</td>
        <td width="203" bgcolor="#996600">FORMA DE PAGAMENTO</td>
      </tr>
      <? $i=0;
	  $dinhero_cred = 0;
	  $cartao_credito_cred = 0;
	  $cartao_debito_cred = 0;
	  $cheque_cred = 0;
	  
	  $sql_creditos = mysqli_query($conexao_bd, "SELECT * FROM historico_creditos WHERE dia = '$diar' AND mes = '$mesr' AND ano = '$anor' AND operador = '$operador'");
	  
	   while($res_creditos = mysqli_fetch_array($sql_creditos)){ $i++;
	    
		if($res_creditos['forma_pagamento'] == 'DINHEIRO'){
			$dinhero_cred = $dinhero_cred+$res_creditos['valor'];
		}elseif($res_creditos['forma_pagamento'] == 'CARTAO DE CREDITO'){
			$cartao_credito_cred = $cartao_credito_cred+$res_creditos['valor'];
		}elseif($res_creditos['forma_pagamento'] == 'CARTAO DE DEBITO'){
			$cartao_debito_cred = $cartao_debito_cred+$res_creditos['valor'];
		}elseif($res_creditos['forma_pagamento'] == 'CHEQUE'){
			$cheque_cred = $cheque_cred+$res_creditos['valor'];
		}
	   
	   $sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE code = '".$res_creditos['cliente']."'");
	  	while($res_cliente = mysqli_fetch_array($sql_cliente)){
	  ?>
      <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td><h3 style="font:12px Arial, Helvetica, sans-serif; text-transform:uppercase; padding:0; margin:0;"><? echo $i; ?></h3></td>
        <td><h3 style="font:12px Arial, Helvetica, sans-serif; text-transform:uppercase; padding:0; margin:0;"><? echo $res_creditos['cliente']; ?></h3></td>
        <td><h3 style="font:12px Arial, Helvetica, sans-serif; text-transform:uppercase; padding:0; margin:0;"><? echo $res_cliente['cpf']; ?></h3></td>
        <td><h3 style="font:12px Arial, Helvetica, sans-serif; text-transform:uppercase; padding:0; margin:0;"><? echo $res_cliente['nome']; ?></h3></td>
        <td><h3 style="font:12px Arial, Helvetica, sans-serif; text-transform:uppercase; padding:0; margin:0;">R$ <? echo number_format($res_creditos['valor'],2,',','.'); ?></h3></td>
        <td><h3 style="font:12px Arial, Helvetica, sans-serif; text-transform:uppercase; padding:0; margin:0;"><? echo $res_creditos['forma_pagamento']; ?></h3></td>
      </tr>
     <? }} ?>
    </table></td>
  </tr>
  <tr>
    <td bgcolor="#3399CC">DINHEIRO</td>
    <td bgcolor="#3399CC">CART&Atilde;O DE CR&Eacute;DITO</td>
    <td bgcolor="#3399CC">CART&Atilde;O DE D&Eacute;BITO</td>
    <td bgcolor="#3399CC">CHEQUE</td>
  </tr>
  <tr>
    <td><h3 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;">R$ <? echo number_format($dinhero_cred,2,',','.'); ?></h3></td>
    <td><h3 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;">R$ <? echo number_format($cartao_credito_cred,2,',','.'); ?></h3></td>
    <td><h3 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;">R$ <? echo number_format($cartao_debito_cred,2,',','.'); ?></h3></td>
    <td><h3 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;">R$ <? echo number_format($cheque_cred,2,',','.'); ?></h3></td>
  </tr>
</table>
<p>
  <? } ?>
</p>
<? 
   $sql_sangria = mysqli_query($conexao_bd, "SELECT * FROM sangria WHERE data = '$diar/$mesr/$anor' AND operador = '$operador'");
   	if(mysqli_num_rows($sql_sangria) == ''){
		echo "<em>Não foram realizados sangrias.</em>";
	}else{
?>
<table width="1000" border="0">
  <tr>
    <td colspan="4" bgcolor="#999999"><span style="font:20px Arial, Helvetica, sans-serif; padding:0; margin:0;; font-family: Arial, Helvetica, sans-serif; font-size: 20px"><strong>Sangrias de caixa</strong></span></td>
  </tr>
  <tr>
    <td width="40" bgcolor="#996600">&nbsp;</td>
    <td width="408" bgcolor="#996600">DATA</td>
    <td width="335" bgcolor="#996600">FORMA</td>
    <td width="195" bgcolor="#996600">VALOR</td>
  </tr>
  <? $i=0; $valor_sangria = 0; while($res_sangria = mysqli_fetch_array($sql_sangria)){ $i++; $valor_sangria = $valor_sangria+$res_sangria['valor'];?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; } ?>>
    <td><? echo $i; ?></td>
    <td><? echo $res_sangria['data_completa']; ?></td>
    <td><? echo $res_sangria['forma']; ?></td>
    <td>R$ <? echo number_format($res_sangria['valor'],2,',','.'); ?></td>
  </tr>
  <? } ?>
</table>
<? } ?>


<p><br />
  
  <?
$valor_final_caixa = 0;
@$somatorio_dinheiro = $valor_abertura_caixa+$dinhero_prod+$dinhero_cred-$valor_sangria;

$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM fechamento_caixa WHERE operador = '$operador' AND dia = '$diar' AND mes = '$mesr' AND ano = '$anor'");
 while($res_caixa = mysqli_fetch_array($sql_verifica)){
	 
$valor_final_caixa = ($res_caixa['nota100']*100)+($res_caixa['nota50']*50)+($res_caixa['nota20']*20)+($res_caixa['nota10']*10)+($res_caixa['nota5']*5)+($res_caixa['nota2']*2)+($res_caixa['moeda1'])+($res_caixa['moeda50']*0.5)+($res_caixa['moeda25']*0.25)+($res_caixa['moeda10']*0.1)+($res_caixa['moeda05']*0.05);
	 
?>
</p>
<table width="1005" border="0">
  <tr>
    <td colspan="6" bgcolor="#999999"><h1 style="font:25px Arial, Helvetica, sans-serif; padding:0; margin:0;"><strong>Fechamento do caixa</strong></h1></td>
  </tr>
  <tr>
    <td bgcolor="#F3FBFE">Notas de R$ 100,00</td>
    <td bgcolor="#F3FBFE">Nota de R$ 50,00</td>
    <td bgcolor="#F3FBFE">Nota de R$ 20,00</td>
    <td bgcolor="#F3FBFE">Nota de R$ 10,00</td>
    <td bgcolor="#F3FBFE">Nota de R$ 5,00</td>
    <td bgcolor="#F3FBFE">Nota de R$ 2,00</td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($res_caixa['nota100']*100,2,',','.'); ?></td>
    <td>R$ <? echo number_format($res_caixa['nota50']*50,2,',','.'); ?></td>
    <td>R$ <? echo number_format($res_caixa['nota20']*20,2,',','.'); ?></td>
    <td>R$ <? echo number_format($res_caixa['nota10']*10,2,',','.'); ?></td>
    <td>R$ <? echo number_format($res_caixa['nota5']*5,2,',','.'); ?></td>
    <td>R$ <? echo number_format($res_caixa['nota2']*2,2,',','.'); ?></td>
  </tr>
  <tr>
    <td bgcolor="#F3FBFE">Moedas de R$ 1,00</td>
    <td bgcolor="#F3FBFE">Moedas de R$ 0,50</td>
    <td bgcolor="#F3FBFE">Moeda de R$ 0,25</td>
    <td bgcolor="#F3FBFE">Moedas de R$ 0,10</td>
    <td bgcolor="#F3FBFE">Moedas de R$ 0,05</td>
    <td bgcolor="#F3FBFE">Saldo da Maquina</td>
  </tr>
  <tr>
    <td>R$ <? echo number_format($res_caixa['moeda1'],2,',','.'); ?></td>
    <td>R$ <? echo number_format($res_caixa['moeda50']*0.5,2,',','.'); ?></td>
    <td>R$ <? echo number_format($res_caixa['moeda25']*0.25,2,',','.'); ?></td>
    <td>R$ <? echo number_format($res_caixa['moeda10']*0.1,2,',','.'); ?></td>
    <td>R$ <? echo number_format($res_caixa['moeda05']*0.05,2,',','.'); ?></td>
    <td>R$ <? echo number_format($res_caixa['saldo_maquina'],2,',','.'); ?></td>
  </tr>
  <tr>
    <td colspan="6">Valor final dispon&iacute;vel no caixa: R$ <? echo number_format($valor_final_caixa,2,',','.'); ?></td>
  </tr>
  <tr>
    <td colspan="6"><h1 style="font:18px Arial, Helvetica, sans-serif; margin:0; padding:0; color:#333;"><strong>Saldo:</strong> R$ <? echo @number_format($valor_final_caixa-$somatorio_dinheiro,2,',','.'); ?> <? if($valor_final_caixa-$somatorio_dinheiro < 0){ ?><h2 style="font:12px Arial, Helvetica, sans-serif; color:#F00;">(<em>Falta dinheiro no caixa</em>)</h2><? } ?></h1></td>
  </tr>

</table>
<? } ?>

</body>
</html>