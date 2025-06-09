-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 07/06/2025 às 05:46
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
-- Banco de dados: `biblioteca`
--
CREATE DATABASE IF NOT EXISTS `biblioteca` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `biblioteca`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `livros`
--

CREATE TABLE `livros` (
  `id` int(11) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `autor` varchar(255) NOT NULL,
  `anoPublicacao` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `livros`
--

INSERT INTO `livros` (`id`, `titulo`, `autor`, `anoPublicacao`) VALUES
(1, 'Dom Quixote', 'Miguel de Cervantes ', 1605),
(2, 'Cem Anos de Solidão', 'Gabriel García Márquez', 1967),
(3, '1984', 'George Orwell', 1949),
(4, 'O Pequeno Príncipe', 'Antoine de Saint-Exupéry', 1943),
(5, 'Orgulho e Preconceito', 'Jane Austen', 1813),
(6, 'A Metamorfose', 'Franz Kafka', 1915),
(7, 'O Senhor dos Anéis', 'J.R.R. Tolkien', 1954),
(8, 'Harry Potter e a Pedra Filosofal', 'J.K. Rowling', 1997),
(9, 'O Código Da Vinci', 'Dan Brown', 2003),
(10, 'O Alquimista', 'Paulo Coelho', 1988), 
(11, 'Memórias Póstumas de Brás Cubas', 'Machado de Assis', 1881),
(12, 'Vidas Secas', 'Graciliano Ramos', 1938),
(13, 'A Hora da Estrela', 'Clarice Lispector', 1977),
(14, 'Grande Sertão: Veredas', 'João Guimarães Rosa', 1956),
(15, 'Dom Casmurro', 'Machado de Assis', 1899),
(16, 'O Cortiço', 'Aluísio Azevedo', 1890),
(17, 'Iracema', 'José de Alencar', 1865),
(18, 'Os Lusíadas', 'Luís Vaz de Camões', 1572),
(19, 'Ensaio sobre a Cegueira', 'José Saramago', 1995),
(20, 'O Evangelho Segundo Jesus Cristo', 'José Saramago', 1991),
(21, 'Admirável Mundo Novo', 'Aldous Huxley', 1932),
(22, 'Fahrenheit 451', 'Ray Bradbury', 1953),
(23, 'O Morro dos Ventos Uivantes', 'Emily Brontë', 1847),
(24, 'Moby Dick', 'Herman Melville', 1851),
(25, 'A Letra Escarlate', 'Nathaniel Hawthorne', 1850),
(26, 'Crime e Castigo', 'Fiódor Dostoiévski', 1866),
(27, 'Os Irmãos Karamázov', 'Fiódor Dostoiévski', 1880),
(28, 'Guerra e Paz', 'Liev Tolstói', 1869),
(29, 'Anna Karenina', 'Liev Tolstói', 1877),
(30, 'Madame Bovary', 'Gustave Flaubert', 1856),
(31, 'O Estrangeiro', 'Albert Camus', 1942),
(32, 'A Peste', 'Albert Camus', 1947),
(33, 'O Processo', 'Franz Kafka', 1925),
(34, 'O Castelo', 'Franz Kafka', 1926),
(35, 'Ulisses', 'James Joyce', 1922),
(36, 'O Grande Gatsby', 'F. Scott Fitzgerald', 1925),
(37, 'O Velho e o Mar', 'Ernest Hemingway', 1952),
(38, 'Para Onde Voam as Gaivotas', 'Mia Couto', 2000),
(39, 'Terra Sonâmbula', 'Mia Couto', 1992),
(40, 'A Varanda do Frangipani', 'Mia Couto', 1996),
(41, 'Nove Noites', 'Bernardo Carvalho', 2002),
(42, 'Estação Brasil', 'Fernando Morais', 1999),
(43, 'Olhos D’Água', 'Conceição Evaristo', 2014),
(44, 'Ponciá Vicêncio', 'Conceição Evaristo', 2003),
(45, 'Quarto de Despejo', 'Carolina Maria de Jesus', 1960),
(46, 'Casa-Grande & Senzala', 'Gilberto Freyre', 1933),
(47, 'Raízes do Brasil', 'Sérgio Buarque de Holanda', 1936),
(48, 'Os Sertões', 'Euclides da Cunha', 1902),
(49, 'Triste Fim de Policarpo Quaresma', 'Lima Barreto', 1915),
(50, 'O Ateneu', 'Raul Pompeia', 1888),
(51, 'Amar, Verbo Intransitivo', 'Mário de Andrade', 1927),
(52, 'Macunaíma', 'Mário de Andrade', 1928),
(53, 'São Bernardo', 'Graciliano Ramos', 1934),
(54, 'Angústia', 'Graciliano Ramos', 1936),
(55, 'Capitães da Areia', 'Jorge Amado', 1937),
(56, 'Gabriela, Cravo e Canela', 'Jorge Amado', 1958),
(57, 'Dona Flor e Seus Dois Maridos', 'Jorge Amado', 1966),
(58, 'Tieta do Agreste', 'Jorge Amado', 1977),
(59, 'O Quinze', 'Rachel de Queiroz', 1930),
(60, 'As Meninas', 'Lygia Fagundes Telles', 1973),
(61, 'Ciranda de Pedra', 'Lygia Fagundes Telles', 1954),
(62, 'Verão no Aquário', 'Lygia Fagundes Telles', 1963),
(63, 'Incidente em Antares', 'Érico Veríssimo', 1971),
(64, 'O Tempo e o Vento', 'Érico Veríssimo', 1949),
(65, 'Olhai os Lírios do Campo', 'Érico Veríssimo', 1938),
(66, 'O Continente', 'Érico Veríssimo', 1949),
(67, 'O Retrato de Dorian Gray', 'Oscar Wilde', 1890),
(68, 'Drácula', 'Bram Stoker', 1897),
(69, 'Frankenstein', 'Mary Shelley', 1818),
(70, 'O Médico e o Monstro', 'Robert Louis Stevenson', 1886),
(71, 'As Aventuras de Sherlock Holmes', 'Arthur Conan Doyle', 1892),
(72, 'O Cão dos Baskervilles', 'Arthur Conan Doyle', 1902),
(73, 'O Hobbit', 'J.R.R. Tolkien', 1937),
(74, 'O Silmarillion', 'J.R.R. Tolkien', 1977),
(75, 'As Crônicas de Nárnia', 'C.S. Lewis', 1950),
(76, 'O Nome da Rosa', 'Umberto Eco', 1980),
(77, 'O Pêndulo de Foucault', 'Umberto Eco', 1988),
(78, 'O Cemitério de Praga', 'Umberto Eco', 2010),
(79, 'O Conto da Aia', 'Margaret Atwood', 1985),
(80, 'O Testamento', 'Margaret Atwood', 2019),
(81, 'As Benevolentes', 'Jonathan Littell', 2006),
(82, 'A Elegância do Ouriço', 'Muriel Barbery', 2006),
(83, 'O Caçador de Pipas', 'Khaled Hosseini', 2003),
(84, 'A Cidade do Sol', 'Khaled Hosseini', 2007),
(85, 'E o Vento Levou...', 'Margaret Mitchell', 1936),
(86, 'O Sol Também se Levanta', 'Ernest Hemingway', 1926),
(87, 'Por Quem os Sinos Dobram', 'Ernest Hemingway', 1940),
(88, 'A Revolução dos Bichos', 'George Orwell', 1945),
(89, 'O Senhor das Moscas', 'William Golding', 1954),
(90, 'O Apanhador no Campo de Centeio', 'J.D. Salinger', 1951),
(91, 'Quem Mexeu no Meu Queijo?', 'Spencer Johnson', 1998),
(92, 'O Monge que Vendeu sua Ferrari', 'Robin Sharma', 1997),
(93, 'Pai Rico, Pai Pobre', 'Robert Kiyosaki', 1997),
(94, 'Os Sete Maridos de Evelyn Hugo', 'Taylor Jenkins Reid', 2017),
(95, 'Daisy Jones & The Six', 'Taylor Jenkins Reid', 2019),
(96, 'Pequenos Incêndios por Toda Parte', 'Celeste Ng', 2017),
(97, 'Tudo o Que Nunca Nos Disseram', 'Celeste Ng', 2014),
(98, 'A Amiga Genial', 'Elena Ferrante', 2011),
(99, 'O Nome Perdido da Amiga Genial', 'Elena Ferrante', 2012),
(100, 'Aqueles que Partem e Aqueles que Ficam', 'Elena Ferrante', 2013),
(101, 'A História da Menina Perdida', 'Elena Ferrante', 2014);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `livros`
--
ALTER TABLE `livros`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `livros`
--
ALTER TABLE `livros`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;
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
(1, 2, 12, 'NOSsA THIAGHO SEU CHEOROSIIIIINHOOOOW', '2025-06-02 17:39:35'),
(2, 2, 12, 'sd', '2025-06-02 17:40:24'),
(3, 2, 12, 'CHEROSOOOOOOOOOO', '2025-06-02 17:40:28');

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
(2, 2, 12, '2025-06-02 17:40:22'),
(23, 5, 13, '2025-06-07 03:38:16'),
(24, 2, 13, '2025-06-07 03:38:20'),
(25, 6, 13, '2025-06-07 03:38:23'),
(26, 7, 13, '2025-06-07 03:38:24');

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
(0, 12, 13, 'curtida', 3, 'alo piaozaada\r\n!', 0, '2025-06-07 02:52:21');

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
  `criado_em` datetime DEFAULT current_timestamp(),
  `video_url` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `posts`
--

INSERT INTO `posts` (`id_post`, `id_user`, `conteudo`, `imagem`, `criado_em`, `video_url`) VALUES
(2, 6, 'EAE SEUS ARROMBADO', '', '2025-05-23 14:24:26', ''),
(3, 12, 'alo piaozaada\r\n!', '', '2025-06-02 14:40:36', ''),
(5, 13, 'oi', NULL, '2025-06-06 23:41:03', ''),
(6, 13, 'opa', NULL, '2025-06-06 23:52:28', ''),
(7, 13, 'Haaladinho', NULL, '2025-06-07 00:24:09', 'https://www.youtube.com/watch?v=0mOIpDq7lco'),
(9, 13, 'gol', '../../uploads/posts/6843b411a7fdd_1749267473.png', '2025-06-07 00:37:53', '');

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

--
-- Despejando dados para a tabela `reposts`
--

INSERT INTO `reposts` (`id_repost`, `id_post_original`, `id_user`, `criado_em`) VALUES
(1, 2, 12, '2025-06-02 17:39:37');

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
(3, 6, 'Driblador', 'expert', '2025-06-06 17:35:27');

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
(5, 10, NULL, 'Muralha', 1.86, 80.00, 'Goleiro', 'Defensivo', 'Direito', 'Sou um goleiro mirim apaixonado por futebol desde pequeno. Adoro estar embaixo das traves, fazendo defesas difíceis e ajudando meu time com garra e dedicação. Estou sempre treinando para melhorar meus reflexos, posicionamento e coragem, porque sei que o goleiro é a última linha de defesa. Sonho em um dia jogar profissionalmente e vestir a camisa de um grande clube, mas por enquanto, meu maior prazer é jogar com os amigos e dar o meu melhor em cada partida.', NULL, 'sem time'),
(7, 13, NULL, 'Fernandes', 1.80, 44.00, 'Centroavante', 'Raçudo', 'Direito', 'dqwdqwwdqwd', NULL, 'sem time');

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
  `email_org` varchar(200) NOT NULL,
  `telefone_org` varchar(100) NOT NULL,
  `password_org` varchar(255) NOT NULL,
  `logo_org` varchar(255) DEFAULT NULL,
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

INSERT INTO `tbl_organizacao` (`id_org`, `nome_org`, `email_org`, `telefone_org`, `password_org`, `logo_org`, `descricao`, `data_fundacao`, `tipo`, `cep`, `redes_sociais`, `created_at`) VALUES
(1, 'Palmeiras 2', 'palmeirasdois@gmail.com', '(11) 93040-3949', '$2y$10$/pNuAwpHwHBDPhzGiL.vUOSoKmfpMdmkD2zNvmr3aL5t1CV/ZzVGC', '../../public/images/profilePhotos/defaultPhoto.png', NULL, '2022-06-13', '', '8451360', NULL, '2025-06-02 16:02:32'),
(2, 'Etec', 'etec@gmail.com', '(11) 90298-7234', '$2y$10$n2zjPxKK.q5dSdtqZK990OmnbWB23M90.cDU8A1XAJy2pTHHsDxt.', '../../public/images/profilePhotos/defaultPhoto.png', NULL, '2001-01-08', '', '8451360', NULL, '2025-06-02 16:26:53');

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
(12, 'Messi da Silva Ronaldo', 'messi@gmail.com', '$2y$10$3savcBMz9aa3Vtu7W3OhjeR8F6vhmDtMNVAxbzSl4wDZxqtbWROuC', '2008-06-19', 'masculino', '../../public/images/profilePhotos/ac968177e896ec1aa7d37b7dbecf91f1.jfif', '(11) 95644-6342', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', '2025-06-02 14:39:06', '2025-06-02 14:39:06'),
(13, 'Eduardo', 'fernandes@gmail.com', '$2y$10$TR1E7vvaIxSRwsolCRPoauBmZ19FeOMPsoA0rBJLOFwrhbpYqnz/C', '2008-02-05', NULL, '../../public/images/profilePhotos/f37f3bc1d68bbe2771b7192f758675ab.png', '(11) 95834-9578', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', '2025-06-06 22:43:49', '2025-06-07 00:44:15');

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
  MODIFY `id_curtida` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `peneiras`
--
ALTER TABLE `peneiras`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `posts`
--
ALTER TABLE `posts`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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
  MODIFY `id_jogador` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `tbl_jogo`
--
ALTER TABLE `tbl_jogo`
  MODIFY `id_jogo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbl_organizacao`
--
ALTER TABLE `tbl_organizacao`
  MODIFY `id_org` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
--
-- Banco de dados: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Despejando dados para a tabela `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"db_futlink\",\"table\":\"posts\"},{\"db\":\"db_futlink\",\"table\":\"curtidas\"},{\"db\":\"db_futlink\",\"table\":\"comentarios\"},{\"db\":\"db_futlink\",\"table\":\"tbl_usuarios\"},{\"db\":\"db_futlink\",\"table\":\"tbl_jogador\"},{\"db\":\"db_futlink\",\"table\":\"tbl_organizacao\"},{\"db\":\"db_futlink\",\"table\":\"tbl_profissional\"},{\"db\":\"biblioteca\",\"table\":\"livros\"}]');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Despejando dados para a tabela `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2025-06-07 01:38:07', '{\"Console\\/Mode\":\"collapse\",\"lang\":\"pt_BR\"}');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Estrutura para tabela `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Índices de tabela `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Índices de tabela `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Índices de tabela `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Índices de tabela `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Índices de tabela `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Índices de tabela `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Índices de tabela `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Índices de tabela `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Índices de tabela `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Índices de tabela `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Índices de tabela `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Índices de tabela `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Índices de tabela `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Índices de tabela `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Índices de tabela `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Índices de tabela `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Índices de tabela `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Banco de dados: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
