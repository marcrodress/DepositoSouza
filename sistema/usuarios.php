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
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box_central">
 <h1 style="font:18px Arial, Helvetica, sans-serif; margin:5px;"><strong>Usuários autorizados</strong></h1>
<br />
<? if(@$_GET['p'] == 'cadastrar'){ ?>
<? if(isset($_POST['button'])){

$code_user = $_POST['code_user'];
$nome_novo = $_POST['nome'];
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$repita_senha = $_POST['repita_senha'];
$cpf_novo = $_POST['cpf'];
$profissao = $_POST['profissao'];
$acesso = $_POST['acesso'];

if($senha != $repita_senha){
	echo "<script language='javascript'>window.alert('As senhas digitadas não conferem!');</script>";
}else{
 $sql = mysqli_query($conexao_bd, "SELECT * FROM adm WHERE cpf = '$cpf_novo'");
 if(mysqli_num_rows($sql) >= 1){
	 echo "<script language='javascript'>window.alert('Já existe um cadastro efetuado com esse CPF!');window.location='?pack=40&p=';</script>";
 }else{
 
	$sql_verifica = mysqli_query($conexao_bd, "INSERT INTO adm (status, data, cod, login, cpf, senha, nome, tipo, profissao, senha_autorizacao) VALUES ('Ativo', '".date("d/m/Y")."', '$code_user', '$usuario', '$cpf_novo', '$senha', '$nome_novo', '$acesso', '$profissao', '')");
	if($sql_verifica == ''){
	 echo "<script language='javascript'>window.alert('Ocorreu um erro ao cadastrar, tente novamente!');</script>";
	}else{
	 echo "<script language='javascript'>window.alert('Cadastro efetuado com sucesso!');window.location='?pack=40&p=';</script>";
	}
 }
}

}?>
<form name="" method="post" action="" enctype="multipart/form-data">
<? $code_user = rand()+date("s")+date("d")*date("s")+rand(); ?>
<input type="hidden" name="code_user" value="<? echo $code_user; ?>" />
<table width="1000" border="0">
  <tr>
    <td colspan="4" bgcolor="#ECECFF">FORMULÁRIO DE CADASTRO DO USUÁRIO AO SISTEMA</td>
  </tr>
  <tr>
    <td width="158" bgcolor="#99CC00">COD.</td>
    <td width="303" bgcolor="#99CC00">Nome</td>
    <td width="346" bgcolor="#99CC00">Usuário</td>
    <td width="175" bgcolor="#FF9900">Senha</td>
    </tr>
  <tr>
    <td><label for="textfield"></label>
    <input name="code_user" type="text" disabled="disabled" id="textfield" value="<? echo @$code_user; ?>" size="10"></td>
    <td><label for="nome"></label>
      <span id="sprytextfield1">
      <input name="nome" type="text" id="nome" size="30" value="<? echo @$nome_novo; ?>" />
      </span></td>
    <td><label for="usuario"></label>
      <span id="sprytextfield2">
      <input name="usuario" type="text" id="usuario" size="15" value="<? echo @$usuario; ?>" />
      </span></td>
    <td bgcolor="#FF9900"><label for="senha"></label>
      <span id="sprytextfield3">
      <input name="senha" type="password" id="senha" size="10" />
      </span></td>
    </tr>
  <tr>
    <td bgcolor="#99CC00">CPF</td>
    <td bgcolor="#99CC00">Profiss&atilde;o</td>
    <td bgcolor="#99CC00">Tipo de acesso</td>
    <td bgcolor="#FF9900">Digite a senha novamente</td>
    </tr>
  <tr>
    <td><span id="sprytextfield4">
    <input name="cpf" type="text" id="cpf" value="<? echo @$cpf_novo; ?>" size="15" maxlength="11" />
    </span></td>
    <td><span id="sprytextfield5">
      <input name="profissao" type="text" id="profissao" value="<? echo @$profissao; ?>" size="30" />
    </span></td>
    <td><select name="acesso" size="1" id="acesso">
      <option value="<? echo @$acesso; ?>"><? echo @$acesso; ?></option>
      <option value="ADM">ADM</option>
      <option value="FUNCIONARIO">FUNCIONARIO</option>
    </select></td>
    <td bgcolor="#FF9900"><span id="sprytextfield6">
      <input name="repita_senha" type="password" id="repita_senha" size="10" />
    </span></td>
    </tr>
  <tr>
    <td colspan="4"><input type="submit" name="button" id="button" value="Cadastrar" /></td>
  </tr>
</table>
</form>
<? } ?>







