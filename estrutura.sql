http://aposte.me/editor/-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Tempo de geração: 18/05/2018 às 15:23
-- Versão do servidor: 5.5.51-38.2
-- Versão do PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de dados: `apost397_half`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `jogos`
--

CREATE TABLE IF NOT EXISTS `jogos` (
  `id` int(11) NOT NULL,
  `data_inicio` datetime NOT NULL,
  `home` int(11) NOT NULL,
  `away` int(11) NOT NULL,
  `ghf` tinyint(4) NOT NULL,
  `gaf` tinyint(4) NOT NULL,
  `ch` tinyint(4) NOT NULL,
  `ca` tinyint(4) NOT NULL,
  `dah` tinyint(3) unsigned NOT NULL,
  `daa` tinyint(3) unsigned NOT NULL,
  `sh` tinyint(4) NOT NULL,
  `sa` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `odds`
--

CREATE TABLE IF NOT EXISTS `odds` (
  `jogo_id` int(11) NOT NULL,
  `gh` tinyint(4) NOT NULL,
  `ga` tinyint(4) NOT NULL,
  `handicap` decimal(3,2) NOT NULL,
  `oh` decimal(4,3) NOT NULL,
  `oa` decimal(4,3) NOT NULL,
  `goalline` decimal(3,2) NOT NULL,
  `oo` decimal(4,3) NOT NULL,
  `ou` decimal(4,3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pages`
--

CREATE TABLE IF NOT EXISTS `pages` (
  `data` int(11) NOT NULL,
  `page` tinyint(4) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Fazendo dump de dados para tabela `pages`
--

INSERT INTO `pages` (`data`, `page`) VALUES
(20180101, 1);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `jogos`
--
ALTER TABLE `jogos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pages`
--
ALTER TABLE `pages`
  ADD UNIQUE KEY `data` (`data`,`page`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
