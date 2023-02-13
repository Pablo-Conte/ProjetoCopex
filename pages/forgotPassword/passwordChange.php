<?php
    
    
    require_once '../../includes/connection.php';

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

        $query = "SELECT id_administrador FROM administrador WHERE siape = :siape";
        $records = $conn->prepare($query);
        $records->bindParam(':siape', $_POST['siape']);
        $records->execute();

        $results = $records->fetch(PDO::FETCH_ASSOC);

        if ($results == false){
            $results = [];
        }

        if ($results){
            if ($_POST['senha'] == $_POST['verificarSenha']){
                $queryPegarCode = $conn->prepare("SELECT code FROM passwordcodeadmin WHERE id_admin = $results[id_administrador]");
                $queryPegarCode->execute();
                $resultCode = $queryPegarCode->fetch(PDO::FETCH_ASSOC);
    
                $hashedSenha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
                if (password_verify($_POST['codigo'], $resultCode['code'])) {
                    $queryTrocarSenha = $conn->prepare("UPDATE administrador SET senha = '$hashedSenha' WHERE id_administrador = $results[id_administrador]");
                    
                    try {
                        $queryTrocarSenha->execute();
                        
                        $queryVerificarCode = $conn->prepare("SELECT id_code FROM passwordcodeadmin WHERE id_admin = $results[id_administrador]");
                        if ($queryVerificarCode->execute()) {
                            
                            while ($queryVerificarIdCode = $queryVerificarCode->fetch(PDO::FETCH_ASSOC)){
                                $queryDeletarCode = $conn->prepare("DELETE FROM passwordcodeadmin WHERE id_code = $queryVerificarIdCode[id_code]");
                                $queryDeletarCode->execute();
                            }
                        };
                        $_SESSION["messageInformationLogin"] = 'Senha alterada com sucesso!';
                        $_SESSION['miColor'] = 'green';
                        header("location: ../login.php");

                    } catch (Exception $e) {
                        $_SESSION["messageInformation"] = 'Dados incorretos, tente novamente!';
                        $_SESSION['miColor'] = '#2186C8';
                    };
                } else {
                    $_SESSION["messageInformation"] = 'Código incorreto!';
                    $_SESSION['miColor'] = '#FA6E65';
                };
            } else {
                $_SESSION["messageInformation"] = 'Senhas não conferem!';
                $_SESSION['miColor'] = '#2186C8';
            }
            
        } else {
            $_SESSION["messageInformation"] = 'Dados incorretos!';
            $_SESSION['miColor'] = '#FA6E65';
        }
    
    } 
    
    //Login Estudante
    if(!empty($_POST['matricula'])){
        $query = "SELECT id_aluno FROM aluno WHERE matricula = :matricula";
        $records = $conn->prepare($query);
        $records->bindParam(':matricula', $_POST['matricula']);
        $records->execute();

        $results = $records->fetch(PDO::FETCH_ASSOC);

        if ($results == false){
            $results = [];
        }

        if ($results){
            if ($_POST['senha'] == $_POST['verificarSenha']){
                $queryPegarCode = $conn->prepare("SELECT code FROM passwordcodealuno WHERE id_aluno = $results[id_aluno]");
                $queryPegarCode->execute();
                $resultCode = $queryPegarCode->fetch(PDO::FETCH_ASSOC);
    
                $hashedSenha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
                if (password_verify($_POST['codigo'], $resultCode['code'])) {
                    $queryTrocarSenha = $conn->prepare("UPDATE aluno SET senha = '$hashedSenha' WHERE id_aluno = $results[id_aluno]");
                    
                    try {
                        $queryTrocarSenha->execute();
                        
                        $queryVerificarCode = $conn->prepare("SELECT id_code FROM passwordcodealuno WHERE id_aluno = $results[id_aluno]");
                        if ($queryVerificarCode->execute()) {
                            
                            while ($queryVerificarIdCode = $queryVerificarCode->fetch(PDO::FETCH_ASSOC)){
                                $queryDeletarCode = $conn->prepare("DELETE FROM passwordcodealuno WHERE id_code = $queryVerificarIdCode[id_code]");
                                $queryDeletarCode->execute();
                            }
                        };
                        $_SESSION["messageInformationLogin"] = 'Senha alterada com sucesso!';
                        $_SESSION['miColor'] = 'green';
                        header("location: ../login.php");

                    } catch (Exception $e) {
                        $_SESSION["messageInformation"] = 'Dados incorretos, tente novamente!';
                        $_SESSION['miColor'] = '#2186C8';
                    };
                } else {
                    $_SESSION["messageInformation"] = 'Código incorreto!';
                    $_SESSION['miColor'] = '#FA6E65';
                };
            } else {
                $_SESSION["messageInformation"] = 'Senhas não conferem!';
                $_SESSION['miColor'] = '#2186C8';
            }
            
        } else {
            $_SESSION["messageInformation"] = 'Dados incorretos!';
            $_SESSION['miColor'] = '#FA6E65';
        }
    }

    //Login Empresa
    if(!empty($_POST['cnpj'])){
        $query = "SELECT id_empresa FROM empresa WHERE cnpj = :cnpj";
        $records = $conn->prepare($query);
        $records->bindParam(':cnpj', $_POST['cnpj']);
        $records->execute();

        $results = $records->fetch(PDO::FETCH_ASSOC);

        if ($results == false){
            $results = [];
        }

        if ($results){
            if ($_POST['senha'] == $_POST['verificarSenha']){
                $queryPegarCode = $conn->prepare("SELECT code FROM passwordcodeempresa WHERE id_empresa = $results[id_empresa]");
                $queryPegarCode->execute();
                $resultCode = $queryPegarCode->fetch(PDO::FETCH_ASSOC);
    
                $hashedSenha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
                if (password_verify($_POST['codigo'], $resultCode['code'])) {
                    $queryTrocarSenha = $conn->prepare("UPDATE empresa SET senha = '$hashedSenha' WHERE id_empresa = $results[id_empresa]");
                    
                    try {
                        $queryTrocarSenha->execute();
                        
                        $queryVerificarCode = $conn->prepare("SELECT id_code FROM passwordcodeempresa WHERE id_empresa = $results[id_empresa]");
                        if ($queryVerificarCode->execute()) {
                            
                            while ($queryVerificarIdCode = $queryVerificarCode->fetch(PDO::FETCH_ASSOC)){
                                $queryDeletarCode = $conn->prepare("DELETE FROM passwordcodeempresa WHERE id_code = $queryVerificarIdCode[id_code]");
                                $queryDeletarCode->execute();
                            }
                        };
                        $_SESSION["messageInformationLogin"] = 'Senha alterada com sucesso!';
                        $_SESSION['miColor'] = 'green';
                        header("location: ../login.php");

                    } catch (Exception $e) {
                        $_SESSION["messageInformation"] = 'Dados incorretos, tente novamente!';
                        $_SESSION['miColor'] = '#2186C8';
                    };
                } else {
                    $_SESSION["messageInformation"] = 'Código incorreto!';
                    $_SESSION['miColor'] = '#FA6E65';
                };
            } else {
                $_SESSION["messageInformation"] = 'Senhas não conferem!';
                $_SESSION['miColor'] = '#2186C8';
            }
            
        } else {
            $_SESSION["messageInformation"] = 'Dados incorretos!';
            $_SESSION['miColor'] = '#FA6E65';
        }
        
    }

    


    
