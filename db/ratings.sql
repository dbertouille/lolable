CREATE TABLE `ratings` (
  `comic_num` int(11) NOT NULL,
  `rating` smallint(6) NOT NULL,
  `ip` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`ip`,`comic_num`)
);
