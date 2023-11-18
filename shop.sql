/*
 Navicat Premium Data Transfer

 Source Server         : shop
 Source Server Type    : MySQL
 Source Server Version : 110102 (11.1.2-MariaDB-1:11.1.2+maria~ubu2204)
 Source Host           : localhost:3309
 Source Schema         : shop

 Target Server Type    : MySQL
 Target Server Version : 110102 (11.1.2-MariaDB-1:11.1.2+maria~ubu2204)
 File Encoding         : 65001

 Date: 18/11/2023 14:02:32
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for admin_permissions
-- ----------------------------
DROP TABLE IF EXISTS `admin_permissions`;
CREATE TABLE `admin_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '权限ID',
  `module` varchar(255) DEFAULT NULL COMMENT '模块',
  `name` varchar(255) NOT NULL COMMENT '权限名',
  `slug` varchar(255) DEFAULT NULL COMMENT '权限标识-控制器@方法',
  `description` varchar(255) DEFAULT NULL COMMENT '权限描述',
  `created_at` timestamp NULL DEFAULT current_timestamp() COMMENT '创建时间',
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新时间',
  `is_on` tinyint(3) unsigned DEFAULT 1,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='权限表，记录系统中的权限信息';

-- ----------------------------
-- Records of admin_permissions
-- ----------------------------
BEGIN;
INSERT INTO `admin_permissions` (`id`, `module`, `name`, `slug`, `description`, `created_at`, `updated_at`, `is_on`) VALUES (1, '管理员', '管理员列表', 'AdminUser@index', '管理员列表', '2023-11-18 04:56:59', '2023-11-18 05:42:49', 1);
INSERT INTO `admin_permissions` (`id`, `module`, `name`, `slug`, `description`, `created_at`, `updated_at`, `is_on`) VALUES (2, '管理员', '管理员新增', 'AdminUser@store', '管理员新增', '2023-11-18 05:42:36', '2023-11-18 05:42:58', 1);
COMMIT;

-- ----------------------------
-- Table structure for admin_role
-- ----------------------------
DROP TABLE IF EXISTS `admin_role`;
CREATE TABLE `admin_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '角色ID',
  `name` varchar(255) NOT NULL COMMENT '角色名',
  `created_at` timestamp NULL DEFAULT current_timestamp() COMMENT '创建时间',
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT '更新时间',
  `is_on` tinyint(3) unsigned DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='角色表，记录系统中的角色信息';

-- ----------------------------
-- Records of admin_role
-- ----------------------------
BEGIN;
INSERT INTO `admin_role` (`id`, `name`, `created_at`, `updated_at`, `is_on`) VALUES (1, '超级管理员', '2023-11-18 04:52:48', '2023-11-18 04:52:48', 1);
COMMIT;

-- ----------------------------
-- Table structure for admin_role_permission
-- ----------------------------
DROP TABLE IF EXISTS `admin_role_permission`;
CREATE TABLE `admin_role_permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` int(11) DEFAULT NULL COMMENT '角色ID',
  `permission_id` int(11) DEFAULT NULL COMMENT '权限ID',
  `is_on` tinyint(3) unsigned NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `role_id` (`role_id`),
  KEY `permission_id` (`permission_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='角色-权限关联表，记录角色和权限之间的关联关系';

-- ----------------------------
-- Records of admin_role_permission
-- ----------------------------
BEGIN;
INSERT INTO `admin_role_permission` (`id`, `role_id`, `permission_id`, `is_on`) VALUES (1, 1, 1, 1);
INSERT INTO `admin_role_permission` (`id`, `role_id`, `permission_id`, `is_on`) VALUES (2, 1, 2, 1);
COMMIT;

-- ----------------------------
-- Table structure for admin_users
-- ----------------------------
DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户ID',
  `account` varchar(20) NOT NULL COMMENT '用户名',
  `salt` varchar(100) DEFAULT NULL,
  `password` varchar(100) NOT NULL COMMENT '密码',
  `email` varchar(255) DEFAULT NULL COMMENT '邮箱',
  `realname` varchar(10) DEFAULT NULL COMMENT '真实姓名\n',
  `phone` varchar(20) NOT NULL COMMENT '手机号',
  `avatar` varchar(255) DEFAULT NULL COMMENT '头像',
  `company_id` int(11) NOT NULL COMMENT '企业ID',
  `type` tinyint(3) unsigned NOT NULL COMMENT '账号类型 0:超级管理员',
  `sex` tinyint(3) unsigned DEFAULT 0 COMMENT '性别 0 :默认未知 1: 男 2:女',
  `status` tinyint(3) unsigned DEFAULT 1 COMMENT '0: 冻结 1:正常',
  `is_on` tinyint(3) unsigned DEFAULT 1 COMMENT '0 :删除 1:正常',
  `created_at` bigint(20) DEFAULT current_timestamp() COMMENT '创建时间',
  `updated_at` bigint(20) DEFAULT current_timestamp() COMMENT '更新时间',
  `last_login_ip` varchar(45) DEFAULT NULL COMMENT 'IP\n',
  `last_login_time` bigint(20) DEFAULT NULL COMMENT '最后登录时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`account`),
  UNIQUE KEY `phone` (`phone`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='后台用户表，记录后台管理系统的用户信息';

-- ----------------------------
-- Records of admin_users
-- ----------------------------
BEGIN;
INSERT INTO `admin_users` (`id`, `account`, `salt`, `password`, `email`, `realname`, `phone`, `avatar`, `company_id`, `type`, `sex`, `status`, `is_on`, `created_at`, `updated_at`, `last_login_ip`, `last_login_time`) VALUES (1, 'Hiker', 'cA2ak', 'e8f0c3b6779bcfe2e7670479fcbb50bd', NULL, 'Hiker', '13711380814', NULL, 1, 0, 0, 1, 1, 1700278498232, 1700286587410, '3232252161', 1700286587);
COMMIT;

-- ----------------------------
-- Table structure for uploads
-- ----------------------------
DROP TABLE IF EXISTS `uploads`;
CREATE TABLE `uploads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` tinyint(3) unsigned DEFAULT NULL COMMENT '文件类型 :1图片',
  `path` varchar(255) NOT NULL COMMENT '文件地址',
  `file_size` int(11) NOT NULL COMMENT '记录文件大小',
  `user_id` int(10) unsigned DEFAULT 0 COMMENT '上传用户ID',
  `status` tinyint(3) unsigned DEFAULT 0 COMMENT '上传状态 0:admin_user 1:user',
  `created_at` bigint(20) NOT NULL DEFAULT current_timestamp(),
  `updated_at` bigint(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- ----------------------------
-- Records of uploads
-- ----------------------------
BEGIN;
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
