<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/fechar_caixa.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#box_central table tr td {
	font-weight: bold;
}
</style>
</head>

<body>
<div id="box_central">
 <h1 style="font:18px Arial, Helvetica, sans-serif; margin:5px;"><strong>Fechamento do caixa</strong></h1>
 <hr />
<? if(@$_GET['recibo'] == 'sim'){ ?>
  <script language="javascript">
		function finaliza(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=340,height=400');
		}
	</script>
<a style="font:12px Arial, Helvetica, sans-serif; text-decoration:none; margin:-5px 0 0 0; border:4px solid #000; float:left; background:#069; padding:10px; color:#FFF;" onclick="finaliza('scripts/relatorio_final_resumido.php?operadornome=<? echo $nome; ?>&valor_abertura_caixa=<? echo @$valor_abertura_caixa; ?>&operador=<? echo $operador; ?>&dia=<? echo $dia; ?>&mes=<? echo $mes; ?>&ano=<? echo $ano; ?>&cliente=<? echo @$nome_cliente; ?>&valor=<? echo @$valor; ?>&nome_cliente=<? echo @$nome_cliente; ?>');" href=""><strong>Relatório resumido</strong></a>



  <script language="javascript">
		function relatorio_completo(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=50,left=150,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=1030,height=600');
		}
	</script>
<a style="font:12px Arial, Helvetica, sans-serif; text-decoration:none; margin:-5px 0 0 0; border:4px solid #000; float:right; background:#930; padding:10px; color:#FFF;" onclick="relatorio_completo('scripts/relatorio_final_completo.php?operadornome=<? echo $nome; ?>&valor_abertura_caixa=<? echo @$valor_abertura_caixa; ?>&operador=<? echo $operador; ?>&dia=<? echo date("d"); ?>&mes=<? echo date("m"); ?>&ano=<? echo date("Y"); ?>&cliente=<? echo @$nome_cliente; ?>&valor=<? echo @$valor; ?>&nome_cliente=<? echo @$nome_cliente; ?>');" href=""><strong>Relatório completo</strong></a>

<br /><br />

<?
$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM abertura_caixa WHERE operador = '$operador' AND data = '$data' AND status = 'Ativo'");
 while($res_caixa = mysqli_fetch_array($sql_verifica)){
?>
<table width="990" border="0">
  <tr>
    <td colspan="6" bgcolor="#FFFFEC"><h1>Resumo de caixa</h1></td>
  </tr>
  <tr>
    <td colspan="6">Valor inicial dispon&iacute;vel no caixa: R$ <? echo number_format($valor_abertura_caixa,2,',','.'); ?> </td>
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


<table width="990" border="0">
  <tr>
    <td colspan="7" bgcolor="#FFFFEC"><h1>Venda de produtos</h1></td>
  </tr>
  <tr>
    <td width="148" bgcolor="#F2F2FF">QUANT.PRODUTOS</td>
    <td width="151" bgcolor="#F2F2FF">VALOR TOTAL</td>
    <td width="154" bgcolor="#F2F2FF">DINHEIRO</td>
    <td width="151" bgcolor="#F2F2FF">CART&Atilde;O DE CR&Eacute;DITO</td>
    <td width="150" bgcolor="#F2F2FF">CART&Atilde;O DE D&Eacute;BITO</td>
    <td width="92" bgcolor="#F2F2FF">PIX/TRANSFER&Ecirc;NCIA</td>
    <td width="114" bgcolor="#F2F2FF">CREDI&Aacute;RIO</td>
  </tr>
<?
$soma_valores = 0;
$soma_quantidade = 0;

$dinheiro = 0;
$cartao_credito = 0;
$cartao_debito = 0;
$cheque = 0;
$crediario = 0;

$sql_pagamento = mysqli_query($conexao_bd, "SELECT * FROM carrinho_pagamentos WHERE operador = '$operador' AND dia = '$dia' AND mes = '$mes' AND ano = '$ano'");
 while($res_carrnho = mysqli_fetch_array($sql_pagamento)){
	 if($res_carrnho['forma_pagamento'] == 'DINHEIRO'){
		 $dinheiro = $dinheiro+$res_carrnho['valor'];
	 }elseif($res_carrnho['forma_pagamento'] == 'CARTAO DE CREDITO'){
		 $cartao_credito = $cartao_credito+$res_carrnho['valor'];
	 }elseif($res_carrnho['forma_pagamento'] == 'CARTAO DE DEBITO'){
		 $cartao_debito = $cartao_debito+$res_carrnho['valor'];
	 }elseif($res_carrnho['forma_pagamento'] == 'CHEQUE'){
		 $cheque = $cheque+$res_carrnho['valor'];
	 }else{
		 $crediario = $crediario+$res_carrnho['valor'];
	 }
 }
 
$sql_quant = mysqli_query($conexao_bd, "SELECT * FROM carrinho_produtos WHERE operador = '$operador' AND dia = '$dia' AND mes = '$mes' AND ano = '$ano'");
 while($res_qua = mysqli_fetch_array($sql_quant)){
	 $soma_valores = $soma_valores+$res_qua['vl_total'];
	 $soma_quantidade = $soma_quantidade+$res_qua['quantidade'];
 }
 
?>
  <tr>
    <td><? echo $soma_quantidade; ?></td>
    <td>R$ <? echo number_format($soma_valores,2,',','.'); ?></td>
    <td>R$ <? echo number_format($dinheiro,2,',','.'); ?></td>
    <td>R$ <? echo number_format($cartao_credito,2,',','.'); ?></td>
    <td>R$ <? echo number_format($cartao_debito,2,',','.'); ?></td>
    <td>R$ <? echo number_format($cheque,2,',','.'); ?></td>
    <td>R$ <? echo number_format($crediario,2,',','.'); ?></td>
  </tr>
</table>

<table width="990" border="0">
  <tr>
    <td colspan="9" bgcolor="#FFFFEC"><h1>Pagamentos do credi&aacute;rios</h1></td>
  </tr>
  <tr>
    <td width="10" bgcolor="#F2F2FF">&nbsp;</td>
    <td colspan="2" bgcolor="#F2F2FF">DATA</td>
    <td width="50" bgcolor="#F2F2FF">COD.</td>
    <td width="293" bgcolor="#F2F2FF">CLIENTE</td>
    <td width="111" bgcolor="#F2F2FF">VALOR</td>
    <td colspan="2" bgcolor="#F2F2FF">FORMA DE PAGT.</td>
    <td width="60" bgcolor="#F2F2FF">&nbsp;</td>
  </tr>
<?
$i = 0;

$recebido_dinheiro = 0;
$recebido_cartao_credito = 0;
$recebido_cartao_debito = 0;
$recebido_cartao_cheque = 0;

$sql_credito = mysqli_query($conexao_bd, "SELECT * FROM historico_creditos WHERE operador = '$operador' AND data = '$data'");
 while($res_credito = mysqli_fetch_array($sql_credito)){ $i++;
 	
	if($res_credito['forma_pagamento'] == 'DINHEIRO'){
		$recebido_dinheiro = $recebido_dinheiro+$res_credito['valor'];
	}elseif($res_credito['forma_pagamento'] == 'CARTAO DE CREDITO'){
		$recebido_cartao_credito = $recebido_cartao_credito+$res_credito['valor'];
	}elseif($res_credito['forma_pagamento'] == 'CARTAO DE DEBITO'){
		$recebido_cartao_debito = $recebido_cartao_debito+$res_credito['valor'];
	}elseif($res_credito['forma_pagamento'] == 'CHEQUE'){
		$recebido_cartao_cheque = $recebido_cartao_cheque+$res_credito['valor'];
	}
	
?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; } ?>>
    <td><h1 style="font:12px Arial, Helvetica, sans-serif; color:#999;"><? echo $i; ?></h1></td>
    <td colspan="2"><h1 style="font:12px Arial, Helvetica, sans-serif; color:#999;"><? echo $res_credito['data_completa']; ?></h1></td>
    <td><h1 style="font:12px Arial, Helvetica, sans-serif; color:#999;"><? echo $res_credito['cliente']; ?></h1></td>
    <td>
      <h1 style="font:12px Arial, Helvetica, sans-serif; color:#999;"><?
	 $sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE code = '".$res_credito['cliente']."'");
	 	while($res_cliente = mysqli_fetch_array($sql_cliente)){
			echo strtoupper($res_cliente['nome']);
		}
	?>    </h1>
    </td>
    <td><h1 style="font:12px Arial, Helvetica, sans-serif; color:#999;">R$ <? echo number_format($res_credito['valor'],2,',','.'); ?></h1></td>
    <td colspan="2"><h1 style="font:12px Arial, Helvetica, sans-serif; color:#999;"><? if($res_credito['forma_pagamento'] == 'CHEQUE'){ echo "PIX/TRANSFERÊNCIA";}else{echo $res_credito['forma_pagamento']; } ?></h1></td>
    <td><a href=""><img src="img/historico_cliente.png" alt="" width="20" height="20" border="0" title="Imprimir comprovante" /></a></td>
  </tr>
<? } ?>
  <tr>
    <td style="padding:0; margin:0;" colspan="9"><table style="padding:0; margin:0; float:left;" width="985" border="0">
      <tr>
        <td width="175" bgcolor="#339999">DINHEIRO</td>
        <td width="217" bgcolor="#339999">CART&Atilde;O DE CR&Eacute;DITO</td>
        <td width="230" bgcolor="#339999">CART&Atilde;O DE D&Eacute;BITO</td>
        <td width="185" bgcolor="#339999">PIX/TRANSFER&Ecirc;NCIA</td>
        <td width="156" bgcolor="#339999">TOTAL RECEBIDO</td>
      </tr>
      <tr>
        <td>R$ <? echo number_format($recebido_dinheiro,2,',','.'); ?></td>
        <td>R$ <? echo number_format($recebido_cartao_credito,2,',','.'); ?></td>
        <td>R$ <? echo number_format($recebido_cartao_debito,2,',','.'); ?></td>
        <td>R$ <? echo number_format($recebido_cartao_cheque,2,',','.'); ?></td>
        <td>R$ <? echo number_format($recebido_dinheiro+$recebido_cartao_credito+$recebido_cartao_debito+$recebido_cartao_cheque,2,',','.'); ?></td>
      </tr>
    </table></td>
    </tr>
</table>





<table width="990" border="0">
  <tr>
    <td colspan="5" bgcolor="#FFFFEC"><h1>Sangrias de caixa</h1></td>
  </tr>
  <tr>
    <td width="134" bgcolor="#F2F2FF">&nbsp;</td>
    <td colspan="2" bgcolor="#F2F2FF">DATA</td>
    <td width="196" bgcolor="#F2F2FF">FORMA DA RETIRADA</td>
    <td bgcolor="#F2F2FF">VALOR</td>
    </tr>
<? $i=0;
   $sql_sangria = mysqli_query($conexao_bd, "SELECT * FROM sangria WHERE data = '$data' AND operador = '$operador'");
   	while($res_sangria = mysqli_fetch_array($sql_sangria)){ $i++;
?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; } ?>>
    <td><h1 style="font:12px Arial, Helvetica, sans-serif; color:#999;"><? echo $i; ?></h1></td>
    <td colspan="2"><h1 style="font:12px Arial, Helvetica, sans-serif; color:#999;"><? echo $res_sangria['data_completa']; ?></h1></td>
    <td><h1 style="font:12px Arial, Helvetica, sans-serif; color:#999;"><? echo $res_sangria['forma']; ?></h1></td>
    <td>
      <h1 style="font:12px Arial, Helvetica, sans-serif; color:#999;">R$ <? echo number_format($res_sangria['valor'],2,',','.'); ?></h1>
    </td>
    </tr>
  <? } ?>
