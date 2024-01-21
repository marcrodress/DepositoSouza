<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
</head>

<body>
<?

switch(@$_GET['pack']){
	
	// abertura e fechamento de caixa
	case 'abrir';
	include 'abrir_caixa.php';
	break;
	
	case '1000';
	include 'fechar_caixa.php';
	break;
	case '100';
	include 'sangria_caixa.php';
	break;
	case '1001';
	include 'sair_sistema.php';
	break;
	
	
	
	// inicia o processo de venda
	case '1';
	include 'carrinho.php';
	break;

	case '2';
	include 'pesquisar_estoque_produto.php';
	break;

	// inicia o processo de compra
	
	
	// inicia o processo de venda
	case '10';
	include 'informa_cliente.php';
	break;
	case '11';
	include 'tirar_cliente.php';
	break;
	case '20';
	include 'historico_cliente.php';
	break;
	case '21';
	include 'relatorio_clientes.php';
	break;
	//
		
	
	
	case '30';
	include 'cadastrar_categoria.php';
	break;
	case '31';
	include 'cadastrar_produto.php';
	break;
	case '32';
	include 'alerta_de_estoque.php';
	break;
	case '33';
	include 'listar_produtos_categorias.php';
	break;
	
	// RELATÓRIOS
	case '50';
	include 'relatorio_geral.php';
	break;
	case '51';
	include 'relatorio_de_venda.php';
	break;
	case '52';
	include 'relatorio_crediario.php';
	break;
	
	// ACESSO
	case '40';
	include 'usuarios.php';
	break;		
	
    default:
	echo "<script language='javascript'>window.alert('Código não encontrado!');window.location='?pack=1';</script>";
	
	}
?>
</body>
</html>