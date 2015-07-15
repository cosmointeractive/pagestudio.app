-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 15, 2015 at 02:28 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `projects_pagestudio_v2`
--
CREATE DATABASE IF NOT EXISTS `projects_pagestudio_v2` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `projects_pagestudio_v2`;

-- --------------------------------------------------------

--
-- Table structure for table `cimp_calendar`
--

CREATE TABLE IF NOT EXISTS `cimp_calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_title` varchar(255) COLLATE utf8_bin NOT NULL,
  `event_description` text COLLATE utf8_bin NOT NULL,
  `event_start` datetime NOT NULL,
  `event_end` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `event_created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `event_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `event_url` varchar(255) COLLATE utf8_bin NOT NULL,
  `event_featured` varchar(255) COLLATE utf8_bin NOT NULL,
  `event_author` int(11) NOT NULL,
  `allDay` varchar(255) COLLATE utf8_bin NOT NULL DEFAULT 'false',
  `repeat` tinyint(1) NOT NULL DEFAULT '0',
  `series_id` int(64) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `series_id` (`series_id`),
  KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cimp_categories`
--

CREATE TABLE IF NOT EXISTS `cimp_categories` (
  `category_ID` bigint(20) NOT NULL AUTO_INCREMENT,
  `category_title` varchar(255) NOT NULL DEFAULT 'Uncategorized',
  `category_slug` varchar(255) NOT NULL DEFAULT 'uncategorized',
  `category_description` longtext NOT NULL,
  `category_parent` bigint(20) NOT NULL DEFAULT '0',
  `category_count` bigint(20) NOT NULL DEFAULT '0',
  `category_sort` varchar(10) DEFAULT NULL,
  `category_visibility` tinyint(1) NOT NULL,
  PRIMARY KEY (`category_ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `cimp_categories`
--

