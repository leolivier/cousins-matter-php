<?php
$login_admin="admin";
$pass_admin=getenv("MYSQL_ROOT_PASSWORD");

if ($login_admin==$PHP_AUTH_USER AND $pass_admin==$PHP_AUTH_PW) {
  header( 'WWW-Authenticate: Basic realm="Accés sécurisé"' );
  header( 'HTTP/1.0 401 Unauthorized' );
  echo 'Accés refusé';
  exit;
}
?>
