-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1

-- Tempo de geração: 05/06/2025 às 22:30

-- Tempo de geração: 04/06/2025 às 22:48


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
-- Estrutura para tabela `comentarios`
--

CREATE TABLE `comentarios` (
  `id_comentario` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `conteudo` text NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `curtidas`
--

CREATE TABLE `curtidas` (
  `id_curtida` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `notificacoes`
--

CREATE TABLE `notificacoes` (
  `id` int(11) NOT NULL,
  `id_user_destino` int(11) NOT NULL,
  `id_user_origem` int(11) NOT NULL,
  `tipo` enum('curtida','comentario','repost') NOT NULL,
  `id_referencia` int(11) NOT NULL,
  `conteudo` text DEFAULT NULL,
  `lida` tinyint(1) DEFAULT 0,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `peneiras`
--

CREATE TABLE `peneiras` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `clube` varchar(255) NOT NULL,
  `foto_peneira` text NOT NULL,
  `descricao` text NOT NULL,
  `localizacao` varchar(255) NOT NULL,
  `data` date NOT NULL,
  `horario` time NOT NULL,
  `inscricao` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `faixa_etaria` varchar(50) NOT NULL,
  `caminho_foto` varchar(255) DEFAULT NULL,
  `caminho_documento` varchar(255) DEFAULT NULL,
  `badge_type` enum('featured','new','normal') DEFAULT 'normal',
  `status_inscricao` enum('status-open','status-closed','status-soon') DEFAULT 'status-soon',
  `fotos` text DEFAULT NULL,
  `documentos` text DEFAULT NULL,
  `data_criacao` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_atualizacao` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `peneiras`
--

INSERT INTO `peneiras` (`id`, `titulo`, `clube`, `foto_peneira`, `descricao`, `localizacao`, `data`, `horario`, `inscricao`, `status`, `faixa_etaria`, `caminho_foto`, `caminho_documento`, `badge_type`, `status_inscricao`, `fotos`, `documentos`, `data_criacao`, `data_atualizacao`) VALUES
(4, 'Peneira Ofc Sub 14', 'Santos Futebol Clube', 'uploads/peneiras/peneira_683e02c12c3ef.jpg', 'O Santos Futebol Clube, também conhecido como Santos, é um clube brasileiro de futebol com sede na cidade de Santos, no estado de São Paulo. Foi fundado em 14 de abril de 1912 e é um dos clubes mais históricos e vitoriosos do Brasil, com um legado que inclui a revelação de grandes talentos, como Pelé. ', 'Rua Pelé Silveiro', '2025-09-19', '15:30:00', 'Gratuita', 'Ativa', '14', NULL, NULL, 'normal', '', '[\"uploads\\/peneiras\\/extra_683e02c12c57b.png\",\"uploads\\/peneiras\\/extra_683e02c12c6b0.png\",\"uploads\\/peneiras\\/extra_683e02c12c7d7.png\"]', '[\"uploads\\/documentos\\/doc_683e02c12c96a.png\"]', '2025-06-02 20:00:01', '2025-06-02 20:00:01');

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
-- Estrutura para tabela `reposts`
--

CREATE TABLE `reposts` (
  `id_repost` int(11) NOT NULL,
  `id_post_original` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
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
  `apelido` varchar(250) DEFAULT NULL,
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
(2, 7, NULL, 'Luquinhas', 1.82, 68.00, 'Volante', 'Técnico', 'Direito', 'Sou um atleta dedicado, atuando como jogador de futebol na categoria sub-20. Tenho paixão pelo esporte desde a infância e busco constantemente evoluir técnica, tática e fisicamente. Comprometido com o trabalho em equipe e com o desempenho em campo, meu objetivo é alcançar o profissionalismo e representar com orgulho o clube e a camisa que visto.', NULL, 'sem time'),
(3, 8, NULL, 'Mary', 1.70, 55.60, 'Meia', 'Agressivo', 'Esquerdo', 'Sou Mariana, jogadora de futebol com uma paixão imensa pelo esporte e uma dedicação constante em melhorar a cada treino. Meu jogo é focado em agilidade e intensidade, sempre buscando contribuir para o time, seja criando jogadas ou finalizando com precisão. Acredito no poder do trabalho em equipe e estou sempre pronta para enfrentar novos desafios, buscando evolução tanto técnica quanto mental. Futebol é minha vida, e minha missão é dar o meu melhor em cada partida!', NULL, 'sem time'),
(4, 9, NULL, '', 1.74, 79.00, 'Atacante', 'Agressivo', 'Direito', 'Sou Gabriel Almeida, tenho 20 anos e venho das categorias de base. Meu foco é evoluir a cada dia, dando o máximo em cada treino e jogo. Em campo, sou rápido e técnico, sempre buscando ajudar o time a conquistar os objetivos. Estou pronto para os desafios e para mostrar meu potencial!', NULL, 'sem time'),
(5, 10, NULL, 'Muralha', 1.86, 80.00, 'Goleiro', 'Defensivo', 'Direito', 'Sou um goleiro mirim apaixonado por futebol desde pequeno. Adoro estar embaixo das traves, fazendo defesas difíceis e ajudando meu time com garra e dedicação. Estou sempre treinando para melhorar meus reflexos, posicionamento e coragem, porque sei que o goleiro é a última linha de defesa. Sonho em um dia jogar profissionalmente e vestir a camisa de um grande clube, mas por enquanto, meu maior prazer é jogar com os amigos e dar o meu melhor em cada partida.', NULL, 'sem time');

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
  `email` varchar(200) NOT NULL,
  `telefone_org` varchar(100) NOT NULL,
  `password_org` varchar(255) NOT NULL,
  `logo_org` varchar(255) DEFAULT NULL,
  `bio` varchar(300) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `data_fundacao` date NOT NULL DEFAULT current_timestamp(),
  `tipo` enum('clube de futebol','escola de futebol','academia','federação','empresa','outro') NOT NULL,
  `cep` varchar(20) DEFAULT NULL,
  `redes_sociais` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`redes_sociais`)),
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `tbl_organizacao`
--

INSERT INTO `tbl_organizacao` (`id_org`, `nome_org`, `email`, `telefone_org`, `password_org`, `logo_org`, `bio`, `descricao`, `data_fundacao`, `tipo`, `cep`, `redes_sociais`, `created_at`) VALUES
(4, 'São Paulo Futebol Clube', 'contato@saopaulofc.net', '(11) 40032-000', '$2y$10$a7vCce4eu1DWbn6mtG.PwOKoCBQLQ5iQI3H0acLi38Uwn9CaVCRG2', 'public/uploads/logos/org_logo_6840ae72f0d00.jpg', 'Clube profissional de futebol com sede em São Paulo, reconhecido nacional e internacionalmente.', 'O São Paulo Futebol Clube é uma das principais equipes de futebol do Brasil, fundado em 25 de janeiro de 1930. Com sede no estádio do Morumbi, o clube conquistou diversos títulos nacionais e internacionais, incluindo a Copa Libertadores da América e o Mundial de Clubes da FIFA. Suas cores tradicionais são vermelho, preto e branco, e seu mascote é o \\\"São Paulinho\\\".', '1930-01-25', 'clube de futebol', '05653-070', NULL, '2025-06-04 17:37:07');


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
(1, 'Shandel Villasante Merlo', 'shandelvm16@gmail.com', '$2y$10$/r1NjYb6YbuPLHqEfJWoTOgC1gWW9Y2GjlYqyHuo3.hsi64xJG.7.', '2006-06-13', 'masculino', '../../public/images/profilePhotos/63f9078f50343495a705174a579c4ebb.png', '(11) 91034-6024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', '2025-03-26 16:30:59', '2025-03-26 16:30:59'),
(2, 'Pedro Medeiros', 'pedrosantos57@gmail.com', '$2y$10$RGBbFsjHN445mW13T1lNuuRTQKSLKmt6kn3nJLWaYtjN6p97TLvUS', '2007-10-15', 'masculino', '../../public/images/profilePhotos/4dfbdd0bab17f7db0777ebe63f252392.png', '(11) 93739-4489', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', '2025-04-22 13:49:20', '2025-04-22 13:49:20'),
(3, 'Murilo Magalhâes', 'superonze46@gmail.com', '$2y$10$fb8mzsnbuknK1gn5vm/2pe1JCajbeI6vJqJzkXt.kc39knhw0zn72', '2007-01-18', 'masculino', '../../public/images/profilePhotos/d1174ab5ba81d29a006a8032587894a4.png', '(11) 93497-3298', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', '2025-04-22 13:51:32', '2025-04-22 13:51:32'),
(4, 'Eduardo Fernandes', 'eduardofernandes134@gmail.com', '$2y$10$nKkdNMWtvoq/MoZT5f1AmeMxm273QzaCzGmyR31VdoqWtIkjFC8du', '2008-02-05', 'masculino', '../../public/images/profilePhotos/defaultPhoto.png', '(11) 93487-3894', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', '2025-04-22 13:54:56', '2025-05-30 14:19:28'),
(5, 'Daniel Mattos', 'danimattos@gmail.com', '$2y$10$i8yA1OcevHfOuENccmJjW.INo46k0wvaAQzBK/keKNZO3.QZSRevK', '2007-04-08', 'masculino', '../../public/images/profilePhotos/fc6674b38f5ddc654d765bad7c410b99.png', '(11) 94597-8548', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', '2025-04-22 14:00:12', '2025-04-22 14:00:12'),
(6, 'Thiago Ribeiro', 'thiagoribeiro23@gmail.com', '$2y$10$UcNCrhuS.GnVmewqepW0G.yKp0aV7QKI8fY5RNS/Eelxl8TXBpWLi', '2006-09-01', 'masculino', '../../public/images/profilePhotos/defaultPhoto.png', '(11) 98429-5376', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', '2025-04-22 14:05:40', '2025-05-30 14:19:28'),
(7, 'Lucas Pereira', 'lucas.pereira95@gmail.com', '$2y$10$Z3b2BjN7siY4mPp2ZYveg.E5Ou.zYBo/kD7Xlf6F9tOgK7JK2/rh2', '1995-05-12', 'masculino', '../../public/images/profilePhotos/d221c089c6b9a3a7e30e189334e33ff3.jpg', '(11) 93498-4533', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', '2025-04-22 14:09:58', '2025-05-30 14:43:30'),
(8, 'Mariana Costa', 'mariana.costa88@hotmail.com', '$2y$10$cakhPbUuDnw.By6Dt9qSpubJyldwC7IKbXYqU944ntLbtfqON9QdO', '1988-07-23', 'masculino', '../../public/images/profilePhotos/83bcdec6db814bfdbd59a58cd38895fd.jpg', '(11) 92349-8495', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', '2025-04-22 14:10:59', '2025-05-30 14:54:28'),
(9, 'Gabriel Almeida', 'gabriel.almeida01@gmail.com', '$2y$10$DfFdrR5UgRiX1dHAtJbPbuv9o2xOGjW/NdqIy3LUq/LOLKO1Dsu7e', '2001-11-01', 'masculino', '../../public/images/profilePhotos/b994d42e0c2a4b54156b024f9d3b61dd.jfif', '(19) 95293-4857', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', '2025-04-22 14:11:52', '2025-05-30 15:05:12'),
(10, 'João Oliveira', 'joao.oliveira80@gmail.com', '$2y$10$X45zxeG5Nd6re714MfqQVuArt8j4QOw1VUmaaqCFlwm88p1c6UWFy', '1980-08-04', 'masculino', '../../public/images/profilePhotos/097b1fb33cfe2100e0595ec03e14d2c5.webp', '(11) 93985-2147', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', '2025-04-22 14:12:55', '2025-05-30 15:08:56'),
(11, 'Shandel', 'shandelvm18@gmail.etec', '$2y$10$d5IrkqQMSnRMt6nUeWmBgeSNwI.Xokm1Zaq9YjdF7IKsnTrwL4tsS', '2006-06-13', 'masculino', '../../public/images/profilePhotos/defaultPhoto.png', '(11) 91034-3903', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', '2025-05-20 14:10:05', '2025-05-30 14:19:28'),
(12, 'Messi da Silva Ronaldo', 'messi@gmail.com', '$2y$10$3savcBMz9aa3Vtu7W3OhjeR8F6vhmDtMNVAxbzSl4wDZxqtbWROuC', '2008-06-19', 'masculino', '../../public/images/profilePhotos/ac968177e896ec1aa7d37b7dbecf91f1.jfif', '(11) 95644-6342', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', '2025-06-02 14:39:06', '2025-06-02 14:39:06');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`id_comentario`),
  ADD KEY `id_post` (`id_post`),
  ADD KEY `id_user` (`id_user`);

--
-- Índices de tabela `curtidas`
--
ALTER TABLE `curtidas`
  ADD PRIMARY KEY (`id_curtida`),
  ADD UNIQUE KEY `unique_curtida` (`id_post`,`id_user`),
  ADD KEY `id_user` (`id_user`);

--
-- Índices de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_destino` (`id_user_destino`),
  ADD KEY `idx_lida` (`lida`);

--
-- Índices de tabela `peneiras`
--
ALTER TABLE `peneiras`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `id_user` (`id_user`);

--
-- Índices de tabela `reposts`
--
ALTER TABLE `reposts`
  ADD PRIMARY KEY (`id_repost`),
  ADD UNIQUE KEY `unique_repost` (`id_post_original`,`id_user`),
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
  ADD UNIQUE KEY `nome_org` (`nome_org`);

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
-- AUTO_INCREMENT de tabela `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `curtidas`
--
ALTER TABLE `curtidas`
  MODIFY `id_curtida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `peneiras`
--
ALTER TABLE `peneiras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `posts`
--
ALTER TABLE `posts`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `reposts`
--
ALTER TABLE `reposts`
  MODIFY `id_repost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tbl_hist_contrato`
--
ALTER TABLE `tbl_hist_contrato`
  MODIFY `id_hist_contrato` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbl_jogador`
--
ALTER TABLE `tbl_jogador`
  MODIFY `id_jogador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `tbl_jogo`
--
ALTER TABLE `tbl_jogo`
  MODIFY `id_jogo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbl_organizacao`
--
ALTER TABLE `tbl_organizacao`
  MODIFY `id_org` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
-- Restrições para tabelas `comentarios`
--
ALTER TABLE `comentarios`
  ADD CONSTRAINT `comentarios_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `posts` (`id_post`) ON DELETE CASCADE,
  ADD CONSTRAINT `comentarios_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tbl_usuarios` (`id_user`) ON DELETE CASCADE;

--
-- Restrições para tabelas `curtidas`
--
ALTER TABLE `curtidas`
  ADD CONSTRAINT `curtidas_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `posts` (`id_post`) ON DELETE CASCADE,
  ADD CONSTRAINT `curtidas_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tbl_usuarios` (`id_user`) ON DELETE CASCADE;

--
-- Restrições para tabelas `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_usuarios` (`id_user`) ON DELETE CASCADE;

--
-- Restrições para tabelas `reposts`
--
ALTER TABLE `reposts`
  ADD CONSTRAINT `reposts_ibfk_1` FOREIGN KEY (`id_post_original`) REFERENCES `posts` (`id_post`) ON DELETE CASCADE,
  ADD CONSTRAINT `reposts_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `tbl_usuarios` (`id_user`) ON DELETE CASCADE;

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
