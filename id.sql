/*
Navicat MySQL Data Transfer

Source Server         : www.go.win
Source Server Version : 50505
Source Host           : www.go.win:3306
Source Database       : id

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-04-28 21:37:47
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for shop_cate
-- ----------------------------
DROP TABLE IF EXISTS `shop_cate`;
CREATE TABLE `shop_cate` (
  `id_cate` int(10) NOT NULL AUTO_INCREMENT,
  `cate_name` varchar(50) NOT NULL,
  `cate_pid` int(10) NOT NULL,
  `cate_level` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_cate`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_cate
-- ----------------------------
INSERT INTO `shop_cate` VALUES ('1', '家用电器', '0', '1');
INSERT INTO `shop_cate` VALUES ('2', '电视', '1', '2');
INSERT INTO `shop_cate` VALUES ('3', '冰箱', '1', '2');
INSERT INTO `shop_cate` VALUES ('4', '洗衣机', '1', '2');
INSERT INTO `shop_cate` VALUES ('5', '手机', '0', '1');
INSERT INTO `shop_cate` VALUES ('6', '电脑', '0', '1');
INSERT INTO `shop_cate` VALUES ('7', '手机通信', '5', '2');
INSERT INTO `shop_cate` VALUES ('8', '空调', '1', '2');
INSERT INTO `shop_cate` VALUES ('9', '合资品牌', '2', '3');
INSERT INTO `shop_cate` VALUES ('10', '手机', '7', '3');
