<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

include "../configs.php";

function createDb(){
	return new PDO("mysql:host=". dbhost . ";dbname=" .dbname, dbuser, dbpassword);
}

$login = $_POST['login'];
$password = $_POST['password'];

$db = createDb();
$sth = $db->prepare("SELECT id FROM admins WHERE login = :login AND password = :password");
$sth->execute([
  ":login" => $login,
  ":password" => $password
]);

if($sth->rowCount()){
  $sth = $db->prepare("SELECT * FROM users");
  $sth->execute();
  $users = $sth->fetchAll(PDO::FETCH_ASSOC);

	$sth = $db->prepare("SELECT * FROM info");
  $sth->execute();
  $searchQuantity = $sth->fetch(PDO::FETCH_ASSOC)['searchQuantity'];

  $sth = $db->prepare("SELECT count(*) as quantity, sum(searchs) as successQuantity FROM users");
  $sth->execute();
	$result = $sth->fetch(PDO::FETCH_ASSOC);
  $usersQuantity = $result['quantity'];
	$searchSucessQuantity = $result['successQuantity'];

	$sth = $db->prepare("SELECT searchQuantity FROM info");
  $sth->execute();
	$searchQuantity = $sth->fetch(PDO::FETCH_ASSOC)['searchQuantity'];
}else{
  echo "<h2>Falha na autenticação</h2>";
  exit();
}

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Admin</title>
    <link rel="stylesheet" href="../style/css/bootstrap.min.css">
  </head>
  <body>
    <div class="container">
      <h1>Painel administrativo</h1>
      <hr>
			<div class="row">
				<div class="col-md-4">
					<div class="panel panel-default">
						<div class="panel-heading">Quantidade de usuários</div>
						<div class="panel-body">
							<?php echo $usersQuantity ?>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-default">
						<div class="panel-heading">Buscas bem sucedidadas</div>
						<div class="panel-body">
							<?php echo $searchSucessQuantity ?>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="panel panel-default">
						<div class="panel-heading">Buscas fracasadas</div>
						<div class="panel-body">
							<?php echo $searchQuantity - $searchSucessQuantity ?>
						</div>
					</div>
				</div>
			</div>
      <table class="table table-bordered">
        <thead>
          <tr>
            <td>Nome</td>
            <td>E-mail</td>
            <td>Facebook</td>
            <td>Whatsapp</td>
            <td>Code</td>
            <td>Número de buscas</td>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($users as $key => $user): ?>
          <tr>
            <td><?php echo $user['name'] ?></td>
            <td><?php echo $user['email'] ?></td>
            <td><?php echo $user['facebook'] ?></td>
            <td><?php echo $user['whatsapp'] ?></td>
            <td><?php echo $user['code'] ?></td>
            <td><?php echo $user['searchs'] ?></td>
          </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </body>
</html>
