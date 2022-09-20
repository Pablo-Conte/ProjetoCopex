<?php
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

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'bobesponjamailer@gmail.com';
    $mail->Password = 'rxcyewmvmscegjmu';
    $mail->Port = 587;

    $mail->setFrom('bobesponjamailer@gmail.com');
    $mail->addAddress($emailEmpresa);

    $mail->isHTML(true);
    $mail->Subject = "$nomeAluno registou interesse na sua vaga!";
    $mail->Body = "<p>Dados de $nomeAluno:</p>
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
