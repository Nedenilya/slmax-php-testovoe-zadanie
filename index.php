<?php 

require_once "User.php";
// require_once "UserHandler.php";

// $user = new User(['name' => "ilya", 
// 				  'surname' => "neden", 
// 				  'birthday' => "2002-05-27", 
// 				  'sex' => '1', 
				  // 'cityOfBirth' => "Minsk"]);
// $user->Save();
// $user->print();
// $user = $user->Update("Ilya", "test", "2001-05-27", '0', "Stolbci");

// $user->Delete();
$user1 = new User(id: 34);
echo "User Surname: " . $user1->surname;
$user1->print();

// $user2 = new User(0);



// $handler = new UserHandler();

?>