INSERT INTO `cimp_categories` (`category_ID`, `category_title`, `category_slug`, `category_description`, `category_parent`, `category_count`, `category_sort`, `category_visibility`) VALUES
(1, 'Uncategorized', 'uncategorized', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vel elit varius, varius ipsum auctor, placerat metus. Cras suscipit, nisi eu semper euismod, odio mauris placerat tellus, id venenatis erat libero sit amet neque. \\r\\n\\r\\nMore', 0, 0, NULL, 1),
(2, 'General', 'general', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce vel elit varius, varius ipsum auctor, placerat metus. Cras suscipit, nisi eu semper euismod, odio mauris placerat tellus, id venenatis erat libero sit amet neque. ', 0, 0, NULL, 1),
(3, 'Sermons', 'sermons', '', 0, 0, NULL, 1),
(4, 'Staff', 'staff', '', 0, 0, NULL, 1),
(5, 'News', 'news', '', 0, 0, NULL, 1),
(8, 'Event', 'event', '', 0, 0, NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cimp_categories_entries`
--

CREATE TABLE IF NOT EXISTS `cimp_categories_entries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `post_ID` bigint(20) DEFAULT NULL,
  `category_ID` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=229 ;

--
-- Dumping data for table `cimp_categories_entries`
--

INSERT INTO `cimp_categories_entries` (`id`, `post_ID`, `category_ID`) VALUES
(91, 28, 3),
(111, 30, 5),
(121, 32, 5),
(131, 33, 5),
(142, 34, 2),
(161, 45, 5),
(177, 31, 5),
(198, 27, 2),
(199, 27, 5),
(222, 21, 4),
(223, 21, 5),
(228, 29, 5);

-- --------------------------------------------------------

--
-- Table structure for table `cimp_core_pages`
--

CREATE TABLE IF NOT EXISTS `cimp_core_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `access_level` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `cimp_core_pages`
--

INSERT INTO `cimp_core_pages` (`id`, `title`, `content`, `access_level`) VALUES
(1, 'Dashboard', 'Welcome, you are on the <b>dashboard</b>, the first view upon login. The different widgets on this page keeps you up-to-date about your website''s most recent activity.  Allowing you a chance to make quick decisions.', 1),
(2, 'Users', 'This page allows you to edit, add, enable, disable, and delete user accounts.', 9),
(3, 'Content Management', 'This page allows you to modify the content of your website.', 5),
(7, 'Calendar', 'This page allows you to add edit and delete events on your website...', 5),
(4, 'Email', 'This is going to hold the email newsletters, email account set up, etc...', 1),
(5, 'General Settings', 'This page allows you modify the settings for the CMS, such as users group, view stats, set language, etc...', 9),
(6, 'Support', 'This is the support page...', 1),
(8, 'Media Libraries', 'This page allows you to modify the images libraries on your front end/public pages...', 5),
(9, 'Documents and Downloads', 'This page allows you to upload images and document files to your website for users to download...', 5),
(10, 'Tutorials', 'Come to this page to view all tutorials.', 0),
(11, 'Administration', 'This page is not visible to anyone except the System <b>Administrator</b>. It is to allow the Sys Admin to manage, view logs, and debugg the application. ', 10),
(12, 'Testimonials', 'On this page you will find the latest comments that users have left on your website.', 0),
(13, 'Posts', 'A post is typical for and most used by blogs. Posts are normally displayed in a blog in reverse sequential order by time (newest posts first). Posts are also used for creating the feeds. ', 0),
(14, 'Comments', 'Blog replies', 1),
(15, 'Edit User', 'Modify single user account.', 9),
(16, 'Modules', 'Modules are larger systems that can be integrated into the control panel. They extend the functionality of the control panel, and or, add functionality to a website. Modules typically store content in the database and can have actions associated with them.', 9),
(17, 'Website Settings', 'Manage the website availability and template design. ', 9),
(18, 'Email configuration', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cimp_events_calendar`
--

CREATE TABLE IF NOT EXISTS `cimp_events_calendar` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL DEFAULT '',
  `slug` varchar(64) NOT NULL,
  `date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date2` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `date_range` int(1) NOT NULL DEFAULT '0',
  `preview` varchar(150) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `comments` int(10) NOT NULL DEFAULT '0',
  `archive` int(1) NOT NULL DEFAULT '0',
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `repeat` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=41 ;

--
-- Dumping data for table `cimp_events_calendar`
--

INSERT INTO `cimp_events_calendar` (`id`, `name`, `slug`, `date`, `date2`, `date_range`, `preview`, `content`, `comments`, `archive`, `date_created`, `date_updated`, `repeat`) VALUES
(34, 'Praesent Convallis', 'praesent-convallis', '2014-10-30 16:00:00', '2014-06-07 00:00:00', 1, 'Suspendisse Potenti. Integer Placerat Justo Ac...', '<p>Aenean in tellus tincidunt, sagittis sem a, rutrum orci. Donec fringilla erat nec dui fermentum ullamcorper. Aenean id urna eu leo consequat ornare. Sed sagittis felis a faucibus mollis. Aliquam eget viverra tellus, sit amet sodales leo. Maecenas lacinia sem non sapien scelerisque consequat. Proin et nisl feugiat, volutpat metus at, cursus nisi. Proin pellentesque luctus augue at varius. Nulla consequat lacus est, vitae lacinia erat malesuada sed. Integer in lorem arcu. Aenean id varius diam. Aenean aliquet vulputate justo in mollis. Suspendisse et volutpat odio. Suspendisse non fermentum velit. Praesent lacinia auctor mi quis dignissim.</p>\r\n<p>Pellentesque sollicitudin magna ac massa condimentum, a posuere magna hendrerit. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi vitae iaculis risus. Duis nec risus nibh. Nullam quis lorem nibh. Etiam sapien metus, sagittis non eleifend a, auctor nec quam. Suspendisse bibendum nisl a dictum faucibus. Nam porta nec elit et fringilla. Sed vel velit molestie, pulvinar dolor eu, ultrices sapien.</p>', 0, 0, '0000-00-00 00:00:00', '2014-05-26 15:34:36', NULL),
(38, 'Lorem Ipsum Dolor ', 'lorem-ipsum-dolor', '2014-10-30 16:00:00', '2014-06-18 00:00:00', 1, 'Lorem Ipsum Dolor Sit Amet, Consectetur Adipiscing', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc pellentesque volutpat ipsum, vel volutpat risus accumsan eu. Phasellus eu odio lectus, congue ultrices quam. Donec et luctus orci. Proin eu eros quis lectus posuere iaculis et eget nisi. Nunc ullamcorper dolor in sem pulvinar ac volutpat velit pretium. Nullam et cursus nisi. In laoreet, leo id facilisis placerat, tortor odio luctus ante, at pharetra leo diam nec lectus. Maecenas adipiscing eleifend erat, et molestie magna facilisis vitae.</p>', 0, 0, '2013-01-29 02:12:55', '2014-05-26 14:08:39', NULL),
(39, 'Golf Image', 'golf-image', '2014-10-30 16:00:00', '2014-05-23 00:00:00', 1, 'There Is This New Event Taking Place Near You', '<p>Lorem ipsum</p>', 0, 0, '2014-05-06 14:53:48', '2014-05-26 14:08:30', NULL),
(40, 'Welcome Committee Meeting', 'welcome-committee-meeting', '2014-10-15 00:00:00', '2014-05-21 00:00:00', 1, 'The Welcome Committee Meetting At 10:00am ', '<p>Please make every effort to attend the meeting. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin pretium non erat quis sollicitudin. Proin convallis ornare lacus, eleifend tempor odio suscipit ut. Cras cursus sollicitudin risus, at varius lectus condimentum sit amet. Mauris mauris tortor, venenatis at lacus sed, semper lacinia quam. Vivamus tincidunt, massa ut vestibulum laoreet, dolor enim vulputate quam, non imperdiet mi metus et mi. Nulla posuere quam quis felis commodo, in varius dui posuere. Nullam non scelerisque eros.</p>\r\n<div id="lipsum">\r\n<p>Vestibulum ac orci non risus consectetur congue. Vivamus ac eros sed urna pharetra feugiat lobortis sit amet metus. Mauris ut est non felis ultricies auctor id et erat. Nam condimentum ullamcorper quam, nec tempus justo malesuada a. Quisque sed sapien sed lorem ultricies sollicitudin vel vitae sapien. Nulla scelerisque nunc sit amet suscipit placerat. Vestibulum sagittis sagittis metus, condimentum pharetra velit condimentum a. Vestibulum ultrices ornare diam, non malesuada ligula adipiscing vel. Suspendisse vel nibh venenatis, aliquam dolor et, fermentum mauris.</p>\r\n</div>', 0, 0, '2014-05-20 02:43:15', '2014-10-03 20:52:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cimp_modules`
--

CREATE TABLE IF NOT EXISTS `cimp_modules` (
  `module_id` bigint(20) NOT NULL AUTO_INCREMENT,
  `module_name` varchar(64) NOT NULL,
  `module_slug` varchar(64) NOT NULL,
  `module_thumbnail` text NOT NULL,
  `module_short_description` varchar(156) NOT NULL DEFAULT 'Another module that extends the functionality of the admin cms.',
  `module_long_description` longtext NOT NULL,
  `module_version` varchar(11) NOT NULL,
  `module_author` varchar(64) NOT NULL,
  `module_website` text NOT NULL,
  `module_date_installed` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `module_date_updated` datetime NOT NULL,
  `module_status` tinyint(2) NOT NULL,
  PRIMARY KEY (`module_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `cimp_modules`
--

INSERT INTO `cimp_modules` (`module_id`, `module_name`, `module_slug`, `module_thumbnail`, `module_short_description`, `module_long_description`, `module_version`, `module_author`, `module_website`, `module_date_installed`, `module_date_updated`, `module_status`) VALUES
(1, 'Hello World', 'hello-world', '', 'Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable Eng', '', '0.0.1', 'Cosmo Mathieu', 'http://cimwebdesigns.com', '2014-03-05 22:22:40', '2014-03-05 17:23:32', 0),
(2, 'Albums', 'albums', '', 'Albums allows you to add create multiple image galleries for your website. Add, edit, and delete images as many times as you need. ', 'Albums allows you to add create multiple image galleries for your website. Add, edit, and delete images as many times as you need. ', '0.0.1', 'Cosmo Mathieu', 'http://cimwebdesigns.com', '2014-03-06 03:22:40', '2014-03-05 22:23:32', 0),
(3, 'Posts Test Module', 'posts-test-module', '', 'Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable Eng', 'Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable Eng', '1.0', 'Cosmo Mathieu', 'http://cimwebdesigns.com', '2014-04-06 13:50:34', '2014-04-06 09:50:34', 0),
(4, 'File Manager', 'file-manager', '', 'The file manager is a multi-purpose feature that allows you to upload, browse, search, edit, rename and delete any type of file', '<p>The file manager is a multi-purpose feature that allows you to upload, browse, search, edit, rename and delete any type of file</p>\n<p>Following features are present as of now.</p>\n<ul>\n <li>Create File, Folder</li>\n <li>Upload ,Download file</li>\n <li>View, Edit files</li>\n <li>rename an delete files</li>\n</ul>\n<p>More features to be added soon.</p>\n<ul>\n <li>Code editor for script fles</li>\n <li>Image editor for image files</li>\n</ul>', '1.0', 'Open Manager', '', '2014-04-24 02:02:13', '2014-04-23 22:02:13', 0),
(5, 'Page Sliders', 'page-sliders', '', 'Page Sliders allows you to create custom slideshows for each page of your website. ', '', '1.0', 'Cosmo Mathieu', 'http://cimwebdesigns.com/', '2014-04-30 13:57:27', '2014-04-30 09:57:27', 0),
(6, 'Posts', 'posts', '', 'Posts are entries that display in reverse order on your home page.', '', '1.0', 'Cosmo Mathieu', 'http://cimwebdesigns.com/', '2014-04-30 18:57:53', '2014-04-30 14:57:53', 0),
(7, 'Comments', 'comments', '', 'Comments allow your website visitors to add feedback to your posts. If you choose to enable comments for your posts, then a comment form will appear at the ', '', '1.0', 'Cosmo Mathieu', 'http://cimwebdesigns.com/', '2014-04-30 19:02:56', '2014-04-30 15:02:56', 0),
(8, 'Analytics', 'analytics', '', 'The Traffic Analytics module allows you to track your blog easily and with lots of metadata.', '', '0.1.0', 'Cosmo Mathieu', 'http://cimwebdesigns.com/', '2014-06-02 19:04:03', '2014-06-02 15:04:03', 0),
(9, 'Staff', 'staff', '', 'A simple module to build and display a staff listing for your website.', 'A simple module to build and display a staff listing for your website. ', '1.0.0', 'Cosmo Mathieu', 'http://cimwebdesigns.com/', '2014-06-07 20:36:17', '2014-06-07 16:36:47', 0),
(10, 'testimonials', 'testimonials', '', 'Another module that extends the functionality of the admin cms.', '', '1.0.0', 'Cosmo Mathieu', 'http://cosmointeractive.co', '2014-07-08 16:33:41', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cimp_module_gallery_category`
--

CREATE TABLE IF NOT EXISTS `cimp_module_gallery_category` (
  `category_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `category_name` varchar(150) NOT NULL DEFAULT '0',
  `category_description` text NOT NULL,
  `tags` text NOT NULL,
  `sort` int(10) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`category_id`),
  KEY `category_id` (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cimp_module_gallery_category`
--

INSERT INTO `cimp_module_gallery_category` (`category_id`, `category_name`, `category_description`, `tags`, `sort`, `date_created`) VALUES
(1, 'New Gallery Name B', '', '', 0, '2014-01-28 04:00:21');

-- --------------------------------------------------------

--
-- Table structure for table `cimp_module_gallery_photos`
--

CREATE TABLE IF NOT EXISTS `cimp_module_gallery_photos` (
  `photo_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `photo_filename` varchar(150) DEFAULT NULL,
  `photo_caption` text,
  `photo_category` bigint(20) unsigned NOT NULL DEFAULT '0',
  `sort_id` int(11) NOT NULL,
  PRIMARY KEY (`photo_id`),
  KEY `photo_id` (`photo_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `cimp_module_gallery_photos`
--

INSERT INTO `cimp_module_gallery_photos` (`photo_id`, `photo_filename`, `photo_caption`, `photo_category`, `sort_id`) VALUES
(4, 'GAL303305361454fa2ea0.jpg', '<p>tags for the image</p>', 3, 0),
(2, 'GAL2505652f59965ee6e2.jpg', '<p>Tulips image tag</p>', 1, 1),
(3, 'GAL486053613fb3265f7.jpg', '<p>Something about the Jelly fish picture</p>', 1, 2),
(6, 'GAL13252536146fa80b6b.jpg', '', 4, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cimp_module_sstaff`
--

CREATE TABLE IF NOT EXISTS `cimp_module_sstaff` (
  `member_id` int(10) NOT NULL AUTO_INCREMENT,
  `member_name` varchar(250) NOT NULL,
  `member_name_slug` varchar(255) DEFAULT NULL,
  `editor` varchar(100) NOT NULL,
  `member_work_phone` varchar(64) NOT NULL,
  `member_email` varchar(64) NOT NULL,
  `member_job_title` varchar(64) NOT NULL,
  `member_detail` text NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `member_status` int(1) NOT NULL DEFAULT '0',
  `member_type` varchar(150) NOT NULL,
  PRIMARY KEY (`member_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `cimp_module_sstaff`
--

INSERT INTO `cimp_module_sstaff` (`member_id`, `member_name`, `member_name_slug`, `editor`, `member_work_phone`, `member_email`, `member_job_title`, `member_detail`, `date_created`, `date_modified`, `member_status`, `member_type`) VALUES
(1, 'Jeremiah Conley', 'jeremiah-conley', 'Cosmo Mathieu', '864-998-5566', 'jconley@nowhere.com', 'Director of Missions', '<h2>Life Story</h2>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc pellentesque volutpat ipsum, vel volutpat risus accumsan eu. Phasellus eu odio lectus, congue ultrices quam. Donec et luctus orci. Proin eu eros quis lectus posuere iaculis et eget nisi. Nunc ullamcorper dolor in sem pulvinar ac volutpat velit pretium. Nullam et cursus nisi. In laoreet, leo id facilisis placerat, tortor odio luctus ante, at pharetra leo diam nec lectus. Maecenas adipiscing eleifend erat, et molestie magna facilisis vitae.</p>\r\n<h2>Hope for Cedar Grove Baptist SC</h2>\r\n<p>Quisque lobortis scelerisque nunc, eu pulvinar risus accumsan nec. Nulla pharetra scelerisque turpis cursus convallis. Duis a magna luctus, accumsan nisl a, bibendum quam.</p>', '2014-06-07 22:59:14', '2014-08-28 12:30:39', 1, 'staff'),
(2, 'Marcy Conley', 'marcy-conley', 'Cosmo Mathieu', '(864) 999-55-66', 'mconley@nowhere.com', 'Children''s Intern', '<h2>Life Story</h2>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc pellentesque volutpat ipsum, vel volutpat risus accumsan eu. Phasellus eu odio lectus, congue ultrices quam. Donec et luctus orci. Proin eu eros quis lectus posuere iaculis et eget nisi. Nunc ullamcorper dolor in sem pulvinar ac volutpat velit pretium. Nullam et cursus nisi. In laoreet, leo id facilisis placerat, tortor odio luctus ante, at pharetra leo diam nec lectus. Maecenas adipiscing eleifend erat, et molestie magna facilisis vitae.</p>\r\n<h2>Hope for Cedar Grove Baptist SC</h2>\r\n<p>Quisque lobortis scelerisque nunc, eu pulvinar risus accumsan nec. Nulla pharetra scelerisque turpis cursus convallis. Duis a magna luctus, accumsan nisl a, bibendum quam.</p>', '2014-06-08 02:59:14', '2014-08-28 12:04:50', 1, 'staff'),
(3, 'Tiny Marshall', 'tiny-marshall', 'Cosmo Mathieu', '999-666-5522', 'jconley@nowhere.com', 'Senior Pastor', '<p>[member\\_picture]</p>\r\n<p><img src="/projects/pagestudio\\_1.1.0/admin../uploads/filemanager\\_source/reverend-a-a-dicks-jr..jpg" alt="reverend-a-a-dicks-jr." /></p>\r\n<p>[/member\\_picture]</p>\r\n<h2>Life Story</h2>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc pellentesque volutpat ipsum, vel volutpat risus accumsan eu. Phasellus eu odio lectus, congue ultrices quam. Donec et luctus orci. Proin eu eros quis lectus posuere iaculis et eget nisi. Nunc ullamcorper dolor in sem pulvinar ac volutpat velit pretium. Nullam et cursus nisi. In laoreet, leo id facilisis placerat, tortor odio luctus ante, at pharetra leo diam nec lectus. Maecenas adipiscing eleifend erat, et molestie magna facilisis vitae..</p>\r\n<h2>Hope for Cedar Grove Baptist SC</h2>\r\n<p>Quisque lobortis scelerisque nunc, eu pulvinar risus accumsan nec. Nulla pharetra scelerisque turpis cursus convallis. Duis a magna luctus, accumsan nisl a, bibendum quam.</p>', '2014-06-08 02:59:14', '2014-10-11 00:26:47', 1, 'staff'),
(4, 'John Doe', 'john-doe', 'CIM Administrator', '(864) 999-55-66', 'jdoe@techmysite.com', 'Director of Youth Music', '<h2>Life Story</h2> <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc pellentesque volutpat ipsum, vel volutpat risus accumsan eu. Phasellus eu odio lectus, congue ultrices quam. Donec et luctus orci. Proin eu eros quis lectus posuere iaculis et eget nisi. Nunc ullamcorper dolor in sem pulvinar ac volutpat velit pretium. Nullam et cursus nisi. In laoreet, leo id facilisis placerat, tortor odio luctus ante, at pharetra leo diam nec lectus. Maecenas adipiscing eleifend erat, et molestie magna facilisis vitae.</p> <h2>Hope for Cedar Grove Baptist SC</h2> <p>Quisque lobortis scelerisque nunc, eu pulvinar risus accumsan nec. Nulla pharetra scelerisque turpis cursus convallis. Duis a magna luctus, accumsan nisl a, bibendum quam.</p> ', '2014-06-14 23:45:41', '2014-06-14 19:46:15', 1, 'staff');

-- --------------------------------------------------------

--
-- Table structure for table `cimp_module_sstaff_categories`
--

CREATE TABLE IF NOT EXISTS `cimp_module_sstaff_categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `member_ID` bigint(20) DEFAULT NULL,
  `category_ID` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `cimp_module_sstaff_categories`
--

INSERT INTO `cimp_module_sstaff_categories` (`id`, `member_ID`, `category_ID`) VALUES
(2, 0, 7),
(3, 0, 4),
(4, 0, 7),
(16, 4, 7),
(27, 2, 7),
(43, 1, 7),
(48, 3, 6);

-- --------------------------------------------------------

--
-- Table structure for table `cimp_options`
--

CREATE TABLE IF NOT EXISTS `cimp_options` (
  `option_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `option_name` varchar(64) NOT NULL DEFAULT '',
  `option_value` longtext NOT NULL,
  PRIMARY KEY (`option_id`),
  UNIQUE KEY `option_name` (`option_name`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=49 ;

--
-- Dumping data for table `cimp_options`
--

INSERT INTO `cimp_options` (`option_id`, `option_name`, `option_value`) VALUES
(1, 'app_version', '1.1.0'),
(2, 'site_name', 'Cedar Grove Baptist Church Simpsonville'),
(3, 'site_url', 'http://localhost/projects/pagestudio_1.1.0/'),
(4, 'site_meta_keywords', ''),
(5, 'site_meta_description', 'The Cedar Grove Baptist Church is a fellowship of baptized believers in Jesus Christ. Empowered by the Holy Spirit, we seek to carry out the will and work of God through education, evangelism, fellowship, ministry, stewardship and worship.'),
(6, 'site_online', '1'),
(7, 'user_login', '0'),
(8, 'user_registration', '0'),
(9, 'user_login_required', '0'),
(10, 'blog_url', 'http://localhost/projects/pagestudio_1.1.0/'),
(11, 'blog_title', ''),
(12, 'blog_landing_page', 'blog'),
(13, 'blog_posts_per_page', '3'),
(14, 'blog_comment_per_page', '2'),
(15, 'blog_links_per_page', '5'),
(16, 'blog_post_order', 'desc'),
(17, 'blog_comment_order', 'asc'),
(18, 'blog_public', '1'),
(19, 'blog_comments_notify', '0'),
(20, 'themes_path', 'themes'),
(21, 'theme_name', 'default'),
(22, 'modules_path', ''),
(23, 'modules_status', ''),
(24, 'portal_online', '1'),
(25, 'portal_login_on', '1'),
(26, 'portal_forgot_pass', '1'),
(27, 'portal_theme', 'default'),
(28, 'default_timezone', 'America/New_York'),
(29, 'default_date_format', 'F jS, Y'),
(30, 'default_time_format', 'g:i a'),
(31, 'default_gmt_offset', ''),
(32, 'admin_email', 'cosmo@cimwebdesigns.com'),
(33, 'reply_email', 'no-reply@cedargrovesc.com'),
(34, 'webmaster_email', 'cosmo@cimwebdesigns.com'),
(35, 'mail_server', 'srv53.hosting24.com'),
(36, 'mail_login', 'cosmo@cimwebdesigns.com'),
(37, 'mail_password', 'cumakit@fixi1'),
(38, 'mail_incoming_srv', ''),
(39, 'mail_outgoing_srv', ''),
(40, 'mail_ssl_on', ''),
(41, 'mail_authen_srvc', 'ssl'),
(42, 'mail_incoming_port', ''),
(43, 'mail_outgoing_port', '465'),
(44, 'mail_send_as_html', '1'),
(45, 'testimonial_notify', '1'),
(46, 'testimonial_order', 'desc'),
(47, 'dashboard_widgets_order', 'a:0:{}'),
(48, 'tracking_code', '<script>\n	  (function(i,s,o,g,r,a,m){i[''GoogleAnalyticsObject'']=r;i[r]=i[r]||function(){\n	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),\n	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)\n	  })(window,document,''script'',''//www.google-analytics.com/analytics.js'',''ga'');\n\n	  ga(''create'', ''UA-52082062-1'', ''cimwebdesigns.com'');\n	  ga(''send'', ''pageview'');\n	</script>');

-- --------------------------------------------------------

--
-- Table structure for table `cimp_pages`
--

CREATE TABLE IF NOT EXISTS `cimp_pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_parent` int(11) NOT NULL DEFAULT '0',
  `page_title` varchar(255) NOT NULL,
  `page_slug` varchar(255) NOT NULL,
  `page_layout` varchar(255) NOT NULL,
  `permanent_link` varchar(250) NOT NULL,
  `page_content` text NOT NULL,
  `page_meta` text NOT NULL,
  `menu_order` varchar(2) NOT NULL DEFAULT '0',
  `menu_visibility` tinyint(4) NOT NULL,
  `page_author` int(10) DEFAULT NULL,
  `page_editor` varchar(255) NOT NULL,
  `page_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `page_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `access_level` tinyint(4) NOT NULL DEFAULT '0',
  `page_status` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=30 ;

--
-- Dumping data for table `cimp_pages`
--

INSERT INTO `cimp_pages` (`id`, `page_parent`, `page_title`, `page_slug`, `page_layout`, `permanent_link`, `page_content`, `page_meta`, `menu_order`, `menu_visibility`, `page_author`, `page_editor`, `page_date`, `page_modified`, `access_level`, `page_status`) VALUES
(1, 0, 'Home', 'home', 'home', '', '<p>[page\\_excerpt size=\\"small\\"]</p>\\r\\n<h2>Welcome to C.G.B.C.S</h2>\\r\\n<p>We invite you join us for the following:</p>\\r\\n<p>Worship on Sundays at 9:00am and 11:00am;</p>\\r\\n<p>Sunday school on Sundays at 10:00am;</p>\\r\\n<p>Bible Study on Wednesdays at 9:00am and 7pm.</p>\\r\\n<p>[button text=\\"Learn more\\" link=\\"#\\"]</p>\\r\\n<p>[/page\\_excerpt]</p>\\r\\n<p>[featured\\_heading]</p>\\r\\n<h2>The Three Parts To <a href=\\"#\\">Our Mission</a> At A Glance:</h2>\\r\\n<p>[/featured\\_heading]</p>\\r\\n<p>[cols\\_3 first=\\"\\"]</p>\\r\\n<h2>Win Souls</h2>\\r\\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vitae purus a diam faucibus pellentesque vitae commodo erat. Pellentesque eget est id leo aliquet auctor. Vestibulum pulvinar mauris at dictum pharetra. Ut vel vulputate risus, at commodo erat.</p>\\r\\n<p><a href=\\"#\\">Read More</a></p>\\r\\n<p>[/cols\\_3]</p>\\r\\n<p>[cols\\_3]</p>\\r\\n<h2>Make Disciples</h2>\\r\\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vitae purus a diam faucibus pellentesque vitae commodo erat. Pellentesque eget est id leo aliquet auctor. Vestibulum pulvinar mauris at dictum pharetra. Ut vel vulputate risus, at commodo erat.</p>\\r\\n<p><a href=\\"#\\">Read More</a></p>\\r\\n<p>[/cols\\_3]</p>\\r\\n<p>[cols\\_3 last=\\"yes\\"]</p>\\r\\n<h2>Change Lives</h2>\\r\\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus vitae purus a diam faucibus pellentesque vitae commodo erat. Pellentesque eget est id leo aliquet auctor. Vestibulum pulvinar mauris at dictum pharetra. Ut vel vulputate risus, at commodo erat.</p>\\r\\n<p><a href=\\"#\\">Read More</a></p>\\r\\n<p>[/cols\\_3]</p>', '', '1', 1, 0, '10', '2015-06-24 23:08:59', '2015-06-26 04:26:11', 0, 'published'),
(2, 0, 'About', 'about', 'about', '', '<p>[page\\_excerpt size=\\"large\\"]</p>\\r\\n<h2>ABOUT US</h2>\\r\\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\\''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book</p>\\r\\n<p>[/page\\_excerpt]</p>\\r\\n<p>[featured\\_heading]</p>\\r\\n<h2><a href=\\"#\\">New Here?</a> Find out what to expect when you visit our church.</h2>\\r\\n<p>[/featured\\_heading]</p>\\r\\n<p>[cols\\_3 first=\\"\\"]</p>\\r\\n<h2>Who We Are</h2>\\r\\n<p><a href=\\"/projects/pagestudio\\_1.1.0/leadership/\\"><strong>Leadership</strong></a><br />Learn about our staff &ndash; our life stories and hopes for The Village.<br /><br /><a href=\\"/projects/pagestudio\\_1.1.0/our-story\\"><strong>Our Story</strong></a><br />Read the story of how God has graciously worked in and through a broken people.<br /><br /><a href=\\"/projects/pagestudio\\_1.1.0/our-beliefs\\"><strong>What We Believe</strong></a><br />Learn about the mission of our church and our four family traits.</p>\\r\\n<p>[/cols\\_3]</p>\\r\\n<p>[cols\\_3]</p>\\r\\n<p><a href=\\"/projects/pagestudio\\_1.1.0/giving/\\"><strong>Giving</strong></a><br />Find out why we give and how to give.<br /><br /><a href=\\"/projects/pagestudio\\_1.1.0/membership/\\"><strong>Membership</strong></a><br />Take the steps to becoming a Covenant Member of The Village.<br /><br /><a href=\\"/projects/pagestudio\\_1.1.0/our-mission/\\"><strong>Our Mission</strong></a><br />Learn about baptism and sign up for Baptism Class.<br /><br /><a href=\\"/projects/pagestudio\\_1.1.0/contact/\\"><strong>Contact Us</strong></a><br />Write, call, visit or contact us online and read frequently asked questions.</p>\\r\\n<p>[/cols\\_3]</p>\\r\\n<p>[cols\\_3 last=\\"yes\\"]</p>\\r\\n<h2>Get Involved</h2>\\r\\n<p><strong>Watch Live</strong><br />Take the steps to becoming a Covenant Member of The Village.<br /><br /><strong>Resources</strong><br />Learn about baptism and sign up for Baptism Class.<br /><br /><a href=\\"/projects/pagestudio\\_1.1.0/calendar/\\"><strong>Upcoming Events</strong></a><br />Write, call, visit or contact us online and read frequently asked questions <br /><a class=\\"read\\" href=\\"/history-of-cedar-grove-baptist-simpsonville\\">view more &rarr;</a></p>\\r\\n<p>[/cols\\_3]</p>\\r\\n<p>&nbsp;More changes</p>', '', '2', 1, 0, '10', '2015-06-24 23:08:59', '2015-06-20 03:20:55', 0, 'published'),
(3, 2, 'Leadership', 'leadership', 'leadership', '', 'This is the leadership page. ', '', '4', 1, 0, '10', '2015-06-24 23:08:59', '2015-06-01 19:02:37', 0, 'published'),
(4, 2, 'Our Story', 'our-story', '', '', '<h2>Historical Account</h2>\r\n<p>The following historical chronicle of the Cedar Grove Baptist Church, Simpsonville, South Carolina, is an attempt to recount the efforts of those who counted it a privilege to sacrifice so that the Word of the Lord might be heard, taught, and lived. Thus, it is with a deep sense of indebtedness and thanksgiving that a special salute is extended to those both -living and dead who have made outstanding and sacrificial contributions to the growth of our spiritual heritage. Thus, the following historical record is offered for the reader&rsquo;s examination, appreciation, and inspiration.</p>\r\n<p>During the Post Civil War period, Blacks in Simpsonville prayed for their own place of worship. Their prayers were answered when Tom Moore, a local white citizen , donated several parcels of land to be used for a place of worship. Clothed in armors of faith and determination, this group of Christian warriors, under the leadership of the Reverend Tom Jones, completed the construction of a brush arbor in July of 1870. Because of the density of cedar trees surrounding the building, the church was named Cedar Grove.</p>\r\n<p>These pioneers were not only imbued with the Holy Spirit, but they also possessed vision, perseverance, and wisdom. Consequently, they recognized the inadequacy of the church&rsquo;s physical facilities and made plans to build a new church in 1876. Constructed of pine and poplar logs, the church was completed during the summer of 1877, just in time for the members to hold their first August revival.</p>\r\n<p>In 1937, a membership exceeding two hundred necessitated the need for still a larger church. Therefore, a frame structure was completed in 1938. The existing building was renovated and bricked in 1962. An educational wing was added in 1972. As a result of additional membership growth, groundbreaking services were held December 8, 1985, for the construction of the present edifice which contains a sanctuary that seats more than three hundred and fifty, offices, educational classrooms, a library, and a baptistery. On Sunday, October 5, 1986, members marched from the old sanctuary to the new sanctuary where the first worship service was held. The new edifice was dedicated Sunday, November 16, 1986. The $332, 000 loan for such was liquidated in 1992.</p>\r\n<p>Since we have a biblical mandate to minister from a holistic perspective, the need for additional space was acknowledged. Consequently, groundbreaking services for a 2.2 million dollar Family Life Center were held on Sunday, June 11, 2000. This much-needed facility contains three offices, four classrooms, a conference room, a gymnasium with a stage, a walking track, a family room, an exercise room, a family room, a weight room, and a commercial kitchen.</p>', '', '3', 1, 0, '10', '2015-06-24 23:08:59', '2015-05-21 01:19:11', 0, 'published'),
(5, 2, 'New Here?', 'new-here', '', '', '<h2>What To Expect</h2>\r\n<p>Knowing what to expect before going somewhere for the first time makes a big difference. Take some time to get to know us. We have highlighted several key areas of information that should help you to see into our services. We&rsquo;re glad you&rsquo;re here and we hope you stay!</p>\r\n<h2>Time &amp; Locations</h2>\r\n<h2>Values and Beliefs</h2>\r\n<h2>Baptism</h2>\r\n<h2>Department Directory</h2>\r\n<h2>Job Opportunities</h2>\r\n<p>We hope this information was helpful to you. If you find that it wasn''t enough or would like to get in touch with us, simply follow this <a href="#">link</a> to our contact page. Again, we are glad that you are here!</p>\r\n<p>Yours truly,</p>\r\n<p>The CGB Staff</p>', '', '6', 0, 0, '10', '2015-06-24 23:08:59', '2015-06-20 02:28:07', 0, 'published'),
(6, 2, 'Our Beliefs', 'our-beliefs', '', '', '<h2>Our beliefs can be summarized as follows:</h2>\r\n<p><strong>The Bible:&nbsp;</strong>We believe the Bible to be the verbally inspired Word of God, inerrant in the original manuscripts and the sufficient and final authority for all matters of faith, practice, and life. (II Timothy 3:16)</p>\r\n<p><strong>God:</strong> We believe God is triune, being three in person and one in essence. The Father, Son, and Spirit are equally God but are three in person. This God is the center of our worship. (Matthew 28:19-20)</p>\r\n<p><strong>The Father:</strong> We believe in the sovereign rule of the Father who assumes headship of all that He created and continues to care and sustain in providence all that exists. (Isaiah 40)<br /><br /><strong>Jesus:</strong> We believe that the eternal Son took on human flesh, being born of a virgin, and that Jesus Christ is truly God and truly man, the only mediator between God and man. (Matthew 1:23-25, I Timothy 2:5, Philippians 2:5-7)<br /><br /><strong>Sin:</strong> We believe that all have sinned and are under the condemnation of death. (Romans 3:23 and 6:23)<br /><br /><strong>Atonement:</strong> We believe that Jesus, according to the will of God the Father, offered Himself as a substitutionary sacrifice and that all who believe in Him have eternal life. On the cross, Jesus defeated evil, sin and death. He shed His blood so that those who repent and believe will have life in Him as their Lord and Savior. (John 3:1, Romans 10:9-10)<br /><br /><strong>Salvation:</strong> We believe that salvation is by grace through faith, and that true faith in the gospel will be made evident by a life of godliness, which is only possible by walking with the Holy Spirit, and by participation with the community of the saints. (Acts 2:42, Ephesians 2:10, Philippians 2:12, Hebrews 10:25)<br /><br /><strong>Resurrection:</strong> We believe in the bodily resurrection of Jesus as the first fruits of our resurrection and His ascension into heaven to the right hand of the Father. We look forward in hope to His second coming in glory. (I Corinthians 15:3-8, II Peter 3)<br /><br /><strong>Ordinances: </strong>We believe that baptism is a faithful response to God&rsquo;s grace, signifying one&rsquo;s identification with Christ and His church and the church&rsquo;s privilege is to commune with the triune God and His people in celebrating the Lord&rsquo;s Supper. (Acts 2:3)<br /><br /><strong>The Church:</strong> We believe that the church is the pillar and foundation of the truth, sharing in God&rsquo;s redemptive mission through proclamation of the gospel by word and deed, resulting in transformed lives committed to God&rsquo;s glory. The church is the community where the people of God share their lives in fellowship with God and each other. (I Timothy 3:15, Matthew 28:19-20)<br /><br /><strong>Eternity:</strong> We believe in a coming Great Day where all people -- the living and the dead -- will stand before God in order to hear His verdict concerning their eternal destiny, either heaven or hell. (Revelation 20:11-15, I Corinthians 3:12-15)</p>', '', '1', 1, 0, '10', '2015-06-24 23:08:59', '2015-06-09 01:46:15', 0, 'published'),
(13, 0, 'Blog', 'blog', 'blog', '', '', '', '7', 1, 0, '10', '2015-06-24 23:08:59', '2015-06-20 17:06:57', 0, 'draft'),
(7, 0, 'Giving', 'giving', 'giving', '', '<p>[page\\_excerpt size="large"]</p>\r\n<h2>Giving Financially</h2>\r\n<p>We have a tremendous opportunity to proclaim the gospel by giving generously. Giving invigorates our devotion to Christ and frees us from the tyranny of consumerism. It provides an outlet for compassion and allows us to proclaim His sufficiency and provision. As people of faith, we give faithfully.</p>\r\n<p>[/page\\_excerpt]</p>\r\n<p>[cols\\_3 first=""]</p>\r\n<p>[featured\\_heading]</p>\r\n<h2>Give Online</h2>\r\n<p><strong>PayPal</strong> <br />Sed sit amet pulvinar orci, at placerat justo. Praesent id quam est. Duis ullamcorper nulla massa, eget mollis nulla condimentum in. Ut id orci tellus.</p>\r\n<p>Pellentesque nec dignissim erat. Vivamus in tristique neque. Praesent in justo ligula.</p>\r\n<p>[button text="Give Now" link="#"]</p>\r\n<p>[/featured\\_heading]</p>\r\n<p>[/cols\\_3]</p>\r\n<p>[cols\\_3]</p>\r\n<h2>More Ways To Give</h2>\r\n<p><strong>Direct Mail<br /></strong>Please do not send cash via US mail. For checks, please make them out to:<br /><br /><strong>Cedar Grove Baptist Church Simpsonville</strong><br />Attention: Finance Department<br /> 206 Moore Street Street, Simpsonville, SC 29680</p>\r\n<p><strong>Asset Donations</strong><br />Duis ullamcorper nulla massa, eget mollis nulla condimentum in. Ut id orci tellus. Pellentesque nec dignissim erat. Vivamus in tristique neque. Praesent in justo ligula.<br /><br /><strong>Have A Question?</strong><br />Contact us online, via phone 864.999.5544, or email us at info@cedargrovesc.org.</p>\r\n<p>[/cols\\_3]</p>\r\n<p>[cols\\_3 last="yes"]</p>\r\n<h2>Thank You</h2>\r\n<p>Your prayers, tithes, and offerings help fulfill the mission of making disciples and planting churches! Christ calls his followers to work and be on mission until He returns &ndash; and you are doing just that. Thank you!</p>\r\n<p>Christ Himself said that it is more blessed to give than to receive (<a href="http://www.esvbible.org/Acts\\%2020\\%3A35/" target="\\_blank">Acts 20:35</a>). So whatever your gift, may Jesus&rsquo; words be true in your life, and may you be blessed by giving toward the work of Jesus. You are loved and appreciated. In Jesus&rsquo; name, thank you!</p>\r\n<p>[/cols\\_3]</p>', 'Some custom page description', '3', 1, 0, '10', '2015-06-24 23:08:59', '2015-06-20 17:07:00', 0, 'draft'),
(9, 0, 'Contact', 'contact', 'contact', '', '<p>[page\\_excerpt size="large"]</p>\r\n<h2>CONTACT US</h2>\r\n<p>Thank you for stopping by! We are happy to hear from you. Please contact us using one of the methods below and we will get back to you as soon as we can.</p>\r\n<p>[/page\\_excerpt]</p>\r\n<p>[map-it title="We are here" address="206 Moore Street Street, Simpsonville, SC 29680" link="https://maps.google.com/maps?oe=utf-8&amp;client=firefox-a&amp;channel=rcs&amp;q=206+Moore+Street,+Simpsonville,+SC+29680&amp;ie=UTF-8&amp;hq=&amp;hnear=0x8858271b124cb44d:0xd11767dcd807df11,206+Moore+St,+Simpsonville,+SC+29681&amp;gl=us&amp;daddr=206+Moore+St,+Simpsonville,+SC+29681&amp;ei=WTz9Ur8BhYLJAcLsgOgG&amp;ved=0CCsQwwUwAA" height="240" width="360" border="framed"]</p>\r\n<p><strong>Cedar Grove Baptist Church Simpsonville</strong></p>\r\n<p>206 Moore Street Street<br />Simpsonville, SC 29680</p>\r\n<p>Phone: 864.963.6935</p>\r\n<p>Fax: 864.963.2391</p>\r\n<p>Email: <a href="#">info@cedargrovesc.org</a></p>', '', '8', 1, 0, '10', '2015-06-24 23:08:59', '2015-05-21 01:19:11', 0, 'published'),
(11, 0, 'Calendar', 'calendar', 'calendar', '', '<p>[page\\_excerpt size="large"]</p>\r\n<h2>Events Calendar</h2>\r\n<p>[/page\\_excerpt]</p>', '', '5', 1, 0, '10', '2015-06-24 23:08:59', '2015-06-20 17:07:04', 0, 'draft'),
(12, 0, 'News', 'news', 'news', '', '<h3>The Latest News From CGBC.</h3>\r\n<p>Stay up to date and get informed on all the latest and future events at Cedar Grove Baptist Church (CGBC) of Simpsonville. Events are sorted in the order of newest to oldest. See our full calendar by going to the calendar page.&nbsp;</p>\r\n<p>&nbsp;</p>', '', '4', 1, 0, '10', '2015-06-24 23:08:59', '2015-06-20 17:07:08', 0, 'draft'),
(14, 2, 'Our Mission', 'our-mission', '', '', '<h2>Creating a welcoming environment</h2>\r\n<p>Some text can go here that focuses on the key points bellow...</p>\r\n<h3><em>The vision of the Church</em></h3>\r\n<p>Make your vision intensely personal and relational. It should be one in which we dwell in the heart of Christ as He dwells in us (Jn. 15:1-15; other key vision passages are Ps. 45, Ps. 110, Rev. 1, Heb. 1, John 1 and Col. 1:15-23). A church which defines its vision in terms of this &ldquo;beatific vision&rdquo; of Christ will have a much greater impact for the Kingdom of God than a church whose vision is defined in terms of buildings, staff, and programs alone.</p>\r\n<h3>The mission of the Church</h3>\r\n<p>There are key passages found in the Bible such as Matthew 28:18-20 and Acts 1:8 that can be used in order to determine a church''s mission. Here is a sample "Our mission is to be witnesses who make disciples, who in turn become loyal and loving subjects of Christ.</p>\r\n<p>&nbsp;</p>', '', '2', 1, 0, '10', '2015-06-24 23:08:59', '2015-06-20 17:07:09', 0, 'draft'),
(16, 0, 'Demo', 'demo', '', '', '<h2>Next Sermon Live In</h2>\r\n<p>&nbsp;[live_sermon_counter size="small"]</p>\r\n<p>[one_half last="yes"]</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur cursus viverra erat vel condimentum. Aliquam erat volutpat. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin convallis lacus in dui laoreet tempor. Curabitur auctor urna sem, ut eleifend justo aliquet eu. Mauris mollis tortor elit, quis pellentesque ligula vulputate sed.</p>\r\n<p>[/one_half]</p>\r\n<p>[page_excerpt size="small"]</p>\r\n<h2 class="alt">Welcome to C.G.B.C.S</h2>\r\n<p>The Cedar Grove Baptist Church is a fellowship of baptized believers in Jesus Christ.</p>\r\n<p>Through the empowerment of the Holy Spirit, we seek to carry out the will and work of God through education, evangelism, fellowship, ministry, stewardship and worship.</p>\r\n<p>We invite you to join us for a worship service on Saturdays at 6:00 PM and Sundays at 9:30 or 11:00 AM.</p>\r\n<p>[button text="Learn more" link="http://cimwebdesigns.com/client_website/cedargrovesc/about-cedar-grove-simpsonville"]</p>\r\n<p>[/page_excerpt]</p>\r\n<p>[picture width="500" height="300"]</p>\r\n<p>&nbsp;</p>\r\n<p>[button text="Save me" size"medium" link="#"]</p>\r\n<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur cursus viverra erat vel condimentum. Aliquam erat volutpat. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin convallis lacus in dui laoreet tempor. Curabitur auctor urna sem, ut eleifend justo aliquet eu. Mauris mollis tortor elit, quis pellentesque ligula vulputate sed. Interdum et malesuada fames ac ante ipsum primis in faucibus. Vestibulum accumsan, mauris in venenatis euismod, nunc eros pretium metus, nec volutpat augue ligula vitae turpis.</p>\r\n<p>[map-it title="Our Location" address="157 Montague Road Greenville, SC" height="300" width="300"]</p>\r\n<p>[media]</p>\r\n<p><img src="/projects/pagestudio_1.1.0/admin../uploads/filemanager_source/Tulips.jpg" alt="Tulips" width="445" height="334" /></p>\r\n<p>[/media]</p>\r\n<p>Phasellus semper, enim ac tincidunt posuere, dolor orci fringilla sem, quis aliquam ante nulla dignissim lectus. Suspendisse lorem libero, mattis vel ultricies nec, rutrum eget dui.</p>\r\n<p>&nbsp;</p>\r\n<p>Pellentesque tempor consequat nisl, ac adipiscing tortor porttitor id. Donec sagittis ultrices urna quis bibendum. Fusce diam ante, fringilla interdum arcu id, venenatis adipiscing ante. Suspendisse mollis rhoncus turpis, a pulvinar elit sollicitudin vel. Praesent gravida justo ut diam condimentum, ac lacinia odio posuere.</p>\r\n<p>&nbsp;</p>\r\n<p>Vivamus fermentum augue eu ante elementum posuere. Mauris ultricies aliquam sagittis. Morbi ut placerat risus, et adipiscing libero. Vivamus varius mattis blandit. Morbi sed dolor at diam posuere placerat. Pellentesque gravida sit amet erat sagittis hendrerit. Donec dapibus eget mauris sed rutrum. Vivamus venenatis quam non quam pulvinar hendrerit.</p>', '', '0', 0, 0, '10', '2015-06-24 23:08:59', '2015-06-20 17:07:11', 0, 'draft'),
(17, 2, 'Membership', 'membership', '', '', '<h2>Membership Class</h2>\r\n<p>We want you to make an informed decision about joining our church. Our class covers what it means to be a Covenant Member and our beliefs and bylaws.</p>\r\n<h3>Baptism at Cedar Grove Baptist Simpsonville</h3>\r\n<p>For many, baptism is the first public step of obedience to Christ. If you have not been baptized following salvation, we ask you to take this step before becoming a Covenant Member. To help prepare you, we offer a <a href="#">Baptism Class</a>. The class covers the biblical significance of baptism, frequently asked questions and gives you an opportunity to share your testimony.</p>\r\n<h3>Required Reading</h3>\r\n<p>We require prospective members to read <a href="#"><em>Church Membership</em></a> by [Author''s name] before signing the Membership Covenant. This book is handed out at Membership Class.</p>\r\n<h3>Signing the Covenant</h3>', '', '5', 1, 0, '10', '2015-06-24 23:08:59', '2015-06-20 17:07:12', 0, 'draft');

-- --------------------------------------------------------

--
-- Table structure for table `cimp_pagesliders`
--

CREATE TABLE IF NOT EXISTS `cimp_pagesliders` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `slider_title` varchar(150) NOT NULL,
  `slider_description` text NOT NULL,
  `slider_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `slider_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `slider_author` int(10) NOT NULL,
  `photo_count` tinyint(10) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cimp_pagesliders`
--

INSERT INTO `cimp_pagesliders` (`id`, `slider_title`, `slider_description`, `slider_date`, `slider_modified`, `slider_author`, `photo_count`) VALUES
(2, 'Home page secondary', 'This is the primary slideshow that appears on the home page. ', '2015-06-25 23:15:14', '2015-07-11 00:04:14', 10, 2);

-- --------------------------------------------------------

--
-- Table structure for table `cimp_pageslider_entries`
--

CREATE TABLE IF NOT EXISTS `cimp_pageslider_entries` (
  `photo_id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `photo_filename` varchar(150) DEFAULT NULL,
  `photo_title` varchar(150) DEFAULT NULL,
  `photo_caption` text,
  `photo_alt` varchar(150) NOT NULL,
  `photo_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `mime_type` varchar(15) NOT NULL,
  `visibility` tinyint(1) NOT NULL DEFAULT '1',
  `slider_id` bigint(20) unsigned NOT NULL DEFAULT '0',
  `sort_id` int(10) NOT NULL,
  PRIMARY KEY (`photo_id`),
  KEY `photo_id` (`photo_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `cimp_pageslider_entries`
--

INSERT INTO `cimp_pageslider_entries` (`photo_id`, `photo_filename`, `photo_title`, `photo_caption`, `photo_alt`, `photo_date`, `mime_type`, `visibility`, `slider_id`, `sort_id`) VALUES
(13, 'public_html/uploads/sliders/lighthouse.jpg', '', '', '', '2015-07-11 00:04:14', 'image/jpeg', 1, 2, 2),
(12, 'public_html/uploads/sliders/19-fast-food-hacks-that-will-change-the-way-you-order.jpg', '', '', '', '2015-07-10 13:25:15', 'image/jpeg', 1, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cimp_posts`
--

CREATE TABLE IF NOT EXISTS `cimp_posts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `post_parent` int(11) NOT NULL DEFAULT '0',
  `post_title` varchar(250) NOT NULL,
  `post_slug` varchar(255) DEFAULT NULL,
  `post_author` varchar(100) NOT NULL,
  `post_content` text NOT NULL,
  `post_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `post_modified` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `post_status` varchar(10) NOT NULL DEFAULT 'published',
  `post_visibility` varchar(10) NOT NULL DEFAULT 'public',
  `post_password` varchar(20) NOT NULL,
  `is_featured` tinyint(1) DEFAULT '0',
  `is_sticky` tinyint(1) NOT NULL DEFAULT '0',
  `post_type` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`),
  KEY `post_parent` (`post_parent`),
  KEY `post_parent_2` (`post_parent`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `cimp_posts`
--

INSERT INTO `cimp_posts` (`id`, `post_parent`, `post_title`, `post_slug`, `post_author`, `post_content`, `post_date`, `post_modified`, `post_status`, `post_visibility`, `post_password`, `is_featured`, `is_sticky`, `post_type`) VALUES
(21, 0, 'Another post title for you to read tomorrow', 'another-post-title-for-you-to-read-tomorrow', '10', '<p>[media]</p>\r\n<p><img src="/projects/pagestudio_1.1.0/admin../uploads/filemanager_source/19-fast-food-hacks-that-will-change-the-way-you-order.jpg" alt="19-fast-food-hacks-that-will-change-the-way-you-order" width="577" height="433" /></p>\r\n<p>[/media]</p>\r\n<p>Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras nec dolor ligula. Praesent iaculis orci sit amet lectus mattis rutrum. Nulla faucibus ultricies mi tincidunt pulvinar. Nulla pretium congue mi vitae consequat. Aliquam dictum sapien nec odio bibendum, et dictum sem posuere. Nulla mi mauris, volutpat id vehicula ac, faucibus sit amet velit. Nullam ut sapien eros. Nulla lacinia nisi a leo pretium, a euismod turpis convallis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Fusce ante ipsum, lobortis vitae neque vel, sagittis tempor turpis. Praesent vitae sapien sapien. Duis ac nisl a lacus iaculis eleifend.</p>\r\n<p>The new home of something here. And some more stuff!</p>', '2014-01-30 02:00:44', '2015-07-04 01:18:11', 'pending', 'password', '', 0, 0, 'post'),
(24, 21, 'my name', NULL, '10', '<p>Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras nec dolor ligula. Praesent iaculis orci sit amet lectus mattis rutrum. Nulla faucibus ultricies mi tincidunt pulvinar. Nulla pretium congue mi vitae consequat. Aliquam dictum sapien nec odio bibendum, et dictum sem posuere. Nulla mi mauris, volutpat id vehicula ac, faucibus sit amet velit. Nullam ut sapien eros. Nulla lacinia nisi a leo pretium, a euismod turpis convallis. Interdum et malesuada fames ac ante ipsum primis in faucibus. Fusce ante ipsum, lobortis vitae neque vel, sagittis tempor turpis. Praesent vitae sapien sapien. Duis ac nisl a lacus iaculis eleifend.</p>', '2014-02-08 02:18:02', '2014-04-30 15:06:19', '0', 'public', '', 0, 0, 'comment'),
(25, 21, 'My opition ', NULL, '10', 'Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras nec dolor ligula. Praesent iaculis orci sit amet lectus mattis rutrum. Nulla faucibus ultricies mi tincidunt pulvinar.', '2014-02-13 18:36:05', '0000-00-00 00:00:00', '1', 'public', '', 0, 0, 'comment'),
(26, 21, 'I do not fully agree with you', NULL, '10', '<p>Interdum et malesuada fames ac ante ipsum primis in faucibus. Cras nec dolor ligula. Praesent iaculis orci sit amet lectus mattis rutrum. Nulla faucibus ultricies mi tincidunt pulvinar.</p>', '2014-02-13 18:36:35', '2014-02-15 16:33:20', '0', 'public', '', 0, 0, 'comment'),
(27, 0, 'New Website Launch', 'new-website-launch', '10', '<p>[media]</p>\r\n<p><img src="/projects/pagestudio_1.1.0/admin../uploads/filemanager_source/cedar-grove-baptist-church-of-simpsonville.JPG" alt="cedar-grove-baptist-church-of-simpsonville" /></p>\r\n<p>[/media]</p>\r\n<p>New year, new beginnings. We are happy to introduce our new website. There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text.</p>\r\n<p><img src="/projects/pagestudio_1.1.0/admin../uploads/filemanager_source/all-devices.png" alt="all-devices" /></p>\r\n<p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always.</p>', '2014-02-13 21:09:45', '2015-07-03 23:29:50', '0', 'public', '', 1, 0, 'post'),
(29, 0, 'News item one', 'news-item-one', '10', '<p>[media]</p>\r\n<p><img src="/projects/pagestudio_1.1.0/admin../uploads/filemanager_source/cedar-grove-baptist-church-of-simpsonville.JPG" alt="cedar-grove-baptist-church-of-simpsonville" width="334" height="373" /></p>\r\n<p>[/media]</p>\r\n<p>New year, new beginnings. We are happy to introduce our new website. There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text.</p>\r\n<p><img class="scale-with-grid" src="/websites/cedargrovesc/admin../uploads/filemanager_source/all-devices.png" alt="all-devices" width="624" height="334" /></p>\r\n<p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always.</p>', '2014-02-22 02:09:45', '2015-07-08 01:11:42', 'published', 'public', '', 0, 0, 'post'),
(30, 0, 'News Item Two', 'news-item-two', '10', '<p>[media]</p>\r\n<p><img src="/projects/pagestudio\\_1.1.0/admin../uploads/filemanager\\_source/cedar-grove-baptist-church-of-simpsonville.JPG" alt="cedar-grove-baptist-church-of-simpsonville" /></p>\r\n<p>[/media]</p>\r\n<p>New year, new beginnings. We are happy to introduce our new website. There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text.</p>\r\n<p><img src="/projects/pagestudio\\_1.1.0/admin../uploads/filemanager\\_source/all-devices.png" alt="all-devices" /></p>\r\n<p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always.</p>', '2014-02-14 02:09:45', '2014-11-13 21:07:05', '0', 'public', '', 1, 0, 'post'),
(31, 0, 'News Item Three', 'news-item-three', '10', '<p>[media]</p>\r\n<p><img class="scale-with-grid" src="/websites/cedargrovesc/admin../uploads/filemanager_source/cedar-grove-baptist-church-of-simpsonville.JPG" alt="cedar-grove-baptist-church-of-simpsonville" width="402" height="450" /></p>\r\n<p>[/media]</p>\r\n<p>New year, new beginnings. We are happy to introduce our new website. There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text.</p>\r\n<p><img class="scale-with-grid" src="/websites/cedargrovesc/admin../uploads/filemanager_source/Tulips.jpg" alt="all-devices" width="672" height="504" /></p>\r\n<p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always.</p>', '2014-02-15 02:09:45', '2015-06-24 23:03:28', '0', 'public', '', 0, 0, 'post'),
(33, 0, 'Another Dummy Post Title', 'another-dummy-post-title', '10', '<p>[media]</p>\r\n<p><img src="/websites/cedargrovesc/admin../uploads/filemanager\\_source/cedar-grove-baptist-church-of-simpsonville.JPG" alt="cedar-grove-baptist-church-of-simpsonville" width="398" height="445" /></p>\r\n<p>[/media]</p>\r\n<p>New year, new beginnings. We are happy to introduce our new website. There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text.</p>\r\n<p><img src="/websites/cedargrovesc/admin../uploads/filemanager\\_source/all-devices.png" alt="all-devices" width="695" height="372" /></p>\r\n<p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always.</p>', '2014-02-15 02:09:45', '2014-09-19 00:15:14', '0', 'public', '', 0, 0, 'post'),
(34, 0, 'A really long name for an article ', 'a-really-long-name-for-an-article', '10', '<p>[media]</p>\r\n<p><img src="/projects/pagestudio\\_1.1.0/admin../uploads/filemanager\\_source/cropped-Depositphotos\\_4596581\\_XXL1.jpg" alt="cropped-Depositphotos\\_4596581\\_XXL1" /></p>\r\n<p>[/media]</p>\r\n<p>New year, new beginnings. We are happy to introduce our new website. There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text.</p>\r\n<p><img class="scale-with-grid" src="/websites/cedargrovesc/admin../uploads/filemanager\\_source/all-devices.png" alt="all-devices" width="624" height="334" /></p>\r\n<p>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always.</p>', '2014-09-13 16:28:43', '2014-10-03 22:55:55', '0', 'public', '', 1, 0, 'post'),
(45, 0, 'Hello world! My First Post', 'hello-world-my-first-post', '10', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed ullamcorper mi nec condimentum mattis. Duis molestie risus purus, aliquam convallis dui venenatis at. Quisque facilisis id purus sit amet euismod. Cras porta pellentesque dolor, non interdum elit consectetur vulputate. Donec mi elit, vestibulum a aliquam nec, laoreet ut leo. Sed commodo, eros id fermentum feugiat, lorem ipsum ullamcorper ex, blandit tempor neque dui sit amet tellus. Vestibulum a metus nec ipsum semper interdum rhoncus non arcu. Sed id augue ac ipsum gravida lacinia condimentum eget leo. Nullam quam quam, scelerisque eu sem vitae, dapibus bibendum tortor. Integer vitae magna a orci suscipit gravida. Integer dignissim, mauris sed mollis ultrices, mauris tellus facilisis urna, sed tempor justo augue id nibh. Nunc scelerisque nec eros sit amet dictum.rnrnNulla finibus sit amet lorem mollis finibus. Cras a fermentum quam. Aliquam erat volutpat. Nullam tempus libero quis gravida sodales. Fusce posuere mollis tincidunt. Curabitur a accumsan augue, eget posuere ante. Aenean varius pulvinar vehicula. Aenean condimentum erat in ullamcorper efficitur. Proin aliquam enim vel bibendum convallis. Duis ac pretium sapien. Suspendisse in purus ut justo imperdiet pharetra id nec turpis. In hac habitasse platea dictumst. Aliquam sagittis tristique tellus ac maximus. Praesent sagittis enim ut ex elementum viverra. Nam lorem justo, gravida eget nulla nec, faucibus tempor orci. ', '2015-05-20 02:05:11', '0000-00-00 00:00:00', '0', 'public', '', 0, 0, 'post');

-- --------------------------------------------------------

--
-- Table structure for table `cimp_users`
--

CREATE TABLE IF NOT EXISTS `cimp_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `email` varchar(100) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `help_tips` int(11) NOT NULL DEFAULT '1',
  `access` tinyint(1) NOT NULL DEFAULT '0',
  `group_id` tinyint(4) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `cimp_users`
--

INSERT INTO `cimp_users` (`id`, `username`, `password`, `email`, `firstname`, `lastname`, `help_tips`, `access`, `group_id`, `date_created`, `last_login`) VALUES
(1, 'systemadmin', '$P$Bn9HP5H01ZBycDkDS.qcLn1O4eTU3h.', 'cosmo@cimwebdesigns.com', 'CIM', 'Administrator', 0, 1, 1, '2013-02-28 05:00:00', '2014-11-26 17:07:42'),
(2, 'johndoe', '$P$BTIIvCVtrmsCaGyiO7FL1asdFCXLIj/', 'cosmo@cimwebdesigns.com', 'Johnathan', 'Doe', 1, 1, 2, '0000-00-00 00:00:00', '2014-08-11 17:10:06'),
(10, 'cosmo', '$P$BfvoSrLuoPu6Ay3gYwxzFH89.gbgz2.', 'cosmo@cimwebdesigns.com', 'Cosmo', 'Mathieu', 0, 1, 1, '2012-09-20 15:13:39', '2014-12-17 19:48:34'),
(16, 'jsullivan', '$P$BE4TPUJj4B/.odoGOi1MQfPrXc9Xzk.', 'jebo0587@aol.com', 'Jared', 'Sullivan', 1, 1, 1, '2014-01-07 07:45:45', '2014-05-15 17:44:12');

-- --------------------------------------------------------

--
-- Table structure for table `cimp_user_groups`
--

CREATE TABLE IF NOT EXISTS `cimp_user_groups` (
  `group_id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(50) NOT NULL,
  `group_type` varchar(15) NOT NULL,
  `group_permissions` text,
  `group_required` tinyint(1) NOT NULL DEFAULT '0',
  `group_modifiable_permissions` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`group_id`),
  KEY `type` (`group_type`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `cimp_user_groups`
--

INSERT INTO `cimp_user_groups` (`group_id`, `group_name`, `group_type`, `group_permissions`, `group_required`, `group_modifiable_permissions`) VALUES
(1, 'Super Admin', 'super_admin', NULL, 1, 0),
(2, 'Administrator', 'administrator', 'a:1:{s:6:"access";a:12:{i:0;s:23:"sitemin/content/entries";i:1;s:19:"sitemin/navigations";i:2;s:17:"sitemin/galleries";i:3;s:13:"sitemin/users";i:4;s:20:"sitemin/users/groups";i:5;s:21:"sitemin/content/types";i:6;s:24:"sitemin/content/snippets";i:7;s:18:"sitemin/categories";i:8;s:29:"sitemin/settings/theme-editor";i:9;s:33:"sitemin/settings/general-settings";i:10;s:28:"sitemin/settings/clear-cache";i:11;s:28:"sitemin/settings/server-info";}}', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `cimp_user_sessions`
--

CREATE TABLE IF NOT EXISTS `cimp_user_sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `hash` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
