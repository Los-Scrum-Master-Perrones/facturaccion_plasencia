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

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_pendiente
DELIMITER //
CREATE PROCEDURE `buscar_pendiente`(
	IN `pa_uno` VARCHAR(50),
	IN `pa_dos` VARCHAR(50),
	IN `pa_tres` VARCHAR(50),
	IN `pa_cuatro` VARCHAR(50),
	IN `pa_cinco` VARCHAR(50),
	IN `pa_seis` VARCHAR(100),
	IN `pa_siete` VARCHAR(100)
)
BEGIN

if (pa_uno != '' || pa_dos != '' || pa_tres != '' || pa_cuatro != '' || pa_cinco != '' || pa_cinco != '' ||  pa_seis != '' ||  pa_siete != '') then 

		SELECT Y.*
					FROM (SELECT X.*
					
							FROM (SELECT pendiente.id_pendiente ,
										pendiente.categoria AS id_categoria,
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
							       (SELECT
							
									if( clase_productos.sampler = "si", pendiente.serie_precio , (select clase_productos.codigo_precio FROM clase_productos WHERE clase_productos.item = pendiente.item) ) AS des FROM clase_productos WHERE clase_productos.item = pendiente.item)
									 AS serie_precio,
							         (SELECT
							
									if( clase_productos.sampler = "si", pendiente.precio ,(select clase_productos.precio FROM clase_productos WHERE clase_productos.item = pendiente.item) ) AS des FROM clase_productos WHERE clase_productos.item = pendiente.item)
							
									AS precio,
							
									(SELECT
										if( clase_productos.sampler = "si", ((pendiente.precio*pendiente.saldo)/1000) ,((select clase_productos.precio FROM clase_productos WHERE clase_productos.item = pendiente.item)*pendiente.saldo)/1000   ) AS des FROM clase_productos WHERE clase_productos.item = pendiente.item)
							
									AS precio_dolares
							
							 
							FROM  pendiente
							WHERE (pendiente.saldo > 0 or (SELECT SUM(saldo) FROM pendiente p WHERE p.orden = pendiente.orden AND
																	p.mes = pendiente.mes AND p.item = pendiente.item) > 0)
							
							ORDER BY pendiente.id_pendiente)x
							
							
						WHERE  (SELECT clase_productos.presentacion FROM clase_productos WHERE clase_productos.item = x.item) = pa_cinco
						
									OR 
									
									(SELECT clase_productos.presentacion FROM clase_productos WHERE clase_productos.item = x.item) = pa_seis
									
									OR 
									
									(SELECT clase_productos.presentacion FROM clase_productos WHERE clase_productos.item = x.item) = pa_siete
								
									
								OR ( pa_cinco = '' AND  pa_seis = '' AND  pa_siete = '') 
						)y
						
			 WHERE 
			 		
			 	(Y.id_categoria = pa_uno
									OR 
				Y.id_categoria = pa_dos
									OR 
				Y.id_categoria = pa_tres
									OR 
				Y.id_categoria = pa_cuatro)
				
					OR ( pa_uno = '' AND  pa_dos = '' AND  pa_tres = ''  AND  pa_cuatro = '') 
										 
			;
			
		
		
				
				

ELSE 


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
	       (SELECT
	
			if( clase_productos.sampler = "si", pendiente.serie_precio , (select clase_productos.codigo_precio FROM clase_productos WHERE clase_productos.item = pendiente.item) ) AS des FROM clase_productos WHERE clase_productos.item = pendiente.item)
			 AS serie_precio,
	         (SELECT
	
			if( clase_productos.sampler = "si", pendiente.precio ,(select clase_productos.precio FROM clase_productos WHERE clase_productos.item = pendiente.item) ) AS des FROM clase_productos WHERE clase_productos.item = pendiente.item)
	
			AS precio,
	
			(SELECT
				if( clase_productos.sampler = "si", ((pendiente.precio*pendiente.saldo)/1000) ,((select clase_productos.precio FROM clase_productos WHERE clase_productos.item = pendiente.item)*pendiente.saldo)/1000   ) AS des FROM clase_productos WHERE clase_productos.item = pendiente.item)
	
			AS precio_dolares
	
	 
			FROM  pendiente
			WHERE (pendiente.saldo > 0 or (SELECT SUM(saldo) FROM pendiente p WHERE p.orden = pendiente.orden AND
													p.mes = pendiente.mes AND p.item = pendiente.item) > 0)
			
			ORDER BY pendiente.id_pendiente;
END if;



END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_pendiente_empaque
DELIMITER //
CREATE PROCEDURE `buscar_pendiente_empaque`(
	IN `pa_uno` VARCHAR(50),
	IN `pa_dos` VARCHAR(50),
	IN `pa_tres` VARCHAR(50),
	IN `pa_cuatro` VARCHAR(50),
	IN `pa_cinco` VARCHAR(50),
	IN `pa_seis` VARCHAR(50),
	IN `pa_siete` VARCHAR(50)
)
BEGIN

