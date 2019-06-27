<?php
ini_set('default_charset','UTF-8'); 

include_once "../../classes/estoque/classeUsuario.php";
include_once "../../classes/classeConexao.php";

class DaoUsuario
{
	public function inserirUsuario(classeUsuario $usuario) 
    {
	  	try
	  	{
			$conec = conec::conecta_mysql("localhost","root","","db_estoque");
			$insert = $conec->prepare("INSERT INTO TB_Usuario(Nm_Usuario, Ds_Senha, Nr_Cpf) VALUES(:Nm_Usuario, :Ds_Senha, :Nr_Cpf)");
			$insert->bindValue(":Nm_Usuario", $usuario->get_Nm_Usuario());
			$insert->bindValue(":Ds_Senha", $usuario->get_Ds_Senha());
			$insert->bindValue(":Nr_Cpf", $usuario->get_Nr_Cpf());
			$insert->execute();
		}
		catch(Exception $e)
		{
			echo "Erro ".$e;
		} 
    }
	
	public function atualizarUsuario(classeUsuario $usuario)
	{
		try
		{
			$conec = conec::conecta_mysql("localhost","root","","db_estoque");
			$update = $conec->prepare("UPDATE TB_Usuario SET Nm_Usuario = :Nm_Usuario, Ds_Senha = :Ds_Senha, Nr_Cpf = :Nr_Cpf WHERE ID_Usuario = :ID_Usuario");
			$update->bindValue(":Nm_Usuario", $usuario->get_Nm_Usuario());
			$update->bindValue(":Ds_Senha", $usuario->get_Ds_Senha());
			$update->bindValue(":Nr_Cpf", $usuario->get_Nr_Cpf());
			$update->bindValue(":ID_Usuario", $usuario->get_ID_Usuario());
			$update->execute();
		}
		catch(Exception $e)
		{
			echo "Erro ".$e;
		} 
	}
	
	public function buscaUsuario() 
	{
	  	try
	  	{
			$conec = conec::conecta_mysql("localhost","root","","db_estoque");
			$select = $conec->prepare("SELECT ID_Usuario, Nm_Usuario, Nr_Cpf FROM TB_Usuario");
            $select->execute();
		}
		catch(Exception $e)
		{
			echo "Erro ".$e;
		} 	

		return $select;
    }
	
	public function validaUsuario(classeUsuario $usuario)
	{
	      $count=0;
	    try{
	      $conec = conec::conecta_mysql("localhost","root","","db_estoque");
          $result = $conec->prepare("SELECT * FROM TB_Usuario WHERE Nm_Usuario = :Nm_Usuario and Ds_Senha = sha1(:Ds_Senha)");
		  $result->bindValue(":Nm_Usuario",$usuario->get_Nm_Usuario());
		  $result->bindValue(":Ds_Senha",$usuario->get_Ds_Senha());
		  $result->execute();
		  $count =  $result->rowCount();
		}catch(Exception $e){
		  echo "Erro ".$e;
		}  
		return $count;
	}
}
?>