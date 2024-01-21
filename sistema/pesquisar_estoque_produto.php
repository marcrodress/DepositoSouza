<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/pesquisar_estoque_produto.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box_central">
 <h1 style="font:18px Arial, Helvetica, sans-serif; margin:5px;"><strong>Buscar produto</strong></h1>
 <hr /><br />
<table width="1000" border="0">
  <tr>
    <td>
      <form name="" method="post" action="" enctype="multipart/form-data">
        <input name="key" type="text" style="font:20px Arial, Helvetica, sans-serif; border-radius:5px; border:1px solid #999; padding:20px; color:#C30; margin:10px 0 10px 10px;" size="88" />
        <input  type="submit" style="font:20px Arial, Helvetica, sans-serif; border-radius:5px; border:1px solid #999; padding:20px; color:#C30; margin:-20px 0 10px 10px;" name="buscar" value="Buscar" />
        </form>
      
      <? if(isset($_POST['buscar'])){
	 
	$key = $_POST['key'];
	if(strlen($key) <3){
		echo "<script language='javascript'>window.alert('Para fazer uma busca é necessário digitar no mínimo 3 letras!');</script>";
	}else{
		$sql_consulta = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE code LIKE '%$key%' OR titulo LIKE '%$key%' OR valor_venda LIKE '%$key%'");
		if(mysqli_num_rows($sql_consulta) == ''){
			echo "<script language='javascript'>window.alert('Não foi encontrado nenhum produto com as informações digitadas: $key');</script>";
		}else{
			echo "<script language='javascript'>window.location='?pack=2&pg=seach&key=$key';</script>";		
		}
	}
 
 }?>
    </td>
    </tr>
  </table>


