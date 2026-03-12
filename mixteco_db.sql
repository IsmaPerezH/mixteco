-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 12-03-2026 a las 21:18:28
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
-- Base de datos: `mixteco_db`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `id` int(11) NOT NULL,
  `nombre` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(4, 'Animales domésticos'),
(3, 'Animales silvestres'),
(6, 'Árboles'),
(8, 'Climas'),
(1, 'Colores'),
(7, 'Meses'),
(2, 'Números'),
(9, 'Partes del cuerpo'),
(5, 'Saludos');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `diccionario`
--

CREATE TABLE `diccionario` (
  `id` int(11) NOT NULL,
  `espanol` varchar(100) NOT NULL,
  `mixteco` varchar(100) NOT NULL,
  `categoria_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `diccionario`
--

INSERT INTO `diccionario` (`id`, `espanol`, `mixteco`, `categoria_id`) VALUES
(1, 'blanco', 'Kuijín', 1),
(2, 'amarillo', 'Kuaan', 1),
(3, 'rojo', 'Kua’a', 1),
(4, 'negro', 'Túun', 1),
(5, 'café', 'Ya’a', 1),
(6, 'azul', 'Nchaá', 1),
(7, 'azul marino', 'Janti’í', 1),
(8, 'morado', 'Nti’i', 1),
(9, 'blanquizco', 'Yaa', 1),
(10, 'verde', 'Kuii', 1),
(11, 'brillante', 'Ntíi', 1),
(12, 'gris', 'Tiyàa', 1),
(13, 'pinto', 'Kɨntɨ', 1),
(14, 'rosa', 'Kua’a yaa', 1),
(15, '0', 'iu', 2),
(16, '1', 'iin', 2),
(17, '2', 'uu', 2),
(18, '3', 'uni', 2),
(19, '4', 'kuun', 2),
(20, '5', 'u’un', 2),
(21, '6', 'iñu', 2),
(22, '7', 'uxia', 2),
(23, '8', 'úna', 2),
(24, '9', 'ɨɨn', 2),
(25, '10', 'uxi', 2),
(26, '11', 'uxi iin', 2),
(27, '12', 'Uxi uu', 2),
(28, '13', 'Uxi uni', 2),
(29, '14', 'Uxi kuun', 2),
(30, '15', 'Xia’un', 2),
(31, '16', 'Xia’un ɨɨn', 2),
(32, '17', 'xia’un uu', 2),
(33, '18', 'xia’un uni', 2),
(34, '19', 'xia’un kuun', 2),
(35, '20', 'Oko', 2),
(36, 'zopilote', 'tijii', 3),
(37, 'gavilán', 'xián', 3),
(38, 'águila', 'yachoko', 3),
(39, 'halcón', 'tásu', 3),
(40, 'paloma', 'satin', 3),
(41, 'colibrí', 'ntiyoo', 3),
(42, 'pájaro carpintero', 'tirrikɨ', 3),
(43, 'pájaro azul', 'xɨ´ɨ', 3),
(44, 'cenzontle', 'tɨsumi', 3),
(45, 'tecolote', 'tɨñuu', 3),
(46, 'correcamino', 'su´un', 3),
(47, 'cordoníz', 'ntɨñu´un', 3),
(48, 'borrego', 'Rɨɨ', 4),
(49, 'cordero (borrego pequeño)', 'Lélú', 4),
(50, 'borrego con cuerno', 'Nerru', 4),
(51, 'borrega', 'Rɨɨ sɨʹɨ', 4),
(52, 'becerro', 'Chelu', 4),
(53, 'becerra', 'Chelu sɨ’ɨ', 4),
(54, 'toro', 'Xintɨkɨ yɨɨ', 4),
(55, 'vaca', 'Xintɨkɨ sɨ’ɨ', 4),
(56, 'pollos en general', 'Chuún', 4),
(57, 'pollitos', 'Tɨrrɨ', 4),
(58, 'gallina', 'Chuki', 4),
(59, 'gallo', 'Lí’li', 4),
(60, 'guajolota', 'Sana', 4),
(61, 'guajolote', 'Kó’olo', 4),
(62, 'puerco(a)', 'Kɨnɨ', 4),
(63, 'puerco', 'Kɨnɨ yɨɨ', 4),
(64, 'puerca', 'Kɨnɨ sɨ’ɨ', 4),
(65, 'perros', 'Tɨina', 4),
(66, 'cachorros', 'Tɨina luli', 4),
(67, 'perra', 'Tɨina sɨ’ɨ', 4),
(68, 'perro', 'Tɨina yɨɨ', 4),
(69, 'gato', 'Vilu', 4),
(70, 'gata', 'Vilu sɨ’ɨ', 4),
(71, 'gato (macho)', 'Vilu yɨɨ', 4),
(72, 'Buenos días', 'Tani ndíí', 5),
(73, 'Saludo de medio día', 'Tani kauxi uu/ kaxiu', 5),
(74, 'Buenas tardes', 'Tani ini', 5),
(75, 'Buenas noches (6-7pm)', 'Tarxio', 5),
(76, 'Buenas noches', 'Tani kuá', 5),
(77, 'ocotal verde', 'nuyújá kuii', 6),
(78, 'Ocotal amarillo', 'nuyújá kuán', 6),
(79, 'Ocotal colorado (rojo)', 'Nuyújá kua’a', 6),
(80, 'Oyamel', 'nuxe’eñu', 6),
(81, 'madroño', 'Nuyúʹndú', 6),
(82, 'chamizal amarillo', 'nuyújí', 6),
(83, 'lengua de vaca', 'yaá stɨkɨ si’i', 6),
(84, 'sabino', 'nuyúkún', 6),
(85, 'enebro', 'nu ini', 6),
(86, 'jacaranda', 'nuita nyaá', 6),
(87, 'espina de gato', 'iñu vilu', 6),
(88, 'encino amarillo', 'nukaji kuaan', 6),
(89, 'encino blanco', 'nukaji kuijin', 6),
(90, 'encino negro', 'nukaji tuun', 6),
(91, 'encino de hoja remolida', 'nukaji numa ndi’i', 6),
(92, 'copalillo', 'yunu suxia kutú', 6),
(93, 'enero', 'yoo iin', 7),
(94, 'febrero', 'yoo uu', 7),
(95, 'marzo', 'yoo uni', 7),
(96, 'abril', 'yoo kuun', 7),
(97, 'mayo', 'yoo u’un', 7),
(98, 'junio', 'yoo iñu', 7),
(99, 'julio', 'yoo uxia', 7),
(100, 'agosto', 'yoo una', 7),
(101, 'septiembre', 'yoo ɨɨn', 7),
(102, 'octubre', 'yoo uxi', 7),
(103, 'noviembre', 'yoo uxi iin', 7),
(104, 'diciembre', 'yoo uxi uu', 7),
(105, 'día soleado', 'kɨvɨ níní', 8),
(106, 'día frio', 'kɨvɨ vijin', 8),
(107, 'día lluvioso', 'sau / kɨvɨ kuun sau', 8),
(108, 'meses lluviosos', 'yoo sau', 8),
(109, 'día nublado', 'kɨvɨ vik', 8),
(110, 'tormenta', 'sau tachi', 8),
(111, 'rachas de viento', 'yii tachi / chi tachi', 8),
(112, 'huracan', 'sau tachi xáá', 8),
(113, 'neblina', 'viko nu´un', 8),
(114, 'cayó la helada', 'nii kuun yuá', 8),
(115, 'llovizna', 'sau ndi´i', 8),
(116, 'remolino', 'tɨkacha', 8),
(117, 'remolino grande', 'tɨkacha xáá', 8),
(118, 'remolino seco', 'tɨkacha ichí', 8),
(119, 'remolino de agua', 'tɨkacha sau', 8),
(120, 'sequía', 'ichí', 8),
(121, 'tiempo seco', 'yoo ichí', 8),
(122, 'culebra de agua', 'koo sau', 8),
(123, 'culebra de agua que tira', 'koo sau xáán', 8),
(124, 'Cabeza', 'Xini', 9),
(125, 'Pecho', 'Jika', 9),
(126, 'Manos', 'Nda’a', 9),
(127, 'Pies', 'Ja’a', 9),
(128, 'Costados', 'Xɨín', 9),
(129, 'Muslo (pierna)', 'Sa’anta', 9),
(130, 'Rodilla', 'Xini jɨtɨ (ko’onto)', 9),
(131, 'Espinilla (Canilla)', 'Yɨkɨ ntoó', 9),
(132, 'pantorrilla / chamorro', 'Kuñu Yɨkɨ jiti', 9),
(133, 'Tobillo', 'Sukun já’a', 9),
(134, 'Planta del pie', 'Xente já’a', 9),
(135, 'Dedos del pie', 'Xini já’a', 9),
(136, 'Nalgas o sentadera', 'Tɨluú', 9),
(137, 'espalda', 'yata', 9),
(138, 'Codo', 'Xujɨtɨ nda’a', 9),
(139, 'tendones de la mano', 'tuchi nda’a', 9),
(140, 'tendones de los pies', 'tuchi ja’a', 9),
(141, 'tendones de la espalda', 'tuchi yata', 9),
(142, 'Tendones/ nervios', 'Tuchi', 9),
(143, 'dedos de los pies', 'Xini ja’a', 9),
(144, 'Dedos de la mano', 'Xini nda’a', 9),
(145, 'Palma de la mano', 'Xente nda’a', 9),
(146, 'Uñas', 'Tíñu', 9),
(147, 'Muñeca', 'Sukun ndá’a', 9),
(148, 'Brazo', 'Chò’o', 9),
(149, 'Sobre el hombro', 'Nuun chò’o', 9),
(150, 'Recto o ano', 'Xujátɨ /Nunjátɨ', 9),
(151, 'Cuello', 'Súkún', 9),
(152, 'Costillas', 'Yɨkɨn jíká', 9),
(153, 'Ojos', 'Nduchi núú', 9),
(154, 'Oreja', 'So’o', 9),
(155, 'Cabello', 'Ixi xini', 9),
(156, 'Bigote', 'Ixi yu’ú', 9),
(157, 'Barba', 'Ixi xáá', 9),
(158, 'Pestañas', 'Ixi nduchi', 9),
(159, 'Cejas', 'Ixi súká', 9),
(160, 'Boca', 'yu’u', 9),
(161, 'Dientes', 'Nu’un', 9),
(162, 'Nariz', 'kutu', 9),
(163, 'Labios', 'Nii yu’u', 9),
(164, 'Garganta', 'Yoó', 9),
(165, 'Párpados', 'Nii nduchi', 9),
(166, 'lengua', 'yaá', 9),
(167, 'cintura', 'xiin', 9),
(168, 'Mejilla', 'Kuñu nuun', 9),
(169, 'Frente', 'Chaan', 9),
(170, 'Nuca', 'Yata sukun', 9),
(171, 'Remolino del cabello', 'Jé’ñu', 9),
(172, 'Quijada', 'Xáá', 9),
(173, 'Donde inicia la pierna', 'Ja’a sɨ’ɨn', 9),
(174, 'Corazón', 'Añu', 9),
(175, 'Hígado', 'Staja’a', 9),
(176, 'Riñones', 'Nduchi ini', 9),
(177, 'Pulmón', 'Tɨña’ma', 9),
(178, 'Páncrea', 'Kaa ini', 9),
(179, 'Intestino delgado', 'Jɨtɨ nti’i', 9),
(180, 'Intestino grueso', 'Jɨtɨ kanu', 9),
(181, 'Vesícula viliar', 'Kava', 9),
(182, 'Estómago', 'Chii', 9),
(183, 'Ombligo', 'Xentu', 9),
(184, 'Vientre', 'Toko', 9);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `diccionario`
--
ALTER TABLE `diccionario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `categoria_id` (`categoria_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `diccionario`
--
ALTER TABLE `diccionario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `diccionario`
--
ALTER TABLE `diccionario`
  ADD CONSTRAINT `diccionario_ibfk_1` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
