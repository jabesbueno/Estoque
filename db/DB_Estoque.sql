-- DATABASE

DROP DATABASE IF EXISTS DB_Estoque;
CREATE DATABASE IF NOT EXISTS DB_Estoque;
USE DB_Estoque;

-- TABELAS


DROP TABLE IF EXISTS TB_Retirada;
DROP TABLE IF EXISTS TB_Produto;
DROP TABLE IF EXISTS TB_Usuario;

-- Estoque
CREATE TABLE TB_Usuario (
	ID_Usuario int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	Nm_Usuario varchar(30) NOT NULL,
	Ds_Senha varchar(300) NOT NULL,
	Nr_Cpf char(14) NOT NULL
) Engine=InnoDB;

CREATE TABLE TB_Produto (
	ID_Produto int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	Nr_Codigo int NOT NULL,
	Nm_Produto varchar(100) NOT NULL,
	Tp_Produto varchar(20) NOT NULL,
	Nr_Quantidade int NOT NULL,
	Dt_Entrada date NOT NULL
) Engine=InnoDB;

CREATE TABLE TB_Retirada (
	ID_Retirada int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	ID_Produto int NOT NULL,
	Nr_QuantProd int NOT NULL,
	Dt_Retirada date NOT NULL,
	Nm_Responsavel varchar(100) NOT NULL
) Engine=InnoDB;
ALTER TABLE TB_Retirada
ADD CONSTRAINT FK_Retirada_Produto
FOREIGN KEY(ID_Produto) REFERENCES TB_Produto(ID_Produto)
ON DELETE CASCADE;
