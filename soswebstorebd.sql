-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-02-2019 a las 14:09:14
-- Versión del servidor: 10.1.32-MariaDB
-- Versión de PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `soswebstore`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clasificacion`
--

CREATE TABLE `clasificacion` (
  `usuario` int(20) NOT NULL,
  `tipo_usuario` int(20) NOT NULL,
  `sku` varchar(2000) COLLATE utf8_spanish2_ci NOT NULL,
  `clasificacion` int(20) NOT NULL,
  `fecha` varchar(200) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuentos`
--

CREATE TABLE `descuentos` (
  `id` int(20) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(2000) COLLATE utf8_spanish2_ci NOT NULL,
  `tipo_descuento` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `regla_visitantes` decimal(20,0) NOT NULL,
  `regla_usuarios` decimal(20,0) NOT NULL,
  `regla_empresas` decimal(20,0) NOT NULL,
  `inicio` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `vencimiento` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `descuentos`
--

INSERT INTO `descuentos` (`id`, `nombre`, `descripcion`, `tipo_descuento`, `regla_visitantes`, `regla_usuarios`, `regla_empresas`, `inicio`, `vencimiento`) VALUES
(2, 'aasdf', '', 'porcentaje', '12', '13', '14', '2019-02-15', '2019-02-15');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuentos_relaciones`
--

CREATE TABLE `descuentos_relaciones` (
  `id_descuento` int(20) NOT NULL,
  `item` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `tipo` varchar(200) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `descuentos_relaciones`
--

INSERT INTO `descuentos_relaciones` (`id_descuento`, `item`, `tipo`) VALUES
(2, '6', 'marca'),
(2, '3', 'marca'),
(2, '5', 'marca');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `galerias`
--

CREATE TABLE `galerias` (
  `producto` varchar(2000) COLLATE utf8_spanish2_ci NOT NULL,
  `medio` int(20) NOT NULL,
  `orden` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `galerias`
--

INSERT INTO `galerias` (`producto`, `medio`, `orden`) VALUES
('Prueba', 1, NULL),
('dasfasdf', 2, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `medios`
--

CREATE TABLE `medios` (
  `id` int(20) NOT NULL,
  `titulo` varchar(2000) COLLATE utf8_spanish2_ci NOT NULL,
  `url` varchar(2000) COLLATE utf8_spanish2_ci NOT NULL,
  `fecha` varchar(200) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `medios`
--

INSERT INTO `medios` (`id`, `titulo`, `url`, `fecha`) VALUES
(1, 'Medio', 'http://localhost/sosadmin/productos/5606.jpg', '15/02/2019'),
(2, 'Prueba 2', 'http://localhost/sosadmin/productos/pos.jpg', '18/02/2019'),
(3, 'Claro', 'http://localhost/sosadmin/productos/claro.jpg', '18/02/2019'),
(4, 'Oscuro', 'http://localhost/sosadmin/productos/oscuro.png', '18/02/2019');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `sku` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `nombre` varchar(2000) COLLATE utf8_spanish2_ci NOT NULL,
  `slug` varchar(2000) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish2_ci,
  `mpn` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fabricante` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `tipo` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `nuevo` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `precio` decimal(11,0) NOT NULL,
  `stock` int(20) DEFAULT NULL,
  `oferta` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
  `fecha` varchar(20) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`sku`, `nombre`, `slug`, `descripcion`, `mpn`, `fabricante`, `tipo`, `nuevo`, `precio`, `stock`, `oferta`, `fecha`) VALUES
('asdf', '213', '213', 'asdfsadf', '', '', '', 'no', '12', 0, 'no', '2019/02/15 23:22:16'),
('dasfasdf', '213123', '213123', 'asdfas', '', '', '', 'no', '11', 0, 'no', '2019/02/18 22:25:46'),
('Prueba', 'adsf', 'adsf', 'asdf', '', '', '', 'no', '12', 0, 'no', '2019/02/15 22:54:38'),
('Sin', 'SIn', 'sin', '', '', '', '', 'no', '0', 0, 'no', '2019/02/15 22:56:24');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reglas`
--

CREATE TABLE `reglas` (
  `id_categoria` int(20) NOT NULL,
  `regla_visitantes` int(20) NOT NULL,
  `regla_usuarios` int(20) NOT NULL,
  `regla_empresas` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `reglas`
--

INSERT INTO `reglas` (`id_categoria`, `regla_visitantes`, `regla_usuarios`, `regla_empresas`) VALUES
(7, 0, 0, 0),
(10, 12, 13, 14),
(13, 0, 0, 0),
(14, 0, 0, 0),
(15, 0, 0, 0),
(16, 0, 0, 0),
(17, 0, 0, 0),
(18, 0, 0, 0),
(19, 0, 0, 0),
(20, 0, 0, 0),
(33, 0, 0, 0),
(35, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `relaciones`
--

CREATE TABLE `relaciones` (
  `sku` varchar(2000) COLLATE utf8_spanish2_ci NOT NULL,
  `id_taxonomia` int(20) NOT NULL,
  `orden` int(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `relaciones`
--

INSERT INTO `relaciones` (`sku`, `id_taxonomia`, `orden`) VALUES
('Prueba', 7, NULL),
('Prueba', 6, NULL),
('Sin', 7, NULL),
('asdf', 7, NULL),
('dasfasdf', 10, NULL),
('dasfasdf', 6, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `taxonomias`
--

CREATE TABLE `taxonomias` (
  `id` int(20) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `slug` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `taxonomia` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` text COLLATE utf8_spanish2_ci,
  `padre` int(20) DEFAULT NULL,
  `icono` int(20) DEFAULT NULL,
  `icono2` int(20) NOT NULL,
  `color` varchar(200) COLLATE utf8_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `taxonomias`
