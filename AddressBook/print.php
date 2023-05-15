<?
global $configs;
$configs = include ("../config.php"); 

include ('../Cezpdf/Cezpdf.php');
include ('AddressBook.class.php');
$entries = $address_book->get_all_entries();

// Initialize a ROS PDF class object using DIN-A4, with background color gray
$pdf = new Cezpdf('a4','portrait','color',[1,1,1]);
// Set pdf Bleedbox
$pdf->ezSetMargins(20,20,20,20);
$pdf->selectFont('Helvetica');
// Define the font size
$size=12;
// Modified to use the local file if it can
$pdf->openHere('Fit');


$pdf->ezText('Le Bottin Mondain des Petits Carreaux', 14);
$pdf->ezText('', $size);

$data=array();
$cols = ['name' => 'Nom', 'address' => 'Adresse', 'phone' => 'Téléphone', 'mail' => 'Mail'];
$coloptions = ['name' => ['justification' => 'left', 'width' => 100], 'address' => ['width' => 200], 'phone'=>['width'=>120]];

foreach ($entries as $entry) {
	array_push($data, array(
		'name'=>$entry['lastname']." ".$entry['firstname']."\n(".$entry["birthday"]->format("d/m/Y").")",
		'address'=>$entry["address"], 
		'phone'=>'Dom: '.$entry["telephone"]["home"]."\nPort: ".$entry["telephone"]["mobile"]."\nTrav: ".$entry["telephone"]["work"],
		'mail'=>$entry["email"][0]."\n".$entry["email"][1]));
}

$pdf->ezTable($data,$cols,"",array('xPos'=>'left','xOrientation'=>'right','width'=>550, 'cols' => $coloptions, 'shadeHeadingCol' => [0.6, 0.6, 0.5]));
$pdf->ezStream();
exit;
?>
