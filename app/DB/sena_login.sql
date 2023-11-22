-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:3306
-- Tiempo de generación: 22-11-2023 a las 16:52:11
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
-- Base de datos: `sena_login`
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
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `permissions`
--

INSERT INTO `permissions` (`id_permission`, `name_permisson`, `created_at`, `updated_at`) VALUES
(1, 'Listar', '2023-10-23 18:18:09', '2023-11-21 15:02:07'),
(4, 'Crear', '2023-11-21 20:02:30', '2023-11-21 15:02:30'),
(6, 'Eliminar', '2023-11-21 20:11:01', '2023-11-21 15:11:01'),
(15, 'Editar', '2023-10-23 18:18:09', '2023-10-23 13:18:09'),
(16, 'Administrar', '2023-10-23 18:18:09', '2023-10-23 13:18:09'),
(17, 'Usuarios', '2023-11-22 12:21:50', '2023-11-22 07:21:50');

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
(20, 'Jose ', 'Rey', '3013685277', '2023-11-22 16:50:47', '2023-11-22 11:50:47', 44);

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
(1, 'Admin', '2023-09-18 15:40:24', '2023-11-22 07:17:40'),
(2, 'User', '2023-10-09 19:16:43', '2023-10-09 14:16:43'),
(10, 'Super Admin', '2023-11-22 12:19:46', '2023-11-22 07:19:46');

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
(1, 1, 1),
(7, 1, 2),
(8, 1, 1),
(11, 15, 1),
(13, 4, 1),
(15, 1, 1),
(17, 4, 1),
(19, 6, 1),
(20, 16, 1),
(21, 16, 10),
(22, 4, 10),
(23, 15, 10),
(24, 6, 10),
(25, 1, 10),
(26, 17, 10);

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
(44, 'Jose ', 'joslrey@misena.edu.co', '411f36d65bf2c258e912617a9c8a29bef168963c1ee97788cd', 10, NULL, '2023-11-22 16:50:47', '2023-11-22 11:51:17', NULL);

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
  MODIFY `id_image` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id_permission` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de la tabla `profiles`
--
ALTER TABLE `profiles`
  MODIFY `id_profiles` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_role` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `role_permisson`
--
ALTER TABLE `role_permisson`
  MODIFY `id_role_permisson` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

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
  ADD CONSTRAINT `fk_role_permisson_permission` FOREIGN KEY (`id_permisson_fk`) REFERENCES `permissions` (`id_permission`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_permisson_ibfk_1` FOREIGN KEY (`id_permisson_fk`) REFERENCES `permissions` (`id_permission`),
  ADD CONSTRAINT `role_permisson_ibfk_2` FOREIGN KEY (`id_role_fk`) REFERENCES `roles` (`id_role`);

--
-- Filtros para la tabla `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`id_role_fk`) REFERENCES `roles` (`id_role`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
