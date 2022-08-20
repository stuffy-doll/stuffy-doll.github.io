<?php
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

function IsInjected($str)
{
  $injections = array(
    '(\n+)',
    '(\r+)',
    '(\t+)',
    '(%0A+)',
    '(%0D+)',
    '(%08+)',
    '(%09+)'
  );
  $inject = join('|', $injections);
  $inject = "/$inject/i";
  if (preg_match($inject, $str)) {
    return true;
  } else {
    return false;
  }
}

if (IsInjected($email)) {
  echo "Bad email value!";
  exit;
}

$email_from = $email;
$email_subject = $subject;
$email_body = $message;

$to = "sans.boba@gmail.com";
$headers = "From: $email_from \r\n";
$headers .= "Reply-To: $visitor_email \r\n";
mail($to, $email_subject, $email_body, $headers);
