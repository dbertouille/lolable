CREATE TABLE `podcasts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(128) NOT NULL,
  `date_posted` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `file` varchar(128) NOT NULL,
  `runtime` int(11) NOT NULL,
  `description` varchar(1024) NOT NULL,
  PRIMARY KEY (`id`)
);
