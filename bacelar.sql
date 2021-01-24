-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19-Dez-2019 às 19:22
-- Versão do servidor: 10.4.8-MariaDB
-- versão do PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bacelar`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `perfil`
--

CREATE TABLE `perfil` (
  `id_perfil` int(11) NOT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `perfil`
--

INSERT INTO `perfil` (`id_perfil`, `descricao`) VALUES
(1, 'Administrador'),
(2, 'Visualizador');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `login` text DEFAULT NULL,
  `passwd` text DEFAULT NULL,
  `email` text DEFAULT NULL,
  `perfil_id` int(11) DEFAULT 1,
  `oab` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `nome`, `login`, `passwd`, `email`, `perfil_id`, `oab`) VALUES
(1, 'admin', 'admin', 'edMfPDF5y7Gv6vht8LySb0houAM=', 'italocosta.mateus@hotmail.com', 1, NULL),
(2, 'Italo Gundes', 'italogundes', 'edMfPDF5y7Gv6vht8LySb0houAM=', 'italo@gmail.com', 1, NULL),
(3, 'Gustavo Ribeiro', 'guga', 'fEqNCco3Yq9h5ZUglD3CZJT4lBs=', 'guga@gmail.com', 2, NULL),
(4, 'Nilton Carlos', 'nilton', 'fEqNCco3Yq9h5ZUglD3CZJT4lBs=', 'nilton@gmail.com', 2, NULL),
(5, 'Bacelar Advocacia', 'bacelar', 'fEqNCco3Yq9h5ZUglD3CZJT4lBs=', 'bacelar@gmail.com', 2, NULL),
(7, 'AntÃ´nio JosÃ© Sales Bacelar', 'antonio.bacelar', 'M9puh30DDTfl7vQmBLwx+gajIqk=', 'antonio@bacelar.adv.br', 1, '9566'),
(8, 'Paulo CÃ©sar CorrÃªa Moraes', 'paulo.moraes', 'M9puh30DDTfl7vQmBLwx+gajIqk=', 'paulo.moraes@bacelar.adv.br', 2, '19833'),
(9, 'Juliane Pereira Melo Lopes', 'juliane.pereira', 'M9puh30DDTfl7vQmBLwx+gajIqk=', 'juliane.pereira@bacelar.adv.br', 1, '15791'),
(10, 'AntÃ´nio Ãcaro', 'antonio', 'fEqNCco3Yq9h5ZUglD3CZJT4lBs=', 'antonio@gmail.com', 2, '123456');

--
-- Acionadores `usuarios`
--
DELIMITER $$
CREATE TRIGGER `usuarios_log_update` AFTER UPDATE ON `usuarios` FOR EACH ROW insert into usuarios_log(old_id, old_nome, old_email, new_id, new_nome, new_email, acao, hora)
					  values(old.id, old.nome, old.email, new.id, new.nome, new.email, 'UPDATE', now())
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios_log`
--

CREATE TABLE `usuarios_log` (
  `id` int(11) NOT NULL,
  `old_id` int(11) NOT NULL,
  `old_nome` varchar(255) DEFAULT NULL,
  `old_email` varchar(255) DEFAULT NULL,
  `new_id` int(11) NOT NULL,
  `new_nome` varchar(255) DEFAULT NULL,
  `new_email` varchar(255) DEFAULT NULL,
  `acao` varchar(45) DEFAULT NULL,
  `hora` datetime DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios_log`
--

INSERT INTO `usuarios_log` (`id`, `old_id`, `old_nome`, `old_email`, `new_id`, `new_nome`, `new_email`, `acao`, `hora`) VALUES
(1, 2, 'Ítalo Matheus', 'italo@gmail.com', 2, 'Italo Gundes', 'italo@gmail.com', 'UPDATE', '2019-03-25 09:40:30');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `perfil`
--
ALTER TABLE `perfil`
  ADD PRIMARY KEY (`id_perfil`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `perfil_fk_idx` (`perfil_id`);

--
-- Índices para tabela `usuarios_log`
--
ALTER TABLE `usuarios_log`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `perfil`
--
ALTER TABLE `perfil`
  MODIFY `id_perfil` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `usuarios_log`
--
ALTER TABLE `usuarios_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `perfil_fk` FOREIGN KEY (`perfil_id`) REFERENCES `perfil` (`id_perfil`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
