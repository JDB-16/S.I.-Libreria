-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 17-02-2024 a las 02:54:39
-- Versión del servidor: 8.0.36
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `libreriadb`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `id_Admin` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Contraseña` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`id_Admin`, `Username`, `Contraseña`) VALUES
('A001', 'Joarri', '1234'),
('A002', 'Maxx1212', '1234'),
('A003', 'Miedo', '1234');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_Cliente` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `DNI` varchar(8) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `Contraseña` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Nombres` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `Apellidos` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `Localidad` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Pais` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Direccion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `id_Sexo` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `id_metPago` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `id_prefEnvio` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL,
  `id_modCompra` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`id_Cliente`, `DNI`, `Contraseña`, `Nombres`, `Apellidos`, `Localidad`, `Pais`, `Direccion`, `id_Sexo`, `id_metPago`, `id_prefEnvio`, `id_modCompra`) VALUES
('C001', '71893568', '1234', 'Joseph', 'Dueñas Blas', 'Chimbote', 'Perú', 'Manzana 0-1', 'S01', 'M01', 'E01', 'M01'),
('C002', '21845730', '1234', 'Renato', 'Morillo', '', '', 'Lote 7 C\' Prima', 'S01', 'M02', 'E02', 'M01'),
('C003', '98765432', 'clave789', 'Laura', 'Fernández', '', '', 'Avenida Central', 'S02', 'M01', 'E01', 'M01'),
('C004', '45678901', 'secretoABC', 'Carlos', 'Martínez', '', '', 'Calle Secundaria', 'S01', 'M01', 'E02', 'M01'),
('C005', '11112222', 'passwordXYZ', 'Ana', 'López', '', '', 'Calle de la Paz', 'S02', 'M01', 'E01', 'M01'),
('C006', '33334444', 'seguro123', 'Roberto', 'García', '', '', 'Avenida Tranquila', 'S01', 'M02', 'E01', 'M01'),
('C007', '99990000', 'confidencial456', 'Isabel', 'Vega', '', '', 'Calle del Sol', 'S02', 'M02', 'E02', 'M01');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `libro`
--

