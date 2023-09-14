DROP PROCEDURE IF EXISTS `anularGestorProgram`//
CREATE DEFINER=`root`@`localhost` PROCEDURE `anularGestorProgram` (IN `id` INT)   BEGIN
UPDATE tbl_programa_productos  as pp
SET pp.id_status = 2
WHERE pp.id_programa_productos = id;
END//

DROP PROCEDURE IF EXISTS `anularInventario`//
CREATE DEFINER=`root`@`localhost` PROCEDURE `anularInventario` (IN `identificador` INT)   BEGIN
    DECLARE cantidad_inventario INT;
    DECLARE cantidad_restar INT;
    DECLARE stockActual int;
    DECLARE codigoproducto int;
	SET codigoproducto = (SELECT i.codigo_producto FROM tbl_inventario AS i WHERE i.id_inventario = identificador);
    -- Obtener la cantidad de productos a restar del inventario
    SELECT i.cantidad INTO cantidad_restar
    FROM tbl_inventario AS i
    WHERE i.id_inventario = identificador;

    -- Verificar si la cantidad de productos es válida para restar
    IF cantidad_restar <= 0 THEN
        -- Realizar un rollback y mostrar mensaje de error
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'INSFP330';
    END IF;

    -- Verificar si hay suficientes productos en inventario para restar
    SELECT cantidad INTO cantidad_inventario
    FROM tbl_productos AS p
    WHERE p.codigo_producto = (SELECT i.codigo_producto FROM tbl_inventario AS i WHERE i.id_inventario = identificador);

    IF cantidad_inventario < cantidad_restar THEN
        -- Realizar un rollback y mostrar mensaje de error
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'INSFP330';
    END IF;

    -- Iniciar una transacción
    START TRANSACTION;

    -- Actualizar el estado del inventario
    UPDATE tbl_inventario AS i
    SET i.id_status = 2
    WHERE i.id_inventario = identificador;

    -- Restar la cantidad de productos del inventario
    UPDATE tbl_productos AS p
    SET p.cantidad = p.cantidad - cantidad_restar
    WHERE p.codigo_producto = (SELECT i.codigo_producto FROM tbl_inventario AS i WHERE i.id_inventario = identificador);

       SET stockActual = (SELECT cantidad FROM tbl_productos WHERE codigo_producto = codigoproducto);

           IF stockActual <= 10 AND stockActual >= 6 THEN
                CALL setAlert(codigoproducto, 'Niveles bajos de producto', 1, 2);
            ELSEIF stockActual < 6 AND stockActual >= 0 THEN
                CALL setAlert(codigoproducto, 'Niveles escasos de producto', 1, 1);
            ELSEIF stockActual > 10 THEN
                CALL setAlert(codigoproducto, 'Niveles normales de producto', 2, 3);
            END IF;
    -- Confirmar la transacción
    COMMIT;
END//

DROP PROCEDURE IF EXISTS `anularProgram`//
CREATE DEFINER=`root`@`localhost` PROCEDURE `anularProgram` (IN `id` INT)   BEGIN
UPDATE tbl_programa  as p
SET p.id_status = 2
WHERE p.id_programa = id;
END//

DROP PROCEDURE IF EXISTS `deactivateNotification`//
CREATE DEFINER=`root`@`localhost` PROCEDURE `deactivateNotification` (IN `id` INT)   BEGIN
UPDATE tbl_alertas as a
SET a.id_status = 2 
WHERE id_alerta = id;
END//

