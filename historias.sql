-- phpMyAdmin SQL Dump
-- Base de Datos para el Módulo de Historias y Leyendas

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historias`
--

CREATE TABLE `historias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(255) NOT NULL,
  `tipo` enum('historia','leyenda') NOT NULL DEFAULT 'historia',
  `resumen` varchar(500) DEFAULT NULL,
  `contenido` text NOT NULL,
  `etiqueta` varchar(50) DEFAULT NULL,
  `creado_en` timestamp DEFAUlT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historias_imagenes`
--

CREATE TABLE `historias_imagenes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `historia_id` int(11) NOT NULL,
  `url_imagen` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_historia` (`historia_id`),
  CONSTRAINT `fk_historia_imagenes` FOREIGN KEY (`historia_id`) REFERENCES `historias` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- 
-- Datos de prueba para 'historias'
--
INSERT INTO `historias` (`titulo`, `tipo`, `resumen`, `contenido`, `etiqueta`) VALUES
('Los orígenes de Achiutla', 'historia', 'En la época prehispánica estos pueblos pertenecieron al reinado de Achiutla y en la época colonial, primero pertenecieron...', 'En la época prehispánica estos pueblos pertenecieron al reinado de Achiutla y en la época colonial, primero pertenecieron a la encomienda de Francisco de las Casas, después pasaron a la corona española. Se relata la fundación del pueblo y el sincretismo cultural que dió origen a San Miguel el Grande. El clima de entonces fue fundamental para el desarrollo agrícola.', 'Historia Local'),
('El Llano de Borrego', 'leyenda', 'Cuentan que anteriormente este lugar se llamó llano de Borrego, inhabitado en aquel entonces y pastaban los animales...', 'En 1904, cuentan que anteriormente, este lugar se llamó llano de Borrego. El llano de Borrego estaba inhabitado en aquel entonces y como se pueden imaginar solo existía un llano en donde pastaban los animales principalmente los borregos. Un día una persona respetada platicó con los demás habitantes y les propuso la de idea comprar un santo en bulto para el lugar, el santo de nombre "El padre de Jesús de las tres caídas".', 'Leyenda Tradicional');

--
-- Datos de prueba para 'historias_imagenes'
--
INSERT INTO `historias_imagenes` (`historia_id`, `url_imagen`) VALUES
(1, '/mixteco/public/img/iglesia.jpg'),
(1, '/mixteco/public/img/paisaje_origen.jpg'),
(2, '/mixteco/public/img/iglesia.jpg');

-- Historias adicionales

INSERT INTO `historias` (`titulo`, `tipo`, `resumen`, `contenido`, `etiqueta`) VALUES

('El Mogote Sagrado', 'historia', 
'En la comunidad cercana a San Miguel el Grande existe un antiguo sitio arqueológico conocido como El Mogote.',
'En las montañas cercanas a San Miguel el Grande se encuentra un sitio arqueológico conocido como El Mogote. Según los ancianos del lugar, este sitio fue un antiguo asentamiento mixteco donde vivieron gobernantes y sacerdotes. La tradición oral dice que en este lugar fue enterrado un antiguo rey mixteco y que por esa razón el sitio es considerado sagrado por las comunidades cercanas. Muchos habitantes evitan alterar el lugar por respeto a los antepasados.', 
'Historia Local'),

('El Flechador del Sol', 'mito',
'Un antiguo mito mixteco cuenta la historia de un héroe que desafió al Sol para conquistar la tierra de la Mixteca.',
'Según la tradición mixteca, un héroe llamado Dzahuindanda nació en el árbol sagrado de Apoala. Cuando su pueblo buscaba un lugar para vivir, descubrió que la tierra de la Mixteca estaba dominada por el Sol. Para poder habitarla, desafió al astro en combate y logró vencerlo con sus flechas. Gracias a su valentía, el pueblo mixteco pudo establecerse en estas tierras y fundar sus primeras comunidades.', 
'Mitología Mixteca'),

('La Cueva de los Espíritus', 'leyenda',
'En los cerros cercanos al pueblo existe una cueva donde, según los ancianos, habitan los espíritus antiguos.',
'Cuenta la leyenda que en uno de los cerros cercanos a San Miguel el Grande existe una cueva profunda donde habitan los espíritus de los antiguos habitantes mixtecos. Se dice que durante la noche se escuchan voces y cantos provenientes del interior. Algunos pobladores aseguran que quienes entran sin respeto pueden perderse o salir enfermos, pues los espíritus protegen el lugar.', 
'Leyenda Local'),

('El Nahual del Cerro', 'leyenda',
'Durante generaciones los habitantes han contado historias sobre un nahual que habita en los cerros.',
'Los pobladores cuentan que hace muchos años un hombre tenía la capacidad de transformarse en animal durante la noche. Este nahual se convertía en coyote o perro grande y caminaba por los cerros vigilando el pueblo. Algunos dicen que protegía a la comunidad, mientras que otros creen que causaba miedo entre quienes viajaban de noche.', 
'Leyenda'),

('El Oráculo de Achiutla', 'historia',
'Achiutla fue considerado un centro sagrado en la época prehispánica donde existía un importante oráculo.',
'Antes de la llegada de los españoles, Achiutla fue uno de los centros religiosos más importantes de la cultura mixteca. En este lugar existía un oráculo donde los sacerdotes realizaban ceremonias y consultas espirituales. Los gobernantes y viajeros acudían al sitio para pedir consejo a los dioses antes de tomar decisiones importantes.', 
'Historia Mixteca'),

('El Tesoro Enterrado del Convento', 'leyenda',
'Se dice que durante la época colonial algunos tesoros fueron escondidos cerca del antiguo convento.',
'Cuando los españoles llegaron a la región y construyeron el convento dominico en Achiutla, algunos habitantes escondieron sus riquezas para evitar que fueran tomadas. La leyenda dice que hasta hoy existen monedas, piezas de oro y objetos antiguos enterrados cerca del antiguo convento. Muchas personas han intentado buscarlos, pero nadie ha encontrado el tesoro.', 
'Leyenda Colonial'),

('El Espíritu del Antiguo Campanario', 'leyenda',
'Algunos habitantes dicen escuchar las campanas de la iglesia sonar durante la madrugada.',
'En ciertas noches silenciosas, los habitantes aseguran escuchar las campanas del antiguo templo sonar sin que nadie esté en la iglesia. Los ancianos dicen que son las almas de antiguos pobladores que regresan a rezar o recordar su pueblo. Este fenómeno ha sido contado por generaciones como parte de las tradiciones del lugar.', 
'Relato Popular');

COMMIT;