</table>





<?
$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM fechamento_caixa WHERE operador = '$operador' AND data = '$data' AND status = 'Ativo'");
 while($res_caixa = mysqli_fetch_array($sql_verifica)){
?>
<table width="990" border="0">
  <tr>
    <td colspan="6" bgcolor="#FFFFEC"><h1>Resumo de caixa</h1></td>
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
    <td colspan="6">Valor final dispon&iacute;vel no caixa: R$ <? 
	$valor_final_caixa = ($res_caixa['nota100']*100)+($res_caixa['nota50']*50)+($res_caixa['nota20']*20)+($res_caixa['nota10']*10)+($res_caixa['nota5']*5)+($res_caixa['nota2']*2)+($res_caixa['moeda1'])+($res_caixa['moeda50']*0.5)+($res_caixa['moeda25']*0.25)+($res_caixa['moeda10']*0.1)+($res_caixa['moeda05']*0.05);
	echo number_format($valor_final_caixa,2,',','.'); ?></td>
  </tr>
  <tr>
    <td colspan="6"><h1 style="font:18px Arial, Helvetica, sans-serif; margin:0; padding:0; color:#333;"><strong>Saldo:</strong> R$ <? echo number_format($valor_final_caixa-$saldo_caixa,2,',','.'); ?> <? if($valor_final_caixa-$saldo_caixa < 0){ ?><h2 style="font:12px Arial, Helvetica, sans-serif; color:#F00;">(<em>Falta dinheiro no caixa</em>)</h2><? } ?></h1></td>
    </tr>
  <tr>
    <td colspan="6" align="center">
<a style="font:12px Arial, Helvetica, sans-serif; text-decoration:none; margin:-5px 0 0 0; border:4px solid #000; float:center; background:#060; padding:10px; color:#FFF;" href="?pack=1000&recibo=sair"><strong>Confirmar fechamento</strong></a>
    </td>
    </tr>
</table>
<? } ?>
<br />
<br />

