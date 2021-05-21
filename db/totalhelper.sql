-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Maio-2021 às 14:18
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `totalhelper`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `accounts`
--

CREATE TABLE `accounts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `accounts`
--

INSERT INTO `accounts` (`id`, `name`, `username`, `password`, `email`, `role`) VALUES
(1, 'Renan', 'renan', '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'test@test.com', 'admin'),
(2, 'João', 'joao', '$2y$10$SfhYIDtn.iOuCW7zfoFLuuZHX6lja4lF4XA4JqNmpiH/.P3zB8JCa', 'email@email.com', 'teacher'),
(3, 'Maria', 'maria', '123456', 'maria@email.com', 'teacher');

-- --------------------------------------------------------

--
-- Estrutura da tabela `calendar`
--

CREATE TABLE `calendar` (
  `id` int(11) NOT NULL,
  `id_teacher` int(11) NOT NULL,
  `id_client` int(11) NOT NULL,
  `date` date NOT NULL,
  `class` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `calendar`
--

INSERT INTO `calendar` (`id`, `id_teacher`, `id_client`, `date`, `class`) VALUES
(4, 2, 4923, '2021-01-13', 1),
(5, 2, 4923, '2021-01-13', 2),
(8, 2, 4923, '2021-03-12', 4),
(9, 2, 4923, '2021-03-12', 5),
(10, 2, 4920, '2021-03-12', 5),
(11, 2, 4920, '2021-03-12', 6),
(12, 2, 4923, '2021-03-12', 5),
(13, 2, 4920, '2021-03-12', 7),
(14, 2, 4920, '2021-03-12', 2),
(15, 2, 4920, '2021-03-12', 3),
(18, 2, 4923, '2021-03-13', 1),
(19, 2, 4923, '2021-03-13', 2),
(20, 2, 4929, '2021-03-12', 8),
(21, 2, 4929, '2021-03-12', 9);

-- --------------------------------------------------------

--
-- Estrutura da tabela `clients`
--

CREATE TABLE `clients` (
  `datainscricao` date DEFAULT current_timestamp(),
  `nome` varchar(100) DEFAULT NULL,
  `cpf` varchar(15) DEFAULT NULL,
  `precadastro` date DEFAULT current_timestamp(),
  `catpretendida` varchar(11) DEFAULT NULL,
  `sitatual` varchar(15) DEFAULT NULL,
  `datahabilitacao` date DEFAULT current_timestamp(),
  `datanascimento` date DEFAULT NULL,
  `nregistro` varchar(15) DEFAULT NULL,
  `ninscricao` varchar(20) DEFAULT NULL,
  `profissao` varchar(30) DEFAULT NULL,
  `estadocivil` varchar(15) DEFAULT NULL,
  `endereco` varchar(150) DEFAULT NULL,
  `numero` int(11) DEFAULT NULL,
  `bairro` varchar(50) DEFAULT NULL,
  `naturalidade` varchar(50) DEFAULT NULL,
  `pai` varchar(100) DEFAULT NULL,
  `mae` varchar(100) DEFAULT NULL,
  `foneresidencial` varchar(25) DEFAULT NULL,
  `fonecomercial` varchar(25) DEFAULT NULL,
  `fonecelular` varchar(25) DEFAULT NULL,
  `renach` varchar(15) DEFAULT NULL,
  `rg` varchar(15) DEFAULT NULL,
  `orgao` varchar(10) DEFAULT NULL,
  `uf` varchar(2) DEFAULT NULL,
  `datapsicotecnico` date DEFAULT current_timestamp(),
  `email` varchar(40) DEFAULT NULL,
  `observacoes` longtext DEFAULT NULL,
  `cod` int(11) NOT NULL,
  `valor_inicial` double DEFAULT NULL,
  `tipo_pagamento` int(11) DEFAULT NULL,
  `entrada` decimal(10,0) DEFAULT NULL,
  `parcelas` int(11) NOT NULL,
  `id_teacher` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `clients`
--

INSERT INTO `clients` (`datainscricao`, `nome`, `cpf`, `precadastro`, `catpretendida`, `sitatual`, `datahabilitacao`, `datanascimento`, `nregistro`, `ninscricao`, `profissao`, `estadocivil`, `endereco`, `numero`, `bairro`, `naturalidade`, `pai`, `mae`, `foneresidencial`, `fonecomercial`, `fonecelular`, `renach`, `rg`, `orgao`, `uf`, `datapsicotecnico`, `email`, `observacoes`, `cod`, `valor_inicial`, `tipo_pagamento`, `entrada`, `parcelas`, `id_teacher`) VALUES
('2011-12-19', 'Bruna Cristina Maia', '41996754858', '2011-10-18', 'AB  ', '', NULL, '1993-06-18', NULL, '579/11', 'atendente', 'Solteiro', 'Manoel Ferreira Grosso', 409, 'Jd Sonia', 'Piracicaba-SP', 'luis Geraldo Maia       ', 'Rute Bernardinelli Maia', '3415-3001', NULL, '9429-4170', '525559051  ', '49053405', 'SSP-SP', 'SP', '2011-10-18', NULL, '1380 6*230', 3, 1380, NULL, NULL, 0, 2),
('2011-12-19', 'Adriana Carneiro do Nascimento Bueno', '12268370852', NULL, 'A', 'B', '2003-04-02', '1970-08-11', '0281106770', NULL, 'Telefonista', 'Casado', 'Theresinha Beduschi Pettinelli', 593, 'Pq Mt Rey I', 'Itapetininga-SP', 'Jose Batista do Nascimento', 'Iracy Carneiro do Nascimento', '3425-3319', NULL, '9164-7769', NULL, '22.751.459', 'SSP', 'SP', NULL, NULL, 'pago em 3x no cartÃ£o  02/02/2012', 4, 560, NULL, NULL, 0, 2),
('2011-11-19', 'Ana Paula Cazini da Rocha', '22618231856', NULL, 'B', '', NULL, '2011-10-20', NULL, '552/11', 'VVV', 'Solteiro', 'Jose Malageta', 205, 'Pq Mt Rey II', 'Piracicaba-SP', 'Jose Luiz Cazini', 'Maria Roseli Barbosa Cazini', '3425-6536 Rose', NULL, '93650500', '523.626.703', '43.229.598', 'SSP', 'SP', '2011-09-19', NULL, '800', 5, 800, NULL, NULL, 0, 2),
('2011-12-19', 'ANTONIO GERALDO SAURIN', '00211376841', '2013-04-24', 'A', 'B', '1977-09-15', '1959-03-29', '03582459017', NULL, 'AUX ESCRITORIO', 'Casado', 'BURI', 361, 'PQ PIRACICABA', 'PIRACICABA-SP', 'ANTONIO SAURIN', 'SANTA SQUINCA SAURIN', '3415-4237', '3425-9069 REC NIVALDO', NULL, NULL, '11398746', 'SSP', 'SP', NULL, NULL, '560', 7, 560, NULL, NULL, 0, 2),
('2011-12-20', 'MILTON CESAR DOS SANTOS', '22574829808', NULL, 'AB', '', NULL, '1982-05-08', NULL, NULL, 'AUX MEC REFRIGERAÃ‡ÃƒO', 'Solteiro', 'SABINO TOME', 176, 'JD ALGODOAL', 'PIRACICABA-SP', 'BENEDITO LAZARO DOS SANTOS', 'CELINA DA SILVA SANTOS', '3413-3483', '3415-3113 ', '9790-5513', NULL, '42.701.743', 'SSP', 'SP', NULL, NULL, '1380', 9, 1380, NULL, NULL, 0, 2),
('2011-12-20', 'WAGNER DE OLIVEIRA BARROS', '40102058814', NULL, 'AB', '', NULL, '1988-12-22', NULL, NULL, 'MEC. MANUNTENÃ‡ÃƒO', 'Solteiro', 'RUA; XV DE NOVEMBRO', 142, 'ARTEMIS', 'PIRACICABA', 'MARCOS ANTONIO DE BARROS', 'VALERIA DE OLIVEIRA', '3438-1004', NULL, '9179-1935', NULL, '44973.399', 'SSP', 'SP', NULL, NULL, '1380', 10, 1380, NULL, NULL, 0, 2),
('2011-12-21', 'WILTON GOMES DE LIMA', '05378900417', NULL, 'AB', '', NULL, '1985-03-01', NULL, NULL, 'CONSULTOR NEGOCIOS', 'Casado', 'COSMOPOLIS', 210, 'JD MARIA CLAUDIA', 'ESCADA-PE', 'IVANILDO GOMES DE LIMA', 'MARIA JOSE SILVA DE LIMA', '35371360', '97981259', '97910739', '531094103', '55972978', 'SSP', 'SP', NULL, NULL, '1300   5x 260', 11, 1300, NULL, NULL, 0, 2),
('2012-01-03', 'ADENILZA ADRIANA DA SILVA', '21720723893', '2012-01-09', 'B', '', '2012-09-25', '1978-03-17', '05602100205', '22/12', 'AJ. PRODUÃ‡ÃƒO', 'Divorciado', 'JORGE HADAD DIB', 25, 'JD BOA ESPERANÃ‡A', 'CHARQUEADA-SP', 'HAILTON ANTERO DA SILVA', 'DIRCE GONÃ‡ALVES DA SILVA', '9405-2829 IRMÃƒ', NULL, '9405-4832', '532394437', '28836949', 'SSP', 'SP', '2012-01-13', '58539-41758', '6 aulas vem pagar 04/07', 12, 800, NULL, NULL, 0, 2),
('2012-01-03', 'MARCIA EVARISTO VIEIRA', '26481997801', '2012-01-09', 'B', '', NULL, '1976-10-07', NULL, '31/12', 'COSTUREIRA', 'Casado', 'LUIZ DELFINI', 366, 'JD JAVARY', 'CEU AZUL PARANA', 'BENEDITO EVARISTO NETO', 'HELENA MAGDALENA EVARISTO', '3425-5815', NULL, '9281-8315', '532339843', '33761510', 'SSP', 'SP', '2012-01-09', '78900/74689', '800', 13, 800, NULL, NULL, 0, 2),
('2021-02-02', 'Renan França', '391.024.478-51', '2021-02-02', NULL, NULL, '2021-02-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-02', NULL, NULL, 4914, NULL, NULL, NULL, 0, 2),
('2021-02-02', 'Amanda França', '123456', '2021-02-02', NULL, NULL, '2021-02-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-02', NULL, NULL, 4915, 1000, 3, NULL, 0, 2),
('2021-02-02', 'Lourdes França', '245345345', '2021-02-02', NULL, NULL, '2021-02-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-02', NULL, NULL, 4916, NULL, NULL, NULL, 0, 2),
('2021-02-02', 'Joise Garcia', '45645654654', '2021-02-02', NULL, NULL, '2021-02-02', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-02-02', NULL, NULL, 4917, NULL, NULL, NULL, 0, 2),
('2021-03-05', 'usuario teste', '1651231231', '2021-03-05', NULL, NULL, '2021-03-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-05', NULL, NULL, 4918, 1000, NULL, NULL, 0, 2),
('2021-03-05', 'sfsdfsdfs', '124234234', '2021-03-05', NULL, NULL, '2021-03-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-05', NULL, NULL, 4919, 123, 2, NULL, 0, 2),
('2021-03-05', 'jusé', '123456', '2021-03-05', NULL, NULL, '2021-03-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-05', NULL, NULL, 4920, 700, 3, '200', 5, 2),
('2021-03-05', 'José de Arimateia', '111', '2021-03-05', NULL, NULL, '2021-03-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-05', NULL, NULL, 4923, 2344, 3, '0', 5, 2),
('2021-03-12', 'pedro bandeira', '321', '2021-03-12', NULL, NULL, '2021-03-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-03-12', NULL, NULL, 4929, 32121, 3, '0', 4, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `clients_old`
--

CREATE TABLE `clients_old` (
  `datainscricao` date DEFAULT '0000-00-00',
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(15) NOT NULL,
  `precadastro` date DEFAULT '0000-00-00',
  `catpretendida` varchar(11) NOT NULL,
  `sitatual` varchar(15) NOT NULL,
  `datahabilitacao` date DEFAULT '0000-00-00',
  `datanascimento` date NOT NULL,
  `nregistro` varchar(15) DEFAULT NULL,
  `ninscricao` varchar(20) DEFAULT NULL,
  `profissao` varchar(30) NOT NULL,
  `estadocivil` varchar(15) NOT NULL,
  `endereco` varchar(150) NOT NULL,
  `numero` int(11) NOT NULL,
  `bairro` varchar(50) NOT NULL,
  `naturalidade` varchar(50) NOT NULL,
  `pai` varchar(100) NOT NULL,
  `mae` varchar(100) NOT NULL,
  `foneresidencial` varchar(25) DEFAULT NULL,
  `fonecomercial` varchar(25) DEFAULT NULL,
  `fonecelular` varchar(25) DEFAULT NULL,
  `renach` varchar(15) DEFAULT NULL,
  `rg` varchar(15) NOT NULL,
  `orgao` varchar(10) NOT NULL,
  `uf` varchar(2) DEFAULT NULL,
  `datapsicotecnico` date DEFAULT '0000-00-00',
  `email` varchar(40) DEFAULT NULL,
  `observacoes` longtext DEFAULT NULL,
  `cod` int(11) NOT NULL,
  `valor_inicial` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `clients_old`
--

INSERT INTO `clients_old` (`datainscricao`, `nome`, `cpf`, `precadastro`, `catpretendida`, `sitatual`, `datahabilitacao`, `datanascimento`, `nregistro`, `ninscricao`, `profissao`, `estadocivil`, `endereco`, `numero`, `bairro`, `naturalidade`, `pai`, `mae`, `foneresidencial`, `fonecomercial`, `fonecelular`, `renach`, `rg`, `orgao`, `uf`, `datapsicotecnico`, `email`, `observacoes`, `cod`, `valor_inicial`) VALUES
('2011-12-19', 'Bruna Cristina Maia', '41996754858', '2011-10-18', 'AB  ', '', NULL, '1993-06-18', NULL, '579/11', 'atendente', 'Solteiro', 'Manoel Ferreira Grosso', 409, 'Jd Sonia', 'Piracicaba-SP', 'luis Geraldo Maia       ', 'Rute Bernardinelli Maia', '3415-3001', NULL, '9429-4170', '525559051  ', '49053405', 'SSP-SP', 'SP', '2011-10-18', NULL, '1380 6*230', 3, 1380),
('2011-12-19', 'Adriana Carneiro do Nascimento Bueno', '12268370852', NULL, 'A', 'B', '2003-04-02', '1970-08-11', '0281106770', NULL, 'Telefonista', 'Casado', 'Theresinha Beduschi Pettinelli', 593, 'Pq Mt Rey I', 'Itapetininga-SP', 'Jose Batista do Nascimento', 'Iracy Carneiro do Nascimento', '3425-3319', NULL, '9164-7769', NULL, '22.751.459', 'SSP', 'SP', NULL, NULL, 'pago em 3x no cartÃ£o  02/02/2012', 4, 560),
('2011-11-19', 'Ana Paula Cazini da Rocha', '22618231856', NULL, 'B', '', NULL, '2011-10-20', NULL, '552/11', 'VVV', 'Solteiro', 'Jose Malageta', 205, 'Pq Mt Rey II', 'Piracicaba-SP', 'Jose Luiz Cazini', 'Maria Roseli Barbosa Cazini', '3425-6536 Rose', NULL, '93650500', '523.626.703', '43.229.598', 'SSP', 'SP', '2011-09-19', NULL, '800', 5, 800),
('2011-12-19', 'ANTONIO GERALDO SAURIN', '00211376841', '2013-04-24', 'A', 'B', '1977-09-15', '1959-03-29', '03582459017', NULL, 'AUX ESCRITORIO', 'Casado', 'BURI', 361, 'PQ PIRACICABA', 'PIRACICABA-SP', 'ANTONIO SAURIN', 'SANTA SQUINCA SAURIN', '3415-4237', '3425-9069 REC NIVALDO', NULL, NULL, '11398746', 'SSP', 'SP', NULL, NULL, '560', 7, 560),
('2011-12-20', 'MILTON CESAR DOS SANTOS', '22574829808', NULL, 'AB', '', NULL, '1982-05-08', NULL, NULL, 'AUX MEC REFRIGERAÃ‡ÃƒO', 'Solteiro', 'SABINO TOME', 176, 'JD ALGODOAL', 'PIRACICABA-SP', 'BENEDITO LAZARO DOS SANTOS', 'CELINA DA SILVA SANTOS', '3413-3483', '3415-3113 ', '9790-5513', NULL, '42.701.743', 'SSP', 'SP', NULL, NULL, '1380', 9, 1380),
('2011-12-20', 'WAGNER DE OLIVEIRA BARROS', '40102058814', NULL, 'AB', '', NULL, '1988-12-22', NULL, NULL, 'MEC. MANUNTENÃ‡ÃƒO', 'Solteiro', 'RUA; XV DE NOVEMBRO', 142, 'ARTEMIS', 'PIRACICABA', 'MARCOS ANTONIO DE BARROS', 'VALERIA DE OLIVEIRA', '3438-1004', NULL, '9179-1935', NULL, '44973.399', 'SSP', 'SP', NULL, NULL, '1380', 10, 1380),
('2011-12-21', 'WILTON GOMES DE LIMA', '05378900417', NULL, 'AB', '', NULL, '1985-03-01', NULL, NULL, 'CONSULTOR NEGOCIOS', 'Casado', 'COSMOPOLIS', 210, 'JD MARIA CLAUDIA', 'ESCADA-PE', 'IVANILDO GOMES DE LIMA', 'MARIA JOSE SILVA DE LIMA', '35371360', '97981259', '97910739', '531094103', '55972978', 'SSP', 'SP', NULL, NULL, '1300   5x 260', 11, 1300),
('2012-01-03', 'ADENILZA ADRIANA DA SILVA', '21720723893', '2012-01-09', 'B', '', '2012-09-25', '1978-03-17', '05602100205', '22/12', 'AJ. PRODUÃ‡ÃƒO', 'Divorciado', 'JORGE HADAD DIB', 25, 'JD BOA ESPERANÃ‡A', 'CHARQUEADA-SP', 'HAILTON ANTERO DA SILVA', 'DIRCE GONÃ‡ALVES DA SILVA', '9405-2829 IRMÃƒ', NULL, '9405-4832', '532394437', '28836949', 'SSP', 'SP', '2012-01-13', '58539-41758', '6 aulas vem pagar 04/07', 12, 800),
('2012-01-03', 'MARCIA EVARISTO VIEIRA', '26481997801', '2012-01-09', 'B', '', NULL, '1976-10-07', NULL, '31/12', 'COSTUREIRA', 'Casado', 'LUIZ DELFINI', 366, 'JD JAVARY', 'CEU AZUL PARANA', 'BENEDITO EVARISTO NETO', 'HELENA MAGDALENA EVARISTO', '3425-5815', NULL, '9281-8315', '532339843', '33761510', 'SSP', 'SP', '2012-01-09', '78900/74689', '800', 13, 800);

-- --------------------------------------------------------

--
-- Estrutura da tabela `financial`
--

CREATE TABLE `financial` (
  `id` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `value` double NOT NULL,
  `name` varchar(100) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `itens`
--

CREATE TABLE `itens` (
  `id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `itens`
