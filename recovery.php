<?php
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require './phpmailer/Exception.php';
require './phpmailer/PHPMailer.php';
require './phpmailer/SMTP.php';
require_once 'metodos.php';
$conn = conectarBD();
$correo = $_SESSION['nombreForm'];
echo $_SESSION['nombreForm'];
$sql = "select * from usuarios where correo='$correo'";
$result = mysqli_query($conn,$sql);

    while($mostrar=mysqli_fetch_array($result)){
        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);
        try {
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'aparadal01@educantabria.es';                     //SMTP username
            $mail->Password   = 'Chicagobulls23';   
            $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom('aparadal01@educantabria.es', 'Aitor');
            $mail->addAddress($correo, 'Kanbin Lou');     //Add a recipient
          //  $mail->addAddress('ellen@example.com');               //Name is optional
         // $mail->addReplyTo('info@example.com', 'Information');
        //  $mail->addCC('cc@example.com');
       //   $mail->addBCC('bcc@example.com');
        
            //Attachments
          //  $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
          //  $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
        
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Prueba envio correo php';
            $mail->Body    = 'Esta es la  <b>prueba </b> con <em>php</em> 
             Haz click en este enlace: <a href=localhost/login/change_password.php>Cambiar Contraseña</a>';
            $mail->AltBody = 'Esta es la prueba de envio de correo con php generado por Aitor Parada Linage.
            Haz click en este enlace: <a href=localhost/login/change_password.php>Cambiar Contraseña</a>';
        
            $mail->send();
            header("location:./login.php?message=ok");
        } catch (Exception $e) {
            header("location:./login.php?message=error");
        }
        
    }
?>