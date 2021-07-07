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

-- Volcando estructura para procedimiento facturacion_plasencia.Actualizar
DELIMITER //
CREATE PROCEDURE `Actualizar`(IN `id_pro` INT, IN `saldo_programacion` DECIMAL(10,2), IN `id_pendiente` INT, IN `saldo_pendiente` DECIMAL(10,2))
BEGIN

UPDATE detalle_programacion SET detalle_programacion.saldo = saldo_programacion WHERE detalle_programacion.id_detalle_programacion =
id_pro;

UPDATE pendiente_empaque SET pendiente_empaque.saldo =  pendiente_empaque.saldo + saldo_pendiente WHERE pendiente_empaque.id_pendiente
= id_pendiente;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.actualizar_capa
DELIMITER //
CREATE PROCEDURE `actualizar_capa`(IN `pa_id` VARCHAR(50), IN `pa_capa` VARCHAR(50))
BEGIN
  UPDATE capa_productos
                SET
                      capa_productos.capa = pa_capa

                WHERE capa_productos.id_capa= pa_id;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.actualizar_contrasenia
DELIMITER //
CREATE PROCEDURE `actualizar_contrasenia`(IN `pa_id` INT, IN `pa_email` VARCHAR(50), IN `pa_password` VARCHAR(200))
BEGIN
             UPDATE users
                SET
                      users.email = pa_email,
                      users.password = pa_password


                WHERE users.id = pa_id;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.actualizar_detalles_productos
DELIMITER //
CREATE PROCEDURE `actualizar_detalles_productos`(IN `pa_id` VARCHAR(50), IN `pa_codpro` VARCHAR(50), IN `pa_codprecio` VARCHAR(50), IN `pa_precio` VARCHAR(50), IN `pa_capa` VARCHAR(50), IN `pa_vitola` VARCHAR(50), IN `pa_nombre` TEXT, IN `pa_marca` TEXT, IN `pa_cello` TEXT, IN `pa_anillo` VARCHAR(50), IN `pa_upc` VARCHAR(50), IN `pa_tipo` VARCHAR(50))
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

-- Volcando estructura para procedimiento facturacion_plasencia.actualizar_detalle_factura
DELIMITER //
CREATE PROCEDURE `actualizar_detalle_factura`(IN `pa_id_pendiente` INT, IN `pa_cantidad_cajas` INT, IN `pa_peso_bruto` INT, IN `pa_peso_neto` INT, IN `pa_cantidad_puros` INT, IN `pa_unidad` INT, IN `pa_anterior` INT)
BEGIN

	UPDATE detalle_factura SET
		detalle_factura.cantidad_cajas = pa_cantidad_cajas,
		detalle_factura.peso_bruto = pa_peso_bruto,
		detalle_factura.peso_neto = pa_peso_neto,
		detalle_factura.cantidad_puros = pa_cantidad_puros,
		detalle_factura.unidad = pa_unidad,
		detalle_factura.anterior = pa_anterior
   WHERE detalle_factura.id_detalle = pa_id_pendiente;



END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.actualizar_detalle_pendiente
DELIMITER //
CREATE PROCEDURE `actualizar_detalle_pendiente`(IN `id_pro` INT, IN `id_pen` INT, IN `saldo` DECIMAL(10,2), IN `saldo_pendiente` DECIMAL(10,2), IN `cant` INT)
BEGIN


UPDATE pendiente_empaque SET pendiente_empaque.saldo = pendiente_empaque.saldo + saldo_pendiente WHERE pendiente_empaque.id_pendiente =
id_pen;

UPDATE detalle_programacion SET detalle_programacion.saldo = saldo, detalle_programacion.cant_cajas =
cant WHERE detalle_programacion.id_detalle_programacion = id_pro;


UPDATE lista_cajas SET lista_cajas.existencia = cant
WHERE (SELECT (SELECT  clase_productos.codigo_caja FROM clase_productos WHERE
			  clase_productos.item = pendiente_empaque.item  ) AS caja
 FROM pendiente_empaque WHERE pendiente_empaque.id_pendiente =id_pen) = lista_cajas.codigo;


END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.actualizar_factura_venta
DELIMITER //
CREATE PROCEDURE `actualizar_factura_venta`(IN `pa_num_factura` VARCHAR(50), IN `pa_cliente` VARCHAR(50), IN `pa_contenedor` VARCHAR(50), IN `pa_id` INT)
BEGIN
   UPDATE factura_terminados SET factura_terminados.cliente = pa_cliente,
   										factura_terminados.numero_factura = pa_num_factura,
   										factura_terminados.contenedor = pa_contenedor
   		WHERE factura_terminados.id = pa_id;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.actualizar_marca
DELIMITER //
CREATE PROCEDURE `actualizar_marca`(IN `pa_id` VARCHAR(50), IN `pa_marca` VARCHAR(50))
BEGIN
  UPDATE marca_productos
                SET
                      marca_productos.marca = pa_marca

                WHERE marca_productos.id_marca = pa_id;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.actualizar_nombre
DELIMITER //
CREATE PROCEDURE `actualizar_nombre`(IN `pa_id` VARCHAR(50), IN `pa_nombre` VARCHAR(50))
BEGIN
  UPDATE nombre_productos
                SET
                      nombre_productos.nombre = pa_nombre

                WHERE nombre_productos.id_nombre = pa_id;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.actualizar_pendientes
DELIMITER //
CREATE PROCEDURE `actualizar_pendientes`(IN `id` INT, IN `item` VARCHAR(50), IN `orden_sistema` VARCHAR(50), IN `observeacion` VARCHAR(50), IN `presentacion` VARCHAR(50), IN `pendient` VARCHAR(50), IN `saldo` VARCHAR(50), IN `seriep` VARCHAR(50), IN `precio` VARCHAR(50), IN `orden` VARCHAR(50))
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
CREATE PROCEDURE `actualizar_pendiente_empaque`(IN `id` INT, IN `observeacion` VARCHAR(50), IN `pendient` VARCHAR(50), IN `saldo` VARCHAR(50))
BEGIN
 UPDATE pendiente_empaque SET
 pendiente_empaque.observacion = observeacion,
 pendiente_empaque.pendiente = pendient,
 pendiente_empaque.saldo = saldo
 WHERE pendiente_empaque.id_pendiente = id ;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.actualizar_pendiente_empaque_sampler
DELIMITER //
CREATE PROCEDURE `actualizar_pendiente_empaque_sampler`(IN `marca` INT, IN `nombre` INT, IN `vitola` INT, IN `capa` INT, IN `tipo_empaque` INT, IN `item` INT)
BEGIN
 UPDATE pendiente_empaque SET
  pendiente_empaque.marca= marca,
  pendiente_empaque.nombre = nombre ,
 pendiente_empaque.capa = capa,
 pendiente_empaque.vitola = vitola,
 pendiente_empaque.tipo_empaque = tipo_empaque
 WHERE pendiente_empaque.id_pendiente = item;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.actualizar_pendiente_saldo_factura
DELIMITER //
CREATE PROCEDURE `actualizar_pendiente_saldo_factura`(IN `id` INT, IN `pa_saldo` INT)
BEGIN
   UPDATE pendiente SET pendiente.saldo =  IF((pendiente.saldo - pa_saldo)<0,0, pendiente.saldo - pa_saldo)  
	WHERE pendiente.id_pendiente = id AND pendiente.pendiente > 0;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.actualizar_pendiente_sampler
DELIMITER //
CREATE PROCEDURE `actualizar_pendiente_sampler`(IN `marca` INT, IN `nombre` INT, IN `vitola` INT, IN `capa` INT, IN `tipo_empaque` INT, IN `item` INT, IN `serie_precio` VARCHAR(50), IN `precio` VARCHAR(50))
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

-- Volcando estructura para procedimiento facturacion_plasencia.actualizar_productos
DELIMITER //
CREATE PROCEDURE `actualizar_productos`(IN `id` INT, IN `item` VARCHAR(50), IN `cod_producto` VARCHAR(50), IN `cod_caja` VARCHAR(50), IN `cod_precio` VARCHAR(50), IN `pa_precio` VARCHAR(50), IN `capa` VARCHAR(50), IN `vitola` VARCHAR(50), IN `nombre` VARCHAR(50), IN `marca` VARCHAR(50), IN `cello` VARCHAR(50), IN `anillo` VARCHAR(50), IN `upc` VARCHAR(50), IN `tipo_empaque` VARCHAR(50), IN `presentacion` VARCHAR(50), IN `sampler` VARCHAR(50), IN `descripcion` VARCHAR(100))
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

-- Volcando estructura para procedimiento facturacion_plasencia.actualizar_programacion
DELIMITER //
CREATE PROCEDURE `actualizar_programacion`(IN `id_pro` INT, IN `con` VARCHAR(50))
BEGIN

UPDATE prograamacion SET prograamacion.mes_contenedor = con WHERE prograamacion.id = id_pro;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.actualizar_saldo_programacion
DELIMITER //
CREATE PROCEDURE `actualizar_saldo_programacion`(IN `id_detalle` INT, IN `saldo` DECIMAL(8,2), IN `cant` INT, IN `id_pendiente` INT)
BEGIN




UPDATE detalle_programacion_temporal SET detalle_programacion_temporal.saldo = saldo,
detalle_programacion_temporal.cant_cajas = cant


WHERE detalle_programacion_temporal.id_detalle_programacion = id_detalle;


UPDATE lista_cajas SET lista_cajas.existencia = cant
WHERE (SELECT (SELECT  clase_productos.codigo_caja FROM clase_productos WHERE
			  clase_productos.item = pendiente_empaque.item  ) AS caja
 FROM pendiente_empaque WHERE pendiente_empaque.id_pendiente =id_pendiente) = lista_cajas.codigo;



END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.actualizar_tipo
DELIMITER //
CREATE PROCEDURE `actualizar_tipo`(IN `pa_id` VARCHAR(50), IN `pa_tipo` VARCHAR(50))
BEGIN
  UPDATE tipo_empaques
                SET
                      tipo_empaques.tipo_empaque = pa_tipo

                WHERE tipo_empaques.id_tipo_empaque = pa_id;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.actualizar_usuarios
DELIMITER //
CREATE PROCEDURE `actualizar_usuarios`(IN `pa_id` INT, IN `pa_codigo` INT, IN `pa_nombre` VARCHAR(50), IN `pa_rol` INT)
BEGIN
             UPDATE users
                SET
                      users.name = pa_nombre,
                      users.codigo = pa_codigo,
                      users.rol =pa_rol


                WHERE users.id = pa_id;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.actualizar_vitola
DELIMITER //
CREATE PROCEDURE `actualizar_vitola`(IN `pa_id` VARCHAR(50), IN `pa_vitola` VARCHAR(50))
BEGIN
  UPDATE vitola_productos
                SET
                      vitola_productos.vitola = pa_vitola

                WHERE vitola_productos.id_vitola = pa_id;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.agregar_lista_caja
DELIMITER //
CREATE PROCEDURE `agregar_lista_caja`(IN `pa_codigo` VARCHAR(50), IN `pa_producto` VARCHAR(255), IN `pa_marca` VARCHAR(50), IN `pa_existencia` INT)
BEGIN
INSERT INTO lista_cajas (lista_cajas.codigo,lista_cajas.productoServicio,lista_cajas.marca,lista_cajas.existencia)
 VALUES (pa_codigo,pa_producto,pa_marca,pa_existencia);
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.anadir_cajas_a_inventario
DELIMITER //
CREATE PROCEDURE `anadir_cajas_a_inventario`(IN `pa_codigo` VARCHAR(50), IN `pa_cantidad` INT)
BEGIN
      UPDATE lista_cajas
		 SET lista_cajas.existencia = lista_cajas.existencia + pa_cantidad
		 WHERE
     lista_cajas.codigo = pa_codigo;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.borrar_datos_existencia
DELIMITER //
CREATE PROCEDURE `borrar_datos_existencia`()
BEGIN
 DELETE FROM importar_existencias;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.borrar_pendientes
DELIMITER //
CREATE PROCEDURE `borrar_pendientes`(IN `id` INT)
BEGIN

DELETE FROM pendiente WHERE pendiente.id_pendiente = id;
DELETE FROM pendiente_empaque WHERE pendiente_empaque.id_pendiente_pedido = id;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.borrar_pendiente_empaque
DELIMITER //
CREATE PROCEDURE `borrar_pendiente_empaque`(IN `id` INT)
BEGIN

DELETE FROM pendiente_empaque WHERE pendiente_empaque.id_pendiente = id;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_capa
DELIMITER //
CREATE PROCEDURE `buscar_capa`(IN `capa` VARCHAR(50))
BEGIN

if capa = "" then

SELECT * FROM capa_productos ;
ELSE

SELECT * FROM capa_productos WHERE capa_productos.capa LIKE CONCAT("%",capa,"%");
END if;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_capa_empaque
DELIMITER //
CREATE PROCEDURE `buscar_capa_empaque`(IN `pa_uno` VARCHAR(50), IN `pa_dos` VARCHAR(50), IN `pa_tres` VARCHAR(50), IN `pa_cuatro` VARCHAR(50))
BEGIN
if pa_uno != "" || pa_dos != "" || pa_tres  != "" || pa_cuatro != ""
 then

SELECT DISTINCT (SELECT (UPPER(((SELECT capa_productos.capa FROM capa_productos WHERE capa_productos.id_capa = pendiente_empaque.capa))))) AS capa
FROM pendiente_empaque

	where  pendiente_empaque.categoria = pa_uno or
pendiente_empaque.categoria = pa_dos  or
pendiente_empaque.categoria = pa_tres or
pendiente_empaque.categoria = pa_cuatro ;

ELSE

SELECT DISTINCT (SELECT (UPPER(((SELECT capa_productos.capa FROM capa_productos WHERE capa_productos.id_capa = pendiente_empaque.capa))))) AS capa
FROM pendiente_empaque;
END if;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_capa_pendiente
DELIMITER //
CREATE PROCEDURE `buscar_capa_pendiente`(IN `pa_uno` VARCHAR(50), IN `pa_dos` VARCHAR(50), IN `pa_tres` VARCHAR(50), IN `pa_cuatro` VARCHAR(50))
BEGIN
if pa_uno != "" || pa_dos != "" || pa_tres  != "" || pa_cuatro != ""
 then

SELECT DISTINCT (SELECT (UPPER(((SELECT capa_productos.capa FROM capa_productos WHERE capa_productos.id_capa = pendiente.capa))))) AS capa
FROM pendiente

	where  pendiente.categoria = pa_uno or
pendiente.categoria = pa_dos  or
pendiente.categoria = pa_tres or
pendiente.categoria = pa_cuatro ;

ELSE

SELECT DISTINCT (SELECT (UPPER(((SELECT capa_productos.capa FROM capa_productos WHERE capa_productos.id_capa = pendiente.capa))))) AS capa
FROM pendiente ;
END if;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_existencia
DELIMITER //
CREATE PROCEDURE `buscar_existencia`(IN `busqueda` VARCHAR(50))
BEGIN

 if busqueda = ""  then
  SELECT importar_existencias.id , importar_existencias.codigo_producto ,
importar_existencias.marca,importar_existencias.nombre, importar_existencias.vitola,importar_existencias.capa
, importar_existencias.total
from  importar_existencias;

ELSE

  SELECT importar_existencias.id , importar_existencias.codigo_producto ,
importar_existencias.marca,importar_existencias.nombre, importar_existencias.vitola,importar_existencias.capa
, importar_existencias.total
from  importar_existencias
WHERE (importar_existencias.marca LIKE CONCAT("%",busqueda,"%") || importar_existencias.nombre LIKE CONCAT("%",busqueda,"%") ||
importar_existencias.capa LIKE CONCAT("%",busqueda,"%") );
END if;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_fechas_pendiente
DELIMITER //
CREATE PROCEDURE `buscar_fechas_pendiente`(IN `pa_uno` VARCHAR(50), IN `pa_dos` VARCHAR(50), IN `pa_tres` VARCHAR(50), IN `pa_cuatro` VARCHAR(50))
BEGIN
if pa_uno != "" || pa_dos != "" || pa_tres  != "" || pa_cuatro != ""
 then

SELECT DISTINCT mes
FROM pendiente
	where  pendiente.categoria = pa_uno or
pendiente.categoria = pa_dos  or
pendiente.categoria = pa_tres or
pendiente.categoria = pa_cuatro ;

ELSE

