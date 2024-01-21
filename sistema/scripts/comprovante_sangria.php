<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>ENCERRA CARRINHO</title>
<style type="text/css">
body {
	background-color: #FFF;
	font:12px Arial, Helvetica, sans-serif;
	text-align:center;
	font-weight: bold;
}
</style>
<script language="javascript">window.print();</script>

</head>

<body>
<table width="304" style="border:2px solid #000; font-weight: bold; font-style: italic;" border="0">
  <tr>
    <td colspan="6" align="center"><h1 style="font:20px Arial, Helvetica, sans-serif; margin:0; padding:0;"><strong>RECIBO DE SANGRIA DE CAIXA</strong></h1>
      <p><img src="../../img/logo.png" width="227" height="116" /></p>
      <h1 style="font:30px Arial, Helvetica, sans-serif; margin:0;"><strong>Deposito Souza</strong></h1>
      <p style="font:15px Arial, Helvetica, sans-serif; margin:0;"><strong>Rua Capit&atilde;o In&aacute;cio Prata, S/N - Ta&iacute;ba<br>
        S&atilde;o Gon&ccedil;alo do Amarante - Cear&aacute;<br>
      CEP: 62670-000</strong></p>
      <p style="font:15px Arial, Helvetica, sans-serif; margin:0;"><strong>(85) 99137.7483/99420.1044/98851.8484</strong></p>
      <p style="font:18px Arial, Helvetica, sans-serif; margin:0;"><strong>Data da sangria:<br />
          <? echo $_GET['data_completa']; ?></strong></p>
      <p style="font:15px Arial, Helvetica, sans-serif; margin:0;">
      <strong>OPERADOR: <br />
    <? echo $_GET['operador']; ?><br><hr />    </td></td>
  </tr>
  <tr>
    <td width="97" align="center">VALOR</td>
  </tr>
  <tr>
    <td align="center"><? echo number_format($_GET['valor'],2,',','.'); ?></td>
  </tr>
  <tr>
    <td align="center">FORMA DA SANGRIA</td>
  </tr>
  <tr>
    <td align="center"><? echo $_GET['forma_pagamento']; ?></td>
  </tr>
  <tr>
    <td align="center" bgcolor="#999999">RESPONS&Aacute;VEL PELA SANGRIA</td>
  </tr>
  <tr>
    <td align="left"><p>NOME:</p></td>
  </tr>
  <tr>
    <td align="left">CPF:</td>
  </tr>
  <tr>
    <td align="left"><p>_________________________________________<br />
    ASSINATURA:</p></td>
  </tr>

  <tr>
    <td><hr />      
      <span style="font-family: Arial, Helvetica, sans-serif; font-size: 12px">Este recibo &eacute; o &uacute;nico comprovante de retirada de valores, sendo sua guarda de responsabilidade do operador.</span></td>
  </tr>
</table>
</body>
</html>
