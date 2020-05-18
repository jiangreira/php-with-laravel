-- for detail
CREATE TABLE `detail` (
  `iddetail` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Period` int(6) NOT NULL,
  `B_ADSL` int(20) DEFAULT '0',
  `B_Cable_Modem` int(20) DEFAULT '0',
  `B_FTTX` int(20) DEFAULT '0',
  `B_Leased_Line` int(20) DEFAULT '0',
  `WB_PWLAN` int(20) DEFAULT '0',
  `WB_3GDate` int(20) DEFAULT '0',
  `WB_4GDate` int(20) DEFAULT '0',
  `M_3GDataCard` int(20) DEFAULT '0',
  `M_3GPhone` int(20) DEFAULT '0',
  `M_4GDataCard` int(20) DEFAULT '0',
  `M_4GPhone` int(20) DEFAULT '0',
  `created_at` date DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `detailcol` datetime DEFAULT NULL,
  `detailcol1` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`iddetail`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci
-- for laravel login
CREATE TABLE `members2` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
-- for normal login
CREATE TABLE `smmembers` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci