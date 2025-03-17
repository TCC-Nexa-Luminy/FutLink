-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17/03/2025 às 20:15
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `db_futlink`
--
CREATE DATABASE IF NOT EXISTS `db_futlink` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `db_futlink`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_hist_contrato`
--

CREATE TABLE `tbl_hist_contrato` (
  `id_hist_contrato` int(11) NOT NULL,
  `id_org` int(11) DEFAULT NULL,
  `id_time` int(11) DEFAULT NULL,
  `id_jogador` int(11) DEFAULT NULL,
  `data_inicio` date DEFAULT NULL,
  `data_fim` date DEFAULT NULL,
  `tipo_contrato` enum('temporário','fixo','empréstimo') DEFAULT 'fixo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_jogador`
--

CREATE TABLE `tbl_jogador` (
  `id_jogador` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_time` int(11) DEFAULT NULL,
  `nacionalidade` varchar(100) NOT NULL,
  `altura` decimal(5,2) NOT NULL,
  `peso` decimal(5,2) NOT NULL,
  `posicao` varchar(150) DEFAULT 'Atacante',
  `num_camisa` int(11) DEFAULT NULL,
  `data_inicio_time` date DEFAULT NULL,
  `status` enum('sem time','ativo','lesionado','suspenso') DEFAULT 'sem time'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_jogo`
--

CREATE TABLE `tbl_jogo` (
  `id_jogo` int(11) NOT NULL,
  `id_time_casa` int(11) NOT NULL,
  `id_time_fora` int(11) NOT NULL,
  `data_inicio` datetime DEFAULT NULL,
  `data_fim` datetime DEFAULT NULL,
  `local_jogo` varchar(250) DEFAULT NULL,
  `placar_casa` int(11) DEFAULT NULL,
  `placar_fora` int(11) DEFAULT NULL,
  `status` enum('Agendado','Em andamento','Cancelado') DEFAULT 'Agendado',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_organizacao`
--

CREATE TABLE `tbl_organizacao` (
  `id_org` int(11) NOT NULL,
  `nome_org` varchar(100) NOT NULL,
  `id_user_dono` int(11) DEFAULT NULL,
  `slogan` varchar(150) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `tipo` enum('Clube Profissional','Clube Amador','Escola de Futebol','Projeto Social','Empresa Esportiva') NOT NULL,
  `rua` varchar(100) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `redes_sociais` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`redes_sociais`)),
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_profissional`
--

CREATE TABLE `tbl_profissional` (
  `id_prof` int(11) NOT NULL,
  `id_user` int(11) DEFAULT NULL,
  `cargo` enum('Treinador','Assistente Técnico','Preparador Físico','Médico','Massagista','Olheiro','Diretor','Adm') NOT NULL,
  `departamento` enum('Técnico','Médico','Administrativo') NOT NULL,
  `salario` decimal(10,2) NOT NULL,
  `data_admissao` date DEFAULT NULL,
  `status_prof` enum('Ativo','Licença','Desligado') DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_prof_time`
--

CREATE TABLE `tbl_prof_time` (
  `id_prof_time` int(11) NOT NULL,
  `id_prof` int(11) DEFAULT NULL,
  `id_time` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_time`
--

CREATE TABLE `tbl_time` (
  `id_time` int(11) NOT NULL,
  `id_org` int(11) DEFAULT NULL,
  `nome` varchar(150) NOT NULL,
  `apelido` varchar(3) NOT NULL,
  `categoria` enum('profissional','amador','base','feminino') DEFAULT NULL,
  `logo` varchar(200) DEFAULT NULL,
  `status` enum('ativo','inativo','jogando') NOT NULL DEFAULT 'ativo',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_usuarios`
--

CREATE TABLE `tbl_usuarios` (
  `id_user` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL,
  `email` varchar(200) NOT NULL,
  `senha` varchar(150) NOT NULL,
  `data_nasc` date NOT NULL,
  `genero` enum('masculino','feminino','outro','prefiro não dizer') DEFAULT NULL,
  `foto_perfil` varchar(200) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `bio` text DEFAULT NULL,
  `rede_social` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`rede_social`)),
  `cep` varchar(20) DEFAULT NULL,
  `rua` varchar(100) DEFAULT NULL,
  `bairro` varchar(100) DEFAULT NULL,
  `cidade` varchar(100) DEFAULT NULL,
  `estado` varchar(100) DEFAULT NULL,
  `status` enum('ativo','suspenso','desativado') DEFAULT 'ativo',
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `tbl_hist_contrato`
--
ALTER TABLE `tbl_hist_contrato`
  ADD PRIMARY KEY (`id_hist_contrato`),
  ADD KEY `id_org` (`id_org`),
  ADD KEY `id_time` (`id_time`),
  ADD KEY `id_jogador` (`id_jogador`);

--
-- Índices de tabela `tbl_jogador`
--
ALTER TABLE `tbl_jogador`
  ADD PRIMARY KEY (`id_jogador`),
  ADD KEY `id_user` (`id_user`);

--
-- Índices de tabela `tbl_jogo`
--
ALTER TABLE `tbl_jogo`
  ADD PRIMARY KEY (`id_jogo`),
  ADD KEY `id_time_casa` (`id_time_casa`),
  ADD KEY `id_time_fora` (`id_time_fora`);

--
-- Índices de tabela `tbl_organizacao`
--
ALTER TABLE `tbl_organizacao`
  ADD PRIMARY KEY (`id_org`),
  ADD UNIQUE KEY `nome_org` (`nome_org`),
  ADD KEY `id_user_dono` (`id_user_dono`);

--
-- Índices de tabela `tbl_profissional`
--
ALTER TABLE `tbl_profissional`
  ADD PRIMARY KEY (`id_prof`),
  ADD KEY `id_user` (`id_user`);

--
-- Índices de tabela `tbl_prof_time`
--
ALTER TABLE `tbl_prof_time`
  ADD PRIMARY KEY (`id_prof_time`),
  ADD KEY `id_time` (`id_time`);

--
-- Índices de tabela `tbl_time`
--
ALTER TABLE `tbl_time`
  ADD PRIMARY KEY (`id_time`),
  ADD UNIQUE KEY `nome` (`nome`),
  ADD KEY `id_org` (`id_org`);

--
-- Índices de tabela `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbl_hist_contrato`
--
ALTER TABLE `tbl_hist_contrato`
  MODIFY `id_hist_contrato` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbl_jogador`
--
ALTER TABLE `tbl_jogador`
  MODIFY `id_jogador` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbl_jogo`
--
ALTER TABLE `tbl_jogo`
  MODIFY `id_jogo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbl_organizacao`
--
ALTER TABLE `tbl_organizacao`
  MODIFY `id_org` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbl_profissional`
--
ALTER TABLE `tbl_profissional`
  MODIFY `id_prof` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbl_prof_time`
--
ALTER TABLE `tbl_prof_time`
  MODIFY `id_prof_time` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbl_time`
--
ALTER TABLE `tbl_time`
  MODIFY `id_time` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `tbl_hist_contrato`
--
ALTER TABLE `tbl_hist_contrato`
  ADD CONSTRAINT `tbl_hist_contrato_ibfk_1` FOREIGN KEY (`id_org`) REFERENCES `tbl_organizacao` (`id_org`),
  ADD CONSTRAINT `tbl_hist_contrato_ibfk_2` FOREIGN KEY (`id_time`) REFERENCES `tbl_time` (`id_time`),
  ADD CONSTRAINT `tbl_hist_contrato_ibfk_3` FOREIGN KEY (`id_jogador`) REFERENCES `tbl_jogador` (`id_jogador`);

--
-- Restrições para tabelas `tbl_jogador`
--
ALTER TABLE `tbl_jogador`
  ADD CONSTRAINT `tbl_jogador_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_usuarios` (`id_user`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tbl_jogo`
--
ALTER TABLE `tbl_jogo`
  ADD CONSTRAINT `tbl_jogo_ibfk_1` FOREIGN KEY (`id_time_casa`) REFERENCES `tbl_time` (`id_time`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_jogo_ibfk_2` FOREIGN KEY (`id_time_fora`) REFERENCES `tbl_time` (`id_time`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tbl_organizacao`
--
ALTER TABLE `tbl_organizacao`
  ADD CONSTRAINT `tbl_organizacao_ibfk_1` FOREIGN KEY (`id_user_dono`) REFERENCES `tbl_usuarios` (`id_user`) ON DELETE SET NULL;

--
-- Restrições para tabelas `tbl_profissional`
--
ALTER TABLE `tbl_profissional`
  ADD CONSTRAINT `tbl_profissional_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_usuarios` (`id_user`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tbl_prof_time`
--
ALTER TABLE `tbl_prof_time`
  ADD CONSTRAINT `tbl_prof_time_ibfk_1` FOREIGN KEY (`id_prof_time`) REFERENCES `tbl_profissional` (`id_prof`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_prof_time_ibfk_2` FOREIGN KEY (`id_time`) REFERENCES `tbl_time` (`id_time`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tbl_time`
--
ALTER TABLE `tbl_time`
  ADD CONSTRAINT `tbl_time_ibfk_1` FOREIGN KEY (`id_org`) REFERENCES `tbl_organizacao` (`id_org`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