DROP PROCEDURE IF EXISTS `deleteDetailProduct`//
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteDetailProduct` (IN `id` INT)   BEGIN 
DECLARE stockActual int;
Declare codigoProducto int;

set codigoProducto = ( SELECT codigo_producto FROM tbl_detalle_programa_productos WHERE id_detalle_programa_productos = id);

UPDATE tbl_productos
    SET cantidad = cantidad + (SELECT cantidad FROM tbl_detalle_programa_productos WHERE id_detalle_programa_productos = id)
    WHERE codigo_producto = codigoProducto;

    UPDATE tbl_programa_productos
    SET cantidad = cantidad - (SELECT cantidad FROM tbl_detalle_programa_productos WHERE id_detalle_programa_productos = id),
        total = total - (SELECT importe FROM tbl_detalle_programa_productos WHERE id_detalle_programa_productos = id)
    WHERE id_programa_productos = (SELECT id_programa_productos FROM tbl_detalle_programa_productos WHERE id_detalle_programa_productos = id);

    DELETE FROM tbl_detalle_programa_productos WHERE id_detalle_programa_productos = id;
    
     SET stockActual = (SELECT cantidad FROM tbl_productos WHERE codigo_producto = codigoProducto);

              IF stockActual <= 10 AND stockActual >= 6 THEN
                CALL setAlert(codigoproducto, 'Niveles bajos de producto', 1, 2);
            ELSEIF stockActual < 6 AND stockActual >= 0 THEN
                CALL setAlert(codigoproducto, 'Niveles escasos de producto', 1, 1);
            ELSEIF stockActual > 10 THEN
                CALL setAlert(codigoproducto, 'Niveles normales de producto', 2, 3);
            END IF;
END//

DROP PROCEDURE IF EXISTS `desactivateNotifications`//
CREATE DEFINER=`root`@`localhost` PROCEDURE `desactivateNotifications` (IN `id` INT)   BEGIN
UPDATE tbl_alertas as a
SET a.id_status = 2
WHERE a.id_usuario = id;
END//

DROP PROCEDURE IF EXISTS `desactivateProduct`//
CREATE DEFINER=`root`@`localhost` PROCEDURE `desactivateProduct` (IN `id` INT)   BEGIN 
UPDATE tbl_productos 
SET id_status = 2
WHERE codigo_producto = id;
END//

DROP PROCEDURE IF EXISTS `finderProduct`//
CREATE DEFINER=`root`@`localhost` PROCEDURE `finderProduct` (IN `buscar` VARCHAR(255))   BEGIN
  SELECT p.nombre, p.codigo_producto, p.precio_unitario, p.cantidad
  FROM tbl_productos AS p
  WHERE p.id_status = 1 AND p.cantidad > 0 AND (p.nombre LIKE CONCAT('%', buscar, '%') OR p.codigo_producto LIKE CONCAT('%', buscar, '%'));
END//

DROP PROCEDURE IF EXISTS `finderProgram`//
CREATE DEFINER=`root`@`localhost` PROCEDURE `finderProgram` (IN `buscar` VARCHAR(60))   BEGIN
  SELECT p.nombre, p.id_programa FROM tbl_programa AS p
  WHERE  p.id_status = 1  AND (p.nombre LIKE CONCAT('%', buscar, '%') OR p.id_programa LIKE CONCAT('%', buscar, '%') );
END//

DROP PROCEDURE IF EXISTS `getAlert`//
CREATE DEFINER=`root`@`localhost` PROCEDURE `getAlert` (IN `idusuario` INT)   BEGIN
SELECT a.id_alerta,a.codigo_productos,p.nombre,a.Mensaje,a.relevancia, p.cantidad FROM tbl_alertas as a 
INNER JOIN tbl_productos as p on a.codigo_productos = p.codigo_producto
WHERE a.id_usuario = idusuario AND a.id_status = 1;
END//

DROP PROCEDURE IF EXISTS `getBudget`//
CREATE DEFINER=`root`@`localhost` PROCEDURE `getBudget` (IN `id` INT)   BEGIN
SELECT p.presupuesto FROM tbl_programa_productos pp 
INNER JOIN tbl_programa p on pp.id_programa = p.id_programa
WHERE pp.id_programa_productos = id;
END//

DROP PROCEDURE IF EXISTS `getDashboardData`//
CREATE DEFINER=`root`@`localhost` PROCEDURE `getDashboardData` ()   BEGIN
SELECT 'productos' AS items, COUNT(*) AS contador FROM tbl_productos
UNION ALL
SELECT 'categorias' AS items, COUNT(*) AS contador FROM tbl_categoria
UNION ALL
SELECT 'usuarios' AS items, COUNT(*) AS contador FROM tbl_usuarios
UNION ALL 
SELECT 'programas' AS items, COUNT(*) AS contador FROM tbl_programa;
END//

DROP PROCEDURE IF EXISTS `getDetailProduct`//
CREATE DEFINER=`root`@`localhost` PROCEDURE `getDetailProduct` (IN `id` INT)   BEGIN
SELECT pp.id_detalle_programa_productos, pp.cantidad, pp.precio_unitario, pp.importe, p.nombre as producto FROM tbl_detalle_programa_productos as pp
INNER JOIN tbl_productos as p on pp.codigo_producto = p.codigo_producto
where pp.id_programa_productos = id;
END//

DROP PROCEDURE IF EXISTS `getEditProgramProduct`//
CREATE DEFINER=`root`@`localhost` PROCEDURE `getEditProgramProduct` (IN `valor` INT)   BEGIN
SELECT pp.id_programa, pp.total, pp.cantidad FROM tbl_programa_productos as pp WHERE id_programa_productos = valor;
END//

DROP PROCEDURE IF EXISTS `getInfoStock`//
CREATE DEFINER=`root`@`localhost` PROCEDURE `getInfoStock` ()   BEGIN 
SELECT nombre as producto, cantidad FROM tbl_productos 
WHERE id_status = 1 AND cantidad <= 10;
END//

DROP PROCEDURE IF EXISTS `getInventory`//
CREATE DEFINER=`root`@`localhost` PROCEDURE `getInventory` ()   begin
select i.id_inventario, i.codigo_producto, i.cantidad, i.id_status, i.fecha_llegada_producto, i.fecha_registro, p.nombre as producto, s.nombre as status, c.nombre as categoriaa, u.usuario as usuario from tbl_inventario as i
inner join tbl_productos as p on i.codigo_producto = p.codigo_producto 
inner join tbl_status as s on i.id_status = s.id_status
inner join tbl_categoria as c on p.id_categoria = c.id_categoria
inner join tbl_usuarios as u on i.id_usuario = u.id_usuario;

end//

DROP PROCEDURE IF EXISTS `getProductInactive`//
CREATE DEFINER=`root`@`localhost` PROCEDURE `getProductInactive` ()   BEGIN
SELECT 	p.codigo_producto, 
		p.nombre, 
        (SELECT a.usuario FROM tbl_usuarios as a WHERE a.id_usuario = p.id_usuario) as usuario,
		p.precio_unitario, 
        p.cantidad, 
        p.numero_contrato, 
        p.numero_oferta_compra, 
        p.fecha_recepcion, 
        (SELECT c.nombre from tbl_categoria as c WHERE c.id_categoria = p.id_categoria) as categoria 
FROM tbl_productos as p WHERE p.id_status = 2;
END//

DROP PROCEDURE IF EXISTS `getProgram`//
CREATE DEFINER=`root`@`localhost` PROCEDURE `getProgram` ()   BEGIN
   SELECT p.id_programa, p.nombre, p.descripcion, p.presupuesto, p.fecha, p.id_status, s.nombre AS status
    FROM tbl_programa AS p
    INNER JOIN tbl_status AS s ON p.id_status = s.id_status;
END//

DROP PROCEDURE IF EXISTS `getProgramProduct`//
CREATE DEFINER=`root`@`localhost` PROCEDURE `getProgramProduct` ()   begin
SELECT  pp.id_programa_productos, 
 pp.fecha as fechacreacion,
		pp.total as costo,
        pp.cantidad as cantidad,
        u.nombres as usuario,
        p.nombre as programa,
        s.nombre as status 
FROM tbl_programa_productos as pp  
INNER JOIN tbl_usuarios as u on pp.id_usuario = u.id_usuario
INNER JOIN tbl_programa as p on pp.id_programa = p.id_programa
INNER JOIN tbl_status as s on pp.id_status = s.id_status;
END//

DROP PROCEDURE IF EXISTS `getReporteHistorialEntrada`//
CREATE DEFINER=`root`@`localhost` PROCEDURE `getReporteHistorialEntrada` (IN `fechaInicio` DATE, IN `fechaFin` DATE, IN `Istatus` INT)   BEGIN
    IF fechaInicio = "0000-00-00" AND fechaFin = "0000-00-00" THEN
        SELECT i.codigo_producto, p.nombre AS producto, i.cantidad AS cantidad, i.fecha_llegada_producto AS fechaLlegada, i.fecha_registro AS fechaRegistro, p.precio_unitario AS preciounitario,
        i.id_status as status
        FROM tbl_inventario AS i
        INNER JOIN tbl_productos AS p ON i.codigo_producto = p.codigo_producto
        WHERE i.id_status = Istatus
        ORDER BY p.nombre ASC, i.cantidad DESC;
    ELSE
        SELECT i.codigo_producto, p.nombre AS producto, i.cantidad AS cantidad, i.fecha_llegada_producto AS fechaLlegada, i.fecha_registro AS fechaRegistro, p.precio_unitario AS preciounitario,i.id_status as status
        FROM tbl_inventario AS i
        INNER JOIN tbl_productos AS p ON i.codigo_producto = p.codigo_producto
        WHERE (i.fecha_registro >= fechaInicio OR fechaInicio IS NULL) AND (i.fecha_registro <= fechaFin OR fechaFin IS NULL) AND (i.id_status = Istatus)
        ORDER BY p.nombre ASC, i.cantidad DESC;
    END IF;
END//

DROP PROCEDURE IF EXISTS `getReporteHistorialSalida`//
CREATE DEFINER=`root`@`localhost` PROCEDURE `getReporteHistorialSalida` (IN `fechaInicio` DATE, IN `fechaFin` DATE, IN `ppstatus` INT)   BEGIN
    IF fechaInicio = "0000-00-00" AND fechaFin = "0000-00-00" THEN
        SELECT dpp.codigo_producto, 
               p.nombre AS producto, 
               dpp.cantidad AS cantidadDPP, 
               p.precio_unitario,
               dpp.importe AS importe,
               pp.fecha AS fechaprogramaproducto,
               pp.cantidad AS cantidadtotalproductos,
               pr.nombre AS programa,
               pr.presupuesto,
               u.usuario,
               dpp.id_programa_productos
        FROM tbl_detalle_programa_productos AS dpp
        INNER JOIN tbl_productos AS p ON dpp.codigo_producto = p.codigo_producto
        INNER JOIN tbl_programa_productos AS pp ON dpp.id_programa_productos = pp.id_programa_productos
        INNER JOIN tbl_programa AS pr ON pp.id_programa = pr.id_programa 
        INNER JOIN tbl_usuarios AS u ON pp.id_usuario = u.id_usuario
        WHERE pp.id_status = ppstatus
        ORDER BY pr.nombre ASC, dpp.id_programa_productos DESC;
    ELSE
        SELECT dpp.codigo_producto, 
               p.nombre AS producto, 
               dpp.cantidad AS cantidadDPP, 
               p.precio_unitario,
               dpp.importe AS importe,
               pp.fecha AS fechaprogramaproducto,
               pp.cantidad AS cantidadtotalproductos,
               pr.nombre AS programa,
               pr.presupuesto,
               u.usuario,
               dpp.id_programa_productos
        FROM tbl_detalle_programa_productos AS dpp
        INNER JOIN tbl_productos AS p ON dpp.codigo_producto = p.codigo_producto
        INNER JOIN tbl_programa_productos AS pp ON dpp.id_programa_productos = pp.id_programa_productos
        INNER JOIN tbl_programa AS pr ON pp.id_programa = pr.id_programa 
        INNER JOIN tbl_usuarios AS u ON pp.id_usuario = u.id_usuario
        WHERE (pp.fecha >= fechaInicio OR fechaInicio IS NULL) AND (pp.fecha <= fechaFin OR fechaFin IS NULL) AND (pp.id_status = ppstatus)
        ORDER BY pr.nombre ASC, dpp.id_programa_productos DESC;
    END IF;
END//

DROP PROCEDURE IF EXISTS `getReporteInventarioActual`//
CREATE DEFINER=`root`@`localhost` PROCEDURE `getReporteInventarioActual` (IN `Pstatus` INT)   BEGIN
SELECT p.nombre as producto, p.cantidad as cantidadactual, p.precio_unitario as preciounitario, p.numero_contrato, p.numero_oferta_compra, p.fecha_recepcion, c.nombre
FROM tbl_productos AS p 
INNER JOIN tbl_categoria as c on p.id_categoria = c.id_categoria
WHERE p.id_status = Pstatus 
ORDER BY p.nombre ASC;
END//

DROP PROCEDURE IF EXISTS `getReporteProductosBajoStock`//
CREATE DEFINER=`root`@`localhost` PROCEDURE `getReporteProductosBajoStock` (IN `pstatus` INT)   BEGIN
SELECT p.codigo_producto,p.nombre,p.precio_unitario,p.cantidad,p.numero_contrato,p.numero_oferta_compra,p.fecha_recepcion,c.nombre FROM tbl_productos as p
INNER JOIN tbl_categoria as c on  p.id_categoria = c.id_categoria
WHERE p.cantidad <= 10 AND p.id_status = pstatus;
END//

DROP PROCEDURE IF EXISTS `infoDetailProgramProduct`//
CREATE DEFINER=`root`@`localhost` PROCEDURE `infoDetailProgramProduct` (IN `id` INT)   BEGIN 
Select dpp.cantidad, dpp.precio_unitario, dpp.importe, pp.fecha, pp.total ,pp.cantidad, p.nombre, p.descripcion, p.presupuesto, p.fecha From tbl_detalle_programa_productos as dpp
inner join tbl_programa_productos as pp on dpp.id_programa_productos = pp.id_programa_productos
inner join tbl_programa as p on pp.id_programa = p.id_programa
WHERE dpp.id_detalle_programa_productos = id;
END//

DROP PROCEDURE IF EXISTS `insertGestorProgram`//
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertGestorProgram` (IN `id_usuario` INT, IN `id_programa` INT, IN `fecha` DATE, IN `total` DECIMAL(10,2), IN `cantidad` INT, IN `id_status` INT)   BEGIN 
INSERT into tbl_programa_productos(id_usuario,id_programa, fecha, total, cantidad, id_status)
VALUES(id_usuario,id_programa,fecha,total,cantidad,id_status);

