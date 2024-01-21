<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/carrinho.css" rel="stylesheet" type="text/css" />
</head>

<body>
<? if($cliente >= 1){ ?>
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

 - <strong>Último pagamento:</strong> <?
 $sql_credito = mysqli_query($conexao_bd, "SELECT * FROM historico_creditos WHERE cliente = '$cliente' ORDER BY id DESC LIMIT 1");
  if(mysqli_num_rows($sql_credito) <=0){
			echo "<em>Ainda não fez pagamento</em>";
  }else{
 	while($res_credito = mysqli_fetch_array($sql_credito)){
			echo $res_credito['data'];
	}
  }
 ?></h1>
</div><!-- box_busca_prod_cliente-->
<? } ?>



<div id="box_busca_prod">
 <form name="" method="post" action="" enctype="multipart/form-data">
  <input style="width:833px; padding:11px; text-align:center; border:1px solid #CCC;" type="text" name="code" />
  <input style="width:50px; padding:11px; text-align:center; border:1px solid #CCC;" type="number" value="1" name="quant" />
  <input style="width:60px; padding:11px; text-align:center; border:1px solid #CCC;" type="submit" name="buscaprod" value="Buscar" />
 </form>
 
 <? if(isset($_POST['buscaprod'])){ require "busca_produto.php"; }?>
 
</div><!-- box_busca_prod -->