--

INSERT INTO `itens` (`id`, `category`, `name`) VALUES
(1, 1, 'Água 20L'),
(2, 2, 'Papel sufite');

-- --------------------------------------------------------

--
-- Estrutura da tabela `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `data` date NOT NULL,
  `valor` decimal(10,0) NOT NULL,
  `id_cliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `payments`
--

INSERT INTO `payments` (`id`, `data`, `valor`, `id_cliente`) VALUES
(1, '2021-02-24', '100', 4920),
(2, '2021-01-04', '50', 4920),
(4, '2021-03-03', '500', 4923),
(5, '2021-03-23', '50', 4923),
(6, '2021-03-02', '94', 4923),
(7, '2021-03-16', '500', 4923),
(11, '2021-03-10', '200', 4923),
(12, '2021-03-11', '1000', 4923),
(13, '2020-12-17', '50', 4920),
(14, '2021-01-14', '50', 4915),
(17, '2021-03-04', '50', 4929),
(18, '2021-03-10', '50', 4929),
(19, '2021-03-10', '50', 4929),
(20, '2021-03-11', '50', 4929),
(21, '2021-03-12', '50', 4929);

-- --------------------------------------------------------

--
-- Estrutura da tabela `stock`
--

CREATE TABLE `stock` (
  `id` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `tipo` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `data` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `accounts`
--
ALTER TABLE `accounts`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`cod`);

--
-- Índices para tabela `clients_old`
--
ALTER TABLE `clients_old`
  ADD PRIMARY KEY (`cod`);

--
-- Índices para tabela `itens`
--
ALTER TABLE `itens`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `accounts`
--
ALTER TABLE `accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `calendar`
--
ALTER TABLE `calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `clients`
--
ALTER TABLE `clients`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4930;

--
-- AUTO_INCREMENT de tabela `clients_old`
--
ALTER TABLE `clients_old`
  MODIFY `cod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4914;

--
-- AUTO_INCREMENT de tabela `itens`
--
ALTER TABLE `itens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `stock`
--
ALTER TABLE `stock`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
