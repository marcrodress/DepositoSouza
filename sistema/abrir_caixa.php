<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/abrir_caixa.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#box_central table tr td {
	font-weight: bold;
}
</style>
</head>

<body>
<div id="box_central">
 <h1 style="font:18px Arial, Helvetica, sans-serif; margin:5px;"><strong>Abertura de caixa</strong></h1>
 <hr />
 
<?
$sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM abertura_caixa WHERE operador = '$operador' AND data = '$data' AND status = 'Ativo'");
if(mysqli_num_rows($sql_verifica) >= 1){
	echo "<script language='javascript'>window.location='?pack=1';<script>";
}
?> 
 
 
<? if(isset($_POST['button'])){

$nota100 = $_POST['nota100'];
$nota50 = $_POST['nota50'];
$nota20 = $_POST['nota20'];
$nota10 = $_POST['nota10'];
$nota5 = $_POST['nota5'];
$nota2 = $_POST['nota2'];
$moeda1 = $_POST['moeda1'];
$moeda50 = $_POST['moeda50'];
$moeda25 = $_POST['moeda25'];
$moeda10 = $_POST['moeda10'];
$moeda05 = $_POST['moeda05'];
$saldo_maquina = $_POST['saldo_maquina'];

$abrir = mysqli_query($conexao_bd, "INSERT INTO abertura_caixa (dia, mes, ano, data, data_completa, ip, status, operador, nota100, nota50, nota20, nota10, nota5, nota2, moeda1, moeda50, moeda25, moeda10, moeda05, saldo_maquina) VALUES ('$dia', '$mes', '$ano', '$data', '$data_completa', '$ip', 'Ativo', '$operador', '$nota100', '$nota50', '$nota20', '$nota10', '$nota5', '$nota2', '$moeda1', '$moeda50', '$moeda25', '$moeda10', '$moeda05', '$saldo_maquina')");
if($abrir == ''){
echo "<script language='javascript'>window.alert('Ocorreu um erro, por favor, tente novamente!');</script>";
}else{
echo "<script language='javascript'>window.location='?pack=1';</script>";
}
}?>
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="990" border="0">
  <tr>
    <td colspan="6" bgcolor="#999999">PREENCHA OS DADOS CORRETAMENTE</td>
  </tr>
  <tr>
    <td bgcolor="#EEFFB9">Notas de R$ 100,00</td>
    <td bgcolor="#EEFFB9">Notas de R$ 50,00</td>
    <td bgcolor="#EEFFB9">Notas de R$ 20,00</td>
    <td bgcolor="#EEFFB9">Notas de R$ 10,00</td>
    <td bgcolor="#EEFFB9">Nota de R$ 5,00</td>
    <td bgcolor="#EEFFB9">Notas de R$ 2,00</td>
  </tr>
  <tr>
    <td><label for="nota100"></label>
      <input name="nota100" type="text" id="nota100" size="5" /></td>
    <td><input name="nota50" type="text" id="nota50" size="5" /></td>
    <td><input name="nota20" type="text" id="nota20" size="5" /></td>
    <td><input name="nota10" type="text" id="nota10" size="5" /></td>
    <td><input name="nota5" type="text" id="nota5" size="5" /></td>
    <td><input name="nota2" type="text" id="nota2" size="5" /></td>
  </tr>
  <tr>
    <td bgcolor="#EEFFB9">Moedas de R$ 1,00 </td>
    <td bgcolor="#EEFFB9">Moedas de R$ 0,50</td>
    <td bgcolor="#EEFFB9">Moedas de 0,25</td>
    <td bgcolor="#EEFFB9">Moedas de 0,10</td>
    <td bgcolor="#EEFFB9">Moedas de R$ 0,05</td>
    <td bgcolor="#EEFFB9">Saldo da maquina</td>
  </tr>
  <tr>
    <td><input name="moeda1" type="text" id="moeda1" size="5" /></td>
    <td><input name="moeda50" type="text" id="moeda50" size="5" /></td>
    <td><input name="moeda25" type="text" id="moeda25" size="5" /></td>
    <td><input name="moeda10" type="text" id="moeda10" size="5" /></td>
    <td><input name="moeda05" type="text" id="moeda05" size="5" /></td>
    <td><input name="saldo_maquina" type="text" id="saldo_maquina" size="5" /></td>
  </tr>
  <tr>
    <td colspan="6"><input type="submit" name="button" id="button" value="Abrir caixa"></td>
  </tr>
</table> 
</form>
</div><!-- box_central -->
</body>
</html>