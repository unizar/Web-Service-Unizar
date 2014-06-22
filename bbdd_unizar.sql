-- phpMyAdmin SQL Dump
-- version 4.0.4.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-06-2014 a las 19:19:41
-- Versión del servidor: 5.6.11
-- Versión de PHP: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

create user 'usuario_web'@'localhost' identified by 'tfgfdi1314';
grant select,insert,update,delete on bbdd_unizar.* to 'usuario_web'@'localhost';

--
-- Base de datos: `bbdd_unizar`
--
CREATE DATABASE IF NOT EXISTS `bbdd_unizar` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `bbdd_unizar`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividad_encuesta`
--

CREATE TABLE IF NOT EXISTS `actividad_encuesta` (
  `id_actividad` int(11) NOT NULL,
  `idEncuesta` int(11) NOT NULL,
  `idPregunta` int(11) NOT NULL,
  `resp1` int(11) NOT NULL,
  `resp2` int(11) NOT NULL,
  `resp3` int(11) NOT NULL,
  `resp4` int(11) NOT NULL,
  `resp5` int(11) NOT NULL,
  PRIMARY KEY (`id_actividad`,`idEncuesta`,`idPregunta`),
  KEY `id_actividad` (`id_actividad`),
  KEY `idEncuesta` (`idEncuesta`),
  KEY `idPregunta` (`idPregunta`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `actividad_encuesta`
--

INSERT INTO `actividad_encuesta` (`id_actividad`, `idEncuesta`, `idPregunta`, `resp1`, `resp2`, `resp3`, `resp4`, `resp5`) VALUES
(24, 27, 112, 60, 40, 50, 20, 10),
(24, 27, 113, 4, 10, 25, 78, 5),
(24, 27, 114, 9, 52, 12, 32, 5),
(24, 27, 115, 1, 5, 22, 11, 33),
(24, 27, 116, 4, 9, 32, 14, 11),
(26, 27, 112, 0, 0, 0, 0, 0),
(26, 27, 113, 0, 0, 0, 0, 0),
(26, 27, 114, 0, 0, 0, 0, 0),
(26, 27, 115, 0, 0, 0, 0, 0),
(26, 27, 116, 0, 0, 0, 0, 0),
(27, 27, 112, 0, 0, 0, 0, 0),
(27, 27, 113, 0, 0, 0, 0, 0),
(27, 27, 114, 0, 0, 0, 0, 0),
(27, 27, 115, 0, 0, 0, 0, 0),
(27, 27, 116, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `actividades`
--

CREATE TABLE IF NOT EXISTS `actividades` (
  `id_actividad` int(11) NOT NULL AUTO_INCREMENT,
  `id_Profesor` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `Lugar` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `Duracion` int(11) NOT NULL,
  `Informacion` varchar(600) COLLATE utf8_spanish_ci NOT NULL,
  `Encuesta` int(11) DEFAULT NULL,
  `Creditos` int(11) NOT NULL,
  PRIMARY KEY (`id_actividad`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=28 ;

--
-- Volcado de datos para la tabla `actividades`
--

INSERT INTO `actividades` (`id_actividad`, `id_Profesor`, `nombre`, `fecha`, `hora`, `Lugar`, `Duracion`, `Informacion`, `Encuesta`, `Creditos`) VALUES
(24, 'MariaAG', 'Fonética del lenguaje anglosajón', '2014-05-30', '14:00:00', 'Aula Magna', 2, 'Se tratará de plantear los problemas de los lingüistas para estudiar esta especialidad en países anglosajones', 27, 1),
(23, 'MariaAG', 'Fonética del lenguaje en la Edad Media', '2014-05-13', '12:00:00', 'Aula Magna', 3, 'Se tratará de plantear un primer debate sobre la visión que tienen los asistentes sobre este tema para finalmente explicarlo desde un punto de vista lo más objetivo posible', 0, 1),
(26, 'MariaAG', 'Taller de Lenguaje de Signos', '2014-06-19', '13:28:00', 'Clase C', 6, 'La lengua de señas, o lengua de signos, es una lengua natural de expresión y configuración gesto-espacial y percepción visual (o incluso táctil por ciertas personas con sordoceguera), gracias a la cual las personas sordas pueden establecer un canal de com', 27, 6);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `alertas`
--

CREATE TABLE IF NOT EXISTS `alertas` (
  `id_alerta` int(5) NOT NULL AUTO_INCREMENT,
  `id_actividad` int(11) NOT NULL,
  `id_profesor` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `FechaAlta` date NOT NULL,
  `FechaBaja` date NOT NULL,
  `Informacion` varchar(255) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`id_alerta`,`id_actividad`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `alertas`
--

INSERT INTO `alertas` (`id_alerta`, `id_actividad`, `id_profesor`, `nombre`, `FechaAlta`, `FechaBaja`, `Informacion`) VALUES
(11, 23, 'MariaAG', 'Cambio de hora', '2014-06-22', '2014-05-31', 'La hora de la actividad del día 30 (Fonética del lenguaje anglosajón se cambia de las 12:00 a las 14:00.\n\nPerdón por las molestias.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `asignaturas`
--

CREATE TABLE IF NOT EXISTS `asignaturas` (
  `idAsignatura` int(11) NOT NULL AUTO_INCREMENT,
  `Asignatura` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `Nombre` varchar(45) COLLATE utf8_spanish_ci NOT NULL,
  `Informacion` varchar(600) COLLATE utf8_spanish_ci NOT NULL,
  `idProfesor` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`idAsignatura`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=28 ;

--
-- Volcado de datos para la tabla `asignaturas`
--

INSERT INTO `asignaturas` (`idAsignatura`, `Asignatura`, `Nombre`, `Informacion`, `idProfesor`) VALUES
(24, 'MP', 'Morfología de las Palabras', 'La morfología <a href="www.google.com">Google</a> es la rama de la lingüística que estudia la estructura interna de las palabras para delimitar, definir y clasificar sus unidades, las clases de palabras a las que da lugar (morfología flexiva) y la formación de nuevas palabras (morfología léxica). La palabra «morfología» fue introducida en el siglo XIX y originalmente trataba simplemente de la forma de las palabras, aunque en su acepción más moderna estudia fenómenos más complejos que la forma en sí.', 'MariaAG'),
(25, 'F II', 'Fonética II', 'La fonética (del griego φωνή (foné) "sonido" o "voz") es el estudio de los sonidos físicos del discurso humano. Es la rama de la lingüística que estudia la producción y percepción de los sonidos de una lengua con respecto a sus manifestaciones físicas. Sus principales ramas son: fonética experimental, fonética articulatoria, fonemática, fonética acústica y fonética auditiva.', 'MariaAG'),
(26, 'LLL', 'Lingüistica', 'Esta asignatura ofrece en su contenido los pilares básicos de lo que se ha\r\nconsagrado con el título de Lingüística general. En última instancia, el curso está al\r\nservicio de una gran finalidad, que podríamos formular en términos de conocimiento\r\nde las bases y fundamentos de todo discurrir en el dominio de la Lingüística y de\r\ntodo futuro trabajo en la materia, y de aplicación a la descripción del sistema\r\nlingüístico; todo ello mediante un acercamiento al objeto lingüístico a través de la\r\nTeoría del lenguaje.', 'MariaAG');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `encuestas`
--

CREATE TABLE IF NOT EXISTS `encuestas` (
  `idEncuesta` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idEncuesta`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=41 ;

