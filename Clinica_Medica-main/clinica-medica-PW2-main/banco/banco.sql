-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.30 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para clinica_medica
CREATE DATABASE IF NOT EXISTS `clinica_medica` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `clinica_medica`;

-- Copiando estrutura para tabela clinica_medica.agendamentos
CREATE TABLE IF NOT EXISTS `agendamentos` (
  `id_agendamento` int NOT NULL AUTO_INCREMENT,
  `id_paciente` int DEFAULT NULL,
  `id_medico` int DEFAULT NULL,
  `id_sala` int DEFAULT NULL,
  `id_usuario` int DEFAULT NULL,
  `data` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `motivo_cancelamento` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id_agendamento`),
  KEY `id_paciente` (`id_paciente`),
  KEY `id_medico` (`id_medico`),
  KEY `id_sala` (`id_sala`),
  KEY `id_usuario` (`id_usuario`),
  CONSTRAINT `agendamentos_ibfk_1` FOREIGN KEY (`id_paciente`) REFERENCES `paciente` (`id_paciente`),
  CONSTRAINT `agendamentos_ibfk_2` FOREIGN KEY (`id_medico`) REFERENCES `medico` (`id_medico`),
  CONSTRAINT `agendamentos_ibfk_3` FOREIGN KEY (`id_sala`) REFERENCES `sala` (`id_sala`),
  CONSTRAINT `agendamentos_ibfk_4` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela clinica_medica.agendamentos: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela clinica_medica.atendimentos
CREATE TABLE IF NOT EXISTS `atendimentos` (
  `id_atendimento` int NOT NULL AUTO_INCREMENT,
  `id_agendamento` int DEFAULT NULL,
  `descricao` text,
  `diagnostico` text,
  PRIMARY KEY (`id_atendimento`),
  UNIQUE KEY `id_agendamento` (`id_agendamento`),
  CONSTRAINT `atendimentos_ibfk_1` FOREIGN KEY (`id_agendamento`) REFERENCES `agendamentos` (`id_agendamento`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela clinica_medica.atendimentos: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela clinica_medica.bloqueio_agenda
CREATE TABLE IF NOT EXISTS `bloqueio_agenda` (
  `id_bloqueio` int NOT NULL AUTO_INCREMENT,
  `id_medico` int DEFAULT NULL,
  `inicio` datetime DEFAULT NULL,
  `fim` datetime DEFAULT NULL,
  `motivo` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_bloqueio`),
  KEY `id_medico` (`id_medico`),
  CONSTRAINT `bloqueio_agenda_ibfk_1` FOREIGN KEY (`id_medico`) REFERENCES `medico` (`id_medico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela clinica_medica.bloqueio_agenda: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela clinica_medica.especialidade
CREATE TABLE IF NOT EXISTS `especialidade` (
  `id_especialidade` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_especialidade`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela clinica_medica.especialidade: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela clinica_medica.horario_medico
CREATE TABLE IF NOT EXISTS `horario_medico` (
  `id_horario` int NOT NULL AUTO_INCREMENT,
  `id_medico` int DEFAULT NULL,
  `dia_semana` varchar(15) DEFAULT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fim` time DEFAULT NULL,
  PRIMARY KEY (`id_horario`),
  KEY `id_medico` (`id_medico`),
  CONSTRAINT `horario_medico_ibfk_1` FOREIGN KEY (`id_medico`) REFERENCES `medico` (`id_medico`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela clinica_medica.horario_medico: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela clinica_medica.medico
CREATE TABLE IF NOT EXISTS `medico` (
  `id_medico` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int DEFAULT NULL,
  `id_especialidade` int DEFAULT NULL,
  `crm` varchar(20) DEFAULT NULL,
  `nome` varchar(100) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `foto` varchar(225) DEFAULT NULL,
  `mini_biografia` text,
  `status` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_medico`),
  UNIQUE KEY `id_usuario` (`id_usuario`),
  UNIQUE KEY `crm` (`crm`),
  KEY `id_especialidade` (`id_especialidade`),
  CONSTRAINT `medico_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`),
  CONSTRAINT `medico_ibfk_2` FOREIGN KEY (`id_especialidade`) REFERENCES `especialidade` (`id_especialidade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela clinica_medica.medico: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela clinica_medica.paciente
CREATE TABLE IF NOT EXISTS `paciente` (
  `id_paciente` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int DEFAULT NULL,
  `cpf` varchar(11) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `data_cadastro` date DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `endereco` varchar(200) DEFAULT NULL,
  `sexo` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_paciente`),
  UNIQUE KEY `id_usuario` (`id_usuario`),
  UNIQUE KEY `cpf` (`cpf`),
  CONSTRAINT `paciente_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela clinica_medica.paciente: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela clinica_medica.sala
CREATE TABLE IF NOT EXISTS `sala` (
  `id_sala` int NOT NULL AUTO_INCREMENT,
  `numero` varchar(10) DEFAULT NULL,
  `descricao` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_sala`),
  UNIQUE KEY `numero` (`numero`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela clinica_medica.sala: ~0 rows (aproximadamente)

-- Copiando estrutura para tabela clinica_medica.usuario
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `email` varchar(150) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL,
  `tipo_usuario` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Copiando dados para a tabela clinica_medica.usuario: ~2 rows (aproximadamente)
INSERT INTO `usuario` (`id_usuario`, `nome`, `email`, `senha`, `tipo_usuario`) VALUES
	(1, 'Recepcionista PriMed', 'recepcao@primed.com', '$2y$10$2qOLOMH1qa7S57LVlRb07OKmT.zop6voyYS9GLgoou1zYsRhpXqoG', 'recepcionista'),
	(2, 'Administrador PriMed', 'admin@primed.com', '$2y$10$wGyYOzx78/5nxmL5mD1QVuq1FAVKiewCvgEmzpcTMCenoXD78TySW', 'admin');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
