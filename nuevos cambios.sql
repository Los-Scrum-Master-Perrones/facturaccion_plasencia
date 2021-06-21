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

-- Volcando estructura para procedimiento facturacion_plasencia.actualizar_pendientes
DELIMITER //
CREATE PROCEDURE `actualizar_pendientes`(
	IN `id` INT,
	IN `item` VARCHAR(50),
	IN `orden_sistema` VARCHAR(50),
	IN `observeacion` VARCHAR(50),
	IN `presentacion` VARCHAR(50),
	IN `pendient` VARCHAR(50),
	IN `saldo` VARCHAR(50),
	IN `seriep` VARCHAR(50),
	IN `precio` VARCHAR(50),
	IN `orden` VARCHAR(50)
)
BEGIN

UPDATE pendiente set pendiente.orden_del_sitema = orden_sistema,
pendiente.observacion = observeacion, pendiente.presentacion = presentacion,

 pendiente.pendiente = pendient,
 pendiente.serie_precio = seriep,
 pendiente.precio = precio,
 pendiente.saldo = saldo,
 pendiente.orden= orden
 WHERE pendiente.id_pendiente = id;


 UPDATE pendiente_empaque SET
 pendiente_empaque.orden_del_sitema = orden_sistema,
 pendiente_empaque.observacion = observeacion,
 pendiente_empaque.presentacion = presentacion,
 pendiente_empaque.pendiente = pendient,
 pendiente_empaque.orden = orden
 WHERE pendiente_empaque.id_pendiente_pedido = id ;


 UPDATE clase_productos SET clase_productos.presentacion = presentacion, clase_productos.codigo_precio =seriep,
 clase_productos.precio = precio
 WHERE clase_productos.item = item;

 end//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.actualizar_pendiente_empaque
DELIMITER //
CREATE PROCEDURE `actualizar_pendiente_empaque`(
	IN `id` INT,
	IN `observeacion` VARCHAR(50),
	IN `pendient` VARCHAR(50),
	IN `saldo` VARCHAR(50)
)
BEGIN
 UPDATE pendiente_empaque SET
 pendiente_empaque.observacion = observeacion,
 pendiente_empaque.pendiente = pendient,
 pendiente_empaque.saldo = saldo
 WHERE pendiente_empaque.id_pendiente_pedido = id ;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_pendiente
DELIMITER //
CREATE PROCEDURE `buscar_pendiente`(
	IN `pa_uno` VARCHAR(50),
	IN `pa_dos` VARCHAR(50),
	IN `pa_tres` VARCHAR(50),
	IN `pa_cuatro` VARCHAR(50)
)
BEGIN

if pa_uno != "" || pa_dos != "" || pa_tres  != "" || pa_cuatro != ""
 then



SELECT pendiente.id_pendiente ,
		 (SELECT categoria.categoria FROM  categoria WHERE categoria.id_categoria = pendiente.categoria	) AS categoria,
		 pendiente.item AS item,
		 pendiente.orden_del_sitema ,
		 pendiente.observacion,
		 (SELECT clase_productos.presentacion FROM clase_productos WHERE clase_productos.item = pendiente.item) AS presentacion,
		 pendiente.mes AS mes ,
		 pendiente.orden AS orden,
	(SELECT

		if( clase_productos.sampler = "si", CONCAT((SELECT clase_productos.descripcion_sampler FROM clase_productos WHERE clase_productos.item = pendiente.item)," ",(SELECT marca_productos.marca  FROM marca_productos WHERE marca_productos.id_marca = pendiente.marca)),
														(SELECT marca_productos.marca  FROM marca_productos WHERE marca_productos.id_marca = pendiente.marca)
						                     	) AS des FROM clase_productos WHERE clase_productos.item = pendiente.item) 	 AS marca,
		(SELECT vitola_productos.vitola FROM  vitola_productos WHERE vitola_productos.id_vitola = pendiente.vitola	) AS vitola,
		(SELECT nombre_productos.nombre FROM  nombre_productos WHERE nombre_productos.id_nombre = pendiente.nombre	) AS nombre,
		(SELECT capa_productos.capa FROM  capa_productos WHERE capa_productos.id_capa = pendiente.capa	) AS capa,
		(SELECT cellos.anillo AS anillo FROM cellos WHERE cellos.id_cello = pendiente.cello) AS anillo,
		(SELECT cellos.cello AS cello FROM cellos WHERE cellos.id_cello = pendiente.cello) AS cello,
		(SELECT cellos.upc AS upc FROM cellos WHERE cellos.id_cello = pendiente.cello) AS upc,
		 pendiente.pendiente as pendiente,
		 pendiente.saldo,
      (SELECT tipo_empaques.tipo_empaque FROM  tipo_empaques WHERE tipo_empaques.id_tipo_empaque = pendiente.tipo_empaque	) AS tipo_empaque,
		pendiente.paquetes AS paquetes,
		pendiente.unidades AS unidades,
	(select clase_productos.codigo_precio FROM clase_productos WHERE clase_productos.item = pendiente.item) AS serie_precio,
		(select clase_productos.precio FROM clase_productos WHERE clase_productos.item = pendiente.item) AS precio

