-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 21, 2017 at 07:14 PM
-- Server version: 5.6.33-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `sparxmgnt_CSS5811`
--

-- --------------------------------------------------------

--
-- Table structure for table `ld_adminlevel`
--

DROP TABLE IF EXISTS `ld_adminlevel`;
CREATE TABLE IF NOT EXISTS `ld_adminlevel` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `ld_adminlevel`
--

INSERT INTO `ld_adminlevel` (`id`, `name`, `status`) VALUES
(-1, 'admin', '1'),
(18, 'TEST1', '1'),
(19, 'TEST12', '1'),
(21, 'Rajesh Yadav', '1');

-- --------------------------------------------------------

--
-- Table structure for table `ld_adminlogin`
--

DROP TABLE IF EXISTS `ld_adminlogin`;
CREATE TABLE IF NOT EXISTS `ld_adminlogin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `role_id` int(10) unsigned NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(250) NOT NULL,
  `emailId` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `userImage` varchar(255) NOT NULL,
  `about` text NOT NULL,
  `hash` varchar(250) NOT NULL,
  `adminLevelId` int(5) NOT NULL DEFAULT '0',
  `lastLogin` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `addDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `addedBy` tinyint(2) NOT NULL DEFAULT '0',
  `modDate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modBy` tinyint(2) NOT NULL DEFAULT '0',
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `ld_adminlogin`
--

