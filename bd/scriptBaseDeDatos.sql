-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 09-06-2020 a las 18:55:41
-- Versión del servidor: 10.4.6-MariaDB
-- Versión de PHP: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `BD2DAW06`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acl_roles`
--

CREATE TABLE `acl_roles` (
  `cod_role` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `puede_acceder` tinyint(1) NOT NULL DEFAULT 0,
  `puede_configurar` tinyint(1) NOT NULL DEFAULT 0,
  `permiso1` tinyint(1) NOT NULL DEFAULT 0,
  `permiso2` tinyint(1) NOT NULL DEFAULT 0,
  `permiso3` tinyint(1) NOT NULL DEFAULT 0,
  `permiso4` tinyint(1) NOT NULL DEFAULT 0,
  `permiso5` tinyint(1) NOT NULL DEFAULT 0,
  `permiso6` tinyint(1) NOT NULL DEFAULT 0,
  `permiso7` tinyint(1) NOT NULL DEFAULT 0,
  `permiso8` tinyint(1) NOT NULL DEFAULT 0,
  `permiso9` tinyint(1) NOT NULL DEFAULT 0,
  `permiso10` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `acl_roles`
--

INSERT INTO `acl_roles` (`cod_role`, `nombre`, `puede_acceder`, `puede_configurar`, `permiso1`, `permiso2`, `permiso3`, `permiso4`, `permiso5`, `permiso6`, `permiso7`, `permiso8`, `permiso9`, `permiso10`) VALUES
(3, 'administradores', 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(5, 'artistas', 0, 0, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0),
(6, 'restaurantes', 0, 0, 0, 0, 0, 0, 0, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `acl_usuarios`
--

CREATE TABLE `acl_usuarios` (
  `cod_usuario` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `nick` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `contrasena` varchar(32) COLLATE utf8_spanish2_ci NOT NULL,
  `cod_role` int(11) NOT NULL,
  `borrado` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `acl_usuarios`
--

INSERT INTO `acl_usuarios` (`cod_usuario`, `nombre`, `nick`, `contrasena`, `cod_role`, `borrado`) VALUES
(8, 'plastic woods', 'plasticWoods@gmail.com', '197fe0b505bc48a76c19c55b1f52f3f8', 5, 0),
(9, 'red eye', 'redEye@gmail.com', '9e3060773ac5bfc183614c6f7b9773fd', 5, 0),
(10, 'gretel', 'gretel@gmail.com', 'b83ec4a282c83b5fbf57c3ac464b9849', 5, 0),
(11, 'grajo', 'grajo@gmail.com', '7098eaee8048ef4bf2db3792b948eeda', 5, 0),
(12, 'santo rostro', 'santoRostro@gmail.com', 'a6f1447ef5b53d6c09aacea7af09c3dd', 5, 0),
(13, 'hibrido', 'hibrido@gmail.com', 'ff62282b272f49439d06e20a96a31466', 5, 0),
(14, 'viva belgrado', 'vivaBelgrado@gmail.com', 'c92c7d2fb5dd1e3bc23a7ae3e978bf58', 5, 0),
(15, 'drunkorama', 'drunkorama@gmail.com', 'c7c710145f12648345e8174b7b4bb10f', 6, 0),
(16, 'reina restaurantes', 'reinaRestaurantes@gmail.com', '17c4216d584d368a97231a7bb00cc68c', 6, 0),
(17, 'la ponderosa', 'laPonderosa@gmail.com', '43a5f63b1fc0bfc91bb37275fc91daa7', 6, 0),
(18, 'alma negra', 'almaNegra@gmail.com', '6de5e0b6b08fedb0b452c3c4808fb012', 6, 0),
(19, 'administrador', 'administrador@gmail.com', '9889f394715bdd4286d4f1b2324bdf75', 3, 0),
(35, 'ramper', 'ramper@gmail.com', 'a5382a02d58827c90c0159b68be28d4b', 5, 0),
(36, 'la urss', 'laurss@gmail.com', '18b713d77acb8fbf6bd0d735bd3a8410', 5, 0),
(37, 'perro', 'perro@gmail.com', '2ee73a55f9894bf93ca53446725e756e', 5, 0),
(38, 'habitar la mar', 'habitarlamar@gmail.com', '9584fb74a8de0e6aaf17c4c7782a281b', 5, 0),
(39, 'toundra', 'toundra@gmail.com', '2d370dffa101b9b4b9ff94c9da014891', 5, 0),
(40, 'jammin\' dose', 'jammindose@gmail.com', '3620449ec3ae4709dc71a42f1ee5ad19', 5, 0),
(41, 'cala vento', 'calavento@gmail.com', '385a113145c98932ba6e1192764cb10a', 5, 0),
(42, 'sumrrá', 'sumrra@gmail.com', '97fff0e8faa6244a1eb092d552591fba', 5, 0),
(43, 'mimimi', 'mimimi@gmail.com', '5cf13861614b30c30dfaada3d7e585b9', 5, 0),
(44, 'tasca frasquita', 'tascafrasquita@gmail.com', 'b53a8a90189002f1d4faccaa892b1f50', 6, 0),
(45, 'casa de xantar o dezaseis', 'xantar@gmail.com', 'f9828a0df20048b8ad232ee9a0fc8e62', 6, 0),
(46, 'pez tomillo', 'peztomillo@gmail.com', 'e6005cbe7b2e9de2f4bd8bcdd48e0f27', 6, 0),
(47, 'arte de cozina', 'artedecozina@gmail.com', 'ae983eb066624320cdcc8dae04e9e354', 6, 0),
(48, 'la sociedad herbívora', 'lasociedadherbivora@gmail.com', '2326f198e6ab2f9a7b700e8dafb54ddc', 6, 0),
(49, 'el tablón verde', 'tablonverde@gmail.com', 'a55e956ecc9e3b527809bc01ae6270ff', 6, 0),
(50, 'la fábrica del sabor', 'lafabrica@gmail.com', '5c6061a4fc0ec744dc759c668bb1e3dd', 6, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artistas`
--

