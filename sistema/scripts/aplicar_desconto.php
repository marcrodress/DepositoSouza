<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<?

$valor_total = base64_decode($valor_total);
$valor_desconto = 0;

$verifica_percentual = 0;
if($valor_total[0] == '%'){
		$verifica_percentual = 1;
}
if((("".$valor_total[1]."".$valor_total[2]."")+0) > 100){
echo "<script language='javascript'>window.alert('O valor máximo do desconto é 100%');</script>";
}else{

if($verifica_percentual == 1){
	$verifica_percentual = (("".$valor_total[1]."".$valor_total[2]."")+0)/100;
	$valor_desconto = $valor_faltante*$verifica_percentual;
}else{
	$valor_desconto = $valor_total;
}


$sql_inseri_pagamento = mysqli_query($conexao_bd, "INSERT INTO carrinho_pagamentos (status, code_carrinho, ip, data_completa, dia, mes, ano, operador, cliente, forma_pagamento, parcelas, vl_parcela, vl_total, valor, code_dia, valor_informado, troco) VALUES ('Ativo', '$code_carrinho', '$ip', '$data_completa', '$dia', '$mes', '$ano', '$operador', '$cliente', 'DESCONTO', '', '', '', '$valor_desconto', '$code_dia', '', '')");

echo "<script language='javascript'>window.location='?pack=1';</script>";

}
?>
</body>
</html>