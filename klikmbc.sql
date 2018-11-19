/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.31-MariaDB : Database - klikmbc
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`klikmbc` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `klikmbc`;

/*Table structure for table `lembaga` */

DROP TABLE IF EXISTS `lembaga`;

CREATE TABLE `lembaga` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) DEFAULT NULL,
  `surl` varchar(100) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `css` varchar(50) DEFAULT NULL,
  `css2` varchar(50) DEFAULT NULL,
  `warna` varchar(20) DEFAULT NULL,
  `bg_color` varchar(20) DEFAULT NULL,
  `btn_color` varchar(20) DEFAULT NULL,
  `api_status` int(11) DEFAULT NULL,
  `api_userkey` varchar(20) DEFAULT NULL,
  `api_passkey` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `lembaga` */

insert  into `lembaga`(`id`,`nama`,`surl`,`logo`,`css`,`css2`,`warna`,`bg_color`,`btn_color`,`api_status`,`api_userkey`,`api_passkey`) values (1,'Bank Yudha Bakti','localhost','logobank.png','style.css','swiper-slide-merah','#ED5565','red-bg','btn-danger',NULL,NULL,NULL);

/*Table structure for table `t_user_deposit` */

DROP TABLE IF EXISTS `t_user_deposit`;

CREATE TABLE `t_user_deposit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lembaga_id` int(11) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `id_depo` int(11) DEFAULT NULL,
  `tanggal` datetime DEFAULT NULL,
  `case` varchar(255) DEFAULT NULL,
  `id_transaksi` int(11) DEFAULT NULL,
  `ket_transaksi` varchar(255) DEFAULT NULL,
  `debet` double DEFAULT '0',
  `kredit` double DEFAULT '0',
  `sisa_saldo` double DEFAULT NULL,
  `komisi` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_transaksi` (`id_transaksi`),
  KEY `id_depo` (`id_depo`),
  CONSTRAINT `t_user_deposit_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `t_user_deposit_ibfk_2` FOREIGN KEY (`id_depo`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

/*Data for the table `t_user_deposit` */

insert  into `t_user_deposit`(`id`,`lembaga_id`,`id_user`,`id_depo`,`tanggal`,`case`,`id_transaksi`,`ket_transaksi`,`debet`,`kredit`,`sisa_saldo`,`komisi`) values (15,1,1,4,'2018-05-23 09:45:29','Saldo',22,'TopUp',500000,0,0,NULL),(16,1,4,4,'2018-05-23 09:45:29','Saldo',22,'TopUp',0,500000,500000,NULL),(17,1,1,3,'2018-05-23 09:45:33','Saldo',21,'TopUp',1000000,0,0,NULL),(18,1,3,3,'2018-05-23 09:45:33','Saldo',21,'TopUp',0,1000000,1000000,NULL),(19,1,3,3,'2018-05-23 10:46:09','HS10',5,'TELKOMSEL 10 H2H',10500,0,989500,NULL),(20,1,3,3,'2018-05-23 14:19:07','HS10',6,'TELKOMSEL 10 H2H',10350,0,979150,NULL),(21,1,3,3,'2018-05-23 14:21:11','HI50',7,'INDOSAT 50 H2H',49200,0,929950,NULL),(22,1,3,3,'2018-05-23 14:43:51','HX25',8,'XL 25 H2H',25050,0,904900,NULL),(23,1,3,3,'2018-05-23 16:33:10','HIDSD',9,'H2H - Indosat Data Super Internet Bulanan 3.5GB',50000,0,854900,NULL),(24,1,3,3,'2018-05-23 16:35:29','HXLHR30',10,'H2H - XL Data HotRod 800MB',29350,0,825550,NULL),(25,1,3,3,'2018-05-24 09:03:06','HT50',11,'THREE 50 H2H',49250,0,776300,NULL),(26,1,3,3,'2018-05-24 11:01:16','HPTSEL',13,'',125000,0,651300,NULL),(27,1,3,3,'2018-05-24 11:17:22','HPTSEL',14,'Tagihan HALO - Telkomsel Pascabayar',75000,0,576300,NULL),(28,1,3,3,'2018-05-24 11:34:58','HPTSEL',15,'Tagihan HALO - Telkomsel Pascabayar',110000,0,466300,NULL),(29,1,3,3,'2018-05-24 14:50:00','PLNPRAH',16,'TOKEN PLN50',53000,0,413300,NULL),(30,1,3,3,'2018-05-24 16:17:13','PLNPASCH',17,'PLN Pasca Bayar',110000,0,303300,NULL),(31,1,3,3,'2018-05-24 16:22:41','WABDG',18,'PDAM KOTA BANDUNG (JABAR)',29000,0,274300,NULL),(32,1,1,3,'2018-05-25 08:57:44','Saldo',23,'TopUp',10000000,0,0,NULL),(33,1,3,3,'2018-05-25 08:57:44','Saldo',23,'TopUp',0,10000000,10274300,NULL),(34,1,3,3,'2018-05-25 10:43:25','GS30H',19,'GEMSCOOL 30.000',29000,0,10245300,NULL),(35,1,3,3,'2018-05-25 10:44:32','PLNPRAH',20,'TOKEN PLN50',53000,0,10192300,NULL),(36,1,3,3,'2018-05-25 11:05:12','PLNPRAH',21,'TOKEN PLN20',53000,0,10139300,NULL),(37,1,3,3,'2018-05-25 11:06:05','PLNPRAH',22,'TOKEN PLN20',53000,0,10086300,NULL),(38,1,3,3,'2018-05-25 11:07:03','PLNPRAH',23,'TOKEN PLN20',53000,0,10033300,NULL),(39,1,3,3,'2018-05-25 11:08:35','PLNPRAH',24,'TOKEN PLN20',53000,0,9980300,NULL),(40,1,3,3,'2018-05-25 11:31:54','GEP2000H',25,'EP Points 2000',125000,0,9855300,NULL),(41,1,3,3,'2018-05-25 11:34:49','SPEEDY',26,'TELKOM Indihome',29000,0,9826300,NULL),(42,1,3,3,'2018-05-25 13:08:19','TVNEX',27,'NEX MEDIA ',29000,0,9797300,NULL),(43,1,3,3,'2018-05-25 13:13:14','FNADIRAH',28,'ADIRA H2H',29000,0,9768300,NULL),(44,1,3,3,'2018-05-25 13:42:46','ASRBPJKS',29,'BPJS Kesehatan ',29000,0,9739300,NULL),(46,1,3,3,'2018-06-25 13:51:19','WKAI',34,'TIKET KERETA API',91500,0,9486800,NULL),(47,1,3,3,'2018-06-25 14:11:29','WKAI',35,'TIKET KERETA API',185500,0,9301300,NULL),(48,1,3,3,'2018-06-25 15:11:20','WKAI',36,'TIKET KERETA API',91500,0,9209800,NULL),(49,1,3,3,'2018-07-11 12:11:44','HOTEL',37,'BOOKING HOTEL',253800,0,8956000,NULL),(50,1,3,3,'2018-07-12 15:54:09','WKAI',38,'TIKET KERETA API',65500,0,8890500,NULL),(51,1,3,3,'2018-07-12 16:00:44','WKAI',39,'TIKET KERETA API',128500,0,8762000,NULL),(52,1,3,3,'2018-07-12 16:38:52','WKAI',40,'TIKET KERETA API',136000,0,8626000,NULL),(53,1,3,3,'2018-07-13 14:54:21','WKAI',41,'TIKET KERETA API',70500,0,8555500,3500),(54,1,3,3,'2018-07-13 14:59:10','WKAI',42,'TIKET KERETA API',167500,0,8388000,3500),(55,1,3,3,'2018-07-13 15:02:12','WKAI',43,'TIKET KERETA API',335000,0,8053000,7000),(56,1,3,3,'2018-07-13 11:06:20','HOTEL',44,'BOOKING HOTEL',341000,0,7712000,NULL),(57,1,3,3,'2018-07-13 11:19:55','HOTEL',45,'BOOKING HOTEL',160000,0,7552000,9600),(58,1,3,3,'2018-07-13 11:29:37','HOTEL',46,'BOOKING HOTEL',150000,0,7402000,9000),(59,1,3,3,'2018-08-13 14:08:37','WKAI',47,'TIKET KERETA API',87500,0,7314500,3500),(60,1,3,3,'2018-08-13 14:15:40','WKAI',48,'TIKET KERETA API',350000,0,6964500,3500),(61,1,3,3,'2018-08-13 10:09:45','HOTEL',49,'BOOKING HOTEL',347059,0,6617441,20824),(62,1,3,3,'2018-08-13 10:12:29','HOTEL',50,'BOOKING HOTEL',360000,0,6257441,21600),(63,1,3,3,'2018-08-13 10:14:47','HOTEL',51,'BOOKING HOTEL',494118,0,5763323,29647),(64,1,1,1,'2018-09-24 16:47:28','WKAI',52,'TIKET KERETA API',140000,0,4844759,3500),(65,1,1,1,'2018-10-15 10:00:14','PLNPASCH',53,'PLN Pasca Bayar',29000,0,4787859,NULL),(66,1,1,1,'2018-11-14 08:14:07','FLIGHT',54,'BOOKING FLIGHT',6808500,0,-2028491,48377);

/*Table structure for table `trans_flight` */

DROP TABLE IF EXISTS `trans_flight`;

CREATE TABLE `trans_flight` (
  `id` varchar(255) NOT NULL,
  `lembaga_id` int(11) DEFAULT NULL,
  `pp` enum('0','1') DEFAULT NULL,
  `adult` int(2) DEFAULT NULL,
  `child` int(2) DEFAULT NULL,
  `infant` int(2) DEFAULT NULL,
  `depart_date` date DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `total_harga` float DEFAULT NULL,
  `contact_title` varchar(10) DEFAULT NULL,
  `contact_name` varchar(100) DEFAULT NULL,
  `contact_telp` varchar(20) DEFAULT NULL,
  `contact_email` varchar(100) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `user_created` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `trans_flight` */

insert  into `trans_flight`(`id`,`lembaga_id`,`pp`,`adult`,`child`,`infant`,`depart_date`,`return_date`,`total_harga`,`contact_title`,`contact_name`,`contact_telp`,`contact_email`,`date_created`,`user_created`) values ('111130920181',1,'0',1,0,0,'2018-09-28','2018-09-30',4697200,'Tuan','Arie Lesmana Hidayat','08123456789','test@gmail.com','2018-09-13 11:40:58','admin'),('111130920182',1,'0',1,0,0,'2018-09-28','2018-09-30',4697200,'Tuan','Arie Lesmana Hidayat','08123456789','test@gmail.com','2018-09-13 12:21:36','admin'),('111130920183',1,'0',1,0,0,'2018-09-28','2018-09-30',4697200,'Tuan','Arie Lesmana Hidayat','08123456789','test@gmail.com','2018-09-13 12:47:29','admin'),('111130920184',1,'1',1,0,0,'2018-09-28','2018-09-30',4697200,'Tuan','Arie Lesmana Hidayat','08123456789','test@gmail.com','2018-09-13 12:49:57','admin'),('111130920185',1,'1',1,0,0,'2018-09-28','2018-09-30',4697200,'Tuan','Arie Lesmana Hidayat','08123456789','test@gmail.com','2018-09-13 13:35:16','admin'),('111130920186',1,'1',1,0,0,'2018-09-28','2018-09-30',4697200,'Tuan','Arie Lesmana Hidayat','08123456789','test@gmail.com','2018-09-13 13:42:45','admin'),('111131120181',1,'0',1,0,0,'2018-11-30','2018-11-30',2269500,'Tuan','Arie Lesmana Hidayat','085323778786','arielesmanahidayat@gmail.com','2018-11-13 11:38:04','admin'),('111141120181',1,'1',1,0,0,'2018-11-30','2018-12-02',6808500,'Tuan','Arie Lesmana Hidayat','085323778786','arielesmanahidayat@gmail.com','2018-11-14 08:14:07','admin');

/*Table structure for table `trans_flight_detail` */

DROP TABLE IF EXISTS `trans_flight_detail`;

CREATE TABLE `trans_flight_detail` (
  `trans_id` varchar(255) NOT NULL,
  `transactionId` varchar(255) DEFAULT NULL,
  `bookingCode` varchar(255) DEFAULT NULL,
  `paymentCode` varchar(255) DEFAULT NULL,
  `type` enum('Pergi','Pulang') DEFAULT NULL,
  `air_from` varchar(255) DEFAULT NULL,
  `air_to` varchar(255) DEFAULT NULL,
  `depart_time` time DEFAULT NULL,
  `arrival_time` time DEFAULT NULL,
  `transitTime` varchar(50) DEFAULT NULL,
  `flightCode` varchar(20) DEFAULT NULL,
  `flightName` varchar(50) DEFAULT NULL,
  `flightIcon` varchar(255) DEFAULT NULL,
  `is_transit` tinyint(1) DEFAULT NULL,
  `transit_name1` varchar(255) DEFAULT NULL,
  `transit_name2` varchar(255) DEFAULT NULL,
  `depart_transit_time` time DEFAULT NULL,
  `arrival_transit_time` time DEFAULT NULL,
  `seat` varchar(255) DEFAULT NULL,
  `class` varchar(3) DEFAULT NULL,
  `baggage` int(3) DEFAULT NULL,
  `timeLimit` varchar(30) DEFAULT NULL,
  `urlEtiket` text,
  `urlStruk` text,
  KEY `trans_id` (`trans_id`),
  CONSTRAINT `trans_flight_detail_ibfk_1` FOREIGN KEY (`trans_id`) REFERENCES `trans_flight` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `trans_flight_detail` */

insert  into `trans_flight_detail`(`trans_id`,`transactionId`,`bookingCode`,`paymentCode`,`type`,`air_from`,`air_to`,`depart_time`,`arrival_time`,`transitTime`,`flightCode`,`flightName`,`flightIcon`,`is_transit`,`transit_name1`,`transit_name2`,`depart_transit_time`,`arrival_transit_time`,`seat`,`class`,`baggage`,`timeLimit`,`urlEtiket`,`urlStruk`) values ('111130920182','795763739','QE59SN','330928360227','Pergi','CGK-Jakarta (CGK) | Soekarno – Hatta','DPS-Denpasar (DPS) | Ngurah Rai','05:40:00','08:40:00','0j0m','GA400','Garuda Indonesia','https://static.scash.bz/fastravel/assets/images/flighticons/GA.png',0,'Soekarno – Hatta ( CGK )','Ngurah Rai ( DPS )','05:40:00','08:40:00','9;0101~CGK~DPS~GA~400~2018-09-28 05:40:00~2018-09-28 08:40:00~Y~9~1536823821-e98e3b6b77cdec266f13f7d508df974c29d0fa23;Y;0;05:40;garudav4;;;05:40;08:40;GA400;CGK;DPS;2018-09-28;;','Y',20,'2017-08-27 14:51:00','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=795763739','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=795763739'),('111130920183','795763739','QE59SN','330928360227','Pergi','CGK-Jakarta (CGK) | Soekarno – Hatta','DPS-Denpasar (DPS) | Ngurah Rai','05:40:00','08:40:00','0j0m','GA400','Garuda Indonesia','https://static.scash.bz/fastravel/assets/images/flighticons/GA.png',0,'Soekarno – Hatta ( CGK )','Ngurah Rai ( DPS )','05:40:00','08:40:00','9;0101~CGK~DPS~GA~400~2018-09-28 05:40:00~2018-09-28 08:40:00~Y~9~1536823821-e98e3b6b77cdec266f13f7d508df974c29d0fa23;Y;0;05:40;garudav4;;;05:40;08:40;GA400;CGK;DPS;2018-09-28;;','Y',20,'2017-08-27 14:51:00','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=795763739','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=795763739'),('111130920183','795763739','QE59SN','330928360227','Pulang','CGK-Jakarta (CGK) | Soekarno – Hatta','DPS-Denpasar (DPS) | Ngurah Rai','14:55:00','17:40:00','0j0m','GA253','Garuda Indonesia','https://static.scash.bz/fastravel/assets/images/flighticons/GA.png',1,'Ngurah Rai ( DPS )','Adisutjipto ( JOG )','14:55:00','15:30:00','9;0301~DPS~JOG~GA~253~2018-09-30 14:55:00~2018-09-30 15:30:00~Y~9~1536807282-bf093932877c5f4f1715c0c53080582941b20446;Y;0;14:55;garudav4;;;14:55;15:30;GA253;DPS;JOG;2018-09-30;;','Y',20,'2017-08-27 14:51:00','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=795763739','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=795763739'),('111130920183','795763739','QE59SN','330928360227','Pulang','CGK-Jakarta (CGK) | Soekarno – Hatta','DPS-Denpasar (DPS) | Ngurah Rai','14:55:00','17:40:00','0j50m','GA213','Garuda Indonesia','https://static.scash.bz/fastravel/assets/images/flighticons/GA.png',1,'Adisutjipto ( JOG )','Soekarno – Hatta ( CGK )','16:20:00','17:40:00','9;0302~JOG~CGK~GA~213~2018-09-30 16:20:00~2018-09-30 17:40:00~Y~9~1536807282-bf093932877c5f4f1715c0c53080582941b20446;Y;0;16:20;garudav4;;;16:20;17:40;GA213;JOG;CGK;2018-09-30;;','Y',20,'2017-08-27 14:51:00','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=795763739','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=795763739'),('111130920184','795763739','QE59SN','330928360227','Pergi','CGK-Jakarta (CGK) | Soekarno – Hatta','DPS-Denpasar (DPS) | Ngurah Rai','05:40:00','08:40:00','0j0m','GA400','Garuda Indonesia','https://static.scash.bz/fastravel/assets/images/flighticons/GA.png',0,'Soekarno – Hatta ( CGK )','Ngurah Rai ( DPS )','05:40:00','08:40:00','9;0101~CGK~DPS~GA~400~2018-09-28 05:40:00~2018-09-28 08:40:00~Y~9~1536823821-e98e3b6b77cdec266f13f7d508df974c29d0fa23;Y;0;05:40;garudav4;;;05:40;08:40;GA400;CGK;DPS;2018-09-28;;','Y',20,'2017-08-27 14:51:00','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=795763739','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=795763739'),('111130920184','795763739','QE59SN','330928360227','Pulang','DPS-Denpasar (DPS) | Ngurah Rai','CGK-Jakarta (CGK) | Soekarno – Hatta','14:55:00','17:40:00','0j0m','GA253','Garuda Indonesia','https://static.scash.bz/fastravel/assets/images/flighticons/GA.png',1,'Ngurah Rai ( DPS )','Adisutjipto ( JOG )','14:55:00','15:30:00','9;0301~DPS~JOG~GA~253~2018-09-30 14:55:00~2018-09-30 15:30:00~Y~9~1536807282-bf093932877c5f4f1715c0c53080582941b20446;Y;0;14:55;garudav4;;;14:55;15:30;GA253;DPS;JOG;2018-09-30;;','Y',20,'2017-08-27 14:51:00','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=795763739','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=795763739'),('111130920184','795763739','QE59SN','330928360227','Pulang','DPS-Denpasar (DPS) | Ngurah Rai','CGK-Jakarta (CGK) | Soekarno – Hatta','14:55:00','17:40:00','0j50m','GA213','Garuda Indonesia','https://static.scash.bz/fastravel/assets/images/flighticons/GA.png',1,'Adisutjipto ( JOG )','Soekarno – Hatta ( CGK )','16:20:00','17:40:00','9;0302~JOG~CGK~GA~213~2018-09-30 16:20:00~2018-09-30 17:40:00~Y~9~1536807282-bf093932877c5f4f1715c0c53080582941b20446;Y;0;16:20;garudav4;;;16:20;17:40;GA213;JOG;CGK;2018-09-30;;','Y',20,'2017-08-27 14:51:00','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=795763739','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=795763739'),('111130920185','795763739','QE59SN','330928360227','Pergi','CGK-Jakarta (CGK) | Soekarno – Hatta','DPS-Denpasar (DPS) | Ngurah Rai','05:40:00','08:40:00','0j0m','GA400','Garuda Indonesia','https://static.scash.bz/fastravel/assets/images/flighticons/GA.png',0,'Soekarno – Hatta ( CGK )','Ngurah Rai ( DPS )','05:40:00','08:40:00','9;0101~CGK~DPS~GA~400~2018-09-28 05:40:00~2018-09-28 08:40:00~Y~9~1536823821-e98e3b6b77cdec266f13f7d508df974c29d0fa23;Y;0;05:40;garudav4;;;05:40;08:40;GA400;CGK;DPS;2018-09-28;;','Y',20,'2017-08-27 14:51:00','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=795763739','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=795763739'),('111130920185','795763739','QE59SN','330928360227','Pulang','DPS-Denpasar (DPS) | Ngurah Rai','CGK-Jakarta (CGK) | Soekarno – Hatta','14:55:00','17:40:00','0j0m','GA253','Garuda Indonesia','https://static.scash.bz/fastravel/assets/images/flighticons/GA.png',1,'Ngurah Rai ( DPS )','Adisutjipto ( JOG )','14:55:00','15:30:00','9;0301~DPS~JOG~GA~253~2018-09-30 14:55:00~2018-09-30 15:30:00~Y~9~1536807282-bf093932877c5f4f1715c0c53080582941b20446;Y;0;14:55;garudav4;;;14:55;15:30;GA253;DPS;JOG;2018-09-30;;','Y',20,'2017-08-27 14:51:00','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=795763739','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=795763739'),('111130920185','795763739','QE59SN','330928360227','Pulang','DPS-Denpasar (DPS) | Ngurah Rai','CGK-Jakarta (CGK) | Soekarno – Hatta','14:55:00','17:40:00','0j50m','GA213','Garuda Indonesia','https://static.scash.bz/fastravel/assets/images/flighticons/GA.png',1,'Adisutjipto ( JOG )','Soekarno – Hatta ( CGK )','16:20:00','17:40:00','9;0302~JOG~CGK~GA~213~2018-09-30 16:20:00~2018-09-30 17:40:00~Y~9~1536807282-bf093932877c5f4f1715c0c53080582941b20446;Y;0;16:20;garudav4;;;16:20;17:40;GA213;JOG;CGK;2018-09-30;;','Y',20,'2017-08-27 14:51:00','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=795763739','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=795763739'),('111130920186','795763739','QE59SN','330928360227','Pergi','CGK-Jakarta (CGK) | Soekarno – Hatta','DPS-Denpasar (DPS) | Ngurah Rai','05:40:00','08:40:00','0j0m','GA400','Garuda Indonesia','https://static.scash.bz/fastravel/assets/images/flighticons/GA.png',0,'Soekarno – Hatta ( CGK )','Ngurah Rai ( DPS )','05:40:00','08:40:00','9;0101~CGK~DPS~GA~400~2018-09-28 05:40:00~2018-09-28 08:40:00~Y~9~1536823821-e98e3b6b77cdec266f13f7d508df974c29d0fa23;Y;0;05:40;garudav4;;;05:40;08:40;GA400;CGK;DPS;2018-09-28;;','Y',20,'2017-08-27 14:51:00','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=795763739','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=795763739'),('111130920186','795763739','QE59SN','330928360227','Pulang','DPS-Denpasar (DPS) | Ngurah Rai','CGK-Jakarta (CGK) | Soekarno – Hatta','14:55:00','17:40:00','0j0m','GA253','Garuda Indonesia','https://static.scash.bz/fastravel/assets/images/flighticons/GA.png',1,'Ngurah Rai ( DPS )','Adisutjipto ( JOG )','14:55:00','15:30:00','9;0301~DPS~JOG~GA~253~2018-09-30 14:55:00~2018-09-30 15:30:00~Y~9~1536807282-bf093932877c5f4f1715c0c53080582941b20446;Y;0;14:55;garudav4;;;14:55;15:30;GA253;DPS;JOG;2018-09-30;;','Y',20,'2017-08-27 14:51:00','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=795763739','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=795763739'),('111130920186','795763739','QE59SN','330928360227','Pulang','DPS-Denpasar (DPS) | Ngurah Rai','CGK-Jakarta (CGK) | Soekarno – Hatta','14:55:00','17:40:00','0j50m','GA213','Garuda Indonesia','https://static.scash.bz/fastravel/assets/images/flighticons/GA.png',1,'Adisutjipto ( JOG )','Soekarno – Hatta ( CGK )','16:20:00','17:40:00','9;0302~JOG~CGK~GA~213~2018-09-30 16:20:00~2018-09-30 17:40:00~Y~9~1536807282-bf093932877c5f4f1715c0c53080582941b20446;Y;0;16:20;garudav4;;;16:20;17:40;GA213;JOG;CGK;2018-09-30;;','Y',20,'2017-08-27 14:51:00','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=795763739','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=795763739'),('111131120181','1175837810','QA23GA','','Pergi','CGK-Jakarta (CGK) | Soekarno – Hatta','SIN-Singapore (SIN) | Singapore Changi','06:10:00','09:00:00','0j0m','GA824','Garuda Indonesia','https://static.scash.bz/fastravel/asset/maskapai/TPGA.png',0,'Soekarno – Hatta ( CGK )','Singapore Changi ( SIN )','06:10:00','09:00:00','9;0101~CGK~SIN~GA~824~2018-11-30 06:10:00~2018-11-30 09:00:00~N~9~1542093233-a143d45c9682cbd24b1d7624d56897ee3470ce6d;N;2284200;06:10;garudav4;;;06:10;09:00;GA824;CGK;SIN;2018-11-30;;','N',20,'13-Nov-2018 16:01','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=796636956','http://api.fastravel.co.id/app/generate_struk?id_transaksi=796636956'),('111141120181','1176859693','SQMMJD','','Pergi','CGK-Jakarta (CGK) | Soekarno – Hatta','PDG-Padang (PDG) | Minangkabau','05:30:00','14:45:00','0j0m','GA100','Garuda Indonesia','https://static.scash.bz/fastravel/asset/maskapai/TPGA.png',0,'Soekarno – Hatta ( CGK )','Sultan Mahmud Badaruddin II ( PLM )','05:30:00','06:45:00','8;0201~CGK~PLM~GA~100~2018-11-30 05:30:00~2018-11-30 06:45:00~Q~8~1542179131-4c046bdd30d0f5b8c67f609528f3b2dbcfe95b7c;Q;0;05:30;garudav4;;;05:30;06:45;GA100;CGK;PLM;2018-11-30;;','Q',20,'14-Nov-2018 15:53','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=796636956','http://api.fastravel.co.id/app/generate_struk?id_transaksi=796636956'),('111141120181','1176859824','SR6FH6','','Pergi','CGK-Jakarta (CGK) | Soekarno – Hatta','PDG-Padang (PDG) | Minangkabau','05:30:00','14:45:00','6j20m','GA7214','Garuda Indonesia','https://static.scash.bz/fastravel/asset/maskapai/TPGA.png',0,'Sultan Mahmud Badaruddin II ( PLM )','Minangkabau ( PDG )','13:05:00','14:45:00','8;0202~PLM~PDG~GA~7214~2018-11-30 13:05:00~2018-11-30 14:45:00~Q~8~1542179131-4c046bdd30d0f5b8c67f609528f3b2dbcfe95b7c;Q;0;13:05;garudav4;;;13:05;14:45;GA7214;PLM;PDG;2018-11-30;;','Q',20,'14-Nov-2018 15:53','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=796636956','http://api.fastravel.co.id/app/generate_struk?id_transaksi=796636956'),('111141120181','1176859935','SQNVSO','','Pulang','PDG-Padang (PDG) | Minangkabau','CGK-Jakarta (CGK) | Soekarno – Hatta','06:05:00','08:00:00','0j0m','GA161','Garuda Indonesia','https://static.scash.bz/fastravel/asset/maskapai/TPGA.png',0,'Minangkabau ( PDG )','Soekarno – Hatta ( CGK )','06:05:00','08:00:00','9;0101~PDG~CGK~GA~161~2018-12-02 06:05:00~2018-12-02 08:00:00~Y~9~1542179134-325638051d5b69f360c06a4136659d6f497b9dd9;Y;1921600;06:05;garudav4;;;06:05;08:00;GA161;PDG;CGK;2018-12-02;;','Y',20,'14-Nov-2018 15:53','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=796636956','http://api.fastravel.co.id/app/generate_struk?id_transaksi=796636956');

/*Table structure for table `trans_flight_detail_harga` */

DROP TABLE IF EXISTS `trans_flight_detail_harga`;

CREATE TABLE `trans_flight_detail_harga` (
  `trans_id` varchar(255) NOT NULL,
  `transactionId` varchar(255) DEFAULT NULL,
  `nominal` double DEFAULT NULL,
  `commision` double DEFAULT NULL,
  `nominalAdmin` double DEFAULT NULL,
  `paymentStatus` int(2) DEFAULT NULL,
  KEY `trans_id` (`trans_id`),
  CONSTRAINT `trans_flight_detail_harga_ibfk_1` FOREIGN KEY (`trans_id`) REFERENCES `trans_flight` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `trans_flight_detail_harga` */

insert  into `trans_flight_detail_harga`(`trans_id`,`transactionId`,`nominal`,`commision`,`nominalAdmin`,`paymentStatus`) values ('111130920186','795763739',1951100,0,0,1),('111130920186','795763739',1593300,0,0,1),('111130920186','795763739',1152800,0,0,1),('111131120181','1175837810',2269500,21911,0,1),('111141120181','1176859693',971000,10427,0,1),('111141120181','1176859824',1221000,14543,0,1),('111141120181','1176859935',1921600,23407,0,1);

/*Table structure for table `trans_flight_detail_penumpang` */

DROP TABLE IF EXISTS `trans_flight_detail_penumpang`;

CREATE TABLE `trans_flight_detail_penumpang` (
  `trans_id` varchar(255) NOT NULL,
  `type` enum('Dewasa','Anak-Anak','Bayi') DEFAULT NULL,
  `title` varchar(10) DEFAULT NULL,
  `fname` varchar(255) DEFAULT NULL,
  `lname` varchar(255) DEFAULT NULL,
  `kewarganegaraan` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `no_telp` varchar(15) DEFAULT NULL,
  `no_hp` varchar(15) DEFAULT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `id_card` varchar(20) DEFAULT NULL,
  `no_id_card` varchar(255) DEFAULT NULL,
  KEY `trans_id` (`trans_id`),
  CONSTRAINT `trans_flight_detail_penumpang_ibfk_1` FOREIGN KEY (`trans_id`) REFERENCES `trans_flight` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `trans_flight_detail_penumpang` */

insert  into `trans_flight_detail_penumpang`(`trans_id`,`type`,`title`,`fname`,`lname`,`kewarganegaraan`,`email`,`no_telp`,`no_hp`,`tgl_lahir`,`id_card`,`no_id_card`) values ('111130920185','Dewasa','Tuan','Arie Lesmana','Hidayat','id','test@gmail.com','02212345678','08123456789','1985-01-01','KTP','3121212121333333'),('111130920186','Dewasa','Tuan','Arie Lesmana','Hidayat','id','test@gmail.com','02212345678','08123456789','1985-01-01','KTP','3121212121333333'),('111131120181','Dewasa','Tuan','Arie Lesmana','Hidayat','id','arielesmanahidayat@gmail.com','0','085323778786','1993-11-15','KTP','3279021511930005'),('111141120181','Dewasa','Tuan','Arie Lesmana','Hidayat','id','arielesmanahidayat@gmail.com','0','085323778786','1993-11-15','KTP','3279021511930005');

/*Table structure for table `trans_hotel` */

DROP TABLE IF EXISTS `trans_hotel`;

CREATE TABLE `trans_hotel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_created` datetime DEFAULT NULL,
  `user_created` varchar(100) DEFAULT NULL,
  `lembaga_id` int(11) DEFAULT NULL,
  `contact_fname` varchar(255) DEFAULT NULL,
  `contact_lname` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `contact_telp` varchar(15) DEFAULT NULL,
  `contact_city` varchar(50) DEFAULT NULL,
  `total_harga` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `trans_hotel` */

insert  into `trans_hotel`(`id`,`date_created`,`user_created`,`lembaga_id`,`contact_fname`,`contact_lname`,`contact_email`,`contact_telp`,`contact_city`,`total_harga`) values (1,'2018-07-11 11:20:34','agen01',1,'TEST','API','testapi@gmail.com','081234567890','Bandung',660000),(2,'2018-07-11 12:11:44','agen01',1,'TEST','API','testapi@gmail.com','081234567890','Bandung',270000),(3,'2018-07-13 11:06:20','agen01',1,'TEST','API','test@gmail.com','081234567890','Bandung',341000),(4,'2018-07-13 11:19:55','agen01',1,'TEST','API','test@gmail.com','081234567890','Bandung',160000),(5,'2018-07-13 11:29:37','agen01',1,'TUAN ','TES API','tesapi@gmail.com','081234567890','Bandung',150000),(6,'2018-08-13 10:09:45','agen01',1,'test','test','test@gmail.com','086343746734','bandung',347059),(7,'2018-08-13 10:10:13','agen01',1,'test','test','test@gmail.com','086343746734','bandung',347059),(8,'2018-08-13 10:12:29','agen01',1,'test','tetstst','tey@gmai.com','0834782734982','bandung',360000),(9,'2018-08-13 10:14:47','agen01',1,'uhfis','dfhidfhiud','hfdusf@gmail.com','09453985093485','ngdfjgnjdg',494118);

/*Table structure for table `trans_hotel_detail` */

DROP TABLE IF EXISTS `trans_hotel_detail`;

CREATE TABLE `trans_hotel_detail` (
  `bookingCode` varchar(100) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `mid` varchar(100) DEFAULT NULL,
  `hotelId` varchar(100) DEFAULT NULL,
  `hotelName` varchar(100) DEFAULT NULL,
  `hotelAddress` text,
  `checkInDate` date DEFAULT NULL,
  `checkOutDate` date DEFAULT NULL,
  `jumlahTamu` int(2) DEFAULT NULL,
  `jumlahKamar` int(2) DEFAULT NULL,
  `typeKamar` varchar(255) DEFAULT NULL,
  `roomImage` text,
  `urlEtiket` text,
  `urlStruk` text,
  PRIMARY KEY (`bookingCode`),
  KEY `id` (`id`),
  CONSTRAINT `trans_hotel_detail_ibfk_1` FOREIGN KEY (`id`) REFERENCES `trans_hotel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `trans_hotel_detail` */

insert  into `trans_hotel_detail`(`bookingCode`,`id`,`mid`,`hotelId`,`hotelName`,`hotelAddress`,`checkInDate`,`checkOutDate`,`jumlahTamu`,`jumlahKamar`,`typeKamar`,`roomImage`,`urlEtiket`,`urlStruk`) values ('49790922',1,'2749261016','1207','Surya Kencana Seaside Hotel Pangandaran','Pantai Barat Pananjung, Pangandaran - 46396nWest Java - Indonesia, Pangandaran,','2018-08-01','2018-08-03',2,1,'Kamar Standar ','https://tiket.com/img/business/s/t/business-standar-room-suryakencanaseasidehotelpangandaran-pangandaran1666.l.jpg','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=&id_outlet=SP110816','http://api.fastravel.co.id/app/generate_struk?id_transaksi='),('49794475',2,'2749385141','2633','Jardin Smart Residence','Jalan Simpang Borobudur IV Nomor 50, Kec. Blimbing, Kota Malang, Jawa Timur 65142, Lowokwaru,','2018-08-01','2018-08-03',2,1,'Standard Room (Tanpa Merokok)','https://tiket.com/img/business/s/t/business-standard-room--no-smoking--jardinsmartresidence-malang5728.l.jpg','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=&id_outlet=SP110816','http://api.fastravel.co.id/app/generate_struk?id_transaksi='),('49923118',3,'2753500749','1313','Hotel Tosari','Jl. KH Achmad Dahlan No.31, Klojen, Malang','2018-08-17','2018-08-19',2,1,'Standard Twin','https://tiket.com/img/business/s/t/business-standard-twin-hotel-tosari-malang-1761.l.jpg','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=&id_outlet=SP110816','http://api.fastravel.co.id/app/generate_struk?id_transaksi='),('49923963',4,'2753528282','3010','The Colorville','Sawit, Darangdan, Purwakarta Regency, West Java 41163, Indonesia, Darangdan,','2018-08-03','2018-08-04',1,1,'Standard Room','https://tiket.com/img/business/s/t/business-standard-room-thecolorville-purwakarta9883.l.jpg','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=&id_outlet=SP110816','http://api.fastravel.co.id/app/generate_struk?id_transaksi='),('49924590',5,'2753547759','510','POD House Makassar','Jl Penghibur no 58-59 Losari Makassar, Losari,','2018-08-03','2018-08-04',2,1,'Business Pod No Breakfast','https://tiket.com/img/business/p/o/business--podhouselosari-makassar6943.l.jpg','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=&id_outlet=SP110816','http://api.fastravel.co.id/app/generate_struk?id_transaksi='),('51667130',6,'2817113788','3056','Dominic Hotel Purwokerto','jl Kombes Bambang Suprapto no 39-41 Purwokerto, Purwokerto Timur,','2018-08-18','2018-08-19',1,1,'Superior','https://tiket.com/img/business/s/u/business-superior-dominichotelpurwokerto-purwokerto7161.l.jpg','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=&id_outlet=SP110816','http://api.fastravel.co.id/app/generate_struk?id_transaksi='),('51667625',8,'2817119118','3491','Hotel Cahya Nirwana','Jl. Kol Sugiono 15, RT 001/02, Purwanegara, Purwokerto Timur, Purwanegara, Purwokerto Timur. Kabupaten Banyumas, Jawa Tengah 53116, Purwokerto Utara,','2018-08-18','2018-08-19',1,1,'Deluxe Twin','https://tiket.com/img/default/d/e/default-default.l.jpg','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=&id_outlet=SP110816','http://api.fastravel.co.id/app/generate_struk?id_transaksi='),('51667772',9,'2817123170','3058','COR Hotel Purwokerto','Jl Jendral Sudirman No 508-511, Purwokerto Timur,','2018-08-18','2018-08-19',1,1,'Junior Suite (1 Bed Besar)','https://tiket.com/img/business/j/u/business-junior-suite--1-bed-besar--corhotelpurwokerto-banyumas2837.l.jpg','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=&id_outlet=SP110816','http://api.fastravel.co.id/app/generate_struk?id_transaksi=');

/*Table structure for table `trans_hotel_detail_harga` */

DROP TABLE IF EXISTS `trans_hotel_detail_harga`;

CREATE TABLE `trans_hotel_detail_harga` (
  `idTransaction` varchar(100) NOT NULL,
  `id` int(11) DEFAULT NULL,
  `methodPayment` varchar(20) DEFAULT NULL,
  `namaBank` varchar(20) DEFAULT NULL,
  `noRekening` varchar(20) DEFAULT NULL,
  `namaPengirim` varchar(100) DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `totalAmount` float DEFAULT NULL,
  `taxAmount` float DEFAULT NULL,
  `komisi` float DEFAULT NULL,
  `nominal` float DEFAULT NULL,
  `nominalAdmin` float DEFAULT NULL,
  `timeLimit` datetime DEFAULT NULL,
  PRIMARY KEY (`idTransaction`),
  KEY `id` (`id`),
  CONSTRAINT `trans_hotel_detail_harga_ibfk_1` FOREIGN KEY (`id`) REFERENCES `trans_hotel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `trans_hotel_detail_harga` */

insert  into `trans_hotel_detail_harga`(`idTransaction`,`id`,`methodPayment`,`namaBank`,`noRekening`,`namaPengirim`,`amount`,`totalAmount`,`taxAmount`,`komisi`,`nominal`,`nominalAdmin`,`timeLimit`) values ('1055793738',1,'Tunai','-','-','-',330000,660000,0,39600,660000,0,'2018-07-11 18:19:58'),('1055844360',2,'Transfer','Bank BCA','0101010101010101','Arie',135000,270000,0,16200,270000,0,'2018-07-11 19:10:51'),('1057563360',3,'Tunai','-','-','-',170500,341000,0,20460,341000,0,'2018-07-13 18:05:41'),('1057574752',4,'Tunai','-','-','-',160000,160000,0,9600,160000,0,'2018-07-13 18:19:12'),('1057583121',5,'Tunai','-','-','-',150000,150000,0,9000,150000,0,'2018-07-13 18:28:56'),('1086497875',6,'Tunai','-','-','-',347059,347059,0,20824,347059,0,'2018-08-13 17:04:59'),('1086503362',8,'Tunai','-','-','-',360000,360000,0,0,360000,0,'2018-08-13 17:11:57'),('1086505149',9,'Tunai','-','-','-',494118,494118,0,0,494118,0,'2018-08-13 17:14:16');

/*Table structure for table `trans_hotel_guest` */

DROP TABLE IF EXISTS `trans_hotel_guest`;

CREATE TABLE `trans_hotel_guest` (
  `bookingCode` varchar(100) DEFAULT NULL,
  `guestFname` varchar(100) DEFAULT NULL,
  `guestLname` varchar(100) DEFAULT NULL,
  `guestIdCard` varchar(100) DEFAULT NULL,
  KEY `bookingCode` (`bookingCode`),
  CONSTRAINT `trans_hotel_guest_ibfk_1` FOREIGN KEY (`bookingCode`) REFERENCES `trans_hotel_detail` (`bookingCode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `trans_hotel_guest` */

insert  into `trans_hotel_guest`(`bookingCode`,`guestFname`,`guestLname`,`guestIdCard`) values ('49794475','Fixgan','Hapissa','01012013'),('49923118','Arie','Lesmana','3279021511930005'),('49923118','Fixgan','Hapissa','01012013'),('49923963','Arie','Lesmana','3279021511930005'),('49924590','Arie','Lesmana','3279021511930005'),('49924590','Fixgan','Hapissa','01012010'),('51667130','test','test','78236742368423'),('51667625','test','testst','726378623826'),('51667772','gfdgyud','fdsfugsu','984039859034');

/*Table structure for table `trans_kereta` */

DROP TABLE IF EXISTS `trans_kereta`;

CREATE TABLE `trans_kereta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lembaga_id` int(11) DEFAULT NULL,
  `pp` enum('0','1') DEFAULT NULL,
  `total_harga` float DEFAULT NULL,
  `contact_name` varchar(255) DEFAULT NULL,
  `contact_email` varchar(255) DEFAULT NULL,
  `contact_telp` varchar(15) DEFAULT NULL,
  `contact_addr` text,
  `date_created` datetime DEFAULT NULL,
  `user_created` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=latin1;

/*Data for the table `trans_kereta` */

insert  into `trans_kereta`(`id`,`lembaga_id`,`pp`,`total_harga`,`contact_name`,`contact_email`,`contact_telp`,`contact_addr`,`date_created`,`user_created`) values (37,1,'1',760000,'Arie','arielesmanahidayat@gmail.com','085323778786','Bandung','2018-04-26 16:39:55','admin'),(38,1,'1',760000,'Arie','arielesmanahidayat@gmail.com','085323778786','Bandung','2018-04-26 16:40:27','admin'),(39,1,'1',760000,'Arie','arielesmanahidayat@gmail.com','085323778786','Bandung','2018-04-26 16:43:27','admin'),(40,1,'0',190000,'Arie Lesmana Hidayat','arielesmanahidayat@gmail.com','085323778786','Bandung','2018-04-26 17:28:23','admin'),(41,1,'0',190000,'Arie Lesmana Hidayat','arielesmanahidayat@gmail.com','085323778786','Bandung','2018-04-26 17:29:07','admin'),(42,1,'0',170000,'Arie','arielesmanahidayat@gmail.com','085323778786','Bandung','2018-04-27 09:03:41','admin'),(43,1,'0',90000,'Arie','arielesmanahidayat@gmail.com','085323778786','Bandung','2018-04-27 09:28:45','admin'),(44,1,'0',340000,'Arie','arielesmanahidayat@gmail.com','085323778786','Bandung','2018-04-27 09:31:32','admin'),(45,1,'0',170000,'Arie','arielesmanahidayat@gmail.com','085323778786','Bandung','2018-04-27 09:33:48','admin'),(46,1,'0',170000,'Arie','arielesmanahidayat@gmail.com','085323778786','Bandung','2018-04-27 09:34:52','admin'),(47,1,'0',215000,'Arie','arielesmanahidayat@gmail.com','085323778786','Bandung','2018-04-27 09:37:00','admin'),(48,1,'1',720000,'Arie','arie@gmail.com','085323778786','Bandung','2018-04-27 16:29:23','admin'),(49,1,'0',91500,'Arie','arielesmanahidayat@gmail.com','085323778786','Bandung','2018-06-22 14:25:37','agen01'),(50,1,'0',91500,'Kontak Arie','arielesmanahidayat@gmail.com','085323778786','Bandung','2018-06-22 14:53:56','agen01'),(51,1,'0',320000,'Arie','arielesmanahidayat@gmail.com','085323778786','Bandung','2018-06-22 15:00:30','agen01'),(52,1,'0',87500,'Arie','arielesmanahidayat@gmail.com','085323778786','Bandung','2018-06-22 15:50:01','agen01'),(53,1,'0',87500,'Arie','arielesmanahidayat@gmail.com','085323778786','Bandung','2018-06-22 15:56:26','agen01'),(54,1,'0',74500,'Arie','arielesmanahidayat@gmail.com','085323778786','Bandung','2018-06-22 15:59:31','agen01'),(55,1,'0',350000,'Arie','arielesmanahidayat@gmail.com','085323778786','Bandung','2018-06-22 16:03:49','agen01'),(56,1,'0',74500,'Arie','arielesmanahidayat@gmail.com','085323778786','Bandung','2018-06-22 16:07:53','agen01'),(57,1,'0',350000,'Arie','arielesmanahidayat@gmail.com','085323778786','Bandung','2018-06-22 16:12:41','agen01'),(60,1,'1',185500,'Arie','arielesmanahidayat@gmail.com','085323778786','Bandung','2018-06-22 17:06:57','agen01'),(61,1,'1',1290000,'Arie','arielesmanahidayat@gmail.com','085323778786','Bandung','2018-06-25 09:46:04','agen01'),(67,1,'0',91500,'Arie','arielesmanahidayat@gmail.com','08532378786','Bandung','2018-06-25 13:51:19','agen01'),(68,1,'1',185500,'Arie','arielesmanahidayat@gmail.com','085323778786','Bandung','2018-06-25 14:11:29','agen01'),(69,1,'0',91500,'Arie','arielesmanahidayat@gmail.com','085323778786','Bandung','2018-06-25 15:11:20','agen01'),(70,1,'0',65500,'Test','test@gmail.com','081234567890','Bandung','2018-07-12 15:54:09','agen01'),(71,1,'1',128500,'Tuan Pulang Pergi','tuanpulangpergi@gmail.com','081234567890','Bandung','2018-07-12 16:00:44','agen01'),(72,1,'1',136000,'Test','test@gmail.com','08123456789','Bandung','2018-07-12 16:38:51','agen01'),(73,1,'0',70500,'TEST','test@gmail.com','081234567890','Bandung','2018-07-13 14:54:21','agen01'),(74,1,'0',167500,'Tes','test@gmail.com','081234567890','Bandung','2018-07-13 14:59:10','agen01'),(75,1,'1',335000,'TEST','test@gmail.com','08123456780','Bandung','2018-07-13 15:02:12','agen01'),(76,1,'0',87500,'test','test@gmail.com','08749384234234','Bandung','2018-08-13 14:08:37','agen01'),(77,1,'0',350000,'tes','tes@gmail.com','0873642763472','bandung','2018-08-13 14:15:40','agen01'),(78,1,'0',140000,'Test','test@gmail.com','081234567890','Bandung','2018-09-24 16:47:28','admin');

/*Table structure for table `trans_kereta_detail` */

DROP TABLE IF EXISTS `trans_kereta_detail`;

CREATE TABLE `trans_kereta_detail` (
  `bookingCode` varchar(255) NOT NULL,
  `trans_id` int(11) DEFAULT NULL,
  `idTransaction` varchar(255) DEFAULT NULL,
  `type` enum('Pergi','Pulang') DEFAULT NULL,
  `st_from` varchar(255) DEFAULT NULL,
  `st_to` varchar(255) DEFAULT NULL,
  `train_name` varchar(255) DEFAULT NULL,
  `grade` varchar(50) DEFAULT NULL,
  `subclass` varchar(10) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `departure_date` date DEFAULT NULL,
  `arrival_date` date DEFAULT NULL,
  `departure_time` time DEFAULT NULL,
  `arrival_time` time DEFAULT NULL,
  `jumlah_dewasa` int(2) DEFAULT NULL,
  `jumlah_bayi` int(2) DEFAULT NULL,
  `timeLimit` varchar(30) DEFAULT NULL,
  `urlEtiket` text,
  `urlStruk` text,
  PRIMARY KEY (`bookingCode`),
  KEY `trans_id` (`trans_id`),
  CONSTRAINT `trans_kereta_detail_ibfk_1` FOREIGN KEY (`trans_id`) REFERENCES `trans_kereta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `trans_kereta_detail` */

insert  into `trans_kereta_detail`(`bookingCode`,`trans_id`,`idTransaction`,`type`,`st_from`,`st_to`,`train_name`,`grade`,`subclass`,`price`,`departure_date`,`arrival_date`,`departure_time`,`arrival_time`,`jumlah_dewasa`,`jumlah_bayi`,`timeLimit`,`urlEtiket`,`urlStruk`) values ('1FQGEG',52,'1038303124','Pergi','KIARACONDONG-KAC','BANJAR-BJR','KAHURIPAN-182','K','C',80000,'2018-08-16','0000-00-00','18:10:00','21:56:00',1,0,'22 Juni 2018 17:49:16',NULL,NULL),('42KKZY',48,'987323283','Pulang','BANJAR-BJR','BANDUNG-BD','MALABAR-91','K','C',190000,'2018-05-01','2018-05-01','04:03:00','07:48:00',2,0,'27 April 2018 18:31:03',NULL,NULL),('482XRN',51,'1038264953','Pergi','BANDUNG-BD','SOLOBALAPAN-SLO','LODAYA-82','E','A',320000,'2018-06-30','0000-00-00','18:55:00','03:58:00',1,0,'22 Juni 2018 16:59:19',NULL,NULL),('4XJ9JG',74,'1057511751','Pergi','KIARACONDONG-KAC','LEMPUYANGAN-LPN','KAHURIPAN-182','K','C',80000,'2018-08-17','0000-00-00','18:10:00','02:40:00',2,0,'13 Juli 2018 16:58:38','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=1057511751','http://api.fastravel.co.id/app/generate_struk?id_transaksi=1057511751'),('6F1Q4X',39,'986499725','Pergi','BANDUNG-BD','BANJAR-BJR','MALABAR-92','K','C',190000,'2018-05-17','2018-05-18','15:45:00','19:36:00',2,0,'26 April 2018 18:45:00',NULL,NULL),('6J7PVM',73,'1057504221','Pergi','KIARACONDONG-KAC','BANJAR-BJR','SERAYU-216','K','C',63000,'2018-08-24','0000-00-00','13:10:00','17:08:00',1,0,'13 Juli 2018 16:48:35','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=1057504221','http://api.fastravel.co.id/app/generate_struk?id_transaksi=1057504221'),('6VXKZU',61,'1040425963','Pulang','YOGYAKARTA-YK','KIARACONDONG-KAC','LODAYA-79','B','B',215000,'2018-08-19','2018-08-19','08:08:00','15:35:00',3,0,'25 Juni 2018 11:40:21',NULL,NULL),('8FSBUQ',70,'1056683045','Pergi','KIARACONDONG-KAC','BANJAR-BJR','KUTOJAYA SELATAN-204','K','C',58000,'2018-08-17','0000-00-00','21:00:00','00:46:00',1,0,'12 Juli 2018 17:53:11','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=1056683045','http://api.fastravel.co.id/app/generate_struk?id_transaksi=1056683045'),('9AR4A9',60,'1038371304','Pergi','KIARACONDONG-KAC','BANJAR-BJR','KAHURIPAN-182','K','C',84000,'2018-06-26','2018-06-27','18:10:00','21:56:00',1,0,'22 Juni 2018 19:06:09',NULL,NULL),('AXU29Q',40,'986541730','Pergi','BANDUNG-BD','BANJAR-BJR','MALABAR-92','K','C',190000,'2018-05-31','0000-00-00','15:45:00','19:36:00',1,0,'26 April 2018 19:29:50',NULL,NULL),('BZWPB3',71,'1056688184','Pergi','KIARACONDONG-KAC','BANJAR-BJR','SERAYU-220','K','C',63000,'2018-09-01','2018-09-02','00:40:00','05:34:00',1,0,'12 Juli 2018 17:59:53','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=1056688184','http://api.fastravel.co.id/app/generate_struk?id_transaksi=1056688184'),('DAQQEC',42,'986999100','Pergi','BANDUNG-BD','BANJAR-BJR','MALABAR-92','K','P',170000,'2018-05-31','0000-00-00','15:45:00','19:36:00',1,0,'27 April 2018 11:04:39',NULL,NULL),('DEDCHK',45,'987025187','Pergi','BANJAR-BJR','BANDUNG-BD','MALABAR-91','K','P',170000,'2018-04-30','0000-00-00','04:03:00','07:48:00',1,0,'27 April 2018 11:35:31',NULL,NULL),('DS43R8',75,'1057513868','Pulang','LEMPUYANGAN-LPN','KIARACONDONG-KAC','KAHURIPAN-181','K','C',80000,'2018-08-20','2018-08-20','18:15:00','02:42:00',2,0,'13 Juli 2018 17:01:27','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=1057513868','http://api.fastravel.co.id/app/generate_struk?id_transaksi=1057513868'),('E7K6NH',54,'1038311348','Pergi','KIARACONDONG-KAC','BANJAR-BJR','SERAYU-216','K','C',67000,'2018-06-30','0000-00-00','13:10:00','17:08:00',1,0,'22 Juni 2018 17:58:51',NULL,NULL),('FDSRTB',77,'1086455706','Pergi','YOGYAKARTA-YK','BANDUNG-BD','MALABAR-91','E','A',350000,'2018-08-31','0000-00-00','23:30:00','07:48:00',1,0,'13 Agustus 2018 16:14:04','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=1086455706','http://api.fastravel.co.id/app/generate_struk?id_transaksi=1086455706'),('FUUR54',60,'1038371315','Pulang','BANJAR-BJR','KIARACONDONG-KAC','PASUNDAN-179','K','C',94000,'2018-06-27','2018-06-27','18:40:00','23:25:00',1,0,'22 Juni 2018 19:06:10',NULL,NULL),('GUUQ6F',57,'1038322674','Pergi','BANDUNG-BD','BANJAR-BJR','MALABAR-92','E','A',350000,'2018-06-30','0000-00-00','15:45:00','19:36:00',1,0,'22 Juni 2018 18:12:07',NULL,NULL),('H374U9',69,'1040726809','Pergi','KIARACONDONG-KAC','BANJAR-BJR','KAHURIPAN-182','K','C',84000,'2018-06-26','0000-00-00','18:10:00','21:56:00',1,0,'25 Juni 2018 17:10:42',NULL,NULL),('H6372Q',53,'1038308284','Pergi','KIARACONDONG-KAC','BANJAR-BJR','KAHURIPAN-182','K','C',80000,'2018-07-06','0000-00-00','18:10:00','21:56:00',1,0,'22 Juni 2018 17:55:45',NULL,NULL),('HXNPHM',43,'987020795','Pergi','BANDUNG-BD','GAMBIR-GMR','ARGO PARAHYANGAN-21','K','C',90000,'2018-05-05','0000-00-00','06:30:00','09:45:00',1,0,'27 April 2018 11:30:04',NULL,NULL),('JN1NGC',39,'986499767','Pulang','-','-','MALABAR-91','K','C',190000,'2018-05-18','2018-05-18','04:03:00','07:48:00',2,0,'26 April 2018 18:45:04',NULL,NULL),('JNVMKU',NULL,'986495162','Pulang','-','-','LODAYA-81','B','K',190000,'2018-06-01','2018-06-01','00:29:00','04:15:00',2,0,'26 April 2018 18:39:53',NULL,NULL),('LFDV6E',48,'987323255','Pergi','BANDUNG-BD','BANJAR-BJR','MALABAR-92','K','P',170000,'2018-04-30','2018-05-01','15:45:00','19:36:00',2,0,'27 April 2018 18:31:02',NULL,NULL),('N8CNYU',68,'1040677913','Pulang','BANJAR-BJR','KIARACONDONG-KAC','PASUNDAN-179','K','C',94000,'2018-06-27','2018-06-27','18:40:00','23:25:00',1,0,'25 Juni 2018 16:09:46',NULL,NULL),('N8UBZZ',56,'1038318529','Pergi','KIARACONDONG-KAC','BANJAR-BJR','SERAYU-216','K','C',67000,'2018-06-30','0000-00-00','13:10:00','17:08:00',1,0,'22 Juni 2018 18:07:16',NULL,NULL),('NJZRWB',72,'1056705373','Pulang','BANJAR-BJR','KIARACONDONG-KAC','KUTOJAYA SELATAN-203','K','C',58000,'2018-09-02','2018-09-02','13:05:00','16:41:00',1,0,'12 Juli 2018 18:20:20','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=1056705373','http://api.fastravel.co.id/app/generate_struk?id_transaksi=1056705373'),('Q3KEXR',76,'1086450706','Pergi','KIARACONDONG-KAC','BANJAR-BJR','KAHURIPAN-182','K','C',80000,'2018-08-21','0000-00-00','18:10:00','21:56:00',1,0,'13 Agustus 2018 16:08:00','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=1086450706','http://api.fastravel.co.id/app/generate_struk?id_transaksi=1086450706'),('QUQERW',71,'1056688194','Pulang','BANJAR-BJR','KIARACONDONG-KAC','KUTOJAYA SELATAN-203','K','C',58000,'2018-09-02','2018-09-02','13:05:00','16:41:00',1,0,'12 Juli 2018 17:59:54','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=1056688194','http://api.fastravel.co.id/app/generate_struk?id_transaksi=1056688194'),('R26MMM',44,'987022981','Pergi','BANDUNG-BD','SURABAYA-SBI','HARINA-74','B','B',340000,'2018-04-29','0000-00-00','21:25:00','09:37:00',1,0,'27 April 2018 11:32:58',NULL,NULL),('SXBHG2',68,'1040677903','Pergi','KIARACONDONG-KAC','BANJAR-BJR','KAHURIPAN-182','K','C',84000,'2018-06-26','2018-06-27','18:10:00','21:56:00',1,0,'25 Juni 2018 16:09:46',NULL,NULL),('V4ELAY',67,'1040661206','Pergi','KIARACONDONG-KAC','BANJAR-BJR','KAHURIPAN-182','K','C',84000,'2018-06-26','0000-00-00','18:10:00','21:56:00',1,0,'25 Juni 2018 15:50:23',NULL,NULL),('VNJHCW',NULL,'986495147','Pergi','BANDUNG-BD','BANJAR-BJR','MALABAR-92','K','C',190000,'2018-05-31','2018-06-01','15:45:00','19:36:00',2,0,'26 April 2018 18:39:52',NULL,NULL),('VSB4SM',72,'1056705358','Pergi','KIARACONDONG-KAC','BANJAR-BJR','SERAYU-220','K','C',63000,'2018-09-01','2018-09-02','00:40:00','05:34:00',1,0,'12 Juli 2018 18:20:19','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=1056705358','http://api.fastravel.co.id/app/generate_struk?id_transaksi=1056705358'),('W3Q29V',75,'1057513844','Pergi','KIARACONDONG-KAC','LEMPUYANGAN-LPN','KAHURIPAN-182','K','C',80000,'2018-08-17','2018-08-20','18:10:00','02:40:00',2,0,'13 Juli 2018 17:01:26','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=1057513844','http://api.fastravel.co.id/app/generate_struk?id_transaksi=1057513844'),('WK82LY',55,'1038315097','Pergi','BANDUNG-BD','BANJAR-BJR','MALABAR-92','E','A',350000,'2018-06-30','0000-00-00','15:45:00','19:36:00',1,0,'22 Juni 2018 18:03:14',NULL,NULL),('X9TCEX',47,'987027895','Pergi','BANDUNG-BD','BANJAR-BJR','LODAYA-80','B','B',215000,'2018-05-11','0000-00-00','07:20:00','11:03:00',1,0,'27 April 2018 11:38:42',NULL,NULL),('XCTX5H',78,'1127093200','Pergi','BANDUNG-BD','GAMBIR-GMR','ARGO PARAHYANGAN-19','E','A',140000,'2018-10-06','0000-00-00','05:00:00','08:15:00',1,0,'24 September 2018 18:46:54','http://api.fastravel.co.id/app/generate_etiket?id_transaksi=1127093200','http://api.fastravel.co.id/app/generate_struk?id_transaksi=1127093200'),('XM2TA7',50,'1038259513','Pergi','KIARACONDONG-KAC','BANJAR-BJR','KAHURIPAN-182','K','C',84000,'2018-06-29','0000-00-00','18:10:00','21:56:00',1,0,'22 Juni 2018 16:52:42',NULL,NULL),('Y3M3TY',49,'1038237650','Pergi','KIARACONDONG-KAC','BANJAR-BJR','KAHURIPAN-182','K','C',84000,'2018-06-26','0000-00-00','18:10:00','21:56:00',1,0,'22 Juni 2018 16:24:38',NULL,NULL),('YWXQGF',61,'1040425947','Pergi','KIARACONDONG-KAC','YOGYAKARTA-YK','LODAYA-82','B','B',215000,'2018-08-16','2018-08-19','19:07:00','02:57:00',3,0,'25 Juni 2018 11:40:21',NULL,NULL);

/*Table structure for table `trans_kereta_detail_harga` */

DROP TABLE IF EXISTS `trans_kereta_detail_harga`;

CREATE TABLE `trans_kereta_detail_harga` (
  `bookingCode` varchar(255) NOT NULL,
  `komisi` double DEFAULT NULL,
  `normalSales` double DEFAULT NULL,
  `extrafee` double DEFAULT NULL,
  `nominalAdmin` double DEFAULT NULL,
  `bookBalance` double DEFAULT NULL,
  `discount` double DEFAULT NULL,
  PRIMARY KEY (`bookingCode`),
  CONSTRAINT `trans_kereta_detail_harga_ibfk_1` FOREIGN KEY (`bookingCode`) REFERENCES `trans_kereta_detail` (`bookingCode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `trans_kereta_detail_harga` */

insert  into `trans_kereta_detail_harga`(`bookingCode`,`komisi`,`normalSales`,`extrafee`,`nominalAdmin`,`bookBalance`,`discount`) values ('1FQGEG',3500,80000,0,7500,80000,0),('482XRN',3500,320000,0,7500,312500,-7500),('4XJ9JG',3500,160000,0,7500,160000,0),('6J7PVM',3500,63000,0,7500,63000,0),('6VXKZU',3500,645000,0,7500,637500,-7500),('8FSBUQ',3500,58000,0,7500,58000,0),('9AR4A9',3500,84000,0,7500,84000,0),('BZWPB3',3500,63000,0,7500,63000,0),('DS43R8',3500,160000,0,7500,160000,0),('E7K6NH',3500,67000,0,7500,67000,0),('FDSRTB',3500,350000,0,7500,342500,-7500),('FUUR54',3500,94000,0,7500,94000,0),('GUUQ6F',3500,350000,0,7500,342500,-7500),('H374U9',3500,84000,0,7500,84000,0),('H6372Q',3500,80000,0,7500,80000,0),('N8CNYU',3500,94000,0,7500,94000,0),('N8UBZZ',3500,67000,0,7500,67000,0),('NJZRWB',3500,58000,0,7500,58000,0),('Q3KEXR',3500,80000,0,7500,80000,0),('QUQERW',3500,58000,0,7500,58000,0),('SXBHG2',3500,84000,0,7500,84000,0),('V4ELAY',3500,84000,0,7500,84000,0),('VSB4SM',3500,63000,0,7500,63000,0),('W3Q29V',3500,160000,0,7500,160000,0),('WK82LY',3500,350000,0,7500,342500,-7500),('XCTX5H',3500,140000,0,7500,132500,-7500),('XM2TA7',3500,84000,0,7500,84000,0),('Y3M3TY',3500,84000,0,7500,84000,0),('YWXQGF',3500,645000,0,7500,637500,-7500);

/*Table structure for table `trans_kereta_nameseat` */

DROP TABLE IF EXISTS `trans_kereta_nameseat`;

CREATE TABLE `trans_kereta_nameseat` (
  `bookingCode` varchar(255) DEFAULT NULL,
  `jenispenumpang` enum('D','B') DEFAULT NULL,
  `namapenumpang` varchar(255) DEFAULT NULL,
  `idpenumpang` varchar(255) DEFAULT NULL,
  `tgllahirpenumpang` date DEFAULT NULL,
  `notelppenumpang` varchar(15) DEFAULT NULL,
  `noseatpenumpang` varchar(50) DEFAULT NULL,
  KEY `bookingCode` (`bookingCode`),
  CONSTRAINT `trans_kereta_nameseat_ibfk_1` FOREIGN KEY (`bookingCode`) REFERENCES `trans_kereta_detail` (`bookingCode`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `trans_kereta_nameseat` */

insert  into `trans_kereta_nameseat`(`bookingCode`,`jenispenumpang`,`namapenumpang`,`idpenumpang`,`tgllahirpenumpang`,`notelppenumpang`,`noseatpenumpang`) values ('DAQQEC','D',NULL,'3279021511930005','1993-11-15','085323778786','EKONOMI-1, 24D'),('HXNPHM','D','Arie Lesmana Hidayat','327902151193005','1993-11-15','085323778786','EKO_AC-1, 20D'),('R26MMM','D','Arie','3279021511930005','1993-11-15','085323778786','BIS-1, 5C'),('DEDCHK','D','Arie Lesmana Hidayat','3279021511930005','1993-11-15','085323778786','EKONOMI-2, 2A'),('X9TCEX','D','Arie','3279021511930005','1993-11-15','085323778786','BIS-1, 2B'),('LFDV6E','D','Arie Lesmana Hidayat','3279021511930005','1993-11-15','085323778786','EKONOMI-2, 23D'),('LFDV6E','D','Fixgan','01012013','2013-01-01','0','EKONOMI-2, 23E'),('42KKZY','D','Arie Lesmana Hidayat','3279021511930005','1993-11-15','085323778786','EKONOMI-1, 11B'),('42KKZY','D','Fixgan','01012013','2013-01-01','0','EKONOMI-1, 11C'),('Y3M3TY','D','Arie Lesmana Hidayat','3279021511930005','1993-11-15','085323778786','EKONOMI-1, 9D'),('XM2TA7','D','Arie Lesmana Hidayat','3279021511930005','1993-11-15','08532377876','EKONOMI-1, 7B'),('482XRN','D','Arie Lesmana Hidayat','3279021511930005','1993-11-15','085323778786','EKS-1, 1C'),('1FQGEG','D','Arie Lesmana Hidayat','3279021511930005','1993-11-15','085323778786','EKONOMI-3, 15A'),('H6372Q','D','Arie Lesmana Hidayat','3279021511930005','1993-11-15','085323778786','EKONOMI-1, 11A'),('E7K6NH','D','Arie Lesmana Hidayat','3279021511930005','1993-11-15','085323778786','EKONOMI-1, 9E'),('WK82LY','D','Arie Lesmana Hidayat','3279021511930005','1993-11-15','085323778786','EKS-1, 1C'),('N8UBZZ','D','Arie Lesmana Hidayat','3279021511930005','1993-11-15','085323778786','EKONOMI-1, 9E'),('GUUQ6F','D','Arie Lesmana Hidayat','3279021511930005','1993-11-15','085323778786','EKS-1, 1C'),('9AR4A9','D','Arie Lesmana Hidayat','3279021511930005','1993-11-15','08532377876','EKONOMI-1, 9D'),('FUUR54','D','Arie Lesmana Hidayat','3279021511930005','1993-11-15','08532377876','EKONOMI-2, 22D'),('YWXQGF','D','Arie Lesmana Hidayat','3279021511930005','1993-11-15','085323778786','BIS-3, 1A'),('YWXQGF','D','Zharif Hidayat','01012010','2010-01-01','0','BIS-3, 1B'),('YWXQGF','D','Tito Nur Astopria','12122012','2012-12-12','0','BIS-3, 2A'),('6VXKZU','D','Arie Lesmana Hidayat','3279021511930005','1993-11-15','085323778786','BIS-1, 12A'),('6VXKZU','D','Zharif Hidayat','01012010','2010-01-01','0','BIS-1, 12B'),('6VXKZU','D','Tito Nur Astopria','12122012','2012-12-12','0','BIS-1, 12C'),('V4ELAY','D','Arie Lesmana Hidayat','3279021511930005','1993-11-15','085323778786','EKONOMI-1, 9D'),('SXBHG2','D','Arie Lesmana Hidayat','3279021511930005','1993-11-15','085323778786','EKONOMI-1, 9D'),('N8CNYU','D','Arie Lesmana Hidayat','3279021511930005','1993-11-15','085323778786','EKONOMI-3, 3A'),('H374U9','D','Arie Lesmana Hidayat','3279021511930005','1993-11-15','085323778786','EKONOMI-1, 9E'),('8FSBUQ','D','Test','1234567890','1993-11-15','081234567890','EKONOMI-1, 8C'),('BZWPB3','D','Tuan Pulang Pergi','10293847566','1990-09-19','081234567890','EKONOMI-1, 2B'),('QUQERW','D','Tuan Pulang Pergi','10293847566','1990-09-19','081234567890','EKONOMI-1, 1A'),('VSB4SM','D','Test','0192837456','1993-11-15','08123456789','EKONOMI-1, 3A'),('NJZRWB','D','Test','0192837456','1993-11-15','08123456789','EKONOMI-1, 1B'),('6J7PVM','D','test','012728372837','1993-11-15','08123456789','EKONOMI-1, 4B'),('4XJ9JG','D','Arie','3279021511930005','1993-11-15','085323778786','EKONOMI-2, 18C'),('4XJ9JG','D','Fixgan','01012013','2013-01-01','0','EKONOMI-2, 19D'),('W3Q29V','D','Arie','3279021511930005','1993-11-15','085323778786','EKONOMI-3, 1B'),('W3Q29V','D','Fixgan','01012013','2013-01-01','0','EKONOMI-3, 10C'),('DS43R8','D','Arie','3279021511930005','1993-11-15','085323778786','EKONOMI-1, 11B'),('DS43R8','D','Fixgan','01012013','2013-01-01','0','EKONOMI-1, 11C'),('Q3KEXR','D','test','3278273827382','1990-11-01','0898324837483','EKONOMI-5, 19B'),('FDSRTB','D','test','3267437248','1993-11-15','08763473476','EKS-1, 4A'),('XCTX5H','D','Test ','32790212345678','1993-11-15','08123456777877','EKS-1, 2D');

/*Table structure for table `trans_saldo` */

DROP TABLE IF EXISTS `trans_saldo`;

CREATE TABLE `trans_saldo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `metode` varchar(255) DEFAULT NULL,
  `nominal` double DEFAULT NULL,
  `harga` double DEFAULT NULL,
  `namapengirim` varchar(255) DEFAULT NULL,
  `nama_bank_rek_tujuan` varchar(255) DEFAULT NULL,
  `no_rek_tujuan` varchar(255) DEFAULT NULL,
  `an_rek_tujuan` varchar(255) DEFAULT NULL,
  `img` text,
  `status` int(2) DEFAULT NULL,
  `timelimit` datetime DEFAULT NULL,
  `lembaga_id` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `trans_saldo` */

insert  into `trans_saldo`(`id`,`id_user`,`datetime`,`metode`,`nominal`,`harga`,`namapengirim`,`nama_bank_rek_tujuan`,`no_rek_tujuan`,`an_rek_tujuan`,`img`,`status`,`timelimit`,`lembaga_id`) values (21,3,'2018-05-23 09:36:43','transferbankb',1000000,1000199,'Agen01','Bank B','B-11111111-11','Head Bank B','D:/xampp/htdocs/klikmbc/uploads/email_2.jpg',2,'2018-05-23 10:36:43',1),(22,4,'2018-05-23 09:38:06','transferbankb',500000,500914,'agen02','Bank B','B-11111111-11','Head Bank B','D:/xampp/htdocs/klikmbc/uploads/full_height.jpg',2,'2018-05-23 10:38:06',1),(23,3,'2018-05-25 08:57:09','transferbanka',10000000,10000574,'Agen01','Bank A','A-11111111-11','Head Bank A','D:/xampp/htdocs/klikmbc/uploads/off_canvas.jpg',2,'2018-05-25 09:57:09',1),(24,3,'2018-08-03 11:07:33','transferbanka',1000000,1000642,'Agen01','Bank A','A-11111111-11','Head Bank A',NULL,4,'2018-08-03 12:07:33',1);

/*Table structure for table `transaksi` */

DROP TABLE IF EXISTS `transaksi`;

CREATE TABLE `transaksi` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `lembaga_id` int(2) DEFAULT NULL,
  `trans_code` varchar(50) DEFAULT NULL,
  `trans_detail_code` int(11) DEFAULT NULL,
  `date_created` datetime DEFAULT NULL,
  `user_created` varchar(255) DEFAULT NULL,
  `sn` varchar(255) DEFAULT NULL,
  `ref` varchar(255) DEFAULT NULL,
  `status` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trans_detail_code` (`trans_detail_code`),
  CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`trans_detail_code`) REFERENCES `transaksi_detail` (`idtrans`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;

/*Data for the table `transaksi` */

insert  into `transaksi`(`id`,`lembaga_id`,`trans_code`,`trans_detail_code`,`date_created`,`user_created`,`sn`,`ref`,`status`) values (5,1,'HS10',6,'2018-05-22 10:46:09','3',NULL,NULL,1),(6,1,'HS10',7,'2018-05-22 14:19:07','3','','1805230000023',1),(7,1,'HI50',8,'2018-05-22 14:21:11','3','','1805230000024',1),(8,1,'HX25',9,'2018-05-23 14:43:51','3','','1805230000038',1),(9,1,'HIDSD',10,'2018-05-23 16:33:10','3','','1805230000057',1),(10,1,'HXLHR30',11,'2018-05-23 16:35:29','3','','1805230000058',1),(11,1,'HT50',12,'2018-05-24 09:03:06','3','','1805240000003',1),(13,1,'HPTSEL',14,'2018-05-24 11:07:27','3',NULL,'1800000000436',1),(14,1,'HPTSEL',15,'2018-05-24 11:17:22','3','','1805240000007',1),(15,1,'HPTSEL',16,'2018-05-24 11:34:58','3','','1805240000007',1),(16,1,'PLNPRAH',17,'2018-05-24 14:50:00','3','10112121323131','1805240000007',1),(17,1,'PLNPASCH',18,'2018-05-24 16:17:13','3','','1805240000007',1),(18,1,'WABDG',19,'2018-05-24 16:22:41','3','','1805240000007',1),(19,1,'GS30H',20,'2018-05-25 10:43:25','3','','1805240000007',1),(20,1,'PLNPRAH',21,'2018-05-25 10:44:32','3','10112121323131','1805240000007',1),(21,1,'PLNPRAH',22,'2018-05-25 11:05:12','3','10112121323131','1805240000007',1),(22,1,'PLNPRAH',23,'2018-05-26 11:06:05','3','10112121323131','1805240000007',1),(23,1,'PLNPRAH',24,'2018-05-26 11:07:03','3','10112121323131','1805240000007',1),(24,1,'PLNPRAH',25,'2018-05-26 11:08:35','3','10112121323131','1805240000007',1),(25,1,'GEP2000H',26,'2018-05-26 11:31:54','3','10001010101','1805240000007',1),(26,1,'SPEEDY',27,'2018-05-27 11:34:49','3','','1805240000007',1),(27,1,'TVNEX',28,'2018-05-27 13:08:19','3','','1805240000007',1),(28,1,'FNADIRAH',29,'2018-05-27 13:13:14','3','','1805240000007',1),(29,1,'ASRBPJKS',30,'2018-05-27 13:42:46','3','','1805240000007',1),(34,1,'WKAI',31,'2018-06-25 13:51:19','3',NULL,'1040661206',1),(35,1,'WKAI',32,'2018-06-25 14:11:29','3',NULL,'1040677903<br/>1040677913',1),(36,1,'WKAI',33,'2018-06-25 15:11:20','3',NULL,'1040726809',1),(37,1,'HOTEL',34,'2018-07-11 12:11:44','3',NULL,'1055844360',1),(38,1,'WKAI',35,'2018-07-12 15:54:09','3',NULL,'1056683045',1),(39,1,'WKAI',36,'2018-07-12 16:00:44','3',NULL,'1056688184<br/>1056688194',1),(40,1,'WKAI',37,'2018-07-12 16:38:52','3',NULL,'1056705358<br/>1056705373',1),(41,1,'WKAI',38,'2018-07-13 14:54:21','3',NULL,'1057504221',1),(42,1,'WKAI',39,'2018-07-13 14:59:10','3',NULL,'1057511751',1),(43,1,'WKAI',40,'2018-07-13 15:02:12','3',NULL,'1057513844<br/>1057513868',1),(44,1,'HOTEL',41,'2018-07-13 11:06:20','3',NULL,'1057563360',1),(45,1,'HOTEL',42,'2018-07-13 11:19:55','3',NULL,'1057574752',1),(46,1,'HOTEL',43,'2018-07-13 11:29:37','3',NULL,'1057583121',1),(47,1,'WKAI',44,'2018-08-13 14:08:37','3',NULL,'1086450706',1),(48,1,'WKAI',45,'2018-08-13 14:15:40','3',NULL,'1086455706',1),(49,1,'HOTEL',46,'2018-08-13 10:09:45','3',NULL,'1086497875',1),(50,1,'HOTEL',47,'2018-08-13 10:12:29','3',NULL,'1086503362',1),(51,1,'HOTEL',48,'2018-08-13 10:14:47','3',NULL,'1086505149',1),(52,1,'WKAI',49,'2018-09-24 16:47:28','1',NULL,'1127093200',1),(53,1,'PLNPASCH',50,'2018-10-15 10:00:14','1','','1805240000007',1),(54,1,'FLIGHT',51,'2018-11-14 08:14:07','1',NULL,'111141120181',1);

/*Table structure for table `transaksi_detail` */

DROP TABLE IF EXISTS `transaksi_detail`;

CREATE TABLE `transaksi_detail` (
  `idtrans` int(11) NOT NULL AUTO_INCREMENT,
  `namaproduk` varchar(255) DEFAULT NULL,
  `nopelanggan` varchar(255) DEFAULT NULL,
  `namapelanggan` varchar(255) DEFAULT NULL,
  `nominal` double DEFAULT NULL,
  PRIMARY KEY (`idtrans`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=latin1;

/*Data for the table `transaksi_detail` */

insert  into `transaksi_detail`(`idtrans`,`namaproduk`,`nopelanggan`,`namapelanggan`,`nominal`) values (6,'TELKOMSEL 10 H2H','085323778786',NULL,10500),(7,'TELKOMSEL 10 H2H','081234567890',NULL,10350),(8,'INDOSAT 50 H2H','0871234567890',NULL,49200),(9,'XL 25 H2H','0871234567890',NULL,25050),(10,'H2H - Indosat Data Super Internet Bulanan 3.5GB','087234567890',NULL,50000),(11,'H2H - XL Data HotRod 800MB','081234567890',NULL,29350),(12,'THREE 50 H2H','0891234567890',NULL,49250),(14,NULL,'08112238737',NULL,125000),(15,'Tagihan HALO - Telkomsel Pascabayar','08112238737','Arie',75000),(16,'Tagihan HALO - Telkomsel Pascabayar','08112238737','Arie',110000),(17,'TOKEN PLN50','01010101010101','Arie',53000),(18,'PLN Pasca Bayar','135792468','Arie',110000),(19,'PDAM KOTA BANDUNG (JABAR)','1029384756','Arie',29000),(20,'GEMSCOOL 30.000','085323778786','Arie',29000),(21,'TOKEN PLN50','010001000010001001','Arie',53000),(22,'TOKEN PLN20','10110110110110','Arie',53000),(23,'TOKEN PLN20','90109010910','Arie',53000),(24,'TOKEN PLN20','890989098','Arie',53000),(25,'TOKEN PLN20','01230123','Arie',53000),(26,'EP Points 2000','085323778786','',125000),(27,'TELKOM Indihome','131169142654','Arie',29000),(28,'NEX MEDIA ','01234512345','Arie',29000),(29,'ADIRA H2H','0987654321','Arie',29000),(30,'BPJS Kesehatan ','10234567890987654321','Arie',29000),(31,'TIKET KAI','V4ELAY','Arie',91500),(32,'TIKET KAI','SXBHG2<br/>N8CNYU','Arie',185500),(33,'TIKET KAI','H374U9','Arie',91500),(34,'HOTEL','49794475','TEST API',270000),(35,'TIKET KAI','8FSBUQ','Test',65500),(36,'TIKET KAI','BZWPB3<br/>QUQERW','Tuan Pulang Pergi',128500),(37,'TIKET KAI','VSB4SM<br/>NJZRWB','Test',136000),(38,'TIKET KAI','6J7PVM','TEST',70500),(39,'TIKET KAI','4XJ9JG','Tes',167500),(40,'TIKET KAI','W3Q29V<br/>DS43R8','TEST',335000),(41,'HOTEL','49923118','TEST API',341000),(42,'HOTEL','49923963','TEST API',160000),(43,'HOTEL','49924590','TUAN  TES API',150000),(44,'TIKET KAI','Q3KEXR','test',87500),(45,'TIKET KAI','FDSRTB','tes',350000),(46,'HOTEL','51667130','test test',347059),(47,'HOTEL','51667625','test tetstst',360000),(48,'HOTEL','51667772','uhfis dfhidfhiud',494118),(49,'TIKET KAI','XCTX5H','Test',140000),(50,'PLN Pasca Bayar','532210247271','Arie',29000),(51,'TIKET PESAWAT','<br/>SQMMJD<br/>SR6FH6<br/>SQNVSO',NULL,6808500);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `nama` varchar(100) DEFAULT NULL,
  `user_level` int(11) DEFAULT NULL,
  `klasifikasi` varchar(2) DEFAULT NULL,
  `user_status` int(11) DEFAULT NULL,
  `lembaga_id` int(2) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `kota` varchar(100) DEFAULT NULL,
  `provinsi` varchar(100) DEFAULT NULL,
  `kodepos` varchar(10) DEFAULT NULL,
  `negara` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `telepon` varchar(100) DEFAULT NULL,
  `saldo` double DEFAULT '0',
  `status_login` int(2) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id`,`username`,`password`,`nama`,`user_level`,`klasifikasi`,`user_status`,`lembaga_id`,`alamat`,`kota`,`provinsi`,`kodepos`,`negara`,`email`,`telepon`,`saldo`,`status_login`) values (1,'admin','21232f297a57a5a743894a0e4a801fc3','Administrasi',0,NULL,1,1,'Jl Dipatiukur No.1','Bandung','Jawa Barat','40134','Indonesia','admin@gmail.com','085323778786',0,0),(2,'arie','db76becac4ca1a766a3d61a35ac47149','Arie Lesmana Hidayat',1,'G',1,1,'Bandung',NULL,NULL,NULL,NULL,'arie@gmail.com','085323778786',0,0),(3,'agen01','b0583fede16f57a4fe14fc2ec9ce0900','Agen01',1,'G',1,1,'Bandung',NULL,NULL,NULL,NULL,'agen1@gmail.com','085323778786',5763323,0),(4,'agen02','940a7501ace3f5175e5fab2709477b95','agen02',1,'A',1,1,'Bandung',NULL,NULL,NULL,NULL,'agen02@gmail.com','085323778786',500000,0),(5,'arie','4900D0A19B6894A4A514E9FF3AFCC2C0','Arie',1,'G',1,2,'Bandung AJA',NULL,NULL,NULL,NULL,'ariel@gmail.com','085323778786',0,0),(7,'agen04','9bfdf6bb1b9468e494ca1112520a3c16','agen04',1,'G',1,2,'Bandung',NULL,NULL,NULL,NULL,'agen04@gmail.com','085323778786',0,0);

/* Procedure structure for procedure `dummy_data_transaksi` */

/*!50003 DROP PROCEDURE IF EXISTS  `dummy_data_transaksi` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `dummy_data_transaksi`()
BEGIN
    DECLARE i INT DEFAULT 100;
    WHILE i < 2000 DO
	INSERT INTO transaksi_detail VALUES (i,'namaproduk','','',100000);
	INSERT INTO transaksi VALUES (i,1,'transcode',i,'','3','','','1');
	SET i = i + 1;
    END WHILE;
    END */$$
DELIMITER ;

/* Procedure structure for procedure `dummy_data_user` */

/*!50003 DROP PROCEDURE IF EXISTS  `dummy_data_user` */;

DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` PROCEDURE `dummy_data_user`()
BEGIN
    
    DECLARE i INT DEFAULT 100;
	  WHILE i < 1000 DO
	    INSERT INTO user VALUES (i,i,i,'','','','','','','','');
	    SET i = i + 1;
	  END WHILE;
    END */$$
DELIMITER ;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
