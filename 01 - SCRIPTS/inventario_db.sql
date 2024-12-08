/*
Navicat MySQL Data Transfer

Source Server         : Local
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : inventario_db

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2024-12-06 19:13:21
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for aprobaciones_fiscalizacion
-- ----------------------------
DROP TABLE IF EXISTS `aprobaciones_fiscalizacion`;
CREATE TABLE `aprobaciones_fiscalizacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `solicitud_viatico_id` int(11) NOT NULL,
  `fiscalizador_id` int(10) unsigned DEFAULT NULL,
  `estado` enum('Pendiente','Aprobada','Rechazada') DEFAULT 'Pendiente',
  `observaciones` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `solicitud_viatico_id` (`solicitud_viatico_id`),
  KEY `fiscalizador_id` (`fiscalizador_id`),
  CONSTRAINT `aprobaciones_fiscalizacion_ibfk_1` FOREIGN KEY (`solicitud_viatico_id`) REFERENCES `solicitudes_viaticos` (`id`),
  CONSTRAINT `aprobaciones_fiscalizacion_ibfk_2` FOREIGN KEY (`fiscalizador_id`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of aprobaciones_fiscalizacion
-- ----------------------------
INSERT INTO `aprobaciones_fiscalizacion` VALUES ('6', '8', null, 'Pendiente', null, '2024-12-06 22:54:50', '2024-12-06 22:54:50');

-- ----------------------------
-- Table structure for aprobaciones_tesoreria
-- ----------------------------
DROP TABLE IF EXISTS `aprobaciones_tesoreria`;
CREATE TABLE `aprobaciones_tesoreria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `solicitud_viaticos_id` int(11) NOT NULL,
  `tesorero_id` int(10) unsigned DEFAULT NULL,
  `estado` enum('Pendiente','Pagado') DEFAULT 'Pendiente',
  `monto_aprobado` decimal(10,2) DEFAULT NULL,
  `observaciones` text DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `solicitud_viaticos_id` (`solicitud_viaticos_id`),
  KEY `tesorero_id` (`tesorero_id`),
  CONSTRAINT `aprobaciones_tesoreria_ibfk_1` FOREIGN KEY (`solicitud_viaticos_id`) REFERENCES `solicitudes_viaticos` (`id`),
  CONSTRAINT `aprobaciones_tesoreria_ibfk_2` FOREIGN KEY (`tesorero_id`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of aprobaciones_tesoreria
-- ----------------------------
INSERT INTO `aprobaciones_tesoreria` VALUES ('5', '8', null, 'Pendiente', null, null, '2024-12-06 22:54:50', '2024-12-06 22:54:50');

-- ----------------------------
-- Table structure for cache
-- ----------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cache
-- ----------------------------

-- ----------------------------
-- Table structure for cache_locks
-- ----------------------------
DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of cache_locks
-- ----------------------------

-- ----------------------------
-- Table structure for comprobantes_entregados
-- ----------------------------
DROP TABLE IF EXISTS `comprobantes_entregados`;
CREATE TABLE `comprobantes_entregados` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `solicitud_viaticos_id` int(11) DEFAULT NULL,
  `categoria_gasto` varchar(255) DEFAULT NULL,
  `nombre_archivo` varchar(255) DEFAULT NULL,
  `tipo_archivo` varchar(50) DEFAULT NULL,
  `contenido` longblob DEFAULT NULL,
  `fecha_entrega` timestamp NOT NULL DEFAULT current_timestamp(),
  `observaciones` text DEFAULT NULL,
  `pdf` longblob DEFAULT NULL,
  `xml` longblob DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `solicitud_viaticos_id` (`solicitud_viaticos_id`),
  CONSTRAINT `comprobantes_entregados_ibfk_1` FOREIGN KEY (`solicitud_viaticos_id`) REFERENCES `solicitudes_viaticos` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of comprobantes_entregados
-- ----------------------------
INSERT INTO `comprobantes_entregados` VALUES ('3', '8', 'Sin Categoría', null, null, null, '2024-12-06 16:54:50', null, null, null);

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
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

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for jobs
-- ----------------------------
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

-- ----------------------------
-- Records of jobs
-- ----------------------------

-- ----------------------------
-- Table structure for job_batches
-- ----------------------------
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

-- ----------------------------
-- Records of job_batches
-- ----------------------------

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES ('1', '0001_01_01_000001_create_cache_table', '1');
INSERT INTO `migrations` VALUES ('2', '0001_01_01_000002_create_jobs_table', '1');
INSERT INTO `migrations` VALUES ('3', '2024_11_02_073816_create_roles_table', '1');
INSERT INTO `migrations` VALUES ('4', '2024_11_02_074136_create_roles_table', '1');
INSERT INTO `migrations` VALUES ('5', '2024_11_02_074220_create_productos_table', '1');
INSERT INTO `migrations` VALUES ('6', '2024_11_02_074305_create_movimientos_table', '1');

-- ----------------------------
-- Table structure for movimientos
-- ----------------------------
DROP TABLE IF EXISTS `movimientos`;
CREATE TABLE `movimientos` (
  `idMovimiento` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idProducto` int(10) unsigned NOT NULL,
  `id_usuario` int(10) unsigned NOT NULL,
  `tipo` enum('entrada','salida') NOT NULL,
  `cantidad` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`idMovimiento`),
  KEY `movimientos_idproducto_foreign` (`idProducto`),
  KEY `movimientos_id_usuario_foreign` (`id_usuario`),
  CONSTRAINT `movimientos_idproducto_foreign` FOREIGN KEY (`idProducto`) REFERENCES `productos` (`idProducto`),
  CONSTRAINT `movimientos_id_usuario_foreign` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of movimientos
-- ----------------------------
INSERT INTO `movimientos` VALUES ('1', '1', '1', 'entrada', '2', '2024-11-02 14:30:55', '2024-11-02 14:30:55');
INSERT INTO `movimientos` VALUES ('2', '1', '2', 'salida', '1', '2024-11-02 15:02:57', '2024-11-02 15:02:57');
INSERT INTO `movimientos` VALUES ('3', '2', '1', 'entrada', '5', '2024-11-02 15:09:25', '2024-11-02 15:09:25');
INSERT INTO `movimientos` VALUES ('4', '2', '2', 'salida', '3', '2024-11-02 15:09:52', '2024-11-02 15:09:52');
INSERT INTO `movimientos` VALUES ('5', '1', '2', 'salida', '1', '2024-11-02 15:10:06', '2024-11-02 15:10:06');
INSERT INTO `movimientos` VALUES ('6', '1', '1', 'entrada', '50', '2024-11-02 17:26:54', '2024-11-02 17:26:54');
INSERT INTO `movimientos` VALUES ('7', '1', '2', 'salida', '20', '2024-11-02 17:33:25', '2024-11-02 17:33:25');
INSERT INTO `movimientos` VALUES ('8', '1', '2', 'salida', '1', '2024-11-02 17:33:39', '2024-11-02 17:33:39');
INSERT INTO `movimientos` VALUES ('9', '4', '1', 'entrada', '50', '2024-11-04 20:49:30', '2024-11-04 20:49:30');
INSERT INTO `movimientos` VALUES ('10', '5', '1', 'entrada', '100', '2024-11-04 20:49:41', '2024-11-04 20:49:41');
INSERT INTO `movimientos` VALUES ('11', '3', '1', 'entrada', '50', '2024-11-06 18:27:59', '2024-11-06 18:27:59');

-- ----------------------------
-- Table structure for productos
-- ----------------------------
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of productos
-- ----------------------------
INSERT INTO `productos` VALUES ('1', 'Jugo viva', 'Sabor fresa y lima', '29', '0', '2024-11-02 12:03:43', '2024-11-02 17:44:42');
INSERT INTO `productos` VALUES ('2', 'Motorola Moto G23 128 GB', 'Desbloqueado', '2', '0', '2024-11-02 14:08:42', '2024-11-06 18:27:34');
INSERT INTO `productos` VALUES ('3', 'Samsung Galaxy S24 Ultra', 'Color titanio, rojo, negro y turqueza', '50', '1', '2024-11-02 14:35:42', '2024-11-06 18:27:59');
INSERT INTO `productos` VALUES ('4', 'Nintendo Switch Modelo OLED Neón', 'Consola Nintendo', '50', '1', '2024-11-02 14:59:16', '2024-11-04 20:49:30');
INSERT INTO `productos` VALUES ('5', 'MacBook Air Apple', '8GB RAM 256GB SSD', '100', '1', '2024-11-02 15:12:15', '2024-11-04 20:49:41');
INSERT INTO `productos` VALUES ('6', 'Papa', 'sabrita', '0', '1', '2024-11-02 17:27:44', '2024-11-02 17:27:44');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id_rol` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'Rectoria', '2024-11-02 07:56:36', '2024-11-02 07:56:36');
INSERT INTO `roles` VALUES ('2', 'Empleado', '2024-11-02 07:56:36', '2024-11-02 07:56:36');
INSERT INTO `roles` VALUES ('3', 'Fiscalizacion', '2024-12-06 01:52:51', '2024-12-06 01:52:55');
INSERT INTO `roles` VALUES ('4', 'Tesoreria', '2024-12-06 01:52:59', '2024-12-03 01:53:02');

-- ----------------------------
-- Table structure for solicitudes_comision
-- ----------------------------
DROP TABLE IF EXISTS `solicitudes_comision`;
CREATE TABLE `solicitudes_comision` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `responsable_id` int(10) unsigned NOT NULL,
  `fecha_solicitud` date NOT NULL,
  `fecha_salida` date NOT NULL,
  `fecha_regreso` date NOT NULL,
  `motivo` varchar(255) NOT NULL,
  `estado` enum('Pendiente','Aprobada','Rechazada') DEFAULT 'Pendiente',
  `observaciones` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `responsable_id` (`responsable_id`),
  CONSTRAINT `solicitudes_comision_ibfk_1` FOREIGN KEY (`responsable_id`) REFERENCES `usuarios` (`id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of solicitudes_comision
-- ----------------------------
INSERT INTO `solicitudes_comision` VALUES ('6', '1', '2024-12-06', '2024-12-09', '2024-12-10', 'Conferencia', 'Pendiente', 'Se brinda conferencia a universidad privada', '2024-12-06 21:56:37', '2024-12-06 21:56:37');
INSERT INTO `solicitudes_comision` VALUES ('7', '2', '2024-12-06', '2024-12-09', '2024-12-27', 'Concurso', 'Aprobada', 'Se realiza comisión por concurso de programación', '2024-12-06 21:57:22', '2024-12-06 22:56:48');

-- ----------------------------
-- Table structure for solicitudes_viaticos
-- ----------------------------
DROP TABLE IF EXISTS `solicitudes_viaticos`;
CREATE TABLE `solicitudes_viaticos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `solicitud_comision_id` int(11) NOT NULL,
  `monto_solicitado` decimal(10,2) NOT NULL,
  `descripcion` text NOT NULL,
  `estado` enum('Pendiente','Aprobada','Rechazada') DEFAULT 'Pendiente',
  `tipo` enum('Devengada','Anticipada') DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `solicitud_comision_id` (`solicitud_comision_id`),
  CONSTRAINT `solicitudes_viaticos_ibfk_1` FOREIGN KEY (`solicitud_comision_id`) REFERENCES `solicitudes_comision` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of solicitudes_viaticos
-- ----------------------------
INSERT INTO `solicitudes_viaticos` VALUES ('8', '7', '7500.00', 'SOLICITUD PARA CONCURSO', 'Aprobada', 'Anticipada', '2024-12-06 22:54:50', '2024-12-06 22:55:57');

-- ----------------------------
-- Table structure for usuarios
-- ----------------------------
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE `usuarios` (
  `id_usuario` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(100) NOT NULL,
  `apellido_paterno` varchar(100) NOT NULL,
  `apellido_materno` varchar(100) NOT NULL,
  `banco` varchar(100) NOT NULL,
  `numero_cuenta` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `contrasena` varchar(255) NOT NULL,
  `area` enum('Empleado','Fiscalizacion','Tesoreria') NOT NULL,
  `id_rol` int(10) unsigned NOT NULL,
  `estatus` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `usuarios_correo_unique` (`correo`),
  KEY `usuarios_id_rol_foreign` (`id_rol`),
  CONSTRAINT `usuarios_id_rol_foreign` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of usuarios
-- ----------------------------
INSERT INTO `usuarios` VALUES ('1', 'Abinadad', 'Morales', 'Montan', '', '', 'admin@empresa.com', '$2y$12$xiiJeL5bTkb.LKsHDPb9/uIECW5ihht/xZaFiCBGHOLzIZhX71uoG', 'Empleado', '1', '1', null, '2024-11-02 08:12:05', '2024-11-02 08:12:05');
INSERT INTO `usuarios` VALUES ('2', 'Empleado', '', '', '', '', 'almacenista@empresa.com', '$2y$12$jTCKy9FAc/e0IJjAUUgTd.M1yL8JNQcPiOp.dFViaCsGdPAEezXt.', 'Empleado', '2', '1', null, '2024-11-02 08:12:05', '2024-12-06 08:42:52');
INSERT INTO `usuarios` VALUES ('3', 'Angel', 'Lopez', 'Vazquez', 'Banamex', '12345678910', 'angel@upt.edu.mx', '$2y$12$xiiJeL5bTkb.LKsHDPb9/uIECW5ihht/xZaFiCBGHOLzIZhX71uoG', 'Empleado', '4', '1', null, '2024-12-06 09:14:27', '2024-12-06 20:54:25');
