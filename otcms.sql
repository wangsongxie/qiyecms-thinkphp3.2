-- phpMyAdmin SQL Dump
-- version 4.4.15.10
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2017-07-10 14:12:19
-- 服务器版本： 5.5.54-log
-- PHP Version: 7.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `oucms`
--

-- --------------------------------------------------------

--
-- 表的结构 `otcms_admin`
--

CREATE TABLE IF NOT EXISTS `otcms_admin` (
  `admin_id` tinyint(4) NOT NULL COMMENT '管理员ID',
  `admin_username` varchar(20) NOT NULL COMMENT '管理员用户名',
  `admin_pwd` varchar(70) NOT NULL COMMENT '管理员密码',
  `admin_img` varchar(255) DEFAULT NULL COMMENT '头像',
  `admin_email` varchar(30) NOT NULL COMMENT '邮箱',
  `admin_realname` varchar(10) DEFAULT NULL COMMENT '真实姓名',
  `admin_tel` varchar(30) DEFAULT NULL COMMENT '电话号码',
  `admin_hits` int(8) NOT NULL DEFAULT '1' COMMENT '登陆次数',
  `admin_ip` varchar(20) DEFAULT NULL COMMENT 'IP地址',
  `admin_addtime` int(11) NOT NULL COMMENT '添加时间',
  `admin_mdemail` varchar(50) NOT NULL DEFAULT '0' COMMENT '传递修改密码参数加密',
  `admin_open` tinyint(2) NOT NULL DEFAULT '0' COMMENT '审核状态'
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `otcms_admin`
--

INSERT INTO `otcms_admin` (`admin_id`, `admin_username`, `admin_pwd`, `admin_img`, `admin_email`, `admin_realname`, `admin_tel`, `admin_hits`, `admin_ip`, `admin_addtime`, `admin_mdemail`, `admin_open`) VALUES
(1, 'admins', 'e5e8aeb7958cbc3427491882a0c4f9c4', '/userimg/2017-06-16/5943a65267867.jpg', 'admin@admin.com', 'admins', '18899998888', 400, '127.0.0.1', 112222233, '1a0cbaee0f6041af3922a0f4dac1a547', 1);

-- --------------------------------------------------------

--
-- 表的结构 `otcms_article`
--

CREATE TABLE IF NOT EXISTS `otcms_article` (
  `a_id` int(11) NOT NULL COMMENT '文章逻辑ID',
  `photo` varchar(64) DEFAULT '' COMMENT '文章图片',
  `a_title` varchar(128) NOT NULL COMMENT '文章标题',
  `a_remark` varchar(256) DEFAULT '' COMMENT '文章描述',
  `a_keyword` varchar(32) DEFAULT '' COMMENT '文章关键字',
  `cate_id` int(11) NOT NULL DEFAULT '1' COMMENT '文章类别',
  `create_time` int(10) NOT NULL COMMENT '文章发表时间',
  `last_time` int(10) DEFAULT NULL,
  `a_content` text NOT NULL COMMENT '文章内容',
  `a_views` int(11) NOT NULL DEFAULT '1' COMMENT '文章是否置顶',
  `a_type` int(1) NOT NULL DEFAULT '1' COMMENT '文章点击量',
  `a_red` int(1) DEFAULT '0',
  `a_from` varchar(16) NOT NULL DEFAULT '1',
  `a_writer` varchar(64) NOT NULL COMMENT '作者',
  `create_ip` varchar(16) NOT NULL,
  `laiyuan` varchar(50) DEFAULT '',
  `laiyuan_url` varchar(255) DEFAULT '',
  `state` int(1) NOT NULL,
  `video` varchar(255) DEFAULT NULL,
  `datas` text,
  `tujilist` text
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COMMENT='文章表';

--
-- 转存表中的数据 `otcms_article`
--

INSERT INTO `otcms_article` (`a_id`, `photo`, `a_title`, `a_remark`, `a_keyword`, `cate_id`, `create_time`, `last_time`, `a_content`, `a_views`, `a_type`, `a_red`, `a_from`, `a_writer`, `create_ip`, `laiyuan`, `laiyuan_url`, `state`, `video`, `datas`, `tujilist`) VALUES
(26, '', '测试', '１２３', '１２３', 8, 1499657640, 1499657691, '<p>１２３</p>', 0, 1, 1, 'Win 10', '', '113.128.69.184', '', '', 1, '', 'a:2:{s:4:"name";s:9:"１２３";s:3:"sex";s:9:"１２３";}', 'N;');

-- --------------------------------------------------------

--
-- 表的结构 `otcms_article_cate`
--

CREATE TABLE IF NOT EXISTS `otcms_article_cate` (
  `id` smallint(5) unsigned NOT NULL,
  `cate_name` varchar(32) DEFAULT NULL,
  `orderby` int(11) DEFAULT '100',
  `state` int(1) DEFAULT NULL,
  `pid` int(10) DEFAULT '0',
  `keysword` varchar(255) DEFAULT NULL,
  `miaoshu` varchar(255) DEFAULT NULL,
  `listhtml` varchar(255) DEFAULT NULL,
  `articlehtml` varchar(255) DEFAULT NULL,
  `ziduans` varchar(255) DEFAULT NULL,
  `hasvideo` int(1) DEFAULT '1',
  `hastuji` int(1) DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `otcms_article_cate`
--

INSERT INTO `otcms_article_cate` (`id`, `cate_name`, `orderby`, `state`, `pid`, `keysword`, `miaoshu`, `listhtml`, `articlehtml`, `ziduans`, `hasvideo`, `hastuji`) VALUES
(7, '新闻中心', 0, 1, 0, '', '', '', '', '', 0, 0),
(8, '最新新闻', 0, 1, 7, '', '', 'list_news.html', 'show_news.html', '姓名|name;性别|sex', 1, 1);

-- --------------------------------------------------------

--
-- 表的结构 `otcms_auth_group`
--

CREATE TABLE IF NOT EXISTS `otcms_auth_group` (
  `id` mediumint(8) unsigned NOT NULL,
  `title` char(100) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `rules` text NOT NULL,
  `addtime` int(11) NOT NULL COMMENT '添加时间'
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `otcms_auth_group`
--

INSERT INTO `otcms_auth_group` (`id`, `title`, `status`, `rules`, `addtime`) VALUES
(1, '超级管理员', 1, '1,2,6,19,110,3,4,5,15,16,90,91,92,93,17,94,95,96,97,98,18,99,100,101,102,103,83,104,107,108,109,126,127,128,129,130,132,133,134,22,23,24,55,56,143,144,145,146,58,139,140,141,142,59,138,135,136,137,60,61,147,148,149,150,62,151,152,153,154,63,64,65,66,157,1', 1212451252),
(5, '办公室', 1, '1,2,6,', 1459056252),
(6, '工程部', 1, '', 1459056396),
(7, '财务部', 1, ',', 1459056409);

-- --------------------------------------------------------

--
-- 表的结构 `otcms_auth_group_access`
--

CREATE TABLE IF NOT EXISTS `otcms_auth_group_access` (
  `uid` mediumint(8) unsigned NOT NULL,
  `group_id` mediumint(8) unsigned NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `otcms_auth_group_access`
--

INSERT INTO `otcms_auth_group_access` (`uid`, `group_id`) VALUES
(1, 1),
(7, 5),
(9, 7);

-- --------------------------------------------------------

--
-- 表的结构 `otcms_auth_rule`
--

CREATE TABLE IF NOT EXISTS `otcms_auth_rule` (
  `id` int(11) unsigned NOT NULL,
  `name` char(80) NOT NULL DEFAULT '',
  `title` char(20) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '1',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `css` varchar(20) NOT NULL COMMENT '样式',
  `condition` char(100) NOT NULL DEFAULT '',
  `pid` int(11) NOT NULL DEFAULT '0' COMMENT '父栏目ID',
  `sort` int(11) NOT NULL DEFAULT '0' COMMENT '排序',
  `addtime` int(11) NOT NULL DEFAULT '0' COMMENT '添加时间'
) ENGINE=MyISAM AUTO_INCREMENT=241 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `otcms_auth_rule`
--

INSERT INTO `otcms_auth_rule` (`id`, `name`, `title`, `type`, `status`, `css`, `condition`, `pid`, `sort`, `addtime`) VALUES
(1, 'Sys', '系统管理', 1, 1, 'fa-gear', '', 0, 0, 1446535750),
(2, 'Sys/sys', '系统设置', 1, 1, '', '', 1, 0, 1446535789),
(3, 'Database', '数据库管理', 1, 1, 'fa-database', '', 0, 0, 1446535805),
(4, 'Database/database', '数据库备份', 1, 1, '', '', 3, 50, 1446535750),
(5, 'Database/import', '数据库下载', 1, 1, '', '', 3, 50, 1446535834),
(6, 'Sys/sys', '站点设置', 1, 1, '', '', 2, 0, 1446535843),
(8, 'Sys/admin_list', '用户管理', 1, 1, '', '', 1, 0, 1446535750),
(9, 'Sys/admin_group', '角色管理', 1, 1, '', '', 1, 0, 1446535750),
(10, 'Sys/admin_rule', '菜单管理', 1, 1, '', '', 1, 1, 1446535750),
(11, 'Sys/emailsys', '邮件设置', 1, 1, '', '', 1, 0, 1446535750),
(12, 'Sys/admin_group_access', '权限设置', 1, 1, '', '', 9, 50, 1456989549),
(13, 'Sys/pwd', '修改密码', 1, 1, '', '', 2, 50, 1457018382),
(207, 'Logs', '日志管理', 1, 1, 'fa-file-text-o', '', 0, 50, 1459140389),
(208, 'Logs/logs_list', '操作日志', 1, 1, '', '', 207, 50, 1459140402),
(210, 'Member/index', '会员列表', 1, 1, '', '', 209, 50, 1459151063),
(211, 'Logs/visitor_list', '访客日志', 1, 1, '', '', 207, 50, 1459177577),
(212, 'Sys/admin_list_add', '添加用户', 1, 1, '', '', 8, 50, 1459944362),
(213, 'Sys/admin_list_edit', '编辑用户', 1, 1, '', '', 8, 50, 1459944382),
(214, 'Sys/admin_list_del', '删除用户', 1, 1, '', '', 8, 50, 1459944403),
(215, 'Sys/admin_group', '添加角色', 1, 1, '', '', 9, 50, 1459944558),
(216, 'Sys/admin_group_edit', '编辑角色', 1, 1, '', '', 9, 50, 1459944593),
(217, 'Sys/admin_group_del', '删除角色', 1, 1, '', '', 9, 50, 1459944616),
(218, 'Sys/admin_rule_add', '添加菜单', 1, 1, '', '', 10, 50, 1459944692),
(219, 'Sys/admin_rule_edit', '编辑菜单', 1, 1, '', '', 10, 50, 1459944710),
(220, 'Sys/admin_rule_del', '删除菜单', 1, 1, '', '', 10, 50, 1459944732),
(221, 'Sys/ruleorder', '菜单排序', 1, 1, '', '', 10, 50, 1459944801),
(222, 'Sys/emailsys', '保存邮件设置', 1, 1, '', '', 11, 50, 1459944841),
(223, 'Article', '文章管理', 1, 1, 'fa fa-paste', '', 0, 4, 1497612542),
(224, 'Article/index_cate', '文章分类', 1, 1, '', '', 223, 50, 1497612634),
(225, 'Article/index', '文章列表', 1, 1, '', '', 223, 50, 1497612817),
(226, 'Article/add_cate', '添加分类', 1, 1, '', '', 224, 50, 1497612877),
(227, 'Article/edit_cate', '编辑分类', 1, 1, '', '', 224, 50, 1497612901),
(228, 'Article/del_cate', '删除分类', 1, 1, '', '', 224, 50, 1497612923),
(229, 'Article/cate_state', '分类状态', 1, 1, '', '', 224, 50, 1497612946),
(230, 'Article/add_article', '添加文章', 1, 1, '', '', 225, 50, 1497613075),
(231, 'Article/edit_article', '编辑文章', 1, 1, '', '', 225, 50, 1497613107),
(232, 'Article/del_article', '删除文章', 1, 1, '', '', 225, 50, 1497613130),
(233, 'Article/article_state', '文章状态', 1, 1, '', '', 225, 50, 1497613161),
(234, 'Said', '单页管理', 1, 1, 'fa fa-file-o', '', 0, 5, 1497667127),
(235, 'Said/index', '单页列表', 1, 1, '', '', 234, 50, 1497667338),
(236, 'Said/add', '添加单页', 1, 1, '', '', 235, 50, 1497667380),
(237, 'Said/edit', '编辑单页', 1, 1, '', '', 235, 50, 1497667416),
(238, 'Said/del', '删除单页', 1, 1, '', '', 235, 50, 1497667445),
(239, 'Said/state', '单页状态', 1, 1, '', '', 235, 50, 1497667475),
(240, 'Sys/carousel_list', '轮播管理', 1, 1, '', '', 1, 50, 1498121569);

-- --------------------------------------------------------

--
-- 表的结构 `otcms_carousel_list`
--

CREATE TABLE IF NOT EXISTS `otcms_carousel_list` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `addtime` int(11) DEFAULT NULL,
  `state` int(11) DEFAULT NULL,
  `orderby` int(5) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `otcms_carousel_list`
--

INSERT INTO `otcms_carousel_list` (`id`, `title`, `img`, `addtime`, `state`, `orderby`, `note`, `url`) VALUES
(1, 'banner1', '/carousel/2017-07-09/5962043ad5cdc.jpg', 1498122100, 1, 1, '123123asd', ''),
(2, 'banner2', '/carousel/2017-07-09/596204460df4a.jpg', 1499466333, 1, 2, '2', '#'),
(3, 'banner3', '/carousel/2017-07-09/5962045c03ea4.jpg', 1499595868, 1, 3, '', ''),
(4, 'banner4', '/carousel/2017-07-09/5962046cf1d89.jpg', 1499595884, 1, 6, '', '');











INSERT INTO `otcms_tel` (`id`, `tel`, `types`, `status`) VALUES
(1, '400-123-5661', 'AAAA', ),
(2, '400-123-5662', 'ABCABC', ),
(3, '400-123-5663', 'ABCD', ),
(4, '400-123-5664', 'ABABAB', ),
(5, '400-123-5665', 'AABBCC',),
(6, '400-123-5666', 'AABAA',),
(7, '400-123-5667', 'AAAAA', 0, ),
(8, '400-123-5668', 'AAABBB', 0, ),
(9, '400-123-5669', 'ABBB', 0, ),
(10, '400-123-5671', 'AABB', 0, ),
(11, '400-123-5672', 'AABCC', 0, ),

-- --------------------------------------------------------

--
-- 表的结构 `otcms_keyword`
--

CREATE TABLE IF NOT EXISTS `otcms_keyword` (
  `keyword_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `pid` int(11) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `otcms_keyword`
--

INSERT INTO `otcms_keyword` (`keyword_id`, `name`, `pid`) VALUES
(1, '销售渠道', 0),
(2, '网上', 1),
(3, '外呼', 1),
(4, '朋友介绍', 1),
(5, '老客户介绍', 1),
(6, '线下跑单', 1),
(7, '做活动', 1),
(8, '小区割接', 1);

-- --------------------------------------------------------

--
-- 表的结构 `otcms_log`
--

CREATE TABLE IF NOT EXISTS `otcms_log` (
  `log_id` int(11) NOT NULL,
  `admin_id` int(11) DEFAULT NULL COMMENT '用户ID',
  `admin_name` varchar(50) DEFAULT NULL COMMENT '用户姓名',
  `description` varchar(300) DEFAULT NULL COMMENT '描述',
  `ip` char(60) DEFAULT NULL COMMENT 'IP地址',
  `status` tinyint(1) DEFAULT NULL COMMENT '1 成功 2 失败',
  `add_time` int(11) DEFAULT NULL COMMENT '添加时间'
) ENGINE=MyISAM AUTO_INCREMENT=658 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `otcms_log`
--

INSERT INTO `otcms_log` (`log_id`, `admin_id`, `admin_name`, `description`, `ip`, `status`, `add_time`) VALUES
(644, 1, 'admins', '用户登录', NULL, 1, 1499356002),
(645, 1, 'admins', '用户登录', NULL, 1, 1499356207),
(646, 1, 'admins', '用户登录', NULL, 1, 1499356675),
(647, 1, 'admins', '用户登录', NULL, 1, 1499460281),
(648, 1, 'admins', '用户登录', NULL, 1, 1499483523),
(649, 1, 'admins', '用户登录', NULL, 1, 1499544467),
(650, 1, 'admins', '用户登录', NULL, 1, 1499576112),
(651, 1, 'admins', '用户登录', NULL, 1, 1499594552),
(652, 1, 'admins', '用户登录', NULL, 1, 1499594866),
(653, 1, 'admins', '用户登录', NULL, 1, 1499594911),
(654, 1, 'admins', '用户登录', NULL, 1, 1499655978),
(655, 1, 'admins', '用户登录', NULL, 1, 1499656446),
(656, 1, 'admins', '用户登录', NULL, 1, 1499657271),
(657, 1, 'admins', '用户登录', NULL, 1, 1499657754);

-- --------------------------------------------------------

--
-- 表的结构 `otcms_member_group`
--

CREATE TABLE IF NOT EXISTS `otcms_member_group` (
  `groupid` int(11) NOT NULL COMMENT '部门ID',
  `groupname` varchar(30) NOT NULL COMMENT '部门名称',
  `open` int(11) NOT NULL DEFAULT '0' COMMENT '状态',
  `note` varchar(255) NOT NULL COMMENT '备注',
  `order` int(11) NOT NULL COMMENT '排序'
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `otcms_member_group`
--

INSERT INTO `otcms_member_group` (`groupid`, `groupname`, `open`, `note`, `order`) VALUES
(7, '办公室', 1, '', 50),
(8, '营销部', 1, '', 50),
(9, '工程部', 1, '', 50),
(10, '财务部', 1, '', 50),
(11, '人事部', 1, '', 50),
(12, '技术部', 1, '', 50);

-- --------------------------------------------------------

--
-- 表的结构 `otcms_member_list`
--

CREATE TABLE IF NOT EXISTS `otcms_member_list` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL COMMENT '用户名',
  `province` int(6) NOT NULL COMMENT '城市',
  `city` int(6) NOT NULL COMMENT '市县',
  `town` int(6) NOT NULL COMMENT '乡镇',
  `sex` tinyint(2) NOT NULL DEFAULT '3' COMMENT '1=男  2=女  3=保密',
  `headpic` varchar(100) NOT NULL DEFAULT '' COMMENT '会员头像路径',
  `phone` varchar(11) DEFAULT NULL COMMENT '电话',
  `email` varchar(50) NOT NULL DEFAULT '' COMMENT '邮箱',
  `state` tinyint(2) NOT NULL DEFAULT '0' COMMENT '状态  0关闭  1开启',
  `birthdate` int(11) NOT NULL COMMENT '出生日期',
  `create_time` int(11) DEFAULT NULL COMMENT '创建时间',
  `address` varchar(255) DEFAULT NULL COMMENT '会员地址',
  `note` varchar(255) DEFAULT NULL COMMENT '备注'
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `otcms_member_list`
--

INSERT INTO `otcms_member_list` (`id`, `username`, `province`, `city`, `town`, `sex`, `headpic`, `phone`, `email`, `state`, `birthdate`, `create_time`, `address`, `note`) VALUES
(1, '242', 0, 0, 0, 3, '/userimg/2016-09-09/57d2854ddd7d9.png', '424', '2452', 1, 1473177600, 1473413506, '2424', '5242'),
(2, '2452', 0, 0, 0, 3, '/userimg/2016-09-09/57d28474cb31f.png', '42452', '2452', 1, 1473350400, 1473414278, '4245245', '24'),
(3, '2452', 0, 0, 0, 3, '', '254', '254', 1, 1473782400, 1473735486, '245', '45'),
(4, '635', 0, 0, 0, 1, '', '6356', '65', 1, 1474473600, 1473735496, '35', '63'),
(5, '8578', 0, 0, 0, 1, '', '785', '875', 1, 1474905600, 1473735506, '785', '78'),
(6, '9899', 0, 0, 0, 1, '', '224', '63', 1, 1473782400, 1473735516, '52', '45'),
(7, '3265', 0, 0, 0, 1, '', '356', '356', 1, 1473696000, 1473735526, '356', '356'),
(8, '656', 0, 0, 0, 3, '', '56', '356', 1, 1474387200, 1473735534, '356', '356'),
(9, '989', 0, 0, 0, 3, '', '356', '356', 1, 1473177600, 1473735543, '356', '356'),
(10, '8963', 0, 0, 0, 3, '', '56', '3563', 1, 1474387200, 1473735550, '3563', '56'),
(11, '8524', 0, 0, 0, 3, '', '452', '2452', 1, 1472572800, 1473735559, '452', '45');

-- --------------------------------------------------------

--
-- 表的结构 `otcms_member_lvl`
--

CREATE TABLE IF NOT EXISTS `otcms_member_lvl` (
  `lvl_id` int(11) NOT NULL COMMENT '等级ID',
  `lvl_name` varchar(20) NOT NULL COMMENT '等级名称',
  `lvl_note` varchar(255) DEFAULT NULL,
  `lvl_open` varchar(255) DEFAULT NULL,
  `lvl_order` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `otcms_member_lvl`
--

INSERT INTO `otcms_member_lvl` (`lvl_id`, `lvl_name`, `lvl_note`, `lvl_open`, `lvl_order`) VALUES
(8, '总经理', '', '1', '50'),
(9, '技术经理', '', '1', '50'),
(10, '项目经理', '', '1', '50'),
(11, '销售员', '', '1', '50'),
(12, '录单员', '', '1', '50'),
(13, '工程人员', '', '1', '50'),
(14, '人事经理', '', '1', '50'),
(15, '财务经理', '', '1', '50'),
(16, '销售部经理', '', '1', '50'),
(17, '后台支撑', '', '1', '50');

-- --------------------------------------------------------

--
-- 表的结构 `otcms_said`
--

CREATE TABLE IF NOT EXISTS `otcms_said` (
  `s_id` int(11) NOT NULL COMMENT '说说逻辑排序',
  `s_content` text NOT NULL COMMENT '说说内容',
  `s_img` varchar(64) DEFAULT NULL,
  `s_from` varchar(16) NOT NULL DEFAULT '1',
  `s_writer` varchar(32) NOT NULL COMMENT '说说作者',
  `s_view` int(11) NOT NULL DEFAULT '1' COMMENT '说说的显推',
  `create_ip` varchar(16) NOT NULL COMMENT '说说ip',
  `create_time` int(10) NOT NULL COMMENT '说说发表时间',
  `title` varchar(255) DEFAULT NULL,
  `articlehtml` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `remark` varchar(255) DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='说说表';

-- --------------------------------------------------------

--
-- 表的结构 `otcms_sys`
--

CREATE TABLE IF NOT EXISTS `otcms_sys` (
  `sys_id` int(36) unsigned NOT NULL,
  `sys_name` char(36) NOT NULL DEFAULT '',
  `sys_url` varchar(36) NOT NULL DEFAULT '',
  `sys_title` varchar(200) NOT NULL,
  `sys_key` varchar(200) NOT NULL,
  `sys_des` varchar(200) NOT NULL,
  `email_open` tinyint(2) NOT NULL COMMENT '邮箱发送是否开启',
  `email_name` varchar(50) NOT NULL COMMENT '发送邮箱账号',
  `email_pwd` varchar(50) NOT NULL COMMENT '发送邮箱密码',
  `email_smtpname` varchar(50) NOT NULL COMMENT 'smtp服务器账号',
  `email_emname` varchar(30) NOT NULL COMMENT '邮件名',
  `email_rename` varchar(30) NOT NULL COMMENT '发件人姓名',
  `sys_tongji` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `otcms_sys`
--

INSERT INTO `otcms_sys` (`sys_id`, `sys_name`, `sys_url`, `sys_title`, `sys_key`, `sys_des`, `email_open`, `email_name`, `email_pwd`, `email_smtpname`, `email_emname`, `email_rename`, `sys_tongji`) VALUES
(1, '网站管理台', 'http://www.outeng.net', 'OUTENG', 'OUTENG', 'OUTENG', 1, 'admin@outeng.net', '', 'smtp.qq.com', 'OUTENG', '欧腾', '<script type="text/javascript">var cnzz_protocol = (("https:" == document.location.protocol) ? " https://" : " http://");document.write(unescape("%3Cspan id=''cnzz_stat_icon_1253472858''%3E%3C/span%3E%3Cscript src=''" + cnzz_protocol + "v1.cnzz.com/stat.php%3Fid%3D1253472858%26online%3D1'' type=''text/javascript''%3E%3C/script%3E"));</script>');

-- --------------------------------------------------------

--
-- 表的结构 `otcms_visitor_logs`
--

CREATE TABLE IF NOT EXISTS `otcms_visitor_logs` (
  `c_id` int(11) NOT NULL,
  `c_ip` varchar(20) DEFAULT NULL,
  `c_os` varchar(255) DEFAULT NULL COMMENT '真实IP',
  `c_browser` varchar(20) DEFAULT NULL,
  `c_url` varchar(255) DEFAULT NULL,
  `c_address` varchar(255) DEFAULT NULL COMMENT '地址',
  `add_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `otcms_admin`
--
ALTER TABLE `otcms_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `otcms_article`
--
ALTER TABLE `otcms_article`
  ADD PRIMARY KEY (`a_id`),
  ADD KEY `a_title` (`a_title`);

--
-- Indexes for table `otcms_article_cate`
--
ALTER TABLE `otcms_article_cate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otcms_auth_group`
--
ALTER TABLE `otcms_auth_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otcms_auth_group_access`
--
ALTER TABLE `otcms_auth_group_access`
  ADD UNIQUE KEY `uid_group_id` (`uid`,`group_id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `group_id` (`group_id`);

--
-- Indexes for table `otcms_auth_rule`
--
ALTER TABLE `otcms_auth_rule`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otcms_carousel_list`
--
ALTER TABLE `otcms_carousel_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `otcms_keyword`
--
ALTER TABLE `otcms_keyword`
  ADD PRIMARY KEY (`keyword_id`);

--
-- Indexes for table `otcms_log`
--
ALTER TABLE `otcms_log`
  ADD PRIMARY KEY (`log_id`);

--
-- Indexes for table `otcms_member_group`
--
ALTER TABLE `otcms_member_group`
  ADD PRIMARY KEY (`groupid`);

--
-- Indexes for table `otcms_member_list`
--
ALTER TABLE `otcms_member_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_member_list_id` (`id`) USING BTREE;

--
-- Indexes for table `otcms_member_lvl`
--
ALTER TABLE `otcms_member_lvl`
  ADD PRIMARY KEY (`lvl_id`);

--
-- Indexes for table `otcms_said`
--
ALTER TABLE `otcms_said`
  ADD PRIMARY KEY (`s_id`),
  ADD KEY `s_id` (`s_id`);

--
-- Indexes for table `otcms_sys`
--
ALTER TABLE `otcms_sys`
  ADD PRIMARY KEY (`sys_id`);

--
-- Indexes for table `otcms_visitor_logs`
--
ALTER TABLE `otcms_visitor_logs`
  ADD PRIMARY KEY (`c_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `otcms_admin`
--
ALTER TABLE `otcms_admin`
  MODIFY `admin_id` tinyint(4) NOT NULL AUTO_INCREMENT COMMENT '管理员ID',AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `otcms_article`
--
ALTER TABLE `otcms_article`
  MODIFY `a_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '文章逻辑ID',AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `otcms_article_cate`
--
ALTER TABLE `otcms_article_cate`
  MODIFY `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `otcms_auth_group`
--
ALTER TABLE `otcms_auth_group`
  MODIFY `id` mediumint(8) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `otcms_auth_rule`
--
ALTER TABLE `otcms_auth_rule`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=241;
--
-- AUTO_INCREMENT for table `otcms_carousel_list`
--
ALTER TABLE `otcms_carousel_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `otcms_keyword`
--
ALTER TABLE `otcms_keyword`
  MODIFY `keyword_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `otcms_log`
--
ALTER TABLE `otcms_log`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=658;
--
-- AUTO_INCREMENT for table `otcms_member_group`
--
ALTER TABLE `otcms_member_group`
  MODIFY `groupid` int(11) NOT NULL AUTO_INCREMENT COMMENT '部门ID',AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `otcms_member_list`
--
ALTER TABLE `otcms_member_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `otcms_member_lvl`
--
ALTER TABLE `otcms_member_lvl`
  MODIFY `lvl_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '等级ID',AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `otcms_said`
--
ALTER TABLE `otcms_said`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '说说逻辑排序',AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `otcms_visitor_logs`
--
ALTER TABLE `otcms_visitor_logs`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
