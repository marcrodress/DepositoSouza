<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<?
  
   $code_prod = $_POST['code'];
   $quant = $_POST['quant'];
   
   $sql_busca_codigo_associado = mysqli_query($conexao_bd, "SELECT * FROM codigos_associados WHERE codigo_barras = '$code_prod'");
   if(mysqli_num_rows($sql_busca_codigo_associado) == ''){
   	$code_prod = $_POST['code'];
   }else{
	   while($res_associado = mysqli_fetch_array($sql_busca_codigo_associado)){
		   $code_prod = $res_associado['produto_original'];
	   }
   }
   
   
   $sql_verifica_produto = mysqli_query($conexao_bd, "SELECT * FROM produtos WHERE code = '$code_prod'");
    if(mysqli_num_rows($sql_verifica_produto) >= 1){ // se encontrar o código de barras
		while($res_prod = mysqli_fetch_array($sql_verifica_produto)){
			$valor_venda = $res_prod['valor_venda'];
			$vl_total = $res_prod['valor_venda']*$quant;
			$estoque = $res_prod['estoque'];
			
			if($estoque < $quant){
				echo "<script language='javascript'>window.alert('A quantidade solicitada é maior do que a disponível no estoque. Disponível: $estoque');</script>";
			}else{
				$sql_produto_carrinho = mysqli_query($conexao_bd, "SELECT * FROM carrinho_produtos WHERE carrinho = '$code_carrinho' AND produto = '$code_prod'");
				if(mysqli_num_rows($sql_produto_carrinho) >= 1){
				 
				  
				  while($res_carrinho = mysqli_fetch_array($sql_produto_carrinho)){
					  $quantAtual = $res_carrinho['quantidade']+$quant;
					  $vl_unitario = $res_carrinho['vl_unitario'];
					  $vl_total = $vl_unitario*$quantAtual;
				  }
				  
				  mysqli_query($conexao_bd, "UPDATE carrinho_produtos SET quantidade = '$quantAtual', vl_unitario = '$vl_unitario', vl_total = '$vl_total' WHERE carrinho = '$code_carrinho' AND produto = '$code_prod'");
				 echo "<script language='javascript'>window.location='';</script>";
				 
				}else{
				  mysqli_query($conexao_bd, "INSERT INTO carrinho_produtos (dia, mes, ano, data_completa, operador, carrinho, produto, quantidade, vl_unitario, vl_total, desconto, cliente, code_dia) VALUES ('$dia', '$mes', '$ano', '$data_completa', '$operador', '$code_carrinho', '$code_prod', '$quant', '$valor_venda', '$vl_total', '0', '$cliente', '$code_dia')");
				 echo "<script language='javascript'>window.location='';</script>";
				} // if que verifica se o produto já foi adicionado ao carrinho
				
				
			} // if se a quantidade estiver no estoque
			
		} // while
		
	}else{
	
  echo "<script language='javascript'>window.alert('Produto não encontrado, use o código 2 para pesquisar o produto!');</script>";

}// se não foi digitado o código de barras ?>
</body>
</html>