END//

DROP PROCEDURE IF EXISTS `insertProduct`//
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertProduct` (IN `codigo_producto` INT, IN `nombre` VARCHAR(50), IN `precio_unitario` DECIMAL(10,2), IN `cantidad` INT, IN `numero_contrato` TEXT, IN `numero_oferta_compra` TEXT, IN `fecha_recepcion` DATE, IN `idCategoria` INT, IN `idStatus` INT, IN `token` TEXT)   BEGIN

DECLARE idUsuario int;

set idUsuario = (SELECT u.id_usuario FROM tbl_usuarios as u WHERE u.token = token);

INSERT INTO tbl_productos 
(codigo_producto, nombre, id_usuario ,precio_unitario, cantidad, numero_contrato, numero_oferta_compra, fecha_recepcion, id_categoria, id_status) 
VALUES 
(codigo_producto, nombre, idUsuario, precio_unitario, cantidad, numero_contrato, numero_oferta_compra, fecha_recepcion, idCategoria, idStatus);

END//

DROP PROCEDURE IF EXISTS `insertProductInventory`//
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertProductInventory` (IN `nombreproducto` VARCHAR(50), IN `cantidad` INT, IN `fechallegadaproducto` DATE, IN `fecharegistro` DATE, IN `idstatus` INT, IN `token` TEXT)   BEGIN

