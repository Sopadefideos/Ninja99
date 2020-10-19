-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 20-06-2018 a las 15:09:19
-- Versión del servidor: 10.1.31-MariaDB
-- Versión de PHP: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `PWpractica`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `COMUNIDADES`
--

CREATE TABLE `COMUNIDADES` (
  `ID_COMUNIDAD` int(255) NOT NULL,
  `COMUNIDAD` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `COMUNIDADES`
--

INSERT INTO `COMUNIDADES` (`ID_COMUNIDAD`, `COMUNIDAD`) VALUES
(0, 'NULL'),
(1, 'Andalucia'),
(2, 'Aragón'),
(3, 'Asturias'),
(4, 'Islas Baleares'),
(5, 'Islas Canarias'),
(6, 'Cantabria'),
(7, 'Castilla la Mancha'),
(8, 'Castilla y León'),
(9, 'Cataluña'),
(10, 'Ceuta'),
(11, 'Extremadura'),
(12, 'Galicia'),
(13, 'La Rioja'),
(14, 'Madrid'),
(15, 'Melilla'),
(16, 'Murcia'),
(17, 'Navarra'),
(18, 'Pais Vasco'),
(19, 'Valencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ESTADO`
--

CREATE TABLE `ESTADO` (
  `CODIGO_ESTADO` int(1) NOT NULL,
  `NOMBRE_ESTADO` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `ESTADO`
--

INSERT INTO `ESTADO` (`CODIGO_ESTADO`, `NOMBRE_ESTADO`) VALUES
(0, 'ALTA'),
(1, 'BAJA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `FAMILIA`
--

CREATE TABLE `FAMILIA` (
  `CODIGO_FAMILIA` int(255) NOT NULL,
  `NOMBRE` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `FAMILIA`
--

INSERT INTO `FAMILIA` (`CODIGO_FAMILIA`, `NOMBRE`) VALUES
(0, 'HOMBRE CALZADO'),
(1, 'HOMBRE CAMISETA'),
(2, 'HOMBRE SUDADERA'),
(3, 'HOMBRE PANTALON'),
(4, 'SKATE COMPLETO'),
(5, 'TABLA SKATE'),
(6, 'MUJER_CALZADO'),
(7, 'MUJER_CAMISETA'),
(8, 'MUJER_PANTALON'),
(9, 'MUJER_CHAQUETA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `LINEA_PEDIDO`
--

CREATE TABLE `LINEA_PEDIDO` (
  `CODIGO_LINEA_PEDIDO` int(11) NOT NULL,
  `CODIGO_PEDIDO` int(11) NOT NULL,
  `PRODUCTO` int(11) NOT NULL,
  `CANTIDAD` int(11) NOT NULL,
  `PRECIO_BASE` decimal(5,2) NOT NULL,
  `IMPUESTO` decimal(2,2) NOT NULL,
  `GASTOS_ENVIO` decimal(2,2) NOT NULL,
  `TOTAL_LINEA` decimal(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `MODO_PAGO`
--

CREATE TABLE `MODO_PAGO` (
  `CODIGO_PAGO` int(11) NOT NULL,
  `NOMBRE` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `MODO_PAGO`
--

INSERT INTO `MODO_PAGO` (`CODIGO_PAGO`, `NOMBRE`) VALUES
(1, 'Transferencia'),
(2, 'Pago con Tarjeta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PEDIDO`
--

CREATE TABLE `PEDIDO` (
  `CODIGO_PEDIDO` int(255) NOT NULL,
  `USUARIO` int(255) NOT NULL,
  `FECHA_COMPRA` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  `FECHA_PAGO` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `FECHA_ENVIO` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `COMUNIDAD` int(255) NOT NULL,
  `PROVINCIA` int(255) NOT NULL,
  `CALLE` varchar(255) COLLATE utf8_bin NOT NULL,
  `NUMERO` int(255) NOT NULL,
  `PISO` int(255) NOT NULL,
  `PUERTA` int(255) NOT NULL,
  `CODIGO_POSTAL` varchar(255) COLLATE utf8_bin NOT NULL,
  `IMPUESTO` decimal(2,2) NOT NULL,
  `GASTOS_ENVIO` decimal(2,2) NOT NULL,
  `TOTAL_PEDIDO` decimal(5,2) NOT NULL,
  `MODO_PAGO` int(255) NOT NULL,
  `ESTADO` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `PEDIDO`
--

INSERT INTO `PEDIDO` (`CODIGO_PEDIDO`, `USUARIO`, `FECHA_COMPRA`, `FECHA_PAGO`, `FECHA_ENVIO`, `COMUNIDAD`, `PROVINCIA`, `CALLE`, `NUMERO`, `PISO`, `PUERTA`, `CODIGO_POSTAL`, `IMPUESTO`, `GASTOS_ENVIO`, `TOTAL_PEDIDO`, `MODO_PAGO`, `ESTADO`) VALUES
(17, 1, '2018-06-20 06:00:21', '2018-06-20 05:50:39', '2018-06-15 05:50:45', 3, 12, 'alcala del valle', 1, 0, 0, '51002', '0.21', '0.01', '0.00', 1, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PRODUCTO`
--

CREATE TABLE `PRODUCTO` (
  `CODIGO_INTERNO` int(11) NOT NULL,
  `REF_FABRICANTE` varchar(11) COLLATE utf8_bin NOT NULL,
  `MARCA` varchar(255) COLLATE utf8_bin NOT NULL,
  `MODELO` varchar(255) COLLATE utf8_bin NOT NULL,
  `DESCRIPCION` varchar(700) COLLATE utf8_bin NOT NULL,
  `FAMILIA` int(11) NOT NULL,
  `PRECIO` decimal(11,2) NOT NULL,
  `TIPO_IMPOSITIVO` decimal(2,2) NOT NULL,
  `GASTOS_ENVIO` decimal(2,2) NOT NULL,
  `STOCK` int(11) NOT NULL,
  `FOTOGRAFIA` varchar(255) COLLATE utf8_bin NOT NULL,
  `ESTADO` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `PRODUCTO`
--

INSERT INTO `PRODUCTO` (`CODIGO_INTERNO`, `REF_FABRICANTE`, `MARCA`, `MODELO`, `DESCRIPCION`, `FAMILIA`, `PRECIO`, `TIPO_IMPOSITIVO`, `GASTOS_ENVIO`, `STOCK`, `FOTOGRAFIA`, `ESTADO`) VALUES
(1, 'AD39703', 'Adidas', 'Lucas Premiere core-black core-black-gum', 'El aspecto del Lucas Premiere ADV está inspirado en los zapatos de voleibol vintage, dándoles un aspecto atemporal y retro. Estos zapatos están diseñados teniendo en cuenta el rendimiento de la patineta y tienen una puntera de una sola pieza hecha en gamuza de alta calidad, lo que permite más flick y durabilidad. La cinta de goma en la parte delantera del pie aumenta enormemente la vida útil general. Las tres rayas tienen un gran panel de malla debajo de ellas para un excelente sistema de ventilación interno.', 0, '57.00', '0.21', '0.01', 5, 'adidas-skateboarding-lucas-premiere-core-black-core-black-gum-skateboarding-by3934_2.jpg', 0),
(2, 'NK93810', 'Nike SB', 'Blazer Vapor TXT', 'Buscando el equilbrio entre el diseño de calidad y la innovación sin precedentes, Nike Skateboarding se ha comprometido a servir de inspiración y apoyo al mundo del skateboarding. Con su propio equipo de skate profesional, encabezado por el atleta de la firma Paul Rodríguez, Nike Skateboarding fabrica una línea de zapatillas de deporte y ropa y presenta las zapatillas de skate clásicas Dunk en una gama actualizada de colores, junto con los estilos más novedosos de la marca.', 0, '65.99', '0.21', '0.01', 6, 'Nike SB Blazer Vapor TXT.jpg', 0),
(3, 'NK31562', 'Nike SB', 'Dri-Fit SB Logo White T-Shirt', 'La camiseta Nike SB Dri-FIT Logo para hombre combina estilo y funcionalidad. Serigrafía con logo Nike en el frontal para darle un toque atlético. La camiseta tiene corte regular y cuello acanalado redondo. Está hecha de tejido Dry-FIT para matenerte caliente y seco durante todo el día. ¡La elección perfecta!', 1, '20.00', '0.21', '0.01', 14, 'Nike-SB-Dri-Fit-SB-Logo-White-T-Shirt-_143352-front-CA.jpg', 0),
(4, 'NK85028', 'Nike SB', 'Icon T-shirt White-Black', 'Logotipo de Nike SB camiseta de los hombres combina el tacto suave del tejido de punto con la tecnología que absorbe el sudor para mantenerte seco y cómodo.', 1, '18.00', '0.21', '0.01', 15, 'nike-sb-gm-icon-t-shirt-white-black-1.1506694056.jpg', 0),
(5, 'NK56129', 'Nike SB', 'Little dude T-shirt shark-black', 'Esta camiseta recibe su nombre del grabado \"Little Dude\" de Geoff McFetridge en el logo de Nike SB. Aparte de la obra de arte rad, esta camiseta también ofrece una tela que absorbe el sudor que es súper suave y tiene un gran ajuste moderno.', 1, '21.50', '0.21', '0.01', 13, 'nike-sb-little-dude-t-shirt-shark-black-1.1507100643.jpg', 0),
(6, 'OS12905', 'Osiris', 'Alle Schuhe Relic black-grey-gum-Vorderansicht', 'Estos zapatos fueron lanzados como parte de la \"colección de estilo de vida\" de Osiris. Estos zapatos están hechos de una combinación de cuero nobuck sintético y malla, lo que lo convierte en una silueta extremadamente cómoda. El área ollie está reforzada y la puntera y el panel lateral están perforados para un ajuste transpirable en su pie.', 0, '71.50', '0.21', '0.01', 3, 'Osiris-Alle-Schuhe-Relic-black-grey-gum-Vorderansicht_600x600@2x.jpg', 0),
(7, 'EL52684', 'Element', 'Tabla de skate Ashbury Twig Logo', 'Element fue fundada en Atlanta en el año 1992, y desde entonces siempre se ha considerado una de las marcas más auténticas y honestas del mundillo del skateboarding. Los años de experiencia de esta marca se ven reflejados en la calidad de sus productos.', 5, '38.75', '0.21', '0.01', 6, 'tabla-de-skate-element-ashbury-twig-logo-775-skateboard-D_NQ_NP_741825-MLA25509180787_042017-F.jpg', 0),
(8, 'AL85968', 'Alien-WorkShop', 'Tabla Skate Missing link', 'Tabla de skate con diseño alien. Hace alusión a la intervencion de nuestros amigos espaciales en la creacion de trucos perfectos en tu zona. No la dejes escapar.', 5, '40.00', '0.21', '0.01', 5, 'tabla-skate-alien-workshop-missing-link-8-125.jpg', 0),
(9, 'BK42684', 'Baker', 'Tabla Skate Baker Fluoro-green', 'Baker Skateboards se fundó en 1999 por nada más y nada menos que Andrew Reynolds. Las tablas demuestran una compañía muy honesta, que apoya totalmente la cultura del skate y disfrutan de una gran reputación. El proceso de producción se basa totalmente en las siete capas de madera de arce, que le dan estabilidad y mucho pop desde los inicios del skate.', 5, '45.00', '0.21', '0.01', 7, 'tabla-skate-baker-fluoro-green.jpg', 0),
(10, 'BT93710', 'Blue Tomato', 'BT Logo 7.5 Skate Completo', 'Tanto si eres un skater principiante o avanzado, esta tabla es perfecta para cualquier estilo. Los mejores materiales y una fabricación de calidad te aseguran el máximo disfrute. El diseño atemporal hace el resto, con bloques de color en madera negra y oscura.\r\n\r\nBlue Tomato le da mucha importancia a las pautas internacionales de protección del medio ambiente durante la producción.', 4, '80.00', '0.21', '0.01', 4, 'BT+Logo+7+5+Complete.jpg', 0),
(11, 'DK34683', 'Darkstar', 'Cosmic FP 8.0 Premium Skate Completo', 'Con la serie first push, Darkstar ha desarrollado una nueva gama de tablas completas especialmente pensada para principiantes, para asegurarse el mejor rendimiento y diversión a un precio razonable. Los mejores materiales y una construcción sólida que te aseguran el máximo disfrute, sin importar el terreno. Pero lo mejor es que esta tabla está lista para ser usada nada más salir de la caja.', 4, '98.00', '0.21', '0.01', 6, 'DarkstarCosmic+FP+8+0+Prem+Complete.jpg', 0),
(12, 'JA33859', 'Jart', 'Grenade 8.0 HC Skate Completo', 'Jart Skateboards se fundó en 2001 en España, y es conocida por su calidad en la fabricación y su fantástico rendimiento. Además, la producción está preparada para cumplir con las directivas internacionales en protección del medio ambiente. Con esta tabla, tendrás la calidad de Jart a un precio fantástico. Una tabla genial perfecta para cualquier nivel de riding.', 4, '110.00', '0.21', '0.01', 3, 'Grenade+8+0+HC+CompleteJart.jpg', 0),
(13, 'TK99365', 'Trick', 'Peace 8.0 MC Skate Complete', 'No te puedes equivocar con esta tabla completa de Tricks. La calidad elaborada de sus componentes y su diseño clásico la hacen una tabla muy atractiva para los principiantes que quieren progresar y aprender trucos nuevos.', 4, '75.00', '0.21', '0.01', 4, 'Tricks+Peace+8+0+MC+Complete.jpg', 0),
(14, 'BL44839', 'Blind', 'OG Athletic Skin 8.0 FP Premium Skate Completo', 'Con la primera serie push, Blind ha desarrollado una nueva gama de tablas completas especialmente pensada para principiantes, para asegurarse el mejor rendimiento y diversión a un precio razonable. Los mejores materiales y una construcción sólida que te aseguran el máximo disfrute, sin importar el terreno. Pero lo mejor es que esta tabla está lista para ser usada nada más salir de la caja.', 4, '107.00', '0.21', '0.01', 3, 'BlindOG+Athletic+Skin+8+0+FP+Prem+Complete.jpg', 0),
(15, 'BH55569', 'Birdhouse', 'Skull II 7.75 Stage3 Skate Completo', 'Skate completo apto para cualquier nivel.', 4, '123.00', '0.21', '0.01', 5, 'BirdhouseSkull+II+7+75+Stage3+Complete.jpg', 0),
(16, 'TM12906', 'Toy Machine', 'Toy Division 8.0 Skate Completo', 'Toy Machine es muy conocida por sus diseños locos y gráficos expresivos en sus tablas. Fundada por Ed Templeton en 1993, la compañía sigue siendo una de las más influyentes y exitosas del panorama. La Toy Division es un clásico, una tabla completa de alta calidad sin tonterías, que solo necesita que le des caña.', 4, '95.00', '0.21', '0.01', 6, 'Toy-MachineToy+Division+8+0+Complete.jpg', 0),
(17, 'SC19444', 'Santa Cruz', 'Wave Dot 7.75 Skate Completo', 'Santa Cruz es la compañía de skateboarding más vieja del mundo. Muchos adelantos técnicos han venido de la mano de esta compañía, así como algunos de los gráficos más míticos de la historia. La famosa \"Screaming Hand\" de Jim Phillips es legendaria en la escena del patín desde hace muchísimo tiempo. Y en términos de calidad, no se puede negar que Santa Cruz siempre ha sido conocida por imprimirla en todos sus productos.', 4, '110.75', '0.21', '0.01', 4, 'Santa-CruzWave+Dot+7+75+Complete.jpg', 0),
(18, 'RD24873', 'Rip N Dip', 'Table Lord Nermal 8.25', 'Desde 2009, Ripndip soprende al mundo con sus diseños inusuales, sus logos y todo tipo de locuras. Por otro lado, siempre hay un núcleo de mejor calidad bajo la superficie de creatividad. Tanto para la ropa como para las tablas de skate.', 5, '53.60', '0.21', '0.01', 3, 'Rip-N-Dip-Lord+Nermal+Board+8+25+Skate+Deck.jpg', 0),
(19, 'NK66689', 'Nike SB', 'Zoom Stefan Janoski', 'Las zapatillas Nike Zoom Stefan Janoski: Máxima comodidad con un diseño discreto. Las Nike SB Zoom Stefan Janoski Sneaker nacen de la mente de una leyenda del skate inovativa. Reunen un aspecto minimalista y la máxima amortiguación. La construcción duradera y un agarre óptimo hace que las zapatillas se ajusten mejor al pie y aumentan el control sobre la tabla.', 0, '87.00', '0.21', '0.01', 7, 'Zoom+Stefan+Janoski+Zapatillas+de+skate.jpg', 0),
(20, 'DC14148', 'DC', 'Tonik SE Sneakers', 'Las Tonik SE de DC son la combinación perfecta entre unas zapatillas de skate y unas zapatillas normales. Gracias a su superficie exterior de ante podrás realizar trucos mucho más altos. Los agujeros de ventilación hacen que la zapatillas sea muy transpirable y previenen el olor y el sudor. Además disponen de unas suelas de goma resistentes a la abrasión.', 0, '68.00', '0.21', '0.01', 2, 'DCTonik+SE+Sneakers.jpg', 0),
(21, 'GB68942', 'Globe', 'Encore 2', 'La zapatilla Globe Encore 2, con su estilo clásico sin adornos, sin duda hará que tu corazón de skater lata más rápido. Su estilo deportivo va genial con cualquier prenda, y cumple todas las exigencias de una zapatilla de skate duradera. La suela de goma vulcanizada garantiza un agarre perfecto y una gran duración. Zonas expuestas como el empeine no solo están bien cosidas, son extremadamente duraderas. Los tobillos acolchados y las suelas blandas protegen tus articulaciones durante las caidas y los aterrizajes más duros.', 0, '58.00', '0.21', '0.01', 4, 'GlobeEncore+2+Zapatillas+de+skate.jpg', 0),
(22, 'AD16689', 'Adidas', 'Superstar', 'Estas zapatillas setenteras empezaron su vida como las jefas de las pistas de basket. No tardaron mucho en infiltrarse en el mundo del skate y la moda urbana (sin mencionar la escena hip-hop). Estas zapatillas para hombre mantienen un look clásico gracias a su superficie exterior de piel. Las Superstar de adidas Originals tienen todos los detalles auténticos, incluyendo los remates en zigzag en las 3 Rayas y las punteras de goma. Estas zapatillas tienen que formar parte de tu colección. ¡No te las pierdas!', 0, '95.50', '0.21', '0.01', 7, 'AdidasSuperstar+Sneakers.jpg', 0),
(23, 'VN14356', 'Vans', 'Center Court Gilbert Crockett 2', 'La Zapatilla signature de Gilbert Crocket, la Gilbert Crockett Pro, con exterior de ante y loneta con la raya lateral clásica de Vans, con UltraCush HD para el máximo nivel de absorción de impactos, puntera de goma reforzada Duracap™ para la mayor durabilidad, y construcción Vans Wafflecup™, la primera cupsole vulcanizada, para una sujeción máxima y reactiva, todo esto encima de la suela Vans Original Waffle para aumentar la estabilidad.', 0, '75.99', '0.21', '0.01', 5, 'VansCenter+Court+Gilbert+Crockett+2+Pro+Skat.jpg', 0),
(24, 'NK44689', 'Nike SB', 'Zoom Stefan Janoski Canvas Deconstructed', 'Exterior de loneta deconstruido que ofrece un tacto muy ligero. La unidad Zoom Air del forro tiene un acolchado muy reactivo. El exterior de goma con dibujo de espiguilla le da un gran agarre. El forro moldeado con unidad Zoom Air integrada en el talón le da un acolchado adicional. La construcción tradicional con autoclave fusiona la suela al exterior para conseguir un look más refinado y una experiencia más cercana al suelo. \r\nLa goma de tres colores te da un toque alegre con cada paso.', 0, '104.00', '0.21', '0.01', 6, 'NikeSBZoom+Stefan+Janoski+Canvas+Deconstructed+S+S.jpg', 0),
(25, 'NK22446', 'Nike SB', 'Stefan Janoski Max', 'Diseñadas gracias a la experiencia y orientadas al skate de leyenda, las Stefan Janoski Max proporcionan una protección excelente ante impactos. Un ride natural con una unidad Max Air bajo el talón y un gran flex son solo algunas de sus claves. La revolucionaria suela Air de Nike se abrió camino hacia el calzado de Nike a finales de los 70. En 1987, debutó la Nike Air Max 1 con una cámara de aire visible en su talón, permitiendo a sus fans sentir y ver la comodidad de la suela Air. Desde entonces, la siguiente gneración de Nike Air Max se ha convertido en todo un éxito entre atletas y aficionados, ofreciendo una impactante combinación de colores y un acolchado fiable y ligero.', 0, '100.00', '0.21', '0.01', 3, 'NikeSBStefan+Janoski+Max+Sneakers.jpg', 0),
(26, 'NK84928', 'Nike SB', 'Nyjah Free', 'El skater mejor pagado del mundo, Nyjah Imani Huston, comparte su valor contigo y te trae la Nike SB Nyjah Free. La Zapatilla Signature te da toda la seguridad que necesitas para intentar trucos imposibles. La capa de goma exterior extremadamente robusta te da la sujeción y protección necesaria, mientras la nueva suela reacciona al impacto del pie. Su perfil ajustado y duradero se ajusta al pie perfectamente.', 0, '120.50', '0.21', '0.01', 2, 'NikeNyjah+Free+Zapatillas+de+skate.jpg', 0),
(27, 'VN99382', 'Vans', 'Kyle Walker Pro', 'Las zapatillas Vans Kyle Walker Pro incorporan la innovadora suela Vans WaffleCup, una construcción revolucionaria que ofrece el tacto de las suelas Vulc con la sujeción de las Cupsole. Además de eso, este pro model viene con el forro UltraCush HD que mantiene el pie cerca de la tabla dándote el máximo nivel de absorción de impactos. El DURACAP protege la puntera cada vez que hagas un ollie o un flip. Esta zapatilla está hecha para patinar.', 0, '88.99', '0.21', '0.01', 7, 'VansKyle+Walker+Pro+Zapatillas+de+skate.jpg', 0),
(28, 'VN11945', 'Vans', 'Slip On Pro Mocasins', 'La Slip-On 59 Pro es una zapatilla de skate clásica de Vans con inspiración en la Era 59. Una zapatilla perfecta para cualquier ocasión en ante con forro y detalles en pana.', 0, '77.00', '0.21', '0.01', 6, 'VansSlip+On+Pro+Mocasins.jpg', 0),
(29, 'TH39145', 'Thrasher', 'Flame Camiseta', 'Si conoces mínimamente el mundo del skateboarding ya habrás oído hablar de Thrasher, seguro. Muestra lo que amas el deporte del patín con la camiseta Flame de Thrasher.', 1, '25.50', '0.21', '0.01', 13, 'ThrasherFlame+Camiseta.jpg', 0),
(30, 'PT48395', 'Patagonia', 'Logo Responsibili Camiseta', 'Patagonia lo mantiene sencillo, con un estilo casual en esta camiseta Line Logo Badge. Hecha de 50% algodón reciclado y 50% poliéster reciclado, el tejido te asegura un tacto suave y fresco.', 1, '21.75', '0.21', '0.01', 11, 'PatagoniaP+6+Logo+Responsibili+Camiseta.jpg', 0),
(31, 'TH99345', 'Thrasher', 'Flame Sudadera con capucha', 'La Revista de Skate Thrasher se fundó en 1981, y es la revista de skate más antigua que existe. Por eso la Sudadera Flame de Thrasher es un clásico absoluto, y ha acompañado a las leyendas del skate durante muchos años.\r\nEl forro de fibra le da una comodidad excelente, con un diseño en color negro con el icónico logo de Thrasher en llamas serigrafiado en el pecho.', 2, '46.00', '0.21', '0.01', 8, 'ThrasherFlame+Sudadera+con+capucha.jpg', 0),
(32, 'RD55738', 'Rip N Dip', 'Lord Nermal Pocket Camiseta', 'Gran camiseta fresca con detalles de la marca Rip N Dip en el bolsillo, ideal para lucilar en el skatepark de tu zona.', 1, '30.00', '0.21', '0.01', 10, 'Rip-N-DipLord+Nermal+Pocket+Camiseta.jpg', 0),
(33, 'TH33857', 'Thrasher', 'Atlantic Drift Camiseta', 'La camiseta Atlantic Drift de Thrasher no puede faltar en tu armario. Esta camiseta de manga corta es todo un clásico. Su cuello es redondo y cuenta con el logo de Thrasher impreso en el pecho. Con esta prenda podrás convertir cualquiera de tus modelitos en una obre de arte.', 1, '25.00', '0.21', '0.01', 16, 'ThrasherAtlantic+Drift+Camiseta.jpg', 0),
(34, 'HR34835', 'Hurley', 'Turtle Camiseta', 'Hay pocos animales más relajados que las tortugas. Esta camiseta captura su esencia. Con un gran estampado de una tortuga en la espalda y el texto \"Born to chill\" en el pecho. ¡Perfecta para los días relajados! ', 1, '22.50', '0.21', '0.01', 10, 'HurleyTurtle+Camiseta.jpg', 0),
(35, 'FL57939', 'Fila', 'Thomas Sudadera con capucha', 'Fila combina el estilo urbano con un look deportivo. La Sudadera oldschool pero moderna Thomas viene con capucha ajustable y logo Fila estampado.', 2, '40.00', '0.21', '0.01', 8, 'FilaThomas+Sudadera+con+capucha.jpg', 0),
(36, 'RD22914', 'Rip N Dip', 'Spaced Out Pocket Camiseta', 'Con esta camiseta seras realmente abducido y llevado al mejor park del espacio exterior. De color negra y con un diseño moderno.', 1, '25.00', '0.21', '0.01', 14, 'Rip-N-DipSpaced+Out+Pocket+Camiseta.jpg', 0),
(37, 'TH94853', 'Thrasher', 'Skate Goat Camiseta', 'La Skate Goat de Thrasher te dejará con la boca abierta gracias a su impactante gráfico delantero. Esta camiseta no puede faltar en el armario de ningún skater auténtico. Además su corte holgado y su suave tejido te resultarán comodísimos.', 1, '30.00', '0.21', '0.01', 18, 'ThrasherSkate+Goat+Camiseta.jpg', 0),
(38, 'FL58764', 'Fila', 'Settanta Chaqueta de chandal', 'Chaqueta estilo de los 80S de Fila con Cuello, puños y dobladillo acanalados y\r\nparche con etiqueta en el pecho.', 2, '43.00', '0.21', '0.01', 9, 'FilaSettanta+Chaqueta+de+chandal.jpg', 0),
(39, 'SC58590', 'Santa Cruz', 'Oval Dot Camiseta', 'La Camiseta Oval Dot de Santa Cruz combina el estilo californiano del surf, con el skate old school, heciéndola perfecta para el skatepark.', 1, '23.50', '0.21', '0.01', 18, 'SantaCruzOval+Dot+Camiseta.jpg', 0),
(40, 'HU99484', 'HUF', 'Triple Triangle Camiseta', 'Un diseño sencillo pero interesante que no destaca demasiado. 100% algodón, Gráfico serigrafiado, Logo en la espalda y en el pecho.', 1, '20.00', '0.21', '0.01', 10, 'HUFTriple+Triangle+Camiseta.jpg', 0),
(41, 'NK11887', 'Nike SB', 'Pelican Camiseta', 'Esta camiseta Nike SB para hombre combina el tacto suave del algodón con un diseño de manga corta y cuello redondo, con corte clásico y una comodidad duradera.', 1, '30.00', '0.21', '0.01', 13, 'NikeSB+Pelican+Camiseta.jpg', 0),
(42, 'DC86749', 'DC', 'Worker Straight Pantalones cortos', 'Corte clásico en este pántalon chino para tus aventuras diarias. Pantalón corto DC Worker Straight, Corte Chino. Solapa con cremallera de metal, Trabillas para el cinturón y Parche con logo DC-\r\n', 3, '40.00', '0.21', '0.01', 9, 'DCWorker+Straight+20+5+Pantalones+cortos.jpg', 0),
(43, 'DC32853', 'DC', 'Rpstp Cargo Pantalones cortos', 'Un clásico que sin duda deberías conocer. Una gran comodidad combinada con mucho espacio de almacenamiento. No hace falta que lleves la mochila siempre.', 3, '45.00', '0.21', '0.01', 8, 'DCRpstp+Cargo+21+Pantalones+cortos.jpg', 0),
(44, 'SC93845', 'Santa Cruz', 'Classic Dot Camiseta', 'Santa Cruz no necesita características extremadamente grandes, brillantes o chillonas para llamar la atención. Por consiguiente, la camiseta Classic Dot tan solo tiene el icónico logo de la marca en el pecho y en la espalda, lo que tiene el poder suficiente para llamar la atención.', 1, '30.50', '0.21', '0.01', 13, 'SantaCruzClassic+Dot+Camiseta.jpg', 0),
(45, 'VC88379', 'Volcom', 'Frickin Modern Stretch Pantalones cortos', 'Con los Volcom Frickin Modern Stretch Chino Shorts estarás a la última y preparado para los días de calor. No hace falta decir que este pantalón viene con detalles clásicos de Volcom, como la costura trasera característica y detalles con el logo de Volcom.', 3, '43.75', '0.21', '0.01', 8, 'VolcomFrickin+Modern+Stretch+Pantalones+cortos.jpg', 0),
(46, 'VC29384', 'Volcom', 'Caden Camisa', 'No es solo para leñadores o amantes de la naturaleza, la Camisa Caden se hizo para las calles de tu ciudad. Lleva tu estilo urbano al siguiente nivel con esta camisa de cuadros hecha 100% de algodón, y tendrás la cantidad justa de estilo.', 1, '36.99', '0.21', '0.01', 10, 'VolcomCaden+Camisa.jpg', 0),
(47, 'BB67485', 'Billabong', 'Outsider Pockets Pantalones cortos', 'Pantalón de 5 bolsillos, Tejido elástico, Etiqueta trasera integrada en el cinturón, Etiqueta de tela y botones con logo.', 3, '43.50', '0.21', '0.01', 8, 'BillabongOutsider+5+Pockets+Pantalones+cortos.jpg', 0),
(48, 'AD28867', 'Adidas', 'Clubhouse Camiseta', 'Debido a su material hecho de algodón puro, esta camiseta clubhouse de manga corta de adidas Originals proporciona una sensación pura y seca durante tus sesiones de skate. El logotipo típico de adidas Trefoil en el pecho izquierdo y el diseño sofisticado con rayas de colores garantizan la dosis correcta de estilo de la calle.', 1, '30.00', '0.21', '0.01', 11, 'AdidasClubhouse+Camiseta.jpg', 0),
(49, 'CA12345', 'Carhartt', 'Bib Overall Straight Jeans', 'Deja de soñar con los 90 - han vuelto y parece que para quedarse Hazte con este peto de Carhartt WIP y lleva ese look de carpintero durante todo el verano. Súper cómodo y con mucho estilo - ¿qué más podrías pedir? Esta prenda moderna de los 90 viene con dos bolsillos separados en el pecho, botones personalizados y un pequeño parche cuadrado en el bolsillo del pecho. Una prenda muy moderna que no puede faltar en tu armario este verano.', 8, '87.45', '0.21', '0.01', 10, 'carharttBib+Overall+Straight+Jeans.jpg', 0),
(50, 'EL73294', 'Element', 'Weekend Shorts', 'WEEKEND SHORTS - OVERALL DENIM SHORTS BY ELEMENT', 8, '36.89', '0.21', '0.01', 7, 'ElementWeekend+Shorts.jpg', 0),
(51, 'RC97384', 'Rip Curl', 'Lagoon Jeans', 'El Pantalón Lagoon de Rip Curl es algo muy especial. Viene con una palmera bordada en el bolsillo trasero, aspecto lavado y puños para un ajuste personalizado. Es muy cómodo, sin dejar de ser un pantalón vaquero.', 8, '56.39', '0.21', '0.01', 20, 'RipCURLLagoon+Jeans.jpg', 0),
(52, 'RX94623', 'Roxy', 'Easy Peasy Pantalones', 'Corte relajado, Tejido muy ligero, Cintura y tobillos elásticos, Dos bolsillos en las caderas, Logo de metal', 8, '51.00', '0.21', '0.01', 5, 'RoxyEasy+Peasy+Pantalones.jpg', 0),
(53, 'RX34462', 'Roxy', 'Tropi Call Jeans', 'Los vaqueros Roxy Tropi Call son el pantalón perfecto para el verano para pasar los días de sol en la playa y las noches de calor. Como está hecho de puro algodón, el tejido vaquero generalmente se adhiere a la piel. Además, el corte suelto te garantiza una experiencia fantástica, incluso en los días de calor. Este pantalón también impresiona con su diseño vaquero atemporal, que nunca pierde su atractivo. Su elegante cordón te asegura que el pantalón siempre está en su sitio, incluso si bailas con la música del verano con tus amigos en la playa o después de un día largo de actividad. ¡Pura sensación de verano!', 8, '36.99', '0.21', '0.01', 7, 'RoxyTropi+Call+Jeans.jpg', 0),
(54, 'AD56327', 'Adidas', 'Deerupt Sneakers', 'Con las últimas innovaciones de adidas para el running, la Deerupt de adidas Originals trae un estilo dinámico para la calle. Esta zapatilla está hecha de un tejido flexible con una gran sujeción y comodidad.', 6, '67.00', '0.21', '0.01', 8, 'adidasDeerupt+Sneakers.jpg', 0),
(55, 'CV24673', 'Converse', 'Chuck Taylor All Star Zapatillas deportivas Women', 'Creada en 1917 como una zapatilla de baloncesto antideslizante, la All Star fue promocionada originalmente por su rendimiento en las pistas gracias al maestro del basket Chuck Taylor. Pero a lo largo de los años ha sucedido algo increíble: La zapatilla, con su silueta atemporal y el parche inconfundible del tobillo, fue adoptada por los rebeldes, los artistas, músicos, soñadores, pensadores y creativos.\r\n\r\nConverse se ha ganado una fama bien merecida en el último siglo y ahora ocupa un lugar muy especial en el corazón de todos los amantes de las zapatillas. Probablemente sea por el estilo inconfundible de Converse o su comodidad imbatible. No lo sabemos. Pero lo que es seguro es que las zapa', 6, '50.00', '0.21', '0.01', 4, 'conversChuck+Taylor+All+Star+Zapatillas+deportivas+Women.jpg', 0),
(56, 'VN23786', 'Vans', 'Marvel Sk8 Hi Sneakers', 'Allá por 2013, sacaron su primera colección, inmortalizando a todos los héroes de la infancia en un par de zapatillas. El segundo intento este año demuestra lo que pasa cuando un gigante de las zapatillas de skate y una leyenda del cómic como Marvel unen sus fuerzas. Esta prometedora mezcla renace y te da las siluetas más famosas de Vans, con nuevos colores y diseños heróicos. \r\n\r\nPara las Marvel Sk8-Hi han tomado cada detalle que hace que la Vans sea tan original, pero con un toque nuevo de diseño. El exterior más que probado aumenta la resistencia de las zapatillas incluso en las condiciones más duras. Una puntera reforzada para garantizar la durabilidad, y plantilla y lengüeta acolchadas ', 6, '90.46', '0.21', '0.01', 3, 'VansMarvel+Sk8+Hi+Sneakers.jpg', 0),
(57, 'NK23497', 'Nike SB', 'Zoom Stefan Janoski Zapatillas de skate', 'Las zapatillas Nike Zoom Stefan Janoski: Máxima comodidad con un diseño discreto. Las Nike SB Zoom Stefan Janoski Sneaker nacen de la mente de una leyenda del skate inovativa. Reunen un aspecto minimalista y la máxima amortiguación. La construcción duradera y un agarre óptimo hace que las zapatillas se ajusten mejor al pie y aumentan el control sobre la tabla', 6, '85.00', '0.21', '0.01', 6, 'NikeSbZoom+Stefan+Janoski+Zapatillas+de+skate (1).jpg', 0),
(58, 'AS82769', 'Asics', 'Gel Kayano Trainer Knit ', 'Una continuación del legendario Asics Gel-Kayano Trainer y diseñado para mujeres, estas zapatillas no solo son tan cómodas, sino que son tan elegantes como su predecesora. Su diseño minimalista y sin costuras con una parte superior de malla transforma a estos corredores deportivos en zapatillas de deporte cotidianas. La construcción monosock proporciona un ajuste perfecto y la entresuela Solyte los hace súper livianos. Con Tigerstripes soldados para una auténtica mirada Asics.', 6, '64.65', '0.21', '0.10', 10, 'ASiicGel+Kayano+Trainer+Knit+Zapatillas+deportivas+Women.jpg', 0),
(59, 'VN91853', 'Vans', 'Thanks+Coach+Long+MTE+Chaqueta.jpg', 'La Chaqueta Thanks Coach Long MTE de Vans combina la funcionalidad con el estilo Californiano clásico de Vans. Esta chaqueta tiene relleno sintético para mejorar el aislamiento, y es el cruce perfecto entre una chaqueta de invierno y de verano. Tendrás todo el estilo de una chaqueta de entrenador, pero estando siempre caliente y seco. ¡Gana siempre! ', 9, '56.00', '0.21', '0.01', 12, 'vansThanks+Coach+Long+MTE+Chaqueta.jpg', 0),
(60, 'AD59324', 'Adidas', '3 Stripes Leggings', 'Estos leggins de adidas Originals vienen con un tejido elástico de algodón. Extra-cómodas, con 3 rayas en las piernas y logo Trefoil en la cadera.', 8, '45.68', '0.21', '0.01', 7, 'adidas3+Stripes+Leggings.jpg', 0),
(61, 'CT39932', 'Carhartt', 'Nimbus Chaqueta', 'La Carhartt Work In Progress Nimbus Pullover está hecha de tejido impermeable de nylon y tiene un práctico bolsillo frontal donde poder guardar las cosas importantes.', 9, '67.69', '0.21', '0.01', 13, 'carharttNimbus+Chaqueta.jpg', 0),
(62, 'FL23295', 'Fila', 'Shelby Track Chaqueta de chandal', 'Chaqueta de chándal de gran tamaño de Fila. Perfecta para días de fresco en primavera y verano, y además combina con prácticamente todo. En azul, rojo y negro clásicos de Fila, con bloques en blanco, cremallera enteriza y dos bolsillos laterales.', 9, '87.00', '0.21', '0.01', 4, 'FilaShelby+Track+Chaqueta+de+chandal.jpg', 0),
(63, 'AD33355', 'Adidas', 'SST TT Chaqueta de chandal', 'Esta chaqueta de chándal para mujer le da un toque de estilo Superstar a cualquier armario. Su increíble patronaje le da un aspecto deportivo genial. También cuenta con las 3 míticas franjas de adidas en los laterales de sus mangas y el logo del trébol en la zona del corazón.', 9, '45.00', '0.21', '0.01', 7, 'AdidasSST+TT+Chaqueta+de+chandal.jpg', 0),
(64, 'VN45205', 'Vans', 'Flying V Raglan Camiseta', 'Desde ahora, no tendrás que volver a robarle a tu novio las camisetas raglan, porque Vans se ha encargado de ello con la Full Parch Raglan LS para chica. Sin duda te quedará mejor. Tiene un logo vintage de Vans en el frontal y la parte trasera, y mangas en contraste.', 7, '32.50', '0.21', '0.01', 6, 'vansFlying+V+Raglan+Camiseta.jpg', 0),
(65, 'SC91483', 'Santa Cruz', 'Leopard Dot Camiseta', 'La camiseta Leopard Dot de Santa Cruz combina un estilo femenino con el skate old school, haciéndola la combinación perfecta para llamar la atención de la gente cool.', 7, '30.00', '0.21', '0.01', 16, 'SantaCruzLeopard+Dot+Camiseta.jpg', 0),
(67, 'CH55832', 'Champion', 'Camiseta', 'Los pioneros de las camisetas. Cuando Champion entró en la escena, era una empresa de ropa de deporte. Ahora representan el estilo urbano, y estñan allanando el camino a hipsters y sneaker freaks. Una prenda necesaria para esta temporada.', 7, '34.00', '0.21', '0.01', 20, 'ChampionCamiseta.jpg', 0),
(68, 'FL77245', 'Fila', 'Allison Camiseta', 'Fila combina el estilo oldschool con un diseño deportivo. La Camiseta Allison tiene un enorme logo estampado.', 7, '24.68', '0.21', '0.01', 23, 'FilaAllison+Camiseta.jpg', 0),
(69, 'VC34978', 'Volcom', 'VolcomFrochickie+Pantalones.jpg', 'El 7/8 Baggy Pants para mujer de Champion tiene una cintura alta y una cinturilla elástica con cordón. Las piernas rectas y dos bolsillos delanteros, así como un bolsillo en la parte delantera. Gimnasio o sofá, ¡aquí está tu zona de confort!', 8, '45.00', '0.21', '0.01', 8, 'VolcomFrochickie+Pantalones.jpg', 0),
(70, 'CH51963', 'Champion', 'Tracktop Chaqueta de chandal', 'Este corte le va perfecto con sneakers, el pantalón Frochickie es súper versátil. Diseñado con un ajuste recto por encima del tobillo, el corte chino es de estructura lisa con un bordado Volcom y lleva bolsillos en la parte frontal y otros dos de ojal en la parte posterior.', 9, '50.99', '0.21', '0.01', 11, 'championTracktop+Chaqueta+de+chandal.jpg', 0),
(71, 'PM27644', 'Puma', 'Basket Satin EP Zapatillas deportivas', 'La Basket es realmente un clásico del baloncesto, utilizada en los 60 como la zapatilla de calentamiento más común en todas las canchas del mundo. Para mantener el interés creciendo y seguir las tendencias del mundo de la moda, Puma ha rescatado la Basket a lo grande durante los últimos años. Con un exterior de ante con cordones anchos para darle un toque femenino, estas joyas mantendrán tus niveles de estilismo a unos niveles superiores.', 6, '76.00', '0.21', '0.01', 5, 'PumaBasket+Satin+EP+Zapatillas+deportivas.jpg', 0),
(72, 'RB92845', 'Reebok', 'Classic Leather Zapatillas deportivas', '¡Nunca pasó de moda! El Reebok Classic ha existido durante décadas y se está volviendo loco en los corazones de hipsters y hopsters por igual. Súper cómodo, súper elegante: ¿qué más necesitas saber realmente?', 6, '60.43', '0.21', '0.01', 11, 'RebookClassic+Leather+Zapatillas+deportivas+Women.jpg', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `PROVINCIAS`
--

CREATE TABLE `PROVINCIAS` (
  `ID_PROVINCIA` int(255) NOT NULL,
  `ID_COMUNIDAD` int(255) NOT NULL,
  `PROVINCIA` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `PROVINCIAS`
--

INSERT INTO `PROVINCIAS` (`ID_PROVINCIA`, `ID_COMUNIDAD`, `PROVINCIA`) VALUES
(0, 0, 'NULL'),
(1, 1, 'Almería'),
(2, 1, 'Cadiz'),
(3, 1, 'Córdoba'),
(4, 1, 'Granada'),
(5, 1, 'Huelva'),
(6, 1, 'Jaén'),
(7, 1, 'Málaga'),
(8, 1, 'Sevilla'),
(9, 2, 'Huesca'),
(10, 2, 'Teruel'),
(11, 2, 'Zaragoza'),
(12, 3, 'Oviedo'),
(13, 4, 'Palma de Mallorca'),
(14, 5, 'Santa Cruz de Tenerife'),
(15, 5, 'Las Palmas de Gran Canaria'),
(16, 6, 'Santander'),
(17, 7, 'Albacete'),
(18, 7, 'Ciudad Real'),
(19, 7, 'Cuenca'),
(20, 7, 'Guadalajara'),
(21, 7, 'Toledo'),
(22, 8, 'Ávila'),
(23, 8, 'Burgos'),
(24, 8, 'León'),
(25, 8, 'Palencia'),
(26, 8, 'Salamanca'),
(27, 8, 'Segovia'),
(28, 8, 'Soria'),
(29, 8, 'Valladolid'),
(30, 8, 'Zamora'),
(31, 9, 'Barcelona'),
(32, 9, 'Gerona'),
(33, 9, 'Lérida'),
(34, 9, 'Tarragona'),
(35, 10, 'Ceuta'),
(36, 11, 'Badajoz'),
(37, 11, 'Cáceres'),
(38, 12, 'La Coruña'),
(39, 12, 'Lugo'),
(40, 12, 'Orense'),
(41, 12, 'Pontevedra'),
(42, 13, 'Logroño'),
(43, 14, 'Madrid'),
(44, 15, 'Melilla'),
(45, 16, 'Murcia'),
(46, 17, 'Pamplona'),
(47, 18, 'Bilbao'),
(48, 18, 'San Sebastián'),
(49, 18, 'Vitoria'),
(50, 19, 'Alicante'),
(51, 19, 'Castellón'),
(52, 19, 'Valencia');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ROL`
--

CREATE TABLE `ROL` (
  `ROL` int(1) NOT NULL,
  `NOMBRE` varchar(255) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `ROL`
--

INSERT INTO `ROL` (`ROL`, `NOMBRE`) VALUES
(0, 'Cliente'),
(1, 'Administrador'),
(2, 'Baja');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `USUARIO`
--

CREATE TABLE `USUARIO` (
  `NOMBRE` varchar(255) COLLATE utf8_bin NOT NULL,
  `USUARIO` varchar(255) COLLATE utf8_bin NOT NULL,
  `PASSWORD` varchar(255) COLLATE utf8_bin NOT NULL,
  `CORREO` varchar(255) COLLATE utf8_bin NOT NULL,
  `ID_COMUNIDAD` int(255) NOT NULL,
  `ID_PROVINCIA` int(255) NOT NULL,
  `CALLE` varchar(255) COLLATE utf8_bin NOT NULL,
  `NUMERO` varchar(255) COLLATE utf8_bin NOT NULL,
  `PISO` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `PUERTA` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `CODIGOPOSTAL` varchar(255) COLLATE utf8_bin NOT NULL,
  `FECHAREGISTRO` date NOT NULL,
  `FECHABAJA` date NOT NULL,
  `ROL` int(255) NOT NULL,
  `ID_USUARIO` int(255) NOT NULL,
  `ESTADO` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `USUARIO`
--

INSERT INTO `USUARIO` (`NOMBRE`, `USUARIO`, `PASSWORD`, `CORREO`, `ID_COMUNIDAD`, `ID_PROVINCIA`, `CALLE`, `NUMERO`, `PISO`, `PUERTA`, `CODIGOPOSTAL`, `FECHAREGISTRO`, `FECHABAJA`, `ROL`, `ID_USUARIO`, `ESTADO`) VALUES
('Antonio', 'Antonio10ms', 'aad46e457c33af5cb47145d631a560fd', 'antonio10marsan@gmail.com', 10, 35, 'Alcala del valle', '43', '', '', '51002', '2018-06-13', '0000-00-00', 1, 1, 0),
('Bruno', 'Brunoo98', 'e10adc3949ba59abbe56e057f20f883e', 'brunoceuta1998@gmail.com', 10, 35, 'calle el cid campeador', '', '', '', '51002', '2018-06-13', '0000-00-00', 0, 2, 0),
('Margarita', 'Margapiesdeplata', '6b826f8460f542ebba33d802bc27a5ca', 'margarita@gmail.com', 10, 35, 'Gomez Marcelo', '1', '5', 'B', '51001', '2018-06-13', '0000-00-00', 0, 3, 0),
('Pepe', 'Pepitor123', 'e10adc3949ba59abbe56e057f20f883e', 'pepe@correo.es', 9, 32, 'Parques de Ceuta', '2', '7', 'B', '51001', '2018-06-13', '0000-00-00', 0, 4, 0),
('Juan', 'Juan123', 'e10adc3949ba59abbe56e057f20f883e', 'juan@correo.es', 8, 25, 'Teniente Ruiz', '5', '3', 'A', '67007', '2018-06-13', '0000-00-00', 0, 5, 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `COMUNIDADES`
--
ALTER TABLE `COMUNIDADES`
  ADD PRIMARY KEY (`ID_COMUNIDAD`),
  ADD KEY `IDCOMUNIDAD` (`ID_COMUNIDAD`);

--
-- Indices de la tabla `ESTADO`
--
ALTER TABLE `ESTADO`
  ADD PRIMARY KEY (`CODIGO_ESTADO`);

--
-- Indices de la tabla `FAMILIA`
--
ALTER TABLE `FAMILIA`
  ADD PRIMARY KEY (`CODIGO_FAMILIA`);

--
-- Indices de la tabla `LINEA_PEDIDO`
--
ALTER TABLE `LINEA_PEDIDO`
  ADD PRIMARY KEY (`CODIGO_LINEA_PEDIDO`),
  ADD KEY `PRODUCTO` (`PRODUCTO`),
  ADD KEY `CODIGO_PEDIDO` (`CODIGO_PEDIDO`) USING BTREE;

--
-- Indices de la tabla `MODO_PAGO`
--
ALTER TABLE `MODO_PAGO`
  ADD PRIMARY KEY (`CODIGO_PAGO`);

--
-- Indices de la tabla `PEDIDO`
--
ALTER TABLE `PEDIDO`
  ADD PRIMARY KEY (`CODIGO_PEDIDO`),
  ADD KEY `USUARIO` (`USUARIO`,`MODO_PAGO`),
  ADD KEY `MODO_PAGO` (`MODO_PAGO`),
  ADD KEY `ESTADO` (`ESTADO`);

--
-- Indices de la tabla `PRODUCTO`
--
ALTER TABLE `PRODUCTO`
  ADD PRIMARY KEY (`CODIGO_INTERNO`),
  ADD KEY `FAMILIA` (`FAMILIA`),
  ADD KEY `ESTADO` (`ESTADO`);

--
-- Indices de la tabla `PROVINCIAS`
--
ALTER TABLE `PROVINCIAS`
  ADD PRIMARY KEY (`ID_PROVINCIA`),
  ADD KEY `IDCOMUNIDAD` (`ID_COMUNIDAD`);

--
-- Indices de la tabla `ROL`
--
ALTER TABLE `ROL`
  ADD PRIMARY KEY (`ROL`);

--
-- Indices de la tabla `USUARIO`
--
ALTER TABLE `USUARIO`
  ADD PRIMARY KEY (`ID_USUARIO`),
  ADD UNIQUE KEY `USUARIO` (`USUARIO`,`PASSWORD`,`CORREO`),
  ADD KEY `ID_COMUNIDAD` (`ID_COMUNIDAD`,`ID_PROVINCIA`),
  ADD KEY `ID_COMUNIDAD_2` (`ID_COMUNIDAD`,`ID_PROVINCIA`),
  ADD KEY `ID_PROVINCIA` (`ID_PROVINCIA`),
  ADD KEY `ROL` (`ROL`),
  ADD KEY `ESTADO` (`ESTADO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `LINEA_PEDIDO`
--
ALTER TABLE `LINEA_PEDIDO`
  MODIFY `CODIGO_LINEA_PEDIDO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de la tabla `PEDIDO`
--
ALTER TABLE `PEDIDO`
  MODIFY `CODIGO_PEDIDO` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `USUARIO`
--
ALTER TABLE `USUARIO`
  MODIFY `ID_USUARIO` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `LINEA_PEDIDO`
--
ALTER TABLE `LINEA_PEDIDO`
  ADD CONSTRAINT `linea_pedido_ibfk_2` FOREIGN KEY (`PRODUCTO`) REFERENCES `PRODUCTO` (`CODIGO_INTERNO`),
  ADD CONSTRAINT `linea_pedido_ibfk_3` FOREIGN KEY (`CODIGO_PEDIDO`) REFERENCES `PEDIDO` (`CODIGO_PEDIDO`);

--
-- Filtros para la tabla `PEDIDO`
--
ALTER TABLE `PEDIDO`
  ADD CONSTRAINT `pedido_ibfk_1` FOREIGN KEY (`MODO_PAGO`) REFERENCES `MODO_PAGO` (`CODIGO_PAGO`),
  ADD CONSTRAINT `pedido_ibfk_2` FOREIGN KEY (`USUARIO`) REFERENCES `USUARIO` (`ID_USUARIO`),
  ADD CONSTRAINT `pedido_ibfk_3` FOREIGN KEY (`ESTADO`) REFERENCES `ESTADO` (`CODIGO_ESTADO`);

--
-- Filtros para la tabla `PRODUCTO`
--
ALTER TABLE `PRODUCTO`
  ADD CONSTRAINT `producto_ibfk_1` FOREIGN KEY (`FAMILIA`) REFERENCES `FAMILIA` (`CODIGO_FAMILIA`),
  ADD CONSTRAINT `producto_ibfk_2` FOREIGN KEY (`ESTADO`) REFERENCES `ESTADO` (`CODIGO_ESTADO`);

--
-- Filtros para la tabla `PROVINCIAS`
--
ALTER TABLE `PROVINCIAS`
  ADD CONSTRAINT `provincias_ibfk_1` FOREIGN KEY (`ID_COMUNIDAD`) REFERENCES `COMUNIDADES` (`ID_COMUNIDAD`);

--
-- Filtros para la tabla `USUARIO`
--
ALTER TABLE `USUARIO`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`ID_COMUNIDAD`) REFERENCES `COMUNIDADES` (`ID_COMUNIDAD`),
  ADD CONSTRAINT `usuario_ibfk_2` FOREIGN KEY (`ID_PROVINCIA`) REFERENCES `PROVINCIAS` (`ID_PROVINCIA`),
  ADD CONSTRAINT `usuario_ibfk_3` FOREIGN KEY (`ROL`) REFERENCES `ROL` (`ROL`),
  ADD CONSTRAINT `usuario_ibfk_4` FOREIGN KEY (`ESTADO`) REFERENCES `ESTADO` (`CODIGO_ESTADO`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
