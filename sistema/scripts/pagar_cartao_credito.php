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
<form name="" method="post" action="" enctype="multipart/form-data">
 <select style="width:352px; font:30px Arial, Helvetica, sans-serif; margin:5px; padding:5px;" name="bandeira" size="1">
   <option value="MASTERCARD">MASTERCARD</option>
   <option value="VISA">VISA</option>
   <option value="ELO">ELO</option>
   <option value="HIPERCARD">HIPERCARD</option>
   <option value="AMERICAN EXPRESS">AMERICAN EXPRESS</option>
   <option value="FORTBRASIL">FORTBRASIL</option>
   <option value="OUTROS">OUTROS</option>
 </select>
 <input style="width:58px; text-align:center; color:#00F; font:30px Arial, Helvetica, sans-serif; margin:5px; padding:5px;" type="number" name="parcela" value="1" autofocus />
</form>
<? if(isset($_POST['parcela'])){
	
 $bandeira = $_POST['bandeira'];
 $parcela = $_POST['parcela'];
 
$valor = base64_decode($_GET['valor']);
@$pontos = array(",", ".");
@$valor = str_replace($pontos, ".", $valor);
 
 if($parcela <=0 || $parcela >12){
	echo "<script language='javascript'>window.alert('O número de parcelas deve está entre 1 e 12');</script>";		 
 }else{

$vl_parcela = 0;
$vl_total = 0;
if($parcela == 1){
$vl_parcela = $valor;
$vl_total = $valor;
}else{
$vl_total = $valor+($valor*0.0532)+(0.0135*$parcela*$valor);	
$vl_parcela = $valor+($valor*0.0532)+(0.0135*$parcela*$valor);	
$vl_parcela = $vl_parcela/$parcela;
}
$sql_inseri_pagamento = mysqli_query($conexao_bd, "INSERT INTO carrinho_pagamentos (status, code_carrinho, ip, data_completa, dia, mes, ano, operador, cliente, forma_pagamento, parcelas, vl_parcela, vl_total, valor, code_dia, valor_informado, troco) VALUES ('Ativo', '$code_carrinho', '$ip', '$data_completa', '$dia', '$mes', '$ano', '$operador', '$cliente', 'CARTAO DE CREDITO', '$parcela', '$vl_parcela', '$vl_total', '$valor', '$code_dia', '', '')");

echo "<script language='javascript'>window.location='?pack=1';</script>";		 
 }

}?>

<?
$valor = base64_decode($_GET['valor']);
@$pontos = array(",", ".");
@$valor = str_replace($pontos, ".", $valor);
?>
<table width="400" border="0">
  <tr>
    <td colspan="3" align="center"><h2 style="font:15px Arial, Helvetica, sans-serif; color:#000; padding:0; margin:0;"><strong>VALOR: R$ <? echo number_format($valor,2,',','.'); ?></strong></h2></td>
  </tr>
  <tr>
    <td width="65" bgcolor="#999999">&nbsp;</td>
    <td width="176" bgcolor="#999999"><strong>VALOR DA PARCELA</strong></td>
    <td width="145" bgcolor="#999999"><strong> TOTAL</strong></td>
  </tr>
<? $k = 1; for($i=1; $i<=4; $i++){ $k++;?>
  <tr <? if($k%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td align="center" bgcolor="#DDEEFF"><strong><? echo $i; ?> X</strong></td>
    <td bgcolor="#DDEEFF"><strong>R$ <? echo number_format($valor/$i,2,',','.'); ?></strong></td>
    <td align="center" bgcolor="#DDEEFF"><strong>R$ <? echo number_format($valor,2,',','.'); ?></strong></td>
  </tr>
<? } ?>
<? for($i=5; $i<=12; $i++){ $k++;?>
  <tr <? if($k%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td align="center";><? echo $i; ?> X</td>
    <td align="left"; >R$ <? $parcela = $valor+($valor*0.0532)+(0.0135*$i*$valor); echo number_format($parcela/$i,2,',','.'); ?></td>
    <td align="center">R$ <? echo number_format($parcela,2,',','.'); ?></td>
  </tr>
<? } ?>
</table>

</body>
</html>