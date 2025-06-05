-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 03-06-2025 a las 08:30:44
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
-- Base de datos: `tsito1`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `administrador`
--

CREATE TABLE `administrador` (
  `NOMBREUSUARIO` varchar(50) NOT NULL,
  `CONTRASEÑA` varchar(100) NOT NULL,
  `NOMBRECOMPLETO` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `administrador`
--

INSERT INTO `administrador` (`NOMBREUSUARIO`, `CONTRASEÑA`, `NOMBRECOMPLETO`) VALUES
('Administrador', '$2y$10$/ka9BwASVCVIaDRxMLlp7u5d97uqh79abX.su9O8sestx26bYAUgG', 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contribuciones`
--

CREATE TABLE `contribuciones` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `APELLIDOPATERNO` varchar(50) NOT NULL,
  `APELLIDOMATERNO` varchar(50) NOT NULL,
  `PAIS` varchar(50) DEFAULT NULL,
  `TIPODECONTRIBUCION` varchar(100) DEFAULT NULL,
  `ID_VOLUNTARIO` int(11) DEFAULT NULL
  `ID_EVENTO` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  CONSTRAINT `fk_evento` FOREIGN KEY (`ID_EVENTO`) REFERENCES `eventos`(`ID`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `contribuciones`
--

INSERT INTO `contribuciones` (`ID`, `NOMBRE`, `APELLIDOPATERNO`, `APELLIDOMATERNO`, `PAIS`, `TIPODECONTRIBUCION`, `ID_VOLUNTARIO`) VALUES
(4, 'Yesua', 'llave', 'vera', 'MEXICO', 'Servicios', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `eventos`
--

CREATE TABLE `eventos` (
  `ID` int(11) NOT NULL,
  `NOMBRE` varchar(100) NOT NULL,
  `FECHA` date NOT NULL,
  `ADMIN_USUARIO` varchar(50) DEFAULT NULL,
  `IMAGEN` varchar(255) DEFAULT NULL,
  `HORA` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `eventos`
--

INSERT INTO `eventos` (`ID`, `NOMBRE`, `FECHA`, `ADMIN_USUARIO`, `IMAGEN`, `HORA`) VALUES
(2, 'Recolecta de Bienes', '2025-05-29', 'Administrador', 'recolecta.jpg', '14:43:00'),
(10, 'Chispa de Cambio: Enciende tu Potencial Voluntario', '2025-06-10', 'Administrador', 'ayuda.png', '07:02:00'),
(11, 'El Efecto Mariposa del Voluntariado: Pequeñas Acciones, Grandes Transformaciones', '2025-06-20', 'Administrador', 'volu.jpg', '13:05:00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `voluntarios`
--

CREATE TABLE `voluntarios` (
  `id` int(11) NOT NULL,
  `NOMBRE` varchar(50) NOT NULL,
  `APELLIDOPATERNO` varchar(50) NOT NULL,
  `APELLIDOMATERNO` varchar(50) NOT NULL,
  `CORREO` varchar(100) NOT NULL,
  `SEXO` enum('Masculino','Femenino','Otro') NOT NULL,
  `TELEFONO` varchar(20) DEFAULT NULL,
  `CONTRASEÑA` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `voluntarios`
--

INSERT INTO `voluntarios` (`id`, `NOMBRE`, `APELLIDOPATERNO`, `APELLIDOMATERNO`, `CORREO`, `SEXO`, `TELEFONO`, `CONTRASEÑA`) VALUES
(1, 'Ángel Ignacio', 'Vázquez', 'Arriaga', 'nachin2334@gmail.com', 'Masculino', '2722834555', '$2y$10$lo18Sr27KLlqlebElyAq9Oa5U53l6EW5P7Hf16WMjpniL8UpBGENS'),
(2, 'Vicente', 'Hernandez ', 'Ramos', 'papu@gmail.com', 'Masculino', '2729374918', '$2y$10$N2a.QUSsD.w//9ng0mv0AOEWJXO2brk0T7aM8LciOugv28/Fz./Zm'),
(3, 'Yesua Llave', 'Vera', 'Llave', 'yesus@gmail.com', 'Masculino', '2721181147', '$2y$10$KK.oF5ibqQwyPBv7nY1vl.ZziRVKQcUlIJUuCmlHN3vC6VkcIsqem');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `voluntario_eventos`
--

CREATE TABLE `voluntario_eventos` (
  `ID` int(11) NOT NULL,
  `ID_VOLUNTARIO` int(11) NOT NULL,
  `ID_EVENTO` int(11) NOT NULL,
  `FECHA_UNION` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `voluntario_eventos`
--

INSERT INTO `voluntario_eventos` (`ID`, `ID_VOLUNTARIO`, `ID_EVENTO`, `FECHA_UNION`) VALUES
(1, 1, 2, '2025-06-03 07:24:09');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `administrador`
--
ALTER TABLE `administrador`
  ADD PRIMARY KEY (`NOMBREUSUARIO`);

--
-- Indices de la tabla `contribuciones`
--
ALTER TABLE `contribuciones`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID_VOLUNTARIO` (`ID_VOLUNTARIO`);

--
-- Indices de la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ADMIN_USUARIO` (`ADMIN_USUARIO`);

--
-- Indices de la tabla `voluntarios`
--
ALTER TABLE `voluntarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `CORREO` (`CORREO`);

--
-- Indices de la tabla `voluntario_eventos`
--
ALTER TABLE `voluntario_eventos`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `UNICO` (`ID_VOLUNTARIO`,`ID_EVENTO`),
  ADD KEY `ID_EVENTO` (`ID_EVENTO`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `contribuciones`
--
ALTER TABLE `contribuciones`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `eventos`
--
ALTER TABLE `eventos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `voluntarios`
--
ALTER TABLE `voluntarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `voluntario_eventos`
--
ALTER TABLE `voluntario_eventos`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `contribuciones`
--
ALTER TABLE `contribuciones`
  ADD CONSTRAINT `contribuciones_ibfk_1` FOREIGN KEY (`ID_VOLUNTARIO`) REFERENCES `voluntarios` (`id`) ON DELETE SET NULL;

--
-- Filtros para la tabla `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `eventos_ibfk_1` FOREIGN KEY (`ADMIN_USUARIO`) REFERENCES `administrador` (`NOMBREUSUARIO`) ON DELETE SET NULL;

--
-- Filtros para la tabla `voluntario_eventos`
--
ALTER TABLE `voluntario_eventos`
  ADD CONSTRAINT `voluntario_eventos_ibfk_1` FOREIGN KEY (`ID_VOLUNTARIO`) REFERENCES `voluntarios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `voluntario_eventos_ibfk_2` FOREIGN KEY (`ID_EVENTO`) REFERENCES `eventos` (`ID`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