--

INSERT INTO `taxonomias` (`id`, `nombre`, `slug`, `taxonomia`, `descripcion`, `padre`, `icono`, `icono2`, `color`) VALUES
(3, 'HP', 'hp', 'marca', '', NULL, 0, 0, NULL),
(5, 'MSI', 'msi', 'marca', '', NULL, 0, 0, NULL),
(6, 'FULL', 'full', 'marca', 'Full', NULL, 1, 0, NULL),
(7, 'Cat', 'cat', 'categoria', 'Nueva descripcion 2', 0, 1, 3, NULL),
(8, 'Marca con dos iconos', 'marca-con-dos-iconos', 'marca', '', NULL, 1, 1, NULL),
(9, 'Prueba 2 imgs', 'prueba-2-imgs', 'marca', '', NULL, 2, 2, NULL),
(10, 'Prueba con imgs', 'prueba-con-imgs', 'categoria', '', 7, 2, 4, NULL),
(11, 'Marca con color', 'marca-con-color', 'marca', 'Desc', NULL, 1, 1, '1762D2'),
(12, 'a', 'a', 'etiqueta', '', NULL, NULL, 0, NULL),
(13, 'a', 'a', 'categoria', '', 0, 0, 0, NULL),
(14, 'av', 'av', 'categoria', '', 0, 0, 0, NULL),
(15, 'Prueba', 'prueba', 'categoria', '', 0, 0, 0, NULL),
(16, 'Coca', 'coca', 'categoria', '', 0, 0, 0, NULL),
(17, 'Categoria con vista', 'categoria-con-vista', 'categoria', '', 0, 0, 0, NULL),
(18, 'Prueba2', 'prueba2', 'categoria', '', 0, 0, 0, NULL),
(19, 'Prueba2', 'prueba2a', 'categoria', '', 0, 0, 0, NULL),
(20, 'Prueba2asdf', 'prueba2asdf', 'categoria', '', 0, 0, 0, NULL),
(21, 'Marca con todo', 'marca-con-todo', 'marca', '', NULL, 0, 0, '834040'),
(22, 'Marca con todo 2', 'marca-con-todo-2', 'marca', '', NULL, 0, 0, '834040'),
(23, 'Pru', 'pru', 'marca', '', NULL, 0, 0, '2AFF63'),
(24, 'ASD', 'asd', 'marca', 'A', NULL, 0, 0, 'FFFFFF'),
(25, 'asdfasdfasdf', 'asdfasdfasdf', 'marca', '', NULL, 0, 0, 'FFFFFF'),
(26, 'Nueva', 'nueva', 'marca', '', NULL, 0, 0, '3EFF0E'),
(27, 'Ultima', 'ultima', 'marca', '', NULL, 0, 0, 'FFFFFF'),
(28, 'Pruebisima', 'pruebisima', 'marca', '', NULL, 0, 0, 'FFFFFF'),
(29, 'Marca', 'marca', 'marca', '', NULL, 1, 3, '194FFF'),
(30, 'A', 'a', 'marca', '', NULL, 0, 0, 'FFFFFF'),
(31, 'Facebook', 'facebook', 'marca', '', NULL, 1, 3, '6D23FF'),
(32, 'Banner', 'banner', 'marca', '', NULL, 0, 0, 'FFFFFF'),
(33, 'CATO', 'cato', 'categoria', '', 0, 0, 0, NULL),
(34, 'ASDF', 'asdf', 'marca', '', NULL, 0, 0, '44F3FF'),
(35, 'ASDFQWER', 'asdfqwer', 'categoria', '', 0, 0, 0, NULL),
(36, 'Marcota', 'marcota', 'marca', '', NULL, 0, 0, 'FFFFFF');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(20) NOT NULL,
  `nombre` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `apellido` varchar(200) COLLATE utf8_spanish2_ci NOT NULL,
  `usuario` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `clave` varchar(10000) COLLATE utf8_spanish2_ci NOT NULL,
  `correo` varchar(500) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `nombre`, `apellido`, `usuario`, `clave`, `correo`) VALUES
