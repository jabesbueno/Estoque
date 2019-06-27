<?php
ini_set('default_charset','UTF-8'); 

include_once "../../classes/estoque/classeProduto.php";
include_once "../../dao/estoque/daoProduto.php";  
include_once '../../helpers/helper.php'; 
include '../../libraries/Data_validator.php';

session_start();

$valor = $_POST['botao'];

switch ($valor) 
{		
	case 0:
	{
		$_SESSION['session_ID_Produto'] = null;
       	$_SESSION['session_Nome'] = null;
        $_SESSION['session_Data'] = null;
		$_SESSION['session_Quantidade'] = null;
        $_SESSION['session_modalProduto'] = null;
        $_SESSION['session_acaoProduto'] = null;
	}
    case 1: 
    {		
		$validate = new Data_validator();
			
		$validate->define_pattern('erro_', '');
 
		$validate->set('Nome', $_POST['Nm_Produto'])->is_required()->min_length(2)
				 ->set('Data', $_POST['Dt_Entrada'])->is_required()->is_date()
				 ->set('Quantidade', $_POST['Nr_Quantidade'])->is_required()->is_num();

		$_SESSION['session_ID_Produto'] = $_POST['ID_Produto'];

		$produto = new DaoProduto();

		// Todos os dados foram validados com sucesso;
		if($validate->validate() && validar_data($_POST['Dt_Entrada']))
		{
			if($_POST['acao'] == 'editar')
			{
				$encoding = mb_internal_encoding();
				$Nm_Produto = mb_strtoupper($_POST['Nm_Produto'], $encoding);
				$Tp_Produto = mb_strtoupper($_POST['Tp_Produto_Oculto'], $encoding);
				$Nr_Quantidade = $_POST['Nr_Quantidade'];
				$Dt_Entrada = $_POST['Dt_Entrada'];
				$ID_Produto = $_POST['ID_Produto'];		
				// Instancia do DaoPrduto
				$update = new DaoProduto();
				// Chamando a função para atualizar o código do produto
				$Nr_Codigo = $update->quantidadeTipo($Tp_Produto);
				// Adicionando valores ao objeto
				$produto = new classeProduto($Nr_Codigo, $Nm_Produto, $Tp_Produto, $Nr_Quantidade, $Dt_Entrada, $ID_Produto);
				// Chamando função para atualizar o produto no banco de dados
				$update->atualizarProduto($produto);
			}
			else if($_POST['acao'] == 'adicionar')
			{
				if($produto->checarProduto($_POST['Nm_Produto']) == false)
				{
					// Pegando os dados inseridos pelo usuario
					$encoding = mb_internal_encoding();
					$Nm_Produto = mb_strtoupper($_POST['Nm_Produto'], $encoding);
					$Tp_Produto = mb_strtoupper($_POST['Tp_Produto'], $encoding);
					$Nr_Quantidade = $_POST['Nr_Quantidade'];
					$Dt_Entrada = $_POST['Dt_Entrada'];
					$ID_Produto = 1;
					// Instancia do DaoPrduto
					$inserir = new DaoProduto();
					// Chamando a função para pegar o código correspondente
					$Nr_Codigo = $inserir->quantidadeTipo($Tp_Produto);
					// Adicionando valores ao objeto
					$produto = new classeProduto($Nr_Codigo, $Nm_Produto, $Tp_Produto, $Nr_Quantidade, $Dt_Entrada, $ID_Produto);
					// Chamando função para inserir no banco de dados
					$inserir->inserirProduto($produto);
				}
				else
				{
					$_SESSION['session_Nome'] = "• Nome duplicado no banco de dados";

					$_SESSION['session_acaoProduto'] = $_POST['acao'];
					$_SESSION['session_modalProduto'] = 'abrir';
				}
			}
		}
		else
		{
			if(!validar_data($_POST['Dt_Entrada']))
			{
				$_SESSION['session_Data'] = "• Não permitido datas futuras";
			}

			if($validate->get_errors() != null)
			{
				$erros = $validate->get_errors();
										
				if (isset($erros['erro_Nome'][0]) != null) $_SESSION['session_Nome'] = "• " . $erros['erro_Nome'][0] . "\n• " . $erros['erro_Nome'][1];
				if (isset($erros['erro_Data'][0]) != null) $_SESSION['session_Data'] = "• " . $erros['erro_Data'][0] . "\n• " . $erros['erro_Data'][1];
				if (isset($erros['erro_Quantidade'][0]) != null) $_SESSION['session_Quantidade'] = "• " . $erros['erro_Quantidade'][0] . "\n• " . $erros['erro_Quantidade'][1];				
			}

			$_SESSION['session_acaoProduto'] = $_POST['acao'];
			$_SESSION['session_modalProduto'] = 'abrir';
		}

		header("Location: ../../views/estoque/frmGerenciamentoProduto.php#produto");

		break;
	}
	case 2: 
    {
    	$_SESSION['session_listarProdutos'] = 'pesquisa';	
    	$_SESSION['session_pesquisaProduto'] = utf8_decode($_POST['Ds_Pesquisa']);

    	header("Location: ../../views/estoque/frmGerenciamentoProduto.php#produto");

    	break;
    }
	case 3:
	{
		$delete = new DaoProduto();
		$delete->excluirProduto($_POST['ID_Produto']);
		header("Location: ../../views/estoque/frmGerenciamentoProduto.php#produto");
		break;
	}
}
?>