<br />
<? } // fecha sim ?>


<? if(@$_GET['recibo'] == 'sair'){
	
mysqli_query($conexao_bd, "UPDATE abertura_caixa SET status = 'ENCERRADO' WHERE operador = '$operador'");

session_start();
$_SESSION['cpf'] = 000;
$_SESSION['nome'] = 000;

echo "<script language='javascript'>window.location='';</script>";


}?>
















<? if(@$_GET['recibo'] == ''){ ?> 
<? if(isset($_POST['button'])){

$nota100 = $_POST['nota100'];
$nota50 = $_POST['nota50'];
$nota20 = $_POST['nota20'];
$nota10 = $_POST['nota10'];
$nota5 = $_POST['nota5'];
$nota2 = $_POST['nota2'];
$moeda1 = $_POST['moeda1'];
$moeda50 = $_POST['moeda50'];
$moeda25 = $_POST['moeda25'];
$moeda10 = $_POST['moeda10'];
$moeda05 = $_POST['moeda05'];
$saldo_maquina = $_POST['saldo_maquina'];

$abrir = mysqli_query($conexao_bd, "UPDATE fechamento_caixa SET nota100 = '$nota100', nota50 = '$nota50', nota20 = '$nota20', nota10 = '$nota10', nota5 = '$nota5', nota2 = '$nota2', moeda1 = '$moeda1', moeda50 = '$moeda50', moeda25 = '$moeda25', moeda10 = '$moeda10', moeda05 = '$moeda05', saldo_maquina = '$saldo_maquina' WHERE operador = '$operador' AND data = '$data'");
if($abrir == ''){
echo "<script language='javascript'>window.alert('Ocorreu um erro, por favor, tente novamente!');</script>";
}else{
echo "<script language='javascript'>window.location='?pack=1000&recibo=sim';</script>";
}
}?>

<?
$sql_verifica_caixa = mysqli_query($conexao_bd, "SELECT * FROM fechamento_caixa WHERE operador = '$operador' AND data = '$data'");
if(mysqli_num_rows($sql_verifica_caixa) == ''){
$abrir = mysqli_query($conexao_bd, "INSERT INTO fechamento_caixa (dia, mes, ano, data, data_completa, ip, status, operador, nota100, nota50, nota20, nota10, nota5, nota2, moeda1, moeda50, moeda25, moeda10, moeda05, saldo_maquina) VALUES ('$dia', '$mes', '$ano', '$data', '$data_completa', '$ip', 'Ativo', '$operador', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0')");
	echo "<script language='javascript'>window.location='';</script>";
}else{
	while($res_caixa = mysqli_fetch_array($sql_verifica_caixa)){
?>
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="990" border="0">
  <tr>
    <td colspan="6" bgcolor="#999999"><p>PREENCHA OS DADOS CORRETAMENTE PARA FAZER O FECHAMENTO</p>
      <h1 style="border-radius:5px; background:#FFF; border:1px solid #000; color:#060; padding:15px;">Valor disponível no caixa <br />R$ <? echo number_format($saldo_caixa,2,',','.'); ?></h1></td>
  </tr>
  <tr>
    <td bgcolor="#EEFFB9">Notas de R$ 100,00</td>
    <td bgcolor="#EEFFB9">Notas de R$ 50,00</td>
    <td bgcolor="#EEFFB9">Notas de R$ 20,00</td>
    <td bgcolor="#EEFFB9">Notas de R$ 10,00</td>
    <td bgcolor="#EEFFB9">Nota de R$ 5,00</td>
    <td bgcolor="#EEFFB9">Notas de R$ 2,00</td>
  </tr>
  <tr>
    <td><label for="nota100"></label>
      <input name="nota100" type="text" id="nota100" size="5" value="<? echo $res_caixa['nota100']; ?>" /></td>
    <td><input name="nota50" type="text" id="nota50" size="5" value="<? echo $res_caixa['nota50']; ?>" /></td>
    <td><input name="nota20" type="text" id="nota20" size="5" value="<? echo $res_caixa['nota20']; ?>" /></td>
    <td><input name="nota10" type="text" id="nota10" size="5" value="<? echo $res_caixa['nota10']; ?>" /></td>
    <td><input name="nota5" type="text" id="nota5" size="5" value="<? echo $res_caixa['nota5']; ?>" /></td>
    <td><input name="nota2" type="text" id="nota2" size="5" value="<? echo $res_caixa['nota2']; ?>" /></td>
  </tr>
  <tr>
    <td bgcolor="#EEFFB9">Moedas de R$ 1,00 </td>
    <td bgcolor="#EEFFB9">Moedas de R$ 0,50</td>
    <td bgcolor="#EEFFB9">Moedas de 0,25</td>
    <td bgcolor="#EEFFB9">Moedas de 0,10</td>
    <td bgcolor="#EEFFB9">Moedas de R$ 0,05</td>
    <td bgcolor="#EEFFB9">Saldo da maquina</td>
  </tr>
  <tr>
    <td><input name="moeda1" type="text" id="moeda1" size="5" value="<? echo $res_caixa['moeda1']; ?>" /></td>
    <td><input name="moeda50" type="text" id="moeda50" size="5" value="<? echo $res_caixa['moeda50']; ?>" /></td>
    <td><input name="moeda25" type="text" id="moeda25" size="5" value="<? echo $res_caixa['moeda25']; ?>" /></td>
    <td><input name="moeda10" type="text" id="moeda10" size="5" value="<? echo $res_caixa['moeda10']; ?>" /></td>
    <td><input name="moeda05" type="text" id="moeda05" size="5" value="<? echo $res_caixa['moeda05']; ?>" /></td>
    <td><input name="saldo_maquina" type="text" id="saldo_maquina" size="5" value="<? echo $res_caixa['saldo_maquina']; ?>" /></td>
  </tr>
  <tr>
    <td colspan="6"><input type="submit" name="button" id="button" value="Fechar caixa"></td>
  </tr>
</table> 
</form>
<? }} ?>
<? } // verifica ?>
</div><!-- box_central -->
</body>
</html>