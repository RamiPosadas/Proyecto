
CREATE TABLE `funciones` (
  `fncod` varchar(255) NOT NULL,
  `fndsc` varchar(255) DEFAULT NULL,
  `fnest` char(3) DEFAULT NULL,
  `fntyp` char(3) DEFAULT NULL,
  PRIMARY KEY (`fncod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

CREATE TABLE `funciones_roles` (
  `rolescod` varchar(128) NOT NULL,
  `fncod` varchar(255) NOT NULL,
  `fnrolest` char(3) DEFAULT NULL,
  `fnexp` datetime DEFAULT NULL,
  PRIMARY KEY (`rolescod`,`fncod`),
  KEY `rol_funcion_key_idx` (`fncod`),
  CONSTRAINT `funcion_rol_key` FOREIGN KEY (`rolescod`) REFERENCES `roles` (`rolescod`),
  CONSTRAINT `rol_funcion_key` FOREIGN KEY (`fncod`) REFERENCES `funciones` (`fncod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


CREATE TABLE `products` (
  `productId` int NOT NULL AUTO_INCREMENT,
  `productName` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `productDescription` text COLLATE utf8mb4_general_ci NOT NULL,
  `productPrice` decimal(10,2) NOT NULL,
  `productImgUrl` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `productStock` int NOT NULL DEFAULT '0',
  `productStatus` char(3) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`productId`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `purchase`;
CREATE TABLE `purchase` (
  `id_purchase` varchar(450) COLLATE utf8mb4_general_ci NOT NULL,
  `purchase_date` date DEFAULT NULL,
  `total` decimal(12,2) DEFAULT NULL,
  `details` varchar(450) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `usercod` varchar(250) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `payments` mediumtext COLLATE utf8mb4_general_ci,
  PRIMARY KEY (`id_purchase`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `purchasedetail` (
  `id_purchase` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `id_item_reference` varchar(250) COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` int DEFAULT NULL,
  `unitary_price` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

CREATE TABLE `roles` (
  `rolescod` varchar(128) NOT NULL,
  `rolesdsc` varchar(45) DEFAULT NULL,
  `rolesest` char(3) DEFAULT NULL,
  PRIMARY KEY (`rolescod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


CREATE TABLE `roles_usuarios` (
  `usercod` bigint NOT NULL,
  `rolescod` varchar(128) NOT NULL,
  `roleuserest` char(3) DEFAULT NULL,
  `roleuserfch` datetime DEFAULT NULL,
  `roleuserexp` datetime DEFAULT NULL,
  PRIMARY KEY (`usercod`,`rolescod`),
  KEY `rol_usuario_key_idx` (`rolescod`),
  CONSTRAINT `rol_usuario_key` FOREIGN KEY (`rolescod`) REFERENCES `roles` (`rolescod`),
  CONSTRAINT `usuario_rol_key` FOREIGN KEY (`usercod`) REFERENCES `usuario` (`usercod`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


CREATE TABLE `usuario` (
  `usercod` bigint NOT NULL AUTO_INCREMENT,
  `useremail` varchar(80) DEFAULT NULL,
  `username` varchar(80) DEFAULT NULL,
  `userpswd` varchar(128) DEFAULT NULL,
  `userfching` datetime DEFAULT NULL,
  `userpswdest` char(3) DEFAULT NULL,
  `userpswdexp` datetime DEFAULT NULL,
  `userest` char(3) DEFAULT NULL,
  `useractcod` varchar(128) DEFAULT NULL,
  `userpswdchg` varchar(128) DEFAULT NULL,
  `usertipo` char(3) DEFAULT NULL COMMENT 'Tipo de Usuario, Normal, Consultor o Cliente',
  PRIMARY KEY (`usercod`),
  UNIQUE KEY `useremail_UNIQUE` (`useremail`),
  KEY `usertipo` (`usertipo`,`useremail`,`usercod`,`userest`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;
