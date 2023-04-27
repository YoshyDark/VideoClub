-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 17-04-2023 a las 21:32:42
-- Versión del servidor: 10.4.27-MariaDB
-- Versión de PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `itmd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `citas`
--

CREATE TABLE `citas` (
  `idCita` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `fecha_cita` date NOT NULL,
  `motivo_cita` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `citas`
--

INSERT INTO `citas` (`idCita`, `idUser`, `fecha_cita`, `motivo_cita`) VALUES
(5, 9, '2023-04-11', 'Alquilar 5 peliculas'),
(6, 16, '2023-04-13', 'Reclamación de pelicula'),
(7, 9, '2023-05-20', 'Pelicula en mal estado'),
(8, 9, '2023-04-14', 'Devolución de DVD'),
(9, 8, '0000-00-00', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticias`
--

CREATE TABLE `noticias` (
  `idNoticia` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `imagen` text NOT NULL,
  `texto` longtext NOT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `noticias`
--

INSERT INTO `noticias` (`idNoticia`, `idUser`, `titulo`, `imagen`, `texto`, `fecha`) VALUES
(12, 8, 'The Mandalorian', 'themandalorian.jpg', 'Ambientada tras la caída del Imperio y antes de la aparición de la Primera Orden, la serie sigue los pasos de Mando, un cazarrecompensas perteneciente a la legendaria tribu de los Mandalorian, un pistolero solitario que trabaja en los confines de la galaxia, donde no alcanza la autoridad de la Nueva República.', '2023-04-11'),
(13, 8, 'The Last of Us', 'TheLastOfUs.jpg', ' Veinte años después de la destrucción de la civilización moderna a causa de un hongo -el cordyceps- que se adueña del cuerpo de los humanos, uno de los supervivientes, Joel, recibe el encargo de sacar a la joven Ellie de una opresiva zona de cuarentena. Juntos cruzan Estados Unidos ayudándose mutuamente para intentar sobrevivir... Adaptación del aclamado videojuego homónimo de Naughty Dog.', '2023-04-17'),
(14, 8, 'Los anillos de poder', 'losanillosdepoder.jpg', 'Comenzando en una época de relativa paz, la serie sigue a un conjunto de personajes, tanto conocidos como nuevos, mientras se enfrentan a la tan temida reaparición del mal en la Tierra Media. Desde las profundidades más oscuras de las Montañas Brumosas, pasando por los majestuosos bosques de la capital elfa de Lindon, hasta el impresionante reino insular de Númenor, y llegando a los lugares más recónditos del mapa, estos reinos y personajes forjarán legados que perdurarán mucho tiempo después de su desaparición.', '2023-04-17');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_data`
--

CREATE TABLE `users_data` (
  `idUser` int(11) NOT NULL,
  `nombre` char(100) NOT NULL,
  `apellido` char(100) NOT NULL,
  `email` char(100) NOT NULL,
  `telefono` text NOT NULL,
  `fecha_de_nacimiento` date NOT NULL,
  `direccion` text DEFAULT NULL,
  `sexo` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users_data`
--

INSERT INTO `users_data` (`idUser`, `nombre`, `apellido`, `email`, `telefono`, `fecha_de_nacimiento`, `direccion`, `sexo`) VALUES
(8, 'pablo', 'Gomez', 'admin@email.com', '123456789', '2023-04-18', 'calle aljibe de trillo 14', 'hombre'),
(9, 'jose', 'gomez', 'josea@gmail.com', '632589562', '1991-08-18', 'calle pacifico 3, 2g', 'hombre'),
(16, 'miriam', 'alvarez', 'miriam@gmail.com', '569874123', '1908-02-25', 'calle pacifico 3, 2g', 'mujer'),
(17, 'miriam', 'lopez', 'miriam2@gmail.com', '456987128', '1970-05-30', 'calle dulce 39, 3b', 'mujer'),
(18, 'ramon', 'ramirezz', 'ramon1@hotmai.com', '45698712333333333', '2000-06-12', 'avenida figueroa 40', 'hombre'),
(19, 'menganito', 'detal', 'menganito@gmail.com', '456987123', '1999-03-20', 'calle dulce 39, 3b', 'hombre'),
(20, 'manuel', 'gomez', 'manuel@gmail.com', '456987123', '1991-08-05', 'calle pacifico 3, 2g', 'hombre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_login`
--

CREATE TABLE `users_login` (
  `idLogin` int(11) NOT NULL,
  `idUser` int(11) NOT NULL,
  `usuario` text NOT NULL,
  `password` text NOT NULL,
  `rol` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users_login`
--

INSERT INTO `users_login` (`idLogin`, `idUser`, `usuario`, `password`, `rol`) VALUES
(7, 9, 'josea', '$2y$10$jn3MyCUELiHiAd1D00EJz./PdDu8CtPCUzDRHI7PJjaQXuBSEUNGO', 'user'),
(9, 8, 'admin', '$2y$10$a8JTW/gDAnLu6lmiKh4z3ehthbeEXpTrydUytKeEsOjOEZu0qUKCS', 'admin'),
(10, 16, 'miriam1', '$2y$10$KVFu8JWk/dRWrIz924NGmu0e2.Sd5TGnOvX4UntjRDzN.RL.zKMbG', 'user'),
(11, 17, 'miriam2', '$2y$10$SnJiYq6odnh9Wcg4alpdgOUN/cVY7fQloc9oQT.7hPElu2Hv6qJHC', 'user'),
(12, 18, 'ramon1', '$2y$10$ae.JUige2K.c/VnfD6DZZu9gOoH3oWXjByZ9/sz/jCJqggMpyn3SO', 'user'),
(13, 19, 'menganito1', '$2y$10$guufIRMiSpma0CvsTRb.qO94V573NK8JRtb6QECZdOfrhkvePKEk2', 'user'),
(14, 20, 'manuel1', '$2y$10$uJhmWl2QUSpfjygwCAgPVO6bFKxL/if8qTLKwMElnAsmTSnn7ChHK', 'user');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `citas`
--
ALTER TABLE `citas`
  ADD PRIMARY KEY (`idCita`),
  ADD KEY `idUser` (`idUser`);

--
-- Indices de la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD PRIMARY KEY (`idNoticia`),
  ADD UNIQUE KEY `titulo` (`titulo`) USING HASH,
  ADD KEY `idUser` (`idUser`);

--
-- Indices de la tabla `users_data`
--
ALTER TABLE `users_data`
  ADD PRIMARY KEY (`idUser`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indices de la tabla `users_login`
--
ALTER TABLE `users_login`
  ADD PRIMARY KEY (`idLogin`),
  ADD UNIQUE KEY `idUser` (`idUser`),
  ADD UNIQUE KEY `usuario` (`usuario`) USING HASH;

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `citas`
--
ALTER TABLE `citas`
  MODIFY `idCita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `noticias`
--
ALTER TABLE `noticias`
  MODIFY `idNoticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de la tabla `users_data`
--
ALTER TABLE `users_data`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `users_login`
--
ALTER TABLE `users_login`
  MODIFY `idLogin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `citas`
--
ALTER TABLE `citas`
  ADD CONSTRAINT `citas_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users_data` (`idUser`);

--
-- Filtros para la tabla `noticias`
--
ALTER TABLE `noticias`
  ADD CONSTRAINT `noticias_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users_data` (`idUser`);

--
-- Filtros para la tabla `users_login`
--
ALTER TABLE `users_login`
  ADD CONSTRAINT `users_login_ibfk_1` FOREIGN KEY (`idUser`) REFERENCES `users_data` (`idUser`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
