SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE IF NOT EXISTS `carrera` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `fecha` date NOT NULL,
  `lugar` varchar(80) NOT NULL,
  `distancia` int(11) NOT NULL,
  `mapa` varchar(80) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;


INSERT INTO `carrera` (`id`, `nombre`, `fecha`, `lugar`, `distancia`, `mapa`) VALUES
(11, 'San Juan', '2011-10-03', 'allariz, ourense, espaÃ±a', 200, 'aqui'),
(12, 'As castaÃ±as quentes', '2011-11-15', 'avenida de portugal, ourense, espaÃ±a', 2000, 'alÃ¡'),
(13, 'Carreira de San Xoan', '2011-10-19', 'San Xoan de Rio', 233, ''),
(14, 'asdfasdfasdfasdf', '2011-10-24', 'asdfasdf', 33, '334fsaf'),
(15, 'asd', '2011-10-23', 'asdfasdf', 0, 'asdf'),
(16, 'asd', '2011-10-23', 'asdfasdf', 0, 'asdf'),
(17, 'asd', '2011-10-23', 'asdfasdf', 0, 'asdf'),
(18, '3434', '2011-10-24', 'fffffffff', 44, 'ff'),
(19, '3434', '2011-10-24', 'fffffffff', 44, 'ff'),
(20, 'Santa Julia Da Praia', '2011-10-29', 'Praias de San Nicanor', 10, 'alli'),
(21, 'Santa Julia Da Praia', '2011-10-29', 'Praias de San Nicanor', 10, 'alli'),
(22, 'Santa Julia Da Praia', '2011-10-29', 'Praias de San Nicanor', 10, 'alli'),
(23, 'Santa Julia Da Praia', '2011-10-29', 'Praias de San Nicanor', 10, 'alli'),
(24, 'Carreira de San Honorato', '2011-10-30', 'Santa Marta de Landrios', 430, 'ala'),
(25, 'xxxxxxxxxxxx', '2011-10-28', 'xxxxxxxxxx', 0, 'xxx'),
(26, 'Carreira de formatic', '2011-10-19', 'Tal sitio', 23, 'asdfasf'),
(27, 'Carrera de Jueves', '2011-10-30', 'Tal sitio', 343, 'asdfasd'),
(28, 'Carrera de Jueves', '2011-10-30', 'Tal sitio', 343, 'asdfasd'),
(29, 'sdfsfsdf', '2011-11-16', 'allariz,ourense,espaÃ±a', 2, 'ss');


CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

INSERT INTO `categoria` (`id`, `nombre`) VALUES
(1, 'Juveniles'),
(2, 'Infantiles'),
(3, 'Senior'),
(4, 'Chalaos'),
(5, 'Suicidas'),
(6, 'Delincuentes'),
(7, 'Falsificadores'),
(8, 'Politicos');

CREATE TABLE IF NOT EXISTS `comentario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `texto` text NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `fecha` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `noticia_id` int(11) NOT NULL,
  `usuario_id1` int(11) NOT NULL,
  PRIMARY KEY (`id`,`noticia_id`),
  KEY `fk_comentario_noticia1` (`noticia_id`),
  KEY `fk_comentario_usuario1` (`usuario_id1`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=54 ;

INSERT INTO `comentario` (`id`, `texto`, `usuario_id`, `fecha`, `noticia_id`, `usuario_id1`) VALUES
(53, 'Opino esto', 3, '2011-10-24 13:46:15', 13, 0);

CREATE TABLE IF NOT EXISTS `equipo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `vehiculo_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

INSERT INTO `equipo` (`id`, `nombre`, `vehiculo_id`) VALUES
(3, 'Los carrileros del infierno', 1),
(4, 'Los truenos del espacio', 1);

CREATE TABLE IF NOT EXISTS `foto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

INSERT INTO `foto` (`id`, `nombre`, `image`) VALUES
(2, 'cruz', 'limon.jpg'),
(3, 'bar.jpg', 'bar.jpg'),
(4, 'berengena.jpg', 'berengena.jpg'),
(5, 'berengena.jpg', 'berengena.jpg'),
(6, 'botella.jpg', 'botella.jpg'),
(7, 'campana.jpg', 'campana.jpg'),
(8, 'cara.gif', 'cara.gif'),
(9, 'cruz.gif', 'cruz.gif'),
(10, 'fresa.jpg', 'fresa.jpg'),
(11, 'hola.jpg', 'hola.jpg'),
(12, 'lechuga.jpg', 'lechuga.jpg'),
(13, 'limon.jpg', 'limon.jpg'),
(14, 'naranja.jpg', 'naranja.jpg'),
(15, 'regalo.jpg', 'regalo.jpg'),
(16, 'siete.jpg', 'siete.jpg'),
(17, 'suerte.jpg', 'suerte.jpg'),
(18, 'zanahoria.jpg', 'zanahoria.jpg'),
(19, 'check', 'checked.gif');

