<?
global $entry;

if (isset($submit)){ // create or update
	$entry = new AddressBookDAO($firstname, $lastname, $address,
    	$home, $mobile, $work, $email, $email2, $birthday, $website);
	if(isset($id)){  // update
		$address_book->update_entry($id, $entry);
	} else { // create
alert('creation');
		$id=$address_book->create_entry($entry);
	}
}
if (isset($delete)) {
	$address_book->delete_entry($id);
	alert("Fiche supprimée");
	unset($id);
}
if (isset($id)) $entry = $address_book->get_entry_by_id($id);
else $entry = new AddressBookDAO();
?>

<form method="post" action="<?=$_SERVER['PHP_SELF']?>">
	<? if(isset($id)){?>  <input type="hidden" name="id" value="<?=$id?>"> <?}?>
	<div class="entry_field">
		<div class="entry_field">
			<label for="firstname">Prénom:</label>
	        <input type="text" name="firstname" size="30" value="<?=$entry->firstname?>">
		</div>
		<div class="entry_field">
			<label for="lastname">Nom:</label>
	        <input type="text" name="lastname" size="30" value="<?=$entry->lastname?>">
		</div>
	</div>
	<hr/>
	<div class="entry_field">
		<label for="birthday">Anniversaire:</label>
		<input type="date" name="birthday" value="<?=$entry->birthday->format('Y-m-d')?>"/>
	</div>
	<div class="entry_field">
		<label for="address">Adresse:</label>
        <textarea name="address" rows="3" cols="30"><?=$entry->address?></textarea>
	</div>
	<div class="phones_container">
		<label for="phone">Téléphones:</label>
			<div class="entry_field">
				<label for="home">Domicile:</label>
		        <input type="tel" name="home" value="<?=$entry->telephone->home?>">
			</div>
			<div class="entry_field">
				<label for="mobile">Portable:</label>
		        <input type="tel" name="mobile" value="<?=$entry->telephone->mobile?>">
			</div>
			<div class="entry_field">
				<label for="work">Travail:</label>
		        <input type="tel" name="work" value="<?=$entry->telephone->work?>">
			</div>
	</div>
	<div class="mails_container">
		<label for="emails">Courriels:</label>
		<div class="entry_field">
			<label for="email1">1er courriel:</label>
	        <input type="email" name="email" size="35" value="<?=$entry->email[0]?>">
		</div>
		<div class="entry_field">
			<label for="email2">2nd courriel:</label>
	        <input type="email" name="email2" size="35" value="<?=$entry->email[1]?>">
		</div>
	</div>
	<label for="other">Autres:</label>
	<div class="entry_field">
		<label for="website">Site web:</label>
        <input type="url" name="website" size="35" value="<?=$entry->website?>">
	</div>
	<hr/>
    <div class="modal_bar">
        <div class="menu"><input type="Submit" name="submit" value="Enregistrer"/></div>
        <div class="menu"><a id="modal-close" onclick=<?=isset($new)?'closeAllPopups()':'togglePopupEdit(false)'?>>Abandonner</a></div>
    </div>
</form>
