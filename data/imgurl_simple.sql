/*
 Navicat Premium Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 100310
 Source Host           : localhost:3306
 Source Schema         : imgurl_simple

 Target Server Type    : MySQL
 Target Server Version : 100310
 File Encoding         : 65001

 Date: 20/07/2019 14:42:27
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for img_images
-- ----------------------------
DROP TABLE IF EXISTS `img_images`;
CREATE TABLE `img_images`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '图片数字ID，自增',
  `imgid` char(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '图片uid，唯一',
  `path` char(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '图片路径',
  `thumb_path` char(64) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '缩略图路径',
  `storage` char(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '存储引擎',
  `ip` char(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户IP',
  `ua` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户UA',
  `date` timestamp NOT NULL COMMENT '图片上传日期',
  `user` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'visitor' COMMENT '上传者，visitor:游客,admin:管理员',
  `compression` tinyint(4) NOT NULL DEFAULT 0 COMMENT '图片是否压缩,0:未压缩,1:已压缩',
  `watermark` tinyint(4) NOT NULL DEFAULT 0 COMMENT '图片水印',
  `level` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'unknown' COMMENT '图片等级，unknown:未识别，everyone:正常,adult:成人',
  `others` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '其它信息',
  `token` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT 'token，用于删除图片',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `images_id`(`id`) USING BTREE,
  UNIQUE INDEX `images_imgid`(`imgid`) USING BTREE,
  UNIQUE INDEX `images_token`(`token`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for img_imginfo
-- ----------------------------
DROP TABLE IF EXISTS `img_imginfo`;
CREATE TABLE `img_imginfo`  (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '图片信息id，自增',
  `imgid` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '图片uid，唯一，和images.imgid关联',
  `mime` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '图片MIME类型',
  `width` double NOT NULL DEFAULT 0 COMMENT '图片宽',
  `height` double NOT NULL DEFAULT 0 COMMENT '图片高',
  `views` int(11) NULL DEFAULT 0 COMMENT '图片浏览次数',
  `ext` varchar(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '图片扩展名',
  `client_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '图片原始文件名',
  `tags` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '图片标签',
  `description` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT '' COMMENT '图片描述',
  `size` double(8, 0) NULL DEFAULT NULL COMMENT '图片大小，单位kb',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `imginfo_id`(`id`) USING BTREE,
  UNIQUE INDEX `imginfo_imgid`(`imgid`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for img_invite
-- ----------------------------
DROP TABLE IF EXISTS `img_invite`;
CREATE TABLE `img_invite`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invite_code` varchar(16) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '邀请码',
  `creat_time` timestamp NOT NULL COMMENT '邀请码创建时间',
  `exp_time` timestamp NOT NULL COMMENT '邀请码过期时间',
  `email` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户邮箱',
  `status` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '邀请码状态',
  `others` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '其它信息',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Table structure for img_options
-- ----------------------------
DROP TABLE IF EXISTS `img_options`;
CREATE TABLE `img_options`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '选项名称，唯一',
  `values` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '选项值，多项可存储json',
  `switch` varchar(6) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT 'OFF' COMMENT '选项开关，ON:打开;OFF:关闭（默认）',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `name`(`name`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of img_options
-- ----------------------------
INSERT INTO `img_options` VALUES (1, 'uplimit', '{\"max_size\":5,\"limit\":10}', 'ON');
INSERT INTO `img_options` VALUES (2, 'tinypng', '{\"api1\":\"\",\"api2\":\"\"}', 'OFF');
INSERT INTO `img_options` VALUES (3, 'moderate', NULL, 'OFF');
INSERT INTO `img_options` VALUES (5, 'site_setting', '{\"logo\":\"/static/images/logo.png\",\"title\":\"ImgURL图床\",\"keywords\":\"\",\"description\":\"\",\"analytics\":\"\",\"comments\":\"\"}', NULL);
INSERT INTO `img_options` VALUES (6, 'footer', 'Copyright © 2017-2022 Powered by <a href=\"https://imgurl.org/\" target = \"_blank\" title = \"ImgURL是一个开源免费的图床程序\">ImgURL</a> | Author <a href=\"https://www.xiaoz.me/\" target = \"_blank\" title = \"小z博客\">xiaoz.me</a>', 'OFF');
INSERT INTO `img_options` VALUES (7, 'notice', '游客限制每日上传10张，单张图片不能超过5M，上传的图片将公开显示，使用之前请先阅读《<a href = \"/page/use\">使用协议</a>》', 'OFF');
INSERT INTO `img_options` VALUES (8, 'ad_global_left', NULL, 'OFF');
INSERT INTO `img_options` VALUES (9, 'ad_global_right', NULL, 'OFF');
INSERT INTO `img_options` VALUES (10, 'ad_page_right', NULL, 'OFF');
INSERT INTO `img_options` VALUES (11, 'ad_global_top', NULL, 'OFF');
INSERT INTO `img_options` VALUES (12, 'txt_watermark', NULL, 'OFF');
INSERT INTO `img_options` VALUES (13, 'img_watermark', NULL, 'OFF');
INSERT INTO `img_options` VALUES (14, 'token', NULL, 'OFF');
INSERT INTO `img_options` VALUES (15, 'page_notice', '此图片来自网友上传，不代表本站立场，若有侵权，请联系管理员删除！', 'OFF');
INSERT INTO `img_options` VALUES (16, 'menus', NULL, 'OFF');

-- ----------------------------
-- Table structure for img_storage
-- ----------------------------
DROP TABLE IF EXISTS `img_storage`;
CREATE TABLE `img_storage`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '存储引擎的名称',
  `engine` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '存储引擎，localhost：本地存储，',
  `domains` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '' COMMENT '存储引擎绑定的域名',
  `info` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '存储引擎的一些信息',
  `switch` varchar(8) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'OFF' COMMENT '存储引擎开关，ON：打开，OFF：关闭',
  `weight` tinyint(2) NOT NULL DEFAULT 0 COMMENT '存储引擎的权重，0-99，权重越高，越靠前',
  `permission` tinyint(1) NOT NULL DEFAULT 1 COMMENT '是否允许游客上传，1:允许,0:拒绝',
  `others` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '其它信息',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `engine`(`engine`) USING BTREE COMMENT '存储引擎外键'
) ENGINE = InnoDB AUTO_INCREMENT = 11 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of img_storage
-- ----------------------------
INSERT INTO `img_storage` VALUES (1, 'Backblaze B2', 'backblaze', 'https://f002.backblazeb2.com/file/', '', 'OFF', 0, 1, NULL);
INSERT INTO `img_storage` VALUES (2, '腾讯COS', 'cos', '', NULL, 'OFF', 0, 1, NULL);
INSERT INTO `img_storage` VALUES (3, '阿里OSS', 'oss', '', NULL, 'OFF', 0, 1, NULL);
INSERT INTO `img_storage` VALUES (4, '七牛云', 'qiniu', '', NULL, 'OFF', 0, 1, NULL);
INSERT INTO `img_storage` VALUES (5, '又拍云', 'upyun', '', NULL, 'OFF', 0, 1, NULL);
INSERT INTO `img_storage` VALUES (6, 'Ucloud', 'ucloud', '', NULL, 'OFF', 0, 1, NULL);
INSERT INTO `img_storage` VALUES (7, 'AWS S3', 'aws_s3', '', NULL, 'OFF', 0, 1, NULL);
INSERT INTO `img_storage` VALUES (8, 'DigitalOcean', 'digitalocean', '', NULL, 'OFF', 0, 1, NULL);
INSERT INTO `img_storage` VALUES (9, 'FTP', 'ftp', '', NULL, 'OFF', 0, 1, NULL);
INSERT INTO `img_storage` VALUES (10, '本地', 'localhost', '', NULL, 'ON', 99, 1, NULL);

-- ----------------------------
-- Table structure for img_users
-- ----------------------------
DROP TABLE IF EXISTS `img_users`;
CREATE TABLE `img_users`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户UID',
  `username` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户名，唯一',
  `email` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户邮箱',
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户密码',
  `ip` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户注册IP',
  `ua` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户注册UA',
  `reg_time` timestamp NOT NULL COMMENT '注册时间',
  `last_login` timestamp NOT NULL COMMENT '最后登录时间',
  `up_limit` int(11) NOT NULL DEFAULT 500 COMMENT '上传限制',
  `status` tinytext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT '用户状态',
  `storage` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL COMMENT '用户默认存储引擎',
  `up_num` int(11) NOT NULL DEFAULT 0 COMMENT '用户总上传数量',
  `others` text CHARACTER SET utf8 COLLATE utf8_general_ci NULL COMMENT '用户其它信息',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `users`(`id`, `uid`, `username`, `email`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_general_ci ROW_FORMAT = Dynamic;

SET FOREIGN_KEY_CHECKS = 1;
