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

<? if(@$_GET['p'] == ''){ ?>
<? if(isset($_POST['button'])){
$categoria = $_POST['categoria'];
$id = $_GET['id'];
	
mysqli_query($conexao_bd, "UPDATE produtos SET categoria = '$categoria' WHERE id = '$id'");
echo "<script language='javascript'>window.alert('Categória atulizada com sucesso! Aproveite e selecione a sub-categória desse produto!');window.location='?categoria=$categoria&subcategoria=&p=1&id=$id';</script>";
}?>
<form id="form1" name="form1" method="post" action="">
  <select style="border:1px solid #000; border-radius:5px; padding:5px; width:200px;" name="categoria" size="1">
   <?
    $sql_categoria = mysqli_query($conexao_bd, "SELECT * FROM categorias WHERE code = '".$_GET['categoria']."'");
	 while($res = mysqli_fetch_array($sql_categoria)){
   ?>
    <option value="<? echo $res['code']; ?>"><? echo $res['categoria']; ?></option>
   <? } ?>


   <?
    $sql_categoria = mysqli_query($conexao_bd, "SELECT * FROM categorias WHERE code != '".$_GET['categoria']."'");
	 while($res = mysqli_fetch_array($sql_categoria)){
   ?>
    <option value="<? echo $res['code']; ?>"><? echo $res['categoria']; ?></option>
   <? } ?>
  </select>
  <input style="border:1px solid #000; border-radius:5px; padding:5px;" type="submit" name="button" id="button" value="Enviar" />
</form>
<? } ?>

<? if(@$_GET['p'] == '1'){ ?>
<? if(isset($_POST['button'])){
$subcategoria = $_POST['subcategoria'];
$id = $_GET['id'];
	
mysqli_query($conexao_bd, "UPDATE produtos SET subcategoria = '$subcategoria' WHERE id = '$id'");
echo "Informação atualizada com sucesso!<br><em>Pressione F5.<em>";
}?>
<form id="form1" name="form1" method="post" action="">
  <select style="border:1px solid #000; border-radius:5px; padding:5px; width:200px;" name="subcategoria" size="1">
   <?
    $sql_categoria = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE id = '".$_GET['id']."'");
	 while($res = mysqli_fetch_array($sql_categoria)){
    $sql_subcategoria = mysqli_query($conexao_bd, "SELECT * FROM subcategorias WHERE code = '".$res['subcategoria']."'");
	 while($res = mysqli_fetch_array($sql_subcategoria)){
   ?>
    <option value="<? echo $res['code']; ?>"><? echo $res['subcategoria']; ?></option>
   <? }} ?>


   <?
    $sql_categoria = mysqli_query($conexao_bd, "SELECT * FROM subcategorias WHERE categoria = '".$_GET['categoria']."'");
	 while($res = mysqli_fetch_array($sql_categoria)){
   ?>
    <option value="<? echo $res['code']; ?>"><? echo $res['subcategoria']; ?></option>
   <? } ?>
  </select>
  <input style="border:1px solid #000; border-radius:5px; padding:5px;" type="submit" name="button" id="button" value="Enviar" />
</form>
<? } ?>
</body>
</html>