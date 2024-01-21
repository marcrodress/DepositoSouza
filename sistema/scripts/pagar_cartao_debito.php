<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body {
	background-color: #FFF;
}
body table{
	margin:-5px 0 0 3px;
}
body table td{
	font:13px Arial, Helvetica, sans-serif;
	padding:5px;
	margin:0 0 0 ;
	border:1px solid #CCC;
	border-radius:5px;
}
</style>
</head>

<body>
<h1 style="font:20px Arial, Helvetica, sans-serif; margin:0 0 0 60px; color:#06C;"><strong>Pagamento com cartão de débito</strong></h1>
<form name="" method="post" action="" enctype="multipart/form-data">
 <select style="width:275px; font:30px Arial, Helvetica, sans-serif; margin:5px; padding:5px;" name="bandeira" size="1">
   <option value="MASTERCARD">MASTERCARD</option>
   <option value="VISA">VISA</option>
   <option value="ELO">ELO</option>
   <option value="OUTROS">OUTROS</option>
 </select>
 <input style="width:148px; text-align:center; color:#00F; font:30px Arial, Helvetica, sans-serif; margin:5px; padding:5px;" type="submit" name="parcela" value="Confirmar" autofocus />
</form>
<? if(isset($_POST['parcela'])){
	
 $bandeira = $_POST['bandeira'];
 
$valor = base64_decode($_GET['valor']);
@$pontos = array(",", ".");
@$valor = str_replace($pontos, ".", $valor);

$sql_inseri_pagamento = mysqli_query($conexao_bd, "INSERT INTO carrinho_pagamentos (status, code_carrinho, ip, data_completa, dia, mes, ano, operador, cliente, forma_pagamento, parcelas, vl_parcela, vl_total, valor, code_dia, valor_informado, troco) VALUES ('Ativo', '$code_carrinho', '$ip', '$data_completa', '$dia', '$mes', '$ano', '$operador', '$cliente', 'CARTAO DE DEBITO', '', '', '', '$valor', '$code_dia', '', '')");

echo "<script language='javascript'>window.location='?pack=1';</script>";		 
 
}?>
<hr />

<?
$valor = base64_decode($_GET['valor']);
@$pontos = array(",", ".");
@$valor = str_replace($pontos, ".", $valor);
?>
<table width="445" border="0">
  <tr>
    <td colspan="3" align="center"><h2 style="font:15px Arial, Helvetica, sans-serif; color:#000; padding:0; margin:0;"><strong>VALOR: R$ <? echo number_format($valor,2,',','.'); ?></strong></h2></td>
  </tr>
  <tr>
    <td width="65" bgcolor="#999999">&nbsp;</td>
    <td width="176" bgcolor="#999999"><strong>VALOR DA PARCELA</strong></td>
    <td width="145" align="center" bgcolor="#999999"><strong> TOTAL</strong></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#DDEEFF">1 X</td>
    <td bgcolor="#DDEEFF">R$ <? echo number_format($valor,2,',','.'); ?></td>
    <td align="center" bgcolor="#DDEEFF">R$ <? echo number_format($valor,2,',','.'); ?></td>
  </tr>
</table>

</body>
</html>