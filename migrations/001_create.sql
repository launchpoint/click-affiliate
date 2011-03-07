CREATE TABLE IF NOT EXISTS `visitors` (
  `id` int(11) NOT NULL auto_increment,
  `visitor_thread_id` int(11) NOT NULL,
  `ip` int(11) NOT NULL,
  `visiting_user_id` int(11) default NULL,
  `affiliate_user_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `visitor_thread_id` (`visitor_thread_id`,`ip`,`visiting_user_id`,`affiliate_user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `visitor_threads` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) NOT NULL,
  `object_type` varchar(50) NOT NULL,
  `object_id` int(11) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `name` (`name`,`object_type`,`object_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