SELECT DISTINCT mes
FROM pendiente ;
END if;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_fecha_empaque
DELIMITER //
CREATE PROCEDURE `buscar_fecha_empaque`(IN `pa_uno` VARCHAR(50), IN `pa_dos` VARCHAR(50), IN `pa_tres` VARCHAR(50), IN `pa_cuatro` VARCHAR(50))
BEGIN
if pa_uno != "" || pa_dos != "" || pa_tres  != "" || pa_cuatro != ""
 then

SELECT DISTINCT mes
FROM pendiente_empaque
	where  pendiente_empaque.categoria = pa_uno or
pendiente_empaque.categoria = pa_dos  or
pendiente_empaque.categoria = pa_tres or
pendiente_empaque.categoria = pa_cuatro ;

ELSE

SELECT DISTINCT mes
FROM pendiente_empaque ;
END if;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_hons_empaque
DELIMITER //
CREATE PROCEDURE `buscar_hons_empaque`(IN `pa_uno` VARCHAR(50), IN `pa_dos` VARCHAR(50), IN `pa_tres` VARCHAR(50), IN `pa_cuatro` VARCHAR(50))
BEGIN
if pa_uno != "" || pa_dos != "" || pa_tres  != "" || pa_cuatro != ""
 then

	SELECT DISTINCT pendiente_empaque.orden
FROM pendiente_empaque
	where  pendiente_empaque.categoria = pa_uno or
pendiente_empaque.categoria = pa_dos  or
pendiente_empaque.categoria = pa_tres or
pendiente_empaque.categoria = pa_cuatro ;

ELSE

SELECT DISTINCT pendiente_empaque.orden
FROM pendiente_empaque ;
END if;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_hons_pendiente
DELIMITER //
CREATE PROCEDURE `buscar_hons_pendiente`(IN `pa_uno` VARCHAR(50), IN `pa_dos` VARCHAR(50), IN `pa_tres` VARCHAR(50), IN `pa_cuatro` VARCHAR(50))
BEGIN
if pa_uno != "" || pa_dos != "" || pa_tres  != "" || pa_cuatro != ""
 then

	SELECT DISTINCT pendiente.orden
FROM pendiente
	where  pendiente.categoria = pa_uno or
pendiente.categoria = pa_dos  or
pendiente.categoria = pa_tres or
pendiente.categoria = pa_cuatro ;

ELSE

SELECT DISTINCT pendiente.orden
FROM pendiente ;
END if;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_item_empaque
DELIMITER //
CREATE PROCEDURE `buscar_item_empaque`(IN `pa_uno` VARCHAR(50), IN `pa_dos` VARCHAR(50), IN `pa_tres` VARCHAR(50), IN `pa_cuatro` VARCHAR(50))
BEGIN
if pa_uno != "" || pa_dos != "" || pa_tres  != "" || pa_cuatro != ""
 then

SELECT DISTINCT item
FROM pendiente_empaque
	where  pendiente_empaque.categoria = pa_uno or
pendiente_empaque.categoria = pa_dos  or
pendiente_empaque.categoria = pa_tres or
pendiente_empaque.categoria = pa_cuatro ;

ELSE

SELECT DISTINCT item
FROM pendiente_empaque ;
END if;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_item_pendiente
DELIMITER //
CREATE PROCEDURE `buscar_item_pendiente`(IN `pa_uno` VARCHAR(50), IN `pa_dos` VARCHAR(50), IN `pa_tres` VARCHAR(50), IN `pa_cuatro` VARCHAR(50))
BEGIN
if pa_uno != "" || pa_dos != "" || pa_tres  != "" || pa_cuatro != ""
 then


SELECT DISTINCT item AS item
FROM pendiente
	where  pendiente.categoria = pa_uno or
pendiente.categoria = pa_dos  or
pendiente.categoria = pa_tres or
pendiente.categoria = pa_cuatro ;

ELSE
SELECT DISTINCT item AS item
FROM pendiente ;
END if;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_listadecajas
DELIMITER //
CREATE PROCEDURE `buscar_listadecajas`(IN `buscar` VARCHAR(50))
BEGIN
if buscar=""then
 SELECT lista_cajas.id,lista_cajas.codigo,lista_cajas.productoServicio,lista_cajas.marca, lista_cajas.existencia FROM lista_cajas;

 else

 SELECT lista_cajas.id,lista_cajas.codigo,lista_cajas.productoServicio,lista_cajas.marca, lista_cajas.existencia
  FROM lista_cajas
 WHERE lista_cajas.codigo LIKE CONCAT("%",buscar,"%") or lista_cajas.productoServicio LIKE CONCAT("%",buscar,"%")
 or lista_cajas.marca LIKE CONCAT("%",buscar,"%");

 END if;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_lista_cajas
DELIMITER //
CREATE PROCEDURE `buscar_lista_cajas`(IN `pa_nombre` VARCHAR(50))
BEGIN
SELECT lista_cajas.codigo,lista_cajas.productoServicio,lista_cajas.marca, lista_cajas.id,lista_cajas.existencia
FROM lista_cajas
WHERE lista_cajas.codigo LIKE CONCAT("%",pa_nombre,"%") OR
lista_cajas.productoServicio LIKE CONCAT("%",pa_nombre,"%") OR
lista_cajas.marca LIKE CONCAT("%",pa_nombre,"%") ;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_marca
DELIMITER //
CREATE PROCEDURE `buscar_marca`(IN `marca` VARCHAR(50))
BEGIN
  IF marca = ""  THEN
  SELECT * FROM marca_productos ;

ELSE
SELECT * FROM marca_productos WHERE marca_productos.marca  like CONCAT("%",marca,"%");

END if;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_marca_empaque
DELIMITER //
CREATE PROCEDURE `buscar_marca_empaque`(IN `pa_uno` VARCHAR(50), IN `pa_dos` VARCHAR(50), IN `pa_tres` VARCHAR(50), IN `pa_cuatro` VARCHAR(50))
BEGIN
if pa_uno != "" || pa_dos != "" || pa_tres  != "" || pa_cuatro != ""
 then

	SELECT DISTINCT (SELECT (UPPER(((SELECT marca_productos.marca FROM marca_productos WHERE marca_productos.id_marca = pendiente_empaque.marca))))) AS marca
FROM pendiente_empaque
	where  pendiente_empaque.categoria = pa_uno or
pendiente_empaque.categoria = pa_dos  or
pendiente_empaque.categoria = pa_tres or
pendiente_empaque.categoria = pa_cuatro ;

ELSE

	SELECT DISTINCT (SELECT (UPPER(((SELECT marca_productos.marca FROM marca_productos WHERE marca_productos.id_marca = pendiente_empaque.marca))))) AS marca
FROM pendiente_empaque;
END if;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_marca_pendiente
DELIMITER //
CREATE PROCEDURE `buscar_marca_pendiente`(IN `pa_uno` VARCHAR(50), IN `pa_dos` VARCHAR(50), IN `pa_tres` VARCHAR(50), IN `pa_cuatro` VARCHAR(50))
BEGIN
if pa_uno != "" || pa_dos != "" || pa_tres  != "" || pa_cuatro != ""
 then

	SELECT DISTINCT (SELECT (UPPER(((SELECT marca_productos.marca FROM marca_productos WHERE marca_productos.id_marca = pendiente.marca))))) AS marca
	FROM pendiente
	where  pendiente.categoria = pa_uno or
pendiente.categoria = pa_dos  or
pendiente.categoria = pa_tres or
pendiente.categoria = pa_cuatro ;

ELSE

	SELECT DISTINCT (SELECT (UPPER(((SELECT marca_productos.marca FROM marca_productos WHERE marca_productos.id_marca = pendiente.marca))))) AS marca
	FROM pendiente;
END if;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_nombre
DELIMITER //
CREATE PROCEDURE `buscar_nombre`(IN `nombre` VARCHAR(50))
BEGIN
if nombre = "" then
SELECT * FROM nombre_productos;

ELSE

SELECT * FROM nombre_productos WHERE nombre_productos.nombre  like CONCAT("%",nombre,"%");
END if;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_nombre_empaque
DELIMITER //
CREATE PROCEDURE `buscar_nombre_empaque`(IN `pa_uno` VARCHAR(50), IN `pa_dos` VARCHAR(50), IN `pa_tres` VARCHAR(50), IN `pa_cuatro` VARCHAR(50))
BEGIN
if pa_uno != "" || pa_dos != "" || pa_tres  != "" || pa_cuatro != ""
 then
 SELECT DISTINCT (SELECT (UPPER(((SELECT nombre_productos.nombre FROM nombre_productos WHERE nombre_productos.id_nombre = pendiente_empaque.nombre))))) AS nombre
FROM pendiente_empaque
	where  pendiente_empaque.categoria = pa_uno or
pendiente_empaque.categoria = pa_dos  or
pendiente_empaque.categoria = pa_tres or
pendiente_empaque.categoria = pa_cuatro ;

ELSE

SELECT DISTINCT (SELECT (UPPER(((SELECT nombre_productos.nombre FROM nombre_productos WHERE nombre_productos.id_nombre = pendiente_empaque.nombre))))) AS nombre
FROM pendiente_empaque ;
END if;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_nombre_pendiente
DELIMITER //
CREATE PROCEDURE `buscar_nombre_pendiente`(IN `pa_uno` VARCHAR(50), IN `pa_dos` VARCHAR(50), IN `pa_tres` VARCHAR(50), IN `pa_cuatro` VARCHAR(50))
BEGIN
if pa_uno != "" || pa_dos != "" || pa_tres  != "" || pa_cuatro != ""
 then
 SELECT DISTINCT (SELECT (UPPER(((SELECT nombre_productos.nombre FROM nombre_productos WHERE nombre_productos.id_nombre = pendiente.nombre))))) AS nombre
FROM pendiente
	where  pendiente.categoria = pa_uno or
pendiente.categoria = pa_dos  or
pendiente.categoria = pa_tres or
pendiente.categoria = pa_cuatro ;

ELSE

SELECT DISTINCT (SELECT (UPPER(((SELECT nombre_productos.nombre FROM nombre_productos WHERE nombre_productos.id_nombre = pendiente.nombre))))) AS nombre
FROM pendiente;
END if;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_ordenes_empaque
DELIMITER //
CREATE PROCEDURE `buscar_ordenes_empaque`(IN `pa_uno` VARCHAR(50), IN `pa_dos` VARCHAR(50), IN `pa_tres` VARCHAR(50), IN `pa_cuatro` VARCHAR(50))
BEGIN
if pa_uno != "" || pa_dos != "" || pa_tres  != "" || pa_cuatro != ""
 then

SELECT DISTINCT pendiente_empaque.orden_del_sitema
FROM pendiente_empaque

	where  pendiente_empaque.categoria = pa_uno or
pendiente_empaque.categoria = pa_dos  or
pendiente_empaque.categoria = pa_tres or
pendiente_empaque.categoria = pa_cuatro ;

ELSE

SELECT DISTINCT pendiente_empaque.orden_del_sitema
FROM pendiente_empaque;
END if;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_ordenes_pendiente
DELIMITER //
CREATE PROCEDURE `buscar_ordenes_pendiente`(IN `pa_uno` VARCHAR(50), IN `pa_dos` VARCHAR(50), IN `pa_tres` VARCHAR(50), IN `pa_cuatro` VARCHAR(50))
BEGIN
if pa_uno != "" || pa_dos != "" || pa_tres  != "" || pa_cuatro != ""
 then

SELECT DISTINCT pendiente.orden_del_sitema
FROM pendiente

	where  pendiente.categoria = pa_uno or
pendiente.categoria = pa_dos  or
pendiente.categoria = pa_tres or
pendiente.categoria = pa_cuatro ;

ELSE

SELECT DISTINCT pendiente.orden_del_sitema
FROM pendiente ;
END if;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_pedidos
DELIMITER //
CREATE PROCEDURE `buscar_pedidos`(IN `pa_item` TEXT, IN `pa_categoria` TEXT, IN `pa_numero_orden` TEXT)
BEGIN

SELECT (SELECT categoria.categoria FROM categoria WHERE categoria.id_categoria
		 = pedidos.categoria) AS categorias,
		pedidos.item,
		pedidos.cant_paquetes,
		pedidos.unidades,
		pedidos.numero_orden,
		(SELECT

		 (CONCAT( (SELECT tipo_empaques.tipo_empaque from tipo_empaques WHERE tipo_empaques.id_tipo_empaque = clase_productos.id_tipo_empaque)," ",
					(SELECT marca_productos.marca from marca_productos WHERE marca_productos.id_marca =clase_productos.id_marca)," ",
					(SELECT nombre_productos.nombre from nombre_productos WHERE nombre_productos.id_nombre =clase_productos.id_nombre)," ",
					(SELECT capa_productos.capa from capa_productos WHERE capa_productos.id_capa =clase_productos.id_capa)," ",
					(SELECT vitola_productos.vitola from vitola_productos WHERE vitola_productos.id_vitola =clase_productos.id_vitola)))


		 	 AS des FROM clase_productos WHERE clase_productos.item = pedidos.item) AS descripcion,
	    (pedidos.cant_paquetes*pedidos.unidades) AS total

FROM pedidos
WHERE pedidos.item LIKE CONCAT("%",pa_item,"%")
		AND (SELECT categoria.categoria FROM categoria WHERE categoria.id_categoria = pedidos.categoria) LIKE CONCAT("%",pa_categoria,"%")
		AND pedidos.numero_orden LIKE CONCAT("%",pa_numero_orden,"%")
ORDER BY id ;





END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_pendiente
DELIMITER //
CREATE PROCEDURE `buscar_pendiente`(IN `pa_uno` VARCHAR(50), IN `pa_dos` VARCHAR(50), IN `pa_tres` VARCHAR(50), IN `pa_cuatro` VARCHAR(50), IN `pa_cinco` VARCHAR(50))
BEGIN

if pa_uno != "" || pa_dos != "" || pa_tres  != "" || pa_cuatro != "" || pa_cinco != ""
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
       (SELECT

		if( clase_productos.sampler = "si", pendiente.serie_precio , (select clase_productos.codigo_precio FROM clase_productos WHERE clase_productos.item = pendiente.item) ) AS des FROM clase_productos WHERE clase_productos.item = pendiente.item)
		 AS serie_precio,
         (SELECT

		if( clase_productos.sampler = "si", pendiente.precio ,(select clase_productos.precio FROM clase_productos WHERE clase_productos.item = pendiente.item) ) AS des FROM clase_productos WHERE clase_productos.item = pendiente.item)

		AS precio

FROM  pendiente
WHERE (pendiente.categoria = pa_uno or
pendiente.categoria = pa_dos  or
pendiente.categoria = pa_tres or
pendiente.categoria = pa_cuatro or
(SELECT clase_productos.presentacion FROM clase_productos WHERE clase_productos.item = pendiente.item) = pa_cinco) AND pendiente.saldo > 0 or (SELECT SUM(saldo) FROM pendiente p WHERE p.orden = pendiente.orden AND
										p.mes = pendiente.mes AND p.item = pendiente.item) > 0

		ORDER BY pendiente.id_pendiente;


 else



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

		AS precio


FROM  pendiente
WHERE  pendiente.saldo > 0 or (SELECT SUM(saldo) FROM pendiente p WHERE p.orden = pendiente.orden AND
										p.mes = pendiente.mes AND p.item = pendiente.item) > 0

		ORDER BY pendiente.id_pendiente;
END if;


END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_pendiente_capa
DELIMITER //
CREATE PROCEDURE `buscar_pendiente_capa`()
BEGIN


SELECT DISTINCT
		(SELECT capa_productos.capa FROM  capa_productos WHERE capa_productos.id_capa = pendiente.capa	) AS capa
FROM pendiente
WHERE  (pendiente.saldo > 0 or (SELECT SUM(saldo) FROM pendiente p WHERE p.orden = pendiente.orden AND
										p.mes = pendiente.mes AND p.item = pendiente.item) > 0)
ORDER BY (SELECT capa_productos.capa FROM  capa_productos WHERE capa_productos.id_capa = pendiente.capa	) ASC;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_pendiente_empaque
DELIMITER //
CREATE PROCEDURE `buscar_pendiente_empaque`(IN `pa_uno` VARCHAR(50), IN `pa_dos` VARCHAR(50), IN `pa_tres` VARCHAR(50), IN `pa_cuatro` VARCHAR(50))
BEGIN

if pa_uno != "" || pa_dos != "" || pa_tres  != "" || pa_cuatro != ""
 then