DECLARE idUsuario int;

set idUsuario = (SELECT u.id_usuario FROM tbl_usuarios as u WHERE u.token = token);

  INSERT INTO tbl_inventario (codigo_producto, id_usuario, cantidad, fecha_llegada_producto, fecha_registro, id_status)
  VALUES ( (SELECT codigo_producto FROM tbl_productos WHERE nombre = nombreproducto), idUsuario ,cantidad, fechallegadaproducto, fecharegistro, idstatus);

END//

DROP PROCEDURE IF EXISTS `InventorytoProductStock`//
CREATE DEFINER=`root`@`localhost` PROCEDURE `InventorytoProductStock` (IN `codigoproducto` INT, IN `cantidadinventario` INT, IN `fechallegadaproducto` DATE, IN `fecharegistro` DATE, IN `idstatus` INT, IN `token` TEXT)   BEGIN
declare stockActual int;
DECLARE idUsuario int;
	SET idUsuario = (SELECT u.id_usuario FROM tbl_usuarios as u WHERE u.token = token);

    -- Insertar datos en la tabla tbl_inventario
    INSERT INTO tbl_inventario (codigo_producto , id_usuario ,cantidad, fecha_llegada_producto, fecha_registro, id_status )
    VALUES (codigoproducto, idUsuario ,cantidadinventario, fechallegadaproducto, fecharegistro, idstatus);

    -- Actualizar la columna cantidad en la tabla tbl_productos
    UPDATE tbl_productos
    SET cantidad = cantidad + cantidadinventario
    WHERE codigo_producto = codigoproducto;
    
        SET stockActual = (SELECT cantidad FROM tbl_productos WHERE codigo_producto = codigoproducto);

              IF stockActual <= 10 AND stockActual >= 6 THEN
                CALL setAlert(codigoproducto, 'Niveles bajos de producto', 1, 2);
            ELSEIF stockActual < 6 AND stockActual >= 0 THEN
                CALL setAlert(codigoproducto, 'Niveles escasos de producto', 1, 1);
            ELSEIF stockActual > 10 THEN
                CALL setAlert(codigoproducto, 'Niveles normales de producto', 2, 3);
            END IF;
    
