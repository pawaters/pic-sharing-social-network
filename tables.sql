-- CREATE TABLE `users` (
--   `id` int(11) NOT NULL AUTO_INCREMENT,
--   `username` varchar(50) NOT NULL,
--   `password` varchar(50) NOT NULL,
--   `email` varchar(50)  NOT NULL,
--   `image` text DEFAULT "1.jpeg",
--   `followers` int(11) DEFAULT 0,
--   `following` int(11) DEFAULT 0,
--   `posts` int(11) DEFAULT 0,
--   PRIMARY KEY (`id`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;







-- CREATE TABLE IF NOT EXISTS `comments` (
--   `id` int(11) NOT NULL AUTO_INCREMENT,
--   `post_id` int(11) NOT NULL,
--   `user_id` int(11) NOT NULL,
--   `username` varchar(50) NOT NULL,
--   `profile_image` text  NOT NULL,
--   `comment_text` text  NOT NULL,
--   `date` DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP,
--   PRIMARY KEY (`id`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




-- CREATE TABLE IF NOT EXISTS `followings` (
--   `id` int(11) NOT NULL AUTO_INCREMENT,
--   `user_id` int(11) NOT NULL,
--   `other_user_id` int(11) NOT NULL,
--     PRIMARY KEY (`id`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




-- CREATE TABLE IF NOT EXISTS `posts` (
--   `id` int(11) NOT NULL AUTO_INCREMENT,
--   `user_id` int(11) NOT NULL,
--   `likes` int(11) NOT NULL,
--   `image` text  NOT NULL,
--   `caption` varchar(250) NOT NULL,
--   `hashtags` varchar(250) NOT NULL,
--   `date` DATETIME  NOT NULL DEFAULT CURRENT_TIMESTAMP,
--   `username` varchar(50)  NOT NULL,
--   `profile_image` text NOT NULL,
--   PRIMARY KEY (`id`) 
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;








-- CREATE TABLE IF NOT EXISTS `likes` (
--   `id` int(11) NOT NULL AUTO_INCREMENT,
--   `user_id` int(11) NOT NULL,
--   `post_id` int(11) NOT NULL,
--   PRIMARY KEY (`id`)
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;







