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

-- Volcando estructura para procedimiento facturacion_plasencia.actualizar_productos
DELIMITER //
CREATE PROCEDURE `actualizar_productos`(
	IN `id` INT,
	IN `item` VARCHAR(50),
	IN `cod_producto` VARCHAR(50),
	IN `cod_caja` VARCHAR(50),
	IN `cod_precio` VARCHAR(50),
	IN `pa_precio` VARCHAR(50),
	IN `capa` VARCHAR(50),
	IN `vitola` VARCHAR(50),
	IN `nombre` VARCHAR(50),
	IN `marca` VARCHAR(50),
	IN `cello` VARCHAR(50),
	IN `anillo` VARCHAR(50),
	IN `upc` VARCHAR(50),
	IN `tipo_empaque` VARCHAR(50),
	IN `presentacion` VARCHAR(50),
	IN `sampler` VARCHAR(50),
	IN `descripcion` VARCHAR(100)
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

UPDATE clase_productos SET clase_productos.item = item,clase_productos.codigo_producto = cod_producto,
clase_productos.codigo_caja=cod_caja,clase_productos.codigo_precio = cod_precio,
clase_productos.precio = pa_precio,
clase_productos.id_capa = icapa,clase_productos.id_vitola = ivitola,
 clase_productos.id_nombre = inombre,clase_productos.id_marca = imarca,
 clase_productos.id_cello = icello,
clase_productos.id_tipo_empaque = itipo, clase_productos.presentacion = presentacion,
clase_productos.sampler = sampler,
clase_productos.descripcion_sampler= descripcion
WHERE clase_productos.id_producto = id;

UPDATE pendiente SET 

pendiente.serie_precio = cod_precio,
pendiente.precio = pa_precio,
pendiente.capa = icapa,
pendiente.vitola = ivitola,
 pendiente.nombre = inombre,
 pendiente.marca = imarca,
 pendiente.cello = icello,
pendiente.tipo_empaque = itipo, 
pendiente.presentacion = presentacion

WHERE pendiente.item = item;


UPDATE pendiente_empaque SET 

pendiente_empaque.capa = icapa,
pendiente_empaque.vitola = ivitola,
 pendiente_empaque.nombre = inombre,
 pendiente_empaque.marca = imarca,
 pendiente_empaque.cello = icello,
pendiente_empaque.tipo_empaque = itipo, 
pendiente_empaque.presentacion = presentacion

WHERE pendiente_empaque.item = item;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.mostrar_detalles_exportar
DELIMITER //
CREATE PROCEDURE `mostrar_detalles_exportar`(
	IN `busqueda` VARCHAR(50),
	IN `id` INT
)
BEGIN


SELECT  detalle_programacion.numero_orden,
		  detalle_programacion.orden,
			(select marca_productos.marca FROM marca_productos WHERE (select pendiente_empaque.marca FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion.id_pendiente) = marca_productos.id_marca) AS marca,

				(select vitola_productos.vitola FROM vitola_productos WHERE (select pendiente_empaque.vitola FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion.id_pendiente) = vitola_productos.id_vitola) AS vitola,

		(select nombre_productos.nombre FROM nombre_productos WHERE (select pendiente_empaque.nombre FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion.id_pendiente) = nombre_productos.id_nombre) AS nombre,

			(select capa_productos.capa FROM capa_productos WHERE (select pendiente_empaque.capa FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion.id_pendiente) = capa_productos.id_capa) AS capa,

 			(select tipo_empaques.tipo_empaque FROM tipo_empaques WHERE (select pendiente_empaque.tipo_empaque FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion.id_pendiente) = tipo_empaques.id_tipo_empaque) AS tipo_empaque,

 				(select cellos.anillo FROM cellos WHERE (select pendiente_empaque.cello FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion.id_pendiente) = cellos.id_cello) AS anillo,

 			(select cellos.cello FROM cellos WHERE (select pendiente_empaque.cello FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion.id_pendiente) = cellos.id_cello) AS cello,

		(select cellos.upc FROM cellos WHERE (select pendiente_empaque.cello FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion.id_pendiente) = cellos.id_cello) AS upc,

			detalle_programacion.saldo

 FROM  detalle_programacion
WHERE detalle_programacion.id_programacion = id;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.mostrar_detalles_programacion
DELIMITER //
CREATE PROCEDURE `mostrar_detalles_programacion`(
	IN `busqueda` VARCHAR(50),
	IN `id` INT
)
BEGIN


SELECT  detalle_programacion.id_detalle_programacion ,
        detalle_programacion.numero_orden,
		  detalle_programacion.cod_producto,
		  detalle_programacion.orden,
			(select marca_productos.marca FROM marca_productos WHERE (select pendiente_empaque.marca FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion.id_pendiente) = marca_productos.id_marca) AS marca,

				(select vitola_productos.vitola FROM vitola_productos WHERE (select pendiente_empaque.vitola FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion.id_pendiente) = vitola_productos.id_vitola) AS vitola,

		(select nombre_productos.nombre FROM nombre_productos WHERE (select pendiente_empaque.nombre FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion.id_pendiente) = nombre_productos.id_nombre) AS nombre,

			(select capa_productos.capa FROM capa_productos WHERE (select pendiente_empaque.capa FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion.id_pendiente) = capa_productos.id_capa) AS capa,

 			(select tipo_empaques.tipo_empaque FROM tipo_empaques WHERE (select pendiente_empaque.tipo_empaque FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion.id_pendiente) = tipo_empaques.id_tipo_empaque) AS tipo_empaque,

 				(select cellos.anillo FROM cellos WHERE (select pendiente_empaque.cello FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion.id_pendiente) = cellos.id_cello) AS anillo,

 			(select cellos.cello FROM cellos WHERE (select pendiente_empaque.cello FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion.id_pendiente) = cellos.id_cello) AS cello,

		(select cellos.upc FROM cellos WHERE (select pendiente_empaque.cello FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion.id_pendiente) = cellos.id_cello) AS upc,

			detalle_programacion.saldo,
			detalle_programacion.id_pendiente,

				(SELECT 	if (detalle_programacion.cant_cajas < 0,
		   CONCAT("Faltan ",detalle_programacion.cant_cajas, " cajas") ,

		 CONCAT("Sobran ",detalle_programacion.cant_cajas, " cajas") )) AS cajas,


			detalle_programacion.cant_cajas,

				 (SELECT detalle_programacion.saldo/


		 (

		 SELECT SUBSTRING((select tipo_empaques.tipo_empaque FROM tipo_empaques
		 WHERE tipo_empaques.id_tipo_empaque = (select pendiente_empaque.tipo_empaque FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion.id_pendiente) AND tipo_empaques.tipo_empaque LIKE CONCAT("%","CAJAS","%")


			 ) , 9, 3))) AS cant_cajas_necesarias

 FROM  detalle_programacion
WHERE detalle_programacion.id_programacion = id AND (
		detalle_programacion.numero_orden LIKE CONCAT("%",busqueda,"%") or 
		detalle_programacion.orden LIKE CONCAT("%",busqueda,"%") or 
		(select marca_productos.marca FROM marca_productos WHERE (select pendiente_empaque.marca FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion.id_pendiente) = marca_productos.id_marca)  LIKE CONCAT("%",busqueda,"%") or 

				(select vitola_productos.vitola FROM vitola_productos WHERE (select pendiente_empaque.vitola FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion.id_pendiente) = vitola_productos.id_vitola)  LIKE CONCAT("%",busqueda,"%") or 

		(select nombre_productos.nombre FROM nombre_productos WHERE (select pendiente_empaque.nombre FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion.id_pendiente) = nombre_productos.id_nombre)  LIKE CONCAT("%",busqueda,"%") or 

			(select capa_productos.capa FROM capa_productos WHERE (select pendiente_empaque.capa FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion.id_pendiente) = capa_productos.id_capa)  LIKE CONCAT("%",busqueda,"%")  )

GROUP BY 1;


END//
DELIMITER ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
