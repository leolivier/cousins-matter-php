<?
$title="Le Bottin Mondain des Petits Carreaux";
$mainpath="../";
if (!isset($basedir)) $basedir="";
require_once ($basedir."../header.inc.php");
require_once ($basedir."AddressBook.class.php");
?>
<nav class="addressbook_navbar">
<div class="container">
	<div class="menu"><a href="<?=$basedir?>index.php">Tout voir</a></div>
	<div class="menu"><a href="<?=$basedir?>index.php?new=true">Ajouter une fiche</a></div>
	<div class="menu"><a href="<?=$basedir?>index.php?birthday=true">Anniversaires</a></div>
	<div class="menu"><a href="<?=$basedir?>print.php" target='_blank'>Imprimer le bottin...</a></div>
</div>
<hr/>
</nav>
<nav class="addressbook_searchbar">
    <div class="searchbar">
        <div class="startswith">
        <?for ($letter='A'; $letter!='AA'; $letter++) { ?>
            <span class="letter"><a href="<?= $_SERVER['PHP_SELF'].'?startswith='.$letter ?>" ><?=$letter?></a></span>
        <?}?>
        </div>
        <div class="search">
            <form class=searchform" action="<?=$_SERVER['PHP_SELF']?>">
                <input type="search" name="search" class="search-query" placeholder="Rechercher" accesskey="s" dir="auto">
                <input type="submit" name="searchact" value="Rechercher"/><!--todo replace with magnifying glass button -->
            </form>
        </div>
    </div>
    <hr/>
</nav>

