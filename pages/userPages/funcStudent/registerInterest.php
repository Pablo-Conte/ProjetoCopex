<?php
    require_once('../../../vendor/autoload.php');
    use Twilio\Rest\Client;
    require_once "../../../includes/connection.php";
    require_once "./studentAuth.php";

    require_once('../../../library/mailSRC/PHPMailer.php');
    require_once('../../../library/mailSRC/SMTP.php');
    require_once('../../../library/mailSRC/Exception.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    //precisamos a partir da outra página, receber o ID da empresa
    //Assim poderemos pesquisar no banco o e-mail da empresa para colocar como addAddress (para quem vamos enviar um e-mail)
    //Para colocar os dados do aluno no corpo do e-mail é fácil, basta puxar da sessão

    $nomeAluno = $_SESSION['name'];
    $numeroAluno = $_SESSION['numero'];
    $emailAluno = $_SESSION['email'];
    $idEmpresa = $_POST['idEmpresa'];
    $cargo = $_POST['cargo'];

    $query = $conn->prepare("SELECT email FROM empresa WHERE id_empresa = $idEmpresa");
    $query->execute();

    $results = $query->fetch(PDO::FETCH_ASSOC);
    $emailEmpresa = $results['email'];

    $mail = new PHPMailer(true);

    // try {
    //     $mail->isSMTP();
    //     $mail->Host = 'smtp.gmail.com';
    //     $mail->SMTPAuth = true;
    //     $mail->Username = 'bobesponjamailer@gmail.com'; //Uma conta com as devidas configs para aceitar requisições desse tipo.
    //     $mail->Password = '-'; //Necessário pass pública do email usado para enviar os e-mails (bob).
    //     $mail->Port = 587;

    //     $mail->setFrom('bobesponjamailer@gmail.com');
    //     $mail->addAddress($emailEmpresa);

    //     $mail->isHTML(true);
    //     $mail->Subject = "$nomeAluno registou interesse na sua vaga!";
    //     $mail->Body = "<p>Dados de $nomeAluno:</p>
    //         <ul>
    //             <li>Nome: $nomeAluno</li>
    //             <li>Numero de contato: $numeroAluno</li>
    //             <li>Email de contato: $emailAluno</li>
    //             <li>Vaga de interesse: $cargo</li>
    //         </ul>
    //         ";
    //     $mail->AltBody = 'Chegou o email teste de Pablin!!';

    //     $_SESSION['m'] = "Interesse foi registrado com sucesso!";

    //     $mail->send();

    //     header("location: ./listVacancy.php");
        
    // } catch (Exception $e) {
    //     echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
    //     //Provavelmente tu estás vendo essa parte do código pq a autenticação não funfou né prof? ahahahha, podemos testar em aulas juntos se quiser ;), ou tu pode criar um email e configurar certin para colocar no $mail->Username e tals
    // }

    //Implementação do envio de SMS, em trabalho ainda.

    // try {
        
    //     $account_sid = '';
    //     $auth_token = '';

    //     $twilio_number = "(726) 227-2391 ";

    //     $client = new Client($account_sid, $auth_token);
    //     $client->messages->create(
    //             // Where to send a text message (your cell phone?)
    //             '+5551997602457',
    //             array(
    //                 'from' => $twilio_number,
    //                 'body' => 'Projeto COPEX está funcionando com SMS agora!'
    //             )
    //         );
        
    // } catch (Exception $e) {
    //     echo "Erro ao enviar SMS";
    // }

    try {

        // Find your Account SID and Auth Token at twilio.com/console
        // and set the environment variables. See http://twil.io/secure
        $sid = "";
        $token = "";
        $twilio = new Client($sid, $token);
        
        $message = $twilio->messages
                          ->create("whatsapp:+5551997602457", // to
                                   [
                                       "from" => "whatsapp:+14155238886",
                                       "body" => "Hi Pablo, it's working very well, good job"
                                   ]
                          );
        
        print($message->sid);
    } catch (Exception $e){
        echo "oh shit, here we go again!\n" . $e;
    }
?>
