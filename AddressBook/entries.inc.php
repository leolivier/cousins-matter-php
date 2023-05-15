<?
$link = $_SERVER['PHP_SELF'];
$nbcols=4;
$i=0;
$entries = isset($startswith) ? 
				$address_book->search_by_first_letter($startswith) : 
			(isset($search) ?
				$address_book->search_entries($search) :
				$address_book->get_all_entries()
			);
?>
<nav class="addressbook_searchbar">
	<div class="searchbar">
		<div class="startswith">
		<?for ($letter='A'; $letter!='AA'; $letter++) { ?>
			<span class="letter"><a href="<?= $link.'?startswith='.$letter ?>" ><?=$letter?></a></span>
		<?}?>
		</div>
		<div class="search">
			<form class=searchform" action="<?=$link?>">
				<input type="search" name="search" class="search-query" placeholder="Rechercher" accesskey="s" dir="auto">
				<input type="submit" name="searchact" value="Rechercher"/><!--todo replace with magnifying glass button -->
			</form>
		</div>
	</div>
	<hr/>
</nav>
<span class="info">nombre de resultats: <?=count($entries)?></span>

<div class="container2">
<?
     foreach($entries as $entry) {
        if ($i%4==0) echo '<div class="grid">';
?>
     <!--div class='name ingrid<?=$i+1?>'><a href="view.php?id=<?=$entry['id']?>"><?=$entry['lastname']?>, <?=$entry['firstname']?></a></div-->
     <div class='name ingrid<?=$i+1?>'><a href="index.php?id=<?=$entry['id']?>"><?=$entry['lastname']?>, <?=$entry['firstname']?></a></div>
<?
        if ($i%4==3) echo '</div>';
        $i++;
     }
?>
  </div>

<?if (count($entries) == 0) 
	if (isset($startswith)) { ?> <div>Pas de noms de famille commençant par <?=$startswith?></div> 
<?	} else if (isset($search)){ ?>  <div>Pas d'entrée contenant <?=$search?></div> 

<?  } 
 else {
	$i=0;
?>

<div class="container2">
<?
	foreach($entries as $entry) {
		if ($i%4==0) echo '<div class="grid">';
?>
	<div class='name ingrid<?=$i+1?>'><a href="view.php?id=<?=$entry['id']?>"><?=$entry['lastname']?>, <?=$entry['firstname']?></a></div> 
<?
		if ($i%4==3) echo '</div>'; 
		$i++;
	}
}
?>
</div>

