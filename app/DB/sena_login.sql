-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-10-2023 a las 18:16:23
-- Versión del servidor: 10.4.28-MariaDB
-- Versión de PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sena_login`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

CREATE TABLE `images` (
  `id_image` int(11) NOT NULL,
  `name` varchar(250) DEFAULT NULL,
  `modeloId` int(11) DEFAULT NULL,
  `path` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id_permission` int(11) NOT NULL,
  `name_permisson` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profiles`
--

CREATE TABLE `profiles` (
  `id_profiles` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL DEFAULT '000',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profiles`
--

INSERT INTO `profiles` (`id_profiles`, `first_name`, `last_name`, `phone`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'jhonatan', 'motta', '000', '2023-08-29 19:31:09', '2023-08-29 16:26:47', 2),
(2, 'jhonatan', 'motta', '000', '2023-08-29 21:11:59', '2023-08-29 16:11:59', 1),
(4, 'Sofia', 'Perez', '3160410637', '2023-08-30 14:55:48', '2023-08-30 09:55:48', 8),
(5, 'Johnvbvb', 'Becerrabvbvbvbnbnv', '3160410637', '2023-09-12 19:29:25', '2023-09-12 14:29:25', 19),
(6, 'lfskdjfisdhgdgdfg', 'dfgdfgdfgdfgdfhfghghjghjghjghjghjghj', '456456456', '2023-09-12 19:34:33', '2023-09-12 14:34:33', 22),
(7, 'juan', 'pene', '12312312', '2023-10-09 19:47:36', '2023-10-09 14:47:36', 27),
(8, 'pedro', 'pene', '12313414', '2023-10-09 20:03:18', '2023-10-09 15:03:18', 28),
(9, 'asdad', 'eqwe', '12313', '2023-10-11 12:54:31', '2023-10-11 07:54:31', 29),
(10, 'sfgb', 'asda', '123123', '2023-10-11 13:23:09', '2023-10-11 08:23:09', 31),
(11, 'ghj', 'h', '123', '2023-10-11 13:23:24', '2023-10-11 08:23:24', 32),
(12, 'jkuyk', 'tuityu', '1341342', '2023-10-11 13:24:27', '2023-10-11 08:24:27', 33),
(13, 'jfgh', 'uty', '132123', '2023-10-11 14:01:00', '2023-10-11 09:01:00', 34),
(14, 'gjhghj', 'tyuty', '123', '2023-10-11 14:01:39', '2023-10-11 09:01:39', 35),
(15, 'tewr', 'werwe', '123', '2023-10-11 14:56:15', '2023-10-11 09:56:15', 36),
(16, 'qwe', 'qweqw', '123', '2023-10-11 14:56:59', '2023-10-11 09:56:59', 37),
(17, 'jhon', 'silva', '3182944014', '2023-10-18 12:28:02', '2023-10-18 07:28:02', 38);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL,
  `name_role` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_permisson`
--

CREATE TABLE `role_permisson` (
  `id_role_permisson` int(11) NOT NULL,
  `id_permisson_fk` int(11) NOT NULL,
  `id_role_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `id_role_fk` int(11) DEFAULT NULL,
  `id_image_fk` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `passwordTime` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `user_name`, `email`, `password`, `id_role_fk`, `id_image_fk`, `created_at`, `updated_at`, `passwordTime`) VALUES
