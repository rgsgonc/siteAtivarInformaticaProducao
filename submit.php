<?php
// Check for empty fields
if(empty($_POST['nome'])  		||
   empty($_POST['email']) 		||
   empty($_POST['telefone']) 		||
   empty($_POST['mensagem'])	||
   !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
	echo "No arguments Provided!";
	return false;
}

$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$mensagem = $_POST['mensagem'];
// Create the email and send the message
$to = 'welitonderesende@gmail.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Email Received From Ethanol Theme:  $nome";
$email_body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $nome\n\nEmail: $email\n\nPhone: $telefone\n\nMessage:\n$mensagem";
$headers = "From: noreply@yourdomain.com\n"; // This is the email address the generated message will be from. We recommend using something like noreply@yourdomain.com.
$headers .= "Reply-To: $email";
mail($to,$email_subject,$email_body,$headers);
return true;

?>
