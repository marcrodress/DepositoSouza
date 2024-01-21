<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/topo.css" rel="stylesheet" type="text/css" />
<? require "config.php"; ?>
<?php

error_reporting(0);
ini_set("display_errors", 0 );

?>

<link rel="stylesheet" href="jquery.superbox.css" type="text/css" media="all" />
<script type="text/javascript" src="
http://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
<script type="text/javascript" src="jquery.superbox-min.js"></script>
<script type="text/javascript">

	$(function(){

		$.superbox.settings = {
		closeTxt: "Fechar",
		loadTxt: "Coletando informações. Por favor, aguarde...",
		overlayOpacity: .5, // Background opaqueness
		boxWidth: "800", // Default width of the box
		boxHeight: "600", // Default height of the box

			};

			$.superbox();

		});

</script>

<?

$code_dia = 0;
$sql_vencimento = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE vencimento = '$data'");
	while($res_vencimento = mysqli_fetch_array($sql_vencimento)){
		 $code_dia = $res_vencimento['codigo'];
	}

?>
</head>

<body>
<div id="box_topo">
 
 <div id="box_logo">
 	<img src="../img/logo.png" width="200" height="100" />
 </div><!-- box_logo -->
 
 <div id="box_busca">
  <form name="" method="get" action="" enctype="multipart/form-data">
   <input style="width:90px; padding:15px; text-align:center; color:#F00; margin:15px 0 0 15px; font:30px Arial, Helvetica, sans-serif; border-radius:5px; border:1px solid #CCC;" type="text" name="pack" autofocus />
   <input style="width:120px; padding:15px; margin:15px 0 0 8px; font:30px Arial, Helvetica, sans-serif; border-radius:5px; border:1px solid #CCC;" type="submit" name="enviar" value="Buscar" />
  </form>
 </div><!-- box_busca -->
 
 <div id="faturamento">
  <img src="img/faturamento.fw.png" />
  <h1 style="font:20px Arial, Helvetica, sans-serif; color:#090; margin:15px 0 0 0;"><strong>R$ 
  <?
   $faturamento = 0;
   
   $sql_faturamento = mysqli_query($conexao_bd, "SELECT * FROM carrinho_pagamentos WHERE dia = '$dia' AND mes = '$mes' AND ano = '$ano' AND operador = '$operador'");
    while($res_faturamento = mysqli_fetch_array($sql_faturamento)){
		$faturamento = $faturamento+$res_faturamento['valor'];
   }
   
   echo number_format($faturamento,2,',','.');
   
  ?>
  </strong></h1>
 </div><!-- faturamento -->
 
 <div id="emcaixa">
  <img src="img/emcaixa.fw.png" />
  <h1 style="font:20px Arial, Helvetica, sans-serif; color:#090; margin:15px 0 0 0;"><strong>R$ 
  <?
   $faturamento = 0;
   
   $sql_faturamento = mysqli_query($conexao_bd, "SELECT * FROM carrinho_pagamentos WHERE dia = '$dia' AND mes = '$mes' AND ano = '$ano' AND operador = '$operador' AND forma_pagamento = 'DINHEIRO'");
    while($res_faturamento = mysqli_fetch_array($sql_faturamento)){
		$faturamento = $faturamento+$res_faturamento['valor'];
   }
   
   
   $valor_sangria = 0;
   $sql_sangria = mysqli_query($conexao_bd, "SELECT * FROM sangria WHERE data = '$data' AND operador = '$operador'");
   	while($res_sangria = mysqli_fetch_array($sql_sangria)){
		$valor_sangria = $valor_sangria+$res_sangria['valor'];
	}
   
   
   
   $historico_credito = 0;
   $sql_credito = mysqli_query($conexao_bd, "SELECT * FROM historico_creditos WHERE dia = '$dia' AND mes = '$mes' AND ano = '$ano' AND operador = '$operador' AND forma_pagamento = 'DINHEIRO'");
    while($res_credito = mysqli_fetch_array($sql_credito)){
		$historico_credito = $historico_credito+$res_credito['valor'];
   }   
   
   
   $valor_abertura_caixa = 0;
   
   $sql_caixa = mysqli_query($conexao_bd, "SELECT * FROM abertura_caixa WHERE dia = '$dia' AND mes = '$mes' AND ano = '$ano' AND operador = '$operador' AND status = 'Ativo'");
    while($res_caixa = mysqli_fetch_array($sql_caixa)){
		$valor_abertura_caixa = ($res_caixa['nota100']*100)+($res_caixa['nota50']*50)+($res_caixa['nota20']*20)+($res_caixa['nota10']*10)+($res_caixa['nota5']*5)+($res_caixa['nota2']*2)+$res_caixa['moeda1']+($res_caixa['moeda50']*0.5)+($res_caixa['moeda25']*0.25)+($res_caixa['moeda10']*0.1)+($res_caixa['moeda05']*0.05);
   }
   
   $saldo_caixa = ($faturamento+$valor_abertura_caixa+$historico_credito)-$valor_sangria;
   
   echo number_format($saldo_caixa,2,',','.');
   
  ?>  
  </strong></h1>
 </div><!-- emcaixa -->
 
 <div id="informacoes_operador">
  <h1 style="font:12px Arial, Helvetica, sans-serif; text-transform:uppercase; color:#FF0;"><strong>Operador</strong></h1>
  <h1 style="font:12px Arial, Helvetica, sans-serif; text-transform:capitalize; color:#FFF;"><? echo $nome; ?></h1>
  <h1 style="font:10px Arial, Helvetica, sans-serif; text-transform:uppercase; color:#FFF;"><? echo date("d/m/Y H:i:s"); ?></h1>
  <h1 style="font:10px Arial, Helvetica, sans-serif; text-transform:uppercase; color:#FFF;">Sair - 1001</h1>
 </div><!-- informacoes_operador -->
 
