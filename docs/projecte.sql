-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-05-2024 a las 17:53:43
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
-- Estructura de tabla para la tabla `calendari`
--

DROP TABLE IF EXISTS `calendari`;
CREATE TABLE IF NOT EXISTS `calendari` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titol` varchar(50) NOT NULL,
  `inici` datetime NOT NULL,
  `final` datetime NOT NULL,
  `usuari_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuari_ids` (`usuari_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `calendari`
--

INSERT INTO `calendari` (`id`, `titol`, `inici`, `final`, `usuari_id`) VALUES
(2, 'adsfg', '2024-05-01 12:12:00', '2024-05-02 12:12:00', 2);

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
  `text` text DEFAULT NULL,
  `comentari` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `projectes`
--

INSERT INTO `projectes` (`id`, `nom`, `descripcio`, `data_inici`, `data_fi`, `text`, `comentari`) VALUES
(5, 'DVD', 'descripcio David', '0000-00-00', '0000-00-00', 'asasass\nasaa,snaks\ns\nas\nas\nassssasassaasasas', NULL),
(6, 'DVD', 'dvddvdvdvdvdvdvdv', '0000-00-00', '0000-00-00', 'asasass\nasaa,snaks\ns\nas\nas\nassssasassaasasas', NULL),
(7, 'DVD', 'dvddvdvdvdvdvdvdv', '2024-04-16', '2024-04-19', 'asasass\nasaa,snaks\ns\nas\nas\nassssasassaasasas', '\nasasSA\nd.vallmanya@sapalomera.cat: lksjask\nb.martinez2@sapalomera.cat: as\nd.vallmanya@sapalomera.cat: ertgyhu\nDVD: asas\nDVD: asas\nDVD: asasas\nDVD: a'),
(8, 'DVD2', 'dvddvdvdvdvdvdvdv', '2024-04-16', '2024-04-19', 'assasas\nasoh\naosijasoi\nasjoaisj\nasloaihsoiahsoasijaosi\naslkajsoa\nsalsmas\nasaksa\nsasnaasassaas', 'Hola! ¿Cómo estás\n1234\nqw\nDavid\nHola DVD\nsasa\naaaaaaaaa\naaaaaaaa\na\n1\nDVD2\n221\nDVD2\nsdfghj\nhOLA dvd\nHola Benito\nHello\nasaasas\nsa\n1\nUsuario: 1\n1\nd.vallmanya@sapalomera.cat1\nDavid1\nDavid: 1\nDavid: kshkuh\nDavid: skdjbkjbskdj\nDavid: 1324r4ty\nDavid: 123245678\nBenito: qewretr4\nBenito2: 12\nDavid: qsdwefgrhjk\nDavid: erwaertyuy\nDavid: saxdfgrt\nDavid: wqEARTEYR6UT7IYTYTUYRETRWAQ\nDavid: qewrg\nDavid: we\nDavid: w\nDavid: we\nBenito2: qew\nBenito2: 12\nBenito2: 12\nBenito2: 12\nBenito2: sd\nBenito2: as\nBenito2: as\nBenito2: as\nBenito2: sa\nBenito2: as\nBenito2: as\nUsuario Desconocido: as\nbmartinezflorido@gmail.com: as\nbmartinezflorido@gmail.com: as\nd.vallmanya@sapalomera.cat: f\nd.vallmanya@sapalomera.cat: f'),
(9, '$nombre_proyecto', '$descripcion', '0000-00-00', '0000-00-00', NULL, NULL),
(10, 'asd', 'asdd', '2024-04-16', '2024-04-24', 'ASASAS\nASAS\nAS\nAS\nASSSSS12', 'Hola \na\nHola soy el projecto asd\nASD\naaasssas\nas\ns\nas\nas\nasas\nas\nas\nas\nas\n12\n1235\nASAS\nA\nkajsn\nHola soy un comentario\nasd\nwsexdftgyh\ndxrcftv'),
(13, 'Nuevo Proyecto para Voluntarios', 'Es un proyectop', '2024-04-17', '2024-04-20', 'titititititit\naosijsoias\naosijasajs\naskjabsk\njfro\neo\nasoiajsoansoasijoaisajos\nFirma de Benito1\naska\nFirma de Benito2', NULL),
(14, 'David V', 'putube', '2024-04-17', '2024-10-20', NULL, NULL),
(24, 'PUTUBE', 'PUTUBE', '2024-04-29', '2024-04-30', 'sAS\nas\nASa\nAs\nASas\nsaaasas', '\nDVD: qewarstdyfy\nDVD: as\nDVD: as'),
(25, 'Putube2', '12', '2024-04-29', '2024-05-01', NULL, NULL),
(26, 'Youtube', 'Youtube', '2024-05-01', '2024-05-02', NULL, NULL),
(27, 'Youtube', 'Youtube', '2024-05-01', '2024-05-02', NULL, NULL),
(28, 'Youtube', 'Youtube', '2024-05-01', '2024-05-02', NULL, NULL),
(29, 'youtube2', 'youtube2', '2024-05-01', '2024-05-02', NULL, NULL),
(30, 'Putube22', '2', '2024-05-01', '2024-05-02', NULL, NULL),
(31, 'Projecto Admin', 'Projecto Admin', '2024-05-01', '2024-05-02', 'sadasd\nsadasds', '\nBenito: sdsd\nBenito: aaa'),
(32, 'Nuevas Tareas', 'Nuevas Tareas', '2024-05-02', '2024-05-10', '<p>ssssssssssssassaasaasas asaskms aksnasAA</p>', '\nDVD: saas\nDVD: as\nBenito: as'),
(33, 'Ehhhhh', 'Ehhhhh', '2024-05-03', '2024-05-04', 'asa\nÃ§sa\ns\nas\na\ns\nas\na\nsa\ns\nas\na\ns\nas\na\nsa\ns\nas\na\ns\nas\na\nsa\nsasasa\nsasasasasas', '\nBenito: as\nDVD: sdfghjklÃ±\nBenito: sa\nBenito: asas\nBenito: as\nBenito: as\nBenito: as\nBenito: as\nBenito: as\nBenito: as\nBenito: as\nBenito: as\nBenito: as\nBenito: as\nBenito: as\nBenito: as'),
(35, 'Y luego', 'Y luego', '2024-05-05', '2024-05-02', 'esdrhbjknlm,.knhbvgfdsaQASDFGVCBHNM,\nXCVGHFXDGHJaaasasaaaas\nasasASASAAS\nsaAAAASSAA\naAAAAASAAAAAASASASawedrfshkjlgyhujikolpwertdgh', '\nBenito: ASDASDSAD\nBenito: as\nBenito: S\nDVD: A\nBenito: A'),
(36, 'Ruben', 'Ruben', '2024-05-07', '2024-05-09', 'asasasa', '\nBenito: as\nDavid: as'),
(37, 'Ruberga', 'Ruberga', '2024-05-07', '2024-05-10', 'Ã¡sdfxcgvhnbmn,earsdtfyguhi', '\nBenito: asdfghjklÃ±\nBenito2: as\nBenito: sesrdtfy\nBenito: A\nBenito: as\nBenito: as\nBenito: a\nBenito: a\nBenito: a\nBenito: a\nBenito: a\nBenito: a\nBenito: serdtfyguio'),
(38, 'davdi valmaÃ±in bravissimo', 'davdi valmaÃ±in bravissimo', '2024-05-07', '2024-05-10', '', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proyecto_usuario`
--

DROP TABLE IF EXISTS `proyecto_usuario`;
CREATE TABLE IF NOT EXISTS `proyecto_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_proyecto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `permissos` enum('editar','comentar','visualitzar') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario__id` (`id_usuario`),
  KEY `id_projecto__id` (`id_proyecto`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proyecto_usuario`
--

INSERT INTO `proyecto_usuario` (`id`, `id_proyecto`, `id_usuario`, `permissos`) VALUES
(4, 7, 2, 'comentar'),
(5, 8, 2, 'visualitzar'),
(6, 24, 2, 'editar'),
(7, 25, 2, 'editar'),
(10, 32, 2, 'editar'),
(11, 33, 1, 'editar'),
(12, 33, 2, 'comentar'),
(13, 32, 1, 'editar'),
(15, 35, 1, 'editar'),
(16, 35, 2, 'editar'),
(17, 35, 14, 'editar'),
(18, 35, 2, 'editar'),
(19, 35, 14, 'editar'),
(20, 36, 1, 'editar'),
(21, 36, 2, 'comentar'),
(22, 36, 14, 'comentar'),
(23, 37, 1, 'editar'),
(24, 37, 14, 'comentar'),
(25, 38, 1, 'editar'),
(26, 38, 14, 'visualitzar'),
(27, 36, 19, 'editar'),
(28, 32, 19, 'editar');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tasques`
--

DROP TABLE IF EXISTS `tasques`;
CREATE TABLE IF NOT EXISTS `tasques` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_projecte` int(11) NOT NULL,
  `descripcio` varchar(255) NOT NULL,
  `estat` enum('Por hacer','En progres','En revisio','Completades') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_projecte` (`id_projecte`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tasques`
--

INSERT INTO `tasques` (`id`, `id_projecte`, `descripcio`, `estat`) VALUES
(1, 31, 'nUEVA TATREA', 'En revisio'),
(2, 31, 'asas', 'Por hacer'),
(3, 31, 'zcxvb', 'En revisio'),
(4, 31, 'qss', 'En revisio'),
(5, 31, 'szzdfxgchj', 'Completades'),
(6, 31, 'asdfghvbjknl', 'En progres'),
(7, 31, 'zfdxghcvjbknl', 'Completades'),
(8, 31, 'sadfghjkl', 'Por hacer'),
(9, 31, 'Nueva cosa', 'Por hacer'),
(10, 31, 'as', 'Por hacer'),
(11, 31, 'zsaDZFXGHJKLÃ‘KJHGNFBCXDSz', 'En revisio'),
(12, 31, 'A', 'En revisio'),
(13, 31, 'Z', 'Por hacer'),
(14, 31, 'a', 'Por hacer'),
(15, 31, 'a', 'Por hacer'),
(16, 31, 'as', 'Por hacer'),
(17, 31, 'nueva coas', 'Por hacer'),
(18, 31, 'qewret', 'Por hacer'),
(19, 31, 'qwewr', 'Por hacer'),
(20, 31, 'as', 'Por hacer'),
(21, 31, 'as', 'Por hacer'),
(22, 31, '25', 'Por hacer'),
(23, 25, '25', 'En progres'),
(24, 25, '12', 'Por hacer'),
(25, 25, 'as', 'Por hacer'),
(26, 25, 'as', 'Por hacer'),
(27, 25, 'as', 'Por hacer'),
(28, 24, '1234567890', 'Por hacer'),
(29, 31, '11232454657645321', 'Por hacer'),
(30, 32, '2134567', 'En progres'),
(31, 32, 'aasassasaasas', 'En revisio'),
(32, 32, 'sa', 'Completades'),
(33, 33, 'asasas', 'Completades'),
(34, 32, 'as', 'Por hacer'),
(35, 35, 'sdZFXCVGHBN', 'En revisio'),
(36, 35, 'DVD', 'Por hacer'),
(37, 35, 'asasas', 'En progres'),
(38, 35, 'as', 'En progres'),
(39, 35, 'as', 'En progres'),
(40, 35, 'aaaaa', 'En progres'),
(41, 35, 'd', 'Por hacer'),
(42, 35, 'd', 'En progres'),
(43, 35, '123456', 'En progres'),
(44, 35, '134567', 'En progres'),
(45, 35, '12', 'Por hacer'),
(46, 35, '1234567890\'Â¡', 'Por hacer'),
(47, 35, 'Nueva', 'Por hacer'),
(48, 35, '132435465768', 'Por hacer'),
(49, 35, '2', 'Por hacer'),
(50, 35, '1', 'Por hacer'),
(51, 35, '12', 'Por hacer'),
(52, 35, '1324356', 'Por hacer'),
(53, 35, '134256', 'Por hacer'),
(54, 35, '213456789', 'Por hacer'),
(55, 35, 'w', 'Por hacer'),
(56, 35, '1234567890', 'Por hacer'),
(57, 35, 'nueie', 'Por hacer');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuaris`
--

DROP TABLE IF EXISTS `usuaris`;
CREATE TABLE IF NOT EXISTS `usuaris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuari` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contrasenya` varchar(255) NOT NULL,
  `rol` enum('admin','membre') NOT NULL,
  `imatge` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuari_UNIQUE` (`usuari`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuaris`
--

INSERT INTO `usuaris` (`id`, `usuari`, `email`, `contrasenya`, `rol`, `imatge`) VALUES
(1, 'Benito', 'b.martinez2@sapalomera.cat', '$2y$10$QXLSD5VpyV4w0Hp9NnThheBTZIduKgOF8qb43FXSIK2267SZf5cVS', 'admin', '../uploads/calendar2.png'),
(2, 'DVD', 'd.vallmanya2@sapalomera.cat', '$2y$10$itgJT5vrfWS1XfypV9G75.Z566I/HyoO1c35crSaNi/VXWDV1Or4S', 'membre', '../uploads/calendar2.png'),
(14, 'Benito2', 'bmartinezflorido@gmail.com', '$2y$10$itgJT5vrfWS1XfypV9G75.Z566I/HyoO1c35crSaNi/VXWDV1Or4S', 'membre', NULL),
(17, 'Prueba Admin', 'pruebaAdmin@gmail.com', '$2y$10$QXLSD5VpyV4w0Hp9NnThheBTZIduKgOF8qb43FXSIK2267SZf5cVS', 'admin', NULL),
(18, 'Prueba User', 'puser@gmail.com', '$2y$10$itgJT5vrfWS1XfypV9G75.Z566I/HyoO1c35crSaNi/VXWDV1Or4S', 'membre', NULL),
(19, 'David', 'd.vallmanya@sapalomera.cat', '$2y$10$WX1Z/31XxntlBYGMNbVmDuhopkWqzNR7YE75UKuZFxoVF4Zfaz2MS', 'membre', NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `calendari`
--
ALTER TABLE `calendari`
  ADD CONSTRAINT `id_usuari_ids` FOREIGN KEY (`usuari_id`) REFERENCES `usuaris` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `proyecto_usuario`
--
ALTER TABLE `proyecto_usuario`
  ADD CONSTRAINT `id_projecte_id` FOREIGN KEY (`id_proyecto`) REFERENCES `projectes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `id_usuario_id` FOREIGN KEY (`id_usuario`) REFERENCES `usuaris` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tasques`
--
ALTER TABLE `tasques`
  ADD CONSTRAINT `id_projecte` FOREIGN KEY (`id_projecte`) REFERENCES `projectes` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
