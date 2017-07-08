<?php
	$action = isset($_POST['action'])?$_POST['action']:'';

	include "controllers/userController.php";
?>
<!DOCTYPE html>
<html>

<head>
    <title>ReePet</title>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700" rel="stylesheet">
    <!-- css -->
    <link href="style/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="style/color/default.css" rel="stylesheet" media="screen">
    <script src="style/js/modernizr.custom.js"></script>
    <link href="style/css/fontello.css" rel="stylesheet">
		<link href="style/css/style.css" rel="stylesheet" media="screen">
		<link href="style/css/components.css" rel="stylesheet" media="screen">
		<link href="style/css/helpers.css" rel="stylesheet" media="screen">
</head>

<body>

    <!-- Created code modal -->
    <?php if($cretedCode): ?>
    <script type="text/javascript">
        onload = function() {
            $(function() {
                $('#createdCodeModal').modal()
            });
        }
    </script>
    <div class="modal fade" id="createdCodeModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Cadastro feito com sucesso!</h4>
                </div>
                <div class="modal-body">
                    <p>O seu código é <span style="font-size: 25px"><?php echo $cretedCode ?></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

		<!-- Recovered Code -->
    <?php if($recoveredCode): ?>
    <script type="text/javascript">
        onload = function() {
            $(function() {
                $('#recoveredCode').modal()
            });
        }
    </script>

    <div class="modal fade" id="recoveredCode" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Seu código foi encontrado!</h4>
                </div>
                <div class="modal-body">
                    <p>O seu código é <span style="font-size: 25px"><?php echo $recoveredCode ?></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>

    <!-- Header -->
    <header class="main-header">
			<nav class="main-header__nav">
				<div class="container">
					<div class="row">
						<div class="col-md-3">
							<img src="style/img/logo.png" alt="Logo Menpet" class="main-header__nav__logo img-responsive">
						</div>
						<div class="col-md-5 col-md-offset-1">
							<ul class="main-header__nav__list">
								<li><a href="#">Pesquisar código</a></li>
								<li><a href="#">Como funciona</a></li>
								<li><a href="#">Fale conosco</a></li>
							</ul>
						</div>
						<div class="col-md-3">
							<a type="button" class="button button--full-width">Cadastre-se</a>
						</div>
					</div>
				</div>
			</nav>
			<div class="main-header__section">
				<div class="container">
					Ajudamos você a <br>
					<span class="primary-color"><b>Ree</b>ncontrar</span> seu Pet de <br>
					uma forma simples e fácil!
					<br>
					<div class="row">
						<div class="col-md-4">
							<br>
							<a type="button" class="button button--full-width">Reencontre agora mesmo</a>
						</div>
					</div>
				</div>
			</div>
    </header>


		<section class="section-area">
			<div class="container">
				<div class="row">
					<div class="col-md-6">
						<div class="card">
							<h3 class="card__title">Cadastrar código</h3>
							<div class="card__description">
								<p>Preencha e receba etiqueta via e-mail.</p>
							</div>
							<form method="post" class="form">
								<input type="text" name="name" placeholder="Nome" class="input input--full-width">
								<input type="text" name="facebook" placeholder="Facebook" class="input input--full-width">
								<input type="text" name="whatsapp" placeholder="Whatsapp" class="input input--full-width">
								<input type="text" name="E-mail" placeholder="E-mail" class="input input--full-width">
								<button type="submit" name="action" value="create" class="button button--full-width">Cadastrar</button>
							</form>
							<div class="text-right">
								Esqueceu sua senha?
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="card">

						</div>
					</div>
				</div>
			</div>
		</section>
    <!-- Serviço -->
    <section id="services" class="home-section bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <div class="section-heading">
                        <?php if($cretedCode): ?>
                        <h2 class="foteGooglePT">Obrigado pro se cadastrar na nossa plataforma!</h2>
                        <?php else: ?>
                        <h2 class="foteGooglePT">Cadastrar | Pesquisar Código</h2>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="row">

                <!-- Cadastrar Código -->
                <div class="col-xs-12 col-sm-6" data-wow-delay="0.3s">
                    <div>
                        <i class="fa fa-cog fa-4x"></i>
                        <h4>Cadastrar Código</h4>
                        <p>Preencha e receba etiqueta via e-mail.</p>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-1 col-md-10">
                            <form class="form-horizontal" role="form" method="post" action="#services">
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-8">
                                        <input type="text" class="form-control" name="name" id="inputName" placeholder="Nome" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-8">
                                        <input type="text" class="form-control" name="facebook" id="inputEmail" placeholder="Facebook">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-8">
                                        <input type="text" class="form-control sp_celphones" name="whatsapp" id="inputSubject" placeholder="WhatsApp">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-8">
                                        <input type="text" class="form-control" name="email" required rows="3" placeholder="E-mail">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-8">
                                        <input type="hidden" name="action" value="create">
                                        <button type="submit" class="btn btn-theme btn-lg btn-block">Cadastrar</button>
                                    </div>
                                </div>
                                <div>
                                    <a href="#" data-toggle="modal" data-target="#forgetPassword">Esqueceu seu código?</a>
                                </div>
                            </form>
                            <div class="modal fade" id="forgetPassword" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">Recuperação de código</h4>
                                        </div>
                                        <div class="modal-body">
                                            <form class="form-inline" method="post" action="#services">
                                                <div class="row">
                                                    <div class="col-xs-12 col-md-9">
                                                        <input type="email" class="form-control" style="width: 100%" placeholder="petter.parker@exemplo.com" required="" name="email">
                                                    </div>
                                                    <div class="col-xs-12 col-md-3">
                                                        <input type="hidden" name="action" value="recoveredCode">
                                                        <button type="submit" class="btn btn-block btn-primary">Recuperar</button>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pesquisar Código -->
                <div class="col-xs-12 col-sm-6" data-wow-delay="0.5s">
                    <div>
                        <i class="fa fa-desktop fa-4x"></i>
                        <h4>Pesquisar Código PET</h4>
                        <p>Digite o código impresso na coleira.</p>
                    </div>
                    <div class="row">
                        <div class="col-md-offset-1 col-md-10">
                            <form class="form-horizontal" role="form" method="get" action="#services">
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-8">
                                        <input type="text" class="form-control" name="codigo" placeholder="DIGITAR: 74w2c" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-offset-2 col-md-8">
                                        <input type="hidden" name="action" value="search">
                                        <button type="submit" value="Submit" class="btn btn-theme btn-lg btn-block">Pesquisar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <?php if($userWanted): ?>
                    <div class="row">
                        <div class="col-md-offset-1 col-md-10">
                            <p>
                                <b>Dono PET:</b>
                                <?php echo $userWanted['name']?>
                            </p>
                            <p>
                                <b>Facebook:</b>
                                <?php echo $userWanted['facebook']?>
                            </p>
                            <p>
                                <b>WhatsApp:</b>
                                <a target="_blank" href="https://api.whatsapp.com/send?1=pt_BR&phone=55<?php echo preg_replace("/\s|[(]|[)]|[-]/","",$userWanted['whatsapp']) ?>">
                                    <?php echo $userWanted['whatsapp']?>
                                </a>
                            </p>
                            <p>
                                <b>E-mail:</b>
                                <a href="mailto:<?php echo $userWanted['email']?>">
                                    <?php echo $userWanted['email']?>
                                </a>
                            </p>
                        </div>
                    </div>
                    <?php endif; ?>
                    <?php if($action == 'search' && !$userWanted): ?>
                    <br>
                    <span style="font-size: 20px">Nenhum Pet cadastrado com esse código</span>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </section>

    <hr>

    <!-- FAQ | Video -->
    <section id="faq" class="home-section bg-white">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-2 col-md-8">
                    <div class="section-heading">
                        <h2 class="foteGooglePT">Como Funciona</h2>
                        <p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Cure.</p>
                        <br>
                        <iframe width="560" height="315" src="https://www.youtube.com/embed/c2OTHeCKsBE?rel=0&amp;controls=0&amp;showinfo=0" frameborder="0" allowfullscreen></iframe>
                    </div>
                </div>
            </div>
        </div>

        <hr>

        <!-- Apoiadores -->
        <section id="apoiadores" class="home-section bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-2 col-md-8">
                        <div class="section-heading">
                            <h5>Ó2 | PróSoftware | Mágica Filmes | Go-X | MusicMe | Evento HOJE</h5>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <hr>

        <!-- Contact -->
        <section id="contact" class="home-section bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-offset-2 col-md-8">
                        <div class="section-heading">
                            <h2 class="foteGooglePT">Envie seu contato</h2>
                            <p>Dúvidas, solicitações e assuntos gerais <br>Entre em contato conosco que retornamos o mais breve possível</p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-offset-1 col-md-10">
                        <form class="form-horizontal" role="form" method="post">
                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-8">
                                    <input type="text" class="form-control" id="inputName" name="nome" placeholder="Nome">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-8">
                                    <input type="email" class="form-control" id="inputEmail" name="email" placeholder="E-mail">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-8">
                                    <input type="text" class="form-control" id="inputSubject" name="assunto" placeholder="Assunto">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-8">
                                    <textarea class="form-control" rows="3" name="mensagem" placeholder="Mensagem"></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-8">
                                    <input type="hidden" name="action" value="contact">
                                    <button type="submit" id="enviar" class="btn btn-theme btn-lg btn-block">Enviar</button>
                                </div>
                            </div>
                        </form>

                        <?php
				if ($action == 'contact') {
					function envia($destino, $nome, $assunto) {
						require_once('phpmail/PHPMailerAutoload.php');

						$mail = new PHPMailer();
						$mail->IsHTML(true); // envio como HTML se 'true'
						$mail->IsSMTP(); // send via SMTP
						$mail->SMTPAuth = true; // 'true' para autenticaï¿½ï¿½o
						$mail->Port = 587;
						$mail->Mailer = "smtp"; //Usando protocolo SMTP
						$mail->Host = "smtp.gmail.com"; //seu servidor SMTP
						$mail->Username = "geffersonvivan@gmail.com";
						$mail->Password = "senha"; // senha de SMTP
						$mail->From = "naoresponda@o2multi.com.br";
						$mail->FromName = "O2 Multicomunicação";
						$mail->CharSet = "UTF-8";
						$mail->SetFrom('naoresponda@o2multi.com.br', 'O2 Multicomunicação');
						$mail->addAddress('geffersonvivan@gmail.com', 'O2 Multicomunicação');

						$mail->AddAddress($destino, $nome); //alterar email aqui
						$mail->addBCC('contatobkp@o2multi.com.br', 'O2 Multicomunicação');
						$mail->Subject = $assunto;

						foreach ($_POST as $key => $valor) {
							if (($key != 'x') && ($key != 'y')) {
								$campos[] = $key;
								$valores[] = $valor;
							}
						}
						$html = '';
						for ($i = 0; $i < count($campos); $i++) {
							$field = ucwords(str_replace('-', ' ', $campos[$i]));
							$field = ucwords(str_replace('_', '/', $field));
							$values = $valores[$i];
							if ($field == 'mensagem') {
								$html .= $field . '<br>' . nl2br($values) . '<br>';
							} else if ($field != 'G Recaptcha Response') {
								$html .= $field . ': ' . $values . '<br>';
							}
						}
						$html = $html;
						$mail->MsgHTML($html);

						if (!$mail->Send()) {
							return 0;
						} else {
							return 1;
							echo "<p>enviado</p>";
						}
					}

					$resultado = envia('geffersonvivan@gmail.com', 'O2 Multi', 'O2 Multi');
				}

				?>

                    </div>
                </div>

                <!--redes sociais-->

                <div class="row mar-top30 ">
                    <div class="col-md-offset-2 col-md-8">
                        <ul class="social-network">
                            <li>
                                <a href="#">
                                    <span class="fa-stack fa-2x">
						<i class="fa fa-circle fa-stack-2x"></i>
						<i class="fa fa-facebook fa-stack-1x fa-inverse"></i>
					</span></a>
                            </li>
                            <li>
                                <a href="#">
                                    <span class="fa-stack fa-2x">
						<i class="fa fa-circle fa-stack-2x"></i>
						<i class="fa fa-twitter fa-stack-1x fa-inverse"></i>
					</span></a>
                            </li>
                        </ul>
                    </div>
                </div>

            </div>
        </section>

        <!-- Footer -->
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <p>Copyright &copy;2014 Todos os direitos reservados</p>
                    </div>
                </div>
            </div>
        </footer>
    </section>

    <!-- js -->
    <script src="style/js/jquery.js"></script>
    <script src="style/js/bootstrap.min.js"></script>
    <script src="style/js/jquery.smooth-scroll.min.js"></script>
    <script src="style/js/jquery.dlmenu.js"></script>
    <script src="style/js/jquery.mask.min.js"></script>
    <script src="style/js/wow.min.js"></script>
    <script src="style/js/custom.js"></script>
</body>

</html>
