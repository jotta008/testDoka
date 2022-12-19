-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.36 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para testdoka
CREATE DATABASE IF NOT EXISTS `testdoka` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `testdoka`;

-- Volcando estructura para tabla testdoka.almacen
CREATE TABLE IF NOT EXISTS `almacen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla testdoka.articulo
CREATE TABLE IF NOT EXISTS `articulo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(500) NOT NULL,
  `gtin` varchar(200) NOT NULL COMMENT 'separado por comas',
  `codigoInterno` varchar(10) NOT NULL,
  `idLaboratorio` int(11) NOT NULL,
  `fraccionable` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1: Si, 2: No',
  `unidadDeFraccion` int(11) NOT NULL,
  `precioVenta` float NOT NULL,
  `precioCompra` float NOT NULL,
  `idAlmacen` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_articulo_laboratorio` (`idLaboratorio`),
  KEY `FK_articulo_almacen` (`idAlmacen`),
  CONSTRAINT `FK_articulo_almacen` FOREIGN KEY (`idAlmacen`) REFERENCES `almacen` (`id`),
  CONSTRAINT `FK_articulo_laboratorio` FOREIGN KEY (`idLaboratorio`) REFERENCES `laboratorio` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla testdoka.laboratorio
CREATE TABLE IF NOT EXISTS `laboratorio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(200) NOT NULL,
  `cuit` int(11) NOT NULL,
  `razonSocial` varchar(200) NOT NULL,
  `direccion` varchar(200) NOT NULL,
  `codigo` varchar(10) NOT NULL COMMENT 'Codigo alfanumerico de 10 caracteres',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla testdoka.lote
CREATE TABLE IF NOT EXISTS `lote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `numeroLote` int(11) NOT NULL,
  `fechaElaboracion` datetime NOT NULL,
  `fechaVencimiento` datetime NOT NULL,
  `idArticulo` int(11) NOT NULL,
  `idAlmacen` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_lote_articulo` (`idArticulo`),
  KEY `FK_lote_almacen` (`idAlmacen`),
  CONSTRAINT `FK_lote_almacen` FOREIGN KEY (`idAlmacen`) REFERENCES `almacen` (`id`),
  CONSTRAINT `FK_lote_articulo` FOREIGN KEY (`idArticulo`) REFERENCES `articulo` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- La exportación de datos fue deseleccionada.

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
