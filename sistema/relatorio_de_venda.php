<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/relatorio_de_venda.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#box_resumo table {
	font-weight: bold;
}
</style>
</head>

<body>
<div id="box_venda">
 <h1 style="font:18px Arial, Helvetica, sans-serif; margin:5px;"><strong>Relatório de venda</strong></h1>
 <hr />
 <div id="filtro">
  <form name="" method="post" action="" enctype="multipart/form-data">
   <select name="dia" size="1">
     <option value="">Selecione o dia</option>
     <option value="<? echo $dia; ?>"><? echo $dia; ?></option>
	  <? for($i=1; $i<=31; $i++){ ?>
        <? if($i != $dia){ ?>
	    <option value="<? if($i <10) {echo "0$i"; }else{ echo $i; } ?>"><? if($i <10) {echo "0$i"; }else{ echo $i; } ?></option>
        <? } ?>
      <? } ?>
   </select>
   <select name="mes" size="1">
     <option value="<? echo $mes; ?>"><? echo $mes; ?></option>
     <option value="">Selecione o mês</option>
	  <? for($i=1; $i<=12; $i++){ ?>
        <? if($i != $mes){ ?>
	    <option value="<? if($i <10) {echo "0$i"; }else{ echo $i; } ?>"><? if($i <10) {echo "0$i"; }else{ echo $i; } ?></option>
        <? } ?>
      <? } ?>
   </select>
   <select name="ano" size="1">
     <option value="<? echo $ano; ?>"><? echo $ano; ?></option>
     <option value="<? echo $ano-1; ?>"><? echo $ano-1; ?></option>
     <option value="<? echo $ano-2; ?>"><? echo $ano-2; ?></option>
     <option value="<? echo $ano-3; ?>"><? echo $ano-3; ?></option>
     <option value="<? echo $ano-4; ?>"><? echo $ano-4; ?></option>
   </select>
  <input type="submit" name="filtro" value="Filtrar" />
  </form>
  <? if(isset($_POST['filtro'])){
	 
  $dia = $_POST['dia'];
  $mes = $_POST['mes'];
  $ano = $_POST['ano'];
  
  if($ano == ''){
	  echo "<script language='javascript'>window.alert('É obrigatório informar o ano!');</script>";
  }else{
	  echo "<script language='javascript'>window.location='?pack=51&ano_filtro=$ano&mes_filtro=$mes&dia_filtro=$dia';</script>";
  }
  
  }?>
 </div><!-- filtro -->
<hr />
<br /> 

 <div id="box_resumo">
  <div id="resumo_geral">

  <div id="recebimento_dinheiro">
   <img src="img/recebimento_dinheiro.fw.png" width="180" height="39" />
   <?
    
	
	$dia_filtro = @$_GET['dia_filtro'];
	$mes_filtro = @$_GET['mes_filtro'];
	$ano_filtro = @$_GET['ano_filtro'];
	
	$filtro_venda = 0;
	if($ano_filtro != '' && $mes_filtro != '' && $dia_filtro != ''){
		$filtro_venda = "WHERE dia = '$dia_filtro' AND mes = '$mes_filtro' AND ano = '$ano_filtro' AND status = 'ENCERRADO'";
		$carrinho_pagamentos = "WHERE dia = '$dia_filtro' AND mes = '$mes_filtro' AND ano = '$ano_filtro' AND status = 'ENCERRADO'";
	}elseif($ano_filtro != '' && $mes_filtro != '' && $dia_filtro == ''){
		$filtro_venda = "WHERE mes = '$mes_filtro' AND ano = '$ano_filtro' AND status = 'ENCERRADO'";
	}else{
		$filtro_venda = "WHERE ano = '$ano' AND status = 'ENCERRADO' ORDER BY id DESC LIMIT 50";
	}

	
	
	$dinheiro = 0;
	$cartao_credito = 0;
	$cartao_debito = 0;
	$cheque = 0;
	$crediario = 0;
	
	$sql_faturamento = mysqli_query($conexao_bd, "SELECT * FROM carrinho_pagamentos $filtro_venda");
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

<?

$sql_vendas = mysqli_query($conexao_bd, "SELECT * FROM carrinho $filtro_venda");
if(mysqli_num_rows($sql_vendas) == ''){
	echo "Não foram encontrados registros para a data selecionada!";
}else{
?>
<table width="1000" border="0">
  <tr>
    <td width="102" bgcolor="#99CC33">DATA</td>
    <td width="102" bgcolor="#99CC33">COD.</td>
    <td width="117" bgcolor="#99CC33">OPERADOR</td>
    <td width="331" bgcolor="#99CC33">CLIENTE</td>
    <td width="157" bgcolor="#99CC33">QUANT. PRODUTOS</td>
    <td width="118" bgcolor="#99CC33">VALOR TOTAL</td>
    <td width="43" bgcolor="#99CC33">&nbsp;</td>
  </tr>
  <? $i=0; while($res_vendas = mysqli_fetch_array($sql_vendas)){ $i++; ?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td><h3 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;"><? echo $res_vendas['dia']; ?>/<? echo $res_vendas['mes']; ?>/<? echo $res_vendas['ano']; ?></h3></td>
    <td><h3 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;"><? echo $res_vendas['code_carrinho']; ?></h3></td>
    <td><h3 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;"><? echo $res_vendas['operador']; ?></h3></td>
    <td><h3 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;"><? 
		if($res_vendas['cliente'] == ''){
			echo "<em>CLIENTE NÃO INFORMADO</em>";
		}else{
		$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE code = '".$res_vendas['cliente']."'");
		 while($res_cliente = mysqli_fetch_array($sql_cliente)){
			 echo $res_cliente['nome'];
		 }
		}
	 ?></h3></td>
    <td><h3 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;"><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM carrinho_produtos WHERE carrinho = '".$res_vendas['code_carrinho']."'")); ?></h3></td>
    <td><h3 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;">R$
     
     <?
      $valor_total = 0;
	  $sql_valor = mysqli_query($conexao_bd, "SELECT * FROM carrinho_produtos WHERE carrinho = '".$res_vendas['code_carrinho']."'"); 
	   while($res_valor = mysqli_fetch_array($sql_valor)){
		   $valor_total = $valor_total+$res_valor['vl_total'];
	   }
	   
	   echo number_format($valor_total,2,',','.');
	 ?>
     
    </h3></td>
    <td>
    
    <script language="javascript">
		function finaliza(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=340,height=400');
		}
	</script>    
    
    <a onclick="finaliza('scripts/encerra_compra.php?operador=<? 
		
		$sql_operador = mysqli_query($conexao_bd, "SELECT * FROM adm WHERE cpf = '".$res_vendas['operador']."'");
		 while($res_operador = mysqli_fetch_array($sql_operador)){
			 echo $res_operador['nome'];
		 }		
		
	 ?>&carrinho=<? echo $res_vendas['code_carrinho']; ?>&nao=nao&cliente=<? echo $res_vendas['cliente']; ?>&data_completa=<? echo $res_vendas['data_completa']; ?>');" href=""><img src="img/recibo_compra.png" title="Imprimir encerramento de caixa" width="25" height="25" border="0" /></a></td>
  </tr>
  <? } ?>
</table>
<? } ?>


</div><!-- box_venda -->
</body>
</html>