<?php 

require_once 'DB.php';

class User{

	public $id;
	public $name;
	public $surname;
	public $birthday;
	public $gender;
	public $cityOfBirth;

	private $db;

	public function __construct($data = null, $id = null)
	{

		$this->db = new DB();
		if($id != null && $data == null)
			$data = $this->db->getUser($id);

		if(!$this->ValidateString($data['name'])){
			die("Name must contain only letters");
		}
		
		if(!$this->ValidateString($data['surname']))
			die("Surname must contain only letters");

		if(!$this->ValidateString($data['cityOfBirth']))
			die("City must contain only letters");

		if(!$this->ValidateDate($data['birthday']))
			die("The date is not in the correct format, please enter the date in the following format: year-month-day");

		if(!in_array($data['gender'], array('1', '0')))
			die("The date is not in the correct format, please enter the date in the following format: year-month-day");

		$this->id = $id;
		$this->name = $data['name'];
		$this->surname = $data['surname'];
		$this->birthday = $data['birthday'];
		$this->gender = $data['gender'];
		$this->cityOfBirth = $data['cityOfBirth'];
	}

	public function Save(){
		$this->id = $this->db->addUser($this);
	}

	public function Delete($id = null){
		if($id != null){
			$this->db->deleteUser($id);
			return;
		}
		$this->db->deleteUser($this->id);
	}

	public function Update($name, $surname, $birthday, $gender, $cityOfBirth){
		return $this->db->updateUser([
			'id' => $this->id,
			'name' => $name, 
			'surname' => $surname, 
			'birthday' => $birthday, 
			'gender' => $gender, 
			'cityOfBirth' => $cityOfBirth
		]);
	}

	public static function BirthdayToAge($birthday){
		$diff = date('Ymd') - date('Ymd', strtotime($birthday));
		return substr($diff, 0, -4);
	}

	public static function GenderToString($gender){
		return ($gender == '1') ? "Мужской" : "Женский";
	}

	private function ValidateString($string){
		return preg_match("/^([a-z]|[а-я])*$/iu", $string);
	}

	private function ValidateDate($date)
	{
	    $d = DateTime::createFromFormat('Y-m-d', $date);
	    return $d && $d->format('Y-m-d') == $date;
	}

	public function print(){
		echo "<pre>Id: " . $this->id . "\n";
		echo "Name: " . $this->name . "\n";
		echo "Surame: " . $this->surname . "\n";
		echo "Age: " . User::BirthdayToAge($this->birthday) . "\n";
		echo "gender: " . User::GenderToString($this->gender) . "\n";
		echo "City Of Birth: " . $this->cityOfBirth . "\n</pre>";
	}
}



?>