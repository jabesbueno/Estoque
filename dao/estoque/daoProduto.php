<?php
ini_set('default_charset','UTF-8'); 

include_once "../../classes/estoque/classeProduto.php";
include_once "../../classes/classeConexao.php";

class DaoProduto
{
	public function checarProduto($nome_produto) 
	{
	  	try
	  	{
			$conec = conec::conecta_mysql("localhost","root","","db_estoque");
			$select = $conec->prepare("SELECT Nm_Produto FROM TB_Produto WHERE Nm_Produto = :Nm_Produto");
			$select->bindValue(":Nm_Produto", $nome_produto);
            $select->execute();
		} 
		catch(Exception $e) 
		{
			print "Não chegou";
		} 	
		
		if ($select->rowCount() > 0) return true;

		return false;
    }

    public function inserirProduto(classeProduto $produto) 
    {
	  	try
	  	{
			$conec = conec::conecta_mysql("localhost","root","","db_estoque");
			$insert = $conec->prepare("INSERT INTO TB_Produto(Nr_Codigo, Nm_Produto, Tp_Produto, Nr_Quantidade, Dt_Entrada) VALUES(:Nr_Codigo, :Nm_Produto, :Tp_Produto, :Nr_Quantidade, :Dt_Entrada)");
			$insert->bindValue(":Nr_Codigo", $produto->get_Nr_Codigo());
			$insert->bindValue(":Nm_Produto", utf8_decode($produto->get_Nm_Produto()));
			$insert->bindValue(":Tp_Produto", utf8_decode($produto->get_Tp_Produto()));
			$insert->bindValue(":Nr_Quantidade", $produto->get_Nr_Quantidade());
			$insert->bindValue(":Dt_Entrada", $produto->get_Dt_Entrada());
			$insert->execute();
		}
		catch(Exception $e)
		{
			print "Não chegou";
		} 
    }
	
	public function atualizarProduto(classeProduto $produto)
	{
		try
		{
			$conec = conec::conecta_mysql("localhost","root","","db_estoque");
			$update = $conec->prepare("UPDATE TB_Produto SET Nm_Produto = :Nm_Produto, Tp_Produto = :Tp_Produto, Nr_Quantidade = :Nr_Quantidade, Dt_Entrada = :Dt_Entrada WHERE ID_Produto = :ID_Produto");
			$update->bindValue(":Nm_Produto", utf8_decode($produto->get_Nm_Produto()));
			$update->bindValue(":Tp_Produto", utf8_decode($produto->get_Tp_Produto()));
			$update->bindValue(":Nr_Quantidade", $produto->get_Nr_Quantidade());
			$update->bindValue(":Dt_Entrada", $produto->get_Dt_Entrada());
			$update->bindValue(":ID_Produto", $produto->get_ID_Produto());
			$update->execute();
		}
		catch(Exception $e)
		{
			print "Não chegou";
		} 
	}
	
	public function buscaProdutoESP($nome_produto) 
	{
	  	try
	  	{
			$conec = conec::conecta_mysql("localhost","root","","db_estoque");
			$select = $conec->prepare("SELECT ID_Produto, Nr_Codigo, Nm_Produto, Tp_Produto, Nr_Quantidade, Dt_Entrada FROM TB_Produto WHERE Nm_Produto LIKE '%" . $nome_produto . "%' ORDER BY Tp_Produto, Nr_Codigo");
            $select->execute();
		}
		catch(Exception $e)
		{
			print "Não chegou";
		} 	

		return $select;
    }

	public function buscaProduto() 
	{
	  	try
	  	{
			$conec = conec::conecta_mysql("localhost","root","","db_estoque");
			$select = $conec->prepare("SELECT ID_Produto, Nr_Codigo, Nm_Produto, Tp_Produto, Nr_Quantidade, Dt_Entrada FROM TB_Produto ORDER BY Tp_Produto, Nr_Codigo");
            $select->execute();
		}
		catch(Exception $e)
		{
			print "Não chegou";
		} 	

		return $select;
    }
	
	public function quantidadeTipo($tipo)
	{
		$quantidade = 1;

		try
		{
			$conec = conec::conecta_mysql("localhost","root","","db_estoque");
			$select = $conec->prepare("SELECT ID_Produto FROM TB_Produto WHERE Tp_Produto = :Tp_Produto");
			$select->bindValue(":Tp_Produto", $tipo);
			$select->execute();
			$quantidade +=  $select->rowCount();
		}
		catch(Exception $e)
		{
			print "Não chegou";
		}
		finally
		{
			return $quantidade;
		}
	}
	
	public function excluirProduto($ID_Produto) 
	{
	  	try
	  	{
			$conec = conec::conecta_mysql("localhost","root","","db_estoque");
			$delete = $conec->prepare("DELETE FROM TB_Produto WHERE ID_Produto = :ID_Produto");
			$delete->bindValue(":ID_Produto", $ID_Produto);
            $delete->execute();
		}
		catch(Exception $e)
		{
			print "Não chegou";
		} 	
    }
}