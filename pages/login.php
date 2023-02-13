<?php
    require_once "./login/loginAuth.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="./css/headerIndex.css">
    <link rel="stylesheet" href="./css/headerHome.css">
    <link rel="stylesheet" href="./css/login.css">
    <script src="../library/jquery/jquery.min.js"></script>
    <script src="../Bootstrap/js/bootstrap.bundle.js"></script>
    <title>Login</title>
</head>

<body id="grad">
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <a href="../index.php" class="navbar-brand">COPEX</a>
            <form class="d-flex" role="search">
                <a href="../index.php" class="home">
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

        if (!empty($_SESSION['messageInformationLogin'])) {

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
                                    $_SESSION[messageInformationLogin]
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

                    $_SESSION['messageInformationLogin'] = '';
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
                            <form action="login.php" method="POST" class="data">
                                <img src="../imagens/admin.png" alt="">
                                <hr>
                                <input type="name" placeholder="Digite seu SIAPE" name="siape">
                                
                                <input type="password" placeholder="Digite sua senha" name="password">
                                <a href="./forgotPassword/forgotPassword.php" class="recuperacao">Esqueceu sua senha?</a>
                                <button type="submit">Login</button>
                            </form>
                        </div>
                    </div>
                    <div id="tab2" style="display: block;">
                        <div class="loginForm">
                            <form action="login.php" method="POST" class="data">
                                <img src="../imagens/aluno.png" alt="">
                                <hr>
                                <input type="text" placeholder="Digite sua matricula" name="matricula">
                                
                                <input type="password" placeholder="Digite sua senha" name="password_aluno">
                                <a href="./forgotPassword/forgotPassword.php" class="recuperacao">Esqueceu sua senha?</a>
                                <button type="submit">Login</button>
                            </form>
                        </div>
                    </div>
                    <div id="tab3" style="display: none;">
                        <div class="loginForm">
                            <form action="login.php" method="POST" class="data">
                                <img src="../imagens/empresa.png" alt="">
                                <hr>
                                <input type="name" placeholder="Digite seu CNPJ" name="cnpj">
                                
                                <input type="password" placeholder="Digite sua senha" name="password_empresa">
                                <a href="./forgotPassword/forgotPassword.php" class="recuperacao">Esqueceu sua senha?</a>
                                <button type="submit">Login</button>
                                
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