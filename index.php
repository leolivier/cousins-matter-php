<?
$title="Les Petits Carreaux";
$mainpath="./";
require_once ("header.inc.php");
?>
<p>Le site des Petits Carreaux est le site web de la famille Clément originaire du Molay Littry
(Calvados)...</p>
<p>Sur ce site destiné à la famille, vous trouverez des photos, un forum de
discussion, des infos utiles comme les adresses de tout le monde, un arbre
généalogique, quelques petits trésors...</p>
<p>Lisez la foire aux questions pour les questions relatives au fonctionnement
du site. Si ça n'y répond pas, envoyez moi un mail (Olivier)</p>
<p><b>Ce site ne vivra que si vous y apportez du contenu! </b></p>
<p>Voici déjà tous les anniversaires des prochains jours!</p>

<?
$basedir="AddressBook/";
include ($basedir."header.inc.php");
include ($basedir."birthday.inc.php");
include ("footer.inc.php");
?>
