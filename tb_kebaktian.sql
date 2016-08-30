/*
Navicat MySQL Data Transfer

Source Server         : bungur
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : db_gki_bungur

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2015-06-17 21:50:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tb_kebaktian
-- ----------------------------
DROP TABLE IF EXISTS `tb_kebaktian`;
CREATE TABLE `tb_kebaktian` (
  `keb_id` int(11) NOT NULL AUTO_INCREMENT,
  `keb_m_ib_id` int(11) DEFAULT NULL,
  `keb_tgl` date DEFAULT NULL,
  `keb_tema` varchar(255) DEFAULT NULL,
  `keb_pengkotbah` varchar(50) DEFAULT NULL,
  `keb_liturgos` varchar(50) DEFAULT NULL,
  `keb_majelis` varchar(255) DEFAULT NULL,
  `keb_pianis` varchar(50) DEFAULT NULL,
  `keb_organis` varchar(50) DEFAULT NULL,
  `keb_tim_musik` varchar(255) DEFAULT NULL,
  `keb_pmdu_nyanyian` varchar(255) DEFAULT NULL,
  `keb_nanyian` varchar(255) DEFAULT NULL,
  `keb_ayat` varchar(255) DEFAULT NULL,
  `keb_persembahan` varchar(50) DEFAULT NULL,
  `keb_mulmed_lcd` varchar(50) DEFAULT NULL,
  `keb_penyambut` varchar(50) DEFAULT NULL,
  `keb_kolektan` varchar(50) DEFAULT NULL,
  `keb_ket` varchar(255) DEFAULT NULL,
  `keb_aktif` smallint(255) DEFAULT NULL,
  PRIMARY KEY (`keb_id`),
  KEY `keb_m_ib_id` (`keb_m_ib_id`),
  CONSTRAINT `tb_kebaktian_ibfk_1` FOREIGN KEY (`keb_m_ib_id`) REFERENCES `tb_m_ibadah` (`m_ib_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
