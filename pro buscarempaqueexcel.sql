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

-- Dumping structure for procedure facturacion_plasencia.buscar_pendiente_empaque_excel
DELIMITER //
CREATE PROCEDURE `buscar_pendiente_empaque_excel`(
	IN `pa_uno` VARCHAR(50),
	IN `pa_dos` VARCHAR(50),
	IN `pa_tres` VARCHAR(50),
	IN `pa_cuatro` VARCHAR(50),
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

SELECT pendiente_empaque.id_pendiente ,
		 (SELECT categoria.categoria FROM  categoria WHERE categoria.id_categoria = pendiente_empaque.categoria	) AS categoria,
		 pendiente_empaque.item AS item,
		 pendiente_empaque.orden_del_sitema ,
		 pendiente_empaque.observacion,
		 pendiente_empaque.presentacion ,
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
WHERE
(( (pendiente_empaque.categoria) = pa_uno) OR
((pendiente_empaque.categoria) =pa_dos) OR
((pendiente_empaque.categoria) = pa_tres) or
((pendiente_empaque.categoria) = pa_cuatro) ) AND

((pendiente_empaque.item) like CONCAT("%",pa_item,"%")) AND
((pendiente_empaque.orden_del_sitema) like CONCAT("%",pa_orden,"%")) AND
((pendiente_empaque.orden) like CONCAT("%",pa_hon,"%")) AND
((SELECT if( clase_productos.sampler = "si", CONCAT((SELECT clase_productos.descripcion_sampler FROM clase_productos WHERE clase_productos.item = pendiente_empaque.item)," ",(SELECT marca_productos.marca  FROM marca_productos WHERE marca_productos.id_marca = pendiente_empaque.marca)), 
			(SELECT marca_productos.marca  FROM marca_productos WHERE marca_productos.id_marca = pendiente_empaque.marca) 
			) AS des FROM clase_productos WHERE clase_productos.item = pendiente_empaque.item) like CONCAT("%",pa_marca, "%")) and
((SELECT vitola_productos.vitola FROM  vitola_productos WHERE vitola_productos.id_vitola = pendiente_empaque.vitola	) like CONCAT("%", pa_vitola , "%"))  and
((SELECT nombre_productos.nombre FROM  nombre_productos WHERE nombre_productos.id_nombre = pendiente_empaque.nombre	)  like CONCAT("%",pa_nombre, "%")) AND
((SELECT capa_productos.capa FROM  capa_productos WHERE capa_productos.id_capa = pendiente_empaque.capa	)  like CONCAT("%",pa_capa, "%"))  and
((SELECT tipo_empaques.tipo_empaque FROM  tipo_empaques WHERE tipo_empaques.id_tipo_empaque = pendiente_empaque.tipo_empaque	)  like CONCAT("%",pa_empaque, "%")) AND
((pendiente_empaque.mes)like CONCAT("%",pa_mes, "%"))
		ORDER BY pendiente_empaque.id_pendiente;
		
END//
DELIMITER ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
