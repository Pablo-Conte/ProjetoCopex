<?php
    
    require_once '../../includes/connection.php';
    use PHPMailer\PHPMailer\PHPMailer;
    require '../../library/mailSRC/PHPMailer.php';
    require '../../library/mailSRC/SMTP.php';
    require '../../library/mailSRC/Exception.php';
    use PHPMailer\PHPMailer\Exception;
    include_once '../../config/configs.php';

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

    $autenticacao = new Autenticacao();
    $senha = $autenticacao->senhaEmail;
    $email = $autenticacao->email;
    
    //Login Administrador
    if (!empty($_POST['siape'])){

        $query = "SELECT id_administrador, email, nome FROM administrador WHERE siape = :siape";
        $records = $conn->prepare($query);
        $records->bindParam(':siape', $_POST['siape']);
        $records->execute();

        $results = $records->fetch(PDO::FETCH_ASSOC);

        if ($results == false){
            $results = [];
        }

        if ($results){
            
            $size = 8;
            $seed = time(); 
            $code = substr(sha1($seed), 40 - min($size,40));
            $hashedCode = password_hash($code, PASSWORD_DEFAULT);
            var_dump($results);
            $queryVerificarCode = $conn->prepare("SELECT id_code FROM passwordcodeadmin WHERE id_admin = $results[id_administrador]");
            if ($queryVerificarCode->execute()) {
                
                while ($queryVerificarIdCode = $queryVerificarCode->fetch(PDO::FETCH_ASSOC)){
                    $queryDeletarCode = $conn->prepare("DELETE FROM passwordcodeadmin WHERE id_code = $queryVerificarIdCode[id_code]");
                    $queryDeletarCode->execute();
                }
            };
            
            $queryCriarCode = $conn->prepare("INSERT INTO passwordCodeadmin (id_admin, code) VALUES ($results[id_administrador], '$hashedCode')");
            $queryCriarCode->execute();
            
            $mail = new PHPMailer(true);
            
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = "$email";
                $mail->Password = "$senha";
                $mail->Port = 587;
    
                $mail->setFrom("$email");
                $mail->addAddress($results['email']);
    
                $mail->isHTML(true);
                $mail->Subject = "Prazer $results[nome]!";
                $mail->Body = "<p>Aqui está seu código de recuperação de senha:</p>
                    <ul>
                        <li>$code</li>
                    </ul>
                    ";
    
                $mail->send();
                
                
                $_SESSION['miColor'] = 'green';
                $_SESSION['messageInformationOutraPagina'] = "Email com o código enviado para o seu e-mail, verifique-o!";

                header("location: ./passwordChange.php");
            
            } catch (Exception $e) {
                $_SESSION['messageInformation'] = "$mail->ErrorInfo";
                $_SESSION['miColor'] = '#FA6E65';
            }
            
        } else {
            $_SESSION["messageInformation"] = 'Algo deu errado!';
            $_SESSION['miColor'] = '#FA6E65';
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

        if ($results){
            
            $size = 8;
            $seed = time(); 
            $code = substr(sha1($seed), 40 - min($size,40));
            $hashedCode = password_hash($code, PASSWORD_DEFAULT);

            $queryVerificarCode = $conn->prepare("SELECT id_code FROM passwordcodealuno WHERE id_aluno = $results[id_aluno]");
            if ($queryVerificarCode->execute()) {
                
                while ($queryVerificarIdCode = $queryVerificarCode->fetch(PDO::FETCH_ASSOC)){
                    $queryDeletarCode = $conn->prepare("DELETE FROM passwordcodealuno WHERE id_code = $queryVerificarIdCode[id_code]");
                    $queryDeletarCode->execute();
                }
            };
            
            $queryCriarCode = $conn->prepare("INSERT INTO passwordCodeAluno (id_aluno, code) VALUES ($results[id_aluno], '$hashedCode')");
            $queryCriarCode->execute();
            
            $mail = new PHPMailer(true);
            
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = "$email";
                $mail->Password = "$senha";
                $mail->Port = 587;
    
                $mail->setFrom("$email");
                $mail->addAddress($results['email']);
    
                $mail->isHTML(true);
                $mail->Subject = "Prazer $results[nome]!";
                $mail->Body = "<p>Aqui está seu código de recuperação de senha:</p>
                    <ul>
                        <li>$code</li>
                    </ul>
                    ";
    
                $mail->send();
                
                
                $_SESSION['miColor'] = 'green';
                $_SESSION['messageInformationOutraPagina'] = "Email com o código enviado para o seu e-mail, verifique-o!";

                header("location: ./passwordChange.php");
            
            } catch (Exception $e) {
                $_SESSION['messageInformation'] = "$mail->ErrorInfo";
                $_SESSION['miColor'] = '#FA6E65';
            }
            
        } else {
            $_SESSION["messageInformation"] = 'Algo deu errado!';
            $_SESSION['miColor'] = '#FA6E65';
        }
    }

    //Login Empresa
    if(!empty($_POST['cnpj'])){
        $query = "SELECT id_empresa, email, nome FROM empresa WHERE cnpj = :cnpj";
        $records = $conn->prepare($query);
        $records->bindParam(':cnpj', $_POST['cnpj']);
        $records->execute();

        $results = $records->fetch(PDO::FETCH_ASSOC);

        if ($results == false){
            $results = [];
        }

        if ($results){
            
            $size = 8;
            $seed = time(); 
            $code = substr(sha1($seed), 40 - min($size,40));
            $hashedCode = password_hash($code, PASSWORD_DEFAULT);

            $queryVerificarCode = $conn->prepare("SELECT id_code FROM passwordcodeempresa WHERE id_empresa = $results[id_empresa]");
            if ($queryVerificarCode->execute()) {
                
                while ($queryVerificarIdCode = $queryVerificarCode->fetch(PDO::FETCH_ASSOC)){
                    $queryDeletarCode = $conn->prepare("DELETE FROM passwordcodeempresa WHERE id_code = $queryVerificarIdCode[id_code]");
                    $queryDeletarCode->execute();
                }
            };
            
            $queryCriarCode = $conn->prepare("INSERT INTO passwordcodeempresa (id_empresa, code) VALUES ($results[id_empresa], '$hashedCode')");
            $queryCriarCode->execute();
            
            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = "$email";
                $mail->Password = "$senha";
                $mail->Port = 587;
    
                $mail->setFrom("$email");
                $mail->addAddress($results['email']);
    
                $mail->isHTML(true);
                $mail->Subject = "Prazer $results[nome]!";
                $mail->Body = "<p>Aqui está seu código de recuperação de senha:</p>
                    <ul>
                        <li>$code</li>
                    </ul>
                    ";
    
                $mail->send();
                
                
                $_SESSION['miColor'] = 'green';
                $_SESSION['messageInformationOutraPagina'] = "Email com o código enviado para o seu e-mail, verifique-o!";

                header("location: ./passwordChange.php");
            
            } catch (Exception $e) {
                $_SESSION['messageInformation'] = "$mail->ErrorInfo";
                $_SESSION['miColor'] = '#FA6E65';
            }
            
        } else {
            $_SESSION["messageInformation"] = 'Algo deu errado!';
            $_SESSION['miColor'] = '#FA6E65';
        }
        
    }
    
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../Bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../css/headerIndex.css">
    <link rel="stylesheet" href="../css/headerHome.css">
    <link rel="stylesheet" href="../css/login.css">
    <script src="../../library/jquery/jquery.min.js"></script>
    <script src="../../Bootstrap/js/bootstrap.bundle.js"></script>
    <title>Recuperação de senha</title>
