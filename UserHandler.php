<?php 
if (!class_exists('User'))
	die('Class User does not exists!');

require_once 'DB.php';
require_once 'User.php';

class UserHandler{


	public $user_id;
	public $users;

	private $db;
	private $condition;
	private $condition_value;

	public function __construct($condition = '', $condition_value = '')
	{
		$this->db = new DB();
		$this->user_id = $this->db->getUsersIds($condition, $condition_value);

		$this->condition = $condition;
		$this->condition_value = $condition_value;
	}

	public function getUsersById(){
		$this->users = array();

		if(empty($this->user_id))
			die("No users");

		foreach ($this->user_id as $value) {
			$this->users[$value['id']] = new User(id: $value['id']);
		}
	}

	public function DeleteUser($id){
		if($id)
			$this->users[$id]->Delete();

		$this->user_id = $this->db->getUsersIds($this->condition, $this->condition_value);
		$this->getUsersById();
		echo "User №{$id} was deleted";
	}

	public function printUsersIds(){
		echo "<pre>Users ID`s: </pre>";
		foreach ($this->user_id as $id) {
			echo 'Id: ' . $id['id'] . '; ';
		}
	}
	public function printUsers(){
		echo "<pre>Users: </pre>";
		foreach ($this->users as $user) {
			$user->print();
		}
	}
}
?>