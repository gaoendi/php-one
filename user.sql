CREATE TABLE `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `username` varchar(20) DEFAULT NULL COMMENT '用户名称',
  `password` char(32) DEFAULT NULL COMMENT '用户密码',
  `last_session_id` char(32) DEFAULT NULL COMMENT '最后登录记录的session_id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8