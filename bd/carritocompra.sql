-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-07-2020 a las 05:39:47
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `carritocompra`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(10) NOT NULL,
  `name` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `precio` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `imagen` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `name`, `precio`, `imagen`) VALUES
(11, 'Nevera', '12000000', 'fotos/nevera.jpg'),
(12, 'Chery Arauca', '132000000', 'fotos/chery.jpg'),
(13, 'Bicleta', '500000', 'fotos/bici.jpg'),
(14, 'TV', '850000', 'fotos/tv.jpg'),
(15, 'Zapato', '50000', 'fotos/zapato.jpg'),
(16, 'Moto TX', '15000000', 'fotos/moto.jpg'),
(17, 'Lapto HP', '950000', 'fotos/lapto.png'),
(18, 'Buzo', '45000', 'fotos/buzo.jpg'),
(19, 'Cartera', '145000', 'fotos/cartera.jpg'),
(20, 'Pantalon Corto', '35000', 'fotos/pantaloncorto.jpg'),
(21, 'Short', '55000', 'fotos/short.jpg'),
(22, 'Patin', '85000', 'fotos/patines.jpg');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `temporalproducts`
--

CREATE TABLE `temporalproducts` (
  `id` int(10) NOT NULL,
  `idproduct` int(100) DEFAULT NULL,
  `cantidad` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cod_user` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL,
  `ip` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `name_equipo` varchar(100) COLLATE utf8_spanish_ci DEFAULT NULL,
  `fecha` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `temporalproducts`
--

INSERT INTO `temporalproducts` (`id`, `idproduct`, `cantidad`, `cod_user`, `ip`, `name_equipo`, `fecha`) VALUES
(165, 20, '2', '002um', '::1', 'DeveloperUrian', '28-07-2020'),
(169, 15, '1', '002um', '::1', 'DeveloperUrian', '28-07-2020'),
(172, 22, '1', '001zy', '::1', 'DeveloperUrian', '28-07-2020'),
(173, 21, '1', '002um', '::1', 'DeveloperUrian', '28-07-2020');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `user` varchar(50) COLLATE utf8_spanish_ci DEFAULT NULL,
  `pass` varchar(10) COLLATE utf8_spanish_ci DEFAULT NULL,
  `cod_user` varchar(20) COLLATE utf8_spanish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `user`, `pass`, `cod_user`) VALUES
(1, 'uriany', '123', '001zy'),
(2, 'urian', '123', '002um');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `temporalproducts`
--
ALTER TABLE `temporalproducts`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de la tabla `temporalproducts`
--
ALTER TABLE `temporalproducts`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=174;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
