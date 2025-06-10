-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10/06/2025 às 07:14
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

--
-- Despejando dados para a tabela `comentarios`
--

INSERT INTO `comentarios` (`id_comentario`, `id_post`, `id_user`, `conteudo`, `criado_em`) VALUES
(26, 8, 12, 'CRACK!', '2025-06-10 04:11:29');

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

--
-- Despejando dados para a tabela `curtidas`
--

INSERT INTO `curtidas` (`id_curtida`, `id_post`, `id_user`, `criado_em`) VALUES
(24, 5, 6, '2025-06-10 03:37:51'),
(26, 8, 12, '2025-06-10 04:11:26'),
(27, 8, 6, '2025-06-10 04:12:03');

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

--
-- Despejando dados para a tabela `notificacoes`
--

INSERT INTO `notificacoes` (`id`, `id_user_destino`, `id_user_origem`, `tipo`, `id_referencia`, `conteudo`, `lida`, `criado_em`) VALUES
(22, 12, 6, 'comentario', 5, 'Vc e bom', 0, '2025-06-10 04:00:04'),
(23, 12, 6, 'comentario', 5, 'SOU RICO BEM ANTES DE TER DINHEIROOOO', 0, '2025-06-10 04:06:27'),
(24, 6, 12, 'curtida', 8, 'Sou Franck Ribéry, jogador das categorias de base. Jogo como meia-atacante e gosto de partir pra cim', 0, '2025-06-10 04:11:26'),
(25, 6, 12, 'comentario', 8, 'CRACK!', 0, '2025-06-10 04:11:29');

-- --------------------------------------------------------

--
-- Estrutura para tabela `peneiras`
--

