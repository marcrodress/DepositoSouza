<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<?

$verifica_troco = 0;
$valor_informado = 0;

$valor_informado = base64_decode($valor_total);
$valor_total = base64_decode($valor_total)+0;
$verifica_troco = $valor_total-$valor_faltante;

if($verifica_troco <=0){
$valor_total = $valor_total+0;
$verifica_troco = 0;
}else{
$valor_total = ($valor_total-$verifica_troco)+0;
}


$sql_inseri_pagamento = mysqli_query($conexao_bd, "INSERT INTO carrinho_pagamentos (status, code_carrinho, ip, data_completa, dia, mes, ano, operador, cliente, forma_pagamento, parcelas, vl_parcela, vl_total, valor, code_dia, valor_informado, troco) VALUES ('Ativo', '$code_carrinho', '$ip', '$data_completa', '$dia', '$mes', '$ano', '$operador', '$cliente', 'DINHEIRO', '', '', '', '$valor_total', '$code_dia', '$valor_informado', '$verifica_troco')");

echo "<script language='javascript'>window.location='?pack=1';</script>";


?>
</body>
</html>