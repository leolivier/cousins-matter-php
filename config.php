<?php

return (object) array(
  'admin' => (object) array(
  	'full_name' => getenv("ADMIN_FULL_NAME"),
  	'user' => getenv("ADMIN_USER"),
  	'password' => getenv('ADMIN_PASSWORD'),
  	'email' => getenv('ADMIN_EMAIL'),
  ),
  'db' => (object) array(
	'name'     => getenv("MYSQL_DATABASE"),
  	'server'   => getenv("MYSQL_SERVER"),
  	'user'     => getenv("MYSQL_USER"),
  	'password' => getenv("MYSQL_PASSWORD"),
  	'filename' => getenv("SQLITE3_DB_FILENAME"),
  ),
  'mailing_list' => (object) array(
	'onoff' => 'off',
	'name' => getenv("MAILING_LIST"),
	'admin_request_address' => "ecartis@freelists.org",
	'admin_email' => getenv('ADMIN_EMAIL'),
  ),
);
?>
