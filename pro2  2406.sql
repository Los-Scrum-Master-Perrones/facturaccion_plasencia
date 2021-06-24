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

-- Dumping structure for procedure facturacion_plasencia.actualizar_detalles_productos
DELIMITER //
CREATE PROCEDURE `actualizar_detalles_productos`(
	IN `pa_id` VARCHAR(50),
	IN `pa_codpro` VARCHAR(50),
	IN `pa_codprecio` VARCHAR(50),
	IN `pa_precio` DECIMAL(10,0),
	IN `pa_capa` VARCHAR(50),
	IN `pa_vitola` VARCHAR(50),
	IN `pa_nombre` TEXT,
	IN `pa_marca` TEXT,
	IN `pa_cello` TEXT,
	IN `pa_anillo` VARCHAR(50),
	IN `pa_upc` VARCHAR(50),
	IN `pa_tipo` VARCHAR(50)
)
BEGIN
DECLARE icapa INT;
DECLARE imarca INT;
DECLARE inombre INT;
DECLARE ivitola INT;
DECLARE itipo INT;
DECLARE icello INT;


SET ivitola = (SELECT vitola_productos.id_vitola FROM  vitola_productos WHERE vitola_productos.vitola = pa_vitola);
SET icapa = (SELECT capa_productos.id_capa FROM  capa_productos WHERE capa_productos.capa = pa_capa);
SET imarca = (SELECT marca_productos.id_marca FROM marca_productos WHERE marca_productos.marca = pa_marca);
SET inombre = (SELECT nombre_productos.id_nombre FROM nombre_productos WHERE nombre_productos.nombre = pa_nombre);
SET icello = (SELECT cellos.id_cello FROM cellos WHERE cellos.cello = pa_cello AND cellos.anillo = pa_anillo AND cellos.upc= pa_upc);

UPDATE detalle_clase_productos set
detalle_clase_productos.codigo_producto = pa_codpro,
detalle_clase_productos.otra_descripcion = pa_codprecio,
detalle_clase_productos.precio = pa_precio,

detalle_clase_productos.id_capa = icapa,
detalle_clase_productos.id_vitola = ivitola,
 detalle_clase_productos.id_nombre = inombre,
 detalle_clase_productos.id_marca = imarca,
 detalle_clase_productos.id_cello = icello,
detalle_clase_productos.id_tipo_empaque = pa_tipo
WHERE 
detalle_clase_productos.id_producto = pa_id;


END//
DELIMITER ;

-- Dumping structure for procedure facturacion_plasencia.insertar_pendente_empaque
DELIMITER //
CREATE PROCEDURE `insertar_pendente_empaque`(IN `fecha` VARCHAR(50))
BEGIN

SET lc_time_names = 'es_ES';
insert into pendiente_empaque(
	`categoria`,
	`item`,
	`orden_del_sitema`,
	`observacion`,
	`presentacion`,
	`mes`,
	`orden`,
	`marca`,
	`vitola`,
	`nombre`,
	`capa`,
	`tipo_empaque`,
	`cello`,
	`pendiente`,
	`saldo`,
	`paquetes`,
	`unidades`,
	pendiente_empaque.id_pendiente_pedido) (SELECT
  pendiente.categoria  AS categoria,
 (SELECT clase_productos.item  FROM clase_productos WHERE clase_productos.item = pendiente.item) AS item,
 '' AS orden_del_sistema,
 '' AS observacion,
 (SELECT clase_productos.presentacion FROM clase_productos WHERE clase_productos.item = pendiente.item) AS presentacion,

pendiente.mes AS mes,
pendiente.orden AS orden,
 (SELECT clase_productos.id_marca FROM clase_productos WHERE clase_productos.item = pendiente.item) AS marca,
 (SELECT clase_productos.id_vitola FROM clase_productos WHERE clase_productos.item = pendiente.item) AS vitola,
 (SELECT clase_productos.id_nombre FROM clase_productos WHERE clase_productos.item = pendiente.item) AS nombre,
 (SELECT clase_productos.id_capa FROM clase_productos WHERE clase_productos.item = pendiente.item) AS capa,
 (SELECT clase_productos.id_tipo_empaque FROM clase_productos WHERE clase_productos.item = pendiente.item) AS tipo_empaque,
 (SELECT clase_productos.id_cello FROM clase_productos WHERE clase_productos.item = pendiente.item) AS cello,
  pendiente.pendiente  AS pendiente,
    pendiente.saldo AS saldo,
     pendiente.paquetes AS paquetes,
      pendiente.unidades AS unidades,
       pendiente.id_pendiente AS id_pendiente_pedido
       FROM pendiente WHERE pendiente.mes =  UPPER( CONCAT( MONTHNAME(fecha)," ",year(fecha))));


