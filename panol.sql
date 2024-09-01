-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-08-2024 a las 05:59:37
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
-- Base de datos: `panol`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `aulas`
--

CREATE TABLE `aulas` (
  `id_aulas` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `piso` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `aulas`
--

INSERT INTO `aulas` (`id_aulas`, `nombre`, `piso`) VALUES
(1, 'Salón 1', 'PB'),
(2, 'Salón 2', 'PB'),
(3, 'Salón 11', 'P1'),
(4, 'Salón 12', 'P1'),
(5, 'Salón 13', 'P1'),
(6, 'Salón 14', 'P1'),
(7, 'Salón 15', 'P1'),
(8, 'Salón 16', 'P1'),
(9, 'Salón 17', 'P1'),
(10, 'Salón 18', 'P1'),
(11, 'Salón 19', 'P1'),
(12, 'Taller ciclo básico', 'PB'),
(13, 'Taller 2', 'PB'),
(14, 'Taller 3', 'PB'),
(15, 'Laboratorio de automatismos', 'PB'),
(16, 'Taller de lenguajes tecnológicos', 'PB'),
(17, 'Laboratorio 1', 'P2'),
(18, 'Laboratorio 2', 'P2'),
(19, 'Laboratorio 3', 'P2'),
(20, 'Laboratorio diseño electrónico', 'P2');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cursos`
--

CREATE TABLE `cursos` (
  `id` int(100) NOT NULL,
  `curso` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cursos`
--

INSERT INTO `cursos` (`id`, `curso`) VALUES
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
(28, '7° 2°');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `herramientas`
--

CREATE TABLE `herramientas` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL,
  `descripcion` varchar(200) NOT NULL,
  `imagen` varchar(200) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `herramientas`
--

INSERT INTO `herramientas` (`id`, `nombre`, `descripcion`, `imagen`, `cantidad`) VALUES
(1, 'martillo', 'sin descripción', '', 0),
(2, 'escofina', 'sin descripción', '', 1),
(3, 'clavos', 'sin descripción', '', 100),
(4, 'destornillador', 'sin descripción', '', 0),
(5, 'Lima redonda', 'Lima redonda', '', 14),
(6, 'Lima triangular', 'Lima triangular', '', 13),
(10, 'Lima cuadrada', 'Lima cuadrada', '../estiloscss/imagenes/herramientas/66ce4ade1cf15.jpg', 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paletas`
--

CREATE TABLE `paletas` (
  `id_paletas` int(11) NOT NULL,
  `colores` longtext NOT NULL,
  `fk_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `fecha_pedido` date NOT NULL,
  `fk_usuario` int(11) NOT NULL,
  `id_aula` int(11) NOT NULL,
  `estado` enum('Pendiente','En curso','Entregado','') NOT NULL,
  `observaciones` varchar(200) NOT NULL,
  `pedido` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`pedido`)),
  `fk_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `fecha_pedido`, `fk_usuario`, `id_aula`, `estado`, `observaciones`, `pedido`, `fk_curso`) VALUES
(32, '2024-08-28', 11, 4, 'Pendiente', '', '{\"herramientas\":[3],\"cantidad\":[10]}', 4),
(33, '2024-08-28', 14, 1, 'Pendiente', '', '{\"herramientas\":[2],\"cantidad\":[1]}', 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reportes`
--

CREATE TABLE `reportes` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_pedido` int(11) NOT NULL,
  `observaciones` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `reportes`
--

INSERT INTO `reportes` (`id`, `id_usuario`, `id_pedido`, `observaciones`) VALUES
(8, 14, 1, 'no hay mas'),
(9, 14, 1, 'no hay mas');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nombre_completo` varchar(150) NOT NULL,
  `username` varchar(70) NOT NULL,
  `correo` varchar(150) NOT NULL,
  `contrasena` varchar(100) NOT NULL,
  `cargo` enum('panolero','encargado_panol','admin','') NOT NULL,
  `horario` varchar(20) NOT NULL,
  `fotoperfil` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_completo`, `username`, `correo`, `contrasena`, `cargo`, `horario`, `fotoperfil`) VALUES
(11, 'Juan Doe', 'jdoe', 'juan@doe.com', '$2y$10$ZBE.cUR3kaJVdqjCFvnLROWFxC80GVZPnHTqbn8Y17qlpulR0Ej2.', '', '', '../estiloscss/imagenes/fotosperfil/66ce4c0a408c3.jpg'),
(12, 'juan do', 'jdoe', 'juan@doe.com', '$2y$10$2TtCf2pA1HBJDY/krUlUJuJ8b49xmP8Gktl5.eGHPWM1wMhhrEfIi', '', '', ''),
(14, 'luciano', 'luciano', 'luciano@gmail.com', '$2y$10$XdkUQobCiUuWNw.shSECtOx68zPqJpquSueOAwPa4jxDnP2M5Lhd6', 'panolero', '', '');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`id_aulas`);

--
-- Indices de la tabla `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `herramientas`
--
ALTER TABLE `herramientas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `paletas`
--
ALTER TABLE `paletas`
  ADD PRIMARY KEY (`id_paletas`),
  ADD KEY `fk_usuario` (`fk_usuario`),
  ADD KEY `fk_usuario_2` (`fk_usuario`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`id_pedido`),
  ADD KEY `usuario_solicitante` (`fk_usuario`),
  ADD KEY `id_aula` (`id_aula`),
  ADD KEY `fk_pedidos_curso` (`fk_curso`);

--
-- Indices de la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_usuario` (`id_usuario`,`id_pedido`);

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
  MODIFY `id_aulas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `herramientas`
--
ALTER TABLE `herramientas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `paletas`
--
ALTER TABLE `paletas`
  MODIFY `id_paletas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de la tabla `reportes`
--
ALTER TABLE `reportes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `paletas`
--
ALTER TABLE `paletas`
  ADD CONSTRAINT `paletas_ibfk_1` FOREIGN KEY (`fk_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_pedidos_aula` FOREIGN KEY (`id_aula`) REFERENCES `aulas` (`id_aulas`),
  ADD CONSTRAINT `fk_pedidos_curso` FOREIGN KEY (`fk_curso`) REFERENCES `cursos` (`id`),
  ADD CONSTRAINT `fk_pedidos_usuario` FOREIGN KEY (`fk_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Filtros para la tabla `reportes`
--
ALTER TABLE `reportes`
  ADD CONSTRAINT `fk_reportes_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
