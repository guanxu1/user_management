/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50709
Source Host           : localhost:3306
Source Database       : mushroom

Target Server Type    : MYSQL
Target Server Version : 50709
File Encoding         : 65001

Date: 2016-07-04 11:36:59
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for article
-- ----------------------------
DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '标题',
  `url` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '文章跳转地址',
  `content` text COLLATE utf8_bin COMMENT '文章内容',
  `image` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '文章图片',
  `column_id` int(11) DEFAULT NULL COMMENT '所属栏目ID',
  `key_id` int(11) DEFAULT NULL COMMENT '外键ID【CLASS：0.商品=>云商商品ID 1.商品集合=>栏目ID 2.新闻=>文章ID】',
  `class` int(11) DEFAULT NULL COMMENT '关联article_class.id字段',
  `create_time` datetime DEFAULT NULL COMMENT '创建时间',
  `create_user` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '创建人',
  `start_time` datetime DEFAULT NULL COMMENT '开始时间【有效时间】',
  `end_time` datetime DEFAULT NULL COMMENT '结束时间【有效时间】',
  `update_time` datetime DEFAULT NULL COMMENT '最后修改时间',
  `update_user` varchar(50) COLLATE utf8_bin DEFAULT NULL COMMENT '最后修改人',
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '状态【0,1】【关闭，开启】',
  `sort` int(10) NOT NULL COMMENT '排序',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='文章列表';

-- ----------------------------
-- Records of article
-- ----------------------------
INSERT INTO `article` VALUES ('80', '测试文章3', '', '', null, '303', null, null, '2016-06-24 15:31:04', 'guanxu', '2016-06-24 15:30:39', '2016-06-24 15:30:39', '2016-06-24 15:49:54', 'guanxu', '1', '1');

-- ----------------------------
-- Table structure for article_class
-- ----------------------------
DROP TABLE IF EXISTS `article_class`;
CREATE TABLE `article_class` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='分类关联表';

-- ----------------------------
-- Records of article_class
-- ----------------------------
INSERT INTO `article_class` VALUES ('3', '新闻');

-- ----------------------------
-- Table structure for classify
-- ----------------------------
DROP TABLE IF EXISTS `classify`;
CREATE TABLE `classify` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  `classify` int(11) DEFAULT NULL COMMENT '1,2【前台，后台】',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='分类';

-- ----------------------------
-- Records of classify
-- ----------------------------
INSERT INTO `classify` VALUES ('1', '系统模块', '1', '2016-06-20 18:28:47', '2');
INSERT INTO `classify` VALUES ('2', '文章模块', '1', '2016-06-20 18:29:20', '2');

-- ----------------------------
-- Table structure for column
-- ----------------------------
DROP TABLE IF EXISTS `column`;
CREATE TABLE `column` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_bin DEFAULT NULL COMMENT '栏目名称',
  `sort` int(11) NOT NULL COMMENT '排序',
  `title_img` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '标题图片',
  `content` text COLLATE utf8_bin COMMENT '栏目简介',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态【0,1】【关闭，开启】',
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=304 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='栏目列表';

-- ----------------------------
-- Records of column
-- ----------------------------
INSERT INTO `column` VALUES ('1', '系统结构', '1', null, null, '1', '2016-02-16 14:05:35');
INSERT INTO `column` VALUES ('303', '2级栏目', '1', '', '', '1', '2016-06-24 15:22:47');

