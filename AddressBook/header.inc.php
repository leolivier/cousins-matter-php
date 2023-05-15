<?
$title="Le Bottin Mondain des Petits Carreaux";
$mainpath="../";
if (!isset($basedir)) $basedir="";
require_once ($basedir."../header.inc.php");
require_once ($basedir."AddressBook.class.php");
function die_alert($msg) { die("<script>alert('$msg');</script>"); }
function hprint_r($obj) { echo("<pre>");print_r($obj);echo("</pre>"); }
function alert($msg) { echo("<script>alert('$msg');</script>"); }

?>
<nav class="adressbook_navbar">
<div class="container grid">
	<div class="menu"><a href="<?=$basedir?>index.php">Tout voir</a></div>
	<div class="menu"><a href="<?=$basedir?>index.php?new=true">Ajouter une fiche</a></div>
	<div class="menu"><a href="<?=$basedir?>birthday.php">Anniversaires</a></div>
	<div class="menu"><a href="<?=$basedir?>print.php" target='_blank'>Imprimer le bottin...</a></div>
</div>
<hr/>
</nav>
