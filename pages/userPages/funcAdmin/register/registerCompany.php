<?php

    require_once('../../../../includes/connection.php');
    require_once('../adminAuth.php');

    if (!empty($_POST['cnpj']) && !empty($_POST['nome']) && !empty($_POST['email']) && !empty($_POST['senha']) && !empty($_POST['numero'])){

        if ($_POST['senha'] == $_POST['verificarSenha']){
            
            $nome = $_POST['nome'];
            $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);;
            $cnpj = $_POST['cnpj'];
            $email = $_POST['email'];
            $numero = $_POST['cnpj'];
    
            $query = $conn->prepare("SELECT * FROM empresa WHERE cnpj = :cnpj OR email = :email");
            $query->bindParam(':cnpj', $cnpj);
            $query->bindParam(':email', $email);
            $query->execute();

            $results = $query->fetch(PDO::FETCH_ASSOC);

            if($results == 0){
                $query = $conn->prepare('
                    INSERT INTO empresa (
                        nome,
                        senha,
                        cnpj,
                        email,
                        numero
                    ) VALUES (
                        :nome,
                        :senha,
                        :cnpj,
                        :email,
                        :numero
                    )');

                $query->bindParam(':nome', $nome);
                $query->bindParam(':senha', $senha);
                $query->bindParam(':cnpj', $cnpj);
                $query->bindParam(':email', $email);
                $query->bindParam(':numero', $numero);

                try {
                    $query->execute();
                    $_SESSION['messageInformation'] = 'Empresa Cadastrado!';
                    $corToast = 'green';
                } catch (Exception $err) {
                    $_SESSION['messageInformation'] = "Ocorreu um erro ao registrar a empresa, verifique se todos os dados estão corretos Erro: $err";
                    $corToast = 'red';
                }

            } else {
                $_SESSION['messageInformation'] = 'Esta empresa já está cadastrado!';
                $corToast = '#0dc1fd';
            }
        } else {
            $_SESSION['messageInformation'] = 'Senhas não coincidem, tente novamente!';
            $corToast = '#0dc1fd';
        }
                
    } else {
        if(isset($_POST['singup'])) {
            if (empty($_POST['salario'] || $_POST['cargo'] || $_POST['descricao'])) {
                $_SESSION['messageInformation'] = "Por favor, preencha todos os dados do formulário";
                $corToast = '#0dc1fd';
            }
        }


    }

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../../../Bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="../../../css/admin/registerCompany/registerCompany.css">
    <script src="../../../../Bootstrap/js/bootstrap.bundle.js"></script>
    <title>Adicionar Vagas</title>
    <script>
        if ( window.history.replaceState ) {
            window.history.replaceState( null, null, window.location.href );
        }
    </script>
</head>

<body>
<?php 
        if (!empty($_SESSION['messageInformation'])){
            
            
            echo "
            <div class='toast-container position-fixed' style='style='left: 50%;
            position: fixed;
            transform: translate(-50%, 0px);
            z-index: 9999; border: none; margin-top: 2%'>
                <div id='liveToast' class='toast' role='alert' aria-live='assertive' aria-atomic='true' style='background-color: white;'>
                    <div class='toast-header' style='background-color: $corToast; color: white'>
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

<nav class="navbar navbar-dark bg-dark sticky-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="../../../login.php">COPEX</a>
            <div class="voltar">
                <a href="../../../login.php">Voltar</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDarkNavbar" aria-controls="offcanvasDarkNavbar">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
            <div class="offcanvas offcanvas-end text-bg-dark" tabindex="-1" id="offcanvasDarkNavbar" aria-labelledby="offcanvasDarkNavbarLabel">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title" id="offcanvasDarkNavbarLabel">COPEX</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                </div>
                <div class="offcanvas-body">

                    <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                        <li class="nav-item">
                            <a class="nav-link" href="../../../login.php">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="../../../sair.php">Logout</a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </nav>

    <div class="center">
        <div class="register">
            <h1>Registro de Empresa</h1>
            <form method="POST" action="./registerCompany.php">
                <div class="first">
                    <input name='cnpj' type="text" placeholder="CNPJ" required>
                    <input name='nome' type="text" placeholder="Nome da Empresa" required>
                </div>
                <div class="second">
                    <input name='email' type="text" placeholder="E-mail da Empresa" required>
                </div>
                <div class="third">
                    <input name='numero' type="text" placeholder="Número" required>
                </div>
                <div class="fourth">
                    <input name='senha' type="password" placeholder="Senha" required>
                    <input name='verificarSenha' type="password" placeholder="Verificar Senha" required>
                </div>

                <input class="button" type="submit" name="singup" value="Registrar Empresa">
            </form>
        </div>
    </div>
    
</body>
</html> 