if (pa_uno != '' || pa_dos != '' || pa_tres != '' || pa_cuatro != '' || pa_cinco != '' ||  pa_seis != '' ||  pa_siete != '') then 


	SELECT Y.*
					FROM (SELECT X.*
					
							FROM (SELECT pendiente_empaque.id_pendiente ,
							pendiente_empaque.categoria AS id_categoria,
							
		 (SELECT categoria.categoria FROM  categoria WHERE categoria.id_categoria = pendiente_empaque.categoria	) AS categoria,
		 pendiente_empaque.item AS item,
		 pendiente_empaque.orden_del_sitema ,
		 pendiente_empaque.observacion,
		(SELECT clase_productos.presentacion FROM clase_productos WHERE clase_productos.item = pendiente_empaque.item) AS presentacion,
		 pendiente_empaque.mes AS mes ,
		 pendiente_empaque.orden AS orden,
	(SELECT

		if( clase_productos.sampler = "si", CONCAT((SELECT clase_productos.descripcion_sampler FROM clase_productos WHERE clase_productos.item = pendiente_empaque.item)," ",(SELECT marca_productos.marca  FROM marca_productos WHERE marca_productos.id_marca = pendiente_empaque.marca)),
														(SELECT marca_productos.marca  FROM marca_productos WHERE marca_productos.id_marca = pendiente_empaque.marca)
						                     	) AS des FROM clase_productos WHERE clase_productos.item = pendiente_empaque.item)  AS marca,
		 (SELECT vitola_productos.vitola FROM  vitola_productos WHERE vitola_productos.id_vitola = pendiente_empaque.vitola	) AS vitola,
		 (SELECT nombre_productos.nombre FROM  nombre_productos WHERE nombre_productos.id_nombre = pendiente_empaque.nombre	) AS nombre,
		  (SELECT capa_productos.capa FROM  capa_productos WHERE capa_productos.id_capa = pendiente_empaque.capa	) AS capa,
		(SELECT cellos.anillo AS anillo FROM cellos WHERE cellos.id_cello = pendiente_empaque.cello) AS anillo,
		(SELECT cellos.cello AS cello FROM cellos WHERE cellos.id_cello = pendiente_empaque.cello) AS cello,
		(SELECT cellos.upc AS upc FROM cellos WHERE cellos.id_cello = pendiente_empaque.cello) AS upc,
		 pendiente_empaque.pendiente as pendiente,
		 pendiente_empaque.saldo,
		 (SELECT tipo_empaques.tipo_empaque FROM  tipo_empaques WHERE tipo_empaques.id_tipo_empaque = pendiente_empaque.tipo_empaque	) AS tipo_empaque,
		pendiente_empaque.paquetes AS paquetes,
		pendiente_empaque.unidades AS unidades,

(SELECT pendiente_empaque.saldo/(SELECT SUBSTRING(tipo_empaques.tipo_empaque, 9, 3) FROM tipo_empaques WHERE tipo_empaques.tipo_empaque LIKE CONCAT("%","CAJAS","%") AND
tipo_empaques.id_tipo_empaque = pendiente_empaque.tipo_empaque)) AS cant_cajas

FROM  pendiente_empaque
WHERE (pendiente_empaque.saldo > 0 or (SELECT SUM(saldo) FROM pendiente_empaque p WHERE p.orden = pendiente_empaque.orden AND
																	p.mes = pendiente_empaque.mes AND p.item = pendiente_empaque.item) > 0)
 ORDER BY pendiente_empaque.id_pendiente
)x
							
							
						WHERE  (SELECT clase_productos.presentacion FROM clase_productos WHERE clase_productos.item = x.item) = pa_cinco
						
									OR 
									
									(SELECT clase_productos.presentacion FROM clase_productos WHERE clase_productos.item = x.item) = pa_seis
									
									OR 
									
									(SELECT clase_productos.presentacion FROM clase_productos WHERE clase_productos.item = x.item) = pa_siete
								
									
								OR ( pa_cinco = '' AND  pa_seis = '' AND  pa_siete = '') 
						)y
						
			 WHERE 
			 		
			 	(Y.id_categoria = pa_uno
									OR 
				Y.id_categoria = pa_dos
									OR 
				Y.id_categoria = pa_tres
									OR 
				Y.id_categoria = pa_cuatro)
				
					OR ( pa_uno = '' AND  pa_dos = '' AND  pa_tres = ''  AND  pa_cuatro = '') 
										 
		
		ORDER BY y.id_pendiente	;
			

ELSE 