<? if(@$_GET['p'] == 'editar'){ ?>
<? if(isset($_POST['button'])){

$code_user = $_POST['code_user'];
$nome_novo = $_POST['nome'];
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$repita_senha = $_POST['repita_senha'];
$profissao = $_POST['profissao'];
$acesso = $_POST['acesso'];

if($senha != $repita_senha){
	echo "<script language='javascript'>window.alert('As senhas digitadas não conferem!');</script>";
}else{
	$sql_verifica = mysqli_query($conexao_bd, "UPDATE adm SET login = '$usuario', senha = '$senha', nome = '$nome_novo', tipo = '$acesso', profissao = '$profissao' WHERE id = '".$_GET['id']."'");
	if($sql_verifica == ''){
	 echo "<script language='javascript'>window.alert('Ocorreu um erro ao atualizar, tente novamente!');</script>";
	}else{
	 echo "<script language='javascript'>window.alert('Atualização efetuada com sucesso!');window.location='?pack=40&p=';</script>";
 }
}

}?>
<form name="" method="post" action="" enctype="multipart/form-data">
<?

$sql_edita = mysqli_query($conexao_bd, "SELECT * FROM adm WHERE id = '".$_GET['id']."'");
 while($res_edita = mysqli_fetch_array($sql_edita)){
?>
<input type="hidden" name="code_user" value="<? echo $res_edita['cod']; ?>" />
<table width="1000" border="0">
  <tr>
    <td colspan="4" bgcolor="#ECECFF">FORMULÁRIO DE ATUALIZA&Ccedil;&Atilde;O DO USUÁRIO AO SISTEMA</td>
  </tr>
  <tr>
    <td width="158" bgcolor="#99CC00">COD.</td>
    <td width="303" bgcolor="#99CC00">Nome</td>
    <td width="346" bgcolor="#99CC00">Usuário</td>
    <td width="175" bgcolor="#FF9900">Senha</td>
    </tr>
  <tr>
    <td><label for="textfield"></label>
    <input name="code_user" type="text" disabled="disabled" id="textfield" value="<? echo $res_edita['cod']; ?>" size="10"></td>
    <td><label for="nome"></label>
      <span id="sprytextfield1">
      <input name="nome" type="text" id="nome" size="30" value="<? echo $res_edita['nome']; ?>" />
      </span></td>
    <td><label for="usuario"></label>
      <span id="sprytextfield2">
      <input name="usuario" type="text" id="usuario" size="15" value="<? echo $res_edita['login']; ?>" />
      </span></td>
    <td bgcolor="#FF9900"><label for="senha"></label>
      <span id="sprytextfield3">
      <input name="senha" type="password" id="senha" size="10" value="<? echo $res_edita['senha']; ?>" />
      </span></td>
    </tr>
  <tr>
    <td bgcolor="#99CC00">CPF</td>
    <td bgcolor="#99CC00">Profiss&atilde;o</td>
    <td bgcolor="#99CC00">Tipo de acesso</td>
    <td bgcolor="#FF9900">Digite a senha novamente</td>
    </tr>
  <tr>
    <td><span id="sprytextfield4">
    <input name="cpf" type="text" disabled="disabled" id="cpf" value="<? echo $res_edita['cpf']; ?>" size="15" maxlength="11" />
    </span></td>
    <td><span id="sprytextfield5">
      <input name="profissao" type="text" id="profissao" value="<? echo $res_edita['profissao']; ?>" size="30" />
    </span></td>
    <td><select name="acesso" size="1" id="acesso">
      <option value="<? echo $res_edita['tipo']; ?>"><? echo $res_edita['tipo']; ?></option>
      <option value="ADM">ADM</option>
      <option value="FUNCIONARIO">FUNCIONARIO</option>
    </select></td>
    <td bgcolor="#FF9900"><span id="sprytextfield6">
      <input name="repita_senha" type="password" id="repita_senha" size="10" value="<? echo $res_edita['senha']; ?>" />
    </span></td>
    </tr>
  <tr>
    <td colspan="4"><input type="submit" name="button" id="button" value="Cadastrar" /></td>
  </tr>
</table>
</form>
<? } ?>



<? } ?>








