/*
Navicat MySQL Data Transfer

Source Server         : bungur
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : db_gki_bungur

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2015-06-17 18:25:07
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tb_m_wil
-- ----------------------------
DROP TABLE IF EXISTS `tb_m_wil`;
CREATE TABLE `tb_m_wil` (
  `m_wil_id` int(5) NOT NULL AUTO_INCREMENT,
  `m_wil_name` varchar(255) NOT NULL,
  `m_wil_koord_name` varchar(255) NOT NULL,
  `m_wil_koord_jmt_id` int(11) DEFAULT NULL,
  `m_wil_phone` varchar(20) DEFAULT NULL,
  `m_wil_area` text,
  PRIMARY KEY (`m_wil_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
