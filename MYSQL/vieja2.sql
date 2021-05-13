-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 10-05-2021 a las 21:09:23
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
  `idc` int(11) NOT NULL,
  `patente` varchar(20) NOT NULL,
  `cantidad_asientos` int(100) NOT NULL,
  `tipo` varchar(20) NOT NULL,
  `modelo` varchar(30) NOT NULL,
  `idu` varchar(30) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `idi` int(11) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `inventario` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `insumos`
--

INSERT INTO `insumos` (`idi`, `nombre`, `inventario`, `precio`, `activo`) VALUES
(1, 'Botella de aguaaa', 66, 35, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `insumos_usuarios_viajes`
--

CREATE TABLE `insumos_usuarios_viajes` (
  `idu` varchar(30) NOT NULL,
  `idi` int(30) NOT NULL,
  `idv` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `lugares`
--

CREATE TABLE `lugares` (
  `idl` int(11) NOT NULL,
  `codigo_postal` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lugares`
--

INSERT INTO `lugares` (`idl`, `codigo_postal`, `nombre`, `activo`) VALUES
(1, 1896, 'City Bell', 0),
(2, 6988, 'Buenos Aires', 1),
(3, 6696, 'La Plata', 1),
(4, 4554, 'La Matanza', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `id` int(11) NOT NULL,
  `viaje` int(11) NOT NULL,
  `texto` varchar(140) NOT NULL,
  `idu` int(11) NOT NULL,
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
  `idu` varchar(30) NOT NULL,
  `nro_viaje` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas`
--

CREATE TABLE `rutas` (
  `idr` int(11) NOT NULL,
  `codigo_ruta` int(11) NOT NULL,
  `codigo_postal_origen` int(11) NOT NULL,
  `codigo_postal_destino` int(11) NOT NULL,
  `kilometros` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rutas`
--

INSERT INTO `rutas` (`idr`, `codigo_ruta`, `codigo_postal_origen`, `codigo_postal_destino`, `kilometros`, `activo`) VALUES
(1, 1, 1896, 6988, 43, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
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

INSERT INTO `usuarios` (`id`, `email`, `nombre`, `apellido`, `DNI`, `clave`, `tipo_usuario`, `suspendido`, `suscrito`, `nro_tarjeta`, `cod_seguridad`, `fecha_vencimiento`, `activo`) VALUES
(1, 'admin@admin.com', 'admin', 'admin', 1111111, 'admin', 'administrador', 0, 0, NULL, NULL, NULL, 1),
(2, 'diego@example.com', 'diego', 'aguilar', 999999, '1234', 'chofer', 0, 0, NULL, NULL, NULL, 1),
(3, 'john@gmail.com', 'john', 'doe', 111119, 'test', 'chofer', 0, 0, NULL, NULL, NULL, 0),
(4, 'juanperez@example.com', 'juan', 'perez', 9111111, '1234', 'chofer', 0, 0, NULL, NULL, NULL, 1),
(5, 'juju@gmail.com', 'tomas', 'echeverria', 43015912, 'clave12', '0', 0, 0, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajes`
--

CREATE TABLE `viajes` (
  `idv` int(11) NOT NULL,
  `nro_viaje` int(11) NOT NULL,
  `imprevisto` varchar(50) NOT NULL,
  `idc` int(11) NOT NULL,
  `idr` int(11) NOT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `choferes_combis`
--
ALTER TABLE `choferes_combis`
  ADD PRIMARY KEY (`email`,`patente`);

--
-- Indices de la tabla `combis`
--
ALTER TABLE `combis`
  ADD PRIMARY KEY (`idc`);

--
-- Indices de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  ADD PRIMARY KEY (`email`,`nro_viaje`);

--
-- Indices de la tabla `insumos`
--
ALTER TABLE `insumos`
  ADD PRIMARY KEY (`idi`);

--
-- Indices de la tabla `insumos_usuarios_viajes`
--
ALTER TABLE `insumos_usuarios_viajes`
  ADD PRIMARY KEY (`idu`,`idi`,`idv`);

--
-- Indices de la tabla `lugares`
--
ALTER TABLE `lugares`
  ADD PRIMARY KEY (`idl`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pasajes`
--
ALTER TABLE `pasajes`
  ADD PRIMARY KEY (`nro_pasaje`);

--
-- Indices de la tabla `rutas`
--
ALTER TABLE `rutas`
  ADD PRIMARY KEY (`idr`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `viajes`
--
ALTER TABLE `viajes`
  ADD PRIMARY KEY (`idv`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `combis`
--
ALTER TABLE `combis`
  MODIFY `idc` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `insumos`
--
ALTER TABLE `insumos`
  MODIFY `idi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `lugares`
--
ALTER TABLE `lugares`
  MODIFY `idl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pasajes`
--
ALTER TABLE `pasajes`
  MODIFY `nro_pasaje` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rutas`
--
ALTER TABLE `rutas`
  MODIFY `idr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `viajes`
--
ALTER TABLE `viajes`
  MODIFY `idv` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
