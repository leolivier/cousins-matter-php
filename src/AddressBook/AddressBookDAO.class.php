<?
class AddressBookDAO {
    // properties
   	public $id;
    public string $firstname;
    public string $lastname;
    public string $address;
	public $telephone;
	public $email;
	public DateTime $birthday;
 	public string $website;

    // constructor
    function __construct($id = NULL, string $firstname = '', string $lastname = '', string $address = '',
    	string $home_tel = '', string $mobile_tel = '', string $work_tel = '',
    	string $email = '', string $email2 = '', string $birthday =  NULL, string $website = '') {
        $this->id = $id;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->address = $address;
        $this->telephone = new class ($home_tel, $mobile_tel, $work_tel) {
        	public string $home, $mobile, $work;
        	function __construct($home_tel, $mobile_tel, $work_tel) {
        		$this->home = $home_tel;
        		$this->work = $work_tel;
        		$this->mobile = $mobile_tel;
        	}
        };
        $this->email = array($email, $email2);
        $this->birthday = $birthday ? DateTime::createFromFormat("Y-m-d", substr($birthday, 0, 10)) : new DateTime('now');
        $this->website = $website;
    }

    // transforms an internal table row into an entry
    static function fromRow ($row): static {
        return new static ($row['id'], $row['firstname'], $row['lastname'], $row['address'],
	        $row['home'], $row['mobile'], $row['work'], $row['email'], $row['email2'], $row['birthday'], $row['website']);
    }

    // transforms an entry into a internal table row
    function toRow(){
        return array(
            'firstname' => $this->firstname, 'lastname' => $this->lastname, 'address' => $this->address,
            'home' => $this->telephone->home, 'mobile' => $this->telephone->mobile, 'work' => $this->telephone->work,
            'email' => $this->email[0], 'email2' => $this->email[1], 'website' => $this->website,
            'birthday' => $this->birthday->format("Y-m-d"));
    }
}
?>
