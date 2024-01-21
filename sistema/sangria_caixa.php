<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<link href="css/sangria_caixa.css" rel="stylesheet" type="text/css" />
<style type="text/css">
#box_central #historico_pagamentos table {
	font-weight: bold;
}
#box_historicos_carrinhos table {
	font-weight: bold;
}
</style>
</head>

<body> 
<div id="box_central">

<div id="box_pagamentos">
 <h1 style="font:15px Arial, Helvetica, sans-serif; margin:5px;"><strong>Informe o valor da sangria</strong></h1>
 <form name="" method="post" action="" enctype="multipart/form-data">
  <select style="font:20px Arial, Helvetica, sans-serif; margin:5px; padding:10px; width:320px; border:1px solid #000; border-radius:5px;" name="forma_pagamento" size="1">
    <option value="DINHEIRO">DINHEIRO</option>
  </select>
  <input name="valor_total" type="text" style="font:20px Arial, Helvetica, sans-serif; text-align:center; color:#00F; margin:5px; padding:10px; width:80px; border:1px solid #000; border-radius:5px;" value="<? echo number_format((float)$saldo_caixa, 2, ',', ''); ?>" />
 </form>
<hr />
 <br /><br />
 <br /><br />
 <? if(isset($_POST['valor_total'])){
 
  $valor_total = $_POST['valor_total'];
  $forma_pagamento = $_POST['forma_pagamento'];
	
		$verifica_ponto = 0;
		for($i=0; $i<strlen($_POST['valor_total']); $i++){
			if($_POST['valor_total'][$i] == '.'){
				$verifica_ponto = 1;
			}
		}
	
	if($verifica_ponto == 1){
			echo "<script language='javascript'>window.alert('Não utilize pontos, apenas utilize virgula para separar os centavos. EX: 100,35');</script>";
	}else{
  $valor_total = str_replace(',','.',$valor_total);
  
  if(number_format((float)$valor_total, 2, '.', '') > number_format((float)$saldo_caixa, 2, '.', '')){
	 $valor_total = number_format($valor_total,2,',','.'); 
	 $saldo_caixa = number_format($saldo_caixa,2,',','.'); 
			echo "<script language='javascript'>window.alert('O valor que você tirar é maior que o saldo disponível no caixa. Você quer tirar R$ $valor_total, porém, no caixa só tem R$ $saldo_caixa');</script>";
  }else{
  
  $verifica_letra = 0;
  $valor_total = base64_encode($valor_total);
  require "scripts/verifica_valor.php";
  if($verifica_letra == 1){
	echo "<script language='javascript'>window.alert('Só é aceitamos números!');</script>";
  }else{
  $valor_total = base64_decode($valor_total);
  mysqli_query($conexao_bd, "INSERT INTO sangria (data, data_completa, dia, mes, ano, ip, code_dia, operador, forma, valor) VALUES ('$data', '$data_completa', '$dia', '$mes', '$ano', '$ip', '$code_dia', '$operador', '$forma_pagamento', '$valor_total')");
 ?>

    <script language="javascript">
		function finaliza(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=340,height=400');
		}
	</script>
    
   	<a style="font:12px Arial, Helvetica, sans-serif; text-decoration:none; border:4px solid #000; background:#069; padding:10px; margin:0 0 0 170px; color:#FFF;" onclick="finaliza('scripts/comprovante_sangria.php?data_completa=<? echo $data_completa; ?>&operador=<? echo $nome; ?>&forma_pagamento=<? echo $forma_pagamento; ?>&valor=<? echo $valor_total; ?>
    ');" href="?pack=100"><strong>Emitir comprovante</strong></a>
 
 
 <? }}}} ?>

</div><!-- box_pagamentos -->

<div id="historico_pagamentos">
 <h1 style="font:15px Arial, Helvetica, sans-serif;"><strong>Últimas sangrias</strong></h1>
 <hr />
 
 <?
  $sql_sangria = mysqli_query($conexao_bd, "SELECT * FROM sangria WHERE operador = '$operador' ORDER BY id DESC LIMIT 7");
  if(mysqli_num_rows($sql_sangria) == ''){
	  echo "<em>Ainda não foi realizado nenhuma sangria.</em>";
  }else{
 ?>
<table width="530" border="0">
  <tr>
    <td width="189" bgcolor="#999999">DATA</td>
    <td width="166" bgcolor="#999999">FORMA</td>
    <td width="80" bgcolor="#999999">VALOR</td>
    <td width="77" bgcolor="#999999">&nbsp;</td>
  </tr>
  <? $i=0; while($res = mysqli_fetch_array($sql_sangria)){ $i++; ?>
  <tr <? if($i%2 == 0){ echo "bgcolor='#F0FFF8'"; }else{ echo "bgcolor='#FFFFDD'"; } ?>>
    <td><? echo $res['data_completa']; ?></td>
    <td><? echo $res['forma']; ?></td>
    <td>R$ <? echo number_format($res['valor'],2,',','.'); ?></td>
    <td>
     
<script language="Javascript">
function confirmacao(id) {
     var resposta = confirm("Deseja excluir essa sangria?");
     if (resposta == true) {
          window.location.href = "?pack=100&acao=excluir&id="+id;
     }
}
</script>     
     <? $data_re = $res['data']; if($data_re == $data){?>
     <a href="javascript:func()"
onclick="confirmacao('<? echo $res['id']; ?>')"><img src="img/deleta.png" width="25" height="25" border="0" title="Excluir sangria" /></a>
     <? } ?>
     
    <script language="javascript">
		function finaliza(urlImagem){
			window.open(urlImagem,'Foto_Ampliada','top=150,left=500,toolbar=no,location=no,status=no,menubar=no,scrollbars=no,resizable=no,width=340,height=400');
		}
	</script>     
    <a onclick="finaliza('scripts/comprovante_sangria.php?data_completa=<? echo $res['data_completa']; ?>&operador=<? echo $res['operador']; ?>&forma_pagamento=<? echo $res['forma']; ?>&valor=<? echo $res['valor']; ?>
    ');" href="?pack=100"><img src="img/impressora.png" width="30" height="30" border="0" title="Imprimir comprovante de sangria" /></a>
     
     </td>
  </tr>
  <? } ?>
</table>
 
 <? } ?>
 
</div><!-- historico_pagamentos -->
</div><!-- box_central -->
</body>
</html>
<? if($_GET['acao'] == 'excluir'){
	
	mysqli_query($conexao_bd, "DELETE FROM sangria WHERE id = '".$_GET['id']."' AND operador = '$operador'");
	echo "<script language='javascript'>window.location='?pack=100';</script>";

}?>