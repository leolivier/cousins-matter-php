<?
require_once ('AddressBookDAO.class.php');

abstract class AddressBookDB {
    // protected properties
    protected const TABLE = 'addressbook';
    protected $db;

    public static function createDB(): static {
        global $configs;
        if (isset($configs->db->filename) && file_exists($configs->db->filename)) {
            require_once ('AddressBookDB.sqlite3.class.php');
            return new Sqlite3AddressBookDB();
        } else {
            require_once ('AddressBookDB.mysqli.class.php');
            return new MySqliAddressBookDB();
        }
    }

    // returns birthdays in the next ndays as an array of assoc arrays
    // each row contains id, firstname, lastname,
    // birthday date, age, #days (between today and birthday)
    abstract public function get_next_birthdays($ndays);

    // return an entry by its id
    abstract function get_entry_by_id($id);

    // delete an entry  by its id and returns the deleted entry
    abstract function delete_entry($id);

    // returns a table containing all entries
    abstract function get_all_entries();

    // create an entry, returns its id
    abstract function create_entry($entry);

    // update an entry
    abstract function update_entry($id, $entry);

    // search for entries
    abstract function search_entries($search);

    // search by lastname first letter
    abstract function search_by_first_letter($letter);
    
	// returns all emails as a json list
	abstract function get_emails();
}
?>
