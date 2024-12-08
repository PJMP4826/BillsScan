-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 08-12-2024 a las 01:09:28
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
-- Base de datos: `proyecto`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `archivos_recientes`
--

CREATE TABLE `archivos_recientes` (
  `id` int(11) NOT NULL,
  `facturas_move_id` int(255) DEFAULT NULL,
  `fecha_subida` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `archivos_recientes`
--

INSERT INTO `archivos_recientes` (`id`, `facturas_move_id`, `fecha_subida`, `user_id`) VALUES
(72, 259, '2024-04-24 13:59:56', 16),
(73, 260, '2024-04-24 14:02:02', 16),
(74, 261, '2024-05-06 14:04:46', 16),
(75, 262, '2024-05-06 14:06:58', 16),
(76, 263, '2024-05-06 14:09:00', 16),
(80, 267, '2024-06-18 14:26:23', 16),
(85, 272, '2024-08-06 17:11:57', 16),
(88, 275, '2024-08-10 09:01:40', 16),
(90, 277, '2024-08-10 11:37:52', 16),
(92, 279, '2024-08-10 11:48:08', 16),
(93, 280, '2024-08-10 11:48:17', 16),
(94, 281, '2024-08-10 11:49:20', 3),
(98, 285, '2024-08-10 11:52:07', 24),
(99, 286, '2024-08-10 14:59:17', 16),
(100, 287, '2024-08-11 13:03:33', 24),
(101, 288, '2024-08-11 13:10:42', 24),
(106, 293, '2024-08-11 13:26:44', 24),
(107, 294, '2024-08-11 13:28:21', 24),
(108, 295, '2024-08-11 13:31:10', 24),
(109, 296, '2024-08-11 13:47:53', 24),
(110, 297, '2024-05-11 14:29:13', 24),
(111, 298, '2024-08-11 14:29:33', 24),
(113, 300, '2024-08-11 14:38:35', 24),
(114, 301, '2024-08-11 14:39:15', 16),
(115, 302, '2024-08-11 14:56:24', 3),
(116, 303, '2024-08-11 14:57:02', 16),
(117, 304, '2024-08-13 16:00:34', 16),
(118, 305, '2024-08-13 16:01:10', 16),
(120, 307, '2024-08-13 16:35:45', 16),
(121, 308, '2024-08-13 16:39:47', 16),
(122, 309, '2024-08-13 16:41:21', 16),
(123, 310, '2024-08-13 16:41:59', 16),
(131, 318, '2024-08-13 21:31:51', 16),
(134, 321, '2024-08-13 21:47:08', 3),
(135, 322, '2024-08-13 21:47:28', 3),
(136, 323, '2024-08-13 21:47:39', 3),
(143, 330, '2024-08-14 01:16:05', 24),
(148, 335, '2024-08-15 01:40:39', 32),
(149, 336, '2024-08-15 01:40:45', 32),
(150, 337, '2024-08-15 01:40:55', 32),
(151, 338, '2024-08-15 01:41:09', 32),
(152, 339, '2024-08-15 01:41:20', 32),
(153, 340, '2024-08-15 01:43:13', 33),
(154, 341, '2024-08-15 01:43:18', 33),
(155, 342, '2024-08-15 01:43:22', 33),
(156, 343, '2024-08-15 01:43:26', 33),
(157, 344, '2024-08-15 01:43:31', 33),
(158, 345, '2024-08-15 01:43:39', 33),
(159, 346, '2024-08-15 01:43:48', 33),
(160, 347, '2024-08-15 01:43:52', 33),
(161, 348, '2024-08-15 01:43:57', 33),
(162, 349, '2024-08-15 01:44:02', 33),
(163, 350, '2024-10-14 02:19:11', 16),
(164, 351, '2024-10-14 02:46:50', 16),
(165, 352, '2024-10-14 02:48:51', 16),
(166, 353, '2024-10-14 02:51:39', 16),
(167, 354, '2024-10-14 02:57:22', 16),
(168, 355, '2024-10-14 03:00:30', 16),
(169, 356, '2024-10-14 03:01:15', 16),
(170, 357, '2024-10-14 03:04:56', 16),
(171, 358, '2024-10-14 03:07:38', 16),
(172, 359, '2024-10-14 03:11:36', 16),
(173, 360, '2024-10-14 03:14:19', 16),
(174, 361, '2024-10-14 03:15:14', 16),
(175, 362, '2024-10-14 03:17:27', 16),
(176, 363, '2024-10-14 03:20:36', 16),
(177, 364, '2024-10-14 03:22:37', 16),
(178, 365, '2024-10-14 03:25:02', 16),
(179, 366, '2024-10-14 03:26:07', 16),
(180, 367, '2024-10-14 03:30:41', 16),
(181, 368, '2024-10-14 03:31:55', 16),
(182, 369, '2024-10-14 04:34:03', 16),
(183, 370, '2024-10-14 04:35:23', 16),
(184, 371, '2024-10-14 04:36:02', 16),
(185, 372, '2024-10-14 04:36:12', 16),
(193, 380, '2024-10-14 05:12:38', 16),
(194, 381, '2024-10-14 05:14:33', 16),
(195, 382, '2024-10-16 04:32:51', 16),
(196, 383, '2024-10-16 04:33:05', 16),
(197, 384, '2024-10-16 04:33:22', 16),
(198, 385, '2024-10-16 04:51:29', 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cambio`
--

CREATE TABLE `cambio` (
  `id` int(11) NOT NULL,
  `cantidad_cambio` decimal(10,2) DEFAULT NULL,
  `total_compra` decimal(10,2) DEFAULT NULL,
  `facturas_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cambio`
--

INSERT INTO `cambio` (`id`, `cantidad_cambio`, `total_compra`, `facturas_id`) VALUES
(50, 30.00, 300.01, 198),
(51, 0.00, 234.00, 199),
(52, 0.00, 32.00, 200),
(53, 0.00, 45.00, 201),
(54, 30.00, 300.01, 202),
(58, 0.00, 45.00, 206),
(63, 30.00, 300.01, 211),
(66, 0.00, 32.00, 214),
(68, 30.00, 270.01, 216),
(70, 0.00, 45.00, 218),
(71, 40.00, 100.00, 219),
(72, 0.00, 32.00, 220),
(77, 30.00, 300.01, 225),
(78, 30.00, 270.01, 226),
(79, 0.00, 52.50, 227),
(80, 0.00, 32.00, 228),
(82, 30.00, 300.01, 230),
(83, 0.00, 45.00, 231),
(84, 40.05, 100.00, 232),
(87, 30.00, 300.01, 235),
(88, 0.00, 45.00, 236),
(89, 0.00, 0.00, 237),
(91, 0.00, 32.00, 239),
(92, 0.00, 0.00, 240),
(93, 30.00, 300.01, 241),
(94, 303.00, 300.01, 242),
(95, 0.00, 32.00, 243),
(96, 40.00, 59.00, 244),
(99, 0.00, 32.00, 247),
(109, 0.00, 45.00, 257),
(112, 0.00, 19.00, 260),
(113, 0.00, 19.00, 261),
(114, 0.00, 1.00, 262),
(121, 0.00, 45.00, 269),
(126, 0.00, 0.00, 274),
(127, 0.00, 32.00, 275),
(128, 304.00, 510.00, 276),
(129, 40.00, 100.00, 277),
(130, 0.00, 0.00, 278),
(131, 0.00, 0.00, 279),
(132, 40.00, 59.00, 280),
(133, 0.00, 19.00, 281),
(134, 0.00, 45.00, 282),
(135, 0.00, 300.20, 283),
(136, 304.00, 510.00, 284),
(137, 0.00, 722.00, 285),
(138, 0.00, 0.00, 286),
(139, 0.00, 0.00, 287),
(140, 30.00, 300.01, 288),
(141, 0.00, 0.00, 289),
(142, 0.00, 300.20, 290),
(143, 0.00, 300.20, 291),
(144, 0.00, 300.20, 292),
(145, 40.00, 59.00, 293),
(146, 0.00, 300.20, 294),
(147, 0.00, 300.20, 295),
(148, 0.00, 300.20, 296),
(149, 0.00, 300.20, 297),
(150, 0.00, 300.20, 298),
(151, 0.00, 300.20, 299),
(152, 40.00, 100.00, 300),
(153, 40.00, 59.00, 301),
(154, 0.00, 300.20, 302),
(155, 0.00, 300.20, 303),
(156, 0.00, 300.20, 304),
(157, 0.00, 300.20, 305),
(158, 40.00, 59.00, 306),
(159, 40.00, 100.00, 307),
(160, 0.00, 32.00, 308),
(161, 40.00, 100.00, 309),
(162, 40.00, 100.00, 310),
(163, 0.00, 45.00, 311),
(164, 0.00, 32.00, 312),
(172, 40.00, 59.00, 320),
(173, 40.00, 100.00, 321),
(174, 0.00, 300.20, 322),
(175, 0.00, 0.00, 323),
(176, 30.00, 300.01, 324),
(177, 0.00, 0.00, 325);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `emisor`
--

CREATE TABLE `emisor` (
  `id` int(11) NOT NULL,
  `denominacion_social` varchar(255) DEFAULT NULL,
  `cif` varchar(50) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `emisor`
--

INSERT INTO `emisor` (`id`, `denominacion_social`, `cif`, `direccion`) VALUES
(136, 'Walmart', 'No encontrado', 'NUEVA WAL MART DE MEXICO S DE RL DE CV NEXTENGO 78'),
(137, 'SALAMANCA Silvestre', '7777286-C', 'Almirante Cervera, 34 08003 - Barcelona'),
(138, 'SUPER SANCHEZ', 'CSA110614061', 'SUPER 165 SUPER 1A. NANGA 2 (CSA) EJIDO ACARASPÁN '),
(139, 'Liverpool', 'No encontrado', 'POLANCO'),
(140, 'Walmart', 'No encontrado', 'NUEVA WAL MART DE MEXICO S DE RL DE CV NEXTENGO 78'),
(144, 'Liverpool', 'No encontrado', 'POLANCO'),
(149, 'Walmart', 'No encontrado', 'NUEVA WAL MART DE MEXICO S DE RL DE CV NEXTENGO 78'),
(152, 'SUPER SANCHEZ', 'CSA110614061', 'SUPER L65 SUPER LA MANGA 2 (CSA) EJIDO ACACHSAPAN '),
(154, 'Walmart', 'No encontrado', 'No encontrado'),
(156, 'Liverpool', 'No encontrado', 'POLANCO'),
(157, 'ZARA', 'A-15022510', 'Avda. de la Diputación - Ed. Inditex Arteixo - La '),
(158, 'SUPER SANCHEZ', 'CSA110614061', 'SUPER L65 SUPER LA MANGA 2 (CSA) EJIDO ACACHSAPAN '),
(163, 'Walmart', 'No encontrado', 'NUEVA WAL MART DE MEXICO S DE RL DE CV NEXTENGO 78'),
(164, 'Walmart', 'No encontrado', 'NUEVA WAL MART DE MEXICO S DE RL DE CV NEXTENGO 78'),
(165, 'Sephora Cosmeticos España, S.L.', 'B84227461', 'C. C. Gran Vía C/ Literatura 1-3 Poligono Industri'),
(166, 'SUPER SANCHEZ', 'CSA110614061', 'SUPER 165 SUPER 1 A MANGA 2 (CSA) EJIDO ACACHSAPAN'),
(168, 'Walmart', 'No encontrado', 'NUEVA WAL MART DE MEXICO S DE RL DE CV NEXTENGO 78'),
(169, 'Liverpool', 'No encontrado', 'POLANCO'),
(170, 'ZARA', 'A-15022510', 'Avda. de la Diputación - Ed. Inditex Arteixo - La '),
(173, 'Walmart', 'No encontrado', 'NUEVA WAL MART DE MEXICO S DE RL DE CV NEXTENGO 78'),
(174, 'Liverpool', 'No encontrado', 'POLANCO'),
(175, 'Sephora Cosmeticos España, S.L.', 'B84227461', 'C. C. Gran Via C/ Literatura 1-3 Poligono Industri'),
(177, 'SUPER SANCHEZ', 'CSA110614061', 'SUPER 165 SUPER 1A. NANGA 2 (CSA) EJIDO ACACHSAPAN'),
(178, 'Sephora Cosmeticos España, S.L.', 'B84227461', 'C. C. Gran Via C/ Literatura 1-3 Poligono Industri'),
(179, 'Walmart', 'No encontrado', 'NUEVA WAL MART DE MEXICO S DE RL DE CV NEXTENGO 78'),
(180, 'Walmart', 'No encontrado', 'NUEVA WAL MART DE MEXICO S DE RL DE CV NEXTENGO 78'),
(181, 'SUPER SANCHEZ', 'CSA110614061', 'SUPER L65 SUPER LA MANGA 2 (CSA) EJIDO ACACHAPAN Y'),
(182, 'ZARA', 'A-15022510', 'Avda. de la Diputación - Ed. Inditex Arteixo - La '),
(185, 'SUPER SANCHEZ', 'CSA110614061', 'SUPER L65 SUPER LA MANGA 2 (CSA) EJIDO ACACHSAPAN '),
(195, 'Liverpool POLANCO', 'No encontrado', 'No encontrado'),
(198, 'ZARA', 'A-15022510', 'avda de la Diputacion - Fd Inditex Arteixo - La Co'),
(199, 'ZARA', 'A-15022510', 'Avda de la Diputación - Ed. Inditex Arteixo - La C'),
(200, 'ZARA', 'ZMC 960801 538', 'BLVD. JOSE DIEGO VALADEZ RIOS # 1676 COL. TRES RIO'),
(207, 'Liverpool', 'No encontrado', 'POLANCO'),
(212, 'SALAMANCA Silvestre', '7772886-C', 'Almirante Cervera, 34'),
(213, 'SUPER SANCHEZ', 'CSA110614061', 'SUPER 165 SUPER 1A. NANGA 2 (CSA) EJIDO ACACIHUAPA'),
(214, 'MERCADO SORIANA', 'T50991022PB6', 'HERMAN CORTEZ (413)'),
(215, 'ZARA', 'A-15022510', 'Avda. de la Diputación - Ed. Inditex Arteixo - La '),
(216, 'Sephora Cosmeticos España, S.L.', 'B84227461', 'C. Gran Via C/ Literatura 1-3 Poligono Industrial '),
(217, 'ZARA', 'ZMC 960801 538', 'BLVD. JOSE DIEGO VALADEZ RIOS # 1676 COL. TRES RIO'),
(218, 'ZARA', 'A-15022510', 'Avda. de la Diputación - Ed. Inditex Arteixo - La '),
(219, 'ZARA', 'A-15022510', 'Avda de la Diputación - Ed. Inditex Arteixo - La C'),
(220, 'Liverpool', 'No encontrado', 'POLANCO'),
(221, 'Soriana', 'No encontrado', 'No encontrado'),
(222, 'MERCADO SORIANA', 'No encontrado', 'Tiendas Soriana SA De CV TS0991022PB6 ALEJANDRO DE'),
(223, 'Holded SA', 'No encontrado', 'Joan de Borbò, 101'),
(224, 'SALAMANCA Silvestre', '7772886-C', 'Almirante Cervera, 34'),
(225, 'Sephora Cosmeticos España, S.L.', 'B84227461', 'C. C. Gran Vía C/ Literatura 1-3'),
(226, 'Walmart', 'No encontrado', 'NUEVA WAL MART DE MEXICO S DE RL DE CV NEXTENGO 78'),
(227, '', '', ''),
(228, 'Soriana', 'No encontrado', 'No encontrado'),
(229, 'SORIANA', 'No encontrado', 'No encontrado'),
(230, 'Soriana', 'No encontrado', 'No encontrado'),
(231, 'ZARA', 'A-15022510', 'Avda. de la Diputación - Ed. Inditex Arteixo - La '),
(232, 'Soriana', 'No encontrado', 'No encontrado'),
(233, 'Soriana', 'No encontrado', 'No encontrado'),
(234, 'Soriana', 'No encontrado', 'No encontrado'),
(235, 'Soriana', 'No encontrado', 'No encontrado'),
(236, 'Soriana', 'No encontrado', 'No encontrado'),
(237, 'SORIANA', 'No encontrado', 'No encontrado'),
(238, 'ZARA', 'A-15022510', 'Avda. de la Diputación - Ed. Inditex Arteixo - La '),
(239, 'ZARA', 'A-15022510', 'Avda. de la Diputación - Ed. Inditex Arteixo - La '),
(240, 'Soriana', 'No encontrado', 'No encontrado'),
(241, 'Soriana', 'No encontrado', 'No encontrado'),
(242, 'Soriana', 'No encontrado', 'No encontrado'),
(243, 'Soriana', 'No encontrado', 'No encontrado'),
(244, 'ZARA', 'A-15022510', 'Avda. de la Diputación - Ed. Inditex Arteixo - La '),
(245, 'ZARA', 'A-15022510', 'Avda. de la Diputación - Ed. Inditex Arteixo - La '),
(246, 'SUPER SANCHEZ', 'CSA110614061', 'SUPER 165 SUPER 1 A MANGA 2 (CSA) EJIDO ACACHSAPAN'),
(247, 'ZARA', 'A-15022510', 'Avda. de la Diputación - Ed. Inditex Arteixo - La '),
(248, 'ZARA', 'A-15022510', 'Avda. de la Diputación - Ed. Inditex Arteixo - La '),
(249, 'Liverpool', 'No encontrado', 'POLANCO'),
(250, 'SUPER SANCHEZ', 'CSA110614061', 'SUPER L65 SUPER LA MANGA 2 (CSA) EJIDO ACACHAPAN Y'),
(258, 'ZARA', 'A-15022510', 'Avda. de la Diputación - Ed. Inditex Arteixo - La '),
(259, 'ZARA', 'A-15022510', 'Avda. de la Diputación - Ed. Inditex Arteixo - La '),
(260, 'SORIANA', 'No encontrado', 'No encontrado'),
(261, 'SALAMANCA Silvestre', '77772886-C', 'Almirante Cervera, 34 08003 - Barcelona'),
(262, 'Walmart', 'No encontrado', 'NUEVA WAL MART DE MEXICO S DE RL DE CV NEXTENGO 78'),
(263, 'ZARA', 'ZMC 960801 538', 'BLVD. JOSE DIEGO VALADEZ RIOS # 1676 COL. TRES RIO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id` int(11) NOT NULL,
  `fecha_subida` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `numero_factura` varchar(50) DEFAULT NULL,
  `emisor_id` int(11) DEFAULT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id`, `fecha_subida`, `numero_factura`, `emisor_id`, `user_id`) VALUES
(198, '2024-04-24 13:59:56', 'No encontrado', 136, 16),
(199, '2024-04-24 14:02:02', 'TA11380180', 137, 16),
(200, '2024-05-06 14:04:51', 'No encontrado', 138, 16),
(201, '2024-05-06 14:07:02', '00005245', 139, 16),
(202, '2024-05-06 14:09:04', 'No encontrado', 140, 16),
(206, '2024-06-18 14:26:26', '00005245', 144, 16),
(211, '2024-08-06 17:11:57', 'No encontrado', 149, 16),
(214, '2024-08-10 09:01:40', 'No encontrado', 152, 16),
(216, '2024-08-10 11:37:52', 'No encontrado', 154, 16),
(218, '2024-08-10 11:48:08', '00005245', 156, 16),
(219, '2024-08-10 11:48:17', 'No encontrado', 157, 16),
(220, '2024-08-10 11:49:20', 'No encontrado', 158, 3),
(225, '2024-08-10 14:59:17', 'No encontrado', 163, 16),
(226, '2024-08-11 13:03:36', 'No encontrado', 164, 24),
(227, '2024-08-11 13:10:44', 'No encontrado', 165, 24),
(228, '2024-08-11 13:14:19', 'No encontrado', 166, 24),
(230, '2024-08-11 13:20:29', '000119', 168, 24),
(231, '2024-08-11 13:24:38', '00005245', 169, 24),
(232, '2024-08-11 13:26:44', 'No encontrado', 170, 24),
(235, '2024-05-11 13:47:53', 'No encontrado', 173, 24),
(236, '2024-08-11 14:29:13', '00005245', 174, 24),
(237, '2024-08-11 14:29:35', 'No encontrado', 175, 24),
(239, '2024-08-11 14:38:35', 'No encontrado', 177, 24),
(240, '2024-08-11 14:39:15', 'No encontrado', 178, 16),
(241, '2024-08-11 14:56:24', 'No encontrado', 179, 3),
(242, '2024-08-11 14:57:02', 'No encontrado', 180, 16),
(243, '2024-08-13 16:00:38', 'No encontrado', 181, 16),
(244, '2024-08-13 16:01:10', 'No encontrado', 182, 16),
(247, '2024-08-13 16:39:47', 'No encontrado', 185, 16),
(257, '2024-08-13 21:31:53', 'No encontrado', 195, 16),
(260, '2024-08-13 21:47:10', 'No encontrado', 198, 3),
(261, '2024-08-13 21:47:28', 'No encontrado', 199, 3),
(262, '2024-08-13 21:47:42', 'No encontrado', 200, 3),
(269, '2024-08-14 01:16:05', '00005245', 207, 24),
(274, '2024-08-15 01:40:39', 'TA11380180', 212, 32),
(275, '2024-08-15 01:40:45', 'No encontrado', 213, 32),
(276, '2024-08-15 01:40:55', 'No encontrado', 214, 32),
(277, '2024-08-15 01:41:09', '(no encontrado)', 215, 32),
(278, '2024-08-15 01:41:20', 'No encontrado', 216, 32),
(279, '2024-08-15 01:43:13', 'No encontrado', 217, 33),
(280, '2024-08-15 01:43:18', 'No encontrado', 218, 33),
(281, '2024-08-15 01:43:22', 'No encontrado', 219, 33),
(282, '2024-08-15 01:43:26', '00005245', 220, 33),
(283, '2024-08-15 01:43:31', '130931162985', 221, 33),
(284, '2024-08-15 01:43:39', 'No encontrado', 222, 33),
(285, '2024-08-15 01:43:48', 'T190030', 223, 33),
(286, '2024-08-15 01:43:52', 'TA11380180', 224, 33),
(287, '2024-08-15 01:43:57', 'No encontrado', 225, 33),
(288, '2024-08-15 01:44:02', 'No encontrado', 226, 33),
(289, '2024-08-20 02:44:34', '', 227, 16),
(290, '2024-10-14 02:19:11', '15091152785', 228, 16),
(291, '2024-10-14 02:46:51', '15093112795', 229, 16),
(292, '2024-10-14 02:48:51', '1309312295', 230, 16),
(293, '2024-10-14 02:51:39', 'No encontrado', 231, 16),
(294, '2024-10-14 02:57:22', '15093112795', 232, 16),
(295, '2024-10-14 03:00:30', '150991162795', 233, 16),
(296, '2024-10-14 03:01:16', '13093112795', 234, 16),
(297, '2024-10-14 03:04:56', '13093112793', 235, 16),
(298, '2024-10-14 03:07:38', '15091162785', 236, 16),
(299, '2024-10-14 03:11:36', '13093112785', 237, 16),
(300, '2024-10-14 03:14:19', 'No encontrado', 238, 16),
(301, '2024-10-14 03:15:14', 'No encontrado', 239, 16),
(302, '2024-10-14 03:17:27', '60231162795', 240, 16),
(303, '2024-10-14 03:20:36', '1509112795', 241, 16),
(304, '2024-10-14 03:22:37', '15093112795', 242, 16),
(305, '2024-10-14 03:25:02', '15093112795', 243, 16),
(306, '2024-10-14 03:26:09', 'No encontrado', 244, 16),
(307, '2024-10-14 03:30:42', 'No encontrado', 245, 16),
(308, '2024-10-14 03:31:55', 'No encontrado', 246, 16),
(309, '2024-10-14 04:34:02', 'No encontrado', 247, 16),
(310, '2024-10-14 04:35:24', 'No encontrado', 248, 16),
(311, '2024-10-14 04:36:02', '00005245', 249, 16),
(312, '2024-10-14 04:36:12', 'No encontrado', 250, 16),
(320, '2024-10-14 05:12:38', 'No encontrado', 258, 16),
(321, '2024-10-14 05:14:33', 'No encontrado', 259, 16),
(322, '2024-10-16 04:32:51', '15093112795', 260, 16),
(323, '2024-10-16 04:33:05', 'TA11380180', 261, 16),
(324, '2024-10-16 04:33:22', 'No encontrado', 262, 16),
(325, '2024-10-16 04:51:29', '3302-02 553093', 263, 16);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas_move`
--

CREATE TABLE `facturas_move` (
  `id` int(11) NOT NULL,
  `imagen_path` varchar(255) NOT NULL,
  `fecha_subida` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `facturas_move`
--

INSERT INTO `facturas_move` (`id`, `imagen_path`, `fecha_subida`) VALUES
(259, 'uploads/ticket-walmart-1.jpg', '2024-04-24 13:59:56'),
(260, 'uploads/ticket-de-la-cuenta-sorpresa.jpg', '2024-04-24 14:02:02'),
(261, 'uploads/sachez.jpeg', '2024-05-06 14:04:46'),
(262, 'uploads/liverpool.jpg', '2024-05-06 14:06:58'),
(263, 'uploads/ticket-walmart-1.jpg', '2024-05-06 14:09:00'),
(267, 'uploads/liverpool.jpg', '2024-06-18 14:26:23'),
(272, 'uploads/ticket-walmart-1.jpg', '2024-08-06 17:11:57'),
(275, 'uploads/sachez.jpeg', '2024-08-10 09:01:40'),
(277, 'uploads/ticket-walmart-1.jpg', '2024-08-10 11:37:52'),
(279, 'uploads/liverpool.jpg', '2024-08-10 11:48:08'),
(280, 'uploads/foto_341.jpeg', '2024-08-10 11:48:17'),
(281, 'uploads/sachez.jpeg', '2024-08-10 11:49:20'),
(285, 'uploads/sachez.jpeg', '2024-08-10 11:52:07'),
(286, 'uploads/ticket-walmart-1.jpg', '2024-08-10 14:59:17'),
(287, 'uploads/ticket-walmart-1.jpg', '2024-08-11 13:03:33'),
(288, 'uploads/ticket-sephora-1.jpg', '2024-08-11 13:10:42'),
(289, 'uploads/sachez.jpeg', '2024-08-11 13:14:16'),
(291, 'uploads/ticket-walmart-1.jpg', '2024-08-11 13:20:27'),
(292, 'uploads/liverpool.jpg', '2024-08-11 13:24:37'),
(293, 'uploads/foto_341.jpeg', '2024-08-11 13:26:44'),
(294, 'uploads/ticket-sephora-1.jpg', '2024-05-11 13:28:21'),
(295, 'uploads/sachez.jpeg', '2024-08-11 13:31:10'),
(296, 'uploads/ticket-walmart-1.jpg', '2024-08-11 13:47:53'),
(297, 'uploads/liverpool.jpg', '2024-08-11 14:29:13'),
(298, 'uploads/ticket-sephora-1.jpg', '2024-08-11 14:29:33'),
(300, 'uploads/sachez.jpeg', '2024-08-11 14:38:35'),
(301, 'uploads/ticket-sephora-1.jpg', '2024-08-11 14:39:15'),
(302, 'uploads/ticket-walmart-1.jpg', '2024-08-11 14:56:24'),
(303, 'uploads/ticket-walmart-1.jpg', '2024-08-11 14:57:02'),
(304, 'uploads/sachez.jpeg', '2024-08-13 16:00:34'),
(305, 'uploads/foto_341.jpeg', '2024-08-13 16:01:10'),
(307, 'uploads/sachez.jpeg', '2024-08-13 16:35:45'),
(308, 'uploads/sachez.jpeg', '2024-08-13 16:39:47'),
(309, 'uploads/sorianaa.jpg', '2024-08-13 16:41:21'),
(310, 'uploads/sorianaa.jpg', '2024-08-13 16:41:59'),
(318, 'uploads/liverpool.jpg', '2024-08-13 21:31:51'),
(321, 'uploads/foto3_2.jpg', '2024-08-13 21:47:08'),
(322, 'uploads/foto3_2.jpg', '2024-08-13 21:47:28'),
(323, 'uploads/foto_245.jpg', '2024-08-13 21:47:39'),
(330, 'uploads/liverpool.jpg', '2024-08-14 01:16:05'),
(335, 'uploads/ticket-de-la-cuenta-sorpresa.jpg', '2024-08-15 01:40:39'),
(336, 'uploads/sachez.jpeg', '2024-08-15 01:40:45'),
(337, 'uploads/sorianaa.jpg', '2024-08-15 01:40:55'),
(338, 'uploads/foto_341.jpeg', '2024-08-15 01:41:09'),
(339, 'uploads/ticket-sephora-1.jpg', '2024-08-15 01:41:20'),
(340, 'uploads/foto_245.jpg', '2024-08-15 01:43:13'),
(341, 'uploads/foto_341.jpeg', '2024-08-15 01:43:18'),
(342, 'uploads/foto3_2.jpg', '2024-08-15 01:43:22'),
(343, 'uploads/liverpool.jpg', '2024-08-15 01:43:26'),
(344, 'uploads/soriana2.jpg', '2024-08-15 01:43:31'),
(345, 'uploads/sorianaa.jpg', '2024-08-15 01:43:39'),
(346, 'uploads/ticket.jpg', '2024-08-15 01:43:48'),
(347, 'uploads/ticket-de-la-cuenta-sorpresa.jpg', '2024-08-15 01:43:52'),
(348, 'uploads/ticket-sephora-1.jpg', '2024-08-15 01:43:57'),
(349, 'uploads/ticket-walmart-1.jpg', '2024-08-15 01:44:02'),
(350, 'uploads/soriana2.jpg', '2024-10-14 02:19:11'),
(351, 'uploads/soriana2.jpg', '2024-10-14 02:46:50'),
(352, 'uploads/soriana2.jpg', '2024-10-14 02:48:51'),
(353, 'uploads/foto_341.jpeg', '2024-10-14 02:51:39'),
(354, 'uploads/soriana2.jpg', '2024-10-14 02:57:22'),
(355, 'uploads/soriana2.jpg', '2024-10-14 03:00:30'),
(356, 'uploads/soriana2.jpg', '2024-10-14 03:01:15'),
(357, 'uploads/soriana2.jpg', '2024-10-14 03:04:56'),
(358, 'uploads/soriana2.jpg', '2024-10-14 03:07:38'),
(359, 'uploads/soriana2.jpg', '2024-10-14 03:11:36'),
(360, 'uploads/foto_341.jpeg', '2024-10-14 03:14:19'),
(361, 'uploads/foto_341.jpeg', '2024-10-14 03:15:14'),
(362, 'uploads/soriana2.jpg', '2024-10-14 03:17:27'),
(363, 'uploads/soriana2.jpg', '2024-10-14 03:20:36'),
(364, 'uploads/soriana2.jpg', '2024-10-14 03:22:37'),
(365, 'uploads/soriana2.jpg', '2024-10-14 03:25:02'),
(366, 'uploads/foto_341.jpeg', '2024-10-14 03:26:07'),
(367, 'uploads/foto_341.jpeg', '2024-10-14 03:30:41'),
(368, 'uploads/sachez.jpeg', '2024-10-14 03:31:55'),
(369, 'uploads/foto_341.jpeg', '2024-10-14 04:34:03'),
(370, 'uploads/foto_341.jpeg', '2024-10-14 04:35:23'),
(371, 'uploads/liverpool.jpg', '2024-10-14 04:36:02'),
(372, 'uploads/sachez.jpeg', '2024-10-14 04:36:12'),
(380, 'uploads/foto_341.jpeg', '2024-10-14 05:12:38'),
(381, 'uploads/foto_341.jpeg', '2024-10-14 05:14:33'),
(382, 'uploads/soriana2.jpg', '2024-10-16 04:32:51'),
(383, 'uploads/ticket-de-la-cuenta-sorpresa.jpg', '2024-10-16 04:33:05'),
(384, 'uploads/ticket-walmart-1.jpg', '2024-10-16 04:33:22'),
(385, 'uploads/foto_245.jpg', '2024-10-16 04:51:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `formapago`
--

CREATE TABLE `formapago` (
  `id` int(11) NOT NULL,
  `forma_pago` varchar(255) DEFAULT NULL,
  `facturas_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `formapago`
--

INSERT INTO `formapago` (`id`, `forma_pago`, `facturas_id`) VALUES
(32, '', 198),
(33, '', 199),
(34, '', 200),
(35, '', 201),
(36, '', 202),
(40, '', 206),
(45, '', 211),
(48, '', 214),
(50, '', 216),
(52, '', 218),
(53, '', 219),
(54, '', 220),
(59, '', 225),
(60, '', 226),
(61, '', 227),
(62, '', 228),
(64, '', 230),
(65, '', 231),
(66, '', 232),
(69, '', 235),
(70, '', 236),
(71, '', 237),
(73, '', 239),
(74, '', 240),
(75, '', 241),
(76, '', 242),
(77, '', 243),
(78, '', 244),
(81, '', 247),
(91, '', 257),
(94, '', 260),
(95, '', 261),
(96, '', 262),
(103, '', 269),
(108, '', 274),
(109, '', 275),
(110, '', 276),
(111, '', 277),
(112, '', 278),
(113, '', 279),
(114, '', 280),
(115, '', 281),
(116, '', 282),
(117, '', 283),
(118, '', 284),
(119, '', 285),
(120, '', 286),
(121, '', 287),
(122, '', 288),
(123, '', 289),
(124, '', 290),
(125, '', 291),
(126, '', 292),
(127, '', 293),
(128, '', 294),
(129, '', 295),
(130, '', 296),
(131, '', 297),
(132, '', 298),
(133, '', 299),
(134, '', 300),
(135, '', 301),
(136, '', 302),
(137, '', 303),
(138, '', 304),
(139, '', 305),
(140, '', 306),
(141, '', 307),
(142, '', 308),
(143, '', 309),
(144, '', 310),
(145, '', 311),
(146, '', 312),
(154, '', 320),
(155, '', 321),
(156, '', 322),
(157, '', 323),
(158, '', 324),
(159, '', 325);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `importe`
--

CREATE TABLE `importe` (
  `id` int(11) NOT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL,
  `importe_total` decimal(10,2) DEFAULT NULL,
  `facturas_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `importe`
--

INSERT INTO `importe` (`id`, `precio_unitario`, `importe_total`, `facturas_id`) VALUES
(32, 0.00, 300.01, 198),
(33, 0.00, 218.55, 199),
(34, 0.00, 32.00, 200),
(35, 0.00, 45.00, 201),
(36, 0.00, 300.01, 202),
(40, 0.00, 45.00, 206),
(45, 0.00, 300.01, 211),
(48, 0.00, 32.00, 214),
(50, 0.00, 300.01, 216),
(52, 0.00, 45.00, 218),
(53, 0.00, 59.00, 219),
(54, 0.00, 32.00, 220),
(59, 0.00, 300.01, 225),
(60, 0.00, 300.01, 226),
(61, 0.00, 52.50, 227),
(62, 0.00, 32.00, 228),
(64, 0.00, 300.01, 230),
(65, 0.00, 45.00, 231),
(66, 0.00, 59.95, 232),
(69, 0.00, 300.01, 235),
(70, 0.00, 45.00, 236),
(71, 0.00, 52.50, 237),
(73, 0.00, 32.00, 239),
(74, 0.00, 52.50, 240),
(75, 0.00, 300.01, 241),
(76, 0.00, 300.01, 242),
(77, 0.00, 32.00, 243),
(78, 0.00, 59.00, 244),
(81, 0.00, 32.00, 247),
(91, 0.00, 45.00, 257),
(94, 0.00, 19.00, 260),
(95, 0.00, 19.00, 261),
(96, 0.00, 1.00, 262),
(103, 0.00, 45.00, 269),
(108, 0.00, 218.55, 274),
(109, 0.00, 32.00, 275),
(110, 0.00, 206.00, 276),
(111, 0.00, 59.00, 277),
(112, 0.00, 52.50, 278),
(113, 0.00, 1.00, 279),
(114, 0.00, 59.00, 280),
(115, 0.00, 19.00, 281),
(116, 0.00, 45.00, 282),
(117, 0.00, 300.20, 283),
(118, 0.00, 206.00, 284),
(119, 0.00, 0.00, 285),
(120, 0.00, 218.55, 286),
(121, 0.00, 52.50, 287),
(122, 0.00, 300.01, 288),
(123, 0.00, 0.00, 289),
(124, 0.00, 300.20, 290),
(125, 0.00, 300.20, 291),
(126, 0.00, 300.20, 292),
(127, 0.00, 59.00, 293),
(128, 0.00, 300.20, 294),
(129, 0.00, 300.20, 295),
(130, 0.00, 300.20, 296),
(131, 0.00, 300.20, 297),
(132, 0.00, 300.20, 298),
(133, 0.00, 300.20, 299),
(134, 0.00, 59.00, 300),
(135, 0.00, 59.00, 301),
(136, 0.00, 300.20, 302),
(137, 0.00, 300.20, 303),
(138, 0.00, 300.20, 304),
(139, 0.00, 300.20, 305),
(140, 0.00, 59.00, 306),
(141, 0.00, 59.00, 307),
(142, 0.00, 32.00, 308),
(143, 0.00, 59.00, 309),
(144, 0.00, 59.00, 310),
(145, 0.00, 45.00, 311),
(146, 0.00, 32.00, 312),
(154, 0.00, 59.00, 320),
(155, 0.00, 59.00, 321),
(156, 0.00, 300.20, 322),
(157, 0.00, 218.55, 323),
(158, 0.00, 300.01, 324),
(159, 0.00, 1.00, 325);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `impuestos`
--

CREATE TABLE `impuestos` (
  `id` int(11) NOT NULL,
  `subtotal` decimal(10,0) NOT NULL,
  `iva` decimal(10,2) DEFAULT NULL,
  `facturas_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `impuestos`
--

INSERT INTO `impuestos` (`id`, `subtotal`, `iva`, `facturas_id`) VALUES
(32, 270, 37.24, 198),
(33, 199, 19.87, 199),
(34, 0, 0.00, 200),
(35, 0, 0.00, 201),
(36, 270, 37.24, 202),
(40, 0, 0.00, 206),
(45, 270, 37.24, 211),
(48, 0, 0.00, 214),
(50, 0, 37.24, 216),
(52, 0, 0.00, 218),
(53, 49, 10.00, 219),
(54, 0, 0.00, 220),
(59, 270, 37.24, 225),
(60, 240, 37.24, 226),
(61, 0, 9.11, 227),
(62, 0, 0.00, 228),
(64, 270, 37.24, 230),
(65, 0, 0.00, 231),
(66, 50, 10.40, 232),
(69, 270, 37.24, 235),
(70, 0, 0.00, 236),
(71, 43, 9.11, 237),
(73, 0, 0.00, 239),
(74, 0, 9.11, 240),
(75, 270, 37.24, 241),
(76, 270, 37.24, 242),
(77, 0, 0.00, 243),
(78, 49, 10.00, 244),
(81, 0, 0.00, 247),
(91, 0, 0.00, 257),
(94, 16, 3.00, 260),
(95, 16, 3.00, 261),
(96, 1, 203.73, 262),
(103, 0, 0.00, 269),
(108, 199, 19.87, 274),
(109, 0, 0.00, 275),
(110, 0, 0.00, 276),
(111, 49, 10.00, 277),
(112, 43, 9.11, 278),
(113, 1, 203.73, 279),
(114, 49, 10.00, 280),
(115, 16, 3.00, 281),
(116, 0, 0.00, 282),
(117, 0, 0.00, 283),
(118, 0, 0.00, 284),
(119, 597, 125.00, 285),
(120, 199, 19.87, 286),
(121, 0, 9.11, 287),
(122, 270, 37.24, 288),
(123, 0, 0.00, 289),
(124, 0, 0.00, 290),
(125, 0, 0.00, 291),
(126, 0, 0.00, 292),
(127, 49, 10.00, 293),
(128, 0, 0.00, 294),
(129, 0, 0.00, 295),
(130, 0, 0.00, 296),
(131, 0, 0.00, 297),
(132, 0, 0.00, 298),
(133, 0, 0.00, 299),
(134, 49, 10.00, 300),
(135, 49, 10.00, 301),
(136, 0, 0.00, 302),
(137, 0, 0.00, 303),
(138, 0, 0.00, 304),
(139, 0, 0.00, 305),
(140, 49, 10.00, 306),
(141, 49, 10.00, 307),
(142, 0, 0.00, 308),
(143, 49, 10.00, 309),
(144, 49, 10.00, 310),
(145, 0, 0.00, 311),
(146, 0, 0.00, 312),
(154, 49, 10.00, 320),
(155, 49, 10.00, 321),
(156, 0, 0.00, 322),
(157, 199, 19.87, 323),
(158, 270, 37.24, 324),
(159, 1, 203.73, 325);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id` int(11) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `facturas_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`id`, `nombre`, `facturas_id`) VALUES
(32, 'TECATE LIGHT 2X$270 127L', 198),
(33, 'PAN', 199),
(34, 'GALLETAS OLEO CAJETA QUEMADA 105 G', 200),
(35, 'PARAGUAS', 201),
(36, 'TECATE LIGHT 2X$270 127L', 202),
(40, 'PARAGUAS', 206),
(45, 'TECATE LIGHT 2X270 127L', 211),
(48, 'GALLETAS OREO CAJETA QUEMADA 105 G', 214),
(50, 'TECATE LIGHT 2X$270 127L', 216),
(52, 'PARAGUAS', 218),
(53, 'BOTIN TACON', 219),
(54, 'GALLETAS OLEO CAJETA QUEMADA 105 G', 220),
(59, 'TECATE LIGHT 2X$270 127L', 225),
(60, 'TECATE LIGHT 2X$270 127TL', 226),
(61, 'PROMOCION 2013', 227),
(62, 'GALLETAS OREO CAJETA QUEMADA 105 G', 228),
(64, 'TECATE LIGHT 2X$270 127L', 230),
(65, 'PARAGUAS', 231),
(66, 'BOTIN TACON', 232),
(69, 'TECATE LIGHT 2X$270 127L', 235),
(70, 'PARAGUAS 00005207', 236),
(71, 'PROMOCION 2013', 237),
(73, 'GALLETAS OLEO CAJETA QUEMADA 105 G', 239),
(74, 'PROMOCION 2013', 240),
(75, 'TECATE LIGHT 2X$270 127L', 241),
(76, 'TECATE LIGHT 2X$270 127L', 242),
(77, 'GALLETAS OREO CAJETA QUEMADA 105 G', 243),
(78, 'BOTIN TACON', 244),
(81, 'GALLETAS OREO CAJETA QUEMADA 105 G', 247),
(91, 'PARAGUAS', 257),
(94, 'CAMISA', 260),
(95, 'CAMISA', 261),
(96, 'VESTIDO', 262),
(103, 'PARAGUAS 00005207', 269),
(108, 'PAN', 274),
(109, 'GALLETAS OREO CAJETA QUEMADA 105 G', 275),
(110, 'IMPUESTO:', 276),
(111, 'BOTIN TACON', 277),
(112, 'PROMOCION 2013', 278),
(113, 'VESTIDO', 279),
(114, 'BOTIN TACON', 280),
(115, 'CAMISA', 281),
(116, 'PARAGUAS 00005207', 282),
(117, 'No encontrado', 283),
(118, 'IMPUESTO', 284),
(119, 'Guantes', 285),
(120, 'PAN', 286),
(121, 'PROMOCION 2013', 287),
(122, 'TECATE LIGHT 2X$270 127L', 288),
(123, '', 289),
(124, 'No encontrado', 290),
(125, 'No encontrado', 291),
(126, 'No encontrado', 292),
(127, 'BOTIN TACON', 293),
(128, 'No encontrado', 294),
(129, 'No encontrado', 295),
(130, 'No encontrado', 296),
(131, 'No encontrado', 297),
(132, 'No encontrado', 298),
(133, 'No encontrado', 299),
(134, 'BOTIN TACON', 300),
(135, 'BOTIN TACON', 301),
(136, 'No encontrado', 302),
(137, 'No encontrado', 303),
(138, 'No encontrado', 304),
(139, 'No encontrado', 305),
(140, 'BOTIN TACON', 306),
(141, 'BOTIN TACON', 307),
(142, 'GALLETAS OREO CAJETA QUEMADA 105 G', 308),
(143, 'BOTIN TACON', 309),
(144, 'BOTIN TACON', 310),
(145, 'PARAGUAS', 311),
(146, 'GALLETAS OREO CAJETA QUEMADA 105 G', 312),
(154, 'BOTIN TACON', 320),
(155, 'BOTIN TACON', 321),
(156, 'No encontrado', 322),
(157, 'PAN', 323),
(158, 'TECATE LIGHT 2X$270 127L', 324),
(159, 'VESTIDO', 325);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `foto_perfil` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `user`
--

INSERT INTO `user` (`id`, `fname`, `lname`, `phone`, `email`, `password`, `type`, `foto_perfil`) VALUES
(3, 'Administrador', 'BillsScan', '123', 'admin@gmail.com', '12', 'Admin', 'foto_perfil/admin.jpg'),
(16, 'Paco', 'García', '9932215164', 'paco@gmail.com', '12', 'Normal', 'foto_perfil/paco.jpg'),
(24, 'Luis', 'Mendez', '9614453309', 'luis@gmail.com', '12345', 'Normal', 'foto_perfil/Luis.jpeg'),
(32, 'Sofia', 'Damasco', '9943444565', 'sofia@gmail.com', '23', 'Normal', 'foto_perfil/sofia.png'),
(33, 'Steve', 'Johnson', '23345343534', 'steve@gmail.com', '12', 'Normal', 'foto_perfil/Steve.png'),
(34, 'FAUSTO JAVIER', 'MENDOZA PEREZ', '9617593309', 'mendozaperezfaustojavier@gmail.com', '23', 'Admin', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `archivos_recientes`
--
ALTER TABLE `archivos_recientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facturas_id` (`facturas_move_id`),
  ADD KEY `fk_archivos_recientes_user` (`user_id`);

--
-- Indices de la tabla `cambio`
--
ALTER TABLE `cambio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facturas_id` (`facturas_id`);

--
-- Indices de la tabla `emisor`
--
ALTER TABLE `emisor`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `emisor_id` (`emisor_id`),
  ADD KEY `fk_facturas_usuarios` (`user_id`);

--
-- Indices de la tabla `facturas_move`
--
ALTER TABLE `facturas_move`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `formapago`
--
ALTER TABLE `formapago`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facturas_id` (`facturas_id`);

--
-- Indices de la tabla `importe`
--
ALTER TABLE `importe`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facturas_id` (`facturas_id`);

--
-- Indices de la tabla `impuestos`
--
ALTER TABLE `impuestos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facturas_id` (`facturas_id`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `facturas_id` (`facturas_id`);

--
-- Indices de la tabla `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `archivos_recientes`
--
ALTER TABLE `archivos_recientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- AUTO_INCREMENT de la tabla `cambio`
--
ALTER TABLE `cambio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=178;

--
-- AUTO_INCREMENT de la tabla `emisor`
--
ALTER TABLE `emisor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=264;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=326;

--
-- AUTO_INCREMENT de la tabla `facturas_move`
--
ALTER TABLE `facturas_move`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=386;

--
-- AUTO_INCREMENT de la tabla `formapago`
--
ALTER TABLE `formapago`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT de la tabla `importe`
--
ALTER TABLE `importe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT de la tabla `impuestos`
--
ALTER TABLE `impuestos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT de la tabla `producto`
--
ALTER TABLE `producto`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=160;

--
-- AUTO_INCREMENT de la tabla `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `archivos_recientes`
--
ALTER TABLE `archivos_recientes`
  ADD CONSTRAINT `fk_archivos_recientes_facturas_move` FOREIGN KEY (`facturas_move_id`) REFERENCES `facturas_move` (`id`),
  ADD CONSTRAINT `fk_archivos_recientes_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `cambio`
--
ALTER TABLE `cambio`
  ADD CONSTRAINT `cambio_ibfk_1` FOREIGN KEY (`facturas_id`) REFERENCES `facturas` (`id`);

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`emisor_id`) REFERENCES `emisor` (`id`),
  ADD CONSTRAINT `fk_facturas_usuarios` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`);

--
-- Filtros para la tabla `formapago`
--
ALTER TABLE `formapago`
  ADD CONSTRAINT `formapago_ibfk_1` FOREIGN KEY (`facturas_id`) REFERENCES `facturas` (`id`);

--
-- Filtros para la tabla `importe`
--
ALTER TABLE `importe`
  ADD CONSTRAINT `importe_ibfk_1` FOREIGN KEY (`facturas_id`) REFERENCES `facturas` (`id`);

--
-- Filtros para la tabla `impuestos`
--
ALTER TABLE `impuestos`
  ADD CONSTRAINT `impuestos_ibfk_1` FOREIGN KEY (`facturas_id`) REFERENCES `facturas` (`id`);

--
-- Filtros para la tabla `producto`
--
ALTER TABLE `producto`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`facturas_id`) REFERENCES `facturas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
