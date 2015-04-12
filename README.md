# Calendar
This is a calendar web app that allows users to signup and login to their own calendars. The users are able to add, remove and tag added events.
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


+--------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+
| events | CREATE TABLE `events` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,
  `userid` mediumint(8) unsigned NOT NULL,
  `event` varchar(200) NOT NULL,
  `month` varchar(10) NOT NULL,
  `day` tinyint(3) unsigned NOT NULL,
  `year` mediumint(8) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userid` (`userid`),
  CONSTRAINT `events_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 |
+--------+----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------+

alter table events add column tag VARCHAR(10) not null default 'General';
update events set tag='General';
alter table users add column shared blob;



