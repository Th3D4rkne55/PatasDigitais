-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02/05/2025 às 17:27
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
-- Banco de dados: `patasdigitais`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `animais`
--

CREATE TABLE `animais` (
  `id` int(11) NOT NULL,
  `codigo` varchar(20) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `idade` varchar(50) DEFAULT NULL,
  `porte` enum('Pequeno','Médio','Grande') DEFAULT NULL,
  `doencas` text DEFAULT NULL,
  `instituicao` varchar(100) DEFAULT NULL,
  `status` enum('Disponível','Adotado') DEFAULT 'Disponível',
  `imagem` text DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `animais`
--

INSERT INTO `animais` (`id`, `codigo`, `nome`, `idade`, `porte`, `doencas`, `instituicao`, `status`, `imagem`, `id_usuario`, `criado_em`) VALUES
(4, 'ANF678FDD0', 'Bilu', '3 Anos', 'Grande', 'Leishmaniose', 'ADAP', 'Disponível', 'images/animais/6814e22362807_AdobeStock_371785829.jpeg', NULL, '2025-05-02 15:17:55'),
(5, 'ANE820999C', 'Lion', '1 ano', 'Pequeno', 'Sem doenças!', 'ADAP', 'Disponível', 'images/animais/6814e251a20a2_pug-dog-isolated-white-background.jpg', NULL, '2025-05-02 15:18:41');

-- --------------------------------------------------------

--
-- Estrutura para tabela `denuncias`
--

CREATE TABLE `denuncias` (
  `id` int(11) NOT NULL,
  `protocolo` varchar(20) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `anexo` varchar(255) DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `denuncias`
--

INSERT INTO `denuncias` (`id`, `protocolo`, `cidade`, `estado`, `endereco`, `descricao`, `anexo`, `criado_em`) VALUES
(1, '65869086', 'Campo Grande', 'Mato Grosso do Sul', 'Av. Zila Correa Machado 2001', 'Teste', 'DALL·E-2025-04-09-14.01.png', '2025-05-02 15:21:18'),
(2, 'E05E7B75', 'Campo Grande', 'Mato Grosso do Sul', 'Avenida Transcontinental 123', 'Teste2', 'teste2.png', '2025-05-02 15:23:58');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `data_nascimento` date NOT NULL,
  `senha` varchar(255) NOT NULL,
  `tipo_usuario` enum('usuario','admin') DEFAULT 'usuario',
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `email`, `telefone`, `data_nascimento`, `senha`, `tipo_usuario`, `criado_em`) VALUES
(4, 'Patas Digitais', 'contato.patasdigitais@gmail.com', '67992699299', '2002-02-02', '$2y$10$C121r5tBN3JIbYeQ.jZJhe4vuPRetK/LJfK84wI/cCHVFTydqnbBO', 'admin', '2025-05-02 15:14:20'),
(5, 'Erick Nathan Alves Mendes', 'ericknathanam1@gmail.com', '6799888-6624', '2002-04-27', '$2y$10$yJ/gqJW/n0fOnwrRxiiAMelbQ/KHPJLvKUQVUsv0T4ba4YFi1k21C', 'usuario', '2025-05-02 15:19:35');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `animais`
--
ALTER TABLE `animais`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Índices de tabela `denuncias`
--
ALTER TABLE `denuncias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `protocolo` (`protocolo`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `animais`
--
ALTER TABLE `animais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `denuncias`
--
ALTER TABLE `denuncias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `animais`
--
ALTER TABLE `animais`
  ADD CONSTRAINT `animais_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
