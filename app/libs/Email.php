<?php

namespace Adso\libs;

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

/**
 * Clase para enviar el correo electronico  para la recuperacion de la contraseña
 */

class Email {


     /**
     * Envía un correo electrónico a la dirección especificada con un enlace para actualizar la contraseña.
     *
     * hacemos un try catch en el cual modificamos el puerto del servidor SMTP 
     * despues colocamos quien lo envia y a quien se lo enviamos 
     * despues creamos el cuerpo del gmail que le va a llegar al destinatario 
     * despues creamos una Exception la cual si esta erronio el correo nle aparezca un mensage de advertencia 
     * 
     * @param string $email La dirección de correo electrónico del destinatario.
     * @param int $id El identificador que se usará en el enlace para actualizar la contraseña.
     * @return void 
     *
     */

    function sendEmail($email, $id) {
        $mail = new PHPMailer(true);
        
        try {
            // Configuración del servidor SMTP y credenciales de autenticación
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = '985fa8dd2f8e5d';
            $mail->Password = '8d66f38b55a76e';
    
            //aqui colocamos la dirrecion gmail de quien lo envia 
            $mail->setFrom('liamreyes2704@gmail.com', 'Liam Reyes');
            // $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
            //aqui colocamos en destinatario 
            $mail->addAddress($email);               //Name is optional
            // $mail->addReplyTo('info@example.com', 'Information');
            // $mail->addCC('cc@example.com');
            // $mail->addBCC('bcc@example.com');
    
            //Attachments
            // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
    
            //Content aqui hacemos el cuerpo del gmail que le va a llegar al destinatario  
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Password update request';
            $mail->Body    = 'Ingresa a este <a href="'.URL.'/login/updatepassword/'.$id.'">link</a> si deseas cambiar tu contraseña';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
            $mail->send();
        } catch (Exception $e) {
            //aqui creamos la Exception para que si esta erronio el gamil aparaezca el mensaje 
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }

    }

}