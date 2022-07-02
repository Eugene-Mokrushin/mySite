<?php

require_once 'vendor/autoload.php';

// Create the Transport
$transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
  ->setUsername('your_email')
  ->setPassword('your_password')
;

// Create the Mailer using your created Transport
$mailer = new Swift_Mailer($transport);


function sendPasswordResetLink($userEmail, $token)
{
  global $mailer;

  $body = '<!DOCTYPE html>
  <html lang="en">
  <head>
      <meta charset="UTF-8">
      <title>Reset Password</title>
  </head>
  <body>
      <div class="wrapper">
          <p>
            Hello there,
            <br>
            Please click on th link below to reset your password.
          </p>
          <a href="http://localhost:3000/en/index.php?password-token='.$token.'">
              Reset your password
          </a>
      </div>
  </body>
  </html>';
  // Create a message
  $message = (new Swift_Message('Reset your password'))
  ->setFrom('your_email')
  ->setTo($userEmail)
  ->setBody($body, 'text/html')
  ;

  // Send the message
  $result = $mailer->send($message);
}


?>