SELECT pendiente_empaque.id_pendiente ,
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
WHERE ((pendiente_empaque.saldo != 0 or (SELECT sampler FROM clase_productos WHERE clase_productos.item = pendiente_empaque.item)= 'si')
 AND
(pendiente_empaque.categoria = pa_uno or
pendiente_empaque.categoria = pa_dos  or
pendiente_empaque.categoria = pa_tres or
pendiente_empaque.categoria = pa_cuatro) ) AND pendiente_empaque.saldo > 0 or (SELECT SUM(saldo) FROM pendiente_empaque p WHERE p.orden = pendiente_empaque.orden AND
										p.mes = pendiente_empaque.mes AND p.item = pendiente_empaque.item) > 0

		ORDER BY pendiente_empaque.id_pendiente;

ELSE

SELECT pendiente_empaque.id_pendiente ,
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
WHERE  pendiente_empaque.saldo > 0 or (SELECT SUM(saldo) FROM pendiente_empaque p WHERE p.orden = pendiente_empaque.orden AND
										p.mes = pendiente_empaque.mes AND p.item = pendiente_empaque.item) > 0



		ORDER BY pendiente_empaque.id_pendiente;
END if;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_pendiente_empaque_excel
DELIMITER //
CREATE PROCEDURE `buscar_pendiente_empaque_excel`(IN `pa_uno` VARCHAR(50), IN `pa_dos` VARCHAR(50), IN `pa_tres` VARCHAR(50), IN `pa_cuatro` VARCHAR(50), IN `pa_item` VARCHAR(50), IN `pa_orden` VARCHAR(50), IN `pa_hon` VARCHAR(50), IN `pa_marca` VARCHAR(50), IN `pa_vitola` VARCHAR(50), IN `pa_nombre` VARCHAR(50), IN `pa_capa` VARCHAR(50), IN `pa_empaque` VARCHAR(50), IN `pa_mes` VARCHAR(50))
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
((pendiente_empaque.categoria) = pa_dos) OR
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
((pendiente_empaque.mes)like CONCAT("%",pa_mes, "%")) AND ( pendiente_empaque.saldo > 0 or (SELECT SUM(saldo) FROM pendiente_empaque p WHERE p.orden = pendiente_empaque.orden AND
										p.mes = pendiente_empaque.mes AND p.item = pendiente_empaque.item) > 0)
		ORDER BY pendiente_empaque.id_pendiente;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_pendiente_empaque_excel2
DELIMITER //
CREATE PROCEDURE `buscar_pendiente_empaque_excel2`(IN `pa_uno` VARCHAR(50), IN `pa_dos` VARCHAR(50), IN `pa_tres` VARCHAR(50), IN `pa_cuatro` VARCHAR(50), IN `pa_item` VARCHAR(50), IN `pa_orden` VARCHAR(50), IN `pa_hon` VARCHAR(50), IN `pa_marca` VARCHAR(50), IN `pa_vitola` VARCHAR(50), IN `pa_nombre` VARCHAR(50), IN `pa_capa` VARCHAR(50), IN `pa_empaque` VARCHAR(50), IN `pa_mes` VARCHAR(50))
BEGIN

SELECT
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
		pendiente_empaque.unidades AS unidades
FROM  pendiente_empaque
WHERE (
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
((pendiente_empaque.mes)like CONCAT("%",pa_mes, "%"))) AND pendiente_empaque.saldo > 0 or (SELECT SUM(saldo) FROM pendiente_empaque p WHERE p.orden = pendiente_empaque.orden AND
										p.mes = pendiente_empaque.mes AND p.item = pendiente_empaque.item) > 0
		ORDER BY pendiente_empaque.id_pendiente;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_pendiente_excel
DELIMITER //
CREATE PROCEDURE `buscar_pendiente_excel`(IN `pa_uno` VARCHAR(50), IN `pa_dos` VARCHAR(50), IN `pa_tres` VARCHAR(50), IN `pa_cuatro` VARCHAR(50), IN `pa_pres` VARCHAR(50), IN `pa_item` VARCHAR(50), IN `pa_orden` VARCHAR(50), IN `pa_hon` VARCHAR(50), IN `pa_marca` VARCHAR(50), IN `pa_vitola` VARCHAR(50), IN `pa_nombre` VARCHAR(50), IN `pa_capa` VARCHAR(50), IN `pa_empaque` VARCHAR(50), IN `pa_mes` VARCHAR(50))
BEGIN
SELECT
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

		AS precio

FROM  pendiente
WHERE (
(( (pendiente.categoria) = pa_uno) OR
((pendiente.categoria) =pa_dos) OR
((pendiente.categoria) = pa_tres) or
((pendiente.categoria) = pa_cuatro) )AND
((SELECT clase_productos.presentacion FROM clase_productos WHERE clase_productos.item = pendiente.item) like CONCAT("%",pa_pres,"%")) AND
((pendiente.item) like CONCAT("%",pa_item,"%")) AND
((pendiente.orden_del_sitema) like CONCAT("%",pa_orden,"%")) AND
((pendiente.orden) like CONCAT("%",pa_hon,"%")) AND
((SELECT if( clase_productos.sampler = "si", CONCAT((SELECT clase_productos.descripcion_sampler FROM clase_productos WHERE clase_productos.item = pendiente.item)," ",(SELECT marca_productos.marca  FROM marca_productos WHERE marca_productos.id_marca = pendiente.marca)),
			(SELECT marca_productos.marca  FROM marca_productos WHERE marca_productos.id_marca = pendiente.marca)
			) AS des FROM clase_productos WHERE clase_productos.item = pendiente.item) like CONCAT("%",pa_marca, "%")) and
((SELECT vitola_productos.vitola FROM  vitola_productos WHERE vitola_productos.id_vitola = pendiente.vitola	) like CONCAT("%", pa_vitola , "%"))  and
((SELECT nombre_productos.nombre FROM  nombre_productos WHERE nombre_productos.id_nombre = pendiente.nombre	)  like CONCAT("%",pa_nombre, "%")) AND
((SELECT capa_productos.capa FROM  capa_productos WHERE capa_productos.id_capa = pendiente.capa	)  like CONCAT("%",pa_capa, "%"))  and
((SELECT tipo_empaques.tipo_empaque FROM  tipo_empaques WHERE tipo_empaques.id_tipo_empaque = pendiente.tipo_empaque	)  like CONCAT("%",pa_empaque, "%")) AND
((pendiente.mes)like CONCAT("%",pa_mes, "%"))) AND pendiente.saldo > 0 or (SELECT SUM(saldo) FROM pendiente p WHERE p.orden = pendiente.orden AND
										p.mes = pendiente.mes AND p.item = pendiente.item) > 0

		ORDER BY pendiente.id_pendiente;


END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_pendiente_factura
DELIMITER //
CREATE PROCEDURE `buscar_pendiente_factura`(IN `pa_sistema` VARCHAR(10), IN `fechade` VARCHAR(50), IN `pa_item` VARCHAR(50), IN `pa_orden` VARCHAR(50), IN `pa_tipo_factura` CHAR(10))
BEGIN

DECLARE fechames varchar(50);
DECLARE tipo_factura VARCHAR(50);
if fechade != ""  then
SET lc_time_names = 'es_ES';
SET fechames = if(fechade IS NULL, "" ,(SELECT UPPER( CONCAT( MONTHNAME( STR_TO_DATE(fechade,'%Y-%m-%d'))," ",year(STR_TO_DATE(fechade,'%Y-%m-%d'))))));
ELSE
SET fechames = "";

END if;

SET tipo_factura = (case pa_tipo_factura
			 	when "RP"  then  "HON"
			 	when "FM"  then  "FTT"
			 	when "WH"  then  "INT-N"
			 	when "Aerea"  then  ""
		 	END );



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
		(select clase_productos.precio FROM clase_productos WHERE clase_productos.item = pendiente.item) AS precio,

		0 AS PT,
		
		(	(SELECT

		if( clase_productos.sampler = "si", (SELECT CONCAT((select tipo_empaque_ingles from tipo_empaques where id_tipo_empaque = pendiente.tipo_empaque)," ",descripcion_sampler)
                                FROM clase_productos
                                WHERE  clase_productos.item = pendiente.item),
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
	WHERE clase_productos.item = pendiente.item 
	)
						                     	) AS des FROM clase_productos WHERE clase_productos.item = pendiente.item) ) AS descripcion_produto
FROM pendiente
WHERE (pendiente.item LIKE CONCAT("%",pa_item,"%")
		AND pendiente.mes LIKE CONCAT("%",fechames,"%")
		AND pendiente.orden LIKE CONCAT("%",pa_orden,"%")
		AND pendiente.orden_del_sitema LIKE CONCAT("%",pa_sistema,"%")) AND (pendiente.saldo > 0 or (SELECT SUM(saldo) FROM pendiente p WHERE p.orden = pendiente.orden AND
										p.mes = pendiente.mes AND p.item = pendiente.item) > 0)
ORDER BY pendiente.id_pendiente;



END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_pendiente_item
DELIMITER //
CREATE PROCEDURE `buscar_pendiente_item`()
BEGIN


SELECT DISTINCT pendiente.item
FROM pendiente
WHERE (pendiente.saldo > 0 or (SELECT SUM(saldo) FROM pendiente p WHERE p.orden = pendiente.orden AND
										p.mes = pendiente.mes AND p.item = pendiente.item) > 0)
ORDER BY pendiente.item asc;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_pendiente_marca
DELIMITER //
CREATE PROCEDURE `buscar_pendiente_marca`()
BEGIN
 

SELECT DISTINCT
	(SELECT

		if( clase_productos.sampler = "si", CONCAT((SELECT clase_productos.descripcion_sampler FROM clase_productos WHERE clase_productos.item = pendiente.item)," ",(SELECT marca_productos.marca  FROM marca_productos WHERE marca_productos.id_marca = pendiente.marca)),
														(SELECT marca_productos.marca  FROM marca_productos WHERE marca_productos.id_marca = pendiente.marca)
						                     	) AS des FROM clase_productos WHERE clase_productos.item = pendiente.item) AS marca
FROM pendiente
WHERE  (pendiente.saldo > 0 or (SELECT SUM(saldo) FROM pendiente p WHERE p.orden = pendiente.orden AND
										p.mes = pendiente.mes AND p.item = pendiente.item) > 0)
ORDER BY (SELECT

		if( clase_productos.sampler = "si", CONCAT((SELECT clase_productos.descripcion_sampler FROM clase_productos WHERE clase_productos.item = pendiente.item)," ",(SELECT marca_productos.marca  FROM marca_productos WHERE marca_productos.id_marca = pendiente.marca)),
														(SELECT marca_productos.marca  FROM marca_productos WHERE marca_productos.id_marca = pendiente.marca)
						                     	) AS des FROM clase_productos WHERE clase_productos.item = pendiente.item) ASC;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_pendiente_meses
DELIMITER //
CREATE PROCEDURE `buscar_pendiente_meses`()
BEGIN


SELECT DISTINCT pendiente.mes
		 
FROM pendiente
WHERE  (pendiente.saldo > 0 or (SELECT SUM(saldo) FROM pendiente p WHERE p.orden = pendiente.orden AND
										p.mes = pendiente.mes AND p.item = pendiente.item) > 0)
ORDER BY pendiente.mes ASC;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_pendiente_nombre
DELIMITER //
CREATE PROCEDURE `buscar_pendiente_nombre`()
BEGIN
SELECT DISTINCT 
		(SELECT nombre_productos.nombre FROM  nombre_productos WHERE nombre_productos.id_nombre = pendiente.nombre	) AS nombre
FROM pendiente
WHERE  (pendiente.saldo > 0 or (SELECT SUM(saldo) FROM pendiente p WHERE p.orden = pendiente.orden AND
										p.mes = pendiente.mes AND p.item = pendiente.item) > 0)
ORDER BY (SELECT nombre_productos.nombre FROM  nombre_productos WHERE nombre_productos.id_nombre = pendiente.nombre	) ASC;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_pendiente_orden_pedido
DELIMITER //
CREATE PROCEDURE `buscar_pendiente_orden_pedido`()
BEGIN

SELECT DISTINCT

		 pendiente.orden
FROM pendiente
WHERE  (pendiente.saldo > 0 or (SELECT SUM(saldo) FROM pendiente p WHERE p.orden = pendiente.orden AND
										p.mes = pendiente.mes AND p.item = pendiente.item) > 0)
										
ORDER BY pendiente.orden ASC;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_pendiente_orden_sistema
DELIMITER //
CREATE PROCEDURE `buscar_pendiente_orden_sistema`()
BEGIN


SELECT DISTINCT 
		 pendiente.orden_del_sitema
FROM pendiente
WHERE  (pendiente.saldo > 0 or (SELECT SUM(saldo) FROM pendiente p WHERE p.orden = pendiente.orden AND
										p.mes = pendiente.mes AND p.item = pendiente.item) > 0)
ORDER BY pendiente.orden_del_sitema ASC;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_pendiente_tipo_empaque
DELIMITER //
CREATE PROCEDURE `buscar_pendiente_tipo_empaque`()
BEGIN


SELECT DISTINCT
      (SELECT tipo_empaques.tipo_empaque FROM  tipo_empaques WHERE tipo_empaques.id_tipo_empaque = pendiente.tipo_empaque) AS tipo_empaque
FROM pendiente
WHERE  (pendiente.saldo > 0 or (SELECT SUM(saldo) FROM pendiente p WHERE p.orden = pendiente.orden AND
										p.mes = pendiente.mes AND p.item = pendiente.item) > 0)
ORDER BY (SELECT tipo_empaques.tipo_empaque FROM  tipo_empaques WHERE tipo_empaques.id_tipo_empaque = pendiente.tipo_empaque) ASC;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_pendiente_vitola
DELIMITER //
CREATE PROCEDURE `buscar_pendiente_vitola`()
BEGIN
	

SELECT DISTINCT
		(SELECT vitola_productos.vitola FROM  vitola_productos WHERE vitola_productos.id_vitola = pendiente.vitola) AS vitola
FROM pendiente
WHERE  (pendiente.saldo > 0 or (SELECT SUM(saldo) FROM pendiente p WHERE p.orden = pendiente.orden AND
										p.mes = pendiente.mes AND p.item = pendiente.item) > 0)
ORDER BY (SELECT vitola_productos.vitola FROM  vitola_productos WHERE vitola_productos.id_vitola = pendiente.vitola) ASC;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_producto
DELIMITER //
CREATE PROCEDURE `buscar_producto`(IN `todo` VARCHAR(50))
BEGIN


 SELECT clase_productos.id_producto,
 			(SELECT capa_productos.capa FROM capa_productos WHERE capa_productos.id_capa = clase_productos.id_capa	) AS capa,
			 clase_productos.item,clase_productos.codigo_producto,clase_productos.codigo_caja,clase_productos.codigo_precio,
 clase_productos.presentacion,

 			(SELECT cellos.anillo AS anillo FROM cellos WHERE cellos.id_cello = clase_productos.id_cello) AS anillo,
		(SELECT cellos.cello AS cello FROM cellos WHERE cellos.id_cello = clase_productos.id_cello) AS cello,
		(SELECT cellos.upc AS upc FROM cellos WHERE cellos.id_cello = clase_productos.id_cello) AS upc,


		(SELECT marca_productos.marca FROM marca_productos WHERE marca_productos.id_marca = clase_productos.id_marca	) AS marca,

		(SELECT vitola_productos.vitola FROM  vitola_productos WHERE vitola_productos.id_vitola = clase_productos.id_vitola	) AS vitola,
		 (SELECT nombre_productos.nombre FROM  nombre_productos WHERE nombre_productos.id_nombre = clase_productos.id_nombre	) AS nombre,



		  (SELECT tipo_empaques.tipo_empaque FROM  tipo_empaques WHERE tipo_empaques.id_tipo_empaque = clase_productos.id_tipo_empaque	) AS tipo_empaque,


		  clase_productos.sampler, clase_productos.descripcion_sampler AS des,
		  clase_productos.precio
FROM clase_productos
WHERE   (SELECT nombre_productos.nombre FROM  nombre_productos WHERE nombre_productos.id_nombre = clase_productos.id_nombrE) LIKE  CONCAT("%",todo,"%")
		|| (SELECT marca_productos.marca FROM marca_productos WHERE marca_productos.id_marca = clase_productos.id_marca) LIKE  CONCAT("%",todo,"%")
		|| clase_productos.item LIKE  CONCAT("%",todo,"%")
		|| (SELECT vitola_productos.vitola FROM  vitola_productos WHERE vitola_productos.id_vitola = clase_productos.id_vitola) LIKE  CONCAT("%",todo,"%");




