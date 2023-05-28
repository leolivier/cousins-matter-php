<?
require_once ("AddressBookDB.class.php");
require_once ("AddressBookDAO.class.php");

class AddressBook {
    // the db class
    var $db;
    // constructor
    function __construct() {
        $this->db = AddressBookDB::createDB();
    }

    static function format_date($date, $no_year=false){
        static $formatter;
        if (!isset($formatter))
            $formatter = IntlDateFormatter::create(
                'fr_FR',
                IntlDateFormatter::FULL,
                IntlDateFormatter::NONE,
                'Europe/Paris',
                IntlDateFormatter::GREGORIAN
            );
        $fdate = $formatter->format($date);
        if ($no_year) return substr($fdate, 0, -4);
        else return $fdate;
    }

    // returns birthdays in the next ndays in the format of a table of assoc
    // each row contains id, firstname, lastname, birthday date,
    // age, diff (in days between today and birthday)
    function get_next_birthdays($ndays){
        $tab = $this->db->get_next_birthdays($ndays);
        // sort on $tab[][0] => #days to next birthday
        sort($tab);
        return $tab;
    }

    function get_entry_by_id($id){
        return $this->db->get_entry_by_id($id);
    }


    function delete_entry($id){
    	$deleted = $this->db->delete_entry($id);
    	AddressBook::updateMailingList (NULL, $deleted->email);
    }

    function get_all_entries(){ return $this->db->get_all_entries(); }

    function create_entry($entry){
    	AddressBook::updateMailingList ($entry->email);
    	return $this->db->create_entry($entry);
    }

    function update_entry($id, $entry){
    	$id or die_alert("update an unknown id");
        $current = $this->get_entry_by_id($id);
    	AddressBook::updateMailingList ($entry->email, $current->email);
    	$this->db->update_entry($id, $entry);
    }

    function search_entries($search){
        return $this->db->search_entries($search);
    }

	function search_by_first_letter($letter) {
		return $this->db->search_by_first_letter($letter);
	}
	function get_emails() { return $this->db->get_emails(); }

	// update a freelist (freelists.org) mailing list or with same admin mode (ecartis, horde...)
	private static function updateMailingList ($newAddress, $oldAddress=NULL) {
		global $configs;
		if ($configs->mailing_list->onoff != 'on') return;
		isset($configs->mailing_list->name) or die('Mailing list name not set!');
		$mailing_list = $configs->mailing_list->name;
		isset($configs->mailing_list->admin_request_address) or die('Mailing list admin request address not set!');
		$mailto = $configs->mailing_list->admin_request_address;
		isset($configs->mailing_list->admin_email) or die('Mailing list admin email address not set!');
		$mailfrom = $configs->mailing_list->admin_email;
		$subject="Automatic subscription to $mailing_list";
		$message="// job\r\n";
		$message.="admin2 $mailing_list\r\n";
        $newarray = array();
        $oldarray = array();
        switch(true){
            case (is_array($newAddress) and is_array(($oldAddress))):
                $newarray=array_diff($newAddress, $oldAddress);
                $oldarray=array_diff($oldAddress, $newAddress);
                break;
            case (is_array($newAddress) and is_string($oldAddress)):
                if (in_array($oldAddress, $newAddress)) $newarray = array_diff($newAddress, ...[$oldAddress]);
                else{
                    $newarray = $newAddress;
                    array_push($oldarray, $oldAddress);
                }
                break;
            case (is_array($oldAddress) and is_string($newAddress)):
                if (in_array($newAddress, $oldAddress)) $oldarray = array_diff($oldAddress, ...[$newAddress]);
                else{
                    $oldarray = $oldAddress;
                    array_push($newarray, $newAddress);
                }
                break;
            default: 
                if ($newAddress!=$oldAddress) {
                    if ($newAddress) array_push($newarray, $newAddress);
                    if ($oldAddress) array_push($oldarray, $oldAddress);
                }
        }
        if (count($newarray) === 0 && count($oldarray) === 0) return;
        foreach($newarray as $address) $message.="subscribe $address\r\n";
        foreach($oldarray as $address) $message.="unsubscribe $address\r\n";
        $message.="adminend2\r\n";
		$message.="// eoj\r\n";
		$headers = "From: $mailfrom\r\n";
		$headers.= "Reply-To: $mailfrom\r\n";
		$headers.= 'X-Mailer: PHP/' . phpversion();
		mail($mailto, $subject, $message, $headers);
	}
}

global $address_book;
if (!isset($address_book)) $address_book = new AddressBook();

?>
