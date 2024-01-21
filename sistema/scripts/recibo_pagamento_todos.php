<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>IMPRESSÃO DE ORÇAMENTO</title>
<style type="text/css">
body {
	background-color: #FFF;
	font:15px Arial, Helvetica, sans-serif;
	text-align:center;
	font-weight: bold;
}
</style>

<?

require "../../conexao.php";

$sql = mysqli_query($conexao_bd, "SELECT * FROM historico_creditos WHERE cliente = '".$_GET['cliente']."'");
 while($res = mysqli_fetch_array($sql)){
?>
</head>

<body>
<script language="javascript">window.print();</script>

<table width="300" border="0" style="page-break-before: always;">
  <tr>
    <td width="290" align="center"><h1 style="font:20px Arial, Helvetica, sans-serif; margin:0; padding:0;"><strong>RECIBO DE PAGAMENTO DE CREDI&Aacute;RIO</strong></h1>
      <p><img src="../../img/logo.png" width="235" height="116" /></p>
    <h1 style="font:30px Arial, Helvetica, sans-serif; margin:0;"><strong>Deposito Souza</strong></h1>
    <p style="font:15px Arial, Helvetica, sans-serif; margin:0;"><strong>CNPJ: 07.107.782/0001-01</strong></p>
    <p style="font:15px Arial, Helvetica, sans-serif; margin:0;"><strong>Rua Capit&atilde;o In&aacute;cio Prata, S/N - Ta&iacute;ba<br>
    S&atilde;o Gon&ccedil;alo do Amarante - Cear&aacute;<br>
    CEP: 62670-000</strong></p>
    <p style="font:15px Arial, Helvetica, sans-serif; margin:0;"><strong>(85) 99137.7483/99420.1044/98851.8484</strong></p>
    <p style="font:15px Arial, Helvetica, sans-serif; margin:0;"><strong><? echo $res['data_completa']; ?></strong></p>
    <p style="font:15px Arial, Helvetica, sans-serif; margin:0;"><strong>Vendedor: <br />
      <? 
	 
	 $sql_verica_operador = mysqli_query($conexao_bd, "SELECT * FROM adm WHERE cpf = '".$res['operador']."'");
	 	while($res_operador = mysqli_fetch_array($sql_verica_operador)){
			echo $res_operador['nome'];
		}
	
	 ?>
      <br />
    </p>
    <hr /></td>
  </tr>
  <tr>
    <td align="center">CLIENTE</td>
  </tr>
  <tr>
    <td align="center"><h1 style="font:12px Arial, Helvetica, sans-serif; margin:0; padding:0;"><? echo $_GET['nome']; ?></h1></td>
  </tr>
  <tr>
    <td align="center">VALOR DO PAGAMENTO</td>
  </tr>
  <tr>
    <td align="center"><h1 style="font:12px Arial, Helvetica, sans-serif; margin:0; padding:0;">R$ <? echo number_format($res['valor'],2,',','.'); ?></h1></td>
  </tr>
  <tr>
    <td align="center">FORMA DE PAGAMENTO</td>
  </tr>
  <tr>
    <td align="center"><h1 style="font:12px Arial, Helvetica, sans-serif; margin:0; padding:0;"><? echo $res['forma_pagamento']; ?></h1></td>
  </tr>
    <td><hr />
      <h2 style="font:12px Arial, Helvetica, sans-serif; margin:15px 0 0 0"><em>Este recibo &eacute; o &uacute;nico comprovante de pagamento do credi&aacute;rio e deve ser apresentado caso seja solicitado.</em></h2></td>
  </tr>
</table>
<? } ?>
</body>
</html>