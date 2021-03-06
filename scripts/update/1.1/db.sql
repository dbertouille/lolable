ALTER TABLE blogs ENGINE=INNODB;
ALTER TABLE comics ENGINE=INNODB;
ALTER TABLE podcasts ENGINE=INNODB;
ALTER TABLE ratings ENGINE=INNODB;
ALTER TABLE users ENGINE=INNODB;

CREATE TABLE `announcements` (
  `id` int NOT NULL AUTO_INCREMENT,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `announcement` text NOT NULL,
  PRIMARY KEY `id` (`id`)
);

ALTER TABLE blogs MODIFY user_id INTEGER;
ALTER TABLE blogs MODIFY id INTEGER UNSIGNED;
ALTER TABLE blogs ADD COLUMN comic_id INTEGER;

ALTER TABLE comics MODIFY comic_num INTEGER;

ALTER TABLE users MODIFY user_id INTEGER;

ALTER TABLE blogs ADD CONSTRAINT blogs_user_id_fk FOREIGN KEY (user_id) REFERENCES users (user_id);
ALTER TABLE blogs ADD CONSTRAINT blogs_comic_id_fk FOREIGN KEY (comic_id) REFERENCES comics (comic_num);