CREATE TABLE IF NOT EXISTS `fotosDePrueba` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pruebas_id` int(11) NOT NULL,
  `image` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

INSERT INTO `fotosDePrueba` (`id`, `pruebas_id`, `image`) VALUES
(6, 29, 'ui-anim_basic_16x16.gif'),
(4, 28, 'Next.gif'),
(7, 28, '');

CREATE TABLE IF NOT EXISTS `inscripcion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `carrera_id` int(11) DEFAULT NULL,
  `equipo_id` int(11) DEFAULT NULL,
  `categoria_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_carrera_has_equipo_equipo1` (`equipo_id`),
  KEY `fk_carrera_has_equipo_carrera1` (`carrera_id`),
  KEY `fk_inscripcion_categoria1` (`categoria_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

INSERT INTO `inscripcion` (`id`, `carrera_id`, `equipo_id`, `categoria_id`) VALUES
(32, 12, 3, 1),
(36, 12, 4, 6),
(37, 11, 4, 3),
(38, 11, 4, 6);

CREATE TABLE IF NOT EXISTS `inscripcionList` (
`id` int(11)
,`carrera_id` int(11)
,`equipo_id` int(11)
,`categoria_id` int(11)
,`categoria_nombre` varchar(30)
,`equipo_nombre` varchar(30)
,`carrera_nombre` varchar(100)
);

CREATE TABLE IF NOT EXISTS `llegada` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tiempo` time DEFAULT NULL,
  `puesto` int(11) DEFAULT NULL,
  `inscripcion_id` int(11) NOT NULL,
  `carrera_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_llegada_inscripcion1` (`inscripcion_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

INSERT INTO `llegada` (`id`, `tiempo`, `puesto`, `inscripcion_id`, `carrera_id`) VALUES
(4, '00:00:12', 1, 32, 12),
(9, '00:00:25', 3, 37, 11),
(10, '00:00:45', 3, 38, 11);

CREATE TABLE IF NOT EXISTS `llegadaList` (
`id` int(11)
,`tiempo` time
,`puesto` int(11)
,`inscripcion_id` int(11)
,`carrera_id` int(11)
,`categoria_nombre` varchar(30)
,`equipo_nombre` varchar(30)
,`carrera_nombre` varchar(100)
);

CREATE TABLE IF NOT EXISTS `noticia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `texto` varchar(200) NOT NULL,
  `fecha` date NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_noticia_usuario1` (`usuario_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;


INSERT INTO `noticia` (`id`, `texto`, `fecha`, `usuario_id`) VALUES
(13, 'Esta es una noticia', '2011-09-13', 0),
(14, 'normal', '2011-10-11', 0),
(15, 'Otra cosa, esto mola lo suficiente', '2011-10-14', 0),
(16, 'Otra cosa', '2011-10-14', 0),
(17, 'Llueve', '2011-10-05', 0);


CREATE TABLE IF NOT EXISTS `piloto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `direccion` varchar(30) NOT NULL,
  `telefono` varchar(30) NOT NULL,
  `email` varchar(30) NOT NULL,
  `fecha_de_nacimiento` date NOT NULL,
  `foto` varchar(30) NOT NULL,
  `equipo_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_piloto_equipo1` (`equipo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

INSERT INTO `piloto` (`id`, `nombre`, `direccion`, `telefono`, `email`, `fecha_de_nacimiento`, `foto`, `equipo_id`) VALUES
(9, 'Tony The Thunder', 'Alli exactamente', '345345', 'miemail@miemail.com', '2011-10-18', 'bg.gif', 3),
(10, 'otro', 'ddddd', '111', 'ee@', '2011-10-01', 'editar.png', 3);

CREATE TABLE IF NOT EXISTS `pilotoConEquipo` (
`id` int(11)
,`nombre` varchar(30)
,`direccion` varchar(30)
,`telefono` varchar(30)
,`email` varchar(30)
,`fecha_de_nacimiento` date
,`foto` varchar(30)
,`equipo_nombre` varchar(30)
);

CREATE TABLE IF NOT EXISTS `pruebas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) NOT NULL,
  `fecha` date NOT NULL,
  `pagado` enum('Si','No') NOT NULL,
  `comentario` text NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `foto_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

INSERT INTO `pruebas` (`id`, `nombre`, `fecha`, `pagado`, `comentario`, `usuario_id`, `foto_id`) VALUES
(28, 'asdfasdfasdfasdf', '2012-03-01', 'Si', 'aaaaaaaaa', 3, 11),
(29, 'ToÃ±o el Rayo', '2011-10-14', 'Si', 'como mola', 3, 0),
(30, 'Carrera3', '2011-10-20', 'Si', 'hyufrg', 3, 2);

CREATE TABLE IF NOT EXISTS `pruebasView` (
`id` int(11)
,`nombre` varchar(40)
,`fecha` date
,`pagado` enum('Si','No')
,`comentario` text
,`usuario_id` int(11)
,`foto_id` int(11)
,`usuario_nombre` varchar(40)
,`foto_nombre` varchar(100)
,`foto_image` varchar(100)
);

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `nivel` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

INSERT INTO `usuario` (`id`, `nombre`, `password`, `nivel`) VALUES
(3, 'to', 'secreto', 10);

CREATE TABLE IF NOT EXISTS `vehiculo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(30) NOT NULL,
  `equipo_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_vehiculo_equipo1` (`equipo_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


DROP TABLE IF EXISTS `inscripcionList`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `inscripcionList` AS select `inscripcion`.`id` AS `id`,`inscripcion`.`carrera_id` AS `carrera_id`,`inscripcion`.`equipo_id` AS `equipo_id`,`inscripcion`.`categoria_id` AS `categoria_id`,`categoria`.`nombre` AS `categoria_nombre`,`equipo`.`nombre` AS `equipo_nombre`,`carrera`.`nombre` AS `carrera_nombre` from (((`inscripcion` join `categoria`) join `equipo`) join `carrera`) where ((`categoria`.`id` = `inscripcion`.`categoria_id`) and (`equipo`.`id` = `inscripcion`.`equipo_id`) and (`carrera`.`id` = `inscripcion`.`carrera_id`));

DROP TABLE IF EXISTS `llegadaList`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `llegadaList` AS select `llegada`.`id` AS `id`,`llegada`.`tiempo` AS `tiempo`,`llegada`.`puesto` AS `puesto`,`llegada`.`inscripcion_id` AS `inscripcion_id`,`llegada`.`carrera_id` AS `carrera_id`,`inscripcionList`.`categoria_nombre` AS `categoria_nombre`,`inscripcionList`.`equipo_nombre` AS `equipo_nombre`,`inscripcionList`.`carrera_nombre` AS `carrera_nombre` from (`llegada` join `inscripcionList`) where (`inscripcionList`.`id` = `llegada`.`inscripcion_id`);

DROP TABLE IF EXISTS `pilotoConEquipo`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pilotoConEquipo` AS select `piloto`.`id` AS `id`,`piloto`.`nombre` AS `nombre`,`piloto`.`direccion` AS `direccion`,`piloto`.`telefono` AS `telefono`,`piloto`.`email` AS `email`,`piloto`.`fecha_de_nacimiento` AS `fecha_de_nacimiento`,`piloto`.`foto` AS `foto`,`equipo`.`nombre` AS `equipo_nombre` from (`piloto` join `equipo`) where (`piloto`.`equipo_id` = `equipo`.`id`);

DROP TABLE IF EXISTS `pruebasView`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `pruebasView` AS select `pruebas`.`id` AS `id`,`pruebas`.`nombre` AS `nombre`,`pruebas`.`fecha` AS `fecha`,`pruebas`.`pagado` AS `pagado`,`pruebas`.`comentario` AS `comentario`,`pruebas`.`usuario_id` AS `usuario_id`,`pruebas`.`foto_id` AS `foto_id`,`usuario`.`nombre` AS `usuario_nombre`,`foto`.`nombre` AS `foto_nombre`,`foto`.`image` AS `foto_image` from ((`pruebas` join `usuario`) join `foto`) where ((`usuario`.`id` = `pruebas`.`usuario_id`) and (`foto`.`id` = `pruebas`.`foto_id`));

ALTER TABLE `inscripcion`
  ADD CONSTRAINT `fk_carrera_has_equipo_carrera1` FOREIGN KEY (`carrera_id`) REFERENCES `carrera` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_carrera_has_equipo_equipo1` FOREIGN KEY (`equipo_id`) REFERENCES `equipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_inscripcion_categoria1` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `llegada`
  ADD CONSTRAINT `fk_llegada_inscripcion1` FOREIGN KEY (`inscripcion_id`) REFERENCES `inscripcion` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `piloto`
  ADD CONSTRAINT `fk_piloto_equipo1` FOREIGN KEY (`equipo_id`) REFERENCES `equipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

ALTER TABLE `vehiculo`
  ADD CONSTRAINT `fk_vehiculo_equipo1` FOREIGN KEY (`equipo_id`) REFERENCES `equipo` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

