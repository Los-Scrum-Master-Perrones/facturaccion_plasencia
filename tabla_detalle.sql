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

-- Volcando estructura para procedimiento facturacion_plasencia.actualizar_pendiente_sampler
DELIMITER //
CREATE PROCEDURE `actualizar_pendiente_sampler`(
	IN `marca` INT,
	IN `nombre` INT,
	IN `vitola` INT,
	IN `capa` INT,
	IN `tipo_empaque` INT,
	IN `item` INT,
	IN `serie_precio` VARCHAR(50),
	IN `precio` VARCHAR(50)
)
BEGIN
 UPDATE pendiente SET
  pendiente.marca= marca,
  pendiente.nombre = nombre ,
  pendiente.capa = capa,
  pendiente.vitola = vitola,
  pendiente.tipo_empaque = tipo_empaque,
  pendiente.serie_precio = serie_precio,
  pendiente.precio = precio
 WHERE pendiente.id_pendiente = item;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.mostrar_detalle_factura
DELIMITER //
CREATE PROCEDURE `mostrar_detalle_factura`(
	IN `pa_para` VARCHAR(50)
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
		 	 ,"-",(SUBSTRING(pendiente.mes,(LENGTH(pendiente.mes)-3) , 4 ))) FROM pendiente
			  
			  WHERE pendiente.id_pendiente = detalle_factura.id_pendiente  ) AS orden,

		(SELECT  pendiente.pendiente
	FROM pendiente WHERE pendiente.id_pendiente = detalle_factura.id_pendiente) AS orden_total,

		(SELECT pendiente.saldo - total_tabacos
	FROM pendiente WHERE pendiente.id_pendiente = detalle_factura.id_pendiente) AS orden_restante,

	`peso_bruto`*`cantidad_puros` AS total_bruto,
	`peso_neto`*`cantidad_puros`AS total_neto,
	(SELECT clase_productos.precio FROM clase_productos WHERE clase_productos.item = 

(SELECT pendiente.item FROM pendiente WHERE pendiente.id_pendiente = detalle_factura.id_pendiente)) AS precio_producto,

	((CAST((SELECT clase_productos.precio FROM clase_productos WHERE clase_productos.item = 

(SELECT pendiente.item FROM pendiente WHERE pendiente.id_pendiente = detalle_factura.id_pendiente) )  AS DECIMAL(9,4)) * `cantidad_cajas`)/1000) AS costo,

	(((CAST((SELECT clase_productos.precio FROM clase_productos WHERE clase_productos.item = 

(SELECT pendiente.item FROM pendiente WHERE pendiente.id_pendiente = detalle_factura.id_pendiente))  AS DECIMAL(9,4)) * `cantidad_cajas`)/1000)*
	(CAST(((`cantidad_puros`*`unidad`)/cantidad_cajas) AS DECIMAL(9,0)))) AS valor_total


FROM detalle_factura
WHERE `facturado` = "N" AND detalle_factura.para = pa_para

ORDER BY (SELECT pendiente.orden
	 FROM pendiente
			  
			  WHERE pendiente.id_pendiente = detalle_factura.id_pendiente  )  AND  (select ( case SUBSTRING(pendiente.mes, 1, (LENGTH(pendiente.mes)-4))
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
			 	
		 	END )FROM pendiente WHERE pendiente.id_pendiente = detalle_factura.id_pendiente  ) DESC
; 



END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.mostrar_detalle_factura_export
DELIMITER //
CREATE PROCEDURE `mostrar_detalle_factura_export`(
	IN `fac` VARCHAR(50)
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
	(SELECT clase_productos.precio FROM clase_productos WHERE clase_productos.item = 

(SELECT pendiente.item FROM pendiente WHERE pendiente.id_pendiente = detalle_factura.id_pendiente)) AS precio_producto,

	((CAST((SELECT clase_productos.precio FROM clase_productos WHERE clase_productos.item = 

(SELECT pendiente.item FROM pendiente WHERE pendiente.id_pendiente = detalle_factura.id_pendiente) )  AS DECIMAL(9,4)) * `cantidad_cajas`)/1000) AS costo,

	(((CAST((SELECT clase_productos.precio FROM clase_productos WHERE clase_productos.item = 

(SELECT pendiente.item FROM pendiente WHERE pendiente.id_pendiente = detalle_factura.id_pendiente))  AS DECIMAL(9,4)) * `cantidad_cajas`)/1000)*
	(CAST(((`cantidad_puros`*`unidad`)/cantidad_cajas) AS DECIMAL(9,0)))) AS valor_total,
	detalle_factura.anterior


FROM detalle_factura,factura_terminados
WHERE detalle_factura.id_venta = factura_terminados.id AND factura_terminados.numero_factura = fac

ORDER BY (SELECT pendiente.orden
	 FROM pendiente
			  
			  WHERE pendiente.id_pendiente = detalle_factura.id_pendiente  )  AND  (select ( case SUBSTRING(pendiente.mes, 1, (LENGTH(pendiente.mes)-4))
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
			 	
		 	END )FROM pendiente WHERE pendiente.id_pendiente = detalle_factura.id_pendiente  ) DESC
; 




END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.traer_detalles_productos_actualizar
DELIMITER //
CREATE PROCEDURE `traer_detalles_productos_actualizar`(
	IN `pa_item` VARCHAR(50),
	IN `pa_limite` MEDIUMINT
)
BEGIN
    SELECT  detalle_clase_productos.id_marca AS marca,
			   detalle_clase_productos.id_vitola	 AS vitola,
					detalle_clase_productos.id_nombre	 AS nombre,
					detalle_clase_productos.id_capa	 AS capa,
					detalle_clase_productos.id_tipo_empaque	 AS tipo_empaque,
					detalle_clase_productos.item,
					detalle_clase_productos.otra_descripcion,
					detalle_clase_productos.precio
	 FROM detalle_clase_productos
	 WHERE detalle_clase_productos.item = pa_item
	 ORDER BY id_producto
	 LIMIT pa_limite,1;




END//
DELIMITER ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
