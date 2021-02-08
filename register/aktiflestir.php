<?php
require 'Medoo.php';
 
use Medoo\Medoo;
 
$database = new Medoo([
	// required
	'database_type' => 'mysql',
	'database_name' => 'register',
	'server' => 'localhost',
	'username' => 'root',
	'password' => '123456789',
 
	// [optional]
	'charset' => 'utf8mb4',
	'collation' => 'utf8mb4_general_ci',
	'port' => 3306
]);



$mail = $_GET['mail'];
$code = $_GET['kod'];



if(isset($mail) && isset($code)){
	
	$kullanici = $database->get("400432_tbl_kayitlar", "id", ["email" => $mail, "kod" => $code, "durum" => '0']);
	
	if ($kullanici) {
		
		$userUpdate = $database->update("400432_tbl_kayitlar", [
			"durum" => '1'
		], [
			"id[=]" => $kullanici
		]);
		
		if ($userUpdate) {
			header('Location: panel.php');
		} else {
			header('Location: index.php');
		}
	} else {
		header('Location: index.php');
	}
	
} else {
	header('Location: index.php');
}
