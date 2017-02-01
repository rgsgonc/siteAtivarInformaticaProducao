<?php
/* Recuperar os Dados do Formulário de Envio*/
$nome		= $_POST["nome"];
$telefone	= $_POST["telefone"];
$email		= $_POST["email"];
$mensagem   = $_POST["mensagem"];


/* Montar o corpo do email*/
$corpoMensagem 	= "<b>Nome:</b> ".$nome." <br><b>Telefone:</b> ".$telefone."<br><b>Mensagem:</b> ".$mensagem;

/* Extender a classe do phpmailer para envio do email*/
require_once("PHPMailerAutoload.php");

//  Informa a senha do email que tu vai usar como destino 
define('GUSER', 'contato@ativarinformatica.com.br');
define('GPWD', 'Rrg018nm*');

function smtpmailer($para, $de, $nomeDestinatario, $assunto, $corpo) {
	global $error;
	$mail = new PHPMailer();
	/* Montando o Email*/
	$mail->IsSMTP();		    /* Ativar SMTP*/
	$mail->SMTPDebug = 0;		/* Debugar: 1 = erros e mensagens, 2 = mensagens apenas*/
	$mail->SMTPAuth = true;		/* Autenticação ativada	*/
	$mail->SMTPSecure = 'tls';	/* TLS REQUERIDO pelo GMail*/
	$mail->Host = 'br522.hostgator.com.br';	/* SMTP utilizado*/
	$mail->Port = 26;  		   /* A porta 587 deverá estar aberta em seu servidor*/
	$mail->Username = GUSER;
	$mail->Password = GPWD;
	$mail->SetFrom($de, $nomeDestinatario);
	$mail->Subject = $assunto;
	$mail->Body = $corpo;
	$mail->AddAddress($para);
	$mail->IsHTML(true);

	/* Função Responsável por Enviar o Email*/
	if(!$mail->Send()) {
		$error = "<font color='red'><b>Mail error: </b></font>".$mail->ErrorInfo;
		return false;
	} else {
		$error = "<font color='blue'><b>Mensagem enviada com Sucesso!</b></font>";
		return true;
	}
}

//Muda o primeiro parametro, ele será o email de destino
if (smtpmailer('contato@ativarinformatica.com.br', $email, $nome, $telefone, $corpoMensagem)) {
	Header("location: enviado-sucesso.php"); // Redireciona para uma página de Sucesso.
    
}
if (!empty($error)) echo $error;
?>