<div id="box_central">
 
 <div id="box_pagamentos">
  <? if(@$_GET['pg'] == ''){ ?>
  <div id="box_pagamentos_opcoes">
  <? if(isset($_POST['valor_total'])){
	  
	  $forma = $_POST['forma'];
	  $valor_total = base64_encode($_POST['valor_total']);
	  $valor_faltante = $_POST['valor_faltante'];
	  
		$verifica_ponto = 0;
		for($i=0; $i<strlen($_POST['valor_total']); $i++){
			if($_POST['valor_total'][$i] == '.'){
				$verifica_ponto = 1;
			}
		}
		
		if($verifica_ponto == 1){
			echo "<script language='javascript'>window.alert('Não utilize pontos, apenas utilize virgula para separar os centavos. EX: 100,35');</script>";
		}else{
	  
	  	  	  
	  if(number_format((float)$valor_faltante, 2, ',', '') < 0){ 
			echo "<script language='javascript'>window.alert('$valor_faltante - $valor_total O valor total já foi pago');</script>";
	  }else{
	   
	   $verifica_letra = 0;
	   	require "scripts/verifica_valor.php";
		if($verifica_letra == 1){
			echo "<script language='javascript'>window.alert('Só é aceitamos números!');</script>";

		}else{
	   
			  if($forma == 1){
				require "scripts/pagar_dinheiro.php";		  
			  }elseif($forma == 4){
				require "scripts/pagar_cheque.php";		
			  }elseif($forma == 6){
				require "scripts/aplicar_desconto.php";  
			  }else{
				echo "<script language='javascript'>window.location='?pack=1&pg=$forma&valor=$valor_total';</script>";
			  }
		  
		}// verrifica se foi digitado letra
	  }
    }
  }?>
  
  
  <?
  
    	$vl_total_carrinho = 0;
		$sql_valor_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho_produtos WHERE carrinho = '$code_carrinho'");
			while($res_carinho = mysqli_fetch_array($sql_valor_carrinho)){
				$vl_total_carrinho = $vl_total_carrinho+$res_carinho['vl_total'];
			}
			
    	$vl_carrinho_pagamento = 0;
		$sql_valor_pagamento = mysqli_query($conexao_bd, "SELECT * FROM carrinho_pagamentos WHERE code_carrinho = '$code_carrinho'");
			while($res_pagamento = mysqli_fetch_array($sql_valor_pagamento)){
				$vl_carrinho_pagamento = $vl_carrinho_pagamento+$res_pagamento['valor'];
			}  
  
  ?>
  
  
   <form name="" method="post" action="" enctype="multipart/form-data">
    <select style="width:290px; font:30px Arial, Helvetica, sans-serif; margin:5px; padding:5px;" name="forma" size="1">
      <option value="1">DINHEIRO</option>
      <option value="2">CARTAO DE CREDITO</option>
      <option value="3">CARTAO DE DEBITO</option>
      <option value="4">PIX/TRANSFERÊNCIA</option>
      <? if($cliente != ''){ ?>
      <option value="5">CREDIARIO</option>
      <? } ?>
      <option value="6">APLICAR DESCONTO</option>
    </select>
    <input style="width:114px; text-align:center; color:#00F; font:30px Arial, Helvetica, sans-serif; margin:5px; padding:5px;" <? if(number_format((float)$vl_total_carrinho-$vl_carrinho_pagamento, 2, '.', '') <= 0){ ?> disabled="disabled" <? } ?> type="text" name="valor_total" value="<?
			
			$valor_faltante = $vl_total_carrinho-$vl_carrinho_pagamento;
			
			if(number_format((float)$valor_faltante, 2, ',', '') <= 0){
			 echo number_format((float)$valor_faltante, 2, ',', '');
			}else{
			 echo number_format((float)$valor_faltante, 2, ',', '');
			}
						
	?>" />
    <input type="hidden" name="valor_faltante" value="<? echo $vl_total_carrinho-$vl_carrinho_pagamento; ?>" />
   </form>
   <hr />
  </div><!-- box_pagamentos_opcoes-->
  <? } // verifica se o o pg tem algo ?>
  
  
  
  
  
  <div id="box_pagamentos_opcoes_detalhes">
  <? ?>
   
   <? if(number_format((float)$vl_total_carrinho-$vl_carrinho_pagamento, 2, '.', '') <=0 && @$_GET['pg'] == '' && $vl_total_carrinho >= 1){ ?>
   <br /><br /><br />
   
    <script language="javascript">
		function finaliza(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=340,height=400');
		}
	</script>
    
   	<a style="font:12px Arial, Helvetica, sans-serif; text-decoration:none; border:4px solid #000; background:#069; padding:10px; margin:0 0 0 170px; color:#FFF;" onclick="finaliza('scripts/encerra_compra.php?operador=<? echo $nome; ?>&carrinho=<? echo $code_carrinho; ?>&cliente=<? echo $cliente; ?>&data_completa=<? echo date("d/m/Y H:i:s"); ?>');" href="?pack=1"><strong>Finalizar venda</strong></a>
   <? } ?>	
    
    
    
    
   <? 
    $valor = @base64_decode($_GET['valor']);
	
    if(@$_GET['pg'] == '2'){
	 require "scripts/pagar_cartao_credito.php";
	}elseif(@$_GET['pg'] == '3'){
	 require "scripts/pagar_cartao_debito.php";
	}elseif(@$_GET['pg'] == '5'){
	 require "scripts/pagar_crediario.php";
	}
   
   ?>
  </div><!-- box_pagamentos_opcoes_detalhes -->
  
  
  
  
  <? if(@$_GET['pg'] == ''){ ?>
  <div id="box_pagamentos_troco">
   <h1 style="font:25px Arial, Helvetica, sans-serif; margin:0 0 0 0;"><strong>VALOR A SER PAGO:</strong> <strong style="color:#F00;">R$ <? echo number_format($vl_total_carrinho,2,',','.'); ?></strong></h1>
   <hr />
   <h1 style="font:18px Arial, Helvetica, sans-serif; margin:0 0 0 0;"><strong>VALOR PAGO:</strong> R$ <? echo number_format($vl_carrinho_pagamento,2,',','.'); ?> - <strong>FALTA:</strong> R$ <? 
   
   if($vl_total_carrinho-$vl_carrinho_pagamento <= 0){
		echo number_format(0,2,',','.');
   }else{
   echo number_format($vl_total_carrinho-$vl_carrinho_pagamento,2,',','.'); 
   }
   ?></h1>
   <h1 style="font:17px Arial, Helvetica, sans-serif; margin:0 0 0 0;"><strong>DESCONTO:</strong> R$ 
   <?
    $valor_desconto = 0;
	$desconto_geral = 0;
	
	
    $sql_busca_produto = mysqli_query($conexao_bd, "SELECT * FROM carrinho_produtos WHERE carrinho = '$code_carrinho' AND operador = '$operador'");
	while($res_prod = mysqli_fetch_array($sql_busca_produto)){
		$valor_desconto = $valor_desconto+$res_prod['desconto'];
	}
	
    $sql_desconto = mysqli_query($conexao_bd, "SELECT * FROM carrinho_pagamentos WHERE code_carrinho = '$code_carrinho' AND forma_pagamento = 'DESCONTO' AND operador = '$operador'");
	while($res_desconto = mysqli_fetch_array($sql_desconto)){
		$desconto_geral = $desconto_geral+$res_desconto['valor'];
		$soma_troco = $soma_troco+$res_desconto['troco'];
	}	
	
   echo number_format($valor_desconto+$desconto_geral,2,',','.');
   ?>
    - <strong>TROCO:</strong> R$ <? $soma_troco = 0;
	
    $sql_troco = mysqli_query($conexao_bd, "SELECT * FROM carrinho_pagamentos WHERE code_carrinho = '$code_carrinho' AND operador = '$operador'");
	while($res_troco = mysqli_fetch_array($sql_troco)){
		$soma_troco = $soma_troco+$res_troco['troco'];
	}	
	
	echo number_format($soma_troco,2,',','.'); ?></h1>
  </div><!-- box_pagamentos_troco -->
  <? } // verifica de se existe produto ativo ?> 
  
  
 </div><!-- box_pagamentos -->
 
 <div id="produtos">
    <script language="javascript">
		function abrePopUp(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=330,height=400');
		}
	</script>
  <? if(@$vl_total_carrinho >= 1){ ?>
  <a style="float:left; color:#000; margin:5px; font:12px Arial, Helvetica, sans-serif;" onclick="abrePopUp('scripts/print_orcamento.php?operador=<? echo $nome; ?>&carrinho=<? echo $code_carrinho; ?>&cliente=<? echo $cliente; ?>&data_completa=<? echo date("d/m/Y H:i:s"); ?>');" href="">Imprimir orçamento</a>
  <? } ?>


  
  <? if(@$vl_carrinho_pagamento >= 1){ ?>
  <a rel="superbox[iframe][700x250]" style="float:right; color:#000; margin:5px; font:12px Arial, Helvetica, sans-serif;" href="scripts/exibir_pagamentos.php?carrinho=<? echo base64_encode($code_carrinho); ?>">Pagamentos</a>
  <? } ?>
  
  <h1 style="margin:5px 0 0 0; font:15px Arial, Helvetica, sans-serif;"><strong>Histórico de produtos</strong></h1>
  <hr />
  
  <?
   $sql_busca_produto = mysqli_query($conexao_bd, "SELECT * FROM carrinho_produtos WHERE carrinho = '$code_carrinho' AND operador = '$operador'");
   if(mysqli_num_rows($sql_busca_produto) == ''){
	   echo "<h1 style='font:12px Arial;'>Nenhum produto adicionado...</h1>";
   }else{
  ?>
   <table style="margin:5px;" width="530" border="0">
      <tr>
        <td width="11" bgcolor="#99CC66">&nbsp;</td>
        <td width="62" bgcolor="#99CC66"><strong>COD.</strong></td>
        <td width="74" bgcolor="#99CC66"><strong>QUANT.</strong></td>
        <td width="200" bgcolor="#99CC66"><strong>PRODUTO</strong></td>
        <td width="74" bgcolor="#99CC66"><strong>VL. UNIT.</strong></td>
        <td width="83" bgcolor="#99CC66"><strong>VL. TOTAL</strong></td>
      </tr>
      <? $i = 0; while($res_prod = mysqli_fetch_array($sql_busca_produto)){ $i++; ?>
      <form name="" method="post" action="" enctype="multipart/form-data">
      <input type="hidden" name="codeproduto" value="<? echo $res_prod['produto']; ?>" />
      <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
        <td><? echo $i; ?></td>
        <td><? echo $res_prod['produto']; ?></td>
        <td><input name="quantprod" type="text" style="font:10px Arial, Helvetica, sans-serif; text-align:center; border:1px solid #FFF;" value="<? echo $res_prod['quantidade']; ?>" size="2" /></td>
        <td><? 
			
			$sql_produto = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE code = '".$res_prod['produto']."'");
				while($res_produto = mysqli_fetch_array($sql_produto)){
					echo $res_produto['titulo'];
				}
		
		 ?></td>
        <td>R$ <a style="text-decoration:none;" rel="superbox[iframe][300x80]" href="scripts/pagar_desconto.php?id_produto_carrinho=<? echo $res_prod['id']; ?>"><? echo number_format($res_prod['vl_unitario'],2,',','.'); ?></a></td>
        <td>R$ <? echo number_format($res_prod['vl_total'],2,',','.'); ?></td>
      </tr>
      </form>
      <? } ?>
    </table>
	<? } ?>
  
 </div><!-- produtos -->
 
</div><!-- box_central -->

</body>
</html>
<? if(isset($_POST['quantprod'])){
	
$codeproduto = $_POST['codeproduto'];


if($_POST['quantprod'] == 0){
	mysqli_query($conexao_bd, "DELETE FROM carrinho_produtos WHERE produto = '$codeproduto' AND carrinho = '$code_carrinho' AND operador = '$operador'");
	echo "<script language='javascript'>window.location='';</script>";
}else{

$sql_quanti = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE code = '$codeproduto'");
 while($res_quant = mysqli_fetch_array($sql_quanti)){
	 $vl_total = $res_quant['valor_venda']*$_POST['quantprod'];
 
 
 mysqli_query($conexao_bd, "UPDATE carrinho_produtos SET quantidade = '".$_POST['quantprod']."', vl_unitario = '".$res_quant['valor_venda']."', vl_total = '$vl_total' WHERE carrinho = '$code_carrinho' AND operador = '$operador' AND produto = '$codeproduto'");

echo "<script language='javascript'>window.location='';</script>";

 }
}
}?>