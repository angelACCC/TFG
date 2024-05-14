-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-05-2024 a las 17:46:50
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tiendawiki`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `codCat` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`codCat`, `nombre`, `descripcion`) VALUES
(1, 'Ropa', 'Prendas de vestir de One Piece, como camisas, sudaderas, pantalones, etc.'),
(2, 'Calzado', 'Calzado inspirado en One Piece, como zapatos y zapatillas.'),
(3, 'Accesorios', 'Accesorios relacionados con One Piece, como sombreros, collares, pulseras, etc.'),
(4, 'Figuras de Acción y Coleccionables', 'Figuras de acción y otros coleccionables de personajes de One Piece.'),
(5, 'Novelas y Mangas de Lectura', 'Novelas, Mangas y otros materiales de lectura relacionados con One Piece.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `comment_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `categoria` enum('personajes','lugares','crews','barcos','armas','frutas','diaals','hakis') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `comment_text`, `comment_time`, `categoria`) VALUES
(1, 1, 'awef', '2024-05-09 19:00:06', ''),
(2, 1, 'awefs', '2024-05-09 19:00:10', ''),
(3, 1, 'fgsd', '2024-05-09 19:00:24', ''),
(4, 1, 'asef', '2024-05-09 19:01:09', ''),
(5, 1, 'dfggsdrg ', '2024-05-09 19:11:00', ''),
(6, 1, 'hola', '2024-05-09 19:13:35', ''),
(7, 1, 'hola de nuevo\\r\\n', '2024-05-09 19:13:50', ''),
(8, 1, 'hola como esta la gente\\r\\ntodo bien?', '2024-05-09 19:14:27', ''),
(9, 1, 'afs', '2024-05-09 19:14:39', ''),
(10, 1, 'asdfasdf', '2024-05-09 19:18:50', ''),
(11, 1, 'jajajajjaja', '2024-05-09 19:18:56', ''),
(12, 1, 'jajajajjaja', '2024-05-09 19:19:26', ''),
(13, 1, 'jejejejejeje', '2024-05-09 19:19:32', ''),
(14, 1, 'jijijijij', '2024-05-09 19:33:51', 'personajes'),
(15, 1, 'fffff', '2024-05-09 19:36:09', 'personajes'),
(16, 1, 'gggg', '2024-05-09 19:39:14', 'personajes'),
(19, 1, 'waef', '2024-05-11 10:01:54', 'personajes'),
(20, 1, 'waef', '2024-05-11 10:05:22', 'personajes'),
(21, 1, 'weftgh', '2024-05-11 10:05:30', 'lugares');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos`
--

CREATE TABLE `pedidos` (
  `codPed` int(11) NOT NULL,
  `ped_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `enviado` tinyint(1) NOT NULL,
  `iduser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidos`
--

