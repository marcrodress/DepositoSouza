<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/cadastrar_produto.css" rel="stylesheet" type="text/css" />
<!-- TinyMCE -->
<script type="text/javascript" src="tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		mode : "textareas",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme : "simple"
		
	});
</script>
<!-- /TinyMCE -->
</head>

<body>
<div id="box_central">
 <h1 style="font:18px Arial, Helvetica, sans-serif; margin:5px;"><strong>Cadastrar produto</strong></h1>
 <hr /><br />
 
 <? if(@$_GET['pg'] == ''){ ?>
  <h1 style="font:18px Arial, Helvetica, sans-serif; margin:0 0 0 400px;"><strong>Digite o código de barras</strong></h1>
  <form name="" method="post" action="" enctype="multipart/form-data">
   <input style="font:18px Arial, Helvetica, sans-serif; border-radius:5px; border:1px solid #000;; margin:5px 0 20px 350px; padding:12px; text-align:center; color:#06C;" type="text" name="codebarras" value="" autofocus />
   <input style="font:18px Arial, Helvetica, sans-serif; border-radius:5px; border:1px solid #000;; margin:5px 0 20px 0; height:40px; padding:5px; text-align:center; color:#06C;" type="submit" name="avancar" value="Avançar" />
  </form>
  
  <? if(isset($_POST['avancar'])){
	  
	 $codebarras = $_POST['codebarras'];
	 $categoria = 0;
	 $subcategoria = 0;
	 
	 $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE code = '$codebarras'");
 	 if(mysqli_num_rows($sql_verifica) == ''){
	 	echo "<script language='javascript'>window.alert('Produto ainda não cadastro, faça o cadastro desse produto');window.location='?pack=31&codebarras=$codebarras&pg=1';</script>";
	 }else{
		 
		 while($res = mysqli_fetch_array($sql_verifica)){
			 $categoria = $res['categoria'];
			 $subcategoria = $res['subcategoria'];
		 
	 	echo "<script language='javascript'>window.alert('Produto encontrado, faça a edição');window.location='?pack=31&codebarras=$codebarras&pg=1&categoria=$categoria&subcategoria=$subcategoria';</script>";
		 }
	 }
  }?>
 <? } ?> 
  


 <? if(@$_GET['pg'] == '1'){ ?>
  <h1 style="font:18px Arial, Helvetica, sans-serif; margin:0 0 0 400px;"><strong>Selecione a categória do produto</strong></h1>
  <form name="" method="post" action="" enctype="multipart/form-data">
	<select style="font:18px Arial, Helvetica, sans-serif; border-radius:5px; border:1px solid #000;; margin:5px 0 20px 450px; padding:12px; text-align:center; color:#06C;" name="categoria" size="1">
     <?
      
	  $sql_cate_prod = mysqli_query($conexao_bd, "SELECT * FROM categorias WHERE code = '".$_GET['categoria']."'");
	  	while($res_cate_prod = mysqli_fetch_array($sql_cate_prod)){
	 
	 ?>
	  <option value="<? echo $res_cate_prod['code']; ?>"><? echo $res_cate_prod['categoria']; ?></option>     
	  <option value=""></option>     
     <? } ?>
    
     <?
      $sql = mysqli_query($conexao_bd, "SELECT * FROM categorias WHERE code != '".$_GET['categoria']."'");
	  	while($res = mysqli_fetch_array($sql)){
	 ?>
	  <option value="<? echo $res['code']; ?>"><? echo $res['categoria']; ?></option>
     <? } ?>
	</select>
    <input style="font:18px Arial, Helvetica, sans-serif; border-radius:5px; height:45px; border:1px solid #000;; margin:5px 0 20px 0; padding:12px; text-align:center; color:#06C;" type="submit" name="avancar" value="Avançar" />
  </form>  
  
  <? if(isset($_POST['avancar'])){
	  
	 $categoria = $_POST['categoria'];
	 $codebarras = $_GET['codebarras'];
	 
	 echo "<script language='javascript'>window.location='?pack=31&codebarras=$codebarras&pg=2&categoria=$categoria';</script>";
  }?>  
 <? } ?>
 
 
 <? if(@$_GET['pg'] == '2'){ ?>
  <h1 style="font:18px Arial, Helvetica, sans-serif; margin:0 0 0 400px;"><strong>Selecione a a subcategória</strong></h1>
  <form name="" method="post" action="" enctype="multipart/form-data">
	<select style="font:18px Arial, Helvetica, sans-serif; border-radius:5px; border:1px solid #000;; margin:5px 0 20px 450px; padding:12px; text-align:center; color:#06C;" name="subcategorias" size="1">
     <?
      $sql = mysqli_query($conexao_bd, "SELECT * FROM subcategorias WHERE categoria = '".$_GET['categoria']."'");
	  	while($res = mysqli_fetch_array($sql)){
	 ?>
	  <option value="<? echo $res['code']; ?>"><? echo $res['subcategoria']; ?></option>
     <? } ?>
	</select>
    <input style="font:18px Arial, Helvetica, sans-serif; border-radius:5px; border:1px solid #000;; height:45px; margin:5px 0 20px 0; padding:12px; text-align:center; color:#06C;" type="submit" name="avancar" value="Avançar" />
  </form>
  <? if(isset($_POST['avancar'])){
	  
	 $subcategorias = $_POST['subcategorias'];
	 $codebarras = $_GET['codebarras'];
	 $categoria = $_GET['categoria'];
	 
	 $sql_verifica = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE code = '$codebarras'");
	 if(mysqli_num_rows($sql_verifica) >= 1){
	 echo "<script language='javascript'>window.location='?pack=31&codebarras=$codebarras&pg=3';</script>";
	 }else{
	 mysqli_query($conexao_bd, "INSERT INTO produtos (tipo, status, code, titulo, valor_venda, valor_compra, estoque, descricao, foto, foto2, foto3, foto4, foto5, alerta_estoque, quant_vendida, categoria, subcategoria) VALUES ('', 'Ativo', '$codebarras', '', '', '', '', '', '', '', '', '', '', '', '', '$categoria', '$subcategorias')");
	 echo "<script language='javascript'>window.location='?pack=31&codebarras=$codebarras&pg=3';</script>";
	 }
  }?>  
 <? } ?>


 <? if(@$_GET['pg'] == '3'){ ?>
    <?
	$sql_produto = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE code = '".$_GET['codebarras']."'");
	 while($res_produto = mysqli_fetch_array($sql_produto)){
	?>
<form name="" method="post" action="" enctype="multipart/form-data">
<table width="995" border="0">
      <tr>
        <td colspan="2" bgcolor="#999999"><strong>TITULO</strong></td>
        <td width="194" bgcolor="#999999" align="center"><strong>VALOR VENDA</strong></td>
        <td width="191" bgcolor="#999999" align="center"><strong>VALOR COMPRA</strong></td>
        <td width="88" bgcolor="#999999"><strong>ESTOQUE</strong></td>
        <td width="112" bgcolor="#999999"><strong>ALERTA ESTOQUE</strong></td>
      </tr>
      <tr>
        <td colspan="2"><label for="titulo"></label>
        <input name="titulo" type="text" id="titulo" value="<? echo $res_produto['titulo']; ?>" size="50"></td>
        <td align="center"><label for="estoque">
          <input name="valor_venda" type="text" value="<?
		  
		    $valor_venda = $res_produto['valor_venda'];
			@$pontos = array(".", ",");
	  		@$valor_venda = str_replace($pontos, ",", $valor_venda);
			
			for($i=0; $i<=strlen($valor_venda); $i++){
				if(@$valor_venda[$i] != '.'){
					echo @$valor_venda[$i];
				}
			}		  
		  
		  ?>" size="15" />
        </label></td>
        <td><label for="valor_venda">
          <input name="valor_compra" style="text-align:center;" type="text" value="
<?
		  
		    $valor_compra = $res_produto['valor_compra'];
			@$pontos = array(".", ",");
	  		@$valor_compra = str_replace($pontos, ",", $valor_compra);
			
			for($i=0; $i<=strlen($valor_compra); $i++){
				if(@$valor_compra[$i] != '.'){
					echo @$valor_compra[$i];
				}
			}		  
		  
		  ?>		  
          " size="15" />
        </label></td>
        <td><input name="estoque" type="number" id="estoque" size="5" value="<? echo $res_produto['estoque']; ?>" /></td>
        <td><input name="alerta_estoque" type="text" id="textfield3" size="6"  value="<? echo $res_produto['alerta_estoque']; ?>" /></td>
      </tr>
      <tr>
        <td width="191" bgcolor="#999999"><strong>FOTO 1</strong></td>
        <td width="193" bgcolor="#999999"><strong>FOTO 2</strong></td>
        <td bgcolor="#999999"><strong>FOTO 3</strong></td>
        <td bgcolor="#999999"><strong>FOTO 4</strong></td>
        <td colspan="2" bgcolor="#999999"><strong>FOTO 5</strong></td>
      </tr>
      <tr>
        <td><label for="foto1"></label>
        <input type="text" name="foto1" value="<? echo $res_produto['foto']; ?>"></td>
        <td><label for="foto2"></label>
        <input type="text" name="foto2" value="<? echo $res_produto['foto2']; ?>"></td>
        <td><label for="foto3"></label>
        <input type="text" name="foto3" value="<? echo $res_produto['foto3']; ?>"></td>
        <td><label for="foto4"></label>
        <input type="text" name="foto4" value="<? echo $res_produto['foto4']; ?>"></td>
        <td colspan="2"><label for="foto5"></label>
        <input type="text" name="foto5" value="<? echo $res_produto['foto5']; ?>"></td>
      </tr>
      <tr>
        <td align="center" colspan="6" bgcolor="#FFFFFF"><hr />          <a style="font:12px Arial, Helvetica, sans-serif; color:#00F;" rel="superbox[iframe][400x95]" href="scripts/produto_associado.php?produto=<? echo @$_GET['codebarras']; ?>">Associar produto</a>
        <hr /></td>
      </tr>
      <tr>
        <td colspan="6" bgcolor="#999999"><strong>DESCRIÇÃO COMPLETA</strong></td>
      </tr>
      <tr>
        <td colspan="6"><label for="textarea"></label>
        <textarea name="descricao" id="textarea" cols="120" rows="20"><? echo base64_decode($res_produto['descricao']); ?></textarea></td>
      </tr>
      <tr>
        <td align="center" colspan="6"><input style="font:12px Arial, Helvetica, sans-serif; width:100px; height:40px;" type="submit" name="button" id="button" value="CADASTRAR"></td>
      </tr>
    </table>
</form>
    <? if(isset($_POST['button'])){
		
	 $titulo = $_POST['titulo'];
	 $estoque = $_POST['estoque'];
	 $valor_venda = $_POST['valor_venda'];
	 $valor_compra = $_POST['valor_compra'];
	 $foto1 = $_POST['foto1'];
	 $foto2 = $_POST['foto2'];
	 $foto3 = $_POST['foto3'];
	 $foto4 = $_POST['foto4'];
	 $foto5 = $_POST['foto5'];
	 $alerta_estoque = $_POST['alerta_estoque'];
	 $descricao = base64_encode($_POST['descricao']);
	 $tipo = $_POST['tipo'];
	 
	 @$pontos = array(",", ".");
	 @$valor_venda = str_replace($pontos, ".", $valor_venda);
	 @$valor_compra = str_replace($pontos, ".", $valor_compra);
	 
	 mysqli_query($conexao_bd, "UPDATE produtos SET tipo = 'PRODUTO', titulo = '$titulo', valor_venda = '$valor_venda', valor_compra = '$valor_compra', estoque = '$estoque', descricao = '$descricao', foto = '$foto1', foto2 = '$foto2', foto3 = '$foto3', foto4 = '$foto4', foto5 = '$foto5', alerta_estoque = '$alerta_estoque' WHERE code = '".$_GET['codebarras']."'");
	 
	echo "<script language='javascript'>window.alert('Registro informado com sucesso!');window.location='?pack=31';</script>";						
	 
	}?>

<? } ?>

 <? } ?>


</div><!-- box_central -->
</body>
</html>