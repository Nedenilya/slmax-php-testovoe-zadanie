<?php 

require_once 'DB.php';

class User{


	public $id;
	public $name;
	public $surname;
	public $birthday;
	public $sex;
	public $cityOfBirth;

	private $db = new DB();

	public function __construct($id = null, $name, $surname, $birthday, $sex, $cityOfBirth)
	{
		if($id != null)
			$db->getUser($id);
		$this->name = $name;
		$this->surname = $surname;
		$this->birthday = $birthday;
		$this->sex = $sex;
		$this->cityOfBirth = $cityOfBirth;
	}

	public function Save($data){

	}

	public function Delete($id){

	}

	public function Update($data){

	}

	public static function BirthdayToAge($birthday){

	}

	public static function SexToString($sex){
		return ($sex == 1) ? "Муж" : "Жен";
	}

}



?>