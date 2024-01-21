<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<style type="text/css">
body {
	background-color: #FFF;
	font:12px Arial, Helvetica, sans-serif;
	text-align:center;
}
</style>
<? require "../../conexao.php"; ?>
</head>

<body>
<? if(isset($_POST['button'])){

$valor_total = $_POST['valor_total'];

		$verifica_ponto = 0;
		for($i=0; $i<strlen($_POST['valor_total']); $i++){
			if($_POST['valor_total'][$i] == '.'){
				$verifica_ponto = 1;
			}
		}

if($verifica_ponto == 1){
echo "<script language='javascript'>window.alert('Não utilize pontos, apenas utilize virgula para separar os centavos. EX: 100,35');</script>";
}else{
$valor_total = str_replace(',','.',$valor_total);	

$verifica_letra = 0;
$valor_total = base64_encode($valor_total);
require "verifica_valor.php";	
  require "verifica_valor.php";
  if($verifica_letra == 1){
	echo "<script language='javascript'>window.alert('Só é aceitamos números!');</script>";
  }else{
$valor_total = base64_decode($valor_total);	
	
mysqli_query($conexao_bd, "UPDATE produtos SET valor_venda = '$valor_total' WHERE id = '".$_GET['id']."'");
echo "Valor atualizado com sucesso!<br><br>Pressione F5.";
die;
  }
 }
}?>
<form id="form1" name="form1" method="post" action="">
  <input style="border:1px solid #000; text-align:center; font:15px Arial, Helvetica, sans-serif; color:#00F; border-radius:5px; padding:5px;" value="<? echo number_format((float)$_GET['valor_venda'], 2, ',', ''); ?>" name="valor_total" type="text" id="estoque" size="7" />
  <input style="border:1px solid #000; border-radius:5px; padding:5px;" type="submit" name="button" id="button" value="Enviar" />
</form>
</body>
</html>