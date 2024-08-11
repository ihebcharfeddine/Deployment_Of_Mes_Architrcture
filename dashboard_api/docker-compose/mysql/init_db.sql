-- Drop the table if it exists
DROP TABLE IF EXISTS `dashboard_data`;

-- Create the dashboard_data table
CREATE TABLE `dashboard_data` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `data_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data_value` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample data into the dashboard_data table
INSERT INTO `dashboard_data` (data_type, data_value, created_at, updated_at) VALUES
('Temperature', '25°C', NOW(), NOW()),
('Humidity', '60%', NOW(), NOW()),
('Pressure', '1013 hPa', NOW(), NOW());