CREATE TABLE `artistas` (
  `cod_artista` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `correo` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `genero` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `anio_inicio` int(11) NOT NULL,
  `provincia` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `municipio` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `musica` varchar(100) COLLATE utf8_spanish2_ci NOT NULL,
  `imagen` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `borrado` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `artistas`
--

INSERT INTO `artistas` (`cod_artista`, `nombre`, `correo`, `genero`, `anio_inicio`, `provincia`, `municipio`, `musica`, `imagen`, `borrado`) VALUES
(1, 'Plastic Woods', 'plasticWoods@gmail.com', 'Rock progresivo', 2018, 'MALAGA', 'ANTEQUERA', 'https://open.spotify.com/album/60AirSw2HelSBhMsAFIDDR', 'plasticWoods.jpg', 0),
(2, 'Red Eye', 'redEye@gmail.com', 'Doom Metal', 2016, 'MALAGA', 'ANTEQUERA', 'https://open.spotify.com/album/1juC1QBJga2WrRM4IbY4IK', 'redEye.jpg', 0),
(3, 'Gretel', 'gretel@gmail.com', 'Proto Doom', 2018, 'GRANADA', 'GRANADA', 'https://open.spotify.com/album/6wTX70pIIok4eCDGDSc26y', 'gretel.jpg', 0),
(4, 'Grajo', 'grajo@gmail.com', 'Doom Metal', 2012, 'CORDOBA', 'CORDOBA', 'https://open.spotify.com/album/7qKLByFvpkJ6Xs3JL5LxFx', 'grajo.jpg', 0),
(5, 'Santo Rostro', 'santoRostro@gmail.com', 'Stoner', 2012, 'JAEN', 'JAEN', 'https://open.spotify.com/album/37UJKIQ90kqmVB8NndzK8t', 'santoRostro.jpg', 0),
(6, 'Hibrido', 'hibrido@gmail.com', 'Rock andaluz', 2019, 'CADIZ', 'ALGECIRAS', 'https://open.spotify.com/album/4ZDGbKJqskIKX0vIQNiFMy', 'hibrido.jpg', 0),
(7, 'Viva Belgrado', 'vivaBelgrado@gmail.com', 'Post rock', 2010, 'CORDOBA', 'CORDOBA', 'https://open.spotify.com/album/5axKADV5bq31joY2nMQeLq', 'vivaBelgrado.jpg', 0),
(36, 'Ramper', 'ramper@gmail.com', 'Slowcore', 2018, 'GRANADA', 'GRANADA', 'https://open.spotify.com/album/5HxQq9wlqBMKPpVcEWuOjm', 'ramper.jpg', 0),
(38, 'La URSS', 'laurss@gmail.com', 'Punk rock', 2006, 'GRANADA', 'GRANADA', 'https://open.spotify.com/album/49IuBcom62Me9rF2uajnho', 'La URSS.jpg', 0),
(39, 'Perro', 'perro@gmail.com', 'Rock alternativo', 2015, 'MURCIA', 'MURCIA', 'https://open.spotify.com/album/6EOIK0yr5BG5BLfnGnDDT3', 'perro.jpg', 0),
(40, 'Habitar la Mar', 'habitarlamar@gmail.com', 'Noise rock', 2014, 'JAEN', 'JAEN', 'https://open.spotify.com/album/6l158MnVNYaLUAuezp3XTX', 'habitar la mar.jpg', 0),
(41, 'Toundra', 'toundra@gmail.com', 'Post rock', 2005, 'MADRID', 'MADRID', 'https://open.spotify.com/album/3sWUR0TPpLRbBI88boj5R2', 'toundra.jpg', 0),
(42, 'Jammin\' Dose', 'jammindose@gmail.com', 'Funk rock', 2007, 'MALAGA', 'MALAGA', 'https://open.spotify.com/album/6XlacFdEnEzo1MpgOkbSIo', 'jammin.jpg', 0),
(43, 'Cala Vento', 'calavento@gmail.com', 'Indie rock', 2011, 'GIRONA', 'FIGUERES', 'https://open.spotify.com/album/4NzeeNLwn92QUhGIpCt27O', 'cala vento.jpg', 0),
(44, 'Sumrrá', 'sumrra@gmail.com', 'Jazz', 2000, 'A CORUÑA', 'SANTIAGO DE COMPOSTELA', 'https://open.spotify.com/album/54MNRZlCT6ZMtDEyrodHHs', 'sumrra.jpg', 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `artistas_restaurantes`
--

CREATE TABLE `artistas_restaurantes` (
  `cod_artista_restaurante` int(11) NOT NULL,
  `cod_artista` int(11) NOT NULL,
  `cod_restaurante` int(11) NOT NULL,
  `puntuacion` int(11) NOT NULL,
  `plato_favorito` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `resena` varchar(300) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `artistas_restaurantes`
--

INSERT INTO `artistas_restaurantes` (`cod_artista_restaurante`, `cod_artista`, `cod_restaurante`, `puntuacion`, `plato_favorito`, `resena`) VALUES
(1, 1, 2, 5, 'Porra antequerana', 'Si buscas la comida más tradicional y andaluza, este es tu sitio. Nos encanta.'),
(2, 1, 1, 4, 'Croquetas al Jägger', 'Un sitio con una música increíble'),
(3, 1, 4, 3, 'Cremoso con fresas', 'La comida es deliciosa, pero los precios son demasiado elevados para mi gusto.'),
(4, 5, 2, 1, 'Porra antequerana', 'La comida excelente pero el servicio muy lento'),
(5, 36, 2, 5, 'Porra antequerana', 'Tanto la comida como el servicio son excelentes. Volveríamos a ir sin duda'),
(6, 6, 2, 1, 'Milhojas', 'La comida regular, pero el servicio excelente.'),
(22, 1, 3, 5, 'Bocata de calamares.', 'Este restaurante es tremendamente barato. La comida está bien, tampoco para tirar cohetes, pero por el precio no se puede pedir más.'),
(23, 1, 6, 4, 'Tostada de aceite y tomate', 'La comida está bastante rica, y la variedad de oferta vegana hace que queramos volver. Los precios podrían ser un poquito más baratos, pero nada fuera de lo normal.'),
(24, 1, 7, 3, 'Milhojas', 'La selección de vinos de la Tasca Frasquita es inmensa, y eso juega a su favor. En contra se podría decir que la selección de tapas es algo escueta. Los precios un poco caros.'),
(25, 1, 8, 5, 'Empanada gallega', 'Fuimos a comer aquí durante nuestra gira por Galicia y quedamos encantados. Hay una gran cantidad de platos increíbles que incluyen cocina tradicional gallega. De precio está genail.'),
(26, 1, 12, 2, 'Patatas a lo pobre', 'El servicio fue bastante malo. Tardaron más de una hora en servirnos la comida. Aunque la variedad de platos vegetarianos está bien, no son muy elaborados. Lo único bueno del sitio son los precios.'),
(27, 1, 11, 3, 'Hamburguesa de lentejas', 'Aunque el servicio es bueno, los platos no son tan especiales como los vienen anunciando. La comida está bastante bien, pero si tenemos en cuenta el precio medio, la calidad no es la esperada. Eso sí, la oferta vegana es muy amplia.'),
(28, 1, 13, 4, 'Hamburguesa dólmen', 'Nos pillaba de vuelta a casa después de la gira. Está bastante bien porque dentro del restaurante hay tres zonas diferenciadas con diferentes tipos de comida. Probamos la hamburguesa dólmen y repetiríamos sin dudarlo. El servicio, aunque correcto, podría haber sido un poco más rápido.'),
(29, 43, 6, 5, 'Tostada de aguacate', 'Tocábamos la noche anterior en Granada y fuimos a desayunar a Mimimí. Nos encantó el ambiente, la música y sobre todo la comida! Somos vegetarianos y poder mirar la carta sin preocuparse de no encontrar opciones es un verdadero alivio.'),
(30, 43, 1, 2, 'Croquetas de setas', 'En nuestra gira por Andalucía paramos en Málaga. Nos recomendaron ir a Drunkorama. Siendo sinceros la comida es bastante buena, pero no es el ambiente que estábamos buscando y eso hizo que nuestra experiencia no fuera tan buena.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provincias`
--

CREATE TABLE `provincias` (
  `cod_provincia` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `provincias`
--

INSERT INTO `provincias` (`cod_provincia`, `nombre`) VALUES
(1, 'MALAGA'),
(2, 'A CORUÑA'),
(3, 'GRANADA'),
(4, 'CORDOBA'),
(5, 'JAEN'),
(6, 'CADIZ'),
(7, 'BADAJOZ'),
(8, 'MURCIA'),
(10, 'MADRID'),
(11, 'BARCELONA'),
(13, 'GIRONA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `restaurantes`
--

CREATE TABLE `restaurantes` (
  `cod_restaurante` int(11) NOT NULL,
  `nombre` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `correo` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `descripcion` varchar(500) COLLATE utf8_spanish2_ci NOT NULL,
  `precio` int(11) NOT NULL,
  `direccion` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `provincia` varchar(30) COLLATE utf8_spanish2_ci NOT NULL,
  `municipio` varchar(40) COLLATE utf8_spanish2_ci NOT NULL,
  `grado_vegetariano` int(11) NOT NULL DEFAULT 0,
  `grado_vegano` int(11) NOT NULL DEFAULT 0,
  `ambiente` varchar(20) COLLATE utf8_spanish2_ci NOT NULL,
  `autovia_cerca` tinyint(4) NOT NULL DEFAULT 0,
  `imagen` varchar(50) COLLATE utf8_spanish2_ci NOT NULL,
  `borrado` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;

--
-- Volcado de datos para la tabla `restaurantes`
--

INSERT INTO `restaurantes` (`cod_restaurante`, `nombre`, `correo`, `descripcion`, `precio`, `direccion`, `provincia`, `municipio`, `grado_vegetariano`, `grado_vegano`, `ambiente`, `autovia_cerca`, `imagen`, `borrado`) VALUES
(1, 'Drunkorama', 'drunkorama@gmail.com', 'Restaurante de Málaga mítico de la escena musical underground.', 2, 'Calle Ramón Franquelo, 7', 'MALAGA', 'MALAGA', 2, 1, 'Garage rock', 0, 'drunkorama.jpg', 0),
(2, 'Reina Restaurantes', 'reinaRestaurantes@gmail.com', 'Restaurante en el corazón de Andalucía con la comida más tradicional.', 3, 'Calle San Agustín, 1', 'MALAGA', 'ANTEQUERA', 2, 1, 'Flamenco', 0, 'reina.jpg', 0),
(3, 'La Ponderosa', 'laPonderosa@gmail.com', 'Restaurante económico y cercano a la autovía. En la provincia de Badajoz', 1, 'Calle de los Agricultores', 'BADAJOZ', 'MONESTERIO', 1, 0, 'flamenco', 1, 'ponderosa.jpg', 0),
(4, 'Alma Negra', 'almaNegra@gmail.com', 'Bar de ambiente cosmopolita, diáfano y con varias alturas, que sirve vinos, cervezas y tapas eclécticas.', 2, 'Rúa Barrera', 'A CORUÑA', 'A CORUÑA', 2, 1, 'Indie rock', 0, 'almaNegra.jpg', 0),
(6, 'Mimimi', 'mimimi@gmail.com', 'Soy una cafetería molona con productos ecológicos y vegetarianos, también veganos, a la que le gusta el calorcito de la gente y las pajitas de colores del Ikea. También me gustan los perritos, pero esto que quede entre nosotros.', 2, 'Pasaje del Profesor Sainz Cantero, 7 Local 1', 'GRANADA', 'GRANADA', 3, 3, 'Indie', 0, 'mimimi.jpg', 0),
(7, 'Tasca Frasquita', 'tascafrasquita@gmail.com', 'Tasca Frasquita es el espacio “boutique” de Familia Querqus. Un lugar de reducidas dimensiones, con capacidad para 30 personas, en el que ofrecemos un trato más personalizado a nuestros clientes. Nuestra cocina refleja el esfuerzo creativo del equipo para llevar el producto en su máxima expresión a las tapas y platos que se ofrecen en la carta.', 3, 'Cuesta Zapateros, 1', 'MALAGA', 'ANTEQUERA', 3, 1, 'Jazz', 0, 'tasca frasquita.jpg', 0),
(8, 'Casa de Xantar o Dezaseis', 'xantar@gmail.com', 'O polbo á grella é o prato estrela da cociña do dezaseis, foi ideado por Rafa Riveiro alá polo ano 2000 e dende entón figura de xeito continuado na carta do Dezaseis.\r\n\r\nEste prato é o mellor exemplo da tradición gastronómica que desenvolve agora Gonzalo Lobato e da que gozan xa por igual composteláns e turistas ou peregrinos.', 2, 'Rúa de San Pedro, 16', 'A CORUÑA', 'SANTIAGO DE COMPOSTELA', 3, 2, 'Jazz', 0, 'xantar.jpg', 0),
(9, 'Pez Tomillo', 'peztomillo@gmail.com', 'Local con techo de mimbre, pared de baldosa y mesas de madera donde degustar platos mediterráneos y cócteles.', 2, 'Paseo Marítimo el Pedregal, 1', 'MALAGA', 'MALAGA', 2, 0, 'Rumba', 0, 'pez tomillo.jpg', 0),
(10, 'Arte de Cozina', 'artedecozina@gmail.com', 'Arte de Cozina es un viaje culinario en el tiempo de la mano de Charo Carmona. Con nosotros podrás degustar antiguos sabores, dejarte sorprender por sus aspectos más distintivos y explorar el poso del recetario tradicional malagueño.\r\n\r\nLos productos de temporada provenientes del entorno surten nuestras despensas de los mejores ingredientes andaluces que aportan calidad y tradición a nuestros guisos, promueven nuestro patrimonio culinario y la sostenibilidad de nuestro hábitat.', 2, 'Calle Calzada, 27', 'MALAGA', 'ANTEQUERA', 3, 2, 'Flamenco', 0, 'arte de cozina.jpg', 0),
(11, 'La Sociedad Herbívora', 'lasociedadherbivora@gmail.com', 'Somos un restaurante vegano situado en Málaga. Tras años en el sector hostelero de la ciudad, decidimos que era hora de empezar nuestro proyecto. Y en diciembre de 2018, abrimos las puertas de LASH. La Sociedad Herbívora es un restaurante vegano con cocina consciente en la que puedes comer sano y rico con una materia prima basada exclusivamente en ingredientes vegetales.\r\n\r\nBienvenidos a La Sociedad Herbívora.', 3, 'Calle Juan de Padilla, 13', 'MALAGA', 'MALAGA', 3, 3, 'Jazz', 0, 'sociedad herbivora.jpg', 0),
(12, 'El Tablón Verde', 'tablonverde@gmail.com', 'El Tablón Verde te ofrece la más exquisita variedad de Vegetariana que puedes encontrar en Granada. Ven a visitarnos o haz tu pedido online. Verás como te sorprenderemos con nuestras especialidades.', 1, 'Calle Santa Bárbara, 7', 'GRANADA', 'GRANADA', 3, 3, 'Indie', 0, 'tablon verde.jpg', 0),
(13, 'La Fábrica del Sabor', 'lafabrica@gmail.com', 'La Fábrica del Sabor es un restaurante con diferentes espacios y una amplia oferta gastronómica en Antequera, el corazón de Andalucía.', 2, 'Pol. Ind. de Antequera, Avenida Principal, 11', 'MALAGA', 'MALAGA', 0, 0, 'Jazz', 1, 'la fabrica.jpg', 0);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `acl_roles`
--
ALTER TABLE `acl_roles`
  ADD PRIMARY KEY (`cod_role`);

--
-- Indices de la tabla `acl_usuarios`
--
ALTER TABLE `acl_usuarios`
  ADD PRIMARY KEY (`cod_usuario`),
  ADD UNIQUE KEY `UQ_ACL_USUARIOS` (`nick`) USING BTREE,
  ADD KEY `FK_ROLES` (`cod_role`);

--
-- Indices de la tabla `artistas`
--
ALTER TABLE `artistas`
  ADD PRIMARY KEY (`cod_artista`),
  ADD KEY `fk_artistas_nick` (`correo`);

--
-- Indices de la tabla `artistas_restaurantes`
--
ALTER TABLE `artistas_restaurantes`
  ADD PRIMARY KEY (`cod_artista_restaurante`),
  ADD UNIQUE KEY `cod_artista` (`cod_artista`,`cod_restaurante`),
  ADD KEY `cod_restaurante` (`cod_restaurante`);

--
-- Indices de la tabla `provincias`
--
ALTER TABLE `provincias`
  ADD PRIMARY KEY (`cod_provincia`);

--
-- Indices de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  ADD PRIMARY KEY (`cod_restaurante`),
  ADD KEY `fk_restaurantes_nick` (`correo`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `acl_roles`
--
ALTER TABLE `acl_roles`
  MODIFY `cod_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `acl_usuarios`
--
ALTER TABLE `acl_usuarios`
  MODIFY `cod_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT de la tabla `artistas`
--
ALTER TABLE `artistas`
  MODIFY `cod_artista` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT de la tabla `artistas_restaurantes`
--
ALTER TABLE `artistas_restaurantes`
  MODIFY `cod_artista_restaurante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT de la tabla `provincias`
--
ALTER TABLE `provincias`
  MODIFY `cod_provincia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  MODIFY `cod_restaurante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `acl_usuarios`
--
ALTER TABLE `acl_usuarios`
  ADD CONSTRAINT `FK_ROLES` FOREIGN KEY (`cod_role`) REFERENCES `acl_roles` (`cod_role`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `artistas`
--
ALTER TABLE `artistas`
  ADD CONSTRAINT `fk_artistas_nick` FOREIGN KEY (`correo`) REFERENCES `acl_usuarios` (`nick`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `artistas_restaurantes`
--
ALTER TABLE `artistas_restaurantes`
  ADD CONSTRAINT `cod_artista` FOREIGN KEY (`cod_artista`) REFERENCES `artistas` (`cod_artista`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `cod_restaurante` FOREIGN KEY (`cod_restaurante`) REFERENCES `restaurantes` (`cod_restaurante`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `restaurantes`
--
ALTER TABLE `restaurantes`
  ADD CONSTRAINT `fk_restaurantes_nick` FOREIGN KEY (`correo`) REFERENCES `acl_usuarios` (`nick`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
