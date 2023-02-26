<?php
    require_once('../../../vendor/autoload.php');
    use Twilio\Rest\Client;
    require_once "../../../includes/connection.php";
    require_once "./studentAuth.php";
    include_once '../../../config/configs.php';
    require_once('../../../library/mailSRC/PHPMailer.php');
    require_once('../../../library/mailSRC/SMTP.php');
    require_once('../../../library/mailSRC/Exception.php');

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    //precisamos a partir da outra página, receber o ID da empresa
    //Assim poderemos pesquisar no banco o e-mail da empresa para colocar como addAddress (para quem vamos enviar um e-mail)
    //Para colocar os dados do aluno no corpo do e-mail é fácil, basta puxar da sessão

    $autenticacao = new Autenticacao();
    $senha = $autenticacao->senhaEmail;
    $email = $autenticacao->email;
    $accountId = $autenticacao->account_sid;
    $authToken = $autenticacao->auth_token;
    $twilioNumber = $autenticacao->twilio_number;

    $nomeAluno = $_SESSION['name'];
    $numeroAluno = $_SESSION['numero'];
    $emailAluno = $_SESSION['email'];
    $idEmpresa = $_POST['idEmpresa'];
    $cargo = $_POST['cargo'];

    $query = $conn->prepare("SELECT email, numero, nome FROM empresa WHERE id_empresa = $idEmpresa");
    $query->execute();

    $results = $query->fetch(PDO::FETCH_ASSOC);
    $emailEmpresa = $results['email'];
    $numeroEmpresa = $results['numero'];
    $nomeEmpresa = $results['nome'];

    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = "$email"; //Uma conta com as devidas configs para aceitar requisições desse tipo.
        $mail->Password = "$senha"; //Necessário senha pública do email usado para enviar os e-mails (bob).
        $mail->Port = 587;

        $mail->setFrom("$email");
        $mail->addAddress($emailEmpresa);

        $mail->isHTML(true);
        $mail->Subject = "$nomeAluno registou interesse na sua vaga!";
        $mail->Body = "<p>Olá! parece que um aluno do IFSul registrou interesse na sua vaga! Lá vão os dados de $nomeAluno:</p>
            <ul>
                <li>Nome: $nomeAluno</li>
                <li>Numero de contato: $numeroAluno</li>
                <li>Email de contato: $emailAluno</li>
                <li>Vaga de interesse: $cargo</li>
            </ul>
            ";
        $mail->AltBody = 'Chegou o email teste de Pablin!!';

        $_SESSION['m'] = "Interesse foi registrado com sucesso!";

        $mail->send();

        header("location: ./listVacancy.php");
        
    } catch (Exception $e) {
        echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
    }

    
    //Implementação do envio de SMS.
    try {
        $account_sid = "$accountId"; //account id do twilio
        $auth_token = "$authToken"; //token do twilio

        $twilio_number = "$twilioNumber"; //Número que tu ganha do twilio para enviar as mensagens

        $client = new Client($account_sid, $auth_token);
        $client->messages->create(
                // Where to send a text message (your cell phone?)
                '+5551997602457', //com o twilio pro, colocariamos aqui a variável do número, como usamos a free, vai o meu na mão mesmo, a fim de teste
                array(
                    'From' => $twilio_number,
                    'body' => "Ola $nomeEmpresa! verificamos que um aluno do IFSUL se interessou em sua vaga. 
Nome: $nomeAluno
Número: $numeroAluno
E-mail: $emailAluno
Cargo: $cargo
                    "
                )
            );
        
    } catch (Exception $e) {
        echo "Erro ao enviar SMS: $e";
    }

    //Envio de mensagens via whatsapp
    try {

        $dadosParaEnviar = http_build_query(
            array(
                'number' => "+$numeroEmpresa",
                'message' => "Ola $nomeEmpresa! verificamos que um aluno do IFSUL se interessou em sua vaga. 

Nome: $nomeAluno
Número: $numeroAluno
E-mail: $emailAluno
Cargo: $cargo
                "
            )
        );
        $opcoes = array('http' =>
               array(
                'method'  => 'POST',
                'header'  => 'Content-Type: application/x-www-form-urlencoded',
                'content' => $dadosParaEnviar
            )
        );
        $contexto = stream_context_create($opcoes);
        $result   = file_get_contents('http://localhost:8000/send-message', false, $contexto);
    } catch (Exception $e){
        echo "oh shit, here we go again!\n" . $e;
    }
     
    $idVaga = $_POST['idVaga'];
    $query = $conn->prepare(
    "INSERT INTO vaga_aluno (
        id_vaga, 
        id_aluno
    ) VALUES (
        $idVaga,
        $_SESSION[user_id_aluno]
    )");

    $query->execute();

    $results = $query->fetch(PDO::FETCH_ASSOC);
    $_SESSION['messageInformation'] = 'Interesse registrado com sucesso!';
    header("location: ../studentPage.php");
?>

