<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/relatorio_crediario.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#box_resumo table {
	font-weight: bold;
}
</style>
</head>

<body>
<div id="box_crediario">
 <h1 style="font:18px Arial, Helvetica, sans-serif; margin:5px;"><strong>Relatório de crediário</strong></h1>
 <hr />
<? if(isset($_POST['button'])){

$tipo = $_POST['tipo'];
echo "<script language='javascript'>window.location='?pack=52&tipo=$tipo';</script>";

}?>
<form name="" method="post" action="" enctype="multipart/form-data">
<table class="table" width="990" border="0">
  <tr>
    <td colspan="2" bgcolor="#CCCCCC">TIPO</td>
    </tr>
  <tr>
    <td width="903"><label for="select"></label>
      <select style="font:18px Arial, Helvetica, sans-serif; padding:10px; height:50px; color:#666; width:895px; border-radius:3px; border:1px solid #000;" name="tipo" size="1" id="select">
        <option value="em_dia">PAGAMENTOS EM DIA</option>
        <option value="ultimo_mes">PAGAMENTO REALIZADOS ÚLTIMOS 30 DIAS</option>
        <option value="a_15">PAGAMENTOS COM MAIS DE 15 DIAS DE ATRASO</option>
        <option value="a_30">PAGAMENTOS COM MAIS DE 30 DIAS DE ATRASO</option>
        <option value="a_45">PAGAMENTOS COM MAIS DE 45 DIAS DE ATRASO</option>
        <option value="a_60">PAGAMENTOS COM MAIS DE 60 DIAS DE ATRASO</option>
    </select></td>
    <td width="92"><input style="font:18px Arial, Helvetica, sans-serif; padding:10px; height:50px; border:1px solid #000; border-radius:5px;" type="submit" name="button" id="button" value="Filtrar"></td>
  </tr>
  </table>
</form>

<? $tipo_filtro = @$_GET['tipo']; ?>
<hr />

<? if($tipo_filtro == ''){}else{ 

if($tipo_filtro == 'em_dia' || $tipo_filtro == 'ultimo_mes'){
 require "relatorio/pagamentos_em_dia.php";
}else{
 require "relatorio/atrasos.php";	
}

} ?>
</div><!-- box_crediario -->
</body>
</html>