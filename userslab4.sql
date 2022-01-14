DROP TABLE IF EXISTS `userslab4`;

CREATE TABLE `userslab4` (
  `compid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `accesslevel` varchar(255) NOT NULL,
  `frozen` varchar(1) NOT NULL,
  PRIMARY KEY (`compid`)
);

insert  into `userslab4`(`compid`,`username`,`password`,`accesslevel`,`frozen`) values (1,'mem1','mem1','member','N');
insert  into `userslab4`(`compid`,`username`,`password`,`accesslevel`,`frozen`) values (2,'mem2','mem2','member','Y');
insert  into `userslab4`(`compid`,`username`,`password`,`accesslevel`,`frozen`) values (3,'edit1','edit1','editor','N');
insert  into `userslab4`(`compid`,`username`,`password`,`accesslevel`,`frozen`) values (4,'edit2','edit2','editor','N');
insert  into `userslab4`(`compid`,`username`,`password`,`accesslevel`,`frozen`) values (5,'admin1','admin1','admin','N');
insert  into `userslab4`(`compid`,`username`,`password`,`accesslevel`,`frozen`) values (6,'admin2','admin2','admin','N');
