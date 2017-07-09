<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

function createDb(){
	return new PDO('mysql:host=reepet_mysql_1;dbname=reepet', 'root', 'root');
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

  $sth = $db->prepare("SELECT count(*) as quantity FROM users");
  $sth->execute();
  $quantity = $sth->fetch(PDO::FETCH_ASSOC)['quantity'];
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
      <div class="panel panel-default">
        <div class="panel-heading">Quantidade de usuários</div>
        <div class="panel-body">
            <?php echo $quantity ?>
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
