CREATE TABLE `blogs` (
  `user_id` int NOT NULL,
  `blog` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(100) NOT NULL,
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  PRIMARY KEY `id` (`id`),
  FOREIGN KEY (user_id)
    REFERENCES users (user_id)
);
