<?php
ini_set('default_charset','UTF-8'); 

include_once "../../classes/estoque/classeRetirada.php";
include_once "../../classes/classeConexao.php";

class DaoRetirada
{
	public function retornarDataEntrada($id_produto)
	{
		try{
			$conec = conec::conecta_mysql("localhost","root","","db_estoque");
			$select = $conec->prepare("SELECT Dt_Entrada FROM TB_Produto WHERE ID_Produto = :ID_Produto");
			$select->bindValue(":ID_Produto", $id_produto);
			$select->execute();
			
		}catch(Exception $e){
			print "Não chegou";
		} 
		while($select2 = $select->fetch())
		{
			$busca = $select2["Dt_Entrada"];	
		}
				
		return $busca;
	}

	public function retornarIDProduto($nome_produto) 
	{
	  	try
	  	{
			$conec = conec::conecta_mysql("localhost","root","","db_estoque");
			$select = $conec->prepare("SELECT ID_Produto AS ID_ProdutoR FROM TB_Produto WHERE Nm_Produto = :Nm_Produto");
			$select->bindValue(":Nm_Produto", $nome_produto);
			$select->execute();
			
		}catch(Exception $e){
			print "Não chegou";
		} 
		while($select2 = $select->fetch())
		{
			$busca = $select2["ID_ProdutoR"];	
		}
				
		return $busca;
    }

	public function retornarNomeProduto($id_produto) 
	{
	  	try
	  	{
			$conec = conec::conecta_mysql("localhost","root","","db_estoque");
			$select = $conec->prepare("SELECT Nm_Produto AS Nm_ProdutoR FROM TB_Produto WHERE ID_Produto = :ID_Produto");
			$select->bindValue(":ID_Produto", $id_produto);
			$select->execute();
			
		} 
		catch(Exception $e)
		{
			print "Não chegou";
		} 
		while($select2 = $select->fetch())
		{
			$busca = $select2["Nm_ProdutoR"];	
		}
				
		return $busca;
    }
	
	public function retornarQuantidadeProduto($id_produto) 
	{
	  	try
	  	{
			$conec = conec::conecta_mysql("localhost","root","","db_estoque");
			$select = $conec->prepare("SELECT Nr_Quantidade FROM TB_Produto WHERE ID_Produto = :ID_Produto");
			$select->bindValue(":ID_Produto", $id_produto);
			$select->execute();
			
		}
		catch(Exception $e)
		{
			print "Não chegou";
		} 
		while($select2 = $select->fetch() )
		{
			$busca = $select2["Nr_Quantidade"];	
		}
		
		return $busca;
    }

    public function inserirRetirada(classeRetirada $retirada) 
    {
	  	try
	  	{	
			$conec = conec::conecta_mysql("localhost","root","","db_estoque");
			$select = $conec->prepare("SELECT Nr_Quantidade FROM TB_Produto WHERE ID_Produto = :ID_Produto");
			$select->bindValue(":ID_Produto", $retirada->get_ID_ProdutoR());
			$select->execute();
			
			while($select2 = $select->fetch())
			{
				$busca = $select2["Nr_Quantidade"];	
			}
						
			if($busca - $retirada->get_Nr_QuantProd() < 0)
			{
				print "ERRO: A quantidade retirada é maior que a quantidade em estoque!";
			}
			else
			{				
				$insert = $conec->prepare("INSERT INTO TB_Retirada(ID_Produto, Nr_QuantProd, Dt_Retirada, Nm_Responsavel) VALUES(:ID_Produto, :Nr_QuantProd, :Dt_Retirada, :Nm_Responsavel)");				
				$insert->bindValue(":ID_Produto", $retirada->get_ID_ProdutoR());	
				$insert->bindValue(":Nr_QuantProd", $retirada->get_Nr_QuantProd());
				$insert->bindValue(":Dt_Retirada", $retirada->get_Dt_Retirada());
				$insert->bindValue(":Nm_Responsavel", $retirada->get_Nm_Responsavel());
				$insert->execute();
				
				$update = $conec->prepare("UPDATE TB_Produto SET Nr_Quantidade = Nr_Quantidade - :Nr_QuantProd WHERE ID_Produto = :ID_Produto");
				$update->bindValue(":ID_Produto", $retirada->get_ID_ProdutoR());
				$update->bindValue(":Nr_QuantProd", $retirada->get_Nr_QuantProd());
				$update->execute();
			}
		}
		catch(Exception $e)
		{
			print "Não chegou";
		} 
    }
	
