//For database creation description and other host specific definitions

Database schema
All database creation instructions. Follow these for testing


mysql:

create database calendar;

create user 'caluser'@'localhost' identified by 'calpass';

grant select, insert, update, delete on calendar.* to 'caluser'@'localhost';

+-------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| users | CREATE TABLE `users` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `passhash` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 |
+-------+--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+



