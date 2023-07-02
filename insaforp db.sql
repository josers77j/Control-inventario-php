-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 02-07-2023 a las 19:44:02
-- Versión del servidor: 8.0.31
-- Versión de PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `insaforp`
--

DELIMITER $$
--
-- Procedimientos
--
DROP PROCEDURE IF EXISTS `anularGestorProgram`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `anularGestorProgram` (IN `id` INT)   BEGIN
UPDATE tbl_programa_productos  as pp
SET pp.id_status = 2
WHERE pp.id_programa_productos = id;
END$$

DROP PROCEDURE IF EXISTS `anularInventario`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `anularInventario` (IN `identificador` INT)   BEGIN
    DECLARE cantidad_inventario INT;
    DECLARE cantidad_restar INT;

    -- Obtener la cantidad de productos a restar del inventario
    SELECT i.cantidad INTO cantidad_restar
    FROM tbl_inventario AS i
    WHERE i.id_inventario = identificador;

    -- Verificar si la cantidad de productos es válida para restar
    IF cantidad_restar <= 0 THEN
        -- Realizar un rollback y mostrar mensaje de error
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'La cantidad de productos a restar no es válida.';
    END IF;

    -- Verificar si hay suficientes productos en inventario para restar
    SELECT cantidad INTO cantidad_inventario
    FROM tbl_productos AS p
    WHERE p.codigo_producto = (SELECT i.codigo_producto FROM tbl_inventario AS i WHERE i.id_inventario = identificador);

    IF cantidad_inventario < cantidad_restar THEN
        -- Realizar un rollback y mostrar mensaje de error
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No hay suficientes productos en inventario.';
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

    -- Confirmar la transacción
    COMMIT;
END$$

DROP PROCEDURE IF EXISTS `anularProgram`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `anularProgram` (IN `id` INT)   BEGIN
UPDATE tbl_programa  as p
SET p.id_status = 2
WHERE p.id_programa = id;
END$$

DROP PROCEDURE IF EXISTS `deleteDetailProduct`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `deleteDetailProduct` (IN `id` INT)   BEGIN 
    UPDATE tbl_productos
    SET cantidad = cantidad + (SELECT cantidad FROM tbl_detalle_programa_productos WHERE id_detalle_programa_productos = id)
    WHERE codigo_producto = (SELECT codigo_producto FROM tbl_detalle_programa_productos WHERE id_detalle_programa_productos = id);

    UPDATE tbl_programa_productos
    SET cantidad = cantidad - (SELECT cantidad FROM tbl_detalle_programa_productos WHERE id_detalle_programa_productos = id),
        total = total - (SELECT importe FROM tbl_detalle_programa_productos WHERE id_detalle_programa_productos = id)
    WHERE id_programa_productos = (SELECT id_programa_productos FROM tbl_detalle_programa_productos WHERE id_detalle_programa_productos = id);

    DELETE FROM tbl_detalle_programa_productos WHERE id_detalle_programa_productos = id;
END$$

DROP PROCEDURE IF EXISTS `finderProduct`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `finderProduct` (IN `buscar` VARCHAR(255))   BEGIN
  SELECT p.nombre, p.codigo_producto, p.precio_unitario
  FROM tbl_productos AS p
  WHERE p.id_status = 1 AND p.cantidad > 0 AND (p.nombre LIKE CONCAT('%', buscar, '%') OR p.codigo_producto LIKE CONCAT('%', buscar, '%'));
END$$

DROP PROCEDURE IF EXISTS `finderProgram`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `finderProgram` (IN `buscar` VARCHAR(60))   BEGIN
  SELECT p.nombre, p.id_programa FROM tbl_programa AS p
  WHERE  p.id_status = 1  AND (p.nombre LIKE CONCAT('%', buscar, '%') OR p.id_programa LIKE CONCAT('%', buscar, '%') );
END$$

DROP PROCEDURE IF EXISTS `getBudget`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getBudget` (IN `id` INT)   BEGIN
SELECT p.presupuesto FROM tbl_programa_productos pp 
INNER JOIN tbl_programa p on pp.id_programa = p.id_programa
WHERE pp.id_programa_productos = id;
END$$

DROP PROCEDURE IF EXISTS `getDetailProduct`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getDetailProduct` (IN `id` INT)   BEGIN
SELECT pp.id_detalle_programa_productos, pp.cantidad, pp.precio_unitario, pp.importe, p.nombre as producto FROM tbl_detalle_programa_productos as pp
INNER JOIN tbl_productos as p on pp.codigo_producto = p.codigo_producto
where pp.id_programa_productos = id;
END$$