</head>

<body id="grad">
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a href="../../index.php" class="navbar-brand">COPEX</a>
            <form class="d-flex" role="search">
                <a href="../login.php" class="voltar">Voltar</a>
                <a href="../../index.php" class="home">
                    HOME
                </a>
            </form>
        </div>
    </nav>

    <?php
        if (!empty($_SESSION['messageInformation'])) {

            echo "
                        <div class='toast-container position-fixed' style='left: 50%;
                        position: fixed; top: 0; transform: translate(-50%, 0px);
                        z-index: 9999; border: none; margin-top: 2%'>
                            <div id='liveToast' class='toast' role='alert' aria-live='assertive' aria-atomic='true' style='background-color: white; '>
                                <div class='toast-header' style='background-color: $_SESSION[miColor]; color: white'>
                                    <strong class='me-auto'>Informativo!</strong>
                                    <button type='button' class='btn-close' data-bs-dismiss='toast' aria-label='Close'></button>
                                </div>
                                <div class='toast-body'>
                                    $_SESSION[messageInformation]
                                </div>
                            </div>
                        </div>";


            echo "
                            <script>
                                const toastLiveExample = document.getElementById('liveToast')
                                const toast = new bootstrap.Toast(toastLiveExample)
                                toast.show()
                            </script>
                        ";

            $_SESSION['messageInformation'] = '';
        }


    ?>
    <div class="main">
        <div>
            <div class="loginChoice">

                <label value="Administrador" name="opcao" class="opcao" id="Administrador">Administrador</label>
                <label value="Estudante" name="opcao" class="opcao" id="Estudante" style="background-color: white; color: black;">Estudante</label>
                <label value="Empresa" name="opcao" class="opcao" id="Empresa">Empresa</label>

            </div>
            <div class="loginStyle">
                <div>
                    <div id="tab1" style="display: none;">
                        <div class="loginForm">
                            <form action="./forgotPassword.php" method="POST" class="data">
                                <img src="../../imagens/admin.png" alt="">
                                <hr>
                                <input type="name" placeholder="Digite seu SIAPE" name="siape">
                                
                                <button type="submit">Recuperar senha</button>
                            </form>
                        </div>
                    </div>
                    <div id="tab2" style="display: block;">
                        <div class="loginForm">
                            <form action="./forgotPassword.php" method="POST" class="data">
                                <img src="../../imagens/aluno.png" alt="">
                                <hr>
                                <input type="text" placeholder="Digite sua matricula" name="matricula">
                                
                                <button type="submit">Recuperar senha</button>
                            </form>
                        </div>
                    </div>
                    <div id="tab3" style="display: none;">
                        <div class="loginForm">
                            <form action="./forgotPassword.php" method="POST" class="data">
                                <img src="../../imagens/empresa.png" alt="">
                                <hr>
                                <input type="name" placeholder="Digite seu CNPJ" name="cnpj">
                                
                                <button type="submit">Recuperar senha</button>
                            </form>
                        </div>
                    </div>
                    <?php if (!empty($message)) : ?>
                        <p> <?= $message ?></p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <script>
        var a = "";
        $(window).load(function() {
            
            $('.opcao').on('click', function(label) {
                
                a = label.currentTarget.id;

                if ((a == "Administrador") || (a == "Estudante") || (a == "Empresa")) {
                    
                    if ((a == "Administrador")) {
                        document.getElementById('tab1').style.display = "block";
                        document.getElementById('Administrador').style.backgroundColor = 'white';
                        document.getElementById('Administrador').style.color = 'black';
                        document.getElementById('Administrador').style.transition = '0.5s'
                        document.getElementById('tab2').style.display = "none";
                        document.getElementById('Estudante').style.backgroundColor = 'RGB(33, 37, 41)';
                        document.getElementById('Estudante').style.color = 'white';
                        document.getElementById('tab3').style.display = "none";
                        document.getElementById('Empresa').style.backgroundColor = 'RGB(33, 37, 41)';
                        document.getElementById('Empresa').style.color = 'white';
                    } else if ((a == "Estudante")) {
                        document.getElementById('tab1').style.display = "none";
                        document.getElementById('Administrador').style.backgroundColor = 'RGB(33, 37, 41)';
                        document.getElementById('Administrador').style.color = 'white';
                        document.getElementById('tab2').style.display = "block";
                        document.getElementById('Estudante').style.backgroundColor = 'white';
                        document.getElementById('Estudante').style.color = 'black';
                        document.getElementById('Estudante').style.transition = '0.5s'
                        document.getElementById('tab3').style.display = "none";
                        document.getElementById('Empresa').style.backgroundColor = 'RGB(33, 37, 41)';
                        document.getElementById('Empresa').style.color = 'white';
                    } else if ((a == "Empresa")) {
                        document.getElementById('tab1').style.display = "none";
                        document.getElementById('Administrador').style.backgroundColor = 'RGB(33, 37, 41)';
                        document.getElementById('Administrador').style.color = 'white';
                        document.getElementById('tab2').style.display = "none";
                        document.getElementById('Estudante').style.backgroundColor = 'RGB(33, 37, 41)';
                        document.getElementById('Estudante').style.color = 'white';
                        document.getElementById('tab3').style.display = "block";
                        document.getElementById('Empresa').style.backgroundColor = 'white';
                        document.getElementById('Empresa').style.color = 'black';
                        document.getElementById('Empresa').style.transition = '0.5s'
                    }
                }

            });

        });
    </script>
</body>

</html>