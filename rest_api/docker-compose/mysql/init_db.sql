DROP TABLE IF EXISTS `students`;

CREATE TABLE `students` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `age` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `student` (name, age) VALUES 
('Berlin', 20),
('Budapest', 22),
('Cincinnati', 21),
('Denver', 23),
('Helsinki', 24),
('Lisbon', 22),
('Moscow', 21),
('Nairobi', 23),
('Oslo', 22),
('Rio', 20),
('Tokyo', 24);

