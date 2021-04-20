-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         5.7.24 - MySQL Community Server (GPL)
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para facturacion_plasencia
CREATE DATABASE IF NOT EXISTS `facturacion_plasencia` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `facturacion_plasencia`;

-- Volcando estructura para tabla facturacion_plasencia.capa_productos
CREATE TABLE IF NOT EXISTS `capa_productos` (
  `id_capa` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `capa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_capa`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla facturacion_plasencia.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `categoria` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla facturacion_plasencia.cellos
CREATE TABLE IF NOT EXISTS `cellos` (
  `id_cello` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cello` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anillo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_cello`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla facturacion_plasencia.clase_productos
CREATE TABLE IF NOT EXISTS `clase_productos` (
  `id_producto` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_capa` int(11) NOT NULL,
  `id_vitola` int(11) NOT NULL,
  `id_nombre` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `id_cello` int(11) NOT NULL,
  `id_tipo_empaque` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_producto`)
) ENGINE=MyISAM AUTO_INCREMENT=210 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla facturacion_plasencia.detalle_clase_productos
CREATE TABLE IF NOT EXISTS `detalle_clase_productos` (
  `id_producto` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `item` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_capa` int(11) NOT NULL,
  `id_vitola` int(11) NOT NULL,
  `id_nombre` int(11) NOT NULL,
  `id_marca` int(11) NOT NULL,
  `id_cello` int(11) NOT NULL,
  `id_tipo_empaque` int(11) NOT NULL,
  `otra_descripcion` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_producto`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=213 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla facturacion_plasencia.marca_productos
CREATE TABLE IF NOT EXISTS `marca_productos` (
  `id_marca` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `marca` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_marca`)
) ENGINE=MyISAM AUTO_INCREMENT=237 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla facturacion_plasencia.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=241 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla facturacion_plasencia.nombre_productos
CREATE TABLE IF NOT EXISTS `nombre_productos` (
  `id_nombre` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_nombre`)
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla facturacion_plasencia.orden_productos
CREATE TABLE IF NOT EXISTS `orden_productos` (
  `id_orden` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `orden` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_orden`)
) ENGINE=MyISAM AUTO_INCREMENT=252 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla facturacion_plasencia.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla facturacion_plasencia.pedidos
CREATE TABLE IF NOT EXISTS `pedidos` (
  `item` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cant_paquetes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unidades` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero_orden` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoria` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla facturacion_plasencia.pendiente
CREATE TABLE IF NOT EXISTS `pendiente` (
  `categoria` int(11) DEFAULT NULL,
  `item` varchar(50) DEFAULT NULL,
  `orden_del_sitema` varchar(50) DEFAULT NULL,
  `observacion` varchar(50) DEFAULT NULL,
  `presentacion` varchar(50) DEFAULT NULL,
  `mes` date DEFAULT NULL,
  `orden` int(11) DEFAULT NULL,
  `marca` int(11) DEFAULT NULL,
  `vitola` int(11) DEFAULT NULL,
  `nombre` int(11) DEFAULT NULL,
  `capa` int(11) DEFAULT NULL,
  `tipo_empaque` int(11) DEFAULT NULL,
  `cello` int(11) DEFAULT NULL,
  `pendiente` int(11) DEFAULT NULL,
  `factura_del_mes` int(11) DEFAULT NULL,
  `cantidad_enviada_mes` int(11) DEFAULT NULL,
  `saldo` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COMMENT='CATEGORIA	ITEM	ORDEN DEL SISTEMA	OBSERVACÓN	PRESENTACIÓN	MES	ORDEN	MARCA	VITOLA	NOMBRE	CAPA	TIPO DE EMPAQUE	ANILLO	CELLO	UPC	PENDIENTE	MARZO 2021 FACTURA #17976(Warehouse)	ENVIADO MES	SALDO';

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla facturacion_plasencia.pendiente_embarque
CREATE TABLE IF NOT EXISTS `pendiente_embarque` (
  `Columna 1` int(11) DEFAULT NULL,
  `Columna 2` int(11) DEFAULT NULL,
  `Columna 3` int(11) DEFAULT NULL,
  `Columna 4` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla facturacion_plasencia.sample_datas
CREATE TABLE IF NOT EXISTS `sample_datas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla facturacion_plasencia.tbl_customer
CREATE TABLE IF NOT EXISTS `tbl_customer` (
  `CustomerID` int(11) NOT NULL AUTO_INCREMENT,
  `CustomerName` varchar(50) DEFAULT NULL,
  `Gender` varchar(50) DEFAULT NULL,
  `Address` varchar(50) DEFAULT NULL,
  `City` varchar(50) DEFAULT NULL,
  `PostalCode` varchar(50) DEFAULT NULL,
  `Country` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`CustomerID`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla facturacion_plasencia.tipo_empaques
CREATE TABLE IF NOT EXISTS `tipo_empaques` (
  `id_tipo_empaque` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_empaque` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_tipo_empaque`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla facturacion_plasencia.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla facturacion_plasencia.vehicles
CREATE TABLE IF NOT EXISTS `vehicles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `registration_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fuel_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `doors` int(11) NOT NULL,
  `year` int(11) NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para tabla facturacion_plasencia.vitola_productos
CREATE TABLE IF NOT EXISTS `vitola_productos` (
  `id_vitola` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `vitola` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_vitola`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- La exportación de datos fue deseleccionada.

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_pendiente
DELIMITER //
CREATE PROCEDURE `buscar_pendiente`(
	IN `nombre` VARCHAR(50),
	IN `fechade` VARCHAR(50),
	IN `fechahasta` VARCHAR(50)
)
BEGIN
if nombre="0" && fechade="0" && fechahasta="0" then

SELECT categoria.categoria AS categoria, pendiente.item AS item,pendiente.orden_del_sitema ,pendiente.observacion 
,pendiente.observacion ,pendiente.mes AS mes ,orden_productos.orden AS orden, marca_productos.marca AS marca,vitola_productos.vitola AS vitola, 
nombre_productos.nombre AS nombre, capa_productos.capa AS capa,
cellos.anillo AS anillo,cellos.cello AS cello, cellos.upc AS upc, pendiente.pendiente as pendiente,pendiente.factura_del_mes, pendiente.cantidad_enviada_mes, pendiente.saldo, tipo_empaques.tipo_empaque AS tipo_empaque
FROM categoria, clase_productos, marca_productos, vitola_productos,nombre_productos, capa_productos, orden_productos,cellos,
tipo_empaques, pendiente
WHERE clase_productos.id_vitola = vitola_productos.id_vitola AND clase_productos.id_capa = capa_productos.id_capa AND pendiente.capa = capa_productos.id_capa and
 clase_productos.id_nombre = nombre_productos.id_nombre AND  clase_productos.id_marca = marca_productos.id_marca AND cellos.id_cello=clase_productos.id_cello and
   clase_productos.id_tipo_empaque = tipo_empaques.id_tipo_empaque AND pendiente.categoria = categoria.id_categoria 
	GROUP BY pendiente.item, pendiente.orden, pendiente.categoria;
	
ELSE  

if fechade = "0"   && fechahasta = "0"  && nombre != "0" then

SELECT categoria.categoria AS categoria, pendiente.item AS item,pendiente.orden_del_sitema ,pendiente.observacion 
,pendiente.observacion ,pendiente.mes AS mes ,orden_productos.orden AS orden, marca_productos.marca AS marca,vitola_productos.vitola AS vitola, 
nombre_productos.nombre AS nombre, capa_productos.capa AS capa,
cellos.anillo AS anillo,cellos.cello AS cello, cellos.upc AS upc, pendiente.pendiente as pendiente,pendiente.factura_del_mes, pendiente.cantidad_enviada_mes, pendiente.saldo, tipo_empaques.tipo_empaque AS tipo_empaque
FROM categoria, clase_productos, marca_productos, vitola_productos,nombre_productos, capa_productos, orden_productos,cellos,
tipo_empaques, pendiente
WHERE clase_productos.id_vitola = vitola_productos.id_vitola AND clase_productos.id_capa = capa_productos.id_capa AND pendiente.capa = capa_productos.id_capa and
 clase_productos.id_nombre = nombre_productos.id_nombre AND  clase_productos.id_marca = marca_productos.id_marca AND cellos.id_cello=clase_productos.id_cello and
   clase_productos.id_tipo_empaque = tipo_empaques.id_tipo_empaque AND pendiente.categoria = categoria.id_categoria AND pendiente.nombre = nombre_productos.id_nombre and
    pendiente.capa = capa_productos.id_capa AND pendiente.marca = marca_productos.id_marca and
  (nombre_productos.nombre LIKE  CONCAT("%",nombre, "%") or  capa_productos.capa LIKE  CONCAT("%",nombre, "%") or  marca_productos.marca LIKE  CONCAT("%",nombre, "%") )

	GROUP BY pendiente.item, pendiente.orden, pendiente.categoria;
	
	
	
	else
	
	if fechade != "0"   && fechahasta != "0"  && nombre = "0" then
	
	
	SELECT categoria.categoria AS categoria, pendiente.item AS item,pendiente.orden_del_sitema ,pendiente.observacion 
,pendiente.observacion ,pendiente.mes AS mes ,orden_productos.orden AS orden, marca_productos.marca AS marca,vitola_productos.vitola AS vitola, 
nombre_productos.nombre AS nombre, capa_productos.capa AS capa,
cellos.anillo AS anillo,cellos.cello AS cello, cellos.upc AS upc, pendiente.pendiente as pendiente,pendiente.factura_del_mes, pendiente.cantidad_enviada_mes, pendiente.saldo, tipo_empaques.tipo_empaque AS tipo_empaque
FROM categoria, clase_productos, marca_productos, vitola_productos,nombre_productos, capa_productos, orden_productos,cellos,
tipo_empaques, pendiente
WHERE clase_productos.id_vitola = vitola_productos.id_vitola AND clase_productos.id_capa = capa_productos.id_capa AND pendiente.capa = capa_productos.id_capa and
 clase_productos.id_nombre = nombre_productos.id_nombre AND  clase_productos.id_marca = marca_productos.id_marca AND cellos.id_cello=clase_productos.id_cello and
   clase_productos.id_tipo_empaque = tipo_empaques.id_tipo_empaque AND pendiente.categoria = categoria.id_categoria AND pendiente.nombre = nombre_productos.id_nombre and
    pendiente.capa = capa_productos.id_capa AND pendiente.marca = marca_productos.id_marca AND  pendiente.mes between  STR_TO_DATE( fechade,"%Y-%m-%d") AND STR_TO_DATE(  fechahasta, "%Y-%m-%d") 
                      
  

	GROUP BY pendiente.item, pendiente.orden, pendiente.categoria;
	
	else
	SELECT "";
	
	END if;
END if;	
END if;	
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.insertar_clase_producto
DELIMITER //
CREATE PROCEDURE `insertar_clase_producto`(
	IN `item` VARCHAR(50),
	IN `capa` VARCHAR(50),
	IN `vitola` VARCHAR(50),
	IN `nombre` VARCHAR(50),
	IN `marca` VARCHAR(50),
	IN `cello` VARCHAR(50),
	IN `anillo` VARCHAR(50),
	IN `upc` VARCHAR(50),
	IN `tipo_empaque` VARCHAR(50)
)
BEGIN

DECLARE icapa INT;
DECLARE imarca INT;
DECLARE inombre INT;
DECLARE ivitola INT;
DECLARE icello INT;
DECLARE itipo INT;


SET ivitola = (SELECT vitola_productos.id_vitola FROM  vitola_productos WHERE vitola_productos.vitola = vitola);
SET icapa = (SELECT capa_productos.id_capa FROM  capa_productos WHERE capa_productos.capa = capa);
SET imarca = (SELECT marca_productos.id_marca FROM marca_productos WHERE marca_productos.marca = marca);
SET inombre = (SELECT nombre_productos.id_nombre FROM nombre_productos WHERE nombre_productos.nombre = nombre);
SET icello = (SELECT cellos.id_cello FROM cellos WHERE cellos.cello = cello AND cellos.anillo = anillo AND cellos.upc= upc);
SET itipo =  (SELECT tipo_empaques.id_tipo_empaque FROM tipo_empaques WHERE tipo_empaques.tipo_empaque = tipo_empaque);

INSERT INTO clase_productos(clase_productos.item,clase_productos.id_capa, clase_productos.id_vitola,
clase_productos.id_nombre,clase_productos.id_marca, clase_productos.id_cello, clase_productos.id_tipo_empaque)
VALUES(item, icapa,ivitola,inombre,imarca,icello,itipo);

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.insertar_detalle_clase_producto
DELIMITER //
CREATE PROCEDURE `insertar_detalle_clase_producto`(
	IN `item` VARCHAR(50),
	IN `capa` VARCHAR(50),
	IN `vitola` VARCHAR(50),
	IN `nombre` VARCHAR(50),
	IN `marca` VARCHAR(50),
	IN `cello` VARCHAR(50),
	IN `anillo` VARCHAR(50),
	IN `upc` VARCHAR(50),
	IN `tipo_empaque` VARCHAR(50),
	IN `precio` VARCHAR(50)
)
BEGIN
	
DECLARE icapa INT;
DECLARE imarca INT;
DECLARE inombre INT;
DECLARE ivitola INT;
DECLARE icello INT;
DECLARE itipo INT;

SET ivitola = (SELECT vitola_productos.id_vitola FROM  vitola_productos WHERE vitola_productos.vitola = vitola);
SET icapa = (SELECT capa_productos.id_capa FROM  capa_productos WHERE capa_productos.capa = capa);
SET imarca = (SELECT marca_productos.id_marca FROM marca_productos WHERE marca_productos.marca = marca);
SET inombre = (SELECT nombre_productos.id_nombre FROM nombre_productos WHERE nombre_productos.nombre = nombre);
SET icello = (SELECT cellos.id_cello FROM cellos WHERE cellos.cello = cello AND cellos.anillo = anillo AND cellos.upc= upc);
SET itipo =  (SELECT tipo_empaques.id_tipo_empaque FROM tipo_empaques WHERE tipo_empaques.tipo_empaque = tipo_empaque);

INSERT INTO detalle_clase_productos(detalle_clase_productos.item,detalle_clase_productos.id_capa, detalle_clase_productos.id_vitola,
detalle_clase_productos.id_nombre,detalle_clase_productos.id_marca, detalle_clase_productos.id_cello, detalle_clase_productos.id_tipo_empaque
,detalle_clase_productos.otra_descripcion)
VALUES(item, icapa,ivitola,inombre,imarca,icello,itipo,precio);

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.insertar_pendiente
DELIMITER //
CREATE PROCEDURE `insertar_pendiente`(
	IN `fecha` DATE
)
BEGIN


insert into pendiente(SELECT categoria.id_categoria AS categoria, pedidos.item AS item,0 AS orden_del_sitema,0 AS observacion,0 AS presentacion ,fecha AS mes ,orden_productos.id_orden AS orden, marca_productos.id_marca AS marca,vitola_productos.id_vitola AS vitola, 
nombre_productos.id_nombre AS nombre, capa_productos.id_capa AS capa,tipo_empaques.id_tipo_empaque AS tipo_empaque,
cellos.id_cello AS cello,(pedidos.cant_paquetes * pedidos.unidades)  as pendiente,0 as factura_del_mes, 0 AS cantidad_enviada_mes, 0 AS saldo
FROM categoria, clase_productos, pedidos, marca_productos, vitola_productos,nombre_productos, capa_productos, orden_productos,cellos,
tipo_empaques
WHERE clase_productos.id_vitola = vitola_productos.id_vitola AND pedidos.numero_orden = orden_productos.orden AND clase_productos.id_capa = capa_productos.id_capa AND 
 clase_productos.id_nombre = nombre_productos.id_nombre AND  clase_productos.id_marca = marca_productos.id_marca AND cellos.id_cello=clase_productos.id_cello and
   clase_productos.id_tipo_empaque = tipo_empaques.id_tipo_empaque AND pedidos.item = clase_productos.item AND categoria.id_categoria=pedidos.categoria
 GROUP BY pedidos.item, pedidos.numero_orden, pedidos.categoria);



DELETE FROM pedidos;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.mostrar_clase_paradetalle
DELIMITER //
CREATE PROCEDURE `mostrar_clase_paradetalle`(
	IN `item` VARCHAR(50)
)
BEGIN


 SELECT clase_productos.id_producto,clase_productos.item,marca_productos.marca, nombre_productos.nombre, vitola_productos.vitola,tipo_empaques.tipo_empaque
FROM clase_productos ,marca_productos,vitola_productos,tipo_empaques,nombre_productos
WHERE  clase_productos.id_vitola = vitola_productos.id_vitola AND 
 clase_productos.id_nombre = nombre_productos.id_nombre AND  clase_productos.id_marca = marca_productos.id_marca  AND  clase_productos.id_tipo_empaque = tipo_empaques.id_tipo_empaque
 AND clase_productos.item =item ;


END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.mostrar_detalles_productos
DELIMITER //
CREATE PROCEDURE `mostrar_detalles_productos`()
BEGIN


 SELECT detalle_clase_productos.id_producto,detalle_clase_productos.item,marca_productos.marca, nombre_productos.nombre, vitola_productos.vitola,tipo_empaques.tipo_empaque
FROM detalle_clase_productos ,marca_productos,vitola_productos,tipo_empaques,nombre_productos
WHERE  detalle_clase_productos.id_vitola = vitola_productos.id_vitola AND 
 detalle_clase_productos.id_nombre = nombre_productos.id_nombre AND  detalle_clase_productos.id_marca = marca_productos.id_marca  AND  detalle_clase_productos.id_tipo_empaque = tipo_empaques.id_tipo_empaque
;


END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.mostrar_pedido
DELIMITER //
CREATE PROCEDURE `mostrar_pedido`()
BEGIN


SELECT  pedidos.item, pedidos.cant_paquetes, CONCAT( tipo_empaques.tipo_empaque," ", marca_productos.marca," ",nombre_productos.nombre," ",
vitola_productos.vitola," ",capa_productos.capa) AS desccripcion ,pedidos.unidades,pedidos.numero_orden
 FROM pedidos, clase_productos, tipo_empaques,marca_productos,nombre_productos,vitola_productos,capa_productos
 WHERE pedidos.item=clase_productos.item AND clase_productos.id_vitola = vitola_productos.id_vitola AND 
 clase_productos.id_nombre = nombre_productos.id_nombre AND  clase_productos.id_marca = marca_productos.id_marca AND 
   clase_productos.id_tipo_empaque = tipo_empaques.id_tipo_empaque  GROUP BY pedidos.item , pedidos.numero_orden;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.mostrar_pendiente
DELIMITER //
CREATE PROCEDURE `mostrar_pendiente`()
BEGIN

SELECT categoria.categoria AS categoria, pendiente.item AS item,0 AS orden_del_sitema,0 AS observacion,0 AS presentacion ,pendiente.mes AS mes ,orden_productos.orden AS orden, marca_productos.marca AS marca,vitola_productos.vitola AS vitola, 
nombre_productos.nombre AS nombre, capa_productos.capa AS capa,
cellos.anillo AS anillo,cellos.cello AS cello, cellos.upc AS upc, pendiente.pendiente as pendiente,0 as factura_del_mes, 0 AS cantidad_enviada_mes, 0 AS saldo, tipo_empaques.tipo_empaque AS tipo_empaque
FROM categoria, clase_productos, marca_productos, vitola_productos,nombre_productos, capa_productos, orden_productos,cellos,
tipo_empaques, pendiente
WHERE clase_productos.id_vitola = vitola_productos.id_vitola AND clase_productos.id_capa = capa_productos.id_capa AND pendiente.capa = capa_productos.id_capa and
 clase_productos.id_nombre = nombre_productos.id_nombre AND  clase_productos.id_marca = marca_productos.id_marca AND cellos.id_cello=clase_productos.id_cello and
   clase_productos.id_tipo_empaque = tipo_empaques.id_tipo_empaque AND pendiente.categoria = categoria.id_categoria 
	GROUP BY pendiente.item, pendiente.orden, pendiente.categoria
	;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.mostrar_productos
DELIMITER //
CREATE PROCEDURE `mostrar_productos`()
BEGIN
 SELECT clase_productos.id_producto,clase_productos.item,marca_productos.marca, nombre_productos.nombre, vitola_productos.vitola,tipo_empaques.tipo_empaque
FROM clase_productos ,marca_productos,vitola_productos,tipo_empaques,nombre_productos
WHERE  clase_productos.id_vitola = vitola_productos.id_vitola AND 
 clase_productos.id_nombre = nombre_productos.id_nombre AND  clase_productos.id_marca = marca_productos.id_marca  AND  clase_productos.id_tipo_empaque = tipo_empaques.id_tipo_empaque ;


END//
DELIMITER ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
