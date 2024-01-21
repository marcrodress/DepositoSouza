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
body table{
	border:1px solid #000;
	border-radius:5px;
}
#form1 table tr td {
	font-weight: bold;
}
</style>
<? require "../../conexao.php"; ?>
</head>

<body>
<? if(isset($_POST['button'])){

$quantidade = $_POST['quantidade'];
$motivo = $_POST['motivo'];
$descricao = $_POST['descricao'];
$estoque = $_GET['estoque'];
$produto = $_GET['produto'];
$operador = $_GET['operador'];
$valor = $_POST['valor'];

if($quantidade > $estoque){
 echo "<script language='javascript'>window.alert('A quantidade perdida informada é maior que o estoque atual!');</script>";
}else{
	$estoque = $estoque-$quantidade;
	$valor = $valor*$quantidade;
	mysqli_query($conexao_bd, "INSERT INTO perdas (data, operador, produto, valor, motivo, descricao) VALUES ('$data_completa', '$operador', '$produto', '$valor', '$motivo', '$descricao')");
	
	mysqli_query($conexao_bd, "UPDATE produtos SET estoque = '$estoque' WHERE code = '".$_GET['produto']."'");
	
	echo "
	
	<strong>Informação registrada com sucesso!</strong><br><br>
	<em>Pressione F5 para mesclar a operação.</em>
	
	";
	
	die;
	
}
}?>





<?
$sql = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE code = '".$_GET['produto']."'");
 while($res = mysqli_fetch_array($sql)){
?>
<form id="form1" name="form1" method="post" action="">
<input type="hidden" name="valor" value="<? echo $res['valor_venda']; ?>" />
  <table width="400" border="0">
    <tr>
      <td><h1 style="font:15px Arial, Helvetica, sans-serif; margin:0; padding:0; color:#09C; text-align:center;"><strong><? echo $res['titulo'] ?></strong></h1>
      <hr /></td>
    </tr>
    <tr>
      <td>Quantidade</td>
    </tr>
    <tr>
      <td><label for="quantidade"></label>
      <input name="quantidade" type="number" id="quantidade" style="font:12px Arial, Helvetica, sans-serif; text-align:center; border:1px solid #000; border-radius:5px; padding:5px; color:#F00;" value="1" size="5" maxlength="2" autofocus /></td>
    </tr>
    <tr>
      <td>Motivo</td>
    </tr>
    <tr>
      <td><label for="motivo"></label>
        <select style="font:12px Arial, Helvetica, sans-serif; text-align:center; border:1px solid #000; border-radius:5px; padding:5px; color:#F00;" name="motivo" size="1" id="motivo">
          <option value="PRODUTO DANIFICADO">PRODUTO DANIFICADO</option>
          <option value="OUTROS">OUTROS</option>
      </select></td>
    </tr>
    <tr>
      <td>Descreva os motivos da perda</td>
    </tr>
    <tr>
      <td><label for="descricao"></label>
      <textarea style="font:12px Arial, Helvetica, sans-serif; text-align:center; border:1px solid #000; border-radius:5px; padding:5px; color:#F00;" name="descricao" id="descricao" cols="45" rows="5"></textarea></td>
    </tr>
    <tr>
      <td><input style="font:12px Arial, Helvetica, sans-serif; text-align:center; border:1px solid #000; border-radius:5px; padding:5px; color:#F00;" type="submit" name="button" id="button" value="Enviar" /></td>
    </tr>
  </table>
</form>
<? } ?>
</body>
</html>