<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/informa_cliente.css" rel="stylesheet" type="text/css" />
<script src="../SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<link href="../SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box_central">
 <h1 style="font:18px Arial, Helvetica, sans-serif; margin:10px;"><strong>Controle de clientes</strong></h1>
 <hr /><br />
 <a rel="superbox[iframe][970x480]" style="font:12px Arial, Helvetica, sans-serif; background:#090; color:#FFF; text-decoration:none; text-align:center; padding:10px; margin:0 0 10px 10px; border:1px solid #000;" href="scripts/verificar_cliente.php?operador=<? echo $operador; ?>"><strong>Cadastrar cliente</strong></a>
 <br /><br />

      <form name="" method="post" action="" enctype="multipart/form-data">
        <span id="sprytextfield1">
        <input name="key" type="text" style="font:20px Arial, Helvetica, sans-serif; border-radius:5px; border:1px solid #999; padding:20px; color:#C30; margin:10px 0 10px 10px;" size="88" />
        </span>
        <input  type="submit" style="font:20px Arial, Helvetica, sans-serif; border-radius:5px; border:1px solid #999; padding:20px; color:#C30; margin:-20px 0 10px 10px;" name="buscar" value="Buscar" />
  </form>
  
<? if(isset($_POST['buscar'])){

$key = $_POST['key'];

$sql_cliente = mysqli_query($conexao_bd, "SELECT * FROM clientes WHERE nome LIKE '%$key%' OR cpf LIKE '%$key%' OR code LIKE '%$key%'");
if(mysqli_num_rows($sql_cliente) == ''){
	echo "<script language='javascript'>window.alert('Não foi encontrado nenhum cliente com as informações digitadas!');</script>";
}else{
?>

<table width="990" border="0">
 <? $i = 0;  while($res_cliente = mysqli_fetch_array($sql_cliente)){  $i++; $cliente = $res_cliente['code'];?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td width="82" rowspan="3"><img style="border:1px solid #000; border-radius:5px;" src="<? if($res_cliente['sexo'] == 'Masculino'){ echo "https://toppng.com/uploads/preview/icone-homem-man-icon-11553494437bgj8eja2bq.png"; }else{ echo "https://image.flaticon.com/icons/png/512/60/60889.png"; }?>" width="80" height="80" /></td>
    <td colspan="7"><h1 style="font:25px Arial, Helvetica, sans-serif; margin:0; padding:0; color:#666;"><strong>COD.: <? echo $res_cliente['code']; ?> - <? echo strtoupper($res_cliente['nome']); ?></strong></h1></td>
  </tr>
  <tr>
    <td width="102" align="center"><strong>CPF: </strong></td>
    <td width="128" align="center"><strong>Data de cadastro</strong></td>
    <td width="125" align="center"><strong>Última compra</strong></td>
    <td width="139" align="center"><strong>Saldo devedor</strong></td>
    <td width="128" align="center"><strong>&Uacute;ltimo pagamento</strong></td>
    <td width="157" align="center"><strong>Quant. Compras</strong></td>
    <td width="95">&nbsp;</td>
  </tr>
  <tr>
    <td align="center"><? echo $res_cliente['cpf']; ?></td>
    <td align="center"><? echo $res_cliente['data']; ?></td>
    <td align="center">
	 
    <?
	 $sql_ultima_compra = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE cliente = '$cliente' AND status = 'ENCERRADO' ORDER BY id DESC LIMIT 1");
	 if(mysqli_num_rows($sql_ultima_compra) == ''){
		 echo "<em>Ainda não fez compra</em>";
	 }else{
	 	while($res = mysqli_fetch_array($sql_ultima_compra)){
			echo $res['data_completa'];
		}
	 }
	 
	?>
     
    </td>
    <td align="center">R$ <? echo number_format($res_cliente['saldo'],2,',','.'); ?></td>
    <td align="center"><?
	 $sql_ultima_pag = mysqli_query($conexao_bd, "SELECT * FROM historico_creditos WHERE cliente = '$cliente' ORDER BY id DESC LIMIT 1");
	 if(mysqli_num_rows($sql_ultima_pag) == ''){
		 echo "<em>Ainda n&atilde;o fez pagamento</em>";
	 }else{
	 	while($res = mysqli_fetch_array($sql_ultima_pag)){
			echo $res['data_completa'];
		}
	 }
	 
	?></td>
    <td align="center"><? echo mysqli_num_rows(mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE cliente = '".$res_cliente['code']."'")); ?></td>
    <td align="center">
    
    <?
	 $sql_ultima_compra = mysqli_query($conexao_bd, "SELECT * FROM carrinho WHERE cliente = '".$res_cliente['code']."' AND code_carrinho = '$code_carrinho'");
	 if(mysqli_num_rows($sql_ultima_compra) == ''){    
	?>
    <a href="?pack=10&cliente=<? echo $res_cliente['code']; ?>&pg=acao"><img src="img/correto.png" alt="" width="25" height="25" border="0" title="Adicionar cliente ao carrinho" /></a>
    <? }else{ ?>
    <a href="?pack=10&cliente=<? echo $res_cliente['code']; ?>&pg=excluir"><img src="img/excluir.jpg" alt="" width="25" height="25" border="0" title="Excluir cliente do carrinho" /></a>    
    <? } ?>
    
    <a rel="superbox[iframe][970x480]" href="scripts/alterar_dados.php?cliente=<? echo $res_cliente['code']; ?>"><img title="Editar informações do cliente" src="img/editar.png" width="25" height="25" border="0" /></a></td>
  </tr>
 <? } ?>
</table>

<? } }?>
  
</div><!-- box_central -->

<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1", "none", {hint:"Digite o nome, CPF ou c\xF3digo do cliente"});
</script>
</body>
</html>
<? if(@$_GET['pg'] == 'excluir'){

$cliente = $_GET['cliente'];

mysqli_query($conexao_bd, "UPDATE carrinho SET cliente = '' WHERE code_carrinho = '$code_carrinho'");
echo "<script language='javascript'>window.location='?pack=1';</script>";

}?>
<? if(@$_GET['pg'] == 'acao'){

$cliente = $_GET['cliente'];

mysqli_query($conexao_bd, "UPDATE carrinho SET cliente = '$cliente' WHERE code_carrinho = '$code_carrinho'");
echo "<script language='javascript'>window.location='?pack=1';</script>";

}?>