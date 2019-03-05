<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

    if(isset($_GET['support'])){
        $subject = $_GET['subject'];
        $text = $_GET['text'];
        $email = $_GET['email'];
        $username = $_GET['username'];
        $mail = new PHPMailer(true);

        try {
            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'tokoricnickoimejezauzeto@gmail.com';
            $mail->Password = 'Lozinka1234!';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            //Recipients
            $mail->setFrom('tokoricnickoimejezauzeto@gmail.com', $username);
            $mail->addAddress('antonijepavlovic1@gmail.com');
            $mail->addReplyTo($email, $username);
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $text;

            if($mail->send())
                echo http_response_code(200);
            else
                echo http_response_code(200);

        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }