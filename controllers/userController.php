<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$action = isset($_POST['action'])?$_POST['action']:'';
if(!$action){
	$action = isset($_GET['action'])?$_GET['action']:'';
}

if($action == 'create'){
	$action = false;
	$db = createDb();
	$sth = $db->prepare("INSERT INTO users (code, name, facebook, whatsapp, email) VALUES (:code, :name, :facebook, :whatsapp, :email)");
	$code = codeGenerate();
	$sth->bindValue(':code', $code);
	$sth->bindValue(':name', $_POST['name']);
	$sth->bindValue(':facebook', $_POST['facebook']);
	$sth->bindValue(':whatsapp', $_POST['whatsapp']);
	$sth->bindValue(':email', $_POST['email']);
	$sth->execute();
	echo $code;
}

if($action == "recoveredCode"){
	$action = false;
	$email = $_POST['email'];
	$db = createDb();
	$sth = $db->prepare("SELECT code FROM users WHERE email = :email");
	$sth->bindValue(':email', $email);
	$sth->execute();
	$recoveredCode = $sth->fetch(PDO::FETCH_ASSOC)['code'];
	echo $recoveredCode;
}

if($action == 'searchCode'){
	$code = $_POST['code'];
	$db = createDb();
	$sth = $db->prepare("SELECT * FROM users WHERE code = :code");
	$sth->bindValue(':code', $code);
	$sth->execute();
	$userWanted = $sth->fetch(PDO::FETCH_ASSOC);
	header('content-type: application/json');
	echo json_encode($userWanted);
}

function createDb(){
	return new PDO('mysql:host=reepet_mysql_1;dbname=reepet', 'root', 'server897');
}

function getRandomCode(){
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $randstring = '';
  for ($i = 0; $i < 7; $i++) {
    $randstring .= $characters[rand(0, strlen($characters))];
  }
  return $randstring;
}

function codeGenerate(){
	$db = createDb();
  $code = '';
  do{
  	$code = getRandomCode();
  	$sth = $db->prepare("SELECT id FROM users WHERE code = :code");
  	$sth->bindValue(':code', $code);
  	$sth->execute();
  	$codeIsDefined = $sth->rowCount();
  } while ($codeIsDefined);
  return $code;
}
