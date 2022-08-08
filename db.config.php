<?php
$db['default'] = array(
	'dsn'	=> '',
	'hostname' => 'localhost',
	'username' => '用户名',
	'password' => '密码',
	'database' => '数据库名',
	'dbdriver' => 'mysqli',
	'dbprefix' => 'img_',
	'pconnect' => FALSE,
	'db_debug' => (ENVIRONMENT !== 'production'),
	'cache_on' => FALSE,
	'cachedir' => '',
	'char_set' => 'utf8',
	'dbcollat' => 'utf8_general_ci',
	'swap_pre' => '',
	'encrypt' => FALSE,
	'compress' => FALSE,
	'stricton' => FALSE,
	'failover' => array(),
	'save_queries' => TRUE
);