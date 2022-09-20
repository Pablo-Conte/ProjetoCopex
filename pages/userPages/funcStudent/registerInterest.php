<?php
    require_once "../../../includes/connection.php";
    require_once "./studentAuth.php";

    require_once('../../../mailSRC/PHPMailer.php');
    require_once('../../../mailSRC/SMTP.php');
    require_once('../../../mailSRC/Exception.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer(true);

    try {
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'bobesponjamailer@gmail.com';
        $mail->Password = '';
        $mail->Port = 587;
        
        $mail->setFrom('bobesponjamailer@gmail.com');
        $mail->addAddress('sofiaifsulmailer@gmail.com');

        $mail->isHTML(true);
        $mail->Subject = 'Teste de email via gmail para COPEX Project';
        $mail->Body = 'Chegou o email teste de <strong>Pablin!!</strong>';
        $mail->AltBody = 'Chegou o email teste de Pablin!!';

        if($mail->send()) {
            echo 'Email enviado com sucesso';
        } else {
            echo 'Email não enviado';
        }

    } catch (Exception $e) {
        echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
    }
