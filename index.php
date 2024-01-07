<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link  rel="stylesheet"  href="bootstrap/css/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>App enviar email</title>
</head>
<body>
	<section>
		<div class="container">
			<div class="text-center my-5">
				<img src="logo.png" width="80px">
				<h1>Send Mail</h1>
				<p class="lead">Seu app de envio de email particular!</p>
			</div>

			<div>
				<form action="enviar_email.php" method="post" class="card card-body font-weight-bold">
					<label for="para">Para</label>
					<input type="email" class="form-control" name="para" placeholder="nome@dominio.com.br"></input>
					<label for="assunto" class="mt-3">Assunto</label>
					<input type="text" class="form-control" name="assunto" placeholder="assunto da mensagem"></input>
					<label for="mensagem" class="mt-3">Mensagem</label>
					<textarea type="text" class="form-control" name="mensagem" ></textarea>
					<?php
						if(isset($_GET['campo'])&&$_GET['Campo']=='vazio'){?>

							<div class="mt-3">
								<p class="text-danger">*Formulário contém campos vazios</p>
							</div>

					<?php } ?>

					<button type="submit" class="btn btn-primary btn-lg mt-3">Enviar mensagem</button>
				</form>
		   </div>

		</div>

		

	</section>

</body>
</html>