SELECT pendiente_empaque.id_pendiente ,
							pendiente_empaque.categoria AS id_categoria,
							
		 (SELECT categoria.categoria FROM  categoria WHERE categoria.id_categoria = pendiente_empaque.categoria	) AS categoria,
		 pendiente_empaque.item AS item,
		 pendiente_empaque.orden_del_sitema ,
		 pendiente_empaque.observacion,
		(SELECT clase_productos.presentacion FROM clase_productos WHERE clase_productos.item = pendiente_empaque.item) AS presentacion,
		 pendiente_empaque.mes AS mes ,
		 pendiente_empaque.orden AS orden,
	(SELECT

		if( clase_productos.sampler = "si", CONCAT((SELECT clase_productos.descripcion_sampler FROM clase_productos WHERE clase_productos.item = pendiente_empaque.item)," ",(SELECT marca_productos.marca  FROM marca_productos WHERE marca_productos.id_marca = pendiente_empaque.marca)),
														(SELECT marca_productos.marca  FROM marca_productos WHERE marca_productos.id_marca = pendiente_empaque.marca)
						                     	) AS des FROM clase_productos WHERE clase_productos.item = pendiente_empaque.item)  AS marca,
		 (SELECT vitola_productos.vitola FROM  vitola_productos WHERE vitola_productos.id_vitola = pendiente_empaque.vitola	) AS vitola,
		 (SELECT nombre_productos.nombre FROM  nombre_productos WHERE nombre_productos.id_nombre = pendiente_empaque.nombre	) AS nombre,
		  (SELECT capa_productos.capa FROM  capa_productos WHERE capa_productos.id_capa = pendiente_empaque.capa	) AS capa,
		(SELECT cellos.anillo AS anillo FROM cellos WHERE cellos.id_cello = pendiente_empaque.cello) AS anillo,
		(SELECT cellos.cello AS cello FROM cellos WHERE cellos.id_cello = pendiente_empaque.cello) AS cello,
		(SELECT cellos.upc AS upc FROM cellos WHERE cellos.id_cello = pendiente_empaque.cello) AS upc,
		 pendiente_empaque.pendiente as pendiente,
		 pendiente_empaque.saldo,
		 (SELECT tipo_empaques.tipo_empaque FROM  tipo_empaques WHERE tipo_empaques.id_tipo_empaque = pendiente_empaque.tipo_empaque	) AS tipo_empaque,
		pendiente_empaque.paquetes AS paquetes,
		pendiente_empaque.unidades AS unidades,

(SELECT pendiente_empaque.saldo/(SELECT SUBSTRING(tipo_empaques.tipo_empaque, 9, 3) FROM tipo_empaques WHERE tipo_empaques.tipo_empaque LIKE CONCAT("%","CAJAS","%") AND
tipo_empaques.id_tipo_empaque = pendiente_empaque.tipo_empaque)) AS cant_cajas

FROM  pendiente_empaque
WHERE (pendiente_empaque.saldo > 0 or (SELECT SUM(saldo) FROM pendiente_empaque p WHERE p.orden = pendiente_empaque.orden AND
																	p.mes = pendiente_empaque.mes AND p.item = pendiente_empaque.item) > 0)
 ORDER BY pendiente_empaque.id_pendiente ;
 
END if;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_pendiente_empaque_excel
DELIMITER //
CREATE PROCEDURE `buscar_pendiente_empaque_excel`(
	IN `pa_uno` VARCHAR(50),
	IN `pa_dos` VARCHAR(50),
	IN `pa_tres` VARCHAR(50),
	IN `pa_cuatro` VARCHAR(50),
	IN `pa_cinco` VARCHAR(100),
	IN `pa_seis` VARCHAR(100),
	IN `pa_siete` VARCHAR(100),
	IN `pa_item` VARCHAR(50),
	IN `pa_orden` VARCHAR(50),
	IN `pa_hon` VARCHAR(50),
	IN `pa_marca` VARCHAR(50),
	IN `pa_vitola` VARCHAR(50),
	IN `pa_nombre` VARCHAR(50),
	IN `pa_capa` VARCHAR(50),
	IN `pa_empaque` VARCHAR(50),
	IN `pa_mes` VARCHAR(50)
)
BEGIN