END//

DROP PROCEDURE IF EXISTS `managerDetailProduct`//
CREATE DEFINER=`root`@`localhost` PROCEDURE `managerDetailProduct` (IN `codigoproducto` INT, IN `stock` INT, IN `idProgramaProductos` INT)   BEGIN
    DECLARE nuevoImporte DECIMAL(10, 2);
        DECLARE stockActual INT;
 SET nuevoImporte = (
        SELECT (p.precio_unitario*stock)+(SELECT pp.total FROM tbl_programa_productos as pp WHERE pp.id_programa_productos = idProgramaProductos) as importe FROM tbl_productos as p WHERE codigo_producto = codigoproducto
    );

    
    IF stock <= (SELECT cantidad FROM tbl_productos WHERE codigo_producto = codigoproducto) THEN
          IF nuevoImporte <= (select presupuesto from tbl_programa where id_programa = (SELECT pp.id_programa FROM tbl_programa_productos as pp WHERE pp.id_programa_productos = idProgramaProductos)) THEN
            IF EXISTS (
                SELECT codigo_producto, id_programa_productos
                FROM tbl_detalle_programa_productos
                WHERE codigo_producto = codigoproducto AND id_programa_productos = idProgramaProductos
            ) THEN
                UPDATE tbl_detalle_programa_productos
                SET cantidad = cantidad + stock,
                    importe = precio_unitario * cantidad
                WHERE codigo_producto = codigoproducto AND id_programa_productos = idProgramaProductos;
            ELSE
                INSERT INTO tbl_detalle_programa_productos (
                    id_programa_productos,
                    cantidad,
                    precio_unitario,
                    importe,
                    codigo_producto
                )
                VALUES (
                    idProgramaProductos,
                    stock,
                    (SELECT precio_unitario FROM tbl_productos WHERE codigo_producto = codigoproducto),
                    stock * (SELECT precio_unitario FROM tbl_productos WHERE codigo_producto = codigoproducto),
                    codigoproducto
                );
            END IF;
            
            UPDATE tbl_productos
            SET cantidad = cantidad - stock
            WHERE codigo_producto = codigoproducto;
            
            UPDATE tbl_programa_productos
            SET cantidad = cantidad + stock,
               total = total + 
                (
                    SELECT (p.precio_unitario*stock) as importe FROM tbl_productos as p WHERE codigo_producto = codigoproducto
                )
            WHERE id_programa_productos = idProgramaProductos;

           SET stockActual = (SELECT cantidad FROM tbl_productos WHERE codigo_producto = codigoproducto);

              IF stockActual <= 10 AND stockActual >= 6 THEN
                CALL setAlert(codigoproducto, 'Niveles bajos de producto', 1, 2);
            ELSEIF stockActual < 6 AND stockActual >= 0 THEN
                CALL setAlert(codigoproducto, 'Niveles escasos de producto', 1, 1);
            ELSEIF stockActual > 10 THEN
                CALL setAlert(codigoproducto, 'Niveles normales de producto', 2, 3);
            END IF;
        ELSE
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'INSFP310';
        END IF;
    ELSE
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'INSFP320';
    END IF;
