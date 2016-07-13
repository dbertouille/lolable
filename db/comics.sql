CREATE TABLE `comics` (
  `comic_num` int NOT NULL,
  `comic_name` varchar(100) NOT NULL,
  `comic_description` varchar(500) NOT NULL,
  `file` varchar(100) NOT NULL,
  `tags` varchar(100) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`comic_num`)
);

