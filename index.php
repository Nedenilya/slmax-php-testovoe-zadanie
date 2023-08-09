<?php 

require_once "User.php";
require_once "UserHandler.php";


/* пример работы с классом User.php */
$user = new User(['name' => "Илья", 
				  'surname' => "Neden", 
				  'birthday' => "2002-05-27", 
				  'gender' => '1', 
				  'cityOfBirth' => "Minskity"]);	//Создание нового пользователя 

$user->Save();	//сохранение пользователя в БД
$user->print(); //вывод полей пользователя
$user = $user->Update("RiptIlya", "test", "2001-05-27", '0', "Minskit"); //обновление полей пользователя

$user->Delete(48);//удаление пользователя

$user1 = new User(id: 40); //получение существующего пользователя по ID
$user1->print(); //вывод полей полученного пользователя


/* пример работы с классом UserHandler.php  */

$handler = new UserHandler();
$handler->getUsersById(); //Получение массива экземпляров класса User из массива с id пользователей полученного в конструкторе

$handler->printUsersIds(); //вывод полученных ID пользователей
$handler->printUsers(); //вывод пользователей в соответствии с полученными ID

$handler->DeleteUser($handler->user_id[1]['id']);	//Удаление первого пользователя в БД

$handler->printUsersIds(); //вывод полученных ID пользователей
$handler->printUsers(); //вывод пользователей в соответствии с полученными ID

?>