-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21/05/2025 às 22:49

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
-- Estrutura para tabela `posts`
--

CREATE TABLE `posts` (
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `conteudo` text NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `criado_em` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `apelido` varchar(250) NOT NULL,
  `altura` decimal(5,2) NOT NULL,
  `peso` decimal(5,2) NOT NULL,
  `posicao` varchar(150) DEFAULT 'Atacante',
  `estiloJogo` varchar(250) NOT NULL,
  `pe_dominante` varchar(100) NOT NULL,
  `descricao` varchar(1000) NOT NULL,
  `data_inicio_time` date DEFAULT NULL,
  `status` enum('sem time','ativo','lesionado','suspenso') DEFAULT 'sem time'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `tbl_jogador`
--

INSERT INTO `tbl_jogador` (`id_jogador`, `id_user`, `id_time`, `apelido`, `altura`, `peso`, `posicao`, `estiloJogo`, `pe_dominante`, `descricao`, `data_inicio_time`, `status`) VALUES
(1, 11, NULL, 'Shand', 1.70, 55.30, 'Zagueiro', 'Estratégico', 'Direito', 'Sou apenas um aluno da etec com o desejo de competir na Champions', NULL, 'sem time'),
(16, 3, NULL, 'Murimbo', 1.72, 79.00, 'Volante', 'Raçudo', 'Direito', 'Sou um jogador profissional muito dedicado, acredito que minhas habilidades podem um dia me levar para competir na Europa.', NULL, 'sem time'),
(17, 7, NULL, 'Luquinhas', 1.76, 82.00, 'Zagueiro', 'Defensivo', 'Esquerdo', 'Meu estilo de jogo se baseia em manter o controle defensivo do meu time. Gosto de ritmos de jogos controlados.', NULL, 'sem time');

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
-- Despejando dados para a tabela `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`id_user`, `nome`, `email`, `senha`, `data_nasc`, `genero`, `foto_perfil`, `telefone`, `bio`, `rede_social`, `cep`, `rua`, `bairro`, `cidade`, `estado`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Pedro Medeiros', 'pedrosantos57@gmail.com', '$2y$10$RGBbFsjHN445mW13T1lNuuRTQKSLKmt6kn3nJLWaYtjN6p97TLvUS', '2007-10-15', 'masculino', '../../public/images/profilePhotos/4dfbdd0bab17f7db0777ebe63f252392.png', '(11) 93739-4489', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', '2025-04-22 13:49:20', '2025-04-22 13:49:20'),
(3, 'Murilo Magalhâes', 'superonze46@gmail.com', '$2y$10$fb8mzsnbuknK1gn5vm/2pe1JCajbeI6vJqJzkXt.kc39knhw0zn72', '2007-01-18', 'masculino', '../../public/images/profilePhotos/b7a663e8cf54ed1d04eca111f9dc54cd.png', '(11) 93497-3298', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', '2025-04-22 13:51:32', '2025-05-23 14:26:54'),
(4, 'Eduardo Fernandes', 'eduardofernandes134@gmail.com', '$2y$10$nKkdNMWtvoq/MoZT5f1AmeMxm273QzaCzGmyR31VdoqWtIkjFC8du', '2008-02-05', 'masculino', '../../public/images/profilePhotos/defaultPhoto', '(11) 93487-3894', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', '2025-04-22 13:54:56', '2025-04-22 13:54:56'),
(5, 'Daniel Mattos', 'danimattos@gmail.com', '$2y$10$i8yA1OcevHfOuENccmJjW.INo46k0wvaAQzBK/keKNZO3.QZSRevK', '2007-04-08', 'masculino', '../../public/images/profilePhotos/fc6674b38f5ddc654d765bad7c410b99.png', '(11) 94597-8548', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', '2025-04-22 14:00:12', '2025-04-22 14:00:12'),
(6, 'Thiago Ribeiro', 'thiagoribeiro23@gmail.com', '$2y$10$UcNCrhuS.GnVmewqepW0G.yKp0aV7QKI8fY5RNS/Eelxl8TXBpWLi', '2006-09-01', 'masculino', '../../public/images/profilePhotos/defaultPhoto', '(11) 98429-5376', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', '2025-04-22 14:05:40', '2025-04-22 14:05:40'),
(7, 'Lucas Pereira', 'lucas.pereira95@gmail.com', '$2y$10$Z3b2BjN7siY4mPp2ZYveg.E5Ou.zYBo/kD7Xlf6F9tOgK7JK2/rh2', '1995-05-12', 'masculino', '../../public/images/profilePhotos/defaultPhoto', '(11) 93498-4533', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', '2025-04-22 14:09:58', '2025-04-22 14:09:58'),
(8, 'Mariana Costa', 'mariana.costa88@hotmail.com', '$2y$10$cakhPbUuDnw.By6Dt9qSpubJyldwC7IKbXYqU944ntLbtfqON9QdO', '1988-07-23', 'masculino', '../../public/images/profilePhotos/defaultPhoto', '(11) 92349-8495', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', '2025-04-22 14:10:59', '2025-04-22 14:10:59'),
(9, 'Gabriel Almeida', 'gabriel.almeida01@gmail.com', '$2y$10$DfFdrR5UgRiX1dHAtJbPbuv9o2xOGjW/NdqIy3LUq/LOLKO1Dsu7e', '2001-11-01', 'masculino', '../../public/images/profilePhotos/defaultPhoto', '(19) 95293-4857', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', '2025-04-22 14:11:52', '2025-04-22 14:11:52'),
(10, 'João Oliveira', 'joao.oliveira80@gmail.com', '$2y$10$X45zxeG5Nd6re714MfqQVuArt8j4QOw1VUmaaqCFlwm88p1c6UWFy', '1980-08-04', 'masculino', '../../public/images/profilePhotos/516517828b4162c14cf596544d41a424.png', '(11) 93985-2147', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', '2025-04-22 14:12:55', '2025-04-22 14:12:55'),
(11, 'Shandel', 'shandelvm18@gmail.etec', '$2y$10$d5IrkqQMSnRMt6nUeWmBgeSNwI.Xokm1Zaq9YjdF7IKsnTrwL4tsS', '2006-06-13', 'masculino', '../../public/images/profilePhotos/defaultPhoto', '(11) 91034-3903', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', '2025-05-20 14:10:05', '2025-05-20 14:10:05'),
(12, 'Shandel Villasante Merlo', 'shandelvm16@gmail.com', '$2y$10$1eyi2xDvvdjlqbcDA8w27uCEONmMktHAt2SJnZks6bLsFCFKz48/q', '2006-06-13', 'masculino', '../../public/images/profilePhotos/defaultPhoto', '(11) 94963-3106', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', '2025-05-21 17:02:09', '2025-05-21 17:02:09');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `id_user` (`id_user`);

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
-- AUTO_INCREMENT de tabela `posts`
--
ALTER TABLE `posts`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbl_hist_contrato`
--
ALTER TABLE `tbl_hist_contrato`
  MODIFY `id_hist_contrato` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbl_jogador`
--
ALTER TABLE `tbl_jogador`
  MODIFY `id_jogador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

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
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_usuarios` (`id_user`) ON DELETE CASCADE;

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