DROP PROCEDURE IF EXISTS `getEditProgramProduct`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getEditProgramProduct` (IN `valor` INT)   BEGIN
SELECT pp.id_programa, pp.total, pp.cantidad FROM tbl_programa_productos as pp WHERE id_programa_productos = valor;
END$$

DROP PROCEDURE IF EXISTS `getInventory`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getInventory` ()   begin
select i.id_inventario, i.codigo_producto, i.cantidad, i.id_status, i.fecha_llegada_producto, i.fecha_registro, p.nombre as producto, s.nombre as status, c.nombre as categoriaa from tbl_inventario as i
inner join tbl_productos as p on i.codigo_producto = p.codigo_producto 
inner join tbl_status as s on i.id_status = s.id_status
inner join tbl_categoria as c on p.id_categoria = c.id_categoria;
end$$

DROP PROCEDURE IF EXISTS `getProgram`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `getProgram` ()   BEGIN
   SELECT p.id_programa, p.nombre, p.descripcion, p.presupuesto, p.fecha, p.id_status, s.nombre AS status
    FROM tbl_programa AS p
    INNER JOIN tbl_status AS s ON p.id_status = s.id_status;
END$$

DROP PROCEDURE IF EXISTS `getProgramProduct`$$
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
END$$

DROP PROCEDURE IF EXISTS `infoDetailProgramProduct`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `infoDetailProgramProduct` (IN `id` INT)   BEGIN 
Select dpp.cantidad, dpp.precio_unitario, dpp.importe, pp.fecha, pp.total ,pp.cantidad, p.nombre, p.descripcion, p.presupuesto, p.fecha From tbl_detalle_programa_productos as dpp
inner join tbl_programa_productos as pp on dpp.id_programa_productos = pp.id_programa_productos
inner join tbl_programa as p on pp.id_programa = p.id_programa
WHERE dpp.id_detalle_programa_productos = id;
END$$

DROP PROCEDURE IF EXISTS `insertGestorProgram`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `insertGestorProgram` (IN `id_usuario` INT, IN `id_programa` INT, IN `fecha` DATE, IN `total` DECIMAL(10,2), IN `cantidad` INT, IN `id_status` INT)   BEGIN 
INSERT into tbl_programa_productos(id_usuario,id_programa, fecha, total, cantidad, id_status)
VALUES(id_usuario,id_programa,fecha,total,cantidad,id_status);

END$$

DROP PROCEDURE IF EXISTS `InventorytoProductStock`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `InventorytoProductStock` (IN `codigoproducto` INT, IN `cantidadinventario` INT, IN `fechallegadaproducto` DATE, IN `fecharegistro` DATE, IN `idstatus` INT)   BEGIN
    -- Insertar datos en la tabla tbl_inventario
    INSERT INTO tbl_inventario (codigo_producto , cantidad, fecha_llegada_producto, fecha_registro, id_status )
    VALUES (codigoproducto, cantidadinventario, fechallegadaproducto, fecharegistro, idstatus);

    -- Actualizar la columna cantidad en la tabla tbl_productos
    UPDATE tbl_productos
    SET cantidad = cantidad + cantidadinventario
    WHERE codigo_producto = codigoproducto;
END$$

DROP PROCEDURE IF EXISTS `managerDetailProduct`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `managerDetailProduct` (IN `codigoproducto` INT, IN `stock` INT, IN `idProgramaProductos` INT)   BEGIN
    DECLARE nuevoImporte DECIMAL(10, 2);
    
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
        ELSE
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'El importe total excede el presupuesto del programa.';
        END IF;
    ELSE
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'La cantidad excede las existencias.';
    END IF;
END$$

DROP PROCEDURE IF EXISTS `updateProgramProduct`$$
CREATE DEFINER=`root`@`localhost` PROCEDURE `updateProgramProduct` (IN `idPrograma` INT, IN `total` DECIMAL(10,2), IN `cantidad` INT, IN `idProgramaProducto` INT)   BEGIN
  
        UPDATE tbl_programa_productos AS pp
        SET pp.id_programa = idPrograma,
            pp.total = total,
            pp.cantidad = cantidad
            WHERE pp.id_programa_productos = idProgramaProducto;

