DROP TABLE acidos_grasos;nnCREATE TABLE `acidos_grasos` (
  `acidoGrasoID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(3) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`acidoGrasoID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;nnINSERT INTO acidos_grasos VALUES("1","DHA");nINSERT INTO acidos_grasos VALUES("2","EPA");nnnnDROP TABLE advertencias;nnCREATE TABLE `advertencias` (
  `advertenciaID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `texto` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `resumen` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`advertenciaID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;nnnnnDROP TABLE advertenciasxarticulo;nnCREATE TABLE `advertenciasxarticulo` (
  `advertenciaID` int(10) unsigned NOT NULL,
  `articuloID` int(10) unsigned NOT NULL,
  KEY `FK_ArtxAdvertencias` (`articuloID`),
  KEY `FK_AdvxArticulo` (`advertenciaID`),
  CONSTRAINT `FK_AdvxArticulo` FOREIGN KEY (`advertenciaID`) REFERENCES `advertencias` (`advertenciaID`),
  CONSTRAINT `FK_ArtxAdvertencias` FOREIGN KEY (`articuloID`) REFERENCES `articulos` (`articuloID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;nnnnnDROP TABLE aminoacidos;nnCREATE TABLE `aminoacidos` (
  `aminoID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`aminoID`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;nnINSERT INTO aminoacidos VALUES("1","Seri/n/a");nINSERT INTO aminoacidos VALUES("2","Treo/n/i/n/a");nINSERT INTO aminoacidos VALUES("3","Glutami/n/a");nINSERT INTO aminoacidos VALUES("4","Asparagi/n/a");nINSERT INTO aminoacidos VALUES("5","Tirosi/n/a");nINSERT INTO aminoacidos VALUES("6","Cistei/n/a");nINSERT INTO aminoacidos VALUES("7","Glici/n/a");nINSERT INTO aminoacidos VALUES("8","Ala/n/i/n/a");nINSERT INTO aminoacidos VALUES("9","Vali/n/a");nINSERT INTO aminoacidos VALUES("10","Leuci/n/a");nINSERT INTO aminoacidos VALUES("11","Isoleuci/n/a");nINSERT INTO aminoacidos VALUES("12","Metio/n/i/n/a");nINSERT INTO aminoacidos VALUES("13","Proli/n/a");nINSERT INTO aminoacidos VALUES("14","Fe/n/ilala/n/i/n/a");nINSERT INTO aminoacidos VALUES("15","Triptofa/n/o");nINSERT INTO aminoacidos VALUES("16","Acido Aspartico");nINSERT INTO aminoacidos VALUES("17","Acido Glutamico");nINSERT INTO aminoacidos VALUES("18","Lisi/n/a");nINSERT INTO aminoacidos VALUES("19","Argi/n/i/n/a");nINSERT INTO aminoacidos VALUES("20","Histidia");nnnnDROP TABLE articulos;nnCREATE TABLE `articulos` (
  `articuloID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(30) COLLATE utf8_spanish_ci NOT NULL,
  `etiquetas` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `imagen` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `categoriaID` int(10) unsigned NOT NULL,
  `tamanoPorcion` int(10) unsigned NOT NULL,
  `calorias` int(10) unsigned NOT NULL,
  `proteina` int(10) unsigned NOT NULL,
  `lipidos` int(10) unsigned NOT NULL,
  `carbohidratos` int(10) unsigned NOT NULL,
  PRIMARY KEY (`articuloID`),
  KEY `FK_Categoria` (`categoriaID`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;nnINSERT INTO articulos VALUES("1","Gold Sta/n/dard Whey","#protei/n/a, #whey","","1","31","113","24","1","2");nINSERT INTO articulos VALUES("4","God&#039;s Omega 3","#omegas, #AceiteDePescado","","2","1","9","0","1","0");nINSERT INTO articulos VALUES("5","xx","#Etiqueta 2,#Etiqueta 3","Captura.PNG","2","2","2","2","3","2");nINSERT INTO articulos VALUES("6","xx","#Etiqueta 2,#Etiqueta 3","Captura.PNG","2","2","2","2","3","2");nINSERT INTO articulos VALUES("7","xx","#Etiqueta 2,#Etiqueta 3","Captura.PNG","2","2","2","2","3","2");nINSERT INTO articulos VALUES("8","xx","#Etiqueta 2,#Etiqueta 3","Captura.PNG","2","2","2","2","3","2");nINSERT INTO articulos VALUES("9","xx","#Etiqueta 2,#Etiqueta 3","Captura.PNG","2","2","2","2","3","2");nINSERT INTO articulos VALUES("10","xx","#Etiqueta 2,#Etiqueta 3","Captura.PNG","2","2","2","2","3","2");nINSERT INTO articulos VALUES("11","xx","#Etiqueta 2,#Etiqueta 3","Captura.PNG","2","2","2","2","3","2");nINSERT INTO articulos VALUES("12","xx","#Etiqueta 2,#Etiqueta 3","Captura.PNG","2","2","2","2","3","2");nINSERT INTO articulos VALUES("13","xx","#Etiqueta 2,#Etiqueta 3","Captura.PNG","2","2","2","2","3","2");nINSERT INTO articulos VALUES("14","xx","#Etiqueta 2,#Etiqueta 3","Captura.PNG","2","2","2","2","3","2");nINSERT INTO articulos VALUES("15","xx","#Etiqueta 2,#Etiqueta 3","Captura.PNG","2","2","2","2","3","2");nINSERT INTO articulos VALUES("16","xxx","#Etiqueta 1,#Etiqueta 3","default","2","5","1","2","3","4");nINSERT INTO articulos VALUES("17","xxx","#Etiqueta 1,#Etiqueta 3","Captura.PNG","2","5","1","2","3","4");nINSERT INTO articulos VALUES("18","xxx","#Etiqueta 1,#Etiqueta 3","Captura.PNG","2","5","1","2","3","4");nINSERT INTO articulos VALUES("19","xxx","#Etiqueta 1,#Etiqueta 3","Captura.PNG","2","5","1","2","3","4");nINSERT INTO articulos VALUES("20","xxx","#Etiqueta 1,#Etiqueta 3","Captura.PNG","2","5","1","2","3","4");nINSERT INTO articulos VALUES("21","xx","#Etiqueta 1","Captura.PNG","2","2","2","2","2","2");nINSERT INTO articulos VALUES("22","xx","#Etiqueta 1","Captura.PNG","2","2","2","2","2","2");nINSERT INTO articulos VALUES("23","xx","#Etiqueta 1","Captura.PNG","2","2","2","2","2","2");nINSERT INTO articulos VALUES("24","xx","#Etiqueta 1","Captura.PNG","2","2","2","2","2","2");nINSERT INTO articulos VALUES("25","xx","#Etiqueta 1","Captura.PNG","2","2","2","2","2","2");nINSERT INTO articulos VALUES("26","xx","#Etiqueta 1","Captura.PNG","2","2","2","2","2","2");nINSERT INTO articulos VALUES("27","xx","#Etiqueta 1","Captura.PNG","2","2","2","2","2","2");nnnnDROP TABLE categorias;nnCREATE TABLE `categorias` (
  `categoriaID` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`categoriaID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;nnINSERT INTO categorias VALUES("1","Protei/n/a");nINSERT INTO categorias VALUES("2","Omegas");nINSERT INTO categorias VALUES("3","Susta/n/cia especifica");nnnnDROP TABLE fotos_carrusel;nnCREATE TABLE `fotos_carrusel` (
  `fotoID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_foto` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`fotoID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;nnnnnDROP TABLE ingredientes;nnCREATE TABLE `ingredientes` (
  `ingredienteID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  `alergeno` tinyint(1) NOT NULL,
  PRIMARY KEY (`ingredienteID`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;nnINSERT INTO ingredientes VALUES("1","Huevo","1");nINSERT INTO ingredientes VALUES("2","Pescado","1");nINSERT INTO ingredientes VALUES("3","Leche","1");nINSERT INTO ingredientes VALUES("4","Cacahuate","1");nINSERT INTO ingredientes VALUES("5","Soya","1");nINSERT INTO ingredientes VALUES("6","Nueces","1");nINSERT INTO ingredientes VALUES("7","Trigo","1");nINSERT INTO ingredientes VALUES("8","Ce/n/te/n/o","1");nINSERT INTO ingredientes VALUES("9","Cebada","1");nINSERT INTO ingredientes VALUES("10","Crustáceos","1");nINSERT INTO ingredientes VALUES("11","Sucralosa","0");nINSERT INTO ingredientes VALUES("12","Vai/n/illi/n/a","0");nINSERT INTO ingredientes VALUES("13","Goma Xa/n/tha/n/","0");nINSERT INTO ingredientes VALUES("14","Cocoa","0");nINSERT INTO ingredientes VALUES("15","Azúcar","0");nINSERT INTO ingredientes VALUES("16","Protei/n/a asilada de suero de leche","1");nINSERT INTO ingredientes VALUES("17","Protei/n/a co/n/ce/n/trada de suero de leche","1");nINSERT INTO ingredientes VALUES("18","Aceite de pescado","1");nnnnDROP TABLE ingredientesxarticulo;nnCREATE TABLE `ingredientesxarticulo` (
  `articuloID` int(10) unsigned NOT NULL,
  `ingredienteID` int(10) unsigned NOT NULL,
  `ingActivo` tinyint(1) NOT NULL DEFAULT 0,
  KEY `FK_ArtxIngrediente` (`articuloID`),
  KEY `FK_IngxArticulo` (`ingredienteID`),
  CONSTRAINT `FK_ArtxIngrediente` FOREIGN KEY (`articuloID`) REFERENCES `articulos` (`articuloID`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_IngxArticulo` FOREIGN KEY (`ingredienteID`) REFERENCES `ingredientes` (`ingredienteID`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;nnINSERT INTO ingredientesxarticulo VALUES("4","18","1");nINSERT INTO ingredientesxarticulo VALUES("1","17","1");nINSERT INTO ingredientesxarticulo VALUES("1","16","0");nINSERT INTO ingredientesxarticulo VALUES("1","12","0");nINSERT INTO ingredientesxarticulo VALUES("1","13","0");nINSERT INTO ingredientesxarticulo VALUES("1","11","0");nnnnDROP TABLE omegas;nnCREATE TABLE `omegas` (
  `omegaID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(6) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`omegaID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;nnINSERT INTO omegas VALUES("1","Omega3");nINSERT INTO omegas VALUES("2","Omega6");nINSERT INTO omegas VALUES("3","Omega9");nnnnDROP TABLE omegasxarticulo;nnCREATE TABLE `omegasxarticulo` (
  `articuloID` int(10) unsigned NOT NULL,
  `omegaID` int(10) unsigned NOT NULL,
  KEY `ArticuloxOmegas` (`articuloID`),
  KEY `OmegasxArticulo` (`omegaID`),
  CONSTRAINT `ArticuloxOmegas` FOREIGN KEY (`articuloID`) REFERENCES `articulos` (`articuloID`),
  CONSTRAINT `OmegasxArticulo` FOREIGN KEY (`omegaID`) REFERENCES `omegas` (`omegaID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;nnINSERT INTO omegasxarticulo VALUES("4","1");nnnnDROP TABLE perfil_acidos_grasos;nnCREATE TABLE `perfil_acidos_grasos` (
  `articuloID` int(10) unsigned NOT NULL,
  `acidoGrasoID` int(10) unsigned NOT NULL,
  `cantidad` int(10) unsigned NOT NULL,
  KEY `ArticuloxAG` (`articuloID`),
  KEY `AGxArticulo` (`acidoGrasoID`),
  CONSTRAINT `AGxArticulo` FOREIGN KEY (`acidoGrasoID`) REFERENCES `acidos_grasos` (`acidoGrasoID`),
  CONSTRAINT `ArticuloxAG` FOREIGN KEY (`articuloID`) REFERENCES `articulos` (`articuloID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;nnINSERT INTO perfil_acidos_grasos VALUES("4","2","1200");nINSERT INTO perfil_acidos_grasos VALUES("4","1","600");nnnnDROP TABLE perfil_aminoacidos;nnCREATE TABLE `perfil_aminoacidos` (
  `articuloID` int(10) unsigned NOT NULL,
  `aminoID` int(10) unsigned NOT NULL,
  `cantidad` float NOT NULL,
  KEY `perfilAminosXarticulo` (`articuloID`),
  KEY `perfilAminosXamino` (`aminoID`),
  CONSTRAINT `perfilAminosXamino` FOREIGN KEY (`aminoID`) REFERENCES `aminoacidos` (`aminoID`),
  CONSTRAINT `perfilAminosXarticulo` FOREIGN KEY (`articuloID`) REFERENCES `articulos` (`articuloID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;nnINSERT INTO perfil_aminoacidos VALUES("1","1","5.3");nINSERT INTO perfil_aminoacidos VALUES("1","2","11");nINSERT INTO perfil_aminoacidos VALUES("1","3","7.7");nINSERT INTO perfil_aminoacidos VALUES("1","4","2");nINSERT INTO perfil_aminoacidos VALUES("1","5","7.7");nINSERT INTO perfil_aminoacidos VALUES("1","6","7.7");nINSERT INTO perfil_aminoacidos VALUES("1","7","5.3");nINSERT INTO perfil_aminoacidos VALUES("1","8","5.3");nINSERT INTO perfil_aminoacidos VALUES("1","9","11");nINSERT INTO perfil_aminoacidos VALUES("1","10","11");nINSERT INTO perfil_aminoacidos VALUES("1","11","11");nINSERT INTO perfil_aminoacidos VALUES("1","12","11");nINSERT INTO perfil_aminoacidos VALUES("1","13","7.7");nINSERT INTO perfil_aminoacidos VALUES("1","14","11");nINSERT INTO perfil_aminoacidos VALUES("1","15","11");nINSERT INTO perfil_aminoacidos VALUES("1","16","5.3");nINSERT INTO perfil_aminoacidos VALUES("1","17","7.7");nINSERT INTO perfil_aminoacidos VALUES("1","18","11");nINSERT INTO perfil_aminoacidos VALUES("1","19","7.7");nINSERT INTO perfil_aminoacidos VALUES("1","20","7.7");nnnnDROP TABLE reportes;nnCREATE TABLE `reportes` (
  `reporteID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `resumen` varchar(100) COLLATE utf8_spanish_ci NOT NULL,
  `texto` varchar(500) COLLATE utf8_spanish_ci NOT NULL,
  `fechaCreacion` datetime NOT NULL,
  `articuloID` int(10) unsigned NOT NULL,
  `usuarioID` int(10) unsigned NOT NULL,
  PRIMARY KEY (`reporteID`),
  KEY `FK_ArtxReporte` (`articuloID`),
  KEY `FK_UsrxReporte` (`usuarioID`),
  CONSTRAINT `FK_ArtxReporte` FOREIGN KEY (`articuloID`) REFERENCES `articulos` (`articuloID`),
  CONSTRAINT `FK_UsrxReporte` FOREIGN KEY (`usuarioID`) REFERENCES `usuarios` (`usuarioID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;nnINSERT INTO reportes VALUES("1","0","x","0000-00-00 00:00:00","1","1");nINSERT INTO reportes VALUES("2","x","x","0000-00-00 00:00:00","1","1");nINSERT INTO reportes VALUES("3","x","x","2022-06-19 00:00:00","1","1");nnnnDROP TABLE tipos_usuario;nnCREATE TABLE `tipos_usuario` (
  `tipoUsuarioID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipo` varchar(15) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`tipoUsuarioID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;nnINSERT INTO tipos_usuario VALUES("1","I/n/vitado");nINSERT INTO tipos_usuario VALUES("2","Registrado");nINSERT INTO tipos_usuario VALUES("3","Moderador");nINSERT INTO tipos_usuario VALUES("4","Admi/n/istrador");nnnnDROP TABLE usuarios;nnCREATE TABLE `usuarios` (
  `usuarioID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tipoUsuarioID` int(10) unsigned NOT NULL,
  `correo` varchar(200) COLLATE utf8_spanish_ci NOT NULL,
  `nombre` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `apellido` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `nombreUsuario` varchar(20) COLLATE utf8_spanish_ci NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `contrasena` varchar(60) COLLATE utf8_spanish_ci NOT NULL,
  PRIMARY KEY (`usuarioID`),
  KEY `FK_tipo_usuario` (`tipoUsuarioID`),
  CONSTRAINT `FK_tipo_usuario` FOREIGN KEY (`tipoUsuarioID`) REFERENCES `tipos_usuario` (`tipoUsuarioID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;nnINSERT INTO usuarios VALUES("1","4","samuelbarraga/n/mira/n/da@gmail.com","Samuel","Barragá/n/","ImSammyB","2001-12-08","12345678");nINSERT INTO usuarios VALUES("2","4","pepepecas@gmail.com","Pepe","Toro","Pecas","2001-02-10","$2y$10$mcj6peu/n/347skGpHGH3iLuBjw2XAAJ6uGHIOREIh1N514kuy.BVB.");nnnnDROP TABLE vitaminas;nnCREATE TABLE `vitaminas` (
  `vitaminaID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) COLLATE utf8_spanish_ci NOT NULL,
  `reqDiario` float NOT NULL,
  PRIMARY KEY (`vitaminaID`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;nnINSERT INTO vitaminas VALUES("1","Vitami/n/a A","0.0009");nINSERT INTO vitaminas VALUES("2","Vitami/n/a B1","0.0012");nINSERT INTO vitaminas VALUES("3","Vitami/n/a B2","0.0013");nINSERT INTO vitaminas VALUES("4","Vitami/n/a B3","0.016");nINSERT INTO vitaminas VALUES("5","Vitami/n/a B5","0.005");nINSERT INTO vitaminas VALUES("6","Vitami/n/a B6","0.0015");nINSERT INTO vitaminas VALUES("7","Vitami/n/a B7","3.0E-5");nINSERT INTO vitaminas VALUES("8","Vitami/n/a B9","0.0004");nINSERT INTO vitaminas VALUES("9","Vitami/n/a B12","2.4E-6");nINSERT INTO vitaminas VALUES("10","Vitami/n/a C","0.09");nINSERT INTO vitaminas VALUES("11","Vitami/n/a D","1.0E-5");nINSERT INTO vitaminas VALUES("12","Vitami/n/a E","0.015");nINSERT INTO vitaminas VALUES("13","Vitami/n/a K","0.00012");nINSERT INTO vitaminas VALUES("14","Calcio","0.011");nINSERT INTO vitaminas VALUES("15","Cloruro","2.3");nINSERT INTO vitaminas VALUES("16","Cromo","3.0E-5");nINSERT INTO vitaminas VALUES("17","Cobre","0.0009");nINSERT INTO vitaminas VALUES("18","Fluor","0.004");nINSERT INTO vitaminas VALUES("19","Yodo","0.00015");nINSERT INTO vitaminas VALUES("20","Hierro","0.013");nINSERT INTO vitaminas VALUES("21","Mag/n/esio","0.37");nINSERT INTO vitaminas VALUES("22","Ma/n/ga/n/eso","0.002");nINSERT INTO vitaminas VALUES("23","Molibde/n/o","4.5E-5");nINSERT INTO vitaminas VALUES("24","Fosforo","0.7");nINSERT INTO vitaminas VALUES("25","Potasio","4.7");nINSERT INTO vitaminas VALUES("26","Sele/n/io","5.5E-5");nINSERT INTO vitaminas VALUES("27","Sodio","2.3");nINSERT INTO vitaminas VALUES("28","Azufre","0");nINSERT INTO vitaminas VALUES("29","Zi/n/c","0.009");nnnnDROP TABLE vitaminasxarticulo;nnCREATE TABLE `vitaminasxarticulo` (
  `articuloID` int(10) unsigned NOT NULL,
  `vitaminaID` int(10) unsigned NOT NULL,
  `cantidad` float NOT NULL,
  KEY `FK_ArtxVitaminas` (`articuloID`),
  KEY `FK_VitxArticulo` (`vitaminaID`),
  CONSTRAINT `FK_ArtxVitaminas` FOREIGN KEY (`articuloID`) REFERENCES `articulos` (`articuloID`),
  CONSTRAINT `FK_VitxArticulo` FOREIGN KEY (`vitaminaID`) REFERENCES `vitaminas` (`vitaminaID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;nnnnn