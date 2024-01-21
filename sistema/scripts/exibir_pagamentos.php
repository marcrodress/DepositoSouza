<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body {
	background-color: #FFF;
	font:12px Arial, Helvetica, sans-serif;
}
body table{
	font:12px Arial, Helvetica, sans-serif;
	text-align:center;
	padding:5px;
	border-radius:5px;
	border:1px solid #999;
}
body table td{
	font:12px Arial, Helvetica, sans-serif;
	text-align:center;
	padding:5px;
	border-radius:5px;
	border:1px solid #999;
}
</style>
</head>

<body>
<? require "../../conexao.php"; ?>

<? if(@$_GET['acao'] == 'excluir'){ $carrinho = base64_decode($_GET['carrinho']);
	
	mysqli_query($conexao_bd, "DELETE FROM carrinho_pagamentos WHERE id = '".$_GET['id']."'");
	
	$sql_pagamentos = mysqli_query($conexao_bd, "SELECT * FROM carrinho_pagamentos WHERE code_carrinho = '$carrinho'");
	
	 if(mysqli_num_rows($sql_pagamentos) <=0){
		echo "Registro excluído com sucesso!<br><br><strong>Pressione F5 para mesclar a operação.</strong>";
		die;
	 }else{
		 $carrinho = $_GET['carrinho'];
		 echo "<script language='javascript'>window.location='exibir_pagamentos.php?carrinho=$carrinho';</script>";
	}
	
}?>


<?

$carrinho = base64_decode($_GET['carrinho']);

$sql_pagamentos = mysqli_query($conexao_bd, "SELECT * FROM carrinho_pagamentos WHERE code_carrinho = '$carrinho'");
if(mysqli_num_rows($sql_pagamentos) == ''){
	echo "Ainda não foi adicionado nenhum pagamento...";
}else{
?>
<table width="680" border="0">
  <tr>
    <td width="147" height="21" bgcolor="#669999"><strong>FORM. PAGT</strong></td>
    <td width="90" bgcolor="#669999"><strong>VALOR</strong></td>
    <td width="90" bgcolor="#669999"><strong>PARCELA</strong></td>
    <td width="144" bgcolor="#669999"><strong>VL. PARCELA</strong></td>
    <td width="88" bgcolor="#669999"><strong>VL. TOTAL</strong></td>
    <td width="95" bgcolor="#669999">&nbsp;</td>
  </tr>
  <? $i=0; while($res_pag = mysqli_fetch_array($sql_pagamentos)){ $i++; ?>
    <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td><? echo $res_pag['forma_pagamento']; ?></td>
    <td>R$ <? echo @number_format($res_pag['valor'],2,',','.'); ?></td>
    <td><? echo $res_pag['parcelas']; ?></td>
    <td>R$ <? echo @number_format($res_pag['vl_parcela'],2,',','.'); ?></td>
    <td>R$ <? echo @number_format($res_pag['vl_total'],2,',','.'); ?></td>
    <td><a href="?carrinho=<? echo $_GET['carrinho']; ?>&acao=excluir&id=<? echo $res_pag['id']; ?>"><img src="../img/excluir.jpg" width="20" height="20" title="Excluir pagamento" /></a></td>
  </tr>
  <? } ?>
</table>
<? } ?>
</body>
</html>