?>


<!DOCTYPE html>
<html lang="pt-br">

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
    <title>Editar Senha</title>
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

        if (!empty($_SESSION['messageInformationOutraPagina'])) {

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
                                    $_SESSION[messageInformationOutraPagina]
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

                    $_SESSION['messageInformationOutraPagina'] = '';
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
                            <form action="./passwordChange.php" method="POST" class="data">
                                <img src="../../imagens/admin.png" alt="">
                                <hr>
                                <input type="text" placeholder="SIAPE" name="siape">
                                <input type="password" placeholder="Senha" name="senha">
                                <input type="password" placeholder="verificar Senha" name="verificarSenha">
                                <input type="text" placeholder="Código" name="codigo">
                                
                                <button type="submit">Editar Senha</button>
                            </form>
                        </div>
                    </div>
                    <div id="tab2" style="display: block;">
                        <div class="loginForm">
                            <form action="./passwordChange.php" method="POST" class="data">
                                <img src="../../imagens/aluno.png" alt="">
                                <hr>
                                <input type="text" placeholder="Matricula" name="matricula">
                                <input type="password" placeholder="Senha" name="senha">
                                <input type="password" placeholder="verificar Senha" name="verificarSenha">
                                <input type="text" placeholder="Código" name="codigo">
                                
                                <button type="submit">Editar Senha</button>
                            </form>
                        </div>
                    </div>
                    <div id="tab3" style="display: none;">
                        <div class="loginForm">
                            <form action="./passwordChange.php" method="POST" class="data">
                                <img src="../../imagens/empresa.png" alt="">
                                <hr>
                                <input type="text" placeholder="CNPJ" name="cnpj">
                                <input type="password" placeholder="Senha" name="senha">
                                <input type="password" placeholder="verificar Senha" name="verificarSenha">
                                <input type="text" placeholder="Código" name="codigo">
                                
                                <button type="submit">Editar Senha</button>
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