END//
DELIMITER ;

-- Dumping structure for procedure facturacion_plasencia.mostrar_detalle_clase_productos
DELIMITER //
CREATE PROCEDURE `mostrar_detalle_clase_productos`(
	IN `pa_item` VARCHAR(50)
)
BEGIN
SELECT 
detalle_clase_productos.id_producto,
item,
(SELECT capa_productos.capa FROM  capa_productos WHERE capa_productos.id_capa = detalle_clase_productos.id_capa	) AS capa,
(SELECT vitola_productos.vitola FROM  vitola_productos WHERE vitola_productos.id_vitola = detalle_clase_productos.id_vitola	) AS vitola,
(SELECT nombre_productos.nombre FROM  nombre_productos WHERE nombre_productos.id_nombre = detalle_clase_productos.id_nombre	) AS nombre,
(SELECT marca_productos.marca FROM marca_productos WHERE marca_productos.id_marca = detalle_clase_productos.id_marca	) AS marca,
	
(SELECT cellos.anillo AS anillo FROM cellos WHERE cellos.id_cello = detalle_clase_productos.id_cello) AS anillo,
(SELECT cellos.cello AS cello FROM cellos WHERE cellos.id_cello = detalle_clase_productos.id_cello) AS cello,
(SELECT cellos.upc AS upc FROM cellos WHERE cellos.id_cello = detalle_clase_productos.id_cello) AS upc,
(SELECT tipo_empaques.tipo_empaque FROM  tipo_empaques WHERE tipo_empaques.id_tipo_empaque = detalle_clase_productos.id_tipo_empaque	) AS tipo_empaque,
otra_descripcion,
precio,
codigo_producto
FROM detalle_clase_productos
WHERE detalle_clase_productos.item like CONCAT('%',pa_item,'%') OR
detalle_clase_productos.otra_descripcion like CONCAT('%',pa_item,'%') OR
detalle_clase_productos.codigo_producto like CONCAT('%',pa_item,'%') OR
(SELECT capa_productos.capa FROM  capa_productos WHERE capa_productos.id_capa = detalle_clase_productos.id_capa	)  like CONCAT('%',pa_item,'%') OR
(SELECT vitola_productos.vitola FROM  vitola_productos WHERE vitola_productos.id_vitola = detalle_clase_productos.id_vitola	)  like CONCAT('%',pa_item,'%') OR
(SELECT nombre_productos.nombre FROM  nombre_productos WHERE nombre_productos.id_nombre = detalle_clase_productos.id_nombre	)  like CONCAT('%',pa_item,'%') OR
(SELECT marca_productos.marca FROM marca_productos WHERE marca_productos.id_marca = detalle_clase_productos.id_marca	)  like CONCAT('%',pa_item,'%') OR
(SELECT tipo_empaques.tipo_empaque FROM  tipo_empaques WHERE tipo_empaques.id_tipo_empaque = detalle_clase_productos.id_tipo_empaque	) like CONCAT('%',pa_item,'%') 

;
END//
DELIMITER ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
