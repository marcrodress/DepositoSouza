<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body {
	background-color: #FFF;
	text-align:center;
	font:12px Arial, Helvetica, sans-serif;
}
</style>
<? require "../../conexao.php"; ?>
</head>

<body>
<? if(isset($_POST['enviar'])){
	
$forma = $_POST['forma'];
$valor = $_POST['valor'];
$id_produto_carrinho = $_GET['id_produto_carrinho'];
$valor_desconto = 0;
$valor_total = 0;
$quantidade = 0;
$vl_unitario = 0;
$desconto = 0;

$sql_prod = mysqli_query($conexao_bd, "SELECT * FROM carrinho_produtos WHERE id = '$id_produto_carrinho'");
while($res_prod = mysqli_fetch_array($sql_prod)){
	$quantidade = $res_prod['quantidade'];
	$vl_unitario = $res_prod['vl_unitario'];
}

if($forma == '$'){
	$desconto = $valor;
	$valor_desconto = ($vl_unitario-$valor);
	$valor_total = $valor_desconto*$quantidade;
}else{
	$desconto = ($vl_unitario*($valor/100));
	$valor_desconto = $vl_unitario-(($vl_unitario*($valor/100)));
	$valor_total = $valor_desconto*$quantidade;
}

mysqli_query($conexao_bd, "UPDATE carrinho_produtos SET vl_unitario = '$valor_desconto', desconto = '$desconto', vl_total = '$valor_total' WHERE id = '$id_produto_carrinho'");

	echo "Desconto efetuado com sucesso!<br><br><strong>Pressione F5 para mesclar a operação.</strong>";
	die;

}?>
<form name="" method="post" action="" enctype="multipart/form-data">
<select style="font:15px Arial, Helvetica, sans-serif;" name="forma" size="1">
  <option value="$">$</option>
  <option value="%">%</option>
</select>
<input style="font:15px Arial, Helvetica, sans-serif;" type="text" name="valor" size="5" />
<input style="font:15px Arial, Helvetica, sans-serif;" type="submit" name="enviar" value="Confirmar" />
</form>
</body>
</html>