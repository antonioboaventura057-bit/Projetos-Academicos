-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 26-Fev-2023 às 20:12
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `biblioteca`
--

CREATE DATABASE IF NOT EXISTS biblioteca;

USE biblioteca;

-- --------------------------------------------------------

--
-- Estrutura da tabela `autor`
--

DROP TABLE IF EXISTS `autor`;
CREATE TABLE IF NOT EXISTS `autor` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `autor`
--

INSERT INTO `autor` (`ID`, `nome`) VALUES
(1, 'Rick Riordan'),
(2, 'J. K. Rowling'),
(3, 'Jeff Kinney');

-- --------------------------------------------------------

--
-- Estrutura da tabela `bairro`
--

DROP TABLE IF EXISTS `bairro`;
CREATE TABLE IF NOT EXISTS `bairro` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `bairro`
--

INSERT INTO `bairro` (`ID`, `nome`) VALUES
(1, 'Jardim Primeiro de Maio'),
(2, 'Vila Valentin'),
(3, 'Pratinha');

-- --------------------------------------------------------

--
-- Estrutura da tabela `emprestimo_devolucao_livro`
--

DROP TABLE IF EXISTS `emprestimo_devolucao_livro`;
CREATE TABLE IF NOT EXISTS `emprestimo_devolucao_livro` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `FK_LEITOR_ID` int DEFAULT NULL,
  `FK_LIVRO_ID` int DEFAULT NULL,
  `acao` varchar(10) NOT NULL,
  `quantidade_dias` int DEFAULT NULL,
  `valor_multa` decimal(15,2) DEFAULT NULL,
  `data_emprestimo` date DEFAULT NULL,
  `prazo_devolucao` date DEFAULT NULL,
  `data_devolucao` date DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_EMPRESTIMO_DEVOLUCAO_LIVRO_2` (`FK_LEITOR_ID`),
  KEY `FK_EMPRESTIMO_DEVOLUCAO_LIVRO_3` (`FK_LIVRO_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `emprestimo_devolucao_livro`
--

INSERT INTO `emprestimo_devolucao_livro` (`ID`, `FK_LEITOR_ID`, `FK_LIVRO_ID`, `acao`, `quantidade_dias`, `valor_multa`, `data_emprestimo`, `prazo_devolucao`, `data_devolucao`) VALUES
(1, 1, 1, 'Devolução', 19, '24.00', '2023-02-07', '2023-02-10', '2023-02-26'),
(8, 1, 1, 'Devolução', 0, '0.00', '2023-02-26', '2023-03-01', '2023-02-26'),
(3, 2, 2, 'Devolução', 3, '0.00', '2023-02-07', '2023-02-10', '2023-02-10'),
(4, 1, 2, 'Devolução', 1, '0.00', '2023-02-25', '2023-02-28', '2023-02-26'),
(5, 1, 3, 'Devolução', 1, '0.00', '2023-02-25', '2023-02-28', '2023-02-26'),
(6, 2, 4, 'Retirada', 0, '0.00', '2023-02-25', '2023-02-28', NULL),
(7, 2, 5, 'Retirada', 0, '0.00', '2023-02-25', '2023-02-28', NULL),
(9, 2, 6, 'Retirada', 0, '0.00', '2023-02-26', '2023-03-01', NULL),
(10, 3, 7, 'Retirada', 0, '0.00', '2023-02-26', '2023-03-01', NULL),
(11, 4, 8, 'Retirada', 0, '0.00', '2023-02-26', '2023-03-01', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `leitor`
--

DROP TABLE IF EXISTS `leitor`;
CREATE TABLE IF NOT EXISTS `leitor` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `nome_completo` varchar(100) NOT NULL,
  `CPF` varchar(14) NOT NULL,
  `telefone` varchar(13) NOT NULL,
  `foto` varchar(100) DEFAULT NULL,
  `quantidade_livros` int DEFAULT NULL,
  `total_multas` decimal(15,2) DEFAULT NULL,
  `FK_BAIRRO_ID` int DEFAULT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `CPF` (`CPF`),
  KEY `FK_LEITOR_2` (`FK_BAIRRO_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `leitor`
--

INSERT INTO `leitor` (`ID`, `nome_completo`, `CPF`, `telefone`, `foto`, `quantidade_livros`, `total_multas`, `FK_BAIRRO_ID`) VALUES
(1, 'Bruno Mantovani', '170.725.542-38', '19 12414-1077', 'Array', 0, '0.00', NULL),
(2, 'Heloisa Mariano', '263.219.610-71', '19 32153-8891', 'Array', 3, NULL, NULL),
(3, 'Larrisa Teixeira', '015.344.478-90', '81 32420-1422', '', 1, NULL, NULL),
(4, 'Julia Moreira', '823.435.962-20', '34 31244-6581', 'Array', 1, NULL, NULL),
(5, 'Antônio Mariano', '998.175.346-77', '81 12672-1884', 'Array', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `livro`
--

DROP TABLE IF EXISTS `livro`;
CREATE TABLE IF NOT EXISTS `livro` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `estilo` varchar(45) NOT NULL,
  `disponivel` tinyint(1) NOT NULL,
  `FK_AUTOR_ID` int DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_LIVRO_2` (`FK_AUTOR_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `livro`
--

INSERT INTO `livro` (`ID`, `nome`, `estilo`, `disponivel`, `FK_AUTOR_ID`) VALUES
(1, 'Percy Jackson e o Mar de Monstros', 'Aventura', 0, NULL),
(2, 'Harry Potter e a Câmara Secreta', 'Mistério', 0, NULL),
(3, 'Diário de um Banana', 'Romance', 0, NULL),
(4, 'O Cortiço', 'Romance', 1, NULL),
(5, 'Pequenos incêndios por toda parte', 'Mistério', 1, NULL),
(6, 'Invenção de Hugo Cabret', 'Aventura', 1, NULL),
(7, 'Fallen', 'Mistério', 1, NULL),
(8, 'Steve Jobs', 'Biografia', 1, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_admin`
--

DROP TABLE IF EXISTS `usuario_admin`;
CREATE TABLE IF NOT EXISTS `usuario_admin` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `login` varchar(45) NOT NULL,
  `senha` varchar(45) NOT NULL,
  PRIMARY KEY (`ID`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `usuario_admin`
--

INSERT INTO `usuario_admin` (`ID`, `login`, `senha`) VALUES
(1, 'user01', 'admin');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
