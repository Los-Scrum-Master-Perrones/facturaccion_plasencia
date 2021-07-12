-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.5.8-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Volcando estructura de base de datos para facturacion_plasencia
CREATE DATABASE IF NOT EXISTS `facturacion_plasencia` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `facturacion_plasencia`;

-- Volcando estructura para procedimiento facturacion_plasencia.reporte_facura_pendiente
DELIMITER //
CREATE PROCEDURE `reporte_facura_pendiente`(
	IN `fecha` DATE,
	IN `marca` VARCHAR(500),
	IN `nombre` VARCHAR(50),
	IN `capa` VARCHAR(50),
	IN `vitola` VARCHAR(50),
	IN `factura` VARCHAR(50),
	IN `tipo_empaque` VARCHAR(50),
	IN `orden` VARCHAR(50)
)
BEGIN
 SELECT

	(SELECT clase_productos.item
		FROM clase_productos
		WHERE clase_productos.item = (SELECT pendiente.item FROM pendiente
													WHERE pendiente.id_pendiente = detalle_factura.id_pendiente)) AS codigo_item
	,
	(SELECT

		if( clase_productos.sampler = "si", CONCAT((SELECT clase_productos.descripcion_sampler FROM clase_productos WHERE clase_productos.item = (SELECT pendiente.item FROM pendiente
											WHERE pendiente.id_pendiente =  detalle_factura.id_pendiente))," ",(SELECT marca_productos.marca  FROM marca_productos WHERE marca_productos.id_marca = (SELECT pendiente.marca FROM pendiente
											WHERE pendiente.id_pendiente =  detalle_factura.id_pendiente))),
														(SELECT marca_productos.marca  FROM marca_productos WHERE marca_productos.id_marca = (SELECT pendiente.marca FROM pendiente
											WHERE pendiente.id_pendiente =  detalle_factura.id_pendiente))
						                     	) AS des FROM clase_productos WHERE clase_productos.item = (SELECT pendiente.item FROM pendiente
											WHERE pendiente.id_pendiente =  detalle_factura.id_pendiente)) 	 AS marca,


			(SELECT nombre_productos.nombre FROM  nombre_productos WHERE nombre_productos.id_nombre = (SELECT pendiente.nombre FROM pendiente
											WHERE pendiente.id_pendiente =  detalle_factura.id_pendiente)	) AS nombre,