END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_alertas`
--

DROP TABLE IF EXISTS `tbl_alertas`;
CREATE TABLE IF NOT EXISTS `tbl_alertas` (
  `id_alerta` int NOT NULL AUTO_INCREMENT,
  `codigo_productos` int DEFAULT NULL,
  `id_usuario` int DEFAULT NULL,
  `id_status` int DEFAULT NULL,
  `relevancia` int DEFAULT NULL,
  PRIMARY KEY (`id_alerta`),
  KEY `id_status` (`id_status`),
  KEY `id_usuario` (`id_usuario`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_categoria`
--

DROP TABLE IF EXISTS `tbl_categoria`;
CREATE TABLE IF NOT EXISTS `tbl_categoria` (
  `id_categoria` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  PRIMARY KEY (`id_categoria`)
) ENGINE=InnoDB AUTO_INCREMENT=122 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_categoria`
--

INSERT INTO `tbl_categoria` (`id_categoria`, `nombre`, `descripcion`) VALUES
(28, 'Suministros de impresión', 'Incluye cartuchos de tinta, tóner, papel de impresión, papel fotográfico y otros insumos necesarios para la impresión.'),
(29, 'Material de escritorio', 'Esta categoría incluye artículos como organizadores de escritorio, portalápices, portanotas, bandejas de entrada y salida, calendarios, relojes, lámparas de escritorio, entre otros.'),
(113, 'Equipos electrónicos', 'Esta categoría abarca los dispositivos electrónicos utilizados en una oficina, como computadoras, impresoras, escáneres, fotocopiadoras, teléfonos, fax, proyectores, calculadoras, entre otros.'),
(121, 'Papeleria', 'Esta categoría incluye productos como papel, bolígrafos, lápices, cuadernos, sobres, carpetas, clips, grapadoras, cintas adhesivas, notas adhesivas, entre otros.');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_detalle_programa_productos`
--