if (pa_uno != '' || pa_dos != '' || pa_tres != '' || pa_cuatro != '' || pa_cinco != '' ||  pa_seis != '' ||  pa_siete != '') then 


	SELECT z.* FROM(SELECT Y.*
					FROM (SELECT X.*
					
							FROM (SELECT 	
											pendiente_empaque.id_pendiente,		
		 (SELECT categoria.categoria FROM  categoria WHERE categoria.id_categoria = pendiente_empaque.categoria	) AS categoria,
		 pendiente_empaque.item AS item,
		 pendiente_empaque.orden_del_sitema ,
		 pendiente_empaque.observacion,
		(SELECT clase_productos.presentacion FROM clase_productos WHERE clase_productos.item = pendiente_empaque.item) AS presentacion,
		 pendiente_empaque.mes AS mes ,
		 pendiente_empaque.orden AS orden,
	(SELECT

		if( clase_productos.sampler = "si", CONCAT((SELECT clase_productos.descripcion_sampler FROM clase_productos WHERE clase_productos.item = pendiente_empaque.item)," ",(SELECT marca_productos.marca  FROM marca_productos WHERE marca_productos.id_marca = pendiente_empaque.marca)),
														(SELECT marca_productos.marca  FROM marca_productos WHERE marca_productos.id_marca = pendiente_empaque.marca)
						                     	) AS des FROM clase_productos WHERE clase_productos.item = pendiente_empaque.item)  AS marca,
		 (SELECT vitola_productos.vitola FROM  vitola_productos WHERE vitola_productos.id_vitola = pendiente_empaque.vitola	) AS vitola,
		 (SELECT nombre_productos.nombre FROM  nombre_productos WHERE nombre_productos.id_nombre = pendiente_empaque.nombre	) AS nombre,
		  (SELECT capa_productos.capa FROM  capa_productos WHERE capa_productos.id_capa = pendiente_empaque.capa	) AS capa,
		(SELECT cellos.anillo AS anillo FROM cellos WHERE cellos.id_cello = pendiente_empaque.cello) AS anillo,
		(SELECT cellos.cello AS cello FROM cellos WHERE cellos.id_cello = pendiente_empaque.cello) AS cello,
		(SELECT cellos.upc AS upc FROM cellos WHERE cellos.id_cello = pendiente_empaque.cello) AS upc,
		 pendiente_empaque.pendiente as pendiente,
		 pendiente_empaque.saldo,
		 (SELECT tipo_empaques.tipo_empaque FROM  tipo_empaques WHERE tipo_empaques.id_tipo_empaque = pendiente_empaque.tipo_empaque	) AS tipo_empaque,
		pendiente_empaque.paquetes AS paquetes,
		pendiente_empaque.unidades AS unidades,

(SELECT pendiente_empaque.saldo/(SELECT SUBSTRING(tipo_empaques.tipo_empaque, 9, 3) FROM tipo_empaques WHERE tipo_empaques.tipo_empaque LIKE CONCAT("%","CAJAS","%") AND
tipo_empaques.id_tipo_empaque = pendiente_empaque.tipo_empaque)) AS cant_cajas

FROM  pendiente_empaque
WHERE (pendiente_empaque.saldo > 0 or (SELECT SUM(saldo) FROM pendiente_empaque p WHERE p.orden = pendiente_empaque.orden AND
																	p.mes = pendiente_empaque.mes AND p.item = pendiente_empaque.item) > 0)
 ORDER BY pendiente_empaque.id_pendiente
)x
							
							
						WHERE  (SELECT clase_productos.presentacion FROM clase_productos WHERE clase_productos.item = x.item) = pa_cinco
						
									OR 
									
									(SELECT clase_productos.presentacion FROM clase_productos WHERE clase_productos.item = x.item) = pa_seis
									
									OR 
									
									(SELECT clase_productos.presentacion FROM clase_productos WHERE clase_productos.item = x.item) = pa_siete
								
									
								OR ( pa_cinco = '' AND  pa_seis = '' AND  pa_siete = '') 
						)y
						
			 WHERE 
			 		
			 	((SELECT categoria.id_categoria FROM categoria WHERE categoria.categoria = Y.categoria) = pa_uno
									OR 
				(SELECT categoria.id_categoria FROM categoria WHERE categoria.categoria = Y.categoria) = pa_dos
									OR 
				(SELECT categoria.id_categoria FROM categoria WHERE categoria.categoria = Y.categoria) = pa_tres
									OR 
				(SELECT categoria.id_categoria FROM categoria WHERE categoria.categoria = Y.categoria) = pa_cuatro)
				
					OR ( pa_uno = '' AND  pa_dos = '' AND  pa_tres = ''  AND  pa_cuatro = '') 
										 
		
			)z
			
			WHERE 
			(
				
				((z.item) like CONCAT("%",pa_item,"%")) AND
				((z.orden_del_sitema) like CONCAT("%",pa_orden,"%")) AND
				((z.orden) like CONCAT("%",pa_hon,"%")) AND
				((SELECT if( clase_productos.sampler = "si", CONCAT((SELECT clase_productos.descripcion_sampler FROM clase_productos WHERE clase_productos.item = z.item)," ",(z.marca)),
							(z.marca)
							) AS des FROM clase_productos WHERE clase_productos.item = z.item) like CONCAT("%",pa_marca, "%")) and
				((z.vitola	) like CONCAT("%", pa_vitola , "%"))  and
				((z.nombre	)  like CONCAT("%",pa_nombre, "%")) AND
				((z.capa	)  like CONCAT("%",pa_capa, "%"))  and
				((z.tipo_empaque	)  like CONCAT("%",pa_empaque, "%")) AND
				((z.mes)like CONCAT("%",pa_mes, "%")))
			;
			

