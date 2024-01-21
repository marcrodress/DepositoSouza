<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<? 
$dia_inicial = 0;
$dia_final = 0;

if($tipo_filtro == 'a_15'){
$dia_inicial = 15;
$dia_final = 29;
}elseif($tipo_filtro == 'a_30'){
$dia_inicial = 30;
$dia_final = 44;
}elseif($tipo_filtro == 'a_45'){
$dia_inicial = 45;
$dia_final = 59;
}elseif($tipo_filtro == 'a_60'){
$dia_inicial = 60;
$dia_final = 50000000;
}

$soma = 0;
$code_ultimo_compra = 0;
$code_ultimo_pagamento = 0;

$sql = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE saldo > 0");
while($res = mysqli_fetch_array($sql)){
	$code_ultimo_pagamento = $res['code_ultimo_pagamento'];
	
		if($code_ultimo_pagamento == ''){
		$code_ultimo_pagamento = $code_dia;
		}else{
		$code_ultimo_pagamento = $res['code_ultimo_pagamento'];
		}
	
	
	$code_ultima_compra = $res['code_ultima_compra'];
	 $diferenca = $code_ultimo_pagamento-$code_ultima_compra;
	
	if($diferenca > $dia_inicial  && $diferenca < $dia_final){
		$soma++;
	}
	
	
}
 $soma;

if($soma == ''){
	echo "<h1 style='margin:10px; font:12px Arial;'><strong>Não foram encontrados registros para o filtro selecionado!</strong></h1><br>";
}else{
?>
<table width="990" border="0">
  <tr>
    <td colspan="9">Foram encontrados <? echo $soma; ?> registros para o filtro selecionado</td>
  </tr>
  <tr>
    <td width="108" bgcolor="#66CC00">COD. CLIENTE</td>
    <td width="231" bgcolor="#66CC00">NOME DO CLIENTE</td>
    <td width="62" bgcolor="#66CC00">CPF</td>
    <td width="101" bgcolor="#66CC00">TELEFONE</td>
    <td width="89" bgcolor="#66CC00">SALDO</td>
    <td width="110" bgcolor="#66CC00">&Uacute;. COMPRA</td>
    <td width="119" bgcolor="#66CC00">&Uacute;. PAGAMENTO</td>
    <td width="107" bgcolor="#66CC00">DIAS. ATRASO</td>
    <td width="25" bgcolor="#66CC00">&nbsp;</td>
  </tr>
  <? $i=0; $soma = 0; 
$sql = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE saldo > 0");
while($res = mysqli_fetch_array($sql)){
	
	$code_ultimo_pagamento = $res['code_ultimo_pagamento'];
	
		if($code_ultimo_pagamento == ''){
		$code_ultimo_pagamento = $code_dia;
		}else{
		$code_ultimo_pagamento = $res['code_ultimo_pagamento'];
		}
	
	
	$code_ultima_compra = $res['code_ultima_compra'];
	$diferenca = $code_ultimo_pagamento-$code_ultima_compra;	
	
	
	if($diferenca > $dia_inicial  && $diferenca < $dia_final){
		$soma = $soma+$res['saldo'];
  $i++;  ?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td><h1 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;"><? echo $res['code']; ?></h1></td>
    <td><h1 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;"><? echo $res['nome']; ?></h1></td>
    <td><h1 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;"><? echo $res['cpf']; ?></h1></td>
    <td><h1 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;"><? echo $res['telefone_1']; ?></h1></td>
    <td><h1 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;">R$ <? echo number_format($res['saldo'],2,',','.'); ?></h1></td>
    <td><h1 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;"><?
	 $sql_data = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE codigo = '".$res['code_ultima_compra']."'");
	 	while($res_data = mysqli_fetch_array($sql_data)){
			echo $res_data['vencimento'];
		}
	?></h1></td>
    <td><h1 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;"><?
	 $sql_data = mysqli_query($conexao_bd, "SELECT * FROM datas_vencimento WHERE codigo = '".$res['code_ultimo_pagamento']."'");
	 	while($res_data = mysqli_fetch_array($sql_data)){
			echo $res_data['vencimento'];
		}
	?></h1></td>
    <td><? echo $diferenca;?> dias</td>
    <td><a href=""><img src="img/historico_cliente.png" alt="" width="25" height="25" border="0" title="Exibir hist&oacute;rico do cliente" /></a></td>
  </tr>
  <? }} ?>
  <tr>
    <td>&nbsp;</td>
    <td colspan="3" align="right">Valor total recebido</td>
    <td align="CENTER" bgcolor="#009966"><span style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;">R$ <? echo number_format($soma,2,',','.'); ?></span></td>
    <td bgcolor="#FFFFFF">&nbsp;</td>
    <td colspan="3">&nbsp;</td>
  </tr>
</table>
<? } ?>
</body>
</html>