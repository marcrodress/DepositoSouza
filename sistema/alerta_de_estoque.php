<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/alerta_de_estoque.css" rel="stylesheet" type="text/css" />
<script type="text/javascript">
function MM_jumpMenu(targ,selObj,restore){ //v3.0
  eval(targ+".location='"+selObj.options[selObj.selectedIndex].value+"'");
  if (restore) selObj.selectedIndex=0;
}
</script>
<style type="text/css">
#box_busca_prod table tr td {
	font-weight: bold;
}
</style>
</head>

<body>

<?

$cate = $_GET['cate'];
if($cate == ''){
    $sql_categorias = mysqli_query($conexao_bd, "SELECT * FROM categorias");
	while($res_categorias = mysqli_fetch_array($sql_categorias)){
		$cate = $res_categorias['code'];
		echo "<script language='javascript'>window.location='?pack=32&cate=$cate';</script>";
	}
}
?>

<div id="box_busca_prod">
<h1 style="font:20px Arial, Helvetica, sans-serif; margin:10px; padding:0;"><strong>Alerta de estoque</strong></h1>
<hr />
<table width="995" border="0">
  <tr>
    <td bgcolor="#669999" align="left">Categ&oacute;ria</td>
    <td bgcolor="#669999" align="left">Sub-categ&oacute;ria</td>
    </tr>
  <tr>
    <td align="left"><form name="form" id="form">
  <select style="font:18px Arial, Helvetica, sans-serif; color:#900; width:600px; border:1px solid #000; border-radius:5px; padding:10px;" name="jumpMenu" size="1" id="jumpMenu" onchange="MM_jumpMenu('parent',this,0)">
    <option value=""></option>
   <?
    $sql_categorias = mysqli_query($conexao_bd, "SELECT * FROM categorias");
	while($res_categorias = mysqli_fetch_array($sql_categorias)){
   ?>
    <option value="?pack=32&cate=<? echo $res_categorias['code']; ?>"><? echo $res_categorias['categoria']; ?></option>
   <? } ?>
  </select>
</form></td>
    <td align="left">
      <? if(@$_GET['cate'] != ''){ ?>  
      <form name="form2" id="form2">
        <select style="font:18px Arial, Helvetica, sans-serif; color:#900; width:370px; border:1px solid #000; border-radius:5px; padding:10px;" name="jumpMenu2" id="jumpMenu2" onchange="MM_jumpMenu('parent',this,0)">
          <option value=""></option>
          <?
    $sql_subcategorias = mysqli_query($conexao_bd, "SELECT * FROM subcategorias WHERE categoria = '".$_GET['cate']."'");
	while($res_subcategorias = mysqli_fetch_array($sql_subcategorias)){
   ?>      
          <option value="?pack=32&cate=<? echo @$_GET['cate']; ?>&subcate=<? echo @$res_subcategorias['code']; ?>"><? echo @$res_subcategorias['subcategoria']; ?></option>
          <? } ?>  
          </select>
        </form>
      <? } ?>  
    </td>
    </tr>
</table>
<hr />




<?
$subcate = @$_GET['subcate'];
$sql_consultas = 0;

$cate = $_GET['cate'];

if($subcate == ''){
$sql_consultas = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE categoria = '".$_GET['cate']."'");
}else{
$sql_consultas = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE categoria = '".$_GET['cate']."' AND subcategoria = '".$_GET['subcate']."'");
}

if(mysqli_num_rows($sql_consultas) == ''){
	echo "<em>Não foram encontrados produtos para o filtro selecionado!<br><br></em>";
}else{
	
$conta = 0;
$alerta_estoque = 0; $estoque = 0;
while($res_consulta = mysqli_fetch_array($sql_consultas)){ 
$alerta_estoque = $res_consulta['alerta_estoque'];
$estoque = $res_consulta['estoque'];
if($alerta_estoque >= $estoque){ $conta++;
}}
	
?>
<h2 style="font:15px Arial, Helvetica, sans-serif; margin:10px;"><strong>Foram encontrados <? echo $conta; ?> produtos para o filtro selecionado</strong></h2>
<table width="1000" border="0">
<? 
if($subcate == ''){
$sql_consultas = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE categoria = '".$_GET['cate']."'");
}else{
$sql_consultas = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE categoria = '".$_GET['cate']."' AND subcategoria = '".$_GET['subcate']."'");
}
$alerta_estoque = 0; $estoque = 0; $i=0;
while($res_consulta = mysqli_fetch_array($sql_consultas)){ 

$alerta_estoque = $res_consulta['alerta_estoque'];
$estoque = $res_consulta['estoque'];

if($alerta_estoque >= $estoque){ $i++; 
?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td width="91" rowspan="2"><img style="border:1px solid #CCC; border-radius:5px;" src="<? echo $res_consulta['foto']; ?>" width="81" height="75"></td>
    <td colspan="5"><h1 style="font:20px Arial, Helvetica, sans-serif; color:#999; padding:0; margin:0;"><? echo strtoupper($res_consulta['titulo']); ?></h1></td>
  </tr>
  <tr>
    <td width="153"><strong>COD.:</strong> <? echo $res_consulta['code']; ?></td>
    <td width="188"><strong>Estoque:</strong> <? echo $res_consulta['estoque']; ?> unidades</td>
    <td width="182"><strong>Valor de venda:</strong> R$ <? echo number_format($res_consulta['valor_venda'],2,',','.'); ?></td>
    <td width="181"><strong>Quant. vendida:</strong> <? echo $res_consulta['quant_vendida']; ?> unidades</td>
    <td width="179">Alerta: <? echo $res_consulta['alerta_estoque']; ?> unidade(s)</td>
  </tr>
<? }} ?>
</table>
<hr />
<? } ?>

</div><!-- box_busca_prod-->
</body>
</html>