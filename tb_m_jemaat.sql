/*
Navicat MySQL Data Transfer

Source Server         : bungur
Source Server Version : 50516
Source Host           : localhost:3306
Source Database       : db_gki_bungur

Target Server Type    : MYSQL
Target Server Version : 50516
File Encoding         : 65001

Date: 2015-06-17 13:49:10
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for tb_m_jemaat
-- ----------------------------
DROP TABLE IF EXISTS `tb_m_jemaat`;
CREATE TABLE `tb_m_jemaat` (
  `m_jmt_id` int(11) NOT NULL AUTO_INCREMENT,
  `m_jmt_no_induk` varchar(20) NOT NULL,
  `m_jmt_nama` varchar(255) DEFAULT NULL,
  `m_jmt_jenkel` varchar(10) DEFAULT NULL,
  `m_jmt_tgl_lhr` date DEFAULT NULL,
  `m_jmt_tmpt_lhr` varchar(50) DEFAULT NULL,
  `m_jmt_status_kawin` varchar(20) DEFAULT NULL,
  `m_jmt_tgl_menikah` date DEFAULT NULL,
  `m_jmt_wil_id` int(5) DEFAULT NULL,
  `m_jmt_alamat_1` varchar(255) DEFAULT NULL,
  `m_jmt_prov_id_1` char(11) DEFAULT NULL,
  `m_jmt_kab_id_1` char(11) DEFAULT NULL,
  `m_jmt_kec_id_1` char(11) DEFAULT NULL,
  `m_jmt_telp_1` varchar(50) DEFAULT NULL,
  `m_jmt_alamat_2` varchar(255) DEFAULT NULL,
  `m_jmt_prov_id_2` char(11) DEFAULT NULL,
  `m_jmt_kab_id_2` char(11) DEFAULT NULL,
  `m_jmt_kec_id_2` char(11) DEFAULT NULL,
  `m_jmt_telp_2` varchar(50) DEFAULT NULL,
  `m_jmt_baptis` enum('Ya','Belum','Unknown') DEFAULT 'Ya',
  `m_jmt_anggota` enum('Ya','Tidak','Unknown') NOT NULL,
  `m_jmt_grj_baptis` varchar(255) DEFAULT NULL,
  `m_jmt_tgl_baptis` date DEFAULT NULL,
  `m_jmt_sidi` enum('Ya','Belum','Unknown') DEFAULT NULL,
  `m_jmt_grj_sidi` varchar(255) DEFAULT NULL,
  `m_jmt_tgl_sidi` date DEFAULT NULL,
  `m_jmt_tgl_masuk` date DEFAULT NULL,
  `m_jmt_grj_asal` varchar(255) DEFAULT NULL,
  `m_jmt_aktif` enum('Ya','Tidak','Unknown') DEFAULT 'Ya',
  `m_jmt_ket` varchar(255) DEFAULT NULL,
  `m_jmt_parent_child_id` int(11) DEFAULT NULL,
  `m_jmt_parent_child_hub` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`m_jmt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
