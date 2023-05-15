<?
//nombre de jours de prévision  
$n = 50; 
$tab = $address_book->get_next_birthdays($n);
?>

<h1>Anniversaires</h1>
<h2>Anniversaires dans les <?=$n?> prochains jours:</h2>
<hr/>
<div class="container">
<? foreach($tab as $ligne) {
    switch (true){ 
      case ($ligne['#days'] == 0): $class='today'; $when="<b>aujourd'hui</b>";break;
      case ($ligne['#days'] == 1): $class='tomorrow';$when='<b>demain</b>';; break;
      case ($ligne['#days'] <= 14): $class="soon"; $when='dans <b>'.$ligne['#days'].'</b> jours';break;
      default: $class='later'; $when='dans <b>'.$ligne['#days'].'</b> jours';
    } 
?>
  <div class="grid">
    <div class='name ingrid1'><a href='<?=$basedir."view.php?id=".$ligne['id']?>'><?=$ligne['firstname']." ".$ligne['lastname']?></a></div>
    <div class='age ingrid2'>aura <b><?=$ligne['age']?></b> ans </div>
    <div class='<?=$class?> ingrid3'><?=$when?></div>
    <div class='birthday ingrid4'>(né(e) le <?=AddressBook::format_date($ligne['birthday'])?>)</div>
  </div>
<?}?>
</div>