END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_tipo_empaque
DELIMITER //
CREATE PROCEDURE `buscar_tipo_empaque`(IN `tipo` VARCHAR(50))
BEGIN
if tipo =""then
SELECT * FROM tipo_empaques ;
else
SELECT * FROM tipo_empaques WHERE tipo_empaques.tipo_empaque  like CONCAT("%",tipo,"%");
END if;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_tipo_empaque_empaque
DELIMITER //
CREATE PROCEDURE `buscar_tipo_empaque_empaque`(IN `pa_uno` VARCHAR(50), IN `pa_dos` VARCHAR(50), IN `pa_tres` VARCHAR(50), IN `pa_cuatro` VARCHAR(50))
BEGIN
if pa_uno != "" || pa_dos != "" || pa_tres  != "" || pa_cuatro != ""
 then

SELECT DISTINCT (SELECT (UPPER(((SELECT tipo_empaques.tipo_empaque FROM tipo_empaques WHERE tipo_empaques.id_tipo_empaque = pendiente_empaque.tipo_empaque))))) AS empaque
FROM pendiente_empaque

	where  pendiente_empaque.categoria = pa_uno or
pendiente_empaque.categoria = pa_dos  or
pendiente_empaque.categoria = pa_tres or
pendiente_empaque.categoria = pa_cuatro ;

ELSE

SELECT DISTINCT (SELECT (UPPER(((SELECT tipo_empaques.tipo_empaque FROM tipo_empaques WHERE tipo_empaques.id_tipo_empaque = pendiente_empaque.tipo_empaque))))) AS empaque
FROM pendiente_empaque ;
END if;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_tipo_empaque_pendiente
DELIMITER //
CREATE PROCEDURE `buscar_tipo_empaque_pendiente`(IN `pa_uno` VARCHAR(50), IN `pa_dos` VARCHAR(50), IN `pa_tres` VARCHAR(50), IN `pa_cuatro` VARCHAR(50))
BEGIN
if pa_uno != "" || pa_dos != "" || pa_tres  != "" || pa_cuatro != ""
 then

SELECT DISTINCT (SELECT (UPPER(((SELECT tipo_empaques.tipo_empaque FROM tipo_empaques WHERE tipo_empaques.id_tipo_empaque = pendiente.tipo_empaque))))) AS empaque
FROM pendiente

	where  pendiente.categoria = pa_uno or
pendiente.categoria = pa_dos  or
pendiente.categoria = pa_tres or
pendiente.categoria = pa_cuatro ;

ELSE

SELECT DISTINCT (SELECT (UPPER(((SELECT tipo_empaques.tipo_empaque FROM tipo_empaques WHERE tipo_empaques.id_tipo_empaque = pendiente.tipo_empaque))))) AS empaque
FROM pendiente ;
END if;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_vitola
DELIMITER //
CREATE PROCEDURE `buscar_vitola`(IN `vitola` VARCHAR(50))
BEGIN
if vitola = "" then
SELECT * FROM vitola_productos;

ELSE
SELECT * FROM vitola_productos WHERE vitola_productos.vitola   like CONCAT("%",vitola,"%");
END if;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_vitola_empaque
DELIMITER //
CREATE PROCEDURE `buscar_vitola_empaque`(IN `pa_uno` VARCHAR(50), IN `pa_dos` VARCHAR(50), IN `pa_tres` VARCHAR(50), IN `pa_cuatro` VARCHAR(50))
BEGIN
if pa_uno != "" || pa_dos != "" || pa_tres  != "" || pa_cuatro != ""
 then
SELECT DISTINCT (SELECT (UPPER(((SELECT vitola_productos.vitola FROM vitola_productos WHERE vitola_productos.id_vitola = pendiente_empaque.vitola))))) AS vitola
FROM pendiente_empaque
where  pendiente_empaque.categoria = pa_uno or
pendiente_empaque.categoria = pa_dos  or
pendiente_empaque.categoria = pa_tres or
pendiente_empaque.categoria = pa_cuatro ;
ELSE
SELECT DISTINCT (SELECT (UPPER(((SELECT vitola_productos.vitola FROM vitola_productos WHERE vitola_productos.id_vitola = pendiente_empaque.vitola))))) AS vitola
FROM pendiente_empaque ;
END if;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.buscar_vitola_pendiente
DELIMITER //
CREATE PROCEDURE `buscar_vitola_pendiente`(IN `pa_uno` VARCHAR(50), IN `pa_dos` VARCHAR(50), IN `pa_tres` VARCHAR(50), IN `pa_cuatro` VARCHAR(50))
BEGIN
if pa_uno != "" || pa_dos != "" || pa_tres  != "" || pa_cuatro != ""
 then
SELECT DISTINCT (SELECT (UPPER(((SELECT vitola_productos.vitola FROM vitola_productos WHERE vitola_productos.id_vitola = pendiente.vitola))))) AS vitola
FROM pendiente
where  pendiente.categoria = pa_uno or
pendiente.categoria = pa_dos  or
pendiente.categoria = pa_tres or
pendiente.categoria = pa_cuatro ;
ELSE
SELECT DISTINCT (SELECT (UPPER(((SELECT vitola_productos.vitola FROM vitola_productos WHERE vitola_productos.id_vitola = pendiente.vitola))))) AS vitola
FROM pendiente;
END if;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.cantidad_cajas
DELIMITER //
CREATE PROCEDURE `cantidad_cajas`()
BEGIN
DECLARE codigo_caja VARCHAR(100);


set codigo_caja =(SELECT  pendiente_empaque.id_pendiente ,clase_productos.codigo_caja FROM pendiente_empaque, clase_productos WHERE
pendiente_empaque.item = clase_productos.item AND clase_productos.codigo_caja IS not NULL);

SELECT codigo_caja;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.contar_detalles_productos
DELIMITER //
CREATE PROCEDURE `contar_detalles_productos`(IN `item` VARCHAR(50))
BEGIN
SELECT COUNT(*) as detalles FROM  detalle_clase_productos  WHERE detalle_clase_productos.item = item;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.datos_pendiente_programar
DELIMITER //
CREATE PROCEDURE `datos_pendiente_programar`(IN `id` INT)
BEGIN

SELECT pendiente_empaque.id_pendiente,
(SELECT categoria.categoria FROM  categoria WHERE categoria.id_categoria = pendiente_empaque.categoria	) AS categoria,
 pendiente_empaque.item AS item,
 pendiente_empaque.orden_del_sitema AS orden_del_sitema,
 pendiente_empaque.observacion AS observacion,
 pendiente_empaque.presentacion AS presentacion ,
 pendiente_empaque.mes AS mes ,
pendiente_empaque.orden AS orden,

(SELECT

		if( clase_productos.sampler = "si", (SELECT clase_productos.descripcion_sampler
										FROM clase_productos WHERE clase_productos.item = pendiente_empaque.item),

										(SELECT marca_productos.marca FROM marca_productos WHERE marca_productos.id_marca = pendiente_empaque.marca	)


		 	) AS des FROM clase_productos WHERE clase_productos.item = pendiente_empaque.item) AS marca,

 (SELECT vitola_productos.vitola FROM  vitola_productos WHERE vitola_productos.id_vitola = pendiente_empaque.vitola	) AS vitola,
		 (SELECT nombre_productos.nombre FROM  nombre_productos WHERE nombre_productos.id_nombre = pendiente_empaque.nombre	) AS nombre,
		  (SELECT capa_productos.capa FROM  capa_productos WHERE capa_productos.id_capa = pendiente_empaque.capa	) AS capa,

(SELECT cellos.anillo AS anillo FROM cellos WHERE cellos.id_cello = pendiente_empaque.cello) AS anillo,
(SELECT cellos.cello AS cello FROM cellos WHERE cellos.id_cello = pendiente_empaque.cello) AS cello,
(SELECT cellos.upc AS upc FROM cellos WHERE cellos.id_cello = pendiente_empaque.cello) AS upc,
 pendiente_empaque.pendiente as pendiente_empaque,
pendiente_empaque.saldo AS saldo,
(SELECT tipo_empaques.tipo_empaque FROM  tipo_empaques WHERE tipo_empaques.id_tipo_empaque = pendiente_empaque.tipo_empaque	) AS tipo_empaque,

 pendiente_empaque.unidades AS paquetes,
(SELECT pendiente_empaque.saldo/(SELECT SUBSTRING(tipo_empaques.tipo_empaque, 9, 3) FROM tipo_empaques WHERE tipo_empaques.tipo_empaque LIKE CONCAT("%","CAJAS","%") AND
tipo_empaques.id_tipo_empaque = pendiente_empaque.tipo_empaque)) AS cant_cajas

FROM pendiente_empaque
WHERE  pendiente_empaque.id_pendiente = id;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.editar_existencia
DELIMITER //
CREATE PROCEDURE `editar_existencia`(IN `pa_id` INT, IN `pa_existencia` INT)
BEGIN
 UPDATE lista_cajas
                SET
                      lista_cajas.existencia = pa_existencia


                WHERE lista_cajas.id = pa_id;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.editar_existencia_producto
DELIMITER //
CREATE PROCEDURE `editar_existencia_producto`(IN `pa_id` INT, IN `pa_existencia` INT, IN `pa_pedido` VARCHAR(50), IN `pa_sistema` VARCHAR(50))
BEGIN
 UPDATE inventario_productos_terminados
                SET
                      inventario_productos_terminados.Existencia = pa_existencia,
                      inventario_productos_terminados.orden_pedido = pa_pedido,
                      inventario_productos_terminados.orden_sistema = pa_sistema


                WHERE inventario_productos_terminados.id = pa_id;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.eliminar_detalles
DELIMITER //
CREATE PROCEDURE `eliminar_detalles`(IN `id` INT, IN `id_pendiente` INT, IN `cant` INT)
BEGIN

DELETE FROM detalle_programacion_temporal WHERE detalle_programacion_temporal.id_detalle_programacion = id;


UPDATE lista_cajas SET lista_cajas.existencia = cant
WHERE (SELECT (SELECT  clase_productos.codigo_caja FROM clase_productos WHERE
			  clase_productos.item = pendiente_empaque.item  ) AS caja
 FROM pendiente_empaque WHERE pendiente_empaque.id_pendiente =id_pendiente) = lista_cajas.codigo;



END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.eliminar_detalle_factura
DELIMITER //
CREATE PROCEDURE `eliminar_detalle_factura`(IN `pa_detalle` INT)
BEGIN
  DELETE FROM detalle_factura WHERE detalle_factura.id_detalle = pa_detalle;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.eliminar_detalle_programacion
DELIMITER //
CREATE PROCEDURE `eliminar_detalle_programacion`(IN `id` INT, IN `id_pendiente` INT, IN `saldo` DECIMAL(10,2), IN `cant` INT)
BEGIN


UPDATE pendiente_empaque SET pendiente_empaque.saldo = saldo + pendiente_empaque.saldo WHERE pendiente_empaque.id_pendiente = id_pendiente;

UPDATE lista_cajas SET lista_cajas.existencia = cant
WHERE (SELECT (SELECT  clase_productos.codigo_caja FROM clase_productos WHERE
			  clase_productos.item = pendiente_empaque.item  ) AS caja
 FROM pendiente_empaque WHERE pendiente_empaque.id_pendiente =id_pendiente) = lista_cajas.codigo;


DELETE FROM detalle_programacion WHERE detalle_programacion.id_detalle_programacion = id;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.eliminar_programacion
DELIMITER //
CREATE PROCEDURE `eliminar_programacion`(IN `id_pro` INT)
BEGIN


DELETE FROM prograamacion WHERE prograamacion.id = id_pro;

DELETE FROM detalle_programacion WHERE detalle_programacion.id_programacion = id_pro;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.eliminar_usuario
DELIMITER //
CREATE PROCEDURE `eliminar_usuario`(IN `pa_id_usuario` INT)
BEGIN

        DELETE FROM users
        WHERE users.id = pa_id_usuario;

        END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.ingresar_presentacion
DELIMITER //
CREATE PROCEDURE `ingresar_presentacion`()
BEGIN

UPDATE clase_productos,(
	SELECT tabla_codigo_programacions.codigo, tabla_codigo_programacions.presentacion, tabla_codigo_programacions.capa,
	tabla_codigo_programacions.nombre ,tabla_codigo_programacions.marca
	FROM clase_productos, tabla_codigo_programacions
	WHERE clase_productos.id_capa = tabla_codigo_programacions.capa AND clase_productos.id_nombre =
tabla_codigo_programacions.nombre AND clase_productos.id_marca = tabla_codigo_programacions.marca)x
SET clase_productos.codigo_producto = x.codigo , clase_productos.presentacion = x.presentacion
WHERE clase_productos.id_capa = x.capa AND clase_productos.id_nombre =
x.nombre AND clase_productos.id_marca = x.marca;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.insertar_actualizar_existencias
DELIMITER //
CREATE PROCEDURE `insertar_actualizar_existencias`(IN `codigo` VARCHAR(50), IN `marca` VARCHAR(50), IN `nombre` VARCHAR(50), IN `vitola` VARCHAR(50), IN `capa` VARCHAR(50), IN `total` VARCHAR(50))
BEGIN

 DECLARE inicio VARCHAR(50);
 DECLARE fin VARCHAR(50);
 DECLARE tamano INT;
 DECLARE con INT;
 DECLARE localizacion INT;
 DECLARE nuevo_total VARCHAR(50);
 DECLARE tot DECIMAL(10,2);


 SET con = 0;
 SET localizacion =  (select LOCATE(',',total));
 SET inicio = (SELECT SUBSTRING_INDEX(total, ',', 1));
 SET fin =  (SELECT SUBSTRING(total, LENGTH(total) - 5, 6));
 SET tamano = LENGTH(total);

 if localizacion >0 then
  SET nuevo_total = CONCAT(inicio, fin);

 else
 SET nuevo_total = total;
 END if;

SET tot =( CAST(nuevo_total AS DECIMAL(10,2)));

INSERT INTO importar_existencias(importar_existencias.codigo_producto,importar_existencias.marca,
importar_existencias.nombre,importar_existencias.vitola, importar_existencias.capa,importar_existencias.total)
VALUES(codigo,marca,nombre,vitola,capa,tot);

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.insertar_capa
DELIMITER //
CREATE PROCEDURE `insertar_capa`(IN `capa` VARCHAR(50))
BEGIN
 INSERT INTO capa_productos(capa_productos.capa)VALUES(capa);
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.insertar_clase_producto
DELIMITER //
CREATE PROCEDURE `insertar_clase_producto`(IN `item` VARCHAR(50), IN `cod_producto` VARCHAR(50), IN `cod_caja` VARCHAR(50), IN `cod_precio` VARCHAR(50), IN `precio` INT, IN `capa` VARCHAR(50), IN `vitola` VARCHAR(50), IN `nombre` VARCHAR(50), IN `marca` VARCHAR(50), IN `cello` VARCHAR(50), IN `anillo` VARCHAR(50), IN `upc` VARCHAR(50), IN `tipo_empaque` VARCHAR(50), IN `presentacion` VARCHAR(50))
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

INSERT INTO clase_productos(clase_productos.item,clase_productos.codigo_producto,clase_productos.codigo_caja
,clase_productos.codigo_precio,clase_productos.precio,clase_productos.id_capa, clase_productos.id_vitola,
clase_productos.id_nombre,clase_productos.id_marca, clase_productos.id_cello, clase_productos.id_tipo_empaque
,clase_productos.presentacion)
VALUES(item,cod_producto,cod_caja,cod_precio,precio,icapa,ivitola,inombre,imarca,icello,itipo,presentacion);




END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.insertar_codigoproducto_presentacion
DELIMITER //
CREATE PROCEDURE `insertar_codigoproducto_presentacion`()
BEGIN

UPDATE clase_productos,tabla_codigo_programacions SET clase_productos.codigo_producto = tabla_codigo_programacions.codigo,
clase_productos.presentacion = tabla_codigo_programacions.presentacion
WHERE clase_productos.id_vitola = tabla_codigo_programacions.vitola AND clase_productos.id_nombre  = tabla_codigo_programacions.nombre AND
clase_productos.id_marca = tabla_codigo_programacions.marca AND
clase_productos.id_capa = tabla_codigo_programacions.capa;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.insertar_detallePro_temporalSinExistencia
DELIMITER //
CREATE PROCEDURE `insertar_detallePro_temporalSinExistencia`(IN `numero_orden` VARCHAR(50), IN `orden` VARCHAR(50), IN `cod_producto` VARCHAR(50), IN `saldo` VARCHAR(50), IN `id_pendiente` INT, IN `cajas_cant` INT)
BEGIN

