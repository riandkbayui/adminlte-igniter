/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50638
 Source Host           : localhost:3306
 Source Schema         : adminlte

 Target Server Type    : MySQL
 Target Server Version : 50638
 File Encoding         : 65001

 Date: 15/02/2020 08:24:23
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for _group
-- ----------------------------
DROP TABLE IF EXISTS `_group`;
CREATE TABLE `_group`  (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_label` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`group_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of _group
-- ----------------------------
INSERT INTO `_group` VALUES (1, 'Administrator');
INSERT INTO `_group` VALUES (2, 'User');

-- ----------------------------
-- Table structure for _setting
-- ----------------------------
DROP TABLE IF EXISTS `_setting`;
CREATE TABLE `_setting`  (
  `setting_web_name` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `setting_web_credit` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `setting_web_credit_href` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `setting_web_logo` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `setting_web_icon` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of _setting
-- ----------------------------
INSERT INTO `_setting` VALUES ('AdminLTE 4', 'Sans Coding', 'http://sanscoding.com', 'assets/dist/img/AdminLTELogo.png', 'assets/dist/img/AdminLTELogo.png');

-- ----------------------------
-- Table structure for _sidebar
-- ----------------------------
DROP TABLE IF EXISTS `_sidebar`;
CREATE TABLE `_sidebar`  (
  `sidebar_id` int(11) NOT NULL AUTO_INCREMENT,
  `sidebar_parent` int(11) NULL DEFAULT 0,
  `sidebar_label` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sidebar_href` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `sidebar_icon` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'fa fa-angle-right',
  `sidebar_index` int(5) NULL DEFAULT NULL,
  `status_id` varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '1',
  PRIMARY KEY (`sidebar_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 14 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of _sidebar
-- ----------------------------
INSERT INTO `_sidebar` VALUES (0, 0, 'Parent', 'None', 'fa fa-angle-right', 0, '0');
INSERT INTO `_sidebar` VALUES (1, 0, 'Dashboard', 'dashboard', 'fas fa-tachometer-alt', 1, '1');
INSERT INTO `_sidebar` VALUES (2, 12, 'Manajemen Grup', 'systems/grup', 'fa fa-users', 1, '1');
INSERT INTO `_sidebar` VALUES (3, 12, 'Manajemen User', 'systems/user', 'fa fa-user', 2, '1');
INSERT INTO `_sidebar` VALUES (4, 12, 'Manajemen Sidebar', 'systems/sidebar', 'fa fa-bars', 3, '1');
INSERT INTO `_sidebar` VALUES (6, 13, 'Pengaturan', 'systems/pengaturan', 'fa fa-cog', 1, '1');
INSERT INTO `_sidebar` VALUES (12, 0, 'System', '#', 'fa fa-cogs', 1, '1');
INSERT INTO `_sidebar` VALUES (13, 12, 'Website', '#', 'fa fa-cube', 5, '1');

-- ----------------------------
-- Table structure for _sidebar_access
-- ----------------------------
DROP TABLE IF EXISTS `_sidebar_access`;
CREATE TABLE `_sidebar_access`  (
  `group_id` int(11) NULL DEFAULT NULL,
  `sidebar_id` int(11) NULL DEFAULT NULL,
  `create` varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0',
  `read` varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0',
  `update` varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0',
  `delete` varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '0',
  INDEX `id_sidebar`(`sidebar_id`) USING BTREE,
  INDEX `id_sidebar_group`(`group_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of _sidebar_access
-- ----------------------------
INSERT INTO `_sidebar_access` VALUES (2, 1, '0', '1', '0', '0');
INSERT INTO `_sidebar_access` VALUES (2, 2, '0', '1', '0', '0');
INSERT INTO `_sidebar_access` VALUES (2, 3, '0', '1', '0', '0');
INSERT INTO `_sidebar_access` VALUES (2, 4, '0', '1', '0', '0');
INSERT INTO `_sidebar_access` VALUES (2, 6, '0', '1', '0', '0');
INSERT INTO `_sidebar_access` VALUES (2, 12, '0', '1', '0', '0');
INSERT INTO `_sidebar_access` VALUES (1, 1, '1', '1', '1', '1');
INSERT INTO `_sidebar_access` VALUES (1, 2, '1', '1', '1', '1');
INSERT INTO `_sidebar_access` VALUES (1, 3, '1', '1', '1', '1');
INSERT INTO `_sidebar_access` VALUES (1, 4, '1', '1', '1', '1');
INSERT INTO `_sidebar_access` VALUES (1, 6, '1', '1', '1', '1');
INSERT INTO `_sidebar_access` VALUES (1, 12, '1', '1', '1', '1');
INSERT INTO `_sidebar_access` VALUES (1, 13, '1', '1', '1', '1');

-- ----------------------------
-- Table structure for _status
-- ----------------------------
DROP TABLE IF EXISTS `_status`;
CREATE TABLE `_status`  (
  `status_id` int(2) NOT NULL,
  `status_label` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`status_id`) USING BTREE
) ENGINE = InnoDB CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of _status
-- ----------------------------
INSERT INTO `_status` VALUES (0, 'Non-Aktif');
INSERT INTO `_status` VALUES (1, 'Aktif');

-- ----------------------------
-- Table structure for _user
-- ----------------------------
DROP TABLE IF EXISTS `_user`;
CREATE TABLE `_user`  (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_username` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `user_password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `user_firstname` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `user_lastname` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `user_gender` enum('L','P') CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `user_email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `user_phone` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `user_address` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL,
  `user_birth_place` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `user_birth_date` date NULL DEFAULT NULL,
  `group_id` int(11) NULL DEFAULT NULL,
  `status_id` int(2) NULL DEFAULT 1,
  PRIMARY KEY (`user_id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Compact;

-- ----------------------------
-- Records of _user
-- ----------------------------
INSERT INTO `_user` VALUES (4, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Super', 'Dede', 'P', 'super@admin.com', '0896186598', 'Teratai Street', 'Blitar', '1996-03-21', 1, 1);
INSERT INTO `_user` VALUES (5, 'pengguna', '5f4dcc3b5aa765d61d8327deb882cf99', 'Pengguna', 'Aplikasi', 'L', 'pengguna@aplikasi.com', '0896186598', 'Teratai Street', 'Blitar', '1990-04-22', 2, 1);

-- ----------------------------
-- View structure for _v_sidebar
-- ----------------------------
DROP VIEW IF EXISTS `_v_sidebar`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `_v_sidebar` AS select `_sidebar`.`sidebar_id` AS `sidebar_id`,`_sidebar`.`sidebar_parent` AS `sidebar_parent`,(select `a`.`sidebar_label` from `_sidebar` `a` where (`a`.`sidebar_id` = `_sidebar`.`sidebar_parent`) limit 1) AS `sidebar_parent_label`,`_sidebar`.`sidebar_label` AS `sidebar_label`,`_sidebar`.`sidebar_href` AS `sidebar_href`,`_sidebar`.`sidebar_icon` AS `sidebar_icon`,`_sidebar`.`sidebar_index` AS `sidebar_index`,`_sidebar`.`status_id` AS `status_id`,`_status`.`status_label` AS `status_label` from (`_sidebar` join `_status` on((`_status`.`status_id` = `_sidebar`.`status_id`))) where (`_sidebar`.`sidebar_id` > 0) order by `_sidebar`.`sidebar_id`;

-- ----------------------------
-- View structure for _v_user
-- ----------------------------
DROP VIEW IF EXISTS `_v_user`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `_v_user` AS select `_user`.`user_id` AS `user_id`,`_user`.`user_username` AS `user_username`,`_user`.`user_password` AS `user_password`,`_user`.`user_firstname` AS `user_firstname`,`_user`.`user_lastname` AS `user_lastname`,`_user`.`user_gender` AS `user_gender`,`_user`.`user_email` AS `user_email`,`_user`.`user_phone` AS `user_phone`,`_user`.`user_address` AS `user_address`,`_user`.`user_birth_place` AS `user_birth_place`,`_user`.`user_birth_date` AS `user_birth_date`,`_user`.`group_id` AS `group_id`,`_user`.`status_id` AS `status_id`,`_group`.`group_label` AS `group_label`,`_status`.`status_label` AS `status_label` from ((`_user` join `_group` on((`_group`.`group_id` = `_user`.`group_id`))) join `_status` on((`_status`.`status_id` = `_user`.`status_id`)));

SET FOREIGN_KEY_CHECKS = 1;
