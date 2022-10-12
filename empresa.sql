-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-10-2022 a las 06:22:14
-- Versión del servidor: 10.4.24-MariaDB
-- Versión de PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `empresa`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(11) NOT NULL,
  `nombre` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `clave` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `back_color` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `icono` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `fecha_creado` datetime NOT NULL,
  `estatus` smallint(6) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre`, `clave`, `back_color`, `icono`, `color`, `fecha_creado`, `estatus`) VALUES
(1, 'Producción', '', '#0000b8', 'fa-gears', '#fff', '2022-07-17 19:28:30', 1),
(2, 'Administrativo', '', '#e30000', 'fa-school', '#fff', '2022-07-17 19:30:30', 1),
(3, 'Salud', '', '#00c7ff', 'fa-bandage', '#000', '2022-07-17 19:30:30', 1),
(4, 'Inducción', '', '', 'fa-book-open', '', '2022-07-17 19:34:30', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `posts`
--

CREATE TABLE `posts` (
  `id_post` int(11) NOT NULL,
  `titulo` varchar(150) NOT NULL,
  `contenido` text NOT NULL,
  `imagen` text NOT NULL,
  `fecha_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_inicio` datetime NOT NULL,
  `fecha_fin` datetime DEFAULT NULL,
  `estatus` int(11) NOT NULL DEFAULT 1,
  `autor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `posts`
--

INSERT INTO `posts` (`id_post`, `titulo`, `contenido`, `imagen`, `fecha_registro`, `fecha_inicio`, `fecha_fin`, `estatus`, `autor`) VALUES
(1, 'Este seria un titulo largo de un post', 'Este sería un contenido mas correcto y editado', 'c4ca4238a0b923820dcc509a6f75849b.jpg', '2022-09-16 07:46:38', '2022-09-14 00:00:00', '2022-09-17 00:00:00', 1, 1),
(2, 'Este también seria un titulo largo de un post', 'contenido nuevo y editado', 'c81e728d9d4c2f636f067f89cc14862c.jpg', '2022-09-17 21:50:11', '2022-09-17 00:00:00', '2022-09-18 00:00:00', 1, 1),
(3, 'Nuevo elemento para mostrar', 'Contenido escrito en panel t', 'eccbc87e4b5ce2fe28308fd9f2a7baf3.jpg', '2022-09-28 09:49:46', '2022-09-26 09:49:00', '2022-09-30 09:49:00', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `post_categorias`
--

CREATE TABLE `post_categorias` (
  `id_post` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `fecha_asignacion` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `post_categorias`
--

INSERT INTO `post_categorias` (`id_post`, `id_categoria`, `fecha_asignacion`) VALUES
(1, 2, '2022-09-24 21:05:16'),
(1, 3, '2022-10-11 22:16:10'),
(1, 4, '2022-10-11 22:24:46'),
(1, 1, '2022-10-11 22:25:22'),
(2, 1, '2022-10-11 22:25:30'),
(2, 4, '2022-10-11 22:25:31'),
(3, 1, '2022-10-11 22:25:39'),
(3, 3, '2022-10-11 22:25:39'),
(3, 4, '2022-10-11 22:25:39');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `username` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `nombre` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `paterno` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `materno` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `correo` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `telefono` text COLLATE utf8_unicode_ci NOT NULL COMMENT 'se guardaran como json',
  `id_categoria` int(11) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  `contrasenia` varbinary(255) NOT NULL,
  `fecha_creado` datetime NOT NULL DEFAULT current_timestamp(),
  `fecha_actualizacion` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `username`, `nombre`, `paterno`, `materno`, `correo`, `telefono`, `id_categoria`, `id_rol`, `contrasenia`, `fecha_creado`, `fecha_actualizacion`) VALUES
(1, 'chuypajaro', 'Jesus', 'Pajaro', 'Cruz', 'pajaro.octavio96@gmail.com', '[\"2222090020\"]', NULL, NULL, 0xc29953b7bfaaee3fb2572e95502846d1, '2022-08-18 23:02:54', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_categorias`
--

CREATE TABLE `usuario_categorias` (
  `id_usuario` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `fecha_asignacion` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id_post`),
  ADD KEY `fk_id_usuario` (`autor`);

--
-- Indices de la tabla `post_categorias`
--
ALTER TABLE `post_categorias`
  ADD KEY `fk_id_post_categoria` (`id_post`),
  ADD KEY `fk_id_post` (`id_categoria`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `fk_categoria` (`id_categoria`),
  ADD KEY `fk_id_rol` (`id_rol`);

--
-- Indices de la tabla `usuario_categorias`
--
ALTER TABLE `usuario_categorias`
  ADD KEY `fk_id_usuario` (`id_usuario`),
  ADD KEY `fk_categoria` (`id_categoria`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `posts`
--
ALTER TABLE `posts`
  MODIFY `id_post` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `post_categorias`
--
ALTER TABLE `post_categorias`
  ADD CONSTRAINT `post_categorias_ibfk_1` FOREIGN KEY (`id_post`) REFERENCES `posts` (`id_post`),
  ADD CONSTRAINT `post_categorias_ibfk_2` FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id_categoria`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
