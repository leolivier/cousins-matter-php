<?
if (isset($id)) {
	$links = $address_book->get_entry_by_id($id);
	$id = $links['id'];
	$links['address']=str_replace("\n", "<br>", $links['address']);
	$links['address']=str_replace("\r", "", $links['address']);
    $map_address=str_replace("<br>", ",", $links['address']);
	$birthdayf = $address_book->format_date($links['birthday']);
?>
<div class="book_entry">
	<div class="name"><?=$links['firstname']?> <?=$links['lastname']?></div>
	<hr/>
	<div class="entry_container">
		<label for="birthday">Anniversaire:</label>
		<div class="birthday"><?=$birthdayf?></div>
	</div>
	<div class="entry_container">
		<label for="adress">Adresse:</label>
		<div class="address" name="address"><?=$links['address']?></div>
	</div>
	<div class="phones_container">
		<label for="phone">Téléphone:</label>
		<div class="entry_container">
			<label for="home_phone">Domicile: </label>
			<div class="phone"><?=$links['telephone']['home']?></div>
		</div>
		<div class="entry_container">
			<label for="mobile_phone">Portable: </label>
			<div class="phone"><?=$links['telephone']['mobile']?></div>
		</div>
		<div class="entry_container">
			<label for="work_phone">Travail: </label>
			<div class="phone"><?=$links['telephone']['work']?></div>
		</div>
	</div>
	<div class="mails_container">
		<label for="email">Courriels:</label>
		<div class="entry_container">
			<label for="email">1er Courriel:</label>
			<div class="email"><a href="mailto:<?=$links['email'][0]?>"><?=$links['email'][0]?></a></div>
		</div>
		<div class="entry_container">
			<label for="email">2nd Courriel:</label>
			<div class="email"><a href="mailto:<?=$links['email'][1]?>"><?=$links['email'][1]?></a></div>
		</div>
	</div>
	<label for="others">Autres:</label>
	<div class="entry_container">
		<label for="website">Site web:</label>
		<div class="website"><a href="<?=$links['website']?>"><?=$links['website']?></a></div>
	</div>
</div>
<hr/>
<div class="grid">
    <div class="menu"><a id="modal-edit-close" onclick="togglePopupEdit(true);">Modifier cette fiche</a></div>
    <div class="menu"><a href="index.php?delete=true&id=<?=$id?>"
                         onClick="return confirm('Etes vous sur(e) de vouloir supprimer cette fiche?')">Supprimer cette fiche</a></div>
    <div class="menu"><a id="modal-view-close" onclick="document.getElementById('modal_view').style.display = 'none';">Fermer cette fiche</a></div>
</div>
<?}
/*
		<tr>
			<td colspan="2">
				et en cadeau, une carte pour se rendre à l'adresse indiquée...<br/>
				NB: si l'adresse contient des choses un peu bizarres, il est possible que ça ne fonctionne pas bien...<br/>
				Dans ce cas, modifier l'adresse dans le champ ci dessous et cliquez dans Go...<br/>
				<form action="#" onsubmit="load_map(this.address.value); return false">
					<p>
						<input type="text" size="60" name="address" value="<?=$map_address?>" />
						<input type="submit" value="Go!" />
					</p>
				</form>
				Vous pouvez également afficher un itinéraire entre l'adresse et cette seconde adresse (probablement la votre)<br/>
				<form action="#" onsubmit="showRoute(this.fromAddress.value); return false">
					<p>
						<input type="text" size="60" name="fromAddress" />
						<input type="submit" value="Go!" />
					</p>
				</form>
				Et pour les geeks à TomTom, cliquez sur ce bouton <a id="tomtom" href="#" target="_blank">
				<img style="vertical-align: middle;"
					src="http://addto.tomtom.com/api/images/addtotomtom-button.gif"
					alt="Ajouter cette adresse à mon TomTom" border="0"/>
				</a> pour ajouter l'adresse automatiquement à votre GPS!
			</td>
		</tr>
	</table>
		</td>
		<td width='50%'>
			<div id="map" style="width: 600px; height: 600px"></div>
			<div id="route" style="width: 600px;"></div>
		</td>
	</tr>
</table>
<br/><br/>
<script type="text/javascript">var map_address="<?=$map_address?>";</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCi31xwOWANmsEEsZwaHvItEjEKm60o9Tk&callback=load_map" async defer></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.0/js/all.js"></script>
<script src="map.js"></script>
*/
?>