END//

DROP PROCEDURE IF EXISTS `reactiveProduct`//
CREATE DEFINER=`root`@`localhost` PROCEDURE `reactiveProduct` (IN `id` INT)   BEGIN
UPDATE tbl_productos 
SET id_status = 1
WHERE codigo_producto = id;
END//

DROP PROCEDURE IF EXISTS `setAlert`//
CREATE DEFINER=`root`@`localhost` PROCEDURE `setAlert` (IN `Acodigoproducto` INT, IN `Amensaje` TEXT, IN `Astatus` INT, IN `Arelevancia` INT)   BEGIN 
    DECLARE idUsuario INT;
    DECLARE done INT DEFAULT FALSE;
    DECLARE existeProducto INT DEFAULT 0;

    -- Cursor para obtener los id_usuario existentes en tbl_usuarios
    DECLARE cursorUsuarios CURSOR FOR SELECT id_usuario FROM tbl_usuarios;

    -- Manejador para no encontrado
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

    -- Verificar si el código de producto existe en la tabla "alertas"
    SELECT COUNT(*) INTO existeProducto FROM tbl_alertas WHERE codigo_productos = Acodigoproducto;

    -- Abrir el cursor
    OPEN cursorUsuarios;

    -- Recorrer los id_usuario existentes
    usuario_loop: LOOP
        FETCH cursorUsuarios INTO idUsuario;
        IF done THEN
            LEAVE usuario_loop;
        END IF;

        IF existeProducto > 0 THEN
            -- Realizar el UPDATE en tbl_alertas con el id_usuario actual
                       UPDATE tbl_alertas
            SET Mensaje = Amensaje,
                id_status = Astatus,
                relevancia = Arelevancia
            WHERE codigo_productos = Acodigoproducto;
        ELSE
            -- Realizar el INSERT en tbl_alertas con el id_usuario actual
            INSERT INTO tbl_alertas (codigo_productos, Mensaje, id_usuario, id_status, relevancia)
            VALUES (Acodigoproducto, Amensaje, idUsuario, Astatus, Arelevancia);
        END IF;
    END LOOP;

    -- Cerrar el cursor
    CLOSE cursorUsuarios;
END//

DROP PROCEDURE IF EXISTS `updateProgramProduct`//
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateProgramProduct` (IN `idPrograma` INT, IN `total` DECIMAL(10,2), IN `cantidad` INT, IN `idProgramaProducto` INT)   BEGIN
  
        UPDATE tbl_programa_productos AS pp
        SET pp.id_programa = idPrograma,
            pp.total = total,
            pp.cantidad = cantidad
            WHERE pp.id_programa_productos = idProgramaProducto;

END//

DROP PROCEDURE IF EXISTS `z`//
CREATE DEFINER=`root`@`localhost` PROCEDURE `z` (IN `idusuario` INT)   BEGIN
SELECT a.codigo_productos,p.nombre,a.Mensaje,a.relevancia FROM tbl_alertas as a 
INNER JOIN tbl_productos as p on a.codigo_productos = p.codigo_producto
WHERE a.id_usuario = idusuario;
END//

DELIMITER ;