DECLARE  c VARCHAR(50);
DECLARE total_Existencia DECIMAL(10,2);
DECLARE saldo_pendiente DECIMAL(10,2);


SET c = (SELECT clase_productos.codigo_producto from clase_productos
WHERE clase_productos.item = cod_producto);

INSERT INTO detalle_programacion_temporal(detalle_programacion_temporal.numero_orden,detalle_programacion_temporal.orden,
detalle_programacion_temporal.cod_producto,detalle_programacion_temporal.saldo, detalle_programacion_temporal.id_pendiente,
detalle_programacion_temporal.cant_cajas)
VALUES(numero_orden,orden,c,saldo,id_pendiente,


	(SELECT ((SELECT lista_cajas.existencia FROM lista_cajas WHERE lista_cajas.codigo =
	(SELECT (	SELECT  clase_productos.codigo_caja FROM clase_productos WHERE
			  clase_productos.item = pendiente_empaque.item  ) AS caja
 FROM pendiente_empaque WHERE pendiente_empaque.id_pendiente =id_pendiente))-cajas_cant)
  FROM pendiente_empaque WHERE pendiente_empaque.id_pendiente =id_pendiente)

);



UPDATE lista_cajas SET lista_cajas.existencia = lista_cajas.existencia - cajas_cant
WHERE (SELECT (SELECT  clase_productos.codigo_caja FROM clase_productos WHERE
			  clase_productos.item = pendiente_empaque.item  ) AS caja
 FROM pendiente_empaque WHERE pendiente_empaque.id_pendiente =id_pendiente) = lista_cajas.codigo;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.insertar_detalle_clase_producto
DELIMITER //
CREATE PROCEDURE `insertar_detalle_clase_producto`(IN `item` VARCHAR(50), IN `capa` VARCHAR(50), IN `vitola` VARCHAR(50), IN `nombre` VARCHAR(50), IN `marca` VARCHAR(50), IN `cello` VARCHAR(50), IN `anillo` VARCHAR(50), IN `upc` VARCHAR(50), IN `tipo_empaque` VARCHAR(50), IN `precio` VARCHAR(50))
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

-- Volcando estructura para procedimiento facturacion_plasencia.insertar_detalle_factura
DELIMITER //
CREATE PROCEDURE `insertar_detalle_factura`(IN `pa_id_pendiente` BIGINT, IN `pa_cantidad_cajas` INT, IN `pa_peso_bruto` INT, IN `pa_peso_neto` INT, IN `pa_cantidad_puros` INT, IN `pa_unidad` INT, IN `pa_observaciones` TEXT, IN `pa_para` VARCHAR(50), IN `pa_anterioir` INT)
BEGIN
	INSERT INTO detalle_factura(
		detalle_factura.id_pendiente,
		detalle_factura.id_venta,
		detalle_factura.cantidad_cajas,
		detalle_factura.peso_bruto,
		detalle_factura.peso_neto,
		detalle_factura.cantidad_puros,
		detalle_factura.unidad,
		detalle_factura.observaciones,
		detalle_factura.facturado,
		detalle_factura.para,
		detalle_factura.anterior)
   VALUES(
		pa_id_pendiente,
		0,
		pa_cantidad_cajas,
		pa_peso_bruto,
		pa_peso_neto,
		pa_cantidad_puros,
		pa_unidad,
		pa_observaciones,
		'N',
		pa_para,
		pa_anterioir);



END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.insertar_detalle_programacion
DELIMITER //
CREATE PROCEDURE `insertar_detalle_programacion`(IN `numero_orden` VARCHAR(50), IN `orden` VARCHAR(50), IN `cod_producto` VARCHAR(50), IN `saldo` BIGINT, IN `id_pendiente` INT, IN `caja` VARCHAR(50), IN `cant_cajas` INT)
BEGIN

DECLARE id INT;

SET id= (SELECT MAX(prograamacion.id) AS id FROM prograamacion);


INSERT INTO detalle_programacion(detalle_programacion.numero_orden,detalle_programacion.orden,
detalle_programacion.cod_producto,detalle_programacion.saldo, detalle_programacion.id_programacion,detalle_programacion.id_pendiente,
detalle_programacion.cajas, detalle_programacion.cant_cajas)
VALUES(numero_orden,orden,cod_producto,saldo,id,id_pendiente,caja, cant_cajas);

UPDATE pendiente_empaque SET pendiente_empaque.saldo = (pendiente_empaque.saldo - saldo)
WHERE pendiente_empaque.id_pendiente= id_pendiente;

DELETE FROM detalle_programacion_temporal;



END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.insertar_detalle_temporal
DELIMITER //
CREATE PROCEDURE `insertar_detalle_temporal`(IN `numero_orden` VARCHAR(50), IN `orden` VARCHAR(50), IN `cod_producto` VARCHAR(50), IN `saldo` DECIMAL(10,2), IN `id_pendiente` INT, IN `cajas_cant` INT)
BEGIN

DECLARE  c VARCHAR(50);
DECLARE total_Existencia DECIMAL(10,2);
DECLARE saldo_pendiente DECIMAL(10,2);


SET c = (SELECT clase_productos.codigo_producto from clase_productos
WHERE clase_productos.item = cod_producto);
SET total_Existencia= (SELECT sum(importar_existencias.total) FROM importar_existencias WHERE
importar_existencias.codigo_producto = cod_producto);

INSERT INTO detalle_programacion_temporal(detalle_programacion_temporal.numero_orden,detalle_programacion_temporal.orden,
detalle_programacion_temporal.cod_producto,detalle_programacion_temporal.saldo, detalle_programacion_temporal.id_pendiente,
detalle_programacion_temporal.cant_cajas)
VALUES(numero_orden,orden,c,saldo,id_pendiente,


	(SELECT ((SELECT lista_cajas.existencia FROM lista_cajas WHERE lista_cajas.codigo =
	(SELECT (	SELECT  clase_productos.codigo_caja FROM clase_productos WHERE
			  clase_productos.item = pendiente_empaque.item  ) AS caja
 FROM pendiente_empaque WHERE pendiente_empaque.id_pendiente =id_pendiente))-cajas_cant)
  FROM pendiente_empaque WHERE pendiente_empaque.id_pendiente =id_pendiente)

);

UPDATE lista_cajas SET lista_cajas.existencia = lista_cajas.existencia - cajas_cant
WHERE (SELECT (SELECT  clase_productos.codigo_caja FROM clase_productos WHERE
			  clase_productos.item = pendiente_empaque.item  ) AS caja
 FROM pendiente_empaque WHERE pendiente_empaque.id_pendiente =id_pendiente) = lista_cajas.codigo;



END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.insertar_factura_terminado
DELIMITER //
CREATE PROCEDURE `insertar_factura_terminado`(IN `orden_sufijo` VARCHAR(10), IN `pa_cliente` VARCHAR(50), IN `pa_numero_factura` VARCHAR(50), IN `pa_contenedor` VARCHAR(50), IN `pa_cantidad_bultos` INT, IN `pa_total_puros` INT, IN `pa_total_peso_bruto` INT, IN `pa_total_peso_neto` INT, IN `pa_fecha_factura` DATETIME)
BEGIN
  INSERT INTO factura_terminados(
  		factura_terminados.cliente,
  		factura_terminados.numero_factura,
  		factura_terminados.contenedor,
		factura_terminados.cantidad_bultos,
		factura_terminados.total_puros,
		factura_terminados.total_peso_bruto,
		factura_terminados.total_peso_neto,
		factura_terminados.fecha_factura,
		factura_terminados.facturado)
	VALUES(
		pa_cliente,
		pa_numero_factura,
		pa_contenedor,
		pa_cantidad_bultos,pa_total_puros,pa_total_peso_bruto,pa_total_peso_neto,pa_fecha_factura,'N');



	UPDATE detalle_factura SET

	detalle_factura.facturado = "S",
	detalle_factura.id_venta = (SELECT factura_terminados.id FROM  factura_terminados WHERE factura_terminados.numero_factura = pa_numero_factura)

	WHERE detalle_factura.para = orden_sufijo
			AND detalle_factura.facturado = "N";


END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.insertar_lista_cajas
DELIMITER //
CREATE PROCEDURE `insertar_lista_cajas`(IN `pa_item` VARCHAR(50), IN `pa_productoServicio` VARCHAR(200), IN `pa_marca` VARCHAR(100))
BEGIN

DECLARE imarca INT;
DECLARE itipo_empaque INT;
DECLARE vl_palabra_1 VARCHAR(50);
DECLARE vl_palabra_2 VARCHAR(50);
DECLARE vl_palabra_3 VARCHAR(50);
DECLARE vl_palabra_4 VARCHAR(50);
DECLARE vl_palabra_5 VARCHAR(50);
DECLARE vl_palabra_6 VARCHAR(50);
DECLARE vl_palabra_7 VARCHAR(50);
DECLARE vl_palabra_8 VARCHAR(50);
DECLARE vl_palabra_9 VARCHAR(50);
DECLARE vl_palabra_10 VARCHAR(50);
DECLARE vl_palabra_12 VARCHAR(50);
DECLARE vl_palabra_13 VARCHAR(50);
DECLARE vl_palabra_14 VARCHAR(50);
DECLARE vl_palabra_15 VARCHAR(50);
DECLARE vl_numpalabras INT;
DECLARE vl_tamanio INT;
DECLARE cont INT;
DECLARE vl_palabra_empaque VARCHAR(50);


SET cont = 0;
SET vl_numpalabras = 0;
SET vl_tamanio = LENGTH(pa_productoServicio);

SET vl_palabra_empaque = SUBSTRING(pa_productoServicio, vl_tamanio - 5,7);
SET vl_palabra_empaque = SUBSTRING(vl_palabra_empaque, LENGTH(vl_palabra_empaque) - 1,3);



IF EXISTS (SELECT tipo_empaques.id_tipo_empaque FROM tipo_empaques WHERE tipo_empaques.tipo_empaque = CONCAT("CAJAS 1/",vl_palabra_empaque)) THEN
  		SET itipo_empaque = (SELECT tipo_empaques.id_tipo_empaque FROM tipo_empaques WHERE tipo_empaques.tipo_empaque = CONCAT("CAJAS 1/",vl_palabra_empaque));
ELSE
		SET vl_palabra_empaque = SUBSTRING(pa_productoServicio, vl_tamanio - 4, 6);
		SET vl_palabra_empaque = SUBSTRING(vl_palabra_empaque, 5);
		SET itipo_empaque = (SELECT tipo_empaques.id_tipo_empaque FROM tipo_empaques WHERE tipo_empaques.tipo_empaque = CONCAT("CAJAS 1/",vl_palabra_empaque));

		IF EXISTS (SELECT tipo_empaques.id_tipo_empaque FROM tipo_empaques WHERE tipo_empaques.tipo_empaque = CONCAT("CAJAS 1/",vl_palabra_empaque)) THEN
  				SET itipo_empaque = (SELECT tipo_empaques.id_tipo_empaque FROM tipo_empaques WHERE tipo_empaques.tipo_empaque = CONCAT("CAJAS 1/",vl_palabra_empaque));
		ELSE
				SET vl_palabra_empaque = SUBSTRING(pa_productoServicio, vl_tamanio - 5,7);
				SET vl_palabra_empaque = SUBSTRING(vl_palabra_empaque, LENGTH(vl_palabra_empaque) - 2,3);

			   SET itipo_empaque = (SELECT tipo_empaques.id_tipo_empaque FROM tipo_empaques WHERE tipo_empaques.tipo_empaque = CONCAT("CAJAS 1/",vl_palabra_empaque));

		END IF;
END IF;




	INSERT INTO lista_cajas(lista_cajas.marca,lista_cajas.productoServicio,lista_cajas.codigo,lista_cajas.tipo_empaque,lista_cajas.existencia)

	VALUES(pa_marca,pa_productoServicio,pa_item,itipo_empaque,0);



END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.insertar_marca
DELIMITER //
CREATE PROCEDURE `insertar_marca`(IN `marca` VARCHAR(100))
BEGIN
 INSERT INTO marca_productos(marca_productos.marca)VALUES(marca);
 end//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.insertar_nombre
DELIMITER //
CREATE PROCEDURE `insertar_nombre`(IN `nombre` VARCHAR(50))
BEGIN
  INSERT INTO nombre_productos(nombre_productos.nombre)VALUES(nombre);
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.insertar_nuevo_pedido
DELIMITER //
CREATE PROCEDURE `insertar_nuevo_pedido`(IN `item` VARCHAR(50), IN `paquetes` VARCHAR(50), IN `unidades` VARCHAR(50), IN `orden` VARCHAR(50), IN `categori` VARCHAR(50))
BEGIN

INSERT INTO pedidos(pedidos.item,pedidos.cant_paquetes,pedidos.unidades,pedidos.numero_orden,pedidos.categoria)
VALUEs(item, paquetes, unidades, orden, categori);
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.insertar_nuevo_pendiente
DELIMITER //
CREATE PROCEDURE `insertar_nuevo_pendiente`(IN `categori` VARCHAR(50), IN `item` VARCHAR(50), IN `orden_del_sitema` VARCHAR(50), IN `observacion` VARCHAR(50), IN `presentacion` VARCHAR(50), IN `mes` VARCHAR(50), IN `orden` VARCHAR(50), IN `marca` VARCHAR(50), IN `vitola` VARCHAR(50), IN `nombre` VARCHAR(50), IN `capa` VARCHAR(50), IN `tipo_empaque` VARCHAR(50), IN `cello` VARCHAR(50), IN `anillo` VARCHAR(50), IN `upc` VARCHAR(50), IN `pendient` VARCHAR(50), IN `saldo` VARCHAR(50), IN `paquetes` VARCHAR(50), IN `unidades` VARCHAR(50), IN `serie_precio` VARCHAR(50), IN `precio` VARCHAR(50))
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


SET lc_time_names = 'es_ES';
insert into pendiente(
	pendiente.categoria,
	pendiente.item,
	pendiente.orden_del_sitema,
	pendiente.observacion,
	pendiente.presentacion,
	pendiente.mes,
pendiente.orden,
pendiente.marca,
pendiente.vitola,
pendiente.nombre,
pendiente.capa,
pendiente.tipo_empaque,
	pendiente.cello,
pendiente.pendiente,
	pendiente.saldo,
	pendiente.paquetes,
pendiente.unidades,
    pendiente.serie_precio,
    pendiente.precio)values (categori,
	item,
	orden_del_sitema,
	observacion,
	presentacion,
	( UPPER( CONCAT( MONTHNAME(mes)," ",year(mes)))),
	orden,
	imarca,
	ivitola,
	inombre,
	icapa,
	itipo,
	icello,
	pendient,
	saldo,
	paquetes,
	unidades,
   serie_precio,
   precio);


insert into pendiente_empaque(
	pendiente_empaque.categoria,
	pendiente_empaque.item,
	pendiente_empaque.orden_del_sitema,
	pendiente_empaque.observacion,
	pendiente_empaque.presentacion,
	pendiente_empaque.mes,
pendiente_empaque.orden,
pendiente_empaque.marca,
pendiente_empaque.vitola,
pendiente_empaque.nombre,
pendiente_empaque.capa,
pendiente_empaque.tipo_empaque,
	pendiente_empaque.cello,
pendiente_empaque.pendiente,
	pendiente_empaque.saldo,
	pendiente_empaque.paquetes,
pendiente_empaque.unidades,
pendiente_empaque.id_pendiente_pedido)values (categori,
	item,
	orden_del_sitema,
	observacion,
	presentacion,
	( UPPER( CONCAT( MONTHNAME(mes)," ",year(mes)))),
	orden,
	imarca,
	ivitola,
	inombre,
	icapa,
	itipo,
	icello,
	pendient,
	saldo,
	paquetes,
	unidades,
	(SELECT MAX(id_pendiente) FROM pendiente));


UPDATE clase_productos SET clase_productos.codigo_precio = serie_precio, clase_productos.precio = precio
WHERE clase_productos.item = item;


