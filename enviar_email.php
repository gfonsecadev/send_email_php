<?php

require './PHPMailer/Exception.php';
require './PHPMailer/PHPMailer.php';
require './PHPMailer/SMTP.php';
require './PHPMailer/OAuthTokenProvider.php';
require './PHPMailer/OAuth.php';
require './PHPMailer/POP3.php';


	class Email{
		private $para="";
		private $assunto="";
		private $mensagem="";
		public $status=array('codigo_status'=> null,'descricao_status'=>null);

		public function __get($atr){
			return $this->$atr;
		}


		public function __set($atr, $valor){
			$this->$atr=$valor;
		}

		public function verificarDados(){
			if (empty($this->para)||empty($this->assunto)||empty($this->mensagem)) {
				header('Location: index.php?Campo=vazio');
			}
		}

	}



    $email=new Email();

   $email->__set('para',$_POST['para']);
   $email->__set('assunto',$_POST['assunto']);
   $email->__set('mensagem',$_POST['mensagem']);
   $email->verificarDados();

    use PHPMailer\PHPMailer\PHPMailer;


   $mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = false;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'gilmar.testes05@gmail.com';                     //SMTP username
    $mail->Password   = 'gil.teste05';                               //SMTP password
    $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('gildrive04@gmail.com');
    $mail->addAddress($email->__get('para'));     //Add a recipient


    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = $email->__get('assunto');
    $mail->Body = $email->__get('mensagem');

    $mail->send();
    
    
 
    $email->status['codigo_status']=1;
    $email->status['descricao_status']='Email foi enviado com sucesso!';

} catch (Exception $e) {
	$email->status['codigo_status']=2;
    $email->status['descricao_status']='Email não foi enviado,tente mais tarde.' .'<BR/>'. '<strong>Motivo</strong> :' ."{$mail->ErrorInfo}";
    
}


 
   

?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
</head>
<body>
	<?php
	if($email->status['codigo_status']==1){?>
		<div class="container">
		<div class="text-center my-5">
				<img src="logo.png" width="80px">
				<h1>Send Mail</h1>
				<p class="lead">Seu app de envio de email particular!</p>
		</div>

		<h1 class="text-success">Sucesso</h1>
		<p><?= $email->status['descricao_status']?></p>
		<a href="index.php" class="btn btn-success btn-lg">Voltar</a>
	</div>
	

<?php }?>

<?php
	if($email->status['codigo_status']==2){?>
		<div class="container">
		<div class="text-center my-5">
				<img src="logo.png" width="80px">
				<h1>Send Mail</h1>
				<p class="lead">Seu app de envio de email particular!</p>
		</div>

		<h1 class="text-danger">Ops...</h1>
		<p><?= $email->status['descricao_status']?></p>
		<a href="index.php" class="btn btn-danger btn-lg">Voltar</a>
	</div>
	

<?php }?>
	
</body>

</html>
