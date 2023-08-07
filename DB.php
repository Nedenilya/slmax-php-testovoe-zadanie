<?php

class DB
{

	private $connection;
	
	public function __construct(){
		$this->connect();
	}

	function connect(){
		$this->connection = new mysqli("localhost", "root", "", "slmax");
		if($this->connection->connect_error)
		    die("Error: Something went wrong, please try again later"); //For users
			//die("Error: " . $this->connection->connect_error);        //For debug
	}

	function getUser($id){

	}

	function addUser(User $user){
		$sql = 'INSERT INTO users SET 	name = \'' . $user->name . '\',
									  	surname = \'' . $user->surname . '\',
									  	birthday = \'' . $user->birthday . '\',
									  	sex = \'' . $user->sex . '\',
									  	city_of_birth = \'' . $user->cityOfBirth . '\'';

		if(mysqli_query($this->connection, $sql)){
			$user_id = mysqli_insert_id($this->connection);
			$this->connection->close();

			return $user_id;
		}else{
			$this->connection->close();
			return false;
		}
	}

	function updateUser(User $user){
		$sql = 'UPDATE users SET 	name = \'' . $user->name . '\',
								  	surname = \'' . $user->surname . '\',
								  	birthday = \'' . $user->birthday . '\',
								  	sex = \'' . $user->sex . '\',
								  	cityOfBirth = \'' . $user->cityOfBirth . '\'
								  	WHERE id = ' . $user->id;

		if(mysqli_query($this->connection, $sql)){
			$this->connection->close();
			return $user;
		}else{
			$this->connection->close();
			return false;
		}
	}

	function deleteUser($id){
		$sql = 'DELETE users WHERE id = ' . $id;

		if(mysqli_query($this->connection, $sql)){
			$this->connection->close();
			return true;
		}else{
			$this->connection->close();
			return false;
		}
	}

	function isMail($mail){
		return filter_var($mail, FILTER_VALIDATE_EMAIL);
	}

	function isPhone($phone){
		return preg_match('/^(\+[1-9][0-9]*[0-9]*)?[0]?[1-9][0-9]*$/', $phone);
	}

}
?>