<?php
ini_set('default_charset','UTF-8'); 

include_once "../../classes/estoque/classeUsuario.php";
include_once "../../dao/estoque/daoUsuario.php";  
include '../../libraries/Data_validator.php';

session_start();

$valor = $_POST['botao'];

switch ($valor) 
{		
	case 0:
	{
		$_SESSION['session_ID_Usuario'] = null;
       	$_SESSION['session_Usuario'] = null;
        $_SESSION['session_Senha'] = null;
		$_SESSION['session_Confirmar'] = null;
		$_SESSION['session_Cpf'] = null;
		$_SESSION['session_modalUsuario'] = null;
		$_SESSION['session_validaSenha'] = null;
		$_SESSION['session_acaoUsuario'] = null;
	}
    case 1: //Inserindo usuсrio
    {		
		$validate = new Data_validator();
			
		$validate->define_pattern('erro_', '');
 
		$validate->set('Usuario', $_POST['Nm_Usuario'])->is_required()
				 ->set('Senha', $_POST['Ds_Senha'])->is_required()
				 ->set('Confirmar', $_POST['confirmar'])->is_required()
				 ->set('Cpf', $_POST['Nr_Cpf'])->is_required();

		$_SESSION['session_ID_Usuario'] = $_POST['ID_Usuario'];

		// Todos os dados foram validados com sucesso;
		if($validate->validate() && ($_POST['Ds_Senha'] == $_POST['confirmar']))
		{
			if($_POST['acao'] == 'adicionar')
			{
				// Pegando os dados inseridos pelo usuario
				$encoding = mb_internal_encoding();
				$Nm_Usuario = mb_strtoupper($_POST['Nm_Usuario'],$encoding);
				$Ds_Senha = sha1($_POST['Ds_Senha']);
				$Nr_Cpf = $_POST['Nr_Cpf'];
				$ID_Usuario = $_POST['ID_Usuario'];
				// Instancia do DaoUsuario
				$inserir = new DaoUsuario();
				// Adicionando valores ao objeto
				$usuario = new classeUsuario($Nm_Usuario, $Ds_Senha, $Nr_Cpf, $ID_Usuario);
				// Chamando funчуo para inserir no banco de dados
				$inserir->inserirUsuario($usuario);
			}
			else
			{
				if(($_POST['Ds_Senha'] != $_POST['confirmar']))
				{
					$_SESSION['session_validaSenha'] = 'Senhas divergentes';
				}
				
				$_SESSION['session_acaoUsuario'] = $_POST['acao'];
				$_SESSION['session_modalUsuario'] = 'abrir';
			}
		}
		else
		{
			if($validate->get_errors() != null)
			{
				$erros = $validate->get_errors();
										
				if (isset($erros['erro_Usuario'][0]) != null) $_SESSION['session_Usuario'] = " " . $erros['erro_Usuario'][0];
				if (isset($erros['erro_Senha'][0]) != null) $_SESSION['session_Senha'] = " " . $erros['erro_Senha'][0];
				if (isset($erros['erro_Confirmar'][0]) != null) $_SESSION['session_Confirmar'] = " " . $erros['erro_Confirmar'][0];
				if (isset($erros['erro_Cpf'][0]) != null) $_SESSION['session_Cpf'] = " " . $erros['erro_Cpf'][0];				
			}
			$_SESSION['session_modalUsuario'] = 'abrir';
			$_SESSION['session_acaoUsuario'] = $_POST['acao'];
			$_SESSION['session_validaSenha'] = 'Senhas divergentes';
			
			$_SESSION['session_validarUsuario'] = null;
			$_SESSION['session_validarSenha'] = null;
			$_SESSION['session_validaLogin'] = null;
		}

		header("Location: ../../views/frmTelaLogin.php");

		break;
	}
	case 2: //Validando login
    {
		$validate = new Data_validator();
			
		$validate->define_pattern('erro_', '');
 
		$validate->set('validarUsuario', $_POST['Nm_Usuario'])->is_required()
				 ->set('validarSenha', $_POST['Ds_Senha'])->is_required();
		
		if($validate->validate())
		{
			
				// Pegando os dados inseridos pelo usuario
				$encoding = mb_internal_encoding();
				$Nm_Usuario = mb_strtoupper($_POST['Nm_Usuario'],$encoding);
				$Ds_Senha = $_POST['Ds_Senha'];
				$Nr_Cpf = '1';
				$ID_Usuario = 1;
				// Instancia do DaoUsuario
				$select = new DaoUsuario();
				// Adicionando valores ao objeto
				$usuario = new classeUsuario($Nm_Usuario, $Ds_Senha, $Nr_Cpf, $ID_Usuario);
				// Chamando funчуo para inserir no banco de dados
				$valida = $select->validaUsuario($usuario);
				
				$_SESSION['session_validarUsuario'] = null;
				$_SESSION['session_validarSenha'] = null;
				$_SESSION['session_validaLogin'] = null;
				if($valida == 0)
				{
					$_SESSION['session_validarUsuario'] = null;
					$_SESSION['session_validarSenha'] = null;
					$_SESSION['session_validaLogin'] = 'Usuario ou Senha incorreto(s)';
					header("Location: ../../views/frmTelaLogin.php");
				}
				else
				{
					$_SESSION['session_validaLogin'] = null;
					$_SESSION['session_validarUsuario'] = null;
					$_SESSION['session_validarSenha'] = null;
					$_SESSION['session_Logado'] = $_POST['Nm_Usuario'];
					header("Location: ../../views/frmTelaPrincipal.php");
				}
			
		}
		else
		{
			if($validate->get_errors() != null)
			{
				$erros = $validate->get_errors();
										
				if (isset($erros['erro_validarUsuario'][0]) != null) $_SESSION['session_validarUsuario'] = " " . $erros['erro_validarUsuario'][0];
				if (isset($erros['erro_validarSenha'][0]) != null) $_SESSION['session_validarSenha'] = " " . $erros['erro_validarSenha'][0];				
			}
			$_SESSION['session_validaLogin'] = null;
			header("Location: ../../views/frmTelaLogin.php");
		}		 
    	break;
    }
}
?>