<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/produto_associado.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box">
<? require "../../conexao.php"; ?>
<form name="" method="post" action="" enctype="multipart/form-data">
<input type="text" name="code_barras" />
<input class="input1" type="submit" name="enviar" value="Buscar" />
</form>

<? if(isset($_POST['enviar'])){
	
$code_barras = $_POST['code_barras'];
$produto_original = $_GET['produto'];

if($code_barras == $produto_original){
 	 echo "<script language='javascript'>window.alert('Código já cadastrado como principal!');</script>";
}else{

$sql_1 = mysqli_query($conexao_bd, "SELECT * FROM codigos_associados WHERE codigo_barras = '$code_barras'");
 if(mysqli_num_rows($sql_1) == ''){
	 mysqli_query($conexao_bd, "INSERT INTO codigos_associados (produto_original, codigo_barras) VALUES ('$produto_original', '$code_barras')");
 	 echo "<script language='javascript'>window.alert('Cadastrado feito com sucesso!');</script>";
 }else{
 	 echo "<script language='javascript'>window.alert('Código já cadastrado!');</script>";
	}
}

}?>

</div><!-- box -->
</body>
</html>