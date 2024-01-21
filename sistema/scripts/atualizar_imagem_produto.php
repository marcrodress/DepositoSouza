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

$url = $_POST['url'];
mysqli_query($conexao_bd, "UPDATE produtos SET foto = '$url' WHERE id = '".$_GET['id']."'");
echo "Imagem atualizada com sucesso!<br><br>Pressione F5.";
die;
}?>
<form id="form1" name="form1" method="post" action="">
  <input style="border:1px solid #000; text-align:center; font:15px Arial, Helvetica, sans-serif; color:#00F; border-radius:5px; padding:5px;" value="<? echo $_GET['url']; ?>" name="url" type="text" id="estoque" size="30" />
  <input style="border:1px solid #000; border-radius:5px; padding:5px;" type="submit" name="button" id="button" value="Enviar" />
</form>
</body>
</html>