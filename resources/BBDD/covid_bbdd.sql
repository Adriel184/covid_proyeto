-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-01-2022 a las 08:45:10
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `covid_ddbb`
--
CREATE DATABASE IF NOT EXISTS `covid_ddbb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `covid_ddbb`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id` int(9) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contrasena` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `tipo` enum('general','paciente') NOT NULL,
  `id_centro` int(9) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `admin`
--

INSERT INTO `admin` (`id`, `usuario`, `contrasena`, `nombre`, `apellido`, `tipo`, `id_centro`) VALUES
(1, 'admin_general', '1234', 'administrador', 'general', 'general', NULL),
(2, 'admin_paciente_1', '1234', 'administrador', 'paciente', 'paciente', 1),
(3, 'admin_paciente_2', '1234', 'administrador', 'paciente', 'paciente', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centro_vacunacion`
--

CREATE TABLE `centro_vacunacion` (
  `id` int(9) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `poblacion` varchar(75) NOT NULL,
  `cp` int(4) NOT NULL,
  `provincia` varchar(50) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `hora_apertura` time NOT NULL,
  `hora_cierre` time NOT NULL,
  `lunes` tinyint(4) NOT NULL,
  `martes` tinyint(4) NOT NULL,
  `miercoles` tinyint(4) NOT NULL,
  `jueves` tinyint(4) NOT NULL,
  `viernes` tinyint(4) NOT NULL,
  `sabado` tinyint(4) NOT NULL,
  `domingo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `centro_vacunacion`
--

INSERT INTO `centro_vacunacion` (`id`, `nombre`, `poblacion`, `cp`, `provincia`, `direccion`, `hora_apertura`, `hora_cierre`, `lunes`, `martes`, `miercoles`, `jueves`, `viernes`, `sabado`, `domingo`) VALUES
(1, 'Centro Salud Amorebieta', 'Amorebieta-Etxano', 48340, 'Vizcaya', 'San Miguel Kalea, 17', '00:00:00', '00:00:00', 1, 1, 1, 1, 1, 1, 1),
(2, 'Hospital Universitario de Galdakao', 'Galdakao', 48960, 'Vizcaya', 'Labeaga Auzoa', '00:00:00', '00:00:00', 1, 1, 1, 1, 1, 1, 1),
(4, 'Ambulatorio De Landako', 'Durango', 48200, '1', 'Ambulatorio De Landako', '08:00:00', '23:30:00', 1, 1, 1, 1, 1, 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `id` int(9) NOT NULL,
  `tis` int(8) NOT NULL,
  `id_centro` int(9) NOT NULL,
  `fecha` datetime NOT NULL,
  `dosis` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `cita`
--

INSERT INTO `cita` (`id`, `tis`, `id_centro`, `fecha`, `dosis`) VALUES
(1, 23456789, 1, '2021-06-28 10:00:00', 0),
(2, 12345678, 2, '2022-01-21 19:50:00', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paciente`
--

CREATE TABLE `paciente` (
  `tis` int(8) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(75) NOT NULL,
  `fecha_nac` date NOT NULL,
  `fecha_pcr` date DEFAULT NULL,
  `id_centro` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `paciente`
--

INSERT INTO `paciente` (`tis`, `nombre`, `apellido`, `fecha_nac`, `fecha_pcr`, `id_centro`) VALUES
(12345678, 'Adriel', 'Crespo', '2001-12-10', NULL, 2),
(23456789, 'Iñigo', 'Rosado', '2002-02-07', '2020-10-12', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `recibe`
--

CREATE TABLE `recibe` (
  `tis` int(8) NOT NULL,
  `id_vacuna` int(9) NOT NULL,
  `fecha` date NOT NULL,
  `dosis` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `recibe`
--

INSERT INTO `recibe` (`tis`, `id_vacuna`, `fecha`, `dosis`) VALUES
(23456789, 1, '2021-07-28', 1),
(23456789, 1, '2022-01-23', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vacuna`
--

CREATE TABLE `vacuna` (
  `id` int(9) NOT NULL,
  `marca` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `vacuna`
--

INSERT INTO `vacuna` (`id`, `marca`) VALUES
(1, 'Pfizer'),
(2, 'Moderna'),
(3, 'Johnson & Johnson'),
(4, 'Novavax'),
(5, 'AstraZeneca');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_centro` (`id_centro`);

--
-- Indices de la tabla `centro_vacunacion`
--
ALTER TABLE `centro_vacunacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tis` (`tis`,`id_centro`),
  ADD KEY `id_centro` (`id_centro`);

--
-- Indices de la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD PRIMARY KEY (`tis`),
  ADD KEY `id_centro` (`id_centro`);

--
-- Indices de la tabla `recibe`
--
ALTER TABLE `recibe`
  ADD PRIMARY KEY (`tis`,`id_vacuna`,`dosis`),
  ADD KEY `id_vacuna` (`id_vacuna`);

--
-- Indices de la tabla `vacuna`
--
ALTER TABLE `vacuna`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `centro_vacunacion`
--
ALTER TABLE `centro_vacunacion`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `vacuna`
--
ALTER TABLE `vacuna`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`id_centro`) REFERENCES `centro_vacunacion` (`id`);

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`id_centro`) REFERENCES `centro_vacunacion` (`id`),
  ADD CONSTRAINT `cita_ibfk_2` FOREIGN KEY (`tis`) REFERENCES `paciente` (`tis`);

--
-- Filtros para la tabla `paciente`
--
ALTER TABLE `paciente`
  ADD CONSTRAINT `paciente_ibfk_1` FOREIGN KEY (`id_centro`) REFERENCES `centro_vacunacion` (`id`);

--
-- Filtros para la tabla `recibe`
--
ALTER TABLE `recibe`
  ADD CONSTRAINT `recibe_ibfk_1` FOREIGN KEY (`id_vacuna`) REFERENCES `vacuna` (`id`),
  ADD CONSTRAINT `recibe_ibfk_2` FOREIGN KEY (`tis`) REFERENCES `paciente` (`tis`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
