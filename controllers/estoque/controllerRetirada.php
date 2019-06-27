<?php
ini_set('default_charset','UTF-8');

include_once "../../classes/estoque/classeRetirada.php";
include_once "../../dao/estoque/daoRetirada.php"; 
include_once '../../helpers/helper.php';   
include '../../libraries/Data_validator.php';

session_start();

$valor = $_POST['botao'];

switch ($valor) 
{
	case 0:
	{
		$_SESSION['session_ID_Retirada'] = null;
		$_SESSION['session_Nm_Responsavel'] = null;
		$_SESSION['session_Dt_Retirada'] = null;
		$_SESSION['session_Nr_QuantProd'] = null;
		$_SESSION['session_acaoRetirada'] = null;
		$_SESSION['session_modalRetirada'] = null;
	}
    case 1:
	{
		$validate = new Data_validator();
			
		$validate->define_pattern('erro_', '');
		
		$validate->set('Nm_Responsavel',$_POST['Nm_Responsavel'])->is_required()->min_length(2)
				 ->set('Dt_Retirada',$_POST['Dt_Retirada'])->is_required()->is_date()
				 ->set('Nr_QuantProd',$_POST['Nr_QuantProd'])->is_required()->is_num();

		$retirada = new DaoRetirada();
	
		if($_POST['acao'] == 'editar') $ID_ProdutoR = $retirada->retornarIDProduto($_POST['Nm_ProdutoR_Oculto']);
		else if($_POST['acao'] == 'adicionar') $ID_ProdutoR = $retirada->retornarIDProduto($_POST['Nm_ProdutoR']);

		$Dt_Entrada = $retirada->retornarDataEntrada($ID_ProdutoR);

		$_SESSION['session_ID_Retirada'] = $_POST['ID_Retirada'];

		if($validate->validate() && validar_data($_POST['Dt_Retirada'], $Dt_Entrada))
		{		
			if($_POST['acao'] == 'editar')
			{
				$ID_ProdutoR = $retirada->retornarIDProduto(utf8_decode($_POST['Nm_ProdutoR_Oculto']));
				$encoding = mb_internal_encoding();
				$Nm_Responsavel = mb_strtoupper($_POST['Nm_Responsavel'], $encoding);
				$Nr_QuantProd = $_POST['Nr_QuantProd'];
				$Dt_Retirada = $_POST['Dt_Retirada'];
				$ID_Retirada = $_POST['ID_Retirada'];
				// Instancia do DaoRetirada
				$update = new DaoRetirada();
				// Atualizando valores previamente inseridos
				$retirada = new classeRetirada($ID_ProdutoR, $Nr_QuantProd, $Dt_Retirada, $Nm_Responsavel, $ID_Retirada);
				// Chamando função para atualizar no banco de dados
				$update->atualizarRetirada($retirada);
			}
			else if($_POST['acao'] == 'adicionar')
			{
				$ID_ProdutoR = $retirada->retornarIDProduto(utf8_decode($_POST['Nm_ProdutoR']));
				$encoding = mb_internal_encoding();
				$Nm_Responsavel = mb_strtoupper($_POST['Nm_Responsavel'], $encoding);
				$Nr_QuantProd = $_POST['Nr_QuantProd'];
				$Dt_Retirada = $_POST['Dt_Retirada'];
				// Instancia do DaoRetirada
				$inserir = new DaoRetirada();	
				// Adicionando valores ao objeto
				$retirada = new classeRetirada($ID_ProdutoR, $Nr_QuantProd, $Dt_Retirada, $Nm_Responsavel, $ID_Retirada);
				// Chamando função para inserir no banco de dados
				$inserir->inserirRetirada($retirada);
			}
		}
		else 
		{
			if(!validar_data($_POST['Dt_Retirada'], $Dt_Entrada))
			{
				$_SESSION['session_Dt_Retirada'] = "• A data não confere com a entrada do produto";
			}

			if($validate->get_errors() != null)
			{
				$erros = $validate->get_errors();
					
				if (isset($erros['erro_Nm_Responsavel'][0]) != null) $_SESSION['session_Nm_Responsavel'] = "• " . $erros['erro_Nm_Responsavel'][0] . "\n• " . $erros['erro_Nm_Responsavel'][1];
				if (isset($erros['erro_Dt_Retirada'][0]) != null) $_SESSION['session_Dt_Retirada'] = "• " . $erros['erro_Dt_Retirada'][0] . "\n• " . $erros['erro_Dt_Retirada'][1];
				if (isset($erros['erro_Nr_QuantProd'][0]) != null) $_SESSION['session_Nr_QuantProd'] = "• " . $erros['erro_Nr_QuantProd'][0] . "\n• " . $erros['erro_Nr_QuantProd'][1];
			}

			$_SESSION['session_acaoRetirada'] = $_POST['acao'];
			$_SESSION['session_modalRetirada'] = 'erro';
		}

		header("Location: ../../views/estoque/frmGerenciamentoProduto.php#retirada");
		
		break;
	}
	case 2:
	{
		$_SESSION['session_listarRetiradas'] = 'pesquisa';	
    	$_SESSION['session_pesquisaRetirada'] = utf8_decode($_POST['Ds_Pesquisa']);

		header("Location: ../../views/estoque/frmGerenciamentoProduto.php#retirada");
	
		break;
	}
}
?>