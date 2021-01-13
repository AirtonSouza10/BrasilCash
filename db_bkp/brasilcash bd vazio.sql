-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 02-Jun-2020 às 15:36
-- Versão do servidor: 10.4.10-MariaDB
-- versão do PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `oticasbrasildf`
--

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `contasapagar`
-- (Veja abaixo para a view atual)
--
DROP VIEW IF EXISTS `contasapagar`;
CREATE TABLE IF NOT EXISTS `contasapagar` (
`MesAno` int(6)
,`year` int(4)
,`month` varchar(64)
,`fornecedor` varchar(100)
,`soma` varchar(416)
);

-- --------------------------------------------------------

--
-- Estrutura stand-in para vista `contaspg`
-- (Veja abaixo para a view atual)
--
DROP VIEW IF EXISTS `contaspg`;
CREATE TABLE IF NOT EXISTS `contaspg` (
`MesAno` int(6)
,`year` int(4)
,`month` varchar(64)
,`fornecedor` varchar(100)
,`soma` double
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `fatura`
--

DROP TABLE IF EXISTS `fatura`;
CREATE TABLE IF NOT EXISTS `fatura` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Loja_id` int(11) NOT NULL,
  `Operador_id` int(11) NOT NULL,
  `Fornecedor_id` int(11) NOT NULL,
  `prazo_id` int(11) NOT NULL,
  `Situacao_id` int(11) NOT NULL,
  `notafiscal` varchar(45) DEFAULT NULL,
  `datacompra` date DEFAULT NULL,
  `datavencimento` date DEFAULT NULL,
  `datapgto` date DEFAULT NULL,
  `total` double DEFAULT NULL,
  `valorPr` double DEFAULT NULL,
  `dtbaixa` date DEFAULT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `numPr` int(11) NOT NULL,
  `duplicata` varchar(45) DEFAULT NULL,
  `tipo` varchar(45) DEFAULT NULL,
  `juro` double DEFAULT 0,
  PRIMARY KEY (`id`,`Loja_id`,`Operador_id`,`Fornecedor_id`,`prazo_id`,`Situacao_id`),
  KEY `Loja_id` (`Loja_id`),
  KEY `Operador_id` (`Operador_id`),
  KEY `Fornecedor_id` (`Fornecedor_id`),
  KEY `prazo_id` (`prazo_id`),
  KEY `Situacao_id` (`Situacao_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2217 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `fatura`
--

INSERT INTO `fatura` (`id`, `Loja_id`, `Operador_id`, `Fornecedor_id`, `prazo_id`, `Situacao_id`, `notafiscal`, `datacompra`, `datavencimento`, `datapgto`, `total`, `valorPr`, `dtbaixa`, `obs`, `numPr`, `duplicata`, `tipo`, `juro`) VALUES
(2210, 14, 7, 21, 30, 2, '123456', '2020-06-02', '2020-06-12', '2020-06-02', 1500, 1500, '2020-06-02', 'FORNECEDOR DE MATERIAIS DE INFORMÁTICA', 1, '123456/A', 'Titulo', 0),
(2211, 15, 7, 23, 29, 2, '78910', '2020-06-01', '2020-06-02', '2020-06-02', 15000, 3000, '2020-06-02', '', 1, '78910/1', 'Titulo', 0),
(2212, 15, 7, 23, 29, 1, '78910', '2020-06-01', '2020-06-01', NULL, 15000, 3000, NULL, '', 2, '78910/2', 'Titulo', 0),
(2213, 15, 7, 23, 29, 1, '78910', '2020-06-01', '2020-08-30', NULL, 15000, 3000, NULL, '', 3, '78910/3', 'Titulo', 0),
(2214, 15, 7, 23, 29, 1, '78910', '2020-06-01', '2020-09-29', NULL, 15000, 3000, NULL, '', 4, '78910/4', 'Titulo', 0),
(2215, 15, 7, 23, 29, 1, '78910', '2020-06-01', '2020-06-02', NULL, 15000, 3000, NULL, '', 5, '78910/5', 'Titulo', 0),
(2216, 14, 7, 24, 30, 2, '12544888777', '2020-05-22', '2020-06-01', '2020-06-02', 17000, 17000, '2020-06-02', '', 1, '12544888777', 'Imposto', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedor`
--

DROP TABLE IF EXISTS `fornecedor`;
CREATE TABLE IF NOT EXISTS `fornecedor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `Razao` varchar(100) DEFAULT NULL,
  `Telefone` varchar(14) DEFAULT NULL,
  `cnpj` varchar(18) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `fornecedor`
--

INSERT INTO `fornecedor` (`id`, `Razao`, `Telefone`, `cnpj`) VALUES
(21, 'CONEXÃO IMPORTADORA EIRELI', '61995295577', '01020304050607'),
(22, 'BOX DROUBLE IMPORTADORA', '61995295579', '88888888888888'),
(23, 'MARTELLI IMPORTADOS', '61995295578', '77777777777777'),
(24, 'SIMPLES NACIONAL', '', 'SIMPLES NACIONAL');

-- --------------------------------------------------------

--
-- Estrutura da tabela `loja`
--

DROP TABLE IF EXISTS `loja`;
CREATE TABLE IF NOT EXISTS `loja` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `razao` varchar(100) DEFAULT NULL,
  `cnpj` varchar(18) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `loja`
--

INSERT INTO `loja` (`id`, `razao`, `cnpj`) VALUES
(15, 'FILIAL 01', '36547896521214'),
(14, 'LOJA MATRIZ', '12345678910112');

-- --------------------------------------------------------

--
-- Estrutura da tabela `operador`
--

DROP TABLE IF EXISTS `operador`;
CREATE TABLE IF NOT EXISTS `operador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(45) DEFAULT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `senha` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `operador`
--

INSERT INTO `operador` (`id`, `nome`, `cpf`, `senha`) VALUES
(8, 'FULANO DE TAL', '78911236545', 'e10adc3949ba59abbe56e057f20f883e'),
(7, 'usuário teste', '123', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Estrutura da tabela `prazo`
--

DROP TABLE IF EXISTS `prazo`;
CREATE TABLE IF NOT EXISTS `prazo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(45) DEFAULT NULL,
  `diasDif` int(11) DEFAULT NULL,
  `qtdePr` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `prazo`
--

INSERT INTO `prazo` (`id`, `descricao`, `diasDif`, `qtdePr`) VALUES
(28, '30/60/90/120', 30, 4),
(29, '30/60/90/120/150', 30, 5),
(30, '10 DIAS', 10, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `situacao`
--

DROP TABLE IF EXISTS `situacao`;
CREATE TABLE IF NOT EXISTS `situacao` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `stattus` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `situacao`
--

INSERT INTO `situacao` (`id`, `stattus`) VALUES
(1, 'Em aberto'),
(2, 'Pago'),
(3, 'Cancelado'),
(4, 'Negociado'),
(7, 'Protestado');

-- --------------------------------------------------------

--
-- Estrutura para vista `contasapagar`
--
DROP TABLE IF EXISTS `contasapagar`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `contasapagar`  AS  select extract(year_month from `f`.`datavencimento`) AS `MesAno`,year(`f`.`datavencimento`) AS `year`,date_format(`f`.`datavencimento`,'%M') AS `month`,`fd`.`Razao` AS `fornecedor`,format(sum(`f`.`valorPr`),2,'de_DE') AS `soma` from (((((`fatura` `f` join `loja` `lj`) join `fornecedor` `fd`) join `prazo` `pz`) join `operador` `op`) join `situacao` `st`) where `f`.`Operador_id` = `op`.`id` and `f`.`Fornecedor_id` = `fd`.`id` and `f`.`prazo_id` = `pz`.`id` and `f`.`Situacao_id` = `st`.`id` and `f`.`Loja_id` = `lj`.`id` and `f`.`Situacao_id` = 1 or `f`.`Operador_id` = `op`.`id` and `f`.`Fornecedor_id` = `fd`.`id` and `f`.`prazo_id` = `pz`.`id` and `f`.`Situacao_id` = `st`.`id` and `f`.`Loja_id` = `lj`.`id` and `f`.`Situacao_id` = 4 or `f`.`Operador_id` = `op`.`id` and `f`.`Fornecedor_id` = `fd`.`id` and `f`.`prazo_id` = `pz`.`id` and `f`.`Situacao_id` = `st`.`id` and `f`.`Loja_id` = `lj`.`id` and `f`.`Situacao_id` = 7 group by extract(year_month from `f`.`datavencimento`),`fd`.`Razao` order by extract(year_month from `f`.`datavencimento`) ;

-- --------------------------------------------------------

--
-- Estrutura para vista `contaspg`
--
DROP TABLE IF EXISTS `contaspg`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `contaspg`  AS  select extract(year_month from `f`.`datavencimento`) AS `MesAno`,year(`f`.`datavencimento`) AS `year`,date_format(`f`.`datavencimento`,'%M') AS `month`,`fd`.`Razao` AS `fornecedor`,sum(`f`.`valorPr`) AS `soma` from (((((`fatura` `f` join `loja` `lj`) join `fornecedor` `fd`) join `prazo` `pz`) join `operador` `op`) join `situacao` `st`) where `f`.`Operador_id` = `op`.`id` and `f`.`Fornecedor_id` = `fd`.`id` and `f`.`prazo_id` = `pz`.`id` and `f`.`Situacao_id` = `st`.`id` and `f`.`Loja_id` = `lj`.`id` and `f`.`Situacao_id` = 1 or `f`.`Operador_id` = `op`.`id` and `f`.`Fornecedor_id` = `fd`.`id` and `f`.`prazo_id` = `pz`.`id` and `f`.`Situacao_id` = `st`.`id` and `f`.`Loja_id` = `lj`.`id` and `f`.`Situacao_id` = 4 or `f`.`Operador_id` = `op`.`id` and `f`.`Fornecedor_id` = `fd`.`id` and `f`.`prazo_id` = `pz`.`id` and `f`.`Situacao_id` = `st`.`id` and `f`.`Loja_id` = `lj`.`id` and `f`.`Situacao_id` = 7 group by extract(year_month from `f`.`datavencimento`),`fd`.`Razao` order by extract(year_month from `f`.`datavencimento`) ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
