<?php

use PHPMailer\PHPMailer\PHPMailer;

require '../../PHPMailer-master/src/PHPMailer.php';
require '../../PHPMailer-master/src/SMTP.php';

$name = "";
$email = "";
$message = "";
$subject = "";

if (isset($_POST['name']))
  $name = $_POST['name'];
if (isset($_POST['email']))
  $email = $_POST['email'];
if (isset($_POST['message']))
  $message = $_POST['message'];
if (isset($_POST['subject']))
  $subject = $_POST['subject'];
if ($name === '') {
  echo "Nome não pode estar vazio";
  die();
}
if ($email === '') {
  echo "Email não pode estar vazio";
  die();
} else {
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Email está no formato inválido";
    die();
  }
}
if ($subject === '') {
  echo "Subject não pode estar vazio";
  die();
}
if ($message === '') {
  echo "Message não pode estar vazio";
  die();
}



$content = "From: $name \nEmail: $email \nMessage: $message";
$mailheader = "From: $email \r\n";
$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'feedbacktestepit@gmail.com';
$mail->Password = 'ijekxnqxprkjeauv';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;
$mail->addAddress($email);
$mail->Subject = $subject;
$mail->Body = $content;
if ($mail->send()) {
  echo "Email Enviado!";
} else { 
  die('Erro ao enviar o email');
}
