<?
// number of birthday forecasting days
$nbdays = 50;
$birthdays = $address_book->get_next_birthdays($nbdays);
?>

<h2>Anniversaires des <?=$nbdays?> prochains jours</h2>
<hr/>
<div class="alternate-colors">
<? 
foreach($birthdays as $line) {
    switch (true){
      case ($line['#days'] == 0): $class='today'; $when="<b>aujourd'hui</b>";break;
      case ($line['#days'] == 1): $class='tomorrow';$when='<b>demain</b>';; break;
      case ($line['#days'] <= 14): $class="soon"; $when='dans <b>'.$line['#days'].'</b> jours';break;
      default: $class='later'; $when='dans <b>'.$line['#days'].'</b> jours';
    }
?>
  <div class="grid">
    <div class='name'><a href='<?=$_SERVER["PHP_SELF"]."?id=".$line['id']?>'><?=$line['firstname']." ".strtoupper($line['lastname'])?></a></div>
    <div class='age'>aura <b><?=$line['age']?></b> ans </div>
    <div class='<?=$class?>'><?=$when?></div>
    <div class='birthday'>(né(e) le <?=AddressBook::format_date($line['birthday'])?>)</div>
  </div>
<?}?>
</div>
