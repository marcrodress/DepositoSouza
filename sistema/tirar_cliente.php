<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/tirar_cliente.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box_central">
<? 

mysqli_query($conexao_bd, "UPDATE carrinho SET cliente = '' WHERE code_carrinho = '$code_carrinho'");
echo "<script language='javascript'>window.location='?pack=1';</script>";

?>
</div><!-- box_central -->
</body>
</html>