ELSE 

SELECT pendiente_empaque.id_pendiente,
		 (SELECT categoria.categoria FROM  categoria WHERE categoria.id_categoria = pendiente_empaque.categoria	) AS categoria,
		 pendiente_empaque.item AS item,
		 pendiente_empaque.orden_del_sitema ,
		 pendiente_empaque.observacion,
		(SELECT clase_productos.presentacion FROM clase_productos WHERE clase_productos.item = pendiente_empaque.item) AS presentacion,
		 pendiente_empaque.mes AS mes ,
		 pendiente_empaque.orden AS orden,
	(SELECT

		if( clase_productos.sampler = "si", CONCAT((SELECT clase_productos.descripcion_sampler FROM clase_productos WHERE clase_productos.item = pendiente_empaque.item)," ",(SELECT marca_productos.marca  FROM marca_productos WHERE marca_productos.id_marca = pendiente_empaque.marca)),
														(SELECT marca_productos.marca  FROM marca_productos WHERE marca_productos.id_marca = pendiente_empaque.marca)
						                     	) AS des FROM clase_productos WHERE clase_productos.item = pendiente_empaque.item)  AS marca,
		 (SELECT vitola_productos.vitola FROM  vitola_productos WHERE vitola_productos.id_vitola = pendiente_empaque.vitola	) AS vitola,
		 (SELECT nombre_productos.nombre FROM  nombre_productos WHERE nombre_productos.id_nombre = pendiente_empaque.nombre	) AS nombre,
		  (SELECT capa_productos.capa FROM  capa_productos WHERE capa_productos.id_capa = pendiente_empaque.capa	) AS capa,
		(SELECT cellos.anillo AS anillo FROM cellos WHERE cellos.id_cello = pendiente_empaque.cello) AS anillo,
		(SELECT cellos.cello AS cello FROM cellos WHERE cellos.id_cello = pendiente_empaque.cello) AS cello,
		(SELECT cellos.upc AS upc FROM cellos WHERE cellos.id_cello = pendiente_empaque.cello) AS upc,
		 pendiente_empaque.pendiente as pendiente,
		 pendiente_empaque.saldo,
		 (SELECT tipo_empaques.tipo_empaque FROM  tipo_empaques WHERE tipo_empaques.id_tipo_empaque = pendiente_empaque.tipo_empaque	) AS tipo_empaque,
		pendiente_empaque.paquetes AS paquetes,
		pendiente_empaque.unidades AS unidades,

(SELECT pendiente_empaque.saldo/(SELECT SUBSTRING(tipo_empaques.tipo_empaque, 9, 3) FROM tipo_empaques WHERE tipo_empaques.tipo_empaque LIKE CONCAT("%","CAJAS","%") AND
tipo_empaques.id_tipo_empaque = pendiente_empaque.tipo_empaque)) AS cant_cajas

FROM  pendiente_empaque
WHERE (pendiente_empaque.saldo > 0 or (SELECT SUM(saldo) FROM pendiente_empaque p WHERE p.orden = pendiente_empaque.orden AND
																	p.mes = pendiente_empaque.mes AND p.item = pendiente_empaque.item) > 0)
 ORDER BY pendiente_empaque.id_pendiente ;
 
END if;


END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_pendiente_empaque_excel2
DELIMITER //
CREATE PROCEDURE `buscar_pendiente_empaque_excel2`(
	IN `pa_uno` VARCHAR(50),
	IN `pa_dos` VARCHAR(50),
	IN `pa_tres` VARCHAR(50),
	IN `pa_cuatro` VARCHAR(50),
	IN `pa_cinco` VARCHAR(100),
	IN `pa_seis` VARCHAR(100),
	IN `pa_siete` VARCHAR(100),
	IN `pa_item` VARCHAR(50),
	IN `pa_orden` VARCHAR(50),
	IN `pa_hon` VARCHAR(50),
	IN `pa_marca` VARCHAR(50),
	IN `pa_vitola` VARCHAR(50),
	IN `pa_nombre` VARCHAR(50),
	IN `pa_capa` VARCHAR(50),
	IN `pa_empaque` VARCHAR(50),
	IN `pa_mes` VARCHAR(50)
)
BEGIN

