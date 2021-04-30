-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.31 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for facturacion_plasencia
CREATE DATABASE IF NOT EXISTS `facturacion_plasencia` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `facturacion_plasencia`;

-- Dumping structure for table facturacion_plasencia.anadir_inventario_cajas
CREATE TABLE IF NOT EXISTS `anadir_inventario_cajas` (
  `id_cajas` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) DEFAULT NULL,
  `descripcion` longtext,
  `lote_origen` longtext,
  `lote_destino` longtext,
  `cantidad` longtext,
  `costo_u` longtext,
  `subtotal` longtext,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_cajas`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- Data exporting was unselected.

-- Dumping structure for table facturacion_plasencia.cajas
CREATE TABLE IF NOT EXISTS `cajas` (
  `id_cajas` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) DEFAULT NULL,
  `descripcion` longtext,
  `lote_origen` longtext,
  `lote_destino` longtext,
  `cantidad` longtext,
  `costo_u` longtext,
  `subtotal` longtext,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_cajas`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table facturacion_plasencia.capa_productos
CREATE TABLE IF NOT EXISTS `capa_productos` (
  `id_capa` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `capa` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_capa`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table facturacion_plasencia.categoria
CREATE TABLE IF NOT EXISTS `categoria` (
  `id_categoria` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `categoria` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table facturacion_plasencia.cellos
CREATE TABLE IF NOT EXISTS `cellos` (
  `id_cello` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `cello` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `anillo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_cello`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table facturacion_plasencia.clase_productos
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

-- Data exporting was unselected.

-- Dumping structure for table facturacion_plasencia.detalle_clase_productos
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

-- Data exporting was unselected.

-- Dumping structure for table facturacion_plasencia.lista_cajas
CREATE TABLE IF NOT EXISTS `lista_cajas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `codigo` varchar(50) DEFAULT NULL,
  `productoServicio` varchar(255) DEFAULT NULL,
  `marca` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=1046 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table facturacion_plasencia.marca_productos
CREATE TABLE IF NOT EXISTS `marca_productos` (
  `id_marca` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `marca` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_marca`)
) ENGINE=MyISAM AUTO_INCREMENT=237 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table facturacion_plasencia.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=240 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table facturacion_plasencia.nombre_productos
CREATE TABLE IF NOT EXISTS `nombre_productos` (
  `id_nombre` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_nombre`)
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table facturacion_plasencia.orden_productos
CREATE TABLE IF NOT EXISTS `orden_productos` (
  `id_orden` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `orden` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_orden`)
) ENGINE=MyISAM AUTO_INCREMENT=252 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table facturacion_plasencia.password_resets
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table facturacion_plasencia.pedidos
CREATE TABLE IF NOT EXISTS `pedidos` (
  `item` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cant_paquetes` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `unidades` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `numero_orden` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoria` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table facturacion_plasencia.pendiente
CREATE TABLE IF NOT EXISTS `pendiente` (
  `categoria` int(11) DEFAULT NULL,
  `item` varchar(50) DEFAULT NULL,
  `orden_del_sitema` int(11) DEFAULT NULL,
  `observacion` int(11) DEFAULT NULL,
  `presentacion` int(11) DEFAULT NULL,
  `mes` int(11) DEFAULT NULL,
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

-- Data exporting was unselected.

-- Dumping structure for table facturacion_plasencia.sample_datas
CREATE TABLE IF NOT EXISTS `sample_datas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table facturacion_plasencia.tbl_customer
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

-- Data exporting was unselected.

-- Dumping structure for table facturacion_plasencia.tipo_empaques
CREATE TABLE IF NOT EXISTS `tipo_empaques` (
  `id_tipo_empaque` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tipo_empaque` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_tipo_empaque`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for table facturacion_plasencia.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL DEFAULT '0',
  `email_verified_at` varchar(50) NOT NULL DEFAULT '0',
  `password` varchar(300) NOT NULL DEFAULT '0',
  `remember_token` varchar(300) NOT NULL DEFAULT '0',
  `codigo` int(11) NOT NULL DEFAULT '0',
  `rol` int(11) NOT NULL DEFAULT '0',
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `codigo` (`codigo`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Data exporting was unselected.

-- Dumping structure for table facturacion_plasencia.vehicles
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

-- Data exporting was unselected.

-- Dumping structure for table facturacion_plasencia.vitola_productos
CREATE TABLE IF NOT EXISTS `vitola_productos` (
  `id_vitola` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `vitola` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_vitola`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Data exporting was unselected.

-- Dumping structure for procedure facturacion_plasencia.actualizar_contrasenia
DELIMITER //
CREATE PROCEDURE `actualizar_contrasenia`(
	IN `pa_id` INT,
	IN `pa_email` VARCHAR(50),
	IN `pa_password` VARCHAR(200)
)
BEGIN
             UPDATE users 
                SET 
                      users.email = pa_email, 
                      users.password = pa_password
               
        
                WHERE users.id = pa_id;
END//
DELIMITER ;

-- Dumping structure for procedure facturacion_plasencia.actualizar_usuarios
DELIMITER //
CREATE PROCEDURE `actualizar_usuarios`(
	IN `pa_id` INT,
	IN `pa_codigo` INT,
	IN `pa_nombre` VARCHAR(50),
	IN `pa_rol` INT
)
BEGIN
             UPDATE users 
                SET 
                      users.name = pa_nombre, 
                      users.codigo = pa_codigo,
                      users.rol =pa_rol
                      
        
                WHERE users.id = pa_id;
END//
DELIMITER ;

-- Dumping structure for procedure facturacion_plasencia.agregar_lista_caja
DELIMITER //
CREATE PROCEDURE `agregar_lista_caja`(
	IN `pa_codigo` VARCHAR(50),
	IN `pa_producto` VARCHAR(255),
	IN `pa_marca` VARCHAR(50)
)
BEGIN
INSERT INTO lista_cajas (lista_cajas.codigo,lista_cajas.productoServicio,lista_cajas.marca) VALUES (pa_codigo,pa_producto,pa_marca);
END//
DELIMITER ;

-- Dumping structure for procedure facturacion_plasencia.buscar_lista_cajas
DELIMITER //
CREATE PROCEDURE `buscar_lista_cajas`(
	IN `pa_nombre` VARCHAR(50)
)
BEGIN
SELECT lista_cajas.codigo,lista_cajas.productoServicio,lista_cajas.marca
FROM lista_cajas
WHERE lista_cajas.codigo LIKE CONCAT("%",pa_nombre,"%") OR
lista_cajas.productoServicio LIKE CONCAT("%",pa_nombre,"%") OR
lista_cajas.marca LIKE CONCAT("%",pa_nombre,"%") ;
END//
DELIMITER ;

-- Dumping structure for procedure facturacion_plasencia.eliminar_usuario
DELIMITER //
CREATE PROCEDURE `eliminar_usuario`(
	IN `pa_id_usuario` INT
)
BEGIN
        
        DELETE FROM users 
        WHERE users.id = pa_id_usuario;
                
        END//
DELIMITER ;

-- Dumping structure for procedure facturacion_plasencia.insertar_clase_producto
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

-- Dumping structure for procedure facturacion_plasencia.insertar_detalle_clase_producto
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

-- Dumping structure for procedure facturacion_plasencia.insertar_pendiente
DELIMITER //
CREATE PROCEDURE `insertar_pendiente`()
BEGIN


insert into pendiente(SELECT categoria.id_categoria AS categoria, pedidos.item AS item,0 AS orden_del_sitema,0 AS observacion,0 AS presentacion ,0 AS mes ,orden_productos.id_orden AS orden, marca_productos.id_marca AS marca,vitola_productos.id_vitola AS vitola, 
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

-- Dumping structure for procedure facturacion_plasencia.mostrar_clase_paradetalle
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

-- Dumping structure for procedure facturacion_plasencia.mostrar_detalles_productos
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

-- Dumping structure for procedure facturacion_plasencia.mostrar_pedido
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

-- Dumping structure for procedure facturacion_plasencia.mostrar_pendiente
DELIMITER //
CREATE PROCEDURE `mostrar_pendiente`()
BEGIN

SELECT categoria.categoria AS categoria, pendiente.item AS item,0 AS orden_del_sitema,0 AS observacion,0 AS presentacion ,0 AS mes ,orden_productos.orden AS orden, marca_productos.marca AS marca,vitola_productos.vitola AS vitola, 
nombre_productos.nombre AS nombre, capa_productos.capa AS capa,
cellos.anillo AS anillo,cellos.cello AS cello, cellos.upc AS upc, pendiente.pendiente as pendiente,0 as factura_del_mes, 0 AS cantidad_enviada_mes, 0 AS saldo, tipo_empaques.tipo_empaque AS tipo_empaque
FROM categoria, clase_productos, marca_productos, vitola_productos,nombre_productos, capa_productos, orden_productos,cellos,
tipo_empaques, pendiente
WHERE clase_productos.id_vitola = vitola_productos.id_vitola AND clase_productos.id_capa = capa_productos.id_capa AND pendiente.capa = capa_productos.id_capa and
 clase_productos.id_nombre = nombre_productos.id_nombre AND  clase_productos.id_marca = marca_productos.id_marca AND cellos.id_cello=clase_productos.id_cello and
   clase_productos.id_tipo_empaque = tipo_empaques.id_tipo_empaque
	GROUP BY pendiente.item, pendiente.orden, pendiente.categoria
	;

END//
DELIMITER ;

-- Dumping structure for procedure facturacion_plasencia.mostrar_productos
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
