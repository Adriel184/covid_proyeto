-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-01-2022 a las 11:12:44
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
-- Base de datos: `covid-ddbb`
--
CREATE DATABASE IF NOT EXISTS `covid-ddbb` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `covid-ddbb`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `admin`
--

CREATE TABLE `admin` (
  `id` int(9) NOT NULL,
  `usuario` varchar(50) NOT NULL,
  `contra` varchar(50) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `tipo` enum('General','Pacientes') NOT NULL,
  `idCentro` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `centro-vacunacion`
--

CREATE TABLE `centro-vacunacion` (
  `id` int(9) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `poblacion` varchar(75) NOT NULL,
  `CP` int(4) NOT NULL,
  `provincia` varchar(50) NOT NULL,
  `direccion` varchar(50) NOT NULL,
  `horaApertura` time NOT NULL,
  `horaCierre` time NOT NULL,
  `lunes` tinyint(4) NOT NULL,
  `martes` tinyint(4) NOT NULL,
  `miercoles` tinyint(4) NOT NULL,
  `jueves` tinyint(4) NOT NULL,
  `viernes` tinyint(4) NOT NULL,
  `sabado` tinyint(4) NOT NULL,
  `domingo` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cita`
--

CREATE TABLE `cita` (
  `id` int(9) NOT NULL,
  `TIS` int(8) NOT NULL,
  `idCentro` int(9) NOT NULL,
  `fecha` datetime NOT NULL,
  `nomDosis` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `info-covid`
--

CREATE TABLE `info-covid` (
  `id` int(9) NOT NULL,
  `TIS` int(8) NOT NULL,
  `dosis` int(1) DEFAULT NULL,
  `tipoDosis` varchar(25) DEFAULT NULL,
  `fecha` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `TIS` int(8) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellidos` varchar(75) NOT NULL,
  `fechaNac` date NOT NULL,
  `fechaPCR` date NOT NULL,
  `idCentro` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idCentro` (`idCentro`);

--
-- Indices de la tabla `centro-vacunacion`
--
ALTER TABLE `centro-vacunacion`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cita`
--
ALTER TABLE `cita`
  ADD PRIMARY KEY (`id`),
  ADD KEY `TIS` (`TIS`),
  ADD KEY `idCentro` (`idCentro`),
  ADD KEY `TIS_2` (`TIS`,`idCentro`);

--
-- Indices de la tabla `info-covid`
--
ALTER TABLE `info-covid`
  ADD PRIMARY KEY (`id`),
  ADD KEY `TIS` (`TIS`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`TIS`),
  ADD KEY `idCentro` (`idCentro`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `centro-vacunacion`
--
ALTER TABLE `centro-vacunacion`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `cita`
--
ALTER TABLE `cita`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `info-covid`
--
ALTER TABLE `info-covid`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`idCentro`) REFERENCES `centro-vacunacion` (`id`);

--
-- Filtros para la tabla `cita`
--
ALTER TABLE `cita`
  ADD CONSTRAINT `cita_ibfk_1` FOREIGN KEY (`idCentro`) REFERENCES `centro-vacunacion` (`id`),
  ADD CONSTRAINT `cita_ibfk_2` FOREIGN KEY (`TIS`) REFERENCES `pacientes` (`TIS`);

--
-- Filtros para la tabla `info-covid`
--
ALTER TABLE `info-covid`
  ADD CONSTRAINT `info-covid_ibfk_1` FOREIGN KEY (`TIS`) REFERENCES `pacientes` (`TIS`);

--
-- Filtros para la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `pacientes_ibfk_1` FOREIGN KEY (`idCentro`) REFERENCES `centro-vacunacion` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
