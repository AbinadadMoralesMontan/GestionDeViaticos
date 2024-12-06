
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
INSERT INTO `migrations` VALUES ('1', '0001_01_01_000001_create_cache_table', '1');
INSERT INTO `migrations` VALUES ('2', '0001_01_01_000002_create_jobs_table', '1');
INSERT INTO `migrations` VALUES ('3', '2024_11_02_073816_create_roles_table', '1');
INSERT INTO `migrations` VALUES ('4', '2024_11_02_074136_create_roles_table', '1');
INSERT INTO `migrations` VALUES ('5', '2024_11_02_074220_create_productos_table', '1');
INSERT INTO `migrations` VALUES ('6', '2024_11_02_074305_create_movimientos_table', '1');


DROP TABLE IF EXISTS `movimientos`;
CREATE TABLE `movimientos` (
  `idMovimiento` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idProducto` int(10) unsigned NOT NULL,
  `idUsuario` int(10) unsigned NOT NULL,
  `tipo` enum('entrada','salida') NOT NULL,
  `cantidad` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idMovimiento`),
  KEY `movimientos_idproducto_foreign` (`idProducto`),
  KEY `movimientos_idusuario_foreign` (`idUsuario`),
  CONSTRAINT `movimientos_idproducto_foreign` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`),
  CONSTRAINT `movimientos_idusuario_foreign` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `movimientos` VALUES ('1', '1', '1', 'entrada', '2', '2024-11-02 14:30:55', '2024-11-02 14:30:55');
INSERT INTO `movimientos` VALUES ('2', '1', '2', 'salida', '1', '2024-11-02 15:02:57', '2024-11-02 15:02:57');
INSERT INTO `movimientos` VALUES ('3', '2', '1', 'entrada', '5', '2024-11-02 15:09:25', '2024-11-02 15:09:25');
INSERT INTO `movimientos` VALUES ('4', '2', '2', 'salida', '3', '2024-11-02 15:09:52', '2024-11-02 15:09:52');
INSERT INTO `movimientos` VALUES ('5', '1', '2', 'salida', '1', '2024-11-02 15:10:06', '2024-11-02 15:10:06');


DROP TABLE IF EXISTS `productos`;
CREATE TABLE `productos` (
  `idProducto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `descripcion` text DEFAULT NULL,
  `cantidad` int(11) NOT NULL DEFAULT 0,
  `estatus` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idProducto`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `productos` VALUES ('1', 'Jugo viva', 'Sabor fresa y limón', '0', '1', '2024-11-02 12:03:43', '2024-11-02 15:11:17');
INSERT INTO `productos` VALUES ('2', 'Motorola Moto G23 128 GB', 'Desbloqueado', '2', '1', '2024-11-02 14:08:42', '2024-11-02 15:09:52');
INSERT INTO `productos` VALUES ('3', 'Samsung Galaxy S24 Ultra', 'Color titanio, rojo, negro y turqueza', '0', '0', '2024-11-02 14:35:42', '2024-11-02 15:09:09');
INSERT INTO `productos` VALUES ('4', 'Nintendo Switch Modelo OLED Neón', 'Consola Nintendo', '0', '1', '2024-11-02 14:59:16', '2024-11-02 15:00:05');
INSERT INTO `productos` VALUES ('5', 'MacBook Air Apple', '8GB RAM 256GB SSD', '0', '1', '2024-11-02 15:12:15', '2024-11-02 15:12:15');


DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `idRol` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


INSERT INTO `roles` VALUES ('1', 'Administrador', '2024-11-02 07:56:36', '2024-11-02 07:56:36');
INSERT INTO `roles` VALUES ('2', 'Almacenista', '2024-11-02 07:56:36', '2024-11-02 07:56:36');


DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `idUsuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `idRol` int(10) unsigned NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `usuarios_correo_unique` (`correo`),
  KEY `usuarios_idrol_foreign` (`idRol`),
  CONSTRAINT `usuarios_idrol_foreign` FOREIGN KEY (`idRol`) REFERENCES `roles` (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `usuarios` VALUES ('1', 'Admin', 'admin@empresa.com', '$2y$12$xiiJeL5bTkb.LKsHDPb9/uIECW5ihht/xZaFiCBGHOLzIZhX71uoG', '1', '1', null, '2024-11-02 08:12:05', '2024-11-02 08:12:05');
INSERT INTO `usuarios` VALUES ('2', 'Almacenista', 'almacenista@empresa.com', '$2y$12$jTCKy9FAc/e0IJjAUUgTd.M1yL8JNQcPiOp.dFViaCsGdPAEezXt.', '2', '1', null, '2024-11-02 08:12:05', '2024-11-02 08:12:05');
