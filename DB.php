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
		$query = "SELECT * FROM users where id = " . $id;
	    $query = mysqli_query($this->connection, $query);

	    if($data = mysqli_fetch_array($query)){
	    	//echo $data['name'];
	        return new User(['name' => $data['name'], 
	        				  'surname' => $data['surname'], 
	        				  'birthday' => $data['birthday'], 
	        				  'sex' => $data['sex'], 
	        				  'cityOfBirth' => $data['city_of_birth']], $id);
	    }else{
	    	die("This user does not exist");
	    }
	}

	function addUser(User $user){
		$sql = 'INSERT INTO users SET 	name = \'' . $user->name . '\',
									  	surname = \'' . $user->surname . '\',
									  	birthday = \'' . $user->birthday . '\',
									  	sex = \'' . $user->sex . '\',
									  	city_of_birth = \'' . $user->cityOfBirth . '\'';

		if(mysqli_query($this->connection, $sql)){
			$user_id = mysqli_insert_id($this->connection);
			// $this->connection->close();
			return $user_id;
		}else{
			// $this->connection->close();
			return false;
		}
	}

	function updateUser($data){
		//echo $data['id'];
		$sql = 'UPDATE users SET 	name = \'' . $data['name'] . '\',
								  	surname = \'' . $data['surname'] . '\',
								  	birthday = \'' . $data['birthday'] . '\',
								  	sex = \'' . $data['sex'] . '\',
								  	city_of_birth = \'' . $data['cityOfBirth'] . '\'
								  	WHERE id = ' . $data['id'];
		if(mysqli_query($this->connection, $sql)){
			// $this->connection->close();
			return $this->getUser($data['id']);
		}else{
			// $this->connection->close();
			return false;
		}
	}

	function deleteUser($id){
		$sql = 'DELETE users WHERE id = ' . $id;

		if(mysqli_query($this->connection, $sql)){
			// $this->connection->close();
			return true;
		}else{
			// $this->connection->close();
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