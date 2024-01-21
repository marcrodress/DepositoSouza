<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<? $code_dia15 = 0;
if($tipo_filtro == 'em_dia'){
$code_dia15 = $code_dia-16;
}else{
$code_dia15 = $code_dia-30;
}

$soma = 0;
$sql = mysqli_query($conexao_bd, "SELECT * FROM historico_creditos WHERE code_dia BETWEEN '$code_dia15' AND '$code_dia'");
if(mysqli_num_rows($sql) == ''){
	echo "<h1 style='margin:10px; font:12px Arial;'><strong>Não foram encontrados registros para o filtro selecionado!</strong></h1><br>";
}else{
?>
<table width="990" border="0">
  <tr>
    <td colspan="7">Foram encontrados <? echo mysqli_num_rows($sql); ?> registros para o filtro selecionado</td>
  </tr>
  <tr>
    <td width="103" bgcolor="#66CC00">DATA</td>
    <td width="108" bgcolor="#66CC00">COD. CLIENTE</td>
    <td width="92" bgcolor="#66CC00">OPERADOR</td>
    <td width="289" bgcolor="#66CC00">NOME DO CLIENTE</td>
    <td width="131" bgcolor="#66CC00">CPF DO CLIENTE</td>
    <td width="73" bgcolor="#66CC00">VALOR</td>
    <td width="164" bgcolor="#66CC00">FORMA</td>
  </tr>
  <? $i=0; while($res = mysqli_fetch_array($sql)){ $i++; $soma = $soma+$res['valor']; ?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td><h1 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;"><? echo $res['data']; ?></h1></td>
    <td><h1 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;"><? echo $res['cliente']; ?></h1></td>
    <td><h1 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;"><? echo $res['operador']; ?></h1></td>
    <td><h1 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;"><? 
	 
	 $sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE code = '".$res['cliente']."'");
	 	while($res_cliente = mysqli_fetch_array($sql_cliente)){
			echo $res_cliente['nome'];
	 ?></h1></td>
    <td><h1 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;"><? echo $res_cliente['cpf']; }?></h1></td>
    <td><h1 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;">R$ <? echo number_format($res['valor'],2,',','.'); ?></h1></td>
    <td><h1 style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;"><? echo $res['forma_pagamento']; ?></h1></td>
  </tr>
  <? } ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td colspan="2" align="right">Valor total recebido</td>
    <td bgcolor="#009966"><span style="font:12px Arial, Helvetica, sans-serif; padding:0; margin:0;">R$ <? echo number_format($soma,2,',','.'); ?></span></td>
    <td>&nbsp;</td>
  </tr>
</table>
<? } ?>
</body>
</html>