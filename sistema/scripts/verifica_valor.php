<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<?php
$valor_total = base64_decode($valor_total);
@$pontos = array(",", ".");
@$valor_total = str_replace($pontos, ".", $valor_total);

if(!is_numeric($valor_total)) {
	if($valor_total[0] == '%'){
    $verifica_letra = 0;
	}else{
    $verifica_letra = 1;
	}
}
	$valor_total = base64_encode($valor_total);
?>
</body>
</html>