END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.insertar_nuevo_pendiente_empaque
DELIMITER //
CREATE PROCEDURE `insertar_nuevo_pendiente_empaque`(IN `categori` VARCHAR(50), IN `item` VARCHAR(50), IN `orden_del_sitema` VARCHAR(50), IN `observacion` VARCHAR(50), IN `presentacion` VARCHAR(50), IN `mes` VARCHAR(50), IN `orden` VARCHAR(50), IN `marca` VARCHAR(50), IN `vitola` VARCHAR(50), IN `nombre` VARCHAR(50), IN `capa` VARCHAR(50), IN `tipo_empaque` VARCHAR(50), IN `cello` VARCHAR(50), IN `anillo` VARCHAR(50), IN `upc` VARCHAR(50), IN `pendient` VARCHAR(50), IN `saldo` VARCHAR(50), IN `paquetes` VARCHAR(50))
BEGIN
    DECLARE
        icapa INT; DECLARE imarca INT; DECLARE inombre INT; DECLARE ivitola INT; DECLARE icello INT; DECLARE itipo INT;
    SET
        ivitola = (
        SELECT
            vitola_productos.id_vitola
        FROM
            vitola_productos
        WHERE
            vitola_productos.vitola = vitola
    );
	SET
	    icapa = (
	    SELECT
	        capa_productos.id_capa
	    FROM
	        capa_productos
	    WHERE
	        capa_productos.capa = capa
	);
	SET
	    imarca =(
	    SELECT
	        marca_productos.id_marca
	    FROM
	        marca_productos
	    WHERE
	        marca_productos.marca = marca
	);
	SET
	    inombre =(
	    SELECT
	        nombre_productos.id_nombre
	    FROM
	        nombre_productos
	    WHERE
	        nombre_productos.nombre = nombre
	);
	SET
	    icello =(
	    SELECT
	        cellos.id_cello
	    FROM
	        cellos
	    WHERE
	        cellos.cello = cello AND cellos.anillo = anillo AND cellos.upc = upc
	);
	SET
	    itipo =(
	    SELECT
	        tipo_empaques.id_tipo_empaque
	    FROM
	        tipo_empaques
	    WHERE
	        tipo_empaques.tipo_empaque = tipo_empaque
	);


	SET
	    lc_time_names = 'es_ES';
	    
	    
	INSERT INTO pendiente_empaque(
	    pendiente_empaque.categoria,
	    pendiente_empaque.item,
	    pendiente_empaque.orden_del_sitema,
	    pendiente_empaque.observacion,
	    pendiente_empaque.presentacion,
	    pendiente_empaque.mes,
	    pendiente_empaque.orden,
	    pendiente_empaque.marca,
	    pendiente_empaque.vitola,
	    pendiente_empaque.nombre,
	    pendiente_empaque.capa,
	    pendiente_empaque.tipo_empaque,
	    pendiente_empaque.cello,
	    pendiente_empaque.pendiente,
	    pendiente_empaque.saldo,
	    pendiente_empaque.paquetes,
	    pendiente_empaque.unidades
	)
	VALUES(
	    categori,
	    item,
	    orden_del_sitema,
	    observacion,
	    presentacion,
	    (
	        UPPER(
	            CONCAT(MONTHNAME(mes), " ", YEAR(mes))
	        )
	    ),
	    orden,
	    imarca,
	    ivitola,
	    inombre,
	    icapa,
	    itipo,
	    icello,
	    pendient,
	    saldo,
	    paquetes,
	    pendient / paquetes
	);
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.insertar_pendente_empaque
DELIMITER //
CREATE PROCEDURE `insertar_pendente_empaque`(IN `fecha` VARCHAR(50), IN `sistema` INT)
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
 sistema AS orden_del_sistema,
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

-- Volcando estructura para procedimiento facturacion_plasencia.insertar_pendiente
DELIMITER //
CREATE PROCEDURE `insertar_pendiente`(IN `fecha` DATE, IN `sistema` INT)
BEGIN
SET lc_time_names = 'es_ES';
insert into pendiente(
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
serie_precio,
precio	) (SELECT
  pedidos.categoria  AS categoria,
 (SELECT clase_productos.item  FROM clase_productos WHERE clase_productos.item = pedidos.item) AS item,
 sistema AS orden_del_sistema,
 '' AS observacion,
 (SELECT clase_productos.presentacion FROM clase_productos WHERE clase_productos.item = pedidos.item) AS presentacion,

(SELECT UPPER( CONCAT( MONTHNAME(fecha)," ",year(fecha)))) AS mes,
pedidos.numero_orden  AS orden,
 (SELECT clase_productos.id_marca FROM clase_productos WHERE clase_productos.item = pedidos.item) AS marca,
 (SELECT clase_productos.id_vitola FROM clase_productos WHERE clase_productos.item = pedidos.item) AS vitola,
 (SELECT clase_productos.id_nombre FROM clase_productos WHERE clase_productos.item = pedidos.item) AS nombre,
 (SELECT clase_productos.id_capa FROM clase_productos WHERE clase_productos.item = pedidos.item) AS capa,
 (SELECT clase_productos.id_tipo_empaque FROM clase_productos WHERE clase_productos.item = pedidos.item) AS tipo_empaque,
 (SELECT clase_productos.id_cello FROM clase_productos WHERE clase_productos.item = pedidos.item) AS cello,
  (pedidos.cant_paquetes * pedidos.unidades)  AS pendiente,
    (pedidos.cant_paquetes * pedidos.unidades) AS saldo,
     pedidos.cant_paquetes AS paquetes,
      pedidos.unidades AS unidades,
       '' AS serie_precio,
       '' AS precio
       FROM pedidos);


DELETE FROM pedidos;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.insertar_productos_terminados
DELIMITER //
CREATE PROCEDURE `insertar_productos_terminados`(IN `marca` VARCHAR(50), IN `nombre` VARCHAR(50), IN `vitola` VARCHAR(50), IN `capa` VARCHAR(50), IN `existencia` INT)
BEGIN
DECLARE imarca INT;
DECLARE inombre INT;
DECLARE ivitola INT;
DECLARE icapa INT;

SET imarca = (SELECT marca_productos.id_marca FROM marca_productos WHERE marca_productos.marca = marca);
SET inombre = (SELECT nombre_productos.id_nombre FROM nombre_productos WHERE nombre_productos.nombre = nombre);
SET ivitola = (SELECT vitola_productos.id_vitola FROM  vitola_productos WHERE vitola_productos.vitola = vitola);
SET icapa = (SELECT capa_productos.id_capa FROM  capa_productos WHERE capa_productos.capa = capa);

INSERT INTO inventario_productos_terminados
(inventario_productos_terminados.orden_pedido,inventario_productos_terminados.orden_sistema,inventario_productos_terminados.Marca,
inventario_productos_terminados.Alias_vitola,inventario_productos_terminados.Vitola,
inventario_productos_terminados.Nombre_capa,inventario_productos_terminados.Existencia)
VALUES('','',imarca,inombre,ivitola,icapa,existencia);

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.insertar_programacion
DELIMITER //
CREATE PROCEDURE `insertar_programacion`(IN `fecha` DATETIME, IN `contenedor` VARCHAR(100))
BEGIN



INSERT INTO prograamacion(prograamacion.fecha,prograamacion.mes_contenedor)VALUES(cast(fecha AS date),contenedor);


END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.insertar_pro_terminado
DELIMITER //
CREATE PROCEDURE `insertar_pro_terminado`(IN `lote` VARCHAR(50), IN `marca` VARCHAR(50), IN `nombre` VARCHAR(50), IN `vitola` VARCHAR(50), IN `capa` VARCHAR(50), IN `existencia` VARCHAR(50))
BEGIN

DECLARE icapa INT;
DECLARE imarca INT;
DECLARE inombre INT;
DECLARE ivitola INT;


SET ivitola = (SELECT vitola_productos.id_vitola FROM  vitola_productos WHERE vitola_productos.vitola = vitola);
SET icapa = (SELECT capa_productos.id_capa FROM  capa_productos WHERE capa_productos.capa = capa);
SET imarca = (SELECT marca_productos.id_marca FROM marca_productos WHERE marca_productos.marca = marca);
SET inombre = (SELECT nombre_productos.id_nombre FROM nombre_productos WHERE nombre_productos.nombre = nombre);


INSERT INTO inventario_productos_terminados(inventario_productos_terminados.lote,
inventario_productos_terminados.Marca, inventario_productos_terminados.Alias_vitola,
inventario_productos_terminados.Vitola,inventario_productos_terminados.Nombre_capa,
inventario_productos_terminados.Existencia)VALUES (lote,imarca,inombre,ivitola,icapa,existencia);

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.insertar_tipo
DELIMITER //
CREATE PROCEDURE `insertar_tipo`(IN `tipo` VARCHAR(50))
BEGIN
INSERT INTO tipo_empaques(tipo_empaques.tipo_empaque)VALUES(tipo);
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.insertar_vitola
DELIMITER //
CREATE PROCEDURE `insertar_vitola`(IN `vitola` VARCHAR(50))
BEGIN
INSERT INTO vitola_productos(vitola_productos.vitola)VALUES(vitola);
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.max_programacion
DELIMITER //
CREATE PROCEDURE `max_programacion`(IN `id` INT)
BEGIN

DECLARE MAXi INT;
SET maxi= (SELECT max(prograamacion.id) FROM prograamacion);

if id = 0 then
 SELECT prograamacion.mes_contenedor FROM prograamacion  WHERE prograamacion.id  = maxi;
 else

  SELECT prograamacion.mes_contenedor FROM prograamacion  WHERE prograamacion.id  = id;

 END if;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.mostrar_cajas
DELIMITER //
CREATE PROCEDURE `mostrar_cajas`()
BEGIN
 SELECT lista_cajas.id,lista_cajas.codigo,lista_cajas.productoServicio,lista_cajas.marca FROM lista_cajas;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.mostrar_cajas_export
DELIMITER //
CREATE PROCEDURE `mostrar_cajas_export`()
BEGIN
SELECT lista_cajas.codigo,lista_cajas.productoServicio,lista_cajas.marca,lista_cajas.existencia
FROM lista_cajas
WHERE lista_cajas.existencia > 0;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.mostrar_clase_paradetalle
DELIMITER //
CREATE PROCEDURE `mostrar_clase_paradetalle`(IN `item` VARCHAR(50))
BEGIN


 SELECT clase_productos.id_producto,clase_productos.item,marca_productos.marca, nombre_productos.nombre, vitola_productos.vitola,tipo_empaques.tipo_empaque
FROM clase_productos ,marca_productos,vitola_productos,tipo_empaques,nombre_productos
WHERE  clase_productos.id_vitola = vitola_productos.id_vitola AND
 clase_productos.id_nombre = nombre_productos.id_nombre AND  clase_productos.id_marca = marca_productos.id_marca  AND  clase_productos.id_tipo_empaque = tipo_empaques.id_tipo_empaque
 AND clase_productos.item =item ;


END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.mostrar_datos_para_editar
DELIMITER //
CREATE PROCEDURE `mostrar_datos_para_editar`(IN `id` INT)
BEGIN


 SELECT clase_productos.id_producto ,clase_productos.codigo_producto,clase_productos.codigo_caja,clase_productos.codigo_precio
 ,clase_productos.item,marca_productos.marca, nombre_productos.nombre, vitola_productos.vitola,tipo_empaques.tipo_empaque,clase_productos.presentacion,
 cellos.cello, cellos.anillo, cellos.upc, capa_productos.capa
FROM clase_productos ,marca_productos,vitola_productos,tipo_empaques,nombre_productos,cellos, capa_productos
WHERE  clase_productos.id_vitola = vitola_productos.id_vitola AND capa_productos.id_capa= clase_productos.id_capa and
 clase_productos.id_nombre = nombre_productos.id_nombre AND  clase_productos.id_marca = marca_productos.id_marca
  AND  clase_productos.id_tipo_empaque = tipo_empaques.id_tipo_empaque AND cellos.id_cello = clase_productos.id_cello AND clase_productos.id_producto = id;


END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.mostrar_detallesprovicional_exportar
DELIMITER //
CREATE PROCEDURE `mostrar_detallesprovicional_exportar`()
BEGIN


