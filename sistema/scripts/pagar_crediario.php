<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>

<?

$valor_total = base64_decode($_GET['valor']);
@$pontos = array(",", ".");
@$valor_total = str_replace($pontos, ".", $valor_total);

$sql_inseri_pagamento = mysqli_query($conexao_bd, "INSERT INTO carrinho_pagamentos (status, code_carrinho, ip, data_completa, dia, mes, ano, operador, cliente, forma_pagamento, parcelas, vl_parcela, vl_total, valor, code_dia, valor_informado, troco) VALUES ('Ativo', '$code_carrinho', '$ip', '$data_completa', '$dia', '$mes', '$ano', '$operador', '$cliente', 'CREDIARIO', '', '', '', '$valor_total', '$code_dia', '', '')");

$saldo_devedor = $saldo_devedor+$valor_total;

mysqli_query($conexao_bd, "UPDATE clientes SET saldo = '$saldo_devedor', code_ultima_compra = '$code_dia' WHERE code = '$cliente'");

mysqli_query($conexao_bd, "INSERT INTO historico_debitos (dia, mes, ano, data, data_completa, ip, cliente, operador, valor, code_carrinho, code_dia) VALUES ('$dia', '$mes', '$ano', '$data', '$data_completa', '$ip', '$cliente', '$operador', '$valor_total', '$code_carrinho', '$code_dia')");

echo "<script language='javascript'>window.location='?pack=1';</script>";

?>
</body>
</html>