DROP TABLE IF EXISTS `tbl_detalle_programa_productos`;
CREATE TABLE IF NOT EXISTS `tbl_detalle_programa_productos` (
  `id_detalle_programa_productos` int NOT NULL AUTO_INCREMENT,
  `id_programa_productos` int DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL,
  `importe` decimal(10,2) DEFAULT NULL,
  `codigo_producto` int DEFAULT NULL,
  PRIMARY KEY (`id_detalle_programa_productos`),
  KEY `codigo_producto` (`codigo_producto`),
  KEY `id_programa_productos` (`id_programa_productos`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_detalle_programa_productos`
--

INSERT INTO `tbl_detalle_programa_productos` (`id_detalle_programa_productos`, `id_programa_productos`, `cantidad`, `precio_unitario`, `importe`, `codigo_producto`) VALUES
(79, 2, 5, '2.99', '14.95', 1007),
(80, 2, 12, '10.00', '120.00', 1006),
(91, 4, 10, '10.00', '100.00', 1005),
(92, 8, 10, '10.00', '100.00', 1006),
(93, 3, 5, '4.00', '20.00', 1002);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_inventario`
--

DROP TABLE IF EXISTS `tbl_inventario`;
CREATE TABLE IF NOT EXISTS `tbl_inventario` (
  `id_inventario` int NOT NULL AUTO_INCREMENT,
  `codigo_producto` int DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  `fecha_llegada_producto` date DEFAULT NULL,
  `fecha_registro` date DEFAULT NULL,
  `id_status` int NOT NULL,
  PRIMARY KEY (`id_inventario`),
  KEY `codigo_producto` (`codigo_producto`),
  KEY `id_status` (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_inventario`
--

INSERT INTO `tbl_inventario` (`id_inventario`, `codigo_producto`, `cantidad`, `fecha_llegada_producto`, `fecha_registro`, `id_status`) VALUES
(1, 1006, 5, '2023-06-23', '2023-06-23', 2),
(2, 1006, 2, '2023-06-23', '2023-06-23', 2),
(3, 1006, 3, '2023-06-23', '2023-06-23', 2),
(4, 1005, 5, '2023-06-23', '2023-06-23', 2),
(5, 1006, 2, '2023-06-23', '2023-06-23', 2),
(6, 1006, 3, '2023-06-23', '2023-06-23', 2),
(7, 1005, 1, '2023-06-23', '2023-06-23', 1),
(8, 1005, 1, '2023-06-23', '2023-06-23', 1),
(9, 1007, 35, '2023-06-29', '2023-06-29', 2),
(10, 1005, 35, '2023-06-30', '2023-06-29', 1),
(11, 1006, 25, '2023-06-30', '2023-06-29', 1),
(12, 1002, 1, '2023-06-30', '2023-06-30', 1),
(13, 1005, 10, '2023-07-01', '2023-07-01', 1),
(14, 1002, 10, '2023-07-01', '2023-07-01', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_productos`
--

DROP TABLE IF EXISTS `tbl_productos`;
CREATE TABLE IF NOT EXISTS `tbl_productos` (
  `codigo_producto` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `precio_unitario` decimal(10,2) DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  `numero_contrato` text,
  `numero_oferta_compra` text NOT NULL,
  `fecha_recepcion` date DEFAULT NULL,
  `id_categoria` int DEFAULT NULL,
  `id_status` int DEFAULT NULL,
  PRIMARY KEY (`codigo_producto`),
  KEY `id_categoria` (`id_categoria`),
  KEY `id_status` (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=1008 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_productos`
--

INSERT INTO `tbl_productos` (`codigo_producto`, `nombre`, `precio_unitario`, `cantidad`, `numero_contrato`, `numero_oferta_compra`, `fecha_recepcion`, `id_categoria`, `id_status`) VALUES
(1002, 'regleta de papel bond', '4.00', 15, '0552255', '588589', '2023-06-14', 29, 1),
(1005, 'papel', '10.00', 35, '55', '26', '2023-01-01', 113, 1),
(1006, 'lapiceros', '10.00', 65, '25', '20', '2023-06-13', 28, 1),
(1007, 'Computadora', '2.99', 0, '2', '2', '2023-06-25', 113, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_programa`
--

DROP TABLE IF EXISTS `tbl_programa`;
CREATE TABLE IF NOT EXISTS `tbl_programa` (
  `id_programa` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` text CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci,
  `presupuesto` decimal(10,2) DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `id_status` int NOT NULL,
  PRIMARY KEY (`id_programa`),
  KEY `id_status` (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_programa`
--

INSERT INTO `tbl_programa` (`id_programa`, `nombre`, `descripcion`, `presupuesto`, `fecha`, `id_status`) VALUES
(29, 'SQL server 1', 'Programa sobre base de datos basico', '500.00', '2023-06-16', 1),
(32, 'Excel Basico', 'Excel basico para estudiantes.', '600.00', '2023-06-25', 2),
(33, 'HTML5 y CSS3 ', 'Fundamentos de HTML y CSS basicos.', '350.00', '2023-06-25', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_programa_productos`
--

DROP TABLE IF EXISTS `tbl_programa_productos`;
CREATE TABLE IF NOT EXISTS `tbl_programa_productos` (
  `id_programa_productos` int NOT NULL AUTO_INCREMENT,
  `id_usuario` int DEFAULT NULL,
  `id_programa` int DEFAULT NULL,
  `fecha` date DEFAULT NULL,
  `total` decimal(10,2) DEFAULT NULL,
  `cantidad` int DEFAULT NULL,
  `id_status` int NOT NULL,
  PRIMARY KEY (`id_programa_productos`),
  KEY `id_programa` (`id_programa`),
  KEY `id_usuario` (`id_usuario`),
  KEY `id_status` (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_programa_productos`
--

INSERT INTO `tbl_programa_productos` (`id_programa_productos`, `id_usuario`, `id_programa`, `fecha`, `total`, `cantidad`, `id_status`) VALUES
(2, 4, 29, '2023-06-16', '134.95', 17, 2),
(3, 4, 32, '2023-06-15', '20.00', 5, 1),
(4, 4, 32, '2023-06-26', '100.00', 10, 2),
(5, 4, 29, '2023-06-29', '0.00', 0, 1),
(6, 4, 29, '2023-06-30', '0.00', 0, 1),
(7, 4, 29, '2023-06-30', '0.00', 0, 1),
(8, 4, 29, '2023-07-02', '100.00', 10, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_roles`
--

DROP TABLE IF EXISTS `tbl_roles`;
CREATE TABLE IF NOT EXISTS `tbl_roles` (
  `id_rol` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  `descripcion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_roles`
--

INSERT INTO `tbl_roles` (`id_rol`, `nombre`, `descripcion`) VALUES
(1, 'Administrador', 'Administrador de Insaforp'),
(2, 'Usuario', 'Usuario de insaforp');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_status`
--

DROP TABLE IF EXISTS `tbl_status`;
CREATE TABLE IF NOT EXISTS `tbl_status` (
  `id_status` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_status`
--

INSERT INTO `tbl_status` (`id_status`, `nombre`) VALUES
(1, 'Activo'),
(2, 'Inactivo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_usuarios`
--

DROP TABLE IF EXISTS `tbl_usuarios`;
CREATE TABLE IF NOT EXISTS `tbl_usuarios` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `token` text,
  `usuario` varchar(50) DEFAULT NULL,
  `nombres` varchar(50) DEFAULT NULL,
  `correo` varchar(50) DEFAULT NULL,
  `telefono` int DEFAULT NULL,
  `contrasenia` text,
  `id_rol` int DEFAULT '2',
  `id_status` int DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  KEY `id_rol` (`id_rol`),
  KEY `id_status` (`id_status`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

--
-- Volcado de datos para la tabla `tbl_usuarios`
--

INSERT INTO `tbl_usuarios` (`id_usuario`, `token`, `usuario`, `nombres`, `correo`, `telefono`, `contrasenia`, `id_rol`, `id_status`) VALUES
(4, NULL, 'jorguelopez', 'jorgue lopez', 'jorgue.lopez@gmail.com', 72544132, '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 1, 1),
(10, NULL, 'RubenTrejo', 'Jose Ruben Trejo ', 'josers772@outlook.es', 72154071, '$2a$07$asxx54ahjppf45sd87a5auXBm1Vr2M1NV5t/zNQtGHGpS5fFirrbG', 2, 1);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_alertas`
--
ALTER TABLE `tbl_alertas`
  ADD CONSTRAINT `tbl_alertas_ibfk_1` FOREIGN KEY (`id_status`) REFERENCES `tbl_status` (`id_status`),
  ADD CONSTRAINT `tbl_alertas_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuarios` (`id_usuario`);

--
-- Filtros para la tabla `tbl_detalle_programa_productos`
--
ALTER TABLE `tbl_detalle_programa_productos`
  ADD CONSTRAINT `tbl_detalle_programa_productos_ibfk_1` FOREIGN KEY (`codigo_producto`) REFERENCES `tbl_productos` (`codigo_producto`),
  ADD CONSTRAINT `tbl_detalle_programa_productos_ibfk_2` FOREIGN KEY (`id_programa_productos`) REFERENCES `tbl_programa_productos` (`id_programa_productos`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_inventario`
--
ALTER TABLE `tbl_inventario`
  ADD CONSTRAINT `tbl_inventario_ibfk_1` FOREIGN KEY (`codigo_producto`) REFERENCES `tbl_productos` (`codigo_producto`),
  ADD CONSTRAINT `tbl_inventario_ibfk_2` FOREIGN KEY (`id_status`) REFERENCES `tbl_status` (`id_status`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_productos`
--
ALTER TABLE `tbl_productos`
  ADD CONSTRAINT `tbl_productos_ibfk_1` FOREIGN KEY (`id_categoria`) REFERENCES `tbl_categoria` (`id_categoria`),
  ADD CONSTRAINT `tbl_productos_ibfk_2` FOREIGN KEY (`id_status`) REFERENCES `tbl_status` (`id_status`);

--
-- Filtros para la tabla `tbl_programa`
--
ALTER TABLE `tbl_programa`
  ADD CONSTRAINT `tbl_programa_ibfk_1` FOREIGN KEY (`id_status`) REFERENCES `tbl_status` (`id_status`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_programa_productos`
--
ALTER TABLE `tbl_programa_productos`
  ADD CONSTRAINT `tbl_programa_productos_ibfk_1` FOREIGN KEY (`id_programa`) REFERENCES `tbl_programa` (`id_programa`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `tbl_programa_productos_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `tbl_usuarios` (`id_usuario`),
  ADD CONSTRAINT `tbl_programa_productos_ibfk_3` FOREIGN KEY (`id_status`) REFERENCES `tbl_status` (`id_status`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_usuarios`
--
ALTER TABLE `tbl_usuarios`
  ADD CONSTRAINT `tbl_usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `tbl_roles` (`id_rol`),
  ADD CONSTRAINT `tbl_usuarios_ibfk_2` FOREIGN KEY (`id_status`) REFERENCES `tbl_status` (`id_status`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
