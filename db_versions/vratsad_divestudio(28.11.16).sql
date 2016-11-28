-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Nov 28, 2016 at 03:19 PM
-- Server version: 5.5.53-38.5-log
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `vratsad_divestudio`
--

-- --------------------------------------------------------

--
-- Table structure for table `cl_accesses`
--

CREATE TABLE IF NOT EXISTS `cl_accesses` (
  `access` varchar(90) NOT NULL,
  PRIMARY KEY (`access`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `cl_languages`
--

CREATE TABLE IF NOT EXISTS `cl_languages` (
  `language` varchar(100) NOT NULL,
  `language_code` varchar(45) NOT NULL,
  PRIMARY KEY (`language`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cl_languages`
--

INSERT INTO `cl_languages` (`language`, `language_code`) VALUES
('Egnlish', ''),
('Български', '');

-- --------------------------------------------------------

--
-- Table structure for table `cl_organization_types`
--

CREATE TABLE IF NOT EXISTS `cl_organization_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organization_type` varchar(90) NOT NULL,
  `date_created` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_upated` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  `date_deleted` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cl_organization_types`
--

INSERT INTO `cl_organization_types` (`id`, `organization_type`, `date_created`, `created_by`, `date_upated`, `updated_by`, `date_deleted`, `deleted_by`) VALUES
(1, 'Физическо лице', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, NULL, NULL),
(2, ' 	Corporation', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, NULL, NULL),
(3, 'Single Professional (ЕТ)', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, NULL, NULL),
(4, 'Subcontractor', '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cl_regions`
--

CREATE TABLE IF NOT EXISTS `cl_regions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `region_bg` varchar(150) NOT NULL,
  `region_en` varchar(150) NOT NULL,
  `region_order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `cl_regions`
--

INSERT INTO `cl_regions` (`id`, `region_bg`, `region_en`, `region_order`) VALUES
(1, 'Благоевград', 'Blagoevgrad', 0),
(2, 'Бургас', 'Burgas', 0),
(3, 'Варна', 'Varna', 0),
(4, 'Велико Търново', 'Veliko Tarnovo', 0),
(5, 'Видин', 'Vidin', 0),
(6, 'Враца', 'Vratsa', 0),
(7, 'Габрово', 'Gabrovo', 0),
(8, 'Добрич', 'Dobrich', 0),
(9, 'Кърджали', 'Kurdzhaly', 0),
(10, 'Кюстендил', 'Kyustendil', 0),
(11, 'Ловеч', 'Lovech', 0),
(12, 'Монтана', 'Montana', 0),
(13, 'Пазарджик', 'Pazardjik', 0),
(14, 'Перник', 'Pernik', 0),
(15, 'Плевен', 'Pleven', 0),
(16, 'Пловдив', 'Plovdiv', 0),
(17, 'Разград', 'Razgrad', 0),
(18, 'Русе', 'Russe', 0),
(19, 'Силистра', 'Silistra', 0),
(20, 'Сливен', 'Sliven', 0),
(21, 'Смолян', 'Smolyan', 0),
(22, 'София област', 'Sofia region', 0),
(23, 'София град', 'Sofia city', 1),
(24, 'Стара Загора', 'Stara Zagora', 0),
(25, 'Търговище', 'Turgovishte', 0),
(26, 'Хасково', 'Haskovo', 0),
(27, 'Шумен', 'Shumen', 0),
(28, 'Ямбол', 'Yambol', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cl_region_translations`
--

CREATE TABLE IF NOT EXISTS `cl_region_translations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cl_region_id` int(11) NOT NULL,
  `region` varchar(150) NOT NULL,
  `locale` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cl_region_id` (`cl_region_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=67 ;

--
-- Dumping data for table `cl_region_translations`
--

INSERT INTO `cl_region_translations` (`id`, `cl_region_id`, `region`, `locale`) VALUES
(1, 1, 'Благоевград', 'bg'),
(2, 1, 'Blagoevgrad', 'en'),
(3, 2, 'Бургас', 'bg'),
(4, 2, 'Burgas', 'en'),
(5, 3, 'Варна', 'bg'),
(6, 3, 'Varna', 'en'),
(7, 4, 'Велико Търново', 'bg'),
(8, 4, 'Veliko Tarnovo', 'en'),
(9, 5, 'Видин', 'bg'),
(10, 5, 'Vidin', 'en'),
(11, 6, 'Враца', 'bg'),
(12, 6, 'Vratsa', 'en'),
(23, 7, 'Габрово', 'bg'),
(24, 7, 'Gabrovo', 'en'),
(25, 8, 'Добрич', 'bg'),
(26, 8, 'Dobrich', 'en'),
(27, 9, 'Кърджали', 'bg'),
(28, 9, 'Kurdzhaly', 'en'),
(29, 10, 'Кюстендил', 'bg'),
(30, 10, 'Kyustendil', 'en'),
(31, 11, 'Ловеч', 'bg'),
(32, 11, 'Lovech', 'en'),
(33, 12, 'Монтана', 'bg'),
(34, 12, 'Montana', 'en'),
(35, 13, 'Пазарджик', 'bg'),
(36, 13, 'Pazardjik', 'en'),
(37, 14, 'Перник', 'bg'),
(38, 14, 'Pernik', 'en'),
(39, 15, 'Плевен', 'bg'),
(40, 15, 'Pleven', 'en'),
(41, 16, 'Пловдив', 'bg'),
(42, 16, 'Plovdiv', 'en'),
(43, 17, 'Разград', 'bg'),
(44, 17, 'Razgrad', 'en'),
(45, 18, 'Русе', 'bg'),
(46, 18, 'Russe', 'en'),
(47, 19, 'Силистра', 'bg'),
(48, 19, 'Silistra', 'en'),
(49, 20, 'Сливен', 'bg'),
(50, 20, 'Sliven', 'en'),
(51, 21, 'Смолян', 'bg'),
(52, 21, 'Smolyan', 'en'),
(53, 22, 'София област', 'bg'),
(54, 22, 'Sofia region', 'en'),
(55, 23, 'София град', 'bg'),
(56, 23, 'Sofia city', 'en'),
(57, 24, 'Стара Загора', 'bg'),
(58, 24, 'Stara Zagora', 'en'),
(59, 25, 'Търговище', 'bg'),
(60, 25, 'Turgovishte', 'en'),
(61, 26, 'Хасково', 'bg'),
(62, 26, 'Haskovo', 'en'),
(63, 27, 'Шумен', 'bg'),
(64, 27, 'Shumen', 'en'),
(65, 28, 'Ямбол', 'bg'),
(66, 28, 'Yambol', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `cl_roles`
--

CREATE TABLE IF NOT EXISTS `cl_roles` (
  `role` varchar(90) NOT NULL COMMENT 'Superadmin, Admin, Client(Търсещ), Supplier(Предлагащ)',
  PRIMARY KEY (`role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cl_roles`
--

INSERT INTO `cl_roles` (`role`) VALUES
('Admin'),
('Client'),
('Superadmin'),
('Supplier');

-- --------------------------------------------------------

--
-- Table structure for table `cl_services`
--

CREATE TABLE IF NOT EXISTS `cl_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `cl_services`
--

INSERT INTO `cl_services` (`id`) VALUES
(1),
(2),
(3),
(4),
(5),
(6),
(7),
(8),
(9);

-- --------------------------------------------------------

--
-- Table structure for table `cl_services_old`
--

CREATE TABLE IF NOT EXISTS `cl_services_old` (
  `service` varchar(200) NOT NULL COMMENT 'Services offered by suppliers (prbably the same as categories that clients look for)',
  PRIMARY KEY (`service`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Used to store categories also (client asked if they are the same)';

--
-- Dumping data for table `cl_services_old`
--

INSERT INTO `cl_services_old` (`service`) VALUES
('Строителство'),
('Туризъм');

-- --------------------------------------------------------

--
-- Table structure for table `cl_service_translations`
--

CREATE TABLE IF NOT EXISTS `cl_service_translations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cl_service_id` int(11) NOT NULL,
  `service` varchar(200) NOT NULL,
  `locale` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cl_service_id` (`cl_service_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `cl_service_translations`
--

INSERT INTO `cl_service_translations` (`id`, `cl_service_id`, `service`, `locale`) VALUES
(1, 1, 'Комплексно счетоводно обслужване', 'bg'),
(2, 1, 'Full accounting service', 'en'),
(3, 2, 'Оперативно счетоводство', 'bg'),
(4, 2, 'Operative accounting', 'en'),
(5, 3, 'Главен счетоводител', 'bg'),
(6, 3, 'Head Accountant', 'en'),
(7, 4, 'Годишно приключване (ГФО)', 'bg'),
(8, 4, 'Annual financial closing', 'en'),
(9, 5, 'Междинни финансови отчети', 'bg'),
(10, 5, 'Midterm fiscal reports', 'en'),
(11, 6, 'Пейрол услуги', 'bg'),
(12, 6, 'Payroll services', 'en'),
(13, 7, 'HR услуги', 'bg'),
(14, 7, 'HR services', 'en'),
(15, 8, 'Еднократни счетоводни и данъчни консултации', 'bg'),
(16, 8, 'Single accounting services', 'en'),
(17, 9, 'Изготвяне на счетоводна политика, сметкоплан, счетоводна отчетност', 'bg'),
(18, 9, 'Create accounting policy', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `cl_statuses`
--

CREATE TABLE IF NOT EXISTS `cl_statuses` (
  `status` varchar(45) NOT NULL,
  `status_order` int(11) NOT NULL,
  PRIMARY KEY (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cl_statuses`
--

INSERT INTO `cl_statuses` (`status`, `status_order`) VALUES
('closed', 3),
('finished', 2),
('open', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cl_system_settings`
--

CREATE TABLE IF NOT EXISTS `cl_system_settings` (
  `rating_period` tinyint(4) NOT NULL COMMENT 'In days'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cl_system_settings`
--

INSERT INTO `cl_system_settings` (`rating_period`) VALUES
(7);

-- --------------------------------------------------------

--
-- Table structure for table `cm_ads`
--

CREATE TABLE IF NOT EXISTS `cm_ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) NOT NULL COMMENT 'For now it is service id',
  `budget` int(11) NOT NULL,
  `deadline` datetime NOT NULL,
  `date_accepted` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `service_id` (`service_id`) USING BTREE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `cm_ads`
--

INSERT INTO `cm_ads` (`id`, `service_id`, `budget`, `deadline`, `date_accepted`, `created_by`, `created_at`, `updated_by`, `updated_at`, `deleted_by`, `date_deleted`) VALUES
(9, 2, 560, '2016-11-15 12:25:00', NULL, 8, '2016-10-27 07:48:44', NULL, '2016-10-27 07:48:44', NULL, NULL),
(20, 9, 460, '2016-11-16 00:00:00', NULL, 4, '2016-11-11 11:01:23', NULL, '2016-11-11 11:01:23', NULL, NULL),
(21, 1, 150, '2016-11-12 00:00:00', NULL, 4, '2016-11-11 11:21:11', NULL, '2016-11-11 11:21:11', NULL, NULL),
(22, 2, 250, '2016-11-23 00:00:00', NULL, 4, '2016-11-11 17:19:13', NULL, '2016-11-11 17:19:13', NULL, NULL),
(23, 2, 605, '2016-11-30 00:00:00', NULL, 4, '2016-11-11 17:44:20', NULL, '2016-11-11 17:44:20', NULL, NULL),
(24, 2, 358, '2016-11-29 00:00:00', NULL, 9, '2016-11-11 17:45:35', NULL, '2016-11-11 17:45:35', NULL, NULL),
(25, 1, 4, '2016-11-16 00:00:00', NULL, 10, '2016-11-14 09:09:18', NULL, '2016-11-14 09:09:18', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cm_ad_translations`
--

CREATE TABLE IF NOT EXISTS `cm_ad_translations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cm_ad_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` varchar(2000) NOT NULL,
  `locale` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cm_ad_id` (`cm_ad_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `cm_ad_translations`
--

INSERT INTO `cm_ad_translations` (`id`, `cm_ad_id`, `title`, `content`, `locale`) VALUES
(1, 9, 'Едно заглавие', 'Две съдържание', 'bg'),
(2, 9, 'One - title', 'Two - content', 'en'),
(13, 20, 'С нов дизайн', 'Последната категория', 'en'),
(14, 21, 'Заглавие1', 'Описвам си нещата', 'en'),
(15, 22, 'С обновена база', 'да сложа и описание', 'en'),
(16, 23, 'Пробна обява', 'Да видим как', 'en'),
(17, 24, 'Пробна обява ', 'На пробен потребител', 'en'),
(18, 25, 'Златна рибка', 'Няма да кажа.', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `cm_articles`
--

CREATE TABLE IF NOT EXISTS `cm_articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  `is_public` tinyint(1) NOT NULL,
  `cl_service_id` varchar(200) NOT NULL COMMENT 'could become category_id',
  `created_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `date_approved` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `cl_service_id` (`cl_service_id`),
  KEY `created_by` (`created_by`),
  KEY `approved_by` (`approved_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cm_articles`
--

INSERT INTO `cm_articles` (`id`, `title`, `content`, `is_public`, `cl_service_id`, `created_by`, `date_created`, `approved_by`, `date_approved`) VALUES
(1, 'Имаме статия', 'Да видим добра ли е структурата на таблицата.', 0, 'Строителство', 2, '2016-09-19 10:00:00', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cm_feedbacks`
--

CREATE TABLE IF NOT EXISTS `cm_feedbacks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(200) NOT NULL,
  `feedback` varchar(2000) NOT NULL,
  `cl_status_id` varchar(45) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `cl_status_id` (`cl_status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cm_feedbacks`
--

INSERT INTO `cm_feedbacks` (`id`, `title`, `feedback`, `cl_status_id`, `created_by`, `date_created`) VALUES
(1, 'Системата ви я бива.', 'Страхотна работа момчета.', 'open', 2, '2016-09-19 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cm_feedback_responds`
--

CREATE TABLE IF NOT EXISTS `cm_feedback_responds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cm_feedback_id` int(11) NOT NULL,
  `respond` varchar(2000) NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cm_feedback_id` (`cm_feedback_id`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cm_feedback_responds`
--

INSERT INTO `cm_feedback_responds` (`id`, `cm_feedback_id`, `respond`, `created_by`, `date_created`) VALUES
(1, 1, 'Благодарим, за нас е удоволствие', 3, '2016-09-19 00:00:00'),
(2, 1, 'Благодарим, за нас е усодолтвие и забавление!', 3, '2016-09-19 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `cm_offers`
--

CREATE TABLE IF NOT EXISTS `cm_offers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cm_ad_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `comment` varchar(2000) NOT NULL,
  `type` varchar(45) NOT NULL COMMENT 'Client or Supplier',
  `deadline` datetime NOT NULL COMMENT 'when it is from supplier',
  `is_approved` tinyint(1) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cm_add_id` (`cm_ad_id`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Dumping data for table `cm_offers`
--

INSERT INTO `cm_offers` (`id`, `cm_ad_id`, `price`, `comment`, `type`, `deadline`, `is_approved`, `created_by`, `created_at`, `updated_at`, `updated_by`) VALUES
(6, 9, 550, 'Защо не?', 'supplier', '2016-10-15 12:25:00', NULL, 8, '2016-10-27 07:57:51', '2016-10-27 07:57:51', 0),
(14, 9, 525, '', '', '2016-11-15 12:25:00', NULL, 8, '2016-10-27 10:15:00', '2016-10-27 10:15:00', 0),
(15, 9, 530, '', '', '2016-12-25 12:25:00', NULL, 8, '2016-10-27 10:18:00', '2016-10-27 10:18:00', 0),
(16, 9, 495, '', '', '2016-11-16 16:30:00', NULL, 8, '2016-10-29 09:54:34', '2016-10-29 09:54:34', 0),
(17, 9, 495, '', '', '2016-11-16 16:30:00', NULL, 8, '2016-10-29 09:55:34', '2016-10-29 09:55:34', 0),
(18, 9, 525, '', '', '2016-10-15 12:25:00', NULL, 4, '2016-11-04 16:23:19', '2016-11-04 16:23:19', 0),
(19, 9, 526, '', '', '2016-10-16 12:25:00', NULL, 4, '2016-11-04 16:37:37', '2016-11-04 16:37:37', 0),
(20, 9, 526, '', '', '2016-10-16 12:25:00', NULL, 4, '2016-11-04 16:38:23', '2016-11-04 16:38:23', 0),
(21, 9, 526, '', '', '2016-10-16 12:25:00', NULL, 4, '2016-11-04 16:39:04', '2016-11-04 16:39:04', 0),
(22, 9, 526, '', '', '2016-10-15 12:25:00', NULL, 4, '2016-11-04 16:39:45', '2016-11-04 16:39:45', 0),
(23, 9, 526, '', '', '2016-10-15 12:25:00', NULL, 4, '2016-11-04 16:40:29', '2016-11-04 16:40:29', 0),
(24, 9, 526, '', '', '2016-10-15 12:25:00', NULL, 4, '2016-11-04 16:41:07', '2016-11-04 16:41:07', 0),
(25, 9, 526, '', '', '2016-10-15 12:25:00', NULL, 4, '2016-11-04 16:41:40', '2016-11-04 16:41:40', 0),
(26, 9, 526, '', '', '2016-10-15 12:25:00', NULL, 4, '2016-11-04 16:43:45', '2016-11-04 16:43:45', 0),
(27, 9, 526, '', '', '2016-10-15 12:25:00', NULL, 4, '2016-11-04 16:44:27', '2016-11-04 16:44:27', 0),
(28, 9, 526, '', '', '2016-10-15 12:25:00', NULL, 4, '2016-11-04 16:44:54', '2016-11-04 16:44:54', 0),
(29, 9, 526, '', '', '2016-10-15 12:25:00', NULL, 4, '2016-11-04 16:45:51', '2016-11-04 16:45:51', 0),
(30, 9, 526, '', '', '2016-10-15 12:25:00', NULL, 4, '2016-11-04 16:45:56', '2016-11-04 16:45:56', 0),
(31, 9, 526, '', '', '2016-10-15 12:25:00', NULL, 4, '2016-11-04 16:47:00', '2016-11-04 16:47:00', 0),
(32, 9, 526, '', '', '2016-10-15 12:25:00', NULL, 4, '2016-11-04 16:47:53', '2016-11-04 16:47:53', 0),
(33, 9, 526, '', '', '2016-10-15 12:25:00', NULL, 4, '2016-11-04 16:48:54', '2016-11-04 16:48:54', 0),
(34, 9, 526, '', '', '2016-10-15 12:25:00', NULL, 4, '2016-11-04 16:54:45', '2016-11-04 16:54:45', 0),
(35, 9, 526, '', '', '2016-10-15 12:25:00', NULL, 4, '2016-11-04 16:56:17', '2016-11-04 16:56:17', 0),
(36, 9, 526, '', '', '2016-10-15 12:25:00', NULL, 4, '2016-11-04 16:56:26', '2016-11-04 16:56:26', 0),
(37, 9, 526, '', '', '2016-10-15 12:25:00', NULL, 4, '2016-11-04 16:56:35', '2016-11-04 16:56:35', 0),
(38, 9, 527, '', '', '2016-10-17 12:27:00', NULL, 4, '2016-11-04 16:57:05', '2016-11-04 16:57:05', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cm_offer_translations`
--

CREATE TABLE IF NOT EXISTS `cm_offer_translations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cm_offer_id` int(11) NOT NULL,
  `comment` varchar(2000) NOT NULL,
  `type` varchar(45) NOT NULL,
  `locale` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cm_offer_id` (`cm_offer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `cm_offer_translations`
--

INSERT INTO `cm_offer_translations` (`id`, `cm_offer_id`, `comment`, `type`, `locale`) VALUES
(1, 14, 'Да видим на български', 'доставчик', 'bg'),
(2, 15, 'Different comment (different offer)', 'supplier', 'en'),
(4, 15, 'Нека има и на БГ', 'доставчик', 'bg'),
(5, 6, 'The most expensive.', 'supplier', 'en'),
(6, 17, 'Ще има ли ел. поща!?', 'клиент', 'bg'),
(7, 18, 'In English, please', 'client', 'en'),
(8, 19, 'adf bla bla', 'client', 'en'),
(9, 20, 'adf bla bla', 'client', 'en'),
(10, 21, 'adf bla bla', 'client', 'en');

-- --------------------------------------------------------

--
-- Table structure for table `cm_outer_ads`
--

CREATE TABLE IF NOT EXISTS `cm_outer_ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link` varchar(200) NOT NULL,
  `height` int(11) NOT NULL,
  `width` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `date_updated` datetime DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `date_deleted` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `updated_by` (`updated_by`),
  KEY `link` (`link`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `cm_outer_ads`
--

INSERT INTO `cm_outer_ads` (`id`, `link`, `height`, `width`, `start_date`, `end_date`, `created_by`, `date_created`, `updated_by`, `date_updated`, `deleted_by`, `date_deleted`) VALUES
(6, 'https://www.abv.bg/', 140, 800, '2016-09-20 00:00:00', '2016-11-30 00:00:00', 3, '2016-09-19 01:00:00', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cm_ratings`
--

CREATE TABLE IF NOT EXISTS `cm_ratings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cm_ad_id` int(11) NOT NULL,
  `cm_offer_id` int(11) NOT NULL,
  `user_graded_id` int(11) NOT NULL,
  `grade` tinyint(4) NOT NULL COMMENT '1-5',
  `comment` varchar(500) NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `updated_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cm_ad_id` (`cm_ad_id`),
  KEY `user_graded_id` (`user_graded_id`),
  KEY `created_by` (`created_by`),
  KEY `cm_offer_id` (`cm_offer_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cm_ratings`
--

INSERT INTO `cm_ratings` (`id`, `cm_ad_id`, `cm_offer_id`, `user_graded_id`, `grade`, `comment`, `created_by`, `created_at`, `updated_at`, `updated_by`) VALUES
(2, 9, 6, 8, 3, 'Бива - не е беше зле.', 8, '2016-11-01 10:28:37', '2016-11-01 10:28:37', 0);

-- --------------------------------------------------------

--
-- Table structure for table `con_ad_regions`
--

CREATE TABLE IF NOT EXISTS `con_ad_regions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cm_ad_id` int(11) NOT NULL,
  `cl_region_id` int(11) NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `ad_id` (`cm_ad_id`),
  KEY `region_id` (`cl_region_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `con_ad_regions`
--

INSERT INTO `con_ad_regions` (`id`, `cm_ad_id`, `cl_region_id`, `updated_at`, `created_at`) VALUES
(4, 20, 23, '2016-11-11 11:01:24', '2016-11-11 11:01:24'),
(5, 20, 6, '2016-11-11 11:01:24', '2016-11-11 11:01:24'),
(6, 21, 23, '2016-11-11 11:21:12', '2016-11-11 11:21:12'),
(7, 21, 7, '2016-11-11 11:21:12', '2016-11-11 11:21:12'),
(8, 21, 8, '2016-11-11 11:21:12', '2016-11-11 11:21:12'),
(9, 22, 23, '2016-11-11 17:19:13', '2016-11-11 17:19:13'),
(10, 22, 16, '2016-11-11 17:19:13', '2016-11-11 17:19:13'),
(11, 23, 23, '2016-11-11 17:44:20', '2016-11-11 17:44:20'),
(12, 23, 11, '2016-11-11 17:44:20', '2016-11-11 17:44:20'),
(13, 24, 23, '2016-11-11 17:45:35', '2016-11-11 17:45:35'),
(14, 24, 6, '2016-11-11 17:45:35', '2016-11-11 17:45:35'),
(15, 25, 23, '2016-11-14 09:09:18', '2016-11-14 09:09:18'),
(16, 25, 1, '2016-11-14 09:09:18', '2016-11-14 09:09:18'),
(17, 25, 16, '2016-11-14 09:09:18', '2016-11-14 09:09:18'),
(18, 25, 17, '2016-11-14 09:09:18', '2016-11-14 09:09:18'),
(19, 25, 18, '2016-11-14 09:09:18', '2016-11-14 09:09:18'),
(20, 25, 19, '2016-11-14 09:09:18', '2016-11-14 09:09:18'),
(21, 25, 20, '2016-11-14 09:09:18', '2016-11-14 09:09:18'),
(22, 25, 21, '2016-11-14 09:09:18', '2016-11-14 09:09:18'),
(23, 25, 22, '2016-11-14 09:09:18', '2016-11-14 09:09:18'),
(24, 25, 24, '2016-11-14 09:09:18', '2016-11-14 09:09:18'),
(25, 25, 25, '2016-11-14 09:09:18', '2016-11-14 09:09:18'),
(26, 25, 26, '2016-11-14 09:09:18', '2016-11-14 09:09:18'),
(27, 25, 27, '2016-11-14 09:09:18', '2016-11-14 09:09:18'),
(28, 25, 15, '2016-11-14 09:09:18', '2016-11-14 09:09:18'),
(29, 25, 14, '2016-11-14 09:09:18', '2016-11-14 09:09:18'),
(30, 25, 2, '2016-11-14 09:09:18', '2016-11-14 09:09:18'),
(31, 25, 3, '2016-11-14 09:09:18', '2016-11-14 09:09:18'),
(32, 25, 4, '2016-11-14 09:09:18', '2016-11-14 09:09:18'),
(33, 25, 5, '2016-11-14 09:09:18', '2016-11-14 09:09:18'),
(34, 25, 6, '2016-11-14 09:09:18', '2016-11-14 09:09:18'),
(35, 25, 7, '2016-11-14 09:09:18', '2016-11-14 09:09:18'),
(36, 25, 8, '2016-11-14 09:09:18', '2016-11-14 09:09:18'),
(37, 25, 9, '2016-11-14 09:09:18', '2016-11-14 09:09:18'),
(38, 25, 10, '2016-11-14 09:09:18', '2016-11-14 09:09:18'),
(39, 25, 11, '2016-11-14 09:09:18', '2016-11-14 09:09:18'),
(40, 25, 12, '2016-11-14 09:09:18', '2016-11-14 09:09:18'),
(41, 25, 13, '2016-11-14 09:09:18', '2016-11-14 09:09:18'),
(42, 25, 28, '2016-11-14 09:09:18', '2016-11-14 09:09:18');

-- --------------------------------------------------------

--
-- Table structure for table `con_role_accesses`
--

CREATE TABLE IF NOT EXISTS `con_role_accesses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cl_role_id` varchar(90) NOT NULL,
  `cl_access_id` varchar(90) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cl_role_id` (`cl_role_id`),
  KEY `cl_access_id` (`cl_access_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `con_user_languages`
--

CREATE TABLE IF NOT EXISTS `con_user_languages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `cl_language_id` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `cl_role_id` (`cl_language_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `con_user_languages`
--

INSERT INTO `con_user_languages` (`id`, `user_id`, `cl_language_id`) VALUES
(1, 6, 'Egnlish'),
(2, 6, 'Български'),
(3, 7, 'Egnlish'),
(4, 7, 'Български'),
(5, 8, 'Egnlish'),
(6, 8, 'Български'),
(7, 9, 'Egnlish'),
(8, 9, 'Български'),
(9, 10, 'Български');

-- --------------------------------------------------------

--
-- Table structure for table `con_user_regions`
--

CREATE TABLE IF NOT EXISTS `con_user_regions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `cl_region_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cl_region_id` (`cl_region_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `con_user_regions`
--

INSERT INTO `con_user_regions` (`id`, `user_id`, `cl_region_id`) VALUES
(1, 5, 12),
(2, 5, 6),
(3, 7, 23),
(4, 7, 1),
(5, 7, 2);

-- --------------------------------------------------------

--
-- Table structure for table `con_user_roles`
--

CREATE TABLE IF NOT EXISTS `con_user_roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `cl_role_id` varchar(90) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `cl_role_id` (`cl_role_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `con_user_services`
--

CREATE TABLE IF NOT EXISTS `con_user_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `cl_service_id` int(11) NOT NULL,
  `min_budget` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `cl_service_id` (`cl_service_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `con_user_services`
--

INSERT INTO `con_user_services` (`id`, `user_id`, `cl_service_id`, `min_budget`) VALUES
(1, 5, 1, 200),
(2, 5, 2, 1000),
(3, 7, 1, 1000),
(4, 7, 2, 400);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(200) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `phone` varchar(45) NOT NULL,
  `reg_number` varchar(90) DEFAULT NULL,
  `org_name` varchar(150) NOT NULL COMMENT 'Name of Organization name',
  `cl_organization_type_id` int(11) NOT NULL,
  `user_type` int(11) NOT NULL COMMENT 'admin/client/supplier',
  `description` varchar(1000) DEFAULT NULL,
  `is_receiving_emails` tinyint(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `cl_organization_type_id` (`cl_organization_type_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `password`, `remember_token`, `email`, `phone`, `reg_number`, `org_name`, `cl_organization_type_id`, `user_type`, `description`, `is_receiving_emails`, `created_at`, `updated_at`) VALUES
(2, 'Stavri Ivanov', 'stavriPass', NULL, 'stavri@abv.bg', '08787878787', '', 'stavri', 2, 2, NULL, 0, '0000-00-00 00:00:00', '2016-09-26 17:36:17'),
(3, 'Genoveva Alipieva', 'genovevaPass', NULL, 'genata88@mail.bg', '08385425112', NULL, 'genoveva', 1, 1, NULL, 0, '0000-00-00 00:00:00', '2016-09-26 17:36:17'),
(4, 'user12', '$2y$10$ELC3QKoV9q/Xtc36MbkTru.56PY6/EIlJJrb3QSg9hIWMkwXlUSLy', 'YHwMDq19de3tchI96xE6WiIiPOiPSuh4Y0dm5qmakPw3arWGNKs3IGAl3boI', 'user12@mail.bg', '555777', NULL, 'User Userov', 1, 1, 'Text', 0, '2016-10-05 07:50:47', '2016-11-11 17:44:25'),
(5, 'Emil', '$2y$10$bWN/hwVuBuE.CVyBxqhLtuoYOFstTm5c/SOUW1Cm9Pd9SjSWc78Ue', 'S85ewtdken84Y7gsY2TBwbNZMU17bkr1aCgU1i262GJxLHFATeP6npXd3k5q', 'elp_vr1@yahoo.com', '0886066166', '130119552', 'Emil Petrov', 3, 2, 'Drugo', 0, '2016-10-05 07:52:56', '2016-10-07 14:33:51'),
(6, 'Emil2', '$2y$10$3eFokHKJ0QYhA5InzSB5GObINlWkUdA1bUEF3cXEyiOroLNvWaw/i', 'ii5voOjyG4ntLZ3hywuAdlvWj37iwqBWiTAVIRaFtLcnVDO5vL90UGa21RjS', 'elp_vr2@yahoo.com', '55', NULL, 'fgg fgd', 1, 1, '', 1, '2016-10-05 11:15:42', '2016-10-05 11:59:49'),
(7, 'User OneThree', '$2y$10$Mw6A4FQSlDNiyf7KcZJ.ye3uD3OFwbwrBqjYUOYwdxbVz0VCDRq2S', NULL, 'user13@mail.bg', '0245283957', NULL, 'Фирмата Ми12', 1, 2, 'Готина фирма, правим всичко бързо и в срок.', 1, '2016-10-13 08:05:47', '2016-10-13 08:05:47'),
(8, 'newuser', '$2y$10$laQ2viscmsWQ05HzSv.l5uWmILtCpcET4DeoSY/i8eUXiWbIl6Ccy', NULL, 'newuser@abv.bg', '0238524891908', NULL, 'Пробна организация', 1, 1, 'И те така те', 1, '2016-10-27 07:48:18', '2016-10-27 07:48:18'),
(9, 'test12', '$2y$10$QEu20aAGQakdHvW1wbu7Pe/KzulnqpOoTwHQMF0TLBq8.1ixEDSK2', 'KNlm5tqX0MBr5HLv51uxX5LWA4DfnRBYIQ74Pzx6NOV3MYLt8B2bHAzhRZJa', 'test12@abv.bg', '02358235729', 'ВР0066!?', 'Пробна организация', 2, 1, 'Да имам нещо си там', 1, '2016-11-11 17:45:10', '2016-11-11 17:47:30'),
(10, 'Peter Beron', '$2y$10$rEIBF/ZfjtKu9DY0KRYgwefmm/VQYyiEF5QVg6vMunCli9f8iZrdK', NULL, 'axx@abv.bg', '+359896722886', NULL, 'BATMAN INC.', 1, 1, 'Инквизитор', 0, '2016-11-14 09:07:59', '2016-11-14 09:07:59');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cl_region_translations`
--
ALTER TABLE `cl_region_translations`
  ADD CONSTRAINT `fk_region_locale` FOREIGN KEY (`cl_region_id`) REFERENCES `cl_regions` (`id`);

--
-- Constraints for table `cl_service_translations`
--
ALTER TABLE `cl_service_translations`
  ADD CONSTRAINT `fk_service_locale` FOREIGN KEY (`cl_service_id`) REFERENCES `cl_services` (`id`);

--
-- Constraints for table `cm_ads`
--
ALTER TABLE `cm_ads`
  ADD CONSTRAINT `fk_ad_service` FOREIGN KEY (`service_id`) REFERENCES `cl_services` (`id`),
  ADD CONSTRAINT `fk_user_ad` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_user_update_ad` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `cm_ad_translations`
--
ALTER TABLE `cm_ad_translations`
  ADD CONSTRAINT `fk_ad_translation` FOREIGN KEY (`cm_ad_id`) REFERENCES `cm_ads` (`id`);

--
-- Constraints for table `cm_articles`
--
ALTER TABLE `cm_articles`
  ADD CONSTRAINT `fk_service_article` FOREIGN KEY (`cl_service_id`) REFERENCES `cl_services_old` (`service`),
  ADD CONSTRAINT `fk_user_approved_article` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_user_created_article` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `cm_feedbacks`
--
ALTER TABLE `cm_feedbacks`
  ADD CONSTRAINT `fk_statuses` FOREIGN KEY (`cl_status_id`) REFERENCES `cl_statuses` (`status`),
  ADD CONSTRAINT `fk_user_feedback` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `cm_feedback_responds`
--
ALTER TABLE `cm_feedback_responds`
  ADD CONSTRAINT `fk_feedback` FOREIGN KEY (`cm_feedback_id`) REFERENCES `cm_feedbacks` (`id`),
  ADD CONSTRAINT `fk_user_respond` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `cm_offers`
--
ALTER TABLE `cm_offers`
  ADD CONSTRAINT `fk_ad` FOREIGN KEY (`cm_ad_id`) REFERENCES `cm_ads` (`id`),
  ADD CONSTRAINT `fk_user_offer` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `cm_offer_translations`
--
ALTER TABLE `cm_offer_translations`
  ADD CONSTRAINT `fk_offer_lang` FOREIGN KEY (`cm_offer_id`) REFERENCES `cm_offers` (`id`);

--
-- Constraints for table `cm_outer_ads`
--
ALTER TABLE `cm_outer_ads`
  ADD CONSTRAINT `fk_user_outer_ad` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_user_updated_outer_ad` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `cm_ratings`
--
ALTER TABLE `cm_ratings`
  ADD CONSTRAINT `fk_ad2` FOREIGN KEY (`cm_ad_id`) REFERENCES `cm_ads` (`id`),
  ADD CONSTRAINT `fk_offer` FOREIGN KEY (`cm_offer_id`) REFERENCES `cm_offers` (`id`),
  ADD CONSTRAINT `fk_user_graded` FOREIGN KEY (`user_graded_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_user_rating` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`);

--
-- Constraints for table `con_ad_regions`
--
ALTER TABLE `con_ad_regions`
  ADD CONSTRAINT `fk_ad3` FOREIGN KEY (`cm_ad_id`) REFERENCES `cm_ads` (`id`),
  ADD CONSTRAINT `fk_region1` FOREIGN KEY (`cl_region_id`) REFERENCES `cl_regions` (`id`);

--
-- Constraints for table `con_role_accesses`
--
ALTER TABLE `con_role_accesses`
  ADD CONSTRAINT `fk_access` FOREIGN KEY (`cl_access_id`) REFERENCES `cl_accesses` (`access`),
  ADD CONSTRAINT `fk_role` FOREIGN KEY (`cl_role_id`) REFERENCES `cl_roles` (`role`);

--
-- Constraints for table `con_user_languages`
--
ALTER TABLE `con_user_languages`
  ADD CONSTRAINT `fk_language` FOREIGN KEY (`cl_language_id`) REFERENCES `cl_languages` (`language`),
  ADD CONSTRAINT `fk_user3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `con_user_regions`
--
ALTER TABLE `con_user_regions`
  ADD CONSTRAINT `fk_region` FOREIGN KEY (`cl_region_id`) REFERENCES `cl_regions` (`id`);

--
-- Constraints for table `con_user_roles`
--
ALTER TABLE `con_user_roles`
  ADD CONSTRAINT `fk_roles` FOREIGN KEY (`cl_role_id`) REFERENCES `cl_roles` (`role`),
  ADD CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `con_user_services`
--
ALTER TABLE `con_user_services`
  ADD CONSTRAINT `fk_service` FOREIGN KEY (`cl_service_id`) REFERENCES `cl_services` (`id`),
  ADD CONSTRAINT `fk_user2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
