<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

$action = isset($_POST['action'])?$_POST['action']:'';
if(!$action){
	$action = isset($_GET['action'])?$_GET['action']:'';
}

if($action == 'create'){
	$action = false;
	$name = $_POST['name'];
	$email = $_POST['email'];
	$facebook = $_POST['facebook'];
	$whatsapp = $_POST['whatsapp'];
	$db = createDb();
	$sth = $db->prepare("SELECT code FROM users WHERE email = :email");
	$sth->execute([':email'=>$email]);
	$response = [];
	if($sth->rowCount()) {
		$response = [
			'existent' => true,
			'code' => ($sth->fetch(PDO::FETCH_ASSOC)['code'])
		];
	} else {
		$sth = $db->prepare("INSERT INTO users (code, name, facebook, whatsapp, email) VALUES (:code, :name, :facebook, :whatsapp, :email)");
		$code = codeGenerate();
		$sth->bindValue(':code', $code);
		$sth->bindValue(':name', $name);
		$sth->bindValue(':facebook', $facebook);
		$sth->bindValue(':whatsapp', $whatsapp);
		$sth->bindValue(':email', $email);
		$sth->execute();
		sendEmail("email@gmail.com", "Name", "Reepet | Novo cadastro!", "
			<p>Um novo úsuario acabou de se cadastrar no Reepet:</p>
			<b>Nome:</b> $name <br>
			<b>Facebook:</b> $facebook <br>
			<b>Whatsapp:</b> $whatsapp <br>
			<b>Email:</b> $email <br>
			<b>Código:</b> $code
		");
		$response = [
			'existent' => false,
			'code' => $code
		];
	}
	header('content-type: application/json');
	echo json_encode($response);
}

if($action == "forgetedCode"){
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
	return new PDO('mysql:host=reepet_mysql_1;dbname=reepet', 'root', 'root');
}

function getRandomCode(){
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $randstring = false;
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

function sendEmail($destiny, $name, $assunto, $message) {
	return 0;
	require_once('../phpmail/PHPMailerAutoload.php');

	$mail = new PHPMailer();
	$mail->IsHTML(true);
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->Port = 587;
	$mail->Mailer = "smtp";
	$mail->Host = "smtp.gmail.com";
	$mail->Username = "email@gmail.com";
	$mail->Password = "senha";
	$mail->From = "email@gmail.com";
	$mail->FromName = "Name";
	$mail->CharSet = "UTF-8";
	$mail->SetFrom('email@gmail.com', 'Name');
	$mail->addAddress('email@gmail.com', 'Name');

	$mail->AddAddress($destiny, $name);
	$mail->Subject = $assunto;

	$mail->MsgHTML($message);

	if (!$mail->Send()) {
		return 0;
	} else {
		return 1;
	}
}
