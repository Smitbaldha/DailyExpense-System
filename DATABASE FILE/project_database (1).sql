/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.0.27-community-nt : Database - wp_practical
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`wp_practical` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `wp_practical`;

/*Table structure for table `expenses` */

DROP TABLE IF EXISTS `expenses`;

CREATE TABLE `expenses` (
  `expense_id` int(20) NOT NULL auto_increment,
  `user_id` varchar(15) NOT NULL,
  `expense` int(20) NOT NULL,
  `expensedate` varchar(15) NOT NULL,
  `expensecategory` varchar(50) NOT NULL,
  `expanse_description` varchar(200) default NULL,
  `payment_type` varchar(20) NOT NULL,
  PRIMARY KEY  (`expense_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `expenses` */

insert  into `expenses`(`expense_id`,`user_id`,`expense`,`expensedate`,`expensecategory`,`expanse_description`,`payment_type`) values (4,'10',12,'2022-04-21','Food','tea','cash'),(5,'10',50,'2022-04-14','Internet','6 GB internet for me ','UPI'),(6,'10',200,'2022-04-12','Food','pizza ','credit/debit card');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL auto_increment,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `profile_path` varchar(50) NOT NULL default 'default_profile.png',
  `password` varchar(50) NOT NULL,
  `trn_date` datetime NOT NULL,
  PRIMARY KEY  (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`user_id`,`firstname`,`lastname`,`email`,`profile_path`,`password`,`trn_date`) values (7,'kavan','ardeshana','kavanrardeshna@gmail.com','default_profile.png','21232f297a57a5a743894a0e4a801fc3','2022-04-11 04:24:16'),(8,'admin','admin','admin@gmail.com','default_profile.png','21232f297a57a5a743894a0e4a801fc3','2022-04-12 10:25:18'),(9,'kavan','patel','admin','default_profile.png','admin','2022-04-21 21:59:08'),(10,'bhavya','ardeshana','kavanrardeshna@gmail.com','thor_f.jpg','warlock#007','2022-04-21 18:31:56');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