SELECT 
detalle_programacion_temporal.numero_orden,
			(SELECT concat(detalle_programacion_temporal.orden ,"-",
	
        ( case SUBSTRING(pendiente_empaque.mes, 1, (LENGTH(pendiente_empaque.mes)-4))
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
		 	 ,"-",(SUBSTRING(pendiente_empaque.mes,(LENGTH(pendiente_empaque.mes)-4) , 5 ))) FROM pendiente_empaque
			  
			  WHERE pendiente_empaque.id_pendiente = detalle_programacion_temporal.id_pendiente  ) AS orden,
		   
			(select marca_productos.marca FROM marca_productos WHERE (select pendiente_empaque.marca FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion_temporal.id_pendiente) = marca_productos.id_marca) AS marca,
			 
				(select vitola_productos.vitola FROM vitola_productos WHERE (select pendiente_empaque.vitola FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion_temporal.id_pendiente) = vitola_productos.id_vitola) AS vitola,
			 
		(select nombre_productos.nombre FROM nombre_productos WHERE (select pendiente_empaque.nombre FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion_temporal.id_pendiente) = nombre_productos.id_nombre) AS nombre,
			              
		(select capa_productos.capa FROM capa_productos WHERE (select pendiente_empaque.capa FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion_temporal.id_pendiente) = capa_productos.id_capa) AS capa,
			              
 			(select tipo_empaques.tipo_empaque FROM tipo_empaques WHERE (select pendiente_empaque.tipo_empaque FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion_temporal.id_pendiente) = tipo_empaques.id_tipo_empaque) AS tipo_empaque,
			 
 				(select cellos.anillo FROM cellos WHERE (select pendiente_empaque.cello FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion_temporal.id_pendiente) = cellos.id_cello) AS anillo,
			 
 			(select cellos.cello FROM cellos WHERE (select pendiente_empaque.cello FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion_temporal.id_pendiente) = cellos.id_cello) AS cello,
			 
		(select cellos.upc FROM cellos WHERE (select pendiente_empaque.cello FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion_temporal.id_pendiente) = cellos.id_cello) AS upc,
			 
			detalle_programacion_temporal.saldo

FROM  detalle_programacion_temporal;	  


END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.mostrar_detalles_exportar
DELIMITER //
CREATE PROCEDURE `mostrar_detalles_exportar`(IN `busqueda` VARCHAR(50), IN `id` INT)
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

-- Volcando estructura para procedimiento facturacion_plasencia.mostrar_detalles_productos
DELIMITER //
CREATE PROCEDURE `mostrar_detalles_productos`()
BEGIN


 SELECT detalle_clase_productos.id_producto,detalle_clase_productos.item,marca_productos.marca, nombre_productos.nombre, vitola_productos.vitola,tipo_empaques.tipo_empaque, capa_productos.capa
FROM detalle_clase_productos ,marca_productos,vitola_productos,tipo_empaques,nombre_productos, capa_productos
WHERE  detalle_clase_productos.id_vitola = vitola_productos.id_vitola AND detalle_clase_productos.id_capa = capa_productos.id_capa and
 detalle_clase_productos.id_nombre = nombre_productos.id_nombre AND  detalle_clase_productos.id_marca = marca_productos.id_marca  AND  detalle_clase_productos.id_tipo_empaque = tipo_empaques.id_tipo_empaque
ORDER BY 1;


END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.mostrar_detalles_programacion
DELIMITER //
CREATE PROCEDURE `mostrar_detalles_programacion`(IN `busqueda` VARCHAR(50), IN `id` INT)
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

-- Volcando estructura para procedimiento facturacion_plasencia.mostrar_detalles_provicional
DELIMITER //
CREATE PROCEDURE `mostrar_detalles_provicional`(IN `busqueda` VARCHAR(50))
BEGIN

DECLARE codigo_caja VARCHAR(50);


SELECT  detalle_programacion_temporal.id_detalle_programacion AS id,
detalle_programacion_temporal.numero_orden,
			detalle_programacion_temporal.cod_producto ,
			(SELECT concat(detalle_programacion_temporal.orden ,"-",

        ( case SUBSTRING(pendiente_empaque.mes, 1, (LENGTH(pendiente_empaque.mes)-4))
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
		 	 ,"-",(SUBSTRING(pendiente_empaque.mes,(LENGTH(pendiente_empaque.mes)-4) , 5 ))) FROM pendiente_empaque

			  WHERE pendiente_empaque.id_pendiente = detalle_programacion_temporal.id_pendiente  ) AS orden,







			(select marca_productos.marca FROM marca_productos WHERE (select pendiente_empaque.marca FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion_temporal.id_pendiente) = marca_productos.id_marca) AS marca,

				(select vitola_productos.vitola FROM vitola_productos WHERE (select pendiente_empaque.vitola FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion_temporal.id_pendiente) = vitola_productos.id_vitola) AS vitola,

		(select nombre_productos.nombre FROM nombre_productos WHERE (select pendiente_empaque.nombre FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion_temporal.id_pendiente) = nombre_productos.id_nombre) AS nombre,

		(select capa_productos.capa FROM capa_productos WHERE (select pendiente_empaque.capa FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion_temporal.id_pendiente) = capa_productos.id_capa) AS capa,

 			(select tipo_empaques.tipo_empaque FROM tipo_empaques WHERE (select pendiente_empaque.tipo_empaque FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion_temporal.id_pendiente) = tipo_empaques.id_tipo_empaque) AS tipo_empaque,

 				(select cellos.anillo FROM cellos WHERE (select pendiente_empaque.cello FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion_temporal.id_pendiente) = cellos.id_cello) AS anillo,

 			(select cellos.cello FROM cellos WHERE (select pendiente_empaque.cello FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion_temporal.id_pendiente) = cellos.id_cello) AS cello,

		(select cellos.upc FROM cellos WHERE (select pendiente_empaque.cello FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion_temporal.id_pendiente) = cellos.id_cello) AS upc,

			detalle_programacion_temporal.saldo,
			(SELECT SUM(importar_existencias.total) FROM importar_existencias WHERE importar_existencias.codigo_producto = detalle_programacion_temporal.cod_producto)  AS total_existencia,
			((SELECT SUM(importar_existencias.total) FROM importar_existencias WHERE importar_existencias.codigo_producto = detalle_programacion_temporal.cod_producto) - detalle_programacion_temporal.saldo) AS diferencia,
       	(SELECT 	if (detalle_programacion_temporal.cant_cajas < 0,
		   CONCAT("Faltan ",detalle_programacion_temporal.cant_cajas, " cajas") ,

		 CONCAT("Sobran ",detalle_programacion_temporal.cant_cajas, " cajas") )) AS existencia,

		  (SELECT detalle_programacion_temporal.saldo/


		 (

		 SELECT SUBSTRING((select tipo_empaques.tipo_empaque FROM tipo_empaques
		 WHERE tipo_empaques.id_tipo_empaque = (select pendiente_empaque.tipo_empaque FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion_temporal.id_pendiente) AND tipo_empaques.tipo_empaque LIKE CONCAT("%","CAJAS","%")


			 ) , 9, 3)

		 )) AS cant_cajas_necesarias,


		 detalle_programacion_temporal.id_pendiente,
		 detalle_programacion_temporal.cant_cajas

 FROM  detalle_programacion_temporal
 WHERE  (detalle_programacion_temporal.numero_orden LIKE CONCAT("%",busqueda,"%")||
			detalle_programacion_temporal.orden LIKE CONCAT("%",busqueda,"%")||
			(select marca_productos.marca FROM marca_productos WHERE (select pendiente_empaque.marca FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion_temporal.id_pendiente) = marca_productos.id_marca)
			 LIKE CONCAT("%",busqueda,"%")||
		(select nombre_productos.nombre FROM nombre_productos WHERE (select pendiente_empaque.nombre FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion_temporal.id_pendiente) = nombre_productos.id_nombre)
		 LIKE CONCAT("%",busqueda,"%")||
			(select capa_productos.capa FROM capa_productos WHERE (select pendiente_empaque.capa FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = detalle_programacion_temporal.id_pendiente) = capa_productos.id_capa)
			   LIKE CONCAT("%",busqueda,"%"))

GROUP BY 1;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.mostrar_detalle_clase_productos
DELIMITER //
CREATE PROCEDURE `mostrar_detalle_clase_productos`(IN `pa_item` VARCHAR(50))
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

-- Volcando estructura para procedimiento facturacion_plasencia.mostrar_detalle_factura
DELIMITER //
CREATE PROCEDURE `mostrar_detalle_factura`(IN `pa_para` VARCHAR(50))
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
			  
			  WHERE pendiente.id_pendiente = detalle_factura.id_pendiente  ),id_detalle   asc
; 



END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.mostrar_detalle_factura_export
DELIMITER //
CREATE PROCEDURE `mostrar_detalle_factura_export`(IN `fac` VARCHAR(50))
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
WHERE  (select factura_terminados.numero_factura FROM factura_terminados WHERE factura_terminados.id = detalle_factura.id_venta) = fac


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
			  
			  WHERE pendiente.id_pendiente = detalle_factura.id_pendiente  ),id_detalle   asc
; 




END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.mostrar_existencia_bodega
DELIMITER //
CREATE PROCEDURE `mostrar_existencia_bodega`()
BEGIN
 SELECT importar_existencias.id , importar_existencias.codigo_producto ,
importar_existencias.marca,importar_existencias.nombre, importar_existencias.vitola,importar_existencias.capa
, importar_existencias.total
from  importar_existencias;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.mostrar_lista_cajas
DELIMITER //
CREATE PROCEDURE `mostrar_lista_cajas`()
BEGIN
SELECT * FROM lista_cajas;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.mostrar_lista_inventario
DELIMITER //
CREATE PROCEDURE `mostrar_lista_inventario`()
BEGIN


SELECT  inventario_productos_terminados.id, inventario_productos_terminados.orden_pedido,
inventario_productos_terminados.orden_sistema,marca_productos.marca, nombre_productos.nombre,
vitola_productos.vitola, capa_productos.capa,
inventario_productos_terminados.Existencia
 FROM inventario_productos_terminados, marca_productos, nombre_productos,vitola_productos
 ,capa_productos
 WHERE inventario_productos_terminados.Marca = marca_productos.id_marca and
  inventario_productos_terminados.Alias_vitola = nombre_productos.id_nombre and
inventario_productos_terminados.Vitola = vitola_productos.id_vitola AND
 inventario_productos_terminados.Nombre_capa = capa_productos.id_capa;


END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.mostrar_lista_productos_terminados
DELIMITER //
CREATE PROCEDURE `mostrar_lista_productos_terminados`()
BEGIN
SELECT inventario_productos_terminados.id,inventario_productos_terminados.Existencia FROM inventario_productos_terminados;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.mostrar_pedido
DELIMITER //
CREATE PROCEDURE `mostrar_pedido`()
BEGIN



SELECT

		(SELECT categoria.categoria FROM categoria WHERE categoria.id_categoria
		 = pedidos.categoria) AS categorias,
		pedidos.item,
		pedidos.cant_paquetes,
		pedidos.unidades,
		pedidos.numero_orden,
		(SELECT CONCAT( (SELECT tipo_empaques.tipo_empaque from tipo_empaques WHERE tipo_empaques.id_tipo_empaque = clase_productos.id_tipo_empaque)," ",
					(SELECT marca_productos.marca from marca_productos WHERE marca_productos.id_marca =clase_productos.id_marca)," ",
					(SELECT nombre_productos.nombre from nombre_productos WHERE nombre_productos.id_nombre =clase_productos.id_nombre)," ",
					(SELECT capa_productos.capa from capa_productos WHERE capa_productos.id_capa =clase_productos.id_capa)," ",
					(SELECT vitola_productos.vitola from vitola_productos WHERE vitola_productos.id_vitola =clase_productos.id_vitola)	) AS des FROM clase_productos WHERE clase_productos.item = pedidos.item) AS descripcion

FROM pedidos;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.mostrar_pendiente
DELIMITER //
CREATE PROCEDURE `mostrar_pendiente`()
BEGIN

SELECT pendiente.id_pendiente, categoria.categoria AS categoria, pendiente.item AS item,pendiente.orden_del_sitema AS orden_del_sitema,pendiente.observacion AS observacion,pendiente.presentacion AS presentacion ,pendiente.mes AS mes ,orden_productos.orden AS orden, marca_productos.marca AS marca,vitola_productos.vitola AS vitola,
nombre_productos.nombre AS nombre, capa_productos.capa AS capa,
cellos.anillo AS anillo,cellos.cello AS cello, cellos.upc AS upc, pendiente.pendiente as pendiente,pendiente.factura_del_mes as factura_del_mes, pendiente.cantidad_enviada_mes AS cantidad_enviada_mes, pendiente.saldo AS saldo, tipo_empaques.tipo_empaque AS tipo_empaque
FROM categoria, clase_productos, marca_productos, vitola_productos,nombre_productos, capa_productos, orden_productos,cellos,
tipo_empaques, pendiente
WHERE pendiente.vitola = vitola_productos.id_vitola AND pendiente.capa = capa_productos.id_capa and
 pendiente.nombre = nombre_productos.id_nombre AND  pendiente.marca = marca_productos.id_marca AND
   pendiente.tipo_empaque = tipo_empaques.id_tipo_empaque AND pendiente.categoria = categoria.id_categoria
	GROUP BY pendiente.item, pendiente.categoria
	;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.mostrar_pendiente_empaque
DELIMITER //
CREATE PROCEDURE `mostrar_pendiente_empaque`()
BEGIN

SELECT categoria.categoria AS categoria, pendiente_empaque.item AS item,pendiente_empaque.orden_del_sitema AS orden_del_sitema,pendiente_empaque.observacion AS observacion,pendiente_empaque.presentacion AS presentacion ,pendiente_empaque.mes AS mes ,orden_productos.orden AS orden, marca_productos.marca AS marca,vitola_productos.vitola AS vitola,
nombre_productos.nombre AS nombre, capa_productos.capa AS capa,
cellos.anillo AS anillo,cellos.cello AS cello, cellos.upc AS upc, pendiente_empaque.pendiente as pendiente_empaque,pendiente_empaque.factura_del_mes as factura_del_mes, pendiente_empaque.cantidad_enviada_mes AS cantidad_enviada_mes, pendiente_empaque.saldo AS saldo, tipo_empaques.tipo_empaque AS tipo_empaque
FROM categoria, clase_productos, marca_productos, vitola_productos,nombre_productos, capa_productos, orden_productos,cellos,
tipo_empaques, pendiente_empaque
WHERE pendiente_empaque.vitola = vitola_productos.id_vitola AND pendiente_empaque.capa = capa_productos.id_capa  and
 pendiente_empaque.nombre = nombre_productos.id_nombre AND  pendiente_empaque.marca = marca_productos.id_marca AND cellos.id_cello=pendiente_empaque.cello AND orden_productos.id_orden =pendiente_empaque.orden and
   pendiente_empaque.tipo_empaque = tipo_empaques.id_tipo_empaque AND pendiente_empaque.categoria = categoria.id_categoria AND
   pendiente_empaque.saldo > 0
	GROUP BY pendiente_empaque.item, pendiente_empaque.orden, pendiente_empaque.categoria;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.mostrar_productos
DELIMITER //
CREATE PROCEDURE `mostrar_productos`()
BEGIN


 SELECT clase_productos.id_producto ,clase_productos.codigo_producto,clase_productos.codigo_caja,clase_productos.codigo_precio
 ,clase_productos.item,marca_productos.marca, nombre_productos.nombre, vitola_productos.vitola,tipo_empaques.tipo_empaque,clase_productos.presentacion,
 cellos.cello, cellos.anillo, cellos.upc, capa_productos.capa, clase_productos.sampler
FROM clase_productos ,marca_productos,vitola_productos,tipo_empaques,nombre_productos,cellos, capa_productos
WHERE  clase_productos.id_vitola = vitola_productos.id_vitola AND clase_productos.id_capa = capa_productos.capa and
 clase_productos.id_nombre = nombre_productos.id_nombre AND  clase_productos.id_marca = marca_productos.id_marca
  AND  clase_productos.id_tipo_empaque = tipo_empaques.id_tipo_empaque AND cellos.id_cello = clase_productos.id_cello;


END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.mostrar_programacion
DELIMITER //
CREATE PROCEDURE `mostrar_programacion`()
BEGIN


  SELECT * FROM prograamacion ORDER by prograamacion.id desc;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.reporte_capas
DELIMITER //
CREATE PROCEDURE `reporte_capas`(IN `pa_capa` TEXT)
BEGIN
SELECT DISTINCT (SELECT (UPPER((SELECT capa_productos.capa FROM capa_productos WHERE capa_productos.id_capa = clase_productos.id_capa))) AS capa
FROM clase_productos
WHERE clase_productos.item = (SELECT pendiente.item FROM pendiente
											WHERE pendiente.id_pendiente =  detalle_factura.id_pendiente)) AS capas
FROM detalle_factura
WHERE `facturado` = "S" AND (SELECT DISTINCT(SELECT (UPPER((SELECT capa_productos.capa FROM capa_productos WHERE capa_productos.id_capa = clase_productos.id_capa))) AS capa
FROM clase_productos
WHERE clase_productos.item = (SELECT pendiente.item FROM pendiente
											WHERE pendiente.id_pendiente =  detalle_factura.id_pendiente))) LIKE CONCAT("%",pa_capa,"%");
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.reporte_facura_pendiente
DELIMITER //
CREATE PROCEDURE `reporte_facura_pendiente`(
	IN `fecha` DATE,
	IN `marca` VARCHAR(200),
	IN `nombre` VARCHAR(50),
	IN `capa` VARCHAR(50),
	IN `vitola` VARCHAR(50),
	IN `factura` VARCHAR(50)
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
	(CAST(((`cantidad_puros`*`unidad`)/cantidad_cajas) AS DECIMAL(9,0))) AS cantidad_cajas,

	`cantidad_puros`*`unidad` AS total_tabacos,

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

	((SELECT (UPPER((SELECT nombre_productos.nombre FROM nombre_productos WHERE nombre_productos.id_nombre = clase_productos.id_nombre))) AS capa
FROM clase_productos
WHERE clase_productos.item = (SELECT pendiente.item FROM pendiente
											WHERE pendiente.id_pendiente =  detalle_factura.id_pendiente))) LIKE (CONCAT("%",nombre,"%")) AND

((SELECT (UPPER((SELECT capa_productos.capa FROM capa_productos WHERE capa_productos.id_capa = clase_productos.id_capa))) AS capa
FROM clase_productos
WHERE clase_productos.item = (SELECT pendiente.item FROM pendiente
											WHERE pendiente.id_pendiente =  detalle_factura.id_pendiente))) LIKE (CONCAT("%",capa,"%")) and
											
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
			  
			  WHERE pendiente.id_pendiente = detalle_factura.id_pendiente  ),id_detalle   ASC;

 end//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.reporte_marcas
DELIMITER //
CREATE PROCEDURE `reporte_marcas`(IN `pa_marca` TEXT)
BEGIN
SELECT DISTINCT (SELECT (UPPER(((SELECT marca_productos.marca FROM marca_productos WHERE marca_productos.id_marca = clase_productos.id_marca)
		 ))) AS capa
FROM clase_productos
WHERE clase_productos.item = (SELECT pendiente.item FROM pendiente
											WHERE pendiente.id_pendiente =  detalle_factura.id_pendiente)) AS marca
FROM detalle_factura
WHERE `facturado` = "S" AND ((SELECT (UPPER(((SELECT marca_productos.marca FROM marca_productos WHERE marca_productos.id_marca = clase_productos.id_marca)
		 ))) AS capa
FROM clase_productos
WHERE clase_productos.item = (SELECT pendiente.item FROM pendiente
											WHERE pendiente.id_pendiente =  detalle_factura.id_pendiente))) LIKE CONCAT("%",pa_marca,"%");

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.reporte_nombres
DELIMITER //
CREATE PROCEDURE `reporte_nombres`(IN `pa_nombre` TEXT)
BEGIN

SELECT DISTINCT (SELECT (UPPER((SELECT nombre_productos.nombre FROM nombre_productos WHERE nombre_productos.id_nombre = clase_productos.id_nombre))) AS capa
FROM clase_productos
WHERE clase_productos.item = (SELECT pendiente.item FROM pendiente
											WHERE pendiente.id_pendiente =  detalle_factura.id_pendiente)) AS nombre
FROM detalle_factura
WHERE `facturado` = "S" AND (
(SELECT (UPPER((SELECT nombre_productos.nombre FROM nombre_productos WHERE nombre_productos.id_nombre = clase_productos.id_nombre))) AS capa
FROM clase_productos
WHERE clase_productos.item = (SELECT pendiente.item FROM pendiente
											WHERE pendiente.id_pendiente =  detalle_factura.id_pendiente))) LIKE CONCAT("%", pa_nombre,"%");