</div><!-- box_topo -->
</body>
</html>

<?
   $code_carrinho = 0;
   $cliente = 0;
   $nome_cliente = 0;
   $saldo_devedor = 0;
   
   $sql_verifica_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE operador = '$operador' AND status = 'Ativo'");
   if(mysqli_num_rows($sql_verifica_carrinho) == ''){
	   $code_carrinho = rand()+date("s")+date("d")*date("m")*date("Y");
	   
	   mysqli_query($conexao_bd, "INSERT INTO carrinho (status, dia, mes, ano, data_completa, ip, operador, code_carrinho, cliente, code_dia) VALUES ('Ativo', '$dia', '$mes', '$ano', '$data_completa', '$ip', '$operador', '$code_carrinho', '', '$code_dia')");
	   
   }else{
	   while($res_carrinho = mysqli_fetch_array($sql_verifica_carrinho)){
		   $code_carrinho = $res_carrinho['code_carrinho'];
		   $cliente = $res_carrinho['cliente'];
		   
		   
		   $sql_nome_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE code = '$cliente'");
		   	while($res_nome = mysqli_fetch_array($sql_nome_cliente)){
				$nome_cliente = $res_nome['nome'];
				$saldo_devedor = $res_nome['saldo'];
			}
		   
		   
	   } // while
   }

?>



<?
// VERIFICA SE O CAIXA FOI ABERTO

if(@$_GET['pack'] != 'abrir'){
$sql_caixa = mysqli_query($conexao_bd, "SELECT * FROM abertura_caixa WHERE operador = '$operador' AND data = '$data'");
if(mysqli_num_rows($sql_caixa) == ''){
	echo "<script language='javascript'>window.location='?pack=abrir';</script>";
 }
}
// VERIFICA SE O CAIXA FOI ABERTO
?>



<? /*
$id = 0;
$sql_pro = mysqli_query($conexao_bd, "SELECT * FROM produtos");
 while($res_pro = mysqli_fetch_array($sql_pro)){ $id = 0; $code_barras = 0;
	 $id = $res_pro['id'];
	 $code = $res_pro['code'];
	 
	 mysqli_query($conexao_bd, "DELETE FROM produtos WHERE code = '$code' AND id != '$id'");
 }

	 mysqli_query($conexao_bd, "DELETE FROM produtos WHERE titulo = ''");

*/
?>