(1, 'Super', 'Admin', 'admin', 'dDFaWHVLaFVxTFlUTEtKb2lreTdWQT09', 'jose@aplitic.com.gt');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vistas_personalizadas`
--

CREATE TABLE `vistas_personalizadas` (
  `id_taxonomia` int(20) NOT NULL,
  `slides` longtext COLLATE utf8_spanish2_ci NOT NULL,
  `columnas` longtext COLLATE utf8_spanish2_ci NOT NULL,
  `banner` longtext COLLATE utf8_spanish2_ci NOT NULL,
  `marcas` longtext COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `vistas_personalizadas`
--

INSERT INTO `vistas_personalizadas` (`id_taxonomia`, `slides`, `columnas`, `banner`, `marcas`) VALUES
(17, 'Array', 'Array', 'Array', 'Array'),
(18, 'Array', 'Array', 'Array', '6'),
(20, '[{\"url\":\"http:\\/\\/localhost\\/sosadmin\\/nueva-categoria\\/\",\"img\":\"1\"}]', '[{\"url\":\"http:\\/\\/localhost\\/sosadmin\\/nueva-categoria\\/\",\"img\":\"1\"}]', '[{\"url\":\"http:\\/\\/localhost\\/sosadmin\\/nueva-categoria\\/\",\"img\":\"1\"}]', '[\"6\"]'),
(24, '[{\"url\":\"http:\\/\\/localhost\\/sosadmin\\/nueva-marca\\/\",\"img\":\"1\"}]', '[{\"url\":\"http:\\/\\/localhost\\/sosadmin\\/nueva-marca\\/\",\"img\":\"1\"}]', '[]', ''),
(25, '[{\"url\":\"http:\\/\\/localhost\\/sosadmin\\/nueva-marca\\/\",\"img\":\"2\"}]', '[{\"url\":\"http:\\/\\/localhost\\/sosadmin\\/nueva-marca\\/\",\"img\":\"2\"}]', '[]', ''),
(26, '[{\"url\":\"http:\\/\\/localhost\\/sosadmin\\/nueva-marca\\/\",\"img\":\"1\"}]', '[]', '[]', ''),
(29, '[{\"url\":\"http:\\/\\/localhost\\/sosadmin\\/nueva-marca\\/\",\"img\":\"3\"},{\"url\":\"http:\\/\\/localhost\\/sosadmin\\/nueva-marca\\/\",\"img\":\"3\"}]', '[{\"url\":\"http:\\/\\/localhost\\/sosadmin\\/nueva-marca\\/\",\"img\":\"2\"},{\"url\":\"http:\\/\\/localhost\\/sosadmin\\/nueva-marca\\/\",\"img\":\"4\"}]', '[]', ''),
(31, '[{\"url\":\"http:\\/\\/localhost\\/sosadmin\\/nueva-marca\\/\",\"img\":\"1\"}]', '[]', '[]', ''),
(32, '[{\"url\":\"http:\\/\\/localhost\\/sosadmin\\/nueva-marca\\/\",\"img\":\"1\"}]', '[]', 'true', ''),
(33, '[{\"url\":\"http:\\/\\/localhost\\/sosadmin\\/nueva-categoria\\/\",\"img\":\"1\"}]', '[{\"url\":\"http:\\/\\/localhost\\/sosadmin\\/nueva-categoria\\/\",\"img\":\"1\"}]', '[{\"url\":\"http:\\/\\/localhost\\/sosadmin\\/nueva-categoria\\/\",\"img\":\"1\"}]', '[\"30\",\"24\"]'),
(34, '[]', '[]', '[{\"url\":\"http:\\/\\/localhost\\/sosadmin\\/nueva-marca\\/\",\"img\":\"1\"}]', ''),
(35, '[{\"url\":\"\",\"img\":\"1\"}]', '[]', '[]', '[]');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `medios`
--
ALTER TABLE `medios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`sku`);

--
-- Indices de la tabla `reglas`
--
ALTER TABLE `reglas`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indices de la tabla `taxonomias`
--
ALTER TABLE `taxonomias`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `descuentos`
--
ALTER TABLE `descuentos`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `medios`
--
ALTER TABLE `medios`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `taxonomias`
--
ALTER TABLE `taxonomias`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
