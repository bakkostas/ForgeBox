-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Φιλοξενητής: 127.0.0.1
-- Χρόνος δημιουργίας: 10 Φεβ 2015 στις 12:02:13
-- Έκδοση διακομιστή: 5.5.27
-- Έκδοση PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Βάση: `forgebox_live`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `actions`
--

CREATE TABLE IF NOT EXISTS `actions` (
  `key_name` varchar(50) NOT NULL,
  `display_name` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`key_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Άδειασμα δεδομένων του πίνακα `actions`
--

INSERT INTO `actions` (`key_name`, `display_name`, `category_id`) VALUES
('ACCESS_CONTROL', 'Access Control', 4),
('ADD_DELETE_ORDER_COURSE_PART', 'Add/Delete and order Course Part', 1),
('DELETE_INSTALLED_WIDGET', 'Delete Installed Widget', 2),
('DELETE_MY_SERVICES', 'Delete My Services', 3),
('DELETE_MY_WIDGET', 'Delete My Widget', 2),
('EPUB_EXPORT_COURSE', 'EPUB Export Course', 1),
('INSTALLED_MY_SERVICES', 'Installed my Services', 3),
('INSTALLED_MY_WIDGET', 'Install my Widget', 2),
('INSTALL_COURSE_FROM_FORGESTORE', 'Install Course from Forgestore', 1),
('INSTALL_SERVICES', 'Install Services', 3),
('INSTALL_WIDGETS', 'Install Widgets', 2),
('MY_ACCOUNT', 'My Account', 5),
('MY_DASHBOARD', 'My Dashboard', 5),
('NEW_EDIT_DELETE_CATEGORY_COURSE', 'New/Edit/Delete Category Course', 1),
('NEW_EDIT_DELETE_COURSE', 'New/Edit/Delete Course', 1),
('NEW_EDIT_DELETE_INTERACTIVE_COURSE', 'New/Edit/Delete Interactive Course', 1),
('NEW_EDIT_DELETE_PRESENTATION_COURSE', 'New/Edit/Delete Presentation Course', 1),
('NEW_EDIT_DELETE_REPOSITORY', 'New/Edit/Delete Repository', 4),
('NEW_EDIT_DELETE_SERVICES', 'New/Edit/Delete Services', 3),
('NEW_EDIT_DELETE_SERVICE_CATEGORY', 'New/Edit/Delete Service Category', 3),
('NEW_EDIT_DELETE_WIDGET', 'New/Edit/Delete Widget', 2),
('NEW_EDIT_DELETE_WIDGET_CATEGORY', 'New/Edit/Delete Widget Category', 2),
('NOTIFICATIONS', 'Notifications', 5),
('PREVIEW_COURSE', 'Preview Course', 1),
('PUBLISH_TO_STORE_WIDGET', 'Publish to Store Widget', 2),
('REVIEWS', 'reviews', 5),
('SITE_CONFIGURATION', 'Site Configuration', 4),
('USER_MANAGEMENT', 'User Management', 4),
('VIEW_ALL_COURSES', 'View All Courses', 1),
('VIEW_CATEGORY_COURSE', 'View Category Course', 1),
('VIEW_CATEGORY_WIDGET', 'View Category Widget', 2),
('VIEW_COURSE_SUPPORT_SERVICES', 'View Course Support Services', 1),
('VIEW_INTERACTIVE_COURSE', 'View Interactive Course', 1),
('VIEW_MY_COURSES', 'View My Courses', 1),
('VIEW_MY_SERVICES', 'View My Services', 3),
('VIEW_MY_WIDGET', 'View My Widget', 2),
('VIEW_PRESENTATION', 'View Presentation', 1);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `category_actions`
--

CREATE TABLE IF NOT EXISTS `category_actions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Άδειασμα δεδομένων του πίνακα `category_actions`
--

INSERT INTO `category_actions` (`id`, `name`) VALUES
(1, 'Courses'),
(2, 'Widgets'),
(3, 'FORGEBox Services'),
(4, 'System'),
(5, 'User Menu');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `match_action_role`
--

CREATE TABLE IF NOT EXISTS `match_action_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_role` int(11) NOT NULL,
  `action` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=131 ;

--
-- Άδειασμα δεδομένων του πίνακα `match_action_role`
--

INSERT INTO `match_action_role` (`id`, `id_role`, `action`) VALUES
(13, 1, 'NEW_EDIT_DELETE_CATEGORY_COURSE'),
(15, 1, 'USER_MANAGEMENT'),
(31, 1, 'ACCESS_CONTROL'),
(34, 1, 'INSTALL_COURSE_FROM_FORGESTORE'),
(35, 1, 'VIEW_PRESENTATION'),
(36, 1, 'VIEW_INTERACTIVE_COURSE'),
(38, 1, 'VIEW_COURSE_SUPPORT_SERVICES'),
(39, 1, 'VIEW_CATEGORY_COURSE'),
(40, 1, 'INSTALLED_MY_WIDGET'),
(41, 1, 'INSTALL_WIDGETS'),
(42, 1, 'VIEW_MY_WIDGET'),
(43, 1, 'DELETE_INSTALLED_WIDGET'),
(44, 1, 'NEW_EDIT_DELETE_WIDGET'),
(45, 1, 'PUBLISH_TO_STORE_WIDGET'),
(47, 1, 'VIEW_CATEGORY_WIDGET'),
(48, 1, 'NEW_EDIT_DELETE_WIDGET_CATEGORY'),
(49, 1, 'INSTALL_SERVICES'),
(53, 1, 'ADD_DELETE_ORDER_COURSE_PART'),
(54, 1, 'DELETE_MY_SERVICES'),
(55, 1, 'DELETE_MY_WIDGET'),
(56, 1, 'EPUB_EXPORT_COURSE'),
(57, 1, 'MY_ACCOUNT'),
(58, 1, 'MY_DASHBOARD'),
(59, 1, 'NEW_EDIT_DELETE_COURSE'),
(60, 1, 'NEW_EDIT_DELETE_INTERACTIVE_COURSE'),
(61, 1, 'NEW_EDIT_DELETE_PRESENTATION_COURSE'),
(62, 1, 'NEW_EDIT_DELETE_REPOSITORY'),
(63, 1, 'NEW_EDIT_DELETE_SERVICE_CATEGORY'),
(64, 1, 'NEW_EDIT_DELETE_SERVICES'),
(65, 1, 'NOTIFICATIONS'),
(66, 1, 'PREVIEW_COURSE'),
(67, 1, 'REVIEWS');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `store_scorm_epub`
--

CREATE TABLE IF NOT EXISTS `store_scorm_epub` (
  `course_id` int(11) NOT NULL,
  `has_scorm` tinyint(4) NOT NULL,
  `has_epub` tinyint(4) NOT NULL,
  PRIMARY KEY (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `tbl_category_courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `course_item_id` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;


--
-- Δομή πίνακα για τον πίνακα `tbl_category_widget`
--

CREATE TABLE IF NOT EXISTS `tbl_category_widget` (
  `id_category_widget` int(11) NOT NULL AUTO_INCREMENT,
  `name_category_widget` varchar(50) NOT NULL,
  `active_category_widget` smallint(6) NOT NULL,
  PRIMARY KEY (`id_category_widget`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `tbl_courses`
--

CREATE TABLE IF NOT EXISTS `tbl_courses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `sdescription` varchar(250) NOT NULL,
  `content` longtext NOT NULL,
  `course_item_id` int(11) NOT NULL,
  `author` varchar(250) NOT NULL,
  `create_date` datetime NOT NULL,
  `modify_date` datetime NOT NULL,
  `publisher` varchar(250) DEFAULT NULL,
  `language` varchar(250) DEFAULT NULL,
  `about` varchar(250) DEFAULT NULL,
  `alignmentType` varchar(250) DEFAULT NULL,
  `educationalFramework` varchar(250) DEFAULT NULL,
  `targetName` varchar(250) DEFAULT NULL,
  `targetDescription` varchar(250) DEFAULT NULL,
  `targetURL` varchar(250) DEFAULT NULL,
  `educationalUse` varchar(250) DEFAULT NULL,
  `duration` varchar(250) DEFAULT NULL,
  `typicalAgeRange` varchar(250) DEFAULT NULL,
  `interactivityType` varchar(250) DEFAULT NULL,
  `learningResourseType` varchar(250) DEFAULT NULL,
  `licence` varchar(250) DEFAULT NULL,
  `isBasedOnURL` varchar(250) DEFAULT NULL,
  `educationalRole` varchar(250) DEFAULT NULL,
  `audienceType` varchar(250) DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  `publish_to_anonymous` tinyint(4) NOT NULL,
  `category_id` int(11) NOT NULL,
  `create_uid` int(11) NOT NULL,
  `interactive_category` int(11) DEFAULT NULL,
  `interactive_item` int(11) DEFAULT NULL,
  `interactive_url` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=117 ;

--
-- Δομή πίνακα για τον πίνακα `tbl_course_types`
--

CREATE TABLE IF NOT EXISTS `tbl_course_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Άδειασμα δεδομένων του πίνακα `tbl_course_types`
--

INSERT INTO `tbl_course_types` (`id`, `name`, `active`) VALUES
(1, 'Course module', 1),
(2, 'Presentation Part', 1),
(3, 'Interactive Part', 1);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `tbl_install_widget`
--

CREATE TABLE IF NOT EXISTS `tbl_install_widget` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `widget_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `url_widget` varchar(150) NOT NULL,
  `title_widget` varchar(150) NOT NULL,
  `author_widget` varchar(150) NOT NULL,
  `description_widget` text NOT NULL,
  `marketplace_id` int(11) NOT NULL,
  `version` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=84 ;

--
-- Δομή πίνακα για τον πίνακα `tbl_match_course_category`
--

CREATE TABLE IF NOT EXISTS `tbl_match_course_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `course_category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=251 ;


--
-- Δομή πίνακα για τον πίνακα `tbl_match_present_interact_course`
--

CREATE TABLE IF NOT EXISTS `tbl_match_present_interact_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) NOT NULL,
  `presentation_id` int(11) DEFAULT NULL,
  `interactive_id` int(11) DEFAULT NULL,
  `order_list` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;

--
-- Δομή πίνακα για τον πίνακα `tbl_repository`
--

CREATE TABLE IF NOT EXISTS `tbl_repository` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `url_json` varchar(100) NOT NULL,
  `url_images` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Άδειασμα δεδομένων του πίνακα `tbl_repository`
--

INSERT INTO `tbl_repository` (`id`, `name`, `active`, `url_json`, `url_images`) VALUES
(2, 'Local FORGEBox repository', 1, 'localmarket/_json/', 'images/_widget/');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `tbl_role`
--

CREATE TABLE IF NOT EXISTS `tbl_role` (
  `id_role` int(11) NOT NULL AUTO_INCREMENT,
  `name_role` varchar(50) NOT NULL,
  `active_role` smallint(6) NOT NULL,
  PRIMARY KEY (`id_role`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Άδειασμα δεδομένων του πίνακα `tbl_role`
--

INSERT INTO `tbl_role` (`id_role`, `name_role`, `active_role`) VALUES
(1, 'Administrator', 1),
(2, 'Designer', 1),
(3, 'FIRE Adapter Provider', 1),
(4, 'Widget Provider', 1),
(5, 'Lab Course Assistant Teacher', 1),
(6, 'Learner', 1),
(7, 'Anonymous', 1);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `tbl_support_services`
--

CREATE TABLE IF NOT EXISTS `tbl_support_services` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `url_data` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Δομή πίνακα για τον πίνακα `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `name_user` varchar(50) NOT NULL,
  `surname_user` varchar(50) NOT NULL,
  `email_user` varchar(50) NOT NULL,
  `password_user` text NOT NULL,
  `active_user` smallint(6) NOT NULL,
  `register_date` date NOT NULL,
  `last_login_date` date NOT NULL,
  `avatar_name` varchar(255) NOT NULL,
  `auth_type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=21 ;

--
-- Άδειασμα δεδομένων του πίνακα `tbl_users`
--

INSERT INTO `tbl_users` (`id_user`, `name_user`, `surname_user`, `email_user`, `password_user`, `active_user`, `register_date`, `last_login_date`, `avatar_name`, `auth_type`) VALUES
(1, 'Administrator', 'user', 'admin@forgebox.eu', '21232f297a57a5a743894a0e4a801fc3', 1, '2014-02-25', '2014-02-25', '', NULL);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `tbl_user_role`
--

CREATE TABLE IF NOT EXISTS `tbl_user_role` (
  `id_role_user` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `id_role` int(11) NOT NULL,
  PRIMARY KEY (`id_role_user`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=51 ;

--
-- Άδειασμα δεδομένων του πίνακα `tbl_user_role`
--

INSERT INTO `tbl_user_role` (`id_role_user`, `id_user`, `id_role`) VALUES
(1, 1, 1);

--
-- Δομή πίνακα για τον πίνακα `tbl_widget_match_with_category`
--


CREATE TABLE IF NOT EXISTS `tbl_widget_match_with_category` (
  `id_widget_match_with_category` int(11) NOT NULL AUTO_INCREMENT,
  `id_category_widget` int(11) NOT NULL,
  `id_widget_meta_data` int(11) NOT NULL,
  PRIMARY KEY (`id_widget_match_with_category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `tbl_widget_meta_data`
--

CREATE TABLE IF NOT EXISTS `tbl_widget_meta_data` (
  `id_widget_meta_data` int(11) NOT NULL AUTO_INCREMENT,
  `url_widget_meta_data` text NOT NULL,
  `title_widget_meta_data` varchar(150) NOT NULL,
  `author_widget_meta_data` varchar(100) NOT NULL,
  `sdescription_widget_meta_data` varchar(250) NOT NULL,
  `description_widget_meta_data` text NOT NULL,
  `simage_widget_meta_data` varchar(150) NOT NULL,
  `limage_widget_meta_data` varchar(150) NOT NULL,
  `active_widget_meta_data` smallint(6) NOT NULL,
  `version_widget_meta_data` varchar(50) NOT NULL,
  `create_date_widget_meta_data` datetime NOT NULL DEFAULT '2014-04-24 00:00:00',
  PRIMARY KEY (`id_widget_meta_data`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `tbl_widget_screenshot`
--

CREATE TABLE IF NOT EXISTS `tbl_widget_screenshot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `widget_id` int(11) NOT NULL,
  `screenshot_name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
