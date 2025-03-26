-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26/03/2025 às 20:51
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

--
-- Despejando dados para a tabela `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`id_user`, `nome`, `email`, `senha`, `data_nasc`, `genero`, `foto_perfil`, `telefone`, `bio`, `rede_social`, `cep`, `rua`, `bairro`, `cidade`, `estado`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Shandel Villasante Merlo', 'shandelvm16@gmail.com', '$2y$10$/r1NjYb6YbuPLHqEfJWoTOgC1gWW9Y2GjlYqyHuo3.hsi64xJG.7.', '2006-06-13', 'masculino', '../../public/images/profilePhotos/63f9078f50343495a705174a579c4ebb.png', '(11) 91034-6024', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'ativo', '2025-03-26 16:30:59', '2025-03-26 16:30:59');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
