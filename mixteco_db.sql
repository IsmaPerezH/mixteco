-- ========================================================
-- Base de Datos Unificada: mixteco_db
-- Proyecto: Tu'un Savi / San Miguel el Grande
-- ========================================================

CREATE DATABASE IF NOT EXISTS `mixteco_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `mixteco_db`;

SET FOREIGN_KEY_CHECKS = 0;

-- --------------------------------------------------------
-- 1. Tabla: categorias
-- --------------------------------------------------------
DROP TABLE IF EXISTS `categorias`;
CREATE TABLE `categorias` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_categoria_nombre` (`nombre`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `categorias` (`id`, `nombre`) VALUES
(1, 'Colores'),
(2, 'Números'),
(3, 'Animales silvestres'),
(4, 'Animales domésticos'),
(5, 'Saludos'),
(6, 'Árboles'),
(7, 'Meses'),
(8, 'Climas'),
(9, 'Partes del cuerpo');

-- --------------------------------------------------------
-- 2. Tabla: diccionario
-- --------------------------------------------------------
DROP TABLE IF EXISTS `diccionario`;
CREATE TABLE `diccionario` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `espanol` VARCHAR(100) NOT NULL,
  `mixteco` VARCHAR(100) NOT NULL,
  `categoria_id` INT(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_diccionario_categoria` (`categoria_id`),
  CONSTRAINT `fk_diccionario_categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categorias` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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

-- --------------------------------------------------------
-- 3. Tabla: gastronomia (Corregido typo de gartronomia)
-- --------------------------------------------------------
DROP TABLE IF EXISTS `gastronomia`;
CREATE TABLE `gastronomia` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `nombre` VARCHAR(150) NOT NULL,
  `resumen` TEXT NOT NULL,
  `origen` VARCHAR(255) NULL,
  `categoria` ENUM('comida', 'bebida') NOT NULL,
  `imagen` VARCHAR(255) NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `gastronomia` (`nombre`, `resumen`, `origen`, `categoria`, `imagen`) VALUES
('Pozole blanco', 'Caldo tradicional con maíz y carne, muy representativo.', 'San Miguel el Grande', 'comida', 'Pozole-blanco.jpg'),
('Xtabentún', 'Licor dulce y anisado elaborado con miel de abejas meliponas.', 'Leyenda maya: Se dice que surgió de la tumba de Xtabay, una mujer de noble corazón.', 'bebida', 'xtabentun.jpg'),
('Pulque', 'Bebida fermentada del maguey, conocida como la "bebida de los dioses".', 'Leyenda mexica: Quetzalcóatl, al ver a los hombres tristes, buscó a Mayahuel, diosa de la fertilidad.', 'bebida', 'pulque.jpg'),
('Agua de Obispo', 'Bebida refrescante de Cuaresma hecha con remolacha, frutas y cacahuates.', 'Se originó en el siglo XVI en Zacatecas.', 'bebida', 'agua-obispo.jpg'),
('Balché', 'Bebida fermentada sagrada para la cultura maya, elaborada con corteza del árbol de balché.', 'Es una bebida ceremonial de origen prehispánico.', 'bebida', 'balche.jpg'),
('Tequila', 'Destilado del agave azul, la bebida emblemática de México por excelencia.', 'Es una "bebida mestiza" que nació en la región de Tequila, Jalisco.', 'bebida', 'tequila.jpg'),
('Mole poblano', 'Compleja salsa de chiles, especias y chocolate, servida sobre guajolote o pollo.', 'Leyenda novohispana: En el siglo XVII, Sor Andrea de la Asunción preparó este guiso en Puebla.', 'comida', 'mole-poblano.jpg'),
('Tamales', 'Masa de maíz rellena de carne, chiles, verduras o frutas, envuelta en hojas de maíz o plátano.', 'Época prehispánica: Los tamales tienen un origen ritual y sagrado.', 'comida', 'tamales.jpg'),
('Barbacoa de hoyo', 'Carne de borrego envuelta en pencas de maguey, cocida lentamente en un horno subterráneo.', 'Tradición prehispánica: Originaria del estado de Hidalgo.', 'comida', 'barbacoa-borrego.jpg'),
('Tlayuda', 'Tortilla de maíz grande y crujiente, cubierta con frijoles, tasajo, chorizo, queso y salsa.', 'Tradición oaxaqueña: Conocida como la "pizza mexicana", originaria de los Valles Centrales de Oaxaca.', 'comida', 'tlayuda.jpg');

-- --------------------------------------------------------
-- 4. Tabla: historias (Corregido ENUM para permitir 'mito')
-- --------------------------------------------------------
DROP TABLE IF EXISTS `historias`;
CREATE TABLE `historias` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `titulo` VARCHAR(255) NOT NULL,
  `tipo` ENUM('historia','leyenda','mito') NOT NULL DEFAULT 'historia',
  `resumen` VARCHAR(500) DEFAULT NULL,
  `contenido` TEXT NOT NULL,
  `etiqueta` VARCHAR(50) DEFAULT NULL,
  `creado_en` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `historias` (`id`, `titulo`, `tipo`, `resumen`, `contenido`, `etiqueta`) VALUES
(1, 'Los orígenes de Achiutla', 'historia', 'En la época prehispánica estos pueblos pertenecieron al reinado de Achiutla...', 'En la época prehispánica estos pueblos pertenecieron al reinado de Achiutla y en la época colonial, primero pertenecieron a la encomienda de Francisco de las Casas, después pasaron a la corona española. Se relata la fundación del pueblo y el sincretismo cultural que dió origen a San Miguel el Grande.', 'Historia Local'),
(2, 'El Llano de Borrego', 'leyenda', 'Cuentan que anteriormente este lugar se llamó llano de Borrego, inhabitado en aquel entonces y pastaban los animales...', 'En 1904, cuentan que anteriormente, este lugar se llamó llano de Borrego. El llano de Borrego estaba inhabitado en aquel entonces y como se pueden imaginar solo existía un llano en donde pastaban los animales principalmente los borregos. Un día una persona respetada platicó con los demás habitantes y les propuso la de idea comprar un santo en bulto para el lugar, el santo de nombre "El padre de Jesús de las tres caídas".', 'Leyenda Tradicional'),
(3, 'El Mogote Sagrado', 'historia', 'En la comunidad cercana a San Miguel el Grande existe un antiguo sitio arqueológico conocido como El Mogote.', 'En las montañas cercanas a San Miguel el Grande se encuentra un sitio arqueológico conocido como El Mogote. Según los ancianos del lugar, este sitio fue un antiguo asentamiento mixteco donde vivieron gobernantes y sacerdotes.', 'Historia Local'),
(4, 'El Flechador del Sol', 'mito', 'Un antiguo mito mixteco cuenta la historia de un héroe que desafió al Sol para conquistar la tierra de la Mixteca.', 'Según la tradición mixteca, un héroe llamado Dzahuindanda nació en el árbol sagrado de Apoala. Cuando su pueblo buscaba un lugar para vivir, descubrió que la tierra de la Mixteca estaba dominada por el Sol. Para poder habitarla, desafió al astro en combate y logró vencerlo con sus flechas.', 'Mitología Mixteca'),
(5, 'La Cueva de los Espíritus', 'leyenda', 'En los cerros cercanos al pueblo existe una cueva donde, según los ancianos, habitan los espíritus antiguos.', 'Cuenta la leyenda que en uno de los cerros cercanos a San Miguel el Grande existe una cueva profunda donde habitan los espíritus de los antiguos habitantes mixtecos.', 'Leyenda Local'),
(6, 'El Nahual del Cerro', 'leyenda', 'Durante generaciones los habitantes han contado historias sobre un nahual que habita en los cerros.', 'Los pobladores cuentan que hace muchos años un hombre tenía la capacidad de transformarse en animal durante la noche. Este nahual se convertía en coyote o perro grande y caminaba por los cerros vigilando el pueblo.', 'Leyenda'),
(7, 'El Oráculo de Achiutla', 'historia', 'Achiutla fue considerado un centro sagrado en la época prehispánica donde existía un importante oráculo.', 'Antes de la llegada de los españoles, Achiutla fue uno de los centros religiosos más importantes de la cultura mixteca. En este lugar existía un oráculo donde los sacerdotes realizaban ceremonias y consultas espirituales.', 'Historia Mixteca'),
(8, 'El Tesoro Enterrado del Convento', 'leyenda', 'Se dice que durante la época colonial algunos tesoros fueron escondidos cerca del antiguo convento.', 'Cuando los españoles llegaron a la región y construyeron el convento dominico en Achiutla, algunos habitantes escondieron sus riquezas para evitar que fueran tomadas.', 'Leyenda Colonial'),
(9, 'El Espíritu del Antiguo Campanario', 'leyenda', 'Algunos habitantes dicen escuchar las campanas de la iglesia sonar durante la madrugada.', 'En ciertas noches silenciosas, los habitantes aseguran escuchar las campanas del antiguo templo sonar sin que nadie esté en la iglesia.', 'Relato Popular');

-- --------------------------------------------------------
-- 5. Tabla: historias_imagenes (Rutas relativas limpias)
-- --------------------------------------------------------
DROP TABLE IF EXISTS `historias_imagenes`;
CREATE TABLE `historias_imagenes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `historia_id` INT(11) NOT NULL,
  `url_imagen` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_historia` (`historia_id`),
  CONSTRAINT `fk_historia_imagenes` FOREIGN KEY (`historia_id`) REFERENCES `historias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `historias_imagenes` (`historia_id`, `url_imagen`) VALUES
(1, '/public/img/iglesia.jpg'),
(1, '/public/img/paisaje_origen.jpg'),
(2, '/public/img/iglesia.jpg'),
(3, '/public/img/image.jpg'),
(3, '/public/img/image2.jpg'),
(4, '/public/img/iglesia.jpg'),
(4, '/public/img/image.jpg'),
(5, '/public/img/paisaje_origen.jpg'),
(5, '/public/img/image2.jpg'),
(6, '/public/img/image.jpg'),
(6, '/public/img/image2.jpg'),
(6, '/public/img/iglesia.jpg'),
(7, '/public/img/paisaje_origen.jpg'),
(7, '/public/img/image.jpg'),
(8, '/public/img/image2.jpg'),
(8, '/public/img/iglesia.jpg'),
(8, '/public/img/paisaje_origen.jpg'),
(9, '/public/img/image.jpg'),
(9, '/public/img/image2.jpg'),
(9, '/public/img/iglesia.jpg');

-- --------------------------------------------------------
-- 6. Tabla: lugares
-- --------------------------------------------------------
DROP TABLE IF EXISTS `lugares`;
CREATE TABLE `lugares` (
  `id` INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
  `nombre` VARCHAR(150) NOT NULL,
  `resumen` TEXT NOT NULL,
  `origen` VARCHAR(150) NULL,
  `ubicacion` TEXT NULL,
  `como_llegar` TEXT NULL,
  `categoria` ENUM('naturales', 'culturales') NOT NULL,
  `imagen` VARCHAR(255) NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `lugares` (`nombre`, `resumen`, `origen`, `ubicacion`, `como_llegar`, `categoria`, `imagen`) VALUES
('Mirador Adan Aparicio', 'Mirador natural con vista panorámica.', 'San Miguel el Grande', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d36135.61364334841!2d-97.65652296706615!3d17.037597080027627!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85c7d21cb0d027f9%3A0x7a9ab6b541095197!2sMirador%20Adan%20Aparicio!5e1!3m2!1ses!2smx!4v1773411712032!5m2!1ses!2smx', 'Subir por el camino de terracería, Pasando el tecnologico.', 'naturales', 'cerro-sol.jpg'),
('Iglesia de San Miguel Arcángel', 'Cultural de San Miguel el Grande.', 'San Miguel el Grande', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2184.123621176802!2d-97.62315307238542!3d17.046224640049648!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85c7d1f0add4653d%3A0xa7fe0f44d593657e!2sIglesia%20de%20San%20Miguel%20Arc%C3%A1ngel!5e1!3m2!1ses!2smx!4v1773413227122!5m2!1ses!2smx', 'Ha 10 metros del palacio municipal.', 'culturales', 'inglesia.jpg'),
('Casa de la Cultura', 'La Casa de la Cultura es el corazón cultural de San Miguel el Grande.', 'San Miguel el Grande', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2184.123621176802!2d-97.62315307238542!3d17.046224640049648!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85c7d1f0add4653d%3A0xa7fe0f44d593657e!2sIglesia%20de%20San%20Miguel%20Arc%C3%A1ngel!5e1!3m2!1ses!2smx!4v1773413227122!5m2!1ses!2smx', 'Ha 10 metros del palacio municipal.', 'culturales', 'casa-cultura.jpg'),
('Cascada Esmeralda', 'Impresionante caída de agua de 30 metros con pozas de color turquesa.', 'San Miguel el Grande', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3860.123456789012!2d-97.61234567890123!3d17.02345678901234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85c7d1a1b2c3d4e5%3A0xf6e7d8c9b0a1f2e3!2sCascada%20Esmeralda!5e1!3m2!1ses!2smx!4v1773413227123!5m2!1ses!2smx', '15 minutos en auto desde el centro, luego 10 minutos caminando por sendero.', 'naturales', 'cascada-esmeralda.jpg'),
('Museo Comunitario', 'Espacio que resguarda piezas arqueológicas y tradiciones de la región.', 'San Miguel el Grande', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3860.234567890123!2d-97.63456789012345!3d17.03456789012345!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85c7d1b2c3d4e5f6%3A0xa1b2c3d4e5f6a7b8!2sMuseo%20Comunitario!5e1!3m2!1ses!2smx!4v1773413227124!5m2!1ses!2smx', 'Junto a la plaza principal, a un costado del palacio municipal.', 'culturales', 'museo-comunitario.jpg'),
('Mirador del Cerro', 'Punto panorámico con vista de 360 grados del valle y el pueblo.', 'San Miguel el Grande', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3860.345678901234!2d-97.64567890123456!3d17.04567890123456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85c7d1c3d4e5f6a7%3A0xb2c3d4e5f6a7b8c9!2sMirador%20del%20Cerro!5e1!3m2!1ses!2smx!4v1773413227125!5m2!1ses!2smx', 'Subir por la calle Independencia hasta el final, luego 200 escalones.', 'naturales', 'mirador-cerro.jpg'),
('Mercado de Artesanías', 'Mercado tradicional donde artesanos locales venden textiles, barro y alebrijes.', 'San Miguel el Grande', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3860.456789012345!2d-97.65678901234567!3d17.05678901234567!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x85c7d1d4e5f6a7b8%3A0xc3d4e5f6a7b8c9d0!2sMercado%20de%20Artesan%C3%ADas!5e1!3m2!1ses!2smx!4v1773413227126!5m2!1ses!2smx', 'Detrás de la iglesia principal, a 5 minutos caminando.', 'culturales', 'mercado-artesanias.jpg');

SET FOREIGN_KEY_CHECKS = 1;
