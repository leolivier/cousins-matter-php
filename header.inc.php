<!DOCTYPE html>
<html>
  <head>
    <title><?= $title ?></title>
    <link rel="stylesheet" href="<?=$mainpath?>cousinsmatter.css" type="text/css" media="screen">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  </head>

  <body>
<?
  global $configs;
  $configs = include ($mainpath."config.php");
  include ($mainpath."menu.inc.php"); 
// il doit y avoir un moyen d'avoir ça sans écrire ce code
    foreach($_GET as $param=>$value){
      global $$param;
      $$param=$value;
//      echo("<pre>G $param=$value</pre>");
    }
    foreach($_POST as $param=>$value){
      global $$param;
      $$param=$value;
//      echo("<pre>P $param=$value</pre>");
    }
  ?>
  <div class="banner"><?=$title?></div>
  <div class="content">