--
-- Volcado de datos para la tabla `encuestas`
--

INSERT INTO `encuestas` (`idEncuesta`, `titulo`) VALUES
(27, 'Calidad'),
(38, 'Conocimientos'),
(39, 'Actualidad');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `preguntas_encuesta`
--

CREATE TABLE IF NOT EXISTS `preguntas_encuesta` (
  `idPregunta` int(11) NOT NULL AUTO_INCREMENT,
  `idEncuesta` int(11) NOT NULL,
  `pregunta` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`idPregunta`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=163 ;

--
-- Volcado de datos para la tabla `preguntas_encuesta`
--

INSERT INTO `preguntas_encuesta` (`idPregunta`, `idEncuesta`, `pregunta`) VALUES
(116, 27, 'Me ha parecido demasiado densa y/o extensa'),
(115, 27, 'Aporta información relevante para mi futuro laboral'),
(114, 27, 'Si se repitiese la actividad recomendaría asistir a mis conocidos'),
(113, 27, 'Me ha creado curiosidad o inquietudes que no tenía acerca de los temas tratados'),
(112, 27, 'Trata temas actuales'),
(148, 38, '¿Te ha aportado conocimientos nuevos sobre el tema?'),
(149, 38, '¿Te gustaría hacer una segunda actividad de este tipo?'),
(150, 38, '¿Te ha parecido bueno el profesor de la actividad?'),
(151, 38, '¿Cogerías otra actividad con este profesor?'),
(152, 38, 'Indica tu grado de satisfación 0-Nada 5-Excelente'),
(153, 39, '¿Cree que le ha servido la actividad para el momento actual?'),
(154, 39, '¿Ha descubierto nuevas salidas laborales?'),
(155, 39, '¿Le gustaría seguir haciendo actividades de este tipo?'),
(156, 39, '¿Le ha gustado el conferenciante?'),
(157, 39, '¿Repitiría una actividad similar con el?');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ultimaconexionusuario`
--

CREATE TABLE IF NOT EXISTS `ultimaconexionusuario` (
  `id_usuario` varchar(20) CHARACTER SET latin1 COLLATE latin1_spanish_ci NOT NULL,
  `fechaConexion` date NOT NULL,
  PRIMARY KEY (`id_usuario`,`fechaConexion`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `ultimaconexionusuario`
--

INSERT INTO `ultimaconexionusuario` (`id_usuario`, `fechaConexion`) VALUES
('MariaPR', '2014-06-22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarioasignaturas`
--

CREATE TABLE IF NOT EXISTS `usuarioasignaturas` (
  `Usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `idAsignatura` int(11) NOT NULL,
  `inscrito` int(1) NOT NULL COMMENT '0-El usuario ha hecho la petición pero no ha sido procesada. 1-Usuario inscrito en la asignatura',
  PRIMARY KEY (`Usuario`,`idAsignatura`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarioasignaturas`
--

INSERT INTO `usuarioasignaturas` (`Usuario`, `idAsignatura`, `inscrito`) VALUES
('MariaPR', 25, 1),
('MariaPR', 24, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `Usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `Nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `apellidos` varchar(50) COLLATE utf8_spanish_ci NOT NULL,
  `dni` varchar(9) COLLATE utf8_spanish_ci NOT NULL,
  `mail` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `password` varchar(10) COLLATE utf8_spanish_ci NOT NULL,
  `tipo_usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL COMMENT 'Profesor,Alumno o Administrador',
  `creditos_maximos` varchar(11) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pregunta_seg` varchar(128) COLLATE utf8_spanish_ci DEFAULT NULL,
  `respuesta_seg` varchar(128) COLLATE utf8_spanish_ci DEFAULT NULL,
  PRIMARY KEY (`Usuario`,`tipo_usuario`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`Usuario`, `Nombre`, `apellidos`, `dni`, `mail`, `password`, `tipo_usuario`, `creditos_maximos`, `pregunta_seg`, `respuesta_seg`) VALUES
('AdrianSS', 'Adrian', 'Sanchez Sanchez', '12345670T', 'adrian@mail.com', '123', 'Administrador', NULL, NULL, NULL),
('MariaAG', 'Maria', 'Armero Guerra', '78945612A', 'm.armero.guerra@gmail.com', '123', 'Profesor', NULL, NULL, NULL),
('MariaPR', 'Maria', 'Perez Reverte', '65436789K', 'maria@mail.com', '111', 'Alumno', '18', 'color favorito', 'rojo'),
('CarmenPL', 'Carmen', 'Perez Lopez', '789654123', 'maria@mail.com', '1234', 'Profesor', NULL, NULL, NULL),
('RocioSM', 'Rocio', 'Sanchez Martín', '78945612K', 'rocio@mail.com', '1234', 'Profesor', NULL, NULL, NULL),
('CarmenLP', 'Carmen', 'Perez Lopez', '70060758K', 'carmen@mail.com', '1478', 'Profesor', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuariosactividades`
--

CREATE TABLE IF NOT EXISTS `usuariosactividades` (
  `Usuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `id_actividad` int(11) NOT NULL,
  `encuestaRealizada` int(11) NOT NULL,
  PRIMARY KEY (`Usuario`,`id_actividad`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `usuariosactividades`
--

INSERT INTO `usuariosactividades` (`Usuario`, `id_actividad`, `encuestaRealizada`) VALUES
('MariaPR', 24, 0);