FROM  pendiente
WHERE pendiente.categoria = pa_uno or
pendiente.categoria = pa_dos  or
pendiente.categoria = pa_tres or
pendiente.categoria = pa_cuatro

		ORDER BY pendiente.id_pendiente;


 else



SELECT pendiente.id_pendiente ,
		 (SELECT categoria.categoria FROM  categoria WHERE categoria.id_categoria = pendiente.categoria	) AS categoria,
		 pendiente.item AS item,
		 pendiente.orden_del_sitema ,
		 pendiente.observacion,
		 (SELECT clase_productos.presentacion FROM clase_productos WHERE  clase_productos.item = pendiente.item) AS presentacion,
		 pendiente.mes AS mes ,
		 pendiente.orden AS orden,
	(SELECT

		if( clase_productos.sampler = "si", CONCAT((SELECT clase_productos.descripcion_sampler FROM clase_productos WHERE clase_productos.item = pendiente.item)," ",(SELECT marca_productos.marca  FROM marca_productos WHERE marca_productos.id_marca = pendiente.marca)),
														(SELECT marca_productos.marca  FROM marca_productos WHERE marca_productos.id_marca = pendiente.marca)
						                     	) AS des FROM clase_productos WHERE clase_productos.item = pendiente.item) 	 AS marca,
		(SELECT vitola_productos.vitola FROM  vitola_productos WHERE vitola_productos.id_vitola = pendiente.vitola	) AS vitola,
		(SELECT nombre_productos.nombre FROM  nombre_productos WHERE nombre_productos.id_nombre = pendiente.nombre	) AS nombre,
		(SELECT capa_productos.capa FROM  capa_productos WHERE capa_productos.id_capa = pendiente.capa	) AS capa,
		(SELECT cellos.anillo AS anillo FROM cellos WHERE cellos.id_cello = pendiente.cello) AS anillo,
		(SELECT cellos.cello AS cello FROM cellos WHERE cellos.id_cello = pendiente.cello) AS cello,
		(SELECT cellos.upc AS upc FROM cellos WHERE cellos.id_cello = pendiente.cello) AS upc,
		 pendiente.pendiente as pendiente,
		 pendiente.saldo,
      (SELECT tipo_empaques.tipo_empaque FROM  tipo_empaques WHERE tipo_empaques.id_tipo_empaque = pendiente.tipo_empaque	) AS tipo_empaque,
		pendiente.paquetes AS paquetes,
		pendiente.unidades AS unidades,
		(select clase_productos.codigo_precio FROM clase_productos WHERE clase_productos.item = pendiente.item) AS serie_precio,
		(select clase_productos.precio FROM clase_productos WHERE clase_productos.item = pendiente.item) AS precio

FROM  pendiente
ORDER BY pendiente.id_pendiente;
END if;