INSERT INTO `ld_adminlogin` (`id`, `role_id`, `first_name`, `last_name`, `username`, `password`, `emailId`, `mobile`, `userImage`, `about`, `hash`, `adminLevelId`, `lastLogin`, `addDate`, `addedBy`, `modDate`, `modBy`, `status`, `deleted_at`) VALUES
(1, 1, 'Sean', 'Rock', 'admin', '9f5e50d369f302c14743ea09f8cc83b6:d4', 'corephp0@gmail.com', '', 'avatar_33e005debaabc5c7bc740c01f2cd4bea.jpeg', '', '6cb3ae1204d48d623f889eed034dd490', -1, '2017-02-21 12:25:48', '2013-08-06 13:41:09', 1, '2015-02-27 03:07:26', 0, '1', NULL),
(24, 22, 'Alex', 'Sparx', 'rakesh', '4832735d833b71a73c62b1e29abc434a:d4', 'rakesh.kumar@sparxitsolutions.com', '', 'avatar_d474a47aedf69abdb90077266537561e.png', '', '3a344767649e8b800c52d28562b6079b', 0, '2017-02-06 06:02:12', '2017-02-02 05:00:31', 0, '2017-02-06 04:58:11', 1, '1', NULL),
(25, 1, 'Sean', 'Rock', 'seanrock', '4832735d833b71a73c62b1e29abc434a:d4', 'sean@sparxitsolutions.com', '', '', '', 'd7234d6b623c671c606ab62fa99060f5', 0, '2017-02-02 07:24:30', '2017-02-02 06:43:00', 0, '2017-02-02 07:24:12', 24, '1', NULL),
(26, 19, 'Amit', 'Kumar', 'amitk', '4832735d833b71a73c62b1e29abc434a:d4', 'amit@sparxitsolutions.com', '', '', '', 'd59437a69dc5981f32288059fd52912d', 0, '0000-00-00 00:00:00', '2017-02-02 06:45:45', 24, '2017-02-02 06:46:10', 24, '1', NULL),
(27, 19, 'Sean', 'Test', 'seantest', '2a997a5eab038193212aa1e568d1951f:d4', 'testsean@sparxitsolutions.com', '', '', '', 'f898e029c7caac4a0de53cb05cfd1899', 0, '0000-00-00 00:00:00', '2017-02-03 10:39:57', 1, '0000-00-00 00:00:00', 0, '0', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ld_adminpermission`
--

DROP TABLE IF EXISTS `ld_adminpermission`;
CREATE TABLE IF NOT EXISTS `ld_adminpermission` (
  `adminLevelId` int(11) NOT NULL DEFAULT '0',
  `menuid` int(5) NOT NULL DEFAULT '0',
  `add_record` enum('0','1') DEFAULT '0',
  `edit_record` enum('0','1') DEFAULT '0',
  `delete_record` enum('0','1') DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ld_adminpermission`
--

INSERT INTO `ld_adminpermission` (`adminLevelId`, `menuid`, `add_record`, `edit_record`, `delete_record`) VALUES
(-1, 42, '1', '1', '1'),
(-1, 20, '1', '1', '1'),
(-1, 19, NULL, NULL, NULL),
(-1, 41, '1', '1', '1'),
(-1, 40, '1', '1', '1'),
(-1, 39, '1', '1', '1'),
(-1, 35, '1', '1', '1'),
(-1, 34, '1', '1', '1'),
(-1, 33, '1', '1', '1'),
(-1, 32, '1', '1', '1'),
(-1, 30, '1', '1', '1'),
(-1, 29, '1', '1', '1'),
(-1, 28, '1', '1', '1'),
(-1, 27, '1', '1', '1'),
(-1, 18, '1', '1', '1'),
(-1, 16, '1', '1', '1'),
(-1, 15, '1', '1', '1'),
(-1, 14, '1', '1', '1'),
(-1, 12, '1', '1', '1'),
(-1, 9, '1', '1', '1'),
(-1, 8, '1', '1', '1'),
(-1, 7, '1', '1', '1'),
(-1, 6, NULL, NULL, NULL),
(-1, 5, '1', '1', '1'),
(-1, 4, '1', '1', '1'),
(-1, 2, NULL, NULL, NULL),
(-1, 1, NULL, NULL, NULL),
(-1, 43, '1', '1', '1'),
(-1, 44, '1', '1', '1'),
(-1, 45, '1', '1', '1'),
(-1, 46, '1', '1', '1'),
(-1, 46, '1', '1', '1'),
(16, 44, '1', '1', '1'),
(16, 45, '1', '1', '1'),
(19, 1, NULL, NULL, NULL),
(19, 2, NULL, NULL, NULL),
(19, 4, '1', '1', '1'),
(19, 5, '1', '1', '1'),
(19, 44, NULL, NULL, NULL),
(19, 45, '1', '1', '1'),
(19, 46, '1', '1', '1'),
(18, 1, NULL, NULL, NULL),
(18, 2, NULL, NULL, NULL),
(18, 4, '1', '1', '1'),
(18, 5, '1', '1', '1'),
(18, 44, NULL, NULL, NULL),
(18, 45, '1', '1', '1'),
(18, 46, '1', '1', '1'),
(-1, 47, '1', '1', '1'),
(-1, 48, '1', '1', '1'),
(-1, 49, '1', '1', '1'),
(-1, 50, '1', '1', '1'),
(21, 1, NULL, NULL, NULL),
(21, 2, NULL, NULL, NULL),
(21, 4, '1', '1', '1'),
(21, 5, '1', '1', '1'),
(-1, 51, '1', '1', '1'),
(-1, 52, '1', '1', '1'),
(-1, 53, '1', '1', '1'),
(-1, 54, '1', '1', '1'),
(-1, 55, '1', '1', '1'),
(-1, 56, '1', '1', '1'),
(-1, 57, '1', '1', '1'),
(-1, 58, '1', '1', '1'),
(-1, 59, '1', '1', '1'),
(-1, 60, '1', '1', '1'),
(-1, 60, '1', '1', '1'),
(-1, 61, '1', '1', '1'),
(-1, 62, '1', '1', '1'),
(-1, 63, '1', '1', '1'),
(-1, 64, '1', '1', '1'),
(-1, 65, '1', '1', '1'),
(-1, 66, '1', '1', '1'),
(-1, 67, '1', '1', '1'),
(-1, 68, '1', '1', '1');

-- --------------------------------------------------------

--
-- Table structure for table `ld_department`
--

DROP TABLE IF EXISTS `ld_department`;
CREATE TABLE IF NOT EXISTS `ld_department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` enum('inactive','active') NOT NULL,
  `created_at` datetime NOT NULL,
  `added_by` int(10) unsigned NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `ld_department`
--

INSERT INTO `ld_department` (`id`, `name`, `description`, `status`, `created_at`, `added_by`, `updated_at`, `deleted_at`) VALUES
(11, 'Department A', '   ', 'inactive', '2017-02-10 06:32:51', 1, '2017-02-20 10:16:01', NULL),
(12, 'Department B', '  ', 'inactive', '2017-02-10 06:33:14', 1, '2017-02-10 07:49:39', NULL),
(13, 'Department C', '  ', 'inactive', '2017-02-10 06:33:28', 1, '2017-02-10 07:49:44', NULL),
(14, 'Department D', '  ', 'inactive', '2017-02-10 06:33:45', 1, '2017-02-10 07:49:50', NULL),
(15, 'Department E', '    ', 'active', '2017-02-10 06:34:09', 1, '2017-02-10 07:50:07', NULL),
(16, 'Department sdf dfdsf', '  ', 'inactive', '2017-02-10 06:34:49', 1, '2017-02-10 06:35:28', '2017-02-10 07:04:09');

-- --------------------------------------------------------

--
-- Table structure for table `ld_employees`
--

DROP TABLE IF EXISTS `ld_employees`;
CREATE TABLE IF NOT EXISTS `ld_employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_name` varchar(100) NOT NULL,
  `state` varchar(255) NOT NULL,
  `contract` varchar(100) NOT NULL,
  `category` varchar(100) NOT NULL,
  `status` enum('inactive','active') NOT NULL,
  `created_at` datetime NOT NULL,
  `added_by` int(10) unsigned NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `ld_employees`
--

INSERT INTO `ld_employees` (`id`, `emp_name`, `state`, `contract`, `category`, `status`, `created_at`, `added_by`, `updated_at`, `deleted_at`) VALUES
(15, 'fhdfg', 'on leave', 'fixed', 'driver', 'inactive', '2017-01-23 10:17:35', 0, '2017-01-23 10:17:35', '2017-02-10 07:37:22'),
(16, 'Test Employee', 'assign', 'part-time', 'services', 'inactive', '2017-01-23 10:24:01', 0, '2017-01-23 10:24:07', '2017-02-10 07:37:08'),
(17, 'rtytryrtyrty', 'on leave', 'fixed', 'driver', 'inactive', '2017-01-27 05:41:51', 0, '2017-01-27 05:41:57', '2017-02-10 07:37:22'),
(21, 'Employee 1', 'assign', 'fixed', 'driver', 'active', '2017-02-10 07:41:51', 1, '2017-02-13 10:47:59', NULL),
(22, 'Employee 2', 'assign', 'part-time', 'services', 'active', '2017-02-10 07:42:09', 1, '2017-02-15 13:56:07', NULL),
(23, 'Employee 3', 'assign', 'fixed', 'exhibitions', 'active', '2017-02-10 07:42:23', 1, '2017-02-15 13:56:12', NULL),
(24, 'Employee 4', 'assign', 'fixed', 'services', 'active', '2017-02-10 07:42:46', 1, '2017-02-15 13:56:22', NULL),
(25, 'Employee 5', 'assign', 'fixed', 'services', 'inactive', '2017-02-10 07:43:02', 1, '2017-02-17 10:09:09', NULL),
(26, 'Employee 6', 'assign', 'fixed', 'services', 'active', '2017-02-10 07:43:18', 1, '2017-02-15 13:56:28', NULL),
(27, 'Employee 7', 'assign', 'fixed', 'services', 'active', '2017-02-10 07:44:06', 1, '2017-02-10 07:51:41', NULL),
(28, 'Employee 8', 'assign', 'fixed', 'driver', 'inactive', '2017-02-15 13:57:15', 1, '2017-02-17 10:09:26', NULL),
(29, 'Employee 9', 'assign', 'fixed', 'driver', 'active', '2017-02-15 13:57:32', 1, '2017-02-15 13:57:32', NULL),
(30, 'Employee 10', 'assign', 'fixed', 'driver', 'inactive', '2017-02-15 13:58:07', 1, '2017-02-17 10:09:33', NULL),
(31, 'Employee 11', 'assign', 'fixed', 'driver', 'inactive', '2017-02-15 13:58:24', 1, '2017-02-17 10:09:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ld_language`
--

DROP TABLE IF EXISTS `ld_language`;
CREATE TABLE IF NOT EXISTS `ld_language` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `language_name` varchar(250) NOT NULL,
  `language_code` varchar(250) NOT NULL,
  `language_flag` varchar(250) NOT NULL,
  `isDefault` enum('0','1') NOT NULL DEFAULT '0',
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `addedBy` tinyint(2) NOT NULL DEFAULT '0',
  `modBy` tinyint(2) NOT NULL DEFAULT '0',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `deleted_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `ld_language`
--

INSERT INTO `ld_language` (`id`, `language_name`, `language_code`, `language_flag`, `isDefault`, `status`, `addedBy`, `modBy`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'English', 'en', 'england2.png', '1', '1', 1, 1, 1417611098, 1417611098, NULL),
(2, 'Swedish', 'se', 'Swidden1.png', '0', '1', 1, 0, 1417611098, 1418878890, 1433228090),
(6, 'French', 'fr', 'th.jpg', '0', '1', 1, 0, 1418719483, 1422964298, 1433228090),
(8, 'test', 'te', '', '0', '1', 0, 0, 1421755441, 1421755459, 1421814108),
(9, 'Norwegian', 'no', 'norway220pxl.jpg', '0', '1', 0, 0, 1433228333, 1443089385, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ld_menu`
--

DROP TABLE IF EXISTS `ld_menu`;
CREATE TABLE IF NOT EXISTS `ld_menu` (
  `menuId` int(5) NOT NULL AUTO_INCREMENT,
  `menuName` varchar(100) NOT NULL DEFAULT '',
  `menuUrl` varchar(100) NOT NULL DEFAULT '',
  `menuImage` varchar(255) NOT NULL,
  `menuClass` varchar(255) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '0',
  `parentId` int(5) NOT NULL DEFAULT '0',
  `menu_type` enum('0','1') NOT NULL DEFAULT '0',
  `sort_order` int(11) NOT NULL,
  PRIMARY KEY (`menuId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=69 ;

--
-- Dumping data for table `ld_menu`
--

INSERT INTO `ld_menu` (`menuId`, `menuName`, `menuUrl`, `menuImage`, `menuClass`, `status`, `parentId`, `menu_type`, `sort_order`) VALUES
(1, 'Dashboard', 'adminarea.php', 'left-icon7.png', 'glyphicons dashboard', 1, 0, '1', 0),
(2, 'Configuration Manager', '#', 'icon_configuration_manager.png', 'glyphicons settings', 1, 0, '1', 0),
(4, 'Administrator', 'manageadministrator.php', '', '', 0, 2, '0', 0),
(5, 'System Configuration', 'systemconfiguration.php', '', '', 1, 2, '0', 0),
(44, 'Layout', '#', '', '', 0, 0, '1', 0),
(45, 'Manage Layout', 'layout/manage', '', '', 1, 44, '0', 0),
(46, 'Manage Pages', 'managepages/manage', '', '', 1, 44, '0', 0),
(47, 'Variants', '#', '', '', 1, 0, '1', 0),
(48, 'Manage banner area', 'variants/manage', '', '', 1, 47, '0', 0),
(49, 'Manage form area', 'variants/form_area', '', '', 1, 47, '0', 0),
(50, 'Manage step area', 'variants/step_area', '', '', 1, 47, '0', 0),
(51, 'Manage about area', 'variants/about_area', '', '', 1, 47, '0', 0),
(52, 'Manage compare area', 'variants/compare_area', '', '', 1, 47, '0', 0),
(53, 'Manage testimonial area', 'variants/testimonial_area', '', '', 1, 47, '0', 0),
(54, 'Manage  form2 area', 'variants/form2_area', '', '', 1, 47, '0', 0),
(55, 'Landing Page', '#', '', '', 1, 0, '1', 0),
(56, 'Manage Landing Page', 'layout/manage', '', '', 1, 55, '0', 0),
(57, 'Brand', '#', '', '', 1, 0, '1', 0),
(58, 'Manage Department', 'department/manage', '', '', 1, 57, '0', 0),
(59, 'Test', '#', '', '', 1, 0, '1', 0),
(60, 'Manage Test', 'test/manage', '', '', 1, 59, '0', 0),
(61, 'Test Urls', 'test/test_url', '', '', 1, 59, '0', 0),
(62, 'Result & Optimation', '#', '', '', 1, 0, '1', 0),
(63, 'Test Optimization', 'optimization/manage', '', '', 1, 62, '0', 0),
(64, 'Network', '#', '', '', 1, 0, '1', 0),
(65, 'Manage Networks', 'network/manage', '', '', 1, 64, '0', 0),
(66, 'Manage Archive Data', 'network/archive', '', '', 1, 64, '0', 0),
(67, 'Manage Networks Data', 'network/data', '', '', 1, 64, '0', 0),
(68, 'Manage Header Footer', 'systemconfiguration/add', '', '', 1, 2, '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `ld_menuposition`
--

DROP TABLE IF EXISTS `ld_menuposition`;
CREATE TABLE IF NOT EXISTS `ld_menuposition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `position` varchar(255) CHARACTER SET latin1 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ld_menuposition`
--

INSERT INTO `ld_menuposition` (`id`, `position`) VALUES
(1, 'Header Top'),
(2, 'Footer'),
(3, 'Footer Bottom');

-- --------------------------------------------------------

--
-- Table structure for table `ld_permissions`
--

DROP TABLE IF EXISTS `ld_permissions`;
CREATE TABLE IF NOT EXISTS `ld_permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `route_url` varchar(255) NOT NULL,
  `display_name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `parent_id` int(10) unsigned NOT NULL,
  `class` varchar(250) NOT NULL,
  `icon` varchar(100) NOT NULL,
  `sort` tinyint(4) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `ld_permissions`
--

INSERT INTO `ld_permissions` (`id`, `name`, `route_url`, `display_name`, `description`, `parent_id`, `class`, `icon`, `sort`, `created_date`) VALUES
(1, 'dashboard', 'admin/adminarea', 'Dashboard', '', 0, '', 'icon-home', 1, '2017-01-12 10:06:47'),
(2, 'book_service', 'admin/service/manage', 'Book Service', '', 0, '', 'icon-speedometer ', 2, '2017-01-12 10:06:47'),
(3, 'manage_projects', 'admin/project/manage', 'Manage Projects', '', 0, '', 'icon-grid', 3, '2017-01-12 10:15:27'),
(4, 'manage_employees', 'admin/employee/manage', 'Manage Employees', '', 0, '', 'icon-users', 4, '2017-01-12 10:17:07'),
(5, 'manage_vehicles', 'admin/vehicle/manage', 'Manage Vehicles', '', 0, '', 'icon-directions ', 5, '2017-01-12 10:18:02'),
(6, 'manage_departments', 'admin/department/manage', 'Manage Departments', '', 0, '', 'icon-notebook', 6, '2017-01-12 10:19:10'),
(7, 'manage_timesheet', 'admin/timesheet/manage', 'Manage Timesheet', '', 0, '', 'icon-calendar', 7, '2017-01-12 10:19:44'),
(8, 'reports', '#', 'Reports', '', 0, '', 'icon-docs', 8, '2017-01-17 07:28:18'),
(9, 'settings', '#', 'Settings', '', 0, '', 'icon-settings', 9, '2017-01-18 05:55:09'),
(10, 'project_daily_report', 'admin/reports/daily', 'Daily Reports', '', 8, '', 'icon-bar-chart', 1, '2017-01-18 05:56:59'),
(11, 'weekly_report', 'admin/reports/weekly', 'Weekly Report', '', 8, '', 'icon-bar-chart', 2, '2017-01-18 05:56:59'),
(12, 'monthly_report', 'admin/reports/monthly', 'Monthly Report', '', 8, '', 'icon-bar-chart', 3, '2017-01-18 05:57:47'),
(13, 'hr_report', 'admin/reports/human_resource', 'Human Resource Report', '', 8, '', 'icon-bar-chart', 4, '2017-01-25 12:52:49'),
(14, 'department_cost_report', 'admin/reports/department_cost', 'Department Cost Report', '', 8, '', 'icon-bar-chart', 5, '2017-01-27 07:13:55'),
(15, 'project_cost_report', 'admin/reports/project_cost', 'Project Cost Report', '', 8, '', 'icon-bar-chart', 6, '2017-01-30 09:57:58'),
(16, 'manage_administrators', 'admin/settings/manage_users', 'Manage Administrators', '', 9, '', 'icon-user', 1, '2017-01-30 09:58:49'),
(17, 'manage_roles', 'admin/settings/manage_role', 'Manage Roles', '', 9, '', 'icon-key', 2, '2017-01-30 09:58:49'),
(18, 'system_config', 'admin/settings/site_config', 'System Configuration', '', 9, '', 'icon-wrench', 3, '2017-01-30 10:02:04');

-- --------------------------------------------------------

--
-- Table structure for table `ld_permission_role`
--

DROP TABLE IF EXISTS `ld_permission_role`;
CREATE TABLE IF NOT EXISTS `ld_permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  KEY `permission_id` (`permission_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ld_permission_role`
--

INSERT INTO `ld_permission_role` (`permission_id`, `role_id`) VALUES
(6, 15),
(7, 15),
(3, 15),
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(8, 1),
(16, 1),
(17, 1),
(18, 1),
(9, 1),
(1, 22),
(2, 22),
(3, 22),
(4, 22),
(5, 22),
(6, 22),
(7, 22),
(10, 22),
(11, 22),
(12, 22),
(13, 22),
(14, 22),
(15, 22),
(8, 22),
(16, 22),
(17, 22),
(18, 22),
(9, 22),
(1, 19),
(2, 19),
(10, 19),
(11, 19),
(12, 19),
(13, 19),
(14, 19),
(15, 19),
(8, 19),
(5, 19);

-- --------------------------------------------------------

--
-- Table structure for table `ld_projects`
--

DROP TABLE IF EXISTS `ld_projects`;
CREATE TABLE IF NOT EXISTS `ld_projects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `status` enum('inactive','active') NOT NULL,
  `created_at` datetime NOT NULL,
  `added_by` int(10) unsigned NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `ld_projects`
--

INSERT INTO `ld_projects` (`id`, `code`, `customer_name`, `description`, `status`, `created_at`, `added_by`, `updated_at`, `deleted_at`) VALUES
(7, 'SAMPLECODE', 'REGN034654', ' MODEL890DFGDFSG', 'active', '0000-00-00 00:00:00', 0, '2017-02-10 08:59:05', '2017-02-10 09:06:52'),
(8, 'CODECODE', 'REGN34896904', 'The quick ggfdg ', 'active', '0000-00-00 00:00:00', 0, '2017-02-10 08:59:17', '2017-02-10 09:05:45'),
(10, 'CODE001AA', 'CUSTNAMEBB', 'the quick brown foxthe quick brown foxthe quick brown fox', 'active', '2017-01-23 09:31:57', 0, '2017-02-10 08:59:25', '2017-02-10 09:05:50'),
(11, '6345', 'rteyrte', 'fghdhfgdfhfghdfhfh', 'inactive', '2017-01-23 09:36:00', 0, '2017-01-23 09:36:00', '2017-02-10 09:06:52'),
(12, 'Code0001', 'Sean Rock', 'the quick brown fox', 'inactive', '2017-02-06 09:16:15', 24, '2017-02-06 09:16:15', '2017-02-10 09:06:52'),
(13, 'Code0002', 'Sean Rock3', 'the quick brown fox jumps over the little lazy dog.', 'inactive', '2017-02-06 09:16:49', 24, '2017-02-06 09:17:10', '2017-02-10 09:06:52'),
(14, 'Project B', 'Customer 1', 'The quick dfs ', 'inactive', '2017-02-10 09:05:12', 1, '2017-02-16 03:59:02', NULL),
(15, 'Project B', 'Customer 2', 'testing..testing..', 'inactive', '2017-02-10 09:07:41', 1, '2017-02-10 09:08:35', NULL),
(16, 'Project C', 'Customer 3', 'testing..testing..testing..testing..', 'inactive', '2017-02-10 09:08:04', 1, '2017-02-10 09:08:40', NULL),
(17, 'Project D', 'Customer 4', 'testing..testing..testing..testing..', 'active', '2017-02-10 09:08:24', 1, '2017-02-10 09:08:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ld_roles`
--

DROP TABLE IF EXISTS `ld_roles`;
CREATE TABLE IF NOT EXISTS `ld_roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('inactive','active') COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `added_by` int(10) unsigned NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `roles_deleted_at_index` (`deleted_at`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=23 ;

--
-- Dumping data for table `ld_roles`
--

INSERT INTO `ld_roles` (`id`, `title`, `description`, `status`, `created_at`, `added_by`, `updated_at`, `deleted_at`) VALUES
(1, 'Super Admin', 'This user has full access permissions and modifications are not allowed for this role.', 'active', '2016-12-16 01:06:38', 0, '2017-01-16 06:47:49', NULL),
(15, 'New Role', '', 'active', '2017-01-16 11:28:46', 0, '2017-01-16 06:47:43', '2017-01-16 06:47:43'),
(19, 'Staff', '', 'active', '2017-02-02 05:04:19', 0, NULL, NULL),
(22, 'HR', '', 'active', '2017-02-02 07:18:25', 24, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ld_services`
--

DROP TABLE IF EXISTS `ld_services`;
CREATE TABLE IF NOT EXISTS `ld_services` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `service_title` varchar(100) NOT NULL,
  `department_id` int(10) unsigned NOT NULL,
  `project_id` int(10) unsigned NOT NULL,
  `service_desc` text NOT NULL,
  `created_at` datetime NOT NULL,
  `added_by` int(10) unsigned NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `ld_services`
--

INSERT INTO `ld_services` (`id`, `start_date`, `end_date`, `start_time`, `end_time`, `service_title`, `department_id`, `project_id`, `service_desc`, `created_at`, `added_by`, `updated_at`, `deleted_at`) VALUES
(1, '2017-02-17', '2017-02-17', '00:00:00', '00:00:00', 'Service 1', 1, 12, 'sdfsd dsfsdf', '2017-02-08 07:41:50', 1, '2017-02-08 07:41:50', '2017-02-16 05:32:05'),
(2, '2017-02-17', '2017-02-20', '00:00:00', '00:00:00', 'Service 2', 1, 12, ' hruhtr', '2017-02-08 07:48:50', 1, '2017-02-08 07:48:50', '2017-02-14 09:26:12'),
(3, '2017-02-16', '2017-02-16', '00:00:00', '00:00:00', 'Service 5', 1, 12, 'sdfdsfds', '2017-02-09 12:12:54', 1, '2017-02-09 12:12:54', '2017-02-14 09:26:21'),
(4, '2017-02-10', '2017-02-10', '15:00:00', '15:00:00', 'Service 1', 15, 17, 'Service 12', '2017-02-10 09:56:13', 1, '2017-02-10 09:56:13', '2017-02-14 09:26:12'),
(5, '2017-02-11', '2017-02-11', '09:00:00', '16:00:00', 'Service 2a', 15, 17, 'Service 2', '2017-02-10 10:32:19', 1, '2017-02-10 10:32:19', '2017-02-14 09:26:12'),
(6, '2017-02-22', '2017-02-28', '08:58:00', '13:53:00', 'Service 5', 15, 17, 'Service Descrrr....\n', '2017-02-13 05:32:10', 1, '2017-02-13 05:32:10', '2017-02-14 09:26:21'),
(7, '2017-02-14', '2017-02-16', '00:00:00', '00:00:00', '0', 15, 17, '0', '2017-02-13 06:46:26', 1, '2017-02-13 06:46:26', '2017-02-14 09:26:12'),
(8, '2017-05-10', '2017-05-10', '01:00:00', '00:00:00', 'Service 3', 15, 17, 'sd g', '2017-02-13 09:17:17', 1, '2017-02-13 09:17:17', '2017-02-14 09:26:12'),
(9, '2017-02-05', '2017-02-15', '00:00:00', '00:00:00', 'Service 1aa', 15, 17, 'Service 1', '2017-02-14 04:13:14', 1, '2017-02-14 04:13:14', '2017-02-14 09:26:12'),
(10, '2017-01-31', '2017-02-01', '00:00:00', '00:00:00', 'Service 6', 15, 17, 'service', '2017-02-14 06:20:38', 1, '2017-02-14 06:20:38', '2017-02-14 09:26:21'),
(11, '2017-01-31', '2017-02-01', '00:00:00', '00:00:00', 'Service 7', 15, 17, 'test', '2017-02-14 06:23:19', 1, '2017-02-14 06:23:19', '2017-02-14 09:26:21'),
(12, '2017-02-16', '2017-04-14', '00:00:00', '12:00:00', 'Service 2', 15, 17, 'testttt', '2017-02-14 07:03:11', 1, '2017-02-14 07:03:11', '2017-02-14 09:26:12'),
(13, '2017-02-05', '2017-02-07', '23:57:00', '23:59:00', 'Service 1', 15, 17, 's ds ds ds d', '2017-02-14 07:08:24', 1, '2017-02-14 07:08:24', '2017-02-14 09:26:12'),
(14, '2017-01-29', '2017-01-30', '23:59:00', '00:00:00', 'Service 2', 15, 17, 'service', '2017-02-14 07:29:52', 1, '2017-02-14 07:29:52', '2017-02-14 09:26:12'),
(15, '2017-01-15', '2017-01-17', '00:00:00', '00:00:00', 'Service 8', 15, 17, 'testttt', '2017-02-14 07:35:06', 1, '2017-02-14 07:35:06', '2017-02-14 09:26:21'),
(16, '2017-02-01', '2017-02-02', '06:00:00', '21:00:00', 'Service 11', 15, 17, 't ttt', '2017-02-14 09:28:55', 1, '2017-02-14 09:28:55', '2017-02-14 12:15:24'),
(17, '2017-02-08', '2017-02-10', '00:00:00', '00:00:00', 'Service 1', 15, 17, 'e rt', '2017-02-14 10:20:17', 1, '2017-02-14 10:20:17', '2017-02-14 10:20:36'),
(18, '2017-02-01', '2017-02-01', '23:59:00', '00:00:00', 'Service 1', 15, 17, 'as ', '2017-02-14 10:21:22', 1, '2017-02-14 10:21:22', '2017-02-14 10:24:40'),
(19, '2017-02-06', '2017-02-08', '11:59:00', '00:00:00', 'Service 1', 15, 17, 'sdf ', '2017-02-14 10:25:21', 1, '2017-02-14 10:25:21', '2017-02-14 10:26:40'),
(20, '2017-01-15', '2017-01-15', '00:00:00', '00:00:00', 'Service 3', 15, 17, 'd fgd', '2017-02-14 10:27:33', 1, '2017-02-14 10:27:33', '2017-02-14 12:15:24'),
(21, '2017-02-02', '2017-02-04', '00:00:00', '00:00:00', 'Service 2', 15, 17, 'fgh gh', '2017-02-14 10:28:35', 1, '2017-02-14 10:28:35', '2017-02-14 12:15:24'),
(22, '2017-02-10', '2017-02-11', '11:59:00', '12:00:00', 'Service 1', 15, 17, ' as das', '2017-02-14 10:52:09', 1, '2017-02-14 10:52:09', '2017-02-14 12:15:24'),
(23, '2017-02-01', '2017-02-01', '23:59:00', '12:00:00', 'Service 4', 15, 17, 'test', '2017-02-14 10:53:27', 1, '2017-02-14 10:53:27', '2017-02-14 12:15:24'),
(24, '2017-02-14', '2017-02-15', '06:00:00', '20:00:00', 'Service 11', 15, 17, 'the quick brown fox ', '2017-02-14 12:16:28', 1, '2017-02-14 12:16:28', '2017-02-14 12:31:13'),
(25, '2017-02-01', '2017-02-01', '12:00:00', '12:00:00', 'Service 1', 15, 17, 'test', '2017-02-14 12:33:31', 1, '2017-02-14 12:33:31', '2017-02-14 13:07:20'),
(26, '2017-04-01', '2017-04-01', '01:00:00', '00:01:00', 'Service 2', 15, 17, 'service 1', '2017-02-14 12:45:12', 1, '2017-02-14 12:45:12', '2017-02-14 13:06:42'),
(27, '2017-02-02', '2017-02-03', '00:00:00', '00:00:00', 'Service 1', 15, 17, 'test', '2017-02-14 13:08:13', 1, '2017-02-14 13:08:13', '2017-02-14 13:08:41'),
(28, '2017-02-02', '2017-02-02', '12:00:00', '00:00:00', 'Service 1', 15, 17, 'test', '2017-02-14 13:09:44', 1, '2017-02-14 13:09:44', '2017-02-14 13:11:00'),
(29, '2017-02-02', '2017-02-03', '00:00:00', '00:00:00', 'Service 1', 15, 17, 'test', '2017-02-14 13:11:45', 1, '2017-02-14 13:11:45', '2017-02-14 13:49:41'),
(30, '2017-02-05', '2017-02-06', '12:00:00', '12:00:00', 'Service 2', 15, 17, 'testtt', '2017-02-14 13:21:15', 1, '2017-02-14 13:21:15', '2017-02-14 13:49:33'),
(31, '2017-02-14', '2017-02-28', '08:00:00', '17:00:00', 'Service 1', 15, 17, 'The quick brown fox jumps over the little lazy dog. The quick brown fox jumps over the little lazy dog. The quick brown fox jumps over the little lazy dog. The quick brown fox jumps over the little lazy dog. The quick brown fox jumps over the little lazy dog. The quick brown fox jumps over the little lazy dog. ', '2017-02-14 13:51:06', 1, '2017-02-14 13:51:06', '2017-02-14 13:51:45'),
(32, '2017-01-15', '2017-01-17', '00:00:00', '00:00:00', 'Service 1', 15, 17, 'Testing', '2017-02-15 04:09:07', 1, '2017-02-15 04:09:07', '2017-02-15 04:09:30'),
(33, '2017-01-15', '2017-01-17', '00:00:00', '00:00:00', 'Service 1', 15, 17, 'service 1', '2017-02-15 04:10:19', 1, '2017-02-15 04:10:19', '2017-02-15 04:11:05'),
(34, '2017-02-02', '2017-02-02', '00:00:00', '00:00:00', 'Service 1', 15, 17, 'service', '2017-02-15 04:16:30', 1, '2017-02-15 04:16:30', NULL),
(35, '2017-02-16', '2017-02-16', '00:00:00', '00:00:00', 'Service 2', 15, 17, 'service', '2017-02-15 04:43:16', 1, '2017-02-15 04:43:16', NULL),
(36, '2017-02-22', '2017-02-23', '07:00:00', '19:00:00', 'Service Test', 15, 17, 'Test ', '2017-02-15 09:47:53', 1, '2017-02-15 09:47:53', NULL),
(37, '2017-02-18', '2017-02-20', '09:00:00', '18:00:00', 'Service 10', 15, 17, 'The quick brown', '2017-02-17 10:04:51', 1, '2017-02-17 10:04:51', NULL),
(38, '2017-02-01', '2017-02-01', '09:00:00', '18:00:00', 'test', 15, 17, 'sd f', '2017-02-17 11:36:54', 1, '2017-02-17 11:36:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ld_services_detail`
--

DROP TABLE IF EXISTS `ld_services_detail`;
CREATE TABLE IF NOT EXISTS `ld_services_detail` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `service_id` int(10) unsigned NOT NULL,
  `service_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `employee_id` varchar(250) NOT NULL,
  `vehicle_id` varchar(250) NOT NULL,
  `added_by` int(10) unsigned NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `ut` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=157 ;

--
-- Dumping data for table `ld_services_detail`
--

INSERT INTO `ld_services_detail` (`id`, `service_id`, `service_date`, `start_time`, `end_time`, `employee_id`, `vehicle_id`, `added_by`, `deleted_at`, `ut`) VALUES
(1, 1, '2017-02-17', '08:30:00', '16:00:00', '20,14', '8,14', 0, '2017-02-14 10:46:22', '2017-02-08 07:41:50'),
(2, 2, '2017-02-17', '08:30:00', '16:00:00', '18', '7', 0, '2017-02-14 09:26:12', '2017-02-08 07:48:50'),
(3, 2, '2017-02-18', '08:30:00', '16:00:00', '18', '7', 0, '2017-02-14 09:26:12', '2017-02-08 07:48:50'),
(4, 2, '2017-02-19', '08:30:00', '16:00:00', '18', '7', 0, '2017-02-14 09:26:12', '2017-02-08 07:48:50'),
(5, 2, '2017-02-20', '08:30:00', '16:00:00', '18', '7', 0, '2017-02-14 09:26:12', '2017-02-08 07:48:50'),
(6, 3, '2017-02-16', '08:30:00', '16:00:00', '19', '8', 0, '2017-02-14 09:26:21', '2017-02-09 12:12:54'),
(7, 4, '2017-02-10', '08:30:00', '16:00:00', '27', '22', 0, '2017-02-14 09:26:12', '2017-02-10 09:56:14'),
(8, 5, '2017-02-11', '08:30:00', '16:00:00', '27', '', 0, '2017-02-14 09:26:12', '2017-02-10 10:32:19'),
(9, 6, '2017-02-22', '08:30:00', '16:00:00', '27', '', 0, '2017-02-14 09:26:21', '2017-02-13 05:32:10'),
(10, 6, '2017-02-23', '08:30:00', '16:00:00', '27', '22', 0, '2017-02-14 09:26:21', '2017-02-13 05:32:10'),
(11, 6, '2017-02-24', '08:30:00', '16:00:00', '27', '22', 0, '2017-02-14 09:26:21', '2017-02-13 05:32:10'),
(12, 6, '2017-02-25', '08:30:00', '16:00:00', '27', '22', 0, '2017-02-14 09:26:21', '2017-02-13 05:32:10'),
(13, 6, '2017-02-26', '08:30:00', '16:00:00', '27', '22', 0, '2017-02-14 09:26:21', '2017-02-13 05:32:10'),
(14, 6, '2017-02-27', '08:30:00', '16:00:00', '27', '22', 0, '2017-02-14 09:26:21', '2017-02-13 05:32:10'),
(15, 6, '2017-02-28', '08:30:00', '16:00:00', '27', '22', 0, '2017-02-14 09:26:21', '2017-02-13 05:32:10'),
(16, 7, '2017-02-14', '08:30:00', '16:00:00', '27', '22', 0, '2017-02-14 09:26:12', '2017-02-13 06:46:26'),
(17, 7, '2017-02-15', '08:30:00', '16:00:00', '27', '22,15', 0, '2017-02-14 09:26:12', '2017-02-13 06:46:26'),
(18, 7, '2017-02-16', '08:30:00', '16:00:00', '27', '22', 0, '2017-02-14 09:26:12', '2017-02-13 06:46:26'),
(19, 8, '2017-05-10', '08:30:00', '16:00:00', '21', '18', 0, '2017-02-14 09:26:12', '2017-02-13 09:17:18'),
(20, 9, '2017-02-05', '08:30:00', '16:00:00', '21', '18', 0, '2017-02-14 09:26:12', '2017-02-14 04:13:15'),
(21, 9, '2017-02-06', '08:30:00', '16:00:00', '21', '18', 0, '2017-02-14 09:26:12', '2017-02-14 04:13:15'),
(22, 9, '2017-02-07', '08:30:00', '16:00:00', '21', '18', 0, '2017-02-14 09:26:12', '2017-02-14 04:13:15'),
(23, 9, '2017-02-08', '08:30:00', '16:00:00', '21', '18', 0, '2017-02-14 09:26:12', '2017-02-14 04:13:15'),
(24, 9, '2017-02-09', '08:30:00', '16:00:00', '21', '18', 0, '2017-02-14 09:26:12', '2017-02-14 04:13:15'),
(25, 9, '2017-02-10', '08:30:00', '16:00:00', '21', '18', 0, '2017-02-14 09:26:12', '2017-02-14 04:13:15'),
(26, 9, '2017-02-11', '08:30:00', '16:00:00', '21', '18', 0, '2017-02-14 09:26:12', '2017-02-14 04:13:15'),
(27, 9, '2017-02-12', '08:30:00', '16:00:00', '21', '18', 0, '2017-02-14 09:26:12', '2017-02-14 04:13:15'),
(28, 9, '2017-02-13', '08:30:00', '16:00:00', '21', '18', 0, '2017-02-14 09:26:12', '2017-02-14 04:13:15'),
(29, 9, '2017-02-14', '08:30:00', '16:00:00', '21', '18', 0, '2017-02-14 09:26:12', '2017-02-14 04:13:15'),
(30, 9, '2017-02-15', '08:30:00', '16:00:00', '21', '18', 0, '2017-02-14 09:26:12', '2017-02-14 04:13:15'),
(31, 10, '2017-01-31', '08:30:00', '16:00:00', '27', '18', 0, '2017-02-14 09:26:21', '2017-02-14 06:20:38'),
(32, 10, '2017-02-01', '08:30:00', '16:00:00', '27', '18', 0, '2017-02-14 09:26:21', '2017-02-14 06:20:38'),
(33, 11, '2017-01-31', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:21', '2017-02-14 06:23:19'),
(34, 11, '2017-02-01', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:21', '2017-02-14 06:23:19'),
(35, 12, '2017-02-16', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(36, 12, '2017-02-17', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(37, 12, '2017-02-18', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(38, 12, '2017-02-19', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(39, 12, '2017-02-20', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(40, 12, '2017-02-21', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(41, 12, '2017-02-22', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(42, 12, '2017-02-23', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(43, 12, '2017-02-24', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(44, 12, '2017-02-25', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(45, 12, '2017-02-26', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(46, 12, '2017-02-27', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(47, 12, '2017-02-28', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(48, 12, '2017-03-01', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(49, 12, '2017-03-02', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(50, 12, '2017-03-03', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(51, 12, '2017-03-04', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(52, 12, '2017-03-05', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(53, 12, '2017-03-06', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(54, 12, '2017-03-07', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(55, 12, '2017-03-08', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(56, 12, '2017-03-09', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(57, 12, '2017-03-10', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(58, 12, '2017-03-11', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(59, 12, '2017-03-12', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(60, 12, '2017-03-13', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(61, 12, '2017-03-14', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(62, 12, '2017-03-15', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(63, 12, '2017-03-16', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(64, 12, '2017-03-17', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(65, 12, '2017-03-18', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(66, 12, '2017-03-19', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(67, 12, '2017-03-20', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(68, 12, '2017-03-21', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(69, 12, '2017-03-22', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(70, 12, '2017-03-23', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(71, 12, '2017-03-24', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(72, 12, '2017-03-25', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(73, 12, '2017-03-26', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(74, 12, '2017-03-27', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(75, 12, '2017-03-28', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(76, 12, '2017-03-29', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(77, 12, '2017-03-30', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:11'),
(78, 12, '2017-03-31', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:12'),
(79, 12, '2017-04-01', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:12'),
(80, 12, '2017-04-02', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:12'),
(81, 12, '2017-04-03', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:12'),
(82, 12, '2017-04-04', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:12'),
(83, 12, '2017-04-05', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:12'),
(84, 12, '2017-04-06', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:12'),
(85, 12, '2017-04-07', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:12'),
(86, 12, '2017-04-08', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:12'),
(87, 12, '2017-04-09', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:12'),
(88, 12, '2017-04-10', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:12'),
(89, 12, '2017-04-11', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:12'),
(90, 12, '2017-04-12', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:12'),
(91, 12, '2017-04-13', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:12'),
(92, 12, '2017-04-14', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 09:26:12', '2017-02-14 07:03:12'),
(93, 13, '2017-02-05', '08:30:00', '16:00:00', '27', '', 0, '2017-02-14 09:26:12', '2017-02-14 07:08:25'),
(94, 13, '2017-02-06', '08:30:00', '16:00:00', '27', '', 0, '2017-02-14 09:26:12', '2017-02-14 07:08:25'),
(95, 13, '2017-02-07', '08:30:00', '16:00:00', '27', '', 0, '2017-02-14 09:26:12', '2017-02-14 07:08:25'),
(96, 14, '2017-01-29', '08:30:00', '16:00:00', '27', '', 0, '2017-02-14 09:26:12', '2017-02-14 07:29:52'),
(97, 14, '2017-01-30', '08:30:00', '16:00:00', '27', '15,18,19,22', 0, '2017-02-14 09:26:12', '2017-02-14 07:29:52'),
(98, 15, '2017-01-15', '08:30:00', '16:00:00', '27', '15', 0, '2017-02-14 09:26:21', '2017-02-14 07:35:06'),
(99, 15, '2017-01-16', '08:30:00', '16:00:00', '27', '15', 0, '2017-02-14 09:26:21', '2017-02-14 07:35:06'),
(100, 15, '2017-01-17', '08:30:00', '16:00:00', '27', '15', 0, '2017-02-14 09:26:21', '2017-02-14 07:35:06'),
(102, 16, '2017-02-02', '08:30:00', '16:00:00', '27', '18', 0, '2017-02-14 12:15:24', '2017-02-14 09:28:55'),
(103, 17, '2017-02-08', '08:30:00', '16:00:00', '27', '18', 0, NULL, '2017-02-14 10:20:18'),
(104, 17, '2017-02-09', '08:30:00', '16:00:00', '27', '18', 0, NULL, '2017-02-14 10:20:18'),
(105, 17, '2017-02-10', '08:30:00', '16:00:00', '27', '18', 0, NULL, '2017-02-14 10:20:18'),
(106, 18, '2017-02-01', '08:30:00', '16:00:00', '27', '22', 0, NULL, '2017-02-14 10:21:22'),
(107, 19, '2017-02-06', '08:30:00', '16:00:00', '21', '15', 0, NULL, '2017-02-14 10:25:21'),
(108, 19, '2017-02-07', '08:30:00', '16:00:00', '21', '15', 0, NULL, '2017-02-14 10:25:21'),
(109, 19, '2017-02-08', '08:30:00', '16:00:00', '21', '15', 0, NULL, '2017-02-14 10:25:21'),
(111, 21, '2017-02-02', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 12:15:24', '2017-02-14 10:28:35'),
(112, 21, '2017-02-03', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 12:15:24', '2017-02-14 10:28:35'),
(113, 21, '2017-02-04', '08:30:00', '16:00:00', '21', '15', 0, '2017-02-14 12:15:24', '2017-02-14 10:28:35'),
(114, 22, '2017-02-10', '08:30:00', '16:00:00', '', '15', 0, '2017-02-14 12:15:24', '2017-02-14 10:52:09'),
(115, 22, '2017-02-11', '08:30:00', '16:00:00', '27,21', '18,19', 0, '2017-02-14 12:15:24', '2017-02-14 10:52:09'),
(116, 23, '2017-02-01', '08:30:00', '16:00:00', '21', '15,18,19', 0, NULL, '2017-02-14 10:53:27'),
(120, 26, '2017-04-01', '08:30:00', '16:00:00', '27,21', '15,18,19,22', 0, '2017-02-14 13:06:42', '2017-02-14 12:45:12'),
(121, 27, '2017-02-02', '08:30:00', '16:00:00', '27,21', '15,18,19', 0, '2017-02-14 13:08:41', '2017-02-14 13:08:13'),
(122, 27, '2017-02-03', '08:30:00', '16:00:00', '27,21', '15,18,19', 0, '2017-02-14 13:08:41', '2017-02-14 13:08:13'),
(128, 31, '2017-02-14', '08:30:00', '16:00:00', '27', '18,19', 0, '2017-02-14 13:51:45', '2017-02-14 13:51:06'),
(129, 31, '2017-02-15', '08:30:00', '16:00:00', '27', '18,19', 0, '2017-02-14 13:51:45', '2017-02-14 13:51:06'),
(130, 31, '2017-02-16', '08:30:00', '16:00:00', '27', '18,19', 0, '2017-02-14 13:51:45', '2017-02-14 13:51:06'),
(131, 31, '2017-02-17', '08:30:00', '16:00:00', '27', '18,19', 0, '2017-02-14 13:51:45', '2017-02-14 13:51:06'),
(132, 31, '2017-02-18', '08:30:00', '16:00:00', '27', '18,19', 0, '2017-02-14 13:51:45', '2017-02-14 13:51:06'),
(133, 31, '2017-02-19', '08:30:00', '16:00:00', '27', '18,19', 0, '2017-02-14 13:51:45', '2017-02-14 13:51:06'),
(134, 31, '2017-02-20', '08:30:00', '16:00:00', '27', '18,19', 0, '2017-02-14 13:51:45', '2017-02-14 13:51:06'),
(135, 31, '2017-02-21', '08:30:00', '16:00:00', '27', '18,19', 0, '2017-02-14 13:51:45', '2017-02-14 13:51:06'),
(136, 31, '2017-02-22', '08:30:00', '16:00:00', '27', '18,19', 0, '2017-02-14 13:51:45', '2017-02-14 13:51:06'),
(137, 31, '2017-02-23', '08:30:00', '16:00:00', '27', '18,19', 0, '2017-02-14 13:51:45', '2017-02-14 13:51:06'),
(138, 31, '2017-02-24', '08:30:00', '16:00:00', '27', '18,19', 0, '2017-02-14 13:51:45', '2017-02-14 13:51:06'),
(139, 31, '2017-02-25', '08:30:00', '16:00:00', '27', '18,19', 0, '2017-02-14 13:51:45', '2017-02-14 13:51:06'),
(140, 31, '2017-02-26', '08:30:00', '16:00:00', '27', '18,19', 0, '2017-02-14 13:51:45', '2017-02-14 13:51:06'),
(141, 31, '2017-02-27', '08:30:00', '16:00:00', '27', '18,19', 0, '2017-02-14 13:51:45', '2017-02-14 13:51:06'),
(142, 31, '2017-02-28', '08:30:00', '16:00:00', '27', '18,19', 0, '2017-02-14 13:51:45', '2017-02-14 13:51:06'),
(143, 32, '2017-01-15', '08:30:00', '16:00:00', '27,21', '15,18', 0, '2017-02-15 04:09:30', '2017-02-15 04:09:07'),
(144, 32, '2017-01-16', '08:30:00', '16:00:00', '27,21', '15,18', 0, '2017-02-15 04:09:30', '2017-02-15 04:09:07'),
(145, 32, '2017-01-17', '08:30:00', '16:00:00', '27,21', '15,18', 0, '2017-02-15 04:09:30', '2017-02-15 04:09:07'),
(149, 34, '2017-02-02', '08:30:00', '16:00:00', '27,21', '15,18,19,22', 0, NULL, '2017-02-15 04:16:30'),
(150, 35, '2017-02-16', '08:30:00', '16:00:00', '27,21', '15,18', 0, NULL, '2017-02-15 04:43:16'),
(151, 36, '2017-02-22', '08:30:00', '16:00:00', '21', '18', 0, NULL, '2017-02-15 09:47:54'),
(152, 36, '2017-02-23', '08:30:00', '16:00:00', '27', '18', 0, NULL, '2017-02-15 09:47:54'),
(153, 37, '2017-02-18', '09:00:00', '18:00:00', '24,23', '18,19', 0, NULL, '2017-02-17 10:04:52'),
(154, 37, '2017-02-19', '09:00:00', '18:00:00', '24,23', '18,19', 0, NULL, '2017-02-17 10:04:52'),
(155, 37, '2017-02-20', '09:00:00', '18:00:00', '23', '18,19', 0, NULL, '2017-02-17 10:04:52'),
(156, 38, '2017-02-01', '09:00:00', '18:00:00', '29,27', '15,18', 0, NULL, '2017-02-17 11:36:54');

-- --------------------------------------------------------

--
-- Table structure for table `ld_sessiondetail`
--

DROP TABLE IF EXISTS `ld_sessiondetail`;
CREATE TABLE IF NOT EXISTS `ld_sessiondetail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sessionId` varchar(50) CHARACTER SET latin1 NOT NULL,
  `adminId` int(5) NOT NULL DEFAULT '0',
  `ipAddress` varchar(30) CHARACTER SET latin1 NOT NULL,
  `signInDateTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `signOutDateTime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `signDate` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=135 ;

--
-- Dumping data for table `ld_sessiondetail`
--

INSERT INTO `ld_sessiondetail` (`id`, `sessionId`, `adminId`, `ipAddress`, `signInDateTime`, `signOutDateTime`, `signDate`) VALUES
(1, '4ad5dc7b948542a3c9a8079a43e8b789', 1, '10.0.0.1', '2017-01-06 13:50:47', '0000-00-00 00:00:00', '2017-01-06'),
(2, '837ef639da6a3dabff0539e4fe97fdba', 1, '46.196.49.113', '2017-01-06 14:05:24', '0000-00-00 00:00:00', '2017-01-06'),
(3, 'fe23e3dbe406d0727b72ee2e3e854c2a', 1, '46.196.49.113', '2017-01-06 14:10:18', '0000-00-00 00:00:00', '2017-01-06'),
(4, '9ed84b90e45e61286303c2629789fcbd', 1, '46.196.49.113', '2017-01-06 21:04:35', '0000-00-00 00:00:00', '2017-01-06'),
(5, '5f5bad7cfd197bf2015c9136dbb8c1a7', 1, '103.77.186.183', '2017-01-07 05:05:52', '0000-00-00 00:00:00', '2017-01-07'),
(6, '96e037f441afa8ad38ef3c0802003024', 1, '103.77.186.183', '2017-01-07 18:21:47', '0000-00-00 00:00:00', '2017-01-07'),
(7, 'ff839ebea165f7d875bbb8e11a0850f5', 1, '103.77.186.183', '2017-01-08 03:24:52', '0000-00-00 00:00:00', '2017-01-08'),
(8, '632329424e77a479202608344f683501', 1, '103.77.186.183', '2017-01-08 10:59:06', '0000-00-00 00:00:00', '2017-01-08'),
(9, '44da998d50d26e62b2ed12cf46593d7c', 1, '46.196.49.113', '2017-01-08 14:10:07', '0000-00-00 00:00:00', '2017-01-08'),
(10, '44da998d50d26e62b2ed12cf46593d7c', 1, '46.196.49.113', '2017-01-08 14:13:57', '0000-00-00 00:00:00', '2017-01-08'),
(11, '3985e1e81a0819c527a17a0917bedda1', 1, '103.72.6.37', '2017-01-08 16:40:17', '0000-00-00 00:00:00', '2017-01-08'),
(12, 'ea926dbf0d742b9dcb30410db943f8f9', 1, '46.196.49.113', '2017-01-08 20:16:54', '0000-00-00 00:00:00', '2017-01-08'),
(13, 'dac682dc5cc7452c6cdc1f5032801bab', 1, '46.196.49.113', '2017-01-08 20:37:34', '0000-00-00 00:00:00', '2017-01-08'),
(14, '710c5ca5d648ff5ef4f590137455f6b4', 1, '46.196.49.113', '2017-01-09 02:04:23', '0000-00-00 00:00:00', '2017-01-09'),
(15, '73e0b4305c14f8009ee12847769d1829', 1, '103.72.6.37', '2017-01-09 02:23:34', '0000-00-00 00:00:00', '2017-01-09'),
(16, '2007fb8600fce19de742eb5c7ee61228', 1, '46.196.49.113', '2017-01-09 02:41:27', '0000-00-00 00:00:00', '2017-01-09'),
(17, 'd09dee3155f039e04e764aa6f6202550', 1, '10.0.0.1', '2017-01-09 05:01:40', '0000-00-00 00:00:00', '2017-01-09'),
(18, '32c896dd0f92e3138b0bbfc25ac2042a', 1, '10.0.0.176', '2017-01-09 05:39:03', '0000-00-00 00:00:00', '2017-01-09'),
(19, '30fa7ae605e660b75d25c4c4d20955f5', 1, '10.0.0.66', '2017-01-09 07:37:12', '0000-00-00 00:00:00', '2017-01-09'),
(20, 'c4aaa979846692cac90f89956258f47f', 1, '10.0.0.65', '2017-01-09 09:04:57', '0000-00-00 00:00:00', '2017-01-09'),
(21, 'e32e69b521ef40323ce5dd1b098364b2', 1, '10.0.0.66', '2017-01-10 04:19:17', '0000-00-00 00:00:00', '2017-01-10'),
(22, 'a15933a3ef2a5e8a91a00afe84c9fae6', 1, '10.0.0.66', '2017-01-11 10:34:34', '0000-00-00 00:00:00', '2017-01-11'),
(23, '73328a95179a20ece6e918d23df6284c', 1, '10.0.0.66', '2017-01-13 04:08:56', '0000-00-00 00:00:00', '2017-01-13'),
(24, '6abaf453c1f57d4341b47caded0dec04', 1, '10.0.0.65', '2017-01-13 04:38:40', '0000-00-00 00:00:00', '2017-01-13'),
(25, 'e63dea623ca4b8fee96262a5f4b1f30e', 1, '10.0.0.66', '2017-01-13 11:01:15', '0000-00-00 00:00:00', '2017-01-13'),
(26, '4fc7c4a570f9c39e5540f91a906aa6c2', 1, '10.0.0.66', '2017-01-16 04:17:22', '0000-00-00 00:00:00', '2017-01-16'),
(27, 'ecdaea675717d0c59025103e514110ad', 1, '10.0.0.65', '2017-01-16 04:52:28', '0000-00-00 00:00:00', '2017-01-16'),
(28, '8c220d645537be4b2722ca8dd6c1594a', 1, '10.0.0.66', '2017-01-16 05:31:50', '0000-00-00 00:00:00', '2017-01-16'),
(29, '8c735fa99bdfddd0a857722cf11ed554', 1, '10.0.0.65', '2017-01-16 11:44:28', '0000-00-00 00:00:00', '2017-01-16'),
(30, 'dd47c8ca6d0254ee96351c818b4e1ea9', 1, '10.0.0.66', '2017-01-16 12:14:58', '0000-00-00 00:00:00', '2017-01-16'),
(31, '5632504fb3be6f9de91ae3ce7f692aac', 1, '10.0.0.66', '2017-01-17 04:37:33', '0000-00-00 00:00:00', '2017-01-17'),
(32, '6b9be264ce74ba726786061048ed63fa', 1, '10.0.0.65', '2017-01-17 08:42:20', '0000-00-00 00:00:00', '2017-01-17'),
(33, '93605ea740540c9674c697c50e31885c', 1, '10.0.0.66', '2017-01-17 08:59:17', '0000-00-00 00:00:00', '2017-01-17'),
(34, '20f5e488c55186c9cde3682c8e398079', 1, '10.0.0.66', '2017-01-17 09:22:31', '0000-00-00 00:00:00', '2017-01-17'),
(35, 'a40dffa803777ad9680a9f6b0da2c86a', 1, '10.0.0.66', '2017-01-17 09:29:28', '0000-00-00 00:00:00', '2017-01-17'),
(36, 'c40c19a0c0b798dc2ec6881476ad38f1', 1, '10.0.0.67', '2017-01-17 10:00:01', '0000-00-00 00:00:00', '2017-01-17'),
(37, 'd1c02f1a6a2a6ead873dd18d76e16258', 1, '10.0.0.66', '2017-01-17 13:49:42', '0000-00-00 00:00:00', '2017-01-17'),
(38, 'b155acbb138e9a7a6a7f2d27217a056b', 1, '10.0.0.65', '2017-01-18 04:59:18', '0000-00-00 00:00:00', '2017-01-18'),
(39, '663b019a884705a0a86a1f8ca7ea24b1', 1, '10.0.0.66', '2017-01-18 05:20:34', '0000-00-00 00:00:00', '2017-01-18'),
(40, '7dd0a3d234d362b20df6a1f9460c5cbf', 1, '10.0.0.66', '2017-01-18 11:52:50', '0000-00-00 00:00:00', '2017-01-18'),
(41, 'e181b0c25dc43648d9ace08dd2844fa3', 1, '10.0.0.66', '2017-01-18 14:25:58', '0000-00-00 00:00:00', '2017-01-18'),
(42, '43f294649e7b9677339beb3e19c69ea4', 1, '10.0.0.65', '2017-01-18 14:26:13', '0000-00-00 00:00:00', '2017-01-18'),
(43, 'bf5d45f17c51fd437911121daafbad02', 1, '10.0.0.66', '2017-01-18 14:33:57', '0000-00-00 00:00:00', '2017-01-18'),
(44, 'a1272d541996495e09ee7f617c092241', 1, '10.0.0.65', '2017-01-19 04:28:36', '0000-00-00 00:00:00', '2017-01-19'),
(45, 'a9cefeccf73869b326be6a9cdfc826f8', 1, '10.0.0.66', '2017-01-19 04:57:56', '0000-00-00 00:00:00', '2017-01-19'),
(46, '769af18f240478451df4291d0207859b', 1, '10.0.0.66', '2017-01-19 09:55:23', '0000-00-00 00:00:00', '2017-01-19'),
(47, 'e9bd5d25f3a4affc4fb89c51a3160b89', 1, '10.0.0.65', '2017-01-19 12:31:24', '0000-00-00 00:00:00', '2017-01-19'),
(48, '67fc348785aaf3f0bc6b661ea44055c3', 1, '10.0.0.66', '2017-01-20 04:47:15', '0000-00-00 00:00:00', '2017-01-20'),
(49, '0ef7b46a78641daed61bb7fa1eb8a1e3', 1, '10.0.0.66', '2017-01-20 06:40:49', '0000-00-00 00:00:00', '2017-01-20'),
(50, '29004c220ef4a509d6e1e221ba805dad', 1, '10.0.0.66', '2017-01-20 09:52:46', '0000-00-00 00:00:00', '2017-01-20'),
(51, '616413256dd6e97ab25b8238822f59fb', 1, '10.0.0.66', '2017-01-20 10:01:14', '0000-00-00 00:00:00', '2017-01-20'),
(52, '616413256dd6e97ab25b8238822f59fb', 1, '10.0.0.66', '2017-01-20 10:04:14', '0000-00-00 00:00:00', '2017-01-20'),
(53, '96bb9c9691473f156632adc19a80cdfa', 1, '10.0.0.66', '2017-01-20 10:13:15', '0000-00-00 00:00:00', '2017-01-20'),
(54, '96bb9c9691473f156632adc19a80cdfa', 1, '10.0.0.66', '2017-01-20 10:16:07', '0000-00-00 00:00:00', '2017-01-20'),
(55, '360cd888f8d3e29898625713dce0cd2c', 1, '10.0.0.68', '2017-01-20 10:28:41', '0000-00-00 00:00:00', '2017-01-20'),
(56, 'cd91cd74f50f2be821d8bd744032158a', 1, '10.0.0.66', '2017-01-23 04:37:01', '0000-00-00 00:00:00', '2017-01-23'),
(57, 'cd91cd74f50f2be821d8bd744032158a', 1, '10.0.0.66', '2017-01-23 04:41:11', '0000-00-00 00:00:00', '2017-01-23'),
(58, 'fa0111d2152295c1c30bfdb7549f3f2c', 1, '10.0.0.80', '2017-01-23 04:43:43', '0000-00-00 00:00:00', '2017-01-23'),
(59, '339891b4a46b3c2c3270696b410a7e33', 1, '10.0.0.80', '2017-01-23 04:49:51', '0000-00-00 00:00:00', '2017-01-23'),
(60, 'b4760f4228f8c400f02cb6b5ea73299f', 1, '10.0.0.80', '2017-01-23 05:24:51', '0000-00-00 00:00:00', '2017-01-23'),
(61, 'cef918f3c86aea52a020d42a11dcc7d0', 1, '10.0.0.80', '2017-01-23 05:25:53', '0000-00-00 00:00:00', '2017-01-23'),
(62, 'cac3ecca0b4f62064179a0924054d104', 1, '10.0.0.80', '2017-01-23 07:43:15', '0000-00-00 00:00:00', '2017-01-23'),
(63, '00390e7ffff3bd3d04ae83eab640fd14', 1, '10.0.0.80', '2017-01-23 08:00:45', '0000-00-00 00:00:00', '2017-01-23'),
(64, 'b556933961e1ee825ca43798ab6719b2', 1, '10.0.0.80', '2017-01-23 11:57:17', '0000-00-00 00:00:00', '2017-01-23'),
(65, 'f79437dea8d39b53c465b8326d0f5859', 1, '10.0.0.80', '2017-01-24 04:44:49', '0000-00-00 00:00:00', '2017-01-24'),
(66, '134a05589ace1d95c97a02f9b61a1418', 1, '10.0.0.80', '2017-01-24 09:43:21', '0000-00-00 00:00:00', '2017-01-24'),
(67, 'a73f8dee3783c4dad04a6b4bc1123c68', 1, '10.0.0.80', '2017-01-25 04:46:23', '0000-00-00 00:00:00', '2017-01-25'),
(68, '50d5e5ba180a098200a4ebbd5c20c28c', 1, '10.0.0.65', '2017-01-25 05:34:33', '0000-00-00 00:00:00', '2017-01-25'),
(69, 'f95aefacab20e47a7e28ca8042eaef08', 1, '10.0.0.80', '2017-01-27 04:35:36', '0000-00-00 00:00:00', '2017-01-27'),
(70, 'b75c58eddbd922e4f4d44c79bc37c17b', 1, '10.0.0.65', '2017-01-27 09:00:47', '0000-00-00 00:00:00', '2017-01-27'),
(71, '2be08a3d449ea0dbd7a9fbbb3cd2bfa7', 1, '10.0.0.80', '2017-01-27 09:02:07', '0000-00-00 00:00:00', '2017-01-27'),
(72, 'a4b755d179e22939544188ff88a1033f', 1, '10.0.0.80', '2017-01-27 12:07:07', '0000-00-00 00:00:00', '2017-01-27'),
(73, '307da316263ac0878a2ba58967fa9247', 1, '10.0.0.80', '2017-01-27 12:32:21', '0000-00-00 00:00:00', '2017-01-27'),
(74, '447861468801ab6e7f0d8e452d06e840', 1, '10.0.0.80', '2017-01-27 12:39:01', '0000-00-00 00:00:00', '2017-01-27'),
(75, '8376a1bc68de96c7d38b309b68e9f2d3', 1, '10.0.0.80', '2017-01-27 12:58:43', '0000-00-00 00:00:00', '2017-01-27'),
(76, '5d36613af66d019fdc3dd2b124b27d6b', 1, '10.0.0.80', '2017-01-27 13:14:08', '0000-00-00 00:00:00', '2017-01-27'),
(77, '6d2c1fedb01506d6ce6939d60c63fabc', 1, '10.0.0.80', '2017-01-30 04:55:42', '0000-00-00 00:00:00', '2017-01-30'),
(78, '2ee4804ee89f3d13fbc96adf539226ae', 1, '10.0.0.80', '2017-01-31 09:01:28', '0000-00-00 00:00:00', '2017-01-31'),
(79, '14660c45c08591ea30f5fee3d6ef2fd6', 1, '10.0.0.80', '2017-01-31 10:42:59', '0000-00-00 00:00:00', '2017-01-31'),
(80, '14660c45c08591ea30f5fee3d6ef2fd6', 1, '10.0.0.80', '2017-01-31 10:44:33', '0000-00-00 00:00:00', '2017-01-31'),
(81, 'a6f109fb349b7a60865668fb227ed4ae', 1, '10.0.0.80', '2017-01-31 11:37:47', '0000-00-00 00:00:00', '2017-01-31'),
(82, '2e8b36ee7c97e6858c46aee963718274', 1, '10.0.0.80', '2017-01-31 12:18:58', '0000-00-00 00:00:00', '2017-01-31'),
(83, '7384b90a28375f5176e8979c8c53b8d7', 1, '10.0.0.80', '2017-02-01 04:59:15', '0000-00-00 00:00:00', '2017-02-01'),
(84, 'a41dd78262807b30167de9cb0a5691ff', 1, '10.0.0.80', '2017-02-01 10:54:39', '0000-00-00 00:00:00', '2017-02-01'),
(85, '04079e7b434704a4cc9de70d7201bb85', 1, '10.0.0.80', '2017-02-02 04:58:14', '0000-00-00 00:00:00', '2017-02-02'),
(86, '34eabc87437f16cb2d77c01ae16e087a', 24, '10.0.0.80', '2017-02-02 05:01:49', '0000-00-00 00:00:00', '2017-02-02'),
(87, '7659819ac4a0688060d0481b016d0669', 25, '10.0.0.80', '2017-02-02 07:24:30', '0000-00-00 00:00:00', '2017-02-02'),
(88, 'e78ebd28f1621e506cbcce0f6e6153e7', 24, '10.0.0.80', '2017-02-02 11:10:20', '0000-00-00 00:00:00', '2017-02-02'),
(89, '1d62291c4d6581fd3df7adf7d4fed0f7', 24, '10.0.0.80', '2017-02-02 11:10:53', '0000-00-00 00:00:00', '2017-02-02'),
(90, '2d447186b82a4473ebd4719aa848bb66', 24, '10.0.0.80', '2017-02-02 11:39:22', '0000-00-00 00:00:00', '2017-02-02'),
(91, 'f0a9b27a4575322a89e7df4e28b15c66', 24, '10.0.0.80', '2017-02-02 12:19:15', '0000-00-00 00:00:00', '2017-02-02'),
(92, 'f0a9b27a4575322a89e7df4e28b15c66', 24, '10.0.0.80', '2017-02-02 12:21:28', '0000-00-00 00:00:00', '2017-02-02'),
(93, 'b0188938523964d7f5f8649e936a5cb6', 1, '10.0.0.80', '2017-02-02 12:23:10', '0000-00-00 00:00:00', '2017-02-02'),
(94, 'b0188938523964d7f5f8649e936a5cb6', 24, '10.0.0.80', '2017-02-02 12:23:20', '0000-00-00 00:00:00', '2017-02-02'),
(95, '05243bf1e235b4ab56ee8c9ee15f7743', 1, '10.0.0.80', '2017-02-02 13:14:38', '0000-00-00 00:00:00', '2017-02-02'),
(96, '38168f065619d89109c9f04806ffaa53', 1, '10.0.0.80', '2017-02-03 04:48:17', '0000-00-00 00:00:00', '2017-02-03'),
(97, '8d3a47a0c906cb9abb48b2a36e74c696', 1, '10.0.0.80', '2017-02-03 12:46:53', '0000-00-00 00:00:00', '2017-02-03'),
(98, '343936cdff874d939f2a8bd9b1436f34', 1, '10.0.0.80', '2017-02-06 04:51:18', '0000-00-00 00:00:00', '2017-02-06'),
(99, '4c4c0c809a6da4dc366e8465fc8970d4', 24, '10.0.0.80', '2017-02-06 04:58:47', '0000-00-00 00:00:00', '2017-02-06'),
(100, '5958fe0106daa28f076fde1b70c0bf00', 1, '10.0.0.80', '2017-02-06 05:49:59', '0000-00-00 00:00:00', '2017-02-06'),
(101, '1615c5c2e33840c5c0cd0582ec9e36e6', 24, '10.0.0.80', '2017-02-06 06:02:12', '0000-00-00 00:00:00', '2017-02-06'),
(102, '110832ea01b88756e69f8069ff654375', 1, '10.0.0.80', '2017-02-06 06:35:30', '0000-00-00 00:00:00', '2017-02-06'),
(103, 'df4040798827103c46f3922506b29cfd', 1, '10.0.0.80', '2017-02-06 11:22:20', '0000-00-00 00:00:00', '2017-02-06'),
(104, '564c03cd3c8a8da0baf73bf7a4233682', 1, '10.0.0.80', '2017-02-07 05:01:53', '0000-00-00 00:00:00', '2017-02-07'),
(105, '0b0adeaecce6aa2d0d4a0c042c6738c4', 1, '10.0.0.80', '2017-02-08 04:52:37', '0000-00-00 00:00:00', '2017-02-08'),
(106, '617df490127dbb2406c70b618f6a052d', 1, '10.0.0.80', '2017-02-09 09:58:40', '0000-00-00 00:00:00', '2017-02-09'),
(107, '1e87a50873d10b6e8bd64823bd72bcf2', 1, '10.0.0.80', '2017-02-10 05:07:15', '0000-00-00 00:00:00', '2017-02-10'),
(108, '425f1c00a65a2aa30fb542055cd1a245', 1, '10.0.0.80', '2017-02-13 05:12:22', '0000-00-00 00:00:00', '2017-02-13'),
(109, '2045ef82ac01e2749ae9c1c50d82722c', 1, '10.0.0.127', '2017-02-13 05:41:13', '0000-00-00 00:00:00', '2017-02-13'),
(110, '2e39e2f92b3a758a2214b64bd52e673e', 1, '10.0.0.80', '2017-02-13 06:41:41', '0000-00-00 00:00:00', '2017-02-13'),
(111, 'a3170f29a9892cb70419d1ae86f90766', 1, '10.0.0.80', '2017-02-13 09:10:05', '0000-00-00 00:00:00', '2017-02-13'),
(112, 'c69e054df97b05f73df3989ae9d449e6', 1, '10.0.0.80', '2017-02-13 10:03:46', '0000-00-00 00:00:00', '2017-02-13'),
(113, '762c0b32cd8adda680f3753415cb8b36', 1, '10.0.0.80', '2017-02-13 12:18:59', '0000-00-00 00:00:00', '2017-02-13'),
(114, 'a8219c41feeb5ddfbd4ec490cb32d02f', 1, '10.0.0.127', '2017-02-14 04:08:49', '0000-00-00 00:00:00', '2017-02-14'),
(115, '52a4d62af8c706f45f49ca72db41fb91', 1, '10.0.0.80', '2017-02-14 06:24:39', '0000-00-00 00:00:00', '2017-02-14'),
(116, 'cf920165d77ed7f0b1f8452f3f984737', 1, '10.0.0.80', '2017-02-14 12:10:29', '0000-00-00 00:00:00', '2017-02-14'),
(117, 'e4f62f0493050cd99ca1d511566b8d4d', 1, '10.0.0.127', '2017-02-15 03:57:29', '0000-00-00 00:00:00', '2017-02-15'),
(118, '919a22bb87fefe315251e3e08a7bf19b', 1, '10.0.0.80', '2017-02-15 04:54:31', '0000-00-00 00:00:00', '2017-02-15'),
(119, '1f28c06a202b1c2ebdfcde82c608a2e5', 1, '10.0.0.80', '2017-02-15 08:40:01', '0000-00-00 00:00:00', '2017-02-15'),
(120, '90f92c7951865744b05a65ddc4122ab7', 1, '10.0.0.127', '2017-02-16 03:56:03', '0000-00-00 00:00:00', '2017-02-16'),
(121, 'c7dfd8fe32175779242687598899f871', 1, '10.0.0.80', '2017-02-16 07:53:17', '0000-00-00 00:00:00', '2017-02-16'),
(122, '71ea3d2210e134873806ff1605a698a6', 1, '10.0.0.127', '2017-02-17 04:00:47', '0000-00-00 00:00:00', '2017-02-17'),
(123, 'cac1d23668471e07f2da7d3571854e30', 1, '10.0.0.80', '2017-02-17 05:56:32', '0000-00-00 00:00:00', '2017-02-17'),
(124, 'c9121e9a7f8354b5382bd93a8a396586', 1, '10.0.0.127', '2017-02-20 04:01:45', '0000-00-00 00:00:00', '2017-02-20'),
(125, '00d13cf194b8325d06baa237ae4cf94f', 1, '10.0.0.80', '2017-02-20 05:07:06', '0000-00-00 00:00:00', '2017-02-20'),
(126, '7121df4e8fe72fd282175437c2a82d2c', 1, '10.0.0.127', '2017-02-21 04:19:10', '0000-00-00 00:00:00', '2017-02-21'),
(127, '2ca89a18f9f432c4de1f8d6f7495c809', 1, '10.0.0.80', '2017-02-21 04:54:13', '0000-00-00 00:00:00', '2017-02-21'),
(128, '9a1e79438567faf157b1ef7d84a8f763', 1, '10.0.0.127', '2017-02-21 05:09:16', '0000-00-00 00:00:00', '2017-02-21'),
(129, '7a972255e7b4b0adfea060a75c17b88d', 1, '10.0.0.127', '2017-02-21 05:10:16', '0000-00-00 00:00:00', '2017-02-21'),
(130, 'cca613684f1a7b78d91374e510a31ccc', 1, '10.0.0.80', '2017-02-21 11:59:17', '0000-00-00 00:00:00', '2017-02-21'),
(131, 'f44b017c5937aa75b719dd98ae934b07', 1, '10.0.0.80', '2017-02-21 12:04:31', '0000-00-00 00:00:00', '2017-02-21'),
(132, '88dc85dd41ff5b49d5cf813defa17139', 1, '10.0.0.80', '2017-02-21 12:14:41', '0000-00-00 00:00:00', '2017-02-21'),
(133, '59af161257ed6bf122d6abd74795eb67', 1, '10.0.0.80', '2017-02-21 12:18:30', '0000-00-00 00:00:00', '2017-02-21'),
(134, '00235faf3fe502acc9f7d656c29a7b7d', 1, '10.0.0.80', '2017-02-21 12:25:48', '0000-00-00 00:00:00', '2017-02-21');

-- --------------------------------------------------------

--
-- Table structure for table `ld_system_config`
--

DROP TABLE IF EXISTS `ld_system_config`;
CREATE TABLE IF NOT EXISTS `ld_system_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `systemName` varchar(250) NOT NULL,
  `systemVal` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `ld_system_config`
--

INSERT INTO `ld_system_config` (`id`, `systemName`, `systemVal`) VALUES
(2, 'SITE_NAME', 'Logistic'),
(3, 'SITE_EMAIL', 'corephp0@gmail.com'),
(4, 'EMAIL_US', 'sean@sparxitsolutions.com'),
(5, 'TIMEZONE', 'Asia/Kolkata'),
(6, 'SHIFT_START_TIME', '9:00 AM'),
(7, 'SHIFT_END_TIME', '6:00 PM');

-- --------------------------------------------------------

--
-- Table structure for table `ld_timesheet`
--

DROP TABLE IF EXISTS `ld_timesheet`;
CREATE TABLE IF NOT EXISTS `ld_timesheet` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `entry_date` date NOT NULL,
  `in_time` time NOT NULL,
  `out_time` time NOT NULL,
  `emp_id` int(11) unsigned NOT NULL,
  `remarks` text NOT NULL,
  `ut` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `total_hours` float NOT NULL,
  `extra_hour` float NOT NULL DEFAULT '0',
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `ld_timesheet`
--

INSERT INTO `ld_timesheet` (`id`, `entry_date`, `in_time`, `out_time`, `emp_id`, `remarks`, `ut`, `total_hours`, `extra_hour`, `deleted_at`) VALUES
(1, '2017-02-01', '09:00:00', '19:00:00', 29, 'test', '2017-02-20 09:46:51', 10, 1, '2017-02-20 10:23:24'),
(2, '2017-02-02', '11:30:00', '18:00:00', 27, 'testing', '2017-02-20 09:48:45', 6.5, 0, '2017-02-20 10:45:39'),
(3, '2017-02-01', '09:00:00', '18:00:00', 27, 'test', '2017-02-20 10:00:35', 9, 1.7, '2017-02-20 10:45:39'),
(4, '2017-02-20', '10:00:00', '18:00:00', 29, 'the quick', '2017-02-20 10:51:27', 8, 0, '2017-02-21 05:21:59'),
(5, '2017-02-20', '10:00:00', '18:00:00', 27, '', '2017-02-20 10:54:49', 8, 0, '2017-02-21 05:21:59'),
(6, '2017-01-20', '09:00:00', '18:00:00', 23, '', '2017-02-20 12:14:11', 9, 3, '2017-02-21 05:21:59'),
(7, '2017-02-20', '09:00:00', '18:00:00', 22, '', '2017-02-20 13:05:40', 9, 0, '2017-02-21 05:21:59'),
(8, '2017-02-20', '09:00:00', '18:00:00', 23, '', '2017-02-20 13:06:08', 9, 0, '2017-02-21 05:21:59'),
(9, '2017-02-20', '09:00:00', '18:00:00', 21, '', '2017-02-20 13:07:48', 9, 0, '2017-02-21 05:21:59'),
(10, '2017-02-23', '09:00:00', '18:00:00', 29, '', '2017-02-20 13:11:15', 9, 0, '2017-02-21 05:21:59'),
(11, '2017-02-20', '09:00:00', '18:00:00', 24, '', '2017-02-20 13:12:42', 9, 0, '2017-02-21 05:21:59'),
(12, '2017-02-21', '09:00:00', '18:00:00', 22, '', '2017-02-21 04:26:15', 9, 0, '2017-02-21 05:21:59'),
(13, '2017-02-01', '09:00:00', '19:00:00', 27, 'the quick', '2017-02-21 06:07:01', 10, 1, NULL),
(14, '2017-02-21', '09:00:00', '18:00:00', 23, '', '2017-02-21 06:42:24', 9, 0, NULL),
(15, '2017-02-21', '09:00:00', '18:00:00', 21, '', '2017-02-21 06:55:11', 9, 0, NULL),
(16, '2017-02-21', '09:00:00', '18:00:00', 22, '', '2017-02-21 06:55:55', 9, 0, NULL),
(17, '2017-02-21', '09:00:00', '18:00:00', 26, '', '2017-02-21 07:04:48', 9, 12, NULL),
(18, '2017-02-21', '08:59:00', '18:00:00', 29, 'New testing', '2017-02-21 10:43:27', 9.02, 0, NULL),
(19, '2017-02-21', '09:00:00', '18:00:00', 27, '', '2017-02-21 10:59:21', 9, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ld_timezones`
--

DROP TABLE IF EXISTS `ld_timezones`;
CREATE TABLE IF NOT EXISTS `ld_timezones` (
  `id` tinyint(4) unsigned NOT NULL AUTO_INCREMENT,
  `timezone` varchar(50) NOT NULL,
  `display_name` varchar(100) NOT NULL,
  `offset` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=113 ;

--
-- Dumping data for table `ld_timezones`
--

INSERT INTO `ld_timezones` (`id`, `timezone`, `display_name`, `offset`) VALUES
(1, 'Pacific/Midway', '(GMT-11:00) Midway Island', 'GMT-11:00'),
(2, 'US/Samoa', '(GMT-11:00) Samoa', 'GMT-11:00'),
(3, 'US/Hawaii', '(GMT-10:00) Hawaii', 'GMT-10:00'),
(4, 'US/Alaska', '(GMT-09:00) Alaska', 'GMT-09:00'),
(5, 'US/Pacific', '(GMT-08:00) Pacific Time (US &amp; Canada)', 'GMT-08:00'),
(6, 'America/Tijuana', '(GMT-08:00) Tijuana', 'GMT-08:00'),
(7, 'US/Arizona', '(GMT-07:00) Arizona', 'GMT-07:00'),
(8, 'US/Mountain', '(GMT-07:00) Mountain Time (US &amp; Canada)', 'GMT-07:00'),
(9, 'America/Chihuahua', '(GMT-07:00) Chihuahua', 'GMT-07:00'),
(10, 'America/Mazatlan', '(GMT-07:00) Mazatlan', 'GMT-07:00'),
(11, 'America/Mexico_City', '(GMT-06:00) Mexico City', 'GMT-06:00'),
(12, 'America/Monterrey', '(GMT-06:00) Monterrey', 'GMT-06:00'),
(13, 'Canada/Saskatchewan', '(GMT-06:00) Saskatchewan', 'GMT-06:00'),
(14, 'US/Central', '(GMT-06:00) Central Time (US &amp; Canada)', 'GMT-06:00'),
(15, 'US/Eastern', '(GMT-05:00) Eastern Time (US &amp; Canada)', 'GMT-05:00'),
(16, 'US/East-Indiana', '(GMT-05:00) Indiana (East)', 'GMT-05:00'),
(17, 'America/Bogota', '(GMT-05:00) Bogota', 'GMT-05:00'),
(18, 'America/Lima', '(GMT-05:00) Lima', 'GMT-05:00'),
(19, 'America/Caracas', '(GMT-04:30) Caracas', 'GMT-04:30'),
(20, 'Canada/Atlantic', '(GMT-04:00) Atlantic Time (Canada)', 'GMT-04:00'),
(21, 'America/La_Paz', '(GMT-04:00) La Paz', 'GMT-04:00'),
(22, 'America/Santiago', '(GMT-04:00) Santiago', 'GMT-04:00'),
(23, 'Canada/Newfoundland', '(GMT-03:30) Newfoundland', 'GMT-03:30'),
(24, 'America/Buenos_Aires', '(GMT-03:00) Buenos Aires', 'GMT-03:00'),
(25, 'Greenland', '(GMT-03:00) Greenland', 'GMT-03:00'),
(26, 'Atlantic/Stanley', '(GMT-02:00) Stanley', 'GMT-02:00'),
(27, 'Atlantic/Azores', '(GMT-01:00) Azores', 'GMT-01:00'),
(28, 'Atlantic/Cape_Verde', '(GMT-01:00) Cape Verde Is.', 'GMT-01:00'),
(29, 'Africa/Casablanca', '(GMT) Casablanca', 'GMT'),
(30, 'Europe/Dublin', '(GMT) Dublin', 'GMT'),
(31, 'Europe/Lisbon', '(GMT) Lisbon', 'GMT'),
(32, 'Europe/London', '(GMT) London', 'GMT'),
(33, 'Africa/Monrovia', '(GMT) Monrovia', 'GMT'),
(34, 'Europe/Amsterdam', '(GMT+01:00) Amsterdam', 'GMT+01:00'),
(35, 'Europe/Belgrade', '(GMT+01:00) Belgrade', 'GMT+01:00'),
(36, 'Europe/Berlin', '(GMT+01:00) Berlin', 'GMT+01:00'),
(37, 'Europe/Bratislava', '(GMT+01:00) Bratislava', 'GMT+01:00'),
(38, 'Europe/Brussels', '(GMT+01:00) Brussels', 'GMT+01:00'),
(39, 'Europe/Budapest', '(GMT+01:00) Budapest', 'GMT+01:00'),
(40, 'Europe/Copenhagen', '(GMT+01:00) Copenhagen', 'GMT+01:00'),
(41, 'Europe/Ljubljana', '(GMT+01:00) Ljubljana', 'GMT+01:00'),
(42, 'Europe/Madrid', '(GMT+01:00) Madrid', 'GMT+01:00'),
(43, 'Europe/Paris', '(GMT+01:00) Paris', 'GMT+01:00'),
(44, 'Europe/Prague', '(GMT+01:00) Prague', 'GMT+01:00'),
(45, 'Europe/Rome', '(GMT+01:00) Rome', 'GMT+01:00'),
(46, 'Europe/Sarajevo', '(GMT+01:00) Sarajevo', 'GMT+01:00'),
(47, 'Europe/Skopje', '(GMT+01:00) Skopje', 'GMT+01:00'),
(48, 'Europe/Stockholm', '(GMT+01:00) Stockholm', 'GMT+01:00'),
(49, 'Europe/Vienna', '(GMT+01:00) Vienna', 'GMT+01:00'),
(50, 'Europe/Warsaw', '(GMT+01:00) Warsaw', 'GMT+01:00'),
(51, 'Europe/Zagreb', '(GMT+01:00) Zagreb', 'GMT+01:00'),
(52, 'Europe/Athens', '(GMT+02:00) Athens', 'GMT+02:00'),
(53, 'Europe/Bucharest', '(GMT+02:00) Bucharest', 'GMT+02:00'),
(54, 'Africa/Cairo', '(GMT+02:00) Cairo', 'GMT+02:00'),
(55, 'Africa/Harare', '(GMT+02:00) Harare', 'GMT+02:00'),
(56, 'Europe/Helsinki', '(GMT+02:00) Helsinki', 'GMT+02:00'),
(57, 'Europe/Istanbul', '(GMT+02:00) Istanbul', 'GMT+02:00'),
(58, 'Asia/Jerusalem', '(GMT+02:00) Jerusalem', 'GMT+02:00'),
(59, 'Europe/Kiev', '(GMT+02:00) Kyiv', 'GMT+02:00'),
(60, 'Europe/Minsk', '(GMT+02:00) Minsk', 'GMT+02:00'),
(61, 'Europe/Riga', '(GMT+02:00) Riga', 'GMT+02:00'),
(62, 'Europe/Sofia', '(GMT+02:00) Sofia', 'GMT+02:00'),
(63, 'Europe/Tallinn', '(GMT+02:00) Tallinn', 'GMT+02:00'),
(64, 'Europe/Vilnius', '(GMT+02:00) Vilnius', 'GMT+02:00'),
(65, 'Asia/Baghdad', '(GMT+03:00) Baghdad', 'GMT+03:00'),
(66, 'Asia/Kuwait', '(GMT+03:00) Kuwait', 'GMT+03:00'),
(67, 'Africa/Nairobi', '(GMT+03:00) Nairobi', 'GMT+03:00'),
(68, 'Asia/Riyadh', '(GMT+03:00) Riyadh', 'GMT+03:00'),
(69, 'Europe/Moscow', '(GMT+03:00) Moscow', 'GMT+03:00'),
(70, 'Asia/Tehran', '(GMT+03:30) Tehran', 'GMT+03:30'),
(71, 'Asia/Baku', '(GMT+04:00) Baku', 'GMT+04:00'),
(72, 'Europe/Volgograd', '(GMT+04:00) Volgograd', 'GMT+04:00'),
(73, 'Asia/Muscat', '(GMT+04:00) Muscat', 'GMT+04:00'),
(74, 'Asia/Tbilisi', '(GMT+04:00) Tbilisi', 'GMT+04:00'),
(75, 'Asia/Yerevan', '(GMT+04:00) Yerevan', 'GMT+04:00'),
(76, 'Asia/Kabul', '(GMT+04:30) Kabul', 'GMT+04:30'),
(77, 'Asia/Karachi', '(GMT+05:00) Karachi', 'GMT+05:00'),
(78, 'Asia/Tashkent', '(GMT+05:00) Tashkent', 'GMT+05:00'),
(79, 'Asia/Kolkata', '(GMT+05:30) Kolkata', 'GMT+05:30'),
(80, 'Asia/Kathmandu', '(GMT+05:45) Kathmandu', 'GMT+05:45'),
(81, 'Asia/Yekaterinburg', '(GMT+06:00) Ekaterinburg', 'GMT+06:00'),
(82, 'Asia/Almaty', '(GMT+06:00) Almaty', 'GMT+06:00'),
(83, 'Asia/Dhaka', '(GMT+06:00) Dhaka', 'GMT+06:00'),
(84, 'Asia/Novosibirsk', '(GMT+07:00) Novosibirsk', 'GMT+07:00'),
(85, 'Asia/Bangkok', '(GMT+07:00) Bangkok', 'GMT+07:00'),
(86, 'Asia/Jakarta', '(GMT+07:00) Jakarta', 'GMT+07:00'),
(87, 'Asia/Krasnoyarsk', '(GMT+08:00) Krasnoyarsk', 'GMT+08:00'),
(88, 'Asia/Chongqing', '(GMT+08:00) Chongqing', 'GMT+08:00'),
(89, 'Asia/Hong_Kong', '(GMT+08:00) Hong Kong', 'GMT+08:00'),
(90, 'Asia/Kuala_Lumpur', '(GMT+08:00) Kuala Lumpur', 'GMT+08:00'),
(91, 'Australia/Perth', '(GMT+08:00) Perth', 'GMT+08:00'),
(92, 'Asia/Singapore', '(GMT+08:00) Singapore', 'GMT+08:00'),
(93, 'Asia/Taipei', '(GMT+08:00) Taipei', 'GMT+08:00'),
(94, 'Asia/Ulaanbaatar', '(GMT+08:00) Ulaan Bataar', 'GMT+08:00'),
(95, 'Asia/Urumqi', '(GMT+08:00) Urumqi', 'GMT+08:00'),
(96, 'Asia/Irkutsk', '(GMT+09:00) Irkutsk', 'GMT+09:00'),
(97, 'Asia/Seoul', '(GMT+09:00) Seoul', 'GMT+09:00'),
(98, 'Asia/Tokyo', '(GMT+09:00) Tokyo', 'GMT+09:00'),
(99, 'Australia/Adelaide', '(GMT+09:30) Adelaide', 'GMT+09:30'),
(100, 'Australia/Darwin', '(GMT+09:30) Darwin', 'GMT+09:30'),
(101, 'Asia/Yakutsk', '(GMT+10:00) Yakutsk', 'GMT+10:00'),
(102, 'Australia/Brisbane', '(GMT+10:00) Brisbane', 'GMT+10:00'),
(103, 'Australia/Canberra', '(GMT+10:00) Canberra', 'GMT+10:00'),
(104, 'Pacific/Guam', '(GMT+10:00) Guam', 'GMT+10:00'),
(105, 'Australia/Hobart', '(GMT+10:00) Hobart', 'GMT+10:00'),
(106, 'Australia/Melbourne', '(GMT+10:00) Melbourne', 'GMT+10:00'),
(107, 'Pacific/Port_Moresby', '(GMT+10:00) Port Moresby', 'GMT+10:00'),
(108, 'Australia/Sydney', '(GMT+10:00) Sydney', 'GMT+10:00'),
(109, 'Asia/Vladivostok', '(GMT+11:00) Vladivostok', 'GMT+11:00'),
(110, 'Asia/Magadan', '(GMT+12:00) Magadan', 'GMT+12:00'),
(111, 'Pacific/Auckland', '(GMT+12:00) Auckland', 'GMT+12:00'),
(112, 'Pacific/Fiji', '(GMT+12:00) Fiji', 'GMT+12:00');

-- --------------------------------------------------------

--
-- Table structure for table `ld_vehicles`
--

DROP TABLE IF EXISTS `ld_vehicles`;
CREATE TABLE IF NOT EXISTS `ld_vehicles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `regn_number` varchar(255) NOT NULL,
  `model` text NOT NULL,
  `status` enum('inactive','active') NOT NULL,
  `created_at` datetime NOT NULL,
  `added_by` int(10) unsigned NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `ld_vehicles`
--

INSERT INTO `ld_vehicles` (`id`, `regn_number`, `model`, `status`, `created_at`, `added_by`, `updated_at`, `deleted_at`) VALUES
(1, 'sparx', 'the quickspard', 'inactive', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '2017-02-10 06:56:53'),
(2, 'schools', 'the quick brown fox', 'inactive', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '2017-02-10 06:56:53'),
(3, 'fadfadsfadsf adsfasd', 'dfadsfad  ', 'inactive', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '2017-02-10 06:56:18'),
(4, 'dfadsfa', ' fadsfads', 'inactive', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '2017-02-10 06:56:53'),
(5, 'Accounts', 'dggdfg ', 'inactive', '0000-00-00 00:00:00', 0, '2017-01-23 08:57:53', '2017-02-10 06:56:53'),
(6, 'testsss', ' dfgdfg ssss', 'inactive', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '2017-02-10 06:56:53'),
(9, 'ryry', 'reyrty', 'inactive', '2017-01-23 08:57:21', 0, '0000-00-00 00:00:00', '2017-02-10 06:56:53'),
(15, 'VEHICLE-REGN-1', 'MODEL-A', 'active', '2017-02-10 06:36:27', 1, '2017-02-13 10:02:08', NULL),
(16, 'VEHICLE-REGN-2', 'MODEL-B', 'inactive', '2017-02-10 06:36:48', 1, '2017-02-10 07:50:25', NULL),
(17, 'VEHICLE-REGN-3', 'MODEL-C', 'inactive', '2017-02-10 06:37:17', 1, '2017-02-10 07:50:30', NULL),
(18, 'VEHICLE-REGN-4', 'MODEL-D', 'active', '2017-02-10 06:37:41', 1, '2017-02-13 10:23:00', NULL),
(19, 'VEHICLE-REGN-5', 'MODEL-E', 'active', '2017-02-10 06:39:47', 1, '2017-02-13 10:23:09', NULL),
(20, 'VEHICLE-REGN-6', 'MODEL-F', 'inactive', '2017-02-10 06:40:22', 1, '2017-02-10 07:50:41', NULL),
(21, 'VEHICLE-REGN-7', 'MODEL-G', 'inactive', '2017-02-10 06:41:20', 1, '2017-02-10 07:50:47', NULL),
(22, 'VEHICLE-REGN-8', 'MODEL-G', 'active', '2017-02-10 06:41:51', 1, '2017-02-10 06:41:51', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ld_permission_role`
--
ALTER TABLE `ld_permission_role`
  ADD CONSTRAINT `ld_permission_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `ld_roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
