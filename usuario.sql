-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 09-07-2024 a las 19:22:43
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `usuario`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Apellido` varchar(100) NOT NULL,
  `Contrasena` varchar(100) NOT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Correo` varchar(100) DEFAULT NULL,
  `Fecha_registro` date NOT NULL,
  `ID_vendedor` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`ID`, `Nombre`, `Apellido`, `Contrasena`, `Telefono`, `Correo`, `Fecha_registro`, `ID_vendedor`) VALUES
(1, 'Carlos', 'Martínez', 'nkjg543843.[-', '555-1234', 'carlos.martinez@example.com', '2024-06-25', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `carrito_producto`
--

CREATE TABLE `carrito_producto` (
  `ID` int(11) NOT NULL,
  `ID_Producto` varchar(100) NOT NULL,
  `ID_Usuario` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `ID` int(11) NOT NULL,
  `Nombre_Usi` varchar(255) NOT NULL,
  `Apellido` varchar(255) NOT NULL,
  `Edad` int(11) NOT NULL,
  `Telefono` varchar(15) NOT NULL,
  `Correo` varchar(255) NOT NULL,
  `CP` varchar(10) NOT NULL,
  `Direcion` varchar(255) NOT NULL,
  `Calle` varchar(255) NOT NULL,
  `Estado` varchar(255) NOT NULL,
  `Municipio` varchar(255) NOT NULL,
  `Colonia` varchar(255) NOT NULL,
  `Referencia` varchar(255) NOT NULL,
  `DNI` varchar(20) NOT NULL,
  `Estatus` varchar(50) DEFAULT NULL,
  `Fecha_Alta` date DEFAULT NULL,
  `Fecha_Modificacion` date DEFAULT NULL,
  `Fecha_Baja` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`ID`, `Nombre_Usi`, `Apellido`, `Edad`, `Telefono`, `Correo`, `CP`, `Direcion`, `Calle`, `Estado`, `Municipio`, `Colonia`, `Referencia`, `DNI`, `Estatus`, `Fecha_Alta`, `Fecha_Modificacion`, `Fecha_Baja`) VALUES
(1, 'ded', 'de', 15, 'cds', 'pio@gmail.com', 'ds', 'adsf', 'dsf', 'afsdf', 'dsf', 'wesf', 'sdff', 'wesf', NULL, '2024-07-02', NULL, NULL),
(2, 'gf', 'dfg', 48, 'jio', 'pio@gmail.com', 'oi', 'pop', 'hgfk', 'kjfk', 'khjk', 'jhkf', 'fk', 'kfhk', NULL, '2024-07-03', NULL, NULL),
(3, 'gkhj', 'dfg', 48, 'jio', 'pio@gmail.com', 'oi', 'pop', 'hgfk', 'kjfk', 'khjk', 'jhkf', 'fk', 'kfhk', NULL, '2024-07-03', NULL, NULL),
(4, 'gkhj', 'dfg', 48, 'jio', 'pio@gmail.com', 'oi', 'pop', 'hgfk', 'kjfk', 'khjk', 'jhkf', 'fk', 'kfhk', NULL, '2024-07-03', NULL, NULL),
(5, 'gkhj', 'dfg', 48, 'jio', 'pio@gmail.com', 'oi', 'pop', 'hgfk', 'kjfk', 'khjk', 'jhkf', 'fk', 'kfhk', NULL, '2024-07-03', NULL, NULL),
(6, 'gkhjggfgfg', 'dfg', 48, 'jio', 'pio@gmail.com', 'oi', 'pop', 'hgfk', 'kjfk', 'khjk', 'jhkf', 'fk', 'kfhk', NULL, '2024-07-03', NULL, NULL),
(7, 'pppp', 'nfn', 14, 'fgbf', 'pio@gmail.com', '4214', 'fhj', 'ghj', 'fj', 'vdfvh', 'axgsf', 'esvrg', 'rty', NULL, '2024-07-03', NULL, NULL),
(8, 'pppp7575', 'nfn', 14, 'fgbf', 'pio@gmail.com', '4214', 'fhj', 'ghj', 'fj', 'vdfvh', 'axgsf', 'esvrg', 'rty', NULL, '2024-07-03', NULL, NULL),
(9, '11123', 'nfn', 14, 'fgbf', 'pio@gmail.com', '4214', 'fhj', 'ghj', 'fj', 'vdfvh', 'axgsf', 'esvrg', 'rty', NULL, '2024-07-03', NULL, NULL),
(10, '11123', 'de', 78, '225', 'pio@gmail.com', 'fhj', 'ghj', 'fj', 'vdfvh', 'axgsf', 'esvrg', 'rty', '123', NULL, '2024-07-03', NULL, NULL),
(11, '11gffr123', 'de', 78, '225', 'pio@gmail.com', 'fhj', 'ghj', 'fj', 'vdfvh', 'axgsf', 'esvrg', 'rty', '123', NULL, '2024-07-03', NULL, NULL),
(12, '11gffr123', 'de', 78, '225', 'pio@gmail.com', 'fhj', 'ghj', 'fj', 'vdfvh', 'axgsf', 'esvrg', 'rty', '123', NULL, '2024-07-03', NULL, NULL),
(13, 'sss11gffr123', 'de', 78, '225', 'pio@gmail.com', 'fhj', 'ghj', 'fj', 'vdfvh', 'axgsf', 'esvrg', 'rty', '123', NULL, '2024-07-03', NULL, NULL),
(14, 'sss11gffr123', 'de', 78, '225', 'pio@gmail.com', 'fhj', 'ghj', 'fj', 'vdfvh', 'axgsf', 'esvrg', 'rty', '123', NULL, '2024-07-03', NULL, NULL),
(15, 'xxsss11gffr123', 'de', 78, '225', 'pio@gmail.com', 'fhj', 'ghj', 'fj', 'vdfvh', 'axgsf', 'esvrg', 'rty', '123', NULL, '2024-07-03', NULL, NULL),
(16, 'xxsss11gffr123', 'de', 78, '225', 'pio@gmail.com', 'fhj', 'ghj', 'fj', 'vdfvh', 'axgsf', 'esvrg', 'rty', '123', NULL, '2024-07-03', NULL, NULL),
(17, 'xxsss11gffr123', 'de', 78, '225', 'pio@gmail.com', 'fhj', 'ghj', 'fj', 'vdfvh', 'axgsf', 'esvrg', 'rty', '123', NULL, '2024-07-03', NULL, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comentario`
--

CREATE TABLE `comentario` (
  `ID` int(11) NOT NULL,
  `Usuario_ID` int(11) NOT NULL,
  `Producto_ID` int(11) NOT NULL,
  `Marca` int(11) NOT NULL,
  `Texto` text NOT NULL,
  `Fecha` date NOT NULL,
  `Calificacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `compra_equipo`
--

CREATE TABLE `compra_equipo` (
  `ID_compra_Pro` int(11) NOT NULL,
  `Nombre_equipo` varchar(100) NOT NULL,
  `Cantidad` int(11) NOT NULL,
  `Precio` decimal(10,2) NOT NULL,
  `Fecha_compra` date NOT NULL,
  `Proveedor` varchar(100) NOT NULL,
  `Numero_factura` varchar(50) DEFAULT NULL,
  `Comentarios` text DEFAULT NULL,
  `Id_usuario` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `descuento`
--

CREATE TABLE `descuento` (
  `ID` int(11) NOT NULL,
  `ID_Compras` int(11) NOT NULL,
  `Codigo` varchar(50) NOT NULL,
  `Tipo` varchar(50) NOT NULL,
  `Valor` decimal(10,2) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  `Fecha_inicio` date NOT NULL,
  `Fecha_fin` date NOT NULL,
  `Activo` tinyint(1) NOT NULL DEFAULT 1,
  `ID_descuento` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `login_cliente`
--

CREATE TABLE `login_cliente` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(255) NOT NULL,
  `Contrasena` varchar(255) NOT NULL,
  `activacion` tinyint(1) DEFAULT 0,
  `token` varchar(255) DEFAULT NULL,
  `token_password` varchar(255) DEFAULT NULL,
  `password_request` datetime DEFAULT NULL,
  `Id_usuarios` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marca`
--

CREATE TABLE `marca` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Pais_origen` varchar(100) DEFAULT NULL,
  `Fecha_fundacion` date DEFAULT NULL,
  `Sitio_web` varchar(100) DEFAULT NULL,
  `Tipo` varchar(100) NOT NULL,
  `vendedor_ID` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `marca`
--

INSERT INTO `marca` (`ID`, `Nombre`, `Pais_origen`, `Fecha_fundacion`, `Sitio_web`, `Tipo`, `vendedor_ID`) VALUES
(1, 'Dell', 'Estados Unidos', '1984-02-01', 'https://www.dell.com', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodo_pago`
--

CREATE TABLE `metodo_pago` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Descripcion` text DEFAULT NULL,
  `Activo` tinyint(1) NOT NULL DEFAULT 1,
  `Numero_tar` int(11) NOT NULL,
  `Fecha_Valida` int(11) NOT NULL,
  `CVV` int(11) NOT NULL,
  `NIP_targeta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `paqueteria`
--

CREATE TABLE `paqueteria` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Correo` varchar(100) DEFAULT NULL,
  `Sitio_web` varchar(100) DEFAULT NULL,
  `Numero_rastreo` varchar(100) DEFAULT NULL,
  `Fecha_salida` varchar(50) NOT NULL,
  `Fecha_Entrega` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Correo` varchar(100) DEFAULT NULL,
  `Contacto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`ID`, `Nombre`, `Direccion`, `Telefono`, `Correo`, `Contacto`) VALUES
(1, 'Proveedor XYZ', 'Calle Falsa 123, Ciudad Ejemplo, Estado Ejemplo', '555-1234', 'contacto@proveedorxyz.com', 'Juan Pérez');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedor`
--

CREATE TABLE `vendedor` (
  `ID` int(11) NOT NULL,
  `Nombre` varchar(100) NOT NULL,
  `Apellido` varchar(100) NOT NULL,
  `Usuario` varchar(50) NOT NULL,
  `Contrasena` varchar(100) NOT NULL,
  `Telefono` varchar(20) DEFAULT NULL,
  `Correo` varchar(100) DEFAULT NULL,
  `Fecha_registro` date NOT NULL,
  `Empresa` varchar(100) NOT NULL,
  `Direccion` varchar(100) NOT NULL,
  `Ciudad` varchar(100) NOT NULL,
  `Calle` varchar(100) NOT NULL,
  `municipio` varchar(100) NOT NULL,
  `Colonia` varchar(100) NOT NULL,
  `Referencia` varchar(100) NOT NULL,
  `RFC` varchar(100) DEFAULT NULL,
  `web` varchar(100) NOT NULL,
  `marca_ID` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `carrito_producto`
--
ALTER TABLE `carrito_producto`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Producto_ID` (`Producto_ID`);

--
-- Indices de la tabla `compra_equipo`
--
ALTER TABLE `compra_equipo`
  ADD PRIMARY KEY (`ID_compra_Pro`);

--
-- Indices de la tabla `descuento`
--
ALTER TABLE `descuento`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Codigo` (`Codigo`);

--
-- Indices de la tabla `login_cliente`
--
ALTER TABLE `login_cliente`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `paqueteria`
--
ALTER TABLE `paqueteria`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`ID`);

--
-- Indices de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `Usuario` (`Usuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `administrador`
--
ALTER TABLE `administrador`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `carrito_producto`
--
ALTER TABLE `carrito_producto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `comentario`
--
ALTER TABLE `comentario`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `compra_equipo`
--
ALTER TABLE `compra_equipo`
  MODIFY `ID_compra_Pro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `descuento`
--
ALTER TABLE `descuento`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `login_cliente`
--
ALTER TABLE `login_cliente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `marca`
--
ALTER TABLE `marca`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `paqueteria`
--
ALTER TABLE `paqueteria`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `vendedor`
--
ALTER TABLE `vendedor`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `carrito_producto`
--
ALTER TABLE `carrito_producto`
  ADD CONSTRAINT `carrito_producto_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `metodo_pago` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `comentario_ibfk_1` FOREIGN KEY (`Producto_ID`) REFERENCES `marca` (`ID`),
  ADD CONSTRAINT `comentario_ibfk_2` FOREIGN KEY (`ID`) REFERENCES `usuarios` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `compra_equipo`
--
ALTER TABLE `compra_equipo`
  ADD CONSTRAINT `compra_equipo_ibfk_1` FOREIGN KEY (`ID_compra_Pro`) REFERENCES `usuarios` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `descuento`
--
ALTER TABLE `descuento`
  ADD CONSTRAINT `descuento_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `administrador` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `metodo_pago`
--
ALTER TABLE `metodo_pago`
  ADD CONSTRAINT `metodo_pago_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `usuarios` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `paqueteria`
--
ALTER TABLE `paqueteria`
  ADD CONSTRAINT `paqueteria_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `usuarios` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `vendedor`
--
ALTER TABLE `vendedor`
  ADD CONSTRAINT `vendedor_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `paqueteria` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
