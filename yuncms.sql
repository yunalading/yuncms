-- MySQL dump 10.16  Distrib 10.1.16-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: yuncms
-- ------------------------------------------------------
-- Server version	10.1.16-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `yc_admin_user`
--

DROP TABLE IF EXISTS `yc_admin_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yc_admin_user` (
  `aid` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '管理员标识',
  `aname` varchar(60) NOT NULL DEFAULT '' COMMENT '管理员用户名',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '登录密码',
  `salt` smallint(4) unsigned NOT NULL DEFAULT '3306' COMMENT '密码组合加密字段',
  `email` varchar(100) NOT NULL DEFAULT '' COMMENT '管理员邮箱',
  `phone` varchar(11) NOT NULL DEFAULT '' COMMENT '手机号',
  `avator` varchar(50) NOT NULL DEFAULT '' COMMENT '用户头像',
  `lasttime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '最后登陆时间',
  `lastip` varchar(15) NOT NULL DEFAULT '' COMMENT '最后登陆ip',
  `islock` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0正常1锁定',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '0正常1删除',
  `regtime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '注册时间',
  PRIMARY KEY (`aid`),
  UNIQUE KEY `管理员用户名` (`aname`),
  UNIQUE KEY `管理员邮箱` (`email`),
  UNIQUE KEY `管理员手机号` (`phone`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='管理员用户';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yc_admin_user`
--

LOCK TABLES `yc_admin_user` WRITE;
/*!40000 ALTER TABLE `yc_admin_user` DISABLE KEYS */;
INSERT INTO `yc_admin_user` VALUES (1,'admin','45a1a3e33cf2739383ee9cd6e512e8a4',3306,'68527761@qq.com','18671418772','',1487297618,'127.0.0.1',0,0,1486707687);
/*!40000 ALTER TABLE `yc_admin_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yc_adminlog`
--

DROP TABLE IF EXISTS `yc_admin_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yc_admin_log` (
  `log_id` int(11)  NOT NULL AUTO_INCREMENT COMMENT '日志自增标识',
  `log_aid` int(11) unsigned zerofill NOT NULL COMMENT '操作的管理员标识',
  `log_action` varchar(150) NOT NULL DEFAULT '' COMMENT '操作的控制器和方法',
  `log_value` varchar(30) NOT NULL DEFAULT '' COMMENT '操作该动作的英文标识',
  `log_desc` text NOT NULL DEFAULT '' COMMENT '中文描述',
  `log_remark` text NOT NULL DEFAULT '' COMMENT '其它备注',
  `log_addtime` int(11) unsigned zerofill NOT NULL DEFAULT '00000000000' COMMENT '日志添加时间',
  `log_del` tinyint(1) unsigned zerofill NOT NULL DEFAULT '0' COMMENT '是否删除1删除0未删除',
  `log_addip` varchar(15) NOT NULL DEFAULT '' COMMENT '记录操作ip',
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='后台管理员操作日志';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yc_adminlog`
--

LOCK TABLES `yc_adminlog` WRITE;
/*!40000 ALTER TABLE `yc_adminlog` DISABLE KEYS */;
/*!40000 ALTER TABLE `yc_adminlog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yc_article`
--

DROP TABLE IF EXISTS `yc_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yc_article` (
  `atr_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '文章id标识',
  `art_title` varchar(100) NOT NULL DEFAULT '' COMMENT '文章标题',
  `art_keywords` varchar(100) NOT NULL DEFAULT '' COMMENT '关键词',
  `art_description` varchar(255) NOT NULL DEFAULT '' COMMENT '描述',
  `art_thumb` varchar(100) NOT NULL DEFAULT '' COMMENT '缩略图',
  `art_content` text NOT NULL DEFAULT '' COMMENT '内容',
  `art_addtime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '发布时间',
  `art_author` varchar(50) NOT NULL DEFAULT '' COMMENT '文章作者',
  `art_view` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '查看次数',
  `art_cate_id` varchar(100) NOT NULL COMMENT '所属栏目的cate_id,多个栏目用逗号(,)隔开',
  `art_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '文章显示状态：0正常显示，1隐藏',
  `art_order` tinyint(5) unsigned NOT NULL DEFAULT '100' COMMENT '文章排序',
  `art_module` varchar(50) NOT NULL  DEFAULT '' COMMENT '模板指定模型,没指定默认用上级栏目的',
  `art_template` varchar(50) NOT NULL DEFAULT '' COMMENT '文章模板',
  PRIMARY KEY (`atr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='文章内容表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yc_article`
--

LOCK TABLES `yc_article` WRITE;
/*!40000 ALTER TABLE `yc_article` DISABLE KEYS */;
/*!40000 ALTER TABLE `yc_article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yc_auth_group`
--

DROP TABLE IF EXISTS `yc_auth_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yc_auth_group` (
  `gid` mediumint(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户组标识',
  `type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '组类型0前台1后台',
  `title` varchar(30) NOT NULL DEFAULT '' COMMENT '用户组中文名称',
  `description` varchar(150) NOT NULL DEFAULT '' COMMENT '用户主描述',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '用户组状态：为1正常，为0禁用,-1为删除',
  `rules` varchar(100) NOT NULL DEFAULT '' COMMENT '用户组拥有的规则id，多个规则 , 隔开',
  `addtime` int(11) unsigned zerofill NOT NULL DEFAULT '00000000000' COMMENT '添加时间',
  PRIMARY KEY (`gid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户权限组';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yc_auth_group`
--

LOCK TABLES `yc_auth_group` WRITE;
/*!40000 ALTER TABLE `yc_auth_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `yc_auth_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yc_auth_group_access`
--

DROP TABLE IF EXISTS `yc_auth_group_access`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yc_auth_group_access` (
  `aid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户标识',
  `gid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '用户组标识',
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='用户和所在组对应关系';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yc_auth_group_access`
--

LOCK TABLES `yc_auth_group_access` WRITE;
/*!40000 ALTER TABLE `yc_auth_group_access` DISABLE KEYS */;
/*!40000 ALTER TABLE `yc_auth_group_access` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yc_auth_rule`
--

DROP TABLE IF EXISTS `yc_auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yc_auth_rule` (
  `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT COMMENT '规则id,自增主键',
  `module` varchar(30) NOT NULL DEFAULT '' COMMENT '规则所属模型',
  `type` tinyint(2) NOT NULL DEFAULT '1' COMMENT '1-url规则;2-主菜单',
  `name` varchar(80) NOT NULL DEFAULT '' COMMENT '规则唯一英文标识',
  `title` varchar(20) NOT NULL DEFAULT '' COMMENT '规则中文描述',
  `group` varchar(20) NOT NULL DEFAULT '' COMMENT '权限节点分组',
  `addtime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否有效(0:无效,1:有效)',
  `sort` int(5) unsigned NOT NULL DEFAULT '100' COMMENT '排序',
  `condition` text NOT NULL DEFAULT '' COMMENT '规则附加条件',
  PRIMARY KEY (`id`),
  UNIQUE KEY `规则唯一英文标识` (`name`),
  KEY `module` (`module`,`status`,`type`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yc_auth_rule`
--

LOCK TABLES `yc_auth_rule` WRITE;
/*!40000 ALTER TABLE `yc_auth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `yc_auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yc_autoconfig`
--

DROP TABLE IF EXISTS `yc_autoconfig`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yc_autoconfig` (
  `conf_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `conf_title` varchar(50) NOT NULL DEFAULT '' COMMENT '名称',
  `conf_name` varchar(50) NOT NULL DEFAULT '' DEFAULT '' COMMENT '变量名',
  `conf_value` text NOT NULL COMMENT '变量值',
  `conf_order` int(5) unsigned NOT NULL DEFAULT '100' COMMENT '排序',
  `conf_tips` varchar(150) NOT NULL DEFAULT '' COMMENT '描述说明',
  `conf_type` tinyint(1) unsigned zerofill NOT NULL DEFAULT '0' COMMENT '类型0配置项1模型',
  `conf_mid` int(11) unsigned DEFAULT '0' COMMENT '如果type=1,此处对应yc_module表的mid',
  `conf_addtime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  `field_type` varchar(50) NOT NULL DEFAULT '' COMMENT '字段类型',
  `field_value` varchar(255) NOT NULL DEFAULT '' COMMENT '类型值(如field_type值为"radio"时field_value可设为 "1|开启,0|关闭")',
  PRIMARY KEY (`conf_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='自定义配置项';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yc_autoconfig`
--

LOCK TABLES `yc_autoconfig` WRITE;
/*!40000 ALTER TABLE `yc_autoconfig` DISABLE KEYS */;
/*!40000 ALTER TABLE `yc_autoconfig` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yc_category`
--

DROP TABLE IF EXISTS `yc_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yc_category` (
  `cate_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '栏目id标识',
  `cate_name` varchar(50) NOT NULL DEFAULT '' COMMENT '分类名称',
  `cate_title` varchar(100) NOT NULL DEFAULT '' COMMENT '栏目分类说明',
  `cate_keywords` varchar(150) NOT NULL DEFAULT '' COMMENT '栏目关键字',
  `cate_description` text NOT NULL DEFAULT '' COMMENT '网站描述',
  `cate_view` int(10) unsigned NOT NULL DEFAULT '0' COMMENT '查看次数',
  `cate_pid` int(5) unsigned  NOT NULL DEFAULT '0' COMMENT '父级栏目cate_id',
  `cate_order` tinyint(4) unsigned NOT NULL DEFAULT '100' COMMENT '栏目排序',
  `cate_module` varchar(50) NOT NULL DEFAULT '' COMMENT '所属模型',
  `cate_template` varchar(50) NOT NULL DEFAULT '' COMMENT '栏目列表模板',
  `cate_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '栏目前台显示状态:0正常显示，1隐藏',
  PRIMARY KEY (`cate_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='网站栏目分类';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yc_category`
--

LOCK TABLES `yc_category` WRITE;
/*!40000 ALTER TABLE `yc_category` DISABLE KEYS */;
/*!40000 ALTER TABLE `yc_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yc_comment`
--

DROP TABLE IF EXISTS `yc_comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yc_comment` (
  `com_id` int(11) unsigned NOT NULL  AUTO_INCREMENT,
  `com_user_id` int(11) unsigned  NOT NULL DEFAULT '0' COMMENT '评论用户的id,0为匿名用户',
  `com_user_name` varchar(50) NOT NULL DEFAULT '' COMMENT '评论用户的名称',
  `com_art_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '评论的文章id',
  `com_addtime` int(11) unsigned  NOT NULL DEFAULT '0' COMMENT '评论的时间',
  `com_content` text NOT NULL DEFAULT '' COMMENT '评论内容',
  `com_reply_id` int(11) unsigned  NOT NULL DEFAULT 0 COMMENT '管理员回复人id',
  `com_reply_msg` text NOT NULL DEFAULT '' COMMENT '管理员回复内容',
  `com_reply_time` int(11) unsigned  NOT NULL DEFAULT '0' COMMENT '回复的时间',
  `com_is_sh` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否审核（0未审核1审核通过2审核不通过）',
  `com_sh_time` int(11) unsigned  NOT NULL DEFAULT '0' COMMENT '审核的时间',
  `com_sh_aid` int(11) unsigned  NOT NULL DEFAULT '0' COMMENT '审核管理员',
  `com_order` int(5) unsigned  NOT NULL DEFAULT 100 COMMENT '排序',
  PRIMARY KEY (`com_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户评论表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yc_comment`
--

LOCK TABLES `yc_comment` WRITE;
/*!40000 ALTER TABLE `yc_comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `yc_comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yc_config`
--

DROP TABLE IF EXISTS `yc_config`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yc_config` (
  `webname` varchar(30) NOT NULL DEFAULT '' COMMENT '网站名称',
  `domain` varchar(50) NOT NULL DEFAULT '' COMMENT '网站域名',
  `website` varchar(255) NOT NULL DEFAULT '' COMMENT '网站备案信息',
  `copyright` varchar(100) NOT NULL DEFAULT '' COMMENT '版权信息',
  `theme` varchar(50) NOT NULL DEFAULT '' COMMENT '后台默认主题',
  `forbitip` text NOT NULL DEFAULT '' COMMENT '禁止访问IP（英文逗号隔开）',
  `mail` varchar(100) NOT NULL DEFAULT '' COMMENT '站长邮箱',
  `QQ` int(15) unsigned  NOT NULL DEFAULT 0 COMMENT '站长联系QQ',
  `keyword` varchar(255) NOT NULL DEFAULT '' COMMENT '网站关键字',
  `description` text NOT NULL DEFAULT '' COMMENT '网站描述，网站简介',
  `logo` varchar(255) NOT NULL DEFAULT '' COMMENT '网站的logo地址',
  `captcha` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否开启后台登录验证码0关闭1开启'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='网站系统配置表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yc_config`
--

LOCK TABLES `yc_config` WRITE;
/*!40000 ALTER TABLE `yc_config` DISABLE KEYS */;
INSERT INTO `yc_config` VALUES ('','http://www.yuncms.com','','','','','',000000000000000,'','','/static/images/logo.png',0);
/*!40000 ALTER TABLE `yc_config` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yc_guestbook`
--

DROP TABLE IF EXISTS `yc_guest_book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yc_guest_book` (
  `guest_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `guest_name` varchar(255) NOT NULL DEFAULT '' COMMENT '姓名',
  `guest_email` varchar(255) NOT NULL DEFAULT '' COMMENT '邮箱',
  `guest_tel` varchar(11) NOT NULL DEFAULT '' COMMENT '电话',
  `guest_order` tinyint(5) unsigned NOT NULL DEFAULT '100' COMMENT '排序编号',
  `guest_msg` text NOT NULL DEFAULT '' COMMENT '留言内容',
  `guest_addtime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '留言时间',
  `guest_view` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否查看（0未查看1已经查看）',
  `guest_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否删除:0未删除1已删除',
  PRIMARY KEY (`guest_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户留言表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yc_guestbook`
--

LOCK TABLES `yc_guestbook` WRITE;
/*!40000 ALTER TABLE `yc_guestbook` DISABLE KEYS */;
/*!40000 ALTER TABLE `yc_guestbook` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yc_links`
--

DROP TABLE IF EXISTS `yc_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yc_links` (
  `link_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `link_name` varchar(150) NOT NULL DEFAULT '' COMMENT '链接名称',
  `link_logo` varchar(255) NOT NULL DEFAULT '' COMMENT '链接图标',
  `link_url` varchar(255) NOT NULL DEFAULT '' COMMENT '链接',
  `link_order` tinyint(5) unsigned NOT NULL DEFAULT '100' COMMENT '排序编号',
  `link_type` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '1站内链接2外网链接',
  `link_show` tinyint(1) unsigned NOT NULL DEFAULT '1' COMMENT '0隐藏1正常显示',
  `link_addtime` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`link_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='友情链接';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yc_links`
--

LOCK TABLES `yc_links` WRITE;
/*!40000 ALTER TABLE `yc_links` DISABLE KEYS */;
/*!40000 ALTER TABLE `yc_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yc_menu`
--

DROP TABLE IF EXISTS `yc_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yc_menu` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '菜单ID',
  `title` varchar(50) NOT NULL DEFAULT '' COMMENT '标题',
  `type` varchar(10) NOT NULL DEFAULT 'admin' COMMENT '菜单类别（admin后台，user会员中心）',
  `icon` varchar(50) NOT NULL DEFAULT '' COMMENT '图标',
  `pid` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '上级分类ID',
  `sort` int(5) unsigned NOT NULL DEFAULT '100' COMMENT '排序（同级有效）',
  `url` varchar(255) NOT NULL DEFAULT '' COMMENT '链接地址',
  `hide` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否隐藏0显示1隐藏',
  `tip` text NOT NULL DEFAULT '' COMMENT '提示',
  `group` varchar(50) DEFAULT '' COMMENT '分组',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  `is_dev` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '是否仅开发者模式可见',
  `status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '菜单状态:0正常1删除',
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `status` (`status`)
) ENGINE=MyISAM AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='后台菜单管理';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yc_menu`
--

LOCK TABLES `yc_menu` WRITE;
/*!40000 ALTER TABLE `yc_menu` DISABLE KEYS */;
INSERT INTO `yc_menu` VALUES (1,'后台首页','admin','',0,1,'admin/index/index',0,'','',1486800730,0,0),(2,'系统管理','admin','',0,2,'',0,'','',1486800730,0,0),(3,'栏目管理','admin','',0,3,'',0,'','',1486800730,0,0),(4,'内容管理','admin','',0,4,'',0,'','',1486800730,0,0),(5,'模型管理','admin','',0,5,'',0,'','',1486800730,0,0),(6,'权限管理','admin','',0,6,'',0,'','',1486800730,0,0),(7,'菜单管理','admin','',0,7,'',0,'','',1486800730,0,0),(8,'用户管理','admin','',0,8,'',0,'','',1486800730,0,0),(9,'扩展管理','admin','',0,9,'',0,'','',1486800730,0,0),(10,'管理员','admin','',8,10,'admin/user/index',0,'','',1486800730,0,0),(11,'管理组','admin','',8,11,'admin/user/group',0,'','',1486800730,0,0),(12,'后台菜单','admin','',7,12,'admin/menu/index',0,'','',1486800730,0,0),(13,'前台菜单','admin','',7,13,'admin/menu/home',1,'','',1486800730,0,0);
/*!40000 ALTER TABLE `yc_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yc_module`
--

DROP TABLE IF EXISTS `yc_module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yc_module` (
  `mid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '模型名称',
  `module` varchar(50) NOT NULL DEFAULT '' COMMENT '模型英文标识',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间',
  PRIMARY KEY (`mid`),
  UNIQUE KEY `模型英文标识` (`module`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='模型表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yc_module`
--

LOCK TABLES `yc_module` WRITE;
/*!40000 ALTER TABLE `yc_module` DISABLE KEYS */;
/*!40000 ALTER TABLE `yc_module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yc_zt`
--

DROP TABLE IF EXISTS `yc_zt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yc_zt` (
  `zt_id` int(11) unsigned NOT NULL AUTO_INCREMENT COMMENT '专题id标识',
  `zt_title` varchar(100) NOT NULL DEFAULT '' COMMENT '专题标题',
  `zt_keywords` varchar(100) NOT NULL DEFAULT '' COMMENT '关键词',
  `zt_description` text NOT NULL DEFAULT '' COMMENT '描述',
  `zt_thumb` varchar(255) NOT NULL DEFAULT '' COMMENT '缩略图',
  `zt_content` text NOT NULL DEFAULT '' COMMENT '内容',
  `zt_addtime` int(11) unsigned  NOT NULL DEFAULT '0' COMMENT '发布时间',
  `zt_author` varchar(50) NOT NULL DEFAULT '' COMMENT '作者',
  `zt_view` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '查看次数',
  `zt_status` tinyint(1) unsigned NOT NULL DEFAULT '0' COMMENT '显示状态：0正常显示，1隐藏',
  `zt_order` tinyint(5) unsigned NOT NULL DEFAULT '100' COMMENT '排序',
  `zt_module` varchar(50) NOT NULL DEFAULT '' COMMENT '模板指定模型',
  `zt_template` varchar(50) NOT NULL DEFAULT '' COMMENT '专题模板',
  PRIMARY KEY (`zt_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='单页面/专题表';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yc_zt`
--

LOCK TABLES `yc_zt` WRITE;
/*!40000 ALTER TABLE `yc_zt` DISABLE KEYS */;
/*!40000 ALTER TABLE `yc_zt` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-02-17 10:57:03
