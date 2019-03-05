<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';
require '../models/DB.php';

if($_SERVER['REQUEST_METHOD'] !== 'POST'){
    echo 'dudlaj ga again'; //neki kul gif
}else {
    if(isset($_POST['send'])){
        $name = $_POST['name'];
        $username = $_POST['username'];
        $email= $_POST['email'];
        $password = $_POST['password'];
        $db = new DB();

        $regName="/^[A-Z][a-z]{2,12}$/";
        $regUsername="/^\w{4,20}$/";
        $regEmail="/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/";
        $regPass="/^[A-z0-9]{5,20}\W?[A-z0-9]{0,20}$/";

        $err = [];

        if(!preg_match($regName,$name)){
            $err = 'Name is not ok, first letter must be capital';
        }

        if(!preg_match($regUsername,$username)){
            $err = 'Username is not ok,username must be at least 4 characters long';
        }

        if(!preg_match($regEmail,$email)){
            $err = 'Email is not ok,entar valid one';
        }

        if(!preg_match($regPass,$password)){
            $err = 'Password is not ok,password must be at least 8 characters long';
        }
        /*R E G U L A R  E X P R E S I O N S */
        if(count($err)){
            echo http_response_code(422);
        }else{
            $password = md5($password);
            $date=date("Y-m-d H:m:s",time());
            $token = md5(time() . $date);
            $q = "insert into user(name,username,email,password,token,active,role_id) values(:name,:username,:email,:password,:token,0,1)";

            $statement = $db->prepareQ($q);
            $statement->bindParam(":name",$name);
            $statement->bindParam(":username",$username);
            $statement->bindParam(":email",$email);
            $statement->bindParam(":password",$password);
            $statement->bindParam(":token",$token);
            try{
                $code = $statement->execute() ? 201 : 500;
                $mail = new PHPMailer(true);
                try {

                    //Server settings
                    // $mail->SMTPDebug = 0;
                    $mail->SMTPOptions = array(
                        'ssl' => array(
                            'verify_peer' => false,
                            'verify_peer_name' => false,
                            'allow_self_signed' => true
                        )
                    );                                       // Enable verbose debug output
                    $mail->isSMTP();                                      // Set mailer to use SMTP
                    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
                    $mail->SMTPAuth = true;                               // Enable SMTP authentication
                    $mail->Username = 'tokoricnickoimejezauzeto@gmail.com';                 // SMTP username
                    $mail->Password = 'Lozinka1234!';                           // SMTP password
                    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
                    $mail->Port = 587;                                    // TCP port to connect to

                    //Recipients
                    $mail->setFrom('tokoricnickoimejezauzeto@gmail.com', 'Antonije Pavlovic');
                    $mail->addAddress($email);     // Add a recipient

                    $mail->isHTML(true);                                  // Set email format to HTML
                    $mail->Subject = 'Registration';
                    $mail->Body    = 'Click on the following link: <a href="http://192.168.0.101/site/php/verification.php?token='.$token.'">LINK </a>  to activate your account';
                    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                    $mail->send();

                     //echo 'Message has been sent';
                   echo http_response_code(200); //ovo ne udje u success i onda ne dobijem alert ali posalje mail
                } catch (Exception $e) {
                    echo http_response_code(500);
                }
            }catch(PDOException $e){
                echo http_response_code(409);
            }
        }
    }
}
