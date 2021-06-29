-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-06-2021 a las 21:01:37
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

--
-- Volcado de datos para la tabla `choferes_combis`
--

INSERT INTO `choferes_combis` (`email`, `patente`, `fecha_desde`, `fecha_hasta`, `activo`) VALUES
('john@mail.com', 'asdasd', '2021-06-22 03:16:14', '2021-06-22 03:16:14', 1),
('tomas@gmail.com', 'asdasd', '2021-06-18 21:06:28', '2021-06-18 21:06:28', 1);

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

--
-- Volcado de datos para la tabla `combis`
--

INSERT INTO `combis` (`idc`, `patente`, `cantidad_asientos`, `tipo`, `modelo`, `idu`, `activo`) VALUES
(1, 'kase', 48, 'Comoda', 'asda', '2', 1),
(3, 'patente2', 400, 'Comoda', 'asda', '4', 1),
(4, 'patent', 12, 'Comoda', 'fiat', '', 1),
(6, 'borrame', 89, 'Comoda', 'adafasfasfasf', '', 0),
(7, 'delet', 1, 'Comoda', 'adafasfasfasf', '5', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentarios`
--

CREATE TABLE `comentarios` (
  `idcom` int(200) NOT NULL,
  `email` varchar(30) NOT NULL,
  `idv` int(11) NOT NULL,
  `fecha_y_hora` datetime NOT NULL,
  `texto_comentario` varchar(120) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comentarios`
--

INSERT INTO `comentarios` (`idcom`, `email`, `idv`, `fecha_y_hora`, `texto_comentario`, `activo`) VALUES
(1, 'tomas@gmail.com', 11, '2021-06-07 03:27:42', 'la pase mal', 0),
(2, 'pasajero@gmail.com', 10, '2021-06-07 03:27:42', 'me contagie', 1),
(3, 'tomas@gmail.com', 10, '2021-06-07 03:27:42', 'me aburri', 0),
(4, 'pasajero@gmail.com', 11, '2021-06-07 03:27:42', 'esto no aparece', 0),
(5, 'tomas@gmail.com', 11, '2021-06-10 06:28:05', 'me descompuse por la comida', 0),
(6, 'tomas@gmail.com', 11, '2021-06-10 06:48:05', 'la comida estaba horrible', 0),
(7, 'tomas@gmail.com', 11, '2021-06-10 12:47:54', 'HOLA', 0),
(8, 'tomas@gmail.com', 11, '2021-06-10 12:48:52', 'HOLA', 0),
(9, 'tomas@gmail.com', 11, '2021-06-10 22:04:20', 'hola', 0),
(10, 'tomas@gmail.com', 9, '2021-06-10 22:10:27', 'esto se borra', 0),
(11, 'tomas@gmail.com', 9, '2021-06-24 03:46:10', 'chau\r\n', 0);

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
  `id` int(11) NOT NULL,
  `idp` varchar(30) NOT NULL,
  `idi` int(30) NOT NULL,
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
  `nombre` varchar(50) NOT NULL,
  `provincia` varchar(100) NOT NULL,
  `activo` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `lugares`
--

INSERT INTO `lugares` (`idl`, `nombre`, `provincia`, `activo`) VALUES
(1, 'City Bell', 'Buenos aires', 1),
(2, 'Buenos Aires', 'bs as', 1),
(3, 'La Plata', 'B A', 1),
(4, 'La Matanza', 'BS. AS.', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mensaje`
--

CREATE TABLE `mensaje` (
  `idm` int(11) NOT NULL,
  `viaje` int(11) NOT NULL,
  `texto` varchar(140) NOT NULL,
  `idu` int(11) NOT NULL,
  `fechayhora` datetime NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pasajeros`
--

CREATE TABLE `pasajeros` (
  `idpasajero` int(10) NOT NULL,
  `nombre` varchar(40) NOT NULL,
  `apellido` varchar(40) NOT NULL,
  `sospechoso_covid` int(11) NOT NULL,
  `dni` int(10) NOT NULL,
  `idp` int(100) NOT NULL,
  `presente` tinyint(10) NOT NULL DEFAULT 0,
  `activo` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pasajeros`
--

INSERT INTO `pasajeros` (`idpasajero`, `nombre`, `apellido`, `sospechoso_covid`, `dni`, `idp`, `presente`, `activo`) VALUES
(1, 'tomas', 'e', 0, 48, 4, 0, 0),
(2, 'mateo', 'e', 0, 48, 4, 0, 0),
(5, 'toams', 'echeverria', 0, 14256398, 9, 0, 1),
(7, 'toams', 'echeverria', 0, 14256398, 11, 0, 0),
(8, 'cual', 'quiera', 0, 47, 11, 0, 0),
(9, 'quien ', 'sea', 0, 49, 11, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pasajes`
--

CREATE TABLE `pasajes` (
  `idp` int(11) NOT NULL,
  `cantidad_asientos` int(11) NOT NULL,
  `precio` int(11) NOT NULL,
  `pago` tinyint(1) NOT NULL,
  `sospechoso_covid` tinyint(1) NOT NULL,
  `idu` varchar(30) NOT NULL,
  `idv` int(11) NOT NULL,
  `idcom` int(200) DEFAULT NULL,
  `tarjeta` bigint(20) NOT NULL,
  `comentario` tinyint(1) NOT NULL DEFAULT 0,
  `fantasma` int(11) NOT NULL DEFAULT 1,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `pasajes`
--

INSERT INTO `pasajes` (`idp`, `cantidad_asientos`, `precio`, `pago`, `sospechoso_covid`, `idu`, `idv`, `idcom`, `tarjeta`, `comentario`, `fantasma`, `activo`) VALUES
(1, 5, 20, 0, 0, '10', 11, NULL, 0, 0, 0, 1),
(2, 2, 0, 0, 0, '6', 10, NULL, 0, 0, 0, 1),
(3, 8, 90, 0, 0, '9', 11, NULL, 0, 0, 0, 1),
(4, 87, 49, 0, 0, '7', 11, 0, 0, 0, 0, 0),
(6, 20, 10, 0, 0, '7', 11, NULL, 0, 0, 0, 1),
(7, 48, 90, 0, 0, '7', 11, NULL, 0, 0, 0, 1),
(8, 48, 90, 0, 0, '7', 11, 0, 0, 0, 0, 1),
(9, 1, 4555, 0, 0, '7', 9, 0, 0, 0, 0, 0),
(11, 3, 13665, 0, 0, '7', 9, NULL, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rembolso`
--

CREATE TABLE `rembolso` (
  `idrem` int(50) NOT NULL,
  `precio` int(11) NOT NULL,
  `tarjeta` int(11) NOT NULL,
  `activo` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rutas`
--

CREATE TABLE `rutas` (
  `idr` int(11) NOT NULL,
  `descripcion` varchar(30) NOT NULL,
  `codigo_postal_origen` int(11) NOT NULL,
  `codigo_postal_destino` int(11) NOT NULL,
  `kilometros` int(11) NOT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `rutas`
--

INSERT INTO `rutas` (`idr`, `descripcion`, `codigo_postal_origen`, `codigo_postal_destino`, `kilometros`, `activo`) VALUES
(1, 'por aeropurto', 1, 2, 43, 1),
(2, 'ruta 8', 1, 2, 2, 1);

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
  `nro_tarjeta` bigint(11) DEFAULT NULL,
  `cod_seguridad` int(11) DEFAULT NULL,
  `fecha_vencimiento` date DEFAULT NULL,
  `activo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `nombre`, `apellido`, `DNI`, `clave`, `tipo_usuario`, `suspendido`, `suscrito`, `nro_tarjeta`, `cod_seguridad`, `fecha_vencimiento`, `activo`) VALUES
(1, 'admin@admin.com', 'admin12', 'admin', 1111111, 'admin12', 'administrador', 0, 0, NULL, NULL, NULL, 1),
(2, 'diego@example.com', 'diegosss', 'aguilar', 999999, 'clave12', 'chofer', 0, 0, NULL, NULL, NULL, 1),
(3, 'john@gmail.com', 'john', 'doe', 111119, 'test', 'chofer', 0, 0, NULL, NULL, NULL, 0),
(4, 'juanperez@example.com', 'juan', 'perez', 9111111, '1234', 'chofer', 0, 0, NULL, NULL, NULL, 1),
(5, 'juju@gmail.com', 'tomas', 'echeverria', 43015912, 'clave12', 'chofer', 0, 0, NULL, NULL, NULL, 1),
(6, 'tomas1@gmail.com', 'tomas', 'echeverria', 14256398, 'clave12', 'pasajero', 0, 0, NULL, NULL, NULL, 0),
(7, 'tomas@gmail.com', 'toams', 'echeverria', 14256398, 'clave12', 'pasajero', 0, 0, NULL, NULL, NULL, 1),
(8, 'tomas@gmail.com', 'toams', 'echeverria', 14256398, 'clave12', 'pasajero', 0, 0, NULL, NULL, NULL, 0),
(9, 'tomiecheverria00@gmail.com', 'tomas', 'echeverria', 43015912, 'clave12', 'pasajero', 0, 0, NULL, NULL, NULL, 1),
(10, 'pasajero@gmail.com', 'kasdasd', 'asdasfdaf', 43015912, 'pasajero12', 'pasajero', 0, 0, NULL, NULL, NULL, 1),
(11, 'basura@gmail.com', 'trash', 'basura', 43015912, 'Tridente12', 'pasajero', 0, 0, NULL, NULL, NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `viajes`
--

CREATE TABLE `viajes` (
  `idv` int(11) NOT NULL,
  `nro_viaje` int(11) NOT NULL,
  `imprevisto` varchar(100) NOT NULL,
  `estado_imprevisto` varchar(100) NOT NULL DEFAULT 'desactivado',
  `precio` int(11) NOT NULL,
  `estado` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `hora` time NOT NULL,
  `idc` int(11) NOT NULL,
  `idr` int(11) NOT NULL,
  `activo` tinyint(4) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `viajes`
--

INSERT INTO `viajes` (`idv`, `nro_viaje`, `imprevisto`, `estado_imprevisto`, `precio`, `estado`, `fecha`, `hora`, `idc`, `idr`, `activo`) VALUES
(6, 10, '', 'desactivado', 100, 'pendiente', '2021-05-12', '00:00:00', 2, 1, 1),
(7, 0, '', 'desactivado', 45, 'finalizado', '2021-05-11', '00:00:00', 2, 1, 1),
(8, 45, 'hola', 'desactivado', 4500, 'finalizado', '2021-05-05', '00:00:00', 4, 1, 1),
(9, 4555, '', 'desactivado', 4555, 'pendiente', '2021-05-07', '23:57:00', 4, 1, 1),
(10, 6, '', 'desactivado', 4, 'finalizado', '2021-06-03', '23:18:00', 4, 1, 0),
(11, 89, '', 'desactivado', 8, 'pendiente', '2021-06-24', '21:27:00', 4, 1, 1),
(12, 99, '', 'desactivado', 16, 'cancelado', '2021-06-28', '20:09:00', 2, 2, 1);

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
  ADD PRIMARY KEY (`idcom`);

--
-- Indices de la tabla `insumos`
--
ALTER TABLE `insumos`
  ADD PRIMARY KEY (`idi`);

--
-- Indices de la tabla `insumos_usuarios_viajes`
--
ALTER TABLE `insumos_usuarios_viajes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `lugares`
--
ALTER TABLE `lugares`
  ADD PRIMARY KEY (`idl`);

--
-- Indices de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  ADD PRIMARY KEY (`idm`);

--
-- Indices de la tabla `pasajeros`
--
ALTER TABLE `pasajeros`
  ADD PRIMARY KEY (`idpasajero`);

--
-- Indices de la tabla `pasajes`
--
ALTER TABLE `pasajes`
  ADD PRIMARY KEY (`idp`),
  ADD UNIQUE KEY `idp` (`idp`);

--
-- Indices de la tabla `rembolso`
--
ALTER TABLE `rembolso`
  ADD PRIMARY KEY (`idrem`);

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
  MODIFY `idc` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `comentarios`
--
ALTER TABLE `comentarios`
  MODIFY `idcom` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `insumos`
--
ALTER TABLE `insumos`
  MODIFY `idi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `insumos_usuarios_viajes`
--
ALTER TABLE `insumos_usuarios_viajes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `lugares`
--
ALTER TABLE `lugares`
  MODIFY `idl` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `mensaje`
--
ALTER TABLE `mensaje`
  MODIFY `idm` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pasajeros`
--
ALTER TABLE `pasajeros`
  MODIFY `idpasajero` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `pasajes`
--
ALTER TABLE `pasajes`
  MODIFY `idp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `rembolso`
--
ALTER TABLE `rembolso`
  MODIFY `idrem` int(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `rutas`
--
ALTER TABLE `rutas`
  MODIFY `idr` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `viajes`
--
ALTER TABLE `viajes`
  MODIFY `idv` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
