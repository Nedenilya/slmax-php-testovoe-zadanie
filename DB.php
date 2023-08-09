<?php

class DB
{

	private $connection;
	
	public function __construct(){
		$this->connect();
	}

	function connect(){
		$this->connection = new mysqli("", "", "", "slmax");
		if($this->connection->connect_error)
		    die("Error: Something went wrong, please try again later"); //For users
			//die("Error: " . $this->connection->connect_error);        //For debug
	}

	function getUser($id){
		$query = "SELECT * FROM users where id = " . $id;
	    $query = mysqli_query($this->connection, $query);

	    if($data = mysqli_fetch_array($query)){
	        return ['name' => $data['name'], 
				    'surname' => $data['surname'], 
				    'birthday' => $data['birthday'], 
				    'gender' => $data['gender'], 
				    'cityOfBirth' => $data['city_of_birth']];
	    }else{
	    	die("This user does not exist");
	    }
	}

	function addUser(User $user){
		$sql = 'INSERT INTO users SET 	name = \'' . $user->name . '\',
									  	surname = \'' . $user->surname . '\',
									  	birthday = \'' . $user->birthday . '\',
									  	gender = \'' . $user->gender . '\',
									  	city_of_birth = \'' . $user->cityOfBirth . '\'';

		if(mysqli_query($this->connection, $sql)){
			$user_id = mysqli_insert_id($this->connection);
			return $user_id;
		}else{
			return false;
		}
	}

	function updateUser($data){
		//echo $data['id'];
		$sql = 'UPDATE users SET 	name = \'' . $data['name'] . '\',
								  	surname = \'' . $data['surname'] . '\',
								  	birthday = \'' . $data['birthday'] . '\',
								  	gender = \'' . $data['gender'] . '\',
								  	city_of_birth = \'' . $data['cityOfBirth'] . '\'
								  	WHERE id = ' . $data['id'];
		if(mysqli_query($this->connection, $sql)){
			return new User(id: $data['id']);
		}else{
			return false;
		}
	}

	function deleteUser($id){
		$sql = 'DELETE FROM users WHERE id = ' . $id;

		if(mysqli_query($this->connection, $sql)){
			return true;
		}else{
			return false;
		}
	}

	function getUsersIds($condition = '', $value = ''){
		if($condition == '' && $value == '')
			$query = "SELECT id FROM users";
		else
			$query = "SELECT id FROM users WHERE " . $condition . " '" . $value . "'";

	    $query = mysqli_query($this->connection, $query);

	    $user_ids = [];
	    while ($row = mysqli_fetch_assoc($query)){
	        $user_ids[] = $row;
	    }
	    return $user_ids;
	}

}
?>