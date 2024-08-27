-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 31-07-2024 a las 02:06:41
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `panol`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aulas`
--

CREATE TABLE `aulas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `piso` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `aulas`
--

INSERT INTO `aulas` (`id`, `nombre`, `piso`) VALUES
(1, 'salon 1', 'PB'),
(2, 'salon 2', 'PB'),
(3, 'salon 11', 'P1'),
(4, 'salon 12', 'P1'),
(5, 'salon 13', 'P1'),
(6, 'salon 14', 'P1'),
(7, 'salon 15', 'P1'),
(8, 'salon 16', 'P1'),
(9, 'salon 17', 'P1'),
(10, 'salon 18', 'P1'),
(11, 'salon 19', 'P1'),
(12, 'taller ciclo basico', 'PB'),
(13, 'taller 2', 'PB'),
(14, 'taller 3', 'PB'),
(15, 'laboratorio de automatismos', 'PB'),
(16, 'taller de lenguajes tecnologicos', 'PB'),
(17, 'laboratorio 1', 'P2'),
(18, 'laboratorio 2', 'P2'),
(19, 'laboratorio 3', 'P2'),
(20, 'laboratorio diseño electronico', 'P2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `descripcion`, `cantidad`) VALUES
(1, 'martillo', 'sin descripción', 2),
(2, 'escofina', 'sin descripción', 10),
(3, 'clavos', 'sin descripción', 400),
(4, 'destornillador', 'sin descripción', 25);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `cursos` varchar(85) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `cursos`) VALUES
(1, '1° 1°'),
(2, '1° 2°'),
(3, '1° 3°'),
(4, '1° 4°'),
(5, '1° 5°'),
(6, '2° 1°'),
(7, '2° 2°'),
(8, '2° 3°'),
(9, '2° 4°'),
(10, '2° 5°'),
(11, '3° 1°'),
(12, '3° 2°'),
(13, '3° 3°'),
(14, '3° 4°'),
(15, '4° 1°'),
(16, '4° 2°'),
(17, '4° 3°'),
(18, '4° 4°'),
(19, '5° 1°'),
(20, '5° 2°'),
(21, '5° 3°'),
(22, '6° 1°'),
(23, '6° 2°'),
(24, '6° 3°'),
(25, '7° 1°'),
(26, '7° 2°');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `herramientaxunidad`
--

CREATE TABLE `herramientaxunidad` (
  `id` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `observacion` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `estado` enum('alta','baja','modificada','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `fecha_pedido` date NOT NULL,
  `usuario_solicitante` int(11) NOT NULL,
  `ubicacion_pedido` int(11) NOT NULL,
  `estado` enum('pendiente','en curso','entregado','') NOT NULL,
  `observaciones` varchar(150) NOT NULL,
  `pedido` longtext NOT NULL,
  `fk_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

CREATE TABLE `reportes` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `id_herramienta` int(11) NOT NULL,
  `observaciones` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_completo` varchar(150) NOT NULL,
  `username` varchar(70) NOT NULL,
  `correo` varchar(100) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `cargo` enum('usuario','panolero','admin','') NOT NULL,
  `horario` varchar(20) NOT NULL,
  `fotoperfil` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_completo`, `username`, `correo`, `contrasena`, `cargo`, `horario`, `fotoperfil`) VALUES
(4, 'matias de santo', 'matiasds', 'matias@desanto.com', '$2y$10$/6Q5fBQK8Tlpw7KPJ.ZSqODv.GQhyAv2Antdbe0/mXaccPRh4M40q', 'usuario', '', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `herramientaxunidad`
--
ALTER TABLE `herramientaxunidad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_categoria` (`id_categoria`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `usuario_solicitante` (`usuario_solicitante`),
  ADD KEY `ubicacion_pedido` (`ubicacion_pedido`),
  ADD KEY `fk_curso` (`fk_curso`);

--
-- Indices de la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_pedido` (`id_pedido`),
  ADD KEY `id_herramienta` (`id_herramienta`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `aulas`
--
ALTER TABLE `aulas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `herramientaxunidad`
--
ALTER TABLE `herramientaxunidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reportes`
--
ALTER TABLE `reportes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `herramientaxunidad`
--
ALTER TABLE `herramientaxunidad`
  ADD CONSTRAINT `herramientaxunidad_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `categoria` (`id`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `pedidos_ibfk_1` FOREIGN KEY (`usuario_solicitante`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `pedidos_ibfk_2` FOREIGN KEY (`ubicacion_pedido`) REFERENCES `aulas` (`id`),
  ADD CONSTRAINT `pedidos_ibfk_3` FOREIGN KEY (`fk_curso`) REFERENCES `cursos` (`id`);

--
-- Filtros para la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD CONSTRAINT `reportes_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `reportes_ibfk_2` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`),
  ADD CONSTRAINT `reportes_ibfk_3` FOREIGN KEY (`id_herramienta`) REFERENCES `herramientaxunidad` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
