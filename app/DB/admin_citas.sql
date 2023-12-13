-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 13-12-2023 a las 15:03:08
-- Versión del servidor: 8.0.30
-- Versión de PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `admin_citas`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `images`
--

CREATE TABLE `images` (
  `id_image` int NOT NULL,
  `name` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `modeloId` int DEFAULT NULL,
  `path` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `permissions`
--

CREATE TABLE `permissions` (
  `id_permission` int NOT NULL,
  `name_permisson` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `description` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id_permission`, `name_permisson`, `created_at`, `updated_at`, `slug`, `description`) VALUES
(1, 'index', '2023-11-22 03:03:11', '2023-12-12 15:52:41', 'roles.index', 'Visualizar roles'),
(2, 'create', '2023-11-22 03:04:02', '2023-12-12 15:54:57', 'roles.create', 'Guardar roles'),
(3, 'editar', '2023-11-22 03:05:14', '2023-12-12 15:52:54', 'roles.editar', 'Editar roles'),
(4, 'delete', '2023-11-22 03:05:46', '2023-12-12 15:53:00', 'roles.delete', 'Borrar roles'),
(5, 'manage', '2023-11-22 03:06:03', '2023-12-12 15:53:15', 'roles.manage', 'Administrar roles'),
(6, 'index', '2023-11-22 03:38:33', '2023-12-12 15:53:22', 'permisson.index', 'Visualizar permisos'),
(7, 'storage', '2023-11-22 18:02:18', '2023-12-12 15:53:32', 'roles.storage', 'Guardar roles'),
(8, 'update', '2023-11-22 18:02:47', '2023-12-12 15:53:38', 'roles.update', 'Actualizar roles'),
(9, 'assing', '2023-11-22 18:03:07', '2023-12-12 15:53:44', 'roles.assing', 'Asignar roles'),
(10, 'create', '2023-11-22 18:04:11', '2023-12-12 15:55:07', 'permisson.create', 'Guardar permisos'),
(11, 'storage', '2023-11-22 18:04:25', '2023-12-12 15:54:03', 'permisson.storage', 'Guardar permisos'),
(12, 'editar', '2023-11-22 18:04:39', '2023-12-12 15:54:13', 'permisson.editar', 'Ediitar permisos'),
(13, 'update', '2023-11-22 18:05:09', '2023-12-12 15:55:12', 'permisson.update', 'Actualizar permisos'),
(17, 'ggggggg1', '2023-11-22 13:37:39', '2023-12-12 15:55:33', '', 'Prueba'),
(18, 'search', '2023-12-12 21:18:14', '2023-12-13 09:46:41', 'roles.search\r\n', 'Busqueda roles'),
(19, 'search', '2023-12-12 21:18:50', '2023-12-13 09:49:33', 'permisson.search', 'Busqueda permisos'),
(20, 'paginarPermisos', '2023-12-12 21:26:32', '2023-12-13 09:49:52', 'roles.paginarPermisos', 'Paginar roles'),
(21, 'paginarPermisos', '2023-12-12 21:26:54', '2023-12-13 09:50:02', 'permisson.paginarPermisos', 'Paginar permisos'),
(22, 'Eliminar', '2023-12-13 14:48:37', '2023-12-13 09:48:37', 'permisson.delete', 'Eliminar permisos'),
(23, 'assign', '2023-12-13 14:52:38', '2023-12-13 09:52:38', 'permisson.asign', 'Asignar permisos\r\n');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `profiles`
--

CREATE TABLE `profiles` (
  `id_profiles` int NOT NULL,
  `first_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `last_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT '000',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `profiles`
--

INSERT INTO `profiles` (`id_profiles`, `first_name`, `last_name`, `phone`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 'Nicolas', 'Prieto', '3219307923', '2023-11-22 03:10:36', '2023-11-21 17:10:36', 1),
(2, 'usuario', 'apellido', '3234567890', '2023-12-12 20:20:15', '2023-12-12 15:20:15', 2),
(4, 'otro', 'ASas', '3122345612', '2023-12-13 14:34:50', '2023-12-13 09:34:50', 4);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_role` int NOT NULL,
  `name_role` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_role`, `name_role`, `created_at`, `updated_at`) VALUES
(2, 'Juann', '2023-12-12 21:04:10', '2023-12-12 16:08:22'),
(3, 'yisus', '2023-12-13 12:47:46', '2023-12-13 07:47:46');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `role_permisson`
--

CREATE TABLE `role_permisson` (
  `id_role_permisson` int NOT NULL,
  `id_permisson_fk` int NOT NULL,
  `id_role_fk` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `role_permisson`
--

INSERT INTO `role_permisson` (`id_role_permisson`, `id_permisson_fk`, `id_role_fk`) VALUES
(22, 20, 2),
(23, 1, 2),
(24, 2, 2),
(25, 3, 2),
(26, 4, 2),
(27, 4, 2),
(28, 5, 2),
(29, 5, 2),
(30, 7, 2),
(31, 8, 2),
(32, 12, 2),
(33, 13, 2),
(35, 18, 2),
(36, 20, 2),
(37, 6, 2),
(38, 21, 2),
(39, 10, 2),
(40, 11, 2),
(41, 23, 2),
(42, 9, 2),
(63, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int NOT NULL,
  `user_name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `id_role_fk` int DEFAULT NULL,
  `id_image_fk` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `passwordTime` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `user_name`, `email`, `password`, `id_role_fk`, `id_image_fk`, `created_at`, `updated_at`, `passwordTime`) VALUES
(1, 'Nicolas', 'nicprieto@misena.edu.co', '411f36d65bf2c258e912617a9c8a29bef168963c1ee97788cd', 2, NULL, '2023-11-22 03:10:36', '2023-12-13 07:34:25', NULL),
(2, 'usuario', 'correo@gmail.com', '31915e541dafc434904af12450d44f036d71ea184c514921f6', NULL, NULL, '2023-12-12 20:20:15', '2023-12-12 15:36:33', NULL),
(3, 'Jhodan', 'corredorjhodan@gmail.com', '2ce3b486b0b3437168f88f62baec29df5596e6ab2b62e4ccb3', 2, NULL, '2023-12-12 22:46:08', '2023-12-12 17:50:04', NULL),
(4, '123', 'cor@gmail.com', '5a588eede47b94529ae6a5eb1f2e4be204b6f8a353d87695e2', 2, NULL, '2023-12-13 14:34:50', '2023-12-13 09:38:58', NULL);

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
  MODIFY `id_image` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id_permission` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de la tabla `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id_profiles` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `role_permisson`
--
ALTER TABLE `role_permisson`
  MODIFY `id_role_permisson` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
