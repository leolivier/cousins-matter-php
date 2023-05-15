<div class="modal" id="modal_edit">
  <div class="modal-back"></div>
  <div class="modal-container">
	<?include('edit.inc.php');?>
  </div>
</div>
<div class="modal" id="modal_view">
  <div class="modal-back"></div>
  <div class="modal-container">
	<?include('view.inc.php');?>
  </div>
</div>
<script>
	// toggle popups
	function togglePopupEdit(edit) {
		if (edit) {
			document.getElementById('modal_view').style.display = 'none';
			document.getElementById('modal_edit').style.display = 'block';
		} else {
			document.getElementById('modal_edit').style.display = 'none';
			document.getElementById('modal_view').style.display = 'block';
		}
	}
	// toggle popups
	function closeAllPopups() {
		document.getElementById('modal_view').style.display = 'none';
		document.getElementById('modal_edit').style.display = 'none';
	}
<?if (isset($new)) {?> 
	togglePopupEdit(true); // force show edit popup for new entry 
<?} else if (!isset($id)) {?>
	closeAllPopups();
<?}?>
</script>

