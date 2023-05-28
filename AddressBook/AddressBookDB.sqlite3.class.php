<?
require_once ('AddressBookDAO.class.php');
require_once ('AddressBookDB.class.php');

class Sqlite3AddressBookDB extends AddressBookDB {
   	private static $fields = ['firstname', 'lastname', 'address', 'home', 'mobile', 'work', 'email', 'email2', 'birthday', 'website'];

    // constructor
    function __construct() {
		global $configs;
		$dbc=$configs->db;
    	$this->db = new SQLite3($dbc->filename, SQLITE3_OPEN_READWRITE) or die($dbc);
    }

	private function db_error() { return 'DB Error #'.$this->db->lastErrorCode().': '.$this->db->lastErrorMsg(); }

    function get_next_birthdays($ndays) {
        $query="SELECT * FROM
            (SELECT id, firstname,  lastname, birthday,
                    (STRFTIME('%Y', DATE('now'))-STRFTIME('%Y', birthday)) - (STRFTIME('%j', DATE('now'))<=STRFTIME('%j', birthday)) +1 AS age,
                    STRFTIME('%j', birthday) - STRFTIME('%j', DATE('now')) AS diff,
                    STRFTIME(DATE('now', 'start of year', '+1 year', '-1 day'), '%j') AS nbj
                    FROM ".self::TABLE.") AS birthday
            WHERE (birthday.diff >= 0 AND birthday.diff < $ndays) OR (birthday.diff < 0 AND birthday.diff + birthday.nbj < $ndays)";
        $result = $this->db->query($query) or die($this->db_error());
        $i=0;
        $tab = array();
        while($row = $result->fetchArray()){
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
        $stmt = $this->db->prepare("SELECT * FROM ".self::TABLE." WHERE id=:id");
        $stmt->bindParam(":id", $id, SQLITE3_INTEGER);
        $result = $stmt->execute();
        if (!$result) die($this->db_error());
        if ($result->numColumns() && $result->columnType(0) != SQLITE3_NULL) return AddressBookDAO::fromRow($result->fetchArray());
        die("cet identifiant n'existe pas: $id");
    }

    // delete an entry  by its id and returns the deleted entry
    function delete_entry($id){
        $entry = $this->get_entry_by_id($id);
        $stmt = $this->db->prepare("DELETE FROM ".self::TABLE." WHERE id=:id");
        $stmt->bindParam(":id", $id, SQLITE3_INTEGER);
        $result = $stmt->execute();
        if (!$result) die($this->db_error());
        return $entry;
    }

    //transform sql result to list of entries
    private static function rows_to_entries($result) {
   		$entries = array();
        while($row = $result->fetchArray()) { array_push($entries, AddressBookDAO::fromRow($row)); }
        // hprint_r($entries);
        return $entries;
	}

    // returns a table containing all entries
    function get_all_entries(){
        $result = $this->db->query("SELECT * FROM ".self::TABLE." ORDER BY lastname, firstname");
        return Sqlite3AddressBookDB::rows_to_entries($result);
    }

    // create an entry, returns its id
    function create_entry($entry){
        $row = $entry->toRow();
        $q1 = "INSERT INTO ".self::TABLE." (";
        $q2 = ' VALUES (';
        foreach (Sqlite3AddressBookDB::$fields as &$field) { $q1 .= $field.', '; $q2 .= ':'.$field.', '; }
        $q1 = substr($q1, 0, -2).')'; $q2 = substr($q2, 0, -2).')';
        $stmt = $this->db->prepare($q1.$q2);
        foreach (Sqlite3AddressBookDB::$fields as &$field) { $stmt->bindParam(':'.$field, $row[$field]); }

        $stmt->execute() || die ("erreur d'insertion dans la base:\n".$this->db_error()."\nmerci de contacter l'administrateur");
        return $this->db->lastInsertRowID();
    }

    // update an entry
    function update_entry($id, $entry){
        $row = $entry->toRow();
        $q = "UPDATE ".self::TABLE." SET ";
        foreach (Sqlite3AddressBookDB::$fields as &$field) { $q .= $field.'=:'.$field.', '; }
        $q = substr($q, 0, -2).' WHERE id=:id';
        $stmt = $this->db->prepare($q);
        foreach (Sqlite3AddressBookDB::$fields as &$field) { $stmt->bindParam(':'.$field, $row[$field]); }
        $stmt->bindParam(":id", $id, SQLITE3_INTEGER);
        $stmt->execute() || die ("erreur de mise à jour dans la base:\n".$this->db_error()."\nmerci de contacter l'administrateur");
    }
    // search for entries
    function search_entries($search) {
        $query="SELECT * FROM ".self::TABLE." WHERE 
                    firstname LIKE :search
                OR  lastname  LIKE :search
                OR  email     LIKE :search
                OR  email2    LIKE :search
                OR  address   LIKE :search
                ORDER BY lastname, firstname ASC";
        $stmt=$this->db->prepare($query);
        $search='%'.$search.'%';
        $stmt->bindParam(':search', $search);
        $result = $stmt->execute();
        if (!$result) die($this->db_error());
//        echo("<pre>query=$query <br/>"); print_r($result);echo('</pre>');
        return Sqlite3AddressBookDB::rows_to_entries($result);
    }
    // search by lastname first letter
    function search_by_first_letter($letter) {
    	$query = "SELECT * FROM ".self::TABLE." WHERE UPPER(SUBSTR(lastname,1,1)) = :letter ORDER BY lastname, firstname";
     	$stmt = $this->db->prepare($query);
     	$stmt->bindParam(":letter", $letter);
     	$result = $stmt->execute();
        return Sqlite3AddressBookDB::rows_to_entries($result);
	}
	// returns all emails
	function get_emails() {
		$query = "SELECT email, email2 FROM addressbook";
		$result = $this->db->query($query);
		$emails = array();
		while ($line = $result->fetchArray()) {
    	    $emails[$line["email"]] = 1;
    	    $emails[$line["email2"]] = 1;
		}
		$emails[''] = 0;
		$emails = array_keys($emails, 1);
		$json = implode("\n", $emails);
		hprint_r ($json);
		return $json;
	}
}
?>
