-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-09-2024 a las 00:31:23
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
(11, 'Destornillador Phillips', 'Herramienta con punta en forma de cruz para atornillar tornillos con ranuras cruzadas.', './imagenes/herramientas/66d4dec01a407.jpeg', 20),
(12, 'Destornillador Plano', 'Herramienta con punta plana para atornillar tornillos con ranura recta.', './imagenes/herramientas/66d4dee4993f5.jpeg', 18),
(13, 'Escofina', 'Herramienta abrasiva con una superficie rugosa para desbastar y dar forma a materiales.', './imagenes/herramientas/66d4def38fb8e.jpeg', 11),
(14, 'Formón', 'Cuchillo de corte con mango y hoja ancha para tallar y esculpir madera.', './imagenes/herramientas/66d4df0dbb2e1.jpeg', 3),
(15, 'Lima circular', 'Herramienta de forma redonda con superficie abrasiva para dar forma a materiales curvos.', './imagenes/herramientas/66d4df215beee.jpeg', 8),
(16, 'Lima cuadrada', 'Lima con sección cuadrada, ideal para trabajar ángulos y superficies planas.', './imagenes/herramientas/66d4df46e2c9d.jpeg', 7),
(17, 'Lima triangular', 'Lima con sección triangular para detalles y ángulos agudos en materiales.', './imagenes/herramientas/66d4df5a442bd.jpeg', 17),
(18, 'Martillo', 'Herramienta con cabeza pesada y mango para golpear y clavar objetos.', './imagenes/herramientas/66d4df68e8626.jpeg', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paletas`
--

CREATE TABLE `paletas` (
  `id_paletas` int(11) NOT NULL,
  `colores` longtext NOT NULL,
  `fk_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `paletas`
--

INSERT INTO `paletas` (`id_paletas`, `colores`, `fk_usuario`) VALUES
(1, '{\"azul\":\"#00fbff\",\"amarillo\":\"#caee52\",\"blanco\":\"#ffffff\",\"negro\":\"#202427\"}', 27),
(2, '{\"azul\":\"#4139e6\",\"amarillo\":\"#caee52\",\"blanco\":\"#ffffff\",\"negro\":\"#202427\"}', 27),
(3, '{\"azul\":\"#ff0000\",\"amarillo\":\"#caee52\",\"blanco\":\"#ffffff\",\"negro\":\"#202427\"}', 27),
(4, '{\"azul\":\"#4139e6\",\"amarillo\":\"#ee537a\",\"blanco\":\"#ffffff\",\"negro\":\"#202427\"}', 27),
(5, '{\"azul\":\"#ffffff\",\"amarillo\":\"#ffffff\",\"blanco\":\"#ffffff\",\"negro\":\"#ffffff\"}', 27),
(6, '{\"azul\":\"#db37e6\",\"amarillo\":\"#6dee53\",\"blanco\":\"#ffffff\",\"negro\":\"#202427\"}', 27),
(7, '{\"azul\":\"#e63737\",\"amarillo\":\"#caee52\",\"blanco\":\"#ffffff\",\"negro\":\"#202427\"}', 27),
(8, '{\"azul\":\"#4139e6\",\"amarillo\":\"#caee52\",\"blanco\":\"#ffffff\",\"negro\":\"#202427\"}', 27),
(9, '{\"azul\":\"#000000\",\"amarillo\":\"#caee52\",\"blanco\":\"#ffffff\",\"negro\":\"#202427\"}', 27),
(10, '{\"azul\":\"#4139e6\",\"amarillo\":\"#caee52\",\"blanco\":\"#ffffff\",\"negro\":\"#ffffff\"}', 27),
(11, '{\"azul\":\"#4139e6\",\"amarillo\":\"#caee52\",\"blanco\":\"#ffffff\",\"negro\":\"#202427\"}', 27);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `id_pedido` int(11) NOT NULL,
  `fecha_pedido` date NOT NULL,
  `fk_usuario` int(11) NOT NULL,
  `id_aula` int(11) NOT NULL,
  `estado` enum('Pendiente','En proceso','Enviado','Entregado','Devuelto','Cancelado') NOT NULL,
  `observaciones` varchar(200) NOT NULL,
  `pedido` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`pedido`)),
  `fk_curso` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`id_pedido`, `fecha_pedido`, `fk_usuario`, `id_aula`, `estado`, `observaciones`, `pedido`, `fk_curso`) VALUES
(35, '2024-09-11', 27, 6, 'Entregado', '', '{\"herramientas\":[12],\"cantidad\":[3]}', 5),
(36, '2024-09-11', 27, 12, 'Pendiente', '', '{\"herramientas\":[16],\"cantidad\":[3]}', 8),
(37, '2024-09-13', 28, 4, 'Pendiente', '', '{\"herramientas\":[14],\"cantidad\":[3]}', 7),
(38, '2024-09-16', 28, 20, 'Pendiente', '', '{\"herramientas\":[18],\"cantidad\":[5]}', 3);

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
(8, 27, 35, 'Martillo con punta rota');

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
  `horario` varchar(20) DEFAULT NULL,
  `fotoperfil` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nombre_completo`, `username`, `correo`, `contrasena`, `cargo`, `horario`, `fotoperfil`) VALUES
(27, 'Matias De Santo', 'matiasds', 'matias@desanto.com', '$2y$10$Sjy3NVXgLpZxjAY.75JVD.VsHkSoprb/oRniRl8a9QClZjndDst7q', 'encargado_panol', '', './imagenes/fotosperfil/66e0bb75d1415.png'),
(28, 'Javier W', 'JaviW', 'javier@panol.com', '$2y$10$uQzlDLISF2hXpfr2w4gM/uP4kFWmkaR.Jw4zXrD.UC8ThRWCihWH2', 'panolero', '7:45 a 11.55', './imagenes/fotosperfil/66e0bc4bef0d2.png');

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
  ADD KEY `fk_usuario` (`fk_usuario`);

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
  ADD KEY `id_usuario` (`id_usuario`,`id_pedido`),
  ADD KEY `id_pedido` (`id_pedido`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de la tabla `paletas`
--
ALTER TABLE `paletas`
  MODIFY `id_paletas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `id_pedido` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT de la tabla `reportes`
--
ALTER TABLE `reportes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

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
  ADD CONSTRAINT `fk_reportes_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`),
  ADD CONSTRAINT `reportes_ibfk_1` FOREIGN KEY (`id_pedido`) REFERENCES `pedidos` (`id_pedido`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
