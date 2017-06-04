/*
Navicat MySQL Data Transfer

Source Server         : native
Source Server Version : 50505
Source Host           : www.go.win:3306
Source Database       : id

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2017-06-04 22:33:30
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
  `cate_sort` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_cate`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_cate
-- ----------------------------
INSERT INTO `shop_cate` VALUES ('1', '家用电器', '0', '3');
INSERT INTO `shop_cate` VALUES ('2', '手机/运营商/数码', '0', '6');
INSERT INTO `shop_cate` VALUES ('3', '电脑/办公', '0', '5');
INSERT INTO `shop_cate` VALUES ('4', '家居/家居/家装/厨具', '0', '2');
INSERT INTO `shop_cate` VALUES ('5', '衣服', '0', '4');
INSERT INTO `shop_cate` VALUES ('6', '美妆个户/宠物', '0', '7');
INSERT INTO `shop_cate` VALUES ('7', '汽车/汽车用品', '0', '8');
INSERT INTO `shop_cate` VALUES ('8', '母婴/玩具乐器', '0', '1');
INSERT INTO `shop_cate` VALUES ('9', '电视', '1', '0');
INSERT INTO `shop_cate` VALUES ('10', '空调', '1', '0');
INSERT INTO `shop_cate` VALUES ('11', '洗衣机', '1', '0');
INSERT INTO `shop_cate` VALUES ('12', '冰箱', '1', '0');
INSERT INTO `shop_cate` VALUES ('13', '厨卫大电', '1', '0');
INSERT INTO `shop_cate` VALUES ('14', '厨卫小电', '1', '0');
INSERT INTO `shop_cate` VALUES ('15', '合资品牌', '9', '0');
INSERT INTO `shop_cate` VALUES ('16', '互联网品牌', '9', '0');
INSERT INTO `shop_cate` VALUES ('17', '国产品牌', '9', '0');
INSERT INTO `shop_cate` VALUES ('18', '柜式空调', '10', '0');
INSERT INTO `shop_cate` VALUES ('19', '中央空调', '10', '0');
INSERT INTO `shop_cate` VALUES ('20', '滚筒洗衣机', '11', '0');
INSERT INTO `shop_cate` VALUES ('21', '多门', '12', '0');
INSERT INTO `shop_cate` VALUES ('22', '对门', '12', '0');
INSERT INTO `shop_cate` VALUES ('23', '三门', '12', '0');
INSERT INTO `shop_cate` VALUES ('24', '油烟机', '13', '0');
INSERT INTO `shop_cate` VALUES ('25', '燃气灶', '13', '0');
INSERT INTO `shop_cate` VALUES ('26', '电饭煲', '14', '0');
INSERT INTO `shop_cate` VALUES ('27', '微波炉', '14', '0');
INSERT INTO `shop_cate` VALUES ('28', '榨汁机', '14', '0');
INSERT INTO `shop_cate` VALUES ('29', '电脑整机', '3', '0');
INSERT INTO `shop_cate` VALUES ('30', '电脑配件', '3', '0');
INSERT INTO `shop_cate` VALUES ('31', '笔记本', '29', '0');
INSERT INTO `shop_cate` VALUES ('32', '游戏本', '29', '0');
INSERT INTO `shop_cate` VALUES ('33', '平板电脑', '29', '0');
INSERT INTO `shop_cate` VALUES ('34', '显卡', '30', '0');
INSERT INTO `shop_cate` VALUES ('35', 'cpu', '30', '0');
INSERT INTO `shop_cate` VALUES ('36', '网卡', '30', '0');
INSERT INTO `shop_cate` VALUES ('37', '显示器', '30', '0');
INSERT INTO `shop_cate` VALUES ('38', '家纺', '4', '0');
INSERT INTO `shop_cate` VALUES ('39', '家居', '4', '0');
INSERT INTO `shop_cate` VALUES ('40', '灯具', '4', '0');
INSERT INTO `shop_cate` VALUES ('41', '生活用品', '4', '0');
INSERT INTO `shop_cate` VALUES ('42', '女装', '5', '0');
INSERT INTO `shop_cate` VALUES ('43', '男装', '5', '0');
INSERT INTO `shop_cate` VALUES ('44', '内衣', '5', '0');
INSERT INTO `shop_cate` VALUES ('45', '配件', '5', '0');
INSERT INTO `shop_cate` VALUES ('46', '洗发护发', '6', '0');
INSERT INTO `shop_cate` VALUES ('47', '身体护理', '6', '0');
INSERT INTO `shop_cate` VALUES ('48', '口腔护理', '6', '0');
INSERT INTO `shop_cate` VALUES ('49', '女性护理', '6', '0');
INSERT INTO `shop_cate` VALUES ('50', '汽车车型', '7', '0');
INSERT INTO `shop_cate` VALUES ('51', '汽车保养', '7', '0');
INSERT INTO `shop_cate` VALUES ('52', '汽车电器', '7', '0');
INSERT INTO `shop_cate` VALUES ('53', '奶粉', '8', '0');
INSERT INTO `shop_cate` VALUES ('54', '童车童床', '8', '0');
INSERT INTO `shop_cate` VALUES ('55', '手机通讯', '2', '0');
INSERT INTO `shop_cate` VALUES ('56', '运营商', '2', '0');
INSERT INTO `shop_cate` VALUES ('57', '手机配件', '2', '0');
INSERT INTO `shop_cate` VALUES ('58', '摄影摄像', '2', '0');
INSERT INTO `shop_cate` VALUES ('59', '数码配件', '2', '0');
INSERT INTO `shop_cate` VALUES ('60', '手机', '55', '0');
INSERT INTO `shop_cate` VALUES ('61', '对讲机', '55', '0');
INSERT INTO `shop_cate` VALUES ('62', '手机维修', '55', '0');
INSERT INTO `shop_cate` VALUES ('63', '合约机', '56', '0');
INSERT INTO `shop_cate` VALUES ('64', '固话宽带', '56', '0');
INSERT INTO `shop_cate` VALUES ('65', '选号码', '56', '0');
INSERT INTO `shop_cate` VALUES ('66', '食品', '0', '0');
INSERT INTO `shop_cate` VALUES ('67', '休闲食品', '66', '0');
INSERT INTO `shop_cate` VALUES ('68', '坚果', '67', '0');

-- ----------------------------
-- Table structure for shop_goods
-- ----------------------------
DROP TABLE IF EXISTS `shop_goods`;
CREATE TABLE `shop_goods` (
  `goods_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `goods_name` varchar(255) NOT NULL DEFAULT '',
  `goods_thumb` varchar(255) NOT NULL DEFAULT '',
  `goods_price` float(20,2) unsigned NOT NULL DEFAULT '0.00',
  `goods_status` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `goods_sales` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_inventory` int(10) unsigned NOT NULL DEFAULT '0',
  `goods_pid` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`goods_id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_goods
-- ----------------------------
INSERT INTO `shop_goods` VALUES ('7', '【良品铺子旗舰店】手剥松子218g 坚果炒货零食新货巴西松子包邮', '\\shoptp\\public\\upload\\20170511\\38b8fdd30e838f266c31d14ea0655b0c.jpg', '13.00', '1', '232', '4552', '68');
INSERT INTO `shop_goods` VALUES ('10', 'Apple iPhone 7 Plus (A1661) 128G 亮黑色 移动联通电信4G手机', '\\shoptp\\public\\upload\\20170511\\7ba63f410c45d16a88392bd7c8268355.jpg', '5699.98', '1', '123', '12000', '60');
INSERT INTO `shop_goods` VALUES ('11', 'Apple MacBook Pro 15.4英寸笔记本电脑 银色(Core i7 处理器/16GB内存/256GB SSD闪存/Retina屏 MJLQ2CH/A)', '\\shoptp\\public\\upload\\20170512\\3367e7f69764c47750a55671764d19ed.jpg', '13088.00', '1', '12', '125', '31');
INSERT INTO `shop_goods` VALUES ('12', '小米(MI)Air 13.3英寸全金属超轻薄笔记本电脑(i5-6200U 8G 256G PCIE固态硬盘 940MX独显 FHD WIN10)银', '\\shoptp\\public\\upload\\20170512\\56eefc8d7c44e722d39af0c3188351be.jpg', '4999.00', '1', '245', '1298', '31');
INSERT INTO `shop_goods` VALUES ('21', '华硕（ASUS）ROG STRIX-GTX1080TI-O11G-GAMING 1569-1708MHz 11G/11100MHz GDDR5X PCI-E3.0显卡', '\\shoptp\\public\\upload\\20170512\\d0d61fdd871ce84db03b8a6272258c67.jpg', '6399.00', '1', '123', '257', '34');
INSERT INTO `shop_goods` VALUES ('22', '夏普（SHARP）LCD-70SU665A 70英寸 日本原装液晶面板 4K超高清 智能液晶电视', '\\shoptp\\public\\upload\\20170512\\a67ae13a88eda6122f0b9733c1497da2.jpg', '9499.00', '1', '1234', '4567', '15');

-- ----------------------------
-- Table structure for shop_goods_keywords
-- ----------------------------
DROP TABLE IF EXISTS `shop_goods_keywords`;
CREATE TABLE `shop_goods_keywords` (
  `goods_id` int(11) NOT NULL,
  `keywords_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_goods_keywords
-- ----------------------------
INSERT INTO `shop_goods_keywords` VALUES ('10', '1');
INSERT INTO `shop_goods_keywords` VALUES ('10', '8');
INSERT INTO `shop_goods_keywords` VALUES ('10', '4');
INSERT INTO `shop_goods_keywords` VALUES ('7', '9');
INSERT INTO `shop_goods_keywords` VALUES ('7', '10');
INSERT INTO `shop_goods_keywords` VALUES ('7', '11');
INSERT INTO `shop_goods_keywords` VALUES ('11', '12');
INSERT INTO `shop_goods_keywords` VALUES ('11', '13');
INSERT INTO `shop_goods_keywords` VALUES ('11', '14');
INSERT INTO `shop_goods_keywords` VALUES ('12', '15');
INSERT INTO `shop_goods_keywords` VALUES ('12', '16');
INSERT INTO `shop_goods_keywords` VALUES ('12', '17');
INSERT INTO `shop_goods_keywords` VALUES ('21', '18');
INSERT INTO `shop_goods_keywords` VALUES ('21', '19');
INSERT INTO `shop_goods_keywords` VALUES ('21', '20');
INSERT INTO `shop_goods_keywords` VALUES ('22', '21');
INSERT INTO `shop_goods_keywords` VALUES ('22', '22');
INSERT INTO `shop_goods_keywords` VALUES ('22', '23');

-- ----------------------------
-- Table structure for shop_keywords
-- ----------------------------
DROP TABLE IF EXISTS `shop_keywords`;
CREATE TABLE `shop_keywords` (
  `keywords_name` varchar(90) NOT NULL,
  `keywords_id` int(11) NOT NULL,
  PRIMARY KEY (`keywords_id`),
  UNIQUE KEY ` keywords_name` (`keywords_name`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of shop_keywords
-- ----------------------------
INSERT INTO `shop_keywords` VALUES ('11100MHz GDDR5X PCI-E3.0显卡', '19');
INSERT INTO `shop_keywords` VALUES ('11G/11100MHz', '20');
INSERT INTO `shop_keywords` VALUES ('128g', '3');
INSERT INTO `shop_keywords` VALUES ('15.4英寸', '12');
INSERT INTO `shop_keywords` VALUES ('32g', '5');
INSERT INTO `shop_keywords` VALUES ('4K超高清', '22');
INSERT INTO `shop_keywords` VALUES ('64g', '4');
INSERT INTO `shop_keywords` VALUES ('70英寸', '21');
INSERT INTO `shop_keywords` VALUES ('Core i5处理器', '17');
INSERT INTO `shop_keywords` VALUES ('Core i7处理器', '13');
INSERT INTO `shop_keywords` VALUES ('huawe', '0');
INSERT INTO `shop_keywords` VALUES ('iphone', '8');
INSERT INTO `shop_keywords` VALUES ('SSD闪存', '14');
INSERT INTO `shop_keywords` VALUES ('华为', '2');
INSERT INTO `shop_keywords` VALUES ('华硕', '18');
INSERT INTO `shop_keywords` VALUES ('双摄像头', '6');
INSERT INTO `shop_keywords` VALUES ('坚果炒货', '9');
INSERT INTO `shop_keywords` VALUES ('小米', '15');
INSERT INTO `shop_keywords` VALUES ('手剥松子', '11');
INSERT INTO `shop_keywords` VALUES ('手机', '1');
INSERT INTO `shop_keywords` VALUES ('日本原装液晶面板', '23');
INSERT INTO `shop_keywords` VALUES ('纯金属', '16');
INSERT INTO `shop_keywords` VALUES ('零食', '10');
INSERT INTO `shop_keywords` VALUES ('魅海蓝', '7');