<? if(@$_GET['p'] == ''){ ?>
 <a style="font:12px Arial, Helvetica, sans-serif; background:#090; color:#FFF; text-decoration:none; text-align:center; padding:10px; margin:0 0 10px 10px; border:1px solid #000;" href="?pack=40&p=cadastrar">Cadastrar usuário</a>
<br />
<br />
 <hr />
<table width="1000" border="0">
  <tr>
    <td width="74" bgcolor="#0099FF">COD.</td>
    <td width="79" bgcolor="#0099FF">DATA</td>
    <td width="66" bgcolor="#0099FF">STATUS</td>
    <td width="260" bgcolor="#0099FF">NOME</td>
    <td width="93" bgcolor="#0099FF">USUÁRIO</td>
    <td width="77" bgcolor="#0099FF">CPF</td>
    <td width="105" bgcolor="#0099FF">PROFISS&Atilde;O</td>
    <td width="68" bgcolor="#0099FF">ACESSO</td>
    <td width="140" bgcolor="#0099FF">&nbsp;</td>
  </tr>
<?
$i=0;
$sql_acesso = mysqli_query($conexao_bd, "SELECT * FROM adm ORDER BY id DESC");
 while($res_acesso = mysqli_fetch_array($sql_acesso)){ $i++;
?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td><? echo @strtoupper($res_acesso['cod']); ?></td>
    <td><? echo @strtoupper($res_acesso['data']); ?></td>
    <td><? echo @strtoupper($res_acesso['status']); ?></td>
    <td><? echo strtoupper($res_acesso['nome']); ?></td>
    <td><? echo strtoupper($res_acesso['login']); ?></td>
    <td><? echo strtoupper($res_acesso['cpf']); ?></td>
    <td><? echo @strtoupper($res_acesso['profissao']); ?></td>
    <td><? echo strtoupper($res_acesso['tipo']); ?></td>
    <td>
      <a href="?pack=40&p=editar&id=<? echo $res_acesso['id']; ?>&status=editar&id=<? echo $res_acesso['id']; ?>"><img src="img/editar.png" width="25" height="25" title="Editar dados cadastrais" /></a>
     
     <? if(strtoupper($res_acesso['status']) == 'ATIVO'){ ?>
     <a href="?pack=40&p=bloquear&id=<? echo $res_acesso['id']; ?>&status=BLOQUEADO"><img src="img/bloquear.jpg" width="25" height="25" border="0" title="BLOQUEAR ACESSO DO USUÁRIO AO SISTEMA" /></a>
     <? }else{ ?>
     <a href="?pack=40&p=bloquear&id=<? echo $res_acesso['id']; ?>&status=ATIVO"><img src="img/correto.png" width="25" height="25" border="0" title="BLOQUEAR ACESSO DO USUÁRIO AO SISTEMA" /></a>     
     <? } ?>

     <a href="#" onclick="javascript: if (confirm('Ao confirmar a exclusão, você deixará de ter acesso aos registros desse usuário. Confirma exclusão?'))location.href='?pack=40&p=excluir&id=<? echo $res_acesso['id']; ?>'"><img src="img/deleta.png" width="25" height="25" border="0" title="Excluir usuário do sistema" /></a>
     
   </td>
  </tr>
<? } ?>
</table>
<? } // p ?>




<br />
</div><!-- box_central -->
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4", "custom", {useCharacterMasking:true, pattern:"00000000000"});
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5", "none");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
</script>
</body>
</html>
<? if(@$_GET['p'] == 'bloquear'){
$id = $_GET['id'];
$status = $_GET['status'];

mysqli_query($conexao_bd, "UPDATE adm SET status = '$status' WHERE id = '$id'");
echo "<script language='javascript'>window.alert('Registro efetuado com sucesso!');window.location='?pack=40&p=';</script>";
}?>

<? if(@$_GET['p'] == 'excluir'){
$id = $_GET['id'];

mysqli_query($conexao_bd, "DELETE FROM adm WHERE id = '$id'");
echo "<script language='javascript'>window.alert('Registro excluído com sucesso!');window.location='?pack=40&p=';</script>";
}?>