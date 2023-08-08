<?php 

require_once 'DB.php';

class User{

	public $id;
	public $name;
	public $surname;
	public $birthday;
	public $sex;
	public $cityOfBirth;

	private $db;

	public function __construct($data = null, $id = null)
	{

		$this->db = new DB();
		if($id != null && $data == null)
			return $this->db->getUser($id);

		echo "idddd; ".$id;
		echo $data['name'];

		$this->id = $id;
		$this->name = $data['name'];
		$this->surname = $data['surname'];
		$this->birthday = $data['birthday'];
		$this->sex = $data['sex'];
		$this->cityOfBirth = $data['cityOfBirth'];
	}

	public function Save(){
		$this->id = $this->db->addUser($this);
	}

	public function Delete(){
		$this->db->deleteUser($this->id);
	}

	public function Update($name, $surname, $birthday, $sex, $cityOfBirth){
		return $this->db->updateUser([
			'id' => $this->id,
			'name' => $name, 
			'surname' => $surname, 
			'birthday' => $birthday, 
			'sex' => $sex, 
			'cityOfBirth' => $cityOfBirth
		]);
	}

	public static function BirthdayToAge($birthday){
		$diff = date('Ymd') - date('Ymd', strtotime($birthday));
		return substr($diff, 0, -4);
	}

	public static function SexToString($sex){
		return ($sex == '1') ? "Муж" : "Жен";
	}

	public function print(){
		echo "Id: " . $this->id . "\n";
		echo "Name: " . $this->name . "\n";
		echo "Surame: " . $this->surname . "\n";
		echo "Age: " . User::BirthdayToAge($this->birthday) . "\n";
		echo "Sex: " . User::SexToString($this->sex) . "\n";
		echo "City Of Birth: " . $this->cityOfBirth . "\n";
	}

}



?>