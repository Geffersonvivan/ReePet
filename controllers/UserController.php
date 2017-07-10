<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

require "../configs.php";

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
		sendEmail(mainEmail, mainEmailName, "Reepet | Novo cadastro!", "
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

	$sth = $db->prepare("UPDATE users SET searchs = searchs+1 WHERE code = :code");
	$sth->bindValue(':code', $code);
	$sth->execute();

	$sth = $db->prepare("SELECT name, facebook, whatsapp, email FROM users WHERE code = :code");
	$sth->bindValue(':code', $code);
	$sth->execute();
	$userWanted = $sth->fetch(PDO::FETCH_ASSOC);
	header('content-type: application/json');
	echo json_encode($userWanted);
}

if($action == 'contact') {
	$name = $_POST['name'];
	$email = $_POST['email'];
	$subject = $_POST['subject'];
	$message = $_POST['message'];
	sendEmail(mainEmail, mainEmailName, "ReePet | Contato", "
		<p>Alguém entrou em contato no site ReePet:</p>
		<b>Nome:</b> $name <br>
		<b>E-mail:</b> $email <br>
		<b>Assunto:</b> $subject <br>
		<b>Mensagem:</b> $message
	");
}

function createDb(){
	return new PDO("mysql:host=". dbhost . ";dbname=" .dbname, dbuser, dbpassword);
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
	require_once('../phpmail/PHPMailerAutoload.php');

	$mail = new PHPMailer();
	$mail->IsHTML(true);
	$mail->IsSMTP();
	$mail->SMTPAuth = true;
	$mail->Port = 587;
	$mail->Mailer = "smtp";
	$mail->Host = "smtp.gmail.com";
	$mail->Username = mainEmail;
	$mail->Password = mainEmailPassword;
	$mail->From = mainReceiveEmail;
	$mail->FromName = mainEmailName;
	$mail->CharSet = "UTF-8";
	$mail->SetFrom(mainReceiveEmail, 'Name');
	$mail->addAddress(mainEmailName, 'Name');

	$mail->AddAddress($destiny, $name);
	$mail->Subject = $assunto;

	$mail->MsgHTML($message);

	if (!$mail->Send()) {
		return 0;
	} else {
		return 1;
	}
}