END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.reporte_vitolas
DELIMITER //
CREATE PROCEDURE `reporte_vitolas`(IN `pa_vitola` VARCHAR(50))
BEGIN
SELECT DISTINCT (SELECT (UPPER((SELECT vitola_productos.vitola FROM vitola_productos WHERE vitola_productos.id_vitola = clase_productos.id_vitola))) AS vitola
FROM clase_productos
WHERE clase_productos.item = (SELECT pendiente.item FROM pendiente
											WHERE pendiente.id_pendiente =  detalle_factura.id_pendiente)) AS vitolas
FROM detalle_factura
WHERE `facturado` = "S" AND (SELECT DISTINCT(SELECT (UPPER((SELECT vitola_productos.vitola FROM vitola_productos WHERE vitola_productos.id_vitola = clase_productos.id_vitola))) AS vitola
FROM clase_productos
WHERE clase_productos.item = (SELECT pendiente.item FROM pendiente
											WHERE pendiente.id_pendiente =  detalle_factura.id_pendiente))) LIKE CONCAT("%",pa_vitola,"%");
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.sustraer_total
DELIMITER //
CREATE PROCEDURE `sustraer_total`(IN `total` VARCHAR(50))
BEGIN

 DECLARE inicio VARCHAR(50);
 DECLARE fin VARCHAR(50);
 DECLARE tamano INT;
 DECLARE con INT;
 DECLARE localizacion INT;
 DECLARE nuevo_total VARCHAR(50);


 SET con = 0;
 SET localizacion =  (select LOCATE(',',total));
 SET inicio = (SELECT SUBSTRING_INDEX(total, ',', 1));
 SET fin =  (SELECT SUBSTRING(total, LENGTH(total) - 5, 6));
 SET tamano = LENGTH(total);

 if localizacion >0 then



 SET nuevo_total = CONCAT(inicio, fin);

 else
 SET nuevo_total = total;
 END if;

SELECT CAST(nuevo_total AS DECIMAL(10,2)), fin, inicio;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.traer_cant_cajas
DELIMITER //
CREATE PROCEDURE `traer_cant_cajas`(IN `id_pendiente` INT)
BEGIn


		 SELECT SUBSTRING((select tipo_empaques.tipo_empaque FROM tipo_empaques
		 WHERE tipo_empaques.id_tipo_empaque = (select pendiente_empaque.tipo_empaque FROM pendiente_empaque
			 WHERE pendiente_empaque.id_pendiente = id_pendiente) AND tipo_empaques.tipo_empaque LIKE CONCAT("%","CAJAS","%")


			 ) , 9, 3) AS cajas_tipo ;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.traer_categoria_id
DELIMITER //
CREATE PROCEDURE `traer_categoria_id`(IN `pa_categoria` VARCHAR(50))
BEGIN
IF pa_categoria = "CATALAGO" THEN

SELECT categoria.id_categoria FROM  categoria WHERE categoria.categoria = "CATALOGO";

ELSE
 SELECT categoria.id_categoria FROM  categoria WHERE categoria.categoria = pa_categoria;

 END IF;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.traer_datos_productos
DELIMITER //
CREATE PROCEDURE `traer_datos_productos`(IN `item` VARCHAR(50))
BEGIN

SELECT * FROM clase_productos WHERE clase_productos.item = item;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.traer_descripcion_factura
DELIMITER //
CREATE PROCEDURE `traer_descripcion_factura`(IN `pa_id_pendiente` INT)
BEGIN
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
											WHERE pendiente.id_pendiente = pa_id_pendiente     )
	);
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.traer_detalles_editar_capa
DELIMITER //
CREATE PROCEDURE `traer_detalles_editar_capa`(IN `pa_id` INT)
BEGIN
SELECT capa FROM capa_productos WHERE id_capa = pa_id;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.traer_detalles_editar_factura
DELIMITER //
CREATE PROCEDURE `traer_detalles_editar_factura`(IN `pa_id` INT)
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
	(SELECT CONCAT(pendiente.orden ,"-", MONTH(pendiente.mes) , "-" , date_format(pendiente.mes,'%y')) AS oer
	FROM pendiente WHERE pendiente.id_pendiente = detalle_factura.id_pendiente) AS orden,

		(SELECT  pendiente.pendiente
	FROM pendiente WHERE pendiente.id_pendiente = detalle_factura.id_pendiente) AS orden_total,

		(SELECT pendiente.saldo - total_tabacos
	FROM pendiente WHERE pendiente.id_pendiente = detalle_factura.id_pendiente) AS orden_restante,

	`peso_bruto`*`cantidad_puros` AS total_bruto,
	`peso_neto`*`cantidad_puros`AS total_neto
FROM detalle_factura WHERE detalle_factura.id_detalle= pa_id;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.traer_detalles_editar_marca
DELIMITER //
CREATE PROCEDURE `traer_detalles_editar_marca`(IN `pa_marca` INT)
BEGIN
SELECT marca FROM marca_productos WHERE id_marca = pa_marca;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.traer_detalles_editar_nombre
DELIMITER //
CREATE PROCEDURE `traer_detalles_editar_nombre`(IN `pa_id` INT)
BEGIN
SELECT nombre FROM nombre_productos WHERE id_nombre = pa_id;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.traer_detalles_editar_tipo
DELIMITER //
CREATE PROCEDURE `traer_detalles_editar_tipo`(IN `pa_id` INT)
BEGIN
SELECT tipo_empaque FROM tipo_empaques WHERE tipo_empaques.id_tipo_empaque = pa_id;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.traer_detalles_editar_vitola
DELIMITER //
CREATE PROCEDURE `traer_detalles_editar_vitola`(IN `pa_id` INT)
BEGIN
SELECT vitola FROM vitola_productos WHERE id_vitola = pa_id;
END//
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
			  
			  WHERE pendiente.id_pendiente = detalle_factura.id_pendiente  ),id_detalle   ASC;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.traer_detalles_productos_actualizar
DELIMITER //
CREATE PROCEDURE `traer_detalles_productos_actualizar`(IN `pa_item` VARCHAR(50), IN `pa_limite` MEDIUMINT)
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

-- Volcando estructura para procedimiento facturacion_plasencia.traer_detalles_productos_factura
DELIMITER //
CREATE PROCEDURE `traer_detalles_productos_factura`(IN `pa_item` VARCHAR(50), IN `pa_posicion` INT)
BEGIN
		    SELECT
		        detalle_clase_productos.id_producto,
		        item,
		        (CONCAT(
		            (
		            SELECT
		                marca_productos.marca
		            FROM
		                marca_productos
		            WHERE
		                marca_productos.id_marca = detalle_clase_productos.id_marca
		        ),
		        " ",
		        (
		            IF(
		                (
		                    (
		                    SELECT
		                        nombre_productos.nombre
		                    FROM
		                        nombre_productos
		                    WHERE
		                        nombre_productos.id_nombre = detalle_clase_productos.id_nombre
		                ) = "NINGUNA"
		                ),
		                "",
		                (
		                SELECT
		                    nombre_productos.nombre
		                FROM
		                    nombre_productos
		                WHERE
		                    nombre_productos.id_nombre = detalle_clase_productos.id_nombre
		            )
		            )
		        ),
		        " ",
		        (
		            IF(
		                (
		                    (
		                    SELECT
		                        vitola_productos.vitola
		                    FROM
		                        vitola_productos
		                    WHERE
		                        vitola_productos.id_vitola = detalle_clase_productos.id_vitola
		                ) = "NINGUNA"
		                ),
		                "",
		                (
		                SELECT
		                    vitola_productos.vitola
		                FROM
		                    vitola_productos
		                WHERE
		                    vitola_productos.id_vitola = detalle_clase_productos.id_vitola
		            )
		            )
		        ))) AS sampler,
				(
		        SELECT
		            capa_productos.capa
		        FROM
		            capa_productos
		        WHERE
		            capa_productos.id_capa = detalle_clase_productos.id_capa
		    ) AS capa,
		(
		    SELECT
		        cellos.anillo AS anillo
		    FROM
		        cellos
		    WHERE
		        cellos.id_cello = detalle_clase_productos.id_cello
		) AS anillo,
		(
		    SELECT
		        cellos.cello AS cello
		    FROM
		        cellos
		    WHERE
		        cellos.id_cello = detalle_clase_productos.id_cello
		) AS cello,
		(
		    SELECT
		        cellos.upc AS upc
		    FROM
		        cellos
		    WHERE
		        cellos.id_cello = detalle_clase_productos.id_cello
		) AS upc,
		(
		    SELECT
		        tipo_empaques.tipo_empaque
		    FROM
		        tipo_empaques
		    WHERE
		        tipo_empaques.id_tipo_empaque = detalle_clase_productos.id_tipo_empaque
		) AS tipo_empaque,
		otra_descripcion,
		precio,
		codigo_producto
		FROM
		    detalle_clase_productos
		WHERE
		    detalle_clase_productos.item = pa_item
		LIMIT pa_posicion,
		1;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.traer_factura_datos
DELIMITER //
CREATE PROCEDURE `traer_factura_datos`(IN `pa_ida_venta` INT)
BEGIN
   SELECT * FROM factura_terminados WHERE factura_terminados.id = pa_ida_venta;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.traer_maximo_registro_existencia
DELIMITER //
CREATE PROCEDURE `traer_maximo_registro_existencia`()
BEGIN

DECLARE max_id BIGINT;

SET max_id = (SELECT max(importar_existencias.id)from  importar_existencias);

 SELECT importar_existencias.id , importar_existencias.codigo_producto ,
importar_existencias.marca,importar_existencias.nombre, importar_existencias.vitola,importar_existencias.capa
from  importar_existencias
WHERE importar_existencias.id = max_id;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.traer_numero_detalles_productos
DELIMITER //
CREATE PROCEDURE `traer_numero_detalles_productos`(IN `pa_item` VARCHAR(50))
BEGIN
    SELECT COUNT(detalle_clase_productos.item) AS tuplas
	 FROM detalle_clase_productos
	 WHERE detalle_clase_productos.item = pa_item;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.traer_numero_detalles_productos_datos
DELIMITER //
CREATE PROCEDURE `traer_numero_detalles_productos_datos`(IN `pa_item` VARCHAR(50), IN `pa_limite` MEDIUMINT)
BEGIN
    SELECT (SELECT marca_productos.marca FROM marca_productos WHERE marca_productos.id_marca = detalle_clase_productos.id_marca) AS marca,
			    (SELECT vitola_productos.vitola FROM  vitola_productos WHERE vitola_productos.id_vitola = detalle_clase_productos.id_vitola	) AS vitola,
					 (SELECT nombre_productos.nombre FROM  nombre_productos WHERE nombre_productos.id_nombre = detalle_clase_productos.id_nombre	) AS nombre,
					  (SELECT capa_productos.capa FROM  capa_productos WHERE capa_productos.id_capa = detalle_clase_productos.id_capa	) AS capa
	 FROM detalle_clase_productos
	 WHERE detalle_clase_productos.item = pa_item
	 ORDER BY id_producto
	 LIMIT pa_limite,1;




END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.traer_numero_detalles_productos_ids
DELIMITER //
CREATE PROCEDURE `traer_numero_detalles_productos_ids`(IN `pa_limite` MEDIUMINT, IN `pa_item` VARCHAR(50))
BEGIN

    SELECT *
	 FROM detalle_clase_productos
	 WHERE detalle_clase_productos.item = pa_item
	 ORDER BY id_producto
	 LIMIT pa_limite,1;

END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.traer_num_factura
DELIMITER //
CREATE PROCEDURE `traer_num_factura`()
BEGIN
	DECLARE vl_num_factura VARCHAR(14);
	DECLARE vl_numero_de_factura_emitidas INT;

	SET vl_num_factura = "FA-";

	SET vl_numero_de_factura_emitidas = (SELECT COUNT(*) FROM factura_terminados)+1;



	SELECT CONCAT("FA-",
				(SELECT (CASE
			    WHEN CHARACTER_LENGTH(vl_numero_de_factura_emitidas) = 1 THEN (CONCAT("00-0000000",vl_numero_de_factura_emitidas))
			    WHEN CHARACTER_LENGTH(vl_numero_de_factura_emitidas) = 2 THEN (CONCAT("00-000000",vl_numero_de_factura_emitidas))
			    WHEN CHARACTER_LENGTH(vl_numero_de_factura_emitidas) = 3 THEN (CONCAT("00-00000",vl_numero_de_factura_emitidas))
			    WHEN CHARACTER_LENGTH(vl_numero_de_factura_emitidas) = 4 THEN (CONCAT("00-0000",vl_numero_de_factura_emitidas))
			    WHEN CHARACTER_LENGTH(vl_numero_de_factura_emitidas) = 5 THEN (CONCAT("00-000",vl_numero_de_factura_emitidas))
			    WHEN CHARACTER_LENGTH(vl_numero_de_factura_emitidas) = 6 THEN (CONCAT("00-00",vl_numero_de_factura_emitidas))
			    WHEN CHARACTER_LENGTH(vl_numero_de_factura_emitidas) = 7 THEN (CONCAT("00-0",vl_numero_de_factura_emitidas))
			    WHEN CHARACTER_LENGTH(vl_numero_de_factura_emitidas) = 8 THEN (CONCAT("00-",vl_numero_de_factura_emitidas))
				END))
	) AS factura_interna;


END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.traer_suma_sampler_pendiente_empaque
DELIMITER //
CREATE PROCEDURE `traer_suma_sampler_pendiente_empaque`(IN `pa_hon` VARCHAR(50), IN `pa_item` VARCHAR(50))
BEGIN
	SELECT SUM(saldo) AS total FROM pendiente_empaque WHERE orden = pa_hon AND item = pa_item;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.traer_ubicacion
DELIMITER //
CREATE PROCEDURE `traer_ubicacion`(IN `ubicacion` VARCHAR(50))
BEGIN
SELECT importar_existencias.id, importar_existencias.codigo_producto,importar_existencias.marca,
importar_existencias.nombre,importar_existencias.vitola,importar_existencias.capa, importar_existencias.ubicacion,
importar_existencias.total
FROM importar_existencias
WHERE importar_existencias.ubicacion  = ubicacion;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.traer_ultimo_detalle_programacion
DELIMITER //
CREATE PROCEDURE `traer_ultimo_detalle_programacion`()
BEGIN
   SELECT 
    (SELECT pendiente_empaque.item FROM pendiente_empaque WHERE pendiente_empaque.id_pendiente = detalle_programacion.id_pendiente) AS item,
   detalle_programacion.id_pendiente,
   
   (SELECT pendiente_empaque.orden FROM pendiente_empaque WHERE pendiente_empaque.id_pendiente = detalle_programacion.id_pendiente) AS orden,
   
	(SELECT clase_productos.sampler FROM clase_productos WHERE clase_productos.item = 
			(SELECT pendiente_empaque.item FROM pendiente_empaque WHERE pendiente_empaque.id_pendiente = detalle_programacion.id_pendiente)) AS sampler,
    
   (SELECT pendiente_empaque.saldo FROM pendiente_empaque WHERE pendiente_empaque.id_pendiente = detalle_programacion.id_pendiente) AS saldo
   
	
	FROM detalle_programacion WHERE detalle_programacion.id_detalle_programacion = 
   	( SELECT MAX(detalle_programacion.id_detalle_programacion) FROM detalle_programacion);
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.traer_ventas_historial
DELIMITER //
CREATE PROCEDURE `traer_ventas_historial`(IN `fecha` DATE, IN `busqueda` VARCHAR(50))
BEGIN
  SELECT * FROM factura_terminados WHERE MONTH(factura_terminados.fecha_factura) = MONTH(fecha)
   AND year(factura_terminados.fecha_factura) = year(fecha) AND factura_terminados.numero_factura LIKE CONCAT("%",busqueda,"%")
	ORDER BY 1 DESC;
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.trae_factura_venta_actual
DELIMITER //
CREATE PROCEDURE `trae_factura_venta_actual`()
BEGIN
 SELECT * FROM factura_terminados WHERE factura_terminados.facturado = 'N';
END//
DELIMITER ;

-- Volcando estructura para procedimiento facturacion_plasencia.verificar_item_clase
DELIMITER //
CREATE PROCEDURE `verificar_item_clase`()
BEGIN
SELECT item FROM pedidos WHERE pedidos.item NOT IN(SELECT clase_productos.item FROM clase_productos);
END//
DELIMITER ;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