if (pa_uno != '' || pa_dos != '' || pa_tres != '' || pa_cuatro != '' || pa_cinco != '' ||  pa_seis != '' ||  pa_siete != '') then 


	SELECT z.* FROM(SELECT Y.*
					FROM (SELECT X.*
					
							FROM (SELECT 							
		 (SELECT categoria.categoria FROM  categoria WHERE categoria.id_categoria = pendiente_empaque.categoria	) AS categoria,
		 pendiente_empaque.item AS item,
		 pendiente_empaque.orden_del_sitema ,
		 pendiente_empaque.observacion,
		(SELECT clase_productos.presentacion FROM clase_productos WHERE clase_productos.item = pendiente_empaque.item) AS presentacion,
		 pendiente_empaque.mes AS mes ,
		 pendiente_empaque.orden AS orden,
	(SELECT

		if( clase_productos.sampler = "si", CONCAT((SELECT clase_productos.descripcion_sampler FROM clase_productos WHERE clase_productos.item = pendiente_empaque.item)," ",(SELECT marca_productos.marca  FROM marca_productos WHERE marca_productos.id_marca = pendiente_empaque.marca)),
														(SELECT marca_productos.marca  FROM marca_productos WHERE marca_productos.id_marca = pendiente_empaque.marca)
						                     	) AS des FROM clase_productos WHERE clase_productos.item = pendiente_empaque.item)  AS marca,
		 (SELECT vitola_productos.vitola FROM  vitola_productos WHERE vitola_productos.id_vitola = pendiente_empaque.vitola	) AS vitola,
		 (SELECT nombre_productos.nombre FROM  nombre_productos WHERE nombre_productos.id_nombre = pendiente_empaque.nombre	) AS nombre,
		  (SELECT capa_productos.capa FROM  capa_productos WHERE capa_productos.id_capa = pendiente_empaque.capa	) AS capa,
		(SELECT cellos.anillo AS anillo FROM cellos WHERE cellos.id_cello = pendiente_empaque.cello) AS anillo,
		(SELECT cellos.cello AS cello FROM cellos WHERE cellos.id_cello = pendiente_empaque.cello) AS cello,
		(SELECT cellos.upc AS upc FROM cellos WHERE cellos.id_cello = pendiente_empaque.cello) AS upc,
		 pendiente_empaque.pendiente as pendiente,
		 pendiente_empaque.saldo,
		 (SELECT tipo_empaques.tipo_empaque FROM  tipo_empaques WHERE tipo_empaques.id_tipo_empaque = pendiente_empaque.tipo_empaque	) AS tipo_empaque,
		pendiente_empaque.paquetes AS paquetes,
		pendiente_empaque.unidades AS unidades,

(SELECT pendiente_empaque.saldo/(SELECT SUBSTRING(tipo_empaques.tipo_empaque, 9, 3) FROM tipo_empaques WHERE tipo_empaques.tipo_empaque LIKE CONCAT("%","CAJAS","%") AND
tipo_empaques.id_tipo_empaque = pendiente_empaque.tipo_empaque)) AS cant_cajas

FROM  pendiente_empaque
WHERE (pendiente_empaque.saldo > 0 or (SELECT SUM(saldo) FROM pendiente_empaque p WHERE p.orden = pendiente_empaque.orden AND
																	p.mes = pendiente_empaque.mes AND p.item = pendiente_empaque.item) > 0)
 ORDER BY pendiente_empaque.id_pendiente
)x
							
							
						WHERE  (SELECT clase_productos.presentacion FROM clase_productos WHERE clase_productos.item = x.item) = pa_cinco
						
									OR 
									
									(SELECT clase_productos.presentacion FROM clase_productos WHERE clase_productos.item = x.item) = pa_seis
									
									OR 
									
									(SELECT clase_productos.presentacion FROM clase_productos WHERE clase_productos.item = x.item) = pa_siete
								
									
								OR ( pa_cinco = '' AND  pa_seis = '' AND  pa_siete = '') 
						)y
						
			 WHERE 
			 		
			 	((SELECT categoria.id_categoria FROM categoria WHERE categoria.categoria = Y.categoria) = pa_uno
									OR 
				(SELECT categoria.id_categoria FROM categoria WHERE categoria.categoria = Y.categoria) = pa_dos
									OR 
				(SELECT categoria.id_categoria FROM categoria WHERE categoria.categoria = Y.categoria) = pa_tres
									OR 
				(SELECT categoria.id_categoria FROM categoria WHERE categoria.categoria = Y.categoria) = pa_cuatro)
				
					OR ( pa_uno = '' AND  pa_dos = '' AND  pa_tres = ''  AND  pa_cuatro = '') 
										 
		
			)z
			
			WHERE 
			(
				
				((z.item) like CONCAT("%",pa_item,"%")) AND
				((z.orden_del_sitema) like CONCAT("%",pa_orden,"%")) AND
				((z.orden) like CONCAT("%",pa_hon,"%")) AND
				((SELECT if( clase_productos.sampler = "si", CONCAT((SELECT clase_productos.descripcion_sampler FROM clase_productos WHERE clase_productos.item = z.item)," ",(z.marca)),
							(z.marca)
							) AS des FROM clase_productos WHERE clase_productos.item = z.item) like CONCAT("%",pa_marca, "%")) and
				((z.vitola	) like CONCAT("%", pa_vitola , "%"))  and
				((z.nombre	)  like CONCAT("%",pa_nombre, "%")) AND
				((z.capa	)  like CONCAT("%",pa_capa, "%"))  and
				((z.tipo_empaque	)  like CONCAT("%",pa_empaque, "%")) AND
				((z.mes)like CONCAT("%",pa_mes, "%")))
			;
			

