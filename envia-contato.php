<?php
session_start();
$nome = $_POST["nome"];
$email = $_POST["email"];
$telefone = $_POST["telefone"];
$mensagem = $_POST["mensagem"];

require_once("PHPMailerAutoload.php");
$mail = new PHPMailer();
$mail->isSMTP();
$mail-> Host = 'smtp.gmail.com';
$mail-> Port = 587;
$mail->SMTPSecure = 'ssl';
$mail->SMTPAuth = true;
$mail->Username = "rgs.gonc@gmail.com";
$mail->Password = "Rrg017nm*"; //aqui colocar a senha do email.

$mail->setFrom ("rgs.gonc@gmail.com", "Ativar Informática");
$mail->addAddress("rgs.gonc@gmail.com");
$mail->Subject = "Contato Ativar Informática"; //titulo do email.
$mail->msgHTML ("<html>De: {$nome}<br/>Email: {$email}<br/>Telefone: {$telefone}<br/>Mensagem: {$mensagem}</html>");
$mail->AltBody = "De: {$nome}\nEmail: {$email}\nTelefone: {$telefone}\n Mensagem: {$mensagem}";

if($mail->send()){
  $_SESSION["success"] = "Mensagem enviada com sucesso";
  header("Location: index.php");
}else{
  $_SESSION["danger"] = "Erro ao enviar mensagem " . $mail->ErrorInfo;
  header("Location: contato.php");
}
die();