CREATE TABLE `libro` (
  `id_Producto` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Nombre` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Sinopsis` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Autor` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Precio` float NOT NULL,
  `FechaPublicacion` date NOT NULL,
  `Stock` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `libro`
--

INSERT INTO `libro` (`id_Producto`, `Nombre`, `Sinopsis`, `Autor`, `Precio`, `FechaPublicacion`, `Stock`) VALUES
('L001', 'El Gran Gatsby', 'La historia sigue a un millonario misterioso llamado Jay Gatsby.', 'F. Scott Fitzgerald', 15.99, '1925-04-10', 80),
('L002', 'Cien años de soledad', 'La novela narra la historia de la familia Buendía en el ficticio pueblo de Macondo.', 'Gabriel García Márquez', 12.5, '1967-05-30', 146),
('L003', '1984', 'La novela presenta un mundo distópico bajo el control de un régimen totalitario.', 'George Orwell', 10.99, '1949-06-08', 78),
('L004', 'Don Quijote de la Mancha', 'Cuenta las aventuras de un hidalgo que se vuelve loco leyendo libros de caballería.', 'Miguel de Cervantes', 18.25, '1605-01-16', 120),
('L005', 'Harry Potter y la piedra filosofal', 'La historia sigue las aventuras de un joven mago, Harry Potter.', 'J.K. Rowling', 14.75, '1997-06-26', 200);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `metodopago`
--

CREATE TABLE `metodopago` (
  `id_metPago` varchar(6) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Descripcion` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `metodopago`
--

INSERT INTO `metodopago` (`id_metPago`, `Descripcion`) VALUES
('M01', 'Tarjeta de Credito'),
('M02', 'Tarjeta de Debito');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `modcompra`
--

CREATE TABLE `modcompra` (
  `id_modCompra` varchar(6) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Descripcion` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `modcompra`
--

INSERT INTO `modcompra` (`id_modCompra`, `Descripcion`) VALUES
('M01', 'Carrito'),
('M02', '1-click');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `prefenvio`
--

CREATE TABLE `prefenvio` (
  `id_prefEnvio` varchar(6) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Descripcion` varchar(255) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `prefenvio`
--

INSERT INTO `prefenvio` (`id_prefEnvio`, `Descripcion`) VALUES
('E01', 'Correo Normal'),
('E02', 'Expreso'),
('E03', 'Internacional'),
('E04', 'Courrier');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sexo`
--

CREATE TABLE `sexo` (
  `id_Sexo` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Descripcion` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `sexo`
--

INSERT INTO `sexo` (`id_Sexo`, `Descripcion`) VALUES
('S01', 'Masculino'),
('S02', 'Femenino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `venta`
--

CREATE TABLE `venta` (
  `id_Venta` varchar(6) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Fecha` datetime NOT NULL,
  `id_Producto` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `Subtotal` float NOT NULL,
  `id_Cliente` varchar(4) CHARACTER SET utf8mb4 COLLATE utf8mb4_spanish2_ci NOT NULL,
  `id_metPago` varchar(6) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `id_prefEnvio` varchar(6) COLLATE utf8mb4_spanish2_ci NOT NULL,
  `id_modCompra` varchar(6) COLLATE utf8mb4_spanish2_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish2_ci;

--
-- Volcado de datos para la tabla `venta`
--

INSERT INTO `venta` (`id_Venta`, `Fecha`, `id_Producto`, `Subtotal`, `id_Cliente`, `id_metPago`, `id_prefEnvio`, `id_modCompra`) VALUES
('V001', '2024-02-16 21:19:11', 'L003', 55.47, 'C006', 'M02', 'E01', 'M01'),
('V002', '2024-02-16 21:20:38', 'L001', 15.99, 'C001', 'M01', 'E01', 'M01');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`id_Admin`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id_Cliente`),
  ADD KEY `FK_Cliente_id_Sexo` (`id_Sexo`),
  ADD KEY `id_metPago` (`id_metPago`),
  ADD KEY `id_prefEnvio` (`id_prefEnvio`),
  ADD KEY `id_modCompra` (`id_modCompra`);

--
-- Indices de la tabla `libro`
--
ALTER TABLE `libro`
  ADD PRIMARY KEY (`id_Producto`);

--
-- Indices de la tabla `metodopago`
--
ALTER TABLE `metodopago`
  ADD PRIMARY KEY (`id_metPago`);

--
-- Indices de la tabla `modcompra`
--
ALTER TABLE `modcompra`
  ADD PRIMARY KEY (`id_modCompra`);

--
-- Indices de la tabla `prefenvio`
--
ALTER TABLE `prefenvio`
  ADD PRIMARY KEY (`id_prefEnvio`);

--
-- Indices de la tabla `sexo`
--
ALTER TABLE `sexo`
  ADD PRIMARY KEY (`id_Sexo`);

--
-- Indices de la tabla `venta`
--
ALTER TABLE `venta`
  ADD PRIMARY KEY (`id_Venta`),
  ADD KEY `id_Producto` (`id_Producto`,`id_Cliente`),
  ADD KEY `id_Cliente` (`id_Cliente`),
  ADD KEY `id_metPago` (`id_metPago`),
  ADD KEY `id_prefEnvio` (`id_prefEnvio`);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD CONSTRAINT `cliente_ibfk_1` FOREIGN KEY (`id_Sexo`) REFERENCES `sexo` (`id_Sexo`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `cliente_ibfk_2` FOREIGN KEY (`id_metPago`) REFERENCES `metodopago` (`id_metPago`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `cliente_ibfk_3` FOREIGN KEY (`id_prefEnvio`) REFERENCES `prefenvio` (`id_prefEnvio`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `cliente_ibfk_4` FOREIGN KEY (`id_modCompra`) REFERENCES `modcompra` (`id_modCompra`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Filtros para la tabla `venta`
--
ALTER TABLE `venta`
  ADD CONSTRAINT `venta_ibfk_2` FOREIGN KEY (`id_Producto`) REFERENCES `libro` (`id_Producto`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_ibfk_4` FOREIGN KEY (`id_prefEnvio`) REFERENCES `prefenvio` (`id_prefEnvio`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_ibfk_6` FOREIGN KEY (`id_Cliente`) REFERENCES `cliente` (`id_Cliente`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `venta_ibfk_7` FOREIGN KEY (`id_metPago`) REFERENCES `metodopago` (`id_metPago`) ON DELETE RESTRICT ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
