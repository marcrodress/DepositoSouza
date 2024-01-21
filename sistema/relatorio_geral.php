<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/relatorio_geral.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? if(@$_GET['dia'] == '' && @$_GET['mes'] == '' && @$_GET['ano'] == ''){ 

echo "<script language='javascript'>window.location='?pack=50&dia=$dia&mes=$mes&ano=$ano';</script>";

}?>

<div id="box_central">
 <h1 style="font:20px Arial, Helvetica, sans-serif; margin:5px;"><strong>Relatório geral</strong></h1>
 <hr />

 <div id="box_resumo">

  <div id="investimento">
   <img src="img/investimento.fw.png" width="180" height="39" />
	<?
	 $investimento = 0;
	 $sql_investimento = mysqli_query($conexao_bd, "SELECT * FROM produtos");
	 	while($res_investimento = mysqli_fetch_array($sql_investimento)){
			$investimento = $investimento+($res_investimento['valor_compra']*$res_investimento['estoque']);
		}
	?>
   <h1 style="font:25px Arial, Helvetica, sans-serif; color:#F00;">R$ <? echo number_format($investimento,2,',','.'); ?></h1>
  </div><!-- investimento -->
 
  <div id="resumo_geral">
   <img src="img/faturamento_previsto.fw.png" width="180" height="39" />
	<?
	 $faturamento_previsto = 0;
	 $sql_faturamento_previsto = mysqli_query($conexao_bd, "SELECT * FROM produtos");
	 	while($res_faturamento_previsto = mysqli_fetch_array($sql_faturamento_previsto)){
			$faturamento_previsto = $faturamento_previsto+($res_faturamento_previsto['valor_venda']*$res_faturamento_previsto['estoque']);
		}
	?>   
   <h1 style="font:25px Arial, Helvetica, sans-serif; color:#F00;">R$ <? echo number_format($faturamento_previsto,2,',','.'); ?></h1>
  </div><!-- resumo_geral -->
  
  <div id="faturamento_confirmado">
   <img src="img/faturamento_confirmado.fw.png" width="180" height="39" />
	<?
	 $faturamento_confirmado = 0;
	 $sql_faturamento_confirmado = mysqli_query($conexao_bd, "SELECT * FROM carrinho_produtos");
	 	while($res_faturamento_confirmado = mysqli_fetch_array($sql_faturamento_confirmado)){
			$faturamento_confirmado = $faturamento_confirmado+($res_faturamento_confirmado['vl_total']);
		}
	?> 
   <h1 style="font:25px Arial, Helvetica, sans-serif; color:#F00;">R$ <? echo number_format($faturamento_confirmado,2,',','.'); ?></h1>
  </div><!-- faturamento_confirmado -->
 
  <div id="perdas">
   <img src="img/perdas.fw.png" width="180" height="39" />
	<?
	 $perdas = 0;
	 $sql_perdas = mysqli_query($conexao_bd, "SELECT * FROM perdas");
	 	while($res_perdas = mysqli_fetch_array($sql_perdas)){
			$perdas = $perdas+($res_perdas['valor']);
		}
	?>    
   <h1 style="font:25px Arial, Helvetica, sans-serif; color:#F00;">R$ <? echo number_format($perdas,2,',','.'); ?></h1>
  </div><!-- perdas --> 
 
  <div id="lucro_liquido_previsto">
   <img src="img/lucro_liquido_previsto.fw.png" width="180" height="39" />
   <h1 style="font:25px Arial, Helvetica, sans-serif; color:#F00;">R$ <? echo number_format($faturamento_previsto-$investimento-$perdas,2,',','.'); ?></h1>
  </div><!-- lucro_liquido_previsto -->
 
  <div id="recebimento_dinheiro">
   <img src="img/recebimento_dinheiro.fw.png" width="180" height="39" />
   <?
    
	$dinheiro = 0;
	$cartao_credito = 0;
	$cartao_debito = 0;
	$cheque = 0;
	$crediario = 0;
	
	$sql_faturamento = mysqli_query($conexao_bd, "SELECT * FROM carrinho_pagamentos");
	 while($res_faturamento = mysqli_fetch_array($sql_faturamento)){
		 
		 if($res_faturamento['forma_pagamento'] == 'DINHEIRO'){
			 $dinheiro = $dinheiro+$res_faturamento['valor'];
		 }elseif($res_faturamento['forma_pagamento'] == 'CARTAO DE CREDITO'){
			 $cartao_credito = $cartao_credito+$res_faturamento['valor'];
		 }elseif($res_faturamento['forma_pagamento'] == 'CARTAO DE DEBITO'){
			 $cartao_debito = $cartao_debito+$res_faturamento['valor'];
		 }elseif($res_faturamento['forma_pagamento'] == 'CHEQUE'){
			 $cheque = $cheque+$res_faturamento['valor'];
		 }elseif($res_faturamento['forma_pagamento'] == 'CREDIARIO'){
			 $crediario = $crediario+$res_faturamento['valor'];
			 
		 }
	 }
	
   ?>
   <h1 style="font:25px Arial, Helvetica, sans-serif; color:#F00;">R$ <? echo number_format($dinheiro,2,',','.'); ?></h1>
  </div><!-- recebimento_dinheiro -->
 
  <div id="recebimento_cartao_credito">
   <img src="img/recebimento_cartao_credito.fw.png" width="180" height="39" />
   <h1 style="font:25px Arial, Helvetica, sans-serif; color:#F00;">R$ <? echo number_format($cartao_credito,2,',','.'); ?></h1>
  </div><!-- recebimento_cartao_credito -->
 
  <div id="recebimento_cartao_debito">
   <img src="img/recebimento_cartao_debito.fw.png" width="180" height="39" />
   <h1 style="font:25px Arial, Helvetica, sans-serif; color:#F00;">R$ <? echo number_format($cartao_debito,2,',','.'); ?></h1>
  </div><!-- recebimento_cartao_debito -->
 
  <div id="recebimento_cheque">
   <img src="img/recebimento_cheque.fw.png" width="180" height="39" />
   <h1 style="font:25px Arial, Helvetica, sans-serif; color:#F00;">R$ <? echo number_format($cheque,2,',','.'); ?></h1>
  </div><!-- recebimento_cheque -->
 
  <div id="recebimento_crediario">
   <img src="img/recebimento_crediario.fw.png" width="180" height="39" />
   <h1 style="font:25px Arial, Helvetica, sans-serif; color:#F00;">R$ <? echo number_format($crediario,2,',','.'); ?></h1>
  </div><!-- recebimento_crediario -->
   
 </div><!-- box_resumo --> 
 

 <div id="box_resumo_detalhes">
 <hr />
 <table width="1000" border="0">
  <tr>
    <td style="border:1px solid #FFF;" width="200">&nbsp;</td>
    <td width="165" bgcolor="#0099FF">Investimento</td>
    <td width="165" bgcolor="#0099FF">Faturamento previsto</td>
    <td width="169" bgcolor="#0099FF">Faturamento confirmado</td>
    <td width="118" bgcolor="#0099FF">Perdas</td>
    <td width="157" bgcolor="#0099FF">Lucro confirmado</td>
  </tr>
