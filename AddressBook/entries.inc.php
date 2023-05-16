<?
$entries = isset($startswith) ? 
				$address_book->search_by_first_letter($startswith) : 
			(isset($search) ?
				$address_book->search_entries($search) :
				$address_book->get_all_entries()
			);
if (count($entries) == 0) {
	if (isset($startswith)) { ?>
		<div>Pas de noms de famille commençant par <?=$startswith?></div> <?
	} else if (isset($search)) { ?>
		<div>Pas d'entrée contenant <?=$search?></div> <?
	}
} else {
?>
	<span class="info">nombre de resultats: <?=count($entries)?></span>
	<div class="container2">
<?
	$nbcols=4;
	$i=0;
	foreach($entries as $entry) {
		if ($i%$nbcols==0) echo '<div class="grid">';
?>
		<div class='name ingrid<?=$i+1?>'><a href="index.php?id=<?=$entry['id']?>"><?=$entry['lastname']?>, <?=$entry['firstname']?></a></div>
<?
		if ($i%$nbcols==$nbcols-1) echo '</div>';
		$i++;
	}
}
?>
</div>