(1, 'jhonatan', 'nicprieto@misena.edu.co', '411f36d65bf2c258e912617a9c8a29bef168963c1ee97788cd', 1, NULL, '2023-08-29 20:39:35', '2023-10-11 09:08:22', '2023-10-09 22:36:48'),
(2, 'fabian', 'castro', '1234', NULL, NULL, '2023-08-29 21:06:34', '2023-08-29 16:06:34', NULL),
(3, 'John', 'jfbehhhhccera@gmail.com', '12345', NULL, NULL, '2023-08-30 14:19:22', '2023-09-11 17:11:26', NULL),
(7, 'David', 'jsoeajorfuigaudgro@gmail.com', '123', NULL, NULL, '2023-08-30 14:21:32', '2023-08-30 09:21:32', NULL),
(8, 'Sofia', 'jfbeccera@gmail.com', '12345', NULL, NULL, '2023-08-30 14:55:48', '2023-08-30 09:55:48', NULL),
(9, 'Camila', 'jfbecggcera@gmail.com', '12345', NULL, NULL, '2023-08-30 14:57:17', '2023-09-11 17:10:34', NULL),
(19, 'Johnvbvb', 'jfbecceraaaa@gmail.com', '12345', NULL, NULL, '2023-09-12 19:29:25', '2023-09-12 14:29:25', NULL),
(22, 'lfskdjfisdhgdgdfg', 'drgfdhdfg@gmail.com', '12345', NULL, NULL, '2023-09-12 19:34:33', '2023-09-12 14:34:33', NULL),
(27, 'juan', 'asdas@gmail.com', '3253812e52244c43795fd25d06c2527d6e8e3d98cf2ac8634d', NULL, NULL, '2023-10-09 19:47:36', '2023-10-09 14:47:36', NULL),
(28, 'pedro', 'uhsdfnjzf@gmail.com', '3253812e52244c43795fd25d06c2527d6e8e3d98cf2ac8634d', NULL, NULL, '2023-10-09 20:03:18', '2023-10-09 15:03:18', NULL),
(29, 'asdad', 'nicolas@gmail.com', '3253812e52244c43795fd25d06c2527d6e8e3d98cf2ac8634d', 2, NULL, '2023-10-11 12:54:31', '2023-10-11 09:08:35', NULL),
(31, 'sfgb', 'juan@gmail.com', '3253812e52244c43795fd25d06c2527d6e8e3d98cf2ac8634d', NULL, NULL, '2023-10-11 13:23:09', '2023-10-11 08:23:09', NULL),
(32, 'ghj', 'asndjksan@gmail.com', '3253812e52244c43795fd25d06c2527d6e8e3d98cf2ac8634d', NULL, NULL, '2023-10-11 13:23:24', '2023-10-11 08:23:24', NULL),
(33, 'jkuyk', '234@gmail.com', '3253812e52244c43795fd25d06c2527d6e8e3d98cf2ac8634d', NULL, NULL, '2023-10-11 13:24:27', '2023-10-11 08:24:27', NULL),
(34, 'jfgh', 'ijm@gmail.com', '3253812e52244c43795fd25d06c2527d6e8e3d98cf2ac8634d', NULL, NULL, '2023-10-11 14:01:00', '2023-10-11 09:01:00', NULL),
(35, 'gjhghj', 'efea@gmail.com', '3253812e52244c43795fd25d06c2527d6e8e3d98cf2ac8634d', NULL, NULL, '2023-10-11 14:01:39', '2023-10-11 09:01:39', NULL),
(36, 'tewr', 'jo@gmail.com', '3253812e52244c43795fd25d06c2527d6e8e3d98cf2ac8634d', NULL, NULL, '2023-10-11 14:56:15', '2023-10-11 09:56:15', NULL),
(37, 'qwe', 'jp@gmail.com', '3253812e52244c43795fd25d06c2527d6e8e3d98cf2ac8634d', NULL, NULL, '2023-10-11 14:56:59', '2023-10-11 09:56:59', NULL),
(38, 'jhon', 'jdsilva83@gmail.com', 'e4e021d9584b7ca48d37ecc55e956519e297cc3cab0ac45639', NULL, NULL, '2023-10-18 12:28:02', '2023-10-18 07:28:02', NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id_image`);

--
-- Indices de la tabla `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id_permission`);

--
-- Indices de la tabla `profiles`
--
ALTER TABLE `profiles`
  ADD PRIMARY KEY (`id_profiles`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_role`);

--
-- Indices de la tabla `role_permisson`
--
ALTER TABLE `role_permisson`
  ADD PRIMARY KEY (`id_role_permisson`),
  ADD KEY `id_permisson_fk` (`id_permisson_fk`),
  ADD KEY `id_role_fk` (`id_role_fk`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `user_name` (`user_name`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_role_fk` (`id_role_fk`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `images`
--
ALTER TABLE `images`
  MODIFY `id_image` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id_permission` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id_profiles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `role_permisson`
--
ALTER TABLE `role_permisson`
  MODIFY `id_role_permisson` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `profiles`
--
ALTER TABLE `profiles`
  ADD CONSTRAINT `profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id_user`);

--
-- Filtros para la tabla `role_permisson`
--
ALTER TABLE `role_permisson`
  ADD CONSTRAINT `role_permisson_ibfk_1` FOREIGN KEY (`id_permisson_fk`) REFERENCES `permissions` (`id_permission`),
  ADD CONSTRAINT `role_permisson_ibfk_2` FOREIGN KEY (`id_role_fk`) REFERENCES `roles` (`id_role`);

--
-- Filtros para la tabla `users`
--
-- ALTER TABLE `users`
--   ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_role_fk`) REFERENCES `roles` (`id_role`);
-- COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