INSERT INTO `pedidos` (`codPed`, `ped_time`, `enviado`, `iduser`) VALUES
(1, '2024-05-12 22:00:00', 1, 1),
(2, '2024-05-12 22:00:00', 1, 1),
(3, '2024-05-12 22:00:00', 1, 1),
(4, '2024-05-12 22:00:00', 1, 1),
(5, '2024-05-12 22:00:00', 1, 1),
(6, '2024-05-12 22:00:00', 1, 1),
(7, '2024-05-12 22:00:00', 1, 1),
(8, '2024-05-12 22:00:00', 1, 1),
(9, '2024-05-12 22:00:00', 1, 1),
(10, '2024-05-12 22:00:00', 1, 1),
(11, '2024-05-12 22:00:00', 1, 1),
(12, '2024-05-12 22:00:00', 1, 1),
(13, '2024-05-12 22:00:00', 1, 1),
(14, '2024-05-12 22:00:00', 1, 1),
(15, '2024-05-12 22:00:00', 1, 1),
(16, '2024-05-12 22:00:00', 1, 1),
(17, '2024-05-13 22:00:00', 1, 1),
(18, '2024-05-13 22:00:00', 1, 1),
(19, '2024-05-13 22:00:00', 1, 1),
(20, '2024-05-13 22:00:00', 1, 1),
(21, '2024-05-13 22:00:00', 1, 1),
(22, '2024-05-13 22:00:00', 1, 1),
(23, '2024-05-13 22:00:00', 1, 1),
(24, '2024-05-13 22:00:00', 1, 1),
(25, '2024-05-13 22:00:00', 1, 1),
(26, '2024-05-13 22:00:00', 1, 1),
(27, '2024-05-13 22:00:00', 1, 1),
(28, '2024-05-13 22:00:00', 1, 1),
(29, '2024-05-13 22:00:00', 1, 1),
(30, '2024-05-13 22:00:00', 1, 1),
(31, '2024-05-13 22:00:00', 1, 1),
(32, '2024-05-13 22:00:00', 1, 1),
(33, '2024-05-13 22:00:00', 1, 1),
(34, '2024-05-13 22:00:00', 1, 1),
(35, '2024-05-13 22:00:00', 1, 1),
(36, '2024-05-13 22:00:00', 1, 1),
(37, '2024-05-13 22:00:00', 1, 1),
(38, '2024-05-13 22:00:00', 1, 1),
(39, '2024-05-13 22:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidosproductos`
--

CREATE TABLE `pedidosproductos` (
  `codPedProd` int(11) NOT NULL,
  `pedido` int(11) NOT NULL,
  `producto` int(11) NOT NULL,
  `unidades` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `pedidosproductos`
--

INSERT INTO `pedidosproductos` (`codPedProd`, `pedido`, `producto`, `unidades`) VALUES
(1, 1, 1, 1),
(2, 1, 2, 1),
(3, 2, 1, 1),
(4, 2, 2, 1),
(5, 3, 1, 1),
(6, 3, 2, 1),
(7, 4, 1, 1),
(8, 4, 2, 1),
(9, 6, 1, 1),
(10, 6, 2, 1),
(11, 8, 1, 1),
(12, 8, 2, 1),
(13, 9, 1, 6),
(14, 9, 2, 1),
(15, 10, 1, 6),
(16, 10, 2, 1),
(17, 11, 1, 6),
(18, 11, 2, 1),
(19, 12, 1, 6),
(20, 12, 2, 2),
(21, 15, 1, 7),
(22, 15, 2, 5),
(23, 16, 1, 7),
(24, 16, 2, 5),
(25, 17, 1, 1),
(26, 17, 2, 1),
(27, 17, 3, 1),
(28, 19, 1, 2),
(29, 19, 2, 1),
(30, 19, 3, 1),
(31, 20, 1, 1),
(32, 21, 1, 1),
(33, 21, 4, 1),
(34, 22, 1, 1),
(35, 23, 1, 1),
(36, 24, 1, 1),
(37, 24, 10, 1),
(38, 24, 15, 1),
(39, 25, 1, 1),
(40, 25, 2, 1),
(41, 25, 3, 1),
(42, 25, 4, 1),
(43, 25, 5, 1),
(44, 25, 6, 1),
(45, 25, 7, 1),
(46, 25, 8, 1),
(47, 25, 17, 1),
(48, 25, 18, 1),
(49, 25, 19, 1),
(50, 25, 20, 1),
(51, 25, 13, 1),
(52, 25, 14, 1),
(53, 25, 15, 1),
(54, 25, 16, 1),
(55, 26, 1, 1),
(56, 26, 2, 1),
(57, 26, 3, 1),
(58, 26, 4, 1),
(59, 26, 5, 1),
(60, 26, 6, 1),
(61, 26, 7, 1),
(62, 26, 8, 1),
(63, 26, 9, 1),
(64, 26, 10, 1),
(65, 26, 11, 1),
(66, 26, 12, 1),
(67, 26, 17, 1),
(68, 26, 18, 1),
(69, 26, 19, 1),
(70, 26, 20, 1),
(71, 26, 13, 1),
(72, 26, 14, 1),
(73, 26, 15, 1),
(74, 26, 16, 1),
(75, 27, 1, 1),
(76, 27, 2, 1),
(77, 27, 3, 1),
(78, 27, 4, 1),
(79, 28, 1, 2),
(80, 28, 2, 2),
(81, 28, 3, 1),
(82, 29, 1, 1),
(83, 30, 1, 1),
(84, 31, 2, 1),
(85, 32, 1, 1),
(86, 33, 1, 1),
(87, 34, 5, 1),
(88, 35, 1, 1),
(89, 36, 1, 1),
(90, 37, 1, 1),
(91, 37, 6, 15),
(92, 38, 1, 1),
(93, 38, 6, 15),
(94, 39, 1, 1),
(95, 39, 6, 15);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `codProd` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `descripcion` text NOT NULL,
  `idcategoria` int(11) NOT NULL,
  `imagen` varchar(255) DEFAULT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`codProd`, `nombre`, `descripcion`, `idcategoria`, `imagen`, `cantidad`, `precio`) VALUES
(1, 'Camiseta One Piece', 'Camiseta de manga corta con diseño de One Piece.', 1, NULL, 99, '15.99'),
(2, 'Pantalon Vaquero', 'Pantalon vaquero azul marino con diseño casual.', 1, NULL, 80, '29.99'),
(3, 'Sudadera Estampada', 'Sudadera con capucha y estampado de personajes de One Piece.', 1, NULL, 50, '24.99'),
(4, 'Camiseta larga One Piece', 'Camiseta de manga larga con diseño de One Piece.', 1, NULL, 60, '39.99'),
(5, 'Zapatos de Luffy', 'Zapatos inspirados en el estilo de Luffy, cómodos y resistentes.', 2, NULL, 20, '59.99'),
(6, 'Sandalias de Nami', 'Sandalias elegantes de Nami, perfectas para un día de verano.', 2, NULL, 15, '29.99'),
(7, 'Botas de Zoro', 'Botas de cuero duraderas, ideales para aventuras.', 2, NULL, 25, '69.99'),
(8, 'Zapatillas de Sanji', 'Zapatillas deportivas con el estilo único de Sanji.', 2, NULL, 30, '49.99'),
(9, 'Sombrero de paja de Luffy', 'El icónico sombrero de paja de Luffy, réplica oficial del anime.', 3, NULL, 50, '39.99'),
(10, 'Collar de Nami', 'Collar elegante con el diseño del tatuaje de Nami.', 3, NULL, 30, '19.99'),
(11, 'Pendientes de Zoro', 'Pendientes de acero inoxidable como en el anime.', 3, NULL, 40, '29.99'),
(12, 'Reloj de bolsillo de Sanji', 'Reloj de bolsillo con diseño vintage y emblema de Sanji.', 3, NULL, 20, '49.99'),
(13, 'One Piece: East Blue', 'Manga recopilatorio que narra las aventuras de Luffy en el East Blue.', 5, NULL, 15, '12.99'),
(14, 'One Piece: Grand Line', 'Manga recopilatorio que relata las épicas batallas en la Grand Line.', 5, NULL, 10, '14.99'),
(15, 'One Piece: New World', 'Manga recopilatorio que muestra las aventuras de Luffy después del timeskip.', 5, NULL, 20, '16.99'),
(16, 'One Piece: Artbook', 'Libro de arte con ilustraciones y bocetos de Eiichiro Oda.', 5, NULL, 5, '24.99'),
(17, 'Figura Luffy', 'Figura de acción de Monkey D. Luffy, el protagonista de One Piece.', 4, NULL, 10, '29.99'),
(18, 'Figura Zoro', 'Figura de acción de Roronoa Zoro, espadachín de los Piratas del Sombrero de Paja.', 4, NULL, 8, '27.99'),
(19, 'Figura Nami', 'Figura de acción de Nami, la navegante de los Piratas del Sombrero de Paja.', 4, NULL, 12, '25.99'),
(20, 'Figura Sanji', 'Figura de acción de Sanji, el cocinero de los Piratas del Sombrero de Paja.', 4, NULL, 15, '32.99');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `saldo` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `pass`, `saldo`) VALUES
(1, 'Tisak', 'Tisak@gmail.com', '$2y$10$.ItolnLn1s8mbP40EnFF4.OtHaerifw7TeMXW8iPiDMMAbTZqGCqG', '1389.13'),
(2, 'asdfas', 'asdfas@asdfga', '$2y$10$catf//6NeEHdSUmqXz6YUO9/RXSG7bMaDzAmRLHkXeZAsArN2PH6y', '0.00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`codCat`);

--
-- Indices de la tabla `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indices de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD PRIMARY KEY (`codPed`),
  ADD KEY `fk_iduser` (`iduser`);

--
-- Indices de la tabla `pedidosproductos`
--
ALTER TABLE `pedidosproductos`
  ADD PRIMARY KEY (`codPedProd`),
  ADD KEY `fk_pedido` (`pedido`),
  ADD KEY `fk_producto` (`producto`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`codProd`),
  ADD KEY `idcategoria` (`idcategoria`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `pedidos`
--
ALTER TABLE `pedidos`
  MODIFY `codPed` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT de la tabla `pedidosproductos`
--
ALTER TABLE `pedidosproductos`
  MODIFY `codPedProd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `codProd` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidos`
--
ALTER TABLE `pedidos`
  ADD CONSTRAINT `fk_iduser` FOREIGN KEY (`iduser`) REFERENCES `users` (`id`);

--
-- Filtros para la tabla `pedidosproductos`
--
ALTER TABLE `pedidosproductos`
  ADD CONSTRAINT `fk_pedido` FOREIGN KEY (`pedido`) REFERENCES `pedidos` (`codPed`),
  ADD CONSTRAINT `fk_producto` FOREIGN KEY (`producto`) REFERENCES `productos` (`codProd`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`codCat`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
