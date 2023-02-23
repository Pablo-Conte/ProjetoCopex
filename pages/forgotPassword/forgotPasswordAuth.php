<?php 
    require_once '../../includes/connection.php';
    use PHPMailer\PHPMailer\PHPMailer;
    require '../../library/mailSRC/Exception.php';
    use PHPMailer\PHPMailer\Exception;


    session_start();

    if (isset($_SESSION['user_id_admin'])){
        header('Location: ./userPages/adminPage.php');
    }

    if (isset($_SESSION['user_id_aluno'])){
        header('Location: ./userPages/studentPage.php');
    }

    if (isset($_SESSION['user_id_empresa'])){
        header('Location: ./userPages/companyPage.php');
    }

    //Login Administrador
    if (!empty($_POST['siape'])){

        $query = "SELECT siape, senha, id_administrador, nome FROM administrador WHERE siape = :siape";

        $records = $conn->prepare($query);

        $records->bindParam(':siape', $_POST['siape']);
        
        $records->execute();

        $results = $records->fetch(PDO::FETCH_ASSOC);
        
        if ($results == false){
            $results = [];
        }

        $message = '';

        if (count($results) > 1 && password_verify($_POST['password'], $results['senha']) == TRUE){
            $_SESSION['user_id_admin'] = $results["id_administrador"];
            $_SESSION['name'] = $results["nome"];
            $_SESSION['messageInformation'] = "";
            header("Location: ./userPages/adminPage.php");
        } else {
            $message = "<script language='javascript' type='text/javascript'>alert('Algo deu errado, tente novamente!')</script>";
        }
    
    } 
    
    //Login Estudante
    if(!empty($_POST['matricula'])){
        $query = "SELECT id_aluno, email, nome FROM aluno WHERE matricula = :matricula";
        $records = $conn->prepare($query);
        $records->bindParam(':matricula', $_POST['matricula']);
        $records->execute();

        $results = $records->fetch(PDO::FETCH_ASSOC);

        if ($results == false){
            $results = [];
        }

        if (count($results) > 1 && password_verify($_POST['password_aluno'], $results['senha']) == True){
            $size = 2;
            $seed = time(); 
            $code = substr(sha1($seed), 40 - min($size,40));
            $hashedCode = password_hash($code, PASSWORD_DEFAULT);
            
            $queryCriarCode = $conn->prepare("INSERT INTO passwordCodeAluno (id_aluno, code) VALUES ($records[id_aluno], $hashedCode)");
            $queryCriarCode->execute();
    
            $mail = new PHPMailer(true);
            
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'bobesponjamailer@gmail.com';
                $mail->Password = 'tjtmlgtjwqqskuam';
                $mail->Port = 587;
    
                $mail->setFrom('bobesponjamailer@gmail.com');
                $mail->addAddress($records['email']);
    
                $mail->isHTML(true);
                $mail->Subject = "Prazer $nomeAluno!";
                $mail->Body = "<p>Aqui está seu código de recuperação de senha:</p>
                    <ul>
                        <li>$code</li>
                    </ul>
                    ";
    
                $mail->send();
    
                header("location: ./passwordChange.php");
            
            } catch (Exception $e) {
                echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
            }
            
        } else {
            $message = "<script language='javascript' type='text/javascript'>alert('Algo deu errado, tente novamente!')</script>";
        }
    }

    //Login Empresa
    if(!empty($_POST['cnpj'])){
        $query = "SELECT * FROM empresa WHERE cnpj = :cnpj";
        $records = $conn->prepare($query);
        $records->bindParam(':cnpj', $_POST['cnpj']);
        $records->execute();

        $results = $records->fetch(PDO::FETCH_ASSOC);

        if ($results == false){
            $results = [];
        }

        if (count($results) > 1 && password_verify($_POST['password_empresa'], $results['senha'])){
            $_SESSION['user_id_empresa'] = $results["id_empresa"];
            $_SESSION['name'] = $results["nome"];
            $_SESSION['messageInformation'] = "";
            header("Location: ./userPages/companyPage.php");
        } else {
            $message = "<script language='javascript' type='text/javascript'>alert('Algo deu errado, tente novamente!')</script>";
        }
        
    }
    
?>