CREATE TABLE `peneiras` (
  `id` int(11) NOT NULL,
  `id_org` int(11) DEFAULT NULL,
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

INSERT INTO `peneiras` (`id`, `id_org`, `titulo`, `clube`, `foto_peneira`, `descricao`, `localizacao`, `data`, `horario`, `inscricao`, `status`, `faixa_etaria`, `caminho_foto`, `caminho_documento`, `badge_type`, `status_inscricao`, `fotos`, `documentos`, `data_criacao`, `data_atualizacao`) VALUES
(4, NULL, 'Peneira Ofc Sub 14', 'Santos Futebol Clube', 'uploads/peneiras/peneira_683e02c12c3ef.jpg', 'O Santos Futebol Clube, também conhecido como Santos, é um clube brasileiro de futebol com sede na cidade de Santos, no estado de São Paulo. Foi fundado em 14 de abril de 1912 e é um dos clubes mais históricos e vitoriosos do Brasil, com um legado que inclui a revelação de grandes talentos, como Pelé. ', 'Rua Pelé Silveiro', '2025-09-19', '15:30:00', 'Gratuita', 'Ativa', '14', NULL, NULL, 'normal', '', '[\"uploads\\/peneiras\\/extra_683e02c12c57b.png\",\"uploads\\/peneiras\\/extra_683e02c12c6b0.png\",\"uploads\\/peneiras\\/extra_683e02c12c7d7.png\"]', '[\"uploads\\/documentos\\/doc_683e02c12c96a.png\"]', '2025-06-02 23:00:01', '2025-06-02 23:00:01'),
(5, 5, 'Bragantino Peneira (Sub-8 a Sub-13)', 'Bragantino Futebol Clube', 'uploads/peneiras/peneira_6843405c58289.jpeg', 'O Red Bull Bragantino realiza seletivas periódicas para integrar novos talentos às suas categorias de base. Essas peneiras são gratuitas e abertas a jogadores nascidos entre 2011 e 2016 (Sub-8 a Sub-13).', 'Campo do Nóbrega – Rua Inhambu, 343, Vila Padre Manoel de Nóbrega, Campinas-SP', '2025-06-07', '14:30:00', 'Gratuita', 'Ativa', '8-13', 'uploads/peneiras/peneira_6843405c58289.jpeg', NULL, 'normal', 'status-open', '[\"uploads\\/peneiras\\/extra_6843405c584e6.webp\",\"uploads\\/peneiras\\/extra_6843405c5869a.webp\",\"uploads\\/peneiras\\/extra_6843405c58875.webp\"]', '[]', '2025-06-06 22:24:12', '2025-06-06 22:37:45'),
(6, 5, 'Bragantino Peneira (Sub-18)', 'RB Bragantino', 'uploads/peneiras/peneira_68434bdc46320.jpeg', 'Red Bull Bragantino é um clube de futebol de Bragança Paulista, que une tradição e inovação. Desde 2019 sob gestão da Red Bull, o time se destaca pelo foco em jovens talentos e pelo futebol moderno e competitivo.', 'Campo do Nóbrega – Rua Inhambu, 343, Vila Padre Manoel de Nóbrega, Campinas-SP', '2025-06-15', '13:00:00', 'Gratuita', 'Ativa', '18', 'uploads/peneiras/peneira_68434bdc46320.jpeg', NULL, 'normal', 'status-open', '[\"uploads\\/peneiras\\/extra_68434bdc4656e.webp\",\"uploads\\/peneiras\\/extra_68434bdc4673b.webp\",\"uploads\\/peneiras\\/extra_68434bdc468bc.webp\"]', '[]', '2025-06-06 23:13:16', '2025-06-06 23:13:16');

-- --------------------------------------------------------

--
-- Estrutura para tabela `posts`
--

CREATE TABLE `posts` (
  `id_post` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `conteudo` text NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `video_url` varchar(250) DEFAULT NULL,
  `criado_em` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `posts`
--

INSERT INTO `posts` (`id_post`, `id_user`, `conteudo`, `imagem`, `video_url`, `criado_em`) VALUES
(5, 12, 'Sou messi, ponta esquerda', NULL, '', '2025-06-10 00:05:17'),
(8, 6, 'Sou Franck Ribéry, jogador das categorias de base. Jogo como meia-atacante e gosto de partir pra cima, com velocidade e dribles rápidos. Sempre busco melhorar a cada treino e dar o meu melhor pelo time. Meu sonho é chegar ao profissional, representar meu clube no alto nível e mostrar tudo o que venho construindo desde pequeno.', '../../uploads/posts/6847b06188430_1749528673.webp', '', '2025-06-10 01:11:13');

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
-- Estrutura para tabela `tbl_caracteristicas_jogador`
--

CREATE TABLE `tbl_caracteristicas_jogador` (
  `id_caracteristica` int(11) NOT NULL,
  `id_jogador` int(11) NOT NULL,
  `caracteristica` varchar(100) NOT NULL,
  `nivel` enum('iniciante','intermediario','avancado','expert') DEFAULT 'intermediario',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `tbl_caracteristicas_jogador`
--

INSERT INTO `tbl_caracteristicas_jogador` (`id_caracteristica`, `id_jogador`, `caracteristica`, `nivel`, `created_at`) VALUES
(1, 6, 'Rápido', 'intermediario', '2025-06-06 17:35:27'),
(2, 6, 'Passes Precisos', 'avancado', '2025-06-06 17:35:27'),
(3, 6, 'Driblador', 'expert', '2025-06-06 17:35:27'),
(7, 7, 'Marcação', 'intermediario', '2025-06-10 03:59:05');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_conquistas_jogador`
--

CREATE TABLE `tbl_conquistas_jogador` (
  `id_conquista` int(11) NOT NULL,
  `id_jogador` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `ano` year(4) NOT NULL,
  `clube` varchar(255) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `tipo` enum('campeonato','torneio','individual','reconhecimento') DEFAULT 'campeonato',
  `posicao` enum('campeao','vice','terceiro','participacao','destaque') DEFAULT 'participacao',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `tbl_conquistas_jogador`
--

INSERT INTO `tbl_conquistas_jogador` (`id_conquista`, `id_jogador`, `titulo`, `ano`, `clube`, `descricao`, `tipo`, `posicao`, `created_at`) VALUES
(1, 6, 'Libertadores', '2013', 'Santos FC', 'Mvp', 'campeonato', 'campeao', '2025-06-06 17:35:27'),
(2, 6, 'Champions', '2015', 'Barcelona', 'Carreguei Geral', 'campeonato', 'campeao', '2025-06-06 17:35:27');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tbl_historico_clubes`
--

CREATE TABLE `tbl_historico_clubes` (
  `id_historico` int(11) NOT NULL,
  `id_jogador` int(11) NOT NULL,
  `nome_clube` varchar(255) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date DEFAULT NULL,
  `posicao` varchar(100) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `tbl_historico_clubes`
--

INSERT INTO `tbl_historico_clubes` (`id_historico`, `id_jogador`, `nome_clube`, `data_inicio`, `data_fim`, `posicao`, `descricao`, `ativo`, `created_at`) VALUES
(1, 6, 'Santos FC', '2010-04-12', '2013-02-04', 'Ponta', 'Joguei mt', 0, '2025-06-06 17:35:27');

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
  `status` enum('sem time','ativo','lesionado','suspenso') DEFAULT 'sem time',
  `redes_sociais` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL COMMENT 'Redes sociais do jogador em formato JSON' CHECK (json_valid(`redes_sociais`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `tbl_jogador`
--

INSERT INTO `tbl_jogador` (`id_jogador`, `id_user`, `id_time`, `apelido`, `altura`, `peso`, `posicao`, `estiloJogo`, `pe_dominante`, `descricao`, `data_inicio_time`, `status`, `redes_sociais`) VALUES
(1, 11, NULL, 'Shand', 1.70, 55.30, 'Zagueiro', 'Estratégico', 'Direito', 'Sou apenas um aluno da etec com o desejo de competir na Champions', NULL, 'sem time', NULL),
(2, 7, NULL, 'Luquinhas', 1.82, 68.00, 'Volante', 'Técnico', 'Direito', 'Sou um atleta dedicado, atuando como jogador de futebol na categoria sub-20. Tenho paixão pelo esporte desde a infância e busco constantemente evoluir técnica, tática e fisicamente. Comprometido com o trabalho em equipe e com o desempenho em campo, meu objetivo é alcançar o profissionalismo e representar com orgulho o clube e a camisa que visto.', NULL, 'sem time', NULL),
(3, 8, NULL, 'Mary', 1.70, 55.60, 'Meia', 'Agressivo', 'Esquerdo', 'Sou Mariana, jogadora de futebol com uma paixão imensa pelo esporte e uma dedicação constante em melhorar a cada treino. Meu jogo é focado em agilidade e intensidade, sempre buscando contribuir para o time, seja criando jogadas ou finalizando com precisão. Acredito no poder do trabalho em equipe e estou sempre pronta para enfrentar novos desafios, buscando evolução tanto técnica quanto mental. Futebol é minha vida, e minha missão é dar o meu melhor em cada partida!', NULL, 'sem time', NULL),
(4, 9, NULL, '', 1.74, 79.00, 'Atacante', 'Agressivo', 'Direito', 'Sou Gabriel Almeida, tenho 20 anos e venho das categorias de base. Meu foco é evoluir a cada dia, dando o máximo em cada treino e jogo. Em campo, sou rápido e técnico, sempre buscando ajudar o time a conquistar os objetivos. Estou pronto para os desafios e para mostrar meu potencial!', NULL, 'sem time', NULL),
(5, 10, NULL, 'Muralha', 1.86, 80.00, 'Goleiro', 'Defensivo', 'Direito', 'Sou um goleiro mirim apaixonado por futebol desde pequeno. Adoro estar embaixo das traves, fazendo defesas difíceis e ajudando meu time com garra e dedicação. Estou sempre treinando para melhorar meus reflexos, posicionamento e coragem, porque sei que o goleiro é a última linha de defesa. Sonho em um dia jogar profissionalmente e vestir a camisa de um grande clube, mas por enquanto, meu maior prazer é jogar com os amigos e dar o meu melhor em cada partida.', NULL, 'sem time', NULL),
(6, 13, NULL, 'Sosia do Neymar', 1.75, 78.50, 'Ponta', 'Ousadia e Alegria', 'Ambos', 'Sou o Neymar sósia e me interesso muito por futebol, quero crescer muito na área. Obrigado FutLink.', NULL, 'sem time', NULL),
(7, 6, NULL, 'Feinho', 1.83, 78.00, 'Ponta', 'Raçudo', 'Ambos', 'Sou ribery, jogador mais feio da história do futebol porém sou bom!', NULL, 'sem time', NULL);

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
(4, 'São Paulo Futebol Clube', 'contato@saopaulofc.net', '(11) 40032-000', '$2y$10$a7vCce4eu1DWbn6mtG.PwOKoCBQLQ5iQI3H0acLi38Uwn9CaVCRG2', 'public/uploads/logos/org_logo_6840ae72f0d00.jpg', 'Clube profissional de futebol com sede em São Paulo, reconhecido nacional e internacionalmente.', 'O São Paulo Futebol Clube é uma das principais equipes de futebol do Brasil, fundado em 25 de janeiro de 1930. Com sede no estádio do Morumbi, o clube conquistou diversos títulos nacionais e internacionais, incluindo a Copa Libertadores da América e o Mundial de Clubes da FIFA. Suas cores tradicionais são vermelho, preto e branco, e seu mascote é o \\\"São Paulinho\\\".', '1930-01-25', 'clube de futebol', '05653-070', NULL, '2025-06-04 17:37:07'),
(5, 'RB Bragantino', 'bragantinorb@gmail.com', '(11) 22771-036', '$2y$10$aBITw3uCIeB89po9/6z.PujnF0eD0XHcWnfTUSQ8IkA.N.eEvh0Xa', 'public/uploads/logos/org_logo_68433e1ce64b9.jpeg', 'Red Bull Bragantino é um clube de futebol de Bragança Paulista, que une tradição e inovação. Desde 2019 sob gestão da Red Bull, o time se destaca pelo foco em jovens talentos e pelo futebol moderno e competitivo.', 'Red Bull Bragantino é um clube de futebol brasileiro com sede em Bragança Paulista, São Paulo, fundado originalmente em 1928. Em 2019, passou por uma reestruturação após parceria com a Red Bull, tornando-se parte do grupo global da marca, que investe em clubes ao redor do mundo.\\r\\n\\r\\nO projeto une a tradição do antigo Clube Atlético Bragantino com uma gestão moderna, voltada para dados, desempenho e formação de jovens atletas. Desde então, o clube vem se consolidando como uma força emergente no futebol brasileiro, com participações expressivas na Série A, na Copa do Brasil e em torneios internacionais como a Copa Sul-Americana.', '1928-01-08', 'clube de futebol', '12914-410', NULL, '2025-06-06 16:14:36'),
(6, 'Sport Club Corinthians Paulista', 'corinthians@gmail.com', '(11) 91234-5678', '$2y$10$YXsRFfpVmDmmkhhGiP6GnudLxGz3qq4EUnS3QEv7snhDRFn6Dxjcm', 'public/uploads/logos/org_logo_6847b860995c9.webp', 'Corinthians é um clube de futebol de São Paulo, conhecido por sua forte ligação com o povo e uma torcida apaixonada. Fundado em 1910, o Timão se destaca pela garra em campo e por sua grande influência no cenário esportivo brasileiro.', 'Sport Club Corinthians Paulista é um dos clubes mais tradicionais e populares do Brasil, fundado em 1º de setembro de 1910, em São Paulo. Conhecido como Timão, tem uma torcida apaixonada e uma forte ligação com as classes populares. Ao longo de sua história, se consolidou como um dos clubes mais influentes do futebol brasileiro. Seu estádio é a Neo Química Arena, em Itaquera, na zona leste paulistana.', '1910-08-01', 'clube de futebol', '08295-005', NULL, '2025-06-10 01:45:20'),
(7, 'Chute Inicial Corinthians', 'chuteinicialtimao@gmail.com', '(11) 93456-7890', '$2y$10$iaIA.8esu7EZMfZj3k77V.ZrV51sMGVsMTryndeLAB0mDEXbjf8cK', 'public/uploads/logos/org_logo_6847b9f9796e3.png', 'Chute Inicial Corinthians Itaquera é uma escolinha de futebol vinculada ao Corinthians, localizada na Zona Leste de São Paulo. Voltada para crianças e jovens, a escolinha promove o desenvolvimento técnico e social por meio do esporte, incentivando a prática do futebol com disciplina.', 'O Chute Inicial Corinthians Itaquera faz parte do projeto social e esportivo do Sport Club Corinthians Paulista, oferecendo treinamento para crianças e adolescentes da comunidade local. O foco está na base, com aulas que ensinam fundamentos do futebol, além de estimular o crescimento pessoal e a cidadania dos participantes. A escolinha funciona em um ambiente estruturado, com profissionais qualificados, buscando revelar novos talentos para o futebol e promover inclusão social por meio do esporte. Localizada em Itaquera, a escolinha está próxima à Neo Química Arena, facilitando o acesso dos alunos.\\r\\n', '1910-09-01', 'escola de futebol', '08295-300', NULL, '2025-06-10 01:52:09'),
(8, 'Santos Futebol Clube', 'santosfc@gmail.com', '(13) 32269-300', '$2y$10$qJtHxUlrhfhTyrE7tY90uOhV2vEbUnJM0bbkMSyjArpaDBcrOWUh6', 'public/uploads/logos/org_logo_6847bb275eb75.jpg', 'A base do Santos FC é famosa por revelar grandes talentos do futebol mundial, formando jovens atletas com foco em técnica, disciplina e trabalho coletivo. Conhecida como um celeiro de craques, a base valoriza o desenvolvimento integral dos jogadores, preparando-os para o profissional.', 'A base do Santos Futebol Clube é uma das mais tradicionais e respeitadas do Brasil, com uma estrutura completa para a formação de jovens atletas desde a categoria sub-9 até o sub-20. O centro de treinamento tem foco na excelência técnica, tática e física, além de promover o crescimento pessoal dos jogadores com acompanhamento educacional e psicológico. A base santista é reconhecida mundialmente por revelar ídolos como Pelé, Neymar, Robinho e muitos outros. O clube investe em profissionais qualificados e em metodologia moderna para desenvolver o potencial máximo de seus atletas, preparando-os para o futebol de alto nível e para a vida fora dos campos.', '1912-04-14', 'escola de futebol', '11045-001', NULL, '2025-06-10 01:57:11'),
(9, 'Clube de Regatas Flamengo', 'flamengo@gmail.com', '(21) 23345-100', '$2y$10$X3KxeXUOrUWQaHeLPLCAFubS2Cvy/.rqeN2l072pEA.j00ATw2U/y', 'public/uploads/logos/org_logo_6847bbe3e4a3b.jpg', 'A base do Flamengo é uma das mais estruturadas do Brasil, focada em formar jogadores talentosos com técnica, disciplina e espírito de equipe. Reconhecida por revelar grandes atletas, a base prepara jovens para o futebol profissional com metodologia moderna e forte apoio técnico.', 'A base do Clube de Regatas do Flamengo é referência nacional na formação de jogadores, oferecendo uma estrutura completa que abrange desde as categorias iniciais até o sub-20. Localizada na Gávea, zona sul do Rio de Janeiro, a base conta com profissionais qualificados, preparação física, acompanhamento psicológico e educacional, além de metodologia atualizada que visa o desenvolvimento técnico, tático e humano dos atletas. O Flamengo investe na base para revelar talentos que possam brilhar no profissional e também no cenário internacional, mantendo a tradição de formar craques e fortalecer a identidade do clube.', '1905-09-23', 'escola de futebol', '22451-000', NULL, '2025-06-10 02:00:19'),
(10, 'Club de Regatas Vasco da Gama', 'vasco@gmail.com', '(21) 25974-848', '$2y$10$wTscrcSUdACPS4jwixbDfuHdgeW3J63yvOitpywsCuoishYQiX.Qy', 'public/uploads/logos/org_logo_6847bd0c4969e.png', 'A base do Vasco da Gama é reconhecida por formar jovens atletas com foco em técnica, disciplina e caráter. Com tradição no desenvolvimento de talentos, prepara jogadores para o futebol profissional e valoriza o crescimento pessoal dentro e fora de campo.', 'A base do Club de Regatas Vasco da Gama possui uma estrutura dedicada à formação completa de atletas, desde as categorias iniciais até o sub-20. Localizada em São Januário, Rio de Janeiro, a base oferece treinamento técnico, físico e tático, além de suporte educacional e psicológico para o desenvolvimento integral dos jogadores. O Vasco tem um histórico de revelar grandes nomes do futebol brasileiro e investe continuamente em profissionais qualificados e metodologia atualizada para preparar seus jovens talentos para a carreira profissional e desafios futuros.', '1898-01-21', 'clube de futebol', '20941-000', NULL, '2025-06-10 02:05:16'),
(11, 'Sport Club Internacional', 'internacional@gmail.com', '(51) 33167-600', '$2y$10$SDnlrACyeywjsIvM.kdnu.eUFentGXN1fWJeQKF3d.la2saNVjqla', 'public/uploads/logos/org_logo_6847bdcf76912.jpeg', 'A base do Internacional é referência no sul do Brasil, focada em revelar e formar jovens talentos com técnica, disciplina e visão de jogo. O clube investe no desenvolvimento integral dos atletas para prepará-los para o futebol profissional.', 'O Sport Club Internacional possui uma das estruturas mais modernas para categorias de base do Brasil, localizada em Porto Alegre. A base do clube atende desde as categorias de iniciação até o sub-20, com foco na formação técnica, física, tática e mental dos jovens atletas. Além do treinamento em campo, o Internacional oferece acompanhamento educacional e psicológico para garantir o desenvolvimento completo dos jogadores. Conhecido por revelar talentos que atuam tanto no Brasil quanto no exterior, o clube mantém uma metodologia atualizada e profissionais especializados para preparar os atletas para o alto nível.', '1913-12-12', 'clube de futebol', '90810-050', NULL, '2025-06-10 02:08:31'),
(12, 'Fluminense Football Club', 'fluminense@gmail.com', '(21) 25433-122', '$2y$10$C6gXW1uHvX52G6aSwuaSZ.PRvlkztYgp09og0n4UQKyKM6eeoV096', 'public/uploads/logos/org_logo_6847be45b6f1e.jpeg', 'O Fluminense Football Club é um dos clubes mais tradicionais do Rio de Janeiro, com uma história rica em técnica e garra. Reconhecido por seu estilo de jogo ofensivo e pela formação de talentos, o Fluminense é símbolo de tradição e paixão no futebol brasileiro.', 'Fundado em 1902, o Fluminense é um dos clubes mais antigos e respeitados do Brasil, com sede no Rio de Janeiro. O time profissional disputa as principais competições nacionais e internacionais, buscando sempre o equilíbrio entre a valorização da base e a experiência dos jogadores mais veteranos. Conhecido por sua camisa tricolor, o clube mantém uma forte ligação com sua torcida e com a história do futebol carioca. O Fluminense conta com uma estrutura moderna de treinamento e um elenco competitivo, que visa o sucesso dentro e fora dos campos, valorizando o futebol bonito e a ética esportiva.', '1930-08-27', 'clube de futebol', '22241-060', NULL, '2025-06-10 02:10:29');

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
(6, 'Thiago Ribery', 'thiagoribeiro23@gmail.com', '$2y$10$UcNCrhuS.GnVmewqepW0G.yKp0aV7QKI8fY5RNS/Eelxl8TXBpWLi', '2006-09-01', 'masculino', '../../public/images/profilePhotos/8c84fdbe8f6b063b38a450f7728241fc.jpg', '(11) 98429-5376', '', NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', '2025-04-22 14:05:40', '2025-06-10 00:59:05'),
(7, 'Lucas Pereira', 'lucas.pereira95@gmail.com', '$2y$10$Z3b2BjN7siY4mPp2ZYveg.E5Ou.zYBo/kD7Xlf6F9tOgK7JK2/rh2', '1995-05-12', 'masculino', '../../public/images/profilePhotos/d221c089c6b9a3a7e30e189334e33ff3.jpg', '(11) 93498-4533', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', '2025-04-22 14:09:58', '2025-05-30 14:43:30'),
(8, 'Mariana Costa', 'mariana.costa88@hotmail.com', '$2y$10$cakhPbUuDnw.By6Dt9qSpubJyldwC7IKbXYqU944ntLbtfqON9QdO', '1988-07-23', 'masculino', '../../public/images/profilePhotos/83bcdec6db814bfdbd59a58cd38895fd.jpg', '(11) 92349-8495', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', '2025-04-22 14:10:59', '2025-05-30 14:54:28'),
(9, 'Gabriel Almeida', 'gabriel.almeida01@gmail.com', '$2y$10$DfFdrR5UgRiX1dHAtJbPbuv9o2xOGjW/NdqIy3LUq/LOLKO1Dsu7e', '2001-11-01', 'masculino', '../../public/images/profilePhotos/b994d42e0c2a4b54156b024f9d3b61dd.jfif', '(19) 95293-4857', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', '2025-04-22 14:11:52', '2025-05-30 15:05:12'),
(10, 'João Oliveira', 'joao.oliveira80@gmail.com', '$2y$10$X45zxeG5Nd6re714MfqQVuArt8j4QOw1VUmaaqCFlwm88p1c6UWFy', '1980-08-04', 'masculino', '../../public/images/profilePhotos/097b1fb33cfe2100e0595ec03e14d2c5.webp', '(11) 93985-2147', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', '2025-04-22 14:12:55', '2025-05-30 15:08:56'),
(11, 'Shandel', 'shandelvm18@gmail.etec', '$2y$10$d5IrkqQMSnRMt6nUeWmBgeSNwI.Xokm1Zaq9YjdF7IKsnTrwL4tsS', '2006-06-13', 'masculino', '../../public/images/profilePhotos/defaultPhoto.png', '(11) 91034-3903', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', '2025-05-20 14:10:05', '2025-05-30 14:19:28'),
(12, 'Messi da Silva Ronaldo', 'messi@gmail.com', '$2y$10$3savcBMz9aa3Vtu7W3OhjeR8F6vhmDtMNVAxbzSl4wDZxqtbWROuC', '2008-06-19', 'masculino', '../../public/images/profilePhotos/ac968177e896ec1aa7d37b7dbecf91f1.jfif', '(11) 95644-6342', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', '2025-06-02 14:39:06', '2025-06-02 14:39:06'),
(13, 'Pedro', 'medeirosantosph@gmail.com', '$2y$10$bGbauKRlKzi8WOX3606HLOUEo0aO/jFk6ewO5DGrbXVcByzjaltxq', '2007-12-03', 'masculino', '../../public/images/profilePhotos/defaultPhoto.png', '(11) 91444-1937', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', '2025-06-06 14:26:34', '2025-06-06 14:26:34');

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_organizacao_cria` (`id_org`);

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
-- Índices de tabela `tbl_caracteristicas_jogador`
--
ALTER TABLE `tbl_caracteristicas_jogador`
  ADD PRIMARY KEY (`id_caracteristica`),
  ADD KEY `id_jogador` (`id_jogador`),
  ADD KEY `idx_jogador_caracteristicas` (`id_jogador`,`caracteristica`);

--
-- Índices de tabela `tbl_conquistas_jogador`
--
ALTER TABLE `tbl_conquistas_jogador`
  ADD PRIMARY KEY (`id_conquista`),
  ADD KEY `id_jogador` (`id_jogador`),
  ADD KEY `idx_jogador_conquistas` (`id_jogador`,`ano`);

--
-- Índices de tabela `tbl_historico_clubes`
--
ALTER TABLE `tbl_historico_clubes`
  ADD PRIMARY KEY (`id_historico`),
  ADD KEY `id_jogador` (`id_jogador`),
  ADD KEY `idx_jogador_historico` (`id_jogador`,`data_inicio`);

--
-- Índices de tabela `tbl_jogador`
--
ALTER TABLE `tbl_jogador`
  ADD PRIMARY KEY (`id_jogador`),
  ADD KEY `id_user` (`id_user`);

--
-- Índices de tabela `tbl_organizacao`
--
ALTER TABLE `tbl_organizacao`
  ADD PRIMARY KEY (`id_org`),
  ADD UNIQUE KEY `nome_org` (`nome_org`);

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
  MODIFY `id_comentario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `curtidas`
--
ALTER TABLE `curtidas`
  MODIFY `id_curtida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `notificacoes`
--
ALTER TABLE `notificacoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `peneiras`
--
ALTER TABLE `peneiras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `posts`
--
ALTER TABLE `posts`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `reposts`
--
ALTER TABLE `reposts`
  MODIFY `id_repost` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tbl_caracteristicas_jogador`
--
ALTER TABLE `tbl_caracteristicas_jogador`
  MODIFY `id_caracteristica` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tbl_conquistas_jogador`
--
ALTER TABLE `tbl_conquistas_jogador`
  MODIFY `id_conquista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `tbl_historico_clubes`
--
ALTER TABLE `tbl_historico_clubes`
  MODIFY `id_historico` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `tbl_jogador`
--
ALTER TABLE `tbl_jogador`
  MODIFY `id_jogador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tbl_organizacao`
--
ALTER TABLE `tbl_organizacao`
  MODIFY `id_org` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `tbl_time`
--
ALTER TABLE `tbl_time`
  MODIFY `id_time` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
-- Restrições para tabelas `peneiras`
--
ALTER TABLE `peneiras`
  ADD CONSTRAINT `fk_organizacao_cria` FOREIGN KEY (`id_org`) REFERENCES `tbl_organizacao` (`id_org`);

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
-- Restrições para tabelas `tbl_caracteristicas_jogador`
--
ALTER TABLE `tbl_caracteristicas_jogador`
  ADD CONSTRAINT `tbl_caracteristicas_jogador_ibfk_1` FOREIGN KEY (`id_jogador`) REFERENCES `tbl_jogador` (`id_jogador`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tbl_conquistas_jogador`
--
ALTER TABLE `tbl_conquistas_jogador`
  ADD CONSTRAINT `tbl_conquistas_jogador_ibfk_1` FOREIGN KEY (`id_jogador`) REFERENCES `tbl_jogador` (`id_jogador`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tbl_historico_clubes`
--
ALTER TABLE `tbl_historico_clubes`
  ADD CONSTRAINT `tbl_historico_clubes_ibfk_1` FOREIGN KEY (`id_jogador`) REFERENCES `tbl_jogador` (`id_jogador`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tbl_jogador`
--
ALTER TABLE `tbl_jogador`
  ADD CONSTRAINT `tbl_jogador_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `tbl_usuarios` (`id_user`) ON DELETE CASCADE;

--
-- Restrições para tabelas `tbl_time`
--
ALTER TABLE `tbl_time`
  ADD CONSTRAINT `tbl_time_ibfk_1` FOREIGN KEY (`id_org`) REFERENCES `tbl_organizacao` (`id_org`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
