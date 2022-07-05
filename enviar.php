<?php

    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'vendor/autoload.php';

    if(isset($_POST['env_email'])):

        //Create an instance; passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.hostinger.com';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = 'contato@garantecredito.com.br';                     //SMTP username
            $mail->Password   = 'Delete@1212';                               //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //Recipients
            $mail->setFrom('contato@garantecredito.com.br', 'Garante Assessoria de Credito Condominial');
            $mail->addAddress($_POST['email'], 'Safety Sindicos Proficionais');     //Add a recipient
            //$mail->addReplyTo('info@example.com', 'Information');
            $mail->addCC('endreo.cba@gmail.com');
            $mail->addCC('contato@safetysindicos.com.br');

            //Attachments
            //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = 'Olá! Agradecemos seu contato.';
            $mail->Body    = 'Logo Entraremos em contato atraves do numero '.$_POST['telefone'].'!</b>';
            $mail->AltBody = 'Todos seus dados são preservados. Com a Garante você tera mais chances de conquistar o credito pra seu condominio.';

            $mail->send();
            Alertmsg('success','Envio de email!', 'SEU EMAIL FOI ENVIADO COM SUCESSO.!');

        } catch (Exception $e) {
            //echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            Alertmsg('error','Envio de email!', 'SEU EMAIL FALHOU.!');
        }

    endif;

    //Alerta sem redirecionamento 
    function Alertmsg($type,$title,$msg){
    
        echo "<script type='text/javascript'>
        Swal.fire({
          icon:  '$type',
          title: '$title',
          text: '$msg',
          timer: 2000
        });
        
        </script>";
    }

?>