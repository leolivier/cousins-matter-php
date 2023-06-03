<?
require_once ('AddressBookDAO.class.php');
require_once ('AddressBookDB.class.php');

class MysqliAddressBookDB extends AddressBookDB {
    // constructor
    function __construct() {
		global $configs;
		$dbc=$configs->db;
    	$this->db = new mysqli($dbc->server, $dbc->user, $dbc->password, $dbc->name) or die($dbc);
    }

    // returns birthdays in the next ndays in the format of a mysqli_result
    // each row contains id, firstname, lastname,
    // birthday date, age, #days (between today and birthday)
    function get_next_birthdays($ndays) {
        $query="SELECT * FROM
            (SELECT id, firstname,  lastname, birthday,
                    (YEAR(CURRENT_DATE)-YEAR(birthday)) - (RIGHT(CURRENT_DATE,5)<=RIGHT(LEFT(birthday, 10),5)) +1 AS age,
                    TO_DAYS(CONCAT(LEFT(CURRENT_DATE,5), RIGHT(LEFT(birthday, 10), 5))) - TO_DAYS(CURRENT_DATE) AS diff,
                    DATE_FORMAT(CONCAT(YEAR(CURRENT_DATE),'-12-31'), '%j') AS nbj
                    FROM ".self::TABLE.") AS birthday
            WHERE (birthday.diff >= 0 AND birthday.diff < $ndays) OR (birthday.diff < 0 AND birthday.diff + birthday.nbj < $ndays)";
        $result = $this->db->query($query) or die($this->db->error);
        $i=0;
        $tab = array();
        while($row = $result->fetch_array()){
            if($row['diff']<0) $row['diff'] = $row['diff'] + $row['nbj'];
            $tab[$i][0] = $row['diff'];# added fro sorting on #days
            $tab[$i]['firstname'] = $row['firstname'];
            $tab[$i]['lastname'] = $row['lastname'];
            $tab[$i]['age'] = $row['age'];
            $tab[$i]['#days'] = $row['diff'];
            $tab[$i]['birthday'] = DateTime::createFromFormat("Y-m-d H:i:s", $row['birthday']);
            $tab[$i]['id'] = $row['id'];
            $i++;
        }
        return $tab;
    }

    // return an entry by its id
    function get_entry_by_id($id){
        $stmt = $this->db->prepare("SELECT * FROM ".self::TABLE." WHERE id=?");
        $stmt->bind_param("i", $id);
        $stmt->execute() or die($this->db->error);
        $result = $stmt->get_result();
        if ($result->num_rows>0) return AddressBookDAO::fromRow($result->fetch_array());
        die("cet identifiant n'existe pas: $id");
    }

    // delete an entry  by its id and returns the deleted entry
    function delete_entry($id){
        $entry = $this->get_entry_by_id($id);
        $stmt = $this->db->prepare("DELETE FROM ".self::TABLE." WHERE id=?");
        $stmt->bind_param("i", $id);
        $result = $stmt->execute() or die($this->db->error);
        return $entry;
    }

    //transform sql result to list of entries
    private static function rows_to_entries($result) {
   		$entries = array();
        while($row = $result->fetch_array()) { array_push($entries, AddressBookDAO::fromRow($row)); }
        // hprint_r($entries);
        return $entries;
	}

    // returns a table containing all entries
    function get_all_entries(){
        $result = $this->db->query("SELECT * FROM ".self::TABLE." ORDER BY lastname, firstname");
        return MysqliAddressBookDB::rows_to_entries($result);
    }

    // create an entry, returns its id
    function create_entry($entry){
        $row = $entry->toRow();
        $stmt = $this->db->prepare("INSERT INTO ".self::TABLE." (firstname, lastname, address, home, mobile, work, email, email2, birthday, website) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssss",
            $row['firstname'], $row['lastname'], $row['address'],
            $row['home'], $row['mobile'], $row['work'],
            $row['email'], $row['email2'], $row['birthday'], $row['website']);
        $stmt->execute() || die ("erreur d'insertion dans la base:\n".$this->db->error."\nmerci de contacter l'administrateur");
        return $this->db->insert_id;
    }

    // update an entry
    function update_entry($id, $entry){
        $row = $entry->toRow();
        $stmt = $this->db->prepare("UPDATE ".self::TABLE." SET firstname=?,lastname=?,address=?,home=?,mobile=?,work=?,email=?,email2=?,birthday=?,website=? WHERE id=?");
        $stmt->bind_param("ssssssssssi",
            $row['firstname'], $row['lastname'], $row['address'],
            $row['home'], $row['mobile'], $row['work'],
            $row['email'], $row['email2'], $row['birthday'], $row['website'], $id);
        $stmt->execute() || die ("erreur de mise à jour dans la base:\n".$this->db->error."\nmerci de contacter l'administrateur");
    }
    // search for entries
    function search_entries($search) {
        $query="SELECT * FROM ".self::TABLE." WHERE 
                    firstname LIKE ?
                OR  lastname  LIKE ? 
                OR  email     LIKE ?
                OR  email2    LIKE ?
                OR  address   LIKE ? 
                ORDER BY lastname, firstname ASC";
        $stmt=$this->db->prepare($query);
        $search='%'.$search.'%';
        $stmt->bind_param("sssss", $search, $search, $search, $search, $search);
        $stmt->execute() or die($this->db->error);
        $result = $stmt->get_result();
//        echo("<pre>query=$query <br/>"); print_r($result);echo('</pre>');
        return MysqliAddressBookDB::rows_to_entries($result);
    }
    // search by lastname first letter
    function search_by_first_letter($letter) {
    	$query = "SELECT * FROM ".self::TABLE." WHERE UPPER(LEFT(lastname,1)) = ? ORDER BY lastname, firstname";
     	$stmt = $this->db->prepare($query);
     	$stmt->bind_param("s", $letter);
     	$stmt->execute();
     	$result = $stmt->get_result();
        return MysqliAddressBookDB::rows_to_entries($result);
	}
	// returns all emails
	function get_emails() {
		$query = "SELECT email, email2 FROM addressbook";
		$result = $this->db->query($query);
		$emails = array();
		while ($line = $result->fetch_array()) {
    	    $emails[$line["email"]] = 1;
    	    $emails[$line["email2"]] = 1;
		}
		$emails[''] = 0;
		$emails = array_keys($emails, 1);
		$json = implode("\n", $emails);
		echo ($json);
		return $json;
	}
}
?>