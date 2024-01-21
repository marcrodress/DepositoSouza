<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/cadastrar_categoria.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="box_central">
 <h1 style="font:18px Arial, Helvetica, sans-serif; margin:5px;"><strong>Categórias e Sub-categórias</strong></h1>
 <hr /><br />
 <? if(@$_GET['pg'] == 'cate'){ ?>
  <form name="" action="" method="post" enctype="multipart/form-data">
  <h1 style="margin:10px; font:12px Arial, Helvetica, sans-serif;"><strong>Digite o nome da categória</strong></h1>
   <input style="margin:10px 0 10px 10px; border:1px solid #000; border-radius:3px; font:12px Arial, Helvetica, sans-serif; padding:10px; width:200px;" type="text" name="categoria" />
   <input style="margin:10px 0 10px 10px; border:1px solid #000; border-radius:3px; font:12px Arial, Helvetica, sans-serif; padding:10px; width:100px;" type="submit" name="enviar" value="Cadastrar" />
  </form>
   <? if(isset($_POST['enviar'])){
   	
	$categoria = strtoupper($_POST['categoria']);
	$code = rand()+date("s")*date("s");
	
	 mysqli_query($conexao_bd, "INSERT INTO categorias (code, categoria) VALUES ('$code', '$categoria')");
	 
	 echo "<script language='javascript'>window.alert('Cadastrado efetuado com sucesso!');window.location='?pack=30';</script>";
	
   }?>
  <hr />
 <? } ?>


 
 
 
  <? if(@$_GET['pg'] == 'editar'){ ?>
  <form name="" action="" method="post" enctype="multipart/form-data">
  <h1 style="margin:10px; font:12px Arial, Helvetica, sans-serif;"><strong>Editar nome da categória</strong></h1>
   <?
    $sql_edita = mysqli_query($conexao_bd, "SELECT * FROM categorias WHERE id = '".$_GET['id']."'");
		while($res_edita = mysqli_fetch_array($sql_edita)){
   ?>
   <input style="margin:10px 0 10px 10px; border:1px solid #000; border-radius:3px; font:12px Arial, Helvetica, sans-serif; padding:10px; width:200px;" type="text" name="categoria" value="<? echo $res_edita['categoria']; ?>" />
   <? } ?>
  
   <input style="margin:10px 0 10px 10px; border:1px solid #000; border-radius:3px; font:12px Arial, Helvetica, sans-serif; padding:10px; width:100px;" type="submit" name="enviar" value="Cadastrar" />
  </form>
   <? if(isset($_POST['enviar'])){
   	
	$categoria = strtoupper($_POST['categoria']);
	
	 mysqli_query($conexao_bd, "UPDATE categorias SET categoria = '$categoria' WHERE id = '".$_GET['id']."'");
	 echo "<script language='javascript'>window.alert('Cadastrado editado com sucesso!');window.location='?pack=30';</script>";
	
   }?>
  <hr />
 <? } ?>
 
 
 
  <? if(@$_GET['pg'] == 'editarsub'){ ?>
  <form name="" action="" method="post" enctype="multipart/form-data">
  <h1 style="margin:10px; font:12px Arial, Helvetica, sans-serif;"><strong>Editar nome da categória</strong></h1>
   <?
    $sql_edita = mysqli_query($conexao_bd, "SELECT * FROM subcategorias WHERE id = '".$_GET['id']."'");
		while($res_edita = mysqli_fetch_array($sql_edita)){
   ?>
   <input style="margin:10px 0 10px 10px; border:1px solid #000; border-radius:3px; font:12px Arial, Helvetica, sans-serif; padding:10px; width:200px;" type="text" name="categoria" value="<? echo $res_edita['subcategoria']; ?>" />
   <? } ?>
  
   <input style="margin:10px 0 10px 10px; border:1px solid #000; border-radius:3px; font:12px Arial, Helvetica, sans-serif; padding:10px; width:100px;" type="submit" name="enviar" value="Cadastrar" />
  </form>
   <? if(isset($_POST['enviar'])){
   	
	$categoria = strtoupper($_POST['categoria']);
	
	 mysqli_query($conexao_bd, "UPDATE subcategorias SET subcategoria = '$categoria' WHERE id = '".$_GET['id']."'");
	 echo "<script language='javascript'>window.alert('Cadastrado editado com sucesso!');window.location='?pack=30';</script>";
	
   }?>
  <hr />
 <? } ?>
 
 
 <? if(@$_GET['pg'] == ''){ ?>
 <a style="font:12px Arial, Helvetica, sans-serif; background:#090; color:#FFF; text-decoration:none; text-align:center; padding:10px; margin:0 0 10px 10px; border:1px solid #000;" href="?pack=30&pg=cate">Cadastrar</a>
 <br /><br />
 <ul>
  <? 
   
   $sql_cate = mysqli_query($conexao_bd, "SELECT * FROM categorias");
    while($res_cate = mysqli_fetch_array($sql_cate)){
  ?>
  <li><strong><? echo $res_cate['categoria']; ?></strong> 
  - <a href="?pack=30&pg=editar&id=<? echo $res_cate['id']; ?>"><img src="img/editar.png" width="20" height="20" border="0" title="Editar categória" /></a> 
  - <a href="?pack=30&pg=excluir&id=<? echo $res_cate['id']; ?>"><img src="img/excluir.jpg" width="20" height="20" border="0" title="Excluir categória" /></a>
  - <a href="?pack=30&pg=inserirsub&cate=<? echo $res_cate['categoria']; ?>&code=<? echo $res_cate['code']; ?>"><img src="img/inserir.jpg" width="20" height="20" border="0" title="Inserir sub-categória" /></a>
  
   <ul>
    <? 
	 $sql_subcate = mysqli_query($conexao_bd, "SELECT * FROM subcategorias WHERE categoria = '".$res_cate['code']."'");
	  while($res_subcate = mysqli_fetch_array($sql_subcate)){
	?>
    <li style="text-transform:capitalize; margin:15px 0 15px 0;"><? echo $res_subcate['subcategoria']; ?>
      - <a href="?pack=30&pg=editarsub&id=<? echo $res_subcate['id']; ?>"><img src="img/editar_sub.jpg" width="15" height="15" border="0" title="Excluir sub-categória" /></a>
      - <a href="?pack=30&pg=excluirsub&id=<? echo $res_subcate['id']; ?>"><img src="img/excluir.jpg" width="15" height="15" border="0" title="Excluir sub-categória" /></a>

    </li>
    <? } ?>
   </ul>
  
  </li>
  <? } ?>
 </ul>
 <br />
 <? } ?>
 
 
 
 
 
  <? if(@$_GET['pg'] == 'inserirsub'){ ?>
  <form name="" action="" method="post" enctype="multipart/form-data">
  <h1 style="margin:10px; font:12px Arial, Helvetica, sans-serif;"><strong>Digite o nome da sub-categória que ficará subordinado a categória: <? echo $_GET['cate']; ?> </strong></h1>
   <input style="margin:10px 0 10px 10px; border:1px solid #000; border-radius:3px; font:12px Arial, Helvetica, sans-serif; padding:10px; width:200px;" type="text" name="categoria" />
   <input style="margin:10px 0 10px 10px; border:1px solid #000; border-radius:3px; font:12px Arial, Helvetica, sans-serif; padding:10px; width:80px;" type="submit" name="enviar" value="Enviar" />
  </form>
   <? if(isset($_POST['enviar'])){
   	
	$categoria = strtoupper($_POST['categoria']);
	$code = rand()+date("s")*date("s");
	
	 mysqli_query($conexao_bd, "INSERT INTO subcategorias (code, categoria, subcategoria) VALUES ('$code', '".$_GET['code']."', '$categoria')");
	 
	 echo "<script language='javascript'>window.alert('Cadastrado efetuado com sucesso!');window.location='?pack=30';</script>";
	
   }?>
  <hr />
 <? } ?>
 
 
</div><!-- box_central -->
</body>
</html>
<? if(@$_GET['pg'] == 'excluir'){
 mysqli_query($conexao_bd, "DELETE FROM categorias WHERE id = '".$_GET['id']."'");
 echo "<script language='javascript'>window.alert('Registro excluído com sucesso!');window.location='?pack=30';</script>";
}?>
<? if(@$_GET['pg'] == 'excluirsub'){
 mysqli_query($conexao_bd, "DELETE FROM subcategorias WHERE id = '".$_GET['id']."'");
 echo "<script language='javascript'>window.alert('Registro excluído com sucesso!');window.location='?pack=30';</script>";
}?>