(SELECT vitola_productos.vitola FROM  vitola_productos WHERE vitola_productos.id_vitola = (SELECT pendiente.vitola FROM pendiente
											WHERE pendiente.id_pendiente =  detalle_factura.id_pendiente)	) AS vitola,



	(SELECT capa_productos.capa FROM  capa_productos WHERE capa_productos.id_capa = (SELECT pendiente.capa FROM pendiente
											WHERE pendiente.id_pendiente =  detalle_factura.id_pendiente)	) AS capas,

	      (SELECT tipo_empaques.tipo_empaque FROM  tipo_empaques WHERE tipo_empaques.id_tipo_empaque = (SELECT pendiente.tipo_empaque FROM pendiente
											WHERE pendiente.id_pendiente =  detalle_factura.id_pendiente)	) AS tipo_empaque,



	(SELECT UPPER(CONCAT((SELECT tipo_empaques.tipo_empaque_ingles FROM tipo_empaques WHERE tipo_empaques.id_tipo_empaque = clase_productos.id_tipo_empaque)
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

	(CAST(((`cantidad_puros`*`unidad`)/cantidad_cajas) AS DECIMAL(9,0)))  AS cantidad_cajas,


(if( (select sampler FROM clase_productos
	WHERE clase_productos.item = (SELECT pendiente.item FROM pendiente
											WHERE pendiente.id_pendiente = detalle_factura.id_pendiente))='si',CAST((`cantidad_puros`*`unidad`)/(SELECT COUNT(*) FROM  detalle_clase_productos WHERE detalle_clase_productos.item = 	(SELECT clase_productos.item
		FROM clase_productos
		WHERE clase_productos.item = (SELECT pendiente.item FROM pendiente
													WHERE pendiente.id_pendiente = detalle_factura.id_pendiente))) AS INT),(`cantidad_puros`*`unidad`)))

	 AS total_tabacos,

	(SELECT CONCAT(pendiente.orden) AS oer
	FROM pendiente WHERE pendiente.id_pendiente = detalle_factura.id_pendiente) AS orden,

	(SELECT factura_terminados.numero_factura FROM factura_terminados  WHERE factura_terminados.id = detalle_factura.id_venta) AS num_factura,

	(SELECT factura_terminados.contenedor FROM factura_terminados WHERE factura_terminados.id = detalle_factura.id_venta) AS contenedor,

		(SELECT factura_terminados.fecha_factura FROM factura_terminados WHERE factura_terminados.id = detalle_factura.id_venta) AS fecha

FROM detalle_factura
WHERE `facturado` = "S" AND (
	year((SELECT factura_terminados.fecha_factura FROM factura_terminados WHERE factura_terminados.id = detalle_factura.id_venta)) = year(fecha) AND
	month((SELECT factura_terminados.fecha_factura FROM factura_terminados WHERE factura_terminados.id = detalle_factura.id_venta)) = month(fecha) AND
	((SELECT (UPPER(((SELECT marca_productos.marca FROM marca_productos WHERE marca_productos.id_marca = clase_productos.id_marca)
		 ))) AS capa
FROM clase_productos
WHERE clase_productos.item = (SELECT pendiente.item FROM pendiente
											WHERE pendiente.id_pendiente =  detalle_factura.id_pendiente))) LIKE (CONCAT("%",marca,"%")) AND

										((SELECT CONCAT(pendiente.orden) AS oer
	FROM pendiente WHERE pendiente.id_pendiente = detalle_factura.id_pendiente) LIKE (CONCAT("%",orden,"%")))


							AND

	((SELECT (UPPER((SELECT tipo_empaques.tipo_empaque FROM tipo_empaques WHERE tipo_empaques.id_tipo_empaque = clase_productos.id_tipo_empaque))) AS capa
FROM clase_productos
WHERE clase_productos.item = (SELECT pendiente.item FROM pendiente
											WHERE pendiente.id_pendiente =  detalle_factura.id_pendiente))) LIKE (CONCAT("%",tipo_empaque,"%"))

							AND

	((SELECT (UPPER((SELECT nombre_productos.nombre FROM nombre_productos WHERE nombre_productos.id_nombre = clase_productos.id_nombre))) AS capa
FROM clase_productos
WHERE clase_productos.item = (SELECT pendiente.item FROM pendiente
											WHERE pendiente.id_pendiente =  detalle_factura.id_pendiente))) LIKE (CONCAT("%",nombre,"%")) AND


(SELECT capa_productos.capa FROM  capa_productos WHERE capa_productos.id_capa = (SELECT pendiente.capa FROM pendiente
											WHERE pendiente.id_pendiente =  detalle_factura.id_pendiente)	)  LIKE (CONCAT("%",capa,"%")) and

		((SELECT (UPPER((SELECT vitola_productos.vitola FROM vitola_productos WHERE vitola_productos.id_vitola = clase_productos.id_vitola))) AS capa
FROM clase_productos
WHERE clase_productos.item = (SELECT pendiente.item FROM pendiente
											WHERE pendiente.id_pendiente =  detalle_factura.id_pendiente))) LIKE (CONCAT("%",vitola,"%")) and

		((SELECT factura_terminados.numero_factura FROM factura_terminados  WHERE factura_terminados.id = detalle_factura.id_venta) LIKE (CONCAT("%",factura,"%")) OR

	(SELECT factura_terminados.contenedor FROM factura_terminados WHERE factura_terminados.id = detalle_factura.id_venta) LIKE (CONCAT("%",factura,"%")) OR (SELECT clase_productos.item
		FROM clase_productos
		WHERE clase_productos.item = (SELECT pendiente.item FROM pendiente
													WHERE pendiente.id_pendiente = detalle_factura.id_pendiente)) LIKE (CONCAT("%",factura,"%")) ))

ORDER BY (SELECT concat(pendiente.orden ,"-",

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

			  WHERE pendiente.id_pendiente = detalle_factura.id_pendiente  ),(SELECT clase_productos.item
		FROM clase_productos
		WHERE clase_productos.item = (SELECT pendiente.item FROM pendiente
													WHERE pendiente.id_pendiente = detalle_factura.id_pendiente)),id_detalle   ASC;

 end//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.traer_detalles_historial_factura
DELIMITER //
CREATE PROCEDURE `traer_detalles_historial_factura`(
	IN `pa_id_factura` INT
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

		detalle_factura.anterior AS orden_restante,

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
WHERE detalle_factura.id_venta = pa_id_factura

ORDER BY (SELECT concat(pendiente.orden ,"-",

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

			  WHERE pendiente.id_pendiente = detalle_factura.id_pendiente  ),(SELECT clase_productos.item
		FROM clase_productos
		WHERE clase_productos.item = (SELECT pendiente.item FROM pendiente
													WHERE pendiente.id_pendiente = detalle_factura.id_pendiente)),id_detalle   asc;

END//
DELIMITER ;

