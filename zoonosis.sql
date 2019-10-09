/*
SQLyog Community v12.4.3 (64 bit)
MySQL - 5.6.21 : Database - zoonosis_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`zoonosis_db` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `zoonosis_db`;

/*Table structure for table `datos_centro` */

DROP TABLE IF EXISTS `datos_centro`;

CREATE TABLE `datos_centro` (
  `id_centro` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `direccion` varchar(50) DEFAULT NULL,
  `telefono` int(11) DEFAULT NULL,
  `celular` int(11) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `web` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_centro`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `datos_centro` */

LOCK TABLES `datos_centro` WRITE;

insert  into `datos_centro`(`id_centro`,`nombre`,`descripcion`,`direccion`,`telefono`,`celular`,`email`,`web`) values 
(2,'maria','ES MUY LECHERA','asdasdasd',23,0,'skaynet.kays@gmail.com','adas'),
(3,'FFDFF','ES MUY LECHERA','21312',767,123,'eve@hotmail.com','sads@gmail.com');

UNLOCK TABLES;

/*Table structure for table `grado_peligro` */

DROP TABLE IF EXISTS `grado_peligro`;

CREATE TABLE `grado_peligro` (
  `id_grado_peligro` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_grado_peligro`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `grado_peligro` */

LOCK TABLES `grado_peligro` WRITE;

insert  into `grado_peligro`(`id_grado_peligro`,`nombre`) values 
(2,'asdasdas'),
(3,'rojo');

UNLOCK TABLES;

/*Table structure for table `mascota_adopcion` */

DROP TABLE IF EXISTS `mascota_adopcion`;

CREATE TABLE `mascota_adopcion` (
  `id_mascota_adopcion` int(11) NOT NULL AUTO_INCREMENT,
  `id_mascota` int(11) DEFAULT NULL,
  `id_adopcion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_mascota_adopcion`),
  KEY `id_mascota` (`id_mascota`),
  KEY `id_adopcion` (`id_adopcion`),
  CONSTRAINT `mascota_adopcion_ibfk_1` FOREIGN KEY (`id_mascota`) REFERENCES `registro_mascota` (`id_mascota`),
  CONSTRAINT `mascota_adopcion_ibfk_2` FOREIGN KEY (`id_adopcion`) REFERENCES `solicitud_adopcion` (`id_adopcion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `mascota_adopcion` */

LOCK TABLES `mascota_adopcion` WRITE;

insert  into `mascota_adopcion`(`id_mascota_adopcion`,`id_mascota`,`id_adopcion`) values 
(2,1,4);

UNLOCK TABLES;

/*Table structure for table `raza` */

DROP TABLE IF EXISTS `raza`;

CREATE TABLE `raza` (
  `id_raza` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `id_tipo_mascota` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_raza`),
  KEY `id_tipo_mascota` (`id_tipo_mascota`),
  CONSTRAINT `raza_ibfk_1` FOREIGN KEY (`id_tipo_mascota`) REFERENCES `tipo_mascota` (`id_tipo_mascota`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `raza` */

LOCK TABLES `raza` WRITE;

insert  into `raza`(`id_raza`,`nombre`,`id_tipo_mascota`) values 
(6,'FFDFF',4),
(7,'SISTEMAS',3),
(8,'bulterry-americano',3);

UNLOCK TABLES;

/*Table structure for table `registro_mascota` */

DROP TABLE IF EXISTS `registro_mascota`;

CREATE TABLE `registro_mascota` (
  `id_mascota` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `fecha_nac` date DEFAULT NULL,
  `especie` varchar(50) DEFAULT NULL,
  `sexo` varchar(50) DEFAULT NULL,
  `color` varchar(50) DEFAULT NULL,
  `senal` varchar(50) DEFAULT NULL,
  `tipo_pelo` varchar(50) DEFAULT NULL,
  `imagen` tinyblob,
  `fecha_registro` date DEFAULT NULL,
  `id_raza` int(11) DEFAULT NULL,
  `id_centro` int(11) DEFAULT NULL,
  `id_senas_particulares` int(11) DEFAULT NULL,
  `id_grado_peligro` int(11) DEFAULT NULL,
  `id_vacuna` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_mascota`),
  KEY `id_raza` (`id_raza`),
  KEY `id_centro` (`id_centro`),
  KEY `id_señas_particulares` (`id_senas_particulares`),
  KEY `id_grado_peligro` (`id_grado_peligro`),
  KEY `id_vacuna` (`id_vacuna`),
  CONSTRAINT `registro_mascota_ibfk_1` FOREIGN KEY (`id_raza`) REFERENCES `raza` (`id_raza`),
  CONSTRAINT `registro_mascota_ibfk_2` FOREIGN KEY (`id_centro`) REFERENCES `datos_centro` (`id_centro`),
  CONSTRAINT `registro_mascota_ibfk_3` FOREIGN KEY (`id_senas_particulares`) REFERENCES `senas_particulares` (`id_senas_particulares`),
  CONSTRAINT `registro_mascota_ibfk_4` FOREIGN KEY (`id_grado_peligro`) REFERENCES `grado_peligro` (`id_grado_peligro`),
  CONSTRAINT `registro_mascota_ibfk_5` FOREIGN KEY (`id_vacuna`) REFERENCES `registro_vacunas` (`id_vacuna`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `registro_mascota` */

LOCK TABLES `registro_mascota` WRITE;

insert  into `registro_mascota`(`id_mascota`,`nombre`,`fecha_nac`,`especie`,`sexo`,`color`,`senal`,`tipo_pelo`,`imagen`,`fecha_registro`,`id_raza`,`id_centro`,`id_senas_particulares`,`id_grado_peligro`,`id_vacuna`) values 
(1,'dfs','2019-09-10','sada','f','ada','asda','ads','sda','2019-09-10',6,3,2,2,5),
(2,'mario','2019-09-10','carnivora','f','s','ad','asda','asd','2019-09-04',6,2,3,2,6),
(3,'bonny','2019-10-02','chapa','macho','choco','mochos','lasio','sadas','2019-10-09',8,2,3,3,7);

UNLOCK TABLES;

/*Table structure for table `registro_vacunas` */

DROP TABLE IF EXISTS `registro_vacunas`;

CREATE TABLE `registro_vacunas` (
  `id_vacuna` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_vacuna` varchar(50) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id_vacuna`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `registro_vacunas` */

LOCK TABLES `registro_vacunas` WRITE;

insert  into `registro_vacunas`(`id_vacuna`,`tipo_vacuna`,`fecha`) values 
(5,'ultrauterino','2019-09-20'),
(6,'tetanos','2019-09-20'),
(7,'corrosivo','2019-10-17');

UNLOCK TABLES;

/*Table structure for table `rol` */

DROP TABLE IF EXISTS `rol`;

CREATE TABLE `rol` (
  `id_rol` int(11) NOT NULL AUTO_INCREMENT,
  `rol` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `rol` */

LOCK TABLES `rol` WRITE;

insert  into `rol`(`id_rol`,`rol`) values 
(1,'utrutru'),
(2,'Administrador'),
(3,'Cajero');

UNLOCK TABLES;

/*Table structure for table `senas_particulares` */

DROP TABLE IF EXISTS `senas_particulares`;

CREATE TABLE `senas_particulares` (
  `id_senas_particulares` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_senas_particulares`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `senas_particulares` */

LOCK TABLES `senas_particulares` WRITE;

insert  into `senas_particulares`(`id_senas_particulares`,`nombre`) values 
(2,'SISTEMAS'),
(3,'microchip');

UNLOCK TABLES;

/*Table structure for table `solicitud_adopcion` */

DROP TABLE IF EXISTS `solicitud_adopcion`;

CREATE TABLE `solicitud_adopcion` (
  `id_adopcion` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_vivienda` varchar(50) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  `fecha_solicitud` date DEFAULT NULL,
  `nombre_solicitante` varchar(50) DEFAULT NULL,
  `ci_solicitante` int(11) DEFAULT NULL,
  `id_mascota` int(11) DEFAULT NULL,
  `id_centro` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_adopcion`),
  KEY `id_mascota` (`id_mascota`),
  KEY `id_centro` (`id_centro`),
  CONSTRAINT `solicitud_adopcion_ibfk_1` FOREIGN KEY (`id_mascota`) REFERENCES `registro_mascota` (`id_mascota`),
  CONSTRAINT `solicitud_adopcion_ibfk_2` FOREIGN KEY (`id_centro`) REFERENCES `datos_centro` (`id_centro`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `solicitud_adopcion` */

LOCK TABLES `solicitud_adopcion` WRITE;

insert  into `solicitud_adopcion`(`id_adopcion`,`tipo_vivienda`,`descripcion`,`fecha_solicitud`,`nombre_solicitante`,`ci_solicitante`,`id_mascota`,`id_centro`) values 
(4,'asd','asdas','2019-09-01','asda',12312,1,3),
(5,'adas','ES MUY LECHERA','0000-00-00','sfs',24324,1,2);

UNLOCK TABLES;

/*Table structure for table `tipo_mascota` */

DROP TABLE IF EXISTS `tipo_mascota`;

CREATE TABLE `tipo_mascota` (
  `id_tipo_mascota` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_tipo_mascota`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tipo_mascota` */

LOCK TABLES `tipo_mascota` WRITE;

insert  into `tipo_mascota`(`id_tipo_mascota`,`nombre`) values 
(3,'SISTEMAS'),
(4,'maria'),
(5,'bul-terry');

UNLOCK TABLES;

/*Table structure for table `usuarios` */

DROP TABLE IF EXISTS `usuarios`;

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `id_rol` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `id_rol` (`id_rol`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `rol` (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `usuarios` */

LOCK TABLES `usuarios` WRITE;

insert  into `usuarios`(`id_usuario`,`nombre`,`password`,`id_rol`) values 
(1,'mario','123',3),
(5,'rosalia','123',1),
(7,'maita','123',3),
(8,'saito','123',1);

UNLOCK TABLES;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
