<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title></title>
</head>

<body>
<? 

$conexao_bd = @mysqli_connect("localhost","ikulyco1_vesteprime","Rcbv896xw*+-","ikulyco1_depositosousa") or die(mysql_error()); 



	$data_completa = date("d/m/Y H:i:s");
	$data = date("d/m/Y");
	$dia = date("d");
	$d = date("d");
	$mes = date("m");
	$hora = date("H:i:s");
	$apenas_hora = date("H");
	$m = date("m");
	$ano = date("Y");
	$a = date("Y");
	$ip = $_SERVER['REMOTE_ADDR'];
	
	mysqli_query($conexao_bd, "DELETE FROM carrinho WHERE dia != '$dia' AND status != 'ENCERRADO'");


?>
</body>
</html>