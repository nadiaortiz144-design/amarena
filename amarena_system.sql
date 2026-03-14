-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 18-11-2017 a las 16:08:53
-- Versión del servidor: 10.1.21-MariaDB
-- Versión de PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `amarena_system`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `cod_cliente` int(11) NOT NULL,
  `nom_cliente` varchar(45) NOT NULL,
  `dir_cliente` varchar(45) NOT NULL,
  `tel_cliente` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cod_cliente`, `nom_cliente`, `dir_cliente`, `tel_cliente`) VALUES
(9, 'ghvhg  ', 'gfcdf', '54344'),
(10, 'Lujan ', 'bhyug', '8979');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_factura`
--

CREATE TABLE `detalle_factura` (
  `cant_vendida` int(11) NOT NULL,
  `factura_nro_factura` int(11) NOT NULL,
  `producto_cod_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empleado`
--

CREATE TABLE `empleado` (
  `cod_empleado` int(11) NOT NULL,
  `nom_empleado` varchar(45) NOT NULL,
  `contra_empleado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `empleado`
--

INSERT INTO `empleado` (`cod_empleado`, `nom_empleado`, `contra_empleado`) VALUES
(1, 'sergio', '0981802481'),
(2, 'carlos', 'hjblhj');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `nro_factura` int(11) NOT NULL,
  `fecha_factura` date NOT NULL,
  `cliente_cod_cliente` int(11) NOT NULL,
  `empleado_cod_empleado` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`nro_factura`, `fecha_factura`, `cliente_cod_cliente`, `empleado_cod_empleado`) VALUES
(102, '2017-02-09', 9, 1),
(103, '2017-02-09', 10, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `cod_producto` int(11) NOT NULL,
  `nom_producto` varchar(45) NOT NULL,
  `descrip_producto` varchar(45) NOT NULL,
  `costo_producto` int(11) NOT NULL,
  `fecha_entrega` date NOT NULL,
  `tam_producto` varchar(45) NOT NULL,
  `cant_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto`
--

INSERT INTO `producto` (`cod_producto`, `nom_producto`, `descrip_producto`, `costo_producto`, `fecha_entrega`, `tam_producto`, `cant_producto`) VALUES
(1, 'lomito', 'jnj', 20000, '2017-02-09', 'pequeno', 1),
(2, 'frutilla', 'jnkj', 15000, '2017-09-08', 'pequeno', 1),
(3, 'Helado', 'con frutas ', 16000, '2017-11-18', 'mediano', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto_x_proveedor`
--

CREATE TABLE `producto_x_proveedor` (
  `producto_cod_producto` int(11) DEFAULT NULL,
  `proveedor_cod_proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `producto_x_proveedor`
--

INSERT INTO `producto_x_proveedor` (`producto_cod_producto`, `proveedor_cod_proveedor`) VALUES
(4, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedor`
--

CREATE TABLE `proveedor` (
  `cod_proveedor` int(11) NOT NULL,
  `nom_proveedor` varchar(45) NOT NULL,
  `dir_proveedor` varchar(45) NOT NULL,
  `tel_proveedor` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `proveedor`
--

INSERT INTO `proveedor` (`cod_proveedor`, `nom_proveedor`, `dir_proveedor`, `tel_proveedor`) VALUES
(2, 'proveedor', 'jhh', '0981802381'),
(3, 'Jeni', 'Asuncion', '345830945');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cod_cliente`);

--
-- Indices de la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD PRIMARY KEY (`factura_nro_factura`,`producto_cod_producto`),
  ADD KEY `producto_cod_producto` (`producto_cod_producto`);

--
-- Indices de la tabla `empleado`
--
ALTER TABLE `empleado`
  ADD PRIMARY KEY (`cod_empleado`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`nro_factura`),
  ADD UNIQUE KEY `cliente_cod_cliente` (`cliente_cod_cliente`),
  ADD KEY `empleado_cod_empleado` (`empleado_cod_empleado`),
  ADD KEY `cliente_cod_cliente_2` (`cliente_cod_cliente`),
  ADD KEY `cliente_cod_cliente_3` (`cliente_cod_cliente`);

--
-- Indices de la tabla `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`cod_producto`);

--
-- Indices de la tabla `producto_x_proveedor`
--
ALTER TABLE `producto_x_proveedor`
  ADD PRIMARY KEY (`proveedor_cod_proveedor`);

--
-- Indices de la tabla `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`cod_proveedor`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalle_factura`
--
ALTER TABLE `detalle_factura`
  ADD CONSTRAINT `detalle_factura_ibfk_1` FOREIGN KEY (`producto_cod_producto`) REFERENCES `producto` (`cod_producto`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_factura_ibfk_2` FOREIGN KEY (`factura_nro_factura`) REFERENCES `factura` (`nro_factura`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_1` FOREIGN KEY (`cliente_cod_cliente`) REFERENCES `cliente` (`cod_cliente`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ibfk_2` FOREIGN KEY (`empleado_cod_empleado`) REFERENCES `empleado` (`cod_empleado`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `producto_x_proveedor`
--
ALTER TABLE `producto_x_proveedor`
  ADD CONSTRAINT `producto_x_proveedor_ibfk_1` FOREIGN KEY (`proveedor_cod_proveedor`) REFERENCES `proveedor` (`cod_proveedor`) ON DELETE NO ACTION ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
