/*
SQLyog Ultimate v12.08 (64 bit)
MySQL - 5.7.11-log : Database - knowhowdb
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`knowhowdb` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `knowhowdb`;

/*Data for the table `t_ans_opt` */

/*Data for the table `t_ansnote` */

insert  into `t_ansnote`(`id`,`content`,`publishtime`,`uid`,`ansid`,`showname`) values (1,'ccxcxcxc','0000',1,1,1);

/*Data for the table `t_answer` */

insert  into `t_answer`(`id`,`content`,`publishTime`,`zan`,`cai`,`uid`,`askid`) values (1,'fsdfsdf','2016-06-10 17:15:16',0,0,1,1),(2,'dfdf','2016-06-10 12:15:16',0,0,2,1),(3,'sdfsdf','2016-06-10 14:15:16',0,0,3,1),(4,'qq','2016-06-10 06:15:16',0,0,1,2),(5,'rew','2016-06-10 12:05:16',0,0,1,3),(6,'qwe','2016-06-10 15:15:16',0,0,3,3);

/*Data for the table `t_ask` */

insert  into `t_ask`(`id`,`title`,`content`,`editTime`,`answerTime`,`publishTime`,`zan`,`cai`,`viewCount`,`asktype`,`bounty`,`endTime`,`remark`,`uid`,`acceptid`) values (1,'lugege是猪','陆哥哥是猪哈哈哈',NULL,'2016-06-07 17:08:47','2016-06-01 17:09:02',5,2,67,0,0,NULL,NULL,1,NULL),(2,'呃呃呃','水电费水电费','2016-06-09 17:09:23',NULL,'2016-06-06 17:09:12',7,1,43,0,0,NULL,NULL,2,NULL),(3,'发发发','水电费水电费',NULL,'2016-06-06 17:09:32','2016-06-05 17:09:17',56,31,77,0,0,NULL,NULL,3,NULL),(4,'dsfsdf','dsfdsfd','2016-06-10 18:02:47','2016-06-10 18:02:49','2016-05-30 18:02:41',0,0,44,0,0,NULL,NULL,1,NULL);

/*Data for the table `t_ask_opt` */

/*Data for the table `t_ask_tag` */

insert  into `t_ask_tag`(`id`,`askid`,`tagid`) values (1,1,3),(2,2,1),(3,2,2),(4,2,3),(5,3,3),(6,1,2);

/*Data for the table `t_askinfo` */

/*Data for the table `t_asknote` */

insert  into `t_asknote`(`id`,`content`,`publishtime`,`uid`,`aid`) values (1,'不知道','2016-6-12 18:00:',1,1);

/*Data for the table `t_badges` */

/*Data for the table `t_rights` */

/*Data for the table `t_tag` */

insert  into `t_tag`(`id`,`tagname`,`tagdes`,`uid`,`createTime`) values (1,'SQL','SQL\r\n',1,'2016-06-10 17:07:24'),(2,'JAVA','SD',2,'2016-06-10 17:08:00'),(3,'JQUERY','ZDFDSFDS',3,'2016-06-10 17:08:02');

/*Data for the table `t_user` */

insert  into `t_user`(`id`,`username`,`password`,`status`) values (1,'lugege','123456',1),(2,'hj','123456',1),(3,'xiaomin','123456',1);

/*Data for the table `t_user_badges` */

/*Data for the table `t_userinfo` */

insert  into `t_userinfo`(`id`,`name`,`website`,`location`,`age`,`regDate`,`lastLoginTime`,`reputation`,`url`,`viewcount`,`des`,`favtags`) values (1,'lugege','xxx','xxx',23,'2016-06-10 17:04:21','2016-06-10 17:04:25',1,'eee',58,'我是lugege\r\n',NULL),(2,'hj','yyy','yyy',24,'2016-04-26 17:05:39','2016-06-01 17:05:50',1,'ttt',45,'我是hj\r\n',NULL),(3,'xiaoming','zzz','zzz',25,'2016-05-05 17:05:43','2016-06-04 17:05:55',1,'www',32,'I am xiaoming',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
