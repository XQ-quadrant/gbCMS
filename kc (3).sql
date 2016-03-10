-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 2016-03-10 17:15:54
-- 服务器版本： 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kc`
--

DELIMITER $$
--
-- 存储过程
--
CREATE DEFINER=`gb`@`localhost` PROCEDURE `index_find` (IN `a_id` INT UNSIGNED, OUT `contents` TEXT)  begin
declare mid int unsigned;
declare model_name char(64);
declare atcid int unsigned;
SET @var_name = ex;
#select cate,title,createtime,views,model_id into mid from cate_atc where id=a_id;
select atc_id,model_id into atcid,mid from cate_atc where id=a_id;

select `name` Into @var_name from model where id = mid;
select content into contents from model_name where id = atcid; 
end$$

--
-- 函数
--
CREATE DEFINER=`gb`@`localhost` FUNCTION `ind1` () RETURNS VARCHAR(30) CHARSET utf8mb4 return Now()$$

DELIMITER ;

-- --------------------------------------------------------

--
-- 表的结构 `cate`
--

CREATE TABLE `cate` (
  `id` int(11) NOT NULL,
  `cindex` varchar(250) NOT NULL COMMENT '唯一标识',
  `name` varchar(250) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `model` text,
  `view_index` tinytext,
  `pre_cate` int(11) DEFAULT NULL,
  `level` smallint(6) NOT NULL DEFAULT '250',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `uri` tinytext COMMENT 'uri'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `cate_atc`
--

CREATE TABLE `cate_atc` (
  `id` int(11) NOT NULL,
  `cate` int(11) NOT NULL,
  `model_id` int(11) NOT NULL COMMENT '模型ID',
  `title` varchar(250) DEFAULT NULL COMMENT '文章标题',
  `atc_id` int(11) NOT NULL COMMENT '文章ID',
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '状态标识',
  `createtime` datetime DEFAULT NULL COMMENT '创建时间',
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时刻'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `cindex_id` int(11) NOT NULL COMMENT '目录引索id',
  `user_id` int(11) NOT NULL COMMENT '发布者id',
  `content` tinytext NOT NULL COMMENT '内容',
  `recieve_id` int(11) DEFAULT NULL COMMENT '回复帖id',
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `document`
--

CREATE TABLE `document` (
  `id` int(11) NOT NULL,
  `index_id` int(11) NOT NULL COMMENT 'cate_atc id',
  `title` varchar(250) NOT NULL COMMENT '标题',
  `author` varchar(100) DEFAULT NULL COMMENT '作者',
  `editor` int(11) DEFAULT NULL COMMENT '编辑',
  `content` text NOT NULL COMMENT '正文'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `manager`
--

CREATE TABLE `manager` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `icon` tinytext NOT NULL COMMENT 'icon_url',
  `IP` char(15) NOT NULL,
  `signature` varchar(60) NOT NULL COMMENT '签名档'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `model`
--

CREATE TABLE `model` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL COMMENT '名称',
  `identity` varchar(250) NOT NULL COMMENT '唯一标识',
  `link` tinytext COMMENT '关联信息',
  `list_extra` tinytext NOT NULL,
  `view_detail` tinytext COMMENT '模型视图',
  `view_edit` tinytext COMMENT '编辑视图',
  `view_add` varchar(250) DEFAULT NULL COMMENT '新增视图',
  `view_other` tinytext,
  `rules` text NOT NULL COMMENT '模型验证规则',
  `status` smallint(6) NOT NULL DEFAULT '1' COMMENT '等级状态',
  `createtime` datetime DEFAULT NULL COMMENT '创建时间',
  `updatetime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '更新时间'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(100) DEFAULT NULL COMMENT '编辑',
  `cate` int(11) NOT NULL,
  `type` varchar(250) NOT NULL,
  `views` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `picgrid`
--

CREATE TABLE `picgrid` (
  `id` int(11) NOT NULL,
  `savepath` tinytext NOT NULL,
  `title` varchar(250) NOT NULL,
  `savename` tinytext NOT NULL,
  `content` text NOT NULL,
  `author` varchar(250) NOT NULL,
  `createtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `size` int(11) NOT NULL,
  `type` varchar(100) NOT NULL,
  `ext` varchar(100) NOT NULL,
  `encrypt` tinytext
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `Race`
--

CREATE TABLE `Race` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL COMMENT '竞赛名称',
  `organization` varchar(250) NOT NULL COMMENT '承办学院',
  `leader` varchar(50) NOT NULL COMMENT '领队老师',
  `introduce` text NOT NULL COMMENT '大赛简介',
  `rule` text NOT NULL COMMENT '赛事规则',
  `expecteddate` date NOT NULL COMMENT '竞赛时间',
  `contacts` date NOT NULL COMMENT '联系方式',
  `website` int(11) NOT NULL COMMENT '官方网址'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `smatch`
--

CREATE TABLE `smatch` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `create_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `user_id` varchar(15) NOT NULL,
  `password` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `sex` enum('男','女','不明','') NOT NULL,
  `birthday` date DEFAULT NULL,
  `college` varchar(50) DEFAULT NULL,
  `major` varchar(50) DEFAULT NULL,
  `class` varchar(50) DEFAULT NULL,
  `native` varchar(250) DEFAULT NULL,
  `politics` varchar(250) DEFAULT NULL,
  `address` tinytext,
  `person_id` varchar(50) NOT NULL,
  `tel` char(20) NOT NULL,
  `email_t` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `team`
--

CREATE TABLE `team` (
  `id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `uid` int(11) NOT NULL,
  `content` text NOT NULL,
  `race` varchar(100) NOT NULL,
  `limit_member` smallint(6) NOT NULL,
  `already_member` smallint(6) NOT NULL,
  `connect` tinytext,
  `orienting` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `uindex`
--

CREATE TABLE `uindex` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `mid` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `password` tinytext NOT NULL,
  `email` varchar(250) DEFAULT NULL,
  `power` int(11) NOT NULL,
  `status` int(10) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cate`
--
ALTER TABLE `cate`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index` (`cindex`);

--
-- Indexes for table `cate_atc`
--
ALTER TABLE `cate_atc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cate` (`cate`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `title` (`title`);

--
-- Indexes for table `picgrid`
--
ALTER TABLE `picgrid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smatch`
--
ALTER TABLE `smatch`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uindex`
--
ALTER TABLE `uindex`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `cate`
--
ALTER TABLE `cate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- 使用表AUTO_INCREMENT `cate_atc`
--
ALTER TABLE `cate_atc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;
--
-- 使用表AUTO_INCREMENT `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- 使用表AUTO_INCREMENT `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;
--
-- 使用表AUTO_INCREMENT `model`
--
ALTER TABLE `model`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- 使用表AUTO_INCREMENT `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- 使用表AUTO_INCREMENT `picgrid`
--
ALTER TABLE `picgrid`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
--
-- 使用表AUTO_INCREMENT `smatch`
--
ALTER TABLE `smatch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- 使用表AUTO_INCREMENT `student`
--
ALTER TABLE `student`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `team`
--
ALTER TABLE `team`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- 使用表AUTO_INCREMENT `uindex`
--
ALTER TABLE `uindex`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;
--
-- 限制导出的表
--

--
-- 限制表 `cate_atc`
--
ALTER TABLE `cate_atc`
  ADD CONSTRAINT `cate_atc_ibfk_1` FOREIGN KEY (`cate`) REFERENCES `cate` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
