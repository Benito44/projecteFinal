-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 29-04-2024 a las 18:32:20
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `projecte`
--
CREATE DATABASE IF NOT EXISTS `projecte` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `projecte`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `activitat`
--

DROP TABLE IF EXISTS `activitat`;
CREATE TABLE IF NOT EXISTS `activitat` (
  `id` int(11) NOT NULL,
  `id_usuari` int(11) NOT NULL,
  `tipus` varchar(50) NOT NULL COMMENT 'Tipo de actividad (por ejemplo, ''creación de tarea'', ''edición de proyecto'')',
  `descripcio` text NOT NULL COMMENT 'Descripción detallada de la actividad'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `chatid` int(11) NOT NULL,
  `sender_userid` int(11) NOT NULL,
  `reciever_userid` int(11) NOT NULL,
  `message` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `chat_login_details`
--

DROP TABLE IF EXISTS `chat_login_details`;
CREATE TABLE IF NOT EXISTS `chat_login_details` (
  `id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `last_activity` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_typing` enum('no','yes') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentaris`
--

DROP TABLE IF EXISTS `comentaris`;
CREATE TABLE IF NOT EXISTS `comentaris` (
  `id` int(11) NOT NULL,
  `id_tasca` int(11) DEFAULT NULL,
  `id_usuari` int(11) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `projectes`
--

DROP TABLE IF EXISTS `projectes`;
CREATE TABLE IF NOT EXISTS `projectes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `descripcio` text NOT NULL,
  `data_inici` date NOT NULL,
  `data_fi` date NOT NULL,
  `id_usuari` int(11) NOT NULL,
  `text` text DEFAULT NULL,
  `comentari` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuari` (`id_usuari`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `projectes`
--

INSERT INTO `projectes` (`id`, `nom`, `descripcio`, `data_inici`, `data_fi`, `id_usuari`, `text`, `comentari`) VALUES
(5, 'DVD', 'descripcio David', '0000-00-00', '0000-00-00', 0, 'asasass\nasaa,snaks\ns\nas\nas\nassssasassaasasas', NULL),
(6, 'DVD', 'dvddvdvdvdvdvdvdv', '0000-00-00', '0000-00-00', 2, 'asasass\nasaa,snaks\ns\nas\nas\nassssasassaasasas', NULL),
(7, 'DVD', 'dvddvdvdvdvdvdvdv', '2024-04-16', '2024-04-19', 2, 'asasass\nasaa,snaks\ns\nas\nas\nassssasassaasasas', '\nasasSA\nd.vallmanya@sapalomera.cat: lksjask\nb.martinez2@sapalomera.cat: as\nd.vallmanya@sapalomera.cat: ertgyhu'),
(8, 'DVD2', 'dvddvdvdvdvdvdvdv', '2024-04-16', '2024-04-19', 2, 'assasas\nasoh\naosijasoi\nasjoaisj\nasloaihsoiahsoasijaosi\naslkajsoa\nsalsmas\nasaksa\nsasnaasassaas', 'Hola! ¿Cómo estás\n1234\nqw\nDavid\nHola DVD\nsasa\naaaaaaaaa\naaaaaaaa\na\n1\nDVD2\n221\nDVD2\nsdfghj\nhOLA dvd\nHola Benito\nHello\nasaasas\nsa\n1\nUsuario: 1\n1\nd.vallmanya@sapalomera.cat1\nDavid1\nDavid: 1\nDavid: kshkuh\nDavid: skdjbkjbskdj\nDavid: 1324r4ty\nDavid: 123245678\nBenito: qewretr4\nBenito2: 12\nDavid: qsdwefgrhjk\nDavid: erwaertyuy\nDavid: saxdfgrt\nDavid: wqEARTEYR6UT7IYTYTUYRETRWAQ\nDavid: qewrg\nDavid: we\nDavid: w\nDavid: we\nBenito2: qew\nBenito2: 12\nBenito2: 12\nBenito2: 12\nBenito2: sd\nBenito2: as\nBenito2: as\nBenito2: as\nBenito2: sa\nBenito2: as\nBenito2: as\nUsuario Desconocido: as\nbmartinezflorido@gmail.com: as\nbmartinezflorido@gmail.com: as\nd.vallmanya@sapalomera.cat: f\nd.vallmanya@sapalomera.cat: f'),
(9, '$nombre_proyecto', '$descripcion', '0000-00-00', '0000-00-00', 0, NULL, NULL),
(10, 'asd', 'asdd', '2024-04-16', '2024-04-24', 2, 'ASASAS\nASAS\nAS\nAS\nASSSSS12', 'Hola \na\nHola soy el projecto asd\nASD\naaasssas\nas\ns\nas\nas\nasas\nas\nas\nas\nas\n12\n1235\nASAS\nA\nkajsn\nHola soy un comentario\nasd\nwsexdftgyh\ndxrcftv'),
(13, 'Nuevo Proyecto para Voluntarios', 'Es un proyectop', '2024-04-17', '2024-04-20', 0, 'titititititit\naosijsoias\naosijasajs\naskjabsk\njfro\neo\nasoiajsoansoasijoaisajos\nFirma de Benito1\naska\nFirma de Benito2', NULL),
(14, 'David V', 'putube', '2024-04-17', '2024-10-20', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_usuario`
--

DROP TABLE IF EXISTS `proyecto_usuario`;
CREATE TABLE IF NOT EXISTS `proyecto_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_proyecto` int(11) DEFAULT NULL,
  `id_usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_projecto__id` (`id_proyecto`),
  KEY `id_usuario__id` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proyecto_usuario`
--

INSERT INTO `proyecto_usuario` (`id`, `id_proyecto`, `id_usuario`) VALUES
(4, 7, 2),
(5, 8, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasques`
--

DROP TABLE IF EXISTS `tasques`;
CREATE TABLE IF NOT EXISTS `tasques` (
  `id` int(11) NOT NULL,
  `id_projecte` int(11) NOT NULL,
  `descripcio` int(11) NOT NULL,
  `data_limit` int(11) NOT NULL,
  `prioritat` enum('baixa','mitja','alta') NOT NULL COMMENT 'referencia al usuari assignat',
  `estat` enum('pendent','en progrés','completa') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_projecte` (`id_projecte`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuaris`
--

DROP TABLE IF EXISTS `usuaris`;
CREATE TABLE IF NOT EXISTS `usuaris` (
  `id` int(11) NOT NULL,
  `usuari` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contrasenya` varchar(255) NOT NULL,
  `rol` enum('admin','membre') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuaris`
--

INSERT INTO `usuaris` (`id`, `usuari`, `email`, `contrasenya`, `rol`) VALUES
(0, 'Benito', 'b.martinez2@sapalomera.cat', '1234', 'admin'),
(2, 'David', 'd.vallmanya@sapalomera.cat', '123', 'membre'),
(3, 'Benito2', 'bmartinezflorido@gmail.com', '1234', 'membre');

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comentaris`
--
ALTER TABLE `comentaris`
  ADD CONSTRAINT `id_tasca` FOREIGN KEY (`id_tasca`) REFERENCES `tasques` (`id`);

--
-- Filtros para la tabla `projectes`
--
ALTER TABLE `projectes`
  ADD CONSTRAINT `id_usuari` FOREIGN KEY (`id_usuari`) REFERENCES `usuaris` (`id`);

--
-- Filtros para la tabla `proyecto_usuario`
--
ALTER TABLE `proyecto_usuario`
  ADD CONSTRAINT `id_projecto__id` FOREIGN KEY (`id_proyecto`) REFERENCES `projectes` (`id`),
  ADD CONSTRAINT `id_usuario__id` FOREIGN KEY (`id_usuario`) REFERENCES `usuaris` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tasques`
--
ALTER TABLE `tasques`
  ADD CONSTRAINT `id_projecte` FOREIGN KEY (`id_projecte`) REFERENCES `projectes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
