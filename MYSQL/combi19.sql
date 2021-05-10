-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-05-2021 a las 04:39:45
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 8.0.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `combi19`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `camino`
--

CREATE TABLE `camino` (
  `cod_ruta` int(11) NOT NULL,
  `cod_postal` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `choferes_combis`
--

CREATE TABLE `choferes_combis` (
  `email` varchar(30) NOT NULL,
  `patente` varchar(20) NOT NULL,
  `fecha_desde` datetime NOT NULL,
  `fecha_hasta` datetime NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `combis`
--

CREATE TABLE `combis` (
  `patente` varchar(20) NOT NULL,
  `cantidad_asientos` int(100) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `modelo` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `combis`
--

INSERT INTO `combis` (`patente`, `cantidad_asientos`, `tipo`, `modelo`, `email`, `activo`) VALUES
('SZM 758', 0, 'Super Comoda', '223', '', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `email` varchar(30) NOT NULL,
  `nro_viaje` int(11) NOT NULL,
  `fecha_y_hora` datetime NOT NULL,
  `texto_comentario` varchar(120) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos`
--

CREATE TABLE `insumos` (
  `nombre` varchar(40) NOT NULL,
  `inventario` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `insumos`
--

INSERT INTO `insumos` (`nombre`, `inventario`, `precio`, `activo`) VALUES
('Botella de aguaaa', 66, 35, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos_usuarios_viajes`
--

CREATE TABLE `insumos_usuarios_viajes` (
  `email` varchar(30) NOT NULL,
  `nombre` int(30) NOT NULL,
  `nro_viaje` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `id` int(11) NOT NULL,
  `texto` varchar(140) NOT NULL,
  `imagen_contenido` longblob DEFAULT NULL,
  `imagen_tipo` varchar(4) DEFAULT NULL,
  `usuarios_id` int(11) NOT NULL,
  `fechayhora` datetime NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pasajes`
--

CREATE TABLE `pasajes` (
  `nro_pasaje` int(11) NOT NULL,
  `nro_asiento` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `pago` tinyint(1) NOT NULL,
  `sospechoso_covid` tinyint(1) NOT NULL,
  `email` varchar(30) NOT NULL,
  `nro_viaje` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas`
--

CREATE TABLE `rutas` (
  `codigo_ruta` int(11) NOT NULL,
  `cod_postal_origen` int(11) NOT NULL,
  `cod_postal_destino` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `email` varchar(30) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `DNI` int(11) NOT NULL,
  `clave` varchar(50) NOT NULL,
  `tipo_usuario` varchar(20) NOT NULL,
  `suspendido` tinyint(1) NOT NULL,
  `suscrito` tinyint(1) NOT NULL,
  `nro_tarjeta` int(11) DEFAULT NULL,
  `cod_seguridad` int(11) DEFAULT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`email`, `nombre`, `apellido`, `DNI`, `clave`, `tipo_usuario`, `suspendido`, `suscrito`, `nro_tarjeta`, `cod_seguridad`, `fecha_vencimiento`, `activo`) VALUES
('admin@admin.com', 'admin', 'admin', 1111111, 'admin', 'administrador', 0, 0, NULL, NULL, NULL, 1),
('diego@example.com', 'diego', 'aguilar', 999999, '1234', 'chofer', 0, 0, NULL, NULL, NULL, 1),
('john@gmail.com', 'john', 'doe', 111119, 'test', 'chofer', 0, 0, NULL, NULL, NULL, 0),
('juanperez@example.com', 'juan', 'perez', 9111111, '1234', 'chofer', 0, 0, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajes`
--

CREATE TABLE `viajes` (
  `nro_viaje` int(11) NOT NULL,
  `imprevisto` varchar(50) NOT NULL,
  `patente` int(11) NOT NULL,
  `codigo_ruta` int(11) NOT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `camino`
--
ALTER TABLE `camino`
  ADD PRIMARY KEY (`cod_ruta`);

--
-- Indices de la tabla `choferes_combis`
--
ALTER TABLE `choferes_combis`
  ADD PRIMARY KEY (`email`,`patente`);

--
-- Indices de la tabla `combis`
--
ALTER TABLE `combis`
  ADD PRIMARY KEY (`patente`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`email`,`nro_viaje`);

--
-- Indices de la tabla `insumos`
--
ALTER TABLE `insumos`
  ADD PRIMARY KEY (`nombre`);

--
-- Indices de la tabla `insumos_usuarios_viajes`
--
ALTER TABLE `insumos_usuarios_viajes`
  ADD PRIMARY KEY (`email`,`nombre`,`nro_viaje`);

--
-- Indices de la tabla `pasajes`
--
ALTER TABLE `pasajes`
  ADD PRIMARY KEY (`nro_pasaje`);

--
-- Indices de la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD PRIMARY KEY (`codigo_ruta`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`email`);

--
-- Indices de la tabla `viajes`
--
ALTER TABLE `viajes`
  ADD PRIMARY KEY (`nro_viaje`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