<?
$sql_categorias = mysqli_query($conexao_bd, "SELECT * FROM categorias");
$i=0;
while($res_categorias = mysqli_fetch_array($sql_categorias)){ $i++;

$investimento = 0;
$faturamento_previsto = 0;
$faturamento_confirmado = 0;
$lucro_liquido_confirmado = 0;
$perdas = 0;

$sql_produtos = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE categoria = '".$res_categorias['code']."'");
  while($res_produtos = mysqli_fetch_array($sql_produtos)){
	$investimento = $investimento+($res_produtos['valor_compra']*$res_produtos['estoque']);
	$faturamento_previsto = $faturamento_previsto+($res_produtos['valor_venda']*$res_produtos['estoque']);
  }
?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td><? echo $res_categorias['categoria']; ?></td>
    <td>R$ <? echo number_format($investimento,2,',','.'); ?></td>
    <td>R$ <? echo number_format($faturamento_previsto,2,',','.');  ?></td>
    <td><?
     
	 $sql_pag = mysqli_query($conexao_bd, "SELECT * FROM carrinho_produtos");
	  while($res_pag = mysqli_fetch_array($sql_pag)){
		  $sql_produtos = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE categoria = '".$res_categorias['code']."'");
	  }
	 
	?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
<? } ?>
 </table>
 <br />
 </div><!-- box_resumo_detalhes -->  
 
</div><!-- box_central -->
</body>
</html>