-- ----------------------------
-- Table structure for column_relation
-- ----------------------------
DROP TABLE IF EXISTS `column_relation`;
CREATE TABLE `column_relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `column_id` int(11) DEFAULT NULL COMMENT '栏目ID',
  `column_parent` int(11) NOT NULL COMMENT '父级栏目ID',
  `rank` int(11) DEFAULT NULL COMMENT '等级【0~100】',
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '状态【0,1】【关闭，开启】',
  `create_time` datetime DEFAULT NULL,
  `number` varchar(200) COLLATE utf8_bin DEFAULT NULL COMMENT '栏目编号',
  PRIMARY KEY (`id`),
  UNIQUE KEY `column_id` (`column_id`)
) ENGINE=InnoDB AUTO_INCREMENT=221 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='栏目关系';

-- ----------------------------
-- Records of column_relation
-- ----------------------------
INSERT INTO `column_relation` VALUES ('1', '1', '0', '1', '1', '2016-06-24 15:22:10', '0001');
INSERT INTO `column_relation` VALUES ('220', '303', '1', '2', '1', '2016-06-24 15:22:47', '00010303');

-- ----------------------------
-- Table structure for modules
-- ----------------------------
DROP TABLE IF EXISTS `modules`;
CREATE TABLE `modules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `url` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `status` int(1) DEFAULT NULL COMMENT '0,1【不可用，可用】',
  `create_time` datetime DEFAULT NULL,
  `classify_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='模块';

-- ----------------------------
-- Records of modules
-- ----------------------------
INSERT INTO `modules` VALUES ('1', '分类管理', 'ClassifyController@index', '1', '2016-06-20 18:18:55', '1');
INSERT INTO `modules` VALUES ('2', '栏目管理', 'ModulesController@index', '1', '2016-06-20 18:20:03', '1');
INSERT INTO `modules` VALUES ('3', '角色管理', 'RoleController@index', '1', '2016-06-21 14:15:37', '1');
INSERT INTO `modules` VALUES ('4', '用户管理', 'UserController@index', '1', '2016-06-21 14:15:48', '1');
INSERT INTO `modules` VALUES ('9', '文章管理', 'ArticleController@index', '1', '2016-06-24 11:43:22', '2');

-- ----------------------------
-- Table structure for modules_func
-- ----------------------------
DROP TABLE IF EXISTS `modules_func`;
CREATE TABLE `modules_func` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `url` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `modules_id` int(11) DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='模块详细方法';

-- ----------------------------
-- Records of modules_func
-- ----------------------------
INSERT INTO `modules_func` VALUES ('1', '列表', 'ModulesController@index', '1', '1', '2016-06-20 18:25:09');
INSERT INTO `modules_func` VALUES ('2', '添加', 'qweqwe', '1', '1', '2016-06-21 14:54:58');
INSERT INTO `modules_func` VALUES ('3', '查看', '123', '1', '1', '2016-06-21 15:25:02');
INSERT INTO `modules_func` VALUES ('4', '添加', '1231231', '2', '1', '2016-06-21 19:04:34');
INSERT INTO `modules_func` VALUES ('5', '列表', 'ArticleController@index', '9', '1', '2016-07-01 15:52:58');

-- ----------------------------
-- Table structure for role
-- ----------------------------
DROP TABLE IF EXISTS `role`;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `status` int(1) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='角色表';

-- ----------------------------
-- Records of role
-- ----------------------------
INSERT INTO `role` VALUES ('1', '开发人员', '1', '2016-06-21 15:26:27');
INSERT INTO `role` VALUES ('2', '测试人员', '1', '2016-06-29 18:29:50');
INSERT INTO `role` VALUES ('3', '无权限', '1', '2016-07-01 19:04:35');

-- ----------------------------
-- Table structure for role_relation
-- ----------------------------
DROP TABLE IF EXISTS `role_relation`;
CREATE TABLE `role_relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL,
  `modules_func_id` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='角色模块权限';

-- ----------------------------
-- Records of role_relation
-- ----------------------------
INSERT INTO `role_relation` VALUES ('20', '1', '5', '2016-07-01 16:40:38');
INSERT INTO `role_relation` VALUES ('19', '1', '4', '2016-07-01 16:40:38');
INSERT INTO `role_relation` VALUES ('18', '1', '3', '2016-07-01 16:40:38');
INSERT INTO `role_relation` VALUES ('17', '1', '2', '2016-07-01 16:40:38');
INSERT INTO `role_relation` VALUES ('23', '2', '3', '2016-07-01 16:40:46');
INSERT INTO `role_relation` VALUES ('22', '2', '2', '2016-07-01 16:40:46');
INSERT INTO `role_relation` VALUES ('21', '2', '1', '2016-07-01 16:40:46');
INSERT INTO `role_relation` VALUES ('16', '1', '1', '2016-07-01 16:40:38');
INSERT INTO `role_relation` VALUES ('24', '2', '5', '2016-07-01 16:40:46');

-- ----------------------------
-- Table structure for role_user
-- ----------------------------
DROP TABLE IF EXISTS `role_user`;
CREATE TABLE `role_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `create_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of role_user
-- ----------------------------
INSERT INTO `role_user` VALUES ('5', '8', '2', '2016-06-29 18:30:12');
INSERT INTO `role_user` VALUES ('4', '8', '1', '2016-06-28 18:36:39');
INSERT INTO `role_user` VALUES ('6', '9', '3', '2016-07-01 19:04:40');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `password` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `mobile` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `rank` int(5) DEFAULT '4' COMMENT '1,2,3,4 【超级管理员，管理员，高级会员，普通会员】',
  `status` int(1) DEFAULT '1' COMMENT '0,1【不可用，可用】',
  `create_time` datetime DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_bin DEFAULT NULL COMMENT '真实姓名',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE,
  UNIQUE KEY `mobile` (`mobile`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='用户表';

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('8', 'test', 'e10adc3949ba59abbe56e057f20f883e', '', '2', '1', '2016-06-28 18:22:10', '');
INSERT INTO `user` VALUES ('9', 'test1', 'e10adc3949ba59abbe56e057f20f883e', null, '2', '1', '2016-07-01 19:04:21', null);
INSERT INTO `user` VALUES ('4', 'admin', 'e10adc3949ba59abbe56e057f20f883e', null, '1', '1', '2016-06-28 16:10:45', '');