<? if(@$_GET['pg'] == 'seach'){ ?>
<h1 style="font:18px Arial, Helvetica, sans-serif; color:#09C; margin:0 0 0 5px;"><strong>(<? echo $key = $_GET['key']; ?>)</strong></h1>
<hr />
<table width="1000" border="0">
<? 
	 $i = 0;
$sql_consulta = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE code LIKE '%$key%' OR titulo LIKE '%$key%' OR valor_venda LIKE '%$key%'");
while($res_consulta = mysqli_fetch_array($sql_consulta)){ $i++;
?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td width="83" rowspan="2"><a rel="superbox[iframe][380x100]" href="scripts/atualizar_imagem_produto.php?id=<? echo $res_consulta['id']; ?>&url=<? echo $res_consulta['foto']; ?>"><img src="<? echo $res_consulta['foto']; ?>" title="Alterar imagem do produto" width="81" height="75" border="0" style="border:1px solid #CCC; border-radius:5px;"></a></td>
    <td colspan="6"><h1 style="font:20px Arial, Helvetica, sans-serif; color:#999; padding:0; margin:0;"><? echo $res_consulta['titulo']; ?></h1></td>
  </tr>
  <tr>
    <td width="142"><strong>COD.:</strong> <? echo $res_consulta['code']; ?></td>
    <td width="141"><strong><a rel="superbox[iframe][180x100]" title="Atualizar estoque" style="text-decoration:none; color:#000;" href="scripts/atualizar_estoque.php?id=<? echo $res_consulta['id']; ?>&estoque=<? echo $res_consulta['estoque']; ?>">Estoque:</a></strong> <? echo $res_consulta['estoque']; ?> unidades</td>
    <td width="173"><strong><a rel="superbox[iframe][180x100]" title="Alterar valor de venda do produto" style="text-decoration:none; color:#000;" href="scripts/atualizar_valor.php?id=<? echo $res_consulta['id']; ?>&valor_venda=<? echo $res_consulta['valor_venda']; ?>">Valor de venda:</a></strong> R$ <? echo number_format($res_consulta['valor_venda'],2,',','.'); ?></td>
    <td width="181"><strong>Quant. vendida:</strong> <? echo $res_consulta['quant_vendida']; ?> unidades</td>
    <td width="156">
      <p style="font:10px Arial, Helvetica, sans-serif; padding:0;"><strong><a rel="superbox[iframe][280x100]" title="Alterar categória" style="text-decoration:none; color:#000;" href="scripts/alterar_categia.php?id=<? echo $res_consulta['id']; ?>&categoria=<? echo $res_consulta['categoria']; ?>">Categ&oacute;ria:</a></strong>
      <?
	    $sql_categoria = mysqli_query($conexao_bd, "SELECT * FROM categorias WHERE code = '".$res_consulta['categoria']."'");
		 while($res_categoria = mysqli_fetch_array($sql_categoria)){
			 echo $res_categoria['categoria'];
		 }
	   
	  ?>
      </br>
      <strong><a rel="superbox[iframe][280x100]" title="Alterar sub-categória" style="text-decoration:none; color:#000;" href="scripts/alterar_categia.php?categoria=<? echo $res_consulta['categoria']; ?>&p=1&id=<? echo $res_consulta['id']; ?>">Sub-Categ&oacute;ria:</a></strong>
      <?
	    $sql_subcategoria = mysqli_query($conexao_bd, "SELECT * FROM subcategorias WHERE code = '".$res_consulta['subcategoria']."'");
		 while($res_subcategoria = mysqli_fetch_array($sql_subcategoria)){
			 echo $res_subcategoria['subcategoria'];
		 }
	   
	  ?>      
      </p>
    </td>
    <td width="94">
    
     <? 
	  $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM carrinho_produtos WHERE carrinho = '$code_carrinho' AND produto = '".$res_consulta['code']."'");
	  if(mysqli_num_rows($sql_verifica) == '' && $res_consulta['estoque'] >=1){
	 ?>
     <a href="?pack=2&pg=adiconar&vl_unitario=<? echo @$res_consulta['valor_venda']; ?>&codeprod=<? echo $res_consulta['code']; ?>&key=<? echo $_GET['key']; ?>"><img src="img/correto.png" width="25" height="25" border="0" title="Incluir no orçamento"></a> 
     <? }elseif(mysqli_num_rows($sql_verifica) >= 1){ ?>
      <a href="?pack=2&pg=excluir&vl_unitario=<? echo @$res_consulta['valor_venda']; ?>&codeprod=<? echo $res_consulta['code']; ?>&key=<? echo $_GET['key']; ?>"><img src="img/excluir.jpg" width="25" height="25" border="0" title="Excluir no orçamento"></a>     
     <? } ?>
     
     <a href="?pack=31&codebarras=<? echo $res_consulta['code']; ?>&pg=1&categoria=<? echo $res_consulta['categoria']; ?>"><img src="img/editar.png" width="25" height="25" border="0" title="Editar dados do produto"></a>
     
     <a rel="superbox[iframe][440x350]" href="scripts/informar_prejuizo.php?operador=<? echo $operador; ?>&estoque=<? echo $res_consulta['estoque']; ?>&produto=<? echo $res_consulta['code']; ?>"><img src="img/prejuizo.ico" width="30" height="25" border="0" title="Informar perda ou prejuizo" /></a></td>
  </tr>
<? } ?>
</table>
<? } // pg busca ?>

</div><!-- box_central -->
</body>
</html>
<? if(@$_GET['pg'] == 'adiconar'){

$codeprod = $_GET['codeprod'];
$key = $_GET['key'];
$vl_unitario = $_GET['vl_unitario'];

mysqli_query($conexao_bd, "INSERT INTO carrinho_produtos (dia, mes, ano, data_completa, operador, carrinho, produto, quantidade, vl_unitario, vl_total, desconto, cliente, code_dia) VALUES ('$dia', '$mes', '$ano', '$data_completa', '$operador', '$code_carrinho', '$codeprod', '1', '$vl_unitario', '$vl_unitario', '0', '$cliente', '$code_dia')");

echo "<script language='javascript'>window.alert('Produto adicionado com sucesso!');window.location='?pack=2&pg=seach&key=$key';</script>";


}?>

<? if(@$_GET['pg'] == 'excluir'){

$codeprod = $_GET['codeprod'];
$key = $_GET['key'];

mysqli_query($conexao_bd, "DELETE FROM carrinho_produtos WHERE carrinho = '$code_carrinho' AND produto = '$codeprod'");

echo "<script language='javascript'>window.alert('Produto retirado com sucesso!');window.location='?pack=2&pg=seach&key=$key';</script>";


}?>