ELSE 

SELECT 
		 (SELECT categoria.categoria FROM  categoria WHERE categoria.id_categoria = pendiente_empaque.categoria	) AS categoria,
		 pendiente_empaque.item AS item,
		 pendiente_empaque.orden_del_sitema ,
		 pendiente_empaque.observacion,
		(SELECT clase_productos.presentacion FROM clase_productos WHERE clase_productos.item = pendiente_empaque.item) AS presentacion,
		 pendiente_empaque.mes AS mes ,
		 pendiente_empaque.orden AS orden,
	(SELECT

		if( clase_productos.sampler = "si", CONCAT((SELECT clase_productos.descripcion_sampler FROM clase_productos WHERE clase_productos.item = pendiente_empaque.item)," ",(SELECT marca_productos.marca  FROM marca_productos WHERE marca_productos.id_marca = pendiente_empaque.marca)),
														(SELECT marca_productos.marca  FROM marca_productos WHERE marca_productos.id_marca = pendiente_empaque.marca)
						                     	) AS des FROM clase_productos WHERE clase_productos.item = pendiente_empaque.item)  AS marca,
		 (SELECT vitola_productos.vitola FROM  vitola_productos WHERE vitola_productos.id_vitola = pendiente_empaque.vitola	) AS vitola,
		 (SELECT nombre_productos.nombre FROM  nombre_productos WHERE nombre_productos.id_nombre = pendiente_empaque.nombre	) AS nombre,
		  (SELECT capa_productos.capa FROM  capa_productos WHERE capa_productos.id_capa = pendiente_empaque.capa	) AS capa,
		(SELECT cellos.anillo AS anillo FROM cellos WHERE cellos.id_cello = pendiente_empaque.cello) AS anillo,
		(SELECT cellos.cello AS cello FROM cellos WHERE cellos.id_cello = pendiente_empaque.cello) AS cello,
		(SELECT cellos.upc AS upc FROM cellos WHERE cellos.id_cello = pendiente_empaque.cello) AS upc,
		 pendiente_empaque.pendiente as pendiente,
		 pendiente_empaque.saldo,
		 (SELECT tipo_empaques.tipo_empaque FROM  tipo_empaques WHERE tipo_empaques.id_tipo_empaque = pendiente_empaque.tipo_empaque	) AS tipo_empaque,
		pendiente_empaque.paquetes AS paquetes,
		pendiente_empaque.unidades AS unidades,

(SELECT pendiente_empaque.saldo/(SELECT SUBSTRING(tipo_empaques.tipo_empaque, 9, 3) FROM tipo_empaques WHERE tipo_empaques.tipo_empaque LIKE CONCAT("%","CAJAS","%") AND
tipo_empaques.id_tipo_empaque = pendiente_empaque.tipo_empaque)) AS cant_cajas

FROM  pendiente_empaque
WHERE (pendiente_empaque.saldo > 0 or (SELECT SUM(saldo) FROM pendiente_empaque p WHERE p.orden = pendiente_empaque.orden AND
																	p.mes = pendiente_empaque.mes AND p.item = pendiente_empaque.item) > 0)
 ORDER BY pendiente_empaque.id_pendiente ;
 
END if;


