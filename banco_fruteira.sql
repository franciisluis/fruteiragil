-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 11-Jun-2019 às 23:49
-- Versão do servidor: 10.1.21-MariaDB
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `banco_fruteira`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categoria`
--

CREATE TABLE `categoria` (
  `id_categoria` int(10) UNSIGNED NOT NULL,
  `nome_categoria` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categoria`
--

INSERT INTO `categoria` (`id_categoria`, `nome_categoria`) VALUES
(2, 'fruta'),
(3, 'bebidas'),
(4, '    assados'),
(5, 'Legumes'),
(6, '       nenhuma');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(10) UNSIGNED NOT NULL,
  `nome_cliente` varchar(255) NOT NULL,
  `email` varchar(11) NOT NULL,
  `cpf` int(11) NOT NULL,
  `telefone` int(11) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `imagem_cliente` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`id_cliente`, `nome_cliente`, `email`, `cpf`, `telefone`, `endereco`, `imagem_cliente`) VALUES
(2, ' Francisco Ladimir', ' chicolpv@g', 2147483647, 2147483647, ' Alcides link 26', 'cliente.png'),
(4, '          Francis', '         ds', 1242545, 2147483647, '         sdksdkjsdhdk', '20190611213202Koala.jpg');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `id_produto` int(10) UNSIGNED NOT NULL,
  `nome_produto` varchar(255) NOT NULL,
  `qtd_produto` int(10) NOT NULL,
  `valor_produto` double NOT NULL,
  `id_categoria` int(10) NOT NULL,
  `imagem_produto` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`id_produto`, `nome_produto`, `qtd_produto`, `valor_produto`, `id_categoria`, `imagem_produto`) VALUES
(3, 'Alface', 35, 1.5, 1, ''),
(4, ' Tomate', 1, 8.74, 2, 'produto.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `requisicao_venda`
--

CREATE TABLE `requisicao_venda` (
  `id_requisicao` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `id_venda` int(11) NOT NULL,
  `qtd` int(11) NOT NULL,
  `valor` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `requisicao_venda`
--

INSERT INTO `requisicao_venda` (`id_requisicao`, `id_produto`, `id_venda`, `qtd`, `valor`) VALUES
(1, 1, 1, 10, 50),
(2, 3, 2, 50, 100),
(3, 6, 4, 10, 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) UNSIGNED NOT NULL,
  `nome_usuario` varchar(255) NOT NULL,
  `senha_usuario` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome_usuario`, `senha_usuario`) VALUES
(2, 'admin', '202cb962ac59075b964b07152d234b70');

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda`
--

CREATE TABLE `venda` (
  `id_venda` int(10) NOT NULL,
  `id_cliente` int(10) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `venda`
--

INSERT INTO `venda` (`id_venda`, `id_cliente`, `data`) VALUES
(1, 1, '0000-00-00'),
(2, 1, '0000-00-00'),
(3, 1, '2019-04-09'),
(4, 2, '2019-04-23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_cliente`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`id_produto`);

--
-- Indexes for table `requisicao_venda`
--
ALTER TABLE `requisicao_venda`
  ADD PRIMARY KEY (`id_requisicao`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Indexes for table `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`id_venda`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id_categoria` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id_cliente` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `id_produto` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `requisicao_venda`
--
ALTER TABLE `requisicao_venda`
  MODIFY `id_requisicao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `venda`
--
ALTER TABLE `venda`
  MODIFY `id_venda` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