	public function atualizarRetirada(classeRetirada $retirada)
	{
		try
		{
			$conec = conec::conecta_mysql("localhost","root","","db_estoque");
			$select = $conec->prepare("SELECT Nr_QuantProd FROM TB_Retirada WHERE ID_Retirada = :ID_Retirada");
			$select->bindValue(":ID_Retirada", $retirada->get_ID_Retirada());
			$select->execute();
			
			while($select2 = $select->fetch())
			{
				$busca = $select2["Nr_QuantProd"];	
			}
			
			$select3 = $conec->prepare("SELECT Nr_Quantidade FROM TB_Produto WHERE ID_Produto = :ID_Produto");
			$select3->bindValue(":ID_Produto", $retirada->get_ID_ProdutoR());
			$select3->execute();

			while($select4 = $select3->fetch())
			{
				$busca2 = $select4["Nr_Quantidade"];	
			}	
			
			if(($busca + $busca2) - ($retirada->get_Nr_QuantProd()) > 0)
			{
				if($busca > ($retirada->get_Nr_QuantProd()))
				{	
					$quantidade = $busca - $retirada->get_Nr_QuantProd();
				
					$atualiza = $conec->prepare("UPDATE TB_Produto SET Nr_Quantidade = Nr_Quantidade + :Nr_QuantProd WHERE ID_Produto = :ID_Produto");
					$atualiza->bindValue(":Nr_QuantProd", $quantidade);
					$atualiza->bindValue(":ID_Produto", $retirada->get_ID_ProdutoR());
					$atualiza->execute();
				}
				else if($busca < ($retirada->get_Nr_QuantProd()))
				{			
					$quantidade = $retirada->get_Nr_QuantProd() - $busca;
								
					$atualiza = $conec->prepare("UPDATE TB_Produto SET Nr_Quantidade = Nr_Quantidade - :Nr_QuantProd WHERE ID_Produto = :ID_Produto");
					$atualiza->bindValue(":Nr_QuantProd", $quantidade);
					$atualiza->bindValue(":ID_Produto", $retirada->get_ID_ProdutoR());
					$atualiza->execute();
				}
			
				$update = $conec->prepare("UPDATE TB_Retirada SET Nr_QuantProd = :Nr_QuantProd, Dt_Retirada = :Dt_Retirada, Nm_Responsavel = :Nm_Responsavel WHERE ID_Retirada = :ID_Retirada");
				$update->bindValue(":Nr_QuantProd", $retirada->get_Nr_QuantProd());
				$update->bindValue(":Dt_Retirada", $retirada->get_Dt_Retirada());
				$update->bindValue(":Nm_Responsavel", $retirada->get_Nm_Responsavel());
				$update->bindValue(":ID_Retirada", $retirada->get_ID_Retirada());
				$update->execute();
			}
			
		}
		catch(Exception $e)
		{
			print "Não chegou";
		} 
	}

	public function buscaRetiradaESP($nome_produto) 
	{
	  	try
	  	{
			$conec = conec::conecta_mysql("localhost","root","","db_estoque");
			$select = $conec->prepare("SELECT r.ID_Retirada, r.ID_Produto AS ID_ProdutoR, r.Nr_QuantProd, r.Dt_Retirada, r.Nm_Responsavel, p.Nm_Produto AS Nm_ProdutoR, p.Nr_Quantidade FROM TB_Retirada AS r INNER JOIN TB_Produto AS p on r.ID_Produto = p.ID_Produto WHERE Nm_Produto LIKE '%" . $nome_produto . "%' ORDER BY r.Dt_Retirada >= p.Dt_Entrada DESC, p.ID_Produto, r.ID_Retirada DESC");
            $select->execute();
		}
		catch(Exception $e)
		{
			print "Não chegou";
		} 	

		return $select;
    }
	
	public function buscaRetirada() 
	{
	  	try
	  	{
			$conec = conec::conecta_mysql("localhost","root","","db_estoque");
			$select = $conec->prepare("SELECT r.ID_Retirada, r.ID_Produto AS ID_ProdutoR, r.Nr_QuantProd, r.Dt_Retirada, r.Nm_Responsavel, p.Nm_Produto AS Nm_ProdutoR, p.Nr_Quantidade FROM TB_Retirada AS r INNER JOIN TB_Produto AS p on r.ID_Produto = p.ID_Produto ORDER BY r.Dt_Retirada >= p.Dt_Entrada DESC, p.ID_Produto, r.ID_Retirada DESC");
            $select->execute();
		} 
		catch(Exception $e) 
		{
			print "Não chegou";
		} 	
		return $select;
    }
}