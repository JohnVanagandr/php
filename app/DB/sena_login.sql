-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 22-11-2023 a las 16:38:03
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
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `slug` varchar(255) NOT NULL,
  `description` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id_permission`, `name_permisson`, `created_at`, `updated_at`, `slug`, `description`) VALUES
(1, 'index', '2023-11-22 03:03:11', '2023-11-21 17:03:11', 'roles.index', ''),
(2, 'create', '2023-11-22 03:04:02', '2023-11-21 17:04:02', 'roles.create', ''),
(3, 'editar', '2023-11-22 03:05:14', '2023-11-21 17:05:14', 'roles.editar', ''),
(4, 'delete', '2023-11-22 03:05:46', '2023-11-21 17:05:46', 'roles.delete', ''),
(5, 'manage', '2023-11-22 03:06:03', '2023-11-21 17:06:03', 'roles.manage', ''),
(6, 'index', '2023-11-22 03:38:33', '2023-11-22 10:37:32', 'permisson.index', ''),
(7, 'storage', '2023-11-22 18:02:18', '2023-11-22 08:02:18', 'roles.storage', ''),
(8, 'update', '2023-11-22 18:02:47', '2023-11-22 08:02:47', 'roles.update', ''),
(9, 'assing', '2023-11-22 18:03:07', '2023-11-22 08:03:07', 'roles.assing', ''),
(10, 'create', '2023-11-22 18:04:11', '2023-11-22 10:36:39', 'permisson.create', ''),
(11, 'storage', '2023-11-22 18:04:25', '2023-11-22 10:36:44', 'permisson.storage', ''),
(12, 'editar', '2023-11-22 18:04:39', '2023-11-22 10:36:49', 'permisson.editar', ''),
(13, 'update', '2023-11-22 18:05:09', '2023-11-22 10:36:53', 'permisson.update', ''),
(14, 'delete', '2023-11-22 18:05:30', '2023-11-22 10:36:59', 'permisson.delete', ''),
(17, 'ggggggg1', '2023-11-22 13:37:39', '2023-11-22 08:37:44', '', '');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profiles`
--

CREATE TABLE `profiles` (
  `id_profiles` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `phone` varchar(15) NOT NULL DEFAULT '000',
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profiles`
--

INSERT INTO `profiles` (`id_profiles`, `first_name`, `last_name`, `phone`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Nicolas', 'Prieto', '3219307923', '2023-11-22 03:10:36', '2023-11-21 17:10:36', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_role` int(11) NOT NULL,
  `name_role` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_role`, `name_role`, `created_at`, `updated_at`) VALUES
(1, 'Adminn', '2023-11-22 03:11:14', '2023-11-22 08:37:22');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_permisson`
--

CREATE TABLE `role_permisson` (
  `id_role_permisson` int(11) NOT NULL,
  `id_permisson_fk` int(11) NOT NULL,
  `id_role_fk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `role_permisson`
--

INSERT INTO `role_permisson` (`id_role_permisson`, `id_permisson_fk`, `id_role_fk`) VALUES
(33, 1, 1),
(34, 6, 1),
(35, 6, 1),
(36, 5, 1),
(38, 9, 1),
(39, 1, 1),
(40, 2, 1),
(41, 3, 1),
(42, 4, 1),
(43, 5, 1),
(44, 6, 1),
(45, 7, 1),
(46, 8, 1),
(47, 9, 1),
(48, 10, 1),
(49, 11, 1),
(50, 12, 1),
(51, 13, 1),
(52, 14, 1);

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
(1, 'Nicolas', 'nicprieto@misena.edu.co', '411f36d65bf2c258e912617a9c8a29bef168963c1ee97788cd', 1, NULL, '2023-11-22 03:10:36', '2023-11-21 17:11:23', NULL);

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
  ADD PRIMARY KEY (`id_permission`),
  ADD UNIQUE KEY `slug` (`slug`);

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
  MODIFY `id_permission` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id_profiles` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `role_permisson`
--
ALTER TABLE `role_permisson`
  MODIFY `id_role_permisson` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  ADD CONSTRAINT `id_permisson_fk` FOREIGN KEY (`id_permisson_fk`) REFERENCES `permissions` (`id_permission`) ON DELETE CASCADE,
  ADD CONSTRAINT `id_role_fk` FOREIGN KEY (`id_role_fk`) REFERENCES `roles` (`id_role`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_permisson_ibfk_1` FOREIGN KEY (`id_permisson_fk`) REFERENCES `permissions` (`id_permission`),
  ADD CONSTRAINT `role_permisson_ibfk_2` FOREIGN KEY (`id_role_fk`) REFERENCES `roles` (`id_role`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`id_role_fk`) REFERENCES `roles` (`id_role`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
