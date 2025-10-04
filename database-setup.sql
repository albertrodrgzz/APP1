-- SIRH - Sistema Integrado de Gestión Administrativa
-- Script de configuración de base de datos para XAMPP
-- 
-- Instrucciones:
-- 1. Abrir phpMyAdmin en http://localhost/phpmyadmin
-- 2. Crear una nueva base de datos llamada 'sirh_app'
-- 3. Ejecutar este script en la base de datos creada

-- Crear la base de datos si no existe
CREATE DATABASE IF NOT EXISTS `sirh_app` 
DEFAULT CHARACTER SET utf8mb4 
COLLATE utf8mb4_unicode_ci;

-- Usar la base de datos
USE `sirh_app`;

-- Configuración de la sesión para mejor rendimiento
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

-- Crear tabla de departamentos
CREATE TABLE IF NOT EXISTS `departments` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `manager_id` bigint(20) UNSIGNED DEFAULT NULL,
  `budget` decimal(15,2) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `departments_manager_id_foreign` (`manager_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Crear tabla de posiciones
CREATE TABLE IF NOT EXISTS `positions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `level` varchar(255) DEFAULT NULL,
  `requirements` text DEFAULT NULL,
  `responsibilities` text DEFAULT NULL,
  `competencies` text DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `positions_department_id_foreign` (`department_id`),
  CONSTRAINT `positions_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Crear tabla de empleados
CREATE TABLE IF NOT EXISTS `employees` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_number` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `postal_code` varchar(255) DEFAULT NULL,
  `country` varchar(255) NOT NULL DEFAULT 'México',
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('M','F','Otro') DEFAULT NULL,
  `marital_status` enum('Soltero','Casado','Divorciado','Viudo','Unión Libre') DEFAULT NULL,
  `national_id` varchar(255) DEFAULT NULL,
  `tax_id` varchar(255) DEFAULT NULL,
  `emergency_contact_name` varchar(255) DEFAULT NULL,
  `emergency_contact_phone` varchar(255) DEFAULT NULL,
  `emergency_contact_relationship` varchar(255) DEFAULT NULL,
  `hire_date` date NOT NULL,
  `position_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` bigint(20) UNSIGNED NOT NULL,
  `manager_id` bigint(20) UNSIGNED DEFAULT NULL,
  `salary` decimal(15,2) NOT NULL,
  `employment_status` enum('Activo','Inactivo','Suspendido','Jubilado') NOT NULL DEFAULT 'Activo',
  `work_schedule` varchar(255) NOT NULL DEFAULT 'Lunes a Viernes 8:00-17:00',
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `employees_employee_number_unique` (`employee_number`),
  UNIQUE KEY `employees_email_unique` (`email`),
  KEY `employees_position_id_foreign` (`position_id`),
  KEY `employees_department_id_foreign` (`department_id`),
  KEY `employees_manager_id_foreign` (`manager_id`),
  KEY `employees_deleted_at_index` (`deleted_at`),
  CONSTRAINT `employees_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `employees_manager_id_foreign` FOREIGN KEY (`manager_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL,
  CONSTRAINT `employees_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Crear tabla de usuarios
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `employee_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_employee_id_foreign` (`employee_id`),
  CONSTRAINT `users_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Crear tabla de asistencia
CREATE TABLE IF NOT EXISTS `attendances` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `check_in` datetime DEFAULT NULL,
  `check_out` datetime DEFAULT NULL,
  `date` date NOT NULL,
  `total_hours` decimal(5,2) NOT NULL DEFAULT 0.00,
  `overtime_hours` decimal(5,2) NOT NULL DEFAULT 0.00,
  `status` enum('Presente','Ausente','Tardanza','Salida Temprano','Vacaciones','Permiso') NOT NULL DEFAULT 'Presente',
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `attendances_employee_id_date_unique` (`employee_id`,`date`),
  CONSTRAINT `attendances_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Crear tabla de documentos de empleados
CREATE TABLE IF NOT EXISTS `employee_documents` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `document_type` enum('Contrato','DNI','CURP','RFC','Comprobante de Domicilio','Acta de Nacimiento','Certificado Médico','Carta de Antecedentes','Otros') NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_size` bigint(20) NOT NULL,
  `mime_type` varchar(255) NOT NULL,
  `uploaded_by` bigint(20) UNSIGNED NOT NULL,
  `is_verified` tinyint(1) NOT NULL DEFAULT 0,
  `expiry_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `employee_documents_employee_id_foreign` (`employee_id`),
  KEY `employee_documents_uploaded_by_foreign` (`uploaded_by`),
  CONSTRAINT `employee_documents_employee_id_foreign` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  CONSTRAINT `employee_documents_uploaded_by_foreign` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Crear tabla de roles
CREATE TABLE IF NOT EXISTS `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Crear tabla de permisos
CREATE TABLE IF NOT EXISTS `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Crear tabla de roles de modelo
CREATE TABLE IF NOT EXISTS `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Crear tabla de permisos de modelo
CREATE TABLE IF NOT EXISTS `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Crear tabla de permisos de roles
CREATE TABLE IF NOT EXISTS `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insertar datos de ejemplo
INSERT INTO `departments` (`name`, `description`, `created_at`, `updated_at`) VALUES
('Dirección General', 'Dirección General del Instituto', NOW(), NOW()),
('Recursos Humanos', 'Gestión de personal y talento humano', NOW(), NOW()),
('Telemática', 'Dirección de Telemática', NOW(), NOW()),
('Administración', 'Gestión administrativa y financiera', NOW(), NOW()),
('Académico', 'Coordinación académica', NOW(), NOW());

INSERT INTO `positions` (`name`, `description`, `department_id`, `level`, `created_at`, `updated_at`) VALUES
('Director General', 'Director General del Instituto', 1, 'Ejecutivo', NOW(), NOW()),
('Director de RRHH', 'Director de Recursos Humanos', 2, 'Directivo', NOW(), NOW()),
('Director de Telemática', 'Director de Telemática', 3, 'Directivo', NOW(), NOW()),
('Administrador', 'Administrador del Sistema', 2, 'Técnico', NOW(), NOW()),
('Analista de Sistemas', 'Analista de Sistemas', 3, 'Técnico', NOW(), NOW()),
('Asistente Administrativo', 'Asistente Administrativo', 4, 'Operativo', NOW(), NOW());

-- Finalizar transacción
COMMIT;

-- Mensaje de confirmación
SELECT 'Base de datos SIRH configurada exitosamente' AS 'Estado';

