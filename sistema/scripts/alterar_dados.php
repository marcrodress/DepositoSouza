<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<script src="../../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body {
	background-color: #FFF;
	font:12px Arial, Helvetica, sans-serif;
}
body input{
	background-color: #FFF;
	font:12px Arial, Helvetica, sans-serif;
	border:1px solid #CCC;
	border-radius:4px;
	padding:5px;
}
body select{
	background-color: #FFF;
	font:12px Arial, Helvetica, sans-serif;
	border:1px solid #CCC;
	border-radius:4px;
	padding:5px;
}
#form1 table {
	font-weight: bold;
}
</style>
<? require "../../conexao.php"; ?>


</head>

<body>
<? if(isset($_POST['button'])){

$cpf = $_POST['cpf'];
$nome = $_POST['nome'];
$nascimento = $_POST['nascimento'];
$sexo = $_POST['sexo'];
$tipo_documento = $_POST['tipo_documento'];
$n_documento = $_POST['n_documento'];
$naturalidade = $_POST['naturalidade'];
$estado_civil = $_POST['estado_civil'];
$conjuge = $_POST['conjuge'];
$mae = $_POST['mae'];
$pai = $_POST['pai'];
$endereco = $_POST['endereco'];
$numero = $_POST['numero'];
$cep = $_POST['cep'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$estado = $_POST['estado'];
$telefone_1 = $_POST['telefone_1'];
$telefone_2 = $_POST['telefone_2'];
$telefone_3 = $_POST['telefone_3'];
$email1 = $_POST['email1'];
$email2 = $_POST['email2'];


	$sql_inseri = mysqli_query($conexao_bd, "UPDATE clientes SET cpf = '$cpf', nome = '$nome', nascimento = '$nascimento', sexo = '$sexo', tipo_documento = '$tipo_documento', n_documento = '$n_documento', naturalidade = '$naturalidade', estado_civil = '$estado_civil', conjuge = '$conjuge', mae = '$mae', pai = '$pai', endereco = '$endereco', numero = '$numero', cep = '$cep', bairro = '$bairro', cidade = '$cidade', estado = '$estado', telefone_1 = '$telefone_1', telefone_2 = '$telefone_2', telefone_3 = '$telefone_3', email1 = '$email1', email2 = '$email2' WHERE code = '".$_GET['cliente']."'");
	
	if($sql_inseri == ''){
		echo "<script language='javascript'>window.alert('Ocorreu um erro ao alterar dados do cliente, tente novamente!');</script>";
	}else{
		echo "<strong>Informações do cliente alterado com sucesso!</strong><br><br><em>Pressione F5 para mesclar a operação.</em>";
		die;
	}

}?>


<?

$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE code = '".$_GET['cliente']."'");
while($res_cliente = mysqli_fetch_array($sql_cliente)){
?>
<form id="form1" name="form1" method="post" action="">
  <table width="900" border="0">
    <tr>
      <td colspan="6" align="center"><h1 style="font:20px Arial, Helvetica, sans-serif;"><strong>ADICIONAR NOVO CLIENTE</strong></h1>
        <hr />
<h2 style="border:1px solid #000; padding:10px; color:#F00; text-align:center; border-radius:5px; width:300px;">Código do cliente:<br />
  <? echo $_GET['cliente']; ?></h2></td>
    </tr>
    <tr>
      <td colspan="6" align="left" bgcolor="#CCCCCC">CPF: 
        <label for="cpf"></label>
        <span id="sprytextfield9">
        <input name="cpf" type="text" id="cpf" size="30" value="<? echo $res_cliente['cpf']; ?>" />
</span></td>
    </tr>
    <tr>
      <td width="170">Nome</td>
      <td colspan="2">Data de nascimento</td>
      <td width="191">Sexo</td>
      <td width="143">Tipo de documento</td>
      <td width="197">N&ordm;. Documento</td>
    </tr>
    <tr>
      <td><label for="nome"></label>
        <span id="sprytextfield8">
        <input name="nome" type="text" id="nome" size="40" value="<? echo $res_cliente['nome']; ?>" />
      <span class="textfieldRequiredMsg">O nome do cliente &eacute; obrigat&oacute;rio.</span></span></td>
      <td colspan="2"><label for="nascimento"></label>
        <span id="sprytextfield1">
        <input type="text" name="nascimento" id="nascimento" value="<? echo $res_cliente['nascimento']; ?>" />
</span></td>
      <td><label for="sexo"></label>
        <select name="sexo" size="1" id="sexo">
          <option value="<? echo $res_cliente['sexo']; ?>"><? echo $res_cliente['sexo']; ?></option>
          <option value=""></option>
          <option value="Masculino">Masculino</option>
          <option value="Femenino">Femenino</option>
      </select></td>
      <td><label for="tipo_documento"></label>
        <select name="tipo_documento" size="1" id="tipo_documento">
          <option value="<? echo $res_cliente['tipo_documento']; ?>"><? echo $res_cliente['tipo_documento']; ?></option>
          <option value=""></option>
          <option value="RG">RG</option>
          <option value="CNH">CNH</option>
      </select></td>
      <td><label for="n_documento"></label>
      <input name="n_documento" type="text" id="n_documento" size="20" value="<? echo $res_cliente['n_documento']; ?>" /></td>
    </tr>
    <tr>
      <td>Naturalidade</td>
      <td colspan="2">Estado c&iacute;vil</td>
      <td>Conjuge</td>
      <td>Nome da m&atilde;e</td>
      <td>Nome do pai</td>
    </tr>
    <tr>
      <td><label for="naturalidade"></label>
      <input type="text" name="naturalidade" id="naturalidade" value="<? echo $res_cliente['naturalidade']; ?>" /></td>
      <td colspan="2"><label for="estado_civil"></label>
        <select name="estado_civil" size="1" id="estado_civil">
          <option value="<? echo $res_cliente['estado_civil']; ?>"><? echo $res_cliente['estado_civil']; ?></option>
          <option value=""></option>
          <option value="Solteiro">Solteiro</option>
          <option value="Casado">Casado</option>
          <option value="Divorciado">Divorciado</option>
          <option value="Vi&uacute;vo">Vi&uacute;vo</option>
      </select>        <label for="conjuge"></label></td>
      <td><label for="conjuge"></label>
      <input type="text" name="conjuge" id="conjuge" value="<? echo $res_cliente['conjuge']; ?>" /></td>
      <td><label for="mae"></label>
      <input name="mae" type="text" id="mae" size="30" value="<? echo $res_cliente['mae']; ?>" /></td>
      <td><label for="pai"></label>
      <input name="pai" type="text" id="pai" size="30" value="<? echo $res_cliente['pai']; ?>" /></td>
    </tr>
    <tr>
      <td>Endere&ccedil;o</td>
      <td width="88">N&ordm;.</td>
      <td width="85">CEP:</td>
      <td>Bairro</td>
      <td>Cidade</td>
      <td>Estado</td>
    </tr>
    <tr>
      <td><label for="endereco"></label>
      <input name="endereco" type="text" id="endereco" size="40" value="<? echo $res_cliente['endereco']; ?>" /></td>
      <td><label for="numero"></label>
      <input name="numero" type="text" id="numero" size="5" value="<? echo $res_cliente['numero']; ?>" /></td>
      <td><label for="cep"></label>
        <span id="sprytextfield2">
        <input type="text" name="cep" id="cep" value="<? echo $res_cliente['cep']; ?>" />
      <span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
      <td><label for="bairro"></label>
      <input type="text" name="bairro" id="bairro" value="<? echo $res_cliente['bairro']; ?>" /></td>
      <td><label for="cidade"></label>
      <input name="cidade" type="text" id="cidade" size="30" value="<? echo $res_cliente['cidade']; ?>" /></td>
      <td><label for="estado"></label>
      <input name="estado" type="text" id="cidade" size="30" value="<? echo $res_cliente['cidade']; ?>" /></td>
    </tr>
    <tr>
      <td>Telefone 1</td>
      <td colspan="2">Telefone 2</td>
      <td>Telefone 3</td>
      <td>E-mail</td>
      <td>E-mail 2:</td>
    </tr>
    <tr>
      <td><label for="telefone_1"></label>
        <span id="sprytextfield3">
        <input name="telefone_1" type="text" id="telefone_1" size="20" value="<? echo $res_cliente['telefone_1']; ?>" />
<span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
      <td colspan="2"><label for="telefone_2"></label>
        <span id="sprytextfield4">
        <input name="telefone_2" type="text" id="telefone_2" size="20" value="<? echo $res_cliente['telefone_2']; ?>" />
<span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
      <td><label for="telefone_3"></label>
        <span id="sprytextfield5">
        <input name="telefone_3" type="text" id="telefone_3" size="20" value="<? echo $res_cliente['telefone_3']; ?>" />
<span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
      <td><label for="email1"></label>
        <span id="sprytextfield6">
        <input name="email1" type="text" id="email1" size="30" value="<? echo $res_cliente['email1']; ?>" />
<span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
      <td><label for="email2"></label>
        <span id="sprytextfield7">
        <input name="email2" type="text" id="email2" size="30" value="<? echo $res_cliente['email2']; ?>" />
      <span class="textfieldInvalidFormatMsg">Invalid format.</span></span></td>
    </tr>
    <tr>
      <td align="center" colspan="6"><hr /><input style="width:100px; padding:5px; border:1px solid #000;" type="submit" name="button" id="button" value="Cadastrar" /></td>
    </tr>
  </table>
</form>
<? } ?>

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "date", {format:"dd/mm/yyyy", useCharacterMasking:true, isRequired:false});
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2", "custom", {isRequired:false, pattern:"00.000-000", useCharacterMasking:true});
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3", "custom", {pattern:"(00) 00000.0000", useCharacterMasking:true, isRequired:false});
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "custom", {useCharacterMasking:true, isRequired:false, pattern:"(00) 00000.0000"});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "custom", {pattern:"(00) 00000.0000", useCharacterMasking:true, isRequired:false});
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6", "email", {useCharacterMasking:true, isRequired:false});
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7", "email", {isRequired:false, useCharacterMasking:true});
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8");
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9", "custom", {useCharacterMasking:true, isRequired:false, pattern:"00000000000"});
</script>
</body>
</html>