/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50725
Source Host           : localhost:3306
Source Database       : permission

Target Server Type    : MYSQL
Target Server Version : 50725
File Encoding         : 65001

Date: 2019-07-20 15:53:37
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin_user
-- ----------------------------
DROP TABLE IF EXISTS `admin_user`;
CREATE TABLE `admin_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) CHARACTER SET utf8 NOT NULL COMMENT '用户名',
  `password` char(32) CHARACTER SET utf8 NOT NULL COMMENT '密码',
  `logintime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '登陆时间',
  `loginip` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '0.0.0.0' COMMENT '登陆ip',
  `lock` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '状态,1:正常,2:锁定',
  `createtime` int(11) NOT NULL DEFAULT '0' COMMENT '创建时间',
  `updatetime` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '更新时间',
  `expiredtime` int(11) NOT NULL DEFAULT '0' COMMENT '过期时间',
  `activationtime` int(11) DEFAULT NULL COMMENT '激活时间',
  `num` int(11) NOT NULL DEFAULT '0' COMMENT '每天上下架次数',
  `token` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `user_nickname` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '用户昵称',
  `user_avatar` varchar(255) CHARACTER SET utf8 DEFAULT NULL COMMENT '用户头像,七牛云的key',
  `description` varchar(255) CHARACTER SET utf8 DEFAULT '优秀的管理员' COMMENT '个人简介',
  `email` varchar(255) DEFAULT NULL,
  `isNotice` tinyint(5) DEFAULT '2' COMMENT '是否开启邮件通知 1 是 2 否',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_UNIQUE` (`username`) USING BTREE,
  UNIQUE KEY `id_UNIQUE` (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COMMENT='管理员表';

-- ----------------------------
-- Records of admin_user
-- ----------------------------
INSERT INTO `admin_user` VALUES ('5', 'admin', '83b2f027abe3b60eadee76ab39fbdc5a', '1563527853', '127.0.0.1', '1', '0', '0', '0', null, '0', null, 'admin', 'http://offline-photo.d88.tech/7.844688863317173', '', '', '2');

-- ----------------------------
-- Table structure for message_model_user
-- ----------------------------
DROP TABLE IF EXISTS `message_model_user`;
CREATE TABLE `message_model_user` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '中间表主键id',
  `message_id` int(11) unsigned NOT NULL,
  `user_id` int(11) unsigned NOT NULL,
  `status` enum('2','4','3','1') CHARACTER SET utf8 NOT NULL DEFAULT '1' COMMENT '1 等待发送 2发送成功 3发送失败 4 已撤回 ',
  `readed` enum('1','0','2') NOT NULL DEFAULT '0' COMMENT '1 是已读取 0 是未读 2 已删除',
  `update_time` int(11) NOT NULL,
  `create_time` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of message_model_user
-- ----------------------------

-- ----------------------------
-- Table structure for model_has_permission
-- ----------------------------
DROP TABLE IF EXISTS `model_has_permission`;
CREATE TABLE `model_has_permission` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(16) unsigned NOT NULL COMMENT '用户id',
  `permission_id` int(16) unsigned NOT NULL COMMENT '权限id',
  PRIMARY KEY (`id`),
  UNIQUE KEY `permission_model_unique` (`user_id`,`permission_id`),
  KEY `delete_permission` (`permission_id`),
  CONSTRAINT `delete_permission` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of model_has_permission
-- ----------------------------

-- ----------------------------
-- Table structure for model_has_role
-- ----------------------------
DROP TABLE IF EXISTS `model_has_role`;
CREATE TABLE `model_has_role` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(16) unsigned NOT NULL COMMENT '角色id',
  `user_id` int(16) unsigned NOT NULL COMMENT '权限id',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_model_unique` (`role_id`,`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of model_has_role
-- ----------------------------

-- ----------------------------
-- Table structure for permission
-- ----------------------------
DROP TABLE IF EXISTS `permission`;
CREATE TABLE `permission` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '权限节点名称(根据它来进行)',
  `rule` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '路由地址',
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' COMMENT '节点备注信息',
  `p_id` int(2) NOT NULL DEFAULT '0' COMMENT '用于菜单渲染的节点',
  `status` enum('1','0') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1' COMMENT '0 禁用 1 启用',
  `create_time` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `update_time` timestamp NOT NULL ON UPDATE CURRENT_TIMESTAMP,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '请求方法 array 格式',
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '路由',
  `hidden` int(2) NOT NULL DEFAULT '1' COMMENT 'true',
  `icon` varchar(165) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1898 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of permission
-- ----------------------------

-- ----------------------------
-- Table structure for role_has_permission
-- ----------------------------
DROP TABLE IF EXISTS `role_has_permission`;
CREATE TABLE `role_has_permission` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `permission_id` int(16) unsigned NOT NULL COMMENT '关联的权限id',
  `role_id` int(16) unsigned NOT NULL COMMENT '关联的角色id',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_permission_role` (`permission_id`,`role_id`),
  KEY `deleted_to_role` (`role_id`),
  CONSTRAINT `deleted_to_permission` FOREIGN KEY (`permission_id`) REFERENCES `permission` (`id`) ON DELETE CASCADE,
  CONSTRAINT `deleted_to_role` FOREIGN KEY (`role_id`) REFERENCES `d88_role` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=636 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='角色 - 权限的中间表';

-- ----------------------------
-- Records of role_has_permission
-- ----------------------------

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', '锋');
INSERT INTO `user` VALUES ('2', '网易云');
INSERT INTO `user` VALUES ('3', '酷狗');