END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_pendiente_excel
DELIMITER //
CREATE PROCEDURE `buscar_pendiente_excel`(
	IN `pa_uno` VARCHAR(50),
	IN `pa_dos` VARCHAR(50),
	IN `pa_tres` VARCHAR(50),
	IN `pa_cuatro` VARCHAR(50),
	IN `pa_cinco` VARCHAR(50),
	IN `pa_seis` VARCHAR(100),
	IN `pa_siete` VARCHAR(100),
	IN `pa_item` VARCHAR(50),
	IN `pa_orden` VARCHAR(50),
	IN `pa_hon` VARCHAR(50),
	IN `pa_marca` VARCHAR(50),
	IN `pa_vitola` VARCHAR(50),
	IN `pa_nombre` VARCHAR(50),
	IN `pa_capa` VARCHAR(50),
	IN `pa_empaque` VARCHAR(50),
	IN `pa_mes` VARCHAR(50)
)
BEGIN

			SELECT z.*	FROM 	(		SELECT Y.*
					FROM (SELECT X.*
					
							FROM (SELECT 
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
									 
							      (SELECT tipo_empaques.tipo_empaque FROM  tipo_empaques WHERE tipo_empaques.id_tipo_empaque = pendiente.tipo_empaque	) AS tipo_empaque,
									pendiente.paquetes AS paquetes,
									pendiente.unidades AS unidades,
							       (SELECT
							
									if( clase_productos.sampler = "si", pendiente.serie_precio , (select clase_productos.codigo_precio FROM clase_productos WHERE clase_productos.item = pendiente.item) ) AS des FROM clase_productos WHERE clase_productos.item = pendiente.item)
									 AS serie_precio,
							         (SELECT
							
									if( clase_productos.sampler = "si", pendiente.precio ,(select clase_productos.precio FROM clase_productos WHERE clase_productos.item = pendiente.item) ) AS des FROM clase_productos WHERE clase_productos.item = pendiente.item)
							
									AS precio,
									pendiente.pendiente as pendiente,
									 pendiente.saldo,
							
									(SELECT
										if( clase_productos.sampler = "si", ((pendiente.precio*pendiente.saldo)/1000) ,((select clase_productos.precio FROM clase_productos WHERE clase_productos.item = pendiente.item)*pendiente.saldo)/1000   ) AS des FROM clase_productos WHERE clase_productos.item = pendiente.item)
							
									AS precio_dolares
							
							 
							FROM  pendiente
							WHERE (pendiente.saldo > 0 or (SELECT SUM(saldo) FROM pendiente p WHERE p.orden = pendiente.orden AND
																	p.mes = pendiente.mes AND p.item = pendiente.item) > 0)
							
							ORDER BY pendiente.id_pendiente)x
							
							
						WHERE  (SELECT clase_productos.presentacion FROM clase_productos WHERE clase_productos.item = x.item) = pa_cinco
						
									OR 
									
									(SELECT clase_productos.presentacion FROM clase_productos WHERE clase_productos.item = x.item) = pa_seis
									
									OR 
									
									(SELECT clase_productos.presentacion FROM clase_productos WHERE clase_productos.item = x.item) = pa_siete
								
									
								OR ( pa_cinco = '' AND  pa_seis = '' AND  pa_siete = '') 
						)y
						
			 WHERE 
			 		
			 	(  (SELECT id_categoria FROM categoria WHERE categoria.categoria = Y.categoria) = pa_uno
									OR 
			    (SELECT id_categoria FROM categoria WHERE categoria.categoria = Y.categoria) = pa_dos
									OR 
			   	 (SELECT id_categoria FROM categoria WHERE categoria.categoria = Y.categoria) = pa_tres
									OR 
			    (SELECT id_categoria FROM categoria WHERE categoria.categoria = Y.categoria) = pa_cuatro)
				
					OR ( pa_uno = '' AND  pa_dos = '' AND  pa_tres = ''  AND  pa_cuatro = '')  )z
											
			WHERE 
			((z.item) like CONCAT("%",pa_item,"%")) AND 
			((z.orden) like CONCAT("%",pa_hon,"%")) AND 
			((z.orden_del_sitema) like CONCAT("%",pa_orden,"%")) AND 
			((SELECT
							
									if( clase_productos.sampler = "si", CONCAT((SELECT clase_productos.descripcion_sampler FROM clase_productos WHERE clase_productos.item = z.item)," ",z.marca),
																					z.marca
													                     	) AS des FROM clase_productos WHERE clase_productos.item = z.item)) like CONCAT("%",pa_marca,"%") AND 
			
			((z.vitola) like CONCAT("%",pa_vitola,"%")) AND
			((z.nombre) like CONCAT("%",pa_nombre,"%")) AND
		   ((z.capa) like CONCAT("%",pa_capa,"%")) AND 
		   ((z.tipo_empaque) like CONCAT("%",pa_empaque,"%"))  AND
		   ((z.mes) like CONCAT("%",pa_mes,"%"))  
			;
										 
	
END//
DELIMITER ;

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
	IN `orden` VARCHAR(50),
	IN `ordenSis` VARCHAR(50)
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


(
    
    if(
        (select sampler FROM clase_productos
			WHERE clase_productos.item = (SELECT pendiente.item FROM pendiente
											WHERE pendiente.id_pendiente = detalle_factura.id_pendiente))='si',
         ((`cantidad_puros`*`unidad`)/(SELECT COUNT(*) FROM  detalle_clase_productos WHERE detalle_clase_productos.item = (SELECT clase_productos.item
		FROM clase_productos
		WHERE clase_productos.item = (SELECT pendiente.item FROM pendiente WHERE pendiente.id_pendiente = detalle_factura.id_pendiente)))),
        
        (`cantidad_puros`*`unidad`)
    
    )

)

	 AS total_tabacos,
	 
	(SELECT CONCAT(pendiente.orden_del_sitema) AS oer
	FROM pendiente WHERE pendiente.id_pendiente = detalle_factura.id_pendiente) AS orden_sistema,
	
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
							((SELECT CONCAT(pendiente.orden_del_sitema) AS oer
	FROM pendiente WHERE pendiente.id_pendiente = detalle_factura.id_pendiente) LIKE (CONCAT("%",ordenSis,"%")))
	
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

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
