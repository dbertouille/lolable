CREATE TABLE `blogs` (
  `user_id` int NOT NULL,
  `blog` text NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(100) NOT NULL,
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `comic_id` int,
  PRIMARY KEY `id` (`id`),
  FOREIGN KEY (user_id)
    REFERENCES users (user_id),
  FOREIGN KEY (comic_id)
    REFERENCES comics (comic_num)
);