END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.mostrar_detalle_factura
DELIMITER //
CREATE PROCEDURE `mostrar_detalle_factura`(
	IN `pa_tipo_factura` VARCHAR(10)
)
BEGIN
SELECT `id_detalle`,
	`id_venta`,
	`id_pendiente`,
	`cantidad_puros`,
	`unidad`,
	(CAST(((`cantidad_puros`*`unidad`)/cantidad_cajas) AS DECIMAL(9,0))) AS cantidad_cajas,
	`cantidad_puros`*`unidad` AS total_tabacos,

	(SELECT (UPPER((SELECT capa_productos.capa FROM capa_productos WHERE capa_productos.id_capa = clase_productos.id_capa))) AS capa
FROM clase_productos
WHERE clase_productos.item = (SELECT pendiente.item FROM pendiente
											WHERE pendiente.id_pendiente =  detalle_factura.id_pendiente)) AS capas,
	`cantidad_cajas` AS 'cantidad_por_caja'

	,(SELECT UPPER(CONCAT((SELECT tipo_empaques.tipo_empaque_ingles FROM tipo_empaques WHERE tipo_empaques.id_tipo_empaque = clase_productos.id_tipo_empaque)
		 ," ",
	    (SELECT vitola_productos.vitola FROM vitola_productos WHERE vitola_productos.id_vitola = clase_productos.id_vitola)
		 ," ",
		 (SELECT marca_productos.marca FROM marca_productos WHERE marca_productos.id_marca = clase_productos.id_marca)
		 ," ",
		 (SELECT nombre_productos.nombre FROM nombre_productos WHERE nombre_productos.id_nombre = clase_productos.id_nombre)
		 ," ",
		 (SELECT case cello
			 	when cello != "SI"  then  "CELLO"
			 	when cello != "NO"  then  ""
		 	END AS celloss
			FROM cellos
		   WHERE cellos.id_cello = clase_productos.id_cello)
		 )) AS producto
	FROM clase_productos
	WHERE clase_productos.item = (SELECT pendiente.item FROM pendiente
											WHERE pendiente.id_pendiente = detalle_factura.id_pendiente)
	) AS producto,

	(SELECT clase_productos.codigo_precio
		FROM clase_productos
		WHERE clase_productos.item = (SELECT pendiente.item FROM pendiente
													WHERE pendiente.id_pendiente = detalle_factura.id_pendiente)) AS codigo
	,

	(SELECT clase_productos.item
		FROM clase_productos
		WHERE clase_productos.item = (SELECT pendiente.item FROM pendiente
													WHERE pendiente.id_pendiente = detalle_factura.id_pendiente)) AS codigo_item
	,
	(SELECT concat(pendiente.orden ,"-",
	
        ( case SUBSTRING(pendiente.mes, 1, (LENGTH(pendiente.mes)-4))
			 	when "ENERO"  then  "01"
			 	when  "FEBRERO"  then  "02"
			 	when  "MARZO"  then  "03"
			 	when "ABRIL" then  "04"
			 	when "MAYO" then  "05"
			 	when  "JUNIO"  then  "06"
			 	when "JULIO" then  "07"
			 	when  "AGOSTO" then  "08"
			 	when "SEPTIEMBRE"then  "09"
			 	when "OCTUBRE" then  "10"
			 	when "NOVIEMBRE"  then  "11"
			 	when  "DICIEMBRE"  then  "12"
			 	
		 	END )
		 	 ,"-",(SUBSTRING(pendiente.mes,(LENGTH(pendiente.mes)-4) , 5 ))) FROM pendiente
			  
			  WHERE pendiente.id_pendiente = detalle_factura.id_pendiente  ) AS orden,

		(SELECT  pendiente.pendiente
	FROM pendiente WHERE pendiente.id_pendiente = detalle_factura.id_pendiente) AS orden_total,

		(SELECT pendiente.saldo - total_tabacos
	FROM pendiente WHERE pendiente.id_pendiente = detalle_factura.id_pendiente) AS orden_restante,

	`peso_bruto`*`cantidad_puros` AS total_bruto,
	`peso_neto`*`cantidad_puros`AS total_neto,
	(SELECT pendiente.precio FROM pendiente WHERE pendiente.id_pendiente = detalle_factura.id_pendiente ) AS precio_producto,

	((CAST((SELECT pendiente.precio FROM pendiente WHERE pendiente.id_pendiente = detalle_factura.id_pendiente )  AS DECIMAL(9,4)) * `cantidad_cajas`)/1000) AS costo,

	(((CAST((SELECT pendiente.precio FROM pendiente WHERE pendiente.id_pendiente = detalle_factura.id_pendiente )  AS DECIMAL(9,4)) * `cantidad_cajas`)/1000)*
	(CAST(((`cantidad_puros`*`unidad`)/cantidad_cajas) AS DECIMAL(9,0)))) AS valor_total


FROM detalle_factura
WHERE `facturado` = "N" AND (SELECT pendiente.orden AS oer
	FROM pendiente WHERE pendiente.id_pendiente = detalle_factura.id_pendiente) LIKE CONCAT("%",pa_tipo_factura,"%")

ORDER BY (SELECT CONCAT(pendiente.orden) AS oer
	FROM pendiente WHERE pendiente.id_pendiente = detalle_factura.id_pendiente)
;



END//
DELIMITER ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
