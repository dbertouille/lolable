CREATE TABLE `announcements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `announcement` text NOT NULL,
  PRIMARY KEY `id` (`id`)
);
